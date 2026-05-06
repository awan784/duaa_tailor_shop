<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login - Darzi Shop </title>
    <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap1.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/themefy_icon/themify-icons.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/niceselect/css/nice-select.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/owl_carousel/css/owl.carousel.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/gijgo/gijgo.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/font_awesome/css/all.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/tagsinput/tagsinput.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/datepicker/date-picker.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/vectormap-home/vectormap-2.0.2.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/scroll/scrollable.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/datatable/css/jquery.dataTables.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/datatable/css/responsive.dataTables.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/datatable/css/buttons.dataTables.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/morris/morris.css')}}">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/material_icon/material-icons.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style1.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css')}}"/>
    <link rel="stylesheet" id="colorSkinCSS" href="{{ asset('admin-assets/css/colors/default.css')}}">
</head>
<body class="login_body">
    
    <section class="login-content">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="">
                        <div class="modal-content cs_modal">
                            <div class="modal-header justify-content-center theme_bg_1">
                                <h5 class="modal-title text_white">Log in</h5>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Your Email" autofocus>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <button type="submit" class="btn_1 full_width text-center">
                                        {{ __('Login') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('admin-assets/js/jquery1-3.4.1.min.js')}}"></script>
    <script src="{{asset('admin-assets/js/popper1.min.js')}}"></script>
    <script src="{{asset('admin-assets/js/bootstrap.min.html')}}"></script>
    <script src="{{asset('admin-assets/js/metisMenu.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/count_up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/chartlist/Chart.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/count_up/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/niceselect/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/owl_carousel/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/jszip.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datepicker/datepicker.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datepicker/datepicker.en.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datepicker/datepicker.custom.js')}}"></script>
    <script src="{{asset('admin-assets/js/chart.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/chartjs/roundedBar.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/progressbar/jquery.barfiller.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/tagsinput/tagsinput.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/am_chart/amcharts.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/scroll/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/scroll/scrollable-custom.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/vectormap-home/vectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/vectormap-home/vectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/apex_chart/apex-chart2.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/apex_chart/apex_dashboard.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/echart/echarts.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/chart_am/core.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/chart_am/charts.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/chart_am/animated.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/chart_am/kelly.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/chart_am/chart-custom.js')}}"></script>
    <script src="{{asset('admin-assets/js/dashboard_init.js')}}"></script>
    <script src="{{asset('admin-assets/js/custom.js')}}"></script>
</body>
</html>