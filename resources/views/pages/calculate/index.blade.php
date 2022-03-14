@extends('layouts.home')

@section('title', 'Data Penentuan Nilai')

@section('header')
<div class="row align-items-center">
	<div class="col">
		<h2 class="page-title mb-2">
			Penentuan Nilai
		</h2>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Penentuan Nilai</li>
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
				<div class="table-responsive">
					<table class="table table-vcenter card-table">
						<thead>
							<tr>
								<tr>
									<th width="5%">#</th>
									<th>Nama Kriteria</th>
									@foreach ($criterias as $c)
										<th>{{ $c->code }}</th>
									@endforeach
								</tr>
							</tr>
						</thead>
						<tbody>
							
							@foreach ($alternatives as $alternative)
								<tr>
									<td><a href="{{ route('calculate.edit', $alternative->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a></td>
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
			<a href="{{ route('calculate.proses') }}" class="btn btn-success mt-2">Proses</a>
		</div>
	</div>
</div>
@endsection