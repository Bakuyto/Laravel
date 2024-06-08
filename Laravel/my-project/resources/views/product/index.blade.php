@extends('layout.backend')
@section('content')
<a class="btn btn-primary" href="{{url('/product/create')}}">New</a>
<br><br>
@if (count($products) > 0 )
        <table class="table table-bordered" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{!! $product->id !!}</td>
                    <td>{!! $product->name !!}</td>
                    <td>{!! $product->description !!}</td>
                    <td><img src="{{asset('img/'.$product->image)}}" width="60" alt=""></td>
                    <td>{!! $product->price !!} $</td>
                    <td><a href="{!! url('product/'. $product->id . '/edit') !!}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form id="delete-form-{{ $product->id }}" action="{{ route('product.destroy', ['product' => $product->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $product->id }}">Delete</button>
                        </form>
                           
                    </td> 
                    
                    <!-- Modal -->
                    <div class="modal fade" id="confirmDeleteModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel{{ $product->id }}">Confirm Delete</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this product?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" onclick="document.getElementById('delete-form-{{ $product->id }}').submit();">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <script>
                        function deleteProduct(ProductId) {
                            var form = document.getElementById('delete-form-' + ProductId);
                            form.submit();
                        }
                    </script>                         
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
@endsection
