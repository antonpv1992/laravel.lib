<div class="registration modal fade" id="reg" tabindex="-1" aria-hidden="true">
  <div class="registration__dialog modal-dialog">
    <form class="registration__form form modal-content px-5 py-5" method="post" action="{{ Route('signup') }}">
      <button type="button" class="form__close btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
      @csrf
      <label class="form__input form-input">
        <i class="form__icon fa fa-envelope"></i>
        <input type="email" class="form__control form-control" name="email" placeholder="Email" require>
      </label>
      <label class="form__input form-input">
        <i class="fa fa-user"></i>
        <input type="text" class="form-control" name="login" placeholder="User name" require>
      </label>
      <label class="form__input form-input">
        <i class="fa fa-lock"></i>
        <input type="password" class="form-control" name="password" placeholder="Password" require>
      </label>
      <label class="form__input form-input">
        <i class="fa fa-lock"></i>
        <input type="password" class="form-control" name="password_confirmation" placeholder="Repeat password" require>
      </label>
      <label class="form__input form-input">
        <i class="fas fa-user-tie"></i>
        <input type="text" class="form-control" name="name" placeholder="Name">
      </label>
      <label class="form__input form-input">
        <i class="fas fa-user-tie"></i>
        <input type="text" class="form-control" name="surname" placeholder="Surname">
      </label>
      <label class="form__input form-input">
        <i class="fas fa-clock"></i>
        <input type="text" class="form-control" name="age" placeholder="Age">
      </label>
      <div class="form__check form-check">
        <label class="form__check-label form-check-label">
          <input class="form__check-input form-check-input" type="checkbox" name="remember_token" value=""> Remember 
        </label>
      </div>
      <button type="submit" class="form__submit btn btn-primary mt-4">Sign Up</button>
      <div class="form__alt-entry text-center mt-3">
        <span class="form__alt-span">Or continue with these social profile</span>
      </div>
      <div class="form__social d-flex justify-content-center mt-4">
        <a herf="{{ Route('gredirect') }}" class="form__social-icon text-decoration-none"><i class="fab fa-google"></i></a>
        <a herf="{{ Route('fredirect') }}" class="form__social-icon text-decoration-none"><i class="fab fa-facebook-f"></i></a>
      </div>
      <div class="form__action text-center mt-4">
        <span class="form__action-span">Already a member?</span>
        <a href="" class="form__action-button text-decoration-none" data-bs-toggle="modal" data-bs-target="#log"
           data-bs-dismiss="modal" aria-label="Close"> Login</a>
      </div>
      <div class="form__action text-center mt-4">
        <span class="form__action-span">Forgot password?</span>
        <a href="" class="form__action-button text-decoration-none" data-bs-toggle="modal" data-bs-target="#forg"
           data-bs-dismiss="modal" aria-label="Close"> Forgot</a>
      </div>
    </form>
  </div>
</div>
