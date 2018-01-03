@extends('layouts.admin')

@section('content')
    <body class="gray-bg">
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <!--<h2 class="logo-name">L.F.H</h2>-->

            </div>
            <h3>Welcome to Letter From Heaven</h3>
            <p>Login in. To see it in action.</p>
            {{--<form class="m-t" role="form" action="index.html">--}}
            <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.login') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" placeholder="Email" required autofocus value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="Password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Forgot password?</small></a>

            </form>
        </div>
    </div>
    </body>
    <!-- Mainly scripts -->
    <script src="{{ asset('admin/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>

@endsection
