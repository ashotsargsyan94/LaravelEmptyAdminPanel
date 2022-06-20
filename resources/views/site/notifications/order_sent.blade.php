@extends('site.notifications.layout')
@section('content')
    <div>
        @if (!empty($respond))
            <p style="font-weight:bold; color:{!! $respond==1?'#28a745':'#ae1c1a' !!}">{{ $subject }}</p>
        @endif
        @if ($user)
            <p><strong>{{ __('app.registered user') }}:</strong> {{ $user->email }}</p>
        @endif
        <p><strong>{{ __('cabinet.order number') }}:</strong> N{{ $order->id }}</p>
        <p><strong>{{ __('cabinet.date') }}:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
        @if ($order['delivery_id'])
            <p><strong>{{ __('app.with delivery') }}:</strong> {{ __('app.yes') }}</p>
            <p><strong>{{ __('app.district') }}:</strong> {{ $order['delivery_title'] }}</p>
            <p><strong>{{ __('app.delivery price') }}:</strong> {{ $order['delivery'] }} ֏</p>
        @else
            <p><strong>{{ __('app.with delivery') }}:</strong> {{ __('app.no') }}</p>
        @endif

        <p><strong>{{ __('app.name') }}:</strong> {{ $order->name }}</p>
        <p><strong>{{ __('app.address') }}:</strong> {{ $order->address }}</p>
        @if ($order->email)
            <p><strong>{{ __('app.email') }}:</strong> {{ $order->email }}</p>
        @endif
        <p><strong>{{ __('app.phone') }}:</strong> {{ $order->phone }}</p>
        @if ($order->phone_2)
            <p><strong>{{ __('app.alt phone') }}:</strong> {{ $order->phone_2 }}</p>
        @endif
        @if ($order->message)
            <div>
                <strong>{{ __('app.notes') }}:</strong>
                <p>{{ $order->message }}</p>
            </div>
        @endif
        <p><strong>{{ __('cabinet.sum') }}:</strong> {{ $order->sum }} ֏</p>
        <p><strong>{{ __('cabinet.payment method') }}:</strong> {{ __('cabinet.cash') }}</p>
        <p><strong>{{ __('cabinet.status') }}:</strong>
            @switch($order->status)
                @case(1) <span style="color:#28a745">{{ __('cabinet.accepted') }}</span> @break
                @case(-1) <span style="color:#ae1c1a">{{ __('cabinet.declined') }}</span> @break
                @default <span style="color:#ffc107">{{ __('cabinet.pending') }}</span>
            @endswitch
        </p>
    </div>
    <div>
        <table border="1" style="font-size:15px;border-collapse: collapse; text-align: center; margin-top:15px">
            <thead>
                <tr>
                    <th>{{ __('app.products.name') }}</th>
                    <th>{{ __('app.products.options') }}</th>
                    <th>{{ __('app.products.count') }}</th>
                    <th>{{ __('app.products.price') }}</th>
                    <th>{{ __('app.products.full price') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product['product_title'][$locale]??'-' }}</td>
                        <td>
                            @forelse($product['options'] as $option)
                            {{ $option['title'][$locale]??'N'.$option['id'] }}@if(!$loop->last),@endif
                            @empty
                            -
                            @endforelse
                        </td>
                        <td>{{ $product['count'] }}</td>
                        <td>{{ $product['price'] }} ֏</td>
                        <td>{{ $product['count'] * $product['price'] }} ֏</td>
                    </tr>
                @endforeach
                @if($order['delivery']!==null)
                    <tr style="font-weight:bold">
                        <td>{{ __('app.price') }}</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>{{ $order['sum'] - $order['delivery'] }} ֏</td>
                    </tr>
                    <tr style="font-weight:bold">
                        <td>{{ __('app.delivery') }}</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>{{ $order['delivery'] }} ֏</td>
                    </tr>
                @endif
                <tr style="font-weight:bold">
                    <td>{{ __('app.all') }}</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>{{ $order['sum'] }} ֏</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection