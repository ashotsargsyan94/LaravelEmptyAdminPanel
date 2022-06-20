@extends('site.layouts.header')
@section('content')
    <section>
        <div class="container">
            <div class="news-tips-articles blog-pages">
                <h2>{{t('app.Նորություններ, հուշումներ և հոդվածներ')}}</h2>
                <div class="tips-articles__block d_flex f_wrap j_content_center">
                    @if(!empty($items))
                        @foreach($items as $item)
                            <div class="tips-articles__box">
                                <div class="tips-articles__info">
                                    <div>
                                        <a href="{{route('page_item',['parent'=>$page->url,'current'=>$item->url])}}" class="tips-articles__img">
                                            <img src="{{asset('u/blog/'.$item->image)}}">
                                        </a>
                                        <div class="tips-articles__text">
                                            <a href="javascript:;">{{$item->title}}</a>
                                            <p>
                                                {!! $item->short_desc !!}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="tips-articles__href d_flex a_items_center j_content_between">
                                            <p><img style="padding-top: 2px" src="{{asset('f/site/img/clock.png')}}">{{date('d',strtotime($item->date))}} {{t('months.'.date('M',strtotime($item->date)).'')}} {{date('Y',strtotime($item->date))}}</p>
                                            <a href="{{route('page_item',['parent'=>$page->url,'current'=>$item->url])}}">{{t('app.Դիտել ավելին')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
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
