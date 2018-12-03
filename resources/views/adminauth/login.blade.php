<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MyAdmin | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('../../bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('../../bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  {{-- <link rel="stylesheet" href="{{ asset('../../bower_components/Ionicons/css/ionicons.min.css"') }}"> --}}
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('../../dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('../../plugins/iCheck/square/blue.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Phuong</b>Vu</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in my system</p>

    <form action="{{ route('admin.authenciate') }}" method="post">
        @csrf
      <div class="form-group has-feedback">
        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
         @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
     {{--  <div class="form-group has-feedback">
        <input type="password" class="form-controll{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
         @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div> --}}
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Login') }}</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    <div class="social-auth-links text-center">
      <p>- OR -</p>
     {{--  <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a> --}}
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <div class="form-group row mb-0">
      <div class="col-md-8 offset-md-4">

        <a class="btn btn-link" href="{{ route('admin.password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
        <a class="nav-link" href="{{ route('admin.register') }}">{{ __('Register a new membership') }}</a>

      </div>
  </div>

    {{-- <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> --}}

  {{-- </div> --}}
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('../../bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('../../bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('../../plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
