@extends('admin.pages.banners.layout')
@section('title', 'Контент страницы о компании')
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
    <x-banner-block title="Загаловок">

    </x-banner-block>
    @bannerBlock(['title'=>'Контент'])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Контент'])
            @banner('content.title', 'Название')
            @banner('content.desc', 'Текст')
            @endcard

            @card(['title'=>'Цифры'])
            @banner('content.counter1', 'Первая цифра')
            @banner('content.counter1_text', 'Подпись первой цифры')
            @banner('content.counter2', 'Вторая цифра')
            @banner('content.counter2_text', 'Подпись второй цифры')
            @banner('content.counter3', 'Третья цифра')
            @banner('content.counter3_text', 'Подпись третей цифры')
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Изоброжение'])
            @banner('content.image', 'Изоброжение (16:9(мин. 800))')
            @endcard
        </div>
    </div>
    @endbannerBlock
    @bannerBlock(['title'=>'Блок после слайдера'])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Надпись блока'])
            @banner('content.after_slider', 'Надпись')
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Изоброжение'])
            @banner('content.after_image', 'Изоброжение (16:9(мин. 800))')
            @endcard
        </div>
    </div>

    @endbannerBlock
@endsection
