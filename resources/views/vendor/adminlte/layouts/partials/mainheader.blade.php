<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>FPVA </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a class="nuevo_mensaje-modal btn" data-toggle="tooltip" title="Nuevo Mensaje">
                        <i class="fa fa-commenting-o"></i>
                    </a>
                    
                </li><!-- /.messages-menu -->

                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="mensajes_cantidad label label-success"></span>
                    </a>
                    <ul class="mensajes_contenedor dropdown-menu">
                        <!-- /.cargamos por ajax -->
                    </ul>
                </li><!-- /.messages-menu -->

                <!-- Notifications Menu -->
                <li class="registro_usuarios dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="registros_cantidad label label-warning"></span>
                    </a>
                    <ul class="registros_contenedor dropdown-menu">
                        <!-- /.cargamos por ajax -->
                    </ul>
                </li>
                
                @if (Auth::guest())
                    <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                @else
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ Gravatar::get($user->email) }}" class="user-image" alt="User Image"/>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>{{ trans('adminlte_lang::message.login') }} Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('adminlte_lang::message.followers') }}</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('adminlte_lang::message.sales') }}</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('adminlte_lang::message.friends') }}</a>
                                </div>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ url('/settings') }}" class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.profile') }}</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ trans('adminlte_lang::message.signout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="submit" value="logout" style="display: none;">
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Control Sidebar Toggle Button -->
                <li>
                    <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
                    <a href="{{ url('/') }}"><i class="fa fa-home"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>



<div id="nuevoMensaje_Modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nuevo Mensaje</h4>
            </div>

            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="select_para">Para:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="select_para" >
                            </select>
                            <div class="form-group has-error">
                                <label class="error_para control-label hidden" for="select_para"></label>
                            </div>
                        </div>
                    </div>


                    <div id="lista_usuario">
                    </div>
                    <br>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="m_asunto">Asunto:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Asunto" id="m_asunto">
                            <div class="form-group has-error">
                                <label class="error_asunto control-label hidden" for="m_asunto"></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Contenido</label>
                        <div class="form-group has-error">
                            <label class="error_contenido control-label hidden" for="p_contenido"></label>
                        </div>
                        <textarea name="content" class="form-control my-editor" id="p_contenido" ></textarea>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="b_enviar">Enviar</button>
            </div>

        </div>
    </div>
</div>



<div id="viewMensaje_Modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="mensaje_asunto modal-title"></h4>
            </div>

            <div class="modal-body">
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h5 class="view_por"></h5>
                    </div>
                    <div class="view_mensaje mailbox-read-message">
                    </div>
                    <div class="mailbox-read-info_etiqueta">
                        <h5 class="view_recep"></h5>
                    </div>
                </div>
                <input type="hidden" id="view_id_mensaje" value="">
            </div>

            <div class="modal-footer">
                <button type="button" class="mensaje_modificar btn btn-primary" style="display: none">Modificar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>


<script type="text/javascript">

var lista_para= [];
    
$(document).on('click','.nuevo_mensaje-modal', function(){

    nuevoMensaje(0);
    
});


$(document).on('click','#select_para', function(){

    if($("#select_para").val() != null){

        $('.error_para').addClass('hidden');
    
        lista_para.push($("#select_para").val());

        $('#lista_usuario').append("<a id='a"+$("#select_para").val()+"' class='quitar btn btn-default btn-xs' data-id='"+$("#select_para").val()+"' data-name='"+$("#op"+$("#select_para").val()).data('name')+"'><i class='fa fa-close'></i> "+$("#op"+$("#select_para").val()).data('name')+"</a>&nbsp;");

        $('#op'+$("#select_para").val()).replaceWith('');

        document.getElementById("op").selected = "true";
    }
    
});

$(document).on('click','.quitar', function(){

    $('#a'+$(this).data('id')).replaceWith('');

    var pos= lista_para.indexOf($(this).data('id'));
    lista_para.splice(pos, 1);

    $('#select_para').append("<option id='op"+$(this).data('id')+"' value='"+$(this).data('id')+"' data-name='"+$(this).data('name')+"'>"+$(this).data('name')+"</option>");
    
});


