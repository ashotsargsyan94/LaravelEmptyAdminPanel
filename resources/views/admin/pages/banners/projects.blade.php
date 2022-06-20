@extends('admin.pages.banners.layout')
@section('title', 'Контент страницы о проекте')
@php $back_url = route('admin.pages.main') @endphp
@section('body')
    @bannerBlock(['title'=>'Загаловок'])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Загаловок'])
            @banner('header.title', 'Надпись блока')
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Изоброжение'])
            @banner('header.image', 'Изоброжение (рек шир. 1920)')
            @endcard
        </div>
    </div>
    @endbannerBlock
    @bannerBlock(['title'=>'Контент'])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Контент'])
            @banner('content.title', 'Загаловок')
            @banner('content.desc', 'Текст')
            @endcard
        </div>

    </div>
    @endbannerBlock
@endsection