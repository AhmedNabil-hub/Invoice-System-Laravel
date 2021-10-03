@extends('layouts.master2')

@section('css')
  <!-- Sidemenu-respoansive-tabs css -->
  <link href="{{ URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
    rel="stylesheet">
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row no-gutter">
      <!-- The image half -->
      <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
        <div class="row wd-100p mx-auto text-center">
          <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
            <img src="{{ URL::asset('assets/img/media/register.svg') }}"
              class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
          </div>
        </div>
      </div>
      <!-- The content half -->
      <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
        <div class="login d-flex align-items-center py-2">
          <!-- Demo content-->
          <div class="container p-0">
            <div class="row">
              <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                <div class="card-sigin">
                  <div class="mb-5 d-flex"> <a href="{{ route('home') }}"><img
                        src="{{ URL::asset('assets/img/brand/favicon.png') }}" class="sign-favicon ht-40"
                        alt="logo"></a>
                    <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Invoice System</h1>
                  </div>
                  <div class="main-signup-header">
                    <h2 class="text-primary">Get Started</h2>
                    <h5 class="font-weight-normal mb-4">It's free to signup and only takes a minute.</h5>
                    <form method="POST" action="{{ route('register') }}">
                      @csrf
                      <div class="form-group">
                        <label>Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                          value="{{ old('name') }}" required autocomplete="name"
                          placeholder="Enter your name">

                        @error('name')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                          name="email" value="{{ old('email') }}" required autocomplete="email"
                          placeholder="Enter your email">

                        @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                          name="password" value="{{ old('password') }}" required autocomplete="new-password"
                          placeholder="Enter your password">

                        @error('password')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Password Confirm</label>
                        <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                          name="password_confirmation" required
                          placeholder="Confirm your password">

                        @error('password_confirmation')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
											<button class="btn btn-main-primary btn-block" type="submit">Create Account</button>
                    </form>
                    <div class="main-signup-footer mt-5">
                      <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End -->
        </div>
      </div><!-- End -->
    </div>
  </div>
@endsection

@section('js')
@endsection
