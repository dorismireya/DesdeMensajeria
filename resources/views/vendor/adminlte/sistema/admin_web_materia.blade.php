@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Administrador Web
@endsection

@section('contentheader_title')
	{{$materia->materia}}
@endsection

@section('main-content')

<div class="row">
	<div class="col-md-4">
		<!-- Profile Image -->
      	<div class="box box-info">
      		<div id="div_materia" class="box-body box-profile">
      			<ul class="list-group list-group-unbordered">
      				<li class="list-group-item">
      					<b>Nivel: {{$materia->nivel}}</b>
                    </li>
                    <li class="list-group-item">
      					<b>Código: {{$materia->codigo}}</b>
                    </li>
                    <li class="list-group-item">
      					<b>Materia: {{$materia->materia}}</b>
                    </li>
                    <li class="list-group-item">
      					<b>Sigla: {{$materia->sigla}}</b>
                    </li>
                </ul>
            	<a class="edit_materia btn btn-info btn-block" data-id_materia="{{$materia->id_materia}}" data-nivel="{{$materia->nivel}}" data-codigo="{{$materia->codigo}}" data-materia="{{$materia->materia}}" data-sigla="{{$materia->sigla}}" data-id_carrera="{{$materia->id_carrera}}" ><b>Editar</b></a>
            </div><!-- /.box-body -->
      	</div><!-- /.box -->
	</div>

	
	<div class="col-md-8">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#horario" data-toggle="tab">Horario</a></li>
				<li><a href="#descripcion" data-toggle="tab">Descripción</a></li>
			</ul>
			<div class="tab-content">
				<div class="active tab-pane" id="horario">
					<div id="div_horario" class="post">
						{!!$materia->horario!!}
						<div class="form-horizontal">
                        	<div class="form-group margin-bottom-none">                
                          		<div class="col-sm-3 col-md-offset-9">
                            		<button class="edit_horario btn btn-primary pull-right btn-block btn-sm" data-id_materia="{{$materia->id_materia}}" data-horario="{{$materia->horario}}">Editar</button>
                          		</div>                          
                    		</div>                        
                      	</div>
					</div>
				</div>
				
				<div class="tab-pane" id="descripcion">
					<div id="div_descripcion" class="post">
						{!!$materia->detalle!!}
						<div class="form-horizontal">
                        	<div class="form-group margin-bottom-none">                
                          		<div class="col-sm-3 col-md-offset-9">
                            		<button class="edit_descripcion btn btn-primary pull-right btn-block btn-sm" data-id_materia="{{$materia->id_materia}}" data-descripcion="{{$materia->detalle}}">Editar</button>
                          		</div>                          
                    		</div>                        
                      	</div>
					</div>
				</div>
				
			</div>
		</div>
</div>
{{ csrf_field() }}

<div id="edit_materia_Modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<h4 class="modal-title"> Editar</h4>
          	</div>
	  		<div class="modal-body">

	        	<form id="form" class="form-horizontal" role="dialog">

	          		<div class="form-group">
	            		<label class="control-label col-sm-2" for="editar_nivel">Nivel:</label>
	            		<div class="col-sm-10">
	                  		<input type="text" class="form-control" placeholder="Nivel de la Materia" id="editar_nivel">
	                  		<div class="form-group has-error">
	                    		<label class="error_nivel control-label hidden" for="editar_nivel"></label>
	                  		</div>
	                	</div>
	                </div>

	                <div class="form-group">
	            		<label class="control-label col-sm-2" for="editar_codigo">Código:</label>
	            		<div class="col-sm-10">
	                  		<input type="text" class="form-control" placeholder="Código de la Materia" id="editar_codigo">
	                  		<div class="form-group has-error">
	                    		<label class="error_codigo control-label hidden" for="editar_codigo"></label>
	                  		</div>
	                	</div>
	                </div>

	                <div class="form-group">
	            		<label class="control-label col-sm-2" for="editar_materia">Materia:</label>
	            		<div class="col-sm-10">
	                  		<input type="text" class="form-control" placeholder="Nombre de la Materia" id="editar_materia">
	                  		<div class="form-group has-error">
	                    		<label class="error_materia control-label hidden" for="editar_materia"></label>
	                  		</div>
	                	</div>
	                </div>

	                <div class="form-group">
	            		<label class="control-label col-sm-2" for="editar_sigla">Sigla:</label>
	            		<div class="col-sm-10">
	                  		<input type="text" class="form-control" placeholder="Sigla" id="editar_sigla">
	                  		<div class="form-group has-error">
	                    		<label class="error_sigla control-label hidden" for="editar_sigla"></label>
	                  		</div>
	                	</div>
	                </div>

	                <input type="hidden" id="editar_id_materia" value="0">
	                <input type="hidden" id="editar_id_carrera" value="0">
	              
	              
	                <div class="modal-footer">
	                  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                  	<button type="button" class="btn btn-primary" id="b_edit_materia">Modificar</button>
	                </div>

	        	</form>
  			</div>
    	</div>
	</div>
