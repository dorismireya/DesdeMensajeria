@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Administrador Publicaciones
@endsection

@section('contentheader_title')
	Administrador Usuarios Publicaciones
@endsection


@section('main-content')

<div class="row">

	<div class="col-md-3">

		<ul class="list-group" >
		  <li class="list-group-item active">Usuarios</li>

		  @foreach($users as $user)

		  	<li id="li{{$user->id}}" class="user_list list-group-item" data-id="{{$user->id}}" style="font-size:90%;">
		  		{{$user->name}}
			</li>

		  @endforeach

		</ul>
	</div>
	<div id="div_facultad" class="col-md-3 hidden">
		<ul id="ul_facultad" class="list-group">
			<li class="list-group-item active" style="font-size:90%;">Facultad</li>
		</ul>
		<ul id="ul_importancia" class="list-group">
			<li class="list-group-item active" style="font-size:90%;">Importancia</li>
		</ul>
		<ul id="ul_tp" class="list-group">
			<li class="list-group-item active" style="font-size:90%;">Tipo Publicacion</li>
		</ul>
	</div>
	<div id="div_carrera" class="col-md-3 hidden">
		<ul id="ul_carrera" class="list-group">
			<li class="list-group-item active" style="font-size:90%;">Carreras</li>
		</ul>
	</div>
	<div id="div_materia" class="col-md-3 hidden">
		<ul id="ul_materia" class="list-group">
			<li class="list-group-item active" style="font-size:90%;">Materias</li>
		</ul>
	</div>
</div>
{{ csrf_field() }}

<script type="text/javascript">



$(document).on('click', '.user_list', function() {

	$('.user_list').removeClass('list-group-item-info');
	$('#li'+$(this).data('id')).addClass('list-group-item-info');

	id_usuario= $(this).data('id');

	$.ajax({

		type: 'post',
		url: 'userPublicacion_Facultad',
		data: {
			'_token': $('input[name=_token]').val(),
			'id': $(this).data('id'),
		},
		success: function(data){

			$('#div_carrera').addClass('hidden');
			$('#div_materia').addClass('hidden');
			$('#div_facultad').removeClass('hidden');

			loadInfo="<ul id='ul_facultad' class='list-group'><li class='list-group-item active' style='font-size:90%;'>Facultad</li>";

			for(i=0; i < data.length; i++){

				loadInfo= loadInfo + "<li id='fac"+data[i].id_facultad+"' class='facultad_list list-group-item' data-id='"+id_usuario+"' data-id_facultad='"+data[i].id_facultad+"' style='font-size:90%;'>";
				loadInfo= loadInfo + data[i].facultad;
				loadInfo= loadInfo + "<span class='pull-right'>";

				if(data[i].cantidad == 0){
					loadInfo= loadInfo + "<button id='bf"+data[i].id_facultad+"' class='b_facultad btn btn-xs btn-default' data-id='"+id_usuario+"' data-id_facultad='"+data[i].id_facultad+"' data-tipo='si' >";
					loadInfo= loadInfo+ "NO";
				}
				else {
					loadInfo= loadInfo + "<button id='bf"+data[i].id_facultad+"' class='b_facultad btn btn-xs btn-success' data-id='"+id_usuario+"' data-id_facultad='"+data[i].id_facultad+"' data-tipo='no'>";
					loadInfo= loadInfo + "SI";
				}	
				loadInfo= loadInfo + "</button></span></li>";
			}

			loadInfo= loadInfo + "</ul>";

			

			$('#ul_facultad').replaceWith(loadInfo);
		}

	});

	$.ajax({
		type: 'post',
		url: 'userPublicacion_Importancia',
		data: {
			'_token': $('input[name=_token]').val(),
			'id': $(this).data('id'),
		},
		success: function(data){

			loadInfo="<ul id='ul_importancia' class='list-group'><li class='list-group-item active' style='font-size:90%;'> Importancia</li>";

			for(i=0; i < data.length; i++){

				loadInfo= loadInfo + "<li id='imp"+data[i].id_importancia+"' class='importancia_list list-group-item' data-id='"+id_usuario+"' data-id_importancia='"+data[i].id_importancia+"' style='font-size:90%;'>";
				loadInfo= loadInfo + data[i].importancia;
				loadInfo= loadInfo + "<span class='pull-right'>";

				if(data[i].cantidad == 0){
					loadInfo= loadInfo + "<button id='bi"+data[i].id_importancia+"' class='b_importancia btn btn-xs btn-default' data-id='"+id_usuario+"' data-id_importancia='"+data[i].id_importancia+"' data-tipo='si' >";
					loadInfo= loadInfo+ "NO";
				}
				else {
					loadInfo= loadInfo + "<button id='bi"+data[i].id_importancia+"' class='b_importancia btn btn-xs btn-success' data-id='"+id_usuario+"' data-id_importancia='"+data[i].id_importancia+"' data-tipo='no'>";
					loadInfo= loadInfo + "SI";
				}	
				loadInfo= loadInfo + "</button></span></li>";
			}

			loadInfo= loadInfo + "</ul>";

			$('#ul_importancia').replaceWith(loadInfo);
		}
	});

	$.ajax({
		type: 'post',
		url: 'userPublicacion_Tipo',
		data: {
			'_token': $('input[name=_token]').val(),
			'id': $(this).data('id'),
		},
		success: function(data){

			loadInfo="<ul id='ul_tp' class='list-group'><li class='list-group-item active' style='font-size:90%;'> Tipo Publicacion</li>";

			for(i=0; i < data.length; i++){

				loadInfo= loadInfo + "<li id='tp"+data[i].id_ftp+"' class='tp_list list-group-item' data-id='"+id_usuario+"' data-id_ftp='"+data[i].id_ftp+"' style='font-size:90%;'>";
				loadInfo= loadInfo + data[i].tipo;
				loadInfo= loadInfo + "<span class='pull-right'>";

				if(data[i].cantidad == 0){
					loadInfo= loadInfo + "<button id='btp"+data[i].id_ftp+"' class='b_tp btn btn-xs btn-default' data-id='"+id_usuario+"' data-id_ftp='"+data[i].id_ftp+"' data-tipo='si' >";
					loadInfo= loadInfo+ "NO";
				}
				else {
					loadInfo= loadInfo + "<button id='btp"+data[i].id_ftp+"' class='b_tp btn btn-xs btn-success' data-id='"+id_usuario+"' data-id_ftp='"+data[i].id_ftp+"' data-tipo='no'>";
					loadInfo= loadInfo + "SI";
				}	
				loadInfo= loadInfo + "</button></span></li>";
			}

			loadInfo= loadInfo + "</ul>";

			$('#ul_tp').replaceWith(loadInfo);
		}
	});
	
});

