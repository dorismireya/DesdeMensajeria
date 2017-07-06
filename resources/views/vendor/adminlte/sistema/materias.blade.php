@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Carrera: {{$carrera->carrera}}
@endsection

@section('contentheader_title')
	Carrera: {{$carrera->codigo}} - {{$carrera->carrera}}
@endsection

@section('main-content')


<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#materias_Modal" id="new-Materia" >
	<span class="glyphicon glyphicon-plus"></span> Nueva Materia
</button>

<br><br>

<div class="row">
	<div class="col-xs-10 col-md-offset-1">
	  <div class="box box-info box-solid">
	    <div class="box-header">
	      <h3 class="box-title">Administración de Materias</h3>
	        
			<div class="box-tools">

				{!! Form::open(['route'=>'materiasSearch','method'=>'get', 'class'=>'pull-right'])!!}


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

	    				<input type="hidden" name="id_carrera" value="{{$carrera->id_carrera}}">

	            	</div>
	            {!! Form::close()!!}
	      	</div>
	        	
	        

	    </div><!-- /.box-header -->
	    <div class="box-body table-responsive no-padding">
	      <table id="tabla_materias" class="table table-hover table-bordered table-striped">
	        <tr class="info">
	          <th class="col-md-1">Nivel</th>
	          <th class="col-md-1">Codigo</th>
	          <th class="col-md-5">Materia</th>
	          <th class="col-md-1">Sigla</th>
	          <th class="col-md-1">Estado</th>
	          <th class="col-md-3"> </th>
	         
	        </tr>

	        <!-- <tbody> -->
	        	@foreach($materias as $materia)
			        <tr class="tr_materias{{$materia->id_materia}}">
			          <td>{{$materia->nivel}}</td>
			          <td>{{$materia->codigo}}</td>
			          <td>{{$materia->materia}}</td>
			          <td>{{$materia->sigla}}</td>
			          <td>{{$materia->estado}}</td>
			          <td>
			          	
			          	<div class="btn-group">
			      			<a class="pre-modal btn btn-delault" data-toggle="tooltip" title="Ver Dependecias de: {{$materia->materia}}" data-id_materia="{{$materia->id_materia}}" data-id_carrera="{{$materia->id_carrera}}" data-codigo="{{$materia->codigo}}" data-materia="{{$materia->materia}}" data-nivel= "{{$materia->nivel}}" data-sigla= "{{$materia->sigla}}">
			    				<i class="fa fa-cog"></i>
			  				</a>
			  				<a class="edit-modal btn btn-delault" data-toggle="tooltip" title="Editar Materia: {{$materia->materia}}" data-id="{{$materia->id_materia}}" data-codigo="{{$materia->codigo}}" data-materia="{{$materia->materia}}" data-nivel= "{{$materia->nivel}}" data-sigla= "{{$materia->sigla}}" data-detalle="{{$materia->detalle}}" data-estado="{{$materia->estado}}">
			    				<i class="fa fa-edit"></i>
			  				</a>
			  				<span class="label label-success badge">{{$materia->cantidad == 0 ? '':$materia->cantidad}}</span>
		  				</div>

			          </td>
			        </tr>
		        @endforeach
	        <!-- </tbody> -->
	       
	      </table>
	    </div><!-- /.box-body -->
	    <div class="box-footer clearfix">
	      <ul class="pagination pagination-sm no-margin pull-right">
	        {{$materias->links()}}
	      </ul>
	    </div>
	  </div><!-- /.box -->
	</div>
</div>


