@extends('layouts.home')

@section('title', 'Data Hasil')

@section('header')
<div class="row align-items-center">
	<div class="col">
		<h2 class="page-title mb-2">
			Hasil
		</h2>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Hasil</li>
			</ol>
		</nav>
	</div>
</div>
@endsection

@section('content')
<div class="container-xl">
	<div class="row row-cards">
		@if (session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
		@endif
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3>Data Awal</h3>
				</div>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Nama Kriteria</th>
									@foreach ($criterias as $c)
										<th>{{ $c->code }}</th>
									@endforeach
							</tr>
						</thead>
						<tbody>
							@foreach ($alternatives as $alternative)
							<tr>
								<td>{{ $alternative->name }}</td>
								@foreach ($alternative->criteria as $c)
								<td>{{ $c->pivot->crip }}</td>
								@endforeach
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3>Data Nilai</h3>
				</div>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Nama Kriteria</th>
									@foreach ($criterias as $c)
										<th width="17%">{{ $c->code }}</th>
									@endforeach
							</tr>
						</thead>
						<tbody>
							@foreach ($alternatives as $alternative)
							<tr>
								<td>{{ $alternative->name }}</td>
								@foreach ($alternative->criteria as $c)
								<td>{{ $c->pivot->value }}</td>
								@endforeach
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3>Data Normalisasi</h3>
				</div>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Nama Kriteria</th>
									@foreach ($criterias as $c)
										<th width="17%">{{ $c->code }}</th>
									@endforeach
							</tr>
						</thead>
						<tbody>
							@foreach ($arrNormalize as $key => $value)
							<tr>
								<td>{{ $key }}</td>
								@foreach ($value as $v)
								<td>{{ $v }}</td>
								@endforeach
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h3>Perangkingan</h3>
				</div>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Rank</th>
								<th>Nama</th>
								<th>Nilai Akhir</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($rank as $key => $value)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $key}}</td>
								<td>{{ $value }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection