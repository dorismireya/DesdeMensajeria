@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Administrador Web
@endsection

@section('contentheader_title')
	{{$carrera->carrera}}
@endsection

@section('main-content')

<div class="row">
	<div class="col-md-4">
		<!-- Profile Image -->
		<div class="box box-info">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="{{ URL::to($carrera->logo) }}" alt="Logo de  la Carrera">
				<a class="edit_logo btn btn-info btn-block" data-id_carrera="{{$carrera->id_carrera}}"><b>Editar</b></a>
            </div><!-- /.box-body -->
      	</div><!-- /.box -->
      	<!-- Profile Image -->
      	<div class="box box-info">
      		<div id="div_carrera" class="box-body box-profile">
      			<ul class="list-group list-group-unbordered">
      				<li class="list-group-item">
      					<b>Código: {{$carrera->codigo}}</b>
                    </li>
                    <li class="list-group-item">
      					<b>Carrera: {{$carrera->carrera}}</b>
                    </li>
                </ul>
            	<a class="edit_carrera btn btn-info btn-block" data-id_carrera="{{$carrera->id_carrera}}" data-codigo="{{$carrera->codigo}}" data-carrera="{{$carrera->carrera}}"><b>Editar</b></a>
            </div><!-- /.box-body -->
      	</div><!-- /.box -->
	</div>
	<div class="col-md-8">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#mision" data-toggle="tab">Misión</a></li>
				<li><a href="#vision" data-toggle="tab">Visión</a></li>
				<li><a href="#proyeccion" data-toggle="tab">Proyección</a></li>
				<li><a href="#descripcion" data-toggle="tab">Descripción</a></li>
				<li><a href="#autoridad" data-toggle="tab">Autoridad</a></li>
				<li><a href="#carrusel" data-toggle="tab">Carrusel</a></li>
			</ul>
			<div class="tab-content">
				<div class="active tab-pane" id="mision">
					<div id="div_mision" class="post">
						{!!$carrera->mision!!}
						<div class="form-horizontal">
                        	<div class="form-group margin-bottom-none">                
                          		<div class="col-sm-3 col-md-offset-9">
                            		<button class="edit_mision btn btn-primary pull-right btn-block btn-sm" data-id_carrera="{{$carrera->id_carrera}}" data-mision="{{$carrera->mision}}">Editar</button>
                          		</div>                          
                    		</div>                        
                      	</div>
					</div>
				</div>
				<div class="tab-pane" id="vision">
					<div id="div_vision" class="post">
						{!!$carrera->vision!!}
						<div class="form-horizontal">
                        	<div class="form-group margin-bottom-none">                
                          		<div class="col-sm-3 col-md-offset-9">
                            		<button class="edit_vision btn btn-primary pull-right btn-block btn-sm" data-id_carrera="{{$carrera->id_carrera}}" data-vision="{{$carrera->vision}}">Editar</button>
                          		</div>                          
                    		</div>                        
                      	</div>
					</div>
				</div>
				<div class="tab-pane" id="proyeccion">
					<div id="div_proyeccion" class="post">
						{!!$carrera->proyeccion!!}
						<div class="form-horizontal">
                        	<div class="form-group margin-bottom-none">                
                          		<div class="col-sm-3 col-md-offset-9">
                            		<button class="edit_proyeccion btn btn-primary pull-right btn-block btn-sm" data-id_carrera="{{$carrera->id_carrera}}" data-proyeccion="{{$carrera->proyeccion}}">Editar</button>
                          		</div>                          
                    		</div>                        
                      	</div>
					</div>
				</div>
				<div class="tab-pane" id="descripcion">
					<div id="div_descripcion" class="post">
						{!!$carrera->detalle!!}
						<div class="form-horizontal">
                        	<div class="form-group margin-bottom-none">                
                          		<div class="col-sm-3 col-md-offset-9">
                            		<button class="edit_descripcion btn btn-primary pull-right btn-block btn-sm" data-id_carrera="{{$carrera->id_carrera}}" data-descripcion="{{$carrera->detalle}}">Editar</button>
                          		</div>                          
                    		</div>                        
                      	</div>
					</div>
				</div>
				<div class="tab-pane" id="autoridad">
					<div id="div_autoridad" class="post">
						{!!$carrera->autoridad!!}
						<div class="form-horizontal">
                        	<div class="form-group margin-bottom-none">                
                          		<div class="col-sm-3 col-md-offset-9">
                            		<button class="edit_autoridad btn btn-primary pull-right btn-block btn-sm" data-id_carrera="{{$carrera->id_carrera}}" data-autoridad="{{$carrera->autoridad}}">Editar</button>
                          		</div>                          
                    		</div>                        
                      	</div>
					</div>
				</div>
				<div class="tab-pane" id="carrusel">
					<div id="div_carrusel" class="post">
						<div class="box-body table-responsive no-padding">
							<table class="table table-striped table-hover">
								<tr class="info">
									<th class="col-md-3">Imagen</th>
				                    <th class="col-md-9"></th>
								</tr>
								@foreach($carruseles as $carrusel)
									<tr id="tr_carrusel{{$carrusel->id_file}}" >
										<td>
											<img class="profile-user-img img-responsive img-circle" src="{{ URL::to($carrusel->direccion) }}" alt="Logo de  carrusel">
										</td>
										<td>
											<a class="delete-file btn btn-delault" data-toggle="tooltip" title="Eliminar Imagen" data-id_file="{{$carrusel->id_file}}">
			  									<i class="fa fa-trash"></i> Borrar
			  								</a>
										</td>
									</tr>
								@endforeach
							</table>
						</div>
						<div class="form-horizontal">
                        	<div class="form-group margin-bottom-none">                
                          		<div class="col-sm-3 col-md-offset-9">
                            		<button class="add_carrusel btn btn-primary pull-right btn-block btn-sm" data-id_carrera="{{$carrera->id_carrera}}">Nueva Foto</button>
                          		</div>                          
                    		</div>                        
                      	</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