</div>

<div id="edit_Modal" class="modal fade" tabindex="-1" role="dialog" aria labelledby="modalAddBrandLabel" aria-hidden="true">
 	<div class="modal-dialog modal-lg">
     	<div class="modal-content">
         	<div class="modal-header">
             	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             	<h4 id="edit_title" class="modal-title"></h4>
          	</div>
	  		<div class="modal-body">
	          	<form>
	            	<textarea id="text_edit" name="name_edit" class="ckeditor">
	                </textarea>
	                

	            	<input type="hidden" id="edit_id_materia" value="0">
	            	<input type="hidden" id="edit_variable" value="0">

	          	</form>
	        	<div class="modal-footer">
	          		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	              	<button type="button" class="btn btn-primary" id="b_edit">Modificar</button>
	            </div>
	      	</div>
    	</div>
    </div>
</div>
<script type="text/javascript">
$(document).on('click','.edit_materia', function(){

	$('.error_nivel').addClass('hidden');
	$('.error_codigo').addClass('hidden');
	$('.error_materia').addClass('hidden');
	$('.error_sigla').addClass('hidden');

	$('#editar_id_materia').val($(this).data('id_materia'));
	$('#editar_id_carrera').val($(this).data('id_carrera'));
	$('#editar_nivel').val($(this).data('nivel'));
	$('#editar_codigo').val($(this).data('codigo'));
	$('#editar_materia').val($(this).data('materia'));
	$('#editar_sigla').val($(this).data('sigla'));

	$('#edit_materia_Modal').modal('show');
});

$(document).on('click', '#b_edit_materia', function(){

	$('.error_nivel').addClass('hidden');
	$('.error_codigo').addClass('hidden');
	$('.error_materia').addClass('hidden');
	$('.error_sigla').addClass('hidden');
	
	if($("#editar_nivel").val().length == 0){
    	$('.error_nivel').removeClass('hidden');
    	$('.error_nivel').text("Ingrese un Nivel de Materia válido");
    	document.getElementById("editar_nivel").focus();
    	return;
  	}

  	if($("#editar_codigo").val().length == 0){
    	$('.error_codigo').removeClass('hidden');
    	$('.error_codigo').text("Ingrese un Código de Materia válido");
    	document.getElementById("editar_codigo").focus();
    	return;
  	}


  	if($("#editar_materia").val().length == 0){
    	$('.error_materia').removeClass('hidden');
    	$('.error_materia').text("Ingrese un Nombre de Materia válido");
    	document.getElementById("editar_materia").focus();
    	return;
  	}

  	if($("#editar_sigla").val().length == 0){
    	$('.error_sigla').removeClass('hidden');
    	$('.error_sigla').text("Ingrese una Sigla de Materia válido");
    	document.getElementById("editar_sigla").focus();
    	return;
  	}


  	$.ajax({

		type: 'post',
	    url: 'adminWebMateria_edit',
	    data: {
	      	'_token': $('input[name=_token]').val(),
	      	'id_materia': $("#editar_id_materia").val(),
	      	'id_carrera': $("#editar_id_carrera").val(),
	      	'nivel': $("#editar_nivel").val(),
	      	'codigo': $("#editar_codigo").val(),
	      	'materia': $("#editar_materia").val(),
	      	'sigla': $("#editar_sigla").val(),
	    },
	    success: function(data){
      		if(data.errors){

		        if(data.errors.materia != undefined){
		          	$('.error_materia').removeClass('hidden');
		          	$('.error_materia').text(data.errors.materia);
		          	document.getElementById("editar_materia").focus();
		          	return;
		        }

		        if(data.errors.codigo != undefined){
		          	$('.error_codigo').removeClass('hidden');
		          	$('.error_codigo').text(data.errors.codigo);
		          	document.getElementById("editar_codigo").focus();
		          	return;
		        }

		        if(data.errors.sigla != undefined){
		          	$('.error_sigla').removeClass('hidden');
		          	$('.error_sigla').text(data.errors.sigla);
		          	document.getElementById("editar_sigla").focus();
		          	return;
		        }

    		}else{

	        	$('#edit_materia_Modal').modal('hide');

	        	$('#div_materia').replaceWith("<div id='div_materia' class='box-body box-profile'><ul class='list-group list-group-unbordered'><li class='list-group-item'><b>Nivel: "+data.nivel+"</b></li><li class='list-group-item'><b>Código: "+data.codigo+"</b></li><li class='list-group-item'><b>Materia: "+data.materia+"</b></li><li class='list-group-item'><b>Sigla: "+data.sigla+"</b></li></ul><a class='edit_materia btn btn-info btn-block' data-id_materia='"+data.id_materia+"' data-nivel='"+data.nivel+"' data-codigo='"+data.codigo+"' data-materia='"+data.materia+"' data-sigla='"+data.sigla+"' data-id_carrera='"+data.id_carrera+"'><b>Editar</b></a></div>");

	        		swal("Materia Modificada!", "La materia "+data.materia+", fue modificada con exito", "success");

	      }
	    }

  });
});

$(document).on('click','.edit_horario', function(){

	$('#edit_Modal').removeAttr('tabindex');

  
  	$('#edit_Modal').focusin(function(){
  		$(this).css({'position':'fixed'});
  	});

  	$('#edit_title').text('Horario');

  	$('#edit_id_materia').val($(this).data('id_materia'));
  	$('#edit_variable').val('horario');

  	CKEDITOR.instances.text_edit.setData($(this).data('horario'));

  
  	$('#edit_Modal').modal('show');
  
});

$(document).on('click','.edit_descripcion', function(){

	$('#edit_Modal').removeAttr('tabindex');

  
  	$('#edit_Modal').focusin(function(){
  		$(this).css({'position':'fixed'});
  	});

  	$('#edit_title').text('Descripción');

  	$('#edit_id_materia').val($(this).data('id_materia'));
  	$('#edit_variable').val('descripcion');

  	CKEDITOR.instances.text_edit.setData($(this).data('descripcion'));

  
  	$('#edit_Modal').modal('show');
  
});

$(document).on('click','#b_edit', function(){

	var contenido= CKEDITOR.instances['text_edit'].getData();

	var variable= $("#edit_variable").val()

  	
  	$.ajax({

    	type: 'post',
    	url: 'adminWebMateria_campos',
    	data: {
      		'_token': $('input[name=_token]').val(),
      		'id_materia': $("#edit_id_materia").val(),
      		'variable': variable,
      		'contenido': contenido,
    	},
    	success: function(data){

      		if(data.errors){
      			console.log('error...');
      		}else{

        		$('#edit_Modal').modal('hide');

        		if(variable == 'horario'){
        			$('#div_horario').replaceWith("<div id='div_horario' class='post'>"+data.horario+"<div class='form-horizontal'><div class='form-group margin-bottom-none'><div class='col-sm-3 col-md-offset-9'><button class='edit_horario btn btn-primary pull-right btn-block btn-sm' data-id_materia='"+data.id_materia+"' data-horario='"+data.horario+"'>Editar</button></div></div></div></div>");
        		}

        		if(variable == 'descripcion'){

        			$('#div_descripcion').replaceWith("<div id='div_descripcion' class='post'>"+data.detalle+"<div class='form-horizontal'><div class='form-group margin-bottom-none'><div class='col-sm-3 col-md-offset-9'><button class='edit_descripcion btn btn-primary pull-right btn-block btn-sm' data-id_materia='"+data.id_materia+"' data-descripcion='"+data.detalle+"'>Editar</button></div></div></div></div>");
        		}

        		swal("Campos de la Materia Modidicados!", "Los campos de la materia "+data.materia+", fueron modificados con exito", "success");
        
      		}
    	}

  	});
});

</script>
@endsection