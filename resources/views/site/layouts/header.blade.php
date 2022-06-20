<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ $seo['title']??null }}</title>
    @if(!empty($seo['keywords']))
        <meta name="keywords" content="{{ $seo['keywords']??null }}">
        <meta name="description" content="{{ $seo['description']??null }}">
    @endif
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="{{ asset('f/site/css/style.css') }}">
    @stack('css')
{{--    <link rel="stylesheet" href="{{ asset('f/site/css/multirange.css') }}">--}}
</head>
<body>
<header>
    <div class="container">
        <div class="header-min d_flex a_items_center j_content_between">
            <div class="header-logo">
                <a href="{{route('page')}}">
                    <img src="{{ $info->data->header_logo() }}" alt="">
                </a>
            </div>
            <div class="header-menu">
                <div class="open-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="for-mobile-bg"></div>
                <div class="menu-cnt">
                    <div id="mySidenav" class="sidenav">
                        <ul>
                            @if(!empty($menu_pages))
                                @foreach($menu_pages as $page)
                                    <li>
                                        <a class="{{ (isset($current_page)  && ($current_page == $page->id))?'actived':null }}"
                                           href="{{ route('page', ['url'=>$page->url]) }}">{{ $page->title }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="header-language">
                <ul>
                    @if(count($languages))
                        @foreach($languages as $language)
                            <li>
                                <a class="{{ ($current_language->id == $language->id)?'actived':'' }}" style="color: #737373;"
                                    href="{{ url(\LanguageManager::getUrlWithLocale($language->iso)) }}"><span>{{ $language->title }}</span>
                                </a>{{(($loop->index + 1) == count($languages))?'':' /'}}
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</header>

@yield('content')

{{--<script src="{{ asset('f/site/js/jquery-3.2.1.min.js') }}"></script>--}}
{{--<script src="{{ asset('f/site/js/jquery.formstyler.min.js') }}"></script>--}}
{{--<script src="{{ asset('f/site/js/jquery.cookie.min.js') }}"></script>--}}
{{--<script src="{{ asset('f/site/js/jquery.fancybox.js') }}"></script>--}}
{{--<script src="{{ asset('f/site/slick/slick.min.js') }}"></script>--}}
<script src="{{ asset('f/site/js/script.js') }}"></script>
{{--<script src="{{ asset('f/site/js/multirange.js') }}"></script>--}}
<script>
    $(document).ready(function () {
        $('select').styler();
    })
</script>
@stack('js')
</body>
</html>
