<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MUHASEBE GİRİŞ SAYFASI</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="panel/style/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="panel/style/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="panel/style/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <p class="login-box-msg">Lütfen Giriş Yapınız</p>
                <form id="admin-login-form">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Lütfen kullanıcı adınızı giriniz." name="kulad" id="kulad">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Lütfen şifrenizi giriniz." name="sifre" id="sifre">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button onclick="adminGiris('admin-login-form','admin-giris');return false;" class="btn btn-primary btn-block">Giriş Yap</button>
                        </div>
                    </div>
                </form>
                <div class="social-auth-links text-center mt-2 mb-3">
                </div>
                <p class="mb-1">
                    <a href="forgot-password.html">Şifremi Unuttum</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Kayıt Ol</a>
                </p>
            </div>
        </div>
    </div>
    <script src="panel/style/plugins/jquery/jquery.min.js"></script>
    <script src="panel/style/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="panel/style/dist/js/adminlte.min.js"></script>
    <script src="panel/style/dist/js/admin.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>