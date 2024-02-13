<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Akses Pintu <small></small></h2>
        <a href="?form=tambahAkses" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Tambah Data Akses</a>
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
                <th class="column-title">No. Akses Pintu</th>
                <th class="column-title">Nama Lantai </th>
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
              		$query = "SELECT * FROM akses_pintu JOIN karyawan ON karyawan.id_emp=akses_pintu.id_emp JOIN lantai ON lantai.id_lantai=akses_pintu.id_lantai ORDER BY akses_pintu.id_akses DESC";
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	      		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><a href="?form=rincianKaryawan&id_emp=<?=$data["id_emp"]?>"><?= $data['nama_emp'];?></a></td>
                <td class=" "><?= $data['jabatan'];?> </td>
                <td class=" "><?= $data['divisi'];?> </td>
                <td class=" "><?= $data['no_akses'];?> </td>
                <td class=" "><?= $data['nama_lantai'];?></td>
               

                <td class=" last"><a href="?form=ubahAkses&id_akses=<?= $data["id_akses"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusAkses&id_akses=<?= $data["id_akses"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
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
