@extends('layouts.admin')

@push('scripts')



@endpush

@section('content')


<!-- Content Header (Page header) -->

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Sales Calls Midday Dials</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Sales Calls Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ count($allCalls) }}</h3>

            <p>Calls </p>
          </div>
          <div class="icon">
            <i class="fas fa-cogs"></i>
          </div>
          {{-- <a href="{{ route('bpm.rap.processing') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ count($answered) }}</h3>

            <p><strong>Answered - </strong>  {{ date('D') }}  {{ date('d')}} {{date('M')}} {{date('Y')}}</p>
          </div>
          <div class="icon">
            <i class="fas fa-envelope-open-text"></i>
          </div>
          {{-- <a href="{{ route('bpm.jobs.all') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
        <div class="inner">
          {{-- <h3>{{ count($approved) }}</h3> --}}

          <p> {{date('M')}} {{date('Y')}}</p>
        </div>
        <div class="icon">
          <i class="far fa-check-circle"></i>
        </div>
        {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          {{-- <h3>{{ count($withdrawn) }}</h3> --}}

          {{-- <p>Apps withdrawn {{date('M')}} {{date('Y')}}</p> --}}
        </div>
        <div class="icon">
          <i class="far fa-times-circle"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
   
  </div>
  <!-- /.row -->
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <section class="col-lg-6 connectedSortable">
      <!-- Custom tabs (Charts with tabs)-->
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">
              <i class="fas fa-chart-line"></i>
              Extention Call Activity
            </h4>
          <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
              <!--<li class="nav-item">
                <a class="nav-link" href="#sales-chart" data-toggle="tab">Table</a>
              </li>-->
              <li class="nav-item">
                {{-- <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Apps</a> --}}
              </li>
            </ul>
          </div>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content p-0">
            <!-- Morris chart - Sales -->
            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 250px;">
            <canvas id="revenue-chart-canvas1" height="300" style="height: 300px;"></canvas>                         
          </div>
          <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 250px;">
              <!-- Date and time range -->
                <!-- /.form group -->
           
          </div>  
        </div>
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->


</section>
<!-- /.Left col -->
<!-- right col (We are only adding the ID to make the widgets sortable)-->
<section class="col-lg-6 connectedSortable">

  <div class="card">
              <div class="card-header">
                <h4 class="card-title">
                  <i class="fas fa-home"></i>
                  Sales Activity
                </h4>
              
              <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <!--<li class="nav-item">
                  <a class="nav-link" href="#sales-chart" data-toggle="tab">Table</a>
                </li>-->
                <li class="nav-item">
                  {{-- <a class="nav-link active" href="#revenue-chart" data-toggle="tab">New</a> --}}
                </li>
              </ul>
            </div>
            </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table id="indextable" class="table table-bordered table-hover table-sm text-sm">
              <thead>
                <tr>

                  
                  <th>Extention</th>
                  <th>Calls Made</th>
                
                </tr>
              </thead>
              <tbody>

              
              @foreach ($calls as $key=>$c)
                <tr>
                  <td><small>{{$key}}</small></td>
                  <td><small>{{count($c)}}</small></td>
                </tr>

                
              @endforeach 
              {{-- @if(isset($props))
              @foreach($props->data as $p)
                <tr>

                  
                  <td><small>{{ $p->phl_Type }}</td>
                  <td><small>{{ $p->phl_Suburb }}</td>
                  <td><small>{{ $p->phl_Address }}</td>
                  <td><small>{{ round($p->phl_Bedrooms, 0) }}</td>
                  <td><small>{{ $p->phl_Rent }}</td>
                  <td><small>{{ $p->phl_Date_Listed }}</td>

                </tr>
                @endforeach
                @else
                <tr><td colspan="8">No Properties Found</td></tr>
                @endif --}}
              </tbody>
            </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </section>



@endsection

@push('scripts')  


<script src="{{ asset('dist/js/callDashBoard.js') }}"></script>

@endpush

