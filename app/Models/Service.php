<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\HasTranslations;
use App\Http\Traits\Sortable;
use App\Http\Traits\UrlUnique;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Service extends Model
{

    use HasTranslations, Sortable, UrlUnique;
    public $translatable = ['title', 'desc', 'short_desc', 'seo_title', 'seo_description', 'seo_keywords'];

    public function galleries()
    {
        return self::hasMany(Gallery::class,'key','id');
    }

    public static function adminList()
    {
        return self::select('id', 'title', 'image', 'short_desc', 'active')->sort()->get();
    }

    private static function cacheKey()
    {
        return 'services';
    }

    private static function clearCaches()
    {
        Cache::forget(self::cacheKey());
    }

    public static function getItem($id)
    {
        $result = self::where('id', $id)->first();
        if (!$result) abort(404);
        return $result;
    }

    public static function getItemSite($url)
    {
        return self::where(['url' => $url, 'active' => 1])->firstOrFail();
    }

    public static function getItems()
    {
        return self::where(['active' => 1])->with('galleries')->sort()->get();
    }


    public static function action($model, $inputs)
    {
        self::clearCaches();
        if (empty($model)) {
            $model = new self;
            $action = 'add';
            $ignore = false;
        } else {
            $action = 'edit';
            $ignore = $model->id;
        }
        $model['active'] = !empty($inputs['active']) ? 1 : 0;
        if (!empty($inputs['generate_url'])) {
            $url = self::url_unique($inputs['generated_url'], $ignore);
        } else {
            $url = $inputs['url'];
        }
        $model['url'] = $url;
        merge_model($inputs, $model, ['title', 'short_desc', 'desc', 'seo_title', 'seo_keywords', 'seo_description']);
        $resizes = [
            [
                'width' => 60,
                'height' => 60,
                'method' => 'resize',
                'upsize' => true,
            ]
        ];
        if ($image = upload_image('image', 'u/services/', $resizes, ($action == 'edit' && !empty($model->image)) ? $model->image : false)) $model->image = $image;
        return $model->save();
    }


    public static function deleteItem($model)
    {
        $path = public_path('u/services/');
        if (!empty($model->image)) File::delete($path . $model->image);
        return $model->delete();
    }
}