{{ csrf_field() }}

<div id="logo_Modal" class="modal fade" tabindex="-1" role="dialog" aria labelledby="modalAddBrandLabel" aria-hidden="true">
 	<div class="modal-dialog modal-lg">
     	<div class="modal-content">
         	<div class="modal-header">
             	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             	<h4 class="modal-title">Nuevo Logotipo</h4>
          	</div>
	  		<div class="modal-body">
	  			<form action="{{ route('adminWebCarrera_logo') }}" enctype="multipart/form-data" method="POST">


	            	<input type="file" name="image" class="form-control">
	                

	            	<input type="hidden" name="id_carrera" id="edit_id_carrera" value="{{$carrera->id_carrera}}">
	            	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	          	
	        	<div class="modal-footer">
	          		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	              	<button type="submit" class="btn btn-primary upload-image" >Modificar</button>
	            </div></form>
	      	</div>
    	</div>
    </div>
</div>

<div id="edit_carrera_Modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<h4 class="modal-title"> Editar</h4>
          	</div>
	  		<div class="modal-body">

	        	<form id="form" class="form-horizontal" role="dialog">

	          		<div class="form-group">
	            		<label class="control-label col-sm-2" for="editar_codigo">Código:</label>
	            		<div class="col-sm-10">
	                  		<input type="text" class="form-control" placeholder="Código de la Carrera" id="editar_codigo">
	                  		<div class="form-group has-error">
	                    		<label class="error_codigo control-label hidden" for="editar_codigo"></label>
	                  		</div>
	                	</div>
	                </div>

	                <div class="form-group">
	            		<label class="control-label col-sm-2" for="editar_carrera">Carrera:</label>
	            		<div class="col-sm-10">
	                  		<input type="text" class="form-control" placeholder="Nombre de la Carrera" id="editar_carrera">
	                  		<div class="form-group has-error">
	                    		<label class="error_carrera control-label hidden" for="editar_carrera"></label>
	                  		</div>
	                	</div>
	                </div>

	                <input type="hidden" id="editar_id_carrera" value="0">
	              
	              
	                <div class="modal-footer">
	                  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                  	<button type="button" class="btn btn-primary" id="b_edit_carrera">Modificar</button>
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
	                

	            	<input type="hidden" id="edit_id_carrera" value="0">
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


