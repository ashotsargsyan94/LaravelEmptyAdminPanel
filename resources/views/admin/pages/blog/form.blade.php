@extends('admin.layouts.app')
@section('content')
    <form action="{!! $edit?route('admin.blog.edit', ['id'=>$item->id]):route('admin.blog.add') !!}" method="post"
          enctype="multipart/form-data">
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
                    @bylang(['id'=>'form_title', 'tp_classes'=>'little-p', 'title'=>'Название'])
                    <input type="text" name="title[{!! $iso !!}]" class="form-control" placeholder="Название"
                           value="{{ old('title.'.$iso, tr($item, 'title', $iso)) }}">
                    @endbylang


                </div>
                <div class="card">
                    <div class="c-title">Дата</div>
                    <div class="c-body">
                        <input type="date" name="date" class="form-control" placeholder="Дата"
                               value="{{ old('date', $item->date??null) }}">
                    </div>
                </div>
                <div class="card px-3 pt-3">
                    <div class="row cstm-input">
                        <div class="col-12 p-b-5">
                            <input class="labelauty-reverse toggle-bottom-input on-unchecked" type="checkbox"
                                   name="generate_url" value="1"
                                   data-labelauty="Вставить ссылку вручную" {!! oldCheck('generate_url', $edit?false:true) !!}>
                            <div class="bottom-input">
                                <input type="text" style="margin-top:3px;" name="url" class="form-control" id="form_url"
                                       placeholder="Ссылка" value="{{ old('url', $item->url??null) }}">
                            </div>
                        </div>
                    </div>
                    @labelauty(['id'=>'active', 'label'=>'Неактивно|Активно', 'checked'=>oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="c-title">Изоброжение 16:9 (1440x768)</div>
                    @if (!empty($item->image))
                        <div class="p-2 text-center">
                            <img src="{{ asset('u/blog/'.$item->image) }}" alt="" class="img-responsive">
                        </div>
                    @endif
                    <div class="c-body">
                        @file(['name'=>'image'])@endfile
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    @bylang(['id'=>'form_content', 'tp_classes'=>'little-p', 'title'=>'Кототкое описание'])
                    <textarea class="form-control form-textarea ckeditor"
                              name="short_desc[{!! $iso !!}]">{!! old('short_desc.'.$iso, tr($item, 'short_desc', $iso)) !!}</textarea>
                    @endbylang
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    @bylang(['id'=>'form_content2', 'tp_classes'=>'little-p', 'title'=>'Описание'])
                    <textarea name="desc[{!! $iso !!}]"
                              class="ckeditor">{!! old('desc.'.$iso, tr($item, 'desc', $iso)) !!}</textarea>
                    @endbylang
                </div>
            </div>

        </div>
        @seo(['item'=>$item])@endseo
        <div class="col-12 save-btn-fixed">
            <button type="submit"></button>
        </div>
    </form>
@endsection

@push('js')
    @ckeditor
@endpush
