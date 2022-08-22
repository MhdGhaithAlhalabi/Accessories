<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>تسجيل الدخول</title>

    <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href={{asset('assets/plugins/fontawesome-free/css/all.min.css')}}>
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href={{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}>
        <!-- Theme style -->
        <link rel="stylesheet" href={{asset('assets/dist/css/adminlte.min.css')}}>

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="/" class="h1"><b>Admin</b>Accessories</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">سجل دخول لبدء الجلسة</p>

            <form method="POST" action="{{ route('login') }}">

                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="البريد الالكتروني">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('email')
                <span class="text-red-500 text-xs italic" role="alert">
                {{ $message }}
            </span>
                @enderror
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="كلمة المرور">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                <span class="text-red-500 text-xs italic" role="alert">
                {{ $message }}
            </span>
                @enderror
                <div class="row">
                    <div class="col-8">
                        <div class="form-check">
                            <input type="checkbox" name="remember" value="1" id="remember">
                            <label for="remember">
                                تذكرني
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">تسجيل الدخول</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

          {{--
           <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    انشاء حساب
                </a>

            </div>
            --}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- /.login-box -->
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>


</body>
</html>

