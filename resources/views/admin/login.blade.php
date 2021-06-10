<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::to('/')}}/assets/images/favicon.png">
    <title>Login | Admin | Helperrific</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{URL::to('/')}}/assets/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{URL::to('/')}}/assets/admin/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{URL::to('/')}}/assets/admin/css/colors/default.css" id="theme" rel="stylesheet">
    <style type="text/css">
        .login-register {
            padding: 15% 0 !important;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{URL::to('/')}}/assets/admin/images/background/login-register.jpg);">
            <div class="login-box card">
                <div class="card-body">
                    <img src="{{URL::to('/')}}/assets/images/logo.png">
                    <form class="form-horizontal form-material" method="post">
                        {{csrf_field()}}
                        <br>
                        <h3 class="box-title m-b-20">Admin Authentication</h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="username" placeholder="Username"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" name="password" placeholder="Password"> </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 font-14"></div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{URL::to('/')}}/assets/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{URL::to('/')}}/assets/admin/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{URL::to('/')}}/assets/admin/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{URL::to('/')}}/assets/admin/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="{{URL::to('/')}}/assets/admin/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{URL::to('/')}}/assets/admin/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="{{URL::to('/')}}/assets/admin/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="{{URL::to('/')}}/assets/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="{{URL::to('/')}}/assets/admin/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{URL::to('/')}}/assets/admin/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>