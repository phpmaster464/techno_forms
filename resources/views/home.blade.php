@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row small-spacing">
            <div class="col-lg-3 col-xs-12">
                <div class="box-content front-card-counter">
                    <div class="col-lg-4 col-xs-12 icon-wrapper">
                        <span class="fa fa-building"></span>
                    </div>
                    <div class="col-lg-8 col-xs-12">
                        <h4 class="counter text-info">Total Companies</h4>
                        <p class="text text-info">{{ $company_count }} </p>
                    </div>
                </div>
                <!-- /.box-content -->
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="box-content front-card-counter">
                    <div class="col-lg-4 col-xs-12 icon-wrapper">
                        <span class="fa fa-briefcase"></span>
                    </div>
                    <div class="col-lg-8 col-xs-12">
                    <h4 class="counter text-info">Total Jobs</h4>
                        <p class="text text-info">{{ $jobs_count }} </p>
                    </div>
                </div>
                <!-- /.box-content -->
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="box-content front-card-counter">
                    <div class="col-lg-4 col-xs-12 icon-wrapper">
                        <span class="fa fa-user"></span>
                    </div>
                    <div class="col-lg-8 col-xs-12">
                    <h4 class="counter text-info">Total Customers</h4>
                        <p class="text text-info">{{ $installer_count }} </p>
                    </div>
                </div>
                <!-- /.box-content -->
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="box-content front-card-counter">
                    <div class="col-lg-4 col-xs-12 icon-wrapper">
                        <span class="fa fa-user-secret"></span>
                    </div>
                    <div class="col-lg-8 col-xs-12">
                    <h4 class="counter text-info">Total Technician</h4>
                        <p class="text text-info">50</p>
                    </div>
                </div>
                <!-- /.box-content -->
            </div>
        </div>
        <!-- /.row -->

@endsection
