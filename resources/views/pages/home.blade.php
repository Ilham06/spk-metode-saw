@extends('layouts.home')

@section('title', 'Dashboard')

@section('header')
<div class="row align-items-center">
	<div class="col">
		<h2 class="page-title mb-2">
			Home
		</h2>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				{{-- <li class="breadcrumb-item active" aria-current="page">Library</li> --}}
			</ol>
		</nav>
	</div>
</div>
@endsection

@section('content')
<div class="container-xl">
	<div class="row row-cards">
		<div class="col-12">
			<div class="alert alert-primary">
				Hallo {{ auth()->user()->name }}, Selamat dantang di MY SPK.
			</div>
			<div class="card">
				<div class="card-body">
					<h3 class="mb-4">Bagaimana Cara Kerja MY SPK?</h3>
					<ul>
						<li><p><strong><a href="{{ route('criteria.index') }}">Menentukan Kriteria.</a></strong> Data kriteria berisi kode, nama, atribut, bobot. Bobot kriteria menentukan seberapa penting kriteria tersebut. Setiap nilai bobot akan di normalisasi dengan cara bobot/total bobot. dan ketika di jumlahkan semua nilainya harus sama dengan 1. Atribut kriteria terdiri dari benefit atau cost, dimana benefit artinya semakin besar nilainya semakin bagus, sedangkan cost semakin kecil nilainya semakin bagus.</p></li>
						<li><p><strong><a href="{{ route('crips.index') }}">Menentukan Crips.</a></strong> Crips adalah nilai dari suatu kriteria. Crips digunakan untuk memudahkan untuk memberikan nilai pada alternatif, dan data inilah yang akan diinputkan pada penentuan nilai. jadi, pastikan anda teleh mengisi data crips sebelum menentukan nilai alternatif. Data Crips berisi keterangan crips itu sendiri, dan bobotnya.</p></li>
						<li><p><strong><a href="{{ route('alternative.index') }}">Menentukan Alternatif.</a></strong> Alternatif merupakan data yang akan dihitung nilainya dan dipilih sebagai alternatif terbaik. Data alternatif berisi kode, nama, dan keterangan(opsional).</p></li>
						<li><p><strong><a href="{{ route('calculate.index') }}">Menentuan Nilai Alternatif.</a></strong> setelah menentukan 3 data diatas, maka sekarang saat untuk menentukan nilai alternatif berdasarkan data kriterianya. data yang akan di inputkan adalah data crips.</p></li>
						<li><p><strong><a href="{{ route('calculate.index') }}">Proses.</a></strong> Proses ini dilakukan otomatis oleh sistem. proses yang dilakukan diantaranya adalah melakukan normalisasi nilai sebelumnya, sampai dengan tahap perangkingan.</p></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection