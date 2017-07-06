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
                        <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">{{ trans('adminlte_lang::message.tabmessages') }}</li>
                        <li>
                            <!-- inner menu: contains the messages -->
                            <ul class="menu">
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <!-- User Image -->
                                            <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image"/>
                                        </div>
                                        <!-- Message title and timestamp -->
                                        <h4>
                                            {{ trans('adminlte_lang::message.supteam') }}
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <!-- The message -->
                                        <p>{{ trans('adminlte_lang::message.awesometheme') }}</p>
                                    </a>
                                </li><!-- end message -->
                            </ul><!-- /.menu -->
                        </li>
                        <li class="footer"><a href="#">c</a></li>
                    </ul>
                </li><!-- /.messages-menu -->

                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">{{ trans('adminlte_lang::message.notifications') }}</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                <li><!-- start notification -->
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> {{ trans('adminlte_lang::message.newmembers') }}
                                    </a>
                                </li><!-- end notification -->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">{{ trans('adminlte_lang::message.viewall') }}</a></li>
                    </ul>
                </li>
                <!-- Tasks Menu -->
                <li class="dropdown tasks-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">{{ trans('adminlte_lang::message.tasks') }}</li>
                        <li>
                            <!-- Inner menu: contains the tasks -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <!-- Task title and progress text -->
                                        <h3>
                                            {{ trans('adminlte_lang::message.tasks') }}
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <!-- The progress bar -->
                                        <div class="progress xs">
                                            <!-- Change the css width attribute to simulate progress -->
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% {{ trans('adminlte_lang::message.complete') }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">{{ trans('adminlte_lang::message.alltasks') }}</a>
                        </li>
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


<script type="text/javascript">

var lista_para= [];
    
$(document).on('click','.nuevo_mensaje-modal', function(){

    lista_para= [];
    $('#lista_usuario').replaceWith("<div id='lista_usuario'></div>");

    $.ajax({

        type: 'post',
        url: 'listar_usuarios_mensaje',
        data: {
            '_token': $('input[name=_token]').val(),
        },
        success: function(data){

            var cadena="";
            for(i=0; i < data.length; i++){

                cadena= cadena + "<option id='op"+data[i].id+"' value='"+data[i].id+"' data-name='"+data[i].name+"'>"+data[i].name+"</option>";
            }

            cadena= "<select class='form-control' id='select_para'><option disabled selected id='op' value=''>-- seleccionar remitente --</option>"+cadena+"</select>";

            $('#select_para').replaceWith(cadena);

            $('#nuevoMensaje_Modal').modal('show');   
        }

    });
    
});


$(document).on('click','#select_para', function(){

    if($("#select_para").val() != null){

        $('.error_para').addClass('hidden');
    
        lista_para.push($("#select_para").val());

        console.log('entra ',$("#select_para").val(), 'array', lista_para.length);

        $('#lista_usuario').append("<a id='a"+$("#select_para").val()+"' class='quitar btn btn-default' data-id='"+$("#select_para").val()+"' data-name='"+$("#op"+$("#select_para").val()).data('name')+"'><i class='fa fa-close'></i> "+$("#op"+$("#select_para").val()).data('name')+"</a>&nbsp;");

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
    
});

</script>

<script>
  var editor_config = {
    path_absolute : "/",
    language: 'es',
    height: 200,
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