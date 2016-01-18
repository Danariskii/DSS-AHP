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
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('js/jquery-ui.js') }}" ></script>

    <script src="{{ asset('jqwidgets/jqxcore.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('jqwidgets/jqxslider.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('jqwidgets/jqxbuttons.js') }}"  type="text/javascript"></script>
    <link href="{{ asset('jqwidgets/styles/jqx.base.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('jqwidgets/styles/jqx.custom.css') }}" rel="stylesheet" type="text/css" />

    <!-- jquery untuk kebawah -->
    <script src="{{ asset('js/easing.js') }}"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($) 
        {
            $(".scroll").click(function(event)
            {       
                event.preventDefault();
                $('html,body').animate(
                    {scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript"> 
        addEventListener("load", function() 
            {
                setTimeout(hideURLbar, 0); }, false);
                function hideURLbar(){ window.scrollTo(0,1); 
            } 
    </script>

    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });

    var insialisasi = (function ($){

        var addEventListener = function (){
            $('.jqx-slider').on('change',function (event) {
                var filter = $(this).attr('filter');
                handleSlide(filter, event.args.value);
                // alert(filter);
            });
        };

        var handleSlide = function (option, value)
        {
            // filterItems(updateFilter(option, value));
            setLabelValue(this[option + 'Slider'], option, value);
        };

        var setLabelValue = function (slider, option, value)
        {

        };

        var filterItems = function (filter)
        {

        };

        return {
            init: function (){
                addEventListener();
            }
        }

    } ($));

    $(document).ready(function () 
    {
        var JumlahKriteria = '{{$JumlahKriteria}}';
        var TableKriteria = JSON.parse('{!! ($Table_Kriteria) !!}');
        var SubKriteria = JSON.parse('{!! ($SubKriteria) !!}');
        var arraySlider = [];
        var value = [];

        // console.log(SubKriteria[0][1].Capasitas);
        // console.log(TableKriteria[1].Jumlah_SubKriteria);
        $('#SubmitBtn').click(function()
        {
            var token = $('meta[name="csrf-token"]').attr('content');
            // var min = $(this).attr('id');
            // var Kmin = 'KetMin' + min;
            // var Kmax = 'KetMax' + min;
            // var ket = event.args.value['rangeStart'] +' dan '+ event.args.value['rangeEnd'];
            for (var i = 0; i < JumlahKriteria; i++)
            {
                value[i] = $(arraySlider[i]).jqxSlider('getValue');
            };

            jQuery.ajax({
                url: "{{URL::to('postValue')}}",
                data: {value: value},
                type : "POST"
            });
            // console.log(value)
        });

        for (var i = 0; i < JumlahKriteria; i++) 
        {
            // alert(i);
            // for (var j = 1+i; j < NamaKriteria.length ; j++) 
            // {
                var ni = document.getElementById('grupslider');
                var namaslider = 'slider'+TableKriteria[i].Nama_Kriteria;
                var namaPanggilslider = '#slider'+TableKriteria[i].Nama_Kriteria;
                var namaketeranganmin = 'KetMin'+TableKriteria[i].Nama_Kriteria;
                var namaketeranganmax = 'KetMax'+TableKriteria[i].Nama_Kriteria;
                var kriteria = TableKriteria[i].Nama_Kriteria;
                arraySlider[i] = '#slider'+TableKriteria[i].Nama_Kriteria;
                // var Satuan_SubKriteria = TableKriteria[i].Satuan_SubKriteria;

                var JumlahSubKriteria = TableKriteria[i].Jumlah_SubKriteria;
                // var namakriteriaA = NamaKriteria[i].Nama_Kriteria;
                // var namakriteriaB = NamaKriteria[j].Nama_Kriteria;
                // console.log(TableKriteria[i].Satuan_SubKriteria);
                
                var newdiv = document.createElement('div');
                var divIdName = TableKriteria[i].Nama_Kriteria;
                newdiv.setAttribute('id',divIdName);
                newdiv.innerHTML = '<h3>Pilih '+divIdName+' AC <br/> yang diinginkan</h3>'
                +'<div class="containerValue">'
                +' <div class="minmax">'
                +'   <div style="float: left" id="'+namaketeranganmin+'"></div>'
                +'   <div style="float: right" id="'+namaketeranganmax+'"></div>'
                +' </div>'
                +'  <div class="slider" id="'+namaslider+'"></div>'
                +'</div>';
                ni.appendChild(newdiv);
            // }

                if (kriteria=='Capasitas')
                {
                    $(namaPanggilslider).jqxSlider({
                        height: 30,
                        width: "90%",
                        min: 1/2,
                        max: 3,
                        step: 1/2,
                        ticksFrequency: 1/2,  //keterangan
                        values: [1/2, 3], 
                        ticksPosition: 'bottom',
                        rangeSlider: true,
                        showRange:true,
                        mode: 'fixed'      
                    });
                }
                else if (kriteria=='Garansi')
                {
                    $(namaPanggilslider).jqxSlider({
                        height: 30,
                        width: "90%",
                        min: 1, 
                        max: JumlahSubKriteria, 
                        step: 1, 
                        ticksFrequency: 1,  //keterangan
                        values: [1, JumlahSubKriteria], 
                        ticksPosition: 'bottom',
                        rangeSlider: true,
                        showRange:true,
                        mode: 'fixed'      
                    });
                }

                else if (kriteria=='Listrik')
                {
                    $(namaPanggilslider).jqxSlider({
                        height: 30,
                        width: "90%",
                        min: 250,
                        max: 2500, 
                        step: 250, 
                        ticksFrequency: 250,  //keterangan
                        values: [500, 2500], 
                        ticksPosition: 'bottom',
                        rangeSlider: true,
                        showRange:true,
                        mode: 'fixed'      
                    });
                }
                else
                {
                    $(namaPanggilslider).jqxSlider({
                        height: 30,
                        width: "90%",
                        min: 1, 
                        max: JumlahSubKriteria, 
                        step: 1, 
                        ticksFrequency: 1,  //keterangan
                        values: [JumlahSubKriteria], 
                        ticksPosition: 'bottom',
                        rangeSlider: false,
                        showRange: false,
                        mode: 'fixed'      
                    });
                }

                $(namaPanggilslider).on('change', function (event) 
                {
                    // console.log($(this).attr('id'))
                    var min = $(this).attr('id').replace("slider", "");
                    var Kmin = 'KetMin' + min;
                    var Kmax = 'KetMax' + min;
                    // console.log(min);

                    if(min=='Capasitas')
                    {
                        if (event.args.value['rangeStart']==1/2)
                        {
                            document.getElementById(Kmin).innerHTML = '1/2' + ' ' + 'PK';
                        }
                        else
                        {
                            document.getElementById(Kmin).innerHTML = event.args.value['rangeStart'] + ' ' + 'PK';
                        }
                        document.getElementById(Kmax).innerHTML = event.args.value['rangeEnd'] + ' ' + 'PK';
                    }
                    else if(min=="Garansi")
                    {
                        document.getElementById(Kmin).innerHTML = event.args.value['rangeStart'] + ' ' + 'Tahun';
                        document.getElementById(Kmax).innerHTML = event.args.value['rangeEnd'] + ' ' + 'Tahun';
                    }
                    else if(min=="Perawatan")
                    {
                        if (event.args.value==1)
                        {
                            document.getElementById(Kmin).innerHTML = 'Praktis atau Mudah';
                        }
                        else if(event.args.value==2)
                        {
                            document.getElementById(Kmin).innerHTML = 'Berkala';
                        }
                        else if(event.args.value==3)
                        {
                            document.getElementById(Kmin).innerHTML = 'Intens';
                        }
                    }
                    else if(min=="Fitur")
                    {
                        if (event.args.value==1)
                        {
                            document.getElementById(Kmin).innerHTML = 'Tidak Ada Fitur';
                        }
                        else if(event.args.value==2)
                        {
                            document.getElementById(Kmin).innerHTML = 'Simple atau Memenuhi Kebutuhan';
                        }
                        else if(event.args.value==3)
                        {
                            document.getElementById(Kmin).innerHTML = 'Full Fitur';
                        }
                    }
                    else if(min=="Listrik")
                    {
                        document.getElementById(Kmin).innerHTML = event.args.value['rangeStart'] + ' ' + 'Watt';
                        document.getElementById(Kmax).innerHTML = event.args.value['rangeEnd'] + ' ' + 'Watt';
                    }
                    else if(min=="Desain")
                    {
                        if (event.args.value==1)
                        {
                            document.getElementById(Kmin).innerHTML = 'Standard';
                        }
                        else if(event.args.value==2)
                        {
                            document.getElementById(Kmin).innerHTML = 'Simple';
                        }
                        else if(event.args.value==3)
                        {
                            document.getElementById(Kmin).innerHTML = 'Stylish';
                        }
                    }
                    else if(min=="Ketahanan")
                    {
                        if (event.args.value==1)
                        {
                            document.getElementById(Kmin).innerHTML = 'Standard atau Low';
                        }
                        else if(event.args.value==2)
                        {
                            document.getElementById(Kmin).innerHTML = 'Middle';
                        }
                        else if(event.args.value==3)
                        {
                            document.getElementById(Kmin).innerHTML = 'Kuat atau Bandel';
                        }
                    }
                });
        }

        // insialisasi.init();
    });
    </script>

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

            <div id="grupslider">

            </div>

            <div class=" text-center">
                <a class="Edit-btn" id="SubmitBtn" value="button" type="button">Submit</a>
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
