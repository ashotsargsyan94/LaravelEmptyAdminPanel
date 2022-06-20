<div class="product bp" data-id="{{ $item->id }}" data-price="{{ $item->price }}">
    <div class="product-image">
        <a href="{{ $product_url = route('product', ['url'=>$item->url]) }}" class="force-16-9">
            <img src="{{ ($item->show_image && $item->image)?asset('u/products/'.$item->image):$info->data->product_image() }}" class="fix-right" alt="{{ $item->title }}">
        </a>
    </div>
    <div class="product-content">
        <div class="product-head">
            <div class="product-title"><a href="{{ $product_url }}" class="bp-product-title">{{ $item->title }}</a></div>
            <div class="product-price">
                @if($item->sale)
                    <div class="discounted-price"><span>{{ $item->sale }} <span class="amd"></span></span></div>
                @endif
                <div class="current-price">{{ $item->price }} <span class="amd"></span></div>
            </div>
        </div>
        @if(count($item->options))
            <div class="product-options">
                @foreach($item->options as $option)
                    <div class="product-option-col">
                        <button class="product-option bp-option{!! $option_class !!}" data-id="{{ $option->id }}">
                                        <span class="product-option-icon">
                                            <img src="{{ asset('u/product_options/'.$option->image) }}" title="{{ $option->title }}" alt="{{ $option->title }}">
                                        </span>
                            <span class="product-option-title">{{ $option->title }}</span>
                        </button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="product-foot">
        <div class="product-count">
            <div class="number-group text-right">
                <button class="number-btn number-input-minus">-</button>
                <input type="text" value="1" placeholder="" maxlength="3" class="number-input bp-count">
                <button class="number-btn number-input-plus">+</button>
            </div>
        </div>
        <div class="product-basket">
            <button class="basket-btn product-to-basket"><img src="{!! aSite('img/basket.svg') !!}" alt="basket"></button>
        </div>
    </div>
</div>