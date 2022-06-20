@extends('site.layouts.app')
@section('content')
    <div class="container pb-s">
        <div class="dynamic-page">
            @if ($page->image && $page->show_image)
                <div class="dynamic-page-banner">
                    <img src="{{ asset('u/pages/'.$page->image) }}" alt="{{ $page->title }}">
                </div>
            @endif
            <div class="global-page-title pt-s">
                <h1>{{ $page->title }}</h1>
            </div>
            <div class="dynamic-page-content dynamic-text pt-2s">{!! $page->content !!}</div>
        </div>
        @component('site.components.video_gallery', ['gallery'=>$video_gallery])@endcomponent
        @component('site.components.gallery', ['gallery'=>$gallery])@endcomponent
    </div>
@endsection