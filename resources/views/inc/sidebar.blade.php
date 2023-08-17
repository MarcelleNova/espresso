<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <!--<img src="{{ asset('/app/img/LogoLife.png') }}" class="img-circle elevation-2" alt="User Image">-->
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->

        {{-- PHONES --}}

        <li class="nav-header">PHONE MANAGEMENT</li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-cogs"></i>
                <p>
                    Movement
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
 
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('calls.phones.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Phones</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('calls.phones.phone.indexTable')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Phones Master</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-compass"></i>
                <p>
                    Dialing Trackers
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('calls.report.range')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Call Report
                        </p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-link"></i>
                <p>
                    Call Matching
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('calls.calldata.create')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Full Day Call Import</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('calls.calldata.create.midday')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Midday Call Import</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('calls.callmatching.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Run Call Mathing
                        </p>
                    </a>
                </li>
            </ul>
        </li> 
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-mobile"></i>
                <p>
                    CLI
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-ban"></i>
                <p>
                    Spam
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
        </li>
        @can('Super User')
        <li class="nav-header">SALES</li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-signal"></i>
                <p>
                    Sales Trackers (Billboard)
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('calls.zip.create')}}" class="nav-link">
                        <i class="far fa-bell nav-icon"></i>
                        <p>Billboard</p>
                    </a>
                </li>
            </ul>
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-eye"></i>
                <p>
                    Sales Stats Focus
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-align-left"></i>
                <p>
                    Batch Stats
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-percent"></i>
                <p>
                    Current Sales view
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
        </li>
        @endcan
            {{-- HR --}}
        @can('Super User')
        <li class="nav-header">HUMAN RESOURCES</li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Employee Roll
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
            {{-- <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('calls.zip.create')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Billboard</p>
                    </a>
                </li> 
            </ul> --}}
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Leave Submissions
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Templates
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-upload"></i>
                <p>
                    Contract Upload
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
        </li>
        @endcan
        @can('Super User')
              {{-- DATA CONTROL --}}
              <li class="nav-header">DATA CONTROL</li>
              <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-spinner"></i>
                      <p>
                        Lead Import
                      </p>
                      <i class="right fas fa-angle-left"></i>
                  </a>
                  {{-- <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('calls.zip.create')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Billboard</p>
                          </a>
                      </li>
                  </ul> --}}
                  <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-undo"></i>
                      <p>
                        Lead Export
                      </p>
                      <i class="right fas fa-angle-left"></i>
                  </a>
                  <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-adjust"></i>
                      <p>
                        Lead Allocation
                      </p>
                      <i class="right fas fa-angle-left"></i>
                  </a>
                  <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-inbox"></i>
                      <p>
                        Invoicing
                      </p>
                      <i class="right fas fa-angle-left"></i>
                  </a>
              </li>
            @endcan
            @can('Super User')
            {{-- Finance --}}
            <li class="nav-header">FINANCE</li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-recycle"></i>
                    <p>
                        Recons
                    </p>
                    <i class="right fas fa-angle-left"></i>
                </a>
                {{-- <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('calls.zip.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Billboard</p>
                        </a>
                    </li>
                </ul>--}}
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-random"></i>
                    <p>
                        Invoices and Payment
                    </p>
                    <i class="right fas fa-angle-left"></i>
                </a>
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-check"></i>
                    <p>
                        Authorisation
                    </p>
                    <i class="right fas fa-angle-left"></i>
                </a>
         
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-heartbeat"></i>
                    <p>
                        Expense Analysis
                    </p>
                    <i class="right fas fa-angle-left"></i>
                </a>
               
            </li>

            @endcan
            @can('Super User')
        <li class="nav-header">CALL MANAGEMENT</li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                    Imports
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('calls.zip.create')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daily SAICOM</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-phone"></i>
                <p>
                    Phones
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('calls.phones.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Movements</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('calls.saicom.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Saicom Table</p>
                    </a>
                </li>
            </ul>

            
        </li>
        @endcan

        @can('Super User')
            @can('Company Administrator')
                <li class="nav-header">ADMINISTRATION</li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            Organisation
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                    
                  
                        <li class="nav-item">
                            <a href="{{ route('admin.venues.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Venues</p>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="{{ route('admin.ventures.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ventures</p>
                            </a>
                        </li> 

                    </ul>
                </li>



                </li>
          
                @can('Super Admin')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Configuration
                            </p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li> 
         

                        </ul>
                    </li>
                @endcan
            @endcan
            @endcan
            <li class="nav-header">ACTIONS</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="nav-icon far fa-circle text-danger"></i>
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                    style="display: none;">
                    @csrf
                </form>

            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>