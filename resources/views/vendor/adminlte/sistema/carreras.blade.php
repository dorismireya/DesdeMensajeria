@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Carreras
@endsection

@section('contentheader_title')
	Carreras
@endsection


@section('main-content')

 
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#carreras_Modal" id="new-Carrera" >
	<span class="glyphicon glyphicon-plus"></span> Nueva Carrera
</button>
<br><br>

<div class="row">
	<div class="col-xs-10 col-md-offset-1">
	  <div class="box box-info box-solid">
	    <div class="box-header">
	      <h3 class="box-title">Administración de Carreras</h3>
	        
				<div class="box-tools">{!! Form::open(['route'=>'carrerasSearch','method'=>'get', 'class'=>'pull-right'])!!}


                    <div class="input-group" style="width: 350px;">

					{!! Form::text('buscar',old('',Request::input('buscar')), ['class' => 'form-control input-sm pull-right', 'placeholder'=> 'Buscar...'])!!}
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="submit"><i class="fa fa-search"></i></button>
                      </div>

                      <select class="form-control input-sm pull-right" name="estado" onchange="">
	        				<option {{$estado_consulta == 'activo' ? 'selected="selected"' : ''}} value="activo" >activo</option>
	        				<option {{$estado_consulta == 'baja' ? 'selected="selected"' : ''}} value="baja">baja</option>
	        				<option {{$estado_consulta == '' ? 'selected="selected"' : ''}} value="">todos</option>
            			</select>

                    </div>{!! Form::close()!!}
                  </div>

	        	
	        

	    </div><!-- /.box-header -->
	    <div class="box-body table-responsive no-padding">
	      <table id="table_carreras" class="table table-hover table-bordered table-striped">
	        <tr class="info">
	          <th class="col-md-1">Código</th>
	          <th class="col-md-4">Carrera</th>
	          <th class="col-md-4">Descripción</th>
	          <th class="col-md-1">Estado</th>
	          <th class="col-md-2"> </th>
	         
	        </tr>

	        <!-- <tbody> -->
	        	@foreach($carreras as $carrera)
			        <tr class="tr_carreras{{$carrera->id_carrera}}">
			          <td>{{$carrera->codigo}}</td>
			          <td>{{$carrera->carrera}}</td>
			          <td>{{$carrera->detalle}}</td>
			          <td>{{$carrera->estado}}</td>
			          <td>
			          	<div class="btn-group">
			      			<a class="btn btn-delault" data-toggle="tooltip" title="Ver Materias de: {{$carrera->carrera}}" href="{{route('sistemaMateria',['id_carrera'=> $carrera->id_carrera])}}">
			    				<i class="fa fa-cog"></i>
			  				</a>
			  				<a class="edit-modal btn btn-delault" data-toggle="tooltip" title="Editar Carrera: {{$carrera->carrera}}" data-id="{{$carrera->id_carrera}}" data-codigo="{{$carrera->codigo}}" data-carrera="{{$carrera->carrera}}" data-detalle="{{$carrera->detalle}}" data-estado="{{$carrera->estado}}">
			    				<i class="fa fa-edit"></i>
			  				</a>
		  				</div>

			          </td>
			        </tr>
		        @endforeach
	        <!-- </tbody> -->
	       
	      </table>
	    </div><!-- /.box-body -->
	    <div class="box-footer clearfix">
	      <ul class="pagination pagination-sm no-margin pull-right">
	        {{$carreras->links()}}
	      </ul>
	    </div>
	  </div><!-- /.box -->
	</div>
