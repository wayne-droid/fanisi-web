@extends('layout')
@section('auth')

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>

                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome, Login To Continue</h1>
                                    </div>
                                    <form class="user" action="/login/user" method="get">

                                        

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <strong>Whoops!</strong> There was a problem.<br><br>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <input type="tel" class="form-control form-control-user"
                                                   id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                                                   placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password"
                                                   id="exampleInputPassword" placeholder="Password" required>
                                        </div>

                                        <input type="submit" value="Login" class="btn btn-primary btn-user btn-block">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()
