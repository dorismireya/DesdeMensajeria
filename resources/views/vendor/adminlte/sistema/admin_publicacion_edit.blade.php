@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Editar Publicación
@endsection

@section('contentheader_title')
  Editar Publicación
@endsection


@section('main-content')

<div class="row">

  <div class="col-md-9">
     <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Editar Publicación</h3>
      </div>

      <div class="box-body">
        <form role="form">

          <div class="form-group">
          <label>Área de Publicación</label>
            <div class="form-group has-error">
              <label class="error_area control-label hidden" for="area_text"></label>
            </div>
            <div class="input-group margin">
              <div class="input-group-btn">
                <button type="button" class="b_area btn btn-success">Área</button>
              </div><!-- /btn-group -->
              <input type="text" id="p_area" class="b_area form-control" readonly="" value="{{$fpublicacion->area}}">
              <input type="hidden" id="area_tabla" value="{{$fpublicacion->tabla}}">
              <input type="hidden" id="area_id_tabla" value="{{$fpublicacion->id_tabla}}">
              
            </div><!-- /input-group -->
        </div>

          <!-- text input -->
          <div class="form-group">
            <label>Título</label>
            <input type="text" class="form-control" placeholder="Ingrese título" id="p_titulo" value="{{$fpublicacion->titulo}}">
            <div class="form-group has-error">
              <label class="error_titulo control-label hidden" for="p_titulo"></label>
            </div>
          </div>

          <!-- textarea -->
          <div class="form-group">
            <label>Descripción</label>
            <textarea class="form-control" rows="3" placeholder="Ingrese descripción..." id='p_detalle'>{{$fpublicacion->detalle}}</textarea>
            <div class="form-group has-error">
              <label class="error_detalle control-label hidden" for="p_detalle"></label>
            </div>
          </div>

          <div class="form-group">
            <label>Contenido</label>
            <div class="form-group has-error">
              <label class="error_contenido control-label hidden" for="p_contenido"></label>
            </div>
            <textarea name="content" class="form-control my-editor" id="p_contenido" >{{$fpublicacion->contenido}}</textarea>
          </div>

          <input type="hidden" id="id_fpublicacion" value="{{$fpublicacion->id_fpublicacion}}">

        </form>
      </div>
     </div>
  </div><!-- /columna de 9 -->

  <div class="col-md-3">

    
    <div class="box box-primary box-solid">
      <div class="box-body">
        <div class="form-group">
          <label>Tipo de Publicación</label>
            <select class="form-control" id="p_tipo" >
              @foreach($tipo_publicaciones as $tipo_publicacion)
                <option {{$fpublicacion->id_ftp === $tipo_publicacion->id_ftp ? 'selected="selected"' : ''}} value="{{$tipo_publicacion->id_ftp}}">{{$tipo_publicacion->tipo}}</option>
              @endforeach
            </select>
        </div>
      </div>
    </div>
    <div class="box box-info box-solid">
      <div class="box-body">
        <!-- select -->
        <div class="form-group">
          <label>Importancia</label>
          <select class="form-control" id="p_importancia" >
            @foreach($importancias as $importancia)
              <option {{$fpublicacion->id_importancia === $importancia->id_importancia ? 'selected="selected"' : ''}} value="{{$importancia->id_importancia}}">{{$importancia->importancia}}</option>
            @endforeach
          </select>
          <div class="form-group has-error">
            <label class="error_importancia control-label hidden" for="p_importancia"></label>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-primary box-solid">
      <div class="box-body">
        <!-- Date range -->
        <div class="form-group">
          <label>Periodo de Publicación</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="p_periodo" value="{{Carbon\Carbon::parse($fpublicacion->fecha_inicio)->format('d/m/Y')}} - {{Carbon\Carbon::parse($fpublicacion->fecha_fin)->format('d/m/Y')}}">
            </div><!-- /.input group -->
        </div><!-- /.form group -->
      </div>
    </div>

    <div class="box box-info box-solid">
      <div class="box-body">
        <div class="form-group">
          <label>Etiqueta</label>
          <input type="text" class="form-control" placeholder="Etiqueta" id="p_etiqueta" value="{{$fpublicacion->etiqueta}}">
          <div class="form-group has-error">
            <label class="error_etiqueta control-label hidden" for="p_etiqueta"></label>
          </div>
        </div>
      </div>
    </div>

    <div class="box-footer">
      <div class="pull-right">
        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#cancel_Modal"><i class="fa fa-times"></i> Cancelar</button>
        <button type="button" class="b_evento btn btn-warning btn-xs" id="b_borrador" ><i class="fa fa-pencil"></i> Borrador</button>
        <button type="button" class="b_evento btn btn-success btn-xs" id="b_publicar" ><i class="fa fa-save"></i> Publicar</button>
      </div>
                  
    </div><!-- /.box-footer -->

  </div><!-- /columna de 3 -->
