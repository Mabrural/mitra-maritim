<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Sales Plan<small></small></h2>
        <a href="?form=tambahSales" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
        <a href="?page=salesPlan" class="btn btn-dark btn-sm btn disabled"><i class="fa fa-bar-chart"></i> Sales Plan</a>
        <a href="?page=masterVessel" class="btn btn-warning btn-sm"><i class="fa fa-ship"></i> Master Vessel</a>
        <a href="?page=masterCustomer" class="btn btn-success btn-sm"><i class="fa fa-user"></i> Master Customer</a>
        <a href="?page=masterDept" class="btn btn-info btn-sm"><i class="fa fa-building"></i> Master Dept</a>
       
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
                <!-- <th class="column-title">Stok Barang </th> -->
                           
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
              		$query = "SELECT * FROM sales_plan JOIN satuan ON satuan.id_satuan=sales_plan.id_satuan JOIN vessel ON vessel.id_vessel=sales_plan.id_vessel JOIN dept ON dept.id_dept=sales_plan.id_dept JOIN customer ON customer.id_cust=sales_plan.id_cust ORDER BY sales_plan.id_sales DESC";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['kode_sales'];?></td>
                <td class=" "><?= $data['nama_vessel'];?></td>
                <td class=" "><?= $data['nama_customer'];?></td>
                <td class=" "><?= $data['jenis_kargo'];?></td>
                <td class=" "><?= $data['qty_sales'];?></td>
                <td class=" "><?= $data['nama_satuan'];?></td>
                <td class=" "><?= $data['loading_port'];?></td>
                <td class=" "><?= $data['discharge_port'];?></td>
                <td class=" "><?= $data['sales_nominal'];?></td>
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
                
                <td class=" last"><a href="?form=ubahSales&id_sales=<?= $data["id_sales"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusSales&id_sales=<?= $data["id_sales"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
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
