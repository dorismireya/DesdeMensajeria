@extends('layouts.app')
@section('htmlheader_title')
  
  Inicio
@endsection
@section('main-content')
@include('layouts.partials.mainheader')
   
<!--=========== BEGIN COURSE BANNER SECTION ================-->
<br><br>
<section id="courseArchive">
  <div class="container">
    <div class="row">
      <!-- start course content -->
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="courseArchive_content">
          <!-- start blog archive  -->
          <div class="row">
            <!-- start single blog -->
            <div class="col-lg-12 col-12 col-sm-12">
              <div class="single_blog">
                <h2 class="blog_title">{{$fpublicacion->titulo}}</h2>
                <div class="blog_commentbox">
                  <p><i class="fa fa-user"></i>{{$usuario->educacion}} {{$usuario->name}}</p>
                  <p><i class="fa fa-calendar"></i>{{Carbon\Carbon::parse($fpublicacion->fecha_inicio)->format('d/m/Y')}}</p>
                  <p><i class="fa fa-building-o"></i>{{$ftipo_publicacion->tipo}}</p>
                  <p><i class="fa fa-star"></i>{{$importancia->importancia}}</p>
                </div>
                  {!!$fpublicacion->contenido!!}    
                <hr>
                <div class="blog_commentbox">
                  <p><i class="fa fa-tag"></i>{{$fpublicacion->etiqueta}}</p>
                </div>          
              </div>                 
            </div>
            <!-- End single blog -->                
          </div>
          <!-- end blog archive  -->                       
        </div>
      </div>
      <!-- End course content -->
      @include('layouts.partials.archive_sidebar')
    </div>
  </div>
</section>
<!--=========== END COURSE BANNER SECTION ================-->
@include('layouts.partials.footer')
@endsection
    