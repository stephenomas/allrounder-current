
<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <div class="user-details">
            <div class="text-center">
                <img style="width: 50%; height: 60%;" src=@if (!empty(Auth::user()->photo))
                {{asset(Auth::user()->photo)}}
                @else
                {{asset('assets/images/users/avatar-1.jpg')}}
                @endif alt="" class="rounded-circle img-thumbnail">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{Auth::user()->name}}</a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)" class="dropdown-item"> Profile</a></li>
                        <li><a href="javascript:void(0)" class="dropdown-item"><span class="badge badge-success float-right">5</span> Settings </a></li>
                        <li><a href="javascript:void(0)" class="dropdown-item"> Lock screen</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a href="javascript:void(0)" class="dropdown-item"> Logout</a></li>
                    </ul>
                </div>

                <p class="text-muted m-0"><i class="far fa-dot-circle text-primary"></i> Online</p>
            </div>
        </div>
        <!--- Divider -->

        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                @if (Auth::user()->role == 1 or Auth::user()->access->dashboard == 1)
                <li>

                    <a href="/dashboard" class="waves-effect"><i class="ti-home"></i><span> Dashboard </span></a>
                </li>
                @endif

                @if (Auth::user()->role == 1  )
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-bar-chart"></i><span> Brand </span><span class="float-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">

                        <li><a href="/add-brand">Add Brand</a></li>
                        <li><a href="/view-brand">View Brands</a></li>


                    </ul>
                </li>
                @endif

                @if (Auth::user()->role == 1  )
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-bar-chart"></i><span> Model </span><span class="float-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">

                        <li><a href="/add-model">Add Model</a></li>


                        <li><a href="/view-model">View Models</a></li>



                    </ul>
                </li>
                @endif

                @if (Auth::user()->role == 1 or Auth::user()->access->addproduct == 1 or Auth::user()->access->viewproduct == 1 )
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-layout"></i><span> Products </span><span class="float-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        @if (Auth::user()->role == 1 or Auth::user()->access->addproduct == 1 )
                        <li><a href="/add-products">Add product</a></li>
                        @endif
                        @if (Auth::user()->role == 1 or Auth::user()->access->viewproduct == 1 )
                        <li><a href="/view-products">View Products</a></li>
                        @endif
                        @if (Auth::user()->role == 1 or Auth::user()->access->viewproduct == 1 )
                        <li><a href="/sold-products">Sold products</a></li>
                        @endif
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><span> Inventory </span><span class="float-right"><i class="mdi mdi-plus"></i></span></a>
                            <ul class="list-unstyled">
                                @if (Auth::user()->role == 1 or Auth::user()->access->viewproduct == 1 )
                                <li><a href="/view-inventory">View Inventory</a></li>
                                @endif
                                @if (Auth::user()->role == 1 or Auth::user()->access->viewproduct == 1 )
                                <li><a href="{{route('inventory.search')}}">Stock History</a></li>
                                @endif
                                @if (Auth::user()->role == 1 or Auth::user()->access->viewproduct == 1 )
                                <li><a href="{{route('inventory.added')}}">Added Stock History</a></li>
                                @endif
                                @if (Auth::user()->role == 1 or Auth::user()->access->viewproduct == 1 )
                                <li><a href="/view-stats">View Statistics</a></li>
                                @endif
                            </ul>
                        </li>


                    </ul>
                </li>
                @endif



                @if (Auth::user()->role == 1 or Auth::user()->access->warehouse == 1 )
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-layout"></i><span> Warehouse Transfer </span><span class="float-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">

                        <li><a href="/transfer-cbu">CBU Transfer</a></li>
                        <li><a href="/transfer-ckd">CKD Transfer</a></li>
                        <li><a href="/warehouse-transfers">Transfer History</a></li>
                        @if (App\Helpers\Utilities::notification())
                        <li><a href="/warehouse-incoming"><i class="ti-envelope text-danger bg-danger mr-1"></i>Incoming</a></li>
                        @endif

                    </ul>
                </li>
                @endif


                @if (Auth::user()->role == 1 or Auth::user()->access->addproduct == 1 or Auth::user()->access->viewproduct == 1 )
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-layout"></i><span> CKD </span><span class="float-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        @if (Auth::user()->role == 1 or Auth::user()->access->addproduct == 1 )
                        <li><a href="/add-ckd">Add CKD</a></li>
                        @endif
                        @if (Auth::user()->role == 1 or Auth::user()->access->viewproduct == 1 )
                        <li><a href="/view-ckd">View CKD</a></li>
                        @endif
                        @if (Auth::user()->role == 1 or Auth::user()->access->viewproduct == 1 )
                        <li><a href="/ckdhistory">View CKD History</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- @if (Auth::user()->role == 1 or Auth::user()->access->addproduct == 1 or Auth::user()->access->viewproduct == 1 )
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-layout"></i><span> Bajaj Cart/Steel </span><span class="float-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        @if (Auth::user()->role == 1 or Auth::user()->access->addproduct == 1 )
                        <li><a href="/add-steel">Add Bajaj Cart/Steel</a></li>
                        @endif
                        @if (Auth::user()->role == 1 or Auth::user()->access->viewproduct == 1 )
                        <li><a href="/view-steel">View Bajaj Cart/Steel</a></li>
                        @endif
                        @if (Auth::user()->role == 1 or Auth::user()->access->viewproduct == 1 )
                        <li><a href="/steelhistory">View History</a></li>
                        @endif
                    </ul>
                </li>
                @endif --}}


                @if (Auth::user()->role == 1 or Auth::user()->access->numberlist == 1 or Auth::user()->access->addnumber == 1 )
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-bar-chart"></i><span> Number Plate </span><span class="float-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        @if (Auth::user()->role == 1 or Auth::user()->access->addnumber == 1 )
                        <li><a href="/add-number">Add Number Plate</a></li>
                        @endif
                        @if (Auth::user()->role == 1 or Auth::user()->access->numberlist == 1 )
                        <li><a href="/number-list">Number Plates List</a></li>
                        @endif


                    </ul>
                </li>
                @endif

                @if (Auth::user()->role == 1 or Auth::user()->access->saleslist == 1 or Auth::user()->access->newsale == 1 )
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-bar-chart"></i><span> Sales </span><span class="float-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        @if (Auth::user()->role == 1 or Auth::user()->access->saleslist == 1 )
                        <li><a href="/sales-list">Sales List</a></li>
                        @endif
                        @if (Auth::user()->role == 1 or Auth::user()->access->newsale == 1 )
                        <li class="has_sub"><a href="javascript:void(0);" class="waves-effect">New Sale<span class="float-right"><i class="mdi mdi-plus"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="/new-sale">CBU sale</a></li>
                                <li><a href="/new-sale-ckd">CKD sale</a></li>
                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->role == 1 or Auth::user()->access->saleslist == 1 )
                        <li><a href="/sales-report">Sale Report</a></li>
                        @endif

                    </ul>
                </li>
                @endif

                @if (Auth::user()->role == 1 or Auth::user()->access->adduser == 1 or Auth::user()->access->viewuser == 1 )
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i><span> Users </span><span class="float-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        @if (Auth::user()->role == 1 or Auth::user()->access->adduser == 1 )
                        <li><a href="{{route('user.create')}}">Add user</a></li>
                        @endif
                        @if (Auth::user()->role == 1 or Auth::user()->access->viewuser == 1 )
                        <li><a href="{{route('user.index')}}">View Users</a></li>
                        @endif


                    </ul>
                </li>
                @endif

                @if (Auth::user()->role == 1 or Auth::user()->access->addbranch == 1 or Auth::user()->access->viewbranch == 1 )
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-vector"></i><span> Branches </span><span class="float-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        @if (Auth::user()->role == 1 or Auth::user()->access->addbranch == 1 )
                        <li><a href="/add-branch">Add branch</a></li>
                        @endif
                        @if (Auth::user()->role == 1 or Auth::user()->access->viewbranch == 1 )
                        <li><a href="/view-branches">View Branches</a></li>
                        @endif


                    </ul>
                </li>
                @endif

                @if (Auth::user()->role == 1 or Auth::user()->access->addreport == 1 or Auth::user()->access->viewreport == 1 )
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-comment"></i><span> Report </span><span class="float-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        @if (Auth::user()->role == 1 or Auth::user()->access->addreport == 1 )
                        <li><a href="/add-report">Add Report</a></li>
                        @endif
                        @if (Auth::user()->role == 1 or Auth::user()->access->viewreport == 1 )
                        <li><a href="/view-outgoing">View Outgoing</a></li>
                        @endif
                        @if (Auth::user()->role == 1 or Auth::user()->access->viewreport == 1 )
                        <li><a href="/view-incoming">View Incoming</a></li>
                        @endif


                    </ul>
                </li>
                @endif

            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->
