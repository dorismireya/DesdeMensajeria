@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Administrador Web
@endsection

@section('contentheader_title')
	{{$facultad->facultad}}
@endsection


@section('main-content')

<div class="row">

	<div class="col-md-4">

		<!-- Profile Image -->
		<div class="box box-info">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="{{ URL::to($facultad->logo) }}" alt="Logo de Facultad">
				<a class="edit_logo btn btn-info btn-block" data-id_facultad="{{$facultad->id_facultad}}"><b>Editar</b></a>
            </div><!-- /.box-body -->
      	</div><!-- /.box -->

      	<!-- Profile Image -->
      	<div class="box box-info">
      		<div id="div_facultad" class="box-body box-profile">
      			<ul class="list-group list-group-unbordered">
      				<li class="list-group-item">
      					<b>Universidad: {{$facultad->universidad}}</b>
                    </li>
                    <li class="list-group-item">
      					<b>Facultad: {{$facultad->facultad}}</b>
                    </li>
                    <li class="list-group-item">
      					<b>Teléfono: {{$facultad->telefono}}</b>
                    </li>
                    <li class="list-group-item">
      					<b>Fax: {{$facultad->fax}}</b>
                    </li>
                    <li class="list-group-item">
      					<b>Dirección: {{$facultad->direccion}}</b>
                    </li>
                </ul>
            	<a class="edit_facultad btn btn-info btn-block" data-id_facultad="{{$facultad->id_facultad}}" data-universidad="{{$facultad->universidad}}" data-facultad="{{$facultad->facultad}}" data-telefono="{{$facultad->telefono}}" data-fax="{{$facultad->fax}}" data-direccion="{{$facultad->direccion}}"><b>Editar</b></a>
            </div><!-- /.box-body -->
      	</div><!-- /.box -->

	</div><!-- /columna de 4 -->
	<div class="col-md-8">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#mision" data-toggle="tab">Misión</a></li>
				<li><a href="#vision" data-toggle="tab">Visión</a></li>
				<li><a href="#historia" data-toggle="tab">Historia</a></li>
				<li><a href="#descripcion" data-toggle="tab">Descripción</a></li>
				<li><a href="#autoridad" data-toggle="tab">Autoridades</a></li>
				<li><a href="#carrusel" data-toggle="tab">Carrusel</a></li>
			</ul>
			<div class="tab-content">
				<div class="active tab-pane" id="mision">
					<div id="div_mision" class="post">
						{!!$facultad->mision!!}
						<div class="form-horizontal">
                        	<div class="form-group margin-bottom-none">                
                          		<div class="col-sm-3 col-md-offset-9">
                            		<button class="edit_mision btn btn-primary pull-right btn-block btn-sm" data-id_facultad="{{$facultad->id_facultad}}" data-mision="{{$facultad->mision}}">Editar</button>
                          		</div>                          
                    		</div>                        
                      	</div>
					</div>
				</div>
				<div class="tab-pane" id="vision">
					<div id="div_vision" class="post">
						{!!$facultad->vision!!}
						<div class="form-horizontal">
                        	<div class="form-group margin-bottom-none">                
                          		<div class="col-sm-3 col-md-offset-9">
                            		<button class="edit_vision btn btn-primary pull-right btn-block btn-sm" data-id_facultad="{{$facultad->id_facultad}}" data-vision="{{$facultad->vision}}">Editar</button>
                          		</div>                          
                    		</div>                        
                      	</div>
					</div>
				</div>
				<div class="tab-pane" id="historia">
					<div id="div_historia" class="post">
						{!!$facultad->historia!!}
						<div class="form-horizontal">
                        	<div class="form-group margin-bottom-none">                
                          		<div class="col-sm-3 col-md-offset-9">
                            		<button class="edit_historia btn btn-primary pull-right btn-block btn-sm" data-id_facultad="{{$facultad->id_facultad}}" data-historia="{{$facultad->historia}}">Editar</button>
                          		</div>                          
                    		</div>                        
                      	</div>
					</div>
				</div>
				<div class="tab-pane" id="descripcion">
					<div id="div_descripcion" class="post">
						{!!$facultad->detalle!!}
						<div class="form-horizontal">
                        	<div class="form-group margin-bottom-none">                
                          		<div class="col-sm-3 col-md-offset-9">
                            		<button class="edit_descripcion btn btn-primary pull-right btn-block btn-sm" data-id_facultad="{{$facultad->id_facultad}}" data-descripcion="{{$facultad->detalle}}">Editar</button>
                          		</div>                          
                    		</div>                        
                      	</div>
					</div>
				</div>
				<div class="tab-pane" id="autoridad">
					<div id="div_autoridad" class="post">
						{!!$facultad->autoridad!!}
						<div class="form-horizontal">
                        	<div class="form-group margin-bottom-none">                
                          		<div class="col-sm-3 col-md-offset-9">
                            		<button class="edit_autoridad btn btn-primary pull-right btn-block btn-sm" data-id_facultad="{{$facultad->id_facultad}}" data-autoridad="{{$facultad->autoridad}}">Editar</button>
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
									<tr>
										<td>
											<img class="profile-user-img img-responsive img-circle" src="{{ URL::to($carrusel->direccion) }}" alt="Logo de  carrusel">
										</td>
										<td></td>
									</tr>
								@endforeach
							</table>
						</div>
						<div class="form-horizontal">
                        	<div class="form-group margin-bottom-none">                
                          		<div class="col-sm-3 col-md-offset-9">
                            		<button class="add_carrusel btn btn-primary pull-right btn-block btn-sm" data-id_facultad="{{$facultad->id_facultad}}">Nueva Foto</button>
                          		</div>                          
                    		</div>                        
                      	</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="box box-info box-solid ">
				<div class="box-header ">
					<h3 class="box-title"> Tipos de publicación</h3>
					<div class="box-tools">
						<div class="btn-group">
							<a class="new_tipo_publicacion btn btn-info btn-block" ><i class="fa fa-plus"></i></a>
						</div>
					</div>
				</div>
				<div class="box-body table-responsive no-padding">
					<table id="tabla_tipo_publicacion" class="table table-striped table-hover">
						<tr class="info">
							<th class="col-md-3">Tipo</th>
		                    <th class="col-md-4">Detalle</th>
		                    <th class="col-md-2">Estado</th>
		                    <th class="col-md-1">Posición</th>
		                    <th class="col-md-2">
						</tr>
						@foreach($tipo_publicaciones as $tipo_publicacion)

							<tr class="tr_tipo_publicacion{{$tipo_publicacion->id_ftp}}">
								<td>{{$tipo_publicacion->tipo}}</td>
								<td>{{$tipo_publicacion->detalle}}</td>
								<td>{{$tipo_publicacion->estado}}</td>
								<td>{{$tipo_publicacion->posicion}}</td>
								<td>
									
									<a class="posicion_tipo_publicacion btn btn-delault" data-toggle="tooltip" title="Cambiar Posicion: {{$tipo_publicacion->tipo}}" data-id_ftp="{{$tipo_publicacion->id_ftp}}" data-tipo="{{$tipo_publicacion->tipo}}" data-estado= "{{$tipo_publicacion->estado}}" data-posicion= "{{$tipo_publicacion->posicion}}" >
			    						<i class="fa fa-refresh"></i>
			  						</a>
									<a class="edit_tipo_publicacion btn btn-delault" data-toggle="tooltip" title="Editar Tipo Publicacion: {{$tipo_publicacion->tipo}}" data-id_ftp="{{$tipo_publicacion->id_ftp}}" data-tipo="{{$tipo_publicacion->tipo}}" data-detalle="{{$tipo_publicacion->detalle}}" data-estado= "{{$tipo_publicacion->estado}}" data-posicion= "{{$tipo_publicacion->posicion}}" >
			    						<i class="fa fa-edit"></i>
			  						</a>
								</td>
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>


		<div class="col-md-12">
			<div class="box box-info box-solid ">
				<div class="box-header ">
					<h3 class="box-title"> Importancia de publicación</h3>
					<div class="box-tools">
						<div class="btn-group">
							<a class="new_importancia btn btn-info btn-block"><i class="fa fa-plus"></i></a>
						</div>
					</div>
				</div>
				<div class="box-body table-responsive no-padding">
					<table id="tabla_importancia" class="table table-striped table-hover">
						<tr class="info">
							<th class="col-md-3">Importancia</th>
		                    <th class="col-md-2">Estado</th>
		                    <th class="col-md-1">Posición</th>
		                    <th class="col-md-2">
						</tr>
						@foreach($importancias as $importancia)

							<tr class="tr_importancia{{$importancia->id_importancia}}">
								<td>{{$importancia->importancia}}</td>
								<td>{{$importancia->estado}}</td>
								<td>{{$importancia->posicion}}</td>
								<td>
									
									<a class="posicion_importancia btn btn-delault" data-toggle="tooltip" title="Cambiar Posicion: {{$importancia->importancia}}" data-id_importancia="{{$importancia->id_importancia}}" data-importancia="{{$importancia->importancia}}" data-estado= "{{$importancia->estado}}" data-posicion= "{{$importancia->posicion}}">
			    						<i class="fa fa-refresh"></i>
			  						</a>
									<a class="edit_importancia btn btn-delault" data-toggle="tooltip" title="Editar Importancia: {{$importancia->importancia}}" data-id_importancia="{{$importancia->id_importancia}}" data-importancia="{{$importancia->importancia}}" data-estado= "{{$importancia->estado}}" data-posicion= "{{$importancia->posicion}}" >
			    						<i class="fa fa-edit"></i>
			  						</a>
								</td>
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>

	</div><!-- /columna de 8 -->
