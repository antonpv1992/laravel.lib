<div class="login modal fade" id="log" tabindex="-1" aria-hidden="true" >
  <div class="login__dialog modal-dialog">
    <form class="login__form form modal-content px-5 py-5" method="post" action="{{ Route('signin') }}">
      @csrf
      <button type="button" class="form__close btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
      <label class="form__input form-input">
        <i class="form__icon fa fa-envelope"></i>
        <input type="email" class="form__control form-control" name="email" placeholder="Email address" require>
      </label>
      <label class="form__input form-input">
        <i class="form__icon fa fa-lock"></i>
        <input type="password" class="form__control form-control" name="password" placeholder="Password" require>
      </label>
      <div class="form__check form-check">
        <label class="form__check-label form-check-label">
          <input class="form__check-input form-check-input" type="checkbox" name="remember" value=""> Remember </label>
      </div>
      <button type="submit" class="form__submit btn btn-primary mt-4">Login</button>
      <div class="form__action text-center mt-4">
        <span class="form__action-span">Not a member?</span>
        <a href="" class="form__action-button text-decoration-none" data-bs-toggle="modal" data-bs-target="#reg" data-bs-dismiss="modal" aria-label="Close"> Sign Up</a>
      </div>
    </form>
  </div>
</div>
