@extends('layouts.app')


@section('content')

<div class="row ">


    <div class="col-md-12">
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
                <form class="form-horizontal" method="post" action="{{ route('company.update',$company->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" name="company_logo" accept=".png, .jpg, .jpeg" require />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                               <!--  <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);"> -->
                                <div id="imagePreview" style="background-image: url({{ URL::to('/') }}/{{$company->company_logo}});">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8 col-lg-8 col-md-12 mb-3">
                        <div class="form-group">
                            <label for="CompanyName" class="col-md-3 col-12 control-label">Name <span class="fa fa-asterisk"></span></label>
                            <div class="col-md-9 col-12">
                                <input type="text" class="form-control" id="CompanyName"
                                    placeholder="Enter Name" name="company_name"
                                    value="{{$company->company_name}}" require>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="CompanyPrimaryEmailAddress "
                                class="company-primary-lable col-md-3 col-12 control-label">Primary Email Address <span class="fa fa-asterisk"></span> </label>
                            <div class="col-md-9 col-12">
                                <input type="email" class="form-control" id="CompanyPrimaryEmailAddress"
                                    placeholder="Enter Primary Email Address " name="company_primary_email"
                                    value="{{$company->company_primary_email}}" require>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="CompanyContactNumber" class="col-md-3 col-12 control-label">Contact
                                Number <span class="fa fa-asterisk"></span></label>
                            <div class="col-md-9 col-12">
                                <input type="text" class="form-control" id="CompanyContactNumber"
                                    placeholder="Enter Contact Number" name="company_contact_number"
                                    value="{{$company->company_contact_number}}" require>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                        <div class="form-group">
                            <label for="CompanyLogo" class="col-md-3 col-12 control-label">Company logo</label>
                            <div class="col-md-9 col-12">
                                <input type="file" class="form-control" id="CompanyLogo" placeholder="Upload your file"
                                    accept="image/" onchange="loadImg()" name="company_logo">
                                @if($company->company_logo != '')
                                <img id="frame" class="" src="{{ URL::to('/') }}/{{$company->company_logo}}"
                                    width="100px" height="100px" style="display:block;" />
                                @else
                                <img id="frame" class="d-none" width="100px" height="100px" />
                                @endif
                            </div>
                        </div>
                    </div> -->
                    
                    <div class="row other-info-title">
                        <span>Other Information </span>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-3">
                    <div class="form-group">
                            <label for="CompanySecondaryEmailAddress" class="col-md-3 col-12 control-label"> Secondary Email Address <!-- <span class="fa fa-asterisk"></span> --></label>
                            <div class="col-md-9 col-12">
                                <input type="email" class="form-control" id="CompanySecondaryEmailAddress"
                                    placeholder="Enter Secondary Email Address " name="company_secondary_email"
                                    value="{{$company->company_secondary_email}}" require>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="CompanyWebsite" class="col-md-3 col-12 control-label">Website <!-- <span class="fa fa-asterisk"></span> --></label>
                            <div class="col-md-9 col-12">
                                <input type="text" class="form-control" id="CompanyWebsite"
                                    placeholder="Enter website" name="company_website"
                                    value="{{$company->company_website}}" require>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="CompanyDescription" class="col-md-3 col-12 control-label">Description <!-- <span class="fa fa-asterisk"></span> --></label>
                            <div class="col-md-9 col-12">
                                <textarea class="form-control" rows="3"  id="CompanyDescription"
                                    placeholder="Enter Description" name="company_description"
                                    value="{{$company->company_description}}" require>
                                </textarea>
                            </div>
                        </div>
                          <!-- Company status ( enable / disable) -->
                          <div id="container" class="form-group">
                            <label for="CompanyStatus" class="col-md-3 col-12 control-label">status <!-- <span class="fa fa-asterisk"></span> --></label>
                            <div class="col-md-9 col-12">

                                <div class="col-sm-2 col-12">
                                    <div class="switch" id="submit">
                                        @if($company->company_status == 1)
                                        <input type="hidden" name="company_status" id="edit_company_status" value="1" require>
                                        <input type="checkbox" checked id="switch-2"
                                            onclick="update_company_status($(this),'edit_company_status');" require>
                                        @else
                                        <input type="hidden" name="company_status" id="edit_company_status" value="0" require>
                                        <input type="checkbox" id="switch-2"
                                            onclick="update_company_status($(this),'edit_company_status');" require>
                                        @endif

                                        <label for="switch-2">
                                            <!-- Switch 2 -->
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group margin-bottom-0 company-submit text-center">
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
   
    <!-- /.col-lg-6 col-xs-12 -->
</div>

@endsection