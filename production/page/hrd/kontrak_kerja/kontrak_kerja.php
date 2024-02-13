<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Kontrak Kerja <small></small></h2>
        <a href="?form=tambahKontrak" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Tambah Kontrak</a>
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
                <th class="column-title">Nama </th>
                <th class="column-title">Tanggal Mulai </th>
                <th class="column-title">Tanggal Akhir </th>
                <th class="column-title">Gaji Pokok </th>
                <th class="column-title">Tunjangan </th>
                <th class="column-title">Total Gaji </th>
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
              		$query = "SELECT * FROM kontrak_kerja JOIN karyawan ON karyawan.id_emp=kontrak_kerja.id_emp ORDER BY kontrak_kerja.id_kontrak DESC";
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     	$gaji_pokok = $data['gaji_pokok'];
              	     	$tunjangan = $data['tunjangan'];
              	     	$total = $gaji_pokok + $tunjangan;

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><a href="?form=rincianKaryawan&id_emp=<?=$data["id_emp"]?>"><?= $data['nama_emp'];?></a></td>
                <td class=" "><?= date('d-M-Y', strtotime($data['tgl_mulai']));?> </td>
                <!-- <td class=" "><?= date('d-M-Y', strtotime($data['tgl_akhir']));?> </td> -->
                <td class=" ">
        				    <?php
        				        if ($data['tgl_akhir'] == NULL || $data['tgl_akhir'] == '' || $data['tgl_akhir'] == '0000-00-00') {
        				            echo '-';
        				        } else {
        				            echo date('d-M-Y', strtotime($data['tgl_akhir']));
        				        }
        				    ?>
        				</td>
                <td class=" "><?= "Rp. ".number_format("$gaji_pokok", 2, ",", "."); ?> </td>
                <td class=" "><?= "Rp. ".number_format("$tunjangan", 2, ",", "."); ?> </td>
                <td class=" "><strong style="color:red;"><?= "Rp. ".number_format("$total", 2, ",", "."); ?> </strong></td>
                <td class=" "><?= $data['status_kontrak'];?> </td>
                <td class="last">
				    <?php if ($data['status_kontrak'] !== 'Permanent') { ?>
				        <a href="?form=ubahKontrak&id_kontrak=<?= $data["id_kontrak"]; ?>" class="btn btn-info btn-sm">Ubah</a> | 
				        <a href="?form=hapusKontrak&id_kontrak=<?= $data["id_kontrak"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</a> | 
				        <a href="?form=extendKontrak&id_kontrak=<?= $data["id_kontrak"]; ?>" class="btn btn-success btn-sm">Extend</a>
				    <?php } else { ?>
				        <!-- Jika status_kontrak = "Permanent", maka disable tombol Extend -->
				        <a href="?form=ubahKontrak&id_kontrak=<?= $data["id_kontrak"]; ?>" class="btn btn-info btn-sm">Ubah</a> | 
				        <a href="?form=hapusKontrak&id_kontrak=<?= $data["id_kontrak"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</a> |
				        <button class="btn btn-secondary btn-sm" disabled>Extend</button>
				    <?php } ?>
				</td>

                <!-- <td class=" last"><a href="?form=ubahKontrak&id_kontrak=<?= $data["id_kontrak"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusKontrak&id_kontrak=<?= $data["id_kontrak"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a> | <a href="?form=extendKontrak&id_kontrak=<?= $data["id_kontrak"]; ?>" class="btn btn-success btn-sm">Extend </a>
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
        </div>
				
			
      </div>
    </div>
