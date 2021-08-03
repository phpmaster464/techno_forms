@extends('layouts.app')


@section('content')
<div class="box-content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Installer</h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('installer.create') }}"> Create</a>
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
                        <!-- <h4 class="box-title">Company</h4> -->
                        <!-- /.box-title -->
                       
                        <!-- /.dropdown js__dropdown -->
                        <!-- <table id="company_table" class="table table-striped table-bordered display" style="width:100%"> -->
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th> 
                                            <th>Roles</th>
                                            <th>Created By </th>
                                            <th>Updated By </th>
                                            <th>Status</th> 
                                            <th>Edit</th>
                                            <!-- <th>Delete</th>  -->
                                        </tr>
                                    </thead>
                                   <tbody>
                                        @php $i = 0; @endphp
                                        @foreach ($installers as $installer)
                                        @php ++$i; 
                                        $roles = json_decode($installer->installer_job_type);
                                        $role_types = implode(",",$roles);
                                        @endphp
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td id="td2">{{$installer->first_name.' '.$installer->last_name}}</td>
                                            <td id="td3">{{$role_types}}</td>
                                            <td id="td8">{{$installer->created_by}}</td>
                                            <td id="td8">{{$installer->updated_by}}</td>
                                            <td id="td9"><!-- {{$installer->company_status}} -->
        
                                                @can('installer-edit')
        
                                                @if($installer->installer_status == 1)
                                                 <div class="switch" id="submit"> 
                                                     <input type="checkbox" checked id="switch-{{$i}}" onclick="set_installer_status('{{$installer->id}}');">
                                                     <label for="switch-{{$i}}"><!-- Switch 2 --></label>
                                                 </div> 
                                                 @else
                                                 <div class="switch" id="submit">
                                                     <input type="checkbox" id="switch-{{$i}}" onclick="set_installer_status('{{$installer->id}}');">
                                                     <label for="switch-{{$i}}"><!-- Switch 2 --></label>
                                                 </div>
                                                 @endif
                                                 @endcan
        
                                            </td>
                                            <td id="td10"><!-- <a class="btn btn-info" href="{{ route('installer.show',$installer->id) }}">Show</a> -->
                                                @can('installer-edit')
                                                <a class="btn btn-primary" href="{{ route('installer.edit',$installer->id) }}">Edit</a>
                                            @endcan</td>
                                           <!--  <td id="td11"><form action="{{ route('installer.destroy',$installer->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                @can('product-delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                @endcan
                                            </form></td> -->
                                            
                                        </tr>
                                         @endforeach
                                        
                                    </tbody>
                                </table>
                                
                            </div>
                    </div>
                    <!-- /.box-content -->
                </div>
                
            </div>

   <!--  <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($installers as $installer)



        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $installer->company_name }}</td>
            <td>{{ $installer->company_primary_email }}</td>
            <td>
                <form action="{{ route('installer.destroy',$installer->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('installer.show',$installer->id) }}">Show</a>
                    @can('product-edit')
                    <a class="btn btn-primary" href="{{ route('installer.edit',$installer->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table> -->


  
 
</div>

@endsection