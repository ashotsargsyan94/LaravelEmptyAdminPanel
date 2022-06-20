<div class="form-group">
    <div class="bylang-header">
        <div class="bylang-title has-title">{{ $label??null }}</div>
    </div>
    <div class="little-p">
        <textarea class="ckeditor" name="{{ $key }}[{!! $count !!}][{{ $as }}]">{!! $value !!}</textarea>
    </div>
</div>