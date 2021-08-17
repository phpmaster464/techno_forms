@extends('layouts.app')

@section('content')


  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    
  
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script type="text/javascript" src="https://raw.githubusercontent.com/furf/jquery-ui-touch-punch/master/jquery.ui.touch-punch.min.js"></script>


  
    <style>
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
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

<div class="row ">


    <div class="col-12 ">
        <div class="box-content card white">
            <h4 class="box-title">Installer Details</h4>
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
                <form class="form-horizontal" method="post" action="{{ route('unverified_installer.register_unverified_technicians_store') }}"
                    enctype="multipart/form-data" autocomplete="off">
                    @csrf

                     <div class="col-md-12">
                            <label class="" for="">Signature:</label>
                            <br/>
                            <div id="sig" ></div>
                            <br/>
                            <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                        </div>


          

                    <!-- Personal Details  -->
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="FirstName" class="col-md-3 col-12 control-label">First Name : <span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="FirstName"
                                        placeholder="Enter First Name" name="first_name"><span class="required"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="LastName" class="col-md-3 col-12 control-label">Last Name : <span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="LastName" placeholder="Enter Last Name"
                                        name="last_name"><span class="required"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="email" class="col-md-3 col-12 control-label">Email :<span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="Email" placeholder="Enter Email"
                                        name="email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="Phone" class="col-md-3 col-12 control-label">Phone : <span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="Phone" placeholder="Enter Phone Number"
                                        name="phone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="Mobile" class="col-md-3 col-12 control-label">Mobile Number <span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="Mobile"
                                        placeholder="Enter Mobile Number" name="mobile">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="Username" class="col-md-3 col-12 control-label">Username :<span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="username" placeholder="Enter Username"
                                        name="username">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="Password" class="col-md-3 col-12 control-label">Password :<span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="password" placeholder="Enter Password"
                                        name="password">
                                </div>
                            </div>
                        </div>

                    <!--Address Detail -->
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="Company ABN" class="col-md-3 col-12 control-label">Company ABN: :<span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="Email" placeholder="Enter Company ABN"
                                        name="companyabn">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="companyname" class="col-md-3 col-12 control-label">Company/Bussiness Name :<span
                                            class="mdi mdi-multiplication"></span></label>
                                    <div class="col-md-9 col-12">
                                        <!-- <input type="text" class="form-control" id="CompanyName"
                                        placeholder="Search Address" name="company_name"> -->
                                        <select id="companyname" name="companyname" class="form-control">
                                            <option value="Physical">Physical</option>
                                            <option value="Postal">Postal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="formdate" class="col-md-3 col-12 control-label">Form Date : <span
                                            class="mdi mdi-multiplication"></span></label>
                                    <div class="col-md-9 col-12">
                                        <input type="date" class="form-control" id="formdate"
                                            name="formdate"><span class="required"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="todate" class="col-md-3 col-12 control-label">To Date : <span
                                            class="mdi mdi-multiplication"></span></label>
                                    <div class="col-md-9 col-12">
                                        <input type="date" class="form-control" id="todate" 
                                            name="todate"><span class="required"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="companywebsite" class="col-md-3 col-12 control-label">Company Website <span
                                            class="mdi mdi-multiplication"></span></label>
                                    <div class="col-md-9 col-12">
                                        <input type="text" class="form-control" id="companyname"
                                            placeholder="Enter Company Website" name="companywebsite">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="postal_address" class="col-md-3 col-12 control-label">Postal Address Type :<span
                                            class="mdi mdi-multiplication"></span></label>
                                    <div class="col-md-9 col-12">
                                        <!-- <input type="text" class="form-control" id="CompanyName"
                                        placeholder="Search Address" name="company_name"> -->
                                        <select id="companyname" name="postaladdress" class="form-control">
                                            <option value="Physical">Physical</option>
                                            <option value="Postal">Postal</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="row">                   
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="UnitType" class="col-md-3 col-12 control-label">Unit Type<span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <!-- <input type="text" class="form-control" id="unit_type"
                                placeholder="Unit Type" name="unit_type"> -->
                                    <select name="unit_type" class="form-control select2_1" id="unit_type">
                                        <option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="UnitNumber" class="col-md-3 col-12 control-label">Unit Number<span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="unit_number" placeholder="Unit Number"
                                        name="unit_number">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="StreetNumber" class="col-md-3 col-12 control-label">Street Number<span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="street_number"
                                        placeholder="Street Number" name="street_number">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="StreetName" class="col-md-3 col-12 control-label">Street Name<span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="street_name" placeholder="Street Name"
                                        name="street_name">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="StreetType" class="col-md-3 col-12 control-label">Street Type<span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <!-- <input type="text" class="form-control" id="street_type"
                placeholder="Street Type" name="street_type"> -->
                                    <select class="form-control" id="street_type" name="street_type">
                                        <option>
                                            <option value="1">abc</option>
                                            <option value="2">xyz</option>
                                        </option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Suburb" class="col-md-3 col-12 control-label">Town/Suburb<span
                                            class="mdi mdi-multiplication"></span></label>
                                    <div class="col-md-9 col-12">
                                        <input type="text" class="form-control" id="suburb" placeholder="Suburb"
                                            name="suburb">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="State" class="col-md-3 col-12 control-label">State<span
                                            class="mdi mdi-multiplication"></span></label>
                                    <div class="col-md-9 col-12">
                                        <!-- <input type="text" class="form-control" id="state"
            placeholder="State" name="state"> -->
                                        <select class="form-control" id="state" name="state">
                                            <option>
						<option value="1">abc</option>
                                            	<option value="2">xyz</option>
					</option>
                                           
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Postcode" class="col-md-3 col-12 control-label">Postcode<span
                                            class="mdi mdi-multiplication"></span></label>
                                    <div class="col-md-9 col-12">
                                        <input type="text" class="form-control" id="postcode" placeholder="Postcode"
                                            name="postcode">
                                    </div>
                                </div>
                            </div>
                    </div>

                    <!-- Account Details-->


                    <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Postcode" class="col-md-3 col-12 control-label">CEC Accreditation Number<span
                                            class="mdi mdi-multiplication"></span></label>
                                    <div class="col-md-9 col-12">
                                        <input type="text" class="form-control" id="CEC" placeholder="Postcode"
                                            name="cecaccnumber">
                                    </div>
                                </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Postcode" class="col-md-3 col-12 control-label">Lincesed Electrician Number<span
                                            class="mdi mdi-multiplication"></span></label>
                                    <div class="col-md-9 col-12">
                                        <input type="text" class="form-control" id="postcode" placeholder="Postcode"
                                            name="licensenumber">
                                    </div>
                                </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Postcode" class="col-md-3 col-12 control-label">CEC Designer Number<span
                                            class="mdi mdi-multiplication"></span></label>
                                    <div class="col-md-9 col-12">
                                        <input type="text" class="form-control" id="postcode" placeholder="Postcode"
                                            name="cecdesignernumber">
                                    </div>
                                </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Postcode" class="col-md-3 col-12 control-label">SE Role <span
                                            class="mdi mdi-multiplication"></span></label>
                                    <div class="col-md-9 col-12">
                                        <input type="radio" name="serole" value="Design" checked>Design
                                        <input type="radio" name="serole" value="install">Install
                                        <input type="radio" name="serole" value="designintall">Design & Install
                                    </div>
                                </div>
                    </div>
                   

                    <div class="col-xl-4 col-lg-4 col-md-4 mb-3 text-center">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                 <label class="py-4" for="imageUpload_photo">Signature</label>
                                <input type='file' id="imageUpload_photo" name="signature"
                                    accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload_photo"></label>
                            </div>
                            <div class="avatar-preview">
                                <!--  <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);"> -->
                                <div id="imagePreview_photo" style="background-image: url();">
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 mb-3 text-center">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <label class="py-4" for="imageUpload_photo">Proof of Identity</label>
                                <input type='file' id="imageUpload_photo" name="proofidentity"
                                    accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload_photo"></label>
                            </div>
                            <div class="avatar-preview">
                                <!--  <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);"> -->
                                <div id="imagePreview_photo" style="background-image: url();">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                  
                    <div class="form-group margin-bottom-0 company-submit text-center">
                        <div class="col-xl-12 col-lg-12 col-md-12 mb-3 ">
                            <a class="btn btn-primary" href="{{ route('installer.index') }}"> Back</a>
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

<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>

@endsection