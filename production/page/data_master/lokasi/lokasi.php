<?php

$id_user = $_SESSION["id_user"];

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Lokasi <small></small></h2>
		    <a href="?form=tambahLokasi" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Lokasi</a>
        <a href="?page=inventarisAsset" class="btn btn-body btn-sm text-light bg-dark"><i class="fa fa-suitcase"></i> Asset</a>
        <a href="?page=masterLokasi" class="btn btn-warning btn-sm btn disabled text-dark"><i class="fa fa-location-arrow"></i> Master Lokasi</a>
        <a href="?page=masterRoom" class="btn btn-success btn-sm"><i class="fa fa-hotel"></i> Master Ruangan</a>
        <a href="?page=disposal" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Disposal</a>

        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <div class="table-responsive">
          <table id="example" class="display" style="width:100%">
            <thead style="background-color: #2a3f54; color: #dfe5f1;">
              <tr class="headings">
                <!-- <th>
                  <input type="checkbox" id="check-all" class="flat">
                </th> -->
                <th class="column-title">No. </th>
                <th class="column-title">Nama Lokasi </th>
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
              		$query = "SELECT * FROM lokasi_barang";

              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
                		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['nama_lokasi'];?></td>
                <td class=" last"><a href="?form=ubahLokasi&id_lokasi=<?= $data["id_lokasi"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusLokasi&id_lokasi=<?= $data["id_lokasi"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
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
