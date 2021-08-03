@extends('layouts.app')


@section('content')

<div class="row ">


    <div class="col-lg-8 col-xs-12">
                    <div class="box-content card white">
                        <h4 class="box-title">Company Detailes</h4>
                        <!-- /.box-title -->
                        <div class="card-content">
                             @if ($errors->any())
                           <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif 
                            <form class="form-horizontal" method="post" action="{{ route('company.update',$company->id) }}" method="POST" enctype="multipart/form-data">
                                 @csrf
                                @method('PUT')
                              
                                    <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                        <div class="form-group">
                                                <label for="CompanyName" class="col-sm-12 control-label">Company Name</label>
                                                <input type="text" class="form-control" id="CompanyName"
                                                    placeholder="Enter Company Name" name="company_name" value="{{$company->company_name}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="CompanyLogo" class="col-sm-12 control-label">Company logo</label>
                                                <input type="file" class="form-control" id="CompanyLogo"
                                                    placeholder="Upload your file" accept="image/" onchange="loadImg()" name="company_logo">
                                                    @if($company->company_logo != '')
                                                        <img id="frame" class="" src="{{ URL::to('/') }}/{{$company->company_logo}}" width="100px" height="100px" style="display:block;" />
    
                                                        
    
                                                    @else
                                                        <img id="frame" class="d-none" width="100px" height="100px"/>
                                                    @endif
                                                    
                                        </div> 
                                    </div>
                               
                               
                                    <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="CompanyPrimaryEmailAddress " class="company-primary-lable col-sm-12 control-label">Company
                                                Primary Email Address </label>
                                            
                                                <input type="email" class="form-control" id="CompanyPrimaryEmailAddress"
                                                    placeholder="Enter Primary Email Address " name="company_primary_email" value="{{$company->company_primary_email}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="CompanySecondaryEmailAddress" class="col-sm-12 control-label">Company
                                                Secondary Email Address (Optional)</label>
                                                <input type="email" class="form-control" id="CompanySecondaryEmailAddress"
                                                    placeholder="Enter Secondary Email Address " name="company_secondary_email" value="{{$company->company_secondary_email}}">
                                        </div>
                                    </div>
                             
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="CompanyContactNumber" class="col-sm-12 control-label">Company Contact
                                            Number</label>
                                            <input type="text" class="form-control" id="CompanyContactNumber"
                                                placeholder="Enter Company Contact Number" name="company_contact_number" value="{{$company->company_contact_number}}">
                                    </div>
                                </div>
                           
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="CompanyWebsite" class="col-sm-12 control-label">Company website</label>
                                            <input type="text" class="form-control" id="CompanyWebsite"
                                                placeholder="Enter Company website" name="company_website" value="{{$company->company_website}}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="CompanyDescription" class="col-sm-12 control-label">Company
                                            Description</label>
                                            <input type="text" class="form-control" id="CompanyDescription"
                                                placeholder="Enter Company Description" name="company_description" value="{{$company->company_description}}">
                                    </div> 
                                </div>
                               
                                
                               
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <!-- Company status ( enable / disable) -->
                                    <div id="container" class="form-group">
                                        <label for="CompanyStatus" class="col-sm-12 control-label">Company status ( enable /
                                            disable)</label>
                                        
                                        <!-- <div class="col-sm-12 col-12">
                                            <input type="hidden" name="company_status" id="create_company_status" value="1"> 
                                            <div class="switch" id="submit">


                                                <input type="checkbox" checked id="switch-2" onclick="update_company_status($(this),'create_company_status');">
                                                <label for="switch-2"></label>
                                            </div>
                                        </div> -->

                                         <div class="col-sm-2 col-12">
                                            <div class="switch" id="submit">
                                            @if($company->company_status == 1)
                                            <input type="hidden" name="company_status" id="edit_company_status" value="1"> 
                                            <input type="checkbox" checked id="switch-2" onclick="update_company_status($(this),'edit_company_status');">
                                            @else
                                            <input type="hidden" name="company_status" id="edit_company_status" value="0"> 
                                            <input type="checkbox"  id="switch-2" onclick="update_company_status($(this),'edit_company_status');"> 
                                            @endif
                                             
                                             <label for="switch-2"><!-- Switch 2 --></label>
                                         </div>
                                       </div>



                                    </div>
                                </div>
                                <div class="form-group margin-bottom-0">
                                    <div class="col-xl-12 col-lg-12 col-md-12 mb-3 ">
                                        <button type="submit" class="btn btn-info btn-sm waves-effect waves-light">Submit</button> 
                                    </div>
                                </div>
                            </form>
                        </div> 
                        <!-- /.card-content -->
                    </div>
                    <!-- /.box-content -->
                </div>
                <div class="col-lg-4 col-xs-12 form-description">
                    <div class="form-description-wrapper bg-white">
                        <h1 class="border-botton">
                            MY PREFERENCES
                        </h1>
                        <div>
                            <span>A</span>
                            <span>B</span>
                            <span>C</span>
                        </div>
                    </div>
                    <!-- /.box-content -->
                </div>

                <!-- /.col-lg-6 col-xs-12 -->
            </div>

@endsection

