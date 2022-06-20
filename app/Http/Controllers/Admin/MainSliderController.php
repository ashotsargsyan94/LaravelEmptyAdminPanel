<?php
namespace App\Http\Controllers\Admin;
//use App\Custom\Notify\Facades\Notify;
use App\Models\MainSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\Notify\Facades\Notify;
class MainSliderController extends BaseController
{
    public function main(){
        $data = ['title'=>'Главный слайдер'];
        $data['items'] = MainSlide::adminList();
        return view('admin.pages.main_slider.main', $data);
    }
    public function add(){
        $data = [];
        $data['title'] = 'Добавление главного слайда';
        $data['back_url'] = route('admin.main_slider.main');
        $data['edit'] = false;
        return view('admin.pages.main_slider.form', $data);
    }
    public function add_put(Request $request){
        $inputs = $request->all();
        $this->validator($inputs)->validate();
        if(MainSlide::action(null, $inputs)) {
            Notify::success('Слайд успешно добавлен.');
            return redirect()->route('admin.main_slider.add');
        }
        else {
            Notify::get('error_occured');
            return redirect()->back()->withInput();
        }
    }
    public function edit($id){
        $data = [];
        $data['item'] = MainSlide::getItem($id);
        $data['title'] = 'Редактирование главного слайда';
        $data['back_url'] = route('admin.main_slider.main');
        $data['edit'] = true;
        return view('admin.pages.main_slider.form', $data);
    }
    public function edit_patch($id, Request $request){
        $item = MainSlide::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, true)->validate();
        if(MainSlide::action($item, $inputs)) {
            Notify::success('Слайд успешно редактирован.');
            return redirect()->route('admin.main_slider.edit', ['id'=>$item->id]);
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
            $page = MainSlide::where('id', $id)->first();
            if ($page && MainSlide::deleteItem($page)) $result['success'] = true;
        }
        return response()->json($result);
    }
    public function sort(){return MainSlide::sortable();
    }
    public function main_second(){
        $data = ['title'=>'Главный слайдер'];
        $data['items'] = MainSlide::adminList()->where('slider_type','0');
        return view('admin.pages.main_slider_second.main', $data);
    }
    private function validator($inputs, $edit=false) {
        $result = [];
        $rules = !$edit?[
            'image'=>'required|image',
        ]:[
            'image'=>'image',
        ];
        return Validator::make($inputs, $rules, [
            'image.image'=>'Неверное изоброжение.',
            'image.required'=>'Выберите изоброжение.'
        ]);
    }
}
