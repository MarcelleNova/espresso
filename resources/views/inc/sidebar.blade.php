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
                    <a href="{{ route('zip.create')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daily SAICOM</p>
                    </a>
                </li>
            

            </ul>
        </li>

            @can('Prop Man')
                <li class="nav-item">
                    <a href="{{ route('rap') }}" class="nav-link">

                        <p>
                            <i class="nav-icon fas fa-chart-pie"></i>Rentals Dashboard

                        </p>
                    </a>
                </li>
            @endcan
            @can('Task Management')
                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-pen-square"></i>
                        <p>
                            Task Management
                        </p>

                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('task-management.space.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Space</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('task-management.folder.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Folder</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('task-management.list.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lists</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('task-management.task.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Task</p>
                            </a>
                        </li>

                    </ul>

                </li>
            @endcan

            @can('Prop Agent')
                <li class="nav-item">
                    <a href="{{ route('agentsDashboard') }}" class="nav-link">

                        <p>
                            <i class="nav-icon fas fa-home"></i>Rental Coordinators

                        </p>
                    </a>
                </li>
            @endcan

            @can('Prop Man')
                <li class="nav-item">
                    <a href="{{ route('prop.properties.available') }}" class="nav-link">

                        <p>
                            <i class="nav-icon fas fa-building"></i>Available Properties

                        </p>
                    </a>
                </li>
            @endcan

            @can('MRP')
                <li class="nav-item">
                    <a href="{{ route('reports.mrpWorkReport') }}" class="nav-link">

                        <p>
                            <i class="nav-icon fas fa-chart-line"></i>Live Workstation Monitor

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mrp.productionorder.dashboard') }}" class="nav-link">

                        <p>
                            <i class="nav-icon fas fa-chart-pie"></i>Production Dashboard

                        </p>
                    </a>
                </li>
            @endcan
            @can('Access Control')
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">

                        <p>
                            <i class="nav-icon fas fa-chart-pie"></i>Dashboard

                        </p>
                    </a>
                </li>


                <li class="nav-header">ACCESS CONTROL</li>

                <li class="nav-item has-treeview">
                    <a href="{{ asset('pages/calendar.html') }}" class="nav-link">
                        <i class="nav-icon fas fa-thermometer-half"></i>
                        <p>
                            Temperature Scanning
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.rfidtags.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>RFID Tags</p>
                            </a>
                        </li>

                    </ul>
                </li>
            @endcan

            @can('Prop Man')


                <li class="nav-header">PROPERTY MANAGEMENT</li>

                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="fas fa-house-user"></i>
                        <p>
                            Task Lists
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bpm.jobs.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Active</p>
                            </a>
                        </li>

                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bpm.rap.processing') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Processing Dashboard</p>
                            </a>
                        </li>

                    </ul>
                    @can('BPM Admin')
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('bpm.jobs.all') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View All</p>
                                </a>
                            </li>

                        </ul>
                    @endcan

                    @can('BPM Admin')
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bpm.jobs.indexAll') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All New</p>
                            </a>
                        </li>

                    </ul>
                @endcan
                </li>

            @endcan

            @can('ATL')
                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="fas fa-building"></i>
                        <p>
                            ATL / MDF
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('prop.authority.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Authority To Lease Forms</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('prop.disclosure.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Disclosure Forms</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('prop.disclosure.createNew') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Disclosure Form</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @can('Prop Maint')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="fas fa-house-user"></i>
                            <p>
                                Property Maintenance
                            </p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('prop.properties.list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Property Details</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
            @endcan



            @can('MRP')

                @can('Partners')
                    <li class="nav-header">BUSINESS PARTNERS</li>

                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="fas fa-calculator"></i>
                            <p>
                                Business Partners
                            </p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('prt.partner.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create New</p>
                                </a>
                            </li>

                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('prt.partner.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Partners</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endcan

                @can('Sales')
                    <li class="nav-header">SALES</li>
                    @can('Sales Quotes')
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-calculator"></i>
                                <p>
                                    Quotes
                                </p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create New</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Quotes</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endcan

                    @can('Sales Orders')
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-shopping-cart"></i>
                                <p>
                                    Sales Orders
                                </p>
                                <i class="right fas fa-angle-left"></i>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('mrp.salesorder.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create New</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('mrp.salesorder.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Sales Orders</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endcan
                    @can('Delivery Notes')
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-truck"></i>
                                <p>
                                    Delivery Notes
                                </p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('mrp.deliverynote.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create New</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('mrp.deliverynote.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Delivery Notes</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endcan
                    @can('Sales Reports')
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-chart-bar"></i>
                                <p>
                                    Sales Reports
                                </p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sales by Category</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sales by Client</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sales by Item</p>
                                    </a>
                                </li>
                            </ul>

                        </li>
                    @endcan
                @endcan
                @can('Purchasing')
                    <li class="nav-header">PURCHASING</li>
                    @can('Purchase Orders')
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-cash-register"></i>
                                <p>
                                    Purchase Orders
                                </p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('mrp.purchaseorder.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create New</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('mrp.purchaseorder.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Purchase Orders</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endcan

                    @can('GRV')
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-people-carry"></i>
                                <p>
                                    Goods Receiving
                                </p>
                                <i class="right fas fa-angle-left"></i>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('mrp.goodsreceived.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create New</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('mrp.goodsreceived.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Goods Receipt Vouchers</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endcan

                    @can('Purchase Reports')
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-chart-bar"></i>
                                <p>
                                    Purchasing Reports
                                </p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Purchases by Category</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Purchases by Item</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Purchases by Supplier</p>
                                    </a>
                                </li>
                            </ul>

                        </li>
                    @endcan
                @endcan

                <li class="nav-header">MANUFACTURING</li>


                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="fas fa-city"></i>
                        <p>
                            Production Orders
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('mrp.productionorder.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Active</p>
                            </a>
                        </li>

                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('mrp.productionorder.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="fas fa-boxes"></i>
                        <p>
                            Inventory
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('inv.item.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Items</p>
                            </a>
                        </li>

                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('inv.item.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Item</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-header">MRP Setup</li>


                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="fas fa-warehouse"></i>
                        <p>
                            Warehouse
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('whs.warehouse.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>

                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('whs.warehouse.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="fas fa-desktop"></i>
                        <p>
                            Workstations
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('mrp.workstation.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>

                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('mrp.workstation.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>

                    </ul>
                </li>

            @endcan

            @role('Reporting')

                @if ($reports != null)
                    <li class="nav-header">REPORTING</li>

                    @foreach ($reports as $cat => $report)
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-chart-line"></i>
                                <p>
                                    {{ $cat }}
                                </p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            @foreach ($report as $r)
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route($r->route) }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ $r->name }}</p>
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        </li>
                    @endforeach
                @endif
            @endrole

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
                            <a href="{{ route('company.company.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Company Name</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('company.details.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Company Details</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('company.locations.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Locations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.stationery.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stationery</p>
                            </a>
                        </li>
                        @can('BPM Administrator')
                            <li class="nav-item">
                                <a href="{{ route('bpm.blueprints.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Blueprints</p>
                                </a>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ route('admin.rfidtags.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>RFID Tags</p>
                            </a>
                        </li>

                    </ul>
                </li>

                @can('BPM Admin')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-sitemap"></i>
                            <p>
                                Workflow Setup
                            </p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('bpm.blueprints.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Blueprints</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-laptop"></i>
                        <p>
                            Assets
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.assets.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Assets</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.asset_categories.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Asset Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.asset_categories.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Asset Maintenance</p>
                            </a>
                        </li>

                    </ul>
                </li>

                </li>
            @endcan
            @role('Super Admin')
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
                            <a href="{{ route('admin.asset_types.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Asset Types</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.asset_types.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Maintenance Types</p>
                            </a>
                        </li>

                    </ul>
                </li>
            @endrole
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