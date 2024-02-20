<?php

$id_user = $_SESSION["id_user"];


?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Master Divisi<small></small></h2><br>
        <form action="laporan/cetak_inventaris.php" method="get">
              <input type="hidden" name="aksi">
              <input type="hidden" name="id_user" value="<?= $id_user;?>">
              <input type="hidden" name="id_lokasi" value="<?= $id_vessel;?>">
              <input type="hidden" name="id_room" value="<?= $id_posisi;?>">
              <!-- <button type="submit" class="btn btn-info btn-sm" name="cetakData"><i class="fa fa-print"></i> Cetak Data</button> -->
              
          </form>
          <a href="?form=tambahDivisi" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Tambah Divisi</a>
          <a href="?page=dataKaryawan" class="btn btn-dark btn-sm" ><i class="fa fa-users"></i> Karyawan Aktif</a>
          <a href="?page=dataKaryawanNonaktif" class="btn btn-danger btn-sm"><i class="fa fa-users"></i> Karyawan Non Aktif</a>
          <a href="?page=masterJabatan" class="btn btn-warning btn-sm"><i class="fa fa-user"></i> Master Jabatan</a>
          <a href="?page=masterDivisi" class="btn btn-success btn-sm btn disabled" autofocus="on"><i class="fa fa-building"></i> Master Divisi</a>
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
                <th class="column-title">Nama Divisi </th>
              
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
              		$query = "SELECT * FROM divisi";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['nama_divisi'];?></td>

                <td class=" last"><a href="?form=ubahDivisi&id_divisi=<?= $data["id_divisi"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusDivisi&id_divisi=<?= $data["id_divisi"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
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


          <!-- <script type="text/javascript">
            new DataTable('#example', {
            responsive: true,
            columnDefs: [
              {
                targets: -1,
                responsivePriority: 'auto'
              }
            ]
          });

          </script> -->
        </div>
				
			
      </div>
    </div>
