<!--=========== BEGIN HEADER SECTION ================-->
    <header id="header">
      <!-- BEGIN MENU -->
      <div class="menu_area">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">  <div class="container">
            <div class="navbar-header">
              <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <!-- LOGO -->
              <!-- TEXT BASED LOGO -->
              <a class="navbar-brand" href="{{url('/')}}">FPVA <span>UMSS</span></a>              
              <!-- IMG BASED LOGO  -->
               <!-- <a class="navbar-brand" href="index.html"><img src="img/logo.png" alt="logo"></a>  -->            
                     
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                <li class="active"><a href="{{url('/')}}">Inicio</a></li>
                <li><a href="{{route('all_publicacion_search',['buscar'=>'', 'tipo'=>'Informacion'])}}">U. Informacion</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Publicaciones<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    @foreach($tipo_publicaciones as $tipo_publicacion)

                      <li><a href="{{route('all_publicacion_search',['buscar'=>'', 'tipo'=>$tipo_publicacion->tipo])}}">{{$tipo_publicacion->tipo}}</a></li>

                    @endforeach
                      <li><a href="{{route('all_publicacion')}}">Todas las publicaciones</a></li>
                  </ul>
                </li>                
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Oferta Academica<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">

                    @foreach($carreras as $carrera)

                      <li><a href="{{route('carrera',['id_carrera' => $carrera->id_carrera])}}">{{$carrera->carrera}}</a></li>

                    @endforeach
                                   
                  </ul>
                </li>               
                <li><a href="{{url('/contact')}}">Contacto</a></li>
                 @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                        <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    @else
                        <li><a href="/home">{{ Auth::user()->name }}</a></li>
                    @endif


              </ul>   

              <ul class="nav navbar-nav navbar-right">
                   
                </ul>

            </div><!--/.nav-collapse -->
          </div>     
        </nav>  
      </div>
      <!-- END MENU -->    
    </header>
    <!--=========== END HEADER SECTION ================-->


