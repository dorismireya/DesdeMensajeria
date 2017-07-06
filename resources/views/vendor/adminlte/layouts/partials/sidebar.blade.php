<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>

            <?php

                $id_usuario= Auth()->user()->id;

                $funciones= DB::table('funciones')
                ->join('tareas','tareas.id_funcion','=','funciones.id_funcion')
                ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
                ->select('funciones.*')
                ->where('usuarios_tareas.id_usuario','=',$id_usuario)
                ->where('funciones.estado', '=', 'activo')
                ->where('tareas.estado', '=', 'activo')
                ->groupBy('funciones.id_funcion')
                ->orderBy('funciones.funcion','ASC')->get();

                $contenedor= '';

                foreach ($funciones as $funcion ) {

                    ?>

                        <li class="treeview">
                            <a href="#" title="{{$funcion->detalle}}"><i class="fa fa-link"></i><span>{{$funcion->funcion}}</span><i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu"> 
                    <?php

                    $tareas= DB::table('tareas')
                    ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
                    ->select('tareas.*')
                    ->where('usuarios_tareas.id_usuario','=',$id_usuario)
                    ->where('tareas.id_funcion','=',$funcion->id_funcion)
                    ->where('tareas.estado', '=', 'activo')
                    ->orderBy('tareas.tarea', 'asc')->get();

                    foreach ($tareas as $tarea) {
                
                        
                        ?>

                            
                            <li><a href="/{{$tarea->vista}}" title="{{$tarea->detalle}}">{{$tarea->tarea}}</a></li>
                        <?php
                    }

                    

                    ?>

                    </ul>
                    </li>

                    <?php


                }
            ?>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
