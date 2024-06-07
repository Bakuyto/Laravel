@extends('layout.backend')
@section('content')
<a class="btn btn-primary" href="{{url('/category/create')}}">New</a>
<br><br>
@if (count($categories) > 0 )
        <table class="table table-bordered" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{!! $category->id !!}</td>
                    <td>{!! $category->name !!}</td>
                    <td>{!! $category->description !!}</td>
                    <td><a href="{!! url('category/'. $category->id . '/edit') !!}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form id="delete-form-{{ $category->id }}" action="{{ route('category.destroy', ['categoryId' => $category->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $category->id }}">Delete</button>
                        </form>   
                    </td> 
                    
                    <!-- Modal -->
                    <div class="modal fade" id="confirmDeleteModal{{ $category->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel{{ $category->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel{{ $category->id }}">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this category?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" onclick="deleteCategory('{{ $category->id }}')">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <script>
                        function deleteCategory(categoryId) {
                            var form = document.getElementById('delete-form-' + categoryId);
                            form.submit();
                        }
                    </script>                         
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
@endsection