</div>
{{ csrf_field() }}

<div id="cancel_Modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Cancelar Publicación</h4>
          </div>
          <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Al elegir la opción Salir, no se guardará ningun dato de la Publicación.</strong>
          <div class="modal-body">
            <form id="form" class="form-horizontal" role="dialog">
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="b_cancelar_salir">Salir</button>
              </div>
            </form>
          </div>
        </div>
    </div>
</div>

<div id="area_Modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Seleccionar Área</h4>
          </div>

          <div class="row">
            <div id="div_facultad" class="col-md-4">
              <ul id="ul_facultad" class="list-group">
                <li class="list-group-item active">Facultad</li>
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


          <div class="modal-body">
            <form id="form" class="form-horizontal" role="dialog">
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              </div>
            </form>
          </div>
        </div>
    </div>
</div>

<script type="text/javascript">

var estado_publicacion= "borrador";
  
$(document).on('click','#b_cancelar_salir', function(){
  window.history.back();
  
});

$(document).on('click', '#b_borrador', function(){
  estado_publicacion= "borrador";
});

$(document).on('click', '#b_publicar', function(){
  estado_publicacion= "publicado";
});

$(document).on('click', '.b_evento', function(){

  $('.error_area').addClass('hidden');
  $('.error_titulo').addClass('hidden');
  $('.error_detalle').addClass('hidden');
  $('.error_contenido').addClass('hidden');
  $('.error_etiqueta').addClass('hidden');

  if($("#p_area").val().length == 0){
    $('.error_area').removeClass('hidden');
    $('.error_area').text("Ingrese un área válida, para la publicación");
    document.getElementById("p_area").focus();
    return;
  }

  if($("#p_titulo").val().length == 0){
    $('.error_titulo').removeClass('hidden');
    $('.error_titulo').text("Ingrese un título válido, para la publicación");
    document.getElementById("p_titulo").focus();
    return;
  }

  if($("#p_titulo").val().length < 5){
    $('.error_titulo').removeClass('hidden');
    $('.error_titulo').text("El título debe tener más de 5 caracteres");
    document.getElementById("p_titulo").focus();
    return;
  }

  if($("#p_detalle").val().length == 0){
    $('.error_detalle').removeClass('hidden');
    $('.error_detalle').text("Ingrese una descripción válida, para la publicación");
    document.getElementById("p_detalle").focus();
    return;
  }

  if($("#p_detalle").val().length < 10){
    $('.error_detalle').removeClass('hidden');
    $('.error_detalle').text("La descripción debe contener más de 10 caracteres");
    document.getElementById("p_detalle").focus();
    return;
  }

  if(tinyMCE.get('p_contenido').getContent().length == 0){
    $('.error_contenido').removeClass('hidden');
    $('.error_contenido').text("Ingrese un contenido válido, para la publicación");
    document.getElementById("p_contenido").focus();
    return;
  }

  if($("#p_importancia").val() == null){
    $('.error_importancia').removeClass('hidden');
    $('.error_importancia').text("Usted no puede realizar publicaciones, pongase en contacto con el administrador");
    document.getElementById("p_importancia").focus();
    return;
  }

  if($("#p_etiqueta").val().length == 0){
    $('.error_etiqueta').removeClass('hidden');
    $('.error_etiqueta').text("Ingrese una etiqueta válida, para la publicación");
    document.getElementById("p_etiqueta").focus();
    return;
  }


  $.ajax({

      type: 'post',
      url: 'adminPublicacionEdit',
      data: {
          '_token': $('input[name=_token]').val(),
          'id_fpublicacion': $("#id_fpublicacion").val(),
          'tabla': $("#area_tabla").val(),
          'id_tabla': $("#area_id_tabla").val(),
          'area': $("#p_area").val(),
          'titulo': $("#p_titulo").val(),
          'detalle': $("#p_detalle").val(),
          'contenido': tinyMCE.get('p_contenido').getContent(),
          'etiqueta': $("#p_etiqueta").val(),
          'fecha_inicio': j('#p_periodo').data('daterangepicker').startDate.format('YYYY-MM-DD'),
          'fecha_fin': j('#p_periodo').data('daterangepicker').endDate.format('YYYY-MM-DD'),
          'id_importancia': $("#p_importancia").val(),
          'id_ftp': $("#p_tipo").val(),
          'estado': estado_publicacion,
      },
      success: function(data){

          if(data.errors){
            
            if(data.errors.titulo != undefined){
                $('.error_titulo').removeClass('hidden');
                $('.error_titulo').text(data.errors.titulo);
                document.getElementById("p_titulo").focus();
                return;
            }

            if(data.errors.detalle != undefined){
                $('.error_detalle').removeClass('hidden');
                $('.error_detalle').text(data.errors.detalle);
                document.getElementById("p_detalle").focus();
                return;
            }

            if(data.errors.contenido != undefined){
                $('.error_contenido').removeClass('hidden');
                $('.error_contenido').text(data.errors.contenido);
                document.getElementById("p_contenido").focus();
                return;
            }

            if(data.errors.etiqueta != undefined){
                $('.error_etiqueta').removeClass('hidden');
                $('.error_etiqueta').text(data.errors.etiqueta);
                document.getElementById("p_etiqueta").focus();
                return;
            }

          } else{

            document.location.href= "{!!url('adminPublicacion');!!}";

            swal("Publicación Modificada!", "La publicación "+data.titulo+", fue modificada con exito", "success");
          }
        
        }
      

    });

});

