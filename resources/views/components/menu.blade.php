<nav class="menu navbar navbar-expand container mt-2 px-2">
  <ul class="menu__buttons navbar-nav me-auto mb-2 mb-lg-0">
    <li class="menu__item nav-item me-3">
      @guest  
      <button type="button" class="menu__button btn btn-primary" data-bs-toggle="modal" data-bs-target="#log">
        Login
      </button>
      @endguest
      @auth
      <a class="menu__button btn btn-primary" role="button" href="{{ Route('profile', Auth::user()->login) }}">
        {{ Auth::user()->login }} 
      </a>
      @endauth
    </li>
    <li class="menu__item nav-item me-3">
      @guest  
      <button type="button" class="menu__button btn btn-primary" data-bs-toggle="modal" data-bs-target="#reg">
      Sign Up
      </button>
      @endguest
      @auth
      <form action="{{ Route('logout') }}" method="post">
        @csrf
        <button type="submit" class="menu__button btn btn-primary" >
          Logout
        </button>
      </form>
      @endauth
    </li>
    @if(Auth::user() && Auth::user()->hasRole('admin'))
    <li class="menu__item nav-item me-3">
      <a class="menu__button btn btn-outline-primary" role="button" href="{{ Route('add') }}">Add book</a>
    </li>
    <li class="menu__item nav-item">
      <a class="menu__button btn btn-outline-primary" role="button" href="{{ Route('users') }}">Show users</a>
    </li>
    @endif
  </ul>
  <form class="menu__form d-flex" action="{{ route('home') }}">
    @include('components/menu-sort')
    @include('components/menu-filter')
    <input class="menu__search form-control me-3" name="bsearch" type="search" placeholder="Search" aria-label="Search" value="{{ $request->bsearch ?? '' }}">
    <button class="menu__button btn btn-outline-primary" type="submit">Search</button>
  </form>
</nav>
