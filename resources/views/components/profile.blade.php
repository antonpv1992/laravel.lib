<div class="profile mt-5 mb-5">
  @if(Auth::user() && (Auth::user()->hasRole('admin') || Auth::user()->login === $user->login))
  <form action="{{ Route('remove', $user->login)}}" method="post">
    @csrf
    @method('DELETE')
    <button type="button" class="users__user-remove" data-bs-toggle="modal" data-bs-target="#deleteBook">
      <i class="users__user-icon fas fa-times"></i>
    </button>
    @include('components/delete-modal')
  </form>
  <a type="button" class="users__user-edit" href="{{ Route('reload', $user->login)}}">
    <i class="users__user-icon fas fa-pencil-alt"></i>
  </a>
  @endif
  <div class="profile__box col-4 me-auto ms-auto">
    <ul class="profile__list list-group list-group-flush pt-4">
      <li class="profile__item list-group-item mb-4">
        <span class="profile__title fw-bold">User name:</span> {{ $user->login }}
      </li>
      <li class="profile__item list-group-item mb-4">
        <span class="profile__title fw-bold">Email:</span> {{ $user->email }}
      </li>
      <li class="profile__item list-group-item mb-4">
        <span class="profile__title fw-bold">Name:</span> {{ $user->name }}
      </li>
      <li class="profile__item list-group-item mb-4">
        <span class="profile__title fw-bold">Surname:</span> {{ $user->surname }}
      </li>
      <li class="profile__item list-group-item mb-4">
        <span class="profile__title fw-bold">Age:</span> {{ $user->age }}
      </li>
    </ul>
  </div>
</div>