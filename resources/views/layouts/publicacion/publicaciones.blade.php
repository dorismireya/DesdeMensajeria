<!--=========== BEGIN ABOUT US SECTION ================-->
<section id="aboutUs">
  <div class="container">
    <div class="row">
    <!-- Start about us area -->
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="aboutus_area wow fadeInLeft">

        {!!$facultad->historia!!}
        
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
      
      <div class="newsfeed_area wow fadeInRight">
        <ul class="nav nav-tabs feed_tabs_publicacion" id="myTab2">
          <li class="active"><a href="#news" data-toggle="tab">Nuevos</a></li>

          @foreach($tipo_publicaciones as $tipo_publicacion)

            <li><a href="#{{$tipo_publicacion->tipo}}" data-toggle="tab">{{$tipo_publicacion->tipo}}</a></li>
          @endforeach   
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Start news tab content -->

          <div class="tab-pane fade in active" id="news">      
            <div class="single_notice_pane">
              <ul class="news_tab">
                @foreach($nuevas_publicaciones as $pos => $np)
                  @if($pos % 3 == 0 && $pos != 0)
                    </ul>
                    <ul class="news_tab">
                  @endif

                  <li>
                    <div class="media bs-noticias bs-noticias-{{$np->tabla}}">
                        <a href="{{route('publicacion_completa',['id_fpublicacion'=>$np->id_fpublicacion])}}"><i class="fa fa-book"> {{$np->titulo}} </i></a>

                        <a href="{{route('all_publicacion_search',['buscar'=>'', 'tabla'=>$np->tabla, 'id_tabla'=>$np->id_tabla])}}" class="bs-noticias-area"><i class="fa fa-university"> {{$np->area}}</i></a>

                        <span class="feed_detalle"> {{$np->detalle}}</span>
                        <br>
                        <span class="bs-noticias-fecha"><i class="fa fa-calendar"></i> Del {{Carbon\Carbon::parse($np->fecha_inicio)->format('d/m/Y')}} al {{Carbon\Carbon::parse($np->fecha_fin)->format('d/m/Y')}}</span>
                        <a href="#" class="bs-noticias-area">Tipo: {{$np->tipo}}</i></a>
                    </div>
                  </li>

                @endforeach
              </ul>
              <a class="see_all" href="{{route('all_publicacion')}}">Mostrar todos</a>
              
              <br>
              <br>
            </div>
            
          </div>


          {!!$tag_html!!}

        </div>
      </div>



    </div>
  </div>
  </div>
</section>
<!--=========== END ABOUT US SECTION ================--> 