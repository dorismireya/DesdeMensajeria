@extends('adminlte::layouts.app')

@section('htmlheader_title')
	funciones
@endsection

@section('contentheader_title')
	Funciones
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		
		<a class="btn btn-primary" href="{{route('funciones.create')}}">
            <i class="fa fa-plus"></i> Nueva Función
      	</a>
	</div>
	<br>

	@foreach($arreglos as $arreglo)
		@if($arreglo[0] == 'funcion')
			<div class="row">
				<div class="col-xs-10 col-md-offset-1">
	  				<div class="box box-info box-solid ">
		                <div class="box-header ">
		                  <h3 class="box-title">Función: {{$arreglo[2]}} </h3>
		                  <div class="box-tools">

		                  	<div class="btn-group">
	                  			<a class="btn btn-delault" data-toggle="tooltip" title="Nueva Tarea para la función: {{$arreglo[2]}}" href="{{route('tareasCrear',['funcion' => $arreglo[2]])}}">
	                				<i class="fa fa-plus"></i>
	              				</a>
	              				<a class="btn btn-delault" data-toggle="tooltip" title="Editar Funcion: {{$arreglo[2]}}" href="{{route('funciones.edit',['id'=>$arreglo[1]])}}">
	                				<i class="fa fa-edit"></i>
	              				</a>
	              				@if($arreglo[6]== 0)
	              					<a class="btn btn-delault" data-toggle="tooltip" title="Eliminar Función: {{$arreglo[2]}}" href="#message_delete{{$arreglo[1]}}" data-toggle="modal">
	                					<i class="fa fa-trash"></i>
	              					</a>

	              					<div class="modal fade" id="message_delete{{$arreglo[1]}}" tabindex="-1" role="dialog">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content modal-info">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        <h4 class="modal-title">Eliminar Función: {{$arreglo[2]}}</h4>
									      </div>
									      <div class="modal-body">
									        <p>Esta seguro de eliminar la función {{$arreglo[2]}}, del sistema?</p>
									      </div>
									      <div class="modal-footer">
									        
									        {!! Form::open(['route' => ['funciones.destroy', $arreglo[1]], 'method' => 'delete'])!!}
									        	<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
									        	<button type="submit" class="btn btn-primary">Eliminar</button>
									        {!! Form::close()!!}
									      </div>
									    </div><!-- /.modal-content -->
									  </div><!-- /.modal-dialog -->
									</div><!-- /.modal -->

              					@endif
	              			</div>
		                  </div>
		                </div><!-- /.box-header -->

		                @if($arreglo[6] != 0)

		                	<div class="box-body table-responsive no-padding">
		                  		<table class="table table-striped table-hover">
				                    <tr class="info">
				                      <th class="col-md-2">Tarea</th>
				                      <th class="col-md-2">Vista</th>
				                      <th class="col-md-6">Detalle</th>
				                      <th class="col-md-2">
				                      </th>
				                    </tr>
		                	
									@foreach($arreglos as $tarea)
								
										@if($tarea[0] == 'tarea' && $tarea[6] == $arreglo[1])
											
											<tr>
						                      	<td>{{$tarea[2]}}</td>
						                      	<td>{{$tarea[3]}}</td>
						                      	<td>{{$tarea[5]}}</td>
						                      	<td>
						                      		<div class="btn-group">
						                      			<a class="btn btn-delault" data-toggle="tooltip" title="Ver usuarios" href="{{route('adminTareasUsuarios',['id'=>$tarea[1]])}}">
						                    				<i class="fa fa-users"></i>
						                  				</a>
						                  				<a class="btn btn-delault" data-toggle="tooltip" title="Editar Tarea: {{$tarea[2]}}" href="{{route('tareas.edit',['id'=>$tarea[1]])}}">
						                    				<i class="fa fa-edit"></i>
						                  				</a>
						                  				<a class="btn btn-delault" data-toggle="tooltip" title="Eliminar Tarea: {{$tarea[2]}}" href="#delete_tarea{{$tarea[1]}}" data-toggle="modal">
						                    				<i class="fa fa-trash"></i>
						                  				</a>

						                  				<div class="modal fade" id="delete_tarea{{$tarea[1]}}" tabindex="-1" role="dialog">
														  <div class="modal-dialog" role="document">
														    <div class="modal-content">
														      <div class="modal-header">
														        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														        <h4 class="modal-title">Eliminar Tarea: {{$tarea[2]}}</h4>
														      </div>
														      <div class="modal-body">
														        <p>Esta seguro de eliminar la tarea <strong>{{$tarea[2]}}</strong>, del sistema?</p>
														      </div>
														      <div class="modal-footer">
														        
														        {!! Form::open(['route' => ['destroyTarea', $tarea[1]], 'method' => 'delete'])!!}
														        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
														        	<button type="submit" class="btn btn-primary">Eliminar</button>
														        {!! Form::close()!!}
														      </div>
														    </div><!-- /.modal-content -->
														  </div><!-- /.modal-dialog -->
														</div><!-- /.modal -->
						                  			</div>
						                      	</td>
						                    </tr>
									

										@endif

									@endforeach

								</table>
		                	</div><!-- /.box-body -->
	                	@endif
              		</div><!-- /.box -->
	            </div>
     	 	</div>

		@endif
		
	@endforeach

@endsection
