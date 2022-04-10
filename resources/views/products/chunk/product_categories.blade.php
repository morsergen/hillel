<div class="col-md-3 products_categories">
    <div class="item">
        <p><img src="{{ asset('storage/' . $product->thumbnail) }}" width="100%" /></p>
        <p>{{ $product->title }}</p>
        <p>
            &#8372; {{ $product->end_price }}
            @if($product->discount)
                (скидка {{ $product->discount }}%)
            @endif
        </p>
        <p>{{ $product->short_description }}</p>
        <a href="{{ route('products.show', $product) }}">Show</a>
        @include('chunks.wish_list')
    </div>
</div>

