@extends('layouts.home')

@section('title', 'Data Kriteria')

@section('header')
<div class="row align-items-center">
	<div class="col">
		<h2 class="page-title mb-2">
			Kriteria
		</h2>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Kriteria</li>
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
			<a href="{{ route('criteria.create') }}" class="btn btn-success mb-2">Tambah Data</a>
			<div class="card">
				<div class="table-responsive">
					<table class="table table-vcenter card-table">
						<thead>
							<tr>
								<th>Kode</th>
								<th>Nama</th>
								<th>Attribut</th>
								<th>Bobot</th>
								<th width="10%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($criterias as $criteria)
								<tr>
									<td>{{ $criteria->code }}</td>
									<td>{{ $criteria->name }}</td>
									<td>{{ $criteria->attribute }}</td>
									<td>{{ $criteria->weight }}</td>
									<td>
										<a href="{{ route('criteria.edit', $criteria->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="fas fa-edit"></i></a>
										<form method="post" action="{{ route('criteria.destroy', $criteria->id) }}" class="d-inline">
											@method('delete')
											@csrf
											<button type="submit" class="btn btn-sm btn-danger btn-icon btn-inline"><i class="fas fa-trash"></i></button>
										</form>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="5" class="text-center">Data Kosong</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection