@extends('layouts.home')

@section('title', 'Edit Data Alternatif')

@section('header')
<div class="row align-items-center">
	<div class="col">
		<h2 class="page-title mb-2">
			Edit Alternatif
		</h2>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('alternative.index') }}">Alternatif</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Alternatif</li>
			</ol>
		</nav>
	</div>
</div>
@endsection

@section('content')
<div class="container-xl">
	<div class="row row-cards">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-header">
					Data Alternatif
				</div>
				<div class="card-body">
					<form action="{{ route('alternative.update', $alternative->id) }}" method="POST">
						@method('patch')
						@csrf
						<div class="mb-3">
							<label class="form-label">Kode Alternatif <span class="text-danger">*</span></label>
							<input type="text" class="form-control  @error('code') is-invalid @enderror" name="code" value="{{ $alternative->code }}">
							@error('code')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label">Nama Alternatif <span class="text-danger">*</span></label>
							<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $alternative->name }}">
							@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label">Keterangan</label>
							<textarea class="form-control @error('note') is-invalid @enderror" name="note" rows="6">{{ $alternative->note }}</textarea>
							@error('note')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<button type="submit" class="btn btn-success">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection