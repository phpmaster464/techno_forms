@extends('layouts.app')


@section('content')
<div class="box-content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Unverified Installers</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('unverified_installer.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Personal Details  -->
                        <div class="row  ">
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="FirstName" class="col-12 control-label">First Name :</label>
                                             <input type="text" class="form-control" name="FirstName" value="{{ $unverifiedinstaller->first_name }} " disabled >
                                </div>
                            </div>
    
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="LastName" class="col-12 control-label">Last Name :</label>
                                   <input type="text" class="form-control" name="LastName" value="{{ $unverifiedinstaller->last_name }} " disabled>
                                </div>
                            </div>
                        </div>
    
                        <div class="row ">
                            <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Emailadrees" class="col-12 control-label">Email :</label>
                                    <input type="text" class="form-control" name="email" value="{{ $unverifiedinstaller->email }} " disabled>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Phone" class="col-12 control-label">Phone :</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $unverifiedinstaller->phone }} " disabled>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Mobile" class="col-12 control-label">Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile" value="{{ $unverifiedinstaller->mobile }} " disabled>
                                </div>
                            </div>
                        </div>
                        
                        <!--Address Detail -->
                        <div class="row ">
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Company ABN" class="col-12 control-label">Company ABN: </label>
                                    <input type="text" class="form-control" name="companyabn" value="{{ $unverifiedinstaller->companyabn }} " disabled>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="companyname" class="col-12 control-label">Company/Bussiness Name
                                        :</label>
                                        <div>
                                            <input type="text" class="form-control" name="companyname" value="{{ $unverifiedinstaller->companyname }} " disabled>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="formdate" class="col-12 control-label">Form Date : </label>
                                    <input type="text" class="form-control" name="formdate" value="{{ date('d-m-Y',strtotime($unverifiedinstaller->formdate)) }} " disabled>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="todate" class="col-12 control-label">To Date :</label>
                                    <input type="text" class="form-control" name="todate" value="{{ date('d-m-Y',strtotime($unverifiedinstaller->todate)) }} " disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="companywebsite" class="col-12 control-label">Company Website</label>
                                    <input type="text" class="form-control" name="companywebsite" value="{{ $unverifiedinstaller->companywebsite }} " disabled>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="postal_address" class="col-12 control-label">Postal Address Type
                                        :</label>
                                    <!-- <input type="text" class="form-control" id="CompanyName"
                                            placeholder="Search Address" name="company_name"> -->
                                    <div>
                                    <input type="text" class="form-control" name="postaladdress" value="{{ $unverifiedinstaller->postaladdress }} " disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="UnitType" class="col-12 control-label">Unit Type</label>
                                    <!-- <input type="text" class="form-control" id="unit_type"
                                    placeholder="Unit Type" name="unit_type"> -->
                                    <div>
                                    <input type="text" class="form-control" name="unit_type" value="{{ $unverifiedinstaller->unit_type }} " disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="UnitNumber" class="col-12 control-label">Unit Number</label>
                                    <input type="text" class="form-control" name="UnitNumber" value="{{ $unverifiedinstaller->unit_number }} " disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="StreetNumber" class="col-12 control-label">Street Number</label>
                                    <input type="text" class="form-control" name="street_number" value="{{ $unverifiedinstaller->street_number }} " disabled >
                                </div>
                            </div>
    
                            <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="StreetName" class="col-12 control-label">Street Name</label>
                                    <input type="text" class="form-control" name="street_name" value="{{ $unverifiedinstaller->street_name }} " disabled>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="StreetType" class="col-12 control-label">Street Type</label>
                                    <div>
                                    <input type="text" class="form-control" name="street_type" value="{{ $unverifiedinstaller->street_type }} " disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Suburb" class="col-12 control-label">Town/Suburb</label>
                                    <input type="text" class="form-control" name="suburb" value="{{ $unverifiedinstaller->suburb }} " disabled>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="State" class="col-12 control-label">State</label>
                                <div>
                                    <input type="text" class="form-control" name="state" value="{{ $unverifiedinstaller->state }} " disabled>
                                </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Postcode" class="col-12 control-label">Postcode</label>
                                    <input type="text" class="form-control" name="postcode" value="{{ $unverifiedinstaller->postcode }} " disabled>
                                </div>
                            </div>
                        </div>
    
                        <!-- Account Details-->
    
                        <div class="row ">
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Postcode" class="col-12 control-label">CEC Accreditation
                                        Number</label>
                                    <input type="text" class="form-control" name="CECaccnumber" value="{{ $unverifiedinstaller->CECaccnumber }} " disabled>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Postcode" class="col-12 control-label">Lincesed Electrician
                                        Number</label>
                                    <input type="text" class="form-control" name="licensenumber" value="{{ $unverifiedinstaller->licensenumber }} " disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Postcode" class="col-12 control-label">CEC Designer Number</label>
                                    <input type="text" class="form-control" name="cecdesignernumber" value="{{ $unverifiedinstaller->cecdesignernumber }} " disabled>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Postcode" class="col-12 control-label">SE Role </label>
                                            <div class="se-radio">
                                              <input type="text" class="form-control" name="serole" value="{{ $unverifiedinstaller->serole }} " disabled>
                                            </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xl-6 col-md-6 col-md-12 mb-3">
                                <div class="avatar-upload">
                                  
                                    <div class="avatar-preview">
                                        <!--  <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);"> -->
                                        <div id="imagePreview_signature" style="background-image: url('{{ url('/') }}/{{$unverifiedinstaller->signature}}'); background-position: center; background-size: contain;" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 col-md-12 mb-3">
                                <div class="avatar-upload">
                                   
                                    <div class="avatar-preview">
                                        <!--  <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);"> -->
                                        <div id="imagePreview_identity" style="background-image: url('{{ url('/') }}/{{$unverifiedinstaller->proofidentity}}');">
                                        </div>
                                    </div>
                                </div>
                            </div>

    </div>
</div>
@endsection
