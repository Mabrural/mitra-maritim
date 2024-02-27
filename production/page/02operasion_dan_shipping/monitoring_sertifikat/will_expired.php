<?php

$id_user = $_SESSION["id_user"];


?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Sertifikat Will Expired<small></small></h2>
        <form action="laporan/cetak_inventaris.php" method="get">
            <input type="hidden" name="aksi">
            <input type="hidden" name="id_user" value="<?= $id_user;?>">
            <input type="hidden" name="id_lokasi" value="<?= $id_vessel;?>">
            <input type="hidden" name="id_room" value="<?= $id_posisi;?>">

        </form>
        
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
                <th class="column-title">Nama Sertifikat </th>
                <th class="column-title">Kapal </th>
                <th class="column-title">Tanggal Terbit </th>
                <th class="column-title">Tanggal Expired</th>
                <th class="column-title">Status </th>
                           
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
              		$query = "SELECT * FROM sertifikat_kapal JOIN vessel ON vessel.id_vessel=sertifikat_kapal.id_vessel WHERE sertifikat_kapal.status_cert='Akan Kedaluarsa'";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	    

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['nama_sertifikat'];?></td>
                <td class=" "><?= $data['nama_vessel'];?></td>
                <td class=" "><?= date('d/m/Y', strtotime($data['tgl_terbit']));?></td>
                <td class=" "><?= date('d/m/Y', strtotime($data['tgl_expired']));?></td>
                <td class=" ">
                    <strong style="background-color: <?php
                    if ($data['status_cert'] == 'Aktif') {
                        echo '#14a664';
                    } elseif ($data['status_cert'] == 'Akan Kedaluarsa') {
                      echo '#b58709';
                    } else {
                        echo '#a62f26';
                    }
                ?>


                    ; color: white; padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 5px; font-weight: normal;"><?= $data['status_cert'];?></strong>
                </td>
            
                <td class=" last"><a href="?form=ubahSertifikat&id_sertifikat=<?= $data["id_sertifikat"]; ?>" class="btn btn-info btn-sm">Update </a> | <a href="?form=hapusSertifikat&id_sertifikat=<?= $data["id_sertifikat"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
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
