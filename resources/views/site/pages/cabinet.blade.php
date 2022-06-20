@extends('site.layouts.header')
@section('content')
    <div class="main">
        <!-- Left & custom positioning -->
        <style>
            .ssk-sticky .ssk-left {
                top: 20%;
            }

            .ssk-sticky {
                z-index: -1 !important;
            }
        </style>
        <div class="ssk-sticky ssk-left ssk-lg">...</div>

{{--        <div class="home_slider_content">--}}
{{--            <div class="swiper-container b1 swiper-container-fade swiper-container-initialized swiper-container-vertical">--}}
{{--                <div class="swiper-wrapper" style="transition-duration: 0ms;">--}}
{{--                    @foreach($header_sliders as $header_slider)--}}
{{--                        <div class="swiper-slide swiper-slide-active header_background_dotted"--}}
{{--                             style="background-image: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)), url({{ asset("u/main_slider/$header_slider->image") }});; background-size: cover; background-position: center center; background-repeat: no-repeat; height: 576px; opacity: 1; transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">--}}
{{--                            <div class="container">--}}
{{--                                <div class="home_slider_text_div">--}}
{{--                                    <div class="home_slider_text_div_for_left">--}}
{{--                                        <h2 class="home_slider_text_div_h2 text-sm-center text-md-left"--}}
{{--                                            style="letter-spacing: 3px;">{{$header_slider->line_1}}</h2>--}}
{{--                                        <h1 class="home_slider_text_div_h1 text-sm-center  text-md-left"--}}
{{--                                            style="letter-spacing: 3px;">{{$header_slider->line_2}}</h1>--}}
{{--                                        <p class="home_slider_text_div_p text-sm-center  text-md-left"--}}
{{--                                           style="letter-spacing: 2px;">{{$header_slider->line_3}}</p>--}}
{{--                                        <div class="d-flex justify-content-md-start justify-content-center">--}}
{{--                                            <a href="{{$header_slider->button_url}}">--}}
{{--                                                <button class="head_button">{{$header_slider->button_text}}<img--}}
{{--                                                            src="{{ asset('f/arch/images/arrow.png') }}" alt="">--}}
{{--                                                </button>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <!-- Add Pagination -->--}}

{{--                <div class="swiper-pagination">--}}
{{--                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--        <section class="container">--}}
{{--            <div class="row" style="margin: 10% 0">--}}
{{--                <div class="col-sm12 col-md-5 d-flex justify-content-center align-items-center" style="padding: 0">--}}
{{--                    <img src="{{ $banners->main_banner->image() }}" height="90%" width="100%" alt="">--}}
{{--                </div>--}}
{{--                <div class="about_text col-sm12 col-md-7 d-flex flex-column justify-content-center align-items-md-start align-items-sm-center"--}}
{{--                     style="padding-left: 80px">--}}
{{--                    <p style="font-family: Roboto Condensed, sans-serif;font-size: 49px;font-weight:700;color: #162B32;padding-right: 10px">--}}
{{--                        {{ $banners->main_banner->title }}--}}
{{--                    </p>--}}
{{--                    <p class="text-sm-center text-md-left"--}}
{{--                       style="line-height:33px;font-family: Roboto,sans-serif;font-weight: 300; color: #8E8E8E; font-size: 15px;">{{ $banners->main_banner->desc }}</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
        <section style="padding-top: 100px" class="container-fluid video_player">
            <div class="row">
                <h1>
                    {{t('video_player')}}

                </h1>
            </div>
            <div class="row player">
                <div class="container">
                    @if(\Illuminate\Support\Facades\Auth::guard('customer')->check())
                        {!!  \Illuminate\Support\Facades\Auth::guard('customer')->user()->source !!}
                    @else
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/FlSKK0_PRHI"
                                frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
                    @endif
                </div>
            </div>
            <div class="row status mt-l">
                <div class="container">
                    <div class="row live">
                        <img src="{{ asset('f/arch/images/live.png') }}" style="height: 53px;" alt="">
                    </div>
                </div>
            </div>
        </section>
        {{--    {{dd($banners)}}--}}
    </div>

@endsection