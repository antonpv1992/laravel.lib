<div class="profile mt-5 mb-5">
  <form class="profile__box col-4 me-auto ms-auto" method="post" action="{{route('rewrite', $user->login)}}">
    @csrf
    @method('PATCH')
    <ul class="profile__list list-group list-group-flush pt-4">
      <li class="profile__item list-group-item mb-4">
        <input type="text" class="profile__title fw-bold border-0 w-100" name="login" placeholder="User name" value="{{ $user->login }}">
      </li>
      <li class="profile__item list-group-item mb-4">
        <input type="email" class="profile__title fw-bold border-0 w-100" name="email" placeholder="Email" value="{{ $user->email  }}">
      </li>
      <li class="profile__item list-group-item mb-4">
        <input type="text" class="profile__title fw-bold border-0 w-100" name="name" placeholder="Name" value="{{ $user->name }}">
      </li>
      <li class="profile__item list-group-item mb-4">
        <input type="text" class="profile__title fw-bold border-0 w-100" name="surname" placeholder="Surname" value="{{ $user->surname }}">
      </li>
      <li class="profile__item list-group-item mb-4">
        <input type="number" class="profile__title fw-bold border-0 w-100" name="age" placeholder="Age" value="{{ $user->age }}">
      </li>
    </ul>
    <label class="modification__input form-input mb-3 d-flex justify-content-center">
      <button type="submit" class="modification__button btn btn-primary">Submit</button>
    </label>
  </form>
</div>
