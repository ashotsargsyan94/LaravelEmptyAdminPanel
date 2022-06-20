@extends('admin.layouts.app')
@section('content')
    <form action="{!! $edit?route('admin.main_slider.edit', ['id'=>$item->id]):route('admin.main_slider.add') !!}"
          method="post" enctype="multipart/form-data">
        @csrf @method($edit?'patch':'put')
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <div class="row">
            <div class="col-12 col-lg-6">

                <div class="card">
                    @bylang(['id'=>'form_title', 'tp_classes'=>'little-p', 'title'=>'Заголовок'])
                    <input type="text" name="title[{!! $iso !!}]" class="form-control" placeholder="Заголовок"
                           value="{{ old('title.'.$iso, tr($item, 'title', $iso)) }}">
                    @endbylang
                </div>
                <div class="card">
                    @bylang(['id'=>'form_title2', 'tp_classes'=>'little-p', 'title'=>'Линия 1'])
                    <input type="text" name="line_1[{!! $iso !!}]" class="form-control" placeholder="Линия 1"
                           value="{{ old('line_1.'.$iso, tr($item, 'line_1', $iso)) }}">
                    @endbylang
                </div>
                <div class="card">
                    @bylang(['id'=>'form_title3', 'tp_classes'=>'little-p', 'title'=>'Линия 2'])
                    <input type="text" name="line_2[{!! $iso !!}]" class="form-control" placeholder="Линия 2"
                           value="{{ old('line_2.'.$iso, tr($item, 'line_2', $iso)) }}">
                    @endbylang
                </div>
                <div class="card px-3 pt-3">
                    @labelauty(['id'=>'active', 'label'=>'Неактивно|Активно', 'checked'=>oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="c-title">Изоброжение 1440x</div>
                    @if (!empty($item->image))
                        <div class="p-2 text-center">
                            <img src="{{ asset('u/main_slider/'.$item->image) }}" alt="" class="img-responsive">
                        </div>
                    @endif
                    <div class="c-body">
                        @file(['name'=>'image'])@endfile
                    </div>
                </div>
            </div>
            <div class="col-12 save-btn-fixed">
                <button type="submit"></button>
            </div>
        </div>
    </form>


@endsection
@push('js')
     @include('ckfinder::setup')
@endpush
