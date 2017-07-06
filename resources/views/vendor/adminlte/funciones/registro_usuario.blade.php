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

                    </div>{!! Form::close()!!}
                  </div>

	        	
	        

	    </div><!-- /.box-header -->
	    <div class="box-body table-responsive no-padding">
	      <table class="table table-hover table-bordered table-striped">
	        <tr class="info">
	          <th class="col-md-4">Nombre</th>
	          <th class="col-md-4">Email</th>
	          <th class="col-md-2"> </th>
	         
	        </tr>
	        <tbody>
	        	@foreach($usuarios as $usuario)
			        <tr>
			          <td>{{$usuario->name}}</td>
			          <td>{{$usuario->email}}</td>
			          <td>
			          	<div class="btn-group">
			      			<a class="btn btn-delault"  title="Activar Usuario: {{$usuario->name}}" href="#modal_activar{{$usuario->id}}" data-toggle="modal">
			    				<i class="fa fa-check"></i>
			  				</a>

			  				<div class="modal fade" id="modal_activar{{$usuario->id}}" tabindex="-1" role="dialog">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title">Usuario: {{$usuario->name}}</h4>
							      </div>
								      {!! Form::open(['route' => ['registrousuario.update', $usuario->id], 'method' => 'put'])!!}
									      <div class="modal-body">
									      	
									      	<p>Seleccione el <strong>Rol</strong> para el usuario: <strong>{{$usuario->name}}</strong></p>

									      	<div class="form-group">
									            {!! Form::label('rol', 'Rol', ['class' => 'col-sm-2 control-label']) !!} 
									            <div class="col-sm-10">
									            	<select class="form-control m-bot15" name="rol">
										                @if($roles->count() > 0)
										                  @foreach($roles as $r)
										                    <option  value="{{$r->id_rol}}">{{$r->rol}}</option>
										                  @endForeach
										                @else
										                  No existe roles
										                @endif   
										            </select>
									            </div>
									          </div>
									        
									      </div>
									      <br>
									      <div class="modal-footer">
									        
									        
									        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									        	<button type="submit" class="btn btn-primary">Guardar</button>
									        
									      </div>
								      {!! Form::close()!!}
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->


			  				<a class="btn btn-delault" title="Eliminar Usuario: {{$usuario->name}}" href="#modal_delete{{$usuario->id}}" data-toggle="modal">
			    				<i class="fa fa-trash"></i>
			  				</a>

			  				


							<div class="modal fade" id="modal_delete{{$usuario->id}}" tabindex="-1" role="dialog">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title">Usuario: {{$usuario->name}}</h4>
							      </div>
								      {!! Form::open(['route' => ['registrousuario.destroy', $usuario->id], 'method' => 'delete'])!!}
									      <div class="modal-body">
									      	
									      	<p>Desea eliminar al Usuario: <strong>{{$usuario->name}}</strong></p>

									      	<div class="form-group">
							            	{{Form::hidden('estado','activo')}}
									        
									      	</div>
									      	<br>
									      	<div class="modal-footer">
									        
									        
									        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									        	<button type="submit" class="btn btn-primary">Eliminar</button>
									        
									      </div>
								      {!! Form::close()!!}
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->



			  			</div>
			          </td>
			        </tr>
		        @endforeach
	        </tbody>
	       
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

@endsection
