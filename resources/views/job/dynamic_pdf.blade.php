<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,
            shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
            integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
            crossorigin="anonymous">

        <title>Form</title>

        <!-- Custome Style -->
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  height: 100%;
  width: 100%;
  overflow-y: auto;
  color: #000;
  background-color: #fff;
  font-size: 16px;
  font-family: "Lato", sans-serif;
}

/* General */

/* 1.Hedarer */

/* 2. Installer Form */

/* 3. Retailer Details form */

/******* General *******************************/

main {
  padding: 10px;
}

hr {
  background-color: #00adef;
  height: 4px;
}

/* .form-control */

#installerFOrm input, #instalationDetailForm input, #mendatory-wrap input {
  border-top: none;
  border-left: none;
  border-right: none;
  border-radius: 0;
}

.form-group label {
  display: flex;
  align-items: flex-end;
}

form {
  border: 1px solid #00adef;
}

h2 {
  background-color: #00adef;
  color: #000;
  text-align: center;
  padding: 6px 0;
  font-weight: 800;
  font-size: 22px;
}

/*********************************************/

/****** 1.Header *******************************/

header {
  display: flex;
  align-items: center;
  justify-content: center;
  align-items: flex-start;
  display: flex;
  flex-direction: column;
}

.logo-img {
  width: 30%;
}

header h1 {
  margin: 0 30px;
  font-weight: 900;
  display: flex;
  align-items: center;
}

.header-description {
  color: #d1d2d4;
  font-weight: 500;
}

.installerDatewrape, .Owner-wrap, .STCwrap, .instalationDetailwrap, #instalationDetailForm .instalationDetailwrap.checkbox, #retailerrFOrm .retail-wrap, #solarPanelFOrm .retail-wrap {
  padding: 0 20px;
  align-items: baseline;
}

/*********************************************/

/******* 2. Installer Form *******************************/

#installerFOrm .installerDatewrape label {
  width: 23%;
  text-decoration: underline;
}

#installerFOrm .installerDatewrape input {
  border-bottom: none;
}

#installerFOrm .Owner-wrap label, #instalationDetailForm .instalationDetailwrap label {
  width: 160px;
}

#instalationDetailForm .instalationDetailwrap.checkbox {
  margin: 20px 20px;
}

#instalationDetailForm .instalationDetailwrap.checkbox label {
  width: 180px;
}

.STCwrap {
  margin-bottom: 0px;
  padding: 11px 20px;
}

/* 3. Retailer Details form */

#retailerrFOrm input {
  border: none;
}

#solarPanelFOrm .form-group {
  height: 63px;
}

#solarPanelFOrm label {
  text-align: right;
  display: flex;
  justify-content: flex-end;
}

#solarPanelFOrm input {
  height: 20px;
  border: none;
  border-bottom: 1px solid #d1d2d4;
  border-radius: 0;
  padding: 0;
}

#numbersOfPanel {
  background-color: #d1d2d4;
  border: 1px solid;
  padding: 32px 24px;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
}

/*********************************************/

/* Authentication */

#authentication {
  /* padding: 10px 15px; */
  padding-right: 15px;
  padding-left: 15px;
}

#authentication p {
  font-size: 13px;
}

.replacement-wrap {
  border: 1px solid #000;
  padding: 15.6px;
  text-align: center;
}

#authentication .replacement-wrap .form-control {
  height: 25px;
  border: ipx solid #d1d2d4;
}

#authentication .replacement-wrap textarea.form-control {
  height: 80px;
}

/*********************************************/

/* Property type */

.property-type {
  border: 1px solid #000;
  padding: 20px;
  background-color: #d1d2d4;
}

.property-type .form-check-label {
  margin-right: 35px;
  margin-left: 5px;
}

/*********************************************/

/* Accreditation Information */

#accreditationInformation h2 {
  padding: 0 20px;
}

#accreditationInformation .installlerDetailsinfo .form-row {
  /* border: 1px solid #00adef; */
  padding: 12px 0px 0;
  margin: 0 0px 15px;
  font-size: 12px;
}

/*********************************************/

/* Mendatory */

#mendatory-wrap {
  padding: 0 13px;
}

#mendatory-wrap .col-md-4 {
  padding: 30px 30px 0 30px;
  border: 1px solid #d1d2d4;
}

#mendatory-wrap .md- h5 {
  font-weight: 600;
}

#mendatory-wrap ol.a {
  list-style-type: lower-greek;
}

#mendatory-wrap ol {
  counter-reset: list;
}

#mendatory-wrap ol>li {
  list-style: none;
}

#mendatory-wrap ol>li:before {
  content: counter(list, lower-greek) ") ";
  counter-increment: list;
}

/* Signature */

#sig-canvas, #sig-canvas1 {
  border-bottom: 1px solid #000;
  cursor: crosshair;
  width: 96%;
  height: 78px;
}

.cec {
  width: 42%;
  margin-top: 41px;
}

