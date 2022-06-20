<?php

namespace App\Http\Controllers\Site;

use App\Mail\OrderSent;
use App\Models\Banner;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ProductsController extends BaseController
{
    public function show($url){
        if (!is_active('menu')) abort(404);
        $data = [];
        $data['item'] = Product::getItemSite($url);
        $data['seo'] = $this->renderSEO($data['item']);
        $data['other_products'] = Product::getRandom($data['item']->id);
        $data['banners'] = Banner::get('menu');
        return view('site.pages.product', $data);
    }

    public function basket(){
        $data = [];
        $data['basket_hidden'] = true;
        $data['noindex'] = true;
//        session(['referer'=>url()->previous()]);
        $data['seo'] = $this->staticSEO(__('app.basket'));

        $data['delivery_prices'] = Delivery::siteList();

        if($data['delivery_prices_count'] = count($data['delivery_prices'])) {
            $data['deliveryChecked'] = oldCheck('delivery', false);
            $data['oldDistrict'] = old('district');
            $data['oldPrice'] = 0;
            if ($data['oldDistrict'] && ($thisDistrict = $data['delivery_prices']->where('id', $data['oldDistrict'])->first())) {
                $data['oldPrice'] = $thisDistrict->price;
            }
            else {
                $thisDistrict = $data['delivery_prices']->first();
                $data['oldDistrict'] = $thisDistrict->id;
                $data['oldPrice'] = $thisDistrict->price;
            }
        }
        return view('site.pages.basket', $data);
    }

    public function order(Request $request) {
        if (!count($this->shared['products_array'])) return redirect()->route('basket');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required_with:delivery|nullable|string|max:255',
            'email' => 'nullable|string|mail|max:255',
            'phone' => 'required|string|phone|max:255',
            'phone_2' => 'nullable|string|phone|max:255',
            'message' => 'nullable|string|max:1000'
        ], [
            'required' => __('auth.required'),
            'required_with' => __('auth.required'),
            'string' => __('auth.required'),
            'max' => __('auth.max'),
            'phone' => __('auth.invalid phone'),
            'mail' => __('auth.invalid email'),
        ]);
        if ($validator->fails()) {
            return redirect()->route('basket', ['order'=>1])->withErrors($validator)->withInput();
        }
        if ($request->has('delivery')){
            $delivery_id = $request->input('district');
            if (!$delivery_id || !($district = Delivery::getItemSite($delivery_id))) return redirect()->route('basket', ['order'=>1])->withInput();
            $delivery = [
                'id'=>$district->id,
                'title'=>$district->getTranslations('title'),
                'price' => $district->price,
                'min_sum' => $this->shared['min_sum']
            ];
        }
        else {
            $delivery = [
                'id'=>null,
            ];
        }

        $order = Order::makeOrder($this->shared['basket_products'], $delivery);
        if (!$order) {
            return redirect()->route('basket', ['order'=>1])->withInput();
        }
        $email = $this->shared['info']->data->contact_email;
        $request_email = $request->input('email');
        if ($email && is_email($email)) {
            $mail = Mail::to($email);
            if ($request_email) {
                $mail->cc($request->input('email'));
            }
        }
        else if($request_email) $mail = Mail::to($request->input('email'));
        if (isset($mail)) try{
            $mail->send(new OrderSent($order));
        } catch (\Exception $e){}
        return redirect()->route('page')->with(['order_success'=>true])->withInput();
    }

    public function search(Request $request){
        $q = $request->get('q');
        if (!$q) return redirect(page('menu'));
        $data['items'] = Product::search($q);
        $data['catalogue_title'] = __('app.search');
        $data['search'] = $q;
        $data['noindex'] = true;
        $data['seo'] = $this->staticSEO(__('app.search results'));
        return view('site.pages.menu', $data);
    }

}
