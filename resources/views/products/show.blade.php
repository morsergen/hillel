@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h1>{{ $product->title }}</h1>
        </div>
        <div class="col-md-3">
            @auth
                <form class="form-horizontal" action="{{ route('rating.add', $product) }}" id="addStar" method="POST">
                    @csrf
            @endauth
                    <div class="form-group required poststars">
                        <div class="col-sm-12 stars">
                            @for($i = 1; $i <= 5; $i++)
                                <input class="star star-{{$i}}" value="{{$i}}" id="star-{{$i}}" type="radio" name="star"
                                       @isset($product->average_rating)
                                       {{ $i == round($product->average_rating) ? 'checked' : '' }}
                                       @endisset
                                />
                                <label class="star star-{{$i}}" for="star-{{$i}}">
                                    <i class="far fa-star {{ $i <= round($product->average_rating) ? 'checked' : '' }}"></i>
                                </label>
                            @endfor
                        </div>
                    </div>
            @auth
                </form>
            @endauth
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <p><img src="{{ asset('storage/' . $product->thumbnail) }}" width="100%" /></p>
        </div>
        <div class="col-md-6">
            <h1>
                {{ $product->end_price }}
                @if($product->discount)
                    (скидка {{ $product->discount }}%)
                @endif
            </h1>
            <hr>
            <h4>
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <input type="number" name="product_count" value="1" min="1" max="{{ $product->in_stock }}" />
                            <button type="submit" class="btn btn-success">добавить в корзину</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        @include('chunks.wish_list')
                    </div>
                </div>
            </h4>
            <hr>
            <p>Категория:
                <strong>
                    <a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a>
                </strong>
            </p>
            <p>SKU: <strong>{{ $product->sku }}</strong></p>
            <p>В наличии: <strong>{{ $product->in_stock }}</strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>{{ $product->description }}</h3>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function () {
            $('#addStar').change('.star', function () {
                $(this).submit();
            });
        });
    </script>
@endpush
