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
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Users</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">

						<a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-xs">Add New User</a>

						<table id="indextable" class="table table-bordered table-hover table-sm text-sm">
							<thead>
								<tr>
									<th>ID</th>
									<th>Company</th>
									<th>Name</th>
									<th>Email</th>
									<th>Mobile</th>
									<th>Avatar</th>
									<th>Roles</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@if(count($users))
								@foreach($users as $u)
								<tr>
									<td>{{ $u->id }}</td>
									<td>{{ $u->company->companyName }}</td>
									<td>{{ $u->name }}</td>
									<td>{{ $u->email }}</td>
									<td>{{ $u->mobile }}</td>
									<td>{{ $u->avatar }}</td>
									<td>
										@foreach($u->getRoleNames() as $r)
										@if($r === 'Super Admin')
										@else
										{{ $r }} | 
										@endif
										@endforeach
									</td>
									<td><a href="{{ route('admin.users.edit',$u->id) }}" class="btn btn-info btn-xs">Edit</a> 
										<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-xs">Delete</a>
										<form action="{{route('admin.users.destroy',$u->id) }}" method="post">
											@method('DELETE')
											<input type="hidden" name="_token" value="{{ csrf_token() }}" >
										</form>
									</td>
								</tr>

								@endforeach
								@else
								<tr><td colspan="5">No Asset Categories Found</td></tr>
								@endif
							</tbody>
						</table>

					</div>

					<!-- MODAL STARTS HERE -->
					<div class="modal fade" id="modal-default">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Default Modal</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>One fine body&hellip;</p>
								</div>
								<div class="modal-footer justify-content-between">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary">Save changes</button>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</section>



					@endsection

