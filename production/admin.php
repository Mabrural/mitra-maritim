<?php 
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

if ($_SESSION["level"] == "Staff Operasional" || $_SESSION["level"] == "Crew Armada") {
    header("Location: index.php");
    exit;
}

if ($_SESSION["level"] == "Direktur Operasional") {
    header("Location: admin2.php");
    exit;
}

if ($_SESSION["level"] == "Direktur Keuangan") {
    header("Location: dirkeu.php");
    exit;
}

if ($_SESSION["level"] == "Purchasing") {
    header("Location: admin3.php");
    exit;
}

if ($_SESSION["level"] == "Direktur Utama") {
    header("Location: dirut.php");
    exit;
}

if ($_SESSION["level"] == "Direktur HRD") {
    header("Location: hrd.php");
    exit;
}

if ($_SESSION["level"] == "Staff IT") {
    header("Location: it.php");
    exit;
}

  include "koneksi.php";
  $id_user = $_SESSION["id_user"];

  $nama = $_SESSION["nama_emp"];

  $jabatan = $_SESSION['jabatan'];

  $karyawan = query("SELECT * FROM user JOIN karyawan ON karyawan.id_emp=user.id_emp WHERE user.id_user = $id_user")[0];
  
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="images/logo-gpp.png" type="image/ico" />

    <title>PT GLOBAL PETRO PASIFIC</title>

    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!-- datatables -->

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="admin.php" class="site_title"><i class="fa fa-globe"></i> <span>PT Global Petro</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/gpp.png" alt="..." class="img-circle profile_img">
              </div> 
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?= $nama;?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="admin.php">Dashboard</a></li>
                      <!-- <li><a href="index2.html">Dashboard2</a></li>
                      <li><a href="index3.html">Dashboard3</a></li> -->
                    </ul>
                  </li>

                  <li><a><i class="fa fa-folder"></i> Master Barang<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="admin.php?page=dataBarang">Daftar Barang</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-database"></i> Asset dan Inventaris<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="admin.php?page=dataInventaris">Storage Barang</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-edit"></i> Permintaan Barang<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <!-- <li><a href="admin.php?page=approve">Approval</a></li> -->
                        <li class="nav-item">
                            <a href="admin.php?page=approve" class="nav-link">
                                Approve Permintaan Barang 
                                <?php
                                    // Check if the notification should be displayed
                                    if (!isset($_SESSION['cuti_notification_displayed'])) {
                                        // Query untuk menghitung jumlah cuti yang belum diapprove
                                        $query = "SELECT COUNT(*) AS jml_barang_belum_diapprove FROM req_barang JOIN user ON user.id_user=req_barang.id_user WHERE req_barang.status_req='Menunggu Persetujuan KC'";
                                        $result = mysqli_query($koneksi, $query);
                                        $data = mysqli_fetch_assoc($result);

                                        // Cek apakah ada data
                                        if ($data['jml_barang_belum_diapprove'] > 0) {
                                            echo "<span class='badge badge-primary'>{$data['jml_barang_belum_diapprove']}</span>";
                                        }

                                        // Set session to indicate that the notification has been displayed
                                        $_SESSION['cuti_notification_displayed'] = true;
                                    }
                                ?>
                            </a>
                        </li>
                      <li><a href="admin.php?page=historyApprove">History Permintaan Barang</a></li>
                      <!-- <li><a href="tables_dynamic.html">Table Dynamic</a></li> -->
                    </ul>
                  </li>

                  <!-- <li><a><i class="fa fa-shopping-cart"></i> Pembelian Barang<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="admin.php?page=invoicePembelian">Invoice Pembelian</a></li>
                    </ul>
                  </li> -->

                  <li><a><i class="fa fa-users"></i> Human Resources<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="admin.php?page=reqCuti">Form Cuti</a></li>
                      <li><a href="admin.php?page=historyCuti">History Cuti</a></li>
                    </ul>
                  </li>

                  <!-- <li><a><i class="fa fa-users"></i> Human Resources<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="admin.php?page=hrd">Data Karyawan</a></li>
                      <li><a href="admin.php?page=cuti">Form Cuti</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                  </li> -->
                  <!-- <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Chart JS</a></li>
                      <li><a href="chartjs2.html">Chart JS2</a></li>
                      <li><a href="morisjs.html">Moris JS</a></li>
                      <li><a href="echarts.html">ECharts</a></li>
                      <li><a href="other_charts.html">Other Charts</a></li>
                    </ul>
                  </li> -->
                  <!-- <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li> -->
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!-- <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div> -->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                   <img src="img/<?= $karyawan['gambar'];?>" alt=""> <strong> <?= $nama;?></strong> ( <?= $jabatan?> )
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="?page=profile">Profile <i class="fa fa-user pull-right"></i></a>
                    <a class="dropdown-item"  href="?page=changePassword">Change Password<i class="fa fa-key pull-right"></i></a>
                      <!-- <a class="dropdown-item"  href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a> -->
                    <!-- <a class="dropdown-item"  href="javascript:;">Help</a> -->
                    <a class="dropdown-item"  href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>

                <!-- <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li> -->
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <?php
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        switch ($page) {
                            case 'approve':
                                include "page/admin_approve/admin_aprove.php";
                                break;

                            case 'historyApprove':
                                include "page/history_approve/history_approve.php";
                                break;
                         
                            case 'dashboard':
                                include "page/dashboard/dashboard.php";
                                break;

                            case 'dataBarang':
                                include 'page/data_barang/barang_read.php';
                                break;

                            case 'dataInventaris':
                                include 'page/asset_dan_inventaris/inventaris_read.php';
                                break;

                            case 'changePassword':
                                include "page/change_password/change_password.php";
                                break;

                            case 'profile':
                                include "page/profile/profile.php";
                              break;

                            case 'reqCuti':
                                include "page/hrd/cuti/req_cuti/form_cuti.php";
                                break;
                            case 'historyCuti':
                                include "page/hrd/cuti/req_cuti/history_request.php";
                                break;

                            case 'invoicePembelian':
                                include 'page/pembelian_barang/invoice/invoice_read.php';
                                break;

                            case 'pengajuanPembelian':
                                include 'page/pembelian_barang/pengajuan_pembelian/pengajuan_pembelian_read.php';
                                break;

                            case 'laporan':
                                include "page/laporan/laporan.php";
                                break;

                            case 'tagihan':
                                include "page/tagihan/tagihan.php";
                                break;
              
                            case 'profil':
                                include "page/profil/profil.php";
                                break;

                            default:
                                echo "<center><h3>Maaf. Halaman tidak di temukan!</h3></center>";
                                break;
                        }
                    } else if(isset($_GET['form'])){
                        $form = $_GET['form'];

                        switch ($form) {
                            

                            case 'tambahKaryawan':
                                include "page/hrd/tambah.php";
                                break;

                            case 'ubahKaryawan':
                                include "page/hrd/ubah.php";
                                break;

                            case 'hapusKaryawan':
                                include 'page/hrd/hapus.php';
                                break;

                            case 'ubahApprove':
                                include "page/admin_approve/konfirmasi_aprove.php";
                                break;

                            case 'reject':
                                include "page/admin_approve/reject_kc.php";
                                break;

                            case 'tambahPengajuan':
                                include "page/pengajuan/tambah.php";
                                break;

                            case 'hapusPengajuan':
                                include "page/pengajuan/hapus.php";
                                break;
                
                            case 'updateProfile':
                                include "page/profile/update_profile.php";
                                break;

                            case 'tambahBarang':
                                include 'page/data_barang/tambah.php';
                                break;

                            case 'ubahBarang':
                                include 'page/data_barang/ubah.php';
                                break;

                            case 'hapusBarang':
                                include 'page/data_barang/hapus.php';
                                break;

                            case 'ubahCatatan':
                                include "page/catatan/ubah.php";
                                break;
                            case 'tambahCatatan':
                                include "page/catatan/tambah.php";
                                break;
                            case 'hapusCatatan':
                                include "page/catatan/hapus.php";
                                break;
              case 'cariCatatan':
                                include "page/catatan/cari.php";
                                break;

                            case 'ubahTagihan':
                                include "page/tagihan/ubah.php";
                                break;
                            case 'tambahTagihan':
                                include "page/tagihan/tambah.php";
                                break;
                            case 'hapusTagihan':
                                include "page/tagihan/hapus.php";
                                break;

                            case 'ubahProfil':
                                include "page/profil/ubah.php";
                                break;
                        

                            default:
                                echo "<center><h3>Maaf. Halaman tidak di temukan!</h3></center>";
                                break;
                        }
                    }

                    else{
                        include "dashboard2.php";
                    }
                ?>
        </div>
          <!-- /top tiles -->


        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            PT Global Petro Pasific - All Right Reserved <a href="https://globalpetro.co.id">2024</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>

