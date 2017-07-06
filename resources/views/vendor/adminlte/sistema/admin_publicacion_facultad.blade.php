@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Administrar Mi Publicacion
@endsection

@section('contentheader_title')
	Administrar Mis Publicaciones: {{$facultad->facultad}}
@endsection


@section('main-content')

<div class="row">

	<div class="col-md-3">
		<a href="{{route('adminPublicacionFacultadNew',['id_facultad'=>$facultad->id_facultad])}}" class="btn btn-primary btn-block margin-bottom"><i class="fa fa-plus"></i> Nueva Publicación</a>
		<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Mis Publicaciones</h3>
              	<div class="box-tools">
                	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              	</div>
            </div>
            <div class="box-body no-padding">
              	<ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#"><i class="fa fa-reorder"></i> Todos</a></li>

					@foreach($tipo_publicaciones as $tipo_publicacion)
						<li><a class="tipos_publicacion" data-tipo_publicacion="{{$tipo_publicacion->tipo}}"><i class="fa fa-circle-o text-yellow"></i> {{$tipo_publicacion->tipo}} <span class="label label-info pull-right">{{$tipo_publicacion->cantidad}}</span></a></li>	
					@endforeach
              	</ul>
            </div><!-- /.box-body -->
      	</div><!-- /. box -->
	</div><!-- /columna de 4 -->
	<div class="col-md-9">
		<nav class="navbar navbar-default" style="font-size:80%;">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					{!! Form::open(['route'=>'adminPublicacionFacultadSearch','method'=>'get', 'class'=>'navbar-form navbar-right'])!!}
						
						<div class="form-group">
							Tipo:
							<select onchange="this.form.submit()" class="search_tipo form-control input-sm" name="tipo">
								@foreach($tipos as $tipo)
									<option {{$tipo_consulta == $tipo->tipo ? 'selected="selected"' : ''}} value="{{$tipo->tipo}}" >{{$tipo->tipo}}</option>
								@endforeach
	        					<option {{$tipo_consulta == '' ? 'selected="selected"' : ''}} value="">todos</option>
            				</select>

						</div>

						<div class="form-group">
							Importancia:
							<select onchange="this.form.submit()" class="form-control input-sm" name="importancia">
								@foreach($importancias as $importancia)
									<option {{$importancia_consulta == $importancia->importancia ? 'selected="selected"' : ''}} value="{{$importancia->importancia}}" >{{$importancia->importancia}}</option>
								@endforeach
	        					<option {{$importancia_consulta == '' ? 'selected="selected"' : ''}} value="">todos</option>
            				</select>

						</div>

						<div class="form-group">
							Estado:
							<select onchange="this.form.submit()" class="form-control input-sm" name="estado">
								@foreach($estados as $estado)
									<option {{$estado_consulta == $estado->estado ? 'selected="selected"' : ''}} value="{{$estado->estado}}" >{{$estado->estado}}</option>
								@endforeach
	        					<option {{$estado_consulta == '' ? 'selected="selected"' : ''}} value="">todos</option>
            				</select>

						</div>

				    	<div class="form-group">
				    		{!! Form::text('buscar',old('',Request::input('buscar')), ['class' => 'form-control input-sm', 'placeholder'=> 'Buscar...'])!!}
				    		<input type="hidden" name="id_facultad" id="id_facultad" value="{{$facultad->id_facultad}}">
				        </div>
				        <button class="btn btn-sm btn-default" type="submit"><i class="fa fa-search"></i></button>
				    {!! Form::close()!!}
				</div>
			</div>	
		</nav>

		<div class="box box-success box-solid ">
			<div class="box-body table-responsive no-padding">
				<table class="table table-striped table-hover">
					<tr class="success">
						<th class="col-md-2">Título</th>
	                    <th class="col-md-1">Tipo</th>
	                    <th class="col-md-2">Inicio</th>
	                    <th class="col-md-2">Fin</th>
	                    <th class="col-md-1">Estado</th>
	                    <th class="col-md-1">Importancia</th>
	                    <th class="col-md-3">
					</tr>
						@foreach($fpublicaciones as $fpublicacion)

						<tr class="tr_fpublicacion{{$fpublicacion->id_fpublicacion}}">
							<td style="font-size:90%;">{{$fpublicacion->titulo}}</td>
							<td style="font-size:90%;">
								<a id="edit_tipo{{$fpublicacion->id_fpublicacion}}" class="edit_tipo btn btn-delault btn-sm" data-toggle="tooltip" title="Cambiar el tipo de publicación de: {{$fpublicacion->titulo}}" data-id_fpublicacion="{{$fpublicacion->id_fpublicacion}}" data-titulo="{{$fpublicacion->titulo}}">
									{{$fpublicacion->tipo}}
								</a>
							</td>
							<td style="font-size:90%;">
								<a id="edit_inicio{{$fpublicacion->id_fpublicacion}}" class="edit_fecha btn btn-delault btn-sm" data-toggle="tooltip" title="Cambiar la fecha de publicación: {{$fpublicacion->titulo}}" data-id_fpublicacion="{{$fpublicacion->id_fpublicacion}}" data-titulo="{{$fpublicacion->titulo}}">
									{{Carbon\Carbon::parse($fpublicacion->fecha_inicio)->format('d/m/Y')}}
								</a>
							</td>
							<td style="font-size:90%;">
								<a id="edit_fin{{$fpublicacion->id_fpublicacion}}" class="edit_fecha btn btn-delault btn-sm" data-toggle="tooltip" title="Cambiar la fecha de publicación: {{$fpublicacion->titulo}}" data-id_fpublicacion="{{$fpublicacion->id_fpublicacion}}" data-titulo="{{$fpublicacion->titulo}}">
									{{Carbon\Carbon::parse($fpublicacion->fecha_fin)->format('d/m/Y')}}
								</a>
							</td>
							<td style="font-size:90%;">
								<a id="edit_estado{{$fpublicacion->id_fpublicacion}}" class="edit_estado btn btn-delault btn-sm" data-toggle="tooltip" title="Cambiar el estado de la publicación: {{$fpublicacion->titulo}}" data-id_fpublicacion="{{$fpublicacion->id_fpublicacion}}" data-titulo="{{$fpublicacion->titulo}}">
									{{$fpublicacion->estado}}
								</a>
							</td>
							<td style="font-size:90%;">
								<a id="edit_importancia{{$fpublicacion->id_fpublicacion}}" class="edit_importancia btn btn-delault btn-sm" data-toggle="tooltip" title="Cambiar la importancia de la publicación: {{$fpublicacion->titulo}}" data-id_fpublicacion="{{$fpublicacion->id_fpublicacion}}" data-titulo="{{$fpublicacion->titulo}}">
									{{$fpublicacion->importancia}}
								</a>
							</td>
							<td style="font-size:90%;">
								<div class="btn-group">
									<a class="view-modal btn btn-delault" data-toggle="tooltip" title="Ver Publicación: {{$fpublicacion->titulo}}" data-id_fpublicacion="{{$fpublicacion->id_fpublicacion}}">
			  							<i class="fa fa-eye"></i>
			  						</a>
									<a class="edit-modal btn btn-delault" data-toggle="tooltip" title="Editar Publicación: {{$fpublicacion->titulo}}" href="{{route('adminPublicacionFacultadEdit',['id_fpublicacacion' => $fpublicacion->id_fpublicacion])}}">
			    						<i class="fa fa-edit"></i>
			  						</a>
			  						<a class="delete-modal btn btn-delault" data-toggle="tooltip" title="Eliminar Publicación: {{$fpublicacion->titulo}}" data-id_fpublicacion="{{$fpublicacion->id_fpublicacion}}" data-titulo= "{{$fpublicacion->titulo}}">
			  							<i class="fa fa-trash"></i>
			  						</a>
								</div>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
			<div class="box-footer clearfix">
	      		<ul class="pagination pagination-sm no-margin pull-right">
	        		{{$fpublicaciones->appends(array('id_facultad' => $facultad->id_facultad, 'buscar' => $old_search, 'estado' => $estado_consulta, 'importancia' => $importancia_consulta, 'tipo' => $tipo_consulta))->links()}}
      			</ul>
	    	</div>
		</div>
	</div><!-- /columna de 8 -->

