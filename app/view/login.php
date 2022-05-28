<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?? 'Sistem Pendukung Keputusan' ?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo/favicon.png') ?>">

    <!-- Core css -->
    <link href="<?= base_url('assets/css/app.min.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="app">
    <div class="container-fluid">
            <div class="d-flex full-height p-v-15 flex-column justify-content-between">
                <div class="d-none d-md-flex p-h-40">
                    <img src="assets/images/logo/logo.png" alt="">
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="m-t-20">Login</h2>
                                    <p class="m-b-30">Masukan NIP dan password untuk masuk ke dalam sistem</p>
                                    <form method="post" autocomplete="off" id="formLogin">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="nip">NIP:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="text" class="form-control" id="nip" placeholder="NIP" name="nip">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password">Password:</label>
                                            <div class="input-affix m-b-10">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-end">
                                                <button class="btn btn-primary">Login</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="offset-md-1 col-md-6 d-none d-md-block">
                            <img class="img-fluid" src="assets/images/others/login-2.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex  p-h-40 justify-content-between">
                    <span class="">© <?= date('Y') ?> <?= $title ?? 'Sistem Pendukung Keputusan' ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Vendors JS -->
    <script src="<?= base_url('assets/js/vendors.min.js') ?>"></script>

    <!-- Core JS -->
    <script src="<?= base_url('assets/js/app.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/helpers.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $('#nip').number();
            $('#nip').maxLength(18);

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