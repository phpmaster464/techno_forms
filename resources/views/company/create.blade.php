@extends('layouts.app')


@section('content')

<div class="row ">


    <div class="col-12 ">
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
                <form class="form-horizontal" method="post" action="{{ route('company.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" name="company_logo" accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                               <!--  <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);"> -->
                                <div id="imagePreview" style="background-image: url();">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-12 mb-3">

                        <div class="form-group">
                            <label for="CompanyName" class="col-md-3 col-12 control-label">Name <span class="mdi mdi-multiplication"></span></label>
                            <div class="col-md-9 col-12">
                                <input type="text" class="form-control" id="CompanyName"
                                    placeholder="Enter Name" name="company_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="CompanyPrimaryEmailAddress " class="col-md-3 col-12 control-label">
                                Primary Email Address <span class="mdi mdi-multiplication"></span></label>
                            <div class="col-md-9 col-12">
                                <input type="email" class="form-control" id="CompanyPrimaryEmailAddress"
                                    placeholder="Enter Primary Email Address " name="company_primary_email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="CompanyContactNumber" class="col-md-3 col-12 control-label">Contact
                                Number <span class="mdi mdi-multiplication"></span></label>
                            <div class="col-md-9 col-12">
                                <input type="text" class="form-control" id="CompanyContactNumber"
                                    placeholder="Enter Contact Number" name="company_contact_number">
                            </div>
                        </div>
                    </div>
                    <div class="row other-info-title">
                        <span>Other Information </span>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-3">
                        <div class="form-group">
                            <label for="CompanySecondaryEmailAddress" class="col-md-3 col-12 control-label">
                                Secondary Email Address <!-- <span class="mdi mdi-multiplication"> --></span></label>
                            <div class="col-md-9 col-12">
                                <input type="email" class="form-control" id="CompanySecondaryEmailAddress"
                                    placeholder="Enter Secondary Email Address " name="company_secondary_email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="CompanyWebsite" class="col-md-3 col-12 control-label">Website <!-- <span class="mdi mdi-multiplication"></span> --></label>
                            <div class="col-md-9 col-12">
                                <input type="text" class="form-control" id="CompanyWebsite"
                                    placeholder="Enter website" name="company_website">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="CompanyDescription" class="col-md-3 col-12 control-label">Description <!-- <span class="mdi mdi-multiplication"></span> --></label>
                            <div class="col-md-9 col-12">
                                    <textarea class="form-control" name="" rows="3" class="form-control" id="CompanyDescription"
                                    placeholder="Enter Description" name="company_description"></textarea>
                            </div>
                        </div>
                         <!-- Company status ( enable / disable) -->
                         <div id="container" class="form-group">
                            <label for="CompanyStatus" class="col-md-3 col-12 control-label">Status <!-- <span class="mdi mdi-multiplication"></span> --></label>
                            <div class="col-md-9 col-12">
                                <input type="hidden" name="company_status" id="create_company_status" value="1">
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
                            <a class="btn btn-primary" href="{{ route('company.index') }}"> Back</a>
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
<!-- 
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<!-- <div class="box-content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New company</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('company.index') }}"> Back</a>
            </div>
        </div>
    </div>


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


    <form action="{{ route('company.store') }}" method="POST">
        @csrf


         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="company_name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="company_primary_email" placeholder="Detail"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form>

</div> -->

@endsection