.print {
  width: 95%;
  margin-top: 41px;
  margin-right: 10px;
}

.list {
  padding: 20px 13px 0px;
}

.list ul li input {
  width: 30%;
  height: 27px;
  margin: 0 8px;
}

.list ul li {
  display: flex;
  flex-wrap: wrap;
  list-style-type: circle;
  position: relative;
  line-height: 35px;
}

.list ul li::before {
  content: " ";
  width: 5px;
  height: 5px;
  background-color: #000;
  color: #000;
  position: absolute;
  top: 16px;
  left: -15px;
  border-radius: 50%;
}

#credential #sig-canvas {
  width: 100%;
}

#credential p input {
  width: 20%;
}

#credential p:nth-child(1) {
  flex-wrap: wrap;
}

#credential .cec input {
  border-bottom: 1px solid;
  /* padding-bottom: 4px; */
  /* margin-bottom: -9px; */
  height: 37px;
}

/*********************************************/

/* Media Query */

@media only screen and (max-width: 1440px) {
  #installerFOrm .installerDatewrape label {
    width: 37%;
  }
  .STCwrap .form-check-inline {
    margin-right: 0;
    margin-left: 25px;
  }
  .STCwrap {
    padding: 6px 17px 0;
  }
}

@media only screen and (max-width: 767px) {
  #instalationDetailForm {
    margin-top: 31px;
  }
  #numbersOfPanel .form-group {
    width: 100%;
    padding: 0px 30px;
  }
  .property-type .form-row:nth-child(2) .col-md-10>div.d-flex{
    flex-wrap: wrap;
  }
  #mendatory-wrap .col-md-4 {
    margin: 5px 0;
  }

  #mendatory-wrap .form-check-inline {
    display: -ms-inline-flexbox;
    display: inline-flex;
    -ms-flex-align: center;
    align-items: baseline;
    padding-left: 11px;
    margin-right: .75rem;
  }
  header>div{
    display: flex;
    flex-direction: column;
  }
  header h1 {
    margin: 0 30px 14px;
    font-size: 19px;
  }
  .double-wrap{
    flex-direction: column;
  }
#instalationDetailForm>div{
  display: flex;
  flex-direction: column;
}