</div>

{{ csrf_field() }}

<div id="edit_facultad_Modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<h4 class="modal-title"> Editar</h4>
          	</div>
	  		<div class="modal-body">

	        	<form id="form" class="form-horizontal" role="dialog">

	          		<div class="form-group">
	            		<label class="control-label col-sm-2" for="editar_universidad">Universidad:</label>
	            		<div class="col-sm-10">
	                  		<input type="text" class="form-control" placeholder="Nombre de la Universidad" id="editar_universidad">
	                  		<div class="form-group has-error">
	                    		<label class="error_universidad control-label hidden" for="editar_universidad"></label>
	                  		</div>
	                	</div>
	                </div>

	                <div class="form-group">
	            		<label class="control-label col-sm-2" for="editar_facultad">Facultad:</label>
	            		<div class="col-sm-10">
	                  		<input type="text" class="form-control" placeholder="Nombre de la Facultad" id="editar_facultad">
	                  		<div class="form-group has-error">
	                    		<label class="error_facultad control-label hidden" for="editar_facultad"></label>
	                  		</div>
	                	</div>
	                </div>

	                <div class="form-group">
	            		<label class="control-label col-sm-2" for="editar_telefono">Teléfono:</label>
	            		<div class="col-sm-10">
	                  		<input type="text" class="form-control" placeholder="Teléfono" id="editar_telefono">
	                  		<div class="form-group has-error">
	                    		<label class="error_telefono control-label hidden" for="editar_telefono"></label>
	                  		</div>
	                	</div>
	                </div>

	                <div class="form-group">
	            		<label class="control-label col-sm-2" for="editar_fax">Fax:</label>
	            		<div class="col-sm-10">
	                  		<input type="text" class="form-control" placeholder="Fax" id="editar_fax">
	                  		<div class="form-group has-error">
	                    		<label class="error_fax control-label hidden" for="editar_fax"></label>
	                  		</div>
	                	</div>
	                </div>

	                <div class="form-group">
	            		<label class="control-label col-sm-2" for="editar_direccion">Dirección:</label>
	            		<div class="col-sm-10">
	                  		<input type="text" class="form-control" placeholder="Dirección" id="editar_direccion">
	                  		<div class="form-group has-error">
	                    		<label class="error_direccion control-label hidden" for="editar_direccion"></label>
	                  		</div>
	                	</div>
	                </div>


	                <input type="hidden" id="editar_id_facultad" value="0">
	              
	              
	                <div class="modal-footer">
	                  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                  	<button type="button" class="btn btn-primary" id="b_edit_facultad">Modificar</button>
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
	                

	            	<input type="hidden" id="edit_id_facultad" value="0">
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


<div id="logo_Modal" class="modal fade" tabindex="-1" role="dialog" aria labelledby="modalAddBrandLabel" aria-hidden="true">
 	<div class="modal-dialog modal-lg">
     	<div class="modal-content">
         	<div class="modal-header">
             	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             	<h4 class="modal-title">Nuevo Logotipo</h4>
          	</div>
	  		<div class="modal-body">
	  			<form action="{{ route('adminWebFacultad_logo') }}" enctype="multipart/form-data" method="POST">


	            	<input type="file" name="image" class="form-control">
	                

	            	<input type="hidden" name="id_facultad" id="edit_id_facultad" value="{{$facultad->id_facultad}}">
	            	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	          	
	        	<div class="modal-footer">
	          		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	              	<button type="submit" class="btn btn-primary upload-image" >Modificar</button>
	            </div></form>
	      	</div>
    	</div>
    </div>
</div>


