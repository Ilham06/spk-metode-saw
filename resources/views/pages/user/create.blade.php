@extends('layouts.auth')

@section('title', 'Tambah Data User')

@section('content')
	<div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md" action="{{ route('user.store') }}" method="post">
        	@csrf
          <div class="card-body">
            <h1 class="card-title text-center mb-4">Tambah User Baru</h1>
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>

              @error('name')
              <span class="invalid-feedback" role="alert">
              	<strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>

              @error('email')
              <span class="invalid-feedback" role="alert">
              	<strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <div class="input-group input-group-flat">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                @error('password')
                <span class="invalid-feedback" role="alert">
                	<strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Buat Akun</button>
            </div>
          </div>
        </form>
      </div>
    </div>
@endsection