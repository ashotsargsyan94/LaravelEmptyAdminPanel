<?php 
namespace App\Services\Basket;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class Basket {
    private $products = null;
    private $basketProducts = null;

    public function encode($array) {
        $string = '';
        foreach ($array as $item) {
            if ($string) $string.='_';
            $string .= $item['id'].'-'.$item['count'].'-'.implode('.', $item['options']);
        }
        return $string;
    }

    public function decode($string){
        $result = [];
        $first = explode('_', $string);
        foreach ($first as $item) {
            $second = explode('-', $item);
            if (is_id($second[0]??'') && is_id($second[1]??'') && preg_match('/^([1-9][0-9]{0,9}(\.[1-9][0-9]{0,9})*)?$/', $second[2]??'')) {
                $result[] = [
                    'id' => (int) $second[0],
                    'count' => (int) $second[1],
                    'options' => ($second[2]??null)?explode('.', $second[2]):null
                ];
            }
        }
        return $result;
    }

    private $config = [
        'minutes' => 60*24,
        'cookie_name' => 'basket',
    ];

    public function getCookieName(){
        return $this->config['cookie_name'];
    }

    public function getProducts(){
        if ($this->products === null) $this->getCookie();
        return [
            'products' => $this->products,
            'basketProducts' => $this->basketProducts
        ];
    }

    private function getCookie(){
        $cookie = Cookie::get($this->config['cookie_name']);
        $products = collect($this->decode($cookie));
        if (!count($products)) {
            $this->products = collect();
            $this->basketProducts = [];
            return false;
        }
        $ids = $products->pluck('id')->unique()->values()->toArray();
        $result = collect();
        $basket_products = [];
        $getProducts = Product::getFromArray($ids);
        foreach($products as $product) {
            $getProduct = $getProducts->where('id', $product['id'])->first();
            if ($getProduct && $product['count']>0) {
                if ($product['count']>999) $product['count'] = 999;
                $resultItem = [
                    'id' => $product['id'],
                    'count' => $product['count'],
                    'options' => []
                ];
                $productOptions = [];
                foreach ($getProduct->options as $option) {
                    if (in_array($option->id, $product['options']??[])) {
                        $resultItem['options'][] = (int) $option->id;
                        $productOptions[] = $option;
                    }
                }
                $findResult = $result->search(function($item, $key) use ($resultItem){
                    return ($item['id'] == $resultItem['id'] && $item['options'] == $resultItem['options']);
                });
                if ($findResult!==false) {
                    $newValue = $basket_products[$findResult]['count']+$resultItem['count'];
                    $result = $result->map(function($value, $key) use ($findResult, $newValue){
                        if ($key == $findResult) {
                            $value['count']=$newValue;
                        }
                        return $value;
                    });
                    $basket_products[$findResult]['count'] = $newValue;
                }
                else {
                    $result->push($resultItem);
                    $basket_products[] = [
                        'product' => $getProduct,
                        'count' => $product['count'],
                        'options' => $productOptions
                    ];
                }
            }
        }
        $this->products = $result;
        $this->basketProducts = $basket_products;
        $newCookie = $this->encode($result);
        if ($newCookie!==$cookie) $this->setCookie($newCookie);
        return true;
    }

    public function setCookie($cookie){
        if ($this->products!==null) Cookie::queue(Cookie::make($this->config['cookie_name'], $cookie, $this->config['minutes'], null, null, false, false));
        else $this->flush();
    }
    public function flush(){
        Cookie::queue(Cookie::forget($this->getCookieName()));
    }
}