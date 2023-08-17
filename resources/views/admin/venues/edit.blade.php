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
					<li class="breadcrumb-item active">Venue Management</li>
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
						<h3 class="card-title">Manage Venues</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<form method="post" action="{{ route('admin.venues.update', $venue->id) }}">
							@method('PUT')
							@csrf
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Code</label>
									<div class="col-md-6"><input type="text" name="code" class="form-control" value="{{ $venue->code }}">
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Name</label>
									<div class="col-md-6"><input type="text" name="name" class="form-control" value="{{ $venue->name }}">
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Description</label>
									<div class="col-md-6"><input type="text" name="description" class="form-control" value="{{ $venue->description }}">
									<div class="col-md-6">
								
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="form-group col text-center">
							<input type="submit" class="btn btn-info btn-sm" value="Save">
						</div>
					</form>
				</div>
			</section>

			@endsection