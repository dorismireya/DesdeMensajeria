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


        <h2>{{$carrera->carrera}} <span class="fa fa-angle-double-right"></span></h2>


        <div class="courseArchive_content">
          <!-- start blog archive  -->
          <div class="row">
            <!-- start single blog -->
            <div class="col-lg-12 col-12 col-sm-12">
              <div class="single_blog">
                <!-- start events slider -->
                <div class="events_slider_area">
                  <div class="events_slider">
                    @foreach($carruseles as $carrusel)
                      <div><img src="{{ URL::to($carrusel->direccion) }}" alt="img"></div>
                    @endforeach
                  </div>
                </div>
                <!-- End events slider -->                
              </div>
              @include('layouts.carrera.mision_vision')
              
              
            </div>
            <!-- End single blog --> 
          </div>            
        </div>
        <!-- end blog archive  -->
        <!-- start related post -->    
      </div>       
    <!-- start course archive sidebar -->
    @include('layouts.partials.archive_sidebar')
    </div>

    {{ csrf_field() }}

    <input type="hidden" id="id_carrera" value="{{$carrera->id_carrera}}">
    
    @include('layouts.carrera.malla_curricular')
  </div>
</section>
    <!--=========== END COURSE BANNER SECTION ================-->
@include('layouts.partials.footer')


@endsection

