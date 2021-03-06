@extends('layouts.app')
@section('content')
<div class="row ">
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
                                            <option value="PVD" @if($job->job_type == 'PVD') selected="true" @endif>PVD</option>
                                            <option value="SWH" @if($job->job_type == 'SWH') selected="true" @endif>SWH</option>
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
                                            <option value="New" @if($job->job_stage == 'New') selected="true" @endif>New</option>
                                            <option value="Preapproval" @if($job->job_stage == 'Preapproval') selected="true" @endif>Preapproval</option>
                                            <option value="New Installation" @if($job->job_stage == 'New Installation') selected="true" @endif>New Installation</option>
                                            <option value="In Progress" @if($job->job_stage == 'In Progress') selected="true" @endif>In Progress</option>
                                            <option value="Installation Completed" @if($job->job_stage == 'Installation Completed') selected="true" @endif>Installation Completed</option>
                                            <option value="Complete" @if($job->job_stage == 'Complete') selected="true" @endif>Complete</option>
                                            <option value="STC Trade" @if($job->job_stage == 'STC Trade') selected="true" @endif>STC Trade</option>
                                            <option value="Aftersales" @if($job->job_stage == 'Aftersales') selected="true" @endif>Aftersales</option>
                                            <option value="Cancellations" @if($job->job_stage == 'Cancellations') selected="true" @endif>Cancellations</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Title" class="control-label"> Title: </label>
                                        <input type="text" class="form-control" id="Title" name="title" value="{{$job->title}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="InstallationDate" class="control-label">Installation Date:</label>
                                        <div class="input-group col-sm-12">
                                            <input type="date" class="form-control" id="InstallationDate" name="installation_date" value="{{$job->installation_date}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="Priority" class="control-label">Priority: <span></span></label>
                                        <select class="form-control" id="Priority" name="priority">
                                            <option value="">Select</option>
                                            <option value="High" @if($job->priority == 'High') selected="true" @endif>High</option>
                                            <option value="Normal" @if($job->priority == 'Normal') selected="true" @endif>Normal</option>
                                            <option value="Low" @if($job->priority == 'Low') selected="true" @endif>Low</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Description" class="control-label">Description:</span></label>
                                        <textarea id="Description" class="form-control" maxlength="225"
                                            rows="2" name="description" value="" >{{$job->description}}</textarea>
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
                                            <option value="Individual" @if($job->owner_type == 'Individual') selected="true" @endif>Individual</option>
                                            <option value="Government body" @if($job->owner_type == 'Government body') selected="true" @endif>Government body</option>
                                            <option value="Corporate body" @if($job->owner_type == 'Corporate body') selected="true" @endif>Corporate body</option>
                                            <option value="Trustee" @if($job->owner_type == 'Trustee') selected="true" @endif>Trustee</option>
                                        </select>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for=" CompanyABN" class="control-label">
                                            Company ABN: <span class="mdi mdi-multiplication"></span></label>
                                        <input type="text" class="form-control" id="CompanyABN" name="company_abn"
                                            {{-- disabled --}} value="{{$job->company_abn}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="OrganisationName" class="control-label">Organisation Name:
                                            <span class="mdi mdi-multiplication"></span></label>
                                        <select class="form-control" id="OrganisationName" name="organisation_name" {{-- disabled --}}>
                                            <option value="">Select selected</option>
                                            <option value="1" @if($job->organisation_name == '1') selected="true" @endif>Select 1</option>
                                            <option value="2" @if($job->organisation_name == '2') selected="true" @endif>Select 1</option>
                                            <option value="3" @if($job->organisation_name == '3') selected="true" @endif>Select 1</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="FirstName" class="control-label"> First Name: <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <input type="text" class="form-control" id="FirstName" name="first_name" value="{{$job->first_name}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="LastName" class="control-label"> Last Name: <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <input type="text" class="form-control" id="LastName" name="last_name" value="{{$job->last_name}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Email" class="control-label"> Email:</label>
                                        <input type="email" class="form-control" id="Email" name="email" value="{{$job->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Phone" class="control-label"> Phone: <span
                                                class="mdi mdi-multiplication"></span></label>
                                        <input type="text" class="form-control" id="Phone" name="phone" value="{{$job->phone}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Mobile" class="control-label"> Mobile: {{-- <span
                                                class="mdi mdi-multiplication"></span></label> --}}
                                        <input type="text" class="form-control" id="Mobile" name="mobile" value="{{$job->mobile}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="PostalAddressType" class="control-label">Postal Address Type:
                                            <span class="mdi mdi-multiplication"></span></label>
                                        <select class="form-control" id="PostalAddressType" name="owner_postal_address_type">
                                            <option value="">select</option>
                                            <option value="1" @if($job->owner_postal_address_type == '1') selected="true" @endif>physical address</option>
                                            <option value="2" @if($job->owner_postal_address_type == '2') selected="true" @endif>P.O BOX</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="UnitType" class="control-label">Unit Type:
                                            <span class="mdi mdi-multiplication"></span></label>
                                        <select class="form-control" id="UnitType" name="owner_unit_type">
                                            <option value="">Select</option>
                                            @php
                                            foreach($unit_type as $key=>$unittype){
                                            @endphp
                                            <option value="{{$unittype->id}}"  @if($job->owner_unit_type == $unittype->id) selected="true" @endif>{{$unittype->unit_type_value}}</option>
                                            @php
                                            }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="UnitNumber" class="control-label"> Unit Number: </label>
                                        <input type="text" class="form-control" id="UnitNumber" name="owner_unit_number" value="{{$job->owner_unit_number}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetNumber" class="control-label"> Street Number: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="StreetNumber" name="owner_street_number"value="{{$job->owner_street_number}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetName" class="control-label"> Street Name: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="StreetName" name="owner_street_name" value="{{$job->owner_street_name}}">
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
                                            <option value="{{$street_type->id}}" @if($job->owner_street_type == $street_type->id) selected="true" @endif>{{$street_type->street_type_value}}</option>
                                            @php
                                            }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Town" class="control-label"> Town: <span
                                                class="mdi mdi-multiplication"></span>
                                        </label>
                                        <input type="text" class="form-control" id="Town" name="owner_town" value="{{$job->owner_town}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="State" class="control-label"> State: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="State" name="owner_state" {{-- disabled --}} value="{{$job->owner_state}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="PostCode" class="control-label"> Post Code: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="PostCode" name="owner_post_code" value="{{$job->owner_post_code}}"> 
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
                                    <input class="form-check-input-reverse" type="checkbox" value="" id="sameAsOwnerAddre" name="same_as_owner_address" @if($job->same_as_owner_address == 1) checked="checked" @endif onclick="set_installation_add(this);">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group select-wrapper">
                                        <label for="PostalAddressType" class="control-label">Postal Address Type:
                                            <span class="mdi mdi-multiplication"></span></label>
                                        <select class="form-control" id="PostalAddressType1" name="installation_postal_address_type">
                                           <option value="">select</option>
                                            <option value="1" @if($job->installation_postal_address_type == 1) selected ="true" @endif>physical address</option>
                                            <option value="2" @if($job->installation_postal_address_type == 2) selected="true" @endif>P.O BOX</option>
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
                                            <option value="{{$unittype->id}}" @if($job->installation_unit_type == $unittype->id) selected="true" @endif>{{$unittype->unit_type_value}}</option>
                                            @php
                                            }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="UnitNumber" class="control-label"> Unit Number: </label>
                                        <input type="text" class="form-control" id="UnitNumber1" name="installation_unit_number" value="{{$job->installation_unit_number}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetNumber" class="control-label"> Street Number: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="StreetNumber1" name="installation_street_number" value="{{$job->installation_street_number}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetName" class="control-label"> Street Name: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="StreetName1" name="installation_street_name" value="{{$job->installation_street_name}}">
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
                                            <option value="{{$street_type->id}}" @if($job->installation_street_type == $street_type->id) selected="true" @endif>{{$street_type->street_type_value}}</option>
                                            @php
                                            }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Town" class="control-label"> Town: <span
                                                class="mdi mdi-multiplication"></span>
                                        </label>
                                        <input type="text" class="form-control" id="Town1" name="installation_town" value="{{$job->installation_town}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="State" class="control-label"> State: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="State1" name="installation_state" {{-- disabled --}} value="{{$job->installation_state}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="PostCode" class="control-label"> Post Code: <span
                                                class="mdi mdi-multiplication"></span> </label>
                                        <input type="text" class="form-control" id="PostCode1" name="installation_post_code" value="{{$job->installation_post_code}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="NMI" class="control-label"> NMI: </label>
                                        <input type="text" class="form-control" id="NMI" name="nmi" value="{{$job->nmi}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="AdditinalInformation" class="control-label">Additinal Installation
                                            Information:</span></label>
                                        <textarea id="AdditinalInformation" class="form-control" maxlength="225"
                                            rows="2" name="additional_installation_information" > {{$job->additional_installation_information}}</textarea>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                    <div id="container" class="form-group">
                                        <label for="Status" class="col-md-3 col-12 control-label">Status </label>
                                        <div class="col-md-9 col-12">
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
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center d-flex form-group margin-bottom-0 "
                            id="buttonWrapper">
                            <a class="btn btn-primary" href="{{ route('job.index') }}">Back</a>
                            <button type="submit" class="btn btn-info btn-sm waves-effect waves-light">Submit</button>
                            
                        </div>
                    </div>
                </form>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection