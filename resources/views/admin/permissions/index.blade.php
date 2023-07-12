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
					<li class="breadcrumb-item active">Permission Management</li>
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
						<h3 class="card-title">Permissions</h3>
						<button type="button" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#modal-default">
							Add Permission
						</button>
					</div>
					<!-- /.card-header -->
					<div class="card-body">


						<table id="indextable" class="table table-bordered table-hover table-sm text-sm">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@if(count($permissions))
								@foreach($permissions as $p)
								<tr>
									<td>{{ $p->id }}</td>
									<td>{{ $p->name }}</td>
									<td><a href="{{ route('admin.permissions.edit',$p->id) }}" class="btn btn-info btn-xs">Edit</a> 
										<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-xs">Delete</a>
										<form action="{{route('admin.permissions.destroy',$p->id) }}" method="post">
											@method('DELETE')
											<input type="hidden" name="_token" value="{{ csrf_token() }}" >
										</form>
										
									</td>
								</tr>

								@endforeach
								@else
								<tr><td colspan="5">No Permissions</td></tr>
								@endif
							</tbody>
						</table>

					</div>

					

					<!-- MODAL STARTS HERE -->
					<div class="modal fade" id="modal-default">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h3 class="modal-title">Add Permission</h3>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form method="post" action="{{ route('admin.permissions.store') }}">
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
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
				</section>



				@endsection
