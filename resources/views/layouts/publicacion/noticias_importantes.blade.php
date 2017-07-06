<div class="single_sidebar">
  <h2>Noticias <span class="fa fa-angle-double-right"></span></h2>
  <ul class="news_tab">

    @foreach($nuevas_publicaciones as $np)

      <li>
        <div class="media">
          <div class="media-body">
           <a href="{{route('publicacion_completa',['id_fpublicacion'=>$np->id_fpublicacion])}}">{{$np->titulo}}</a>
           <span class="feed_detalle">{{$np->detalle}}</span>
           <span class="feed_date"Del {{Carbon\Carbon::parse($np->fecha_inicio)->format('d/m/Y')}} al {{Carbon\Carbon::parse($np->fecha_fin)->format('d/m/Y')}}</span>
          </div>
        </div>
      </li>
    @endforeach
    
  </ul>
</div>
<!-- End single sidebar -->