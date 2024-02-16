<?php

$id_user = $_SESSION["id_user"];


?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Master Bank<small></small></h2>
        <a href="?form=tambahBank" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Bank</a>
        <a href="?page=crew" class="btn btn-dark btn-sm "><i class="fa fa-users"></i> Crew Armada</a>
        <a href="?page=masterBank" class="btn btn-warning btn-sm btn disabled"><i class="fa fa-bank"></i> Master Bank</a>
        <a href="?page=kontrakCrew" class="btn btn-success btn-sm  "><i class="fa fa-file-text-o"></i> Kontrak Crew</a>
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
                <th class="column-title">Nama Bank </th>
              
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
              		$query = "SELECT * FROM bank";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['nama_bank'];?></td>

                <td class=" last"><a href="?form=ubahBank&id_bank=<?= $data["id_bank"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusBank&id_bank=<?= $data["id_bank"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
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
