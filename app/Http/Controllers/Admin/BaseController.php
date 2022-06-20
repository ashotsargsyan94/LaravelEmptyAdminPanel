<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Order;

class BaseController extends Controller
{
    protected $languages;
    protected $lang;
    protected $isos;
    protected $urlLang;
    public $shared;
    public function __construct() {
        $this->middleware(function($request, $next){
            $this->view_share();
            return $next($request);
        });
    }
    public function view_share(){
        $languages = Language::select('id','iso', 'title')->where('active', '>=', '0')->sort()->get();
        $languagesResult = [];
        $isos = [];
        $admin_language = settings('admin_language', 1);
        $url_language = settings('url_language', 1);
        foreach($languages as $language) {
            if($language->id==$admin_language) {
                $this->lang = $language->iso;
            }
            if($language->id==$url_language) {
                $this->urlLang = $language->iso;
            }
            $languagesResult[] = [
                'iso'=>$language->iso,
                'title'=>$language->title,
            ];
            $isos[] = $language->iso;
        }
        $default_language = $languages->where('id', settings('default_language', 1))->first()->iso;
        if (!$this->lang) $this->lang = $default_language;
        if (!$this->urlLang) $this->urlLang = $default_language;
        $this->languages = $languagesResult;
        $this->isos = $isos;
        $this->shared = [
            'lang'=>$this->lang,
            'languages'=>$languagesResult,
            'isos'=>$isos,
            'urlLang'=>$this->urlLang,
        ];
        view()->share($this->shared);
    }
}
