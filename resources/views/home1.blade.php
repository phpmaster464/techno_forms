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
            <!-- <div class="col-xs-12">
                <div class="box-content">
                    <h4 class="box-title">Activity</h4>
                   
                    <div class="dropdown js__drop_down">
                        <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                        <ul class="sub-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else there</a></li>
                            <li class="split"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                      
                    </div>
                  
                    <div id="real-time-flot-chart" class="flot-chart" style="height: 320px"></div>
                   
                </div>
              
            </div> -->
            <!-- /.col-xs-12 -->

            <div class="col-lg-4 col-xs-12">
                <div class="box-content">
                    <h4 class="box-title text-info">Total Visitors</h4>
                    <!-- /.box-title -->
                    <div class="dropdown js__drop_down">
                        <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                        <ul class="sub-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else there</a></li>
                            <li class="split"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                        <!-- /.sub-menu -->
                    </div>
                    <!-- /.dropdown js__dropdown -->
                    <div class="content widget-stat">
                        <div id="traffic-sparkline-chart-1" class="left-content margin-top-15"></div>
                        <!-- /#traffic-sparkline-chart-1 -->
                        <div class="right-content">
                            <h2 class="counter text-info">278</h2>
                            <!-- /.counter -->
                            <p class="text text-info">Some text here</p>
                            <!-- /.text -->
                        </div>
                        <!-- .right-content -->
                    </div>
                    <!-- /.content widget-stat -->
                </div>
                <!-- /.box-content -->
            </div>
            <!-- /.col-lg-4 col-xs-12 -->

            <div class="col-lg-4 col-xs-12">
                <div class="box-content">
                    <h4 class="box-title text-success">Projects Done</h4>
                    <!-- /.box-title -->
                    <div class="dropdown js__drop_down">
                        <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                        <ul class="sub-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else there</a></li>
                            <li class="split"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                        <!-- /.sub-menu -->
                    </div>
                    <!-- /.dropdown js__dropdown -->
                    <div class="content widget-stat">
                        <div id="traffic-sparkline-chart-2" class="left-content margin-top-10"></div>
                        <!-- /#traffic-sparkline-chart-2 -->
                        <div class="right-content">
                            <h2 class="counter text-success">36%</h2>
                            <!-- /.counter -->
                            <p class="text text-success">Some text here</p>
                            <!-- /.text -->
                        </div>
                        <!-- .right-content -->
                    </div>
                    <!-- /.content widget-stat -->
                </div>
                <!-- /.box-content -->
            </div>
            <!-- /.col-lg-4 col-xs-12 -->

            <div class="col-lg-4 col-xs-12">
                <div class="box-content">
                    <h4 class="box-title text-success">Salary Traffic</h4>
                    <!-- /.box-title -->
                    <div class="dropdown js__drop_down">
                        <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                        <ul class="sub-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else there</a></li>
                            <li class="split"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                        <!-- /.sub-menu -->
                    </div>
                    <!-- /.dropdown js__dropdown -->
                    <div class="content widget-stat">
                        <div id="traffic-sparkline-chart-3" class="left-content"></div>
                        <!-- /#traffic-sparkline-chart-3 -->
                        <div class="right-content">
                            <h2 class="counter text-danger">849 <i class="fa fa-angle-double-up"></i></h2>
                            <!-- /.counter -->
                            <p class="text text-danger">Some text here</p>
                            <!-- /.text -->
                        </div>
                        <!-- .right-content -->
                    </div>
                    <!-- /.content widget-stat -->
                </div>
                <!-- /.box-content -->
            </div>
            <!-- /.col-lg-4 col-xs-12 -->

            <div class="col-lg-6 col-xs-12">
                <div class="box-content">
                    <h4 class="box-title">Visitor Analytics</h4>
                    <!-- /.box-title -->
                    <div class="dropdown js__drop_down">
                        <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                        <ul class="sub-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else there</a></li>
                            <li class="split"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                        <!-- /.sub-menu -->
                    </div>
                    <!-- /.dropdown js__dropdown -->
                    <div id="bar-morris-chart" class="morris-chart" style="height: 240px"></div>
                    <div class="text-center">
                        <ul class="list-inline morris-chart-detail-list">
                            <li><i class="fa fa-circle"></i>Series A</li>
                            <li><i class="fa fa-circle"></i>Series B</li>
                            <li><i class="fa fa-circle"></i>Series C</li>
                        </ul>
                    </div>
                    <!-- /#bar-morris-chart.morris-chart -->
                </div>
                <!-- /.box-content -->
            </div>
            <!-- /.col-lg-6 col-xs-12 -->

            <div class="col-lg-6 col-xs-12">
                <div class="box-content">
                    <h4 class="box-title">Memory usage</h4>
                    <!-- /.box-title -->
                    <div class="dropdown js__drop_down">
                        <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                        <ul class="sub-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else there</a></li>
                            <li class="split"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                        <!-- /.sub-menu -->
                    </div>
                    <!-- /.dropdown js__dropdown -->
                    <div id="donut-morris-chart" class="morris-chart" style="height: 240px"></div>
                    <div class="text-center">
                        <ul class="list-inline morris-chart-detail-list">
                            <li><i class="fa fa-circle"></i>Series A</li>
                            <li><i class="fa fa-circle"></i>Series B</li>
                            <li><i class="fa fa-circle"></i>Series C</li>
                        </ul>
                    </div>
                    <!-- /#donut-morris-chart.morris-chart -->
                </div>
                <!-- /.box-content -->
            </div>
            <!-- /.col-lg-6 col-xs-12 -->
        </div>
        <!-- /.row -->

@endsection
