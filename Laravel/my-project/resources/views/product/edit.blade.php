@extends('layout.backend')

@section('content')
<div class="container">
    <h1>{{ isset($product) ? 'Edit Product' : 'Create Product' }}</h1>
    
    @if(Session::has('product_create'))
    <div id="product-create-alert" class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('product_create') !!}
    </div>
    @endif

    @if(Session::has('product_update'))
    <div id="product-update-alert" class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Success!</strong> {!! session('product_update') !!}
    </div>
    @endif

    @if (count($errors) > 0)
    <div id="product-create-error" class="alert alert-danger">
        <strong class="h5 fw-bold">Something is Wrong!!!</strong>
        <br><br>
        
        <ul>
            @foreach ($errors->all() as $error)
            <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ isset($product) ? route('product.update', $product->id) : route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" id="category_id" class="form-select">
                @foreach($categories as $categoryId => $categoryName)
                    <option value="{{ $categoryId }}" {{ (isset($product) && $product->category_id == $categoryId) ? 'selected' : (old('category_id') == $categoryId ? 'selected' : '') }}>
                        {{ $categoryName }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" style="width: 100%;" value="{{ isset($product) ? $product->name : old('name') }}">
        </div>
        <br>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" style="width: 100%;" rows="5">{{ isset($product) ? $product->description : old('description') }}</textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="image">Image:</label>
            @if(isset($product) && $product->image)
                <div>
                    <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}" width="100">
                </div>
                <br>
            @endif
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <br>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" class="form-control" style="width: 100%;" value="{{ isset($product) ? $product->price : old('price') }}">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Create' }}</button>
        <a href="{{ route('product.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
