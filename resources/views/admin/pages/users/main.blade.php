@extends('admin.layouts.app')
@section('content')
    @if(count($items))
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-striped m-b-0 columns-middle my-datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Эл.почта</th>
                        <th>Статус</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr class="item-row" data-id="{!! $item->id !!}">
                            <td class="item-id">{{ $item->id }}</td>
                            <td class="item-title">{{ $item->name }}</td>
                            <td class="item-title">{{ $item->email }}</td>
                            @if($item->active)
                                <td class="text-success">Активно</td>
                            @else
                                <td class="text-danger">Блокирован</td>
                            @endif
                            <td>
                                <a href="{{ route('admin.users.view', ['id'=>$item->id]) }}" {!! tooltip('Посмотреть') !!} class="icon-btn view"></a>
                                {{--<span class="d-inline-block" data-toggle="modal" data-target="#itemDeleteModal"><a href="javascript:void(0)" class="icon-btn delete" {!! tooltip('Удалить') !!}></a></span>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h4 class="text-danger">@lang('admin/all.empty')</h4>
    @endif
@endsection
@push('js')
    @js(aApp('datatables/datatables.js'))
    <script>
        $('.my-datatable').dataTable();
    </script>
@endpush
@push('css')
    @css(aApp('datatables/datatables.css'))
@endpush