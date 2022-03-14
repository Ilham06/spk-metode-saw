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
				<div class="table-responsive">
					<table class="table">
						@foreach ($alternatives as $alternative)
						<tr>
							<td>{{ $alternative->name }}</td>
							@foreach ($alternative->criteria as $c)
								<td>{{ $c->pivot->normalize }}</td>
							@endforeach
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection