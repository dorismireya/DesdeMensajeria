@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Registro Usuarios
@endsection

@section('contentheader_title')
	Registro Usuarios
@endsection


@section('main-content')

 
<div class="row">
	<div class="col-xs-10 col-md-offset-1">
	  	<div class="box box-info box-solid">
	    	<div class="box-header">
	      		<h3 class="box-title">Administración de Registro Usuarios</h3>
	        
				<div class="box-tools">{!! Form::open(['route'=>'registrosUsuariosSearch','method'=>'get', 'class'=>'pull-right'])!!}


                    <div class="input-group" style="width: 150px;">
                    	{!! Form::text('buscar',old('',Request::input('buscar')), ['class' => 'form-control input-sm pull-right', 'placeholder'=> 'Buscar...'])!!}
                      		<div class="input-group-btn">
                        		<button class="btn btn-sm btn-default" type="submit"><i class="fa fa-search"></i></button>
                      		</div>

                      	{!! Form::close()!!}

                    </div>
              	</div>
	    	</div><!-- /.box-header -->

	    	<div class="box-body table-responsive no-padding">
	      		<table class="table table-hover table-bordered table-striped">
	        		<tr class="info">
	          			<th class="col-md-4">Nombre</th>
	          			<th class="col-md-4">Email</th>
          				<th class="col-md-2"> </th>
	         
	        		</tr>
	        		@foreach($usuarios as $usuario)
			        	<tr id="tr{{$usuario->id}}" >
			          		<td>{{$usuario->name}}</td>
			          		<td>{{$usuario->email}}</td>
			          		<td>
		          				<div class="btn-group">
			      					<a class="activar_usuario btn btn-delault"  title="Activar Usuario: {{$usuario->name}}" data-toggle="tooltip" data-id="{{$usuario->id}}" data-name="{{$usuario->name}}">
			    						<i class="fa fa-check"></i>
			  						</a>

			  						<a class="delete_usuario btn btn-delault" title="Eliminar Usuario: {{$usuario->name}}" data-toggle="tooltip" data-id="{{$usuario->id}}" data-name="{{$usuario->name}}">
			    						<i class="fa fa-trash"></i>
			  						</a>
		  						</div>
			          		</td>
			        	</tr>
		        	@endforeach
	       
	      		</table>
	    	</div><!-- /.box-body -->
	    	<div class="box-footer clearfix">
	      		<ul class="pagination pagination-sm no-margin pull-right">
	        		{{$usuarios->links()}}
	      		</ul>
	    	</div>
	  	</div><!-- /.box -->
	</div>
</div>


{{ csrf_field() }}

<div class="activar_modal modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="titulo_usuario modal-title"></h4>
		    </div>
    		<div class="modal-body">
    			<form role="form">
    				<p>Seleccione el <strong>Rol</strong> para el usuario: <strong class='name_usuario'></strong></p>
					<div class="form-group">
						<label class="control-label col-sm-2" for="rol">Rol:</label>
						<div class="col-sm-10">
							<select class="form-control" id="rol">
								@if($roles->count() > 0)
									@foreach($roles as $r)
										<option  value="{{$r->id_rol}}">{{$r->rol}}</option>
									@endForeach
								@else
									No existe roles
								@endif
							</select>
							<div class="form-group has-error">
                                <label class="error_rol control-label hidden" for="rol"></label>
                            </div>
						</div>
					</div>
					<input type="hidden" id="id_modal" value="">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        	<button type="submit" class="b_activar_usuario btn btn-primary">Guardar</button>
								        
		    </div>
	    </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="delete_modal modal fade" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="titulod_usuario modal-title"></h4>
	      	</div>
	      	<div class="modal-body">
				<p>Desea eliminar al Usuario: <strong class="named_usuario"></strong></p>
				<input type="hidden" id="id_delete" value="">
			</div><!-- /.modal-body -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        	<button type="submit" class="b_delete_usuario btn btn-primary">Eliminar</button>
									        
	      	</div>
							    
	  	</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>


<script type="text/javascript">
	
$(document).on('click', '.activar_usuario', function(){

	$('.titulo_usuario').text('Usario: '+$(this).data('name'));
	$('.name_usuario').text($(this).data('name'));

	$('#id_modal').val($(this).data('id'));

	$('.activar_modal').modal('show');

});

$(document).on('click', '.b_activar_usuario', function(){

	$.ajax({

        type: 'post',
        url: 'activarUsuario',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#id_modal').val(),
            'id_rol': $('#rol').val(),
        },
        success: function(data){
        	$('.activar_modal').modal('hide');
        	$('#tr'+data.id).replaceWith('');

        	loadMensajes();

        	swal("Usuario activado", "El usuario: "+data.name+" se activo correctamente", "success");
        }

    });

});


$(document).on('click', '.delete_usuario', function(){

	$('.titulod_usuario').text('Usario: '+$(this).data('name'));
	$('.named_usuario').text($(this).data('name'));

	$('#id_delete').val($(this).data('id'));

	$('.delete_modal').modal('show');

});

$(document).on('click', '.b_delete_usuario', function(){

	$.ajax({

        type: 'post',
        url: 'eliminarUsuario',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#id_delete').val(),
        },
        success: function(data){
        	$('.delete_modal').modal('hide');
        	$('#tr'+data.id).replaceWith('');

        	loadMensajes();

        	swal("Usuario eliminado", "El usuario: "+data.name+" se elimino correctamente", "error");
        }

    });

});


</script>

@endsection
