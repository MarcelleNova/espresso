@extends('layouts.admin')

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
					<li class="breadcrumb-item active">Call Management</li>
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
						<h3 class="card-title">Call Data Manual Calls Import - Midday</h3>
					
					</div>
					<!-- /.card-header -->
					<div class="card-body">

						@if ($message = Session::get('success'))
						<div class="alert alert-info alert-block" id="session-alert" style="display:block">
							<button type="button" class="close" data-dismiss="alert"></button>
							<strong>{{ $message }}</strong>
						</div>
		
						@endif
					
							<form id="fulldayform" method="post" action="{{ route('calls.import.calls.midday') }}" class="fileform" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<div class="row mt-3">
										<label class="col-md-3">
											Select File for Midday Call Import
											<span class="text-danger"></span> 
										</label>
										<input type="file" class="col-md-3 form-control" name="csv_file" required>
												
										<div class="form-group col text-center">
											<input type="submit" class="btn btn-info btn-sm" value="Import File">
										</div>
									</div>
									<div class="row mb-5">
										<div class="col-md-3"></div>
										<div class="col-md-7">
											Path to call Data is \\platdc\SFTP_Root\SCP Folder\Nova Life\Midday
										</div>
									</div>
							</form>
				
							<form method="post" action="{{ route('calls.import.calls.midday') }}" class="fileform" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<div class="row mb-2">
										{{-- <div class="col-md-12 text-right">
											<a href="{{ route('calls.phones.create') }}">Create New Phone</a>
										</div> --}}
									</div>
									<div class="row mb-5">
										<label class="col-md-3">
											Select Date for Midday Call Import
											<span class="text-danger"></span> 
										</label>
										<input type="date" class="col-md-3 form-control" name="date" required>
												
										<div class="form-group col text-center">
											<input type="submit" class="btn btn-info btn-sm" value="Import Files">
										</div>
									</div>
							</form>
				
					</div>

			</section>
			@endsection

	@push('scripts')

		<script type="text/javascript">
		$( window ).on( "load", function() { 


			// Timeout to hide the alert after a certain duration
				setTimeout(function() {
					document.getElementById('session-alert').style.display = 'none';
				}, 1000); // 5000 milliseconds = 5 seconds
			})
		</script>

	@endpush




