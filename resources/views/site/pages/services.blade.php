@extends('site.layouts.header')
@section('content')
    <section>
        <div class="container">
            <div class="services-block-fon">
                <div class="services-bg" style="background-image: url({{$content->header->image()}})">
                    <img src="{{$content->header->image2()}}" alt="png">
                </div>
                <div class="about-our-company__title">

                    <h2>{{$content->content->title}}</h2>
                    <p>
                       {!! $content->content->desc !!}
                    </p>
                </div>

                @if(!empty($items))
                    @foreach($items as $item)
                        <div class="name-of-services">
                            <div class="name-of-services__title d_flex a_items_center">
                                <div class="name-of-services__key">
                                    <img src="{{asset('u/services/'.$item->image)}}" alt="png">
                                </div>
                                <strong>{{$item->title}}</strong>
                            </div>
                            <p>
                                {!! $item->desc !!}
                            </p>
                            <div class="name-services__gallery">
                                @if(count($item->galleries))
                                    @foreach($item->galleries as $gallery)
                                        <div class="name-services__img">
                                            <a href="{{asset('u/gallery/'.$gallery->image)}}" data-fancybox="gallery">
                                                <img src="{{asset('u/gallery/thumbs/'.$gallery->image)}}" alt="jpg">
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    @include('site.layouts.footer')

@endsection
