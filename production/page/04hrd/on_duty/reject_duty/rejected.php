<?php

$id_user = $_SESSION["id_user"];


?>
    <div class="x_panel">
      <div class="x_title">
        <h2>On Duty Karyawan<small></small></h2>
        <!-- <a href="?form=tambahOnduty" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New Form</a> -->
        <a href="?page=approveOnduty" class="btn btn-warning btn-sm"><i class="fa fa-clock-o"></i> Pending</a>
        <a href="?page=approved" class="btn btn-success btn-sm  "><i class="fa fa-check"></i> Approved</a>
        <a href="?page=rejected" class="btn btn-danger btn-sm btn disabled"><i class="fa fa-ban"></i> Rejected</a>
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
                <th class="column-title">Nama Karyawan </th>
                <th class="column-title">Tanggal On Duty</th>
                <th class="column-title">Waktu On Duty </th>
                <th class="column-title">Tujuan </th>
                <th class="column-title">Alasan</th>
                <th class="column-title">Status</th>

                <th class="bulk-actions" colspan="7">
                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th>
              </tr>
            </thead>

            <tbody>
              <tr class="even pointer">
              	<?php 
              		$no = 1;
              		$query = "SELECT * FROM on_duty JOIN karyawan ON karyawan.id_emp=on_duty.id_emp JOIN user ON user.id_emp=karyawan.id_emp WHERE on_duty.status_duty='Rejected' ORDER BY id_duty DESC";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['nama_emp'];?></td>
                <td class=" "><?= date('d/m/Y', strtotime($data['tgl_duty']));?></td>
                <td class=" "><?= $data['waktu_duty'];?></td>
                <td class=" "><?= $data['tujuan_duty'];?></td>
                <td class=" "><?= $data['alasan_duty'];?></td>
                <td class=" ">
                    <strong style="background-color: <?php
                    if ($data['status_duty'] == 'Rejected') {
                        echo '#a62f26';
                    } elseif ($data['status_duty'] == 'Approved') {
                      echo '#14a664';
                    } else {
                        echo '#b58709';
                    }
                ?>


                    ; color: white; padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 5px; font-weight: normal;"><?= $data['status_duty'];?></strong>
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
