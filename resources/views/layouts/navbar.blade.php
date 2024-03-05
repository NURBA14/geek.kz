<header class="market-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"
                style="color: black; font-size: 55px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif ">GEEK</a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" style="font-size: 20px" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="font-size: 20px"
                            href="{{ route('user.category.list') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="font-size: 20px" href="{{ route('user.tag.list') }}">Tags</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: 20px" href="{{ route('login.create') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: 20px" href="{{ route('register.create') }}">Reg-in</a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: 20px" href="{{ route('user.profile') }}">Profile</a>
                        </li>
                        @if (auth()->user()->is_admin == 1)
                            <li class="nav-item">
                                <a class="nav-link" style="font-size: 20px" href="{{ route('admin.index') }}">Admin
                                    zone</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: 20px" href="{{ route('login.logout') }}">Logout</a>
                        </li>
                    @endauth
                </ul>
                <form class="form-inline" action="{{ route('posts.search') }}" method="get">
                    <input class="form-control mr-sm-2" required name="s" type="text"
                        placeholder="How may I help?">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </div>
</header>
