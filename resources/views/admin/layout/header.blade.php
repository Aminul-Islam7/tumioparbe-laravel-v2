<div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="{{ url('/') }}" target="_blank" class="logo"> 
                <img src="{{asset('admin/images/LogoTumioParbe.png')}}" height="50px" width="50px" alt="logo-icon" class="img-responsive">
                </a>
                <a href="{{ url('/') }}" target="_blank" class="logo-icon"> 
                    <img src="{{asset('admin/images/LogoTumioParbe.png')}}" alt="logo-icon" class="img-responsive">
                </a>
            </div>
        </div>
        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <div class="pull-left">
                        <button class="button-menu-mobile open-left">
                            <i class="fa fa-bars"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>

                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="hidden-xs">
                            <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="fa-solid fa-arrows-to-dot"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                                @if(Auth::user()->photo)
                                    <img src="{{ asset(Auth::user()->photo) }}" alt="user-img" class="img-circle"/>
                                @else
                                    <img src="{{ asset('admin/images/icon.png')}}" alt="user-img" class="img-circle"> 
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('user.edit', ['user_id' => logged_in_user_id()]) }}"><i class="md md-settings"></i> Reset Profile</a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="md md-settings-power"></i> Logout</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