$(document).on('click','.b_area', function(){
  
  $.ajax({

    type: 'post',
    url: 'adminPublicacionEdit_listarFacultad',
    data: {
      '_token': $('input[name=_token]').val(),
    },
    success: function(data){

      $('#div_materia').addClass('hidden');
      $('#div_carrera').addClass('hidden');

      loadInfo="<ul id='ul_facultad' class='list-group'><li class='list-group-item active'>Facultad</li>";


      for(i=0; i < data.length; i++){

        loadInfo= loadInfo + "<li id='fac"+data[i].id_facultad+"' class='facultad_list list-group-item' data-id_facultad='"+data[i].id_facultad+"'  style='font-size:70%;'>";
        loadInfo= loadInfo + data[i].facultad;
        loadInfo= loadInfo + "<span class='pull-right'>";
          if(data[i].cantidad != 0)
            loadInfo= loadInfo + "<a class='click_area btn btn-xs btn-success' data-area_tabla='facultad' data-area_id_tabla='"+data[i].id_facultad+"' data-text='"+data[i].facultad+"'>Si</a>";
        loadInfo= loadInfo + "</span></li>";
      }

      loadInfo= loadInfo + "</ul>";

      

      $('#ul_facultad').replaceWith(loadInfo);

      $('#area_Modal').modal('show');
    }

  });
  
});