<div id="materias_Modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
  		<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title" id="title">Nueva Materia</h4>
        	</div>
        	{{ csrf_field() }}
        	<div class="modal-body">
        		<form id="form" class="form-horizontal" role="dialog">

					<div class="form-group">
              			<label class="control-label col-sm-2" for="nivel">Nivel:</label>
		              	<div class="col-sm-10">
		                	<input type="text" class="form-control text-uppercase" placeholder="Nivel de la Materia" id="nivel">
		                	<div class="form-group has-error">
		              			<label class="error_nivel control-label hidden" for="nivel"></label>
		              		</div>
		              	</div>
            		</div>


        			<div class="form-group">
              			<label class="control-label col-sm-2" for="codigo">Código:</label>
		              	<div class="col-sm-10">
		                	<input type="text" class="form-control text-uppercase" placeholder="Código de la Materia" id="codigo">
		                	<div class="form-group has-error">
		              			<label class="error_codigo control-label hidden" for="codigo"></label>
		              		</div>
		              	</div>
            		</div>


            		<div class="form-group">
              			<label class="control-label col-sm-2" for="materia">Materia:</label>
		              	<div class="col-sm-10">
		                	<input type="text" class="form-control text-capitalize" placeholder="Nombre de la Materia" id="materia">
		                	<div class="form-group has-error">
		              			<label class="error_materia control-label hidden" for="materia"></label>
		              		</div>
		              	</div>
            		</div>

            		<div class="form-group">
              			<label class="control-label col-sm-2" for="sigla">Sigla:</label>
		              	<div class="col-sm-10">
		                	<input type="text" class="form-control text-uppercase" placeholder="Sigla de la Materia" id="sigla">
		                	<div class="form-group has-error">
		              			<label class="error_sigla control-label hidden" for="sigla"></label>
		              		</div>
		              	</div>
            		</div>

            		<div class="form-group">
              			<label class="control-label col-sm-2" for="detalle">Descripción:</label>
		              	<div class="col-sm-10">
		                	<input type="text" class="form-control" placeholder="Descripción" id="detalle">
		              	</div>
            		</div>

            		<input type="hidden" id="id_carrera" value="{{$carrera->id_carrera}}">
            		<input type="hidden" id="id_materia" value="0">
        		
            	
	          		<div class="modal-footer">
	            		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	            		<button type="button" class="btn btn-primary" id="b_Guardar">Guardar</button>
	            		<button type="button" class="btn btn-success" id="b_Activo" style="display: none">Activar</button>
	            		<button type="button" class="btn btn-warning" id="b_Baja" style="display: none">Baja</button>
	            		<button type="button" class="btn btn-primary" id="b_Modificar" style="display: none">Modificar</button>
	          		</div>

          		</form>

    		</div>
      	</div>
    </div>
</div>


<div id="dependencias_Modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
  		<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title" id="pre_title"></h4>
        	</div>
        	<div class="modal-body">

        		<div class="col-lg-12">
        			<div class="input-group">
        				<input id="searchMateria" type="text" class="form-control" onkeyup="searchMateria()" placeholder="Buscar materia...">
        				<span class="input-group-btn">
        					<button class="btn btn-default" type="button">Buscar</button>
    					</span>
    					
					</div><!-- /input-group -->
				</div><!-- /.col-lg-6 -->
				<br><br>
        		
        		<div class="box-body table-responsive no-padding">
			      	<table id="tabla_dependencias" class="table table-hover table-bordered table-striped">
			        	<tr class="info">
				          	<th class="col-md-1">Nivel</th>
					        <th class="col-md-2">Código</th>
					        <th class="col-md-7">Materia</th>
					        <th class="col-md-1">Sigla</th>
					        <th class="col-md-1"> </th>
			        	</tr>   
			      	</table>
			    </div><!-- /.box-body -->
    		</div>
      	</div>
    </div>
</div>


<script type="text/javascript">

$(document).on('click', '#new-Materia', function() {

	$('#title').text('Nueva Materia');

	$('#id_materia').val('0');
	$('#nivel').val('');
	$('#codigo').val('');
	$('#materia').val('');
	$('#sigla').val('');
	$('#detalle').val('');

	$('.error_nivel').addClass('hidden');
	$('.error_codigo').addClass('hidden');
	$('.error_materia').addClass('hidden');
	$('.error_sigla').addClass('hidden');

	$('#b_Guardar').show('400');
	$('#b_Modificar').hide('400');
	$('#b_Activo').hide('400');
	$('#b_Baja').hide('400');


    setTimeout(function(){document.getElementById("nivel").focus();}, 500);
});


