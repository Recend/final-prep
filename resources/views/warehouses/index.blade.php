@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Sandeliai</div>

                    <div class="card-body">
                        @can('edit')
                        <a href="{{route('warehouse.create')}}" class="btn btn-outline-success">Pridėti nauja</a>
                        @endcan
                     <table class="table">
                         <thead>
                         <tr>
                            <th>Pavadinimas</th>
                             <th>Adresas</th>
                             <th>Miestas</th>
                             @can('edit')
                             <th colspan="2">Veiksmai</th>
                             @endcan
                         </tr>
                         </thead>
                         <tbody>
                         @foreach($warehouses as $warehouse)
                         <tr>
                             <td>{{ $warehouse->name }}</td>
                             <td>{{ $warehouse->address }}</td>
                             <td>{{ $warehouse->city }}</td>
                             @can('edit')
                             <td>
                                 <a href="{{route('warehouseProducts',$warehouse->id)}}" class="btn btn-outline-success">Prekės</a>
                             </td>
                             <td>
                                 <a href="{{route('warehouse.edit', $warehouse->id)}}" class="btn btn-outline-success">Redaguoti</a>
                             </td>
                             <td>
                              <form method="post" action="{{ route('warehouse.destroy',$warehouse->id) }}">
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
