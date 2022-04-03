@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @each('categories.chunk.home_view', $categories, 'category')
        </div>
    </div>
</div>
@endsection