<div id="carrusel_Modal" class="modal fade" tabindex="-1" role="dialog" aria labelledby="modalAddBrandLabel" aria-hidden="true">
 	<div class="modal-dialog">
     	<div class="modal-content">
         	<div class="modal-header">
             	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             	<h4 class="modal-title">Nueva Fotografia</h4>
          	</div>
	  		<div class="modal-body">
	  			<form action="{{ route('adminWebCarrera_carrusel') }}" enctype="multipart/form-data" method="POST">


	            	<input type="file" name="image" class="form-control">
	                

	            	<input type="hidden" name="id_carrera" id="carrusel_id_carrera" value="{{$carrera->id_carrera}}">
	            	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	          	
	        	<div class="modal-footer">
	          		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	              	<button type="submit" class="btn btn-primary upload-image" >Guardar</button>
	            </div></form>
	      	</div>
    	</div>
    </div>
</div>



<script type="text/javascript">
	$(document).on('click','.edit_logo', function(){

	console.log($(this).data('id_carrera'));
	$('#edit_id_carrera').val($(this).data('id_carrera'));

	$('#logo_Modal').modal('show');
  
});

$("body").on("click",".upload-image",function(e){
    $(this).parents("form").ajaxForm(options);

    /*success: function(data){

    	console.log('---------------------------');
    };*/
  });

$(document).on('click','.add_carrusel', function(){

	$('#carrusel_id_carrera').val($(this).data('id_carrera'));

	$('#carrusel_Modal').modal('show');
  
});

var options = { 
    complete: function(response) 
    {
    	//console.log('entra a option ', response)
    	if($.isEmptyObject(response.responseJSON.error)){
    		alert('Image Upload Successfully.');
    	}else{
    		printErrorMsg(response.responseJSON.error);
    	}
    }
  };

  function printErrorMsg (msg) {
  	console.log('errores');
	/*$(".print-error-msg").find("ul").html('');
	$(".print-error-msg").css('display','block');
	$.each( msg, function( key, value ) {
		$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
	});*/
  }

$(document).on('click','.edit_carrera', function(){

	$('.error_codigo').addClass('hidden');
	$('.error_carrera').addClass('hidden');
	
	$('#editar_id_carrera').val($(this).data('id_carrera'));
	$('#editar_codigo').val($(this).data('codigo'));
	$('#editar_carrera').val($(this).data('carrera'));

	$('#edit_carrera_Modal').modal('show');
});

$(document).on('click', '#b_edit_carrera', function(){

	$('.error_codigo').addClass('hidden');
	$('.error_carrera').addClass('hidden');
	
	if($("#editar_codigo").val().length == 0){
    	$('.error_codigo').removeClass('hidden');
    	$('.error_codigo').text("Ingrese un Código de Carrera válido");
    	document.getElementById("editar_codigo").focus();
    	return;
  	}

  	if($("#editar_carrera").val().length == 0){
    	$('.error_carrera').removeClass('hidden');
    	$('.error_carrera').text("Ingrese un Nombre de Carrera válido");
    	document.getElementById("editar_carrera").focus();
    	return;
  	}


  	$.ajax({

		type: 'post',
	    url: 'adminWebCarrera_edit',
	    data: {
	      	'_token': $('input[name=_token]').val(),
	      	'id_carrera': $("#editar_id_carrera").val(),
	      	'codigo': $("#editar_codigo").val(),
	      	'carrera': $("#editar_carrera").val(),
	    },
	    success: function(data){

      		if(data.errors){


	        	if(data.errors.codigo != undefined){
		          	$('.error_codigo').removeClass('hidden');
		          	$('.error_codigo').text(data.errors.codigo);
		          	document.getElementById("editar_codigo").focus();
		          	return;
		        }

		        if(data.errors.carrera != undefined){
		          	$('.error_carrera').removeClass('hidden');
		          	$('.error_carrera').text(data.errors.carrera);
		          	document.getElementById("editar_carrera").focus();
		          	return;
		        }

    		}else{

	        	$('#edit_carrera_Modal').modal('hide');

	        	$('#div_carrera').replaceWith("<div id='div_carrera' class='box-body box-profile'><ul class='list-group list-group-unbordered'><li class='list-group-item'><b>Código: "+data.codigo+"</b></li><li class='list-group-item'><b>Carrera: "+data.carrera+"</b></li></ul><a class='edit_carrera btn btn-info btn-block' data-id_carrera='"+data.id_carrera+"' data-codigo='"+data.codigo+"' data-carrera='"+data.carrera+"'><b>Editar</b></a></div>");

	        		swal("Carrera Modificada!", "La carrera "+data.carrera+", fue modificada con exito", "success");

	      }
	    }

  });
});

