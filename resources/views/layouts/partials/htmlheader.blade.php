<head>
    <link rel="shortcut icon" href="/img/fpva.jpg" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Mireya Terceros Ovando">


    <title> Facultad Politecnica del Valle Alto - @yield('htmlheader_title', '') </title>


	<!-- CSS
    ================================================== -->       
    <!-- Bootstrap css file-->
    <link href="{{ asset('/web/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font awesome css file-->
    <link href="{{ asset('/web/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Superslide css file-->
    <link rel="stylesheet" href="{{ asset('/web/css/superslides.css')}}">
    <!-- Slick slider css file -->
    <link href="{{ asset('/web/css/slick.css')}}" rel="stylesheet"> 
    <!-- Circle counter cdn css file -->
    <link rel='stylesheet prefetch' href='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/css/jquery.circliful.css'>  
    <!-- smooth animate css file -->
    <link rel="stylesheet" href="{{ asset('/web/css/animate.css')}}"> 
    <!-- preloader -->
    <link rel="stylesheet" href="{{ asset('/web/css/queryLoader.css')}}" type="text/css" />
    <!-- gallery slider css -->
    <link type="text/css" media="all" rel="stylesheet" href="{{ asset('/web/css/jquery.tosrus.all.css')}}" />    
    <!-- Default Theme css file -->
    <link id="switcher" href="{{ asset('/web/css/themes/default-theme.css')}}" rel="stylesheet">
    <!-- Main structure css file -->
    <link href="{{ asset('/web/style.css')}}" rel="stylesheet">
    <link href="{{ asset('/web/css/style_malla.css')}}" rel="stylesheet">
   
    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>   
    <link href='http://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'>    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


	<!-- Javascript Files
    ================================================== -->

    <!-- initialize jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Preloader js file -->
    <script src="{{ asset('/web/js/queryloader2.min.js')}}" type="text/javascript"></script>
    <!-- For smooth animatin  -->
    <script src="{{ asset('/web/js/wow.min.js')}}"></script>  
    <!-- Bootstrap js -->
    <script src="{{ asset('/web/js/bootstrap.min.js')}}"></script>
    <!-- slick slider -->
    <script src="{{ asset('/web/js/slick.min.js')}}"></script>
    <script src="{{ asset('/web/js/jquery.jsPlumb-1.4.1-all-min.js')}}"></script>
    <!-- superslides slider -->
    <script src="{{ asset('/web/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{ asset('/web/js/jquery.animate-enhanced.min.js')}}"></script>
    <script src="{{ asset('/web/js/jquery.superslides.min.js')}}" type="text/javascript" charset="utf-8"></script>   
    <!-- for circle counter -->
    <script src='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/js/jquery.circliful.min.js'></script>
    <!-- Gallery slider -->
    <script type="text/javascript" language="javascript" src="{{ asset('/web/js/jquery.tosrus.min.all.js')}}"></script> 

    <!-- Custom js-->
    <script src="{{ asset('/web/js/custom.js')}}"></script>

	




	<meta name="csrf-token" content="{{ csrf_token() }}">


	<script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>