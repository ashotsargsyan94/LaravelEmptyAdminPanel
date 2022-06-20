@extends('site.layouts.header')
@section('content')
    <section class="real-estate-sale__fon" style="background-image: url({{$home->search->image()}})">
        <div class="container">
            <div class="real-estate-sale__min">
                <div class="real-estate-sale__title">
                    <h1>{{ $home->search->title }}</h1>
                </div>
                <div class="real-estate-sale__block">
                    <form method="get" action="{{ route('estateSearch') }}">
                        <div class="real-sale__form d_flex j_content_between a_items_center">
                            <div class="real-sale__sel">
                                @if(!empty($categories) && count($categories))
                                    <select name="categories">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">- {{ $category->title }} -</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            @if(!empty($types) && count($types))
                                @foreach($types as $type)
                                    <div class="real-sale__btn btn">
                                        <button type="submit" name="types"
                                                value="{{ $type->id }}">{{ $type->title }}</button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @if($home->adv_title->title != '')
        <section>
            <div class="container">
                <div class="call-us-free">
                    <h2>{{ $home->adv_title->title }}</h2>
                    @if(count($home->adv))
                        <div class="call-us-free__href">
                            <ul>
                                @foreach($home->adv as $phone)
                                    <li>{{$phone->title}} <a href="tel: {{$phone->phone}}"> {{$phone->phone}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif
    <section>
        <div class="container bbest">
            <h2>{{ $home->suggestions->title??null }}</h2>
            @foreach($types as $k=>$tp)
                <div class="best-offers">
                    <div class="best-offers__title">
                        <p>{{ t("app.block_1_$k") }}</p>
                    </div>
                    <div class="best-offers-slider">
                        @foreach($block_1 as $item)

                            @if($item->type_id == $tp->id)

                                <div class="best-offers-slider-box">
                                    <div class="best-offers__block">
                                        <a href="{{route('page_item',['parent'=>'estates','current'=>$item->url])}}"
                                           class="best-offers__img">
                                            <img src="{{asset("u/estates/$item->image")}}" alt="png">
                                            @if($item->urgent)
                                                <span class="urgently">{{ t('app.Շտապ') }}</span>
                                            @endif
                                        </a>
                                        <div class="best-offers__box">
                                            <a href="{{route('page_item',['parent'=>'estates','current'=>$item->url])}}">{{$item->title}}</a>
                                            <p> {{ \App\Models\Location::getLocationTitle($item->locations->locations_id) }}</p>
                                            <strong>{{$item->price??null}}</strong>
                                            <div class="best-offers__info d_flex a_items_end j_content_between">
                                                <ul>
                                                    @if(!empty($item->estate_filter) && count($item->estate_filter))
                                                        @foreach($item->estate_filter as $filter)
                                                            @if($filter->filter->to_card)
                                                                @if($filter->filter->have_interval)
                                                                    <li>{{$filter->filter->title}}:</li>
                                                                    <li><strong>{{$filter->value}}</strong>
                                                                    </li>
                                                                @else
                                                                    <li>{{$filter->filter->title}}:</li>
                                                                    @if(!empty($filter->filter->option) && count($filter->filter->option))
                                                                        @foreach($filter->filter->option as $option)
                                                                            @if($filter->option_id == $option->id)
                                                                                <li>
                                                                                    <strong>{{(json_decode($option->options)->{app()->getLocale()})??null}}</strong>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    <li> {{ t('app.Կոդ:') }} </li>
                                                    <li><strong>{{$item->code??null}}</strong></li>
                                                </ul>
                                                <div data-id="{{$item->id}}"
                                                     class="best-offers__heart {{ (in_array($item->id,$favorites))?'active-heart':'' }}">
                                                    <a href="javascript:;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24.716"
                                                             height="21.99"
                                                             viewBox="0 0 24.716 21.99">
                                                            <path id="heart"
                                                                  d="M22.756,2.152A6.646,6.646,0,0,0,17.812,0a6.218,6.218,0,0,0-3.884,1.341,7.945,7.945,0,0,0-1.57,1.639,7.941,7.941,0,0,0-1.57-1.639A6.217,6.217,0,0,0,6.9,0,6.647,6.647,0,0,0,1.961,2.152,7.726,7.726,0,0,0,0,7.428,9.2,9.2,0,0,0,2.452,13.45a52.273,52.273,0,0,0,6.136,5.76c.85.725,1.814,1.546,2.815,2.421a1.451,1.451,0,0,0,1.911,0c1-.875,1.965-1.7,2.816-2.422a52.244,52.244,0,0,0,6.136-5.759,9.2,9.2,0,0,0,2.451-6.022,7.725,7.725,0,0,0-1.961-5.276Zm0,0"
                                                                  transform="translate(0)" fill="#d9e2e9"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach</div>
                </div>
            @endforeach
        </div>
    </section>
    @if(!empty($slides))
        <section>
            @foreach($slides as $slide)
                <div class="estate-passport-slid">
                    <div class="estate-passport-slid-box">
                        <div class="estate-passport-fon"
                             style="background-image: url({{ 'u/main_slider/'.$slide->image }})">
                            <div class="container">
                                <div class="estate-passport-block">
                                    <div class="estate-passport-title">
                                        <h2>{!! $slide->title !!}</h2>
                                        <p>{!! $slide->line_1 !!}<br>
                                            {!! $slide->line_2 !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    @endif

    <section>
        <div class="container bbest">
            <h2>{{ $home->suggestions2->title??null }}</h2>
            @foreach($types as $k=>$tp)
                <div class="best-offers">
                    <div class="best-offers__title">
                        <p>{{ t("app.block_2_$k") }}</p>
                    </div>
                    <div class="best-offers-slider">
                        @foreach($block_2 as $item)

                            @if($item->type_id == $tp->id)

                                <div class="best-offers-slider-box">
                                    <div class="best-offers__block">
                                        <a href="{{route('page_item',['parent'=>'estates','current'=>$item->url])}}"
                                           class="best-offers__img">
                                            <img src="{{asset("u/estates/$item->image")}}" alt="png">
                                            @if($item->urgent)
                                                <span class="urgently">{{ t('app.Շտապ') }}</span>
                                            @endif
                                        </a>
                                        <div class="best-offers__box">
                                            <a href="{{route('page_item',['parent'=>'estates','current'=>$item->url])}}">{{$item->title}}</a>
                                            <p> {{ \App\Models\Location::getLocationTitle($item->locations->locations_id) }}</p>
                                            <strong>{{$item->price??null}}</strong>
                                            <div class="best-offers__info d_flex a_items_end j_content_between">
                                                <ul>
                                                    @if(!empty($item->estate_filter) && count($item->estate_filter))
                                                        @foreach($item->estate_filter as $filter)
                                                            @if($filter->filter->to_card)
                                                                @if($filter->filter->have_interval)
                                                                    <li>{{$filter->filter->title}}:</li>
                                                                    <li><strong>{{$filter->value}}</strong>
                                                                    </li>
                                                                @else
                                                                    <li>{{$filter->filter->title}}:</li>
                                                                    @if(!empty($filter->filter->option) && count($filter->filter->option))
                                                                        @foreach($filter->filter->option as $option)
                                                                            @if($filter->option_id == $option->id)
                                                                                <li>
                                                                                    <strong>{{(json_decode($option->options)->{app()->getLocale()})??null}}</strong>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    <li> {{ t('app.Կոդ:') }} </li>
                                                    <li><strong>{{$item->code??null}}</strong></li>
                                                </ul>
                                                <div data-id="{{$item->id}}"
                                                     class="best-offers__heart {{ (in_array($item->id,$favorites))?'active-heart':'' }}">
                                                    <a href="javascript:;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24.716"
                                                             height="21.99"
                                                             viewBox="0 0 24.716 21.99">
                                                            <path id="heart"
                                                                  d="M22.756,2.152A6.646,6.646,0,0,0,17.812,0a6.218,6.218,0,0,0-3.884,1.341,7.945,7.945,0,0,0-1.57,1.639,7.941,7.941,0,0,0-1.57-1.639A6.217,6.217,0,0,0,6.9,0,6.647,6.647,0,0,0,1.961,2.152,7.726,7.726,0,0,0,0,7.428,9.2,9.2,0,0,0,2.452,13.45a52.273,52.273,0,0,0,6.136,5.76c.85.725,1.814,1.546,2.815,2.421a1.451,1.451,0,0,0,1.911,0c1-.875,1.965-1.7,2.816-2.422a52.244,52.244,0,0,0,6.136-5.759,9.2,9.2,0,0,0,2.451-6.022,7.725,7.725,0,0,0-1.961-5.276Zm0,0"
                                                                  transform="translate(0)" fill="#d9e2e9"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        @endforeach</div>
                </div>
            @endforeach

        </div>
    </section>

    <section>
        <div class="container">
            <div class="about-our-company d_flex j_content_between a_items_center"
                 style="background-image: url({{$home->about->image()}});">
                <div class="about-our-company__block">
                    <div class="about-our-company__text">
                        <h2>{{$home->about->title}}</h2>
                        <p>
                            {!! $home->about->desc !!}
                        </p>
                    </div>
                    <div class="about-our-company__href">
                        <a href="{{$home->about->url??"javascript:void(0)"}}">{{$home->about->button_text}}</a>
                    </div>
                </div>
                <div class="about-our-company__logo">
                    <img src="{{$home->about->image2()}}">
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container bbest">
            <h2>{{ $home->suggestions3->title??null }}</h2>
            @foreach($types as $k=>$tp)
                <div class="best-offers">
                    <div class="best-offers__title">
                        <p>{{ t("app.block_3_$k") }}</p>
                    </div>
                    <div class="best-offers-slider">
                        @foreach($block_3 as $item)

                            @if($item->type_id == $tp->id)

                                <div class="best-offers-slider-box">
                                    <div class="best-offers__block">
                                        <a href="{{route('page_item',['parent'=>'estates','current'=>$item->url])}}"
                                           class="best-offers__img">
                                            <img src="{{asset("u/estates/$item->image")}}" alt="png">
                                            @if($item->urgent)
                                                <span class="urgently">{{ t('app.Շտապ') }}</span>
                                            @endif
                                        </a>
                                        <div class="best-offers__box">
                                            <a href="{{route('page_item',['parent'=>'estates','current'=>$item->url])}}">{{$item->title}}</a>
                                            <p> {{ \App\Models\Location::getLocationTitle($item->locations->locations_id) }}</p>
                                            <strong>{{$item->price??null}}</strong>
                                            <div class="best-offers__info d_flex a_items_end j_content_between">
                                                <ul>
                                                    @if(!empty($item->estate_filter) && count($item->estate_filter))
                                                        @foreach($item->estate_filter as $filter)
                                                            @if($filter->filter->to_card)
                                                                @if($filter->filter->have_interval)
                                                                    <li>{{$filter->filter->title}}:</li>
                                                                    <li><strong>{{$filter->value}}</strong>
                                                                    </li>
                                                                @else
                                                                    <li>{{$filter->filter->title}}:</li>
                                                                    @if(!empty($filter->filter->option) && count($filter->filter->option))
                                                                        @foreach($filter->filter->option as $option)
                                                                            @if($filter->option_id == $option->id)
                                                                                <li>
                                                                                    <strong>{{(json_decode($option->options)->{app()->getLocale()})??null}}</strong>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    <li> {{ t('app.Կոդ:') }} </li>
                                                    <li><strong>{{$item->code??null}}</strong></li>
                                                </ul>
                                                <div data-id="{{$item->id}}"
                                                     class="best-offers__heart {{ (in_array($item->id,$favorites))?'active-heart':'' }}">
                                                    <a href="javascript:void(0);">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24.716"
                                                             height="21.99"
                                                             viewBox="0 0 24.716 21.99">
                                                            <path id="heart"
                                                                  d="M22.756,2.152A6.646,6.646,0,0,0,17.812,0a6.218,6.218,0,0,0-3.884,1.341,7.945,7.945,0,0,0-1.57,1.639,7.941,7.941,0,0,0-1.57-1.639A6.217,6.217,0,0,0,6.9,0,6.647,6.647,0,0,0,1.961,2.152,7.726,7.726,0,0,0,0,7.428,9.2,9.2,0,0,0,2.452,13.45a52.273,52.273,0,0,0,6.136,5.76c.85.725,1.814,1.546,2.815,2.421a1.451,1.451,0,0,0,1.911,0c1-.875,1.965-1.7,2.816-2.422a52.244,52.244,0,0,0,6.136-5.759,9.2,9.2,0,0,0,2.451-6.022,7.725,7.725,0,0,0-1.961-5.276Zm0,0"
                                                                  transform="translate(0)" fill="#d9e2e9"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        @endforeach</div>
                </div>
            @endforeach

        </div>
    </section>

    <section>
        <div class="container">
            <div class="download-attachment d_flex a_items_end j_content_between">
                <div class="download-attachment__title">
                    <h2>{{ $home->app->title }}</h2>
                    <p>
                        {!! $home->app->desc !!}
                    </p>
                    <div class="download-attachment__href d_flex">
                        <a href="javascript:;" target="_blank">
                            <img src="{{ $home->app->button_img1() }}">
                        </a>
                        <a href="javascript:;" target="_blank">
                            <img src="{{ $home->app->button_img2() }}">
                        </a>
                    </div>
                </div>
                <div class="mobile-app__img">
                    <img src="{{ $home->app->image() }}">
                </div>
            </div>
        </div>
    </section>
    {{--    <section>--}}
    {{--        <div class="container">--}}
    {{--            <div class="news-tips-articles">--}}
    {{--                <h2>{{ $home->news->title }}</h2>--}}
    {{--                <div class="tips-articles__block d_flex j_content_center">--}}
    {{--                    <div class="tips-articles__box">--}}
    {{--                        <div class="tips-articles__info">--}}
    {{--                            <a href="javascript:;" class="tips-articles__img">--}}
    {{--                                <img src="assets/img/home1.png">--}}
    {{--                            </a>--}}
    {{--                            <div class="tips-articles__text">--}}
    {{--                                <a href="javascript:;">7 կտոր խորհուրդներ Newbies- ին</a>--}}
    {{--                                <p>--}}
    {{--                                    Lorem ipsum dolor sit amet, consectetuer--}}
    {{--                                    adipiscing elit. Eenean Commodo ligula eget--}}
    {{--                                    դալոր: Էնեյան զանգված: Cum sociis natoque--}}
    {{--                                    penatibus et magnis--}}
    {{--                                </p>--}}
    {{--                            </div>--}}
    {{--                            <div class="tips-articles__href d_flex a_items_center j_content_between">--}}
    {{--                                <p><img src="assets/img/clock.png">02 Հունիսի 2020</p>--}}
    {{--                                <a href="javascript:;">Դիտել ավելին</a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="tips-articles__box">--}}
    {{--                        <div class="tips-articles__info">--}}
    {{--                            <a href="javascript:;" class="tips-articles__img">--}}
    {{--                                <img src="assets/img/home2.png">--}}
    {{--                            </a>--}}
    {{--                            <div class="tips-articles__text">--}}
    {{--                                <a href="javascript:;">7 կտոր խորհուրդներ Newbies- ին</a>--}}
    {{--                                <p>--}}
    {{--                                    Lorem ipsum dolor sit amet, consectetuer--}}
    {{--                                    adipiscing elit. Eenean Commodo ligula eget--}}
    {{--                                    դալոր: Էնեյան զանգված: Cum sociis natoque--}}
    {{--                                    penatibus et magnis--}}
    {{--                                </p>--}}
    {{--                            </div>--}}
    {{--                            <div class="tips-articles__href d_flex a_items_center j_content_between">--}}
    {{--                                <p><img src="assets/img/clock.png">02 Հունիսի 2020</p>--}}
    {{--                                <a href="javascript:;">Դիտել ավելին</a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="tips-articles__box">--}}
    {{--                        <div class="tips-articles__info">--}}
    {{--                            <a href="javascript:;" class="tips-articles__img">--}}
    {{--                                <img src="assets/img/home3.png">--}}
    {{--                            </a>--}}
    {{--                            <div class="tips-articles__text">--}}
    {{--                                <a href="javascript:;">7 կտոր խորհուրդներ Newbies- ին</a>--}}
    {{--                                <p>--}}
    {{--                                    Lorem ipsum dolor sit amet, consectetuer--}}
    {{--                                    adipiscing elit. Eenean Commodo ligula eget--}}
    {{--                                    դալոր: Էնեյան զանգված: Cum sociis natoque--}}
    {{--                                    penatibus et magnis--}}
    {{--                                </p>--}}
    {{--                            </div>--}}
    {{--                            <div class="tips-articles__href d_flex a_items_center j_content_between">--}}
    {{--                                <p><img src="assets/img/clock.png">02 Հունիսի 2020</p>--}}
    {{--                                <a href="javascript:;">Դիտել ավելին</a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}

    @include('site.layouts.footer')
@endsection
@push('js')

    {{--    @include('ckfinder::setup')--}}
@endpush
