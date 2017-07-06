@extends('layouts.app')

@section('htmlheader_title')
	
	Inicio
@endsection

@section('main-content')


@include('layouts.partials.mainheader')


    @include('layouts.facultad.slider')
    @include('layouts.publicacion.publicaciones')
    @include('layouts.carrera.carreras')
    @include('layouts.facultad.whyus')
    @include('layouts.partials.footer')
    @include('layouts.partials.popup')

    
@endsection
