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
					{{-- <li class="breadcrumb-item"><a href="{{route('company.company.index')}}">Company</a></li> --}}
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
						<h3 class="card-title">Edit User</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<form method="post" action="{{ route('users.update', $user->id) }}">
							@method('PUT')
							<input type="hidden" name="_token" value="{{ csrf_token() }}" >
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Name</label>
									<div class="col-md-6"><input type="text" name="name" class="form-control" value="{{ $user->name }}">
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Email</label>
									<div class="col-md-6"><input type="text" name="email" class="form-control" value="{{ $user->email }}">
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Mobile</label>
									<div class="col-md-6"><input type="text" name="mobile" class="form-control" value="{{ $user->mobile }}">
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Card Number</label>
									<div class="col-md-6"><input type="text" name="bpmID" class="form-control" value="{{ $user->bpmID }}">
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Roles</label>

									<div class="col-md-6">
										@foreach($roles as $r)
										<div class="checkbox">
											<input type="checkbox" name="roles[]" value="{{$r}}"
											<?php

											$user_roles = $user->roles->pluck('name')->toArray();
											if(in_array($r, $user_roles)){
												echo "checked";
											}
											?>
											>
											{{$r}}
										</div>
										@endforeach
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							@can('Super Admin')
							<div class="form-group">
								<div class="row">
									<label class="col-md-3">Reports</label>

									<div class="col-md-6">
										@foreach($reports as $r)
										<div class="checkbox">
											<input type="checkbox" name="reports[]" value="{{$r->id}}"
											<?php

											$user_reports = $user->reports->pluck('id')->toArray();
											if(in_array($r->id, $user_reports)){
												echo "checked";
											}
											?>
											>
											{{$r->category}} - {{$r->name}}
										</div>
										@endforeach
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							@endcan

						</div>
						<div class="form-group col text-center">
							<input type="submit" class="btn btn-info btn-sm" value="Save">
						</div>
					</form>
				</div>
			</section>

			@endsection