<div id="tipo_publicacion_Modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<h4 class="title_tipo_publicacion modal-title"></h4>
          	</div>
	  		<div class="modal-body">

	        	<form id="form" class="form-horizontal" role="dialog">

	          		<div class="form-group">
	            		<label class="control-label col-sm-4" for="tipo_publicacion">Tipo Publicación:</label>
	            		<div class="col-sm-8">
	                  		<input type="text" class="form-control" placeholder="Tipo de Publicación" id="tipo_publicacion">
	                  		<div class="form-group has-error">
	                    		<label class="error_tipo control-label hidden" for="tipo_publicacion"></label>
	                  		</div>
	                	</div>
	                </div>

	                <div class="form-group">
	            		<label class="control-label col-sm-4" for="detalle_publicacion">Descripción:</label>
	            		<div class="col-sm-8">
	                  		<input type="text" class="form-control" placeholder="Descripcion" id="detalle_publicacion">
	                  		<div class="form-group has-error">
	                    		<label class="error_detalle control-label hidden" for="detalle_publicacion"></label>
	                  		</div>
	                	</div>
	                </div>

					<input type="hidden" id="publicacion_id_ftp" value="0">
	              
	              
	                <div class="modal-footer">
	                  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                  	<button type="button" class="btn btn-primary" id="b_new_tipo_publicacion">Guardar</button>
	                  	<button type="button" class="btn btn-primary" id="b_edit_tipo_publicacion" style="display: none">Modificar</button>
	                  	<button type="button" class="btn btn-success" id="b_Activo" style="display: none">Activar</button>
	            		<button type="button" class="btn btn-warning" id="b_Baja" style="display: none">Baja</button>
	                </div>

	        	</form>
  			</div>
    	</div>
	</div>
</div>


<div id="importancia_Modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<h4 class="title_importancia modal-title"></h4>
          	</div>
	  		<div class="modal-body">

	        	<form id="form" class="form-horizontal" role="dialog">

	          		<div class="form-group">
	            		<label class="control-label col-sm-4" for="importancia">Nombre de Importancia:</label>
	            		<div class="col-sm-8">
	                  		<input type="text" class="form-control" placeholder="Nombre de Importancia" id="importancia">
	                  		<div class="form-group has-error">
	                    		<label class="error_importancia control-label hidden" for="importancia"></label>
	                  		</div>
	                	</div>
	                </div>


					<input type="hidden" id="importancia_id_importancia" value="0">
	              
	              
	                <div class="modal-footer">
	                  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                  	<button type="button" class="btn btn-primary" id="b_new_importancia">Guardar</button>
	                  	<button type="button" class="btn btn-primary" id="b_edit_importancia" style="display: none">Modificar</button>
	                  	<button type="button" class="btn btn-success" id="b_importancia_Activo" style="display: none">Activar</button>
	            		<button type="button" class="btn btn-warning" id="b_importancia_Baja" style="display: none">Baja</button>
	                </div>

	        	</form>
  			</div>
    	</div>
	</div>
</div>


<div id="posicion_publicacion_Modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<h4 class="posicion_title modal-title"></h4>
          	</div>
	  		<div class="modal-body">

	        	<form id="form" class="form-horizontal" role="dialog">

	          		<div class="form-group">
	            		<label class="control-label col-sm-2" for="select_posicion">Posición:</label>
	            		<div class="col-sm-10">
	            			<select class="form-control" id="select_posicion">
	            			</select>
	                  		<div class="form-group has-error">
	                    		<label class="error_posicion control-label hidden" for="select_posicion"></label>
	                  		</div>
	                	</div>
	                </div>

					<input type="hidden" id="publicacion_id_ftp" value="0">
	              
	              
	                <div class="modal-footer">
	                  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                  	<button type="button" class="btn btn-primary" id="b_posicion_tipo_publicacion">Modificar</button>
	                </div>

	        	</form>
  			</div>
    	</div>
	</div>
</div>


<div id="posicion_importancia_Modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<h4 class="posicion_importancia_title modal-title"></h4>
          	</div>
	  		<div class="modal-body">

	        	<form id="form" class="form-horizontal" role="dialog">

	          		<div class="form-group">
	            		<label class="control-label col-sm-2" for="select_importancia_posicion">Posición:</label>
	            		<div class="col-sm-10">
	            			<select class="form-control" id="select_importancia_posicion">
	            			</select>
	                  		<div class="form-group has-error">
	                    		<label class="error_importancia_posicion control-label hidden" for="select_importancia_posicion"></label>
	                  		</div>
	                	</div>
	                </div>

					<input type="hidden" id="importancia_id_importancia" value="0">
	              
	              
	                <div class="modal-footer">
	                  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                  	<button type="button" class="btn btn-primary" id="b_posicion_importancia">Modificar</button>
	                </div>

	        	</form>
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
	  			<form action="{{ route('adminWebFacultad_carrusel') }}" enctype="multipart/form-data" method="POST">


	            	<input type="file" name="image" class="form-control">
	                

	            	<input type="hidden" name="id_facultad" id="carrusel_id_facultad" value="{{$facultad->id_facultad}}">
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

	console.log($(this).data('id_facultad'));
	$('#edit_id_facultad').val($(this).data('id_facultad'));

	$('#logo_Modal').modal('show');
  
});

$("body").on("click",".upload-image",function(e){
    $(this).parents("form").ajaxForm(options);

    /*success: function(data){

    	console.log('---------------------------');
    };*/
  });
