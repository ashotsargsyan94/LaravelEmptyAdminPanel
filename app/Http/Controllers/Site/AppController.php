<?php

namespace App\Http\Controllers\Site;

use App\Mail\Contact;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Estate;
use App\Models\Filter;
use App\Models\Gallery;
use App\Models\Location;
use App\Models\MainSlide;
use App\Models\Page;
use App\Models\Service;
use App\Models\Type;
use App\Models\VideoGallery;
use App\Services\PageManager\StaticPages;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AppController extends BaseController
{
    use StaticPages;

    protected function static_home($page) {

        $data = [];
        $data['current_page'] = $page['id'];
        $data['seo'] = $this->renderSEO($page);
        $data['slides'] = MainSlide::getSlides();
        return view('site.pages.home', $data);
    }

    protected function static_about($page) {
        $data = [];
        $data['current_page'] = $page['id'];
        $data['banners'] = Banner::get('about');
        $data['gallery'] = Gallery::get('about');
        $data['video_gallery'] = VideoGallery::get('about');
        $data['seo'] = $this->renderSEO($page);
        return view('site.pages.about_company', $data);
    }

    protected function static_contact($page) {
        $data = [];
        $data['current_page'] = $page['id'];
        $data['banners'] = Banner::get('contact');
        $data['seo'] = $this->renderSEO($page);
        return view('site.pages.contact', $data);
    }
    protected function static_blog($page) {
        $data = [];
        $data['current_page'] = $page['id'];
        $data['page'] = $page;
        $data['items'] = Blog::getBlog();
//        dd($data);
        $data['seo'] = $this->renderSEO($page);
        return view('site.pages.blog', $data);
    }


    protected function static_services($page){
        $data['items'] = Service::getItems();
        $data['content'] = Banner::get('services');
        $data['current_page'] = $page['id'];
        return view('site.pages.services', $data);
    }
    public function page_item($parent=null,$current=null)
    {
        if ($parent != null && $parent != 'estates'){
            $parent_page = Page::getItemSite($parent);
        }
        if (isset($parent_page) && $parent_page != null && $parent_page->static == 'blog'){
            $data['item'] = Blog::getItemSite($current);
            $data['page'] = $parent_page;
            $data['alts'] = Blog::getBlog()->take(9);
            $data['current_page'] = $data['item']['id'];
            $view = 'blog_item';
        }
        elseif ($parent == 'estates' && $current != null){
            $data['item'] = Estate::getItemSite($current);
            $type = Type::getItem( $data['item']->type_id);
            $category = Category::getItem($data['item']->category_id);
            $data['part'] = $type->title.'. '.$category->title;
            $data['alts'] = Estate::getEstates($category->id,$type->id);
            $data['galleries'] = Gallery::get('estates', $data['item']['id']);
            $data['favorites'] = isset($_COOKIE['favorite'])?explode(',',$_COOKIE['favorite']):[];
            $view = 'estate_item';
        }
        else{
            abort(404);
        }

        return view("site.pages.$view", $data);
    }
    protected function dynamic_page($page){
        $data = [];
        $data['current_page'] = $page['id'];
        $data['page'] = $page;
        $data['gallery'] = Gallery::get('pages', $page->id);
        $data['video_gallery'] = VideoGallery::get('pages', $page->id);
        $data['seo'] = $this->renderSEO($page);
        return view('site.pages.dynamic_page', $data);
    }

    /**
     * @throws TokenMismatchException
     */
    public function sendMail(Request $request){
        $redirect = redirect(page('contact').'#contact-form');
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|mail|max:255',
            'phone' => 'required|string|phone|max:255',
            'message' => 'required|string|max:1000'
        ], [
            'required' => t('auth.required'),
            'string' => t('auth.required'),
            'max' => t('auth.max'),
            'mail' => t('auth.invalid email'),
            'phone' => t('auth.invalid phone'),
        ]);
        if ($validator->fails()) {
            return $redirect->withErrors($validator)->withInput();
        }

        $email  = $this->shared['info']->contact_email->email;
//        dd($email);
        if (!$email || !is_email($email)) return $redirect->withErrors(['global' => __('app.internal error')])->withInput();
        try {
            Mail::to($email)->send(new Contact($request->only('email', 'phone', 'message')));
        }
        catch (\Exception $exception) {
            return $redirect->withErrors(['global'=>__('app.internal error')])->withInput();
        }
        return $redirect->with(['message_sent'=>true]);
    }

}

