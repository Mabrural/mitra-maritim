<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>RAB<small></small></h2>
        <a href="?form=tambahRab" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New RAB</a>       
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
              		$query = "SELECT * FROM rab ORDER BY id_rab DESC";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['doc_num'];?></td>
                <td class=" "><?= date('d/m/Y', strtotime($data['tgl_rab']));?></td>
                <td class=" "><a href="files/rab/<?= $data['file_rab']; ?>" style="color:blue; text-decoration: underline;"><i class="fa fa-download"></i> Unduh RAB</a></td>
                
                <td class="last">
                    <?php
                    if ($data['status_rab'] !== 'On Dirops') {
                        echo '<a href="?form=lihatRab&id_rab=' . $data["id_rab"] . '" class="btn btn-dark btn-sm btn disabled">' . $data['status_rab'] . '</a>';
                    } else {
                        echo '| <a href="?form=approveRab&id_rab=' . $data["id_rab"] . '" class="btn btn-success btn-sm" onclick="return confirm(\'Anda yakin ingin mengapprove data ini?\')">Approve</a>';
                        echo '| <a href="?form=reviseRab&id_rab=' . $data["id_rab"] . '" class="btn btn-info btn-sm" onclick="return confirm(\'Anda yakin ingin merevise data ini?\')">Revise </a>';
                        echo '| <a href="?form=rejectRab&id_rab=' . $data["id_rab"] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Anda yakin ingin mereject data ini?\')">Reject</a>';
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
