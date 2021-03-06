@if(count($gallery??[]))
    <div class="video-gallery row row-grid pt-s">
        @foreach($gallery as $video)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="force-4-3 gallery-video">
                    <div class="video-player" data-id="{{ $video->video }}">
                        <div class="video-data loaded">
                            <div class="video-thumbnail" style="background-image: url('https://i.ytimg.com/vi/{{ $video->video }}/hqdefault.jpg');"></div>
                            <button class="video-play-button" aria-label="Play">
                                <svg height="100%" version="1.1" viewBox="0 0 68 48" width="100%"><path class="play-icon" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#212121" fill-opacity="0.8"></path><path d="M 45,24 27,14 27,34" fill="#fff"></path></svg>
                            </button>
                        </div>
                        <span class="video-loader"></span>
                    </div>
                </div>
            </div>
        @endforeach
        @if (empty($skip_plugins))
            @push('js')
                @js(aSite('js/video.js'))
            @endpush
        @endif
    </div>
@endif