$(document).on('click','.add_carrusel', function(){

	$('#carrusel_id_facultad').val($(this).data('id_facultad'));

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

	
$(document).on('click','.edit_facultad', function(){

	$('.error_universidad').addClass('hidden');
	$('.error_facultad').addClass('hidden');
	$('.error_telefono').addClass('hidden');
	$('.error_fax').addClass('hidden');
	$('.error_direccion').addClass('hidden');

	$('#editar_id_facultad').val($(this).data('id_facultad'));
	$('#editar_universidad').val($(this).data('universidad'));
	$('#editar_facultad').val($(this).data('facultad'));
	$('#editar_telefono').val($(this).data('telefono'));
	$('#editar_fax').val($(this).data('fax'));
	$('#editar_direccion').val($(this).data('direccion'));

	$('#edit_facultad_Modal').modal('show');
});

$(document).on('click', '#b_edit_facultad', function(){

	$('.error_universidad').addClass('hidden');
	$('.error_facultad').addClass('hidden');
	$('.error_telefono').addClass('hidden');
	$('.error_fax').addClass('hidden');
	$('.error_direccion').addClass('hidden');

	if($("#editar_universidad").val().length == 0){
    	$('.error_universidad').removeClass('hidden');
    	$('.error_universidad').text("Ingrese un Nombre de Universidad válido");
    	document.getElementById("editar_universidad").focus();
    	return;
  	}

  	if($("#editar_facultad").val().length == 0){
    	$('.error_facultad').removeClass('hidden');
    	$('.error_facultad').text("Ingrese un Nombre de Facultad válido");
    	document.getElementById("editar_facultad").focus();
    	return;
  	}


  	if($("#editar_telefono").val().length == 0){
    	$('.error_telefono').removeClass('hidden');
    	$('.error_telefono').text("Ingrese un teléfono válido");
    	document.getElementById("editar_telefono").focus();
    	return;
  	}

  	if($("#editar_fax").val().length == 0){
    	$('.error_fax').removeClass('hidden');
    	$('.error_fax').text("Ingrese un fax válido");
    	document.getElementById("editar_fax").focus();
    	return;
  	}

  	if($("#editar_direccion").val().length == 0){
    	$('.error_direccion').removeClass('hidden');
    	$('.error_direccion').text("Ingrese una dirección válida");
    	document.getElementById("editar_direccion").focus();
    	return;
  	}


  	$.ajax({

		type: 'post',
	    url: 'adminWebFacultad_edit',
	    data: {
	      	'_token': $('input[name=_token]').val(),
	      	'id_facultad': $("#editar_id_facultad").val(),
	      	'universidad': $("#editar_universidad").val(),
	      	'facultad': $("#editar_facultad").val(),
	      	'telefono': $("#editar_telefono").val(),
	      	'fax': $("#editar_fax").val(),
	      	'direccion': $("#editar_direccion").val(),
	    },
	    success: function(data){

      		if(data.errors){


	        	if(data.errors.universidad != undefined){
		          	$('.error_universidad').removeClass('hidden');
		          	$('.error_universidad').text(data.errors.universidad);
		          	document.getElementById("editar_universidad").focus();
		          	return;
		        }

		        if(data.errors.facultad != undefined){
		          	$('.error_facultad').removeClass('hidden');
		          	$('.error_facultad').text(data.errors.facultad);
		          	document.getElementById("editar_facultad").focus();
		          	return;
		        }

    		}else{

	        	$('#edit_facultad_Modal').modal('hide');

	        	$('#div_facultad').replaceWith("<div id='div_facultad' class='box-body box-profile'><ul class='list-group list-group-unbordered'><li class='list-group-item'><b>Universidad: "+data.universidad+"</b></li><li class='list-group-item'><b>Facultad: "+data.facultad+"</b></li><li class='list-group-item'><b>Teléfono: "+data.telefono+"</b></li><li class='list-group-item'><b>Fax: "+data.fax+"</b></li><li class='list-group-item'><b>Dirección: "+data.direccion+"</b></li></ul><a class='edit_facultad btn btn-info btn-block' data-id_facultad='"+data.id_facultad+"' data-universidad='"+data.universidad+"' data-facultad='"+data.facultad+"' data-telefono='"+data.telefono+"' data-fax='"+data.fax+"' data-direccion='"+data.direccion+"'><b>Editar</b></a></div>");

	        		swal("Facultad Modificada!", "La facultad "+data.facultad+", fue modificada con exito", "success");

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

  	$('#edit_id_facultad').val($(this).data('id_facultad'));
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

  	$('#edit_id_facultad').val($(this).data('id_facultad'));
  	$('#edit_variable').val('vision');

  	CKEDITOR.instances.text_edit.setData($(this).data('vision'));

  
  	$('#edit_Modal').modal('show');
  
});

$(document).on('click','.edit_historia', function(){

	$('#edit_Modal').removeAttr('tabindex');

  
  	$('#edit_Modal').focusin(function(){
  		$(this).css({'position':'fixed'});
  	});

  	$('#edit_title').text('Historia');

  	$('#edit_id_facultad').val($(this).data('id_facultad'));
  	$('#edit_variable').val('historia');

  	CKEDITOR.instances.text_edit.setData($(this).data('historia'));

  
  	$('#edit_Modal').modal('show');
  
});

$(document).on('click','.edit_descripcion', function(){

	$('#edit_Modal').removeAttr('tabindex');

  
  	$('#edit_Modal').focusin(function(){
  		$(this).css({'position':'fixed'});
  	});

  	$('#edit_title').text('Descripción');

  	$('#edit_id_facultad').val($(this).data('id_facultad'));
  	$('#edit_variable').val('descripcion');

  	CKEDITOR.instances.text_edit.setData($(this).data('descripcion'));

  
  	$('#edit_Modal').modal('show');
  
});


$(document).on('click','.edit_autoridad', function(){

	$('#edit_Modal').removeAttr('tabindex');

  
  	$('#edit_Modal').focusin(function(){
  		$(this).css({'position':'fixed'});
  	});

  	$('#edit_title').text('Autoridades');

  	$('#edit_id_facultad').val($(this).data('id_facultad'));
  	$('#edit_variable').val('autoridad');

  	CKEDITOR.instances.text_edit.setData($(this).data('autoridad'));

  
  	$('#edit_Modal').modal('show');
  
});


$(document).on('click','#b_edit', function(){

	var contenido= CKEDITOR.instances['text_edit'].getData();

	var variable= $("#edit_variable").val()

  	
  	$.ajax({

    	type: 'post',
    	url: 'adminWebFacultad_campos',
    	data: {
      		'_token': $('input[name=_token]').val(),
      		'id_facultad': $("#edit_id_facultad").val(),
      		'variable': variable,
      		'contenido': contenido,
    	},
    	success: function(data){

      		if(data.errors){
      			console.log('error...');
      		}else{

        		$('#edit_Modal').modal('hide');

        		if(variable == 'mision'){
        			$('#div_mision').replaceWith("<div id='div_mision' class='post'>"+data.mision+"<div class='form-horizontal'><div class='form-group margin-bottom-none'><div class='col-sm-3 col-md-offset-9'><button class='edit_mision btn btn-primary pull-right btn-block btn-sm' data-id_facultad='"+data.id_facultad+"' data-mision='"+data.mision+"'>Editar</button></div></div></div></div>");
        		}

        		if(variable == 'vision'){

        			$('#div_vision').replaceWith("<div id='div_vision' class='post'>"+data.vision+"<div class='form-horizontal'><div class='form-group margin-bottom-none'><div class='col-sm-3 col-md-offset-9'><button class='edit_vision btn btn-primary pull-right btn-block btn-sm' data-id_facultad='"+data.id_facultad+"' data-vision='"+data.vision+"'>Editar</button></div></div></div></div>");
        		}

        		if(variable == 'historia'){

        			$('#div_historia').replaceWith("<div id='div_historia' class='post'>"+data.historia+"<div class='form-horizontal'><div class='form-group margin-bottom-none'><div class='col-sm-3 col-md-offset-9'><button class='edit_historia btn btn-primary pull-right btn-block btn-sm' data-id_facultad='"+data.id_facultad+"' data-historia='"+data.historia+"'>Editar</button></div></div></div></div>");
        		}

        		if(variable == 'descripcion'){

        			$('#div_descripcion').replaceWith("<div id='div_descripcion' class='post'>"+data.detalle+"<div class='form-horizontal'><div class='form-group margin-bottom-none'><div class='col-sm-3 col-md-offset-9'><button class='edit_descripcion btn btn-primary pull-right btn-block btn-sm' data-id_facultad='"+data.id_facultad+"' data-descripcion='"+data.detalle+"'>Editar</button></div></div></div></div>");
        		}

        		if(variable == 'autoridad'){

        			$('#div_autoridad').replaceWith("<div id='div_autoridad' class='post'>"+data.autoridad+"<div class='form-horizontal'><div class='form-group margin-bottom-none'><div class='col-sm-3 col-md-offset-9'><button class='edit_autoridad btn btn-primary pull-right btn-block btn-sm' data-id_facultad='"+data.id_facultad+"' data-autoridad='"+data.autoridad+"'>Editar</button></div></div></div></div>");
        		}
        		swal("Campos de Facultad Modidicados!", "Los campos de la facultad "+data.facultad+", fueron modificados con exito", "success");
        
      		}
    	}

  	});
});


$(document).on('click','.new_tipo_publicacion', function(){

	console.log($(this).data('id_facultad'));

	$('.title_tipo_publicacion').text("Nuevo Tipo de Publicación");

	$('#publicacion_id_ftp').val(0);

	$('.error_tipo').addClass('hidden');
	$('.error_detalle').addClass('hidden');

	$('#tipo_publicacion').val('');
	$('#detalle_publicacion').val('');

	$('#b_new_tipo_publicacion').show('400');
	$('#b_edit_tipo_publicacion').hide('400');
	$('#b_Activo').hide('400');
	$('#b_Baja').hide('400');

	$('#tipo_publicacion_Modal').modal('show');

	setTimeout(function(){document.getElementById("tipo_publicacion").focus();}, 500);
  
});


$(document).on('click', '#b_new_tipo_publicacion', function(){

	$('.error_tipo').addClass('hidden');
	$('.error_detalle').addClass('hidden');

	if($("#tipo_publicacion").val().length == 0){
		$('.error_tipo').removeClass('hidden');
		$('.error_tipo').text("Ingrese un tipo válido de publicación");
		document.getElementById("tipo_publicacion").focus();
		return;
	}

	if($("#detalle_publicacion").val().length == 0){
		$('.error_detalle').removeClass('hidden');
		$('.error_detalle').text("Ingrese una descripción válida para el tipo de publicación");
		document.getElementById("detalle_publicacion").focus();
		return;
	}

	$.ajax({

		type: 'post',
		url: 'admimWebFacultad_TipoPublicacionAdd',
		data: {
			'_token': $('input[name=_token]').val(),
			'tipo': $("#tipo_publicacion").val(),
			'detalle': $("#detalle_publicacion").val(),
		},
		success: function(data){

			if(data.errors){


				if(data.errors.tipo != undefined){
					$('.error_tipo').removeClass('hidden');
					$('.error_tipo').text(data.errors.tipo);
					document.getElementById("tipo_publicacion").focus();
					return;
				}
				if(data.errors.detalle != undefined){
					$('.error_detalle').removeClass('hidden');
					$('.error_detalle').text(data.errors.detalle);
					document.getElementById("detalle_publicacion").focus();
					return;
				}
			}else{

				$('#tipo_publicacion_Modal').modal('hide');

				$('#tabla_tipo_publicacion').append("<tr class='tr_tipo_publicacion"+data.id_ftp+"'><td>"+data.tipo+"</td><td>"+data.detalle+"</td><td>"+data.estado+"</td><td>"+data.posicion+"</td><td><a class='posicion_tipo_publicacion btn btn-delault' title='Cambiar Posicion: "+data.tipo+"' data-id_ftp='"+data.id_ftp+"' data-tipo='"+data.tipo+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"' ><i class='fa fa-refresh'></i></a><a class='edit_tipo_publicacion btn btn-delault' title='Editar Tipo Publicacion: "+data.tipo+"' data-id_ftp='"+data.id_ftp+"' data-tipo='"+data.tipo+"' data-detalle='"+data.detalle+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"' ><i class='fa fa-edit'></i></a></td></tr>");

					swal("Tipo de Publicación Creado!", "El tipo de publicación "+data.tipo+", fue creado con exito", "success");

			}
		}

	});
});


$(document).on('click','.edit_tipo_publicacion', function(){

	$('.title_tipo_publicacion').text("Editar Tipo de Publicación");

	$('#publicacion_id_ftp').val($(this).data('id_ftp'));

	$('.error_tipo').addClass('hidden');
	$('.error_detalle').addClass('hidden');

	$('#tipo_publicacion').val($(this).data('tipo'));
	$('#detalle_publicacion').val($(this).data('detalle'));

	$('#b_new_tipo_publicacion').hide('400');
	$('#b_edit_tipo_publicacion').show('400');

	if($(this).data('estado') == "activo"){
		$('#b_Activo').hide('400');
		$('#b_Baja').show('400');
	} else{

		$('#b_Activo').show('400');
		$('#b_Baja').hide('400');
	}

	$('#tipo_publicacion_Modal').modal('show');

	setTimeout(function(){document.getElementById("tipo_publicacion").focus();}, 500);
  
});

$(document).on('click', '#b_edit_tipo_publicacion', function(){


	$('.error_tipo').addClass('hidden');
	$('.error_detalle').addClass('hidden');

	if($("#tipo_publicacion").val().length == 0){
		$('.error_tipo').removeClass('hidden');
		$('.error_tipo').text("Ingrese un tipo válido para la publicación");
		document.getElementById("tipo_publicacion").focus();
		return;
	}

	if($("#detalle_publicacion").val().length == 0){
		$('.error_detalle').removeClass('hidden');
		$('.error_detalle').text("Ingrese una descripción para el tipo de publicación");
		document.getElementById("detalle_publicacion").focus();
		return;
	}

	$.ajax({

		type: 'post',
		url: 'admimWebFacultad_TipoPublicacionEdit',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_ftp': $('#publicacion_id_ftp').val(),
			'tipo': $("#tipo_publicacion").val(),
			'detalle': $("#detalle_publicacion").val(),
		},
		success: function(data){

			if(data.errors){


				if(data.errors.tipo != undefined){
					$('.error_tipo').removeClass('hidden');
					$('.error_tipo').text(data.errors.tipo);
					document.getElementById("tipo_publicacion").focus();
					return;
				}
				if(data.errors.detalle != undefined){
					$('.error_detalle').removeClass('hidden');
					$('.error_detalle').text(data.errors.detalle);
					document.getElementById("detalle_publicacion").focus();
					return;
				}
			}else{

				$('#tipo_publicacion_Modal').modal('hide');

				$('.tr_tipo_publicacion'+data.id_ftp).replaceWith("<tr class='tr_tipo_publicacion"+data.id_ftp+"'><td>"+data.tipo+"</td><td>"+data.detalle+"</td><td>"+data.estado+"</td><td>"+data.posicion+"</td><td><a class='posicion_tipo_publicacion btn btn-delault' title='Cambiar Posicion: "+data.tipo+"' data-id_ftp='"+data.id_ftp+"' data-tipo='"+data.tipo+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"'><i class='fa fa-refresh'></i></a><a class='edit_tipo_publicacion btn btn-delault' title='Editar Tipo Publicacion: "+data.tipo+"' data-id_ftp='"+data.id_ftp+"' data-tipo='"+data.tipo+"' data-detalle='"+data.detalle+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"'><i class='fa fa-edit'></i></a></td></tr>");

				swal("Tipo de Publicación Modificado!", "El tipo de publicación "+data.tipo+", fue Modificado con exito", "success");
			}
		}

	});
});


$(document).on('click', '#b_Activo', function(){

	$.ajax({

		type: 'post',
		url: 'admimWebFacultad_TipoPublicacionEstado',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_ftp': $('#publicacion_id_ftp').val(),
			'estado': 'activo',
		},
		success: function(data){

			if(data.errors){

			}else{

				$('#tipo_publicacion_Modal').modal('hide');

				$('.tr_tipo_publicacion'+data.id_ftp).replaceWith("<tr class='tr_tipo_publicacion"+data.id_ftp+"'><td>"+data.tipo+"</td><td>"+data.detalle+"</td><td>"+data.estado+"</td><td>"+data.posicion+"</td><td><a class='posicion_tipo_publicacion btn btn-delault' title='Cambiar Posicion: "+data.tipo+"' data-id_ftp='"+data.id_ftp+"' data-tipo='"+data.tipo+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"'><i class='fa fa-refresh'></i></a><a class='edit_tipo_publicacion btn btn-delault' title='Editar Tipo Publicacion: "+data.tipo+"' data-id_ftp='"+data.id_ftp+"' data-tipo='"+data.tipo+"' data-detalle='"+data.detalle+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"'><i class='fa fa-edit'></i></a></td></tr>");

				swal("Estado de Tipo de Publicación Modificado!", "El tipo de publicación "+data.tipo+", fue modificado con exito", "success");
			}
		}

	});
});

$(document).on('click', '#b_Baja', function(){

	$.ajax({

		type: 'post',
		url: 'admimWebFacultad_TipoPublicacionEstado',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_ftp': $('#publicacion_id_ftp').val(),
			'estado': 'baja',
		},
		success: function(data){

			if(data.errors){

			}else{

				$('#tipo_publicacion_Modal').modal('hide');

				$('.tr_tipo_publicacion'+data.id_ftp).replaceWith("<tr class='tr_tipo_publicacion"+data.id_ftp+"'><td>"+data.tipo+"</td><td>"+data.detalle+"</td><td>"+data.estado+"</td><td>"+data.posicion+"</td><td><a class='posicion_tipo_publicacion btn btn-delault' title='Cambiar Posicion: "+data.tipo+"' data-id_ftp='"+data.id_ftp+"' data-tipo='"+data.tipo+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"'><i class='fa fa-refresh'></i></a><a class='edit_tipo_publicacion btn btn-delault' title='Editar Tipo Publicacion: "+data.tipo+"' data-id_ftp='"+data.id_ftp+"' data-tipo='"+data.tipo+"' data-detalle='"+data.detalle+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"'><i class='fa fa-edit'></i></a></td></tr>");

				swal("Estado de Tipo de Publicación Modificado!", "El tipo de publicación "+data.tipo+", fue modificado con exito", "success");
			}
		}

	});
});

$(document).on('click','.posicion_tipo_publicacion', function(){

	$('.posicion_title').text("Cambiar Posicion de: "+$(this).data('tipo'));

	$('#publicacion_id_ftp').val($(this).data('id_ftp'));

	$('.error_posicion').addClass('hidden');

	$.ajax({

		type: 'post',
		url: 'adminWebFacultad_ListaTipoPublicacion',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_ftp': $(this).data('id_ftp'),
		},
		success: function(data){

			var text_contenedor= "";

			for(i=0; i < data.length; i++){

				var text_contenedor= text_contenedor + "<option value='"+data[i].id_ftp+"'>"+data[i].tipo+"</option>";
			}

			text_contenedor= "<select class='form-control' id='select_posicion'>"+text_contenedor+"</select>";

			$('#select_posicion').replaceWith(text_contenedor);
		}
	});

	setTimeout(function(){document.getElementById("select_posicion").focus();}, 500);

	$('#posicion_publicacion_Modal').modal('show');
  
});


$(document).on('click', '#b_posicion_tipo_publicacion', function(){


	$('.error_posicion').addClass('hidden');

	console.log($('#select_posicion').val());
	

	$.ajax({

		type: 'post',
		url: 'admimWebFacultad_TipoPublicacionPosicion',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_ftp': $('#publicacion_id_ftp').val(),
			'new_id_ftp': $('#select_posicion').val(),
		},
		success: function(data){

			if(data.errors){


				
			}else{


				$('#posicion_publicacion_Modal').modal('hide');

				$('.tr_tipo_publicacion'+data.tipo_publicacion.id_ftp).replaceWith("<tr class='tr_tipo_publicacion"+data.tipo_publicacion.id_ftp+"'><td>"+data.tipo_publicacion.tipo+"</td><td>"+data.tipo_publicacion.detalle+"</td><td>"+data.tipo_publicacion.estado+"</td><td>"+data.tipo_publicacion.posicion+"</td><td><a class='posicion_tipo_publicacion btn btn-delault' title='Cambiar Posicion: "+data.tipo_publicacion.tipo+"' data-id_ftp='"+data.tipo_publicacion.id_ftp+"' data-tipo='"+data.tipo_publicacion.tipo+"' data-estado= '"+data.tipo_publicacion.estado+"' data-posicion= '"+data.tipo_publicacion.posicion+"'><i class='fa fa-refresh'></i></a><a class='edit_tipo_publicacion btn btn-delault' title='Editar Tipo Publicacion: "+data.tipo_publicacion.tipo+"' data-id_ftp='"+data.tipo_publicacion.id_ftp+"' data-tipo='"+data.tipo_publicacion.tipo+"' data-detalle='"+data.tipo_publicacion.detalle+"' data-estado= '"+data.tipo_publicacion.estado+"' data-posicion= '"+data.tipo_publicacion.posicion+"'><i class='fa fa-edit'></i></a></td></tr>");

				$('.tr_tipo_publicacion'+data.tipo_new_publicacion.id_ftp).replaceWith("<tr class='tr_tipo_publicacion"+data.tipo_new_publicacion.id_ftp+"'><td>"+data.tipo_new_publicacion.tipo+"</td><td>"+data.tipo_new_publicacion.detalle+"</td><td>"+data.tipo_new_publicacion.estado+"</td><td>"+data.tipo_new_publicacion.posicion+"</td><td><a class='posicion_tipo_publicacion btn btn-delault' title='Cambiar Posicion: "+data.tipo_new_publicacion.tipo+"' data-id_ftp='"+data.tipo_new_publicacion.id_ftp+"' data-tipo='"+data.tipo_new_publicacion.tipo+"' data-estado= '"+data.tipo_new_publicacion.estado+"' data-posicion= '"+data.tipo_new_publicacion.posicion+"'><i class='fa fa-refresh'></i></a><a class='edit_tipo_publicacion btn btn-delault' title='Editar Tipo Publicacion: "+data.tipo_new_publicacion.tipo+"' data-id_ftp='"+data.tipo_new_publicacion.id_ftp+"' data-tipo='"+data.tipo_new_publicacion.tipo+"' data-detalle='"+data.tipo_new_publicacion.detalle+"' data-estado= '"+data.tipo_new_publicacion.estado+"' data-posicion= '"+data.tipo_new_publicacion.posicion+"'><i class='fa fa-edit'></i></a></td></tr>");

				swal("Posición de Tipo de Publicación Modificado!", "La posición del tipo de publicación "+data.tipo_new_publicacion.tipo+", fue modificado con exito", "success");
			}
		}

	});
});


$(document).on('click','.new_importancia', function(){

	$('.title_importancia').text("Nuevo nivel de Importancia");

	$('#importancia_id_importancia').val(0);

	$('.error_importancia').addClass('hidden');

	$('#importancia').val('');

	$('#b_new_importancia').show('400');
	$('#b_edit_importancia').hide('400');
	$('#b_importancia_Activo').hide('400');
	$('#b_importancia_Baja').hide('400');

	$('#importancia_Modal').modal('show');

	setTimeout(function(){document.getElementById("importancia").focus();}, 500);
  
});


$(document).on('click', '#b_new_importancia', function(){

	$('.error_importancia').addClass('hidden');

	if($("#importancia").val().length == 0){
		$('.error_importancia').removeClass('hidden');
		$('.error_importancia').text("Ingrese un Nivel valido de Importancia");
		document.getElementById("importancia").focus();
		return;
	}


	$.ajax({

		type: 'post',
		url: 'admimWebFacultad_ImportanciaAdd',
		data: {
			'_token': $('input[name=_token]').val(),
			'importancia': $("#importancia").val(),
		},
		success: function(data){

			if(data.errors){


				if(data.errors.importancia != undefined){
					$('.error_importancia').removeClass('hidden');
					$('.error_importancia').text(data.errors.importancia);
					document.getElementById("importancia").focus();
					return;
				}
			}else{

				$('#importancia_Modal').modal('hide');

				$('#tabla_importancia').append("<tr class='tr_importancia"+data.id_importancia+"'><td>"+data.importancia+"</td><td>"+data.estado+"</td><td>"+data.posicion+"</td><td><a class='posicion_importancia btn btn-delault' title='Cambiar Posicion: "+data.importancia+"' data-id_importancia='"+data.id_importancia+"' data-importancia='"+data.importancia+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"'><i class='fa fa-refresh'></i></a><a class='edit_importancia btn btn-delault' title='Editar Importancia: "+data.importancia+"' data-id_importancia='"+data.id_importancia+"' data-importancia='"+data.importancia+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"' ><i class='fa fa-edit'></i></a></td></tr>");

				swal("Importancia Creada!", "Se creo correctamente el nivel de importancia: "+data.importancia, "success");

			}
		}

	});
});

$(document).on('click','.edit_importancia', function(){

	$('.title_importancia').text("Editar nivel de Importancia");

	$('#importancia_id_importancia').val($(this).data('id_importancia'));

	$('.error_importancia').addClass('hidden');

	$('#importancia').val($(this).data('importancia'));

	$('#b_new_importancia').hide('400');
	$('#b_edit_importancia').show('400');

	if($(this).data('estado') == "activo"){
		$('#b_importancia_Activo').hide('400');
		$('#b_importancia_Baja').show('400');
	} else{

		$('#b_importancia_Activo').show('400');
		$('#b_importancia_Baja').hide('400');
	}

	$('#importancia_Modal').modal('show');

	setTimeout(function(){document.getElementById("importancia").focus();}, 500);
  
});

$(document).on('click', '#b_edit_importancia', function(){


	$('.error_importancia').addClass('hidden');

	if($("#importancia").val().length == 0){
		$('.error_importancia').removeClass('hidden');
		$('.error_importancia').text("Ingrese un nivel válido de Importancia");
		document.getElementById("importancia").focus();
		return;
	}

	$.ajax({

		type: 'post',
		url: 'admimWebFacultad_ImportanciaEdit',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_importancia': $('#importancia_id_importancia').val(),
			'importancia': $("#importancia").val(),
		},
		success: function(data){

			if(data.errors){


				if(data.errors.importancia != undefined){
					$('.error_importancia').removeClass('hidden');
					$('.error_importancia').text(data.errors.importancia);
					document.getElementById("importancia").focus();
					return;
				}
			}else{

				$('#importancia_Modal').modal('hide');


				$('.tr_importancia'+data.id_importancia).replaceWith("<tr class='tr_importancia"+data.id_importancia+"'><td>"+data.importancia+"</td><td>"+data.estado+"</td><td>"+data.posicion+"</td><td><a class='posicion_importancia btn btn-delault' title='Cambiar Posicion: "+data.importancia+"' data-id_importancia='"+data.id_importancia+"' data-importancia='"+data.importancia+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"'><i class='fa fa-refresh'></i></a><a class='edit_importancia btn btn-delault' title='Editar Importancia: "+data.importancia+"' data-id_importancia='"+data.id_importancia+"' data-importancia='"+data.importancia+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"' ><i class='fa fa-edit'></i></a></td></tr>");

				swal("Importancia Modificada!", "Se edito correctamente el nivel de importancia: "+data.importancia, "success");
			}
		}

	});
});


