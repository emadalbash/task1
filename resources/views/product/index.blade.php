@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Products</div>

                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col"> Product Name</th>
                                <th scope="col"> Product Photo</th>
                                <th scope="col"> Category Name</th>
                                <th scope="col"> Edit</th>
                                <th scope="col"> Delete</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)

                                <tr>
                                    <th scope="row">{{$product->id}}</th>
                                    <td>{{$product->name}}</td>
                                    <td><img src="{{$product->photo}}" alt="{{$product->name}}" class="img-thumbnail" height="100px" width="100px"></td>
                                    <td>{{$product->category->name}}</td>
                                    <td></th><a href="{{route('product.edit',$product->id)}}"><i class="far fa-edit"></i></a></td>
                                    <td></th><a href="{{route('product.delete',$product->id)}}"><i class="far fa-trash-alt"></i></a></td>



                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
