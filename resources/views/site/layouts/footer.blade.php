{{--<footer style="background: #FAFAFA;width: 100%;margin-top: 30px">--}}
{{--    <section style="background: #FAFAFA" class="container">--}}
{{--        <div class="row d-flex align-content-center" style="min-height: 225px">--}}
{{--            <div class="col-12 col-md-4 align-items-start text-center">--}}
{{--                --}}{{--                {{dd($info)}}--}}
{{--                @foreach($info->contacts as $address)--}}
{{--                    <address class="text-md-left text-center footer_text"--}}
{{--                             style="width: 100%">{{$address->address}}</address>--}}
{{--                @endforeach--}}
{{--                <div id="footer_icons_block" class="d-flex align-items-start justify-content-center justify-content-md-start">--}}
{{--                    @foreach($socials as $social)--}}
{{--                        <a target="_blank" href="{{$social->url}}">--}}
{{--                            <button style="background-color: black;" class="nav_top_icons " id="footer_icons"><img--}}
{{--                                        class="footer_icons" height="100%" width="100%"--}}
{{--                                        src="{{asset('u/banners/'.$social->icon)}}"></button>--}}
{{--                        </a>--}}
{{--                    @endforeach--}}
{{--                </div>--}}

{{--            </div>--}}
{{--            <div class="col-12 col-md-4 text-center">--}}
{{--                @foreach($info->contacts as $phone)--}}
{{--                    @if($phone->phone!='')--}}
{{--                        <div><a style="color: #0c0c0c" href="tel:{{$phone->phone}}"><p style="display: inline-block"--}}
{{--                                                                                       class="footer_text"><span>@lang('app.phone number'):{{$phone->phone}}</span>--}}
{{--                                </p>  <i class="fa fa-phone-square"></i></a></div>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--            <div class="col-12 col-md-4 text-md-right text-center">--}}
{{--                @foreach($info->contacts as $email)--}}
{{--                    @if($email->email!='')--}}
{{--                        <div><a style="color: #0c0c0c" href="mailto:{{$email->email}}"><p style="display: inline-block"--}}
{{--                                                                                          class="footer_text">--}}
{{--                                    <span>{{$email->email}}</span></p>  <i class="fa fa-envelope"></i></a></div>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div style="border-top: 1px solid #00000036;padding-top: 10px" class="row d-flex justify-content-between">--}}
{{--            <div class="col-sm-12 col-md-5 text-md-left">--}}
{{--                <p class="footer_text">©{{$year}} Atlantshin @lang('app.All rights reserved')</p>--}}

{{--            </div>--}}
{{--            <div class="col-sm-12 col-md-5 d-flex justify-content-md-end">--}}
{{--                <div class="footer_text d-flex justify-content-center  justify-content-md-end"--}}
{{--                     style="display: flex;width: 100%">--}}
{{--                    <div class="d-flex ">--}}
{{--                        <a class="text-md-right text-center" target="_blank" style="color: unset;width: 100%"--}}
{{--                           href="https://astudio.am/">--}}
{{--                            <span class="studio"> @lang('app.design and development')&nbsp;</span>--}}
{{--                        </a>--}}
{{--                        <p>ASTUDIO</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </section>--}}
{{--</footer>--}}
<footer>
    <div class="container">
        <div class="footer-min">
            <div class="footer-block d_flex a_items_start j_content_between">
                <div class="footer-street">
                    <strong class="footer-title">{{t('app.Հասցե')}}</strong>
                    <ul>
                        <li>
                            <img src="{{asset('f/site/img/Group10.png')}}">
                            @foreach($info->contacts as $address)
                                @if($address->address!='')
                                    <a href="javascript:void(0)">{{$address->address}}</a>
                                @endif
                            @endforeach
                        </li>
                        <li>
                            <img src="{{asset('f/site/img/Group11.png')}}">
                            @foreach($info->contacts as $phone)
                                @if($phone->phone!='')
                                   <a href="tel:{{$phone->phone}}">{{$phone->phone}} <br></a>
                                @endif
                            @endforeach
                        </li>
                        <li>
                            <img src="{{asset('f/site/img/Group12.png')}}">
                            @foreach($info->contacts as $email)
                                @if($email->email!='')
                                    <a href="mailto:{{$email->email}}">{{$email->email}} <br></a>
                                @endif
                            @endforeach
                        </li>
                    </ul>
                </div>
                <div class="footer-href">
                    <strong class="footer-title">{{t('app.Տեղեկատվություն')}}</strong>
                    <ul>
                        @if(!empty($menu_pages))
                            @foreach($menu_pages as $page)
                                <li>
                                    <a class="{{ (isset($current_page)  && ($current_page == $page->id))?'actived':null }}"
                                       href="{{ route('page', ['url'=>$page->url]) }}">{{ $page->title }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="footer-href">
                    <strong class="footer-title">{{t('app.Օգտակար հղումներ')}}</strong>
                    <div class="footer-href__last d_flex">
                        <ul>
                            @if(!empty($footer_links))
                                @foreach($footer_links as $link)
                                    @if($loop->index <= 4)
                                    <li>
                                        <a href="{{ $link->url }}" target="_blank">{{ $link->title }}</a>
                                    </li>
                                    @else
                                        <?php break ?>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                        <ul>
                            @if(!empty($footer_links))
                                @foreach($footer_links as $link)
                                    @if($loop->index > 4)
                                        <li>
                                            <a href="{{ $link->url }}" target="_blank">{{ $link->title }}</a>
                                        </li>
                                    @else
                                        <?php continue ?>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="footer-form">
                    <strong class="footer-title">{{t('app.Բաժանորդագրվեք մեզ')}}</strong>
                    <div class="footer-form__info">
                        <form>
                            <div class="footer-form__inp d_flex a_items_center">
                                <label>
                                    <input type="text" placeholder="{{t('app.Մուտքագրեք էլ. հասցե')}}">
                                </label>
                                <div class="footer-form-btn">
                                    <button>
                                        <img src="{{asset('f/site/img/paper-plane.png')}}">
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="footer-icon">
                        <ul>
                            @foreach($socials as $social)
                                <li><a target="_blank" href="{{$social->url}}">
                                        <img src="{{$social->icon()}}">
                                    </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-last-block d_flex j_content_between a_items_center">
                <div class="footer-last-text d_flex a_items_center">
                    <div class="footer-logo">
                        <a href="index.html">
                            <img src="{{$info->data->menu_logo()}}">
                        </a>
                    </div>
                    <p>©{{date('Y')}} Anita @lang('app.All rights reserved')</p>
                </div>
                <div class="footer-name d_flex a_items_center">
                    <a href="https://astudio.am/"> @lang('app.design and development')</a>
                    <p>ASTUDIO</p>
                </div>
            </div>
        </div>
    </div>
</footer>
