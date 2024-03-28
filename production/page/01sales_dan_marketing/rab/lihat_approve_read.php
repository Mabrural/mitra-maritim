<?php

$id_rab = mysqli_real_escape_string($koneksi, $_GET['id_rab']);

$id_user = $_SESSION["id_user"];

$rab = query("SELECT * FROM rab WHERE id_rab=$id_rab")[0];
?>
    <div class="x_panel">
      <div class="x_title">
        <h2>RAB<small></small></h2>
        <a href="?page=RAB" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
       
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
                <th class="column-title">Document Number </th>
                <th class="column-title">Tanggal RAB </th>
                <th class="column-title">File RAB</th>
                <th class="column-title">Status</th>

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
              		$query = "SELECT * FROM rab WHERE id_rab=$id_rab";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['doc_num'];?></td>
                <td class=" "><?= date('d/m/Y', strtotime($data['tgl_rab']));?></td>
                <td class=" "><a href="files/rab/<?= $data['file_rab']; ?>" style="color:blue; text-decoration: underline;"><i class="fa fa-download"></i> Unduh RAB</a></td>
                <td class=" ">
                    <strong style="background-color: <?php
                    if ($data['status_rab'] == 'Reject') {
                        echo '#a62f26';
                    } elseif ($data['status_rab'] == 'Selesai') {
                      echo '#14a664';
                    } else {
                        echo '#b58709';
                    }
                ?>
                 ; color: white; padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 5px; font-weight: normal;"><?= $data['status_rab'];?></strong>
                
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

    <div class="x_content">
            <div class="row no-gutters">
                
                <div class="col-md-4 mt-2 ml-3 mr-5">
                    <h5 class="card-title"><b>DATA APPROVAL</b></h5><hr>
                    <table>
                    <tbody style="font-size: 0.9rem;">
                    <tr>
                        <td width="45%"><strong>Direktur Operasional</strong></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td><?= $rab['rab_app1']?></td>
                    </tr>

                    <tr>
                        <td width="45%"><strong>Direktur Utama</strong></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td><?= $rab['rab_app2']?></td>
                    </tr>

                    <tr>
                        <td width="45%"><strong>Direktur Keuangan</strong></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td><?= $rab['rab_app3']?></td>
                    </tr>

                </tbody></table>
                <br>
                </div>
            </div>
        </div>
