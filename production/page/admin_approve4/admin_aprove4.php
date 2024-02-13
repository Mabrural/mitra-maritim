
<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Rekap Data Pengajuan Barang <small></small></h2>
        <!-- <a href="?form=tambahPengajuan" class="btn btn-primary">Form Pengajuan</a> -->
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
                <th class="column-title">Nama Pemohon </th>
                <th class="column-title">Jabatan </th>
                <th class="column-title">Divisi </th>
                <th class="column-title">Tanggal Pengajuan </th>
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
                  // $query = "SELECT * FROM barang JOIN user ON user.id_user=barang.id_user WHERE status='Sudah disetujui' GROUP BY barang.id_user";
              		// $query = "SELECT karyawan.nama_emp, karyawan.jabatan, karyawan.divisi, barang.tgl_pengajuan FROM karyawan JOIN user ON user.id_emp=karyawan.id_emp JOIN barang ON user.id_user=barang.id_user";
                  $query = "SELECT * FROM karyawan JOIN user ON user.id_emp=karyawan.id_emp JOIN barang ON user.id_user=barang.id_user WHERE barang.status='On Progress in Purchasing' GROUP BY karyawan.nama_emp, barang.tgl_pengajuan ORDER BY barang.tgl_pengajuan DESC";
              		// $query = "SELECT * FROM barang WHERE barang.id_user=$id_user";
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              		
              		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><strong><?= $data['nama_emp'];?></strong></td>
                <td class=" "><?= $data['jabatan'];?></td>
                <td class=" "><?= $data['divisi'];?></td>
                <td class=" "><?= date('d-M-Y', strtotime($data['tgl_pengajuan']));?></td>
                

                <td><a href="?form=rincian&id_user=<?= $data["id_user"]; ?>&tgl_pengajuan=<?= $data['tgl_pengajuan']?>" class="btn btn-info btn-sm">Rincian</a></td>

                <!-- <td class=" last"><a href="?form=ubahPengajuan&id_barang=<?= $data["id_barang"]; ?>" class="btn btn-info btn-sm">Approve </a> 
                </td> -->
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
