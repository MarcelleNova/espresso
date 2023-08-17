@extends('layouts.admin')

@push('scripts')
								
	<script type="text/javascript">
		jQuery.noConflict();
	(function($) {
	// Your select2 code here
	// Select Venture
	$(document).ready(function() {
				$('#ajax_search').select2({delay:500, openActive:true});
			})

			$(document).ready(function() {
				$('#ajax_search').select2({
					minimumInputLength: 3,
					ajax: {
						url: '{{ route('admin.ventures.getVentures') }}',
						dataType: 'json',
					},
				});
			});

			// Select TSR
			$(document).ready(function() {
				$('#ajax_search2').select2({delay:500, openActive:true});
			})

			$(document).ready(function() {
				$('#ajax_search2').select2({
					minimumInputLength: 3,
					ajax: {
						url: '{{ route('calls.phones.autocompleteName') }}',
						dataType: 'json',
					},
				});
			});


	
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
					<li class="breadcrumb-item active">Call Reports</li>
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
						<h3 class="card-title">Call Report

						</h3>
					
					</div>
					<!-- /.card-header -->
					<div class="card-body">

						@if ($message = Session::get('success'))
						<div class="alert alert-success alert-block">
							<button type="button" class="close" data-dismiss="alert"></button>
							<strong>{{ $message }}</strong>
						</div>
		
						@endif

						<form method="get" action="{{ route('calls.report.report') }}">
							@csrf
							<div class="form-group p-4">
								<div class="row input-group mb-3">
									<label class="col-md-3">
										Date From:
										<span class="text-danger"></span> 
									</label>
									<input type="date" class="col-md-4 form-control ml-2" name="dateFrom">
								</div>					
								<div class="row input-group mb-3">
									<label class="col-md-3">
										Date To:
										<span class="text-danger"></span> 
									</label>
									<input type="date" class="col-md-4 form-control ml-2" name="dateTo">
								</div>
								<div class="clearfix"></div>
							
							<div class="form-group">
								<div class="row mb-3">
									<label class="col-md-3">
										Venture:
										<span class="text-danger"></span> 
									</label>
									{{-- <input type="text" class="col-md-3 form-control" name="venture"> --}}
									<div class="col-md-4 input-group">
										<select name="phones" id="ajax_search2" required class="form-control select2">
											<option value="">Please select</option>
										</select>
									</div>
								</div>					
								<div class="row mb-3">
									<label class="col-md-3">
										TSR
										<span class="text-danger"></span> 
									</label>
									<div class="col-md-4 input-group">
										<select name="phones" id="ajax_search2" required class="form-control select2">
											<option value="">Please select</option>
										</select>
									</div>
									{{-- <input type="text" class="col-md-3 form-control" name="TSR"> --}}
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group col text-center">
								<input type="submit" class="btn btn-info btn-sm" value="Do Call Analysis">
							</div>
						</form>

					</div>

					

					<!-- MODAL STARTS HERE -->
					<div class="modal fade" id="modal-default">
						{{-- <div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h3 class="modal-title">Add Role</h3>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form method="post" action="{{ route('admin.roles.store') }}">
											<input type="hidden" name="_token" value="{{ csrf_token() }}" >
											<div class="form-group">
												<div class="row">
													<label class="col-md-3">Name</label>
													<div class="col-md-6"><input type="text" name="name" class="form-control">
													</div>
												</div>
												<div class="clearfix"></div>
											</div>
												<div class="form-group col text-center">
													<input type="submit" class="btn btn-info btn-sm" value="Save">
												</div>
											</form>
								</div>
								<div class="modal-footer justify-content-between">
									
								</div>
							</div> --}}
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->

		</section>
		@endsection



