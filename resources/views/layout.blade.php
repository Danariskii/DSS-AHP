<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Decision Support System</title>
    <link rel="shortcut icon" href="{{ asset('bird_red.ico') }}">
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="{{ asset('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>

    <script src="{{ asset('js/jquery.js') }}" ></script>
    <script src="{{ asset('js/jquery-ui.js') }}" ></script>

    <script src="{{ asset('js/nouislider.min.js') }}" ></script>
    <script src="{{ asset('js/wNumb.js') }}" ></script>
    <link href="{{ asset('css/nouislider.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('jqwidgets/jqxcore.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('jqwidgets/jqxslider.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('jqwidgets/jqxbuttons.js') }}"  type="text/javascript"></script>
    <link href="{{ asset('jqwidgets/styles/jqx.base.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('jqwidgets/styles/jqx.custom.css') }}" rel="stylesheet" type="text/css" />



    <script src="{{ asset('js/custom.js') }}" ></script>


    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    

    <!-- jquery untuk kebawah -->
    <script src="{{ asset('js/easing.js') }}"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($) 
        {
            $(".scroll").click(function(event)
            {       
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="home">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <div class="logo">
                <img src="{{ asset('images/umn.png') }}" >
                </div>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="{{ URL::to('/') }}">PHI - Admin v1.0</a> -->
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="login"><i class="fa fa-user fa-fw"></i> Login </a>   <!-- {{Session::get('username')}} --></a>
<!--                         </li>
                        <li><a href="login"><i class="fa fa-sign-in fa-fw"></i> Login</a>
                        </li> -->
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>

    <!--<div id="page-wrapper">
            @yield('content')
        </div>
        <!- /#page-wrapper -->
        
        <!-- /#home -->
        <div class="body-content">
            <div class="header" style=" background-image:url('{{ asset('images/header-bg.jpg') }}'); position:relative">
                <div class="main-menu text-center">
                    <h1>Decision Support System for <br/> Air Conditioner</h1>
                    <span>Built with Love</span>
                    <a class="slide-btn scroll" href="#dss">Start</a>
                </div>

                <div class="features-grids text-center">
                    <div class="col-md-3 features-grid">
                        <a href="#list" class="scroll">
                            <span class="fea-icon1"><i class="fa fa-thumbs-up"></i> </span>
                        </a>
                        <h3>List Air Conditioner</h3>
                    </div>
                    <div class="col-md-3 features-grid">
                        <a href="#dss" class="scroll">
                            <span class="fea-icon1"><i class="fa fa-tachometer"> </i> </span>
                        </a>
                        <h3>DSS</h3>
                    </div>
                    <div class="col-md-3 features-grid">
                        <a href="#quest" class="scroll">
                            <span class="fea-icon1"><i class="fa fa-question"> </i> </span>
                        </a>
                        <h3>Questionnare</h3>
                    </div>
                    <div class="col-md-3 features-grid">
                        <a href="#about" class="scroll">
                            <span class="fea-icon1"><i class="fa fa-star"> </i> </span>
                        </a>
                        <h3>About</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#end-home -->

    </div>

    <!-- List Air Conditioner -->

        <div id="list" class="List-box">
            <div class="head text-center">
                <h3><span> </span> List Merek Air Conditioner</h3>
            </div>
        </div>

    <!-- End List Air Conditioner -->

    <!-- Decision Support System -->

        <div id="dss" class="DSS">
            <div class="head text-center">
                <h2><span> </span> Decision Support System</h2>
            </div>

            <h3>Kapasitas</h3>
            <div class="containerValue">
                <div class="minmax">
                    <div style="float: left" id="KapasitasMin"></div>
                    <div style="float: right" id="KapasitasMax"></div>
                </div>
                <div class="slider" id="sliderKapasitas"></div>
            </div>

            <h3>Garansi</h3>
            <div class="containerValue">
                <div class="minmax">
                    <div style="float: left" id="GaransiMin"></div>
                    <div style="float: right" id="GaransiMax"></div>
                </div>
                <div class="slider" id="sliderGaransi"></div>
            </div>

            <h3>Perawatan</h3>
            <div class="containerValue">
                <div class="minmax">
                    <div style="float: left" id="PerawatanMin"></div>
                    <div style="float: right" id="PerawatanMax"></div>
                </div>
                <div class="slider" id="sliderPerawatan"></div>
            </div>

            <h3>Fitur</h3>
            <div class="containerValue">
                <div class="minmax">
                    <div style="float: left" id="FiturMin"></div>
                    <div style="float: right" id="FiturMax"></div>
                </div>
                <div class="slider" id="sliderFitur"></div>
            </div>

            <h3>Listrik</h3>
            <div class="containerValue">
                <div class="minmax">
                    <div style="float: left" id="ListrikMin"></div>
                    <div style="float: Right" id="ListrikMax"></div>
                </div>
                <div class="slider" id="sliderListrik"></div>
            </div>

            <h3>Desain</h3>
            <div class="containerValue">
                <div class="minmax">
                    <div style="float: left" id="DesainMin"></div>
                    <div style="float: right" id="DesainMax"></div>
                </div>
                <div class="slider" id="sliderDesain"></div>
            </div>

            <h3>Ketahanan</h3>
            <div class="containerValue">
                <div class="minmax">
                    <div style="float: left" id="KetahananMin"></div>
                    <div style="float: right" id="KetahananMax"></div>
                </div>
                <div class="slider" id="sliderKetahanan"></div>
            </div>
        </div>

    <!-- end Decision Support System -->

    <!--Start Questionnare-->

        <div id="quest" class="question-box">
            <div class="head text-center">
                <h3><span> </span> Questionnare </h3>
            </div>
        </div>

    <!--End Questionnare-->

    <!-- About-Me -->

    <div id="about" class="aboutme">
        <div class="head text-center">
            <h3><span> </span> About </h3>
        </div>
        <div class="text-center">
            <p>Nama : Danariski Pratama <br/> </p>
            <p>NIM : 11110110097<br/> </p>
            <p>Fakultas : Teknologi Informasi dan Komunikasi<br/> </p>
            <p>Program Studi : Teknik Informasi<br/> </p>
            <p>Universitas Multimedia Nusantara<br/> </p>
        </div>
    </div>

    <!-- End About -->

    <!--start-footer-->

    <div class="footer">
        <script src="{{ asset('js/move-top.js') }}"></script>
            <script type="text/javascript">
                $(document).ready(function() 
                {
                    var defaults = {
                        containerID: 'toTop', // fading element id
                        containerHoverID: 'toTopHover', // fading element hover id
                        scrollSpeed: 1200,
                        easingType: 'linear' 
                    };
                    $().UItoTop({ easingType: 'easeOutQuart' });
                });
            </script>
            <a href="#home" id="toTop" style="display: block; background-image:url('{{ asset('images/to-top1.png') }}');"> <span id="toTopHover" style="opacity: 1;"> </span></a>
    </div>

    <!-- End-Footer -->



    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{ asset('bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('dist/js/sb-admin-2.js') }}"></script>

    <!-- Page-Level Demo script - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
