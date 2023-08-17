@extends('layouts.admin')


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('.fileform').submit(function() {
                $("input[type='submit']", this)
                    .val("Please Wait...")
                    .attr('disabled', 'disabled');
                return true;
            });
        });
    </script>

    <script>
        $('form').ajaxForm({
            beforeSend: funtion() {
                var precentVal = '0%';
                bar.width(percentVal);
                percent.html(percentVal);
            },
            uploadProgress:finction(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.witch(percentVal)
                percent.html(percentVal);
            },
            complete: function(xhr) {
                aler('File Has been Uoloaded Successfully');
                wondown.locaton.href = SITEURL +"/"+"ajax-file-upload-progress-bar";
            }
        });
    </script>
@endpush

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right text-sm">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Import</li>
                </ol>
            </div>
        </div>
    </div>
</div>

   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-info">
                <h6 class="mb-0">SAICOM Daily Call Import for Simon</h6>
            </div>
            <div class="card-body">

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <strong>{{ $message }}</strong>
                </div>

                @endif

                {{-- <p> {{session('status')}} </p> --}}
                {{-- Unzip Part --}}
                <form action="{{ url('calls/unzip') }}" class="fileform" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-5">
                        <span class="col-md-3 text-sm my-auto">Zip file destination</span>
                        <div class="col-md-4 col-sm"><input type="file" name="zip" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-4">
                            <input type="submit" class="btn btn-info btn-sm" value="Unzip">
                        </div>     
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
                            The zip file will be extracted to public_path app/uploads/unzip/
                        </div>
                    </div>
                </form>

                <div class="row mt-5">

                </div>
               {{-- Break big zip into smaller csv files --}}
                <form action="{{ url('calls/store') }}" method="POST" class="fileform" enctype="multipart/form-data">
                    @csrf         
                      
                    <div class="row mb-5 form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                        <span class="col-md-3 text-sm my-auto">Choose Csv file to Import</span>
                        <div class="col-md-4 col-sm"><input id="file" type="file" name="file" class="form-control form-control-sm" required>
                        </div>
                
                        @if ($errors->has('file'))
                        <span class="help-block">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                        @endif

                       

                        <div class="col-md-4">
                            <input type="submit" class="btn btn-sm btn-info" name="submit" value="Chunk CSV">
                        </div>
                    </div>
                    <div class="row">
                        <div class="progress">
                            <div class="bar"></div>
                            <div class="percent">0%</div>
                        </div>
                    </div>
                </form>

                <form action="{{ url('import-calls-do') }}" method="GET" enctype="multipart/form-data">
                    @csrf         
                      
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-danger float-right">Save to DB</button>
                        </div>
                
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</section>




@endsection