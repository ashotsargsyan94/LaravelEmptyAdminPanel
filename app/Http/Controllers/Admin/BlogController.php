<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogController extends BaseController
{
    public function main(){
        $data = ['title'=>'Блог'];
        $data['items'] = Blog::adminList();
        return view('admin.pages.blog.main', $data);
    }
    public function add(){
        $data = [];
        $data['title'] = 'Добавление блога';
        $data['back_url'] = route('admin.blog.main');
        $data['edit'] = false;
        return view('admin.pages.blog.form', $data);
    }
    public function add_put(Request $request){
        $validator = $this->validator($request);
        $validator['validator']->validate();
        if(Blog::action(null, $validator['inputs'])) {
            Notify::success('Блог успешно добавлен.');
            return redirect()->route('admin.blog.add');
        }
        else {
            Notify::get('error_occured');
            return redirect()->back()->withInput();
        }
    }
    public function edit($id){
        $data = [];
        $data['item'] = Blog::getItem($id);
        $data['title'] = 'Редактирование блога';
        $data['back_url'] = route('admin.blog.main');
        $data['edit'] = true;
        return view('admin.pages.blog.form', $data);
    }
    public function edit_patch($id, Request $request){
        $item = Blog::getItem($id);
        $validator = $this->validator($request, $item->id);
        $validator['validator']->validate();
        if(Blog::action($item, $validator['inputs'])) {
            Notify::success('Блог успешно редактирован.');
            return redirect()->route('admin.blog.edit', ['id'=>$item->id]);
        }
        else {
            Notify::get('error_occured');
            return redirect()->back()->withInput();
        }
    }
    public function delete(Request $request) {
        $result = ['success'=>false];
        $id = $request->input('item_id');
        if ($id && is_id($id)) {
            $page = Blog::where('id', $id)->first();
            if ($page && Blog::deleteItem($page)) $result['success'] = true;
        }
        return response()->json($result);
    }
    public function sort(){
        return Blog::sortable();
    }
    private function validator($request, $ignore=false) {
        $inputs = $request->all();
        if(!empty($inputs['url'])) $inputs['url'] = lower_case($inputs['url']);
        $inputs['generated_url'] = !empty($inputs['title'][$this->urlLang])?to_url($inputs['title'][$this->urlLang]):null;
        $request->merge(['url' => $inputs['url']]);
        $unique = $ignore===false?null:','.$ignore;
        $result = [];
        $rules = [
            'generated_url'=>'required_with:generate_url|string|nullable',
        ];
        if (empty($inputs['generate_url'])) {
            $rules['url'] = 'required|is_url|string|unique:blogs,url'.$unique.'|nullable';
        }
        if (!$ignore) {
            $rules['image'] = 'required|image';
        }
        else {
            $rules['image'] = 'image|nullable';
        }
        $result['validator'] = Validator::make($inputs, $rules, [
            'generated_url.required_with'=>'Введите название ('.$this->urlLang.') чтобы сгенерировать URL.',
            'url.required'=>'Введите URL или подставьте галочку "сгенерировать автоматический".',
            'url.is_url'=>'Неправильный URL.',
            'url.unique'=>'URL уже используется.',
            'image.image'=>'Неверное изоброжение.',
            'image.required'=>'Выберите изоброжение.'
        ]);
        $result['inputs'] = $inputs;
        return $result;
    }
}
