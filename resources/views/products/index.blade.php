@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Produktai</div>

                    <div class="card-body">
                        @can('edit')
                        <a href="{{route('products.create')}}" class="btn btn-outline-success">Pridėti nauja</a>
                        @endcan
                        <hr>
                        <h5>Produktų filtravimas</h5>
                        <form method="post" action="{{ route('products.filter') }}">
                            @csrf
                            <div class="mb-3">
                                    <label>Pasirinkite sandelį</label>
                                <select class="form-select" name="warehouse_id">
                                    <option value="" {{ isset($filter_warehouse_id)&&($filter_warehouse_id==null)?'selected':'' }}>-</option>
                                    @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}" {{isset($filter_warehouse_id)&&($filter_warehouse_id==$warehouse->id)?'selected':'' }}>{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-outline-success">Filtruoti</button>
                        </form>
                        <hr>
                        <h5>Produktų paieška</h5>
                        <form method="post" action="{{ route('products.find') }}">
                            @csrf
                            <div class="mb-3">
                                <label>Ieškoti pagal pavadinimą</label>
                                <input name="name" type="text" value="@if(isset($findProduct)){{ $findProduct }} @endif" class="form-control">
                                <label>Ieškoti pagal kiekį</label>
                                <input name="quantity" type="number" value="@if(isset($findQuantity)){{ $findQuantity }} @endif" class="form-control">
                            </div>
                                <button class="btn btn-outline-success">Ieškoti</button>
                        </form>
                     <table class="table">
                         <thead>
                         <tr>
                            <th>
                                <a href="{{ route('products.order', 'name') }}">Pavadinimas @if(isset($orderBy)&&$orderBy=='name')
                                        {!!  ($orderDirection=='DESC')?'&uparrow;':'&downarrow;' !!}
                                    @endif</a>
                            </th>
                             <th>
                                 <a href="{{ route('products.order', 'quantity') }}">Kiekis
                                     @if(isset($orderBy)&&$orderBy=='quantity')
                                         {!!  ($orderDirection=='DESC')?'&uparrow;':'&downarrow;' !!}
                                     @endif</a>
                             </th>
                             <th>
                                 <a href="{{ route('products.order','price') }}">Kaina
                                     @if(isset($orderBy)&&$orderBy=='price')
                                         {!!($orderDirection=='DESC')?'&uparrow;':'&downarrow;' !!}
                                     @endif</a>
                             </th>
                             <th>
                                 <a href="{{ route('products.order', 'warehouse_id') }}">Sandelys
                                     @if(isset($orderBy)&&$orderBy=='warehouse_id')
                                         {!! ($orderDirection=='DESC')?'&uparrow;':'&downarrow;' !!}
                                     @endif</a>
                             </th>
                             @can('edit')
                             <th colspan="2">Veiksmai</th>
                             @endcan
                         </tr>
                         </thead>
                         <tbody>
                         @foreach($products as $product)
                         <tr>
                             <td>{{ $product->name }}</td>
                             <td>{{ $product->quantity }}</td>
                             <td>{{ $product->price }}</td>
                             <td>{{$product->warehouse->name}}</td>
                             @can('edit')
                             <td>
                                 <a href="{{route('products.edit', $product->id)}}" class="btn btn-outline-success">Redaguoti</a>
                             </td>
                             <td>
                                 <form method="post" action="{{ route('products.destroy',$product->id) }}">
                                     @csrf
                                     @method('DELETE')
                                     <button class="btn btn-outline-danger">Ištrinti</button>

                                 </form>
                             </td>
                             @endcan
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
