@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Administrador Web
@endsection

@section('contentheader_title')
	Administrador Web
@endsection


@section('main-content')

<div class="row">
  <div class="col-md-4">
    <ul id="ul_facultad" class="list-group">
      <li class="list-group-item active">Facultad</li>
        @foreach($facultades as $facultad)
          <li id="li{{$facultad->id_facultad}}" class="facultad_list list-group-item" data-id_facultad="{{$facultad->id_facultad}}" style="font-size:80%;">
            {{$facultad->facultad}}
            <span class="pull-right">
              @if($facultad->cantidad != 0)
                <a class="btn btn-xs btn-success" href="{{route('adminWebFacultad',['id_facultad'=>$facultad->id_facultad])}}" >
                  <i class="fa fa-eye"></i>
                  Ver
                </a>
              @endif
            </span>
          </li>
        @endforeach
    </ul>
  </div>
  <div id="div_carrera" class="col-md-4 hidden">
    <ul id="ul_carrera" class="list-group">
      <li class="list-group-item active">Carreras</li>
    </ul>
  </div>
  <div id="div_materia" class="col-md-4 hidden">
    <ul id="ul_materia" class="list-group">
      <li class="list-group-item active">Materias</li>
    </ul>
  </div>
</div>

{{ csrf_field() }}

<script type="text/javascript">


$(document).on('click', '.facultad_list', function() {

  $('.facultad_list').removeClass('list-group-item-info');
  $('#fac'+$(this).data('id_facultad')).addClass('list-group-item-info');

  id_facultad= $(this).data('id_facultad');

  $.ajax({

    type: 'post',
    url: 'adminWeb_listarCarrera',
    data: {
      '_token': $('input[name=_token]').val(),
      'id_facultad': id_facultad,
    },
    success: function(data){

      $('#div_materia').addClass('hidden');
      $('#div_carrera').removeClass('hidden');

      loadInfo="<ul id='ul_carrera' class='list-group'><li class='list-group-item active'>Carreras</li>";


      for(i=0; i < data.length; i++){

        loadInfo= loadInfo + "<li id='car"+data[i].id_carrera+"' class='carrera_list list-group-item' data-id_facultad='"+id_facultad+"' data-id_carrera='"+data[i].id_carrera+"' style='font-size:80%;'>";
        loadInfo= loadInfo + data[i].carrera;
        loadInfo= loadInfo + "<span class='pull-right'>";
          if(data[i].cantidad != 0)
            loadInfo= loadInfo + "<a class='btn btn-xs btn-success' href='adminWebCarrera/"+data[i].id_carrera+"' ><i class='fa fa-eye'></i>Ver</a>";
        loadInfo= loadInfo + "</span></li>";
      }

      loadInfo= loadInfo + "</ul>";

      

      $('#ul_carrera').replaceWith(loadInfo);
    }

  });
});

$(document).on('click', '.carrera_list', function() {

  $('.carrera_list').removeClass('list-group-item-info');
  $('#car'+$(this).data('id_carrera')).addClass('list-group-item-info');

  id_facultad= $(this).data('id_facultad');
  id_carrera= $(this).data('id_carrera');

  $.ajax({

    type: 'post',
    url: 'adminWeb_listarMateria',
    data: {
      '_token': $('input[name=_token]').val(),
      'id_carrera': id_carrera,
    },
    success: function(data){

      $('#div_materia').removeClass('hidden');

      loadInfo="<ul id='ul_materia' class='list-group'><li class='list-group-item active'>Materias</li>";

      for(i=0; i < data.length; i++){

        loadInfo= loadInfo + "<li id='mat"+data[i].id_materia+"' class='list-group-item' data-id_materia='"+data[i].id_materia+"' style='font-size:80%;'>";
        loadInfo= loadInfo + data[i].materia;
        loadInfo= loadInfo + "<span class='pull-right'>";

        if(data[i].cantidad != 0)
          loadInfo= loadInfo + "<a class='btn btn-xs btn-success' href='adminWebMateria/"+data[i].id_materia+"' ><i class='fa fa-eye'></i>Ver</a>";
        loadInfo= loadInfo + "</span></li>";
      }

      loadInfo= loadInfo + "</ul>";

      

      $('#ul_materia').replaceWith(loadInfo);
    }

  });
});

</script>	

@endsection
