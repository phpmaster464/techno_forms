@extends('layouts.app')


@section('content')

<div class="row ">


    <div class="col-12 ">
        <div class="box-content card white">
            <h3 class="box-title">Create A Job</h3>
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
                            <h3>Job Details :</h3>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="JobType" class="control-label">Job Type: <span
                                                class="fa fa-asterisk"></span></label>
                                        <select class="form-control" id="JobType" name="job_type">
                                            <option value="PVD">PVD</option>
                                            <option value="SWH">SWH</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="ReferenceNumber" class="control-label">
                                            Reference Number <span class="fa fa-asterisk"></span></label>
                                        <input type="text" class="form-control" id="ReferenceNumber"
                                            name="reference_number">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
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
                                        <input type="text" class="form-control" id="Title" name="title" value="{{old('title')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="InstallationDate" class="control-label">Installation Date:</label>
                                        <div class="input-group col-sm-12">
                                            <input type="date" class="form-control" id="InstallationDate" name="installation_date" value="{{old('installation_date')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
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
                                        <textarea id="Description" class="form-control" maxlength="225"
                                            rows="2" name="description" > {{old('description')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- owner-details -->
                        <div class="owner-details-wrapper">
                            <h3>Owner Details :</h3>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="JobType" class="control-label">Owner Type: <span
                                                class="fa fa-asterisk"></span></label>
                                        <select class="form-control" id="JobType" name="owner_type">
                                            <option value="">Select</option>
                                            <option value="Individual">Individual</option>
                                            <option value="Government body">Government body</option>
                                            <option value="Corporate body">Corporate body</option>
                                            <option value="Trustee">Trustee</option>
                                        </select>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for=" CompanyABN" class="control-label">
                                            Company ABN: <span class="fa fa-asterisk"></span></label>
                                        <input type="text" class="form-control" id="CompanyABN" name="company_abn"
                                            {{-- disabled --}} value="{{old('company_abn')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="OrganisationName" class="control-label">Organisation Name:
                                            <span class="fa fa-asterisk"></span></label>
                                        <select class="form-control" id="OrganisationName" name="organisation_name" {{-- disabled --}}>
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
                                                class="fa fa-asterisk"></span></label>
                                        <input type="text" class="form-control" id="FirstName" name="first_name" value="{{old('first_name')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="LastName" class="control-label"> Last Name: <span
                                                class="fa fa-asterisk"></span></label>
                                        <input type="text" class="form-control" id="LastName" name="last_name" value="{{old('first_name')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Email" class="control-label"> Email:</label>
                                        <input type="email" class="form-control" id="Email" name="email" value="{{old('email')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Phone" class="control-label"> Phone: <span
                                                class="fa fa-asterisk"></span></label>
                                        <input type="text" class="form-control" id="Phone" name="phone" value="{{old('phone')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="Mobile" class="control-label"> Mobile: {{-- <span
                                                class="fa fa-asterisk"></span></label> --}}
                                        <input type="text" class="form-control" id="Mobile" name="mobile" value="{{old('mobile')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="PostalAddressType" class="control-label">Postal Address Type:
                                            <span class="fa fa-asterisk"></span></label>
                                        <select class="form-control" id="PostalAddressType" name="owner_postal_address_type">
                                            <option value="">select</option>
                                            <option value="1">physical address</option>
                                            <option value="2">P.O BOX</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="UnitType" class="control-label">Unit Type:
                                            <span class="fa fa-asterisk"></span></label>
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
                                        <input type="text" class="form-control" id="UnitNumber" name="owner_unit_number" value="{{old('owner_unit_number')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetNumber" class="control-label"> Street Number: <span
                                                class="fa fa-asterisk"></span> </label>
                                        <input type="text" class="form-control" id="StreetNumber" name="owner_street_number" value="{{old('owner_street_number')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetName" class="control-label"> Street Name: <span
                                                class="fa fa-asterisk"></span> </label>
                                        <input type="text" class="form-control" id="StreetName" name="owner_street_name"  value="{{old('owner_street_name')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetType" class="control-label">Street Type:
                                            <span class="fa fa-asterisk"></span></label>
                                        <select class="form-control" id="StreetType" name="owner_street_type">
                                             <option value="">Select</option>
                                            @php
                                            foreach($street_types as $key=>$street_type){
                                            @endphp
                                            <option value="{{$street_type->id}}">{{$street_type->street_type_value}}</option>
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
                                                class="fa fa-asterisk"></span>
                                        </label>
                                        <input type="text" class="form-control" id="Town" name="owner_town" value="{{old('owner_town')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="State" class="control-label"> State: <span
                                                class="fa fa-asterisk"></span> </label>
                                        <input type="text" class="form-control" id="State" name="owner_state" {{-- disabled --}} value="{{old('owner_state')}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="PostCode" class="control-label"> Post Code: <span
                                                class="fa fa-asterisk"></span> </label>
                                        <input type="text" class="form-control" id="PostCode" name="owner_post_code" value="{{old('owner_post_code')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Inastallation Adress -->
                        <div class="installation-address-wrapper">
                            <h3>Installation Address :</h3>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label" for="sameAsOwnerAddre">
                                    Same as Owner Address:
                                    </label>
                                    <input class="form-check-input-reverse" type="checkbox" value="" id="sameAsOwnerAdd" name="same_as_owner_address" onclick="set_installation_add(this);">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="PostalAddressType" class="control-label">Postal Address Type:
                                            <span class="fa fa-asterisk"></span></label>
                                        <select class="form-control" id="PostalAddressType1" name="installation_postal_address_type">
                                           <option value="">select</option>
                                            <option value="1">physical address</option>
                                            <option value="2">P.O BOX</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="UnitType" class="control-label">Unit Type:
                                            <span class="fa fa-asterisk"></span></label>
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
                                        <input type="text" class="form-control" id="UnitNumber1" name="installation_unit_number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetNumber" class="control-label"> Street Number: <span
                                                class="fa fa-asterisk"></span> </label>
                                        <input type="text" class="form-control" id="StreetNumber1" name="installation_street_number">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetName" class="control-label"> Street Name: <span
                                                class="fa fa-asterisk"></span> </label>
                                        <input type="text" class="form-control" id="StreetName1" name="installation_street_name">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="StreetType" class="control-label">Street Type:
                                            <span class="fa fa-asterisk"></span></label>
                                        <select class="form-control" id="StreetType1" name="installation_street_type">
                                            <option value="">Select</option>
                                             @php
                                            foreach($street_types as $key=>$street_type){
                                            @endphp
                                            <option value="{{$street_type->id}}">{{$street_type->street_type_value}}</option>
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
                                                class="fa fa-asterisk"></span>
                                        </label>
                                        <input type="text" class="form-control" id="Town1" name="installation_town">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="State" class="control-label"> State: <span
                                                class="fa fa-asterisk"></span> </label>
                                        <input type="text" class="form-control" id="State1" name="installation_state" {{-- disabled --}}>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="PostCode" class="control-label"> Post Code: <span
                                                class="fa fa-asterisk"></span> </label>
                                        <input type="text" class="form-control" id="PostCode1" name="installation_post_code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="NMI" class="control-label"> NMI: </label>
                                        <input type="text" class="form-control" id="NMI" name="nmi">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="AdditinalInformation" class="control-label">Additinal Installation
                                            Information:</span></label>
                                        <textarea id="AdditinalInformation" class="form-control" maxlength="225"
                                            rows="2" name="additional_installation_information"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center d-flex form-group margin-bottom-0 "
                            id="buttonWrapper">
                            <a class="btn btn-primary" href="{{ route('job.index') }}"> Back</a>
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