</div>


{{ csrf_field() }}

<div id="view_Modal" class="modal fade" tabindex="-1" role="dialog">
 	<div class="modal-dialog modal-lg" role="document">
     	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              	<h4 class="view_title modal-title"></h4>
          	</div>



          	<div class="row">
            	<div class="col-md-4 col-sm-6 col-xs-12">
              		<div class="info-box bg-aqua">
                		<span class="info-box-icon"><i class="fa fa-info-circle"></i></span>
            			<div class="info-box-content">
                  			<span class="info-box-text">Tipo de Publicación</span>
                  			<span class="view_tipo info-box-number"></span>
                		</div><!-- /.info-box-content -->
              		</div><!-- /.info-box -->
        		</div><!-- /.col -->

            	<div class="col-md-4 col-sm-6 col-xs-12">
              		<div class="info-box bg-green">
                		<span class="info-box-icon"><i class="fa fa-star"></i></span>
                		<div class="info-box-content">
                  			<span class="info-box-text">Importancia</span>
                  			<span class="view_importancia info-box-number"></span>
                  			
                		</div><!-- /.info-box-content -->
              		</div><!-- /.info-box -->
            	</div><!-- /.col -->


        		<div class="col-md-4 col-sm-6 col-xs-12">
              		<div class="info-box bg-yellow">
                		<span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                		<div class="info-box-content">
                  			<span class="info-box-text">Periodo</span>
                  			<span class="view_fecha_inicio info-box-number"></span>
                  			<span class="view_fecha_fin info-box-number"></span>
                		</div><!-- /.info-box-content -->
              		</div><!-- /.info-box -->
        		</div><!-- /.col -->
            
          	</div><!-- /.row -->

          	<div class="box-body no-padding">
          		<div class="mailbox-read-info">
          			<h5 class="view_detalle"></h5>
          		</div>
          		<div class="view_contenido mailbox-read-message">
          		</div>
          		<div class="mailbox-read-info_etiqueta">
          			<h5 class="view_etiqueta"></h5>
          		</div>
          	</div>


         	<input type="hidden" id="id_fpublicacion_view" value="0">
          	<div class="modal-body">
            	<form id="form" class="form-horizontal" role="dialog">
              		<div class="modal-footer">
                		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                		<button type="button" class="b_edit_modal btn btn-info">Editar</button>
              		</div>
            	</form>
          	</div>
        </div>
    </div>
</div>

<div id="tipo_Modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<h4 class="tipo_title modal-title"></h4>
          	</div>
	  		<div class="modal-body">

	        	<form id="form" class="form-horizontal" role="dialog">

	          		<div class="form-group">
	            		<label class="control-label col-sm-4" for="select_tipo">Tipo de Publicación:</label>
	            		<div class="col-sm-8">
	            			<select class="form-control" id="select_tipo">
	            			</select>
	                  		<div class="form-group has-error">
	                    		<label class="error_tipo control-label hidden" for="select_tipo"></label>
	                  		</div>
	                	</div>
	                </div>

					<input type="hidden" id="id_fpublicacion_tipo" value="0">
	              
	              
	                <div class="modal-footer">
	                  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                  	<button type="button" class="btn btn-primary" id="b_tipo_modal">Modificar</button>
	                </div>

	        	</form>
  			</div>
    	</div>
	</div>
</div>

<div id="fecha_Modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<h4 class="fecha_title modal-title"></h4>
          	</div>
	  		<div class="modal-body">

	        	<form id="form" class="form-horizontal" role="dialog">

	          		<div class="form-group">
	            		<label class="control-label col-sm-4" for="select_fecha">Fecha de Publicación:</label>
	            		<div class="col-sm-8">
	            			<input type="text" class="form-control pull-right" id="select_fecha" value="">
	                  		<div class="form-group has-error">
	                    		<label class="error_fecha control-label hidden" for="select_fecha"></label>
	                  		</div>
	                	</div>
	                </div>

					<input type="hidden" id="id_fpublicacion_fecha" value="0">
	              
	              
	                <div class="modal-footer">
	                  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                  	<button type="button" class="btn btn-primary" id="b_fecha_modal">Modificar</button>
	                </div>

	        	</form>
  			</div>
    	</div>
	</div>
</div>

