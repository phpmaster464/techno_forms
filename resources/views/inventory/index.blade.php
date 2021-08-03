@extends('layouts.app')


@section('content')
<div class="box-content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Inventories</h2>
            </div>
            <div class="pull-right">
                @can('job-create')
                <a class="btn btn-success" href="{{ route('inventory.create') }}"> Create</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <!-- Table -->
            <div class="row small-spacing">
                <div class="col-xs-12">
                    <div class="box-content">
                    
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sr no </th>
                                            <th>Manufacturer</th>
                                            <th>Model</th>
                                            <th>Supplier</th>
                                            <th>Pallet No</th>
                                            <th>Pallet Serials</th>
                                            <th>Wattage</th> 
                                            <th>Created By </th>
                                            <th>Updated By </th> 
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @php $i = 0; @endphp
                                        @foreach ($inventories as $inventory)
                                        @php ++$i; @endphp
                                        <tr>
                                            <td id="td1">{{$i}}</td>
                                            <td id="td2">{{$inventory->Manufacturer}}</td>
                                            <td id="td3">{{$inventory->Model}}</td> 
                                            <td id="td4">{{$inventory->Supplier}}</td>
                                            <td id="td5">{{$inventory->pallet_number}}</td>
                                            <td id="td6">{{$inventory->unverified_panel_serials}}</td>
                                            <td id="td7">{{$inventory->wattage}}</td>
                                            <td id="td8">{{$inventory->created_by}}</td>
                                            <td id="td8">{{$inventory->updated_by}}</td>
                                         
                                            <td id="td10">
                                            
                                                <a class="btn btn-primary" href="{{ route('inventory.edit',$inventory->id) }}">Edit</a>
                                            
                                           </td>
                                            
                                        </tr>
                                         @endforeach 

                                        
                                    </tbody>
                                </table>
                                
                            </div>
                    </div>
                    <!-- /.box-content -->
                </div>
                
            </div>

</div>

@endsection