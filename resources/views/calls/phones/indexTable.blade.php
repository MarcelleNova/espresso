@extends('layouts.admin')

@push('scripts')

 <!-- DataTables -->
 <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
	
{{-- <script type="text/javascript">
	function showJobCard(url) {
		console.log('Call to top script', url);
		document.getElementById('jobCardiFrame').src = url;
		$('#modal-showJobCard').modal('show');

	}

	window.closeModal = function() {
		$('#modal-showJobCard').modal('hide');
	};
</script> --}}

<script>
    $('body').on('click','.showJob', function show(id){
        var jobID = $(this)[0].value;
        let url = "{{ route('calls.phones.show', ':id') }}";
        url = url.replace(':id', jobID);
        $('#modal-showJobCard').load(url, function(){
        /* load finished, show dialog */
        $('#modal-showJobCard').modal('show')
    });

    });
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
						<h3 class="card-title">Phones</h3>
						<button type="button" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#modal-default">
							Add Phone
						</button>
					</div>
					<!-- /.card-header -->
					<div class="card-body">

						{{ $dataTable->table() }}

					</div>

					

					<!-- MODAL STARTS HERE -->
					{{-- <div class="modal fade" id="modal-showJobCard">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h3 class="modal-title">Add Phone</h3>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form method="post" action="{{ route('calls.phones.store') }}">
										@csrf
											{{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" > 
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
					</div> --}}


					    <!-- NEW FIELD MODAL STARTS HERE -->
			<div class="modal fade" id="modal-showJobCard" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
					<div class="modal-content">
						<div class="modal-body">

							<div class="embed-responsive embed-responsive-4by3">

								<iframe class="embed-responsive-item" id="jobCardiFrame" allowfullscreen src=""></iframe>
							</div>
						</div>
					</div>

            <!-- /.modal-content -->
        </div>
    </div>
    <!-- /.modal-dialog -->



				</section>



	@endsection

	@push('scripts')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/datatables.min.js"></script>

{{-- <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script> --}}
	<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.2.1/js/buttons.print.min.css" rel="stylesheet">
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}
	{{-- <script src="https://cdn.datatables.net/1.2.1/js/buttons.print.min.js"></script> --}}
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/cr-1.5.4/datatables.min.js"></script>
{{ $dataTable->scripts() }}





	{{-- <script type="text/javascript">
		function populateChild(field,child,childField)
		{
			//alert(child + '_add');
			var selection = document.getElementById(field);
			var childSelect = document.getElementById(child);
			childSelect.innerHTML = "";

			document.getElementById(child + '_add').style.display = 'block';
			childSelect.disabled = false;
			childSelect.setAttribute("data-parent", field);

			var children = selection.options[selection.selectedIndex].dataset.children;

			var options = JSON.parse(children);



			for( var i = 0; i < options.length; i++) {
				var opt = options[i];
				childSelect.innerHTML += "<option value=\"" + opt.id + "\">" + opt[childField] + "</option>";
				//alert(opt[childField]);
			}

			}


	</script>

	<script type="text/javascript">
		function createModal(thisField,fieldLabel,fieldName,route){

			//alert(thisField);
			document.getElementById('modal-title').innerHTML = 'Add ' + fieldLabel;
			document.getElementById('modal-field-label').innerHTML = fieldLabel;
			document.getElementById('modal-field-name').setAttribute("name", fieldName);
			document.getElementById('modal-form').action = route;
			document.getElementById('destination').value = window.location.href;
			var thisField = document.getElementById(thisField);
			if(thisField.dataset.parent!==""){
				var parent = thisField.dataset.parent;
				document.getElementById('modal-parent-label').innerHTML = document.getElementById(parent).dataset.label;
				document.getElementById('modal-parent-value').value = document.getElementById(parent).options[document.getElementById(parent).selectedIndex].text;
				document.getElementById('belongsTo').value = document.getElementById(parent).options[document.getElementById(parent).selectedIndex].value;
				document.getElementById('modal-parent').style.display = 'block';

				//alert(parent);
			}

			$('#modal-field').modal('show');
		}

	</script>

	<script type="text/javascript">
		function submitForm(){
			var form = document.getElementById('modal-form');

			form.submit(function(e){
				e.preventDefault();

				$.ajax({
					url: form.attr('action'),
					type: form.attr('method'),
					dataType: 'json',
					data: form.serialize(),
					success: function(result){
						alert(result);
					}
				})
			})
		}
	</script> --}}

@endpush

