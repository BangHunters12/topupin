<?php
ob_start();
session_start();
include('config/koneksi.php');
$sid = session_id();
$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
$urlwebs = $s0['urlweb'];
$pengguna = $s0['user'];
$sql_1a = mysqli_query($conn,"SELECT * FROM `tb_social` WHERE user = '$pengguna'") or die(mysqli_error());
$s1a = mysqli_fetch_array($sql_1a);
$sql_1b = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '$pengguna'") or die(mysqli_error());
$s1b = mysqli_fetch_array($sql_1b);
$ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d');

$stat = mysqli_query($conn,"INSERT INTO `tb_stat` (`ip`, `date`, `hits`, `page`, `user`) VALUES ('$ip', '$date', 1, 'Masuk Akun', '$pengguna')") or die (mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Masuk Akun - <?php echo $s0['instansi']; ?></title>
  <meta name="description" content="<?php echo $s0['deskripsi']; ?>">
  <meta name="keywords" content="<?php echo $s0['keyword']; ?>">
  <meta property="og:title" content="Masuk Akun - <?php echo $s0['instansi']; ?>"/>
  <meta property="og:description" content="<?php echo $s0['deskripsi']; ?>" />
  <meta property="og:url" content="<?php echo $urlweb; ?>" />
  <meta property="og:image" content="<?php echo $urlweb; ?>/upload/<?php echo $s0['image']; ?>" />
  <meta name="resource-type" content="document" />
  <meta http-equiv="content-type" content="text/html; charset=US-ASCII" />
  <meta http-equiv="content-language" content="en-us" />
  <meta name="author" content="topupin" />
  <meta name="contact" content="topupin.com" />
  <meta name="copyright" content="Copyright (c) topupin.com. All Rights Reserved." />
  <meta name="robots" content="index, nofollow">

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $urlweb; ?>/upload/favicon.png">

  <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/plugins/summernote/dist/summernote-bs4.css"/>
  <!--Select Plugins-->
  <link href="<?php echo $urlweb; ?>/assets/plugins/select2/css/select2.min.css" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="<?php echo $urlweb; ?>/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!--Data Tables -->
  <link href="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <!-- animate CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Horizontal menu CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/horizontal-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="<?php echo $urlweb; ?>/assets/css/app-style.css" rel="stylesheet"/>
  <link href="<?php echo $urlweb; ?>/assets/css/style-main<?php echo $s0['warna']; ?>.css" rel="stylesheet"/>
<!-- forgot password css-->
<link href="<?php echo $urlweb; ?>/assets/css/card_lp.css" rel="stylesheet"/>
<!-- <script src="assets/js/login.js"></script> -->

 <style>
</style>
</head>

<body>

  <!-- Start wrapper-->
  <div id="wrapper">

    <!--Start topbar header-->
    <?php include('top_menu.php'); ?>
    <!--End topbar header-->

    <div class="clearfix pt-5"></div>
    <div class="pt-5 pb-5">
      <div class="container">
       <div class="row">
          <div class="col-lg-12">
            <div class="pt-3 pb-4">
              <h5>Login</h5>
              <span class="strip-primary"></span>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="pb-3">
              <div class="section">
                <div class="card-body">
                  <?php
                    error_reporting(0);
                    if (!empty($_GET['error'])) {
                      if ($_GET['error'] == 1) {
                        echo '
                          <div class="alert alert-warning alert-dismissible mb-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div class="alert-icon">
                              <i class="fa fa-exclamation-triangle"></i>
                            </div>
                            <div class="alert-message">
                              <span><strong>Warning!</strong> Username dan Password Wajib Diisi!</span>
                            </div>
                          </div>
                        ';
                      }
                      if ($_GET['error'] == 2) {
                        echo '
                          <div class="alert alert-warning alert-dismissible mb-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div class="alert-icon">
                              <i class="fa fa-exclamation-triangle"></i>
                            </div>
                            <div class="alert-message">
                              <span><strong>Warning!</strong> Username Salah!</span>
                            </div>
                          </div>
                        ';
                      }
                      if ($_GET['error'] == 3) {
                        echo '
                          <div class="alert alert-warning alert-dismissible mb-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div class="alert-icon">
                              <i class="fa fa-exclamation-triangle"></i>
                            </div>
                            <div class="alert-message">
                              <span><strong>Warning!</strong> Password Salah!</span>
                            </div>
                          </div>
                        ';
                      }
                      if ($_GET['error'] == 4) {
                        echo '
                          <div class="alert alert-warning alert-dismissible mb-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div class="alert-icon">
                              <i class="fa fa-exclamation-triangle"></i>
                            </div>
                            <div class="alert-message">
                              <span><strong>Warning!</strong> Username atau Password Tidak Ditemukan!</span>
                            </div>
                          </div>
                        ';
                      }
                      if ($_GET['notif'] == 5) {
                        echo '
                          <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div class="alert-icon">
                              <i class="fa fa-check"></i>
                            </div>
                            <div class="alert-message">
                              <span><strong>Well done!</strong> Akun berhasil dibuat, silahkan login!</span>
                            </div>
                          </div>
                        ';
                      }
                    }
                  ?>
                  <form role="form" class="mt-3" action="<?php echo $urlweb; ?>/login-proses/" method="POST">
                    <div class="form-group mb-2">
                      <p class="text-white">Username</p>
                      <input type="text" name="user" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                      <p class="text-white">Password</p>
                      <input type="password" name="pass" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Masuk Akun</button>
              
                    <div class="mt-3">
                     <a href="javascript:void(0);" data-toggle="modal" data-target="#forgotPasswordModal">Lupa Password?</a>
                    </div>


                  </form>

                  
<!-- card Lupa Password -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="forgotPasswordLabel">Lupa Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="forgotPasswordForm">
          <div class="form-group">
            <label for="fullname">Nama Lengkap</label>
            <input type="text" id="fullname" name="fullname" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="no_hp">Nomor HP</label>
            <input type="text" id="no_hp" name="no_hp" class="form-control" required>
          </div>
          <button type="button" id="validateUser" class="btn btn-primary">Validasi</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- card Password Baru -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resetPasswordLabel">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="resetPasswordForm">
          <div class="form-group">
            <label for="new_password">Password Baru</label>
            <input type="password" id="new_password" name="new_password" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="confirm_password">Konfirmasi Password</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
          </div>
          <button type="button" id="resetPassword" class="btn btn-primary">Reset Password</button>
        </form>
      </div>
    </div>
  </div>
</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	  
	  <div class="d-block d-sm-none" style="height: 100px;"></div>
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	  <!--Start footer-->
    <?php include('footer.php'); ?>


                  <!-- java script forgot password -->
    <script>
      
   $(document).ready(function () {

  // Validasi pengguna
  $('#validateUser').on('click', function () {
    const fullname = $('#fullname').val();
    const email = $('#email').val();
    const no_hp = $('#no_hp').val();

    if (fullname && email && no_hp) {
      console.log({ fullname, email, no_hp }); 
      $.ajax({
        url: 'http://localhost/ppob2/forgot_password.php',
        type: 'POST',
        data: { action: 'validate_user', full_name: fullname, email, no_hp }, 
        success: function (response) {
          console.log(response); 
          try {
            const res = JSON.parse(response);
            if (res.status === 'success') {
              $('#forgotPasswordModal').modal('hide');
              $('#resetPasswordModal').modal('show');
            } else {
              alert(res.message);
            }
          } catch (e) {
            console.error('Parsing error:', e);
            alert('Terjadi kesalahan saat membaca respons server.');
          }
        },
        error: function (xhr) {
          console.error(xhr.responseText);
          alert('Terjadi kesalahan, coba lagi.');
        },
      });
    } else {
      alert('Semua bidang wajib diisi.');
    }
  });

  // Reset password
  $('#resetPassword').on('click', function () {
    const newPassword = $('#new_password').val();
    const confirmPassword = $('#confirm_password').val();

    if (newPassword && confirmPassword) {
      if (newPassword === confirmPassword) {
        if (newPassword.length < 6) {
          alert('Password harus memiliki minimal 6 karakter.');
          return;
        }
        console.log({ newPassword, confirmPassword }); 
        $.ajax({
          url: 'http://localhost/ppob2/forgot_password.php',
          type: 'POST',
          data: { action: 'reset_password', new_password: newPassword },
          success: function (response) {
            console.log(response); 
            try {
              const res = JSON.parse(response);
              if (res.status === 'success') {
                alert('Password berhasil direset. Silakan login.');
                $('#resetPasswordModal').modal('hide');
              } else {
                alert(res.message);
              }
            } catch (e) {
              console.error('Parsing error:', e);
              alert('Terjadi kesalahan saat membaca respons server.');
            }
          },
          error: function (xhr) {
            console.error(xhr.responseText); 
            alert('Terjadi kesalahan, coba lagi.');
          },
        });
      } else {
        alert('Password dan Konfirmasi Password tidak sama.');
      }
    } else {
      alert('Semua bidang wajib diisi.');
    }
  });
});

</script>
</body>
</html>
