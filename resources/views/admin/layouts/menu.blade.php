<div class="navbar-custom-menu" style="background:#26b1b0;">

        <ul class="nav navbar-nav">
            <li>
                @if(Auth::guard('admin')->check())
                    <a href="{{route('logoutAdmin')}}">Logout</a>
                    @else
                    <a href="{{route('AdminLogin')}}">login</a>
                @endif

            </li>
        </ul>

</div>
