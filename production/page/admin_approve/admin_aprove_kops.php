
<?php

$id_user = $_SESSION["id_user"];


// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Approval Barang<small></small></h2>
        <!-- <a href="?form=tambahPengajuan" class="btn btn-primary">Form Pengajuan</a> -->
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
                <th class="column-title">Kode Pengajuan </th>
                <th class="column-title">Kode Barang </th>
                <th class="column-title">Nama Barang </th>
                <th class="column-title">Spesifikasi </th>
                <th class="column-title">Qty </th>
                <th class="column-title">Satuan </th>
                <th class="column-title">Lokasi Barang </th>
                <th class="column-title">Lokasi Ruangan </th>
                <th class="column-title">Tanggal Pengajuan </th>
                <th class="column-title">Alasan </th>
                <th class="column-title">Nama Pemohon </th>
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
                  // $query = "SELECT * FROM karyawan JOIN user ON user.id_emp=karyawan.id_emp JOIN barang ON user.id_user=barang.id_user WHERE status='Menunggu Persetujuan' OR status='Sedang diproses'";
                  $query2 = "SELECT * FROM req_barang JOIN user ON user.id_user=req_barang.id_user JOIN karyawan ON karyawan.id_emp=user.id_emp WHERE req_barang.status_req='Menunggu Persetujuan KC' AND karyawan.id_emp=user.id_emp";
              		$query3 = "SELECT * FROM req_barang JOIN user ON user.id_user=req_barang.id_user JOIN barang ON barang.kode_brg=req_barang.kode_brg WHERE status_req='Menunggu Persetujuan KC'";

                  $query = "SELECT * FROM req_barang
                            JOIN user ON user.id_user=req_barang.id_user
                            JOIN karyawan ON karyawan.id_emp=user.id_emp
                            JOIN barang ON barang.kode_brg=req_barang.kode_brg 
                            JOIN satuan ON satuan.id_satuan=req_barang.id_satuan 
                            JOIN lokasi_barang ON lokasi_barang.id_lokasi=req_barang.id_lokasi 
                            JOIN lokasi_room ON lokasi_room.id_room=req_barang.id_room WHERE req_barang.status_req='Menunggu Persetujuan Ka. Ops'";

                  $tampil2 = mysqli_query($koneksi, $query2);
                  $data2 = mysqli_fetch_assoc($tampil2);
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['kode_pengajuan'];?></td>
                <td class=" "><?= $data['kode_brg'];?></td>
                <td class=" "><?= $data['nama_barang'];?> </td>
                <td class=" "><?= $data['spek'];?></td>
                <td class=" "><?= $data['qty_req'];?></td>
                <td class=" "><?= $data['nama_satuan'];?></td>
                <td class=" "><?= $data['nama_lokasi'];?></td>
                <td class=" "><?= $data['room_name'];?></td>
                <td class=" "><?= date('d-M-Y', strtotime($data['tgl_req_brg']));?></td>
                <td class=" "><?= $data['alasan'];?></td>
                <td class=" "><strong><?= $data['nama_emp'];?></strong></td>
                <td class=" ">
                    <strong style="background-color: <?php
                    if ($data['status_req'] == 'Menunggu Persetujuan KC') {
                        echo '#b58709';
                    } elseif ($data['status_req'] == 'Menunggu Persetujuan Dir.Ops') {
                        echo '#b58709';
                    } elseif ($data['status_req'] == 'Menunggu Persetujuan Ka. Ops') {
                        echo '#b58709';
                    } elseif ($data['status_req'] == 'On Progress in Purchasing') {
                        echo '#b58709';
                    } elseif ($data['status_req'] == 'Menunggu Persetujuan Dir. HRD') {
                        echo '#b58709';
                    } elseif ($data['status_req'] == 'Menunggu Persetujuan Dir. Keuangan') {
                        echo '#b58709';
                    } elseif ($data['status_req'] == 'Menunggu Persetujuan Dir. Utama') {
                        echo '#b58709';
                    } elseif ($data['status_req'] == 'Ditolak') {
                        echo '#a62f26';
                    } else {
                        echo '#14a664';
                    }
                ?>


                    ; color: white; padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 5px; font-weight: normal;"><?= $data['status_req'];?></strong>
                </td>

                 <?php if ($data['status_req'] == 'Sudah disetujui' OR $data['status_req'] == 'Sedang diproses') { ?>
		          <td class=" last">
		            <span class="text-success fa fa-check"><strong> Selesai</strong></span>
		          </td>
		        <?php } else { ?>
		          <td class=" last"><a href="?form=ubahApprove&id_req_brg=<?= $data["id_req_brg"]; ?>" class="btn btn-info btn-sm">Approve </a> | <a href="?form=reject&id_req_brg=<?= $data["id_req_brg"]; ?>" class="btn btn-danger btn-sm">Reject </a> 
                <input type="hidden" name="nama_pemohon" value="<?= $_SESSION['username']; ?>">
		        </td>
		        <?php } ?>

             <!--    <td class=" last"><a href="?form=ubahPengajuan&id_barang=<?= $data["id_barang"]; ?>" class="btn btn-info btn-sm">Approve </a> 
                </td> -->
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