$(document).on('click', '#b_Guardar', function(){

	$('.error_nivel').addClass('hidden');
	$('.error_codigo').addClass('hidden');
	$('.error_materia').addClass('hidden');
	$('.error_sigla').addClass('hidden');

	if($("#nivel").val().length == 0){
		$('.error_nivel').removeClass('hidden');
		$('.error_nivel').text("Ingrese un nivel válido de la Materia");
		document.getElementById("nivel").focus();
		return;
	}

	if($("#codigo").val().length == 0){
		$('.error_codigo').removeClass('hidden');
		$('.error_codigo').text("Ingrese un código válido de la Materia");
		document.getElementById("codigo").focus();
		return;
	}

	if($("#materia").val().length == 0){
		$('.error_materia').removeClass('hidden');
		$('.error_materia').text("Ingrese un nombre válido de la Materia");
		document.getElementById("materia").focus();
		return;
	}

	if($("#sigla").val().length == 0){
		$('.error_sigla').removeClass('hidden');
		$('.error_sigla').text("Ingrese una sigla válida de la Materia");
		document.getElementById("sigla").focus();
		return;
	}


	$.ajax({

		type: 'post',
		url: 'materiaAdd',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_carrera': $("#id_carrera").val(),
			'materia': capitalize($("#materia").val()),
			'nivel': $("#nivel").val().toUpperCase(),
			'codigo': $("#codigo").val().toUpperCase(),
			'sigla': $("#sigla").val().toUpperCase(),
			'detalle': $("#detalle").val(),
		},
		success: function(data){

			if(data.errors){


				if(data.errors.nivel != undefined){
					$('.error_nivel').removeClass('hidden');
					$('.error_nivel').text(data.errors.nivel);
					document.getElementById("nivel").focus();
					return;
				}

				if(data.errors.codigo != undefined){
					$('.error_codigo').removeClass('hidden');
					$('.error_codigo').text(data.errors.codigo);
					document.getElementById("codigo").focus();
					return;
				}

				if(data.errors.materia != undefined){
					$('.error_materia').removeClass('hidden');
					$('.error_materia').text(data.errors.materia);
					document.getElementById("materia").focus();
					return;
				}

				if(data.errors.sigla != undefined){
					$('.error_sigla').removeClass('hidden');
					$('.error_sigla').text(data.errors.sigla);
					document.getElementById("sigla").focus();
					return;
				}

			}else{

				$('#materias_Modal').modal('hide');


				$('#tabla_materias').append("<tr class='tr_materias"+data.id_materia+"'><td>"+data.nivel+"</td><td>"+data.codigo+"</td><td>"+data.materia+"</td><td>"+data.sigla+"</td><td>"+data.estado+"</td><td><div class='btn-group'><a class='pre-modal  btn btn-delault' title='Ver Dependecias de: "+data.materia+"' data-id_materia='"+data.id_materia+"' data-id_carrera='"+data.id_carrera+"' data-codigo='"+data.codigo+"' data-materia='"+data.materia+"' data-nivel= '"+data.nivel+"' data-sigla= '"+data.sigla+"'><i class='fa fa-cog'></i></a><a class='edit-modal btn btn-delault' title='Editar Materia: "+data.materia+"' data-id='"+data.id_materia+"' data-codigo='"+data.codigo+"' data-materia='"+data.materia+"' data-nivel= '"+data.nivel+"' data-sigla= '"+data.sigla+"' data-detalle='"+data.detalle+"' data-estado='"+data.estado+"'><i class='fa fa-edit'></i></a><span class='badge'></span></div></td></tr>");

				swal("Materia Creada!", "La materia "+data.materia+", fue creada con exito", "success");
			}
		}

	});

});