<div id="estado_Modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<h4 class="estado_title modal-title"></h4>
          	</div>
	  		<div class="modal-body">

	        	<form id="form" class="form-horizontal" role="dialog">

	          		<div class="form-group">
	            		<label class="control-label col-sm-4" for="select_estado">Estado de Publicación:</label>
	            		<div class="col-sm-8">
	            			<select class="form-control" id="select_estado">
	            			</select>
	                  		<div class="form-group has-error">
	                    		<label class="error_estado control-label hidden" for="select_estado"></label>
	                  		</div>
	                	</div>
	                </div>

					<input type="hidden" id="id_fpublicacion_estado" value="0">
	              
	              
	                <div class="modal-footer">
	                  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                  	<button type="button" class="btn btn-primary" id="b_estado_modal">Modificar</button>
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
              		<h4 class="importancia_title modal-title"></h4>
          	</div>
	  		<div class="modal-body">

	        	<form id="form" class="form-horizontal" role="dialog">

	          		<div class="form-group">
	            		<label class="control-label col-sm-4" for="select_importancia">Importancia de Publicación:</label>
	            		<div class="col-sm-8">
	            			<select class="form-control" id="select_importancia">
	            			</select>
	                  		<div class="form-group has-error">
	                    		<label class="error_importancia control-label hidden" for="select_importancia"></label>
	                  		</div>
	                	</div>
	                </div>

					<input type="hidden" id="id_fpublicacion_importancia" value="0">
	              
	              
	                <div class="modal-footer">
	                  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                  	<button type="button" class="btn btn-primary" id="b_importancia_modal">Modificar</button>
	                </div>

	        	</form>
  			</div>
    	</div>
	</div>
</div>

<div id="delete_Modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="delete_title modal-title">Eliminar Publicación</h4>
          </div>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;¿Esta seguro de eliminar esta publicación?.
          <input type="hidden" id="id_fpublicacion_delete" value="0">
          <div class="modal-body">
            <form id="form" class="form-horizontal" role="dialog">
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="b_delete_modal btn btn-danger">Eliminar</button>
              </div>
            </form>
          </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	
$(document).on('click', '.view-modal', function(){

	$.ajax({

		type: 'post',
		url: 'adminPublicacionFacultadGetFpublicacion',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_fpublicacion': $(this).data('id_fpublicacion'),
		},
		success: function(data){

			$('.view_title').html("<strong>"+data[0].titulo+"</strong>");
			$('.view_detalle').html("<strong>Descripción: </strong>"+data[0].detalle);
			$('.view_tipo').text(data[0].tipo);
			$('.view_importancia').text(data[0].importancia);
			$('.view_fecha_inicio').text("Del: "+data[0].fecha_inicio);
			$('.view_fecha_fin').text("Al : "+data[0].fecha_fin);
			$('.view_contenido').html("<strong>Contenido: </strong><br>"+data[0].contenido);
			$('.view_etiqueta').html("<strong>Etiqueta: </strong>"+data[0].etiqueta);

			$('#id_fpublicacion_view').val(data[0].id_fpublicacion);

			$('#view_Modal').modal('show');

		}
	});
});

$(document).on('click', '.b_edit_modal', function(){

	$('#view_Modal').modal('hide');
	document.location.href= "{!!url('adminPublicacionFacultadEdit/"+$("#id_fpublicacion_view").val()+"');!!}";
});


$(document).on('click', '.delete-modal', function(){

	$('.delete_title').html("Eliminar Publicación: <strong>"+$(this).data('titulo')+"</strong>");

	$('#id_fpublicacion_delete').val($(this).data('id_fpublicacion'));

	$('#delete_Modal').modal('show');
});


$(document).on('click', '.b_delete_modal', function(){

	$.ajax({

    	type: 'post',
    	url: 'adminPublicacionFacultadDestroy',
    	data: {
      		'_token': $('input[name=_token]').val(),
      		'id_fpublicacion': $("#id_fpublicacion_delete").val(),
    	},
    	success: function(data){

      		if(data.errors){
      			console.log('error...');
      		}else{

        		$('#delete_Modal').modal('hide');

    			$('.tr_fpublicacion'+data.id_fpublicacion).replaceWith("");
    			swal("Publicación Eliminada!", "La publicación "+data.titulo+", fue eliminada correctamente", "success");
      		}
    	}

  	});

});


$(document).on('click','.edit_tipo', function(){

	$('.tipo_title').text("Cambiar tipo de Publicación de: "+$(this).data('titulo'));

	$('#id_fpublicacion_tipo').val($(this).data('id_fpublicacion'));

	$('.error_tipo').addClass('hidden');

	$.ajax({

		type: 'post',
		url: 'adminPublicacionFacultadListaCambiarTipo',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_fpublicacion': $(this).data('id_fpublicacion'),
		},
		success: function(data){

			var text_contenedor= "";

			for(i=0; i < data.length; i++){

				var text_contenedor= text_contenedor + "<option value='"+data[i].id_ftp+"'>"+data[i].tipo+"</option>";
			}

			text_contenedor= "<select class='form-control' id='select_tipo'>"+text_contenedor+"</select>";

			$('#select_tipo').replaceWith(text_contenedor);
		}
	});

	setTimeout(function(){document.getElementById("select_tipo").focus();}, 500);

	$('#tipo_Modal').modal('show');
  
});

