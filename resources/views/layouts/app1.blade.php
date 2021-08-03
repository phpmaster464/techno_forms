<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">



    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Techno Forms') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <!-- Main Styles -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/styles/style.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}">
    
    <!-- Material Design Icon -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/material-design/css/materialdesignicons.css') }}">

    <!-- mCustomScrollbar -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">


    <!-- Waves Effect -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/waves/waves.min.css') }}">

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/sweet-alert/sweetalert.css') }}">
    
    <!-- Morris Chart -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/chart/morris/morris.css') }}">

    <!-- FullCalendar -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/fullcalendar/fullcalendar.print.css') }}" media='print'>

    <!-- Data Tables -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/datatables/media/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css')}}">




    @if(Auth::check())

    <style type="text/css">
     <style>
     .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
  }

  .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
  }

  .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
  }

  .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
  }

  input:checked + .slider {
      background-color: #2196F3;
  }

  input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
      border-radius: 34px;
  }

  .slider.round:before {
      border-radius: 50%;
  }
</style>
</style>
@endif

</head>
<body>

    @if(Auth::check())
    <!-- custom theme -->

    <div class="main-menu">
        <header class="header" >
            <a href="index.html" class="logo">
                <img src="{{ asset('assets/images/logo/TF-logo-1.png') }}">
            </a>
            <button type="button" class="button-close fa fa-times js__menu_close"></button>
            <div class="user">
                <a href="#" class="avatar"><img src="assets/images/avatar-sm-5.jpg" alt=""><span class="status online"></span></a>
                <h5 class="name"><a href="profile.html">{{ Auth::user()->name }}</a></h5>
                <h5 class="position">Administrator</h5>
                <!-- /.name -->
                <div class="control-wrap js__drop_down">
                    <i class="fa fa-caret-down js__drop_down_button"></i>
                    <div class="control-list">
                        <div class="control-item"><a href="profile.html"><i class="fa fa-user"></i> Profile</a></div>
                        <div class="control-item"><a href="#"><i class="fa fa-gear"></i> Settings</a></div>
                        <div class="control-item"><a href="#"><i class="fa fa-sign-out"></i> Log out</a></div>
                    </div>
                    <!-- /.control-list -->
                </div>
                <!-- /.control-wrap -->
            </div>
            <!-- /.user -->
        </header>
        <!-- /.header -->
        <div class="content">

            <div class="navigation">
                <h5 class="title">Navigation</h5>
                <!-- /.title -->
                <ul class="menu js__accordion">
                    <li class="current" onclick="change_current_menu($(this));">
                        <a class="waves-effect" href="{{route('home')}}"><i class="menu-icon mdi mdi-view-dashboard"></i><span>Dashboard</span></a>
                    </li>

                    <li class="" onclick="change_current_menu($(this));" id="company_li">
                        <a class="waves-effect" href="{{route('company.index')}}"><i class="menu-icon mdi mdi-desktop-mac"></i><span>Company</span></a>
                    </li>
                </ul>
                <!-- /.menu js__accordion -->

                <!-- /.menu js__accordion -->
            </div>
            <!-- /.navigation -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.main-menu -->

    <div class="fixed-navbar">
        <div class="pull-left">
            <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
            <!-- <h1 class="page-title">Home</h1> -->
            <!-- /.page-title -->
        </div>
        <!-- /.pull-left -->
        <div class="pull-right">
            <div class="ico-item">
                <a href="#" class="ico-item mdi mdi-magnify js__toggle_open" data-target="#searchform-header"></a>
                <form action="#" id="searchform-header" class="searchform js__toggle"><input type="search" placeholder="Search..." class="input-search"><button class="mdi mdi-magnify button-search" type="submit"></button></form>
                <!-- /.searchform -->
            </div>
            <!-- /.ico-item -->
            <a href="#" class="ico-item mdi mdi-email notice-alarm js__toggle_open" data-target="#message-popup"></a>
            <a href="#" class="ico-item pulse"><span class="ico-item mdi mdi-bell notice-alarm js__toggle_open" data-target="#notification-popup"></span></a>
            <a href="{{ route('logout') }}" class="ico-item mdi mdi-logout" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"></a>
        </div>
        <!-- /.pull-right -->
    </div>
    <!-- /.fixed-navbar -->

    <div id="notification-popup" class="notice-popup js__toggle" data-space="75">
        <h2 class="popup-title">Your Notifications</h2>
        <!-- /.popup-title -->
        <div class="content">
            <ul class="notice-list">
                <li>
                    <a href="#">
                        <span class="avatar"><img src="assets/images/avatar-sm-1.jpg" alt=""></span>
                        <span class="name">John Doe</span>
                        <span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
                        <span class="time">10 min</span>
                    </a>
                </li>
            </ul>
            <!-- /.notice-list -->
            <a href="#" class="notice-read-more">See more messages <i class="fa fa-angle-down"></i></a>
        </div>
        <!-- /.content -->
    </div>
    <!-- /#notification-popup -->

    <div id="message-popup" class="notice-popup js__toggle" data-space="75">
        <h2 class="popup-title">Recent Messages<a href="#" class="pull-right text-danger">New message</a></h2>
        <!-- /.popup-title -->
        <div class="content">
            <ul class="notice-list">
                <li>
                    <a href="#">
                        <span class="avatar"><img src="assets/images/avatar-sm-1.jpg" alt=""></span>
                        <span class="name">John Doe</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">10 min</span>
                    </a>
                </li>
            </ul>
            <!-- /.notice-list -->
            <a href="#" class="notice-read-more">See more messages <i class="fa fa-angle-down"></i></a>
        </div>
        <!-- /.content -->
    </div>
    <!-- /#message-popup -->

    <!-- custom theme -->



    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                @endif
                <div id="app">
                    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                        <div class="">
               <!--  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->

                <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
                    <!-- Left Side Of Navbar -->
                    <!--  <ul class="navbar-nav mr-auto"></ul> -->


                    <!-- Right Side Of Navbar -->
                    <!-- <ul class="navbar-nav ml-auto"> -->
                        <!-- Authentication Links -->
                        @guest
                            <!-- <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>-->
                                @else
                            <!-- <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
                            <li><a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a></li>
                            <li><a class="nav-link" href="{{ route('products.index') }}">Manage Product</a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a> -->


                               <!--  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                -->

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <!-- </div>
                                </li> -->
                                @endguest
                   <!--  </ul>
                </div>
            </div>
        </nav> -->


        <main class="py-4">
            <div class="">
                @yield('content')
            </div>
        </main>
    </div>

    @if(Auth::check())
    <footer class="footer">
        <ul class="list-inline">
            <li>2021 © TechnoForms.</li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Terms</a></li>
            <li><a href="#">Help</a></li>
        </ul>
    </footer>