$(document).on('click', '.edit-modal', function() {

	$('#title').text('Editar Materia');

	$('#id_materia').val($(this).data('id'));
	$('#nivel').val($(this).data('nivel'));
	$('#codigo').val($(this).data('codigo'));
	$('#materia').val($(this).data('materia'));
	$('#sigla').val($(this).data('sigla'));
	$('#detalle').val($(this).data('detalle'));

	$('.error_nivel').addClass('hidden');
	$('.error_codigo').addClass('hidden');
	$('.error_materia').addClass('hidden');
	$('.error_sigla').addClass('hidden');

	$('#b_Guardar').hide('400');
	$('#b_Modificar').show('400');

	if($(this).data('estado') == 'activo'){
		$('#b_Activo').hide('400');
		$('#b_Baja').show('400');	
	}else{
		$('#b_Activo').show('400');
		$('#b_Baja').hide('400');
	}

    setTimeout(function(){document.getElementById("nivel").focus();}, 500);

    $('#materias_Modal').modal('show');

});

$(document).on('click', '#b_Modificar', function(){

	$('.error_nivel').addClass('hidden');
	$('.error_codigo').addClass('hidden');
	$('.error_materia').addClass('hidden');
	$('.error_sigla').addClass('hidden');

	if($("#nivel").val().length == 0){
		$('.error_nivel').removeClass('hidden');
		$('.error_nivel').text("Ingrese un nivel válido de la Materia");
		document.getElementById("nivel").focus();
		return;
	}

	if($("#codigo").val().length == 0){
		$('.error_codigo').removeClass('hidden');
		$('.error_codigo').text("Ingrese un código válido de la Materia");
		document.getElementById("codigo").focus();
		return;
	}

	if($("#materia").val().length == 0){
		$('.error_materia').removeClass('hidden');
		$('.error_materia').text("Ingrese un nombre válido de la Materia");
		document.getElementById("materia").focus();
		return;
	}

	if($("#sigla").val().length == 0){
		$('.error_sigla').removeClass('hidden');
		$('.error_sigla').text("Ingrese una sigla válida de la Materia");
		document.getElementById("sigla").focus();
		return;
	}


	$.ajax({

		type: 'post',
		url: 'materiaEdit',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_materia': $("#id_materia").val(),
			'id_carrera': $("#id_carrera").val(),
			'materia': capitalize($("#materia").val()),
			'nivel': $("#nivel").val().toUpperCase(),
			'codigo': $("#codigo").val().toUpperCase(),
			'sigla': $("#sigla").val().toUpperCase(),
			'detalle': $("#detalle").val(),
		},
		success: function(data){

			if(data.errors){


				if(data.errors.nivel != undefined){
					$('.error_nivel').removeClass('hidden');
					$('.error_nivel').text(data.errors.nivel);
					document.getElementById("nivel").focus();
					return;
				}

				if(data.errors.codigo != undefined){
					$('.error_codigo').removeClass('hidden');
					$('.error_codigo').text(data.errors.codigo);
					document.getElementById("codigo").focus();
					return;
				}

				if(data.errors.materia != undefined){
					$('.error_materia').removeClass('hidden');
					$('.error_materia').text(data.errors.materia);
					document.getElementById("materia").focus();
					return;
				}

				if(data.errors.sigla != undefined){
					$('.error_sigla').removeClass('hidden');
					$('.error_sigla').text(data.errors.sigla);
					document.getElementById("sigla").focus();
					return;
				}

			}else{

				$('#materias_Modal').modal('hide');


				$('.tr_materias'+data.id_materia).replaceWith("<tr class='tr_materias"+data.id_materia+"'><td>"+data.nivel+"</td><td>"+data.codigo+"</td><td>"+data.materia+"</td><td>"+data.sigla+"</td><td>"+data.estado+"</td><td><div class='btn-group'><a class='pre-modal btn btn-delault' title='Ver Dependecias de: "+data.materia+"' data-id_materia='"+data.id_materia+"' data-id_carrera='"+data.id_carrera+"' data-codigo='"+data.codigo+"' data-materia='"+data.materia+"' data-nivel= '"+data.nivel+"' data-sigla= '"+data.sigla+"'><i class='fa fa-cog'></i></a><a class='edit-modal btn btn-delault' title='Editar Materia: "+data.materia+"' data-id='"+data.id_materia+"' data-codigo='"+data.codigo+"' data-materia='"+data.materia+"' data-nivel= '"+data.nivel+"' data-sigla= '"+data.sigla+"' data-detalle='"+data.detalle+"' data-estado='"+data.estado+"'><i class='fa fa-edit'></i></a><span class='badge'></span></div></td></tr>");

				swal("Materia Modificada!", "La materia "+data.materia+", fue modificada con exito", "success");
			}
		}

	});

	
});


