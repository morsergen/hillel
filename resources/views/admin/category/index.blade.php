@extends('layouts.app')

@section('content')
    <div class="container admin-area">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Categories') }} ({{$categories->count()}})</h3>
                        <div>
                            <a href="{{route('admin.categories.create')}}">Create new</a>
                        </div>
                    </div>
                    <table class="admin">
                        <tr>
                            <th>ID</th>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Count products</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td><img src="{{ asset('storage/' . $category->thumbnail) }}" width="50" /></td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->products_count }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->description }}</td>
                                <td class="actions">
                                    <a href="{{route('admin.categories.show', ['category'=> $category])}}"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('admin.categories.edit', ['category'=> $category])}}"><i class="fa fa-edit"></i></a>

                                    <a href="javascript:void(0);" onclick="document.getElementById('delete-form-{{$category->id}}').submit();">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form id="delete-form-{{$category->id}}" method="POST" style="display: none;"
                                          action="{{route('admin.categories.destroy', ['category'=> $category])}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="div_paginate">{{ $categories->links('admin/pagination/default') }}</div>
            </div>
        </div>
    </div>
@endsection
