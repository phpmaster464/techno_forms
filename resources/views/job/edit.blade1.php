@extends('layouts.app')
@section('content')
<div class="row ">
    <div class="col-12 ">
        <div class="box-content card white">
            <h4 class="box-title">Jobs Detailes(Edit Page)</h4>
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
            </div>
        </div>
    </div>
</div>
@endsection