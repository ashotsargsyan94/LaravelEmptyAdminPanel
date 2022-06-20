@if(count($gallery??[]))
    <div class="photo-gallery row row-grid pt-s">
        @foreach($gallery as $image)
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <a href="{{ asset('u/gallery/'.$image->image) }}" data-fancybox="gallery" class="force-4-3">
                    <img src="{{ asset('u/gallery/thumbs/'.$image->image) }}" alt="{{ $image->alt }}" title="{{ $image->title }}">
                </a>
            </div>
        @endforeach
        @if (empty($skip_plugins))
            @push('js')
                @js(aApp('fancybox/fancybox.js'))
            @endpush
            @push('css')
                @css(aApp('fancybox/fancybox.css'))
            @endpush
        @endif
    </div>
@endif