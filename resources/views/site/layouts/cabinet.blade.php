@extends('site.layouts.app')
@section('content')
    <div class="container py-s">
        <div class="global-page-title">
            <h1>@yield('page_title')</h1>
        </div>
        <div class="row pt-2s l-m">
            <div class="col-12 col-lg-4">
                <div class="cabinet-menu">
                    @if ($pending_orders_count>0)
                        @component('site.components.cabinet_link', ['route'=>'cabinet.orders.pending', 'title'=>__('cabinet.pending orders')])@endcomponent
                    @endif
                    @component('site.components.cabinet_link', ['route'=>'cabinet.orders.accepted', 'title'=>__('cabinet.accepted orders')])@endcomponent
                    @if ($declined_orders_count>0)
                            @component('site.components.cabinet_link', ['route'=>'cabinet.orders.declined', 'title'=>__('cabinet.declined orders')])@endcomponent
                    @endif
                    @component('site.components.cabinet_link', ['route'=>'cabinet.profile', 'title'=>__('cabinet.profile settings')])@endcomponent
                    <a class="cabinet-link" href="javascript:void(0)" data-toggle="modal" data-target="#logout-modal">{{ __('cabinet.logout') }}</a>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="cabinet-page">@yield('cabinet_page')</div>
            </div>
        </div>
    </div>
    @yield('cabinet_foot')
    <div class="modal fade order-modal" id="logout-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:600px">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title">{{ __('cabinet.logout? title') }}</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('logout') }}" method="post">
                        <div>{{ __('cabinet.logout?') }}</div>
                        <div class="order-submit">
                            <button type="submit" class="btn-order">{{ __('cabinet.logout confirm') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    @js(aApp('bootstrap/js/bootstrap.js'))
@endpush