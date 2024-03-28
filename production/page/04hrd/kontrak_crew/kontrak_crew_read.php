<?php

$id_user = $_SESSION["id_user"];


?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Contract Crew Armada<small></small></h2>
        <form action="laporan/cetak_inventaris.php" method="get">
            <input type="hidden" name="aksi">
            <input type="hidden" name="id_user" value="<?= $id_user;?>">
            <input type="hidden" name="id_lokasi" value="<?= $id_vessel;?>">
            <input type="hidden" name="id_room" value="<?= $id_posisi;?>">
            <!-- <button type="submit" class="btn btn-info btn-sm" name="cetakData"><i class="fa fa-print"></i> Cetak Data</button> -->

        </form>
        <a href="?page=crew" class="btn btn-dark btn-sm "><i class="fa fa-users"></i> Crew Armada</a>
        <a href="?page=kontrakCrew" class="btn btn-success btn-sm  btn disabled"><i class="fa fa-file-text-o"></i> Contract Crew</a>
        <a href="?page=crewEndContract" class="btn btn-danger btn-sm"><i class="fa fa-users"></i> Crew End Contract</a>
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
                <th class="column-title">Kapal </th>
                <th class="column-title">Sign ON </th>
                <th class="column-title">Sign OFF</th>
                <th class="column-title">Sertifikat Crew</th>
                <th class="column-title">Gaji </th>
                <th class="column-title">Uang Makan </th>
                <th class="column-title">Status </th>

                <th class="bulk-actions" colspan="7">
                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th>
              </tr>
            </thead>

            <tbody>
              <tr class="even pointer">
              	<?php 
              		$no = 1;
              		$query = "SELECT * FROM kontrak_crew JOIN crew ON crew.id_crew=kontrak_crew.id_crew JOIN vessel ON vessel.id_vessel=crew.id_vessel JOIN status_crew ON status_crew.idstatus_crew=kontrak_crew.idstatus_crew WHERE kontrak_crew.idstatus_crew=1 ORDER BY kontrak_crew.id_kontrakcrew DESC";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     	$gaji = $data['gaji_crew'];
              	     	$uang_makan_crew = $data['uang_makan_crew'];

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['nama_crew'];?></td>
                <td class=" "><?= $data['nama_vessel'];?></td>
                <td class=" "><?= date('d/m/Y', strtotime($data['sign_on']));?></td>
                <td class=" "><?= date('d/m/Y', strtotime($data['sign_off']));?></td>
                <td class=" "><a href="files/sertifikat_crew/<?= $data['sertifikat_crew'];?>" style="text-decoration: underline; color: blue;">Lihat Sertifikat</a></td>
                <td class=" "><strong style='color: red'><?= "Rp. ".number_format("$gaji", 2, ",", "."); ?> </strong></td>
                <td class=" "><strong style='color: red'><?= "Rp. ".number_format("$uang_makan_crew", 2, ",", "."); ?> </strong></td>
                <td class=" ">
                    <strong style="background-color: <?php
                    if ($data['nama_status'] == 'On Contract') {
                        echo '#14a664';
                    } else {
                        echo '#a62f26';
                    }
                ?>


                    ; color: white; padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 5px; font-weight: normal;"><?= $data['nama_status'];?></strong>
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