$(document).on('click','.b_facultad', function(){

	id= $(this).data('id');
	id_facultad= $(this).data('id_facultad');
	tipo= $(this).data('tipo');

	$.ajax({

		type: 'post',
		url: 'userPublicacion_FacultadInsert',
		data: {
			'_token': $('input[name=_token]').val(),
			'id': id,
			'id_facultad': id_facultad,
			'tipo': tipo,
		},
		success: function(data){

			loadInfo="";

			if(tipo== "si"){

				loadInfo= loadInfo + "<button id='bf"+id_facultad+"' class='b_facultad btn btn-xs btn-success' data-id='"+id+"' data-id_facultad='"+id_facultad+"' data-tipo='no' >";
				loadInfo= loadInfo+ "SI";
			}else{
				loadInfo= loadInfo + "<button id='bf"+id_facultad+"' class='b_facultad btn btn-xs btn-default' data-id='"+id+"' data-id_facultad='"+id_facultad+"' data-tipo='si' >";
				loadInfo= loadInfo+ "NO";
			}

			loadInfo= loadInfo + "</button>";

			$('#bf'+id_facultad).replaceWith(loadInfo);
		}

	});
});


$(document).on('click','.b_importancia', function(){

	id= $(this).data('id');
	id_importancia= $(this).data('id_importancia');
	tipo= $(this).data('tipo');

	$.ajax({

		type: 'post',
		url: 'userPublicacion_ImportanciaInsert',
		data: {
			'_token': $('input[name=_token]').val(),
			'id': id,
			'id_importancia': id_importancia,
			'tipo': tipo,
		},
		success: function(data){

			loadInfo="";

			if(tipo== "si"){

				loadInfo= loadInfo + "<button id='bi"+id_importancia+"' class='b_importancia btn btn-xs btn-success' data-id='"+id+"' data-id_importancia='"+id_importancia+"' data-tipo='no' >";
				loadInfo= loadInfo+ "SI";
			}else{
				loadInfo= loadInfo + "<button id='bi"+id_importancia+"' class='b_importancia btn btn-xs btn-default' data-id='"+id+"' data-id_importancia='"+id_importancia+"' data-tipo='si' >";
				loadInfo= loadInfo+ "NO";
			}

			loadInfo= loadInfo + "</button>";

			$('#bi'+id_importancia).replaceWith(loadInfo);
		}

	});
});


