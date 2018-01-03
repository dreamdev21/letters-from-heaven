@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="site/css/global-override.css">
    <link rel="stylesheet" href="site/css/style.min.css">



    <section id="login" class="sections" style="margin-top: 7rem;;">
        <div class="container">


            <div id="main" role="main" class="page-content clearfix">

                <div id="primary" class="primary-content">


                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12">


                        <div class="login-box login-account">


                            <h2>Sign In</h2>

                            <div class="login-box-content returning-customers clearfix">

                                <form role="form" method="POST" action="{{ route('login') }}"
                                      class="clearfix" novalidate="novalidate">

                                    {{ csrf_field() }}
                                    <fieldset>


                                        <div class="form-row username required" aria-required="true">


                                            <label for="dwfrm_login_username"><span
                                                        class="required-indicator">* </span><span>Email</span></label>


                                            <div class="field-wrapper">
                                                <input class="input-text email required" type="email"
                                                       id="dwfrm_login_username"
                                                       name="email" placeholder="" value="{{ old('email') }}"
                                                       required autofocus
                                                       maxlength="2147483647" aria-required="true">
                                            </div>


                                            <div class="form-caption "></div>

                                        </div>


                                        <div class="form-row password required" aria-required="true">


                                            <label for="dwfrm_login_password"><span
                                                        class="required-indicator">* </span><span>Password</span></label>


                                            <div class="field-wrapper">
                                                <input class="input-text  required" type="password"
                                                       id="dwfrm_login_password"
                                                       name="password" value="" placeholder=""
                                                       autocomplete="off"
                                                       maxlength="2147483647" aria-required="true">
                                            </div>


                                            <div class="form-caption "></div>

                                        </div>

                                        <div class="form-row form-row-button">

                                            <button class="primary" type="submit" value="Login"
                                                    name="dwfrm_login_login">
                                                Sign In
                                            </button>

                                        </div>
                                        <a id="password-reset"
                                           href="{{ url('password/reset') }}"
                                           title="Request to reset your password" data-small-width="300">
                                            Forgot Password?
                                        </a>
                                    </fieldset>
                                </form>

                                <div class="login-oauth">


                                    <hr class="hr-or top" data-content="or">


                                    {{--<form action="#" method="post"--}}
                                          {{--class="clearfix" novalidate="novalidate">--}}

                                        <fieldset>

                                            <a href="/redirect">
                                                <div class="form-row form-row-button">

                                                    <button class="primary" type="submit" value="Login"
                                                            name="dwfrm_login_login">
                                                        Sign In With Facebook
                                                    </button>

                                                </div></a>

                                        </fieldset>

                                    {{--</form>--}}


                                </div>
                            </div>
                        </div>

                    </div><!-- END: page column -->
                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12">
                        <div class="login-box login-create-account clearfix">
                            <h2>Join</h2>
                            <div class="login-box-content clearfix">
                                <form action="#" method="post"
                                      id="dwfrm_login_register" novalidate="novalidate">
                                    <fieldset>
                                        <div class="form-row form-row-button">
                                            <button class="primary" type="button" value="Create Account"
                                                    data-toggle="modal" data-target="#myModal2"
                                                    name="dwfrm_login_register">
                                                Create an Account
                                            </button>

                                        </div>
                                        <input type="hidden" name="dwfrm_login_securekey" value="809070296">
                                    </fieldset>
                                </form>
                                <div class="login-oauth">


                                    <hr class="hr-or top" data-content="or">


                                    {{--<form action="#" method="post"--}}
                                          {{--class="clearfix" id="dwfrm_oauthlogin" novalidate="novalidate">--}}

                                        <fieldset>

                                            <a href="/redirect">
                                                <div class="form-row form-row-button">

                                                    <button class="primary" type="submit" value="Login"
                                                            name="dwfrm_login_login">
                                                        Sign Up With Facebook
                                                    </button>

                                                </div></a>

                                        </fieldset>

                                    {{--</form>--}}
                                    <div class="form-caption privacy-notice" style="margin-top: 2rem">
                                        <span>By creating your account,you agree to our </span>
                                        <a href="privacy-policy" class="privacy-policy alt-light"
                                           title="Privacy Policy">Terms and Conditions</a>
                                    </div>


                                </div>


                            </div>
                        </div>

                    </div><!-- END: page column -->

                </div>
            </div>
        </div>
    </section>
    <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <h4 class="modal-title">Create new account</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-8">
                                <input  type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-8">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">state</label>

                            <div class="col-md-8">
                                <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" required autofocus>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                            <label for="zip" class="col-md-4 control-label">Zip</label>

                            <div class="col-md-8">
                                <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" required autofocus>

                                @if ($errors->has('zip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-8">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('dateofbirth') ? ' has-error' : '' }}">
                            <label for="dateofbirth" class="col-md-4 control-label">Date of birth</label>

                            <div class="col-md-8">
                                <input id="dateofbirth" type="date" class="form-control" name="dateofbirth" value="{{ old('dateofbirth') }}" required autofocus>

                                @if ($errors->has('dateofbirth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dateofbirth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="site/js/vendor/jquery-1.11.2.min.js"></script>
    {{--<script src="site/js/vendor/bootstrap.min.js"></script>--}}
    <script src="site/js/plugins.js"></script>
    <script src="site/js/main.js"></script>
@endsection
