@extends('layouts.home')

@section('title', 'Tambah Data Crips')

@section('header')
<div class="row align-items-center">
	<div class="col">
		<h2 class="page-title mb-2">
			Tambah Crips
		</h2>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('crips.index') }}">Crips</a></li>
				<li class="breadcrumb-item active" aria-current="page">Tambah Crips</li>
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
					Data Crips {{ $criteria->name }}
				</div>
				<div class="card-body">
					<form action="{{ route('crips.store', $criteria->id) }}" method="POST">
						@csrf

						<div class="input-group mb-2">
							<input type="text" class="crips form-control" id="name" placeholder="Masukan Crips">
							<input type="number" class="value form-control" id="name" placeholder="Masukan Value">
							<button type="button" name="add" id="dynamic-ar" class="btn btn-sm btn-primary rounded-0">Submit</button>
						</div>
						<span class="text-danger alert-error"></span>

						<div class="services-form-box mt-4" id="dynamicAddRemove"></div>
						<button type="submit" class="btn btn-success mt-2 btn-block">Simpan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
	<script>

  // dynamic form
  var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;

        if( !$('.crips').val() || !$('.value').val() ) {
          $('.alert-error').html('Data Tidak Boleh Kosong!')
        } else {
          $("#dynamicAddRemove").append('<div class="input-group mb-2"><input type="text" name="crips[' + i +
            ']" value="'+$('.crips').val()+'" class="services form-control"><input type="number" name="value[' + i +
            ']" value="'+$('.value').val()+'" class="services form-control"><button type="button" class="btn btn-sm btn-danger remove-input-field rounded-0">Delete</button></div>'
            );

          $('.crips').val('');
          $('.value').val('')
          $('.crips').focus();
          $('.alert-error').html('')
        }
        
    });
    
    $(document).on('click', '.remove-input-field', function (e) {
        $(this).parents('.input-group').remove();
    });

    $(document).keypress(
      function(event){
        if (event.which == '13') {
          event.preventDefault();
        }
      });


</script>
@endsection