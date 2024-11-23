<?php
ob_start();
session_start();
require 'top_menu.php';
include('config/koneksi.php');
$sid = session_id();
$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
$urlwebs = $s0['urlweb'];
$pengguna = $s0['user'];
$sql_1a = mysqli_query($conn, "SELECT * FROM `tb_social` WHERE user = '$pengguna'") or die(mysqli_error());
$s1a = mysqli_fetch_array($sql_1a);
$sql_1b = mysqli_query($conn, "SELECT * FROM `tb_user` WHERE user = '$pengguna'") or die(mysqli_error());
$s1b = mysqli_fetch_array($sql_1b);
$ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d');
$stat = mysqli_query($conn, "INSERT INTO `tb_stat` (`ip`, `date`, `hits`, `page`, `user`) VALUES ('$ip', '$date', 1, 'Beranda', '$pengguna')") or die(mysqli_error());
$sql_banner = mysqli_query($conn, "SELECT * FROM `tb_banner` WHERE id = 1") or die(mysqli_error());
$ssb = mysqli_fetch_array($sql_banner);
$status = $ssb['status'];
if ($status == true) {
  $cekPopup = mysqli_query($conn, "SELECT * FROM `tb_popup` WHERE ip = '$ip'") or die(mysqli_error());
  $cpp = mysqli_num_rows($cekPopup);
  if ($cpp == 0) {
    $pop = mysqli_query($conn, "INSERT INTO `tb_popup` (`ip`, `date`, `status`) VALUES ('$ip', '$date', 0)") or die(mysqli_error());
    $lihat = $status;
  } else {
    $cp = mysqli_fetch_array($cekPopup);
    $statusnya = $cp['status'];
    if ($statusnya == 0) {
      $lihat = $status;
    } else {
      $lihat = 'false';
    }
  }
} else {
  $lihat = $status;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $s0['instansi']; ?></title>
  <meta name="description" content="<?php echo $s0['deskripsi']; ?>">
  <meta name="keywords" content="<?php echo $s0['keyword']; ?>">
  <meta property="og:title" content="<?php echo $s0['instansi']; ?>" />
  <meta property="og:description" content="<?php echo $s0['deskripsi']; ?>" />
  <meta property="og:url" content="<?php echo $urlweb; ?>" />
  <meta property="og:image" content="<?php echo $urlweb; ?>/upload/<?php echo $s0['image']; ?>" />
  <meta name="resource-type" content="document" />
  <meta http-equiv="content-type" content="text/html; charset=US-ASCII" />
  <meta http-equiv="content-language" content="en-us" />
  <meta name="author" content="Arie Budi" />
  <meta name="contact" content="ariebudi.com" />
  <meta name="copyright" content="Copyright (c) dendistore.com. All Rights Reserved." />
  <meta name="robots" content="index, nofollow">

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $urlweb; ?>/upload/favicon.png">

  <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/plugins/summernote/dist/summernote-bs4.css" />
  <!-- simplebar CSS-->
  <link href="<?php echo $urlweb; ?>/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <!-- Bootstrap core CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <!--Data Tables -->
  <link href="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <!-- animate CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/animate.css" rel="stylesheet" type="text/css" />
  <!-- Icons CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/icons.css" rel="stylesheet" type="text/css" />
  <!-- Horizontal menu CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/horizontal-menu.css" rel="stylesheet" />
  <!-- Custom Style-->
  <link href="<?php echo $urlweb; ?>/assets/css/app-style.css" rel="stylesheet" />
  <link href="<?php echo $urlweb; ?>/assets/css/style-main<?php echo $s0['warna']; ?>.css" rel="stylesheet" />
  <!-- Custom Style-->
  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
  <style type="text/css">
    .carousel img {
      width: 90%;
      margin-right: 10px;
    }

    @media screen and (max-width: 768px) {

      /* half-width cells for larger devices */
      .carousel img {
        width: 90%;
      }
    }

    .navbar-expand {
      background-color: #eee;
      margin-left: auto;
      margin-right: auto;
      text-align: center;

      max-width: 40em;
      border-top: 2px solid red;

      box-shadow: rgba(0, 0, 0, 0.30) 0px 1px 8px;
      background-color: white;
    }

    .navbar-dark .navbar-nav .nav-link {
      color: rgb(223 22 22);
      font-size: 1.2em;

      transition: .5s ease-in-out;


    }

    .navbar-dark .navbar-nav .active {
      transform: scale(1.15) translateY(-1em);
      transition: .5s ease-in-out;
      border-radius: 100%;
      border: 4px solid #c8e4f9;
      background: red;
      width: 52px;
      margin: auto;
    }

    .navbar-dark .navbar-nav .nav-link .active {
      color: white;
      text-align: center;
    }
  </style>
</head>
<!-- Bottom Navbar -->
<nav class="navbar navbar-dark navbar-expand fixed-bottom d-none d-lg-none d-xl-none p-0">
  <ul class="navbar-nav nav-justified w-100">
    <li class="nav-item">
      <a href="index" class="nav-link text-center">
        <i class="fa fa-search"></i>
        <span class="small d-block">Cek</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="transaksi" class="nav-link text-center">
        <i class="fa fa-tag"></i>
        <span class="small d-block">Harga</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="artikel" class="nav-link text-center active">
        <i class="fas fa-home"></i>
      </a>
    </li>
    <?php if (isset($_SESSION['user'])) { ?>
      <li class="nav-item">
        <a href="map" class="nav-link text-center">
          <i class="fas fa-history"></i>
          <span class="small d-block">Riwayat</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link text-center">
          <i class="fas fa-user"></i>
          <span class="small d-block">Profil</span>
        </a>
      </li>
    <?php } else { ?>
      <li class="nav-item">
        <a href="map" class="nav-link text-center">
          <i class="fas fa-sign-in-alt"></i>
          <span class="small d-block">Masuk</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link text-center">
          <i class="fas fa-user-plus"></i>
          <span class="small d-block">Daftar</span>
        </a>
      </li>
    <?php } ?>
  </ul>
</nav>
<script>
  $('.dropdown-toggle').dropdown()
</script>
<script type="text/javascript">
  $(function() {
    var path = window.location.href; // Mengambil data URL pada Address bar
    $('nav a').each(function() {
      // Jika URL pada menu ini sama persis dengan path...
      if (this.href === path) {
        // Tambahkan kelas "active" pada menu ini
        $(this).addClass('active');
      } else {
        $(this).removeClass('active');
      }
    });
  });
</script>

<body>






  <!-- Start wrapper-->
  <div id="wrapper">

    <!--Start topbar header-->
    <?php include('top_menu.php'); ?>
    <!--End topbar header-->

    <div class="clearfix" style="padding-bottom: 4rem;"></div>
    <?php include('home_' . $s0['template'] . '.php'); ?>


    <div class="d-block d-sm-none" style="height: 100px;"></div>
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
    <div class="modal fade" id="exampleModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-dark animated bounceIn" style="background: #1e2124;">
          <div class="modal-body text-left" style="color: #fff!important;">
            <?php
            $sql_banner = mysqli_query($conn, "SELECT * FROM `tb_banner` WHERE id = 1") or die(mysqli_error());
            $ssb = mysqli_fetch_array($sql_banner);
            if ($ssb['image'] != '') {
              echo '
                  <img src="' . $urlwebs . '/upload/' . $ssb['image'] . '" class="img-fluid mb-3" style="display: block; margin: 0 auto;">
                ';
            }
            echo '<div style="margin: 15px!important;">' . $ssb['content'] . '</div>';
            ?>
          </div>
          <div class="modal-footer">
            <div class="row" style="width: 100%;">
              <div class="col-8 text-left">
                <div class="form-group form-check mt-2">
                  <input type="checkbox" name="popup" class="form-check-input" value="1" id="exampleCheck1">
                  <label class="form-check-label text-white mt-1" for="exampleCheck1">Jangan Tayangkan Lagi</label>
                  <input type="hidden" name="ip" id="ipaddress" value="<?php echo $ip; ?>">
                </div>
              </div>
              <div class="col-4 text-right">
                <button type="button" class="btn btn-warning" data-dismiss="modal" aria-label="Close">
                  Tutup
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Start footer-->
    <?php include('footer.php'); ?>
    <script>
      $(window).on('load', function() {
        $('#exampleModal').modal({
          show: <?php echo $lihat; ?>,
          backdrop: 'static',
          keyboard: false
        });
      });
      $(document).ready(function() {
        $("#exampleCheck1").change(function() {
          if (this.checked == true) {
            $.ajax({
              url: "<?php echo $urlweb; ?>/popup.php",
              method: "POST",
              data: {
                id: 1,
                ipaddress: $('#ipaddress').val()
              },
              success: function(data) {

              }
            })
          }
        });
      });
    </script>
</body>

</html>