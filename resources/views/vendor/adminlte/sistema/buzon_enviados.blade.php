@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Buzon
@endsection

@section('contentheader_title')
	Buzon Enviados
@endsection


@section('main-content')

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Mensajes</h3>
				<div class="box-tools pull-right">
					{!! Form::open(['route'=>'mensajesEnviadosSearch','method'=>'get', 'class'=>'navbar-form navbar-right'])!!}

						<div class="form-group">
							{!! Form::text('buscar',old('',Request::input('buscar')), ['class' => 'search_input form-control input-sm', 'placeholder'=> 'Buscar...'])!!}
						</div>

						<button class="btn btn-sm btn-default" type="submit"><i class="fa fa-search"></i></button>
					
					{!! Form::close()!!}
				</div>
			</div>
			<div class="box-body no-padding">
				<div class="table-responsive mailbox-messages">
					<table class="table table-hover table-striped">
						<tbody>
							@foreach($mensajes as $mensaje)
								<tr id="tr{{$mensaje->id_mensaje}}" class="seleccionado" data-id_mensaje="{{$mensaje->id_mensaje}}" data-asunto="{{$mensaje->asunto}}" data-para="{{$mensaje->name}}" data-mensaje="{{$mensaje->mensaje}}" data-fecha="{{$mensaje->fecha}}">
									<td class="col-md-3 mailbox-name">{{substr($mensaje->name, 0, 90)}}</td>
									<td class="col-md-7 mailbox-subject">{{substr($mensaje->asunto, 0, 90)}}</td>
									<td class="col-md-2 mailbox-date">{{Carbon\Carbon::parse($mensaje->fecha)->format('d/m/Y h:i A')}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="box-footer no-padding">
				<div class="mailbox-controls">
					<div class="pull-right">
						{{$mensajes->appends(array('buscar' => $old_search))->links()}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
$(document).on('click', '.seleccionado', function(){

    moment.locale('es');

    $('.mensaje_modificar').show('400');
    $('.mensaje_asunto').text("Asunto: "+$(this).data('asunto'));
    $('.view_por').text("Para: "+$(this).data('para'));
    $('.view_mensaje').html($(this).data('mensaje'));
    $('.view_recep').text(moment($(this).data('fecha'), 'YYYY-MM-DD h:mm:ss').format('LLLL'));
    $('#view_id_mensaje').val($(this).data('id_mensaje'));

	$('#viewMensaje_Modal').modal('show');
});

</script>

@endsection
