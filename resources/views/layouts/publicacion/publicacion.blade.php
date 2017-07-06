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

        <h2>{{$titulo}} <span class="fa fa-angle-double-right"></span></h2>

        <div class="courseArchive_content">
          <!-- start blog archive  -->
          <div class="row">
            <!-- start single blog archive -->

            @foreach($listar_publicaciones as $lp)

              <div class="col-lg-12 col-12 col-sm-12">
                <div class="single_blog_archive wow fadeInUp">
                  <h2 class="blog_title"><a href="{{route('publicacion_completa',['id_fpublicacion'=>$lp->id_fpublicacion])}}"> {{$lp->titulo}}</a></h2>
                  <div class="blog_commentbox">
                    <p><i class="fa fa-user"></i><a href="{{route('publicacionUser',['id'=>$lp->id])}}">{{$lp->educacion}} {{$lp->name}}</a></p>
                    <p><i class="fa fa-calendar"></i>{{Carbon\Carbon::parse($lp->fecha_inicio)->format('d/m/Y')}}</p>
                    <p><i class="fa fa-building-o"></i>{{$lp->tipo}}</p>
                    <p><i class="fa fa-star"></i>{{$lp->importancia}}</p>
                  </div>
                  <p class="blog_summary">{{$lp->detalle}}</p>
                  <a class="blog_readmore" href="{{route('publicacion_completa',['id_fpublicacion'=>$lp->id_fpublicacion])}}">Leer mas</a>
                </div>
              </div>

            @endforeach

            
            
            <!-- start single blog archive -->
          </div>
          <!-- end blog archive  -->
          <nav>

          <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                {{$listar_publicaciones->links()}}
              </ul>
          </div>
          </nav>
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