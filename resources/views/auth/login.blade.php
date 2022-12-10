<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Makku Frozen Food Dashboard</title>
    <link rel="stylesheet" href="/lte/assets/css/main/app.css">
    <link rel="stylesheet" href="/lte/assets/css/pages/auth.css">
    <link rel="shortcut icon" href="/lte/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="/lte/assets/images/logo/favicon.png" type="image/png">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img class="img-fluid" src="/lte/assets/images/logo_blue.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Welcome,</h1>
                    <p class="auth-subtitle mb-5">Please login first.</p>

                    @error('loginError')
                        <div class="alert alert-danger">
                            <strong>Error</strong>
                            <p>{{ $message }}</p>
                        </div>
                    @enderror

                    <form method="post">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Username" name="name">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('name')
                                <p style="color: red">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <p style="color: red">{{$message}}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>
    </div>
</body>
</html>
