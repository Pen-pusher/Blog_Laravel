
    
      <nav class="navbar navbar-expand-md navbar-dark bg-dark ">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                  <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link disabled" href="/about">About</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link disabled" href="/services">Services</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="/posts">Blog</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/posts/create">Create Posts</a>
                  </li>
                  
                 
                </ul> 

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                   
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                    @else

                        <li class="nav-item">
                        <a id="nav-item" class="btn btn-default" href="#" role="button"  aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        
                        <li class="dropdown"><a href="/home">Dashboard</a></li>

                            <ul class="btn btn-default" role="btn">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>