<!-- start single sidebar -->
<div class="single_sidebar">
  <h2>Nuestras Carreras <span class="fa fa-angle-double-right"></span></h2>
  <ul>
    @foreach($carreras as $carrera)

      <li><a href="{{route('carrera',['id_carrera' => $carrera->id_carrera])}}">{{$carrera->carrera}}</a></li>

    @endforeach
  </ul>
</div>
<!-- End single sidebar -->
