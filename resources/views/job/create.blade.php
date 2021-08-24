@extends('layouts.app')


@section('content')

<div class="row ">
    <div class="col-12 ">
        <div class="box-content card white">
            <h4 class="box-title">Create A Job</h4>
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
                <form class="form-horizontal" method="post" action="{{ route('job.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="job-form-wrapper">
                        <!-- job-detail -->
                        <div class="job-detail-wrapper">
                            <h4>Job Details :</h4>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="JobType" class="control-label">Job Type: <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <select class="form-control" id="JobType" name="job_type">
                                            <option value="PVD">PVD</option>
                                            <option value="SWH">SWH</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="ReferenceNumber" class="control-label">
                                            Reference Number <span class="mdi mdi-multiplication"></span></label>
                                        <input type="text" class="form-control" id="ReferenceNumber"
                                            value="{{ old('reference_number')}}" name="reference_number">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="JobStage" class="control-label">Job Stage: <span></span></label>
                                        <select class="form-control" id="JobStage" name="job_stage">
                                            <option value="">Select</option>
                                            <option value="New">New</option>
                                            <option value="Preapproval">Preapproval</option>
                                            <option value="New Installation">New Installation</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Installation Completed">Installation Completed</option>
                                            <option value="Complete">Complete</option>
                                            <option value="STC Trade">STC Trade</option>
                                            <option value="Aftersales">Aftersales</option>
                                            <option value="Cancellations">Cancellations</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Title" class="control-label"> Title: </label>
                                        <input type="text" class="form-control" id="Title" name="title"
                                            value="{{old('title')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="InstallationDate" class="control-label">Installation Date:</label>
                                        <div class="input-group col-sm-12">
                                            <input type="date" class="form-control" id="InstallationDate"
                                                name="installation_date" value="{{old('installation_date')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="Priority" class="control-label">Priority: <span></span></label>
                                        <select class="form-control" id="Priority" name="priority">
                                            <option value="">Select</option>
                                            <option value="High">High</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Low">Low</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Description" class="control-label">Description:</span></label>
                                        <textarea id="Description" class="form-control" maxlength="225" rows="2"
                                            name="description"> {{old('description')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- owner-details -->
                        <div class="owner-details-wrapper">
                            <h4>Owner Details :</h4>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="JobType" class="control-label">Owner Type: <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <select class="form-control" id="JobType" name="owner_type">
                                            <option value="">Select</option>
                                            <option value="Individual">Individual</option>
                                            <option value="Government body">Government body</option>
                                            <option value="Corporate body">Corporate body</option>
                                            <option value="Trustee">Trustee</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for=" CompanyABN" class="control-label">
                                            Company ABN: <span class="mdi mdi-multiplication"></span></label>
                                        <input type="text" class="form-control" id="CompanyABN" name="company_abn"
                                            {{-- disabled --}} value="{{old('company_abn')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="OrganisationName" class="control-label">Organisation Name:
                                            <span class="mdi mdi-multiplication"></span></label>
                                        <select class="form-control" id="OrganisationName" name="organisation_name"
                                            {{-- disabled --}}>
                                            <option value="">Select selected</option>
                                            <option value="1">Select 1</option>
                                            <option value="2">Select 1</option>
                                            <option value="3">Select 1</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="FirstName" class="control-label"> First Name: <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <input type="text" class="form-control" id="FirstName" name="first_name"
                                            value="{{old('first_name')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="LastName" class="control-label"> Last Name: <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <input type="text" class="form-control" id="LastName" name="last_name"
                                            value="{{old('first_name')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Email" class="control-label"> Email:
                                            <span class="mdi mdi-multiplication"></span>
                                        </label>
                                        <input type="email" class="form-control" id="Email" name="email"
                                            value="{{old('email')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Phone" class="control-label"> Phone: <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <input type="text" class="form-control phone" id="Phone" name="phone"
                                            value="{{old('phone')}}">
                                    </div>
                                </div>
                                <!-- <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Mobile" class="control-label"> Mobile: {{-- <span
                                                class="mdi mdi-multiplication"></span></label> --}}
                                        <input type="text" class="form-control" id="Mobile" name="mobile" value="{{old('mobile')}}">
                                    </div>
                                </div> -->
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Mobile" class="control-label"> Mobile: <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <input type="text" class="form-control phone" id="Mobile" name="mobile"
                                            value="{{old('mobile')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="PostalAddressType" class="control-label">Postal Address Type:
                                            <span class="mdi mdi-multiplication"></span></label>
                                        <select class="form-control" id="PostalAddressType"
                                            name="owner_postal_address_type">
                                            <option value="">select</option>
                                            <option value="1">physical address</option>
                                            <option value="2">P.O BOX</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="UnitType" class="control-label">Unit Type:
                                        </label>
                                        <select class="form-control" id="UnitType" name="owner_unit_type">
                                            <option value="">Select</option>
                                            @php
                                            foreach($unit_type as $key=>$unittype){
                                            @endphp
                                            <option value="{{$unittype->id}}">{{$unittype->unit_type_value}}</option>
                                            @php
                                            }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="UnitNumber" class="control-label"> Unit Number: </label>
                                        <input type="text" class="form-control" id="UnitNumber" name="owner_unit_number"
                                            value="{{old('owner_unit_number')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">

                                        <label for="Search" class="control-label"> Search Address </label>

                                        <input type="text" class="form-control" id="SearchAddressone"
                                            placeholder="Search Address" name="search_address" autocomplete="off">

                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display:none" id="SearchAddressdiv1">

                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetNumber" class="control-label"> Street Number: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="StreetNumber"
                                            name="owner_street_number" value="{{old('owner_street_number')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetName" class="control-label"> Street Name: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="StreetName" name="owner_street_name"
                                            value="{{old('owner_street_name')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="StreetType" class="control-label">Street Type:
                                            <span class="mdi mdi-multiplication"></span></label>
                                        <select class="form-control" id="StreetType" name="owner_street_type">
                                            <option value="">Select</option>
                                            @php
                                            foreach($street_types as $key=>$street_type){
                                            @endphp
                                            <option value="{{$street_type->id}}">{{$street_type->street_type_value}}
                                            </option>
                                            @php
                                            }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display:none" id="SearchAddressdiv2">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Town" class="control-label"> Town: <span
                                                class="mdi mdi-multiplication"></span>
                                        </label>
                                        <input type="text" class="form-control" id="Town" name="owner_town"
                                            value="{{old('owner_town')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="State" class="control-label"> State: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="State" name="owner_state"
                                            {{-- disabled --}} value="{{old('owner_state')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="PostCode" class="control-label"> Post Code: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="PostCode" name="owner_post_code"
                                            value="{{old('owner_post_code')}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Inastallation Adress -->
                        <div class="installation-address-wrapper">
                            <h4>Installation Address :</h4>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label" for="sameAsOwnerAddre">
                                        Same as Owner Address:
                                    </label>
                                    <input class="form-check-input-reverse" type="checkbox" value="" id="sameAsOwnerAdd"
                                        name="same_as_owner_address" onclick="set_installation_add(this);">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="PostalAddressType" class="control-label">Postal Address Type:
                                            <span class="mdi mdi-multiplication"></span></label>
                                        <select class="form-control" id="PostalAddressType1"
                                            name="installation_postal_address_type">
                                            <option value="">select</option>
                                            <option value="1">physical address</option>
                                            <option value="2">P.O BOX</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="UnitType" class="control-label">Unit Type:
                                            <span class="mdi mdi-multiplication"></span></label>
                                        <select class="form-control" id="UnitType1" name="installation_unit_type">
                                            <option value="">Select</option>
                                            @php
                                            foreach($unit_type as $key=>$unittype){
                                            @endphp
                                            <option value="{{$unittype->id}}">{{$unittype->unit_type_value}}</option>
                                            @php
                                            }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="UnitNumber" class="control-label"> Unit Number: </label>
                                        <input type="text" class="form-control" id="UnitNumber1"
                                            value="{{ old('installation_unit_number')}}"
                                            name="installation_unit_number">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">

                                        <label for="Search" class="control-label"> Search Address </label>

                                        <input type="text" class="form-control" id="sameAsOwnerAddre_copy"
                                            placeholder="Search Address" name="search_address" autocomplete="off">

                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display:none" id="SearchAddressdiv3">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetNumber" class="control-label"> Street Number: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="StreetNumber1"
                                            value="{{ old('installation_street_number')}}"
                                            name="installation_street_number">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetName" class="control-label"> Street Name: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="StreetName1"
                                            value="{{ old('installation_street_name')}}"
                                            name="installation_street_name">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="StreetType" class="control-label">Street Type:
                                            <span class="mdi mdi-multiplication"></span></label>
                                        <select class="form-control" id="StreetType1" name="installation_street_type">
                                            <option value="">Select</option>
                                            @php
                                            foreach($street_types as $key=>$street_type){
                                            @endphp
                                            <option value="{{$street_type->id}}">{{$street_type->street_type_value}}
                                            </option>
                                            @php
                                            }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display:none" id="SearchAddressdiv4">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Town" class="control-label"> Town: <span
                                                class="mdi mdi-multiplication"></span>
                                        </label>
                                        <input type="text" class="form-control" id="Town1"
                                            value="{{ old('installation_town')}}" name="installation_town">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="State" class="control-label"> State: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="State1"
                                            value="{{ old('installation_state')}}" name="installation_state"
                                            {{-- disabled --}}>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="PostCode" class="control-label"> Post Code: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="PostCode1"
                                            value="{{ old('installation_post_code')}}" name="installation_post_code">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- installer start -->
                        <div class="owner-details-wrapper">
                            <h4>Installer:</h4>

                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="Installer" class="control-label">Select Installer: <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <select name="installer_type" class="form-control select2_1"
                                            id="installer_type">
                                            <option></option>
                                            @foreach($installers as $installer)
                                            <option value="{{$installer->id}}">{{$installer->first_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="Designer" class="control-label">Select Designer: <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <select name="Designer_type" class="form-control select2_1" id="Designer_type">
                                            <option></option>
                                            @foreach($Designers as $Designer)
                                            <option value="{{$Designer->id}}">{{$Designer->first_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="Installer_state" class="control-label">Installer State
                                            <span class="mdi mdi-multiplication"></span></label>
                                        <select class="form-control" id="Installer_state" name="Installer_state"
                                            {{-- disabled --}}>
                                            <option value="">Select selected</option>
                                            <option value="1">Select 1</option>
                                            <option value="2">Select 1</option>
                                            <option value="3">Select 1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="Electrician" class="control-label">Select Electrician <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <select class="form-control" id="Electrician" name="Electrician"
                                            {{-- disabled --}}>
                                            <option></option>
                                            @foreach($Electricians as $Electrician)
                                            <option value="{{$Electrician->id}}">{{$Electrician->first_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- installer  end-->

                        <!--panel start -->
						 <input type="button" class="btn btn-info add_field_button"
                                        onclick="add_more_button();" value="Add More Fields">
                        <div class="owner-details-wrapper-panel">
                            <div class="owner-details-wrapperone" id="newone">
                                <div class="heading-one">
                                    <h4>Panels:</h4>
                                   
                                </div>
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="Panels_search" class="control-label"> Quick Search: </label>
                                            <input type="date" class="form-control" id="install_date"
                                                name="install_date[]" value="">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="Title" class="control-label"> Total Number of solar panel
                                            </label>
                                            <input type="text" class="form-control" id="total_no_solar_panel"
                                                name="total_no_solar_panel[]" value="{{old('no_solar_panel')}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                        <div class="form-group select-wrapper">
                                            <label for="Panels_Brand" class="control-label">Brand
                                                <span class="mdi mdi-multiplication"></span></label>
                                            <select class="form-control" id="Panels_Brand" name="Panels_Brand[]"
                                                {{-- disabled --}}>
                                                <option value="">Select selected</option>
                                                <option value="1">Select 1</option>
                                                <option value="2">Select 2</option>
                                                <option value="3">Select 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                        <div class="form-group select-wrapper">
                                            <label for="Model" class="control-label">Model <span
                                                    class="mdi mdi-multiplication"></span></label>
                                            <select class="form-control" id="Panels_Model" name="Panels_Model[]"
                                                {{-- disabled --}}>
                                                <option value="">Select selected</option>
                                                <option value="1">Select 1</option>
                                                <option value="2">Select 2</option>
                                                <option value="3">Select 3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="Title" class="control-label"> Enter number of Solar Panels
                                            </label>
                                            <input type="text" class="form-control" id="enter_no_of_solar_panal"
                                                name="enter_no_of_solar_panal[]" value="{{old('title')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--panel end -->
                        </div>

                        <!-- inverter start -->
						<input type="button" class="btn btn-info add_field_button"
                                        onclick="add_more_inverter_button();" value="Add More Fields">
                        <div class="inventory-wrapper">
                            <div class="owner-details-wrappertwo">
                                <div class="heading-one">
                                    <h4>Inverter:</h4>

                                    
                                </div>

                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="Title" class="control-label"> Quick Search: </label>
                                            <input type="date" class="form-control" id="inverter_Quick_Search"
                                                name="inverter_Quick_Search[]" value="{{old('title')}}">
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                        <div class="form-group select-wrapper">
                                            <label for="inverter_Brand" class="control-label">Brand
                                                <span class="mdi mdi-multiplication"></span></label>
                                            <select class="form-control" id="inverter_Brand" name="inverter_Brand[]"
                                                {{-- disabled --}}>
                                                <option value="">Select selected</option>
                                                <option value="1">Select 1</option>
                                                <option value="2">Select 1</option>
                                                <option value="3">Select 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                        <div class="form-group select-wrapper">
                                            <label for="inverter_Series" class="control-label">Series
                                                <span class="mdi mdi-multiplication"></span></label>
                                            <select class="form-control" id="inverter_Series" name="inverter_Series[]"
                                                {{-- disabled --}}>
                                                <option value="">Select selected</option>
                                                <option value="1">Select 1</option>
                                                <option value="2">Select 1</option>
                                                <option value="3">Select 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                        <div class="form-group select-wrapper">
                                            <label for="inverter_Model" class="control-label">Model
                                                <span class="mdi mdi-multiplication"></span></label>
                                            <select class="form-control" id="inverter_Model" name="inverter_Model[]"
                                                {{-- disabled --}}>
                                                <option value="">Select selected</option>
                                                <option value="1">Select 1</option>
                                                <option value="2">Select 1</option>
                                                <option value="3">Select 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="Enter number of inverter" class="control-label"> Enter number of
                                                inverter </label>
                                            <input type="text" class="form-control" id="Enter_number_of_inverter"
                                                name="Enter_number_of_inverter[]" value="{{old('title')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="rate-dpower-wrapper" id="advanceInstaller">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Rated_Power_Output" class="control-label"> Rated Power Output:
                                        </label>
                                        <input type="text" class="form-control" id="Rated_Power_Output"
                                            value="{{ old('nmi')}}" name="Rated_Power_Output">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="NMI" class="control-label"> Deeming Period: 10 Years </label>
                                        <input type="text" class="form-control" id="Deeming_Period"
                                            value="{{ old('nmi')}}" name="Deeming_Period">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="NMI" class="control-label"> NMI: </label>
                                        <input type="text" class="form-control" id="NMI" value="{{ old('nmi')}}"
                                            name="nmi">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="AdditinalInformation" class="control-label">Additinal Installation
                                            Information:</span></label>
                                        <textarea id="AdditinalInformation" class="form-control" maxlength="225"
                                            rows="2"
                                            name="additional_installation_information">{{ old('additional_installation_information')}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-md-12 mb-3">
                                    <div id="container" class="form-group">
                                        <label for="Status" class="col-md-3 col-12 control-label">Status </label>
                                        <div class="col-md-9 col-12">
                                            <input type="hidden" name="installer_status" id="create_company_status"
                                                value="1">
                                            <div class="switch" id="submit">
                                                <input type="checkbox" checked id="switch-2"
                                                    onclick="update_company_status($(this),'create_company_status');">
                                                <label for="switch-2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center d-flex form-group margin-bottom-0 "
                                    id="buttonWrapper">
                                    <a class="btn btn-primary" href="{{ route('job.index') }}"> Back</a>
                                    <button type="submit"
                                        class="btn btn-info btn-sm waves-effect waves-light">Submit</button>
                                </div>
                            </div>
                        </div>

                        <!-- inverter  end-->

                </form>
            </div>
            <!-- /.card-content -->
        </div>
        <!-- /.box-content -->
    </div>
    <!-- /.col-lg-6 col-xs-12 -->
</div>


@endsection