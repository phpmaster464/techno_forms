@extends('layouts.app')


@section('content')

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
                <form class="form-horizontal" method="post" action="{{ route('installer.store') }}"
                    enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="col-xl-4 col-lg-4 col-md-4 mb-3 text-center">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload_logo" name="installer_logo"
                                    accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload_logo"></label>
                            </div>
                            <div class="avatar-preview">
                                <!--  <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);"> -->
                                <div id="imagePreview_logo" style="background-image: url();">
                                </div>
                            </div>
                        </div>
                        <label class="py-4" for="imageUpload_logo ">Logo</label>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 mb-3 text-center">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload_photo" name="installer_photo"
                                    accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload_photo"></label>
                            </div>
                            <div class="avatar-preview">
                                <!--  <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);"> -->
                                <div id="imagePreview_photo" style="background-image: url();">
                                </div>
                            </div>
                        </div>
                        <label class="py-4" for="imageUpload_photo">Photo</label>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 mb-3 text-center">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload_license" name="installer_license_photo"
                                    accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload_license"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview_license" style="background-image: url();">

                                </div>
                            </div>
                        </div>
                        <label class="py-4" for="imageUpload_license">License</label>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="FirstName" class="col-md-3 col-12 control-label">First Name <span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="FirstName"
                                        placeholder="Enter First Name" value="{{ old('first_name')}}" name="first_name">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="LastName" class="col-md-3 col-12 control-label">Last Name <span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="LastName" placeholder="Enter Last Name" value="{{ old('last_name')}}" name="last_name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="email" class="col-md-3 col-12 control-label">Email Address <span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="Email" value="{{ old('email')}}" placeholder="Enter Email" name="email">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="Mobile" class="col-md-3 col-12 control-label">Mobile Number <span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control phone"  maxlength="10" id="Mobile"
                                        placeholder="Enter Mobile Number" value="{{ old('mobile')}}" name="mobile">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="Phone" class="col-md-3 col-12 control-label"> Secondary Contact </label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control phone" id="Phone"  maxlength="10" placeholder="Enter Phone Number" value="{{ old('phone')}}" name="phone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="CompanySecondaryEmailAddress" class="col-md-3 col-12 control-label">
                                    Job Type</label>
                                <div class="col-md-9 col-12">
                                    <input name="jtype[]" id="jtype1" onchange="change_installer_job_type($(this));"
                                        type="checkbox" value="Solar PV"><label for="CompanySecondaryEmailAddress"
                                        class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Solar
                                        PV</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input name="jtype[]" id="jtype2" onchange="change_installer_job_type($(this));"
                                        type="checkbox" value="Solar Water Heater"><label for="SolarWaterHeater"
                                        class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Solar Water
                                        Heater</label>&nbsp;&nbsp;&nbsp;&nbsp;<input name="jtype[]" id="jtype3"
                                        onchange="change_installer_job_type($(this));" type="checkbox"
                                        value="Both"><label for="Both"
                                        class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Both</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group" id="typeWrapper">
                                <label for="CompanySecondaryEmailAddress" class="col-md-3 col-12  control-label">
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

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="SearchAddress" class="col-md-3 col-12 control-label">Search Address<span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="SearchAddress"
                                        placeholder="Search Address" value="{{ old('search_address')}}" name="search_address" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="AddressType" class="col-md-3 col-12 control-label">Address Type</label>
                                <div class="col-md-9 col-12">
                                    <!-- <input type="text" class="form-control" id="CompanyName"
                                    placeholder="Search Address" name="company_name"> -->
                                    <select id="installer_address_type" name="address_type" class="form-control"
                                        onchange="changeAddressType()">
                                        <option value="Physical">Physical</option>
                                        <option value="Postal">Postal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row physical_address">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="UnitType" class="col-md-3 col-12 control-label">Unit Type</label>
                                <div class="col-md-9 col-12">
                                    <!-- <input type="text" class="form-control" id="unit_type"
                                placeholder="Unit Type" name="unit_type"> -->
                                    <select name="unit_type" class="form-control select2_1" id="unit_type">
                                        <option></option>
                                        @foreach($unit_types as $unit_type)
                                        <option value="{{$unit_type->unit_type_name}}">{{$unit_type->unit_type_value}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="UnitNumber" class="col-md-3 col-12 control-label">Unit Number</label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="unit_number" value="{{ old('unit_number')}}" placeholder="Unit Number" name="unit_number">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="StreetNumber" class="col-md-3 col-12 control-label">Street Number</label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" value="{{ old('street_number')}}" id="street_number"
                                        placeholder="Street Number" name="street_number">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="StreetName" class="col-md-3 col-12 control-label">Street Name</label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="street_name" value="{{ old('street_name')}}" placeholder="Street Name" name="street_name">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="StreetType" class="col-md-3 col-12 control-label">Street Type</label>
                                <div class="col-md-9 col-12">
                                    <!-- <input type="text" class="form-control" id="street_type"
                placeholder="Street Type" name="street_type"> -->
                                    <select class="form-control" id="street_type" name="street_type">
                                        <option></option>
                                        @foreach($street_types as $street_type)
                                        <option value="{{$street_type->street_type_name}}">
                                            {{$street_type->street_type_value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row postal_address" style="display:none;">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="PostalDeliveryType" class="col-md-3 col-12 control-label">Postal Delivery
                                    Type<span class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="postal_delivery_type"
                                        placeholder="Postal Delivery Type" value="{{ old('postal_delivery_type')}}" name="postal_delivery_type">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="PostalDeliveryNumber" class="col-md-3 col-12 control-label">Postal Delivery
                                    Number<span class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="postal_delivery_number"
                                        placeholder="Postal Delivery Number" value="{{ old('postal_delivery_number')}}" name="postal_delivery_number">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="Suburb" class="col-md-3 col-12 control-label">Suburb<span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="suburb" value="{{ old('suburb')}}" placeholder="Suburb" name="suburb">
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
                                        <option></option>
                                        @foreach($states as $state)
                                        <option value="{{$state->au_state_name}}">{{$state->au_state_value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="Postcode" class="col-md-3 col-12 control-label">Postcode<span
                                        class="mdi mdi-multiplication"></span></label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="postcode" value="{{ old('postcode')}}" placeholder="Postcode" name="postcode">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                        <!-- Installer status ( enable / disable) -->
                        <div id="container" class="form-group">
                            <label for="Status" class="col-md-3 col-12 control-label">Status
                                <!-- <span class="mdi mdi-multiplication"></span> -->
                            </label>
                            <div class="col-md-9 col-12">
                                <input type="hidden" name="installer_status" id="create_company_status" value="1">
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
@endsection

@section('scriptsection')
<script type="text/javascript">
$(document).ready(function() {
    alert("Works");
});
</script>

@endsection