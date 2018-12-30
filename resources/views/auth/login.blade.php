<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name', 'UIS')}}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    </head>
    <body>
        <main>
            <div class="container">
                <div id="loginbox mx-auto" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                    @if(isset($_GET['error']))
                        <div class="alert alert-danger text-dark" role="alert">
                            <b>Unable to log in.</b><br>Please check that you have entered your <b>login</b> and <b>password</b> correctly.
                            <ul>
                                <li><span>Is the <b>Caps Lock</b> safely turned off?</span></li>
                                <li><span>Maybe you are using the wrong <b>input language</b>? (e.g. German vs. English)</span></li>
                                <li><span>Try typing your password in a text editor and <b>pasting</b> it into the "Password" field.</span></li>
                            </ul>
                        </div>
                    @endif
                    <div class="panel panel-info mx-auto" >
                        <div class="panel-heading">
                            <div class="panel-title">
                                Sign In
                            </div>
                            <div style="float:right; font-size: 80%; position: relative; top:-10px">
                                <a href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                            
                        </div>
                        <div style="padding-top:30px" class="panel-body" >
                            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                                <form id="loginform" class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <label for="email" class="input-group-addon"><i class="glyphicon glyphicon-user"></i></label>
                                        <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" placeholder="email" required>                                        
                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <label for="password" class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></label>
                                        <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required>
                                        @if ($errors->has('password'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="input-group">
                                        <div class="checkbox">
                                            <label>
                                                <input id="login-remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div style="margin-top:10px" class="form-group">
                                        <!-- Button -->
                                        <div class="col-sm-12 controls">
                                            <button type="submit" id="btn-login" href="#" class="btn btn-success">{{ __('Login') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
