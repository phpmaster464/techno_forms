@extends('layouts.app')


@section('content')


<div class="box-content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Roles</h2>
            </div>
            <div class="pull-right">
                @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Create</a>
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
                                        @php $i = 0; @endphp
                                        @foreach ($roles as $key => $role)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td >
                                                    
                                              @can('role-edit')

                                              @if($role->status == 1)

                                               <div class="switch" id="submit"> 
                                                   <input type="checkbox" checked id="switch-{{$i}}" onclick="set_role_status('{{$role->id}}');" @if($role->id == '1' || $role->id == '3') disabled @endif>
                                                   <label for="switch-{{$i}}"><!-- Switch 2 --></label>
                                               </div> 
                                               @else
                                               <div class="switch" id="submit">
                                                   <input type="checkbox" id="switch-{{$i}}" onclick="set_role_status('{{$role->id}}');" @if($role->id == '1' || $role->id == '3') disabled @endif >
                                                   <label for="switch-{{$i}}"><!-- Switch 2 --></label>
                                               </div>
                                               @endif
                                               @endcan
                                               

                                            </td>
                                            <td id="td10">
                                                @if($role->id == '1' || $role->id == '3') 
                                                @can('role-edit')
                                                <a class="btn btn-primary" href="#">Edit</a>
                                                @endcan

                                                @else
                                                @can('role-edit')
                                                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                                @endcan
                                                @endif

                                               
                                                <!-- @can('role-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
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


<!-- <div class="box-content">

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Role Management</h2>
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>




</div> -->

@endsection