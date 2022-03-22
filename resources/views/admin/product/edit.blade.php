@extends('layouts.app')

@section('content')
    <div class="container admin-area">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Edit product') }}</h3>
                        <div>
                            <a href="{{route('admin.products.index')}}">Back to products</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.products.update', ['product' => $product]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $product->id }}">

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $product->title }}" required autocomplete="title" autofocus>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category_id" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>
                                <div class="col-md-6">
                                    <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if($product->category_id == $category->id) selected @endif >{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="thumbnail" class="col-md-4 col-form-label text-md-end">{{ __('Thumbnail') }}</label>
                                <div class="col-md-1">
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" id="thumbnail-preview" width="70" />
                                </div>
                                <div class="col-md-5">
                                    <input id="thumbnail" type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail">
                                    @error('thumbnail')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="sku" class="col-md-4 col-form-label text-md-end">{{ __('SKU') }}</label>
                                <div class="col-md-6">
                                    <input id="sku" type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" value="{{ $product->sku }}" required>
                                    @error('sku')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" required>
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="discount" class="col-md-4 col-form-label text-md-end">{{ __('Discount') }}</label>
                                <div class="col-md-6">
                                    <input id="discount" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ $product->discount }}" required>
                                    @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="in_stock" class="col-md-4 col-form-label text-md-end">{{ __('In stock') }}</label>
                                <div class="col-md-6">
                                    <input id="sku" type="text" class="form-control @error('in_stock') is-invalid @enderror" name="in_stock" value="{{ $product->in_stock }}" required>
                                    @error('in_stock')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="short_description" class="col-md-4 col-form-label text-md-end">{{ __('Short description') }}</label>
                                <div class="col-md-6">
                                    <textarea name="short_description" class="form-control short_description @error('short_description') is-invalid @enderror" rows="10">{{ $product->short_description }}</textarea>
                                    @error('short_description')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                                <div class="col-md-6">
                                    <textarea name="description" class="form-control description @error('description') is-invalid @enderror" rows="10">{{ $product->description }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="images" class="col-md-4 col-form-label text-md-end">{{ __('Images') }}</label>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row images-wrapper">
                                                @foreach($product->images as $image)
                                                    <div class="col-sm-4 d-flex justify-content-center align-items-center">
                                                        <img src="{{ asset('storage/' . $image->path) }}" class="card-img-top" style="max-width: 80%; margin: 0 auto; display: block;">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror" onChange="readMultiFiles" id="images" multiple>
                                            @error('images')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update product') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/images-preview.js') }}" defer></script>
@endpush