</div>
<!-- /.main-content -->
</div>
@endif
<!--/#wrapper -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="assets/script/html5shiv.min.js }}"></script>
        <script src="assets/script/respond.min.js }}"></script>
    <![endif]-->
    <!-- 
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="{{ asset('assets/scripts/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/scripts/modernizr.min.js') }}"></script>
        <script src="{{ asset('assets/plugin/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="{{ asset('assets/plugin/nprogress/nprogress.js') }}"></script>
        <script src="{{ asset('assets/plugin/sweet-alert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('assets/plugin/waves/waves.min.js') }}"></script>

        <!-- Morris Chart -->
        <script src="{{ asset('assets/plugin/chart/morris/morris.min.js') }}"></script>
        <script src="{{ asset('assets/plugin/chart/morris/raphael-min.js') }}"></script>
        <script src="{{ asset('assets/scripts/chart.morris.init.min.js') }}"></script>

        <!-- Flot Chart -->
        <script src="{{ asset('assets/plugin/chart/plot/jquery.flot.min.js') }}"></script>
        <script src="{{ asset('assets/plugin/chart/plot/jquery.flot.tooltip.min.js') }}"></script>
        <script src="{{ asset('assets/plugin/chart/plot/jquery.flot.categories.min.js') }}"></script>
        <script src="{{ asset('assets/plugin/chart/plot/jquery.flot.pie.min.js') }}"></script>
        <script src="{{ asset('assets/plugin/chart/plot/jquery.flot.stack.min.js') }}"></script>
        <script src="{{ asset('assets/scripts/chart.flot.init.min.js') }}"></script>

        <!-- Sparkline Chart -->
        <script src="{{ asset('assets/plugin/chart/sparkline/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('assets/scripts/chart.sparkline.init.min.js') }}"></script>

        <!-- FullCalendar -->
        <script src="{{ asset('assets/plugin/moment/moment.js') }}"></script>
        <script src="{{ asset('assets/plugin/fullcalendar/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('assets/scripts/fullcalendar.init.js') }}"></script>

        <!-- Data Tables -->
        <script src="{{ asset('assets/plugin/datatables/media/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('assets/plugin/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{ asset('assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{ asset('assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js')}}"></script>
        <script src="{{ asset('assets/scripts/datatables.demo.min.js')}}"></script>


        <script src="{{ asset('assets/scripts/main.js') }}"></script>



        <script type="text/javascript">
            function reset_password_email()
            {
                var email = $('#email').val();
                jQuery.ajax({
                    type:"POST",
                    url:"{{ route('password.email') }}",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        "email": email
                    },
                    dataType:'json',
                    beforeSend:function(){
                     $("#btnFetch").prop("disabled", true);
                     $("#email").prop("disabled", true);
                     $("#btnFetch").html('<i class="fa fa-circle-o-notch fa-spin"></i> loading...');
                 },
                 success:function(data){
                    $("#btnFetch").prop("disabled", false);
                    $("#btnFetch").html('Send Password Reset Link');
                    swal({
                        title : "Password Reset Successfull", 
                        type: "success",
                        confirmButtonColor: '#f60e0e',
                    });
                    window.location.replace("{{url('/')}}/login");
                }, 
                
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $("#btnFetch").prop("disabled", false);
                    $("#btnFetch").html('Send Password Reset Link'); 
                    $("#email").val('');
                    var error = JSON.parse(XMLHttpRequest.responseText);
                    var err_text = "Something went wrong";
                    if(typeof error.errors.email[0] != "undefined"){
                        var err_text =  error.errors.email[0];
                    }
                    swal({
                        title : err_text, 
                        type: "error",
                        confirmButtonColor: '#f60e0e',
                    });
                    
                }
            });
            } 

            function reset_password()
            {   
                var token = $('#res_token').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var password_confirmation = $('#password-confirm').val();

                jQuery.ajax({
                    type:"POST",
                    url:"{{ route('password.update') }}",
                    data:{
                        "_token": "{{ csrf_token() }}", 
                        "token":token,   
                        "email":email,
                        "password":password,
                        "password_confirmation":password_confirmation,
                    }, 
                    dataType:'json',
                    beforeSend:function(){
                     $("#btnFetch").prop("disabled", true);
                     $("#email").prop("disabled", true);
                     $("#btnFetch").html('<i class="fa fa-circle-o-notch fa-spin"></i> loading...');
                 },
                 success:function(data){
                    $("#btnFetch").prop("disabled", false);
                    $("#btnFetch").html('Send Password Reset Link');
                    swal({
                        title : "Password Reset Successfull", 
                        type: "success",
                        confirmButtonColor: '#f60e0e',
                    });
                    window.location.replace("{{url('/')}}/logout");
                }, 
                
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $("#btnFetch").prop("disabled", false);
                    $("#btnFetch").html('Send Password Reset Link'); 
                    $("#email").val('');
                    var error = JSON.parse(XMLHttpRequest.responseText);
                    var err_text = "Something went wrong";
                    // if(typeof error.errors.email[0] != "undefined"){
                    //     var err_text =  error.errors.email[0];
                    // }
                     // swal({
                     //        title : err_text, 
                     //        type: "error",
                     //        confirmButtonColor: '#f60e0e',
                     //    });

                 }
             });
            }


            function update_company_status(obj,id){
                var status = obj.is(':checked'); 
                if(status == true)
                {
                    $('#'+id).val(1);
                }
                else
                {
                    $('#'+id).val(0); 
                }
            }

            function set_company_status(id)
            {

                jQuery.ajax({
                    type:"POST",
                    url:"{{ route('company.companyStatus') }}",
                    data:{
                        "_token": "{{ csrf_token() }}", 
                        "id" : id
                    }, 
                    dataType:'json',
                    beforeSend:function(){

                    },
                    success:function(data){
                     alert('done');
                 }
             });

            }

            $(document).ready(function(){
                var url  = window.location.href;
                var data = url.search('company');
                if(data != -1)
                {   
                    $(".menu li").removeClass("current");
                    $("#company_li").addClass('current');
                    return false;
                }



            });

            function change_current_menu(menu_link)
            {
                $(".menu li").removeClass("current");

                menu_link.addClass("current");
            }

            function loadImg(){
                $('#frame').attr('src', URL.createObjectURL(event.target.files[0]));
                $('#frame').css("border","1px solid black");
                $('#frame').show();
            }

        </script>

    </body>
    </html>


</body>
</html>