@extends('layouts.home')

@section('title', 'Data Crips')

@section('header')
<div class="row align-items-center">
	<div class="col">
		<h2 class="page-title mb-2">
			Crips
		</h2>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Crips</li>
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
		@forelse ($criterias as $criteria)
			<div class="col-lg-6">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h3>{{ $criteria->name }}</h3>
						<a href="{{ route('crips.create', $criteria->id) }}" class="btn btn-success btn-sm">Tambah Crips</a>
					</div>
					<div class="card-body p-0">
						<table class="table">
							<thead>
								<tr>
									<th>Kode</th>
									<th>Crips</th>
									<th>Nilai</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($criteria->crips as $crips)
								<tr>
									<td>{{ $criteria->code }}</td>
									<td>{{ $crips->note }}</td>
									<td>{{ $crips->value }}</td>
									<td>
										<a href="{{ route('crips.edit', $crips->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="fas fa-edit"></i></a>
										<form method="post" action="{{ route('crips.destroy', $crips->id) }}" class="d-inline">
											@method('delete')
											@csrf
											<button type="submit" class="btn btn-sm btn-danger btn-icon btn-inline"><i class="fas fa-trash"></i></button>
										</form>
									</td>
								</tr>
								@empty
								<tr>
									<td colspan="4" class="text-center">Belum Ada Crips</td>
								</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
		@empty
		<div class="alert alert-danger">
			Belum Ada Kriteria
		</div>
		@endforelse
	</div>
</div>
@endsection