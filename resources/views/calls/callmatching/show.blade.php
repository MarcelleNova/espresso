@extends('layouts.modal')

@push('scripts')

    <script text="javascript">
        $(document).ready(function() {
            $("#unit").on("click", function() {
                $(".newUnit").toggle();
            });

            $("#update").on("click", function() {
                document.getElementById("update").submit;
            });

            $("#stage").on("click", function() {
                $(".newStage").toggle();
            });

            $("#updateStage").on("click", function() {
                document.getElementById("updateStage").submit;
            });

        });
    </script>

<script type="text/javascript">
    $(document).ready(function() {
        $(function () {
            setTimeout(function () {
                    if ($(".alert").is(":visible")){
                            //you may add animate.css class for fancy fadeout
                        $(".alert").fadeOut("fast");
                    }

                }, 4000)

            });
    });
</script>

@endpush

    <div class="container-fluid mt-5"> 

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row justify-content-center bg-secondary pt-2 pl-3 pb-2">
                                    <button type="button" class="close text-right mr-3" data-dismiss="modal" aria-label="Close"
                                    onclick="window.parent.closeModal();">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                    <div class="col-md-2 text-left text-xs">
                                        Current Stage
                                    </div>
                        
                                    <div class="col-md-8 text-left text-xs">
                                        Next Transitions
                                    </div>
                        
                                    <div class="col-md-2 text-left text-xs">
                                        Blueprint
                                    </div>
                                    <div class="row justify-content-center bg-secondary pt-1 pb-2 pl-3">
                                        <div class="col-md-2 text-left text-sm">
                                            <i class="far fa-clipboard"></i> 
                                            {{-- @role('Property Maintenance')
                                                <i class="fas fa-pencil-alt text-xs" id="stage"
                                                    type="button" title="Change Stage"
                                                    value="Click"></i>
                                            @endrole --}}
                                        </div>
                            
                                        <div class="col-md-2 text-left text-sm">
                                            {{ $job->displayName }}
                                        </div>
                                        
                             
                                    </div>
                        
                                </div>
                                <div class="row justify-content-center pt-2 pl-3">
                                    <div class="col text-left">
                                        <ul class="nav nav-tabs card-header-tabs">
                                            <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                                    href="#jobDetails">Job Details</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                    href="#jobDocuments">Documents</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                    href="#jobAttachments">Attachments</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                    href="#jobNotifications">Notifications</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="jobDetails">
                                        <div class="row justify-content-center pt-2 pl-3">
                                            <div class="col text-left">
                                                Title: <small class="text-muted">{{ $job->saicomUsername }}</small>
                                            </div>

                                            <div class="col text-left">
                                                Created: <small class="text-muted">{{ $job->created_at }}</small>
                                            </div>

                                        </div>

                                        <div class="row justify-content-center pt-0 pl-3">
                                            <div class="col text-left">
                                                Requestor: <small
                                                    class="text-muted">{{ $job->venue }}</small>
                                            </div>


                                            <div class="col text-left">
                                                Updated: <small class="text-muted">{{ $job->updated_at }}</small>
                                            </div>
                                        </div>

                                                                    <hr>
                                        <div class="row justify-content-center pt-2 pl-3">
                                            <div class="col text-left">
                                                NOTES:
                                              
                                            </div>



                                            
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="jobDocuments">
                                    
                                    </div>
                                    <div class="tab-pane fade" id="jobAttachments">
                                        <div class="row justify-content-center pt-2 pl-3">
                                            <div class="col text-left">
                                                Title: <small class="text-muted">{{ $job->saicomUserName }}</small>
                                            </div>

                                            <div class="col text-left">
                                                Created: <small class="text-muted">{{ $job->created_at }}</small>
                                            </div>

                                        </div>

                                        <div class="row justify-content-center pt-0 pl-3">
                                            <div class="col text-left">
                                                Requestor: <small
                                                    class="text-muted">{{ $job->displayName}}</small>
                                            </div>


                                            <div class="col text-left">
                                                Updated: <small class="text-muted">{{ $job->updated_at }}</small>
                                            </div>
                                        </div>

                                    
                                        <hr>
                                        <div class="row justify-content-center pt-2 pl-3">
                                            <div class="col text-left">
                                                Attachments:
                                                <div class="row justify-content-center">
                                                    <div class="col">
                                                   
                                
                                                    </div>
                                                </div>
                                            </div>



                                          
                                        </div>
                                    </div>
                                  
                               
                                        <div class="tab-pane fade" id="operations">
                                            <div class="row">

                                                <div class="col">
                                          
                                                </div>

                                                <div class="col">
                                                    <table class="table table-hover table-sm text-sm">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="3">Actual Costs:</th>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-muted">Type</th>
                                                                <th class="text-muted">Actual Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                   
                                                           

                                                        </tbody>

                                                    </table>

                                                </div>

                                            </div>

                                        </div>
                            
                                            

                                            </div>
                                      

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>


        <!-- NEW FIELD MODAL STARTS HERE -->
        <div class="modal fade" id="modal-showUnit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                        <div class="embed-responsive embed-responsive-4by3">
                            YES
                            {{-- <iframe class="embed-responsive-item" id="jobCardiFrame" allowfullscreen
                                src=""></iframe> --}}
                        </div>
                    </div>
                </div>

                <!-- /.modal-content -->
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
    </div>

