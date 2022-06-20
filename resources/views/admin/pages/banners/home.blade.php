@extends('admin.pages.banners.layout')
@section('title', 'Контент главной страницы')
@php $back_url = route('admin.pages.main') @endphp
@section('body')
    @bannerBlock(['title'=>"Банер 'Поиска'"])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Контент'])
            @banner('search.title', 'Название')
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Изоброжение'])
            @banner('search.image', 'Изоброжение (16:9(мин. 1440x))')
            @endcard
        </div>
    </div>
    @endbannerBlock
    @bannerBlock(['title'=>"Банер 'Бесплатные объявления'"])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Контент'])
            @banner('adv_title.title', 'Надпись блока')
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @cards(['title'=>'Номера телефонов', 'banners'=>'adv'])
            @banner('title', 'Текст номера')
            @banner('phone', 'Номер телефона')
            @endcards
        </div>
    </div>
    @endbannerBlock
    @bannerBlock(['title'=>"Банер 'Лучшие предложения'"])
    <div class="row">
        <div class="col-12 col-dxl-12">
            @card(['title'=>'Контент'])
            @banner('suggestions.title', 'Название блока')
            <div class="row">
                <div class="col-12 col-dxl-6">
                    @banner('suggestions.title1', 'Надпись первого блока')
                </div>
                <div class="col-12 col-dxl-6">
                    @banner('suggestions.title2', 'Надпись второго блока')
                </div>
            </div>

            @endcard
        </div>
    </div>
    @endbannerBlock
    @bannerBlock(['title'=>"Банер 'Второй блок предложений'"])
    <div class="row">
        <div class="col-12 col-dxl-12">
            @card(['title'=>'Контент'])
            @banner('suggestions2.title', 'Название блока')
            <div class="row">
                <div class="col-12 col-dxl-6">
                    @banner('suggestions2.title1', 'Надпись первого блока')
                </div>
                <div class="col-12 col-dxl-6">
                    @banner('suggestions2.title2', 'Надпись второго блока')
                </div>
            </div>

            @endcard
        </div>
    </div>
    @endbannerBlock
    @bannerBlock(['title'=>"Банер 'Третий блок предложений'"])
    <div class="row">
        <div class="col-12 col-dxl-12">
            @card(['title'=>'Контент'])
            @banner('suggestions3.title', 'Название блока')
            <div class="row">
                <div class="col-12 col-dxl-6">
                    @banner('suggestions3.title1', 'Надпись первого блока')
                </div>
                <div class="col-12 col-dxl-6">
                    @banner('suggestions3.title2', 'Надпись второго блока')
                </div>
            </div>
            @endcard
        </div>
    </div>
    @endbannerBlock
    @bannerBlock(['title'=>"Банер 'О нас'"])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Контент'])
            @banner('about.title', 'Название блока')
            @banner('about.desc', 'Описание блока')
            @banner('about.button_text', 'Надпись кнопки')
            @banner('about.url', 'Ссылка кнопки')
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Изоброжении'])
            @banner('about.image', 'Изоброжение фона (16:9(мин. 1440 x))')
            @banner('about.image2', 'Изоброжение правого блока (2:1(мин. 360 x 180))')
            @endcard
        </div>
    </div>
    @endbannerBlock
    @bannerBlock(['title'=>"Банер 'Наше приложение'"])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Контент'])
            @banner('app.title', 'Название блока')
            @banner('app.desc', 'Описание блока')
            @banner('app.url1', 'Ссылка первой кнопки')
            @banner('app.url2', 'Ссылка второй кнопки')
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Изоброжении'])
            @banner('app.image', 'Изоброжение правого блока (2:1(мин. 360 x 180))')
            @banner('app.button_img1', 'Изображение первой кнопки (мин. 200х60)')
            @banner('app.button_img2', 'Изображение второй кнопки (мин. 200х60)')
            @endcard
        </div>
    </div>
    @endbannerBlock
    @bannerBlock(['title'=>"Банер 'Новости'"])
    <div class="card">
        <div class="card-body">
            @banner('news.title', 'Загаловок блока')
        </div>
    </div>
    @endbannerBlock
@endsection
