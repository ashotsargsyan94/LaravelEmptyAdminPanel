@extends('admin.pages.banners.layout')
@section('title', 'Контент страницы сервисов')
@php $back_url = route('admin.pages.main') @endphp
@section('body')
    @bannerBlock(['title'=>'Загаловок'])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Изоброжение'])
            @banner('header.image', 'Изоброжение (рек шир. 1440)')
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Изоброжение'])
            @banner('header.image2', 'Логотип на Изоброжении (рек шир. x200)')
            @endcard
        </div>
    </div>
    @endbannerBlock
    @bannerBlock(['title'=>'Контент'])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Контент'])
            @banner('content.title', 'Загаловок')
            @banner('content.desc', 'Описание')
            @endcard
        </div>
    </div>
    @endbannerBlock
@endsection
