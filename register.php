<?php
include "inc/koneksi.php";

if (isset($_POST['btnRegister'])) {
    $nama_pengguna = mysqli_real_escape_string($koneksi, $_POST['nama_pengguna']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, md5($_POST['password']));
    $level = 'User'; // Default level untuk pendaftar baru

    // Cek apakah username sudah ada
    $sql_check = "SELECT * FROM tb_pengguna WHERE username='$username'";
    $query_check = mysqli_query($koneksi, $sql_check);
    $jumlah_check = mysqli_num_rows($query_check);

    if ($jumlah_check > 0) {
        echo "<script>
                Swal.fire({title: 'Registrasi Gagal', text: 'Username sudah digunakan', icon: 'error', confirmButtonText: 'OK'})
                .then((result) => {
                    if (result.value) {
                        window.location = 'register.php';
                    }
                });
              </script>";
    } else {
        // Insert ke database
        $sql_register = "INSERT INTO tb_pengguna (nama_pengguna, username, password, level) VALUES ('$nama_pengguna', '$username', '$password', '$level')";
        $query_register = mysqli_query($koneksi, $sql_register);

        if ($query_register) {
            echo "<script>
                    Swal.fire({title: 'Registrasi Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'})
                    .then((result) => {
                        if (result.value) {
                            window.location = 'login.php';
                        }
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({title: 'Registrasi Gagal', text: 'Terjadi kesalahan', icon: 'error', confirmButtonText: 'OK'})
                    .then((result) => {
                        if (result.value) {
                            window.location = 'register.php';
                        }
                    });
                  </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register | SI Perpustakaan</title>
    <link rel="icon" href="dist/img/logo.png">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <h3><font color="green"><b>Sistem Informasi Perpustakaan</b></font></h3>
        </div>
        <div class="login-box-body">
            <center>
                <img src="dist/img/logo.png" width=160px />
            </center>
            <br>
            <p class="login-box-msg">Register Akun Baru</p>
            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="nama_pengguna" placeholder="Nama Lengkap" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <a href="login.php">Sudah punya akun? Login</a>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-success btn-block btn-flat" name="btnRegister">Daftar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</body>
</html>
