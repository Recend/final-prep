@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Sandeliai</div>

                    <div class="card-body">
                    <form method="post" action="{{ isset($warehouse)?route('warehouse.update',$warehouse->id):route('warehouse.store')}}">
                        @csrf
                        @if(isset($warehouse))
                        @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Pavadinimas</label>
                            <input type="text" name="name" class="form-control" value="{{isset($warehouse)?$warehouse->name:""}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Miestas</label>
                            <input type="text" name="city" class="form-control" value="{{isset($warehouse)?$warehouse->city:""}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresas</label>
                            <input type="text" name="address" class="form-control" value="{{isset($warehouse)?$warehouse->address:""}}">
                        </div>
                        <button type="submit" class="btn btn-outline-success">{{isset($warehouse)?"Redaguoti":"Pridėti"}}</button>


                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
