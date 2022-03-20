@extends('layouts.app')

@section('content')
    <div class="container admin-area">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Category') }}</h3>
                        <div>
                            <a href="{{route('admin.categories.index')}}">Back to categories</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">ID</div>
                            <div class="col-sm-10">{{ $category->id }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">Name</div>
                            <div class="col-sm-10">{{ $category->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">Slug</div>
                            <div class="col-sm-10">{{ $category->slug }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">Description</div>
                            <div class="col-sm-10">{{ $category->description }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
