@extends('adminlte::page')

@section('content')
<div class="card">
	<div class="card-header">
		<span class="card-title">Daftar Media Pembelajaran</span>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-primary p-3">
						<img src="{{ asset('assets/images/icon/module.png') }}">
					</span>
					<div class="info-box-content">
						<span class="info-box-text">Total Modul</span>
						<span class="info-box-number">
							{{ auth()->user()->guru->moduls()->count() }}
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-success">
						<i class="fa fa-fw fa-book"></i>
					</span>
					<div class="info-box-content">
						<span class="info-box-text">Total Materi</span>
						<span class="info-box-number">
							{{ auth()->user()->guru->materis()->count() }}
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-warning p-3">
						<img src="{{ asset('assets/images/icon/question mark.png') }}">
					</span>
					<div class="info-box-content">
						<span class="info-box-text">Total Tes</span>
						<span class="info-box-number">
							{{ auth()->user()->guru->tesses()->count() }}
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-danger p-3">
						<img src="{{ asset('assets/images/icon/test-quiz.png') }}">
					</span>
					<div class="info-box-content">
						<span class="info-box-text">Total Quiz</span>
						<span class="info-box-number">
							{{ auth()->user()->guru->quizes()->count() }}
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection