<?php 
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

if ($_SESSION["level"] == "Direktur Operasional") {
    header("Location: dirops.php");
    exit;
} 

if ($_SESSION["level"] == "Direktur Keuangan") {
    header("Location: dirkeu.php");
    exit;
}

if ($_SESSION["level"] == "Purchasing") {
    header("Location: purchasing.php");
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- link jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="k-finance.php?page=dashboard" class="site_title"><i class="fa fa-anchor"></i> <span>Mitra Maritim, M </span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/logo-mmm.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2 class=""><?= $nama;?></h2>
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
                      <li><a href="k-finance.php?page=dashboard">Dashboard</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-bar-chart"></i> Sales & Marketing<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <!-- <li><a href="operasion.php?page=voyageManagement">Voyage Management</a></li> -->
                      <li><a href="k-finance.php?page=salesPlan">Sales Plan</a></li>
                      <li><a href="k-finance.php?page=RAB">RAB</a></li>
                      <li><a href="k-finance.php?page=pengajuanPPU">Pengajuan PPU</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-ship"></i> Operasional & Shipping<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="k-finance.php?page=voyageTracking">Voyage Tracking <br> <b style="color:#f5b042">(Coming Soon)</b></a></li>
                      <li><a href="k-finance.php?page=vesselDatabase">Vessel Database</a></li>
                      <li><a href="k-finance.php?page=stockBBM">Stock BBM Monitor <br> <b style="color:#f5b042">(Coming Soon)</b></a></li>
                      <li><a href="k-finance.php?page=monitoringSertifikat">Monitoring Sertifikat & Legalitas</a></li>
                      <li><a href="k-finance.php?page=pengajuanPPU">Pengajuan PPU</a></li>
                      <li><a href="k-finance.php?page=crew">Crewing</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-shopping-cart"></i> Purchasing<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="k-finance.php?page=inventarisAsset">Inventaris & Asset Armada</a></li>
                      <li><a href="k-finance.php?page=pengajuanPPU">Pengajuan PPU</a></li>
                      <li><a href="k-finance.php?page=dataBarang">Data Barang/Sparepart</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-credit-card"></i> Finance & Accounting<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="k-finance.php?page=BPU">PPU & BPU</a></li>
                      <li><a href="k-finance.php?page=actualRab">RAB/Actual RAB (Jurnal Umum) <br> <b style="color:#f5b042">(Coming Soon)</b></a></li>
                      <li><a href="k-finance.php?page=omset">Penjualan (Omset) <br> <b style="color:#f5b042">(Coming Soon)</b></a></li>
                      <li><a href="k-finance.php?page=labaRugi">Laba & Rugi <br> <b style="color:#f5b042">(Coming Soon)</b></a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-users"></i> Human Resources<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="k-finance.php?page=dataKaryawan">Database Karyawan</a></li>
                      <li><a href="k-finance.php?page=crew">Database Crew</a></li>
                      <li><a href="k-finance.php?page=onDuty">On Duty Karyawan</a></li>
                      <li><a href="k-finance.php?page=slipGaji">Slip Gaji</a></li>
                      <li><a href="k-finance.php?page=cutiKaryawan">Cuti Karyawan</a></li>
                      <!-- <li><a href="operasion.php?page=reqCuti">Form Cuti</a></li>
                      <li><a href="operasion.php?page=historyCuti">History Cuti</a></li> -->
                      <!-- <li><a href="tables_dynamic.html">Table Dynamic</a></li> -->
                    </ul>
                  </li>

                  <li><a><i class="fa fa-gear"></i> Setting<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="k-finance.php?page=profile">Profile</a></li>
                      <li><a href="logout.php" onclick="return confirm('Anda yakin ingin keluar?')">Logout</a></li>
                    </ul>
                  </li>


                </ul>
              </div>
              <!-- <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div> -->

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
                    <!-- <a class="dropdown-item"  href="javascript:;"> Profile</a>
                      <a class="dropdown-item"  href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a> -->
                    <a class="dropdown-item"  href="?page=profile">Profile <i class="fa fa-user pull-right"></i></a>
                    <a class="dropdown-item"  href="?page=changePassword">Change Password<i class="fa fa-key pull-right"></i></a>
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

                            case 'crew':
                                include "page/04hrd/crew/crew_read.php";
                                break;

                            case 'kontrakCrew':
                                include "page/04hrd/kontrak_crew/kontrak_crew_read.php";
                                break;

                            case 'crewEndContract':
                              include "page/04hrd/kontrak_crew/endkontrak_crew_read.php";
                              break;
 
                            case 'masterBank':
                                include "page/04hrd/master_bank/master_bank.php";
                                break;

                            case 'masterVessel':
                              include "page/02operasion_dan_shipping/vessel_database/vessel_database_read.php";
                              break;

                            case 'masterPosisi':
                              include "page/04hrd/master_posisi/master_posisi.php";
                              break;

                            case 'salesPlan':
                              include "page/01sales_dan_marketing/sales_plan/sales_plan_read.php";
                              break;

                            case 'masterCustomer':
                              include "page/01sales_dan_marketing/master_customer/master_customer.php";
                              break;

                            case 'masterDept':
                              include "page/01sales_dan_marketing/master_dept/master_dept.php";
                              break;

                            case 'masterKargo':
                              include "page/01sales_dan_marketing/master_kargo/master_kargo.php";
                              break;

                            case 'dataKaryawan':
                              include "page/hrd/data_karyawan_read.php";
                              break;

                            case 'dataKaryawanNonaktif':
                              include "page/hrd/data_karyawan_nonaktif_read.php";
                              break;

                            case "onDuty":
                                include "page/04hrd/on_duty/on_duty.php";
                                break;

                            case 'pengajuan':
                                include "page/pengajuan/pengajuan.php";
                                break;

                            case 'historyPengajuan':
                                include "page/history_pengajuan/history_pengajuan.php";
                                break;

                            case 'changePassword':
                                include 'page/change_password/change_password.php';
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

                            case 'dashboard':
                                include "page/05dashboard/dashboard.php";
                                break;

                            case 'dataInventaris':
                                include 'page/asset_dan_inventaris/inventaris_read.php';
                                break;

                            case 'dataBarang':
                                include 'page/data_barang/barang_read.php';
                                break;

                            case 'invoicePembelian':
                                include 'page/pembelian_barang/invoice/invoice_read.php';
                                break;

                            case 'pengajuanPembelian':
                                include "page/pembelian_barang/pengajuan_pembelian/pengajuan_pembelian_read.php";
                                break;

                            case 'transaksiBarangMasuk':
                                include 'page/asset_dan_inventaris/transaksi_barang/barang_masuk/barang_masuk.php';
                                break;

                            case 'laporan':
                                include "page/laporan/laporan.php";
                                break;

                            case 'tagihan':
                                include "page/tagihan/tagihan.php";
                                break;

                            case 'inventarisAsset':
                              include "page/06purchasing/inventaris_dan_asset/inventaris_read.php";
                              break;

                            case 'approved':
                              include "page/04hrd/on_duty/approved.php";
                              break;

                            case 'rejected':
                              include "page/04hrd/on_duty/rejected.php";
                              break;

                              case 'cutiKaryawan':
                                include "page/hrd/cuti/req_cuti/cuti.php";
                                break;
  
                              case 'approvedCuti':
                                include "page/hrd/cuti/req_cuti/approved.php";
                                break;
  
                              case 'rejectedCuti':
                                include "page/hrd/cuti/req_cuti/rejected.php";
                                break;

                                case "masterLokasi":
                                  include "page/data_master/lokasi/lokasi.php";
                                  break;
    
                                case "masterRoom":
                                  include "page/data_master/room/room.php";
                                  break;
    
                                case "disposal":
                                  include "page/06purchasing/inventaris_dan_asset/disposal_read.php";
                                  break;

                                case "monitoringSertifikat":
                                  include "page/02operasion_dan_shipping/monitoring_sertifikat/monitoring_sertifikat_read.php";
                                  break;

                                case "sertifikatExpired":
                                  include "page/02operasion_dan_shipping/monitoring_sertifikat/expired_read.php";
                                  break;

                                case "sertifikatWillExpired":
                                  include "page/02operasion_dan_shipping/monitoring_sertifikat/will_expired_read.php";
                                  break;

                                case "sertifikatAktif":
                                  include "page/02operasion_dan_shipping/monitoring_sertifikat/sertifikat_aktif_read.php";
                                  break;

                                case "RAB":
                                  include "page/01sales_dan_marketing/rab/rab_read.php";
                                  break;

                                case "vesselDatabase":
                                  include "page/02operasion_dan_shipping/vessel_database/vessel_database_read.php";
                                  break;

                                case "pengajuanPPU":
                                  include "page/02operasion_dan_shipping/pengajuan_ppu/ppu.php";
                                  break;

                                case "loanPanjar":
                                  include "page/02operasion_dan_shipping/pengajuan_ppu/loan-panjar/loan-panjar-read.php";
                                  break;

                                case "bpuLoanPanjar":
                                  include "page/03_finance_dan_accounting/bpu_ppu/bpu_loan.php";
                                  break;

                                case "BPU":
                                  include "page/03_finance_dan_accounting/bpu_ppu/bpu.php";
                                  break;

                                case "bpuExpenses":
                                  include "page/03_finance_dan_accounting/bpu_expenses/bpu_expenses.php";
                                  break;

                                case "expenses";
                                  include "page/02operasion_dan_shipping/pengajuan_ppu/expenses/expenses_read.php";
                                  break;

                                case 'slipGaji':
                                  include "page/hrd/slip_gaji/slip_gaji.php";
                                  break;
                            

                            default:
                                echo "<center><h3 class='h5 mt-3'>Maaf. Anda Tidak Memiliki Akses Ke Halaman ini!</h3></center>";
                                break;
                        }
                    } else if(isset($_GET['form'])){
                        $form = $_GET['form'];

                        switch ($form) {

                          case "lihatUraianRead":
                            include "page/02operasion_dan_shipping/pengajuan_ppu/loan-panjar/lihat_uraian_read.php";
                            break;

                          case "tambahBpuExpenses":
                            include "page/03_finance_dan_accounting/bpu_expenses/tambah.php";
                            break;

                          case "ubahBpuExpenses":
                            include "page/03_finance_dan_accounting/bpu_expenses/ubah.php";
                            break;

                          case "hapusBpuExpenses":
                            include "page/03_finance_dan_accounting/bpu_expenses/hapus.php";
                            break;

                          case 'tambahSlip':
                            include 'page/hrd/slip_gaji/tambah.php';
                            break;

                          case 'ubahSlip':
                            include 'page/hrd/slip_gaji/ubah.php';
                            break;

                          case "tambahBpuLoan":
                            include "page/03_finance_dan_accounting/bpu_ppu/tambah.php";
                            break;

                          case "ubahBpuLoan":
                            include "page/03_finance_dan_accounting/bpu_ppu/ubah.php";
                            break;

                          case "hapusBpuLoan":
                            include "page/03_finance_dan_accounting/bpu_ppu/hapus.php";
                            break;

                          case "lihatUraianRead":
                            include "page/02operasion_dan_shipping/pengajuan_ppu/loan-panjar/lihat_uraian_read.php";
                            break;

                          case "lihatUraianBpu":
                            include "page/03_finance_dan_accounting/bpu_ppu/lihat_uraian_bpu.php";
                            break;

                          case "lihatApprove":
                            include "page/01sales_dan_marketing/sales_plan/lihat_approve_read.php";
                            break;

                          case "lihatRab":
                            include "page/01sales_dan_marketing/rab/lihat_approve_read.php";
                            break;

                          case "tambahRab":
                            include "page/01sales_dan_marketing/rab/tambah.php";
                            break;

                          case "ubahRab":
                            include "page/01sales_dan_marketing/rab/ubah.php";
                            break;

                          case "hapusRab":
                            include "page/01sales_dan_marketing/rab/hapus.php";
                            break;

                            case "lihatLampiran":
                              include "page/04hrd/crew/lihat_lampiran_read.php";
                              break;

                            case "tambahSertifikat":
                              include "page/02operasion_dan_shipping/monitoring_sertifikat/tambah.php";
                              break;

                            case "ubahSertifikat":
                              include "page/02operasion_dan_shipping/monitoring_sertifikat/ubah.php";
                              break;

                            case "hapusSertifikat":
                              include "page/02operasion_dan_shipping/monitoring_sertifikat/hapus.php";
                              break;

                            case "tambahOnduty":
                              include "page/04hrd/on_duty/tambah.php";
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

                            case "tambahKontrakCrew":
                                include "page/04hrd/kontrak_crew/tambah.php";
                                break;

                            case "ubahKontrakCrew":
                                include "page/04hrd/kontrak_crew/ubah.php";
                                break;

                            case "hapusKontrakCrew":
                                include "page/04hrd/kontrak_crew/hapus.php";
                                break;

                            case "tambahBank":
                                include "page/04hrd/master_bank/tambah.php";
                                break;

                            case "hapusBank":
                                include "page/04hrd/master_bank/hapus.php";
                                break;

                            case "ubahBank":
                                include "page/04hrd/master_bank/ubah.php";
                                break;

                            case "tambahSales":
                              include "page/01sales_dan_marketing/sales_plan/tambah.php";
                              break;

                          case "hapusSales":
                              include "page/01sales_dan_marketing/sales_plan/hapus.php";
                              break;

                          case "ubahSales":
                              include "page/01sales_dan_marketing/sales_plan/ubah.php";
                              break;

                          case "tambahVessel":
                              include "page/01sales_dan_marketing/master_vessel/tambah.php";
                              break;

                          case "hapusVessel":
                              include "page/01sales_dan_marketing/master_vessel/hapus.php";
                              break;

                          case "ubahVessel":
                              include "page/01sales_dan_marketing/master_vessel/ubah.php";
                              break;

                              case "tambahCustomer":
                                include "page/01sales_dan_marketing/master_customer/tambah.php";
                                break;

                            case "hapusCustomer":
                                include "page/01sales_dan_marketing/master_customer/hapus.php";
                                break;

                            case "ubahCustomer":
                                include "page/01sales_dan_marketing/master_customer/ubah.php";
                                break;

                            case "tambahDept":
                                include "page/01sales_dan_marketing/master_dept/tambah.php";
                                break;

                            case "hapusDept":
                                include "page/01sales_dan_marketing/master_dept/hapus.php";
                                break;

                            case "ubahDept":
                                include "page/01sales_dan_marketing/master_dept/ubah.php";
                                break;

                                case "tambahKargo":
                                  include "page/01sales_dan_marketing/master_kargo/tambah.php";
                                  break;
  
                              case "hapusKargo":
                                  include "page/01sales_dan_marketing/master_kargo/hapus.php";
                                  break;
  
                              case "ubahKargo":
                                  include "page/01sales_dan_marketing/master_kargo/ubah.php";
                                  break;

                            case "tambahPosisi":
                              include "page/04hrd/master_posisi/tambah.php";
                              break;

                            case "ubahPosisi":
                              include "page/04hrd/master_posisi/ubah.php";
                              break;

                            case "hapusPosisi":
                              include "page/04hrd/master_posisi/hapus.php";
                              break;

                            case 'ubahPengajuan':
                                include "page/pengajuan/ubah.php";
                                break;

                            case 'tambahPengajuan':
                                include "page/pengajuan/tambah.php";
                                break;

                            case 'hapusPengajuan':
                                include "page/pengajuan/hapus.php";
                                break;

                            case 'updateProfile':
                                include 'page/profile/update_profile.php';
                                break;

                            case 'ubahRequestCuti':
                                include 'page/hrd/cuti/req_cuti/ubah.php';
                                break;

                            case 'hapusRequestCuti':
                                include 'page/hrd/cuti/req_cuti/hapus.php';
                                break;

                            case 'tambahKaryawan':
                                include 'page/hrd/tambah.php';
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

                            case 'tambahBarang':
                                include "page/data_barang/tambah.php";
                                break;

                            case 'ubahBarang':
                                include "page/data_barang/ubah.php";
                                break;

                            case 'hapusBarang':
                                include "page/data_barang/hapus.php";
                                break;

                            case 'tambahBarangMasuk':
                                include "page/asset_dan_inventaris/transaksi_barang/barang_masuk/tambah.php";
                                break;
                
                            case 'cariAnggaran':
                              include "page/anggaran/cari.php";
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
    

          
         


        <!-- /page content -->

        <!-- footer content -->
        <footer class="">
          <div class="pull-right">
            PT Mitra Maritim Mandiri - All Right Reserved <a href="https://mitramaritim.com">2024</a>
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
