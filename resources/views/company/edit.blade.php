@extends('layouts.app')


@section('content')

<div class="row " id="editCompany">
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
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload" name="company_logo" accept=".png, .jpg, .jpeg"
                                        require />
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <!--  <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);"> -->
                                    <div id="imagePreview"
                                        style="background-image: url({{ URL::to('/') }}/{{$company->company_logo}});">
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
                                    <div id="imagePreview_identity" style="background-image: url({{ URL::to('/') }}/{{$company->proofidentity}});">
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
                                    name="company_name" value="{{$company->company_name}}" require>

                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="CompanyPrimaryEmailAddress "
                                    class="company-primary-lable col-12 control-label">Primary Email Address
                                    <span class="mdi mdi-multiplication"></span> </label>

                                <input type="email" class="form-control" id="CompanyPrimaryEmailAddress"
                                    placeholder="Enter Primary Email Address " name="company_primary_email"
                                    value="{{$company->company_primary_email}}" require>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="CompanyPrimaryEmailAddress "
                                    class="company-primary-lable col-12 control-label">Secondary Email Address
                                    <span class="mdi mdi-multiplication"></span> </label>

                                <input type="email" class="form-control" id="CompanyPrimaryEmailAddress"
                                    placeholder="Enter Primary Email Address " name="company_secondary_email"
                                    value="{{$company->company_secondary_email}}" require>

                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="CompanyContactNumber" class=" col-12 control-label">Contact
                                    Number <span class="mdi mdi-multiplication"></span></label>

                                <input type="text" class="form-control phone" id="CompanyContactNumber"
                                    placeholder="Enter Contact Number" name="company_contact_number"
                                    value="{{$company->company_contact_number}}" require>

                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="Phone" class="col-12 control-label">Secondary Contact </label>
                                <input type="text" class="form-control phone" id="Phone"
                                    placeholder="Enter Phone Number" value="{{$company->phone}}" name="phone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="CompanySecondaryEmailAddress" class="col-md-2 col-12 control-label">
                                    Job Type</label>

                                @php
                                $jtype = json_decode($company->job_type);
                                $type = json_decode($company->installer_job_type);

                               
                                @endphp

                                @if ($jtype != '' && in_array("Solar PV", $jtype))
                                <input name="jtype[]" id="jtype1" onchange="change_installer_job_type($(this));"
                                    type="checkbox" value="Solar PV" checked><label for="CompanySecondaryEmailAddress"
                                    class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Solar
                                    PV</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                @else
                                <input name="jtype[]" id="jtype1" onchange="change_installer_job_type($(this));"
                                    type="checkbox" value="Solar PV"><label for="CompanySecondaryEmailAddress"
                                    class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Solar
                                    PV</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                @endif

                                @if ($jtype != '' && in_array("Solar Water Heater", $jtype))
                                <input name="jtype[]" id="jtype2" onchange="change_installer_job_type($(this));"
                                    type="checkbox" value="Solar Water Heater" checked><label for="SolarWaterHeater"
                                    class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Solar Water
                                    Heater</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                @else
                                <input name="jtype[]" id="jtype2" onchange="change_installer_job_type($(this));"
                                    type="checkbox" value="Solar Water Heater"><label for="SolarWaterHeater"
                                    class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Solar Water
                                    Heater</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                @endif

                                @if ($jtype != '' && in_array("Both", $jtype))
                                <input name="jtype[]" id="jtype3" onchange="change_installer_job_type($(this));"
                                    type="checkbox" value="Both" checked><label for="Both"
                                    class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Both</label>
                                @else
                                <input name="jtype[]" id="jtype3" onchange="change_installer_job_type($(this));"
                                    type="checkbox" value="Both"><label for="Both"
                                    class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Both</label>
                                @endif


                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group" id="typeWrapper">
                                <label for="CompanySecondaryEmailAddress" class="col-md-1 col-12 control-label">
                                    Type</label>


                                <ul class="checkbox-grid">
                                    @if ($type != '' && in_array("Installer", $type))
                                    <li>
                                        <input name="type[]" class="type1" type="checkbox" value="Installer"
                                            checked=""><label for="CompanySecondaryEmailAddress"
                                            class="control-label type11">&nbsp;&nbspInstaller&nbsp;&nbsp;</label>&nbsp;&nbsp&nbsp;&nbsp
                                    </li>
                                    @else
                                    <li>
                                        <input name="type[]" class="type1" type="checkbox" value="Installer"><label
                                            for="CompanySecondaryEmailAddress"
                                            class="control-label type11">&nbsp;&nbsp;Installer&nbsp;&nbsp;</label>&nbsp;&nbsp&nbsp;&nbsp
                                    </li>
                                    @endif

                                    @if ($type != '' && in_array("Electrician", $type))
                                    <li>
                                        <input name="type[]" class="type_all" type="checkbox" value="Electrician"
                                            checked><label for="CompanySecondaryEmailAddress"
                                            class="control-label typeall">&nbsp;&nbsp;Electrician&nbsp;&nbsp;</label>&nbsp;&nbsp&nbsp;&nbsp
                                    </li>
                                    @else
                                    <li>
                                        <input name="type[]" class="type_all" type="checkbox" value="Electrician"><label
                                            for="CompanySecondaryEmailAddress"
                                            class="control-label typeall">&nbsp;&nbsp;Electrician&nbsp;&nbsp;</label>&nbsp;&nbsp&nbsp;&nbsp
                                    </li>
                                    @endif

                                    @if ($type != '' && in_array("Designer", $type))
                                    <li>
                                        <input name="type[]" class="type1" type="checkbox" value="Designer"
                                            checked><label for="CompanySecondaryEmailAddress"
                                            class="control-label type11">&nbsp;&nbsp;Designer&nbsp;&nbsp;</label>&nbsp;&nbsp&nbsp;&nbsp
                                    </li>
                                    @else
                                    <li>
                                        <input name="type[]" class="type1" type="checkbox" value="Designer"><label
                                            for="CompanySecondaryEmailAddress"
                                            class="control-label type11">&nbsp;&nbsp;Designer&nbsp;&nbsp;</label>&nbsp;&nbsp&nbsp;&nbsp
                                    </li>
                                    @endif

                                    @if ($type != '' && in_array("Plumber", $type))
                                    <li>
                                        <input name="type[]" class="type2" type="checkbox" value="Plumber"
                                            checked><label for="CompanySecondaryEmailAddress"
                                            class="control-label type22">&nbsp;&nbsp;Plumber&nbsp;&nbsp;</label>&nbsp;&nbsp&nbsp;&nbsp
                                    </li>
                                    @else
                                    <li>
                                        <input name="type[]" class="type2" type="checkbox" value="Plumber"><label
                                            for="CompanySecondaryEmailAddress"
                                            class="control-label type22">&nbsp;&nbsp;Plumber&nbsp;&nbsp;</label>&nbsp;&nbsp&nbsp;&nbsp
                                    </li>
                                    @endif

                                    @if ($type != '' && in_array("Gas Fitter", $type))
                                    <li>
                                        <input name="type[]" class="type2" type="checkbox" value="Gas Fitter"
                                            checked=""><label for="CompanySecondaryEmailAddress"
                                            class="control-label type22">&nbsp;&nbsp;Gas
                                            Fitter&nbsp;&nbsp</label>&nbsp;&nbsp&nbsp;&nbsp
                                    </li>
                                    @else
                                    <li>

                                        <input name="type[]" class="type2" type="checkbox" value="Gas Fitter"><label
                                            for="CompanySecondaryEmailAddress"
                                            class="control-label type22">&nbsp;&nbsp;Gas
                                            Fitter&nbsp;&nbsp;</label>&nbsp;&nbsp&nbsp;&nbsp
                                    </li>
                                    @endif

                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="Company ABN" class="col-12 control-label">Company ABN:</label>
                                <input type="text" class="form-control" id="text" placeholder="Enter Company ABN"
                                    value="{{$company->companyabn}}" name="companyabn">
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
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="fromdate" class="col-12 control-label">From Date : <span
                                        class="mdi mdi-multiplication"></span></label>
                                <input type="date" class="form-control" id="fromdate" value="{{$company->fromdate}}"
                                    name="fromdate"><span class="required"></span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="todate" class="col-12 control-label">To Date : <span
                                        class="mdi mdi-multiplication"></span></label>
                                <input type="date" class="form-control" id="todate" value="{{$company->todate}}"
                                    name="todate"><span class="required"></span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="CompanyWebsite" class=" col-12 control-label">Website
                                    <!-- <span class="mdi mdi-multiplication"></span> -->
                                </label>

                                <input type="text" class="form-control" id="CompanyWebsite" placeholder="Enter website"
                                    name="company_website" value="{{$company->company_website}}" require>

                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="CompanyDescription" class="col-12 control-label">Description
                                    <!-- <span class="mdi mdi-multiplication"></span> -->
                                </label>

                                @if($company->company_description != '')
                                <textarea class="form-control" rows="3" id="CompanyDescription"
                                    placeholder="Enter Description" name="company_description"
                                    require>{{$company->company_description}}</textarea>
                                @else
                                <textarea class="form-control" rows="3" id="CompanyDescription"
                                    placeholder="Enter Description" value="{{$company->company_description}}"
                                    name="company_description" require></textarea>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6 mb-3">
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
                                         @if($company->unit_type == 1)  
                                            <option value="1" selected="selected">1</option>
                                         @else
                                            <option value="1">1</option>
                                         @endif 

                                         @if($company->unit_type == 2)
                                            <option value="2" selected="selected">2</option>
                                         @else
                                            <option value="2">2</option>
                                         @endif 
                                        
                                       
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="UnitNumber" class="col-12 control-label">Unit Number</label>
                                <input type="text" class="form-control" value="{{$company->unit_number}}"
                                    id="unit_number" placeholder="Enter Unit Number" name="unit_number">
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

                    <input type="hidden" id="address_latitude" name="address_latitude" value="{{$company->address_latitude}}">
                    <input type="hidden" id="address_longitude" name="address_longitude" value="{{$company->address_longitude}}">
                    <div class="row" id="addressdiv1">

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="StreetNumber" class="col-12 control-label">Street Number</label>
                                <input type="text" class="form-control" id="street_number"
                                    placeholder="Enter Street Number" value="{{$company->street_number}}"
                                    name="street_number">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="StreetName" class="col-12 control-label">Street Name</label>
                                <input type="text" class="form-control" id="street_name" placeholder="Enter Street Name"
                                    value="{{$company->street_name}}" name="street_name">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="StreetType" class="col-12 control-label">Street Type</label>
                                <div>
                                    <select class="form-control" id="street_type" name="street_type">
                                        <option>

                                         
                                            @if($company->street_type == 1) 
                                            <option value="1" selected="selected">abc</option>
                                            @else
                                            <option value="1">abc</option> 
                                            @endif

                                            @if($company->street_type == 2)
                                            <option value="2" selected="selected">xyz</option>
                                            @else
                                            <option value="2">xyz</option>
                                            @endif
                                        
                                        
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
                                    value="{{$company->suburb}}" name="suburb">
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
                                    value="{{$company->postcode}}" name="postcode">
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
                                    placeholder="Enter CEC Accreditation Number" value="{{$company->CECaccnumber}}"
                                    name="cecaccnumber">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="Postcode" class="col-12 control-label">Lincesed Electrician
                                    Number<span class="mdi mdi-multiplication"></span></label>
                                <input type="text" class="form-control" id="postcode"
                                    placeholder="Enter Lincesed Electrician Number" value="{{$company->licensenumber}}"
                                    name="licensenumber">
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="Postcode" class="col-12 control-label">CEC Designer Number<span
                                        class="mdi mdi-multiplication"></span></label>
                                <input type="text" class="form-control" id="postcode"
                                    placeholder="Enter CEC Designer Number" value="{{$company->cecdesignernumber}}"
                                    name="cecdesignernumber">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                               <label for="Postcode" class="col-12 control-label">SE Role <span
                                            class="mdi mdi-multiplication"></span></label>
                                    <div class="se-radio">
                                        <ul class="checkbox-grid">
                                            @if($company->serole == "Design")
                                            <li><input type="radio" name="serole" value="Design"
                                                    checked="checked"><span>Design</span></li>
                                            @else
                                            <li><input type="radio" name="serole" value="Design"
                                                   ><span>Design</span></li>
                                            @endif


                                            @if($company->serole == "install")
                                            <li> <input type="radio" name="serole" value="install" checked="checked"> <span>Install</span>
                                            </li>
                                            @else
                                            <li> <input type="radio" name="serole" value="install"> <span>Install</span>
                                            </li>
                                            @endif


                                            @if($company->serole == "designintall")
                                            <li><input type="radio" name="serole" value="designintall" checked="checked"><span> Design &
                                                    Install</span></li> 
                                            @else
                                            <li><input type="radio" name="serole" value="designintall"><span> Design &
                                                    Install</span></li>
                                            @endif


                                           
                                            
                                        </ul>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Company status ( enable / disable) -->
                        <div class="col-md-6 mb-3">
                            <div id="container" class="form-group">
                                <label for="CompanyStatus" class="col-md-1 col-12 control-label">status
                                    <!-- <span class="mdi mdi-multiplication"></span> -->
                                </label>
                                <div class="col-md-9 col-12 ">
                                    <div class="col-sm-2 col-12 p-0">
                                        <div class="switch" id="submit">
                                            @if($company->company_status == 1)
                                            <input type="hidden" name="company_status" id="edit_company_status"
                                                value="1" require>
                                            <input type="checkbox" checked id="switch-2"
                                                onclick="update_company_status($(this),'edit_company_status');" require>
                                            @else
                                            <input type="hidden" name="company_status" id="edit_company_status"
                                                value="0" require>
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
                                <a class="btn btn-primary" href="{{ route('company.index') }}"> Back</a>
                                <button type="submit"
                                    class="btn btn-info btn-sm waves-effect waves-light">Submit</button>
                            </div>
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