$(document).on('click','.b_tp', function(){

	id= $(this).data('id');
	id_ftp= $(this).data('id_ftp');
	tipo= $(this).data('tipo');

	$.ajax({

		type: 'post',
		url: 'userPublicacion_TipoInsert',
		data: {
			'_token': $('input[name=_token]').val(),
			'id': id,
			'id_ftp': id_ftp,
			'tipo': tipo,
		},
		success: function(data){

			loadInfo="";

			if(tipo== "si"){

				loadInfo= loadInfo + "<button id='btp"+id_ftp+"' class='b_tp btn btn-xs btn-success' data-id='"+id+"' data-id_ftp='"+id_ftp+"' data-tipo='no' >";
				loadInfo= loadInfo+ "SI";
			}else{
				loadInfo= loadInfo + "<button id='btp"+id_ftp+"' class='b_tp btn btn-xs btn-default' data-id='"+id+"' data-id_ftp='"+id_ftp+"' data-tipo='si' >";
				loadInfo= loadInfo+ "NO";
			}

			loadInfo= loadInfo + "</button>";

			$('#btp'+id_ftp).replaceWith(loadInfo);
		}

	});
});


$(document).on('click', '.facultad_list', function() {

	$('.facultad_list').removeClass('list-group-item-info');
	$('#fac'+$(this).data('id_facultad')).addClass('list-group-item-info');

	id_usuario= $(this).data('id');
	id_facultad= $(this).data('id_facultad');

	$.ajax({

		type: 'post',
		url: 'userPublicacion_Carrera',
		data: {
			'_token': $('input[name=_token]').val(),
			'id': id_usuario,
			'id_facultad': id_facultad,
		},
		success: function(data){

			$('#div_materia').addClass('hidden');
			$('#div_carrera').removeClass('hidden');

			loadInfo="<ul id='ul_carrera' class='list-group'><li class='list-group-item active' style='font-size:90%;'>Carreras</li>";

			for(i=0; i < data.length; i++){

				loadInfo= loadInfo + "<li id='car"+data[i].id_carrera+"' class='carrera_list list-group-item' data-id='"+id_usuario+"' data-id_facultad='"+id_facultad+"' data-id_carrera='"+data[i].id_carrera+"' style='font-size:80%;'>";
				loadInfo= loadInfo + data[i].carrera.substring(0,30);
		        if(data[i].carrera.length >= 30)
		          loadInfo= loadInfo + "..";
				loadInfo= loadInfo + "<span class='pull-right'>";

				if(data[i].cantidad == 0){
					loadInfo= loadInfo + "<button id='bc"+data[i].id_carrera+"' class='b_carrera btn btn-xs btn-default' data-id='"+id_usuario+"' data-id_facultad='"+id_facultad+"' data-id_carrera='"+data[i].id_carrera+"' data-tipo='si' >";
					loadInfo= loadInfo+ "NO";
				}
				else {
					loadInfo= loadInfo + "<button id='bc"+data[i].id_carrera+"' class='b_carrera btn btn-xs btn-success' data-id='"+id_usuario+"' data-id_facultad='"+id_facultad+"' data-id_carrera='"+data[i].id_carrera+"' data-tipo='no'>";
					loadInfo= loadInfo + "SI";
				}	
				loadInfo= loadInfo + "</button></span></li>";
			}

			loadInfo= loadInfo + "</ul>";

			

			$('#ul_carrera').replaceWith(loadInfo);
		}

	});
});

