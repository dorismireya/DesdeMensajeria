@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Admin Usuarios Tarea {{$tarea->tarea}}
@endsection

@section('contentheader_title')
	Administrador de Usuarios por Tarea: {{$tarea->tarea}}
@endsection

@section('main-content')


<div class="container">
<div class="row">
	<div class="col-md-6 col-md-offset-3" >

	{!! Form::open(['route' => ['tareasusuarios.update',$tarea->id_tarea], 'method' => 'put']) !!}

	@foreach($tipos as $tipo)
		
            
	    <div class="box box-info box-solid">
	        <div class="box-header with-border">
	          <h3 class="box-title">{{$tipo->tipo}}</h3>
	          <div class="box-tools">
	            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	          </div>
	        </div>
	        <div class="box-body no-padding">

				<table class="table table-hover table-striped">
              		<tbody>

              			@foreach($users as $user)

		      				@if($tipo->tipo == $user->tipo)
                        		<tr>
                         			
                          			<td class="mailbox-subject col-md-10"><b>{{$user->name}}</b></td>
                          			<td class="col-md-2">

                          				<input type="checkbox" id="{{$user->id}}" name="checkbox[]" value="{{$user->id}}" {{$user->cantidad != 0 ? 'checked="checked"':''}}>
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
      
      <a class="btn btn-default" href="{{route('adminFuncion.index')}}">
        <i class="fa fa-close"></i> Cancelar
      </a>

      
      <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Guardar</button>
    </div><!-- /.box-footer -->
	{!! Form::close() !!}
	</div>
</div>
</div>

@endsection