</div>


	<div id="carreras_Modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
	  		<div class="modal-content">
	        	<div class="modal-header">
	          		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            	<h4 class="modal-title" id="title">Nueva Carrera</h4>
	        	</div>
	        	{{ csrf_field() }}
	        	<div class="modal-body">
	        		<form id="form" class="form-horizontal" role="dialog">

	        			<div class="form-group">
	              			<label class="control-label col-sm-2" for="codigo">Código:</label>
			              	<div class="col-sm-10">
			                	<input type="text" class="form-control" placeholder="Codigo de Carrera" id="codigo">
			                	<div class="form-group has-error">
			              			<label class="error_codigo control-label hidden" for="codigo"></label>
			              		</div>
			              	</div>
	            		</div>
	            		<p class="error text-center alert alert-danger hidden"></p>

	            		<div class="form-group">
	              			<label class="control-label col-sm-2" for="carrera">Carrera:</label>
			              	<div class="col-sm-10">
			                	<input type="text" class="form-control" placeholder="Nombre de la Carrera" id="carrera">
			                	<div class="form-group has-error">
			              			<label class="error_carrera control-label hidden" for="codigo"></label>
			              		</div>
			              	</div>
	            		</div>

	            		<div class="form-group">
	              			<label class="control-label col-sm-2" for="detalle">Descripción:</label>
			              	<div class="col-sm-10">
			                	<input type="text" class="form-control" placeholder="Descripcion" id="detalle">
			              	</div>
	            		</div>

	            		<input type="hidden" id="id_carrera" value="0">
            		
	            	
	          		<div class="modal-footer">
	            		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	            		<button type="button" class="btn btn-primary" id="b_Guardar">Guardar</button>
	            		<button type="button" class="btn btn-success" id="b_Activo" style="display: none">Activar</button>
	            		<button type="button" class="btn btn-warning" id="b_Baja" style="display: none">Baja</button>
	            		<button type="button" class="btn btn-primary" id="b_Modificar" style="display: none">Modificar</button>
	            		<button type="button" class="btn btn-danger" id="b_Delete" style="display: none">Eliminar</button>
	          		</div>

	          		</form>

	    		</div>
	      	</div>
	    </div>
	</div>


	<div id="carreras_DeleteModal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
	  		<div class="modal-content">
	        	<div class="modal-header">
	          		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            	<h4 class="modal-title" id="title-delete">Eliminar Carrera</h4>
	        	</div>
	        	<div class="modal-body">
	        		<p id="contenido_delete"></p>
	
            		<input type="hidden" id="id_carrera_delete" value="0">
            		
	          		<div class="modal-footer">
	            		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	            		<button type="button" class="btn btn-danger" id="b_buttonDelete">Eliminar</button>
	          		</div>

	    		</div>
	      	</div>
	    </div>
	</div>

	<script type="text/javascript">

		$(document).on('click', '#new-Carrera', function() {

			$('#title').text('Nueva Carrera');

			$('#id_carrera').val('0');
			$('#codigo').val('');
			$('#carrera').val('');
			$('#detalle').val('');

			$('.error_codigo').addClass('hidden');
			$('.error_carrera').addClass('hidden');

			$('#b_Guardar').show('400');
			$('#b_Modificar').hide('400');
			$('#b_Delete').hide('400');
			$('#b_Activo').hide('400');
			$('#b_Baja').hide('400');


            setTimeout(function(){document.getElementById("codigo").focus();}, 500);
        });

		
		$(document).on('click', '#b_Guardar', function(){

			$('.error_codigo').addClass('hidden');
			$('.error_carrera').addClass('hidden');

			if($("#codigo").val().length == 0){
				$('.error_codigo').removeClass('hidden');
				$('.error_codigo').text("Ingrese un código válido de carrera");
				document.getElementById("codigo").focus();
				return;
			}

			if($("#carrera").val().length == 0){
				$('.error_carrera').removeClass('hidden');
				$('.error_carrera').text("Ingrese el nombre de carrera");
				document.getElementById("carrera").focus();
				return;
			}


			$.ajax({

				type: 'post',
				url: 'carreraAdd',
				data: {
					'_token': $('input[name=_token]').val(),
					'codigo': $("#codigo").val(),
					'carrera': $("#carrera").val(),
					'detalle': $("#detalle").val(),
				},
				success: function(data){

					if(data.errors){


						if(data.errors.codigo != undefined){
							$('.error_codigo').removeClass('hidden');
							$('.error_codigo').text(data.errors.codigo);
							document.getElementById("codigo").focus();
							return;
						}
						if(data.errors.carrera != undefined){
							$('.error_carrera').removeClass('hidden');
							$('.error_carrera').text(data.errors.carrera);
							document.getElementById("carrera").focus();
							return;
						}
					}else{

						$('#carreras_Modal').modal('hide');


						$('#table_carreras').append("<tr class='tr_carreras" + data.id_carrera + "'><td>" + data.codigo + "</td><td>" + data.carrera + "</td><td>" + data.detalle + "</td><td>" + data.estado + "</td><td><div class='btn-group'><a class='btn btn-delault' data-toggle='tooltip' title='Ver Materias de: "+data.carrera+"' href='{{route('sistemaMateria',['id_carrera'=> ''])}}"+"/"+data.id_carrera+"'><i class='fa fa-cog'></i></a><a class='edit-modal btn btn-delault' title='Editar Carrera: "+data.id_carrera+"' data-id='"+data.id_carrera+"' data-codigo='"+data.codigo+"' data-carrera='"+data.carrera+"' data-detalle='"+data.detalle+"' data-estado='"+data.estado+"'><i class='fa fa-edit'></i></a></div></td></tr>");

						swal("Carrera Creada!", "La carrera "+data.carrera+", fue creada con exito", "success");
							
							
					}
				}

			});
		});

		$(document).on('click','.edit-modal', function(){

			contenedor_id_carrera= $(this).data('id');
			contenedor_codigo= $(this).data('codigo');
			contenedor_carrera= $(this).data('carrera');
			contenedor_detalle= $(this).data('detalle');
			contenedor_estado= $(this).data('estado');

			console.log('estado after: ',contenedor_estado);


			$.ajax({

				type: 'post',
				url: 'carreraCantidadMaterias',
				data: {
					'_token': $('input[name=_token]').val(),
					'id_carrera': $(this).data('id'),
				},
				success: function(data){

					$('#title').text('Editar Carrera');

					$('#id_carrera').val(contenedor_id_carrera);
					$('#codigo').val(contenedor_codigo);
					$('#carrera').val(contenedor_carrera);
					$('#detalle').val(contenedor_detalle);

					$('.error_codigo').addClass('hidden');
					$('.error_carrera').addClass('hidden');

					if(contenedor_estado == 'activo'){

						$('#b_Baja').show('400');
						$('#b_Activo').hide('400');
					}else{

						$('#b_Activo').show('400');
						$('#b_Baja').hide('400');
					}


					$('#b_Modificar').show('400');
					$('#b_Guardar').hide('400');

					if(data[0].cantidad == 0)
						$('#b_Delete').show('400');
					else $('#b_Delete').hide('400');

		            setTimeout(function(){document.getElementById("codigo").focus();}, 500);

		            $('#carreras_Modal').modal('show');
				}
			});
		});

		$(document).on('click', '#b_Baja', function(){


			$.ajax({

				type: 'post',
				url: 'carreraEstado',
				data: {
					'_token': $('input[name=_token]').val(),
					'id_carrera': $("#id_carrera").val(),
					'estado': 'baja',
				},
				success: function(data){

					if(data.errors){

					}else{

						$('#carreras_Modal').modal('hide');

						$('.tr_carreras'+data.id_carrera).replaceWith("<tr class='tr_carreras" + data.id_carrera + "'><td>" + data.codigo + "</td><td>" + data.carrera + "</td><td>" + data.detalle + "</td><td>" + data.estado + "</td><td><div class='btn-group'><a class='btn btn-delault' data-toggle='tooltip' title='Ver Materias de: "+data.carrera+"' href='{{route('sistemaMateria',['id_carrera'=> ''])}}"+"/"+data.id_carrera+"'><i class='fa fa-cog'></i></a><a class='edit-modal btn btn-delault' title='Editar Carrera: "+data.id_carrera+"' data-id='"+data.id_carrera+"' data-codigo='"+data.codigo+"' data-carrera='"+data.carrera+"' data-detalle='"+data.detalle+"' data-estado='"+data.estado+"'><i class='fa fa-edit'></i></a></div></td></tr>");

						swal("Estado de Carrera Modificada!", "El estado de la carrera "+data.carrera+", fue modificada con exito", "success");

						
					}
				}
			});
		});

		$(document).on('click', '#b_Activo', function(){


			$.ajax({

				type: 'post',
				url: 'carreraEstado',
				data: {
					'_token': $('input[name=_token]').val(),
					'id_carrera': $("#id_carrera").val(),
					'estado': 'activo',
				},
				success: function(data){

					if(data.errors){

					}else{

						$('#carreras_Modal').modal('hide');

						$('.tr_carreras'+data.id_carrera).replaceWith("<tr class='tr_carreras" + data.id_carrera + "'><td>" + data.codigo + "</td><td>" + data.carrera + "</td><td>" + data.detalle + "</td><td>" + data.estado + "</td><td><div class='btn-group'><a class='btn btn-delault' data-toggle='tooltip' title='Ver Materias de: "+data.carrera+"' href='{{route('sistemaMateria',['id_carrera'=> ''])}}"+"/"+data.id_carrera+"'><i class='fa fa-cog'></i></a><a class='edit-modal btn btn-delault' title='Editar Carrera: "+data.id_carrera+"' data-id='"+data.id_carrera+"' data-codigo='"+data.codigo+"' data-carrera='"+data.carrera+"' data-detalle='"+data.detalle+"' data-estado='"+data.estado+"'><i class='fa fa-edit'></i></a></div></td></tr>");

						swal("Estado de Carrera Modificada!", "El estado de la carrera "+data.carrera+", fue modificada con exito", "success");

						
					}
				}
			});
		});


		$(document).on('click', '#b_Modificar', function(){

			$('.error_codigo').addClass('hidden');
			$('.error_carrera').addClass('hidden');

			if($("#codigo").val().length == 0){
				$('.error_codigo').removeClass('hidden');
				$('.error_codigo').text("Ingrese un código válido de carrera");
				document.getElementById("codigo").focus();
				return;
			}

			if($("#carrera").val().length == 0){
				$('.error_carrera').removeClass('hidden');
				$('.error_carrera').text("Ingrese el nombre de la carrera");
				document.getElementById("carrera").focus();
				return;
			}


			$.ajax({

				type: 'post',
				url: 'carreraEdit',
				data: {
					'_token': $('input[name=_token]').val(),
					'id_carrera': $("#id_carrera").val(),
					'codigo': $("#codigo").val(),
					'carrera': $("#carrera").val(),
					'detalle': $("#detalle").val(),
				},
				success: function(data){

					if(data.errors){


						if(data.errors.codigo != undefined){
							$('.error_codigo').removeClass('hidden');
							$('.error_codigo').text(data.errors.codigo);
							document.getElementById("codigo").focus();
							return;
						}
						if(data.errors.carrera != undefined){
							$('.error_carrera').removeClass('hidden');
							$('.error_carrera').text(data.errors.carrera);
							document.getElementById("carrera").focus();
							return;
						}
					}else{

						$('#carreras_Modal').modal('hide');


						$('.tr_carreras'+data.id_carrera).replaceWith("<tr class='tr_carreras" + data.id_carrera + "'><td>" + data.codigo + "</td><td>" + data.carrera + "</td><td>" + data.detalle + "</td><td>" + data.estado + "</td><td><div class='btn-group'><a class='btn btn-delault' data-toggle='tooltip' title='Ver Materias de: "+data.carrera+"' href='{{route('sistemaMateria',['id_carrera'=> ''])}}"+"/"+data.id_carrera+"'><i class='fa fa-cog'></i></a><a class='edit-modal btn btn-delault' title='Editar Carrera: "+data.id_carrera+"' data-id='"+data.id_carrera+"' data-codigo='"+data.codigo+"' data-carrera='"+data.carrera+"' data-detalle='"+data.detalle+"' data-estado='"+data.estado+"'><i class='fa fa-edit'></i></a></div></td></tr>");

						swal("Carrera Modificada!", "La carrera "+data.carrera+", fue modificada con exito", "success");

						
					}
				}

			});
		});


		$(document).on('click', '#b_Delete', function(){

			$('#carreras_Modal').modal('hide');

			$('#title-delete').text('Eliminar Carrera: '+$("#codigo").val()+" - "+$("#carrera").val());
			$('#contenido_delete').html("Desea eliminar la Carrera:<br>Código: <strong>"+$("#codigo").val()+"</strong><br>Carrera: <strong>"+$("#carrera").val()+"</strong>");
			$('#id_carrera_delete').val($("#id_carrera").val());


			$('#carreras_DeleteModal').modal('show');
		});

		$(document).on('click', '#b_buttonDelete', function(){

			$.ajax({

				type: 'post',
				url: 'carreraDelete',
				data:{
					'_token': $('input[name=_token]').val(),
					'id_carrera': $("#id_carrera_delete").val(),
				},
				success: function(data){

					if(data.errors){

					}else{

						$('#carreras_DeleteModal').modal('hide');

						$('.tr_carreras'+$('#id_carrera').val()).remove();

						swal("Carrera Eliminada!", "La carrera "+$("#carrera").val()+", fue eliminada con exito", "error");

						
					}
				}
			});
		});
	</script>


@endsection
