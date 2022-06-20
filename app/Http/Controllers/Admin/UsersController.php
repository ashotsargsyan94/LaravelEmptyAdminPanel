<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Services\Notify\Facades\Notify;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends BaseController
{
    public function main(){
        $data = ['title'=>'Пользователи'];
        $data['items'] = User::getUsers();
        return view('admin.pages.users.main', $data);
    }

    public function view($id){
        $data = [];
        $data['item'] = User::where(['id'=>$id, 'admin'=>0])->with('orders')->firstOrFail();
        $data['title'] = 'Пользователь "'.$data['item']->email.'"';
        $data['orders'] = $orders = $data['item']->orders;
        $data['orders_count'] = [
            'pending' => $orders->where('status', Order::PENDING)->count(),
            'accepted' => $orders->where('status', Order::ACCEPTED)->count(),
            'declined' => $orders->where('status', Order::DECLINED)->count(),
        ];
//        $data['back_url'] = route('admin.users.main');
        return view('admin.pages.users.view', $data);
    }

    public function toggleActive(Request $request){
        $id = $request->input('id');
        $active = $request->input('active');
        if (!is_id($id)) abort(404);
        $item = User::findOrFail($id);
        $item->active = $active?1:0;
        $item->save();
        Notify::success('Изменении сохранены');
        return redirect()->route('admin.users.view', ['id'=>$item->id]);
    }
}