$(document).on('click', '.facultad_list', function() {

  $('.facultad_list').removeClass('list-group-item-info');
  $('#fac'+$(this).data('id_facultad')).addClass('list-group-item-info');

  id_facultad= $(this).data('id_facultad');

  $.ajax({

    type: 'post',
    url: 'adminPublicacionEdit_listarCarrera',
    data: {
      '_token': $('input[name=_token]').val(),
      'id_facultad': id_facultad,
    },
    success: function(data){

      $('#div_materia').addClass('hidden');
      $('#div_carrera').removeClass('hidden');

      loadInfo="<ul id='ul_carrera' class='list-group'><li class='list-group-item active'>Carreras</li>";


      for(i=0; i < data.length; i++){

        loadInfo= loadInfo + "<li id='car"+data[i].id_carrera+"' class='carrera_list list-group-item' data-id_facultad='"+id_facultad+"' data-id_carrera='"+data[i].id_carrera+"' style='font-size:70%;'>";
        loadInfo= loadInfo + data[i].carrera;
        loadInfo= loadInfo + "<span class='pull-right'>";
          if(data[i].cantidad != 0)
            loadInfo= loadInfo + "<a class='click_area btn btn-xs btn-success' data-area_tabla='carrera' data-area_id_tabla='"+data[i].id_carrera+"' data-text='"+data[i].carrera+"'>Si</a>";
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
    url: 'adminPublicacionEdit_listarMateria',
    data: {
      '_token': $('input[name=_token]').val(),
      'id_carrera': id_carrera,
    },
    success: function(data){

      $('#div_materia').removeClass('hidden');

      loadInfo="<ul id='ul_materia' class='list-group'><li class='list-group-item active'>Materias</li>";

      for(i=0; i < data.length; i++){

        loadInfo= loadInfo + "<li id='mat"+data[i].id_materia+"' class='list-group-item' data-id_materia='"+data[i].id_materia+"' style='font-size:70%;'>";
        loadInfo= loadInfo + data[i].materia.substring(0,35);
        if(data[i].materia.length >= 35)
          loadInfo= loadInfo + "..";
        loadInfo= loadInfo + "<span class='pull-right'>";

        if(data[i].cantidad != 0)
          loadInfo= loadInfo + "<a class='click_area btn btn-xs btn-success' data-area_tabla='materia' data-area_id_tabla='"+data[i].id_materia+"' data-text='"+data[i].carrera+" - "+data[i].materia+"'>Si</a>";
        loadInfo= loadInfo + "</span></li>";
      }

      loadInfo= loadInfo + "</ul>";

      

      $('#ul_materia').replaceWith(loadInfo);
    }

  });
});


$(document).on('click', '.click_area', function() {

  $('#area_tabla').val($(this).data('area_tabla'))
  $('#area_id_tabla').val($(this).data('area_id_tabla'));
  $('#p_area').val($(this).data('text'));

  console.log($('#area_id_tabla').val());

  $('#area_Modal').modal('hide');
});



</script>

<script>

  var j = jQuery.noConflict();
    
    j( function() {
      j( "#p_periodo" ).daterangepicker({
        locale: {
          format: 'DD/MM/YYYY',
          applyLabel: "Aceptar",
          cancelLabel: "Cancelar",
          daysOfWeek: [
                'Do',
                'Lu',
                'Ma',
                'Mi',
                'Ju',
                'Vi',
                'Sa'
            ],
            monthNames: [
                'Enero',
                'Febrero',
                'Marzo',
                'Abril',
                'Mayo',
                'Junio',
                'Julio',
                'Agosto',
                'Septiembre',
                'Octubre',
                'Noviembre',
                'Diciembre'
            ],
        }
      });
    });

</script>


<script>
  var editor_config = {
    path_absolute : "/",
    language: 'es',
    height: 400,
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>

@endsection
