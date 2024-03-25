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

if ($_SESSION['level'] == "Kepala Cabang") {
    header("Location: admin.php");
    exit;
}

if ($_SESSION["level"] == "Direktur Keuangan") {
    header("Location: dirkeu.php");
    exit;
}

if ($_SESSION['level'] == "Direktur Utama") {
    header("Location: dirut.php");
    exit;
}

if ($_SESSION["level"] == "Purchasing") {
    header("Location: admin3.php");
    exit;
}

if ($_SESSION["level"] == "Staff IT") {
    header("Location: it.php");
    exit;
}
  include "koneksi.php";
  $id_user = $_SESSION["id_user"];

  $nama = $_SESSION["nama_emp"];

  $jabatan = $_SESSION['nama_jabatan'];
  
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
	  <link rel="icon" href="images/logo-mmm.png" type="image/ico" />

    <title>PT MITRA MARITIM MANDIRI</title>

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
              <a href="hrd.php" class="site_title"><i class="fa fa-anchor"></i> <span>Mitra Maritim, M</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/logo-mmm.png" alt="..." class="img-circle profile_img">
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
                      <li><a href="hrd.php?page=dashboard">Dashboard</a></li>
                      <!-- <li><a href="index2.html">Dashboard2</a></li>
                      <li><a href="index3.html">Dashboard3</a></li> -->
                    </ul>
                  </li>

                  <li><a><i class="fa fa-bar-chart"></i> Sales & Marketing<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="finance.php?page=salesPlan">Sales Plan</a></li>
                      <li><a href="finance.php?page=RAB">RAB</a></li>
                      <li><a href="finance.php?page=pengajuanPPU">Pengajuan PPU</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-ship"></i> Operasional & Shipping<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="finance.php?page=voyageTracking">Voyage Tracking <br> <b style="color:#f5b042">(Coming Soon)</b></a></li>
                      <li><a href="finance.php?page=vesselDatabase">Vessel Database</a></li>
                      <li><a href="finance.php?page=stockBBM">Stock BBM Monitor <br> <b style="color:#f5b042">(Coming Soon)</b></a></li>
                      <li><a href="finance.php?page=monitoringSertifikat">Monitoring Sertifikat & Legalitas</a></li>
                      <li><a href="finance.php?page=pengajuanPPU">Pengajuan PPU</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-shopping-cart"></i> Purchasing<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="hrd.php?page=inventarisAsset">Inventaris & Asset Armada</a></li>
                      <li><a href="hrd.php?page=pengajuanPPU">Pengajuan PPU</a></li>
                      <li><a href="hrd.php?page=dataBarang">Data Barang/Sparepart</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-credit-card"></i> Finance & Accounting<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="hrd.php?page=dataBarang">PPU & BPU</a></li>
                      <li><a href="hrd.php?page=actualRAB">RAB/Actual RAB (Jurnal Umum) <br> <b style="color:#f5b042">(Coming Soon)</b></a></li>
                      <li><a href="hrd.php?page=omset">Penjualan (Omset) <br> <b style="color:#f5b042">(Coming Soon)</b></a></li>
                      <li><a href="hrd.php?page=labaRugi">Laba & Rugi <br> <b style="color:#f5b042">(Coming Soon)</b></a></li>
                    </ul>
                  </li>
                 
                  <!-- <li><a><i class="fa fa-folder"></i> Master Barang<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="hrd.php?page=dataBarang">Daftar Barang</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-database"></i> Asset dan Inventaris<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="hrd.php?page=dataInventaris">Storage Barang</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-history"></i>History Permintaan<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="hrd.php?page=historyPermintaan">History Permintaan Barang</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-shopping-cart"></i> Pembelian Barang<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="hrd.php?page=approvePembelian">Approve Pembelian Barang</a></li>
                      <li><a href="hrd.php?page=invoicePembelian">Invoice Pembelian</a></li>
                    </ul>
                  </li> -->

                  <li><a><i class="fa fa-users"></i> Human Resources<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="hrd.php?page=dataKaryawan">Data Karyawan</a></li>
                      <li><a href="hrd.php?page=crew">Database Crew</a></li>
                      <li><a href="hrd.php?page=kontrakKerja">Kontrak Kerja</a></li>
                      <li><a href="hrd.php?page=absen">Data Absen</a></li>
                      <li><a href="hrd.php?page=aksesPintu">Data Akses Pintu</a></li>
                      <li><a href="hrd.php?page=userLogin">Data Login</a></li>
                      <li><a href="hrd.php?page=penitipanIjazah">Penitipan Ijazah</a></li>
                      <li><a href="hrd.php?page=manageCuti">Manage Cuti</a></li>
                      <!-- <li><a href="hrd.php?page=reqCuti">Form Cuti</a></li> -->
                      <!-- <li><a href="hrd.php?page=approveCuti">Approve Cuti</a></li> -->

                      <!-- notifikasi lengket jika tidak ada data yang ditampilkan maka spannya tetap ada tapi 0 -->
                     <!--  <li class="nav-item">
                          <a href="hrd.php?page=approveCuti" class="nav-link">
                              Approve Cuti <span class="badge badge-primary">
                                  <?php
                                      // Query untuk menghitung jumlah cuti yang belum diapprove
                                      $query = "SELECT COUNT(*) AS jml_cuti_belum_diapprove FROM req_cuti JOIN kategori_cuti ON kategori_cuti.id_kategori_cuti=req_cuti.id_kategori_cuti JOIN karyawan ON karyawan.id_emp=req_cuti.id_emp WHERE req_cuti.status_cuti='Belum diapprove'";
                                      $result = mysqli_query($koneksi, $query);
                                      $data = mysqli_fetch_assoc($result);
                                      echo $data['jml_cuti_belum_diapprove'];
                                  ?>
                              </span>
                          </a>
                      </li> -->

                      <!-- untuk menampilkan notifikasi permanent alias tidak hilang sebelum klik tombol approve -->
                      <!-- <li class="nav-item">
                          <a href="hrd.php?page=approveCuti" class="nav-link">
                              Approve Cuti <?php
                                  // Query untuk menghitung jumlah cuti yang belum diapprove
                                  $query = "SELECT COUNT(*) AS jml_cuti_belum_diapprove FROM req_cuti JOIN kategori_cuti ON kategori_cuti.id_kategori_cuti=req_cuti.id_kategori_cuti JOIN karyawan ON karyawan.id_emp=req_cuti.id_emp WHERE req_cuti.status_cuti='Belum diapprove'";
                                  $result = mysqli_query($koneksi, $query);
                                  $data = mysqli_fetch_assoc($result);

                                  // Cek apakah ada data
                                  if ($data['jml_cuti_belum_diapprove'] > 0) {
                                      echo "<span class='badge badge-primary'>{$data['jml_cuti_belum_diapprove']}</span>";
                                  }
                              ?>
                          </a>
                      </li> -->

                      <!-- untuk menampilkan notif sekali lihat -->
                        <li class="nav-item">
                            <a href="hrd.php?page=approveCuti" class="nav-link">
                                Approve Cuti 
                                <?php
                                    // Check if the notification should be displayed
                                    if (!isset($_SESSION['cuti_notification_displayed'])) {
                                        // Query untuk menghitung jumlah cuti yang belum diapprove
                                        $query = "SELECT COUNT(*) AS jml_cuti_belum_diapprove FROM req_cuti JOIN kategori_cuti ON kategori_cuti.id_kategori_cuti=req_cuti.id_kategori_cuti JOIN karyawan ON karyawan.id_emp=req_cuti.id_emp WHERE req_cuti.status_cuti='Belum diapprove'";
                                        $result = mysqli_query($koneksi, $query);
                                        $data = mysqli_fetch_assoc($result);

                                        // Cek apakah ada data
                                        if ($data['jml_cuti_belum_diapprove'] > 0) {
                                            echo "<span class='badge badge-primary'>{$data['jml_cuti_belum_diapprove']}</span>";
                                        }

                                        // Set session to indicate that the notification has been displayed
                                        $_SESSION['cuti_notification_displayed'] = true;
                                    }
                                ?>
                            </a>
                        </li>
                      <li class="nav-item">
                            <a href="hrd.php?page=approveOnduty" class="nav-link">
                                Approve On Duty karyawan 
                                <?php
                                    // Check if the notification should be displayed
                                    if (!isset($_SESSION['duti_notification_displayed'])) {
                                        // Query untuk menghitung jumlah cuti yang belum diapprove
                                        $query = "SELECT COUNT(*) AS jml_duty_pending FROM on_duty JOIN karyawan ON karyawan.id_emp=on_duty.id_emp WHERE on_duty.status_duty='Pending'";
                                        $result = mysqli_query($koneksi, $query);
                                        $data = mysqli_fetch_assoc($result);

                                        // Cek apakah ada data
                                        if ($data['jml_duty_pending'] > 0) {
                                            echo "<span class='badge badge-primary'>{$data['jml_duty_pending']}</span>";
                                        }

                                        // Set session to indicate that the notification has been displayed
                                        $_SESSION['duti_notification_displayed'] = true;
                                    }
                                ?>
                            </a>
                        </li>
                      <li><a href="hrd.php?page=slipGaji">Slip Gaji</a></li>
                      <li><a href="hrd.php?page=qrCode">QRCode</a></li>
                      <!-- <li><a href="hrd.php?page=attendance">Attendance</a></li>
                      <li><a href="hrd.php?page=penilaian">Penilaian Karyawan</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li> -->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-gear"></i> Setting<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="hrd.php?page=profile">Profile</a></li>
                      <li><a href="logout.php" onclick="return confirm('Anda yakin ingin keluar?')">Logout</a></li>
                    </ul>
                  </li>
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
                    <!-- <a class="dropdown-item"  href="javascript:;"> Profile</a> -->
                    <a class="dropdown-item"  href="?page=profile">Profile <i class="fa fa-user pull-right"></i></a>
                    <a class="dropdown-item"  href="?page=changePassword">Change Password<i class="fa fa-key pull-right"></i></a>
                      <!-- <a class="dropdown-item"  href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a> -->
                    <!-- <a class="dropdown-item"  href="javascript:;">Help</a> -->
                    <a class="dropdown-item" onclick="return confirm('Anda yakin ingin keluar?')"  href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
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

                            case 'inventarisAsset':
                                include "page/06purchasing/inventaris_dan_asset/inventaris_read.php";
                                break;

                            case 'crew':
                                include "page/04hrd/crew/crew.php";
                                break;

                            case 'kontrakCrew':
                                include "page/04hrd/kontrak_crew/kontrak_crew.php";
                                break;

                            case 'masterBank':
                                include "page/04hrd/master_bank/master_bank.php";
                                break;

                            case 'masterJabatan':
                                include "page/hrd/master_jabatan/master_jabatan.php";
                                break;

                            case 'masterDivisi':
                                include "page/hrd/master_divisi/master_divisi.php";
                                break;

                            case 'approve':
                                include "page/admin_approve/admin_aprove.php";
                                break;

                            case 'historyApprove':
                                include "page/history_approve/history_approve.php";
                                break;

                            case 'approvePembelian':
                                include 'page/pembelian_barang/approve_pembelian/approve1.php';
                                break;
                         
                            case 'dashboard':
                                include "page/05dashboard/dashboard.php";
                                break;

                            case 'dataBarang':
                                include 'page/data_barang/barang_read.php';
                                break;

                            case 'dataInventaris':
                                include 'page/asset_dan_inventaris/inventaris_read.php';
                                break;

                            case 'dataKaryawan':
                                include "page/hrd/data_karyawan.php";
                                break;

                            case 'dataKaryawanNonaktif':
                                include "page/hrd/data_karyawan_nonaktif.php";
                                break;

                            case 'manageCuti':
                                include "page/hrd/cuti/manage_cuti/manage_cuti.php";
                                break;

                            case 'aksesPintu':
                                include 'page/hrd/akses_pintu/akses_pintu.php';
                              break;

                            case 'absen':
                                include "page/hrd/data_absen/data_absen.php";
                                break;

                            case 'userLogin':
                                include 'page/hrd/user_login/user_login.php';
                              break;

                            case 'penitipanIjazah':
                                include 'page/hrd/penitipan_ijazah/data_ijazah.php';
                                break;

                            case 'attendance':
                                include 'page/hrd/attendance/attendance.php';
                                break;

                            case 'penilaian':
                                include 'page/hrd/penilaian_karyawan/penilaian.php';
                                break;

                            case 'changePassword':
                                include "page/change_password/change_password.php";
                                break;

                            case 'profile':
                                include "page/profile/profile.php";
                                break;

                            case 'kontrakKerja':
                                include "page/hrd/kontrak_kerja/kontrak_kerja.php";
                                break;

                            case 'reqCuti':
                                include "page/hrd/cuti/req_cuti/form_cuti2.php";
                                break;
                            case 'historyCuti':
                                include "page/hrd/cuti/req_cuti/history_request.php";
                                break;

                            case 'approveCuti':
                                include "page/hrd/cuti/approve_cuti/approve_cuti.php";
                                break;

                            case 'approvedCuti':
                              include "page/hrd/cuti/approve_cuti/approved.php";
                              break;

                            case 'rejectedCuti':
                              include "page/hrd/cuti/reject_cuti/reject_cuti.php";
                              break;

                              case 'approveOnduty':
                                include "page/04hrd/on_duty/approve_duty/approve_duty.php";
                                break;

                              case 'approved':
                                include "page/04hrd/on_duty/approve_duty/approved.php";
                                break;

                              case 'rejected':
                                include "page/04hrd/on_duty/reject_duty/rejected.php";
                                break;

                            case 'historyApproveCuti':
                                include "page/hrd/cuti/approve_cuti/history_approve_cuti.php";
                                break;

                            case 'historyPermintaan':
                                include 'page/history_permintaan/history_permintaan.php';
                                break;

                            case 'invoicePembelian':
                                include 'page/pembelian_barang/invoice/invoice_read.php';
                                break;

                            case 'pengajuanPembelian':
                                include 'page/pembelian_barang/pengajuan_pembelian/pengajuan_pembelian_read.php';
                                break;

                            case 'qrCode':
                                include 'page/hrd/qrcode/qrcode.php';
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

                            case 'slipGaji':
                                include "page/hrd/slip_gaji/slip_gaji.php";
                                break;

                            case "disposal":
                              include "page/06purchasing/inventaris_dan_asset/disposal_read.php";
                              break;

                            default:
                                echo "<center><h3>Maaf. Halaman tidak di temukan!</h3></center>";
                                break;
                        }
                    } else if(isset($_GET['form'])){
                        $form = $_GET['form'];

                        switch ($form) {

                          case 'tambahSlip':
                            include 'page/hrd/slip_gaji/tambah.php';
                            break;

                          case 'ubahSlip':
                            include 'page/hrd/slip_gaji/ubah.php';
                            break;


                          case 'approveOnduty':
                              include "page/04hrd/on_duty/approve_duty/konfirmasiapp_duty.php";
                              break;
                          
                          case 'rejectOnduty':
                            include "page/04hrd/on_duty/reject_duty/reject.php";
                            break;

                          case 'tambahInventaris':
                              include "page/06purchasing/inventaris_dan_asset/tambah.php";
                              break;

                          case 'ubahInventaris':
                              include "page/06purchasing/inventaris_dan_asset/ubah.php";
                              break;

                          case 'hapusInventaris':
                              include 'page/06purchasing/inventaris_dan_asset/hapus.php';
                              break;

                          case "tambahCrew":
                            include "page/04hrd/crew/tambah.php";
                            break;

                          case "hapusCrew":
                              include "page/04hrd/crew/hapus.php";
                              break;

                          case "ubahCrew":
                              include "page/04hrd/crew/ubah.php";
                              break;

                          case "tambahBank":
                              include "page/04hrd/master_bank/tambah.php";
                              break;

                          case "ubahBank":
                              include "page/04hrd/master_bank/ubah.php";
                              break;

                          case "hapusBank":
                              include "page/04hrd/master_bank/hapus.php";
                              break;

                          case "tambahKontrakCrew":
                            include "page/04hrd/kontrak_crew/tambah.php";
                            break;

                            case "ubahKontrakCrew":
                                include "page/04hrd/kontrak_crew/ubah.php";
                                break;

                            case "hapusKontrakCrew":
                                include "page/04hrd/kontrak_crew/hapus.php";
                                break;

                            case "tambahJabatan":
                                include "page/hrd/master_jabatan/tambah.php";
                                break;

                            case "ubahJabatan":
                                include "page/hrd/master_jabatan/ubah.php";
                                break;

                            case "hapusJabatan":
                                include "page/hrd/master_jabatan/hapus.php";
                                break;

                            case "tambahDivisi":
                                include "page/hrd/master_divisi/tambah.php";
                                break;

                            case "ubahDivisi":
                                include "page/hrd/master_divisi/ubah.php";
                                break;

                            case "hapusDivisi":
                                include "page/hrd/master_divisi/hapus.php";
                                break;
                            

                            case 'tambahKaryawan':
                                include "page/hrd/tambah.php";
                                break;

                            case 'ubahKaryawan':
                                include "page/hrd/ubah.php";
                                break;

                            case 'hapusKaryawan':
                                include 'page/hrd/hapus.php';
                                break;

                            case 'rincianKaryawan':
                                include 'page/hrd/rincian_karyawan.php';
                                break;

                            case 'tambahAbsen':
                                include "page/hrd/data_absen/tambah.php";
                                break;

                            case 'ubahAbsen':
                                include "page/hrd/data_absen/ubah.php";
                                break;

                            case 'hapusAbsen':
                                include "page/hrd/data_absen/hapus.php";
                              break;

                            case 'tambahAkses':
                                include 'page/hrd/akses_pintu/tambah.php';
                                break;

                            case 'ubahAkses':
                                include 'page/hrd/akses_pintu/ubah.php';
                                break;


                            case 'hapusAkses':
                                include 'page/hrd/akses_pintu/hapus.php';
                                break;

                            case 'tambahLogin':
                                include 'page/hrd/user_login/tambah.php';
                                break;

                            case 'ubahLogin':
                                include 'page/hrd/user_login/ubah.php';
                                break;

                            case 'hapusLogin':
                                include 'page/hrd/user_login/hapus.php';
                                break;

                            case 'ubahApprove':
                                include "page/admin_approve/konfirmasi_aprove.php";
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

                            case 'tambahIjazah':
                                include "page/hrd/penitipan_ijazah/tambah.php";
                                break;

                            case 'hapusIjazah':
                                include 'page/hrd/penitipan_ijazah/hapus.php';
                                break;

                            case 'ubahIjazah':
                                include 'page/hrd/penitipan_ijazah/ubah.php';
                                break;

                            case 'returnIjazah':
                                include 'page/hrd/penitipan_ijazah/return.php';
                                break;

                            case 'tambahKontrak':
                                include "page/hrd/kontrak_kerja/tambah.php";
                                break;

                            case 'hapusKontrak':
                                include "page/hrd/kontrak_kerja/hapus.php";
                                break;

                            case 'ubahKontrak':
                                include "page/hrd/kontrak_kerja/ubah.php";
                                break;

                            case 'extendKontrak':
                                include "page/hrd/kontrak_kerja/extend.php";
                                break;

                            case 'tambahManageCuti':
                                include "page/hrd/cuti/manage_cuti/tambah.php";
                                break;

                            case 'hapusManageCuti':
                                include 'page/hrd/cuti/manage_cuti/hapus.php';
                                break;

                            case 'ubahManageCuti':
                                include 'page/hrd/cuti/manage_cuti/ubah.php';
                                break;

                            case 'detilKuota':
                                include 'page/hrd/cuti/manage_cuti/detil_manage_cuti.php';
                                break;

                            case 'approveCuti':
                                include 'page/hrd/cuti/approve_cuti/konfirmasi_approve_cuti.php';
                                break;

                            case 'rejectCuti':
                                include 'page/hrd/cuti/reject_cuti/konfirmasi_reject.php';
                                break;

                            case 'app1Pembelian':
                                include 'page/pembelian_barang/approve_pembelian/konfirmasi_app1.php';
                                break;

                            case 'reject1':
                                include 'page/pembelian_barang/approve_pembelian/reject1.php';
                                break;

                            case 'tambahQrcode':
                                include 'page/hrd/qrcode/tambah.php';
                                break;

                            case 'hapusQrcode':
                                include 'page/hrd/qrcode/hapus.php';
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
                        include "page/05dashboard/dashboard.php";
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

