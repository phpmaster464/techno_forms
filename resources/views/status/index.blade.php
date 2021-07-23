@extends('layouts.app')


@section('content')


<div class="box-content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Status</h2>
            </div>
            <div class="pull-right">
                @can('status-create')
            <a class="btn btn-success" href="{{ route('status.create') }}"> Create</a>
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
                                        $all_status = $status;
                                        @endphp

                                        @foreach ($all_status as $key => $status)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $status->name }}</td>
                                            <td >
                                                    
                                              @can('status-edit')

                                              @if($status->status == 1)

                                               <div class="switch" id="submit"> 
                                                   <input type="checkbox" checked id="switch-{{$i}}" onclick="set_status_status('{{$status->id}}');" >
                                                   <label for="switch-{{$i}}"><!-- Switch 2 --></label>
                                               </div> 
                                               @else
                                               <div class="switch" id="submit">
                                                   <input type="checkbox" id="switch-{{$i}}" onclick="set_status_status('{{$status->id}}');">
                                                   <label for="switch-{{$i}}"><!-- Switch 2 --></label>
                                               </div>
                                               @endif
                                               @endcan
                                               

                                            </td>
                                            <td id="td10">
                                                
                                                @can('status-edit')
                                                <a class="btn btn-primary" href="{{ route('status.edit',$status->id) }}">Edit</a>
                                                @endcan
                                                <!-- @can('status-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['status.destroy', $status->id],'style'=>'display:inline']) !!}
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