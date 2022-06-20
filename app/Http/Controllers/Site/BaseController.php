<?php

namespace App\Http\Controllers\Site;

use App\Models\Banner;
use App\Models\HomePlan;
use App\Models\Language;
use App\Models\MainSlide;
use App\Models\News;
use App\Models\Page;
use App\Models\Service;
use App\Services\PageManager\Facades\PageManager;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $shared = [];

    protected function view_share() {
        if (count($this->shared)) return false;
        //start
//        $this->shared['logo_image'] = Banner::get('info')->data->header_logo;
        //
        $this->shared['locale'] = app()->getLocale();
        $this->shared['languages'] = Language::getLanguages();
        foreach($this->shared['languages'] as $language) {
            if ($language->iso == $this->shared['locale']) $this->shared['current_language'] = $language;
        }
        $this->shared['homepage'] = PageManager::getHomePage();
        $this->shared['menu_pages'] = Page::getMenu();
        $this->shared['current_url'] = url()->current();
//        $this->shared['info'] = Banner::get('info');
//        $this->shared['suffix'] =  $this->shared['info']->seo->title_suffix;
//        $this->shared['home'] = Banner::get('home');
//        $this->shared['socials'] = collect($this->shared['info']->socials)->filter(function($item){
//            return $item->icon && $item->url;
//        });
//        $this->shared['footer_links'] = collect($this->shared['info']->footer_links)->filter(function($item){
//            return $item->title;
//        });
        view()->share($this->shared);
        return true;
    }

    public function __construct(){
        $this->middleware(function($request, $next){
            $this->view_share();
            return $next($request);
        });
    }

    protected function renderSEO($item) {
        $seo = [
            'title' => $item->seo_title,
            'keywords' => $item->seo_keywords,
            'description' => $item->seo_description,
        ];
//        if (!$seo['title']) {
//            $title = $item->title;
//            if ($this->shared['suffix']) {
//                if ($title) $title.= ' - ';
//                $title.=$this->shared['suffix'];
//            }
//            $seo['title'] = $title;
//        }
        return $seo;
    }

    protected function staticSEO($title){
        $seo = ['title' => $title];
//        if ($this->shared['suffix']) {
//            if ($seo['title']) $seo['title'] .= ' - ';
//            $seo['title'].= $this->shared['suffix'];
//        }
        return $seo;
    }
}
