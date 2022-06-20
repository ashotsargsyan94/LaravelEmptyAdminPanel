<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Language extends Model
{
    public $timestamps = false;
    public static function clearCaches(){
        Cache::forget(self::cacheKeyIsos());
        Cache::forget(self::cacheKeyLanguages());
    }
    private static function cacheKeyIsos(){
        return 'language_isos';
    }
    private static function cacheKeyLanguages(){
        return 'all_languages';
    }
    public static function getAll() {
        return self::sort()->get();
    }
    public static function isValid($iso){
        return (self::where('iso', $iso)->count()!=0);
    }
    public static function getIsos(){
        return self::select('id', 'iso')->where('active', 1)->get()->mapWithKeys(function($item){
            return [$item->id=>$item->iso];
        })->toArray();
    }
    public static function getLanguages(){
        return self::where('active', 1)->sort()->get();
    }
    public function scopeSort($query) {
        return $query->orderBy('id', 'asc');
    }
}