$(document).on('click', '#b_importancia_Activo', function(){

	$.ajax({

		type: 'post',
		url: 'admimWebFacultad_ImportanciaEstado',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_importancia': $('#importancia_id_importancia').val(),
			'estado': 'activo',
		},
		success: function(data){

			if(data.errors){

			}else{

				$('#importancia_Modal').modal('hide');

				$('.tr_importancia'+data.id_importancia).replaceWith("<tr class='tr_importancia"+data.id_importancia+"'><td>"+data.importancia+"</td><td>"+data.estado+"</td><td>"+data.posicion+"</td><td><a class='posicion_importancia btn btn-delault' title='Cambiar Posicion: "+data.importancia+"' data-id_importancia='"+data.id_importancia+"' data-importancia='"+data.importancia+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"'><i class='fa fa-refresh'></i></a><a class='edit_importancia btn btn-delault' title='Editar Importancia: "+data.importancia+"' data-id_importancia='"+data.id_importancia+"' data-importancia='"+data.importancia+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"' ><i class='fa fa-edit'></i></a></td></tr>");

				swal("Estado de Importancia Modificado!", "Se edito correctamente el nivel de importancia: "+data.importancia, "success");
			}
		}

	});
});

$(document).on('click', '#b_importancia_Baja', function(){

	$.ajax({

		type: 'post',
		url: 'admimWebFacultad_ImportanciaEstado',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_importancia': $('#importancia_id_importancia').val(),
			'estado': 'baja',
		},
		success: function(data){

			if(data.errors){

			}else{

				$('#importancia_Modal').modal('hide');

				$('.tr_importancia'+data.id_importancia).replaceWith("<tr class='tr_importancia"+data.id_importancia+"'><td>"+data.importancia+"</td><td>"+data.estado+"</td><td>"+data.posicion+"</td><td><a class='posicion_importancia btn btn-delault' title='Cambiar Posicion: "+data.importancia+"' data-id_importancia='"+data.id_importancia+"' data-importancia='"+data.importancia+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"'><i class='fa fa-refresh'></i></a><a class='edit_importancia btn btn-delault' title='Editar Importancia: "+data.importancia+"' data-id_importancia='"+data.id_importancia+"' data-importancia='"+data.importancia+"' data-estado= '"+data.estado+"' data-posicion= '"+data.posicion+"' ><i class='fa fa-edit'></i></a></td></tr>");

				swal("Estado de Importancia Modificado!", "Se edito correctamente el nivel de importancia: "+data.importancia, "success");
			}
		}

	});
});


