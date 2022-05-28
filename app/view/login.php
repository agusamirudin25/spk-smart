<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?? 'Sistem Pendukung Keputusan' ?></title>
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="icon" href="<?= base_url('assets/favicon.ico') ?>" type="image/x-icon">

    <!-- Toggles CSS -->
    <link href="<?= base_url('assets/vendors/jquery-toggles/css/toggles.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/vendors/jquery-toggles/css/themes/toggles-light.css') ?>" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/dist/css/style.css') ?>" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->

    <!-- HK Wrapper -->
    <div class="hk-wrapper">

        <!-- Main Content -->
        <div class="hk-pg-wrapper hk-auth-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="auth-form-wrap pt-xl-0 pt-70">
                            <div class="auth-form w-xl-25 w-lg-55 w-sm-75 w-100">
                                <form autocomplete="off" id="formLogin" method="post">
                                    <h1 class="display-4 text-center mb-10">Selamat Datang</h1>
                                    <p class="text-center mb-30">Silakan login untuk mengakses sistem.</p>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="NIS/NIP" type="text" id="kode_pengguna" name="kode_pengguna" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="Password" type="password" id="password" name="password" required>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->
    <!-- jQuery -->
    <script src="<?= base_url('assets/vendors/jquery/dist/jquery.min.js') ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url('assets/vendors/popper.js/dist/umd/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>

    <!-- Slimscroll JavaScript -->
    <script src="<?= base_url('assets/dist/js/jquery.slimscroll.js') ?>"></script>

    <!-- Fancy Dropdown JS -->
    <script src="<?= base_url('assets/dist/js/dropdown-bootstrap-extended.js') ?>"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="<?= base_url('assets/dist/js/feather.min.js') ?>"></script>

    <!-- Init JavaScript -->
    <script src="<?= base_url('assets/dist/js/init.js') ?>"></script>

    <!-- Core JS -->
    <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/helpers.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $('#kode_pengguna').number();
            $('#kode_pengguna').maxLength(20);

            const BASE_URL = "<?= base_url() ?>";
            $('#formLogin').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?= url() ?>Auth/cek_login',
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            success_alert("Berhasil", data.msg, BASE_URL + data.page);
                        } else {
                            error_alert("Gagal", data.msg);
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>