@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Roles
@endsection

@section('contentheader_title')
	Roles
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		
		<a class="btn btn-primary" href="{{route('roles.create')}}">
            <i class="fa fa-plus"></i> Nuevo Rol
      	</a>
	</div>
	<br>
	<section class="content">
		<div class="row">
			

			@foreach($roles as $rol)
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="box box-info box-solid">

						<div class="box-header with-border">
		                  <h6 class="box-title">Rol: {{$rol->rol}} </h6>
		                  <div class="box-tools">

		                  	<div class="btn-group ">
	                  			<a class="btn btn-delault" data-toggle="tooltip" title="Administrar: {{$rol->rol}}" href="{{route('adminTareasRoles',['id'=>$rol->id_rol])}}">
	                				<i class="fa fa-cog"></i>
	              				</a>
	              				<a class="btn btn-delault" data-toggle="tooltip" title="Editar Rol: {{$rol->rol}}" href="{{route('roles.edit',['id'=>$rol->id_rol])}}">
	                				<i class="fa fa-edit"></i>
	              				</a>

	              				<a class="btn btn-delault" data-toggle="tooltip" title="Eliminar Rol: {{$rol->rol}}" href="#message_delete{{$rol->id_rol}}" data-toggle="modal">
                					<i class="fa fa-trash"></i>
              					</a>

              					<div class="modal fade" id="message_delete{{$rol->id_rol}}" tabindex="-1" role="dialog">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content modal-info">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title">Eliminar Rol: {{$rol->rol}}</h4>
								      </div>
								      <div class="modal-body">
								        <p>Esta seguro de eliminar el Rol {{$rol->rol}}, del sistema?</p>
								      </div>
								      <div class="modal-footer">
								        
								        {!! Form::open(['route' => ['roles.destroy', $rol->id_rol], 'method' => 'delete'])!!}
								        	<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
								        	<button type="submit" class="btn btn-primary">Eliminar</button>
								        {!! Form::close()!!}
								      </div>
								    </div><!-- /.modal-content -->
								  </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
	              			</div>

	              				<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		                  </div>
		                </div><!-- /.box-header -->
		                @if($rol->cantidad != 0)
		                	<div class="box-body">
		                		@foreach($funciones as $funcion)

		                			@if($rol->id_rol == $funcion->id_rol)
		                				<strong>{{$funcion->funcion}}</strong>
		                				<UL>
		                					@foreach($tareas as $tarea)
		                						@if($rol->id_rol == $tarea->id_rol && $tarea->id_funcion == $funcion->id_funcion)
		                							<LI>
		                								{{$tarea->tarea}}
	                								</LI>
		                						@endif
		                					@endforeach	
		                				</UL>
		                			@endif
		                		@endforeach
                			</div><!-- /.box-body -->
		                @endif
					</div>
				</div>

			@endforeach
			
		</div>
	</section>
@endsection
