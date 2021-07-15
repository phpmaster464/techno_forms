@extends('layouts.app')


@section('content')

<div class="row ">


    <div class="col-lg-6 col-xs-12">
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
                            <form class="form-horizontal" method="post" action="{{ route('company.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div class="form-group">
                                            <label for="CompanyName" class="col-sm-12 control-label">Company Name</label>
                                            <input type="text" class="form-control" id="CompanyName"
                                                placeholder="Enter Company Name" name="company_name">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="CompanyLogo" class="col-sm-12 control-label">Company logo</label>
                                            <input type="file" class="form-control" id="CompanyLogo"
                                                placeholder="Upload your file" accept="image/" onchange="loadImg()" name="company_logo">
                                                <img id="frame" class="d-none" width="100px" height="100px"/>
                                    </div> 
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="CompanyPrimaryEmailAddress " class="col-sm-12 control-label">Company
                                            Primary Email Address </label>
                                        
                                            <input type="email" class="form-control" id="CompanyPrimaryEmailAddress"
                                                placeholder="Enter Primary Email Address " name="company_primary_email">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="CompanySecondaryEmailAddress" class="col-sm-12 control-label">Company
                                            Secondary Email Address</label>
                                            <input type="email" class="form-control" id="CompanySecondaryEmailAddress"
                                                placeholder="Enter Secondary Email Address " name="company_secondary_email">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="CompanyContactNumber" class="col-sm-12 control-label">Company Contact
                                            Number</label>
                                            <input type="text" class="form-control" id="CompanyContactNumber"
                                                placeholder="Enter Company Contact Number" name="company_contact_number">
                                    </div>
                                </div>
                           
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="CompanyWebsite" class="col-sm-12 control-label">Company website</label>
                                            <input type="text" class="form-control" id="CompanyWebsite"
                                                placeholder="Enter Company website" name="company_website">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="CompanyDescription" class="col-sm-12 control-label">Company
                                            Description</label>
                                            <input type="text" class="form-control" id="CompanyDescription"
                                                placeholder="Enter Company Description" name="company_description">
                                    </div> 
                                </div>
                               
                                
                               
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <!-- Company status ( enable / disable) -->
                                    <div id="container" class="form-group">
                                        <label for="CompanyStatus" class="col-sm-12 control-label">Company status</label>
                                        
                                        <div class="col-sm-12 col-12">
                                            <input type="hidden" name="company_status" id="create_company_status" value="1"> 
                                            <div class="switch" id="submit">
                                                <input type="checkbox" checked id="switch-2" onclick="update_company_status($(this),'create_company_status');">
                                                <label for="switch-2"></label>
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
                <div class="col-lg-6 col-xs-12 bg-white border">
                    <!-- <h1 class="border-botton">
                        MY PREFERENCES
                    </h1>
                    <div>
                        <span>A</span>
                        <span>B</span>
                        <span>C</span>
                    </div> -->
                    <!-- /.box-content -->
                </div>

                <!-- /.col-lg-6 col-xs-12 -->
            </div>


<!-- <div class="box-content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New company</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('company.index') }}"> Back</a>
            </div>
        </div>
    </div>


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


    <form action="{{ route('company.store') }}" method="POST">
        @csrf


         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="company_name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="company_primary_email" placeholder="Detail"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form>

</div> -->

@endsection