$(document).on('click', '#b_Baja', function(){


	$.ajax({

		type: 'post',
		url: 'materiaEstado',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_materia': $("#id_materia").val(),
			'estado': 'baja',
		},
		success: function(data){

			if(data.errors){

			}else{

				$('#materias_Modal').modal('hide');


				$('.tr_materias'+data.id_materia).replaceWith("<tr class='tr_materias"+data.id_materia+"'><td>"+data.nivel+"</td><td>"+data.codigo+"</td><td>"+data.materia+"</td><td>"+data.sigla+"</td><td>"+data.estado+"</td><td><div class='btn-group'><a class='pre-modal btn btn-delault' title='Ver Dependecias de: "+data.materia+"' data-id_materia='"+data.id_materia+"'  data-id_carrera='"+data.id_carrera+"' data-codigo='"+data.codigo+"' data-materia='"+data.materia+"' data-nivel= '"+data.nivel+"' data-sigla= '"+data.sigla+"'><i class='fa fa-cog'></i></a><a class='edit-modal btn btn-delault' title='Editar Materia: "+data.materia+"' data-id='"+data.id_materia+"' data-codigo='"+data.codigo+"' data-materia='"+data.materia+"' data-nivel= '"+data.nivel+"' data-sigla= '"+data.sigla+"' data-detalle='"+data.detalle+"' data-estado='"+data.estado+"'><i class='fa fa-edit'></i></a><span class='badge'></span></div></td></tr>");

				swal("Estado de Materia Modificada!", "El estado de la materia "+data.materia+", fue modificada con exito", "success");
			}
		}
	});
});

$(document).on('click', '#b_Activo', function(){


	$.ajax({

		type: 'post',
		url: 'materiaEstado',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_materia': $("#id_materia").val(),
			'estado': 'activo',
		},
		success: function(data){

			if(data.errors){

			}else{

				$('#materias_Modal').modal('hide');


				$('.tr_materias'+data.id_materia).replaceWith("<tr class='tr_materias"+data.id_materia+"'><td>"+data.nivel+"</td><td>"+data.codigo+"</td><td>"+data.materia+"</td><td>"+data.sigla+"</td><td>"+data.estado+"</td><td><div class='btn-group'><a class='pre-modal btn btn-delault' title='Ver Dependecias de: "+data.materia+"' data-id_materia='"+data.id_materia+"' data-id_carrera='"+data.id_carrera+"' data-codigo='"+data.codigo+"' data-materia='"+data.materia+"' data-nivel= '"+data.nivel+"' data-sigla= '"+data.sigla+"'><i class='fa fa-cog'></i></a><a class='edit-modal btn btn-delault' title='Editar Materia: "+data.materia+"' data-id='"+data.id_materia+"' data-codigo='"+data.codigo+"' data-materia='"+data.materia+"' data-nivel= '"+data.nivel+"' data-sigla= '"+data.sigla+"' data-detalle='"+data.detalle+"' data-estado='"+data.estado+"'><i class='fa fa-edit'></i></a><span class='badge'></span></div></td></tr>");

				swal("Estado de Materia Modificada!", "El estado de la materia "+data.materia+", fue modificada con exito", "success");
			}
		}
	});
});


