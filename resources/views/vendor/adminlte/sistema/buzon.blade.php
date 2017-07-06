@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Buzon
@endsection

@section('contentheader_title')
	Buzon Recibidos
@endsection


@section('main-content')

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Mensajes</h3>
				<div class="box-tools pull-right">
					{!! Form::open(['route'=>'mensajeSearch','method'=>'get', 'class'=>'navbar-form navbar-right'])!!}

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
								<tr id="tr{{$mensaje->id_mensaje}}" class="seleccionado" data-id_mensaje="{{$mensaje->id_mensaje}}" data-asunto="{{$mensaje->asunto}}" data-por="{{$mensaje->name}}" data-mensaje="{{$mensaje->mensaje}}" data-fecha="{{$mensaje->fecha}}" data-id_md="{{$mensaje->id_md}}" data-visto="{{$mensaje->visto}}">
									<td class="col-md-3 mailbox-name">{!!$mensaje->visto === 'no' ? "<b>".$mensaje->name."</b>": $mensaje->name !!}</td>
									<td class="col-md-7 mailbox-subject">{!!$mensaje->visto === 'no' ? "<b>".substr($mensaje->asunto, 0, 90)."</b>": substr($mensaje->asunto, 0, 90) !!}</td>
									<td class="col-md-2 mailbox-date">{!!$mensaje->visto === 'no' ? "<b>".Carbon\Carbon::parse($mensaje->fecha)->format('d/m/Y h:i A')."</b>": Carbon\Carbon::parse($mensaje->fecha)->format('d/m/Y h:i A') !!}</td>
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

	var id_md= $(this).data('id_md');
	var id_mensaje= $(this).data('id_mensaje');
	var name_remitente= $(this).data('por');
	var asunto_remitente= $(this).data('asunto');
	var mensaje_remitente= $(this).data('mensaje');
	var fecha_remitente= $(this).data('fecha');
	var visto_remitente= $(this).data('visto');

    moment.locale('es');

    $('.mensaje_asunto').text("Asunto: "+$(this).data('asunto'));
    $('.view_por').text("De: "+$(this).data('por'));
    $('.view_mensaje').html($(this).data('mensaje'));
    $('.view_recep').text(moment($(this).data('fecha'), 'YYYY-MM-DD h:mm:ss').format('LLLL'));

	$('#viewMensaje_Modal').modal('show');

	if(visto_remitente != 'si'){

		$.ajax({

	        type: 'post',
	        url: 'updateVisto',
	        data: {
	            '_token': $('input[name=_token]').val(),
	            'id_md': id_md,
	        },
	        success: function(data){
	            
	            if(data.errors){
	                console.log('error al poner en visto el mensaje');
	            }else{

	                loadMensajes();

	                var cadena= "";

	                cadena= cadena + "<td class='col-md-3 mailbox-name'>"+name_remitente+"</td>";
	                cadena= cadena + "<td class='col-md-7 mailbox-subject'>"+asunto_remitente.substring(0, 90)+"</td>";
	                cadena= cadena + "<td class='col-md-2 mailbox-date'>"+moment(fecha_remitente).format('DD/MM/YYYY h:mm A')+"</td>";

	                cadena= "<tr id='tr"+id_mensaje+"' class='seleccionado' data-id_mensaje='"+id_mensaje+"' data-asunto='"+asunto_remitente+"' data-por='"+name_remitente+"' data-mensaje='"+mensaje_remitente+"' data-fecha='"+fecha_remitente+"' data-id_md='"+id_md+"' data-visto='"+data.visto+"'>"+cadena+"</tr>";

	                $('#tr'+id_mensaje).replaceWith(cadena);   
	            }
	        }
	    });
    }
});

</script>

@endsection
