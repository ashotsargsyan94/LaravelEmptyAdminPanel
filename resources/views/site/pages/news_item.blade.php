@extends('site.layouts.header')
@section('content')
    <div class="main">
        <section style="position:relative;background-image:linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),url({{asset('u/news/'.$news_item->image)}}) " class="about_header header_background_dotted">
            <div class="header_txt ">
                <div class="container text-md-left">
                    <p>{{$news_item->title}}</p>
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
        <section class="container mt-5">
            <div class="row">
                <div class="col-md-8 d-flex flex-column align-items-center">
                    <div style="width: 100%">
                        <img height="100%" width="100%" src="{{asset('u/news/'.$news_item->image)}}" alt="">
                    </div>
                    <div style="margin-top: -2%;background-color: white;position: relative;width: 90%;box-shadow: 0 0 6px -3px;padding: 20px;margin-bottom: 40px">
                        <p style="position:absolute;padding: 5px;background: #162B32;display: inline-block;margin-top: -35px;color: white;font-family: Roboto, sans-serif;font-size: 13px">{{$news_item->updated_at->format('d').' '. t('Month.'.$news_item->updated_at->format('m')).'-'. $news_item->updated_at->format('y')}}</p>
                        <p style="text-align: center" class="text_center w-100 m-0">{{$news_item->title}}</p>
                    </div>
                    <div class="descr" style="font-family: Roboto, sans-serif;font-size: 13px;color: #5B5B5B; margin-bottom: 40px" >
                        {!! $news_item->description !!}
                    </div>

                    <div class="row" >
                        @foreach($galleries as $images)
                            <div class="col-6 col-md-4 mb-3">
                                <a href="{{asset("u/gallery/$images->image")}}" data-fancybox="gallery">
                                    <img height="100%" width="100%" src = "{{asset("u/gallery/thumbs/$images->image")}}" alt = "" />
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row" style="box-shadow: 0 0 6px -3px;padding: 15px">
                        @foreach($others as $other)
                            <a class="row mb-3" style="text-decoration: none" href="{{route('news_item',['id'=>$other->id])}}">
                                <div class="col-5"> <img height="100%" width="100%" style="position: relative"
                                                         src="{{asset('u/news/'.$other->image)}}" alt=""></div>
                                <div class="col-7 d-flex flex-column justify-content-center">
                                    <div  class="d-flex flex-column justify-content-center"  style="height: 100%;border-bottom: 1px solid #70707061">
                                        <div style="max-height: 130px;overflow: hidden">
                                            <p style="text-align: start;color: #5B5B5B;font-family: Roboto,sans-serif; font-size: 13px;margin: 0" class="">{{$other->updated_at->format('d').' '. t('Month.'.$other->updated_at->format('m')).'-'. $other->updated_at->format('y')}}</p>
                                            <p class="head_text" style="text-align: start;color: #162B32;font-family: Roboto,sans-serif; font-size: 15px;margin: 0">{{$other->title}}</p>
                                            {{--                                        <div class="home_text" style="text-align: start;color: #5B5B5B;font-family: Roboto,sans-serif; font-size: 16px">{!! $other->short !!}</div>--}}
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

@endsection
