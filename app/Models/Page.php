<?php

namespace App\Models;

use App\Http\Traits\UrlUnique;
use Illuminate\Support\Facades\Cache;
use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use App\Http\Traits\HasTranslations;
use \PageManager;

class Page extends Model
{
    use HasTranslations, Sortable, UrlUnique;

    protected $sortableDesc = false;
    public $translatable = ['title', 'content', 'seo_title', 'seo_description', 'seo_keywords'];

    //region Cache
    private static function cacheKeyMenu(){
        return 'menu';
    }

    private static function cacheKeyStatic(){
        return 'pages_static';
    }

    public static function clearCaches(){
        Cache::forget(self::cacheKeyMenu());
        Cache::forget(self::cacheKeyStatic());
    }

    public static function getStaticPages() {
        return Cache::rememberForever(self::cacheKeyStatic(), function(){
            return self::select('id', 'url', 'static', 'active')->whereNotNull('static')->get();
        });
    }

    public static function getMenu(){
        return Cache::rememberForever(self::cacheKeyMenu(), function(){
            return self::select('id', 'url', 'title', 'static')->where(['active'=>1, 'to_menu'=>1])->sort()->get();
        });
    }

    public static function adminList(){
        return self::select('id', 'title', 'active', 'static')->sort()->get();
    }

    public static function getStaticPage($static){
        return self::where(['static'=>$static, 'active'=>1])->firstOrFail();
    }

    public static function getPage($id){
        return self::findOrFail($id);
    }
    public static function getItemSite($url){
        return self::where(['active'=>1,'url'=>$url])->firstOrFail();
    }
    public static function actionPage($model, $inputs) {
        if (empty($model)) {
            $model = new self;
            $ignore = false;
            $action = 'add';
            $model['sort'] = $model->sortValue();
        }
        else {
            $ignore = $model->id;
            $action = 'edit';
        }
        if (!empty($inputs['generate_url'])) {
            $url = self::url_unique($inputs['generated_url'], $ignore);
                if (PageManager::inUsedRoutes($url) && $url!=$model->url) $url = $url.'-2';
            $length = mb_strlen($url, 'UTF-8');
            if($length==1) $url = '-'.$url.'-';
            else if ($length==2) $url=$url.'-';
        }
        else {
            $url = $inputs['url'];
        }
        $model['url'] = $url;
        $model['to_menu'] = (int) !empty($inputs['to_menu']);
        $model['show_image'] = (int) !empty($inputs['show_image']);
        $model['active'] = (int) (!empty($inputs['active']) || ($action=='edit' && $model['static'] == PageManager::getHomePage()));
        if ($action == 'add' || !$model->static) {
            $resizes = [
                [
                    'width'=>1440,
                    'height'=>270,
                    'upsize'=>true,
                ]
            ];
            if($image = upload_image('image', 'u/pages/', $resizes, ($action=='edit' && !empty($model->image))?$model->image:false)) $model->image = $image;
        }
        merge_model($inputs, $model, ['title', 'content', 'seo_title', 'seo_description', 'seo_keywords']);
        self::clearCaches();
        return $model->save();
    }

    public static function deletePage($model){
        self::clearCaches();
        if ($model->image) File::delete(public_path('u/pages/').$model->image);
        Gallery::clear('pages', $model->id);
        VideoGallery::clear('pages', $model->id);
        return $model->delete();
    }

    public function getUrlAttribute($value) {
        if ($this->static==\PageManager::getHomePage()) return '';
        return $value;
    }

}
