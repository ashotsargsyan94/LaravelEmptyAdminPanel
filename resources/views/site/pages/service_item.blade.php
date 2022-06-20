@extends('site.layouts.header')
@section('content')
    <div class="main">
        <section
                style="position:relative;background-image:linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),url({{asset('u/services/'.$service_item->image)}}) "
                class="about_header header_background_dotted">
            <div class="header_txt ">
                <div class="container text-md-left">
                    <p>{{$service_item->name}}</p>
                </div>
            </div>
        </section>
        <style>
            .main {
                background-color: white !important;
            }

            footer {
                margin-top: 0 !important;
            }
        </style>
        <section class="container mt-5">
            <div class="row">
                <div class="col-md-8 d-flex flex-column align-items-center">
                    <div style="width: 100%;position: relative">
                        <img height="100%" width="100%" src="{{asset('u/services/'.$service_item->image)}}" alt="">
                        <div class="service_item_icon"
                             style="background-image: url({{asset('/u/services/'.$service_item->icon) }});">
                        </div>
                    </div>
                    <div class="w-100" style="padding: 25px 0">
                        <p style="text-align: start"
                           class="text-left w-100 m-0 head_text service_item_name">{{$service_item->name}}</p>
                    </div>
                    <div class="descr" style="">
                        {!! $service_item->desc !!}
                    </div>

                    {{--                    <div class="row" >--}}
                    {{--                        @foreach($galleries as $images)--}}
                    {{--                            <div class="col-6 col-md-4 mb-3">--}}
                    {{--                                <a href="{{asset("u/gallery/$images->image")}}" data-fancybox="gallery">--}}
                    {{--                                    <img height="100%" width="100%" src = "{{asset("u/gallery/thumbs/$images->image")}}" alt = "" />--}}
                    {{--                                </a>--}}
                    {{--                            </div>--}}
                    {{--                        @endforeach--}}
                    {{--                    </div>--}}
                </div>

                <div class="col-md-4">
                    <div class="row" style="">
                        @foreach($others as $other)
                            <a class=" mb-3  ml-md-5" style="text-decoration: none"
                               href="{{route('service_item',['id'=>$other->id])}}">
                                <div class="col-sm-12">
                                    <div style="box-shadow: 0 0 6px -3px;">
                                        <div>
                                            <img height="100%" width="100%"
                                                 src="{{asset('u/services/'.$other->image)}}" alt="">
                                        </div>

                                        <div class="p-3 position-relative">
                                            <div class="service_icon"
                                                               style="background-image: url({{asset('/u/services/'.$other->icon) }});">
                                            </div>
                                            <p class="head_text"
                                               style="text-align: start;color: #162B32;font-family: Roboto,sans-serif; font-size: 15px;margin: 0">{{$other->name}}</p>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@include('site.layouts.footer')
@endsection






{{--@extends('site.layouts.header')--}}
{{--@section('content')--}}
{{--    <div class="main">--}}
{{--        <section style="position:relative;background-image:linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),url({{asset('u/services/'.$service_item->image)}}) " class="about_header header_background_dotted">--}}
{{--            <div class="header_txt ">--}}
{{--                <div class="container text-md-left">--}}
{{--                    <p>{{$service_item->name}}</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--        <style>--}}
{{--            .main{--}}
{{--                background-color: white!important;--}}
{{--            }--}}
{{--            footer{--}}
{{--                margin-top: 0!important;--}}
{{--            }--}}
{{--        </style>--}}
{{--        <section class="container">--}}
{{--            <div class="row" >--}}
{{--                <div style="padding: 70px 15px 35px" class="col-12 about_project_text2 about_project_text">--}}
{{--                    <h1 class="text-left" >--}}
{{--                        {{$service_item->name}}--}}
{{--                    </h1>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row" style="padding: 0!important;">--}}
{{--                <div style="min-height: 400px" class="col-12 col-md-6">--}}
{{--                    {{dd($service_item)}}--}}
{{--                    <img height="100%" width="100%" src="{{asset('u/services/'.$service_item->image)}}" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div style="padding: 40px 15px!important;"  class="row">--}}
{{--                <div style="padding: 0"  class="col-12 about_project_text" id="desc">--}}
{{--                    <p style="padding-top: 0" class="text-left">--}}
{{--                        {{$service_item->desc}}--}}

{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--        <!-- Left & custom positioning -->--}}

{{--        <section style="padding-bottom: 30px" class="container-fluid">--}}
{{--            <div class="row">--}}
{{--                <section style="padding-bottom: 30px" class="container-fluid">--}}
{{--                    <div class="swiper-container swiper-container-service">--}}
{{--                        <div class="swiper-wrapper">--}}
{{--                            @foreach($galleries as $images)--}}
{{--                                <div class="swiper-slide">--}}
{{--                                    <a href="{{asset("u/gallery/$images->image")}}" data-fancybox="gallery">--}}
{{--                                        <img height="100%" width="100%" src = "{{asset("u/gallery/thumbs/$images->image")}}" alt = "" />--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </section>--}}
{{--                @foreach($galleries as $images)--}}
{{--                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">--}}
{{--                        <a href="{{asset("u/gallery/$images->image")}}" data-fancybox="gallery">--}}
{{--                            <img height="100%" width="100%" src = "{{asset("u/gallery/thumbs/$images->image")}}" alt = "" />--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    </div>--}}
{{--    </div>--}}

{{--@endsection--}}
