<!-- start single sidebar -->
<div class="single_sidebar">
  <h2>Tipos de Publicaciones <span class="fa fa-angle-double-right"></span></h2>
  <ul>
    @foreach($tipo_publicaciones as $tipo_publicacion)

      <li><a href="{{route('publicacion',['id_ftp'=>$tipo_publicacion->id_ftp])}}">{{$tipo_publicacion->tipo}}</a></li>

    @endforeach
  </ul>
</div>
<!-- End single sidebar -->