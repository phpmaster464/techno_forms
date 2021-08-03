@extends('layouts.app')


@section('content')

<div class="row small-spacing">
                <div class="col-lg-12 col-xs-12">
                    <div class="box-content card white">
                        <h4 class="box-title">Edit Company Details</h4>
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
                            <form class="form-horizontal" action="{{ route('company.update',$company->id) }}" method="POST">
        @csrf
        @method('PUT')
                                <div class="form-group">
                                    <label for="CompanyName" class="col-sm-2 control-label">Company Name</label>
                                    <div class="col-sm-8 col-12">
                                        <input type="text" class="form-control" id="CompanyName"
                                            placeholder="Enter Company Name" name="company_name" value="{{$company->company_name}}" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="CompanyLogo" class="col-sm-2 control-label">Company logo</label>
                                    <div class="col-sm-8 col-12">
                                        <input type="file" class="form-control" id="CompanyLogo"
                                            placeholder="Upload your file" name="company_logo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="CompanyPrimaryEmailAddress " class="col-sm-2 control-label">Company
                                        Primary Email Address </label>
                                    <div class="col-sm-8 col-12">
                                        <input type="email" class="form-control" id="CompanyPrimaryEmailAddress"
                                            placeholder="Enter Primary Email Address " name="company_primary_email" value="{{$company->company_primary_email}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="CompanySecondaryEmailAddress" class="col-sm-2 control-label">Company
                                        Secondary Email Address (Optional)</label>
                                    <div class="col-sm-8 col-12">
                                        <input type="email" class="form-control" id="CompanySecondaryEmailAddress"
                                            placeholder="Enter Secondary Email Address " name="company_secondary_email" value="{{$company->company_secondary_email}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="CompanyContactNumber" class="col-sm-2 control-label">Company Contact
                                        Number</label>
                                    <div class="col-sm-8 col-12">
                                        <input type="text" class="form-control" id="CompanyContactNumber"
                                            placeholder="Enter Company Contact Number" name="company_contact_number" value="{{$company->company_contact_number}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="CompanyWebsite" class="col-sm-2 control-label">Company website</label>
                                    <div class="col-sm-8 col-12">
                                        <input type="text" class="form-control" id="CompanyWebsite"
                                            placeholder="Enter Company website" name="company_website" value="{{$company->company_website}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="CompanyDescription" class="col-sm-2 control-label">Company
                                        Description</label>
                                    <div class="col-sm-8 col-12">
                                        <input type="text" class="form-control" id="CompanyDescription"
                                            placeholder="Enter Company Description" name="company_description" value="{{$company->company_description}}">
                                    </div>
                                </div>
                               
                                <!-- Company status ( enable / disable) --> 
                                <div id="container" class="form-group">
                                    <label for="CompanyStatus" class="col-sm-2 control-label">Company status ( enable /
                                        disable)</label>
                                   <!--  <div class="col-sm-6 col-12">
                                        <input type="tex" class="form-control" name="CompanyStatus" id="CompanyStatus"
                                            placeholder="Enter Company code">
                                    </div> -->
                                    <div class="col-sm-2 col-12">
                                            <div class="switch primary"><input type="checkbox" checked ><label for="sw itch"></label></div>
                                            <input type="hidden" name="company_status" value="1" id="company_status">
                                    </div>
                                </div>

                                <div class="form-group margin-bottom-0">
                                    <div class="col-sm-offset-2 col-sm-8 col-12">
                                        <button type="submit" class="btn btn-info btn-sm waves-effect waves-light"
                                            >Submit</button>
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

