<?php

$id_user = $_SESSION["id_user"];
$id_sales = $_GET['id_sales'];

$sales_plan = query("SELECT * FROM sales_plan WHERE id_sales=$id_sales")[0];

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Sales Plan<small></small></h2>
        <a href="?form=tambahSales" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
        <a href="?page=salesPlan" class="btn btn-dark btn-sm"><i class="fa fa-bar-chart"></i> Sales Plan</a>
        <a href="?page=masterVessel" class="btn btn-warning btn-sm text-dark"><i class="fa fa-ship"></i> Master Vessel</a>
        <a href="?page=masterCustomer" class="btn btn-success btn-sm"><i class="fa fa-user"></i> Master Customer</a>
        <a href="?page=masterDept" class="btn btn-info btn-sm"><i class="fa fa-building"></i> Master Dept</a>
        <a href="?page=masterKargo" class="btn btn-dark btn-sm"><i class="fa fa-truck"></i> Master Kargo</a>
       
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
                <th class="column-title">Kode Sales </th>
                <th class="column-title">Voyage Number </th>
                <th class="column-title">Vessel </th>
                <th class="column-title">Customer </th>
                <th class="column-title">Jenis Kargo </th>
                <th class="column-title">Qty </th>
                <th class="column-title">Satuan </th>
                <th class="column-title">Loading Port</th>
                <th class="column-title">Discharge Port</th>
                <th class="column-title">Sales Nominal</th>
                <th class="column-title">Start</th>
                <th class="column-title">Finished</th>
                <th class="column-title">Departement</th>
                <th class="column-title">Status</th>
                           
                <!-- <th class="column-title no-link last"><span class="nobr">Action</span> -->
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
              		$query = "SELECT * FROM sales_plan JOIN satuan ON satuan.id_satuan=sales_plan.id_satuan JOIN vessel ON vessel.id_vessel=sales_plan.id_vessel JOIN dept ON dept.id_dept=sales_plan.id_dept JOIN customer ON customer.id_cust=sales_plan.id_cust JOIN jenis_kargo ON jenis_kargo.id_kargo=sales_plan.id_kargo JOIN load_port ON load_port.id_load=sales_plan.id_load JOIN disch_port ON disch_port.id_disch=sales_plan.id_disch WHERE sales_plan.id_sales=$id_sales ORDER BY sales_plan.id_sales DESC";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     		$sales_nominal = $data['sales_nominal'];

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['kode_sales'];?></td>
                <td class=" "><?= $data['voy_num'];?></td>
                <td class=" "><?= $data['nama_vessel'];?></td>
                <td class=" "><?= $data['nama_customer'];?></td>
                <td class=" "><?= $data['nama_kargo'];?></td>
                <td class=" "><?= $data['qty_sales'];?></td>
                <td class=" "><?= $data['nama_satuan'];?></td>
                <td class=" "><?= $data['nama_load'];?></td>
                <td class=" "><?= $data['nama_disch'];?></td>
                <td class=" "><strong style='color: red'><?= "Rp. ".number_format("$sales_nominal", 2, ",", "."); ?> </strong></td>
                <td class=" "><?= date('d/m/Y', strtotime($data['start']));?></td>
                <td class=" ">
                    <?php
        				        if ($data['finished'] == NULL || $data['finished'] == '' || $data['finished'] == '0000-00-00') {
        				            echo '-';
        				        } else {
        				            echo date('d-M-Y', strtotime($data['finished']));
        				        }
        				    ?>
                </td>
                <td class=" "><?= $data['nama_dept'];?></td>
                <td class=" ">
                    <strong style="background-color: <?php
                    if ($data['status_plan'] == 'Reject') {
                        echo '#a62f26';
                    } elseif ($data['status_plan'] == 'Selesai') {
                      echo '#14a664';
                    } else {
                        echo '#b58709';
                    }
                ?>


                    ; color: white; padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 5px; font-weight: normal;"><?= $data['status_plan'];?></strong>
                </td>

            
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

        <div class="x_content">
            <div class="row no-gutters">
                
                <div class="col-md-4 mt-2 ml-3 mr-5">
                    <h5 class="card-title"><b>DATA APPROVAL</b></h5><hr>
                    <table>
                    <tbody style="font-size: 0.9rem;">
                    <tr>
                        <td width="45%"><strong>Direktur Operasional</strong></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td><?= $sales_plan['app1']?></td>
                    </tr>

                    <tr>
                        <td width="45%"><strong>Direktur Utama</strong></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td><?= $sales_plan['app2']?></td>
                    </tr>

                    <tr>
                        <td width="45%"><strong>Direktur Keuangan</strong></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td><?= $sales_plan['app3']?></td>
                    </tr>

                </tbody></table>
                <br>
                </div>
            </div>
        </div>

    </div>
