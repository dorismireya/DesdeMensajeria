@extends('layouts.app')

@section('htmlheader_title')
  
  Inicio
@endsection

@section('main-content')

@include('layouts.partials.mainheader')
<br><br>
    
<!--=========== BEGIN COURSE BANNER SECTION ================-->
<section id="courseArchive">
  <div class="container" >
    <div class="row">

      <nav class="navbar navbar-default" style="font-size:80%;" >
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> 
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            {!! Form::open(['route'=>'all_publicacion_search','method'=>'get', 'class'=>'navbar-form navbar-right'])!!}
              <div class="form-group">
                Tipo:
                <select onchange="this.form.submit()" class="search_tipo form-control input-sm" name="tipo">
                  @foreach($tipo_publicaciones as $tipo)
                    <option {{$tipo_consulta == $tipo->tipo ? 'selected="selected"' : ''}} value="{{$tipo->tipo}}" >{{$tipo->tipo}}</option>
                  @endforeach
                  <option {{$tipo_consulta == '' ? 'selected="selected"' : ''}} value="">todos</option>
                </select>

              </div>

              <div class="form-group">
                {!! Form::text('buscar',old('',Request::input('buscar')), ['class' => 'search_input form-control input-sm', 'placeholder'=> 'Buscar...'])!!}
                <input id="tabla" type="hidden" name="tabla" value="">
                <input id="id_tabla" type="hidden" name="id_tabla" value="">
              </div>
              <button class="btn btn-sm btn-default" type="submit"><i class="fa fa-search"></i></button>
            {!! Form::close()!!}
          </div>
        </div>
      </nav>
      <a class="see_all" href="{{route('all_publicacion')}}">Mostrar todos</a>
      <!-- start course content -->
      <div class="col-lg-12 col-md12 col-sm-12">
        <div class="courseArchive_content">
          <!-- start blog archive  -->
          <div class="row">

            <h2>{{$titulo}} <span class="fa fa-angle-double-right"></span></h2>

            <!-- start single blog archive -->

            @foreach($lista_publicaciones as $lp)

              <div class="col-lg-12 col-12 col-sm-12">
                <div class="single_blog_archive wow fadeInUp">
                  <h2 class="blog_title"><a href="{{route('publicacion_completa',['id_fpublicacion'=>$lp->id_fpublicacion])}}"> {{$lp->titulo}}</a></h2>
                  <div class="blog_commentbox">
                    <p><i class="fa fa-user"></i><a href="{{route('all_publicacion_search',['buscar'=>$lp->name])}}">{{$lp->educacion}} {{$lp->name}}</a></p>
                    <p><i class="fa fa-calendar"></i>{{Carbon\Carbon::parse($lp->fecha_inicio)->format('d/m/Y')}}</p>
                    <p><i class="fa fa-building-o"></i><a href="{{route('all_publicacion_search',['buscar'=>'', 'tipo'=>$lp->tipo])}}">{{$lp->tipo}}</a></p>
                    <p><i class="fa fa-star"></i>{{$lp->importancia}}</p>
                  </div>
                  <p class="blog_summary">{{$lp->detalle}}</p>

                  <div class="blog_commentbox">
                    <?php

                      if($lp->tabla == "materia"){

                        $area= DB::table('materias')
                        ->join('carreras','materias.id_carrera','carreras.id_carrera')
                        ->join('facultades','facultades.id_facultad','carreras.id_facultad')
                        ->select('materias.id_materia as id_materia', 'materias.materia as materia', 'carreras.id_carrera as id_carrera', 'carreras.carrera as carrera', 'facultades.id_facultad as id_facultad', 'facultades.facultad as facultad')
                        ->where('materias.id_materia','=',$lp->id_tabla)->get();

                      }

                      if($lp->tabla == "carrera"){

                        $area= DB::table('carreras')
                        ->join('facultades','facultades.id_facultad','carreras.id_facultad')
                        ->select(DB::raw('0 as id_materia'), DB::raw('0 as materia'), 'carreras.id_carrera as id_carrera', 'carreras.carrera as carrera', 'facultades.id_facultad as id_facultad', 'facultades.facultad as facultad')
                        ->where('carreras.id_carrera','=',$lp->id_tabla)->get();
                      }

                      if($lp->tabla == "facultad"){

                        $area= DB::table('facultades')
                        ->select(DB::raw('0 as id_materia'), DB::raw('0 as materia'), DB::raw('0 as id_carrera'), DB::raw('0 as carrera'), 'facultades.id_facultad as id_facultad', 'facultades.facultad as facultad')
                        ->where('facultades.id_facultad','=',$lp->id_tabla)->get();
                      }
                    ?>

                    <p><i class="fa fa-university"></i><a href="JavaScript:;" class="link_area" data-tabla= "facultad" data-id_tabla= "{{$area[0]->id_facultad}}">{{$area[0]->facultad}}</a></p>
                    @if($area[0]->id_carrera != 0)
                      <p><i class="fa fa-graduation-cap"></i><a href="JavaScript:;" class="link_area" data-tabla= "carrera" data-id_tabla= "{{$area[0]->id_carrera}}">{{$area[0]->carrera}}</a></p>
                    @endif
                    @if($area[0]->id_materia != 0)
                      <p><i class="fa  fa-newspaper-o"></i><a href="JavaScript:;" class="link_area" data-tabla= "materia" data-id_tabla= "{{$area[0]->id_materia}}">{{$area[0]->materia}}</a></p>
                    @endif


                  </div>
                  
                  <a class="blog_readmore" href="{{route('publicacion_completa',['id_fpublicacion'=>$lp->id_fpublicacion])}}">Leer mas</a>
                </div>
              </div>

            @endforeach
          </div>
          <!-- end blog archive  -->
          <!-- start previous & next button -->
          
          <nav>

            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                {{$lista_publicaciones->appends(array('buscar' => $old_search, 'tabla' => $tabla_consulta, 'id_tabla' => $id_tabla_consulta, 'tipo' => $tipo_consulta))->links()}}
              </ul>
            </div>
          </nav>
        </div>
      </div>
      <a class="see_all" href="{{route('all_publicacion')}}">Mostrar todos</a>
      <!-- End course content -->
    </div>
  </div>
</section>
{{ csrf_field() }}



<script type="text/javascript">
$(document).on('click', '.link_area', function(){

  $('#tabla').val($(this).data('tabla'));
  $('#id_tabla').val($(this).data('id_tabla'));

  $('#tabla').closest('form').trigger('submit');
});
</script>
<!--=========== END COURSE BANNER SECTION ================-->
@include('layouts.partials.footer')
@endsection