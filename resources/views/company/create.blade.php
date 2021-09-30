@extends('layouts.app')


@section('content')

<div class="row " id="createCompany">
    <div class="col-12 container-fluid ">
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
                <form class="form-horizontal" method="post" action="{{ route('company.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <label class="py-4" for="imageUpload_identity">Company Logo</label>
                                    <input type='file' id="imageUpload" name="company_logo"
                                        accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <!--  <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);"> -->
                                    <div id="imagePreview" style="background-image: url();">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <label class="py-4" for="imageUpload_identity">Proof of Identity</label>
                                    <input type='file' id="imageUpload_identity" name="proofidentity"
                                        accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload_identity"></label>
                                </div>
                                <div class="avatar-preview">
                                    <!--  <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);"> -->
                                    <div id="imagePreview_identity" style="background-image: url();">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="CompanyName" class="col-12 control-label">Company Name <span
                                        class="mdi mdi-multiplication"></span></label>

                                <input type="text" class="form-control" id="CompanyName" placeholder="Enter Name"
                                    value="{{ old('company_name')}}" name="company_name">

                            </div>
                            <div class="form-group">
                                <label for="CompanyPrimaryEmailAddress " class="col-12 control-label">
                                    Primary Email Address <span class="mdi mdi-multiplication"></span></label>
                                <input type="email" class="form-control" id="CompanyPrimaryEmailAddress"
                                    placeholder="Enter Primary Email Address " value="{{ old('company_primary_email')}}"
                                    name="company_primary_email">

                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="CompanyContactNumber" class="col-12 control-label">Contact
                                    Number <span class="mdi mdi-multiplication"></span></label>

                                <input type="text" class="form-control phone" id="CompanyContactNumber"
                                    placeholder="Enter Contact Number" value="{{ old('company_contact_number')}}"
                                    name="company_contact_number">

                            </div>
                            <div class="form-group">
                                <label for="Phone" class="col-12 control-label">Secondary Contact :</label>
                                <input type="text" class="form-control phone" id="Phone" maxlength="10"
                                    value="{{ old('phone')}}" placeholder="Enter Phone Number" name="phone">
                            </div>

                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="Username" class="col-12 control-label">Username :<span
                                        class="mdi mdi-multiplication"></span></label>
                                <input type="text" class="form-control" id="username" value="{{ old('username')}}"
                                    placeholder="Enter Username" name="username">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="Password" class="col-12 control-label">Password :<span
                                        class="mdi mdi-multiplication"></span></label>
                                <input type="text" class="form-control" id="password" placeholder="Enter Password"
                                    value="{{ old('password')}}" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="CompanySecondaryEmailAddress" class="col-12 control-label">
                                    Secondary Email Address
                                    <!-- <span class="mdi mdi-multiplication"> --></span>
                                </label>

                                <input type="email" class="form-control" id="CompanySecondaryEmailAddress"
                                    placeholder="Enter Secondary Email Address "
                                    value="{{ old('company_secondary_email')}}" name="company_secondary_email">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group" id="typeWrapper">
                                <label for="CompanySecondaryEmailAddress"
                                    class="col-md-2 col-12 control-label multicheck-lable">
                                    Job Type</label>
                                <div class="col-md-9 col-12">
                                    <ul class="checkbox-grid">
                                        <li>
                                            <input name="jtype[]" id="jtype1"
                                                onchange="change_installer_job_type($(this));" type="checkbox"
                                                value="Solar PV"><label for="CompanySecondaryEmailAddress"
                                                class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Solar
                                                PV</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        </li>
                                        <li>

                                            <input name="jtype[]" id="jtype2"
                                                onchange="change_installer_job_type($(this));" type="checkbox"
                                                value="Solar Water Heater"><label for="SolarWaterHeater"
                                                class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Solar Water
                                                Heater</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        </li>
                                        <li>
                                            <input name="jtype[]" id="jtype3"
                                                onchange="change_installer_job_type($(this));" type="checkbox"
                                                value="Both"><label for="Both"
                                                class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Both</label>
                                        </li>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group" id="typeWrapper">
                                <label for="CompanySecondaryEmailAddress"
                                    class="col-md-3 col-12  control-label  multicheck-lable">
                                    Type</label>
                                <div class="col-md-9 col-12">
                                    <ul class="checkbox-grid">
                                        <li>
                                            <input name="type[]" class="type1" type="checkbox" value="Installer"><label
                                                for="CompanySecondaryEmailAddress"
                                                class="control-label type11">&nbsp;&nbsp;Installer&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        </li>
                                        <li>

                                            <input name="type[]" class="type_all" type="checkbox"
                                                value="Electrician"><label for="CompanySecondaryEmailAddress"
                                                class="control-label typeall">&nbsp;&nbsp;Electrician&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        </li>
                                        <li>

                                            <input name="type[]" class="type1" type="checkbox" value="Designer"><label
                                                for="CompanySecondaryEmailAddress"
                                                class="control-label type11">&nbsp;&nbsp;Designer&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        </li>
                                        <li>

                                            <input name="type[]" class="type2" type="checkbox" value="Plumber"><label
                                                for="CompanySecondaryEmailAddress"
                                                class="control-label type22">&nbsp;&nbsp;Plumber&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        </li>
                                        <li>

                                            <input name="type[]" class="type2" type="checkbox" value="Gas Fitter"><label
                                                for="CompanySecondaryEmailAddress"
                                                class="control-label type22">&nbsp;&nbsp;Gas
                                                Fitter&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!--Address Detail -->
                    <div class="row ">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="Company ABN" class="col-12 control-label">Company ABN:</label>
                                <input type="text" class="form-control" id="text" placeholder="Enter Company ABN"
                                    value="{{ old('companyabn')}}" name="companyabn">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="companyname" class="col-12 control-label">Company/Bussiness Name
                                    :</label>
                                <div>
                                    <select id="companyname" name="companyname" class="form-control">
                                        <option value="Physical">Physical</option>
                                        <option value="Postal">Postal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="fromdate" class="col-12 control-label">From Date : <span
                                        class="mdi mdi-multiplication"></span></label>
                                <input type="date" class="form-control" id="fromdate" value="{{ old('fromdate')}}"
                                    name="fromdate"><span class="required"></span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="todate" class="col-12 control-label">To Date : <span
                                        class="mdi mdi-multiplication"></span></label>
                                <input type="date" class="form-control" id="todate" value="{{ old('todate')}}"
                                    name="todate"><span class="required"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="CompanyWebsite" class="col-12 control-label">Website
                            <!-- <span class="mdi mdi-multiplication"></span> -->
                        </label>

                        <input type="text" class="form-control" id="CompanyWebsite" placeholder="Enter website"
                            value="{{ old('company_website')}}" name="company_website">

                    </div>

                    <div class="form-group">
                        <label for="CompanyDescription" class="col-12 control-label">Description
                            <!-- <span class="mdi mdi-multiplication"></span> -->
                        </label>

                        <textarea class="form-control" name="" rows="3" class="form-control"
                            placeholder="Enter Description" id="CompanyDescription" placeholder="Enter Description"
                            name="company_description">{{old('company_description')}}</textarea>

                    </div>
                    <div class="form-group">
                        <label for="postal_address" class="col-12 control-label">Postal Address Type
                            :</label>
                        <!-- <input type="text" class="form-control" id="CompanyName"
                                                placeholder="Search Address" name="company_name"> -->
                        <div>
                            <select id="postaladdress" name="postaladdress" class="form-control">
                                <option value="Physical">Physical</option>
                                <option value="Postal">Postal</option>
                            </select>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="UnitType" class="col-12 control-label">Unit Type</label>
                                <!-- <input type="text" class="form-control" id="unit_type"
                                        placeholder="Unit Type" name="unit_type"> -->
                                <div>
                                    <select name="unit_type" class="form-control" id="unit_type">
                                        <option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="UnitNumber" class="col-12 control-label">Unit Number</label>
                                <input type="text" class="form-control" value="{{ old('unit_number')}}" id="unit_number"
                                    placeholder="Enter Unit Number" name="unit_number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="StreetNumber" class="col-12 control-label">Search Address<span
                                        class="mdi mdi-multiplication"></span></label>
                                <input type="text" class="form-control" id="SearchAddress_sign1"
                                    placeholder="Search Address" name="search_address" autocomplete="off">

                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="address_latitude" name="address_latitude">
                    <input type="hidden" id="address_longitude" name="address_longitude">
                    <div class="row"  id="addressdiv1">

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="StreetNumber" class="col-12 control-label">Street Number</label>
                                <input type="text" class="form-control" id="street_number"
                                    placeholder="Enter Street Number" value="{{ old('street_number')}}"
                                    name="street_number">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="StreetName" class="col-12 control-label">Street Name</label>
                                <input type="text" class="form-control" id="street_name" placeholder="Enter Street Name"
                                    value="{{ old('street_name')}}" name="street_name">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="StreetType" class="col-12 control-label">Street Type</label>
                                <div>
                                    <select class="form-control" id="street_type" name="street_type">
                                        <option>
                                        <option value="1">abc</option>
                                        <option value="2">xyz</option>
                                        </option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="addressdiv2">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="Suburb" class="col-12 control-label">Town/Suburb</label>
                                <input type="text" class="form-control" id="suburb" placeholder="Enter Town/Suburb"
                                    value="{{ old('suburb')}}" name="suburb">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="State" class="col-12 control-label">State</label>
                                <div>
                                    <select class="form-control" id="state" name="state">
                                        <option>
                                        <option value="1">abc</option>
                                        <option value="2">xyz</option>
                                        </option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="Postcode" class="col-12 control-label">Postcode</label>
                                <input type="text" class="form-control" id="postcode" placeholder="Enter Postcode"
                                    value="{{ old('postcode')}}" name="postcode">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Account Details-->

                    <div class="row ">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="Postcode" class="col-12 control-label">CEC Accreditation
                                    Number<span class="mdi mdi-multiplication"></span></label>
                                <input type="text" class="form-control" id="CEC"
                                    placeholder="Enter CEC Accreditation Number" value="{{ old('cecaccnumber')}}"
                                    name="cecaccnumber">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="Postcode" class="col-12 control-label">Lincesed Electrician
                                    Number<span class="mdi mdi-multiplication"></span></label>
                                <input type="text" class="form-control" id="licensenumber"
                                    placeholder="Enter Lincesed Electrician Number" value="{{ old('licensenumber')}}"
                                    name="licensenumber">
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="Postcode" class="col-12 control-label">CEC Designer Number<span
                                        class="mdi mdi-multiplication"></span></label>
                                <input type="text" class="form-control" id="cecdesignernumber"
                                    placeholder="Enter CEC Designer Number" value="{{ old('cecdesignernumber')}}"
                                    name="cecdesignernumber">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="Postcode" class="col-12 control-label">SE Role <span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="se-radio">
                                    <ul class="checkbox-grid">
                                        <li><input type="radio" name="serole" value="Design" checked><span>Design</span>
                                        </li>
                                        <li> <input type="radio" name="serole" value="install"> <span>Install</span>
                                        </li>
                                        <li><input type="radio" name="serole" value="designintall"><span> Design &
                                                Install</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Company status ( enable / disable) -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div id="container" class="form-group">
                                <label for="CompanyStatus" class="col-md-1 col-12 control-label">Status
                                    <!-- <span class="mdi mdi-multiplication"></span> -->
                                </label>
                                <div class="col-md-9 col-12">
                                    <input type="hidden" name="company_status" id="create_company_status" value="1">
                                    <div class="switch" id="submit">
                                        <input type="checkbox" checked id="switch-2"
                                            onclick="update_company_status($(this),'create_company_status');">
                                        <label for="switch-2"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group margin-bottom-0 company-submit text-center">
                            <div class="col-xl-12 col-lg-12 col-md-12 mb-3 ">
                                <a class="btn btn-primary" href="{{ route('company.index') }}"> Back</a>
                                <button type="submit"
                                    class="btn btn-info btn-sm waves-effect waves-light">Submit</button>
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
<!-- 
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
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