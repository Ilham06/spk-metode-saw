@extends('layouts.home')

@section('title', 'Edit Data Crips')

@section('header')
<div class="row align-items-center">
	<div class="col">
		<h2 class="page-title mb-2">
			Edit Crips
		</h2>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('crips.index') }}">Crips</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Crips</li>
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
					Edit Data Crips {{ $crip->note }}
				</div>
				<div class="card-body">
					<form action="{{ route('crips.update', $crip->id) }}" method="POST">
						@method('put')
						@csrf
						@error('note')
						<span class="text-danger">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
						@error('value')
						<span class="text-danger">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
						<div class="input-group mb-2">
							<input type="text" class="crips form-control" id="name" name="note" value="{{ $crip->note }}">
							<input type="number" class="value form-control" id="name" name="value" value="{{ $crip->value }}">
						</div>
						<button type="submit" class="btn btn-success mt-2 btn-block">Simpan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection