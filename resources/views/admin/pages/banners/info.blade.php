@extends('admin.pages.banners.layout')
@section('title', 'Информация')
@section('body')
    @bannerBlock(['title'=>'Контакты'])
        <div class="row">
            <div class="col-12 col-dxl-6">
                @cards(['title'=>'Эл. почты', 'banners'=>'contacts', 'id'=>2])
                    @banner('email', 'Эл. почта')
                @endcards
                @cards(['title'=>'Эл. почта для отправки письма', 'banners'=>'contact_email'])
                    @banner('email', 'Эл. почта')
                @endcards
            </div>
            <div class="col-12 col-dxl-6">
                @cards(['title'=>'Телефоны', 'banners'=>'contacts'])
                    @banner('phone', 'Телефон')
                @endcards
                @cards(['title'=>'Адреса', 'banners'=>'contacts', 'id'=>3])
                    @banner('address', 'Адрес')
                @endcards
            </div>
            <div class="col-12 col-dxl-6">
                @cards(['title'=>'Ссылки социальных сетей', 'banners'=>'socials'])
                @banner('icon', 'Икона (20x20)')
                @banner('title', 'Название')
                @banner('url', 'Ссылка')
                @endcards
            </div>
            <div class="col-12 col-dxl-6">
                @cards(['title'=>'Альернативные ссылки футера', 'banners'=>'footer_links'])
                @banner('title', 'Название')
                @banner('url', 'Ссылка')
                @endcards
                @card(['title'=>'Карта'])
                @banner('map.source', 'Ссылка на карту')
                @endcard
            </div>
        </div>
    @endbannerBlock
    @bannerBlock(['title'=>'Контент страниц'])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Логотипы'])
            @banner('data.header_logo', 'Верхний логотип (шир. <=260)')
            @banner('data.menu_logo', 'Нижний логотип (шир. <=260)')
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title'=>'SEO'])
            @banner('seo.title_suffix', 'Суффикс названии')
            @endcard
        </div>
    </div>
    @endbannerBlock
@endsection
