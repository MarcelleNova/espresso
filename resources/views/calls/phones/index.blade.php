@extends('layouts.admin')
@push('scripts')
								
	<script type="text/javascript">
		jQuery.noConflict();
	(function($) {
	// Your select2 code here
	// Select first by extention
	$(document).ready(function() {
				$('#ajax_search').select2({delay:500, openActive:true});
			})

			$(document).ready(function() {
				$('#ajax_search').select2({
					minimumInputLength: 1,
					ajax: {
						url: '{{ route('calls.phones.getPhoneExtensions') }}',
						dataType: 'json',
					},
				});
			});

			//Select second by name
			// $(document).ready(function() {
			// 	$('#ajax_search2').select2({delay:500, openActive:true});
			// })

			// $(document).ready(function() {
			// 	$('#ajax_search2').select2({
			// 		minimumInputLength: 1,
			// 		ajax: {
			// 			url: '{{ route('admin.bitrix.getActiveUsers') }}',
			// 			dataType: 'json',
			// 		},
			// 	});
			// });


	
	})(jQuery);

	</script>
@endpush

@section('content')
<!-- Content Header (Page header) -->

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">

			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right text-sm">
					<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
					<li class="breadcrumb-item active">Phone Management</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Phone Movement</h3>
						{{-- <button type="button" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#modal-default">
							Add Phone
						</button> --}}
					</div>
					<!-- /.card-header -->
					<div class="card-body">

						<form method="get" action="{{ route('calls.phones.editPhone')  }}">
							@csrf
							<div class="form-group">
								{{-- <div class="row mb-2">
									<div class="col-md-12 text-right">
										<a href="{{ route('calls.phones.create') }}">Create New Phone</a>
									</div>
								</div> --}}
								
								<div class="clearfix"></div>
								<div class="row mb-5">
									<label class="col-md-3">
										Phone Extension
										<span class="text-danger"></span>
									</label>
									<div class="col-md-4 input-group">
										<select name="phone" id="ajax_search" required class="form-control select2">
											<option value="">Please select</option>
										</select>
									</div>
									<div class="col-md-3 form-group col text-center">
										<input type="submit" class="btn btn-info" value="View">
									</div>
								</div>
								<div class="clearfix"></div>
								{{-- <div class="row">
									<label class="col-md-3">
										Bitrix User Name
										<span class="text-danger"></span>
									</label>
									<div class="col-md-4 input-group">
										<select name="phone" id="ajax_search2" required class="form-control select2">
											<option value="">Please select</option>
										</select>
									</div>
									<div class="col-md-3 form-group col text-center">
										<input type="submit" class="btn btn-info" value="Edit">
									</div>
								</div> --}}
								<div class="clearfix"></div>
							</div>
							
						</form>

					</div>

				</section>



				@endsection

