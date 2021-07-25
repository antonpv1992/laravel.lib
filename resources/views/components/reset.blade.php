<div class="reset">
  <div class="reset__dialog col-6 me-auto ms-auto">
    <form class="reset__form form px-5 py-5" method="post" action="{{ Route('password.update') }}">
      @csrf
      <!-- Password Reset Token -->
      <input type="hidden" name="token" value="{{ $request->route('token') }}">
      <label class="form__input form-input">
        <i class="form__icon fa fa-envelope"></i>
        <input type="email" class="form__control form-control" name="email" placeholder="Email address" require>
      </label>
      <label class="form__input form-input">
        <i class="form__icon fa fa-lock"></i>
        <input type="password" class="form__control form-control" name="password" placeholder="Password" require>
      </label>
      <label class="form__input form-input">
        <i class="form__icon fa fa-lock"></i>
        <input type="password" class="form__control form-control" name="password_confirmation" placeholder="Repeat Password" require>
      </label>
      <button type="submit" class="form__submit btn btn-primary mt-4">Update</button>
    </form>
  </div>
</div>