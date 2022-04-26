<!-- Top Bar Start -->
<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="index" class="logo"><img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="24"></a>
            <a href="index" class="logo-sm"><img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="28"></a>
        </div>
    </div>
    <!-- Button mobile view to collapse sidebar menu -->

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left waves-light waves-effect">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>

            </ul>

            <ul class="nav navbar-right float-right list-inline">

                <li class="d-none d-sm-block">
                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light notification-icon-box"><i class="fas fa-expand"></i></a>
                </li>

                <li class="dropdown">
                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                        <img src=@if (!empty(Auth::user()->photo))
                        {{asset(Auth::user()->photo)}}
                        @else
                        {{asset('assets/images/users/avatar-1.jpg')}}
                        @endif alt="user-img" class="rounded-circle">
                        <span class="profile-username">
                                {{Auth::user()->name}} <span class="mdi mdi-chevron-down font-15"></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu">

                        <li><a href="/settings" class="dropdown-item"> Settings </a></li>

                        <li><a href="/logout" class="dropdown-item"> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!-- Top Bar End -->
