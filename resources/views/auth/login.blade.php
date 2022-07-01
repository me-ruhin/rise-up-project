<!doctype html>
<html lang="zxx">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendors Min CSS -->
        <link rel="stylesheet" href="{{asset('backend/assets/css/vendors.min.css')}}">
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{asset('backend/assets/css/responsive.css')}}">

        <title>@yield('title','Dashboard')</title>

        <link rel="icon" type="image/png" href="{{asset('backend/assets/img/favicon.png')}}">
        @stack('css')
    </head>

    <body>


        <div class="login-area">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="login-form">


                        <h2>Welcome to AMS</h2>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            @if (\Session::has('login_error'))

                            <div class="alert alert-danger">
                                <ul>
                                    <li>{!! \Session::get('login_error') !!}</li>
                                </ul>
                            </div>
                        @endif

                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                <span class="label-title"><i class="bx bx-user"></i></span>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            </div>

                            <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <span class="label-title"><i class="bx bx-lock"></i></span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                            <button type="submit" class="login-btn">Login</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Vendors Min JS -->
        <script src="{{asset('backend/assets/js/vendors.min.js')}}"></script>



        @stack('js')

        <!-- Custom JS -->
        <script src="{{asset('backend/assets/js/custom.js')}}"></script>
    </body>
</html>
