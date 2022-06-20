<?php
namespace App\Models;
use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use App\Http\Traits\HasTranslations;
class MainSlide extends Model
{


    use HasTranslations, Sortable;
    public $translatable = ['title', 'line_1', 'line_2'];
    public static function adminList(){
        return self::select('id', 'image', 'active')->sort()->get();
    }
    private static function cacheKey(){
        return 'main_slide';
    }
    private static function clearCaches(){
        Cache::forget(self::cacheKey());
    }
    public static function getSlides(){
        return Cache::rememberForever(self::cacheKey(), function(){
            return self::where('active', 1)->sort()->get();
        });
    }

    public static function getItem($id){
        $result = self::where('id',$id)->first();
        if (!$result) abort(404);
        return $result;
    }
    public static function action($model, $inputs) {
        self::clearCaches();
        if (empty($model)) {
            $model = new self;
            $action = 'add';
        }
        else {
            $action = 'edit';
        }
        $model['active'] = !empty($inputs['active'])?1:0;
        merge_model($inputs, $model, ['line_1', 'line_2', 'title']);
        $resizes = [
            [
                'width'=>1440,
                'height'=>600,
                'upsize'=>true,
            ]
        ];
        if($image = upload_image('image', 'u/main_slider/', $resizes, ($action=='edit' && !empty($model->image))?$model->image:false)) $model->image = $image;
        return $model->save();
    }
    public static function deleteItem($model){
        $path = public_path('u/main_slider/');
        if (!empty($model->image)) File::delete($path.$model->image);
        return $model->delete();
    }
}
