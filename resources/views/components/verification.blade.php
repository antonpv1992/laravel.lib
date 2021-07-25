<div class="mx-3 my-3">
  <div class="container">
    <div>
      Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.
    </div>
    @if (session('status') == 'verification-link-sent')
    <div>
      A new verification link has been sent to the email address you provided during registration.
    </div>
    @endif
    <div class="mt-4 d-flex justify-content-around">
      <form method="POST" action="{{ Route('verification.send') }}">
        @csrf
        <div>
          <button type="submit" class="btn btn-outline-primary">
              Resend Verification Email
          </button>
        </div>
      </form>
      <form method="POST" action="{{ Route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-primary">
            Log Out
        </button>
      </form>
    </div>
  </div>
</div>