@extends('layouts.home')

@section('title', 'Edit Data Nilai')

@section('header')
<div class="row align-items-center">
	<div class="col">
		<h2 class="page-title mb-2">
			Edit Nilai
		</h2>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('calculate.index') }}">Perhitungan</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Nilai</li>
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
					Data Nilai
				</div>
				<div class="card-body">
					<form action="{{ route('calculate.update', $alternative->id) }}" method="post">
						@method('PUT')
						@csrf
						@forelse ($criterias as $criteria)
						<div class="mb-2">
							<label for="" class="form-label">{{ $criteria->name }} ({{ $criteria->code }})</label>
							{{-- <input type="number" class="form-control" name="criteria[{{ $criteria->id }}]" placeholder="nilai {{ $criteria->name }}"> --}}
							<select name="criteria[{{ $criteria->id }}]" id="" class="form-control" required>
								@forelse ($criteria->crips as $crip)
									<option value="{{ $crip->value }}?{{ $crip->note }}">{{ $crip->note }}</option>
								@empty
									<option value="" disabled>belum ada crips</option>
								@endforelse
							</select>
						</div>
						@empty
						<div class="alert alert-danger">
							Belum Ada Kriteria
						</div>
						@endforelse
						<button type="submit" class="btn btn-success mt-2">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection