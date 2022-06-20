@extends('site.layouts.header')
@section('content')
    <div class="main">
{{--        {{dd($about->content->image)}}--}}

    <section style="position:relative;background-image:linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),url({{asset('/u/banners/'.$banners->header->image)}}) " class="header_background_dotted about_header">
        <div class="header_txt ">
            <div class="container text-md-left">
            <p>{{$banners->header->title}}</p>
            </div>
        </div>
    </section>
    <style>
        .main{
            background-color: white!important;
        }
        footer{
            margin-top: 0!important;
        }
    </style>
        <section class="container">
            <div class="row main_row" style="margin: 70px 0">
                <div class="col-sm12 col-lg-6 d-flex justify-content-center align-items-center pr-lg-5"
                     style="padding: 0">
                    <img src="{{ $banners->content->image() }}" height="90%" width="100%" alt="">
                </div>
                <div class="about_text col-sm12 col-lg-6 d-flex flex-column justify-content-center ">
                    <p class="text-center text-md-left about_title head_text" style="line-height: unset">
                        {{ $banners->content->title }}
                    </p>
                    <p class="text-sm-center text-md-left home_text"
                       style="line-height:33px;font-family: Roboto,sans-serif;font-weight: 300; color: #8E8E8E; font-size: 15px;">{!! $banners->content->desc !!}
                    </p>
                    <div class="container">
                        <div class="row">
                            <div class="col-3 d-flex justify-content-center align-items-start">
                                <div class="about_counter">
                                    <div>
                                        <p class="head_text"> {{ $banners->content->counter1 }}</p>
                                        <span class="home_text">{{ $banners->content->counter1_text }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-center">
                                <div class="about_counter div_with_rotated_lines">
                                    <div class="line_rotated"></div>
                                    <div>
                                        <p class="head_text">{{ $banners->content->counter2 }}</p>
                                        <span class="home_text">{{ $banners->content->counter2_text }}</span>
                                    </div>
                                    <div class="line_rotated"></div>
                                </div>
                            </div>
                            <div class="col-3 d-flex justify-content-center align-items-start">
                                <div class="about_counter">
                                    <div>
                                        <p class="head_text">{{ $banners->content->counter3 }}</p>
                                        <span class="home_text">{{ $banners->content->counter3_text }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section style="padding-bottom: 30px" class="container-fluid">
            <div class="swiper-container swiper-container-about">
                <div class="swiper-wrapper">
                @foreach($gallery as $images)
                        <div class="swiper-slide">
                            <a href="{{asset("u/gallery/$images->image")}}" data-fancybox="gallery">
                                <img height="100%" width="100%" src = "{{asset("u/gallery/thumbs/$images->image")}}" alt = "" />
                            </a>
                        </div>
                @endforeach
                </div>
            </div>
        </section>
        <section class="container-fluid d-flex justify-content-center align-items-center" style="background-repeat:no-repeat;background-attachment:fixed;background-size:cover;background-image:linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),url({{asset('/u/banners/'.$banners->content->after_image)}})">
            <div style="min-height: 280px;color: white;font-size: 24px;font-family: Roboto Condensed, sans-serif" class="col-12 text-center home_text d-flex justify-content-center align-items-center">
                {!! $banners->content->after_slider !!}
            </div>
        </section>
    </div>
    <style>
        html, body {
            position: relative;
            height: 100%;
        }
        body {
            background: #eee;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color:#000;
            margin: 0;
            padding: 0;
        }
        .swiper-container-about {
            width: 100%;
            height: 100%;
        }
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
    </style>

    @include('site.layouts.footer')

@endsection
@push('js')

    {{--    @include('ckfinder::setup')--}}
@endpush