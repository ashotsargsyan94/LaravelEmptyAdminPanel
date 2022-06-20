@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="view-line"><span class="view-label">Имя:</span> {{ $item->name }}</div>
            <div class="view-line"><span class="view-label">Эл.почта:</span> {{ $item->email }} @if($item->verification) <span class="text-danger">(не подтверждена)</span> @else <span class="text-success">(подтверждена)</span> @endif</div>
            <div class="view-line"><span class="view-label">Телефон:</span> {{ $item->phone }}</div>
            <div class="view-line"><span class="view-label">Адрес:</span> {{ $item->address }}</div>
            <div class="view-line"><span class="view-label">Дата регистрации:</span> {{ $item->created_at->format('d.m.Y H:i') }}</div>
            <div class="view-line"><span class="view-label">Статус:</span> @if($item->active) <span class="text-success">активно</span> @else <span class="text-danger">блокирован</span> @endif</div>
            <div class="view-line"><span class="view-label">Ожидаемые заказы:</span> {{ $orders_count['pending'] }}</div>
            <div class="view-line"><span class="view-label">Принятые заказы:</span> {{ $orders_count['accepted'] }}</div>
            <div class="view-line"><span class="view-label">Откноненные заказы:</span> {{ $orders_count['declined'] }}</div>
            <div class="m-t-10">
                <button type="button" data-toggle="modal" data-target="#blockUserModal" class="btn btn-{{ $item->active?'danger':'success' }}">{{ $item->active?'Блокировать':'Разблокировать' }}</button>
            </div>
        </div>
    </div>
    @bannerBlock(['title'=>'Заказы'])
    @if(count($orders))
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-striped m-b-0 columns-middle">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Дата</th>
                        <th>Сумма</th>
                        <th>С доставкой</th>
                        <th>Статус</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr class="item-row" data-id="{!! $order->id !!}">
                            <td class="item-id">{{ $order->id }}</td>
                            <td class="item-title">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                            <td class="item-title">{{ $order->sum }}</td>
                            <td class="item-title">{!! $order->delivery===null?'<span class="text-danger">нет</span>':'<span class="text-success">да</span>' !!}</td>
                            <td>
                                @switch($order->status)
                                    @case(1) <span class="text-success">Принято</span> @break
                                    @case(-1) <span class="text-danger">Откланено</span> @break
                                    @default <span class="text-warning">Ожидание</span>
                                @endswitch
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.view', ['id'=>$order->id]) }}" {!! tooltip('Посмотреть') !!} class="icon-btn view"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h4 class="text-danger">У пользователя нет заказов</h4>
    @endif
    @endbannerBlock
    @modal(['id'=>'blockUserModal', 'centered'=>true,
        'saveBtn'=>$item->active?'Блокировать':'Разблокировать',
        'saveBtnClass'=>'btn-'.($item->active?'danger':'success'),
        'closeBtn' => 'Отменить',
        'form'=>['method'=>'post','action'=>route('admin.users.toggleActive')]])
    @slot('title')Блокировка пользователя@endslot
    <input type="hidden" name="active" value="{{ $item->active?0:1 }}">
    <input type="hidden" name="id" value="{{ $item->id }}">
    @csrf @method('patch')
    <p class="font-14">Вы действительно хотите {{ $item->active?'блокировать':'разблокировать' }} данного пользователя?</p>
    @endmodal
@endsection