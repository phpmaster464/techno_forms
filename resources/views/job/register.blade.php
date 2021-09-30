@extends('layouts.app')

@section('content')

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
    rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js">
</script>
<script type="text/javascript"
    src="https://raw.githubusercontent.com/furf/jquery-ui-touch-punch/master/jquery.ui.touch-punch.min.js"></script>

<style>
.kbw-signature {
    width: 100%;
    height: 200px;
}

#sig canvas {
    width: 100% !important;
    height: auto;
}
</style>

<!-- <script type="text/javascript">
.required {
  content: "*";
  color: #FF0000;
}
</script> -->
<div class="registration-form-wrapper">
    <div class="container-fluid">
        <div class="row" id="registrationForm">
            <div class=" col-xl-12 col-lg-12 col-md-12 mb-3">
                <div class="">
                    <h4 class="box-title">Installer Details</h4>
                    <!-- /.box-title -->

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
                    <form class="form-horizontal" method="post"
                        action="{{ route('unverified_installer.register_unverified_technicians_store') }}"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <!--  <div class="row ">
                                <div class="col-md-12">
                                    <label class="" for="">Signature:</label>
                                    <br />
                                    <div id="sig"></div>
                                    <br />
                                    <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                                    <textarea id="signature64" name="signed" style="display: none"></textarea>
                                </div>
                            </div> -->

                        <!-- Personal Details  -->

                        <div class="row  ">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="FirstName" class="col-12 control-label">First Name : <span
                                            class="mdi mdi-multiplication"></span></label>
                                    <input type="text" class="form-control" id="FirstName"
                                        value="{{ old('first_name')}}" placeholder="Enter First Name"
                                        name="first_name"><span class="required"></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">

                                <div class="form-group">
                                    <label for="LastName" class="col-12 control-label">Last Name : <span
                                            class="mdi mdi-multiplication"></span></label>
                                    <input type="text" class="form-control" id="LastName" value="{{ old('last_name')}}"
                                        placeholder="Enter Last Name" name="last_name"><span class="required"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="Emailadrees" class="col-12 control-label">Email :<span
                                            class="mdi mdi-multiplication"></span></label>
                                    <input type="text" class="form-control" id="Emailadrees" value="{{ old('email')}}"
                                        placeholder="Enter Email" name="email">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="Mobile" class="col-12 control-label">Mobile Number <span
                                            class="mdi mdi-multiplication"></span></label>
                                    <input type="text" class="form-control phone" id="Mobile" maxlength="10"
                                        value="{{ old('mobile')}}" placeholder="Enter Mobile Number" name="mobile">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
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
                                                <input name="type[]" class="type1" type="checkbox"
                                                    value="Installer"><label for="CompanySecondaryEmailAddress"
                                                    class="control-label type11">&nbsp;&nbsp;Installer&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            </li>
                                            <li>

                                                <input name="type[]" class="type_all" type="checkbox"
                                                    value="Electrician"><label for="CompanySecondaryEmailAddress"
                                                    class="control-label typeall">&nbsp;&nbsp;Electrician&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            </li>
                                            <li>

                                                <input name="type[]" class="type1" type="checkbox"
                                                    value="Designer"><label for="CompanySecondaryEmailAddress"
                                                    class="control-label type11">&nbsp;&nbsp;Designer&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            </li>
                                            <li>

                                                <input name="type[]" class="type2" type="checkbox"
                                                    value="Plumber"><label for="CompanySecondaryEmailAddress"
                                                    class="control-label type22">&nbsp;&nbsp;Plumber&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            </li>
                                            <li>

                                                <input name="type[]" class="type2" type="checkbox"
                                                    value="Gas Fitter"><label for="CompanySecondaryEmailAddress"
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
                                    <label for="Company ABN" class="col-12 control-label">Company ABN: :</label>
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
                                    <label for="formdate" class="col-12 control-label">Form Date : <span
                                            class="mdi mdi-multiplication"></span></label>
                                    <input type="date" class="form-control" id="formdate" value="{{ old('formdate')}}"
                                        name="formdate"><span class="required"></span>
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
                        <div class="row ">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="companywebsite" class="col-12 control-label">Company Website <span
                                            class="mdi mdi-multiplication"></span></label>
                                    <input type="text" class="form-control" id="companyname"
                                        placeholder="Enter Company Website" value="{{ old('companywebsite')}}"
                                        name="companywebsite">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="postal_address" class="col-12 control-label">Postal Address Type
                                        :</label>
                                    <!-- <input type="text" class="form-control" id="CompanyName"
                                                placeholder="Search Address" name="company_name"> -->
                                    <div>
                                        <select id="companyname" name="postaladdress" class="form-control">
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
                                    <input type="text" class="form-control" value="{{ old('unit_number')}}"
                                        id="unit_number" placeholder="Enter Unit Number" name="unit_number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="StreetNumber" class="col-12 control-label">Search Address<span
                                            class="mdi mdi-multiplication"></span></label>
                                    <input type="text" class="form-control" id="SearchAddress_sign"
                                        placeholder="Search Address" name="search_address" autocomplete="off">

                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="address_latitude">
                        <input type="hidden" id="address_longitude">
                        <div class="row" style="display:none" id="addressdiv1">

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
                                    <input type="text" class="form-control" id="street_name"
                                        placeholder="Enter Street Name" value="{{ old('street_name')}}"
                                        name="street_name">
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
                        <div class="row" style="display:none" id="addressdiv2">
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
                                    <input type="text" class="form-control" id="postcode"
                                        placeholder="Enter Lincesed Electrician Number"
                                        value="{{ old('licensenumber')}}" name="licensenumber">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="Postcode" class="col-12 control-label">CEC Designer Number<span
                                            class="mdi mdi-multiplication"></span></label>
                                    <input type="text" class="form-control" id="postcode"
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
                                            <li><input type="radio" name="serole" value="Design"
                                                    checked><span>Design</span></li>
                                            <li> <input type="radio" name="serole" value="install"> <span>Install</span>
                                            </li>
                                            <li><input type="radio" name="serole" value="designintall"><span> Design &
                                                    Install</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="" for="">Signature:</label>
                                <br />
                                <div id="div_signcontract">
                                    <canvas id="canvas" name="signed">Canvas is not supported</canvas>
                                    <div>
                                        <br />
                                        <button id="clear" class="btn btn-danger btn-sm"
                                            onclick="init_Sign_Canvas()">Clear Signature</button>
                                        <textarea id="signature64" name="signed" style="display: none"></textarea>
                                        <input type="text" style="display: none;" class="form-control" id="iamgeval"
                                            name="iamgeval">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
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
                        <div class="row submit-wrapper">
                            <div class="form-group margin-bottom-0 company-submit text-center">
                                <div class="col-xl-12 col-md-12 col-md-12 mb-3 ">
                                    <input type="button" class="btn btn-info btn-sm waves-effect waves-light"
                                        value="Submit" onclick="fun_submit()">
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- /.card-content -->
            </div>
            <!-- /.box-content -->
        </div>
    </div>
