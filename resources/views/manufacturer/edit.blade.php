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


    {!! Form::model($manufacturer, ['method' => 'PATCH','route' => ['manufacturer.update', $manufacturer->id]]) !!}
    <div class="row">
        <div class="col-xs-6 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Name<span class="fa fa-asterisk"></span>:</strong>
                {!! Form::text('manufacturer_name', null, array('placeholder' => 'Manufacturer','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Status:</strong>
                <br />
                <input type="hidden" name="manufacturer" id="create_manufacturer_status" value="1">
                <div class="switch" id="submit">
                    @if($manufacturer->status == 1)
                    <input type="checkbox" checked id="switch-2"
                        onclick="update_company_status($(this),'create_manufacturer_status');">
                    @else
                    <input type="checkbox" id="switch-2"
                        onclick="update_company_status($(this),'create_manufacturer_status');">
                    @endif

                    <label for="switch-2"></label>
                </div>
            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center d-flex" id="buttonWrapper">
            <a class="btn btn-primary" href="{{ route('manufacturer.index') }}"> Back</a>
            <button type="submit" class="btn btn-info btn-sm waves-effect waves-light">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}

</div>
@endsection