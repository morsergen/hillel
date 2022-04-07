@auth
    @if (auth()->user()->isFollover($product))
        <form action="{{ route('wishlist.delete', $product) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">&#10084;</button>
        </form>
    @else
        <form action="{{ route('wishlist.add', $product) }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-outline-danger">&#10084;</button>
        </form>
    @endif
@endauth
