@extends('admin.pages.banners.layout')
@section('title', 'Контент страницы контакта')
@php $back_url = route('admin.pages.main') @endphp
@section('body')
    @bannerBlock(['title'=>'Контент'])
        <div class="row">
            <div class="col-12 col-dxl-6">
                @card(['title'=>'Блок'])
                @banner('content.title', 'Название блока')
                @banner('content.text', 'Текст после названии')
                @endcard
            </div>
            <div class="col-12 col-dxl-6">
                @card(['title'=>'Блок'])
                @banner('content.image', 'Изображение блока')
                @endcard
            </div>
            <div class="col-12 col-dxl-6">
                @card(['title'=>'Блок'])
                @banner('content.email_text', 'Надпись блока письма')
                @banner('content.email_desc', 'Текст блока письма')
                @endcard
            </div>
            <div class="col-12 col-dxl-6">
                @card(['title'=>'Блок'])
                @banner('content.address_text', 'Надпись блока адреса')
                @banner('content.address_desc1', '1-ый Текст блока адреса')
                @banner('content.address_desc2', '2-ой Текст блока адреса')
                @endcard
            </div>
        </div>
    @endbannerBlock
@endsection