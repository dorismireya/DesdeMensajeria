@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Usuarios
@endsection

@section('contentheader_title')
	Usuarios
@endsection


@section('main-content')

 
<div class="row">
	<div class="col-xs-10 col-md-offset-1">
	  <div class="box box-info box-solid">
	    <div class="box-header">
	      <h3 class="box-title">Administración de Usuarios</h3>
	        
				<div class="box-tools has-feedback">{!! Form::open(['route'=>'usuariossearch','method'=>'get', 'class'=>'pull-right'])!!}


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

                    </div>
                {!! Form::close()!!}
                  </div>

	        	
	        

	    </div><!-- /.box-header -->
	    <div class="box-body table-responsive no-padding">
	      <table class="table table-hover table-bordered table-striped">
	        <tr class="info">
	          <th class="col-md-3">Nombre</th>
	          <th class="col-md-3">Email</th>
	          <th class="col-md-2">Rol</th>
	          <th class="col-md-2">Estado</th>
	          <th class="col-md-2"> </th>
	         
	        </tr>
	        <tbody>
	        	@foreach($usuarios as $usuario)
			        <tr>
			          <td>{{$usuario->name}}</td>
			          <td>{{$usuario->email}}</td>
			          <td>{{$usuario->tipo}}</td>
			          <td>{{$usuario->estado}}</td>
			          <td>
			          	<div class="btn-group">
			      			<a class="btn btn-delault" data-toggle="tooltip" title="Administrar Tareas del Usuario: {{$usuario->name}}" href="{{route('adminUsuriosTareas',['id'=>$usuario->id])}}">
			    				<i class="fa fa-cog"></i>
			  				</a>
			  				<a class="btn btn-delault" title="Editar Usuario: {{$usuario->name}}" href="#modal_edit{{$usuario->id}}" data-toggle="modal">
			    				<i class="fa fa-edit"></i>
			  				</a>

			  				<div class="modal fade" id="modal_edit{{$usuario->id}}" tabindex="-1" role="dialog">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title">Usuario: {{$usuario->name}}</h4>
							      </div>
							      <div class="modal-body">
							        <p>Rol: {{$usuario->tipo}}</p>
							        <p>Email: {{$usuario->email}}</p>
							      </div>
							      <div class="modal-footer">

							      	<a class="btn btn-success" title="Editar Usuario: {{$usuario->name}}" href="#edit_pass{{$usuario->id}}" data-toggle="modal" data-dismiss="modal">
			    						<i class="fa fa-unlock"></i> Cambiar Password
			  						</a>
			  						<a class="btn btn-warning" title="Editar Usuario: {{$usuario->name}}" href="#edit_rol{{$usuario->id}}" data-toggle="modal" data-dismiss="modal">
			    						<i class="fa fa-exchange"></i> Cambiar Rol
			  						</a>
			  						<a class="btn btn-primary" title="Editar Usuario: {{$usuario->name}}" href="#edit_estado{{$usuario->id}}" data-toggle="modal" data-dismiss="modal">
			    						<i class="fa fa-star-half-empty"></i> Cambiar Estado
			  						</a>
							      </div>
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->

							<div class="modal fade" id="edit_pass{{$usuario->id}}" tabindex="-1" role="dialog">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title">Usuario: {{$usuario->name}}</h4>
							      </div>
								      {!! Form::open(['route' => ['usuarios.update', $usuario->id], 'method' => 'put'])!!}
									      <div class="modal-body">
									      	
									      	<p>Ingrese un nuevo Password para el usuario: <strong>{{$usuario->name}}</strong></p>

									      	<div class="form-group">
									            {!! Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) !!} 
									            <div class="col-sm-10">
									              {!! Form::text('password', null, ['class' => 'form-control', 'placeholder'=>'Ingrese nuevo password', 'required' => 'required']) !!}
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


							<div class="modal fade" id="edit_rol{{$usuario->id}}" tabindex="-1" role="dialog">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title">Usuario: {{$usuario->name}}</h4>
							      </div>
								      {!! Form::open(['route' => ['usuarios_rol', $usuario->id], 'method' => 'put'])!!}
									      <div class="modal-body">
									      	
									      	<p>Desea cambiar el <strong>Rol</strong> del usuario: <strong>{{$usuario->name}}</strong></p>

									      	<div class="form-group">
									            {!! Form::label('tipo', 'Rol', ['class' => 'col-sm-2 control-label']) !!} 
									            <div class="col-sm-10">
									            	<select class="form-control m-bot15" name="tipo">
										                @if($roles->count() > 0)
										                  @foreach($roles as $r)
										                    <option {{$r->rol === $usuario->tipo ? 'selected="selected"' : ''}} value="{{$r->id_rol}}">{{$r->rol}}</option>
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


							<div class="modal fade" id="edit_estado{{$usuario->id}}" tabindex="-1" role="dialog">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title">Usuario: {{$usuario->name}}</h4>
							      </div>
								      {!! Form::open(['route' => ['usuarios.update', $usuario->id], 'method' => 'put'])!!}
									      <div class="modal-body">
									      	
									      	<p>Desea dar de <strong>{{$usuario->estado == 'activo' ? 'baja' : 'alta'}}</strong> al Usuario: <strong>{{$usuario->name}}</strong></p>

									      	<div class="form-group">
									      		@if($usuario->estado == 'activo')
									            	{{Form::hidden('estado','baja')}}
								            	@else {{Form::hidden('estado','activo')}}
								            	@endif
									        
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