$(document).on('click','.edit_mision', function(){

	$('#edit_Modal').removeAttr('tabindex');

  
  	$('#edit_Modal').focusin(function(){
  		$(this).css({'position':'fixed'});
  	});

  	$('#edit_title').text('Misión');

  	$('#edit_id_carrera').val($(this).data('id_carrera'));
  	$('#edit_variable').val('mision');

  	CKEDITOR.instances.text_edit.setData($(this).data('mision'));

  
  	$('#edit_Modal').modal('show');
  
});

$(document).on('click','.edit_vision', function(){

	$('#edit_Modal').removeAttr('tabindex');

  
  	$('#edit_Modal').focusin(function(){
  		$(this).css({'position':'fixed'});
  	});

  	$('#edit_title').text('Visión');

  	$('#edit_id_carrera').val($(this).data('id_carrera'));
  	$('#edit_variable').val('vision');

  	CKEDITOR.instances.text_edit.setData($(this).data('vision'));

  
  	$('#edit_Modal').modal('show');
  
});

$(document).on('click','.edit_proyeccion', function(){

	$('#edit_Modal').removeAttr('tabindex');

  
  	$('#edit_Modal').focusin(function(){
  		$(this).css({'position':'fixed'});
  	});

  	$('#edit_title').text('Proyección');

  	$('#edit_id_carrera').val($(this).data('id_carrera'));
  	$('#edit_variable').val('proyeccion');

  	CKEDITOR.instances.text_edit.setData($(this).data('proyeccion'));

  
  	$('#edit_Modal').modal('show');
  
});

$(document).on('click','.edit_descripcion', function(){

	$('#edit_Modal').removeAttr('tabindex');

  
  	$('#edit_Modal').focusin(function(){
  		$(this).css({'position':'fixed'});
  	});

  	$('#edit_title').text('Descripción');

  	$('#edit_id_carrera').val($(this).data('id_carrera'));
  	$('#edit_variable').val('descripcion');

  	CKEDITOR.instances.text_edit.setData($(this).data('descripcion'));

  
  	$('#edit_Modal').modal('show');
  
});


$(document).on('click','.edit_autoridad', function(){

	$('#edit_Modal').removeAttr('tabindex');

  
  	$('#edit_Modal').focusin(function(){
  		$(this).css({'position':'fixed'});
  	});

  	$('#edit_title').text('Autoridad');

  	$('#edit_id_carrera').val($(this).data('id_carrera'));
  	$('#edit_variable').val('autoridad');

  	CKEDITOR.instances.text_edit.setData($(this).data('autoridad'));

  
  	$('#edit_Modal').modal('show');
  
});