$(document).on('click', '#b_tipo_modal', function(){


	$('.error_tipo').addClass('hidden');


	$.ajax({

		type: 'post',
		url: 'adminPublicacionFacultadUpdateTipo',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_fpublicacion': $('#id_fpublicacion_tipo').val(),
			'id_ftp': $('#select_tipo').val(),
		},
		success: function(data){

			if(data.errors){


				
			}else{


				$('#tipo_Modal').modal('hide');

				$('#edit_tipo'+data.fpublicacion.id_fpublicacion).replaceWith("<a id='edit_tipo"+data.fpublicacion.id_fpublicacion+"' class='edit_tipo btn btn-delault btn-sm' data-toggle='tooltip' title='Cambiar el tipo de publicación de: "+data.fpublicacion.titulo+"' data-id_fpublicacion='"+data.fpublicacion.id_fpublicacion+"' data-titulo='"+data.fpublicacion.titulo+"'>"+data.ftipo_publicacion.tipo+"</a>");

				swal("Tipo de Publicación fue modificado", "La publicación "+data.fpublicacion.titulo+", fue modificada con exito", "success");
			}
		}

	});
});

$(document).on('click','.edit_fecha', function(){

	$('.fecha_title').text("Cambiar estado de Publicación de: "+$(this).data('titulo'));

	$('#id_fpublicacion_fecha').val($(this).data('id_fpublicacion'));


	$('.error_fecha').addClass('hidden');

	$.ajax({

		type: 'post',
		url: 'adminPublicacionFacultadGetFpublicacion',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_fpublicacion': $(this).data('id_fpublicacion'),
		},
		success: function(data){

			$('#select_fecha').replaceWith("<input type='text' class='form-control pull-right' id='select_fecha' value='"+moment(data[0].fecha_inicio).format('DD/MM/YYYY')+" - "+moment(data[0].fecha_fin).format('DD/MM/YYYY')+"'>");

			var j = jQuery.noConflict();
    
		    j( function() {
		    	j( "#select_fecha" ).daterangepicker({
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
		}
	});

	setTimeout(function(){document.getElementById("select_fecha").focus();}, 500);

	$('#fecha_Modal').modal('show');
  
});

$(document).on('click', '#b_fecha_modal', function(){


	$('.error_fecha').addClass('hidden');

	var j = jQuery.noConflict();
    
    j( function() {
    	j( "#select_fecha" ).daterangepicker({
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


	$.ajax({

		type: 'post',
		url: 'adminPublicacionFacultadUpdateFecha',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_fpublicacion': $('#id_fpublicacion_fecha').val(),
			'fecha_inicio': j('#select_fecha').data('daterangepicker').startDate.format('YYYY-MM-DD'),
			'fecha_fin': j('#select_fecha').data('daterangepicker').endDate.format('YYYY-MM-DD'),
		},
		success: function(data){

			if(data.errors){


				
			}else{


				$('#fecha_Modal').modal('hide');
				$('#edit_inicio'+data.id_fpublicacion).replaceWith("<a id='edit_inicio"+data.id_fpublicacion+"' class='edit_fecha btn btn-delault btn-sm' data-toggle='tooltip' title='Cambiar la fecha de publicación : "+data.titulo+"' data-id_fpublicacion='"+data.id_fpublicacion+"' data-titulo='"+data.titulo+"'>"+moment(data.fecha_inicio).format('DD/MM/YYYY')+"</a>");

				$('#edit_fin'+data.id_fpublicacion).replaceWith("<a id='edit_fin"+data.id_fpublicacion+"' class='edit_fecha btn btn-delault btn-sm' data-toggle='tooltip' title='Cambiar la fecha de publicación : "+data.titulo+"' data-id_fpublicacion='"+data.id_fpublicacion+"' data-titulo='"+data.titulo+"'>"+moment(data.fecha_fin).format('DD/MM/YYYY')+"</a>");

				swal("Fecha de Publicación modificada", "La publicación "+data.titulo+", fue cambiada con exito", "success");
			}
		}

	});
});


$(document).on('click','.edit_estado', function(){

	$('.estado_title').text("Cambiar estado de Publicación de: "+$(this).data('titulo'));

	$('#id_fpublicacion_estado').val($(this).data('id_fpublicacion'));


	$('.error_estado').addClass('hidden');

	$.ajax({

		type: 'post',
		url: 'adminPublicacionFacultadListaCambiarEstado',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_fpublicacion': $(this).data('id_fpublicacion'),
		},
		success: function(data){

			var text_contenedor= "";

			for(i=0; i < data.length; i++){
				var text_contenedor= text_contenedor + "<option value='"+data[i].estado+"'>"+data[i].estado+"</option>";
			}

			text_contenedor= "<select class='form-control' id='select_estado'>"+text_contenedor+"</select>";

			$('#select_estado').replaceWith(text_contenedor);
		}
	});

	setTimeout(function(){document.getElementById("select_estado").focus();}, 500);

	$('#estado_Modal').modal('show');
  
});

$(document).on('click', '#b_estado_modal', function(){


	$('.error_estado').addClass('hidden');


	$.ajax({

		type: 'post',
		url: 'adminPublicacionFacultadUpdateEstado',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_fpublicacion': $('#id_fpublicacion_estado').val(),
			'estado': $('#select_estado').val(),
		},
		success: function(data){

			if(data.errors){


				
			}else{


				$('#estado_Modal').modal('hide');
				$('#edit_estado'+data.id_fpublicacion).replaceWith("<a id='edit_estado"+data.id_fpublicacion+"' class='edit_estado btn btn-delault btn-sm' data-toggle='tooltip' title='Cambiar el estado de publicación : "+data.titulo+"' data-id_fpublicacion='"+data.id_fpublicacion+"' data-titulo='"+data.titulo+"'>"+data.estado+"</a>");

				swal("Estado de Publicación modificada", "La publicación "+data.titulo+", fue cambiada con exito", "success");
			}
		}

	});
});

$(document).on('click','.edit_importancia', function(){

	$('.importancia_title').text("Cambiar importancia de Publicación de: "+$(this).data('titulo'));

	$('#id_fpublicacion_importancia').val($(this).data('id_fpublicacion'));


	$('.error_importancia').addClass('hidden');

	$.ajax({

		type: 'post',
		url: 'adminPublicacionFacultadListaCambiarImportancia',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_fpublicacion': $(this).data('id_fpublicacion'),
		},
		success: function(data){

			var text_contenedor= "";

			for(i=0; i < data.length; i++){
				var text_contenedor= text_contenedor + "<option value='"+data[i].id_importancia+"'>"+data[i].importancia+"</option>";
			}

			text_contenedor= "<select class='form-control' id='select_importancia'>"+text_contenedor+"</select>";

			$('#select_importancia').replaceWith(text_contenedor);
		}
	});

	setTimeout(function(){document.getElementById("select_importancia").focus();}, 500);

	$('#importancia_Modal').modal('show');
  
});

$(document).on('click', '#b_importancia_modal', function(){


	$('.error_importancia').addClass('hidden');


	$.ajax({

		type: 'post',
		url: 'adminPublicacionFacultadUpdateImportancia',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_fpublicacion': $('#id_fpublicacion_importancia').val(),
			'id_importancia': $('#select_importancia').val(),
		},
		success: function(data){

			if(data.errors){

				console.og('entra al error');
				
			}else{


				$('#importancia_Modal').modal('hide');
				$('#edit_importancia'+data.fpublicacion.id_fpublicacion).replaceWith("<a id='edit_importancia"+data.fpublicacion.id_fpublicacion+"' class='edit_importancia btn btn-delault btn-sm' data-toggle='tooltip' title='Cambiar la importancia de la publicación : "+data.fpublicacion.titulo+"' data-id_fpublicacion='"+data.fpublicacion.id_fpublicacion+"' data-titulo='"+data.fpublicacion.titulo+"'>"+data.importancia.importancia+"</a>");

				swal("Importancia de Publicación modificada", "La publicación "+data.titulo+", fue cambiada con exito", "success");
			}
		}

	});
});

$(document).on('click','.tipos_publicacion', function(){

	console.log($(this).data('tipo_publicacion'));
	$('.search_tipo').val($(this).data('tipo_publicacion'));

	$('.search_tipo').closest('form').trigger('submit');
  
});

</script>

@endsection
