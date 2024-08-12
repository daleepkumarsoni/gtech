<nav class="sidebar dark_sidebar">
    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href="index.html"><img src="img/logo_white.png" alt></a>
        <a class="small_logo" href="index.html"><img src="img/mini_logo.png" alt></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        @if (auth()->user()->roles()->where('name', 'Admin')->exists())
            <li class>
                <a class="has-arrow" href="{{route('admin.dashboard')}}" aria-expanded="false">
                    <div class="nav_icon_small">
                        <img src="img/menu-icon/1.svg" alt>
                    </div>
                    <div class="nav_title">
                        <span>Admin </span>
                    </div>
                </a>

            </li>
            <li class>
                <a class="has-arrow" href="{{route('admin.project')}}" aria-expanded="false">
                    <div class="nav_icon_small">
                        <img src="img/menu-icon/1.svg" alt>
                    </div>
                    <div class="nav_title">
                        <span>Project </span>
                    </div>
                </a>

            </li>
            <li class>
                <a class="has-arrow" href="{{route('admin.chart')}}" aria-expanded="false">
                    <div class="nav_icon_small">
                        <img src="img/menu-icon/1.svg" alt>
                    </div>
                    <div class="nav_title">
                        <span>Chart </span>
                    </div>
                </a>

            </li>
            <li class>
                <a class="has-arrow" href="{{route('admin.search')}}" aria-expanded="false">
                    <div class="nav_icon_small">
                        <img src="img/menu-icon/1.svg" alt>
                    </div>
                    <div class="nav_title">
                        <span>Search </span>
                    </div>
                </a>

            </li>


        @endif
        @if (auth()->user()->roles()->where('name', 'Manager')->exists())
            <li class>
                <a class="has-arrow" href="{{route('manager.dashboard')}}" aria-expanded="false">
                    <div class="nav_icon_small">
                        <img src="img/menu-icon/1.svg" alt>
                    </div>
                    <div class="nav_title">
                        <span>Manager </span>
                    </div>
                </a>

            </li>
            <li class>
                <a class="has-arrow" href="{{route('manage.task')}}" aria-expanded="false">
                    <div class="nav_icon_small">
                        <img src="img/menu-icon/1.svg" alt>
                    </div>
                    <div class="nav_title">
                        <span>Task </span>
                    </div>
                </a>

            </li>
        @endif
        @if (auth()->user()->roles()->where('name', 'Employee')->exists())
            <li class>
                <a class="has-arrow" href="{{route('user.task.list')}}" aria-expanded="false">
                    <div class="nav_icon_small">
                        <img src="img/menu-icon/1.svg" alt>
                    </div>
                    <div class="nav_title">
                        <span>Task List </span>
                    </div>
                </a>

            </li>
        @endif

        <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div>
                    <span class="ms-4">Logout</span>
                </div>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>



    </ul>
</nav>