$(document).on('click','#b_enviar', function(){

    $('.error_asunto').addClass('hidden');

    if(lista_para.length == 0){

        $('.error_para').removeClass('hidden');
        $('.error_para').text("Seleccione un destinatario");
        document.getElementById("select_para").focus();
        return;
    }

    if($("#m_asunto").val().length == 0){
        $('.error_asunto').removeClass('hidden');
        $('.error_asunto').text("Ingrese un asunto válido, para el mensaje");
        document.getElementById("m_asunto").focus();
        return;
    }


    $.ajax({

        type: 'post',
        url: 'guardar_usuarios_mensaje',
        data: {
            '_token': $('input[name=_token]').val(),
            'asunto': $("#m_asunto").val(),
            'mensaje': tinyMCE.get('p_contenido').getContent(),
            'lista': lista_para,
        },
        success: function(data){
            
            if(data.errors){
                console.log('error al insertar el mensaje');
            }else{

                

                swal("Mensaje Creado", "El mensaje "+data.asunto+", fue creado con exito", "success");
            }
        }
    });

    $('#nuevoMensaje_Modal').modal('hide');
    
});

$(document).ready(function() {

   loadMensajes();
});


$(document).on('click', '.a_view', function(){

    var id_md= $(this).data('id_md');

    moment.locale('es');

    $('.mensaje_modificar').hide('400');
    $('.mensaje_asunto').text("Asunto: "+$(this).data('asunto'));
    $('.view_por').text("De: "+$(this).data('por'));
    $('.view_mensaje').html($(this).data('mensaje'));
    $('.view_recep').text(moment($(this).data('fecha'), 'YYYY-MM-DD h:mm:ss').format('LLLL'));
    $('#view_id_mensaje').val($(this).data('id_mensaje'));

    $('#viewMensaje_Modal').modal('show');


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
            }
        }
    });
});

$(document).on('click', '.mensaje_modificar', function(){

    //console.log('entra', $('#view_id_mensaje').val());

    $('#viewMensaje_Modal').modal('hide');

    nuevoMensaje($('#view_id_mensaje').val());
});


function nuevoMensaje(id_mensaje){

    lista_para= [];
    $('#lista_usuario').replaceWith("<div id='lista_usuario'></div>");
    $('#m_asunto').val('');
    tinymce.activeEditor.setContent('');

    $.ajax({

        type: 'post',
        url: 'listar_usuarios_mensaje',
        data: {
            '_token': $('input[name=_token]').val(),
            'id_mensaje': id_mensaje,
        },
        success: function(data){

            if(data.usuario.estado != 'activo'){
                swal("Acceso denegado", "Usted no esta habilitado, para enviar mensajes. Pongase en contacto con su Administrador", "error");
                return;
            }

            var cadena="";
            for(i=0; i < data.lista.length; i++){

                temp_existe= false;

                for(j=0; j < data.mensaje.length; j++){

                    if(data.lista[i].id == data.mensaje[j].id_destino)
                        temp_existe= true;
                }

                if(!temp_existe)
                    cadena= cadena + "<option id='op"+data.lista[i].id+"' value='"+data.lista[i].id+"' data-name='"+data.lista[i].name+"'>"+data.lista[i].name+"</option>";
            }

            cadena= "<select class='form-control' id='select_para'><option disabled selected id='op' value=''>-- seleccionar remitente --</option>"+cadena+"</select>";

            $('#select_para').replaceWith(cadena);

            

            if(data.mensaje.length != 0){

                for(i=0; i < data.mensaje.length; i++){

                    $('#lista_usuario').append("<a id='a"+data.mensaje[i].id_destino+"' class='quitar btn btn-default btn-xs' data-id='"+data.mensaje[i].id_destino+"' data-name='"+data.mensaje[i].name+"'><i class='fa fa-close'></i> "+data.mensaje[i].name+"</a>&nbsp;");
                    lista_para.push(data.mensaje[i].id_destino);
                }

                $('#m_asunto').val(data.mensaje[0].asunto);
                if(data.mensaje[0].mensaje != null)
                    tinymce.activeEditor.setContent(data.mensaje[0].mensaje);
            }


            $('#nuevoMensaje_Modal').modal('show');
        }

    });
}

