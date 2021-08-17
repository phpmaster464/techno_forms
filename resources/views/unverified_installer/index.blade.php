@extends('layouts.app')


@section('content')



<div class="box-content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Unverified Installer</h2>
            </div>
            <div class="pull-right">
                
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
                                            <th>Name</th>                                            
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Postal Address </th>
                                            <th>Verified</th> 
                                            <th>View</th>
                                            <!-- <th>Delete</th>  -->
                                        </tr>
                                    </thead>
                                   <tbody>
                                        @php $i = 0; @endphp

                                        @foreach ($unverified_installers as $unverified_installer)
                                        @php ++$i; 
                                        @endphp
                                        <tr>
                                        
                                            <td id="td2">{{$unverified_installer->first_name.' '.$unverified_installer->last_name}}</td>
                                            <td id="td8">{{$unverified_installer->email}}</td>
                                            <td id="td8">{{$unverified_installer->phone}}</td>
                                            <td id="td8">{{$unverified_installer->postaladdress}}</td>                                           
                                            <td id="td9" >
                                                    



                                                @can('unverifiedinstaller-edit')
        
                                                @if($unverified_installer->verified == 1)

                                                 <div class="switch" id="submit" > 
                                                     <input type="checkbox" class="switch_unv_installer" checked id="switch-{{$i}}" onclick="set_unverified_installer_status('{{$unverified_installer->id}}');"  disabled="disabled" >
                                                     <label for="switch-{{$i}}"><!-- Switch 2 --></label>
                                                 </div> 
                                                 @else
                                                 
                                                 <div class="switch" id="submit">
                                                     <input type="checkbox" id="switch-{{$i}}" onclick="set_unverified_installer_status('{{$unverified_installer->id}}');">
                                                     <label for="switch-{{$i}}"><!-- Switch 2 --></label>
                                                 </div>
                                                 @endif
                                                 @endcan
         
                                            </td>
                                            <td id="td10">
                                                @can('unverifiedinstaller-list')
                                                <a class="btn btn-primary" href="{{ route('unverified_installer.show',$unverified_installer->id) }}">View</a>
                                            @endcan</td>
                                          
                                            
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


