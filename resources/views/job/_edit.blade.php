@extends('layouts.app')
@section('content')
<div class="row " id="editJob">
    <div class="col-12 ">
        <div class="box-content card white">
            <h4 class="box-title">Edit Job</h4>
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
                <form class="form-horizontal" method="post" action="{{ route('job.update',$job->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3 text-center">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload_installer" name="installer_signature"
                                    accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload_installer"></label>
                            </div>
                            <div class="avatar-preview">
                                <!--  <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);"> -->
                                <div id="imagePreview_installer"
                                    style="background-image: url({{ URL::to('/') }}/{{$job->installer_signature}});">
                                </div>

                                <div class="avtar-checkbox">
                                    <input id="installer_CheckBox" name="installer_CheckBox" type="checkbox" class="cardcheckbox ajaxdownloadimage1" align="right" />
                                    <div id="flip-ch1">
                                        <a id="ajaxdownloadimage1" class="imagedown"
                                            data-imagevalue="{{$job->installer_signature}}" href="#">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label class="py-4" for="imageUpload_installer ">Installer Signature</label>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3 text-center">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload_designer" name="designer_signature"
                                    accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload_designer"></label>
                            </div>
                            <div class="avatar-preview">
                                <!--  <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);"> -->
                                <div id="imagePreview_designer"
                                    style="background-image: url({{ URL::to('/') }}/{{$job->designer_signature}});">
                                </div>
                                <div class="avtar-checkbox">
                                    <input id="designer_CheckBox" name="installer_CheckBox" type="checkbox"
                                        class="cardcheckbox ajaxdownloadimage2" align="right" />
                                    <div id="flip-ch2">
                                        <a id="ajaxdownloadimage2" class="imagedown"
                                            data-imagevalue="{{$job->designer_signature}}" href="#">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label class="py-4" for="imageUpload_designer">Designer Signature</label>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3 text-center">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload_electrician" name="electrician_signature"
                                    accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload_electrician"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview_electrician"
                                    style="background-image: url({{ URL::to('/') }}/{{$job->electrician_signature}});">
                                </div>
                                <div class="avtar-checkbox">
                                    <input id="electrician_CheckBox" name="installer_CheckBox" type="checkbox"
                                        class="cardcheckbox ajaxdownloadimage3" align="right" />
                                    <div id="flip-ch3">
                                        <a id="ajaxdownloadimage3" class="imagedown"
                                            data-imagevalue="{{$job->electrician_signature}}" href="#">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label class="py-4" for="imageUpload_electrician">Electrician Signature</label>

                    </div>


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
                                            <option value="PVD" @if($job->job_type == 'PVD') selected="true" @endif>PVD
                                            </option>
                                            <option value="SWH" @if($job->job_type == 'SWH') selected="true" @endif>SWH
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="ReferenceNumber" class="control-label">
                                            Reference Number <span class="mdi mdi-multiplication"></span></label>
                                        <input type="text" class="form-control" id="ReferenceNumber"
                                            name="reference_number" value="{{$job->reference_number}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="JobStage" class="control-label">Job Stage: <span></span></label>
                                        <select class="form-control" id="JobStage" name="job_stage">
                                            <option value="">Select</option>
                                            <option value="First Time Install" @if($job->job_stage == 'First Time
                                                Install') selected="true" @endif>First Time Install</option>
                                            <option value="Additional System" @if($job->job_stage == 'Additional
                                                System') selected="true" @endif>Additional System</option>
                                            <option value="Replacement System" @if($job->job_stage == 'Replacement
                                                System')
                                                selected="true" @endif>Replacement System</option>
                                            <option value="Extension" @if($job->job_stage == 'Extension')
                                                selected="true" @endif>Extension</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="InstallationDate" class="control-label">Installation Date:</label>
                                        <div class="input-group col-sm-12">
                                            <input type="date" class="form-control" id="InstallationDate"
                                                name="installation_date" value="{{$job->installation_date}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="Priority" class="control-label">Priority: <span></span></label>
                                        <select class="form-control" id="Priority" name="priority">
                                            <option value="">Select</option>
                                            <option value="High" @if($job->priority == 'High') selected="true"
                                                @endif>High</option>
                                            <option value="Normal" @if($job->priority == 'Normal') selected="true"
                                                @endif>Normal</option>
                                            <option value="Low" @if($job->priority == 'Low') selected="true" @endif>Low
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Description" class="control-label">Description:</span></label>
                                        <textarea id="Description" class="form-control" maxlength="225" rows="2"
                                            name="description" value="">{{$job->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                            <option value="Individual" @if($job->owner_type == 'Individual')
                                                selected="true" @endif>Individual</option>
                                            <option value="Government body" @if($job->owner_type == 'Government body')
                                                selected="true" @endif>Government body</option>
                                            <option value="Corporate body" @if($job->owner_type == 'Corporate body')
                                                selected="true" @endif>Corporate body</option>
                                            <option value="Trustee" @if($job->owner_type == 'Trustee') selected="true"
                                                @endif>Trustee</option>
                                        </select>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="OrganisationName" class="control-label">Company Name:</label>
                                        <input type="text" class="form-control" id="OrganisationName"
                                            name="organisation_name" value="{{$job->organisation_name}}">
                                        <!-- <select class="form-control" id="OrganisationName" name="organisation_name"
                                            <option value="">Select selected</option>
                                            <option value="1" @if($job->organisation_name == '1') selected="true"
                                                @endif>Select 1</option>
                                            <option value="2" @if($job->organisation_name == '2') selected="true"
                                                @endif>Select 1</option>
                                            <option value="3" @if($job->organisation_name == '3') selected="true"
                                                @endif>Select 1</option>
                                        </select> -->
                                    </div>
                                </div>


                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for=" CompanyABN" class="control-label">
                                            Company ABN:</label>
                                        <input type="text" class="form-control" id="CompanyABN" name="company_abn"
                                            {{-- disabled --}} value="{{$job->company_abn}}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="FirstName" class="control-label"> First Name: <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <input type="text" class="form-control" id="FirstName" name="first_name"
                                            value="{{$job->first_name}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="LastName" class="control-label"> Last Name: <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <input type="text" class="form-control" id="LastName" name="last_name"
                                            value="{{$job->last_name}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Email" class="control-label"> Email:
                                        </label>
                                        <input type="email" class="form-control" id="Email" name="email"
                                            value="{{$job->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Mobile" class="control-label"> Mobile:</label>
                                        <input type="text" class="form-control phone" id="Mobile" maxlength="10"
                                            name="mobile" value="{{$job->mobile}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Phone" class="control-label"> Secondary Contact: </label>
                                        <input type="text" class="form-control phone" id="Phone" maxlength="10"
                                            name="phone" value="{{$job->phone}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="PostalAddressType" class="control-label">Postal Address Type:
                                        </label>
                                        <select class="form-control" id="PostalAddressType"
                                            name="owner_postal_address_type">
                                            <option value="">select</option>
                                            <option value="1" @if($job->owner_postal_address_type == '1')
                                                selected="true" @endif>physical address</option>
                                            <option value="2" @if($job->owner_postal_address_type == '2')
                                                selected="true" @endif>P.O BOX</option>
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
                                            <option value="{{$unittype->id}}" @if($job->owner_unit_type ==
                                                $unittype->id) selected="true" @endif>{{$unittype->unit_type_value}}
                                            </option>
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
                                            value="{{$job->owner_unit_number}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">

                                        <label for="Search" class="control-label"> Search Address </label>

                                        <input type="text" class="form-control" id="SearchAddress_sign2"
                                            placeholder="Search Address" name="search_address" autocomplete="off">

                                        <input type="hidden" id="address_latitude" name="address_latitude">

                                        <input type="hidden" id="address_longitude" name="address_longitude">




                                    </div>
                                </div>
                            </div>
                            @if($job->owner_street_number != '' || $job->owner_street_name != '' || $job->street_type_value !='')
                            <div class="row" id="SearchAddressdiv1" >
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetNumber" class="control-label"> Street Number: </label>
                                        <input type="text" class="form-control" id="StreetNumber"
                                            name="owner_street_number" value="{{$job->owner_street_number}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetName" class="control-label"> Street Name: </label>
                                        <input type="text" class="form-control" id="StreetName" name="owner_street_name"
                                            value="{{$job->owner_street_name}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="StreetType" class="control-label">Street Type:
                                        </label>
                                        <select class="form-control" id="StreetType" name="owner_street_type">
                                            <option value="">Select</option>
                                            @php
                                            foreach($street_types as $key=>$street_type){
                                            @endphp
                                            <option value="{{$street_type->id}}" @if($job->owner_street_type ==
                                                $street_type->id) selected="true"
                                                @endif>{{$street_type->street_type_value}}</option>
                                            @php
                                            }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($job->owner_town != '' || $job->owner_state != '' || $job->owner_post_code !='')
                            <div class="row" id="SearchAddressdiv2">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Town" class="control-label"> Town:
                                        </label>
                                        <input type="text" class="form-control" id="Town" name="owner_town"
                                            value="{{$job->owner_town}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="State" class="control-label"> State: </label>
                                        <select class="form-control" id="State" name="owner_state">
                                            <option value="">Select</option>
                                            @php
                                            foreach($states as $key=>$state){
                                            @endphp
                                            <option value="{{$state->id}}" @if($job->owner_state ==
                                                $state->id) selected="true"
                                                @endif>{{$state->au_state_name}}</option>
                                            @php
                                            }
                                            @endphp
                                        </select>
                                        <!-- <input type="text" class="form-control" id="State" name="owner_state"
                                            {{-- disabled --}} value="{{$job->owner_state}}"> -->
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="PostCode" class="control-label"> Post Code: </label>
                                        <input type="text" class="form-control" id="PostCode" name="owner_post_code"
                                            value="{{$job->owner_post_code}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="story" class="control-label"> Story Type:</label>
                                        <select class="form-control" id="story" name="story_type">
                                            <option value="">Select</option>
                                            <option value="a" @if($job->story_type == "a") selected="true" @endif>a</option>
                                            <option value="b" @if($job->story_type == "b") selected="true" @endif>b</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="property" class="control-label"> Property Type:</label>
                                        <select class="form-control" id="property" name="property_type">
                                            <option value="">Select</option>
                                            <option value="p1" @if($job->property_type == "p1") selected="true" @endif>p1</option>
                                            <option value="p2" @if($job->property_type == "p2") selected="true" @endif>p2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Meter_no" class="control-label"> Meter No: </label>
                                        <input type="text" class="form-control" id="Meter_no" name="owner_meter_number"
                                            value="{{$job->owner_meter_number}}">
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Inastallation Adress -->
                        <div class="installation-address-wrapper">
                            <h4>Installation Address :</h4>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label" for="sameAsOwnerAddre">
                                        Same as Owner Address:
                                    </label>
                                    <input class="form-check-input-reverse" type="checkbox" value=""
                                        id="sameAsOwnerAddre" name="same_as_owner_address"
                                        @if($job->same_as_owner_address == 1) checked="checked" @endif
                                    onclick="set_installation_add(this);">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="PostalAddressType" class="control-label">Postal Address Type:
                                        </label>
                                        <select class="form-control" id="PostalAddressType1"
                                            name="installation_postal_address_type">
                                            <option value="">select</option>
                                            <option value="1" @if($job->installation_postal_address_type == 1) selected
                                                ="true" @endif>physical address</option>
                                            <option value="2" @if($job->installation_postal_address_type == 2)
                                                selected="true" @endif>P.O BOX</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="UnitType" class="control-label">Unit Type:
                                        </label>
                                        <select class="form-control" id="UnitType1" name="installation_unit_type">
                                            <option value="">Select</option>
                                            @php
                                            foreach($unit_type as $key=>$unittype){
                                            @endphp
                                            <option value="{{$unittype->id}}" @if($job->installation_unit_type ==
                                                $unittype->id) selected="true" @endif>{{$unittype->unit_type_value}}
                                            </option>
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
                                            name="installation_unit_number" value="{{$job->installation_unit_number}}">
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
                            @if($job->installation_street_number != '' || $job->installation_street_name != '' ||
                            $job->street_type_value !='')
                            <div class="row" id="SearchAddressdiv3">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetNumber" class="control-label"> Street Number: </label>
                                        <input type="text" class="form-control" id="StreetNumber1"
                                            name="installation_street_number"
                                            value="{{$job->installation_street_number}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetName" class="control-label"> Street Name:</label>
                                        <input type="text" class="form-control" id="StreetName1"
                                            name="installation_street_name" value="{{$job->installation_street_name}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="StreetType" class="control-label">Street Type:</label>
                                        <select class="form-control" id="StreetType1" name="installation_street_type">
                                            <option value="">Select</option>
                                            @php
                                            foreach($street_types as $key=>$street_type){
                                            @endphp
                                            <option value="{{$street_type->id}}" @if($job->installation_street_type ==
                                                $street_type->id) selected="true"
                                                @endif>{{$street_type->street_type_value}}</option>
                                            @php
                                            }
                                            @endphp
                                        </select>
                                    </div>
                                    @endif
                                </div>


                                @if($job->installation_town != '' || $job->installation_state != '' ||
                                $job->installation_post_code !='')
                                <div class="row" id="SearchAddressdiv4">
                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="Town" class="control-label"> Town:
                                            </label>
                                            <input type="text" class="form-control" id="Town1" name="installation_town"
                                                value="{{$job->installation_town}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="State" class="control-label"> State:</label>

                                            <select class="form-control" id="State1" name="installation_state">
                                                <option value="">Select</option>
                                                @php
                                                foreach($states as $key=>$state){
                                                @endphp
                                                <option value="{{$state->id}}" @if($job->installation_state ==
                                                    $state->id) selected="true"
                                                    @endif>{{$state->au_state_name}}</option>
                                                @php
                                                }
                                                @endphp
                                            </select>
                                            <!-- <input type="text" class="form-control" id="State1"
                                                name="installation_state" {{-- disabled --}}
                                                value="{{$job->installation_state}}"> -->
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="PostCode" class="control-label"> Post Code:</label>
                                            <input type="text" class="form-control" id="PostCode1"
                                                name="installation_post_code" value="{{$job->installation_post_code}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- installer start -->
                        <div class="owner-details-wrapper">
                            <h4>Installer:</h4>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="Installer" class="control-label">Select Installer: </label>
                                        <select name="installer_type" class="form-control select2_1"
                                            id="installer_type">
                                            <option></option>
                                            @php
                                            foreach($installers as $k=>$installer){
                                            @endphp
                                            @if($job->installer_type == $installer->id)
                                            <option value="{{$installer->id}}" selected>{{$installer->first_name}}
                                            </option>
                                            @else
                                            <option value="{{$installer->id}}">{{$installer->first_name}}</option>
                                            @endif

                                            @php
                                            }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="Designer" class="control-label">Select Designer: </label>
                                        <select name="Designer_type" class="form-control select2_1" id="Designer_type">
                                            <option></option>

                                            @php
                                            foreach($Designers as $k=>$Designer){
                                            @endphp
                                            @if($job->Designer_type == $Designer->id)
                                            <option value="{{$Designer->id}}" selected>{{$Designer->first_name}}
                                            </option>
                                            @else
                                            <option value="{{$Designer->id}}">{{$Designer->first_name}}</option>
                                            @endif

                                            @php
                                            }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="Electrician" class="control-label">Select Electrician</label>
                                        <select class="form-control" id="Electrician" name="Electrician" ><option>
                                            </option>

                                            @php
                                            foreach($Electricians as $k=>$Electrician){
                                            @endphp
                                            @if($job->Electrician == $Electrician->id)
                                            <option value="{{$Electrician->id}}" selected>
                                                {{$Electrician->first_name}}</option>
                                            @else
                                            <option value="{{$Electrician->id}}">{{$Electrician->first_name}}
                                            </option>
                                            @endif

                                            @php
                                            }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="Installer_state" class="control-label">Installer State
                                        </label>
                                        <select class="form-control" id="Installer_state" name="Installer_state"> <option
                                            value="">Select selected</option>

                                            <option value="1" @if($job->Installer_state == '1') selected="true"
                                                @endif>Select 1</option>
                                            <option value="2" @if($job->Installer_state == '2') selected="true"
                                                @endif>Select 1</option>
                                            <option value="3" @if($job->Installer_state == '3') selected="true"
                                                @endif>Select 1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="AdditinalInformation" class="control-label">Additinal
                                            Installation
                                            Information:</span></label>
                                        <textarea id="AdditinalInformation" class="form-control" maxlength="225" rows="2"
                                            name="additional_installation_information"> {{$job->additional_installation_information}}</textarea>
                                    </div>
                                </div>
                                <!-- <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="AdditinalInformation" class="control-label">Installer
                                            Notes:</span></label>
                                        <textarea id="AdditinalInformation" class="form-control" maxlength="225"
                                            rows="2"
                                            name="additional_installation_information"> {{$job->additional_installation_information}}</textarea>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- installer  end-->

                        <!--panel start -->
                        <div class="add-field-wrapper">
                            <div class="col-xl-8 col-lg-10 col-md-12 mb-8">
                                <div class="form-group" style="display:none;">
                                    <label for="Title" class="control-label"> Total Number of solar panel
                                    </label>
                                    <input type="text" class="one" id="sum" name="sum"
                                        value="{{old('no_solar_panel')}}">
                                </div>
                            </div>
                        </div>

                        <div class="owner-details-wrapper-main-panel">
                            <div class="owner-details-wrapper-panel">

                                @if(empty($panels))
                                <div class="owner-details-wrapperone">
                                    <div class="heading-one">
                                        <h4>Panels:</h4>


                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                            <div class="form-group autocomplete">
                                                <label for="Panels_search" class="control-label"> Quick Search: </label>

                                                <input type="text" class="form-control quick_search" id="install_date"
                                                    name="install_date[]" value="">

                                            </div>
                                        </div>


                                        <div class="Brand col-xl-4 col-lg-4 col-md-12 mb-3">
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
                                        <div class="Model col-xl-4 col-lg-4 col-md-12 mb-3">
                                            <div class="form-group select-wrapper">
                                                <label for="Model" class="control-label">Model<span
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
                                                    name="enter_no_of_solar_panal[]" value="" onkeyup="rated_power()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                @foreach($panels as $k=>$panel)   
                                    
                                <div class="owner-details-wrapperone">
                                    <div class="heading-one">
                                        <h4>Panels:</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                            <div class="form-group autocomplete">
                                                <label for="Panels_search" class="control-label"> Quick Search: </label>

                                                <input type="text" class="form-control quick_search" id='install_date{{$k}}'
                                                    name="install_date[]" value="{{$panel->install_date}}">
                                            </div>
                                        </div>

                                        <div class="Brand col-xl-4 col-lg-4 col-md-12 mb-3">
                                            <div class="form-group select-wrapper">
                                                <label for="Panels_Brand" class="control-label">Brand
                                                    <span class="mdi mdi-multiplication"></span></label>
                                                <select class="form-control" id="Panels_Brand" name="Panels_Brand[]">
                                                    <option value="">Select selected</option>
                                                    @if(in_array($panel->Panels_Brand,array(1,2,3)) || !isset($panel->Panels_Brand))
                                                        <option value="1" @if($panel->Panels_Brand == '1')
                                                            selected="true"
                                                            @endif>Select 1</option>
                                                        <option value="2" @if($panel->Panels_Brand == '2')
                                                            selected="true"
                                                            @endif>Select 1</option>
                                                        <option value="3" @if($panel ->Panels_Brand == '3')
                                                            selected="true"
                                                            @endif>Select 1</option>
                                                    @elseif(isset($panel->Panels_Brand))
                                                        <option value="{{$panel->Panels_Brand}}" selected="true">{{$panel->Panels_Brand}}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="Model col-xl-4 col-lg-4 col-md-12 mb-3">
                                            <div class="form-group select-wrapper">
                                                <label for="Model" class="control-label">Model<span
                                                        class="mdi mdi-multiplication"></span></label>
                                                <select class="form-control" id="Panels_Model" name="Panels_Model[]">
                                                    <option value="">Select selected</option>
                                                    @if(in_array($panel->Panels_Model,array(1,2,3)) || !isset($panel->Panels_Model))
                                                        <option value="1" @if($panel->Panels_Model == '1') selected="true"
                                                            @endif>Select 1</option>
                                                        <option value="2" @if($panel->Panels_Model == '2') selected="true"
                                                            @endif>Select 1</option>
                                                        <option value="3" @if($panel ->Panels_Model == '3') selected="true"
                                                            @endif>Select 1</option>
                                                    @elseif(isset($panel->Panels_Brand))
                                                        <option value="{{$panel->Panels_Model}}" selected="true">{{$panel->Panels_Model}}</option>
                                                    @endif    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                            <div class="form-group">
                                                <label for="Title" class="control-label"> Enter number of Solar Panels
                                                </label>
                                                <input type="text" class="form-control" id="enter_no_of_solar_panal"
                                                    name="enter_no_of_solar_panal[]"
                                                    value="{{$panel ->enter_no_of_solar_panal}}"
                                                    onkeyup="rated_power()">
                                            </div>
                                        </div>
                                    </div>
                                    @if($k != 0)
                                    <a href="#" class="btn btn-primary remove_field">Delete</a>
                                    @endif
                                </div>
                                @endforeach
                                @endif

                            </div>
                            <input type="button" class="btn btn-info add_field_button" onclick="add_more_button();"
                                value="Add More Fields">
                        </div>

                        <!--panel end -->

                        <!-- inverter start -->
                        <div class="add-field-wrapper">


                        </div>

                        <div class=inventory-main-wrapper>
                            <div class="inventory-wrapper">

                                @if(empty($inverters))
                                <div class="owner-details-wrappertwo">
                                    <div class="heading-one">
                                        <h4>Inverter:</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                            <div class="form-group autocomplete">
                                                <label for="Title" class="control-label"> Quick Search: </label>
                                                <input type="text" class="form-control quick_search_inverter" id="inverter_Quick_Search"
                                                    name="inverter_Quick_Search[]" value="{{old('title')}}">
                                            </div>
                                        </div>

                                        <div class="Brand col-xl-4 col-lg-4 col-md-12 mb-3">
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
                                        <div class="Series col-xl-4 col-lg-4 col-md-12 mb-3">
                                            <div class="form-group select-wrapper">
                                                <label for="inverter_Series" class="control-label">Series
                                                    <span class="mdi mdi-multiplication"></span></label>
                                                <select class="form-control" id="inverter_Series"
                                                    name="inverter_Series[]" {{-- disabled --}}>
                                                    <option value="">Select selected</option>
                                                    <option value="1">Select 1</option>
                                                    <option value="2">Select 1</option>
                                                    <option value="3">Select 1</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="Model col-xl-4 col-lg-4 col-md-12 mb-3">
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
                                                <label for="Enter number of inverter" class="control-label"> Enter
                                                    number of
                                                    inverter </label>
                                                <input type="text" class="form-control" id="Enter_number_of_inverter"
                                                    name="Enter_number_of_inverter[]" value="{{old('title')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else


                                @foreach($inverters as $k=>$inverter)
                                <div class="owner-details-wrappertwo">
                                    <div class="heading-one">
                                        <h4>Inverter:</h4>

                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                            <div class="form-group  autocomplete">
                                                <label for="Title" class="control-label"> Quick Search: </label>
                                                <input type="text" class="form-control quick_search_inverter" id="inverter_Quick_Search{{$k}}"
                                                    name="inverter_Quick_Search[]"
                                                    value="{{$inverter->inverter_Quick_Search_date}}">
                                            </div>
                                        </div>

                                        <div class="Brand col-xl-4 col-lg-4 col-md-12 mb-3">
                                            <div class="form-group select-wrapper">
                                                <label for="inverter_Brand" class="control-label">Brand
                                                    <span class="mdi mdi-multiplication"></span></label>
                                                <select class="form-control" id="inverter_Brand"
                                                    name="inverter_Brand[]">
                                                    <option value="">Select selected</option>
                                                    @if(in_array($inverter->inverter_Brand,array(1,2,3)) || !isset($inverter->inverter_Brand))
                                                        
                                                        <option value="1" @if($inverter->inverter_Brand == '1')
                                                            selected="true"
                                                            @endif>Select 1</option>
                                                        <option value="2" @if($inverter->inverter_Brand == '2')
                                                            selected="true"
                                                            @endif>Select 1</option>
                                                        <option value="3" @if($inverter ->inverter_Brand == '3')
                                                            selected="true"
                                                            @endif>Select 1</option>
                                                    @elseif(isset($inverter->inverter_Brand))
                                                        <option value="{{$inverter->inverter_Brand}}" selected="true">{{$inverter->inverter_Brand}}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="Series col-xl-4 col-lg-4 col-md-12 mb-3">
                                            <div class="form-group select-wrapper">
                                                <label for="inverter_Series" class="control-label">Series
                                                    <span class="mdi mdi-multiplication"></span></label>
                                                <select class="form-control" id="inverter_Series"
                                                    name="inverter_Series[]">
                                                    <option value="">Select selected</option>
                                                    @if(in_array($inverter->inverter_Series,array(1,2,3)) || !isset($inverter->inverter_Series))
                                                        <option value="1" @if($inverter->inverter_Series == '1')
                                                            selected="true"
                                                            @endif>Select 1</option>
                                                        <option value="2" @if($inverter->inverter_Series == '2')
                                                            selected="true"
                                                            @endif>Select 1</option>
                                                        <option value="3" @if($inverter ->inverter_Series == '3')
                                                            selected="true" @endif>Select 1</option>
                                                    @elseif(isset($inverter->inverter_Series))
                                                        <option value="{{$inverter->inverter_Series}}" selected="true">{{$inverter->inverter_Series}}</option>
                                                    @endif        
                                                </select>
                                            </div>
                                        </div>
                                        <div class="Model col-xl-4 col-lg-4 col-md-12 mb-3">
                                            <div class="form-group select-wrapper">
                                                <label for="inverter_Model" class="control-label">Model
                                                    <span class="mdi mdi-multiplication"></span></label>
                                                <select class="form-control" id="inverter_Model"
                                                    name="inverter_Model[]">
                                                    <option value="">Select selected</option>
                                                    @if(in_array($inverter->inverter_Series,array(1,2,3)) || !isset($inverter->inverter_Model))
                                                        <option value="1" @if($inverter->inverter_Model == '1')
                                                            selected="true"
                                                            @endif>Select 1</option>
                                                        <option value="2" @if($inverter->inverter_Model == '2')
                                                            selected="true"
                                                            @endif>Select 1</option>
                                                        <option value="3" @if($inverter ->inverter_Model == '3')
                                                            selected="true"
                                                            @endif>Select 1</option>
                                                    @elseif(isset($inverter->inverter_Model))
                                                        <option value="{{$inverter->inverter_Model}}" selected="true">{{$inverter->inverter_Model}}</option>
                                                    @endif         
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                            <div class="form-group">
                                                <label for="Enter number of inverter" class="control-label"> Enter
                                                    number of
                                                    inverter </label>
                                                <input type="text" class="form-control" id="Enter_number_of_inverter"
                                                    name="Enter_number_of_inverter[]"
                                                    value="{{$inverter ->Enter_number_of_inverter}}">
                                            </div>
                                        </div>
                                    </div>
                                    @if($k != 0)
                                    <a href="#" class="btn btn-primary remove_field">Delete</a>
                                    @endif
                                </div>
                                @endforeach
                                


                            </div>
                            @endif
                            <input type="button" class="btn btn-info add_field_button"
                                onclick="add_more_inverter_button();" value="Add More Fields">
                        </div>

                        <div class="rate-dpower-wrapper" id="advanceInstaller">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Rated_Power_Output" class="control-label"> Rated Power
                                            Output:
                                        </label>
                                        <input type="text" class="form-control" id="Rated_Power_Output"
                                            value="{{ $job->Rated_Power_Output}}" name="Rated_Power_Output"
                                            readonly="readonly">
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label  class="control-label"> Deeming Period:
                                        </label>
                                        <select class="form-control" id="Deeming_Period" name="Deeming_Period"
                                            {{-- disabled --}}>
                                            <option value="">Select</option>
                                            <option value="1" @if($job->Deeming_Period == '1') selected="true" @endif>10
                                                Years</option>
                                            <option value="2" @if($job->Deeming_Period == '2') selected="true" @endif>20
                                                Years</option>
                                            <option value="3" @if($job->Deeming_Period == '3') selected="true" @endif>30
                                                Years</option>
                                        </select>
                                        <!-- <input type="text" class="form-control" id="Deeming_Period"
                                            value="{{$job->Deeming_Period}}" name="Deeming_Period"> -->
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="NMI" class="control-label"> NMI: </label>
                                        <input type="text" class="form-control" id="NMI" name="nmi"
                                            value="{{$job->nmi}}">
                                    </div>
                                </div>

                               
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3 @if(!isset($job->grid_appication_reference_number)) hidden @endif" id=garn_div>
                                    <div class="form-group">
                                        <label  class="control-label"> Grid Application Reference Number :
                                        </label>
                                        <input type="text" class="form-control" id="GARN"
                                            name="grid_appication_reference_number"
                                            value="{{$job->grid_appication_reference_number}}">
                                    </div>
                                </div>
                                

                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Meter" class="control-label"> Meter Number: </label>
                                        <input type="text" class="form-control" id="Meter" name="meter_no" value="{{$job->meter_no}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Distributor" class="control-label"> Distributor: <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <input type="text" class="form-control" id="Distributor" name="distributor" value="{{$job->distributor}}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label  class="control-label"> Replacing Panel: </label>
                                        @if($job->replacing_panels == "yes")
                                        <input class="form-check-input replacing_panels" type="checkbox" id="no" name="replacing_panels"
                                            value="yes" checked="" style="margin: 5px 10px 5px 10px;">Yes
                                        @else
                                        <input class="form-check-input replacing_panels" type="checkbox" id="no" name="replacing_panels"
                                            value="yes" style="margin: 5px 10px 5px 10px;">Yes
                                        @endif
                                        @if($job->replacing_panels == "no")
                                        <input class="form-check-input replacing_panels" type="checkbox" id="no" name="replacing_panels"
                                            value="no" checked="" style="margin: 5px 10px 5px 10px;">No
                                        @else
                                        <input class="form-check-input replacing_panels" type="checkbox" id="no" name="replacing_panels"
                                            value="no" style="margin: 5px 10px 5px 10px;">No
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">

                                        <label class="control-label"> Additional Panel: </label>
                                        @if($job->Additionalpanels == "yes")
                                        <input class="form-check-input Additionalpanels" type="checkbox" id="no" name="Additionalpanels"
                                            value="yes" checked="" style="margin: 5px 10px 5px 10px;"> Yes
                                        @else
                                        <input class="form-check-input Additionalpanels" type="checkbox" id="no" name="Additionalpanels"
                                            value="yes" style="margin: 5px 10px 5px 10px;">Yes
                                        @endif
                                        @if($job->Additionalpanels == "no")
                                        <input class="form-check-input Additionalpanels" type="checkbox" id="no" name="Additionalpanels"
                                            value="no" checked="" style="margin: 5px 10px 5px 10px;">No
                                        @else
                                        <input class="form-check-input Additionalpanels" type="checkbox" id="no" name="Additionalpanels"
                                            value="no" style="margin: 5px 10px 5px 10px;">No
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label  class="control-label"> System Installed: </label>
                                        @if($job->system_installed == "yes")
                                        <input class="form-check-input system_installed" type="checkbox" id="no" name="system_installed"
                                            value="yes" checked="" style="margin: 5px 10px 5px 10px;">Yes
                                        @else
                                        <input class="form-check-input system_installed" type="checkbox" id="no" name="system_installed"
                                            value="yes" style="margin: 5px 10px 5px 10px;">Yes
                                        @endif
                                        @if($job->system_installed == "no")
                                        <input class="form-check-input system_installed" type="checkbox" id="no" name="system_installed"
                                            value="no" checked="" style="margin: 5px 10px 5px 10px;">No
                                        @else
                                        <input class="form-check-input system_installed" type="checkbox" id="no" name="system_installed"
                                            value="no" style="margin: 5px 10px 5px 10px;">No
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3"  id="panel_serial">
                                    <div class="form-group">
                                        <label for="Panel Serial Numbers" class="control-label"> Panel Serial Numbers
                                        </label>


                                        @php $i = 0; @endphp
                                        @foreach($panels as $key=>$panel)

                                        @foreach($panel->panel_serial_no as $pkey=>$serial_no)
                                        @php ++$i; @endphp
                                        <div id="Panel_Serial_Numbers{{$i}}" class="d-flex mb-2 align-items-center ">
                                            <input type="text" class="form-control" id="Panel_Serial_Numbers"
                                                name="Panel_Serial_Numbers[{{$key}}][]" value={{$serial_no}}
                                                @if($panel->panel_serial_no_scanned[$pkey]['scanned'] == '1')
                                            style="background-color: #21c021;color: #fff;";
                                            @endif>
                                            <input type="checkbox" name="locationthemes"
                                                value="{{$panel->panel_serial_no_scanned[$pkey]['panel_iamge']}}"
                                                class="panel_image_save" 
                                                @if(isset($panel->panel_serial_no_scanned[$pkey]['panel_iamge']) && $panel->panel_serial_no_scanned[$pkey]['panel_iamge'] =='')
                                                disabled
                                                @endif
                                                />

                                            @if(isset($panel->panel_serial_no_scanned[$pkey]['panel_iamge']) &&
                                            $panel->panel_serial_no_scanned[$pkey]['panel_iamge'] !='')
                                            <img src="{{URL::to('/')}}/{{$panel->panel_serial_no_scanned[$pkey]['panel_iamge']}}"
                                                height="30" width="30">
                                            @else
                                            <img src="{{URL::to('/')}}/assets/images/no-img.png" height="30" width="30">
                                            @endif
                                           

                                            <input type="hidden" class="" id="panel_delete_{{$i}}"
                                                name="Panel_Serial_Numbers_Delete[{{$key}}][]" value="1" class="btn btn-primary panel_delete" >
                                            <input type="button" class="btn btn-primary panel_delete" id="{{$i}}"
                                                value="Delete">


                                            </br>
                                        </div>
                                        @endforeach
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3" id="invetrers_serial">
                                    <div class="form-group">
                                        <label for="Invetrers Serial Numbers" class="control-label"> Invetrers Serial
                                            Numbers
                                        </label>

                                        @php $i = 0; @endphp
                                        @foreach($inverters as $key=>$inverter)

                                        @foreach($inverter->inverter_serial_no as $ikey=>$serial_no)
                                        @php ++$i; @endphp
                                        <div id="Invetrers_Serial_Numbers{{$i}}" class="d-flex mb-2 align-items-center">
                                            <input type="text" class="form-control" id="Invetrers_Serial_Numbers"
                                                name="Invetrers_Serial_Numbers[{{$key}}][]" value={{$serial_no}}
                                                @if($inverter->inverter_serial_no_scanned[$ikey]['scanned'] == '1')
                                            style="background-color: #21c021;color: #fff;";
                                            @endif>
                                            <!-- edit code -->
                                            <input type="checkbox" name="locationthemes"
                                                value="{{$inverter->inverter_serial_no_scanned[$ikey]['inverter_image']}}"
                                                class="panel_image_save"
                                                @if(isset($inverter->inverter_serial_no_scanned[$ikey]['inverter_image']) && $inverter->inverter_serial_no_scanned[$ikey]['inverter_image'] =='')
                                                disabled
                                                @endif
                                                />

                                                
                                            @if(isset($inverter->inverter_serial_no_scanned[$ikey]['inverter_image']) &&
                                            $inverter->inverter_serial_no_scanned[$ikey]['inverter_image'] !='')
                                            <img src="{{URL::to('/')}}/{{$inverter->inverter_serial_no_scanned[$ikey]['inverter_image']}}"
                                                height="30" width="30">
                                            @else
                                            <img src="{{URL::to('/')}}/assets/images/no-img.png" height="30" width="30">
                                            @endif
                                           

                                            <input type="hidden" id="invetrers_delete_{{$i}}"
                                                name="Invetrers_Serial_Numbers_Delete[{{$key}}][]" value="1" class="btn btn-primary invetrers_delete">
                                            <input type="button" class="btn btn-primary invetrers_delete" id="{{$i}}"
                                                value="Delete">
                                        </div>
                                        @endforeach
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Status" class="control-label">Status </label>
                                        <select class="form-control" id="edit_job_status" name="job_status">
                                            <option value="">Select</option>
                                            <option value="Pending" @if($job->job_status == 'Pending') selected="true"
                                                @endif>Pending</option>
                                            <option value="In Progress" @if($job->job_status == 'In Progress')
                                                selected="true" @endif>In Progress</option>
                                            <option value="Completed By Installer" @if($job->job_status == 'Completed By
                                                Installer') selected="true" @endif>Completed By Installer</option>
                                            <option value="Completed By Company" @if($job->job_status == 'Completed By
                                                Company') selected="true" @endif>Completed By Company</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            @if($panel_image_count >0 || $inverter_image_count>0)
                            <div class="row">
                                <!-- <div class="col-xl-4 col-lg-4 col-md-12 mb-3"></div> -->
                                <div class="col-xl-8 col-lg-8 col-md-12 mb-3 text-center">
                                    <input class="btn btn-info btn-sm waves-effect waves-light" type="button"
                                        id="panel_save_image" value="Download" style="margin-top:28px; ">
                                </div>
                            </div>
                            @endif


                            <div class="row">
                                
                                <!-- <div class="col-xl-2 col-lg-2 col-md-12 mb-3">
                                    <div id="container" class="form-group">
                                        <label for="Status" class="col-3 control-label">Status
                                        </label>
                                        <div class="col-9 ">
                                            <div class="switch" id="submit">
                                                @if($job->job_status == "1")
                                                <input type="hidden" name="job_status" id="edit_job_status" value="1">
                                                <input type="checkbox" checked id="switch-2"
                                                    onclick="update_company_status($(this),'edit_job_status');">
                                                @else
                                                <input type="hidden" name="job_status" id="edit_job_status" value="0">
                                                <input type="checkbox" id="switch-2"
                                                    onclick="update_company_status($(this),'edit_job_status');">
                                                @endif

                                                <label for="switch-2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- inverter  end-->

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center d-flex form-group margin-bottom-0 "
                            id="buttonWrapper">
                            <a class="btn btn-primary" href="{{ route('job.index') }}">Back</a>
                            <button type="submit" class="btn btn-info btn-sm waves-effect waves-light">Submit</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection