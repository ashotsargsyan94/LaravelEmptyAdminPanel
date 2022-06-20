<?php
use Illuminate\Support\Facades\Route;
use App\Services\LanguageManager\Facades\LanguageManager;

//region Admin
//region Login
Route::group(['prefix' => config('admin.prefix'), 'middleware'=>'notAdmin'], function (){
    Route::get('login', 'Admin\AuthController@login')->name('admin.login');
    Route::post('login', 'Admin\AuthController@attemptLogin');
    Route::get('password/reset', 'Admin\AuthController@reset')->name('admin.password.reset');
    Route::post('password/reset', 'Admin\AuthController@attemptReset');
    Route::get('password/recover/{email}/{token}', 'Admin\AuthController@recover')->where(['email'=>'[^\/]+', 'token'=>'[^\/]+'])->name('admin.password.recover');
    Route::post('password/recover/{email}/{token}', 'Admin\AuthController@attemptRecover')->where(['email'=>'[^\/]+', 'token'=>'[^\/]+']);
});
//endregion
Route::group(['prefix' => config('admin.prefix'), 'middleware' => 'admin'], function () {
    //region CKFinder
    Route::any('file_browser/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')->name('ckfinder_connector');
    Route::any('file_browser/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')->name('ckfinder_browser');
    //endregion
    Route::name('admin.')->namespace('Admin')->group(function(){
        //region Logout
        Route::post('logout', 'AuthController@logout')->name('logout');
        //endregion
        //region Home Page Redirect
        Route::get('/', 'AuthController@redirectIfAuthenticated');
        //endregion
        //region Dashboard
        Route::get('dashboard', 'DashboardController@main')->name('dashboard');
        //endregion
        //region Languages
        Route::prefix('languages')->name('languages.')->group(function() { $c='LanguagesController@';
            Route::get('', $c.'main')->name('main');
            Route::patch('', $c.'editLanguage');
        });
        //endregion
        //region Pages
        Route::prefix('pages')->name('pages.')->group(function() { $c='PagesController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'addPage')->name('add');
            Route::put('add', $c.'addPage_put');
            Route::get('edit/{id}', $c.'editPage')->name('edit');
            Route::patch('edit/{id}', $c.'editPage_patch');
            Route::delete('delete', $c.'deletePage_delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion
        //region Banners
        Route::match(['get', 'post'], 'banners/{page}', 'BannersController@renderPage')->name('banners');
        Route::prefix('gallery')->group(function(){ $c='GalleriesController@';
            Route::get('{gallery}/{id?}{key?}', $c.'show')->name('gallery');
            Route::put('add', $c.'add')->name('gallery.add');
            Route::patch('edit', $c.'edit')->middleware('ajax')->name('gallery.edit');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('gallery.sort');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('gallery.delete');
            Route::post('poster', $c.'poster')->middleware('ajax')->name('gallery.poster');
        });
        //endregion
        //region Users
        Route::prefix('users')->name('users.')->group(function(){ $c='UsersController@';
            Route::get('', $c.'main')->name('main');
            Route::get('{id}', $c.'view')->name('view');
            Route::patch('toggle-active', $c.'toggleActive')->name('toggleActive');
        });
        //endregion
        //region Video Galleries
        Route::prefix('video-gallery')->group(function(){ $c='VideoGalleriesController@';
            Route::get('{gallery}/{id?}', $c.'show')->name('video_gallery');
            Route::get('{gallery}/add/{id?}', $c.'add')->name('video_gallery.add');
            Route::put('{gallery}/add/{id?}', $c.'add_put');
            Route::get('{id}/edit', $c.'edit')->name('video_gallery.edit');
            Route::patch('{id}/edit', $c.'edit_patch');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('video_gallery.sort');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('video_gallery.delete');
        });
        //endregion
        //region Profile
        Route::prefix('profile')->name('profile.')->group(function() { $c = 'ProfileController@';
            Route::get('', $c.'main')->name('main');
            Route::patch('', $c.'patch');
        });
        //endregion
        //region Translations
        Route::prefix('translations')->name('translations.')->group(function() { $c = 'TranslationsController@';
            Route::get('{locale}', $c.'main')->name('main');
            Route::get('{locale}/{filename}', $c.'edit')->name('edit');
            Route::patch('{locale}/{filename}', $c.'edit_patch')->name('edit');
        });
        //endregion
        //Home Page Sliders
        Route::prefix('main-slider')->name('main_slider.')->group(function() { $c='MainSliderController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //end sliders

        //Region services
        Route::prefix('services')->name('services.')->group(function() { $c='ServicesController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion
        //Region blog
        Route::prefix('blog')->name('blog.')->group(function() { $c='BlogController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion
        //regionGetRegions
        Route::get('getRegions','LocationsController@getLocations')->name('getRegions');
        //endregion
    });
});
//endregion
//region EstateSearch

//
//region Site
Route::group(['prefix'=>LanguageManager::getPrefix(), 'middleware'=>'languageManager'], function () {
    Route::post('login', 'Site\CustomerLoginController@login')->name('login');
    Route::get('logout', 'Site\CustomerLoginController@logout')->name('logout');
    Route::get('cabinet', 'Site\OtherPagesController@cabinet')->name('cabinet');
    Route::get('{url?}', 'Site\AppController@pageManager')->name('page');
    Route::get('{parent?}/{current}', 'Site\AppController@page_item')->name('page_item');
    Route::post('send-mail', 'Site\AppController@sendMail')->name('contacts.send_mail');
});
////endregion