$(document).on('click','.b_carrera', function(){

	id= $(this).data('id');
	id_facultad= $(this).data('id_facultad');
	id_carrera= $(this).data('id_carrera');
	tipo= $(this).data('tipo');

	$.ajax({

		type: 'post',
		url: 'userPublicacion_CarreraInsert',
		data: {
			'_token': $('input[name=_token]').val(),
			'id': id,
			'id_carrera': id_carrera,
			'tipo': tipo,
		},
		success: function(data){

			loadInfo="";

			if(tipo == "si"){
				loadInfo= loadInfo + "<button id='bc"+id_carrera+"' class='b_carrera btn btn-xs btn-success' data-id='"+id+"' data-id_facultad='"+id_facultad+"' data-id_carrera='"+id_carrera+"' data-tipo='no' >";
				loadInfo= loadInfo+ "SI";
			}
			else {
				loadInfo= loadInfo + "<button id='bc"+id_carrera+"' class='b_carrera btn btn-xs btn-default' data-id='"+id+"' data-id_facultad='"+id_facultad+"' data-id_carrera='"+id_carrera+"' data-tipo='si'>";
				loadInfo= loadInfo + "NO";
			}

			loadInfo= loadInfo + "</button>";

			$('#bc'+id_carrera).replaceWith(loadInfo);
		}

	});
});


$(document).on('click', '.carrera_list', function() {

	$('.carrera_list').removeClass('list-group-item-info');
	$('#car'+$(this).data('id_carrera')).addClass('list-group-item-info');

	id_usuario= $(this).data('id');
	id_facultad= $(this).data('id_facultad');
	id_carrera= $(this).data('id_carrera');

	$.ajax({

		type: 'post',
		url: 'userPublicacion_Materia',
		data: {
			'_token': $('input[name=_token]').val(),
			'id': id_usuario,
			'id_facultad': id_facultad,
			'id_carrera': id_carrera,
		},
		success: function(data){

			$('#div_materia').removeClass('hidden');

			loadInfo="<ul id='ul_materia' class='list-group'><li class='list-group-item active' style='font-size:90%;'>Materias</li>";

			for(i=0; i < data.length; i++){

				loadInfo= loadInfo + "<li id='mat"+data[i].id_materia+"' class='list-group-item' data-id_materia='"+data[i].id_materia+"' style='font-size:80%;'>";
				loadInfo= loadInfo + data[i].materia.substring(0,25);
		        if(data[i].materia.length >= 25)
		          loadInfo= loadInfo + "..";
				loadInfo= loadInfo + "<span class='pull-right'>";

				if(data[i].cantidad == 0){
					loadInfo= loadInfo + "<button id='bm"+data[i].id_materia+"' class='b_materia btn btn-xs btn-default' data-id='"+id_usuario+"' data-id_facultad='"+id_facultad+"' data-id_carrera='"+id_carrera+"' data-id_materia='"+data[i].id_materia+"' data-tipo='si' >";
					loadInfo= loadInfo+ "NO";
				}
				else {
					loadInfo= loadInfo + "<button id='bm"+data[i].id_materia+"' class='b_materia btn btn-xs btn-success' data-id='"+id_usuario+"' data-id_facultad='"+id_facultad+"' data-id_carrera='"+id_carrera+"' data-id_materia='"+data[i].id_materia+"' data-tipo='no'>";
					loadInfo= loadInfo + "SI";
				}	
				loadInfo= loadInfo + "</button></span></li>";
			}

			loadInfo= loadInfo + "</ul>";

			

			$('#ul_materia').replaceWith(loadInfo);
		}

	});
});

$(document).on('click','.b_materia', function(){

	id= $(this).data('id');
	id_facultad= $(this).data('id_facultad');
	id_carrera= $(this).data('id_carrera');
	id_materia= $(this).data('id_materia');
	tipo= $(this).data('tipo');

	$.ajax({

		type: 'post',
		url: 'userPublicacion_MateriaInsert',
		data: {
			'_token': $('input[name=_token]').val(),
			'id': id,
			'id_materia': id_materia,
			'tipo': tipo,
		},
		success: function(data){

			loadInfo="";

			if(tipo == "si"){
				loadInfo= loadInfo + "<button id='bm"+id_materia+"' class='b_materia btn btn-xs btn-success' data-id='"+id+"' data-id_facultad='"+id_facultad+"' data-id_carrera='"+id_carrera+"' data-id_materia='"+id_materia+"' data-tipo='no' >";
					loadInfo= loadInfo+ "SI";
			}
			else {
				loadInfo= loadInfo + "<button id='bm"+id_materia+"' class='b_materia btn btn-xs btn-default' data-id='"+id+"' data-id_facultad='"+id_facultad+"' data-id_carrera='"+id_carrera+"' data-id_materia='"+id_materia+"' data-tipo='si'>";
					loadInfo= loadInfo + "NO";	
			}

			loadInfo= loadInfo + "</button>";

			$('#bm'+id_materia).replaceWith(loadInfo);
		}

	});
});

</script>

@endsection
