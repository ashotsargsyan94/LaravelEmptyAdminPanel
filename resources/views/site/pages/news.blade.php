@extends('site.layouts.header')
@section('content')
    <div class="main">
        <section
                style="position:relative;background-image:linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),url({{asset('/u/banners/'.$news_banner->header->image)}}) "
                class="about_header header_background_dotted">
            <div class="header_txt ">
                <div class="container text-md-left">
                    <p>{{$news_banner->header->title}}</p>
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
        <section class="container" style="margin: 60px auto;!important;">

            <div class="row">
                @foreach($news as $new)
                    <div class="col-md-4" style="box-sizing: border-box;height: 100%">
                        <a style="text-decoration: none" href="{{route('news_item',['id'=>$new->id])}}">
                            <img height="100%" width="100%" style="position: relative"
                                 src="{{asset('u/news/'.$new->image)}}" alt="">
                            <div class="" style="">
                                <p style="text-align: start;color: #5B5B5B;font-family: Roboto,sans-serif; font-size: 13px;margin: 0" class="">{{$new->updated_at->format('d').' '. t('Month.'.$new->updated_at->format('m')).'-'. $new->updated_at->format('y')}}</p>
                                <p class="head_text" style="text-align: start;color: #162B32;font-family: Roboto,sans-serif; font-size: 24px;margin: 0">{{$new->title}}</p>
                                <div class="home_text short_desc" style="text-align: start;color: #5B5B5B;font-family: Roboto,sans-serif; font-size: 16px">{!! $new->short !!}</div>
                            </div>
                        </a>
                    </div>
                    <style>
                        .short_desc * {
                            color:#5B5B5B!important;
                        }
                    </style>
                @endforeach
            </div>
        </section>
    </div>

@endsection