$(document).on('click','.posicion_importancia', function(){

	$('.posicion_importancia__title').text("Cambiar Posicion de: "+$(this).data('importancia'));

	$('#importancia_id_importancia').val($(this).data('id_importancia'));

	$('.error_importancia_posicion').addClass('hidden');

	$.ajax({

		type: 'post',
		url: 'adminWebFacultad_ListaImportancia',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_importancia': $(this).data('id_importancia'),
		},
		success: function(data){

			var text_contenedor= "";

			for(i=0; i < data.length; i++){

				var text_contenedor= text_contenedor + "<option value='"+data[i].id_importancia+"'>"+data[i].importancia+"</option>";
			}

			text_contenedor= "<select class='form-control' id='select_importancia_posicion'>"+text_contenedor+"</select>";

			$('#select_importancia_posicion').replaceWith(text_contenedor);
		}
	});

	setTimeout(function(){document.getElementById("select_importancia_posicion").focus();}, 500);

	$('#posicion_importancia_Modal').modal('show');
  
});


$(document).on('click', '#b_posicion_importancia', function(){


	$('.error_importancia_posicion').addClass('hidden');

	console.log($('#select_importancia_posicion').val());
	

	$.ajax({

		type: 'post',
		url: 'admimWebFacultad_ImportanciaPosicion',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_importancia': $('#importancia_id_importancia').val(),
			'new_id_importancia': $('#select_importancia_posicion').val(),
		},
		success: function(data){

			if(data.errors){


				
			}else{


				$('#posicion_importancia_Modal').modal('hide');

				$('.tr_importancia'+data.importancia.id_importancia).replaceWith("<tr class='tr_importancia"+data.importancia.id_importancia+"'><td>"+data.importancia.importancia+"</td><td>"+data.importancia.estado+"</td><td>"+data.importancia.posicion+"</td><td><a class='posicion_importancia btn btn-delault' title='Cambiar Posicion: "+data.importancia.importancia+"' data-id_importancia='"+data.importancia.id_importancia+"' data-importancia='"+data.importancia.importancia+"' data-estado= '"+data.importancia.estado+"' data-posicion= '"+data.importancia.posicion+"'><i class='fa fa-refresh'></i></a><a class='edit_importancia btn btn-delault' title='Editar Importancia: "+data.importancia.importancia+"' data-id_importancia='"+data.importancia.id_importancia+"' data-importancia='"+data.importancia.importancia+"' data-estado= '"+data.importancia.estado+"' data-posicion= '"+data.importancia.posicion+"' ><i class='fa fa-edit'></i></a></td></tr>");

				$('.tr_importancia'+data.new_importancia.id_importancia).replaceWith("<tr class='tr_importancia"+data.new_importancia.id_importancia+"'><td>"+data.new_importancia.importancia+"</td><td>"+data.new_importancia.estado+"</td><td>"+data.new_importancia.posicion+"</td><td><a class='posicion_importancia btn btn-delault' title='Cambiar Posicion: "+data.new_importancia.importancia+"' data-id_importancia='"+data.new_importancia.id_importancia+"' data-importancia='"+data.new_importancia.importancia+"' data-estado= '"+data.new_importancia.estado+"' data-posicion= '"+data.new_importancia.posicion+"'><i class='fa fa-refresh'></i></a><a class='edit_importancia btn btn-delault' title='Editar Importancia: "+data.new_importancia.importancia+"' data-id_importancia='"+data.new_importancia.id_importancia+"' data-importancia='"+data.new_importancia.importancia+"' data-estado= '"+data.new_importancia.estado+"' data-posicion= '"+data.new_importancia.posicion+"' ><i class='fa fa-edit'></i></a></td></tr>");


				swal("Posición de Importancia Modificada!", "Se edito correctamente el nivel de importancia: "+data.importancia, "success");
			}
		}

	});
});

</script>

@endsection
