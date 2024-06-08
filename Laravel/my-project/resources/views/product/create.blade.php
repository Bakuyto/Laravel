@extends('layout.backend')

@section('content')
<div class="container">
    <h1>Create Product</h1>
    @if(Session::has('product_create'))
    <div id="product-create-alert" class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('product_create') !!}
    </div>
    @endif
    @if (count($errors) > 0)
    {{-- Form Error List --}}
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

    <form action="{{ url('product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Category:</label>
            <select name="category_id" id="category_id" class="form-select">
                @foreach($categories as $categoryId => $categoryName)
                    <option value="{{ $categoryId }}" {{ old('category_id') == $categoryId ? 'selected' : '' }}>
                        {{ $categoryName }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" style="width: 100%;">
        </div>
        <br>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" style="width: 100%;" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" class="form-control" style="width: 100%;">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
    </form>
</div>

@endsection
