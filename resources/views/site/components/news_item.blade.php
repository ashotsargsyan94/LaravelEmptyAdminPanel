<div class="news-item">
    <div class="news-item-image"><a href="{{ route('news', ['url'=>$item->url]) }}" class="force-4-3"><img src="{{ asset('u/news/'.$item->image) }}" alt="{{ $item->title }}"></a></div>
    <div class="news-item-content">
        <div class="news-item-date">{{ $item->created_at->format('d.m.Y') }}</div>
        <div class="news-item-title"><a href="{{ route('news', ['url'=>$item->url]) }}">{{ $item->title }}</a></div>
        <div class="news-item-description">{{ $item->short }}</div>
    </div>
</div>