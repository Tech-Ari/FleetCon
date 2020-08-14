@extends('admin')
@section('section')

{{-- {{$products}} --}}
<section class="content">
    <div class="card card-success">
        <div class="card-header">
            <h3>All Products.</h3>
        </div>
        <div class="card-body">
            <div>
                <a href="/add-product" type="button" class="btn  btn-success"> <i class="fa fa-user"></i> Add Product</a>
            </div>
            <div style="text-align: clear"></div>
            <br>
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Unit of Measure</th>
                                    <th>Symbol</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->unit_of_measure}}</td>
                                    <td>{{$product->symbol}}</td>
                                    <td>
                                        <div class="btn-group">
                                            
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="{{"#editproduct".$product->id}}"><i class="fas fa-edit"> Edit</i></button>
                                            
                                            {{-- Modal To Edit Goes Here. --}}
                                            
                                            {!! Form::open(['action' => ['ProductController@update', $product->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                                            <div class="modal fade" id="{{"editproduct".$product->id}}" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <input type="hidden" name="idProduct" value="{{$product->id}}">
                                                            <h4 class="modal-title">Update product: {{$product->name}}</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                                                                <div class="col-sm-8">
                                                                    {{Form::text('name', $product['name'], ['class' => 'form-control'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="inputId" class="col-sm-3 col-form-label">Unit of Measure</label>
                                                                <div class="col-sm-8">
                                                                    {{Form::text('unit_of_measure', $product['unit_of_measure'], ['class' => 'form-control'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="inputPhone" class="col-sm-3 col-form-label">Phone</label>
                                                                <div class="col-sm-8">
                                                                    {{Form::text('symbol', $product['symbol'], ['class' => 'form-control'])}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            {{Form::hidden('_method','PUT')}}
                                                            {{ csrf_field() }}
                                                            {{Form::submit('Update', ['class' => 'btn btn-success '])}}
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}

                                            &nbsp;&nbsp;
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="{{"#deleteproduct".$product->id}}"><i class="fas fa-trash"> Delete</i></button>

                                            {{-- Modal To Delete Goes Here --}}

                                            <div class="modal fade" id="{{"deleteproduct".$product->id}}" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete product : {{$product->name}}</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5 class="text-center">Are You Sure You Want To Delete product {{$product->name}} ?</h5>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <form action="/deleteProduct" method="POST">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="idProduct" value="{{$product->id}}">
                                                                <button type="submit" class="btn btn-danger fa fa-trash-o "> Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection