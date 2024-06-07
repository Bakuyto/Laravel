@extends('layout.backend')

@section('content')
<div class="container">
    <h1>Create Category</h1>
    @if(Session::has('category_update'))
    <div id="category-update-alert" class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Success!</strong> {!! session('category_update') !!}
    </div>
    @endif
    @if (count($errors) > 0)
    {{-- Form Error List --}}
    <div id="category-update-error" class="alert alert-danger">
        <strong class="h5 fw-bold">Something is Wrong!!!</strong>
        <br><br>
        
        <ul>
            @foreach ($errors->all() as $error)
            <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" method="POST">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" style="width: 100%;" value="{{ isset($category) ? $category->name : '' }}">
        </div>
        <br>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" style="width: 100%;" rows="5">{{ isset($category) ? $category->description : '' }}</textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Create' }}</button>
        <a href="{{ route('category.list') }}" class="btn btn-primary">Back</a>
    </form>
</div>

@endsection