function loadMensajes(){

    $.ajax({

        type: 'post',
        url: 'listar_mensajes',
        data: {
            '_token': $('input[name=_token]').val(),
        },
        success: function(data){


            if(data.tarea_valida[0].cantidad == 1){
                $('.registro_usuarios').show(200);
                $('.registros_cantidad').text(data.usuarios.length);

                var concatenar= "";

                user_max= data.usuarios.length;

                if(user_max > 5)
                    user_max= 5;

                for(i=0; i< user_max; i++){

                    concatenar= concatenar+"<li>";
                    concatenar= concatenar+"<ul class='menu'>";
                    concatenar= concatenar+"<li>";
                    concatenar= concatenar+"<a href='{{route('adminRegistrosUsuarios')}}'>";
                    concatenar= concatenar+"<i class='fa fa-users text-aqua'></i>"+data.usuarios[i].name;
                    concatenar= concatenar+"</a>";
                    concatenar= concatenar+"</li>";
                    concatenar= concatenar+"</ul>";
                    concatenar= concatenar+"</li>";
                }


                concatenar= "<li class='header'>Tiene "+data.usuarios.length+" registros</li>"+concatenar;
                concatenar= concatenar + "<li class='footer'><a href='{{route('adminRegistrosUsuarios')}}'>Ver Registros de Usuarios</a></li></ul>";

                concatenar= "<ul class='registros_contenedor dropdown-menu'>"+concatenar;

                $('.registros_contenedor').replaceWith(concatenar);   


            }else $('.registro_usuarios').hide(400);

            $('.mensajes_cantidad').text(data.lista.length);

            var cadena= "";

            max= data.lista.length;

            if(max > 5)
                max= 5;

            for(i=0; i < max; i++){

                cadena= cadena+"<li id='id_m"+data.lista[i].id_mensaje+"'>";
                cadena= cadena+"<ul class='menu'>";
                cadena= cadena+"<li>";
                cadena= cadena+"<a class='a_view' data-toggle='tooltip' data-id_mensaje='"+data.lista[i].id_mensaje+"' data-id_md='"+data.lista[i].id_md+"' data-por='"+data.lista[i].name+"' data-asunto='"+data.lista[i].asunto+"' data-mensaje='"+data.lista[i].mensaje+"' data-fecha='"+data.lista[i].fecha+"'>";
                cadena= cadena+"<div class='pull-left'><i class='fa fa-envelope-o'></i></div>";
                cadena= cadena+"<h4>";

                cadena= cadena+data.lista[i].name;
                
                cadena= cadena+"<p>"+data.lista[i].asunto+"</p>";
                cadena= cadena+"</h4>";
                moment.locale('es');
                cadena= cadena+"<small><i class='fa fa-clock-o'></i> "+moment(data.lista[i].fecha, 'YYYY-MM-DD h:mm:ss').fromNow()+"</small>";
                cadena= cadena+"</a>";
                cadena= cadena+"</li>";
                cadena= cadena+"</ul>";
                cadena= cadena+"</li>";

            }

            cadena= cadena+"<li class='footer'><a href='{{route('getMensajes')}}'><i class='glyphicon glyphicon-inbox'></i>Ver Mensajes Recibidos</a></li>";
            cadena= cadena+"<li class='footer'><a href='{{route('getMensajesEnviados')}}'><i class='glyphicon glyphicon-send'></i>Ver Mensajes Enviados</a></li></ul>";

            cadena= "<ul class='mensajes_contenedor dropdown-menu'>"+cadena;

            $('.mensajes_contenedor').replaceWith(cadena);   
        }

    });
}

</script>

<script>
  var editor_config = {
    path_absolute : "/",
    language: 'es',
    height: 150,
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>