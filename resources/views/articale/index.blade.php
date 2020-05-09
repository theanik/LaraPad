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
                  Artical 
                  <a style="float: right" type="button" class="btn btn-primary" onclick="openModal()">
                    Add New
                  </a>
                </div>

                <div class="card-body">
                   

                  <table class="table table-hover" id="productTable">
                    <thead>
                      <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Title</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($articales as $key=>$item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{ $item->title }}</td>
                                <td>Action</td>
                            </tr>     
                        @endforeach
                       
                    </tbody>
                    {{-- <input type="hidden" name="hidden_page" id="hidden_page" value="1" /> --}}

                  </table> 


                </div>


                {{-- start modal --}}

                
                
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div id="formError">
                          
                        </div>
                        <form id="productForm" action="{{ route('articale.store') }}" method="POST">
                            @csrf
                            @method('POST')

                            <input type="text" name="title" value="" class="form-control" placeholder="Name"><br>
                            <textarea name="body" class="form-control"></textarea><br>
                            <select name="category_id" id="" class="form-control">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>

                       
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
    $('#modal').modal('show')
    $('#modalLabel').html('Artical')
}
</script>

@endpush