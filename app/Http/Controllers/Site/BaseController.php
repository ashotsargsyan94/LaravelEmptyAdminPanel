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

        $this->shared['locale'] = app()->getLocale();
        $this->shared['languages'] = Language::getLanguages();
        foreach($this->shared['languages'] as $language) {
            if ($language->iso == $this->shared['locale']) $this->shared['current_language'] = $language;
        }
        $this->shared['homepage'] = PageManager::getHomePage();
        $this->shared['menu_pages'] = Page::getMenu();
        $this->shared['current_url'] = url()->current();

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

        return $seo;
    }

    protected function staticSEO($title){
        $seo = ['title' => $title];

        return $seo;
    }
}
