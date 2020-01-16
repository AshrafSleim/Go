@extends('layouts.header')
@section('content')
    <!--Login Page Starts-->
    <section id="login">
        <div class="container-fluid">
            <div class="row full-height-vh">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="card text-center width-400"style="border-radius: 15px" >
                        <div class="card-img overlap">
                        </div>
                        <div class="card-body">

                            <div class="card-block" style="background-color: #423f3f;border-radius: 15px">
                                <h2 class="white">Login</h2>

                                <form method="POST" action='{{ route("PostAdminLogin") }}'>
                                    @csrf

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"  value="{{ old('email') }}" required autofocus >
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                              </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-pink btn-block btn-raised" style="background-color: #00f6f4">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
    <!--Login Page Ends-->

@endsection
<!-- ////////////////////////////////////////////////////////////////////////////-->

<!-- BEGIN VENDOR JS-->
