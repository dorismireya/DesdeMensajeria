@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Editar Tarea
@endsection

@section('contentheader_title')
  Editar Tarea
@endsection


@section('main-content')

<div class="row">
  <div class="col-xs-8 col-md-offset-2">
    <div class="box box-info">
      
      <!-- form start -->
      <br>

      @if($errors->any())
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-warning"></i> Error de Validación!</h4>
          <ul>
          @foreach($errors->all() as $error)

            <li>{{$error}}</li>
          @endforeach
          </ul>
        </div>
      @endif


      {!! Form::model($tarea, ['class' => 'form-horizontal','route' => ['tareas.update',$tarea->id_tarea], 'method' => 'put']) !!}
        <div class="box-body">

          <div class="form-group">
            {!! Form::label('funcion', 'Funcion', ['class' => 'col-sm-2 control-label']) !!} 
            <div class="col-sm-10">
              
              <select class="form-control m-bot15" name="id_funcion">
                @if($funciones->count() > 0)
                  @foreach($funciones as $f)
                    <option {{$f->id_funcion === $tarea->id_funcion ? 'selected="selected"' : ''}} value="{{$f->id_funcion}}">{{$f->funcion}}</option>
                  @endForeach
                @else
                  No existe funciones
                @endif   
            </select>
            </div>
          </div>
          

          <div class="form-group">
            {!! Form::label('tarea', 'Tarea', ['class' => 'col-sm-2 control-label']) !!} 
            <div class="col-sm-10">
              {!! Form::text('tarea', null, ['class' => 'form-control', 'placeholder'=>'Nombre de Tarea', 'required' => 'required']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('vista', 'Vista', ['class' => 'col-sm-2 control-label']) !!} 
            <div class="col-sm-10">
              {!! Form::text('vista', null, ['class' => 'form-control', 'placeholder'=>'Ruta de Vista', 'required' => 'required']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('detalle', 'Detalle', ['class' => 'col-sm-2 control-label']) !!} 
            <div class="col-sm-10">
              {!! Form::text('detalle', null, ['class' => 'form-control', 'placeholder'=>'Descripción']) !!}
            </div>
          </div>

          {{Form::hidden('estado','activo')}}

          
        </div><!-- /.box-body -->
        <div class="box-footer">
          
          <a class="btn btn-default" href="{{route('adminFuncion.index')}}">
            <i class="fa fa-close"></i> Cancelar
          </a>

          
          <button type="submit" class="btn btn-info pull-right"><i class="fa fa-edit"></i> Editar</button>
        </div><!-- /.box-footer -->
      {!! Form::close() !!} 
    </div>
  </div>
</div>
@endsection
