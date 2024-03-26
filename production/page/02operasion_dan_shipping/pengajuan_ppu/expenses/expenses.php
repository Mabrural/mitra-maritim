<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Expenses<small></small></h2>
        <a href="?form=tambahExpenses" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New Expenses</a>       
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
                <th class="column-title">Nomor Expenses </th>
                <th class="column-title">Tanggal Expenses </th>
                <th class="column-title">Nama Pemohon</th>
                <th class="column-title">Divisi</th>
                <th class="column-title">Keperluan</th>
                <th class="column-title">Nominal</th>
                <th class="column-title">Status</th>
                <th class="column-title">Lampiran</th>
     
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
              		$query = "SELECT * FROM expenses JOIN karyawan ON karyawan.id_emp=expenses.pemohon JOIN divisi ON divisi.id_divisi=karyawan.id_divisi WHERE expenses.id_user= $id_user";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
                    $nominal_expenses = $data['nominal_expenses'];
              	     		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['no_expenses'];?></td>
                <td class=" "><?= date('d/m/Y', strtotime($data['tgl_expenses']));?></td>
                <td class=" "><?= $data['nama_emp'];?></td>
                <td class=" "><?= $data['nama_divisi'];?></td>
                <td class=" "><?= $data['keperluan_exp'];?></td>
                <td class=" "><?= "Rp. " . number_format($nominal_expenses, 2, ",", "."); ?></td>
                <td class=" "><?= $data['status_expenses'];?></td>
                <td class=" "><a href="files/upload_expenses/<?= $data['upload_expenses']?>" class="btn btn-secondary btn-sm"> <i class="fa fa-eye"></i> View</a></td>

                
                <td class=" last"><a href="?form=ubahExpenses&id_expenses=<?= $data["id_expenses"]; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Ubah </a>
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
