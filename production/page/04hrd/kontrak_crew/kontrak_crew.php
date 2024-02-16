<?php

$id_user = $_SESSION["id_user"];


?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Kontrak Crew Armada<small></small></h2>
        <a href="?form=tambahKontrakCrew" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New Contract</a>
        <a href="?page=crew" class="btn btn-dark btn-sm "><i class="fa fa-users"></i> Crew Armada</a>
        <a href="?page=masterBank" class="btn btn-warning btn-sm"><i class="fa fa-bank"></i> Master Bank</a>
        <a href="?page=kontrakCrew" class="btn btn-success btn-sm  btn disabled"><i class="fa fa-file-text-o"></i> Kontrak Crew</a>
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
                <th class="column-title">Gaji </th>
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
              		$query = "SELECT * FROM kontrak_crew JOIN crew ON crew.id_crew=kontrak_crew.id_crew JOIN vessel ON vessel.id_vessel=crew.id_vessel JOIN status_crew ON status_crew.idstatus_crew=kontrak_crew.idstatus_crew ORDER BY kontrak_crew.id_kontrakcrew DESC";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     	$gaji = $data['gaji_crew'];

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['nama_crew'];?></td>
                <td class=" "><?= $data['nama_vessel'];?></td>
                <td class=" "><?= date('d/m/Y', strtotime($data['sign_on']));?></td>
                <td class=" "><?= date('d/m/Y', strtotime($data['sign_off']));?></td>
                <td class=" "><strong style='color: red'><?= "Rp. ".number_format("$gaji", 2, ",", "."); ?> </strong></td>
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
            
                <td class=" last"><a href="?form=ubahKontrakCrew&id_kontrakcrew=<?= $data["id_kontrakcrew"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusKontrakCrew&id_kontrakcrew=<?= $data["id_kontrakcrew"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
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
