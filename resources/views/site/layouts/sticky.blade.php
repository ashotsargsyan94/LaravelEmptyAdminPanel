@extends('site.layouts.app')
@php $page_classes=' sticky-inside' @endphp
@section('content')
    <div class="container">
        <div class="row l-m mx--xl-0">
            <div class="d-none d-xl-block col-3 mt--s">
                <div class="sidebar-sticky">
                    <div class="menu-search">
                        <form class="menu-search-form" action="{{ route('search') }}" method="get">
                            <div class="menu-search-group">
                                <input type="text" name="q" placeholder="{{ __('app.search') }}" class="menu-search-control" value="{{ $search??null }}">
                                <button type="submit" class="menu-search-submit">
                                    <img src="{!! aSite('img/search.svg') !!}" alt="search">
                                </button>
                            </div>
                        </form>
                    </div>
                    <aside class="menu-page-sidebar">
                        <div class="sidebar-title pb-s">{{ __('app.menu') }}</div>
                        <div class="section-dash red"></div>
                        <div class="sidebar-items fixed-scrollbar">
                            <a href="{{ page('menu') }}" class="sidebar-item{{ ($catalogue_page??null)=='all'?' active':null }}">{{ __('app.all products') }}</a>
                            @foreach($catalogues as $catalogue)
                                <a href="{{ route('catalogue', ['url'=>$catalogue->url]) }}" class="sidebar-item{{ ($catalogue_page??null)==$catalogue->id?' active':null }}">{{ $catalogue->title }}</a>
                            @endforeach
                        </div>
                    </aside>
                </div>
            </div>
            <div class="col-12 col-xl-9 px--xl-0">
                <div class="sticky-container mt--s pt-s mb-s">
                    <div class="menu-page-breadcrumb">
                        <div class="bc-item">
                            <a href="{!! route('page') !!}" class="bc-link">{{ __('app.main') }}</a>
                        </div>
                        @yield('breadcrumb')
                    </div>
                </div>
                <div class="menu-page-items pb-s">@yield('main')</div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    @js(aSite('js/menu.js'))
@endpush