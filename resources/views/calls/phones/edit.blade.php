@extends('layouts.admin')

@push('scripts')
<script type="text/javascript">
	jQuery.noConflict();
	(function($) {
	// Your select2 code here

			$(document).ready(function() {
				$('#ajax_search2').select2({delay:500, openActive:true});
			})

			$(document).ready(function() {
				$('#ajax_search2').select2({
					minimumInputLength: 1,
					ajax: {
						url: '{{ route('admin.bitrix.getActiveUsers') }}',
						dataType: 'json',
					},
				});
			});

			$(document).ready(function() {
				$('#ajax_search').select2({delay:500, openActive:true});
			})

			$(document).ready(function() {
				$('#ajax_search').select2({
					minimumInputLength: 1,
					ajax: {
						url: '{{ route('admin.bitrix.getActiveUsers') }}',
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
					<li class="breadcrumb-item"><a href="{{route('calls.phones.index')}}">Phones</a></li>
					<li class="breadcrumb-item active">Phone Movement</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
				<div class="card">
					<div class="card-header bg-secondary">
						<div class="ml-2 card-title text-sm">Manage Extension <b>  {{ $active->phone->extension}} @if($active)<span class="mx-3 bg-success px-3 py-1">ACTIVE</span>@else<span class="mx-3 bg-danger px-3 py-1">NOT ACTIVE</span> @endif </b>  </div> 
						<span class="float-right"><a href="{{route('home')}}" class="text-white text-bold" title="Close & Exit">X</a></span>

					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<div class="form-group">
							@if($active)
							<div class="row mb-1">
								<span class="col-md-2 text-sm">Name: </span>
								<div class="col-md-3 form-control form-control-sm">
									{{ $active->phone->displayName}}
								</div>
								<div class="col-md-1"></div>
								<span class="col-md-2 text-sm my-auto">Venue:</span>
								<div class="col-md-3 form-control form-control-sm">
									{{ $active->Venue->name}}
								</div>
							</div>
							<div class="row mb-1">
								<span class="col-md-2 text-sm">Assigned To: </span>
								<div class="col-md-3 form-control form-control-sm">
									{{ $active->assignedToUserID}} - {{ $active->assignedToUserName}}
								</div>
								<div class="col-md-1"></div>
								<span class="col-md-2 text-sm my-auto">Venture:</span>
								<div class="col-md-3 form-control form-control-sm">
									{{ $active->Venture->name}}
								</div>
							</div>
							<div class="row mb-1">
								<span class="col-md-2 text-sm">Assigned Date: </span>
								<div class="col-md-3 form-control form-control-sm">
									{{ $active->assigned_date}}
								</div>
								<div class="col-md-1"></div>
								<span class="col-md-2 text-sm my-auto">Site: </span>
								<div class="col-md-3 form-control form-control-sm">
									{{ $active->site }}
								</div>
							</div>
							<div class="row mb-1">
								<span class="col-md-2 text-sm my-auto">Updated By: </span>
								<div class="col-md-3 form-control form-control-sm">
									{{ $active->user->name}}
								</div>
								<div class="col-md-6"></div>
							</div>
							@else
								<div> Not currently active</div>
							@endif

						</div>
					</div>
				
						<div class="card-header bg-secondary text-white text-sm">
							<h3 class="ml-2 card-title text-sm">History of Phone Movement</h3> 
						</div>
						<div class="card-body">
							<div class="form-group mt-2">
								<table class="table table-bordered table-hover table-sm text-sm">
									<thead>
										<tr>
											<th>Active</th>
											<th>Extension</th>
											<th>Name</th>
											<th>Venue</th>
											<th>Venture</th>
											<th>Site</th>
											<th>Assigned To</th>
											<th>Assigned Date</th>
											<th>Removed Date</th>	
											<th>Moved By</th>									
										</tr>
									</thead>
									<tbody>
										@if(count($phones))
											@foreach ($phones as $p )
											<tr @if ($p->active != '1') class=" text-secondary"@else class="text-dark" @endif>
												<td scope="col">{{$p->active}}</td>
												<td scope="col">{{$p->phone->extension}}</td>
												<td scope="col">{{$p->phone->displayName}}</td>
												<td scope="col">{{$p->Venue->name}}</td>
												<td scope="col">{{$p->Venture->name}}</td>
												<td scope="col">{{$p->site}}</td>
												<td scope="col">{{$p->assignedToUserID}} - {{$p->assignedToUserName}}</td>
												<td scope="col">{{$p->assigned_date}}</td>
												<td scope="col">{{$p->removed_date}}</td>
												<td scope="col">{{$p->user->name}}</td>
											</tr>
											
											@endforeach
										@else
										<tr><td colspan="5">No phone data</td></tr>
										@endif
									</tbody>
								
								</table>
							</div>
				
							<div class="form-group">
								<div class="row float-right">
									@can('Super User')
									<span class="col-md-3">
										<input type="submit" class="btn btn-info btn-sm" value="Update Extension Details" data-toggle="modal" data-target="#modal-second">
									</span>
									@endcan
								</div>
								<div class="row float-right">
									<div class="col-md-3 mx-2">
										{{-- <a href="{{ route('calls.phones.edit',$active->id) }}" class="btn btn-info btn-xs">  Edit</a>  --}}
										<input type="submit" class="btn btn-info btn-sm" value="Assign to another TSR" data-toggle="modal" data-target="#modal-default">

									</div>

								</div>
								
							</div>
					
					</form>
				</div>

				<!-- MODAL STARTS HERE -->
				<div class="modal fade" id="modal-default">
					<div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title">Extension TSR Update</h3>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="{{ route('calls.phones.doTSRUpdate')}}">
									@method('PUT')
										@csrf
										<input type="hidden" name="phone" value="{{$active->phone->id}}">
										<input type="hidden" name="active" value="{{$active}}">
										<div class="row mb-5">
											<label class="col-md-3">
												Select Active Bitrix User
												<span class="text-danger"></span>
											</label>
											<div class="col-md-6 input-group " style="width:100%">
												<select name="newTSRUser" id="ajax_search2" style="width:100%" required class="form-control select2">
													<option value="">Please select</option>
												</select>
											</div>
										</div>
										<div class="clearfix"></div>
									
										<div class="row">
											<div class="form-group col text-center">
												<input type="submit" class="btn btn-info btn-sm" value="Confirm Update to this TSR">
											</div>
										</div>
											
								</form>
							</div>
							<div class="modal-footer justify-content-between">
								
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>

				<!-- SECOND MODAL STARTS HERE -->
				<div class="modal fade" id="modal-second">
					<div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title">Update Extension Details</h3>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body ml-5">
								<form method="post" action="{{ route('calls.phones.doExtensionUpdate')}}">
									@method('PUT')
										@csrf
										<input type="hidden" name="phone" value="{{$active->phone->id}}">
										<input type="hidden" name="active" value="{{$active}}">
										<div class="row mb-1">
											<span class="col-md-3 text-sm">Name: </span>
											<div class="col-md-5 col-sm"><input type="text" name="displayName"
												value="{{ $active->phone->displayName}}" class="form-control form-control-sm">
										</div>
										</div>
										<div class="row mb-1">
											<span class="col-md-3 text-sm">Venue:</span>
											<select class="col-md-5 col-sm form-control form-control-sm ml-2" name="venue" id="venue" value="{{ isset($active->Venue->id) ? $active->Venue->id : ''  }}">
												<option value=""></option>
												@foreach ($venues as $venue)
													<option value="{{ $venue->id }}"
														@if ($venue->id == $active->Venue->id) selected @endif>
														{{ $venue->name }}
													</option>
												@endforeach
											</select>
										</div>
										<div class="row mb-1">
											<span class="col-md-3 text-sm">Venture:</span>
											<select class="col-md-5 col-sm form-control form-control-sm ml-2" name="venture" id="select-box-venture">
												<option value=""></option>
												@foreach ($ventures as $venture)
													<option value="{{ $venture->id }}"
														@if ($venture->name == $active->Venture->name) selected @endif>
														{{ $venture->name }}
													</option>
												@endforeach
											</select>
											
										
										</div>
										<div class="row mb-1">
											<span class="col-md-3 text-sm my-auto">Site: </span>
											<div class="col-md-5 col-sm"><input type="text" name="site"
												value="{{ $active->site }}" class="form-control form-control-sm">
											</div>
										</div>
										<div class="row mb-5">
											<span class="col-md-3 text-sm">Assigned To: </span>
											<div class="col-md-5 input-group " style="width:100%">
												<select name="newTSRUser" id="ajax_search" style="width:100%" required class="form-control select2" >
													<option value="{{ $active->assignedToUserID}}">{{ $active->assignedToUserID}} - {{ $active->assignedToUserName}}</option>
												</select>
											</div>
										</div>
										<div class="clearfix"></div>
									
										<div class="row">
											<div class="form-group col text-center">
												<input type="submit" class="btn btn-info btn-sm" value="Confirm Update">
											</div>
										</div>
											
								</form>
							</div>
							<div class="modal-footer justify-content-between">
								
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>


				
	</section>
@endsection