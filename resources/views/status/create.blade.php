@extends('layouts.app')


@section('content')
<div class="box-content">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Status</h2>
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


{!! Form::open(array('route' => 'status.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Name<span class="fa fa-asterisk"></span>:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group role-wrapper">
            <strong>Status:</strong>
            <input type="hidden" name="status" id="create_status_status" value="1">
            <div class="switch" id="submit">
                <input type="checkbox" checked id="switch-2"
                onclick="update_company_status($(this),'create_status_status');">
                <label for="switch-2"></label> 
            </div>
        </div>
        <!-- <div class="form-group">
            <strong>Permission:</strong>
            <br/>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
        </div> -->
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center d-flex" id="buttonWrapper">
            <a class="btn btn-primary" href="{{ route('status.index') }}"> Back</a>
            <button type="submit" class="btn btn-info btn-sm waves-effect waves-light">Submit</button>
        </div>
</div>
{!! Form::close() !!}


</div>
@endsection