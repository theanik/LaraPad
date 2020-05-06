@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card-header">
                  Category 
                  <a style="float: right" type="button" class="btn btn-primary" onclick="openModal()">
                    Add New
                  </a>
                </div>

                <div class="card-body">
                   

                  <table class="table table-hover" id="productTable">
                    <thead>
                      <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $key=>$item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>Action</td>
                            </tr>     
                        @endforeach
                       
                    </tbody>
                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

                  </table> 


                </div>


                {{-- start modal --}}

                
                
                <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div id="formError">
                          
                        </div>
                        <form id="productForm" action="{{ route('category.store') }}" method="POST">
                            @csrf
                            @method('POST')

                          <input type="text" name="name" value="" class="form-control" placeholder="Name"><br>
                       
                          <button type="submit" class="btn btn-primary">Submit</button>
                          <button type="reset" class="btn btn-secoundry">Reset</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                {{-- end modal --}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>

function openModal(){
    $('#productModal').modal('show')
    $('#productModalLabel').html('Add Category')
}
</script>

@endpush