<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Manage Cuti <small></small></h2>
        <a href="?form=tambahManageCuti" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Tambah Manage Cuti</a>
        <!-- <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Settings 1</a>
                <a class="dropdown-item" href="#">Settings 2</a>
              </div>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul> -->
        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <!-- <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p> -->

        <div class="table-responsive">
          <table id="example" class="display" style="width:100%">
            <thead style="background-color: #2a3f54; color: #dfe5f1;">
              <tr class="headings">
                <!-- <th>
                  <input type="checkbox" id="check-all" class="flat">
                </th> -->
                <th class="column-title">No. </th>
                <th class="column-title">Nama Karyawan</th>
                <th class="column-title">Jabatan</th>
                <th class="column-title">Divisi</th>
                <th class="column-title">Jenis Cuti</th>
                <th class="column-title">Kuota</th>
                <th class="column-title no-link last"><span class="nobr">Action</span>
                </th>
                <th class="bulk-actions" colspan="7">
                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th>
              </tr>
            </thead>

            <tbody>
              <tr class="even pointer">
              	<?php 
              		$no = 1;
              		// $query = "SELECT * FROM akses_pintu JOIN karyawan ON karyawan.id_emp=akses_pintu.id_emp JOIN lantai ON lantai.id_lantai=akses_pintu.id_lantai ORDER BY akses_pintu.id_akses DESC";
                  $query = "SELECT * FROM manage_cuti JOIN karyawan ON karyawan.id_emp=manage_cuti.id_emp JOIN kategori_cuti ON kategori_cuti.id_kategori_cuti=manage_cuti.id_kategori_cuti ORDER BY manage_cuti.id_manage_cuti DESC";
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	      		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><a href="?form=rincianKaryawan&id_emp=<?=$data["id_emp"]?>"><?= $data['nama_emp'];?></a></td>
                <td class=" "><?= $data['jabatan'];?> </td>
                <td class=" "><?= $data['divisi'];?> </td>
                <td class=" "><?= $data['kategori_cuti'];?> </td>

                <td class="">
                    <div class="progress">
                        <?php
                        $kategori_cuti = $data['kategori_cuti'];
                        $kuota_cuti = $data['kuota_cuti'];

                        // Menghitung persentase width sesuai dengan kondisi tertentu
                        if ($kategori_cuti == 'Annual Leave') {
                            $width_percentage = ($kuota_cuti == 12) ? 100 : min(100, ($kuota_cuti / 12) * 100);
                        } elseif ($kategori_cuti == 'Unpaid Leave') {
                            $width_percentage = ($kuota_cuti == 3) ? 100 : min(100, ($kuota_cuti / 3) * 100);
                        } elseif ($kategori_cuti == 'Sick Leave') {
                            $width_percentage = ($kuota_cuti == 6) ? 100 : min(100, ($kuota_cuti / 6) * 100);
                        } else {
                            // Jika tidak memenuhi kondisi spesifik, gunakan perhitungan default
                            $width_percentage = min(100, ($kuota_cuti / 12) * 100);
                        }

                        // Output progress bar dengan width yang dihitung
                        echo '<div class="progress-bar progress-bar-striped" role="progressbar" style="width: ' . $width_percentage . '%" aria-valuenow="' . $kuota_cuti . '" aria-valuemin="0" aria-valuemax="12">' . $kuota_cuti . '</div>';
                        ?>
                    </div>
                </td>
                <!-- <td class="">
                    <div class="progress">
                        <?php
                        $kuota_cuti = $data['kuota_cuti'];
                        
                        // Menghitung persentase width sesuai dengan kondisi tertentu
                        // $width_percentage = ($kuota_cuti >= 12) ? 100 : (($kuota_cuti >= 6) ? 50 : ($kuota_cuti * 100 / 12));
                        $width_percentage = min(100, ($kuota_cuti / 12) * 100);
                        
                        // Output progress bar dengan width yang dihitung
                        echo '<div class="progress-bar progress-bar-striped" role="progressbar" style="width: ' . $width_percentage . '%" aria-valuenow="' . $kuota_cuti . '" aria-valuemin="0" aria-valuemax="12">' . $kuota_cuti . '</div>';
                        ?>
                    </div>
                </td> -->
              
               

                <td class=" last"><a href="?form=ubahManageCuti&id_manage_cuti=<?= $data["id_manage_cuti"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusManageCuti&id_manage_cuti=<?= $data["id_manage_cuti"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
                </td>
              </tr>
              <?php } ?>
           
            </tbody>
           
          </table>

          <script type="text/javascript">
          $(document).ready(function() {
              // Periksa apakah ada data dalam tabel
              if ($('#example tbody td').length > 0) {
                  new DataTable('#example', {
                      responsive: true,
                      columnDefs: [
                          {
                              targets: -1,
                              responsivePriority: 'auto'
                          }
                      ]
                  });
              } else {
                  // Jika tidak ada data, inisialisasi DataTable tanpa responsivitas
                  $('#example').DataTable();
              }
          });

          </script>

        </div>
				
			
      </div>
    </div>
