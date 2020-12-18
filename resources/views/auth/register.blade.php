@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
           

                <div class="card-body ">
                <h3 class=" "> {{ __('Create account') }} </h3>
                    <form method="POST" >
                        @csrf



                        <div class="form-group row">    
                            <div class="col-md-6">
                                <label for="name" >{{ __('First name') }}</label>
                                    <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" style="width: 100%" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>

                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="lname" >{{ __('Last name') }}</label>
                                        <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>

                                        @error('lname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                        </div>

                          <div class="form-group  ">
                          

                            <div class="">
                                 <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <small style="color:#888888;"> A verification mail will be sent to this email address </small>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 

                        <div class="form-group  row">
                           
                            <div class="col-md-6">
                                <label for="password" class="">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                           

                            <div class="col-md-6">
                                <label for="password-confirm" >{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3  ">
                                <button type="submit" class="btn btn-block btn-primary" >
                                    {{ __('Create Account') }}
                                </button>
                            </div>

                        </div>

                    </form>
                </div>
                
            </div>
            <div class="d-flex justify-content-center mt-2">
                <small style="color: #666666;"> Already have an account? <a href=" {{ route('login') }}" > Sign in </a> </small>
            </div>
        </div>
    </div>
</div>
@endsection
