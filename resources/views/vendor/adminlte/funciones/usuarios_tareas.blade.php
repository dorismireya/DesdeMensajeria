@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Admin Tareas {{$usuario->name}}
@endsection

@section('contentheader_title')
	Administrador de Tareas del Usuario: {{$usuario->name}}
@endsection

@section('main-content')


<div class="container">
<div class="row">
	<div class="col-md-6 col-md-offset-3" >

	{!! Form::open(['route' => ['usuariostareas.update',$usuario->id], 'method' => 'put']) !!}

	@foreach($funciones as $funcion)
		
            
	    <div class="box box-info box-solid">
	        <div class="box-header with-border">
	          <h3 class="box-title">{{$funcion->funcion}}</h3>
	          <div class="box-tools">
	            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	          </div>
	        </div>
	        <div class="box-body no-padding">

				<table class="table table-hover table-striped">
              		<tbody>

              			@foreach($tareas as $tarea)

		      				@if($funcion->id_funcion == $tarea->id_funcion)
                        		<tr>
                         			
                          			<td class="mailbox-subject col-md-10"><b>{{$tarea->tarea}}</b> {{$tarea->detalle}}</td>
                          			<td class="col-md-2">

                          				<input type="checkbox" id="{{$tarea->id_tarea}}" name="checkbox[]" value="{{$tarea->id_tarea}}" {{$tarea->cantidad != 0 ? 'checked="checked"':''}}>
                      				</td>
                        		</tr>
                    		@endif
		        		@endforeach
                    </tbody>
                </table>



	          
	        </div><!-- /.box-body -->

      	</div><!-- /. box -->

		

	@endforeach

	<div class="box-footer">
      
      <a class="btn btn-default" href="{{route('usuarios.index')}}">
        <i class="fa fa-close"></i> Cancelar
      </a>

      
      <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Guardar</button>
    </div><!-- /.box-footer -->
	{!! Form::close() !!}
	</div>
</div>
</div>

@endsection