</div>

<!-- /.col-md-6 col-xs-12 -->

<script type="text/javascript">
var isSign = false;
var leftMButtonDown = false;
$(document).ready(function() {
    init_Sign_Canvas();
    console.log("here");
});
$(window).load(function() {
    init_Sign_Canvas();
});
jQuery(function() {
    //Initialize sign pad
    init_Sign_Canvas();
});

function fun_submit() {
    if (isSign) {
        var canvas = $("#canvas").get(0);
        var imgData = canvas.toDataURL();
        $("#iamgeval").val(imgData);
        $("form").submit();
    } else {
        alert('Please sign');
    }
}

function init_Sign_Canvas() {
    console.log("in init");
    isSign = false;
    leftMButtonDown = false;
    //Set Canvas width
    var sizedWindowWidth = $(window).width();
    if (sizedWindowWidth > 700)
        sizedWindowWidth = $(window).width() / 2;
    else if (sizedWindowWidth > 400)
        sizedWindowWidth = sizedWindowWidth - 100;
    else
        sizedWindowWidth = sizedWindowWidth - 50;
    // $("#canvas").width(sizedWindowWidth);
    // $("#canvas").height(200);
    // $("#canvas").css("border","1px solid #000");
    $("#canvas").width('100%');
    $("#canvas").height('202px');
    $("#canvas").css("border", "1px solid rgb(0, 0, 0)");
    var canvas = $("#canvas").get(0);
    canvasContext = canvas.getContext('2d');
    if (canvasContext) {
        canvasContext.canvas.width = sizedWindowWidth;
        canvasContext.canvas.height = 200;
        canvasContext.fillStyle = "#fff";
        canvasContext.fillRect(0, 0, sizedWindowWidth, 200);
        canvasContext.moveTo(50, 150);
        canvasContext.lineTo(sizedWindowWidth - 50, 150);
        canvasContext.stroke();
        canvasContext.fillStyle = "#000";
        canvasContext.font = "20px Arial";
        canvasContext.fillText("x", 40, 155);
    }
    // Bind Mouse events
    $(canvas).on('mousedown', function(e) {
        if (e.which === 1) {
            leftMButtonDown = true;
            canvasContext.fillStyle = "#000";
            var x = e.pageX - $(e.target).offset().left;
            var y = e.pageY - $(e.target).offset().top;
            canvasContext.moveTo(x, y);
        }
        e.preventDefault();
        return false;
    });
    $(canvas).on('mouseup', function(e) {
        if (leftMButtonDown && e.which === 1) {
            leftMButtonDown = false;
            isSign = true;
        }
        e.preventDefault();
        return false;
    });
    // draw a line from the last point to this one
    $(canvas).on('mousemove', function(e) {
        if (leftMButtonDown == true) {
            canvasContext.fillStyle = "#000";
            var x = e.pageX - $(e.target).offset().left;
            var y = e.pageY - $(e.target).offset().top;
            canvasContext.lineTo(x, y);
            canvasContext.stroke();
        }
        e.preventDefault();
        return false;
    });
    //bind touch events
    $(canvas).on('touchstart', function(e) {
        leftMButtonDown = true;
        canvasContext.fillStyle = "#000";
        var t = e.originalEvent.touches[0];
        var x = t.pageX - $(e.target).offset().left;
        var y = t.pageY - $(e.target).offset().top;
        canvasContext.moveTo(x, y);
        e.preventDefault();
        return false;
    });
    $(canvas).on('touchmove', function(e) {
        canvasContext.fillStyle = "#000";
        var t = e.originalEvent.touches[0];
        var x = t.pageX - $(e.target).offset().left;
        var y = t.pageY - $(e.target).offset().top;
        canvasContext.lineTo(x, y);
        canvasContext.stroke();
        e.preventDefault();
        return false;
    });
    $(canvas).on('touchend', function(e) {
        if (leftMButtonDown) {
            leftMButtonDown = false;
            isSign = true;
        }
    });
}
</script>

@endsection