.property-type .form-row .col-md-10>div.d-flex {
flex-wrap: wrap;
}
.form-row>.col, .form-row>[class*=col-] {
  padding-right: 5px;
  padding-left: 5px;
  width: 100%;
  min-width: 100%;
}
.signature-wrap{
  display: flex;
  flex-direction: column;
}
.cec {
  width: 100%;
}
}
        </style>

    </head>

    <body>
        <main class="container-fluid">
          
            <div class="row">
                <section class="col-md-9">
                    <header>
                        <div class="d-flex">
                            <img src="demo-logo.png" alt="Logo"
                                class="logo-img">
                            <h1>STC Assigment Form - PV Solar</h1>
                        </div>
                        <p class="header-description text-uppercase">Emerging
                            energy solution gropu pty.Ltd.517 Flinders Lane,
                            MELBOURNE VIC 3000</p>
                    </header>
                   
                    <section class="row">
                        <div class="col-md-6">
                            <form id="installerFOrm">
                                <div class="form-group d-flex flex-md-row
                                    installerDatewrape">
                                    <label for="installtionDate">Installtion
                                        Date: </label>
                                    <input type="text" value="{{ $data->installation_date }}"
                                        class="form-control"
                                        id="installtionDate">
                                </div>
                                <h2>Owner Details</h2>
                                <div class="form-group d-flex flex-md-row
                                    Owner-wrap">
                                    <label for="OwnerfirstName">First Name:
                                    </label>
                                    <input type="text" value="{{ $data->first_name }}"
                                        class="form-control"
                                        id="OwnerfirstName">
                                </div>
                                <div class="form-group d-flex flex-md-row
                                    Owner-wrap">
                                    <label for="OwnerLastName">Last Name:
                                    </label>
                                    <input type="text" value="{{ $data->last_name }}"
                                        class="form-control" id="OwnerLastName">
                                </div>
                                <div class="form-group d-flex flex-md-row
                                    Owner-wrap">
                                    <label for="OwnerPstalAddress">Postal
                                        Address: </label>
                                    <input type="text" value="{{ $data->owner_postal_address_type }} {{ $data->owner_unit_type }} {{ $data->owner_unit_number }} {{ $data->owner_street_number }} {{ $data->owner_street_name }} {{ $data->owner_street_type }}"  class="form-control"
                                        id="OwnerPstalAddress">
                                </div>
                                <div class="form-group d-flex flex-md-row
                                    Owner-wrap">
                                    <label for="OwnerSuburb">Suburb: </label>
                                    <input type="text" value="{{ $data->installation_town }}"
                                        class="form-control" id="OwnerSuburb">
                                </div>
                                <div class="form-group d-flex flex-md-row
                                    Owner-wrap double-wrap mb-0">
                                    <div class="col-md-6 p-0 form-group d-flex
                                        flex-md-row">
                                        <label for="Ownerqld">State: </label>
                                        <input type="text" value="{{ $data->installation_state }}"
                                            class="form-control" id="Ownerqld">
                                    </div>
                                    <div class="col-md-6 p-0 form-group d-flex
                                        flex-md-row">
                                        <label for="OwnerPostcode">Postcode:
                                        </label>
                                        <input type="text" value="{{ $data->installation_post_code }}"
                                            class="form-control"
                                            id="OwnerPostcode">
                                    </div>
                                </div>
                                <div class="form-group d-flex flex-md-row
                                    Owner-wrap double-wrap mb-0">
                                    <div class="col-md-6 p-0 form-group d-flex
                                        flex-md-row">
                                        <label for="Ownerhome">Home: </label>
                                        <input type="text" value="{{ $data->phone }}"
                                            class="form-control" id="Ownerhome">
                                    </div>
                                    <div class="col-md-6 p-0 form-group d-flex
                                        flex-md-row">
                                        <label for="Ownermobile">Mobile:
                                        </label>
                                        <input type="text" value="{{ $data->mobile }}"
                                            class="form-control"
                                            id="Ownermobile">
                                    </div>
                                </div>
                                <div class="form-group d-flex flex-md-row
                                    Owner-wrap">
                                    <label for="Owneremail">Email: </label>
                                    <input type="text" value="{{ $data->email }}"
                                        class="form-control" id="Owneremail">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form id="instalationDetailForm">
                                <div class="form-group d-flex flex-md-row
                                    STCwrap">
                                    <label style="margin-right: 20px;">STC Deeming Period:</label>                                   
                                    <div>                                       
                                        <div class="form-check form-check-inline">
                                            @php
                                            $deeming =$data->Deeming_Period;
                                            @endphp
                                            @if ($deeming != '' && $deeming=='1')
                                            <input class="form-check-input"
                                                type="checkbox" id="OneYr"
                                                value="1" checked>
                                            <label class="form-check-label"
                                                for="OneYr">1 Yr </label>
                                            @else
                                            <input class="form-check-input"
                                                type="checkbox" id="OneYr"
                                                value="1">
                                            <label class="form-check-label"
                                                for="FiveYr">1 Yr</label>
                                            @endif
                                        </div>

                                        <div class="form-check form-check-inline">
                                          @if ($deeming != '' && $deeming=='5')
                                            <input class="form-check-input"
                                                type="checkbox" id="FiveYr"
                                                value="5" checked>
                                            <label class="form-check-label"
                                                for="FiveYr">5 Yr</label>
                                             @else
                                            <input class="form-check-input"
                                                type="checkbox" id="FiveYr"
                                                value="1">
                                            <label class="form-check-label"
                                                for="FiveYr">5 Yr</label>
                                            @endif
                                        </div>
                                        <div class="form-check form-check-inline">
                                          @if ($deeming != '' && $deeming=='12')
                                            <input class="form-check-input"
                                                type="checkbox" id="12Yr"
                                                value="12" checked>
                                            <label class="form-check-label"
                                                for="12Yr">12 Yr</label>
                                          @else
                                            <input class="form-check-input"
                                                type="checkbox" id="FiveYr"
                                                value="12">
                                            <label class="form-check-label"
                                                for="FiveYr">12 Yr</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <h2>Installation Details</h2>
                                <div class="form-check instalationDetailwrap
                                    checkbox">
                                    <input class="form-check-input"
                                        type="checkbox" value=" {{ $data->same_as_owner_address }}"
                                        id="sameasowner">
                                    <label class="form-check-label"
                                        for="sameasowner">
                                        Same as Owner Details
                                    </label>
                                </div>
                                <div class="form-group d-flex flex-md-row
                                    instalationDetailwrap">
                                    <label for="installtionfirstname">First
                                        Name: </label>
                                    <input type="text" value="{{ $data->first_name }}"
                                        class="form-control"
                                        id="installtionfirstname">
                                </div>
                                <div class="form-group d-flex flex-md-row
                                    instalationDetailwrap">
                                    <label for="installtionlastname">Last Name:</label>
                                    <input type="text" value="{{ $data->last_name }}"
                                        class="form-control"
                                        id="installtionlastname">
                                </div>
                                <div class="form-group d-flex flex-md-row
                                    instalationDetailwrap">
                                    <label for="installtionAddre">Install
                                        Address:</label>
                                    <input type="text" value="{{ $data->installation_postal_address_type }} {{ $data->installation_unit_type }} {{ $data->installation_unit_number }} {{ $data->installation_street_number }} {{ $data->installation_street_name }} {{ $data->installation_street_type }}" 
                                        class="form-control"
                                        id="installtionAddre">
                                </div>
                                <div class="form-group d-flex flex-md-row
                                    instalationDetailwrap">
                                    <label for="installSuburb">Suburb: </label>
                                    <input type="text" value="{{ $data->installation_town }}"
                                        class="form-control" id="installSuburb">
                                </div>
                                <div class="form-group d-flex flex-md-row
                                    instalationDetailwrap double-wrap mb-0">
                                    <div class="col-md-6 p-0 form-group d-flex
                                        flex-md-row">
                                        <label for="installqld">State: </label>
                                        <input type="text" value="{{ $data->installation_state }}"
                                            class="form-control"
                                            id="installqld">
                                    </div>
                                    <div class="col-md-6 p-0 form-group d-flex
                                        flex-md-row">
                                        <label for="installPostcode">Postcode:
                                        </label>
                                        <input type="text" value="{{ $data->installation_post_code }}"
                                            class="form-control"
                                            id="installPostcode">
                                    </div>
                                </div>
                                <div class="form-group d-flex flex-md-row
                                    instalationDetailwrap double-wrap mb-0">
                                    <div class="col-md-6 p-0 form-group d-flex
                                        flex-md-row">
                                        <label for="installhome">Home: </label>
                                        <input type="text" value="{{ $data->phone }}"
                                            class="form-control"
                                            id="installhome">
                                    </div>
                                    <div class="col-md-6 p-0 form-group d-flex
                                        flex-md-row">
                                        <label for="installmobile">Mobile:
                                        </label>
                                        <input type="text" value="{{ $data->mobile }}"
                                            class="form-control"
                                            id="installmobile">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                    <section id="authentication" class="mt-4">
                        <div class="row">
                            <div class="col-md-3 replacement-wrap">
                                <p class="mb-o">Are you <u>replacing</u> panels
                                    to a system as a result of damage or faults?</p>
                                <div>
                                   @php
                                   $replacing_panels =$data->replacing_panels;
                                   $Additionalpanels =$data->Additionalpanels;
                                   $system_installed =$data->system_installed;
                                   @endphp
                                    <div class="form-check form-check-inline">                                       
                                            @if ($replacing_panels != '' && $replacing_panels=='yes')
                                              <input class="form-check-input" 
                                                  type="checkbox" id="yes" checked value="yes" >
                                              <label class="form-check-label"
                                                  for="yes">Yes</label>
                                              @else
                                              <input class="form-check-input"
                                                  type="checkbox" id="yes" value="yes" >
                                              <label class="form-check-label"
                                                  for="yes">Yes</label>
                                            @endif
                                    </div>
                                    <div class="form-check form-check-inline">
                                       @if ($replacing_panels != '' && $replacing_panels=='no')
                                        <input class="form-check-input"
                                            type="checkbox" id="no" checked value="no">
                                        <label class="form-check-label"
                                            for="no">No</label>
                                          @else
                                              <input class="form-check-input"
                                                  type="checkbox" id="no" value="no" >
                                              <label class="form-check-label"
                                                  for="yes">No</label>
                                          @endif

                                    </div>
                                </div>
                                <p class="mb-o"># of replacement panels?</p>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-3 replacement-wrap">
                                <p class="mb-o">Are you <u>Additional</u> panels
                                    to an exsisting system?</p>
                                <div>
                                    <div class="form-check form-check-inline">
                                       @if ($Additionalpanels != '' && $Additionalpanels=='yes')
                                        <input class="form-check-input" 
                                                  type="checkbox" id="yes" checked value="yes" >
                                              <label class="form-check-label"
                                                  for="yes">Yes</label>
                                        @else
                                              <input class="form-check-input"
                                                  type="checkbox" id="yes" value="yes" >
                                              <label class="form-check-label"
                                                  for="yes">Yes</label>
                                        @endif
                                    </div>
                                    <div class="form-check form-check-inline">
                                       @if ($Additionalpanels != '' && $Additionalpanels=='no')
                                        <input class="form-check-input"
                                            type="checkbox" id="no" checked value="no">
                                        <label class="form-check-label"
                                            for="no">No</label>
                                        @else
                                              <input class="form-check-input"
                                                  type="checkbox" id="no" value="no" >
                                              <label class="form-check-label"
                                                  for="yes">No</label>
                                        @endif
                                    </div>
                                </div>
                                <p class="mb-o"># of exixting panels?</p>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-3 replacement-wrap">
                                <p class="mb-o">Is there currently more than one
                                    system installed at this address?</p>
                                <div>
                                    <div class="form-check form-check-inline">
                                       @if ($system_installed != '' && $system_installed=='yes')
                                        <input class="form-check-input" 
                                                  type="checkbox" id="yes" checked value="yes" >
                                              <label class="form-check-label"
                                                  for="yes">Yes</label>
                                        @else
                                              <input class="form-check-input"
                                                  type="checkbox" id="yes" value="yes" >
                                              <label class="form-check-label"
                                                  for="yes">Yes</label>
                                        @endif
                                    </div>
                                    <div class="form-check form-check-inline">
                                        @if ($system_installed != '' && $system_installed=='no')
                                         <input class="form-check-input"
                                            type="checkbox" id="no" checked value="no">
                                        <label class="form-check-label"
                                            for="no">No</label>
                                        @else
                                              <input class="form-check-input"
                                                  type="checkbox" id="no" value="no" >
                                              <label class="form-check-label"
                                                  for="yes">No</label>
                                        @endif
                                    </div>
                                </div>
                                <p class="mb-o">please specify location of other
                                    system?</p>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-3 replacement-wrap">
                                <p class="mb-o">Are there any additional
                                    comments relating to this installtion?</p>
                                <textarea class="form-control"
                                    id="installinfomore" rows="3">{{$data->additional_installation_information}}</textarea>
                            </div>
                        </div>
                    </section>
                </section>
                <section class="col-md-3">
                    <form id="retailerrFOrm">
                        <h2 class="text-uppercase">Retailer Details</h2>
                        <div class="form-group d-flex flex-md-row retail-wrap">
                            <label class="text-uppercase" for="retailertName">Name:
                            </label>
                            <input type="text" value=" {{ $data->organisation_name }} "
                                class="form-control" id="retailertName">
                        </div>
                        <div class="form-group d-flex flex-md-row retail-wrap">
                            <label class="text-uppercase" for="retailerABN">ABN:
                            </label>
                            <input type="text" value=" {{ $data->company_abn }} "
                                class="form-control" id="retailerABN">
                        </div>
                    </form>
                    <form id="solarPanelFOrm">
                        <h2 class="text-uppercase">Solar Panel System</h2>
                        <div class="form-group retail-wrap">
                            <label for="solarbrand">Panel Brand</label>
                            <input type="text" class="form-control" value="{{ $data->Panels_Brand }}"
                                id="solarbrand">
                        </div>
                        <div class="form-group retail-wrap">
                            <label for="solarModel">Panel Model</label>
                            <input type="text" class="form-control" value="{{ $data->Panels_Model }}"
                                id="solarModel">
                        </div>
                        <div class="form-group retail-wrap">
                            <label for="solarinvertorbrand">Inverter Brand</label>
                            <input type="text" class="form-control" value="{{ $data->inverter_Brand }}"
                                id="solarinvertorbrand">
                        </div>
                        <div class="form-group retail-wrap">
                            <label for="invetorModel">Inverter Model</label>
                            <input type="text" class="form-control" value="{{ $data->inverter_Model }}"
                                id="invetorModel">
                        </div>
                        <div class="form-group retail-wrap">
                            <label for="Inverterseries">Inverter Series</label>
                            <input type="text" class="form-control" value="{{ $data->inverter_Series }}"
                                id="Inverterseries">
                        </div>
                    </form>

                    <form id="numbersOfPanel">
                        <div class="form-group numOfPanel-wrap">
                            <label for="numPanel">Number Of Panel</label>
                            <input type="text" class="form-control" 
                                id="numPanel" value="{{ $totalpanel }}" >
                        </div>
                        <div class="form-group numOfPanel-wrap">
                            <label for="powerOutput">Rated power Output (kW)</label>
                            <input type="text" class="form-control" value="{{ $data->Rated_Power_Output }}"
                                id="powerOutput">
                        </div>
                    </form>
                </section>
            </div>
            <!-- Property-Type -->
            <div class="property-type">
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label class="text-danger">Property Type:</label>
                    </div>
                    <div class="col-md-10 mb-3 d-flex">
                        <div class="d-flex">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" value="{{ $data->property_type }}"
                                    type="checkbox" id="residential">
                                <label class="form-check-label"
                                    for="residential" style="width: 100px;">Residential</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" value="{{ $data->property_type }}"
                                    type="checkbox" id="school">
                                <label class="form-check-label"
                                    for="school" style=" width: 60px;">School</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" value="{{ $data->property_type }}"
                                    type="checkbox" id="commercial">
                                <label class="form-check-label"
                                    for="commercial">Commercial</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" value="{{ $data->property_type }}"
                                    type="checkbox" id="other">
                                <label class="form-check-label"
                                    for="other">Other</label>
                            </div>
                        </div>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label class="text-danger">Single/Multi Story:</label>
                    </div>
                    <div class="col-md-10 mb-3 d-flex">
                        <div class="d-flex">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" value="{{ $data->story_type }}"
                                    type="checkbox" id="single">
                                <label class="form-check-label"
                                    for="single" style="width: 100px;">Single</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" value="{{ $data->story_type }}"
                                    type="checkbox" id="multi">
                                <label class="form-check-label"
                                    for="multi" style=" width: 60px;">Multi</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" value="{{ $data->story_type }}"
                                    type="checkbox" id="numOfstc">
                                <label class="form-check-label"
                                    for="numOfstc">Nunber of small-scale tech
                                    certs (STCs) </label>
                            </div>
                        </div>
                        <div style="width: 57%;">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Number of STCs</div>
                                </div>
                                <input type="text" class="form-control"
                                    id="numstcs"
                                    placeholder="Username">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Accreditation Information  -->
            <div id="accreditationInformation">
                <h2 class="text-white text-left">Accreditation Information</h2>
                <div class="instalerAccrediInfo">
                    <form class="installlerDetailsinfo border-0">
                        <h5>INSTALLER DETALS</h5>
                        <div class="form-row">
                            <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->first_name }} {{ $data->last_name }}"
                                    id="fullname">
                                <label class="text-uppercase" for="fullname">Full
                                    name</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->mobile }}"
                                    id="phone">
                                <label class="text-uppercase" for="phone">PHONE</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->unit_type }} {{ $data->unit_number }} {{ $data->street_number }} {{ $data->street_name }} {{ $data->street_type }}"
                                    id="address">
                                <label class="text-uppercase" for="address">address</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->suburb }}"
                                    id="suburb">
                                <label class="text-uppercase" for="suburb">suburb</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->postcode }}"
                                    id="postcode">
                                <label class="text-uppercase" for="postcode">postcode</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" 
                                    id="accreditationnum">
                                <label class="text-uppercase" 
                                    for="accreditationnum">accreditation number</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="instalerAccrediInfo">
                    <form class="form installlerDetailsinfo border-0">
                        <div class="d-flex justify-content-between">
                            <h5 class="text-uppercase">Electrician DETALS</h5>
                            <span>. State 'as above' if details are the same</span>
                        </div>
                        <div class="form-row">
                           <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->first_name }} {{ $data->last_name }}"
                                    id="fullname">
                                <label class="text-uppercase" for="fullname">Full
                                    name</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->mobile }}"
                                    id="phone">
                                <label class="text-uppercase" for="phone">PHONE</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->unit_type }} {{ $data->unit_number }} {{ $data->street_number }} {{ $data->street_name }} {{ $data->street_type }}"
                                    id="address">
                                <label class="text-uppercase" for="address">address</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->suburb }}"
                                    id="suburb">
                                <label class="text-uppercase" for="suburb">suburb</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->postcode }}"
                                    id="postcode">
                                <label class="text-uppercase" for="postcode">postcode</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" 
                                    id="accreditationnum">
                                <label class="text-uppercase"
                                    for="accreditationnum">accreditation number</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="instalerAccrediInfo">
                    <form class="form installlerDetailsinfo border-0">
                        <div class="d-flex justify-content-between">
                            <h5 class="text-uppercase">designer DETALS</h5>
                            <span>. State 'as above' if details are the same</span>
                        </div>
                        <div class="form-row">
                            <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->first_name }} {{ $data->last_name }}"
                                    id="fullname">
                                <label class="text-uppercase" for="fullname">Full
                                    name</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->mobile }}"
                                    id="phone">
                                <label class="text-uppercase" for="phone">PHONE</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->unit_type }} {{ $data->unit_number }} {{ $data->street_number }} {{ $data->street_name }} {{ $data->street_type }}"
                                    id="address">
                                <label class="text-uppercase" for="address">address</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->suburb }}"
                                    id="suburb">
                                <label class="text-uppercase" for="suburb">suburb</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" value="{{ $data->postcode }}"
                                    id="postcode">
                                <label class="text-uppercase" for="postcode">postcode</label>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control" 
                                    id="accreditationnum">
                                <label class="text-uppercase"
                                    for="accreditationnum">accreditation number</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>

            <div id="mendatory-wrap">
                <span>Mandatory written statement by the CEC installer and
                    Designer:</span>
                <p class="d-flex flex-wrap pt-3">
                    I
                    <input type="text" class="form-control w-25" style="border-bottom: 1px solid;">
                    (name of installer) was the accredited CEC Instaler that
                    completed the SGU installation at
                    <input type="text" class="form-control w-25" style="border-bottom: 1px solid;">
                    and verify that u have installed the system, it meets the
                    CEC accreditation guidlines, CEC accreditation Code of
                    practice and I a bound by their Code of Conduct, have used
                    panels and inverters approved by the CEC, followed all of
                    the Cean Energy Regulator's Guidelines, have $5m in public
                    liability insurance and the system meets the following
                    Australian standard, Where applicatble:-
                </p>
                <div class="row">
                    <div class="col-md-4">
                        <h5>
                            PV & Inverter Standard
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Error, quod? Totam ad ipsa ipsum
                            ab voluptas error magni veniam animi similique
                            dignissimos veritatis obcaecati, porro autem
                            doloribus architecto unde consectetur, facere earum.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h5>
                            Grid connected system
                        </h5>
                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing
                            elit. Nulla, expedita! Cum, consectetur? Quibusdam
                            deleniti neque tempore dolores, amet ipsam illo nam
                            quia alias hic, quos natus eveniet sint consequatur
                            fugiat. Deserunt ab architecto esse minima delectus
                            obcaecati, quas quo dicta.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h5>
                            Standalone System
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Perferendis aliquid, recusandae perspiciatis
                            ut voluptate sequi nisi, aperiam cumque tenetur
                            nesciunt modi! Earum accusantium libero mollitia ea?
                            Architecto quasi deserunt sequi.
                        </p>
                    </div>
                </div>
                <div style="display: flex;flex-wrap: wrap;">
                    <p>I verify that all Local, state or Territory goverment
                        requirements have been met for.
                        (i) The Siting of the unit (ii) The attachment of the
                        unit to the building or structure.
                        (iii) The grid connection of the system for the SGU
                        installation.
                    </p>
                    <p style="display: flex;flex-wrap: wrap;">
                        I verify that the SGU is
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                type="checkbox" id="grid" style="border-bottom: 1px solid;">
                            <label class="form-check-label"
                                for="grid">Grid connection</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                type="checkbox" id="connected" style="border-bottom: 1px solid;">
                            <label class="form-check-label"
                                for="connected">Connected to the grid with
                                battery storage</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                type="checkbox" id="grid" style="border-bottom: 1px solid;">
                            <label class="form-check-label"
                                for="grid" style="margin-top: 17px;">an off grid installation and an
                                electrical worker holding an unristricted
                                licence for electrical work issued by the State
                                or Territory authority for the place where the
                                unit was installed undertook ll wiring of the
                                unit that involve alternating current of 50 or
                                volts or direct current of 120. I confirm that
                                the details in the above statement is correct.</label>
                        </div>
                    </p>
                </div>
                <div class="signature-section">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="div d-flex signature-wrap border-0">
                                <div>
                                    <canvas id="sig-canvas" width="620"
                                        height="160"></canvas>
                                    <label>Signature of the SGUs CEC Installer</label>
                                </div>
                                <div class="cec">
                                    <input type="text" class="form-control" 

                                        id="cec"  style="border-bottom: 1px solid">
                                    <label for="cec">CEC Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="div d-flex signature-wrap border-0">
                                <div>
                                    <canvas id="sig-canvas" width="620"
                                        height="160"></canvas>
                                    <label>Signature of the SGUs CEC Designer</label>
                                </div>
                                <div class="cec">
                                    <input type="text" class="form-control" 
                                        id="cec1" style="border-bottom: 1px solid">
                                    <label for="cec1">CEC Number</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="div d-flex signature-wrap border-0">
                                <div class="print">
                                    <input type="text" class="form-control"
                                        id="print" value="{{ $data->first_name }}" style="border-bottom: 1px solid">
                                    <label for="print">Print Name</label>
                                </div>
                                <div class="cec">
                                    <input type="date" class="form-control"
                                        id="date" value="{{ $data->installation_date }}" style="border-bottom: 1px solid">
                                    <label for="date">Date</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="div d-flex signature-wrap border-0">
                                <div class="print">
                                    <input type="text" class="form-control"
                                        id="print1" value="{{ $data->first_name }}"style="border-bottom: 1px solid">
                                    <label for="print1">Print Name</label>
                                </div>
                                <div class="cec">
                                    <input type="date" class="form-control"
                                        id="date1" value="{{ $data->installation_date }}" style="border-bottom: 1px solid">
                                    <label for="date1">Date</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6" style="border: 1px solid #d1d2d4;">
                        <div class="list">
                            <h5 class="text-uppercase">mendatory declaration</h5>
                            <ul >
                                <li>
                                    I am the legal owner of the above small generation
                                    unit (SGU) and assign the right to create STCs to
                                    <input type="text" class="form-control">
                                    for the period stated above, commencing at the date
                                    of installation.
                                </li>
                                <li>
                                    I have not previously assign or created any STCs for
                                    this system within this period To claim
                                    <input type="text" class="form-control"> years
                                    deeming for SGU. STCs must be registered within 12
                                    months of installlation.
                                </li>
                                <li>
                                    I Understand I am under no obligation to assign STCs
                                    to
                                    <input type="text" class="form-control">
                                </li>
                                <li>
                                    I agree to reay the STC to 
                                    <input type="text" class="form-control"> should my assigment be invalid 
                                </li>
                                <li>
                                    I understand that an agent of the Clean Energy Regulator or  
                                    <input type="text" class="form-control"> may wish to inspect the SGU withnin the five years of certificate redemption
                                </li>
        
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6" id="credential">
                        <p class="d-flex">
                           I understand that this system is eligible for <input type="text" class="form-control" style="border-bottom: 1px solid;">STCs and in exchange for assigning my right to create these STCs, I will recive a point of salle discount from the installer/suppliers. 
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="div d-flex signature-wrap border-0">
                                    <div>
                                        <canvas id="sig-canvas" width="620"
                                            height="160"></canvas>
                                        <label>Owner Signature</label>
                                    </div>
                                    <div class="cec">
                                        <input type="text" class="form-control"
                                            id="ownerdate">
                                        <label for="ownerdate">Date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="div d-flex signature-wrap border-0">
                                    <div>
                                        <canvas id="sig-canvas" width="620"
                                            height="160"></canvas>
                                        <label>Agent / Installer Signature</label>
                                    </div>
                                    <div class="cec">
                                        <input type="text" class="form-control"
                                            id="agentdate">
                                        <label for="agentdate">Date</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="d-flex flex-wrap">
                           PRIVACY DECLARATION : <input type="text" class="form-control" style="border-bottom: 1px solid;">will only use this personal information as Intrnnded and will not sell or divullge this to any parties other than the Clen Energy Regulators.
                         </p>
                    </div>
                  
                     <a class="btn btn-primary" href="{{ route('job.generatePDF',$data->id) }}" align="center"> Download</a>

                     <!-- <a class="btn btn-primary" href="#" onclick="generate_pdf();" align="center"> Download</a> -->
                </div>
               
            </div>
        
        </main>

         <script src="{{ asset('assets/scripts/jsPdf/jspdf.debug.js')}}"></script>
          <script src="{{ asset('assets/scripts/jsPdf/html2pdf.js')}}"></script>


        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
            crossorigin="anonymous"></script> 
        <script>

          
