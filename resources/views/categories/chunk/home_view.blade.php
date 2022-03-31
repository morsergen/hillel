<div class="col-md-3 categories_home_view">
    <div class="item">
        <p><img src="{{ asset('storage/' . $category->thumbnail) }}" width="100%" /></p>
        <p>{{ $category->name }} ({{ $category->products()->count() }})</p>
        <p>{{ $category->description }}</p>
        <a href="{{ route('categories.show', $category) }}">show</a>
    </div>
</div>

