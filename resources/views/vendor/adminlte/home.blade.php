@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title')
	Bienvenido al Sistema FPVA
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">

				<!-- Default box -->
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title"><i>Bienvenido</i></h3>
					</div>
					<div class="box-body">
						{{ trans('adminlte_lang::message.logged') }}.
					
						<center>
							<img class="hidden-xs hidden-sm hidden-md" src="{{ asset('/img/fpva.jpg') }}"  width="450" height="450" class="Responsive image img-thumbnail" alt="">
						</center>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
@endsection
