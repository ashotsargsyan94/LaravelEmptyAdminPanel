@extends('site.layouts.header')
@section('content')
    <section>
        <div class="container">
            <div class="blog-single-pages">
                <div class="news-tips-articles blog-pages">
                    <h2>{{$item->title}}</h2>

                </div>
                <div class="blog-single__main d_flex">
                    <div class="blog-single__left">
                        <div class="tips-articles__href ">
                            <p><img src="{{asset('f/site/img/clock.png')}}">{{date('d',strtotime($item->date))}} {{t('months.'.date('M',strtotime($item->date)).'')}} {{date('Y',strtotime($item->date))}}</p>
                        </div>
                        <div class="blog-single_img">
                            <img src="{{asset('u/blog/'.$item->image)}}">
                        </div>
                        <p class="blog-single__text">
                            {!! $item->desc !!}
                        </p>
                    </div>
                    <div class="blog-single__dubscribe">
                        <h2>Բաժանորդագրվել և հետևել մեզ</h2>
                        <div class="single-dubscribe__item">
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/" target="_blank">
                                        <img src="assets/img/facebook.png">
                                        <div class="single-dubscribe__name">
                                            <strong>FACEBOOK</strong>
                                        </div>
                                        <div class="single-dubscribe__like">
                                            <span>Like</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/" target="_blank">
                                        <img src="assets/img/twitter.png">
                                        <div class="single-dubscribe__name">
                                            <strong>TWITTER</strong>
                                        </div>
                                        <div class="single-dubscribe__like">
                                            <span>Followers</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/" target="_blank">
                                        <img src="assets/img/youtube.png">
                                        <div class="single-dubscribe__name">
                                            <strong>YOUTUBE</strong>
                                        </div>
                                        <div class="single-dubscribe__like">
                                            <span>Subscribers</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/" target="_blank">
                                        <img src="assets/img/instagram.png">
                                        <div class="single-dubscribe__name">
                                            <strong>INSTAGRAM</strong>
                                        </div>
                                        <div class="single-dubscribe__like">
                                            <span>Followers</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/" target="_blank">
                                        <img src="assets/img/linkedin.png">
                                        <div class="single-dubscribe__name">
                                            <strong>LINKDIN</strong>
                                        </div>
                                        <div class="single-dubscribe__like">
                                            <span>Followers</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="news-tips-articles blog-pages">
                    <h2>{{t('app.Առնչվող նյութեր')}}</h2>
                    <div class="tips-articles__block d_flex f_wrap j_content_center">
                        @if(!empty($alts))
                            @foreach($alts as $alt)
                                <div class="tips-articles__box">
                                    <div class="tips-articles__info">
                                        <div>
                                            <a href="javascript:;" class="tips-articles__img">
                                                <img src="{{asset('u/blog/'.$alt->image)}}">
                                            </a>
                                            <div class="tips-articles__text">
                                                <a href="javascript:;">{{$alt->title}}</a>
                                                <p>
                                                    {!! $alt->short_desc !!}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="">
                                            <div class="tips-articles__href d_flex a_items_center j_content_between">
                                                <p><img style="padding-top: 2px" src="{{asset('f/site/img/clock.png')}}">{{date('d',strtotime($alt->date))}} {{t('months.'.date('M',strtotime($alt->date)).'')}} {{date('Y',strtotime($alt->date))}}</p>
                                                <a href="{{route('page_item',['parent'=>$page->url,'current'=>$alt->url])}}">{{t('app.Դիտել ավելին')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                     </div>
                </div>
            </div>

        </div>
    </section>

    @include('site.layouts.footer')
@endsection
@push('css')
    <style>
        .tips-articles__info {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
@endpush

