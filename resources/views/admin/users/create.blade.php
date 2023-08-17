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
					<li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Users</a></li>
					<li class="breadcrumb-item active">User Management</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
	<div class="container-fluid text-sm">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Add New User</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<form method="post" action="{{ route('admin.users.store') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" >
						@if(count($companies))
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Company</label>
									<div class="col-md-6">
										<select name="companyID" class="form-control">
											<option value="">Select Company</option>
											@foreach($companies as $c)
											<option value="{{ $c->id }}">{{ $c->companyName }}</option>
											@endforeach
										</select>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
								@endif
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Name</label>
									<div class="col-md-6"><input type="text" name="name" class="form-control">
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Email</label>
									<div class="col-md-6"><input type="text" name="email" class="form-control">
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Mobile</label>
									<div class="col-md-6"><input type="text" name="mobile" class="form-control">
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Card Number</label>
									<div class="col-md-6"><input type="text" name="bpmID" class="form-control">
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							@if(count($roles))
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Roles</label>

									<div class="col-md-6">
										@foreach($roles as $r)
										<div class="checkbox">
											<input type="checkbox" name="roles[]" value="{{$r}}" 
																				>
											{{$r}}
										</div>
										@endforeach
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							@endif
							

						</div>
						<div class="form-group col text-center">
							<input type="submit" class="btn btn-info btn-sm" value="Save">
						</div>
					</form>
				</div>
			</section>

			@endsection