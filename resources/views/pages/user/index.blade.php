@extends('layouts.home')

@section('title', 'Data User')

@section('header')
<div class="row align-items-center">
	<div class="col">
		<h2 class="page-title mb-2">
			User
		</h2>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">User</li>
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
			<a href="{{ route('user.create') }}" class="btn btn-success mb-2">Tambah User</a>
			<div class="card">
				<div class="table-responsive">
					<table class="table table-vcenter card-table">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Email</th>
								<th>Role</th>
								<th width="10%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($users as $user)
								<tr>
									<td>{{ $user->name }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->role }}</td>
									<td>
										<form onclick="return confirm('hapus data?')" method="post" action="{{ route('user.destroy', $user->id) }}" class="d-inline">
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