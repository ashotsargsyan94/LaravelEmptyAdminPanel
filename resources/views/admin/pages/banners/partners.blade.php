@extends('admin.pages.banners.layout')
@section('title', 'Контент страницы сотрудников')
@php $back_url = route('admin.pages.main') @endphp
@section('body')
    @bannerBlock(['title'=>'Загаловок'])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Загаловок'])
            @banner('content.title', 'Надпись блока')
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Изоброжение'])
            @banner('content.image', 'Изоброжение (рек шир. 1920)')
            @endcard
        </div>
    </div>
    @endbannerBlock
@endsection