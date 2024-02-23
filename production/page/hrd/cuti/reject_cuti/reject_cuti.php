<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Approval Cuti <small></small></h2>
        <a href="?page=reqCuti" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Tambah Request Cuti</a>
        <a href="?page=approveCuti" class="btn btn-warning btn-sm "><i class="fa fa-clock-o"></i> Pending</a>
        <a href="?page=approvedCuti" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a>
        <a href="?page=rejectedCuti" class="btn btn-danger btn-sm btn disabled"><i class="fa fa-ban"></i> Rejected</a>
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
                <th class="column-title">Kategori Cuti</th>
                <th class="column-title">Tanggal Mulai</th>
                <th class="column-title">Tanggal Akhir</th>
                <th class="column-title">Jumlah Hari</th>
                <th class="column-title">Alasan</th>
                <th class="column-title">Created At</th>
                <th class="column-title">Approved At</th>
                <th class="column-title">Status Cuti</th>

                <th class="bulk-actions" colspan="7">
                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th>
              </tr>
            </thead>

            <tbody>
              <tr class="even pointer">
                <?php 
                  $no = 1;
                 
                  $query = "SELECT * FROM req_cuti JOIN kategori_cuti ON kategori_cuti.id_kategori_cuti=req_cuti.id_kategori_cuti JOIN karyawan ON karyawan.id_emp=req_cuti.id_emp WHERE req_cuti.status_cuti='Rejected'";
                  $tampil = mysqli_query($koneksi, $query);
                  while ($data = mysqli_fetch_assoc($tampil)) {
                          

                 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['nama_emp'];?> </td>
                <td class=" "><?= $data['kategori_cuti'];?> </td>
                <td class=" "><?= $data['tgl_mulai'];?> </td>
                <td class=" "><?= $data['tgl_akhir'];?> </td>
                <td class=" "><?= $data['jml_hari'];?> Hari</td>
                <td class=" "><?= $data['alasan'];?> </td>
                <td class=" "><?= $data['created_at'];?> </td>
                <td class=" "><?= $data['updated_at'];?> </td>
                <!-- <td class=" "><?= $data['status_cuti'];?> </td> -->
                <td class=" ">
                    <strong style="background-color: <?php
                    if ($data['status_cuti'] == 'Rejected') {
                        echo '#a62f26';
                    } elseif ($data['status_cuti'] == 'Approved') {
                      echo '#14a664';
                    } else {
                        echo '#b58709';
                    }
                ?>


                    ; color: white; padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 5px; font-weight: normal;"><?= $data['status_cuti'];?></strong>
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

        </div>
        
      
      </div>
    </div>
