@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Produktai</div>

                    <div class="card-body">
                    <form method="post" action="{{ isset($product)?route('products.update',$product->id):route('products.store')}}">
                        @csrf
                        @if(isset($product))
                        @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Pavadinimas</label>
                            <input  type="text" name="name" class="form-control @if ($errors->has('name')) is-invalid @endif" value="{{isset($product)?$product->name:""}}">
                            @if($errors->has('name'))
                                @foreach($errors->get('name') as $error)
                                   <div class="alert alert-danger">{{ $error }} </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kiekis</label>
                            <input type="number" name="quantity" class="form-control @if ($errors->has('quantity')) is-invalid @endif" value="{{isset($product)?$product->quantity:""}}">
                            @if($errors->has('quantity'))
                                @foreach($errors->get('quantity') as $error)
                                    <div class="alert alert-danger">{{ $error }} </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kaina</label>
                            <input type="number" name="price" class="form-control @if ($errors->has('price')) is-invalid @endif" value="{{isset($product)?$product->price:""}}">
                            @if($errors->has('price'))
                                @foreach($errors->get('price') as $error)
                                    <div class="alert alert-danger">{{ $error }} </div>
                                @endforeach
                            @endif
                        </div>
                        <label class="form-label">Sandelys</label>
                        <select class="form-select mb-3" name="warehouse_id">
                            @foreach($warehouses as $warehouse)
                                <option value="{{$warehouse->id}}"{{ isset($product)&&($warehouse->id==$product->warehouse_id)?'selected':"" }} >{{$warehouse->name}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-outline-success">{{isset($product)?"Redaguoti":"Pridėti"}}</button>
                        <a class="btn btn-outline-primary float-end" href="{{route('products.index')}}">Atgal</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
