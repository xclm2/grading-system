@extends('welcome')
@section('content')

<div class="row justify-content-center x-container g-login">
    <div class="col-12 text-center">
        <img class="img-fluid rounded-circle" style="width: 300px; height: 300px;" src="{{ asset('images/login.jpg') }}"/>
    </div>
    <div class="col-md-5">
        <form id="xclm2-login" method="POST" action="/user/login">
            <h3>Welcome</h3>
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="form-floating mb-3">
                <input type="email" class="form-control shadow-sm border-0" id="floatingInput" name="email" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control shadow-sm border-0" id="floatingPassword" name="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button type="submit" class="btn btn-dark btn-lg w-100 mb-3">Login</button>

            <div class="form-floating text-center">
                <a href="/user/forgotpassword">Forgotten password?</a>
            </div>
            <hr>
            <p><b>Need an account?</b><br>
                <span class="small">Contact your administrator to create an account</span>
            </p>
        </form>
    </div>
</div>
@endsection