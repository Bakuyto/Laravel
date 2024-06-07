@extends('layout.backend')

@section('content')
<div class="container">
    <h1>Create Category</h1>
    @if(Session::has('category_create'))
    <div id="category-create-alert" class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('category_create') !!}
    </div>
    @endif
    @if (count($errors) > 0)
    {{-- Form Error List --}}
    <div id="category-create-error" class="alert alert-danger">
        <strong class="h5 fw-bold">Something is Wrong!!!</strong>
        <br><br>
        
        <ul>
            @foreach ($errors->all() as $error)
            <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ url('category') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" style="width: 100%;">
        </div>
        <br>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" style="width: 100%;" rows="5"></textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('category.list') }}" class="btn btn-primary">Back</a>
    </form>
</div>

@endsection
