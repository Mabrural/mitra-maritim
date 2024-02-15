<?php

$id_user = $_SESSION["id_user"];


?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Crew Armada<small></small></h2>
        <a href="?form=tambahCrew" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Crew</a>
        <a href="?page=crew" class="btn btn-dark btn-sm btn disabled"><i class="fa fa-users"></i> Crew Armada</a>
        <a href="?page=masterVessel" class="btn btn-warning btn-sm"><i class="fa fa-bank"></i> Master Bank</a>
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
                <th class="column-title">Nama Crew </th>
                <th class="column-title">NIK </th>
                <th class="column-title">NPWP </th>
                <th class="column-title">Tempat, Tanggal Lahir </th>
                <th class="column-title">Jenis Kelamin </th>
                <th class="column-title">Posisi</th>
                <th class="column-title">Bank - No. Rekening</th>
                <th class="column-title">Kapal</th>
                           
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
              		$query = "SELECT * FROM crew JOIN bank ON bank.id_bank=crew.id_bank JOIN vessel ON vessel.id_vessel=crew.id_vessel JOIN posisi_crew ON posisi_crew.id_posisi=crew.id_posisi ORDER BY id_crew DESC";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['nama_crew'];?></td>
                <td class=" "><?= $data['nik'];?></td>
                <td class=" "><?= $data['npwp'];?></td>
                <td class=" "><?= $data['tmp_lahir'];?>, <?= date('d/m/Y', strtotime($data['tgl_lahircrew']));?></td>
                <td class=" "><?= $data['jk_crew'];?></td>
                <td class=" "><?= $data['nama_posisi'];?></td>
                <td class=" "><?= $data['nama_bank'];?> - <?= $data['no_rek'];?></td>
                <td class=" "><?= $data['nama_vessel'];?></td>
            
                <td class=" last"><a href="?form=ubahCrew&id_crew=<?= $data["id_crew"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusCrew&id_crew=<?= $data["id_crew"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
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
