@extends('layouts.app')


@section('content')
<div class="box-content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Company</h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('company.create') }}"> Create</a>
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
                                            <th>Code</th>
                                            <th>Name</th> 
                                            <!-- <th>Logo </th> -->
                                            <th>Primary Email Address</th>
                                            <!-- <th>Secondary Email Address </th> -->
                                            <th>Contact Number</th>
                                            <th>Website</th>
                                            <th>Created By </th>
                                            <th>Updated By </th>
                                            <!-- <th>Creation Date </th>
                                            <th>Updated date</th> -->
                                            <th>Status</th> 
                                            <th>Edit</th>
                                            <!-- <th>Delete</th>  -->
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Logo </th>
                                            <th>Primary Email Address</th>
                                            <th>Secondary Email Address </th>
                                            <th>Contact Number</th>
                                            <th>Website</th>
                                            <th>Description </th>
                                            <th>Code</th>
                                            <th>Creation Date </th>
                                            <th>Updated date</th>
                                            <th>Status</th> 
                                        </tr>
                                    </tfoot> -->
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach ($companies as $company)
                                        @php ++$i; @endphp
                                        <tr>
                                            <td id="td1">{{$company->company_code}}</td>
                                            <td id="td2">{{$company->company_name}}</td>
                                            <!-- <td id="td3">{{$company->company_logo}}</td> -->
                                            <td id="td4">{{$company->company_primary_email}}</td>
                                            <!-- <td id="td5">{{$company->company_secondary_email}}</td> -->
                                            <td id="td6">{{$company->company_contact_number}}</td>
                                            <td id="td7">{{$company->company_website}}</td>
                                            <td id="td8">{{$company->created_by}}</td>
                                            <td id="td8">{{$company->updated_by}}</td>
                                            <td id="td9"><!-- {{$company->company_status}} -->
        
                                                @can('company-edit')
        
                                                @if($company->company_status == 1)
                                                 <div class="switch" id="submit"> 
                                                     <input type="checkbox" checked id="switch-{{$i}}" onclick="set_company_status('{{$company->id}}');">
                                                     <label for="switch-{{$i}}"><!-- Switch 2 --></label>
                                                 </div> 
                                                 @else
                                                 <div class="switch" id="submit">
                                                     <input type="checkbox" id="switch-{{$i}}" onclick="set_company_status('{{$company->id}}');">
                                                     <label for="switch-{{$i}}"><!-- Switch 2 --></label>
                                                 </div>
                                                 @endif
                                                 @endcan
        
                                            </td>
                                            <td id="td10"><!-- <a class="btn btn-info" href="{{ route('company.show',$company->id) }}">Show</a> -->
                                                @can('company-edit')
                                                <a class="btn btn-primary" href="{{ route('company.edit',$company->id) }}">Edit</a>
                                            @endcan</td>
                                           <!--  <td id="td11"><form action="{{ route('company.destroy',$company->id) }}" method="POST">
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
        @foreach ($companies as $company)



        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $company->company_name }}</td>
            <td>{{ $company->company_primary_email }}</td>
            <td>
                <form action="{{ route('company.destroy',$company->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('company.show',$company->id) }}">Show</a>
                    @can('product-edit')
                    <a class="btn btn-primary" href="{{ route('company.edit',$company->id) }}">Edit</a>
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