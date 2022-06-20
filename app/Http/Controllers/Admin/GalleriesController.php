<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Services\Notify\Facades\Notify;
use App\Models\Career;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Page;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GalleriesController extends BaseController
{
    //region Private
    private $data = [
        'title'=>'Галерея',
    ];
    private $settings = [
        'thumb_method'=>'fit',
        'thumb_width'=>280,
        'thumb_height'=>210,
        'thumb_upsize'=>true,
        'method'=>'resize',
        'width'=>1440,
        'height'=>null,
        'upsize'=>true,
    ];
    private $gallery;
    private $key;

    private function verify($gallery, $key){
        $this->gallery = $this->data['gallery'] = $gallery;
        $this->key = $this->data['key'] = $key;
        $method_name = 'gallery_'.$gallery;
        if (!method_exists($this, $method_name)) abort(404);
        $use_keys = $key===null?false:true;
        $require_keys = (new \ReflectionMethod($this, $method_name))->getNumberOfRequiredParameters()==0?false:true;
        if ($use_keys !== $require_keys)  abort(404);
        if ($key) $this->{$method_name}($key);
        else $this->{$method_name}();
    }

    private function verifyFromRequest($request){
        $gallery = $request->input('gallery');
        $key = $request->input('key');
        if (!$gallery || ($key!==null && !is_id($key))) abort(404);
        $this->verify($gallery, $key);
    }

    private function set(array $new_settings){
        $this->settings = array_merge($this->settings, $new_settings);
    }

    public function show($gallery, $key=null) {
        $this->verify($gallery, $key);
        $this->data['images'] = Gallery::adminList($gallery, $key);
        return view('admin.pages.gallery.main', $this->data);
    }

    public function sort(){
        $ids = Gallery::sortable(true);
        if (!$ids) return response()->json(false);
        return response()->json(true);
    }

    public function delete(Request $request){
        $result = ['success'=>false];
        $id = $request->input('item_id');
        if ($id && is_id($id)) {
            $item = Gallery::where('id', $id)->first();
            if ($item && Gallery::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    public function add(Request $request) {
        $this->verifyFromRequest($request);
        $images = $request->images;
        Validator::make(['images'=>$images], [
            'images'=>'required|array',
            'images.*'=>'image|mimes:png,jpeg,gif'
        ], [
            'required'=>'Выберите изоброжении',
            'array'=>'Выберите изоброжении',
            'image'=>'Формат не поддерживается',
            'mimes'=>'Формат не поддерживается',

        ])->validate();
        if(Gallery::addImages($this->gallery, $this->key, $images, $this->settings)) {
            Notify::success('Изоброжении успешно добавлены');
        }
        else {
            Notify::error('Некаторые изоброжении не добавлены');
        }
        $args = ['gallery'=>$this->gallery];
        if ($this->key) $args['id'] = $this->key;
        return redirect()->route('admin.gallery', $args);
    }

    public function edit(Request $request) {
        $id = $request->input('item_id');
        $response = ['success'=>false];
        if (is_id($id) && $item = Gallery::where('id', $id)->first()) {
            $values = $request->only('alt', 'title');
            Gallery::updateSeo($item, $values);
            $response['success'] = true;
        }
        return response()->json($response);

    }
    public function poster(Request $request){
        $id = $request->input('item_id');
        $response = ['success'=>false];
        if (is_id($id) && $item = Gallery::where('id', $id)->first()) {
//            return response()->json($request->only('poster'));
            $values = ['poster'=>$request->poster];
            Gallery::poster($item, $values);
            $response['success'] = true;
        }
        return response()->json($response);
    }
    //endregion

    private function gallery_estates($key){
        $this->data['title'] = 'Галерея';
        $this->data['back_url'] = route('admin.pages.main');
    }

    private function gallery_pages($key) {
        $item = Page::getPage($key);

        $this->data['title'] = 'Галерея страницы "'.$item->a('title').'"';
        $this->data['back_url'] = route('admin.pages.main');
    }

    private function gallery_services_item($key){
        $item = Service::getItem($key);
        $this->data['title'] = 'Галерея услуги "'.$item->a('title').'"';
        $this->data['back_url'] = route('admin.services.main');
    }

    private function gallery_news(){
        $this->data['title'] = 'Галерея страницы новостей';
        $this->data['back_url'] = route('admin.pages.main');
    }

    private function gallery_news_item($key){
        $item = News::getItem($key);
        $this->data['title'] = 'Галерея новости "'.$item->a('title').'"';
        $this->data['back_url'] = route('admin.news.main');
    }



}
