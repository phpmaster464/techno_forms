@extends('layouts.app')


@section('content')
<div class="box-content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Jobs</h2>
            </div>
            <div class="pull-right">
                @can('job-create')
                <a class="btn btn-success" href="{{ route('job.create') }}"> Create</a>
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
                                            <th>Job Type</th>
                                            <th>Reference Number</th>
                                            <th>Installation Date</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th> 
                                            <th>Created By </th>
                                            <th>Updated By </th> 
                                            <th>Status</th> 
                                            <th>Edit</th>
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
                                        @foreach ($jobs as $job)
                                        @php ++$i; @endphp
                                        <tr>
                                            <td id="td1">{{$job->job_type}}</td>
                                            <td id="td2">{{$job->reference_number}}</td>
                                            <td id="td3">{{$job->installation_date}}</td> 
                                            <td id="td4">{{$job->first_name}}</td>
                                            <td id="td5">{{$job->last_name}}</td>
                                            <td id="td6">{{$job->email}}</td>
                                            <td id="td7">{{$job->phone}}</td>
                                            <td id="td8">{{$job->created_by}}</td>
                                            <td id="td8">{{$job->updated_by}}</td>
                                            <td id="td9"><!-- {{$job->job_status}} -->
        
                                                @can('job-edit')
        
                                                @if($job->job_status == "1")
                                                 <div class="switch" id="submit"> 
                                                     <input type="checkbox" checked id="switch-{{$i}}" onclick="set_job_status('{{$job->id}}');">
                                                     <label for="switch-{{$i}}"><!-- Switch 2 --></label>
                                                 </div> 
                                                 @else
                                                 <div class="switch" id="submit">
                                                     <input type="checkbox" id="switch-{{$i}}" onclick="set_job_status('{{$job->id}}');">
                                                     <label for="switch-{{$i}}"><!-- Switch 2 --></label>
                                                 </div>
                                                 @endif
                                                 @endcan
        
                                            </td>
                                            <td id="td10">
                                            @can('job-edit')
                                                <a class="btn btn-primary" href="{{ route('job.edit',$job->id) }}">Edit</a>
                                            @endcan
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