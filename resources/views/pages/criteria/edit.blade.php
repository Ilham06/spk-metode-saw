@extends('layouts.home')

@section('title', 'Edit Data Kriteria')

@section('header')
<div class="row align-items-center">
	<div class="col">
		<h2 class="page-title mb-2">
			Edit Kriteria
		</h2>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('criteria.index') }}">Kriteria</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Kriteria</li>
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
					Data Kriteria
				</div>
				<div class="card-body">
					<form action="{{ route('criteria.update', $criteria->id) }}" method="POST">
						@method('patch')
						@csrf
						<div class="mb-3">
							<label class="form-label">Kode Kriteria <span class="text-danger">*</span></label>
							<input type="text" class="form-control  @error('code') is-invalid @enderror" name="code" value="{{ $criteria->code }}">
							@error('code')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label">Nama Kriteria <span class="text-danger">*</span></label>
							<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $criteria->name }}">
							@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label">Bobot <span class="text-danger">*</span></label>
							<input type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ $criteria->weight }}">
							@error('weight')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="mb-3">
							<div class="form-label">Atribut <span class="text-danger">*</span></div>
							<select class="form-select @error('attribute') is-invalid @enderror" name="attribute">
								<option value="benefit" {{ ($criteria->attribute) == 'benefit' ? 'selected' : '' ; }}>Benefit</option>
								<option value="cost" {{ ($criteria->attribute) == 'cost' ? 'selected' : '' ; }}>Cost</option>
							</select>
							@error('attribute')
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