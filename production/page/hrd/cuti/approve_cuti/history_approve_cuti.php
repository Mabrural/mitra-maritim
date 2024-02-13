<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>History Approval Cuti <small></small></h2>
        <!-- <a href="?form=tambahManageCuti" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Tambah Request Cuti</a> -->
        <!-- <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Settings 1</a>
                <a class="dropdown-item" href="#">Settings 2</a>
              </div>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul> -->
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
                
<!--                 <th class="column-title">Jenis Cuti</th>
                <th class="column-title">Kuota</th> -->
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
                 
                  $query = "SELECT * FROM req_cuti JOIN kategori_cuti ON kategori_cuti.id_kategori_cuti=req_cuti.id_kategori_cuti JOIN karyawan ON karyawan.id_emp=req_cuti.id_emp WHERE req_cuti.status_cuti='Sudah diapprove'";
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
                <td class=" "><?= $data['status_cuti'];?> </td>
              
                <td class=" last"><button class="btn btn-secondary btn-sm" disabled>SELESAI</button>
                </td>
                <!-- <td class=" last"><a href="?form=ubahRequestCuti&id_req_cuti=<?= $data["id_req_cuti"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusRequestCuti&id_req_cuti=<?= $data["id_req_cuti"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
                </td> -->
                <!-- <td class=" last"> | <a href="?form=detilKuota&id_emp=<?= $data['id_emp'];?>" class="btn btn-secondary btn-sm">Detil Kuota</a>  -->
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