$(document).on('click','#b_edit', function(){

	var contenido= CKEDITOR.instances['text_edit'].getData();

	var variable= $("#edit_variable").val()

  	
  	$.ajax({

    	type: 'post',
    	url: 'adminWebCarrera_campos',
    	data: {
      		'_token': $('input[name=_token]').val(),
      		'id_carrera': $("#edit_id_carrera").val(),
      		'variable': variable,
      		'contenido': contenido,
    	},
    	success: function(data){

      		if(data.errors){
      			console.log('error...');
      		}else{

        		$('#edit_Modal').modal('hide');

        		if(variable == 'mision'){
        			$('#div_mision').replaceWith("<div id='div_mision' class='post'>"+data.mision+"<div class='form-horizontal'><div class='form-group margin-bottom-none'><div class='col-sm-3 col-md-offset-9'><button class='edit_mision btn btn-primary pull-right btn-block btn-sm' data-id_carrera='"+data.id_carrera+"' data-mision='"+data.mision+"'>Editar</button></div></div></div></div>");
        		}

        		if(variable == 'vision'){

        			$('#div_vision').replaceWith("<div id='div_vision' class='post'>"+data.vision+"<div class='form-horizontal'><div class='form-group margin-bottom-none'><div class='col-sm-3 col-md-offset-9'><button class='edit_vision btn btn-primary pull-right btn-block btn-sm' data-id_carrera='"+data.id_carrera+"' data-vision='"+data.vision+"'>Editar</button></div></div></div></div>");
        		}

        		if(variable == 'proyeccion'){

        			$('#div_proyeccion').replaceWith("<div id='div_proyeccion' class='post'>"+data.proyeccion+"<div class='form-horizontal'><div class='form-group margin-bottom-none'><div class='col-sm-3 col-md-offset-9'><button class='edit_proyeccion btn btn-primary pull-right btn-block btn-sm' data-id_carrera='"+data.id_carrera+"' data-proyeccion='"+data.proyeccion+"'>Editar</button></div></div></div></div>");
        		}

        		if(variable == 'descripcion'){

        			$('#div_descripcion').replaceWith("<div id='div_descripcion' class='post'>"+data.detalle+"<div class='form-horizontal'><div class='form-group margin-bottom-none'><div class='col-sm-3 col-md-offset-9'><button class='edit_descripcion btn btn-primary pull-right btn-block btn-sm' data-id_carrera='"+data.id_carrera+"' data-descripcion='"+data.detalle+"'>Editar</button></div></div></div></div>");
        		}

        		if(variable == 'autoridad'){

        			$('#div_autoridad').replaceWith("<div id='div_autoridad' class='post'>"+data.autoridad+"<div class='form-horizontal'><div class='form-group margin-bottom-none'><div class='col-sm-3 col-md-offset-9'><button class='edit_autoridad btn btn-primary pull-right btn-block btn-sm' data-id_carrera='"+data.id_carrera+"' data-autoridad='"+data.autoridad+"'>Editar</button></div></div></div></div>");
        		}
        		swal("Campos de la Carrera Modidicados!", "Los campos de la carrera "+data.carrera+", fueron modificados con exito", "success");
        
      		}
    	}

  	});
});

$(document).on('click','.delete-file', function(){

	var id_file= $(this).data('id_file');

	swal({
  		title: "Borrar Imagen",
  		text: "Desea borrar esta imagen!",
  		type: "warning",
  		showCancelButton: true,
  		confirmButtonColor: "#DD6B55",
  		cancelButtonText: "Cancelar",
  		confirmButtonText: "Borrar!",
  		closeOnConfirm: false
	},
	function(){
		

		$.ajax({

    		type: 'post',
    		url: 'destroy_file',
    		data: {
      			'_token': $('input[name=_token]').val(),
      			'id_file': id_file,
    		},
    		success: function(data){

      			if(data.errors){
      				console.log('error...');
      			}else{

      				console.log('confirmado eliminar', data.id_file);
      				$('#tr_carrusel'+data.id_file).replaceWith("");

        			swal("Borrado!", "La imagen fue borrada correctamente", "success");
      			}
    		}

  		});
  		
	});
  
});

</script>


@endsection
