
@extends('layouts.'.Auth::user()->role->name)
@section('content')
    <h1 class="display-3">Edit profile</h1>
    
    {{ Breadcrumbs::render('profile') }}
    <?php 
    $u = Auth::user();
    
    ?>
    <main class="pt-3" role="main">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <button class="btn" style="background-color: rgba(0, 0, 0, 0);" id="updateButton">{{ __('Edit user')}}</button>
                        <button class="btn" style="background-color: rgba(0, 0, 0, 0);" id="changePasswordButton">Change Password</button>
                    </div>
                    
                    <div class="card-body">
                        {!! Form::open(['action' => ['UsersController@update', $u->id], 'method'=>'POST', 'id'=>'updateForm']) !!}
                            
                            <input id="password" type="password"  name="password" value="123456" hidden>
    
                            
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $u->name }}" required autofocus>
    
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ $u->surname }}" required autofocus>
        
                                        @if ($errors->has('surname'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('surname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $u->email}}" required>
    
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{Form::hidden('_method', 'PUT')}}
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}

                        {!! Form::open(['action' => ['UsersController@changePassword', $u->id], 'method'=>'POST', 'id'=>'changePasswordForm' , 'style' => 'display:none;']) !!}
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            {{Form::hidden('_method', 'PUT')}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Custom Scroller Js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
        $("#updateButton").click(function(e) {
            $("#changePasswordForm").hide();
            $("#updateForm").show();
            e.preventDefault();
        });
        $("#changePasswordButton").click(function(e) {
            $("#updateForm").hide();
            $("#changePasswordForm").show();

            e.preventDefault();
        });
    </script>
@endsection