
@extends('layouts.fullwidth')

@section('content')
<div class="col-md-6">
    <div class="authincation-content">
        <div class="row no-gutters">
            <div class="col-xl-12">
                <div class="auth-form">
                    <div class="text-center mb-3">
                        <img src="{{ asset('images/logo-full.png')}}" alt="">
                    </div>
                    <h4 class="text-center mb-4">Sign in your account</h4>
                  @if (session('error'))
    <div class="alert alert-danger mt-2">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mt-2">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('login.post') }}">
    @csrf

    <div class="form-group">
        <label>Email</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
    </div>
</form>

                        <!-- <div class="form-row d-flex justify-content-between mt-4 mb-2">
                            <div class="form-group">
                               <div class="form-check custom-checkbox ms-1">
                                    <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                                    <label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="{{ url('page-forgot-password')}}">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                        </div> -->
                
                    <div class="new-account mt-3">
                        <p>Don't have an account? <a class="text-primary" href="{{ url('page-register')}}">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection