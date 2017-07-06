<!-- start course archive sidebar -->
<div class="col-lg-4 col-md-4 col-sm-4">
  <div class="courseArchive_sidebar">
    <!-- start single sidebar -->
    @section('sidebar')
        @include('layouts.publicacion.noticias_importantes')
        @include('layouts.publicacion.tipos_publicaciones')
        @include('layouts.carrera.nuestras_carreras')
        @include('layouts.publicacion.tags')
    @show
    
  </div>
</div>
<!-- start course archive sidebar -->