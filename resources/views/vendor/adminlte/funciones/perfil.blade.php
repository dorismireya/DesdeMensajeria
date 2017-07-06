@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Perfil: {{$usuario->name}}
@endsection

@section('contentheader_title')
	
@endsection


@section('main-content')

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-5">

      <div class="thumbnail">
        <div class="col-sm-12">
          <img src="{!!asset('img/user.png')!!}" class="img-responsive img-thumbnail col-sm-8 col-md-offset-2">
        </div>
        <div class="caption">
        <p>&nbsp;<br></p>
          <div align="center">
            <h3 id="h3_name">{{$usuario->name}}</h3>
            <strong id="str_educacion">{{$usuario->educacion}}</strong>
            <p id="p_email">{{$usuario->email}}</p>
          
            <p>
              <a id="editar" class="btn btn-success" role="button" data-id="{{$usuario->id}}" data-name="{{$usuario->name}}" data-educacion="{{$usuario->educacion}}"><i class="fa fa-edit"></i> Editar</a>
              <a id="biografia" class="btn btn-info" role="button" data-id="{{$usuario->id}}" data-biografia="{{$usuario->biografia}}"><i class="fa fa-graduation-cap"></i> Biografía</a>
              <a id="password" class="btn btn-warning" role="button" data-id="{{$usuario->id}}"><i class="fa fa-unlock-alt"></i> Password</a>
            </p>
          </div>
        </div>
      </div>
    </div>

		<div class="col-sm-7">
      <section class="invoice">
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-user"></i> {{$usuario->name}}
                <br><br>
              </h2>
            </div><!-- /.col -->
          </div>

          <div id="div_biografia" class="row invoice-info">
             {!!$usuario->biografia!!}
             

          </div><br><br>

          <!-- <div class="row no-print">
            <div class="col-xs-12">
              <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Imprimir </a>
              <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-file-pdf-o"></i> Generar PDF</button>
            </div>
          </div> -->
      </section>
		</div>
	</div>
</div>

{{ csrf_field() }}

<div id="editar_Modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="editar_title"></h4>
          </div>
          <div class="modal-body">
            <form id="form" class="form-horizontal" role="dialog">

              <div class="form-group">
                <label class="control-label col-sm-2" for="editar_name">Nombre:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Nombre usuario" id="editar_name">
                  <div class="form-group has-error">
                    <label class="error_name control-label hidden" for="editar_name"></label>
                  </div>
                </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="editar_educacion">Educación:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Profesión" id="editar_educacion">
                    <div class="form-group has-error">
                      <label class="error_educacion control-label hidden" for="editar_educacion"></label>
                    </div>
                  </div>
                </div>

                <input type="hidden" id="editar_id" value="0">
              
              
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary" id="b_Modificar">Modificar</button>
                </div>

            </form>
          </div>
        </div>
    </div>
</div>

<div id="pass_Modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="pass_title"></h4>
          </div>
          <div class="modal-body">
            <form id="form" class="form-horizontal" role="dialog">

              <div class="form-group">
                <label class="control-label col-sm-4" for="pass_actual">Contraseña Actual:</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="pass_actual">
                  <div class="form-group has-error">
                    <label class="error_actual control-label hidden" for="pass_actual"></label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4" for="pass_new">Contraseña Nueva:</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="pass_new">
                  <div class="form-group has-error">
                    <label class="error_new control-label hidden" for="pass_new"></label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4" for="pass_repeat">Repetir Contraseña:</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="pass_repeat">
                  <div class="form-group has-error">
                    <label class="error_repeat control-label hidden" for="pass_repeat"></label>
                  </div>
                </div>
              </div>

              <input type="hidden" id="pass_id" value="0">
              
              
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="b_PassModificar">Modificar</button>
              </div>

            </form>
          </div>
        </div>
    </div>
</div>

<div id="bio_Modal" class="modal fade" tabindex="-1" role="dialog" aria labelledby="modalAddBrandLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Biografía</h4>
          </div>
          <div class="modal-body">
              <form>
                <textarea id="text_bio" name="name_bio" class="ckeditor">
                </textarea>
                

                <input type="hidden" id="bio_id" value="0">
              </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" id="b_BioGuardar">Guardar</button>
            </div>
          </div>
        </div>
    </div>
</div>


<script type="text/javascript">

  
$(document).on('click','#editar', function(){

  $('.error_name').addClass('hidden');
  $('.error_educacion').addClass('hidden');

  $('#editar_title').text('Editar Datos Usuario');

  $('#editar_name').val($(this).data('name'));
  $('#editar_educacion').val($(this).data('educacion'));
  $('#editar_id').val($(this).data('id'));

  $('#editar_Modal').modal('show');

});