$(document).on('click', '.pre-modal', function() {

	id_materia= $(this).data('id_materia');

	$('#searchMateria').val('');

	$('#pre_title').text('Pre-requisitos de Materia: '+$(this).data('materia'));


	$('#tabla_dependencias').replaceWith("<table id='tabla_dependencias' class='table table-hover table-bordered table-striped'><tr class='info'><th class='col-md-1'>Nivel</th><th class='col-md-2'>Código</th><th class='col-md-7'>Materia</th><th class='col-md-1'>Sigla</th><th class='col-md-1'></th></tr></table>");

	$.ajax({

		type: 'post',
		url: 'materia_listaDependientes',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_carrera': $(this).data('id_carrera'),
			'id_materia': $(this).data('id_materia'),
		},
		success: function(data){


			for(i=0; i < data.length; i++){

				var text_contenedor= "<tr class='tr_depmat"+data[i].id_materia+"'><td>"+data[i].nivel+"</td><td>"+data[i].codigo+"</td><td>"+data[i].materia+"</td><td>"+data[i].sigla+"</td><td>";

				if(data[i].cantidad == '0')
					text_contenedor= text_contenedor+"<button id='b"+data[i].id_materia+"' class='click_materia btn btn-block btn-default btn-xs' data-id_materia='"+data[i].id_materia+"' data-id_padre='"+id_materia+"' data-cantidad='"+data[i].cantidad+"'>NO</button>";
				else text_contenedor= text_contenedor+"<button id='b"+data[i].id_materia+"' class='click_materia btn btn-block btn-success btn-xs' data-id_materia='"+data[i].id_materia+"' data-id_padre='"+id_materia+"' data-cantidad='"+data[i].cantidad+"'>SI</button>";

				text_contenedor= text_contenedor+"</td></tr>"

				$('#tabla_dependencias').append(text_contenedor);


			}
		}
	});

	setTimeout(function(){document.getElementById("searchMateria").focus();}, 500);

    $('#dependencias_Modal').modal('show');

});

function searchMateria(){

	var input, filter, table, tr, td, i;

	input = document.getElementById("searchMateria");
	filter = input.value.toUpperCase();

	table = document.getElementById("tabla_dependencias");
	tr = table.getElementsByTagName("tr");


	for(i=0; i < tr.length; i++){

		td= tr[i].getElementsByTagName("td")[2];

		if (td) {
			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			} else {
        		tr[i].style.display = "none";
      		}
    	} 
	}

}

$(document).on('click', '.click_materia', function(){

	id_materia= $(this).data('id_materia');
	id_padre= $(this).data('id_padre');
	cantidad= $(this).data('cantidad');

	$.ajax({

		type: 'post',
		url: 'materia_dependencia',
		data: {
			'_token': $('input[name=_token]').val(),
			'id_padre': id_padre,
			'id_materia': id_materia,
			'cantidad': cantidad,
		},
		success: function(data){

			if(cantidad == 0){
				$('#b'+id_materia).replaceWith("<button id='b"+id_materia+"' class='click_materia btn btn-block btn-success btn-xs' data-id_materia='"+id_materia+"' data-id_padre='"+id_padre+"' data-cantidad='1'>SI</button>");

			swal("Materia Dependiente Asignada!", "La materia "+id_materia+", cuenta con esta dependencia.", "success");

			}else { $('#b'+id_materia).replaceWith("<button id='b"+id_materia+"' class='click_materia btn btn-block btn-default btn-xs' data-id_materia='"+id_materia+"' data-id_padre='"+id_padre+"' data-cantidad='0'>NO</button>");

			swal("Materia Dependiente Retirada!", "La materia "+id_materia+", no cuenta con esta dependencia.", "error");
			}
		}
	});
});

</script>

@endsection
