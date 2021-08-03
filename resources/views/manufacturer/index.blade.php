@extends('layouts.app')


@section('content')


<div class="box-content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Manufacturer</h2>
            </div>
            <div class="pull-right">
                @can('manufacturer-create')
            <a class="btn btn-success" href="{{ route('manufacturer.create') }}"> Create</a>
            @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

     @if ($message = Session::get('error'))
        <div class="alert alert-error">
            <p style="color:red;">{{ $message }}</p>
        </div>
    @endif
 

    <!-- Table -->
            <div class="row small-spacing">
                <div class="col-xs-12">
                    <div class="box-content">
                        <!-- <h4 class="box-title">Company</h4> -->
                        <!-- /.box-title -->
                       
                        <!-- /.dropdown js__dropdown -->
                        <!-- <table id="company_table" class="table table-striped table-bordered display" style="width:100%"> -->
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Type</th>
                                            <th>Status</th> 
                                            <th>Edit</th>
                                            <!-- <th>Delete</th>  -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0;
                                        $all_manufacturer = $manufacturer;
                                        @endphp

                                        @foreach ($all_manufacturer as $key => $manufacturer)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $manufacturer->manufacturer_name }}</td>
                                            <td >
                                                    

                                              @if($manufacturer->status == 1)

                                               <div class="switch" id="submit"> 
                                                   <input type="checkbox" checked id="switch-{{$i}}" onclick="set_manufacturer_status('{{$manufacturer->id}}');" >
                                                   <label for="switch-{{$i}}"><!-- Switch 2 --></label>
                                               </div> 
                                               @else
                                               <div class="switch" id="submit">
                                                   <input type="checkbox" id="switch-{{$i}}" onclick="set_manufacturer_status('{{$manufacturer->id}}');">
                                                   <label for="switch-{{$i}}"><!-- Switch 2 --></label>
                                               </div>
                                               @endif
                                          
                                               

                                            </td>
                                            <td id="td10">
                                                
                                                @can('manufacturer-edit')
                                                <a class="btn btn-primary" href="{{ route('manufacturer.edit',$manufacturer->id) }}">Edit</a>
                                                @endcan
                                                <!-- @can('manufacturer-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['manufacturer.destroy', $manufacturer->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                                @endcan -->
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