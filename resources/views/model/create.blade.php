@extends('layouts.app')


@section('content')
<div class="box-content">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Model</h2>
        </div>
        <div class="pull-right">
            <!-- <a class="btn btn-primary" href="{{ route('status.index') }}"> Back</a> -->
        </div>
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

 <form class="form-horizontal" method="post" action="{{ route('model.store') }}"  enctype="multipart/form-data">
                    @csrf

                    <div id="invoceWrapper">
                                    <div class="form-group">
                                        <!-- <label for="select_manufacturer" class="col-md-3
                                            col-12 control-label">Select Manufacturer<span
                                                class="mdi mdi-multiplication"></span></label> -->
                                                <label for="select_manufacturer" class="col-md-3
                                            col-12 control-label">Select Manufacturer</label>
                                        <div class="col-md-6 col-6">
                                            <select class="form-control" id="select_manufacturer" name="manufacturer_id">
                                                <option value=''>Select Manufacturer</option>
                                                @php
                                                foreach($manufacturer as $k=>$manufac){
                                                @endphp
                                                <option value="{{$manufac->id}}">{{$manufac->manufacturer_name}}</option>
                                                @php
                                                }
                                                @endphp
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="pallet_num"
                                            class="col-md-3
                                            col-12 control-label">Model</label>
                                        <div class="col-md-6 col-6">
                                            <input type="text"  class="form-control" id="model_name" name="model_name"   placeholder="Model">
                                        </div>                                       
                                   </div>
								   
								   <div class="form-group">
                                        <label for="pallet_num"
                                            class="col-md-3  col-12 control-label">Status</label>
											<input type="hidden" name="status" id="create_model_status" value="1">
                                        <div class="col-md-6 col-6">
                                            <div class="switch" id="submit">
												<input type="checkbox" checked id="switch-2"
												onclick="update_company_status($(this),'create_model_status');">
												<label for="switch-2"></label> 
											</div>
                                        </div>                                       
                                   </div>
								   
								   <div class="col-xs-12 col-sm-12 col-md-12 text-center d-flex" id="buttonWrapper">
											<a class="btn btn-primary" href="{{ route('model.index') }}"> Back</a>
											<button type="submit" class="btn btn-info btn-sm waves-effect waves-light">Submit</button>
									</div>

                    
                </form>


</div>
@endsection