$(document).on('click', '#b_Modificar', function(){

  $('.error_name').addClass('hidden');
  $('.error_educacion').addClass('hidden');

  if($("#editar_name").val().length == 0){
    $('.error_name').removeClass('hidden');
    $('.error_name').text("Ingrese un Nombre de Usuario válido");
    document.getElementById("editar_name").focus();
    return;
  }

  if($("#editar_educacion").val().length == 0){
    $('.error_educacion').removeClass('hidden');
    $('.error_educacion').text("Ingrese su Profesión");
    document.getElementById("editar_educacion").focus();
    return;
  }


  $.ajax({

    type: 'post',
    url: 'perfilEdit',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $("#editar_id").val(),
      'name': $("#editar_name").val(),
      'educacion': $("#editar_educacion").val(),
    },
    success: function(data){

      if(data.errors){


        if(data.errors.name != undefined){
          $('.error_name').removeClass('hidden');
          $('.error_name').text(data.errors.name);
          document.getElementById("editar_name").focus();
          return;
        }
        if(data.errors.educacion != undefined){
          $('.error_educacion').removeClass('hidden');
          $('.error_educacion').text(data.errors.educacion);
          document.getElementById("editar_educacion").focus();
          return;
        }
      }else{

        $('#editar_Modal').modal('hide');

        $('#h3_name').text(data.name);
        $('#str_educacion').text(data.educacion);
        $('#p_email').text(data.email);

        $('#editar').replaceWith("<a id='editar' class='btn btn-default' role='button' data-id='"+data.id+"' data-name='"+data.name+"' data-educacion='"+data.educacion+"'>Editar</a>");

      }
    }

  });
});


$(document).on('click','#password', function(){

  $('.error_actual').addClass('hidden');
  $('.error_new').addClass('hidden');
  $('.error_repeat').addClass('hidden');

  $('#pass_title').text('Cambiar Password');

  $('#pass_actual').val();
  $('#pass_new').val();
  $('#pass_repeat').val();
  $('#pass_id').val($(this).data('id'));

  $('#pass_Modal').modal('show');

  document.getElementById("pass_actual").focus();

});

$(document).on('click', '#b_PassModificar', function(){

  $('.error_actual').addClass('hidden');
  $('.error_new').addClass('hidden');
  $('.error_repeat').addClass('hidden');

  if($("#pass_actual").val().length == 0){
    $('.error_actual').removeClass('hidden');
    $('.error_actual').text("Ingrese la contraseña actual");
    document.getElementById("pass_actual").focus();
    return;
  }

  if($("#pass_new").val().length == 0){
    $('.error_new').removeClass('hidden');
    $('.error_new').text("Ingrese una contraseña nueva");
    document.getElementById("pass_new").focus();
    return;
  }


  if($("#pass_repeat").val().length == 0){
    $('.error_repeat').removeClass('hidden');
    $('.error_repeat').text("Repita la contraseña nueva");
    document.getElementById("pass_repeat").focus();
    return;
  }

  if($("#pass_new").val() != $("#pass_repeat").val()){

    $('.error_new').removeClass('hidden');
    $('.error_new').text("Las contraseñas no coinciden");
    document.getElementById("pass_new").focus();
    return;
  }

  $.ajax({

    type: 'post',
    url: 'perfilPassword',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $("#pass_id").val(),
      'password': $("#pass_actual").val(),
      'new_password': $("#pass_new").val(),
    },
    success: function(data){

      console.log(data);

      if(data.errors){

        $('.error_actual').removeClass('hidden');
        $('.error_actual').text(data.errors);
        document.getElementById("pass_actual").focus();
        return;
      }else{

        $('#pass_Modal').modal('hide');

        
      }
    }

  });
});

$(document).on('click','#biografia', function(){

  $('#bio_Modal').removeAttr('tabindex');

  /*$('#bio_Modal').focusout(function(){
      $(this).css({'position':'relative'});
  });*/

  $('#bio_Modal').focusin(function(){
      $(this).css({'position':'fixed'});
  });

  $('#bio_id').val($(this).data('id'));

  CKEDITOR.instances.text_bio.setData($(this).data('biografia'));

  console.log($(this).data('biografia'));

  $('#bio_Modal').modal('show');
  

  
});
$(document).on('click','#b_BioGuardar', function(){
  var contenido= CKEDITOR.instances['text_bio'].getData();
  console.log('data',contenido);

  $.ajax({

    type: 'post',
    url: 'perfilBiografia',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $("#bio_id").val(),
      'biografia': contenido,
    },
    success: function(data){

      if(data.errors){

      }else{

        $('#bio_Modal').modal('hide');

        $('#div_biografia').html(data.biografia);
        
      }
    }

  });
});

</script>


@endsection
