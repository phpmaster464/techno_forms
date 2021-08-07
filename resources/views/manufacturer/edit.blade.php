@extends('layouts.app')


@section('content')
<div class="box-content">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Manufacturer Edit</h2>
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



    <form class="form-horizontal" method="post" action="{{ route('manufacturer.update',$manufacturer->id) }}"  enctype="multipart/form-data">
        
    @csrf
     @method('PUT')
<div id="invoceWrapper">
    <div class="form-group">
        <label for="pallet_num"
        class="col-md-3
        col-12 control-label">Manufacturer</label>
        <div class="col-md-6 col-6">
            <input type="text"  class="form-control" id="Manufacturer" name="manufacturer_name"   value="{{$manufacturer->manufacturer_name}}">
        </div>                                       
    </div>

    <div class="form-group">
        <label for="status" class="col-md-3  col-12 control-label">Status</label>
            <input type="hidden" name="status" id="create_Manufacturer_status" value="1">
        <div class="switch" id="submit">
            @if($manufacturer->status == 1)
                <input type="checkbox" checked id="switch-2"
                onclick="update_company_status($(this),'create_Manufacturer_status');">
            @else
                <input type="checkbox" id="switch-2"
                onclick="update_company_status($(this),'create_Manufacturer_status');">
            @endif
            <label for="switch-2"></label>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center d-flex" id="buttonWrapper">
        <a class="btn btn-primary" href="{{ route('manufacturer.index') }}"> Back</a>
        <button type="submit" class="btn btn-info btn-sm waves-effect waves-light">Submit</button>
    </div>

</div>
</div>
 </form>


@endsection