function generate_pdf()
            {
          var doc = new jsPDF();
          var specialElementHandlers = {
            '#editor': function (element, renderer) {
              return true;
            }
          };

          
            doc.fromHTML($('.container-fluid').html(), 15, 15, {
              'width': 170,
              'elementHandlers': specialElementHandlers
            });
            doc.save('sample-file.pdf');
        
}


          function generate_pdf11()
            {
                var pdf = new jsPDF('p', 'pt', 'letter');
                var canvas = pdf.canvas;

                canvas.width = 8.5 * 72;

                html2canvas(document.body, {
                    canvas:canvas,
                    onrendered: function(canvas) {
                        var iframe = document.createElement('iframe');
                        iframe.setAttribute('style','position:absolute;right:0; top:0; bottom:0; height:100%; width:500px');
                        document.body.appendChild(iframe);
                        iframe.src = pdf.output('datauristring');


                    }
                }); 
            }


                (function() {
  window.requestAnimFrame = (function(callback) {
    return window.requestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      window.oRequestAnimationFrame ||
      window.msRequestAnimaitonFrame ||
      function(callback) {
        window.setTimeout(callback, 1000 / 60);
      };
  })();

  var canvas = document.getElementById("sig-canvas");
  var ctx = canvas.getContext("2d");
  ctx.strokeStyle = "#222222";
  ctx.lineWidth = 4;

  var drawing = false;
  var mousePos = {
    x: 0,
    y: 0
  };
  var lastPos = mousePos;

  canvas.addEventListener("mousedown", function(e) {
    drawing = true;
    lastPos = getMousePos(canvas, e);
  }, false);

  canvas.addEventListener("mouseup", function(e) {
    drawing = false;
  }, false);

  canvas.addEventListener("mousemove", function(e) {
    mousePos = getMousePos(canvas, e);
  }, false);

  // Add touch event support for mobile
  canvas.addEventListener("touchstart", function(e) {

  }, false);

  canvas.addEventListener("touchmove", function(e) {
    var touch = e.touches[0];
    var me = new MouseEvent("mousemove", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchstart", function(e) {
    mousePos = getTouchPos(canvas, e);
    var touch = e.touches[0];
    var me = new MouseEvent("mousedown", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchend", function(e) {
    var me = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(me);
  }, false);

  function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: mouseEvent.clientX - rect.left,
      y: mouseEvent.clientY - rect.top
    }
  }

  function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: touchEvent.touches[0].clientX - rect.left,
      y: touchEvent.touches[0].clientY - rect.top
    }
  }

  function renderCanvas() {
    if (drawing) {
      ctx.moveTo(lastPos.x, lastPos.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      ctx.stroke();
      lastPos = mousePos;
    }
  }

  // Prevent scrolling when touching the canvas
  document.body.addEventListener("touchstart", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchend", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchmove", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);

  (function drawLoop() {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();

  function clearCanvas() {
    canvas.width = canvas.width;
  }

  // Set up the UI
  var sigText = document.getElementById("sig-dataUrl");
  var sigImage = document.getElementById("sig-image");
  var clearBtn = document.getElementById("sig-clearBtn");
  var submitBtn = document.getElementById("sig-submitBtn");
  clearBtn.addEventListener("click", function(e) {
    clearCanvas();
    sigText.innerHTML = "Data URL for your signature will go here!";
    sigImage.setAttribute("src", "");
  }, false);
  submitBtn.addEventListener("click", function(e) {
    var dataUrl = canvas.toDataURL();
    sigText.innerHTML = dataUrl;
    sigImage.setAttribute("src", dataUrl);
  }, false);

})();
            </script>
    </body>
</html>