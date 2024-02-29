<?php

$id_crew = mysqli_real_escape_string($koneksi, $_GET['id_crew']);
$id_user = $_SESSION["id_user"];

$crew = query("SELECT * FROM crew WHERE id_crew=$id_crew")[0];

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Crew Armada<small></small></h2>

          <form action="laporan/cetak_inventaris.php" method="get">
              <input type="hidden" name="aksi">
              <input type="hidden" name="id_user" value="<?= $id_user;?>">
              <input type="hidden" name="id_lokasi" value="<?= $id_vessel;?>">
              <input type="hidden" name="id_room" value="<?= $id_posisi;?>">
              <!-- <button type="submit" class="btn btn-info btn-sm" name="cetakData"><i class="fa fa-print"></i> Cetak Data</button> -->
              
          </form>
        <a href="?page=crew" class="btn btn-dark btn-sm "><i class="fa fa-users"></i> Crew Armada</a>
        <a href="?page=kontrakCrew" class="btn btn-success btn-sm  "><i class="fa fa-file-text-o"></i> Kontrak Crew</a>
        <a href="?page=kontrakCrew" class="btn btn-danger btn-sm  "><i class="fa fa-users"></i> Crew End Contract</a>
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
               
                <th class="column-title">Scan KTP</th>
                <th class="column-title">Scan KK</th>
                <th class="column-title">Scan NPWP</th>
                
                <th class="bulk-actions" colspan="7">
                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th>
              </tr>
            </thead>

            <tbody>
              <tr class="even pointer">
              	<?php 
              		$no = 1;
              		$query = "SELECT * FROM crew JOIN bank ON bank.id_bank=crew.id_bank JOIN vessel ON vessel.id_vessel=crew.id_vessel JOIN posisi_crew ON posisi_crew.id_posisi=crew.id_posisi";
  
                    $query .= " WHERE id_crew=$id_crew ORDER BY crew.id_crew DESC";


              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['nama_crew'];?></td>
                <td class=" ">
                    <?php
                    if (!empty($data['scan_ktp'])) {
                        echo '<a href="files/ktp/' . $data['scan_ktp'] . '" style="text-decoration:underline; color: blue;">Lihat KTP</a>';
                    } else {
                        echo 'Tidak ada data';
                    }
                    ?>
                </td>
                <td class=" ">
                    <?php
                    if (!empty($data['scan_kk'])) {
                        echo '<a href="files/kk/' . $data['scan_kk'] . '" style="text-decoration:underline; color: blue;">Lihat KK</a>';
                    } else {
                        echo 'Tidak ada data';
                    }
                    ?>
                </td>
                <td class=" ">
                    <?php
                    if (!empty($data['scan_npwp'])) {
                        echo '<a href="files/npwp/' . $data['scan_npwp'] . '" style="text-decoration:underline; color: blue;">Lihat NPWP</a>';
                    } else {
                        echo 'Tidak ada data';
                    }
                    ?>
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
