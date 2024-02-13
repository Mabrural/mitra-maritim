<?php

$id_user = $_SESSION["id_user"];

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Satuan <small></small></h2>
		<a href="?form=tambahSatuan" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Satuan</a>

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
                <th class="column-title">Nama Satuan </th>
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
              		$query = "SELECT * FROM satuan";

              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
                		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['nama_satuan'];?></td>
                <td class=" last"><a href="?form=ubahSatuan&id_satuan=<?= $data["id_satuan"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusSatuan&id_satuan=<?= $data["id_satuan"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
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
