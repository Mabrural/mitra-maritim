<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");
$lokasi = query("SELECT * FROM lokasi_barang");
$room = query("SELECT * FROM lokasi_room");
$vendor = query("SELECT * FROM vendor");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Transaksi Barang Masuk <small></small></h2>
        <a href="?form=tambahBarangMasuk" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Transaksi</a>
        <a href="?form=cetakInventaris" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Cetak Data</a><br>
          <div class="row">
            <div class="col-md-2 col-sm-6">
              <select class="form-control" name="id_lokasi" id="id_lokasi" required>
                <option value="">--Pilih Lokasi Barang--</option>
                <?php foreach($lokasi as $row) : ?>
                  <option value="<?= $row['id_lokasi']?>"><?= $row['nama_lokasi']?></option>
                <?php endforeach;?> 
              </select><br>
            </div>

            <div class="col-md-2 col-sm-6">
              <select class="form-control" name="id_room" id="id_room" required>
                <option value="">--Pilih Lokasi Ruangan--</option>
                <?php foreach($room as $row) : ?>
                  <option value="<?= $row['id_room']?>"><?= $row['room_name']?></option>
                <?php endforeach;?> 
              </select>
            </div>

            <div class="col-md-2 col-sm-6">
              <select class="form-control" name="id_vendor" id="id_vendor">
                <option value="NULL">--Pilih Vendor--</option>
                <?php foreach($vendor as $row) : ?>
                  <option value="<?= $row['id_vendor']?>"><?= $row['nama_vendor']?></option>
                <?php endforeach;?> 
              </select>
            </div>
          </div>
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
                <th class="column-title">ID Transaksi </th>
                <th class="column-title">Kode Barang </th>
                <th class="column-title">Nama Barang </th>
                <th class="column-title">Spesifikasi </th>
                <th class="column-title">Tanggal Masuk </th>
                <th class="column-title">Qty</th>
                <th class="column-title">Satuan </th>
                <th class="column-title">Harga </th>
                <th class="column-title">Warranty </th>
                <th class="column-title">Renewal </th>
                <th class="column-title">Keterangan </th>
                <th class="column-title">Vendor </th>             
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
              		// $query = "SELECT * FROM storage_barang JOIN vendor ON vendor.id_vendor=storage_barang.id_vendor JOIN lokasi_room ON lokasi_room.id_room=storage_barang.id_room JOIN lokasi_barang ON lokasi_barang.id_lokasi=storage_barang.id_lokasi";
              		$query = "SELECT * FROM barang_masuk JOIN vendor ON vendor.id_vendor=barang_masuk.id_vendor JOIN req_barang ON req_barang.id_req_brg=barang_masuk.id_req_brg JOIN satuan ON satuan.id_satuan=barang_masuk.id_satuan JOIN barang ON barang.kode_brg=req_barang.kode_brg";
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
                   		$harga_brg = $data['harga_brg'];

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['id_transaksi'];?></td>
                <td class=" "><?= $data['kode_brg'];?></td>
                <td class=" "><a href="img/barang/<?= $data['gambar_barang'];?>" style="text-decoration: underline; color:blue;"><?= $data['nama_barang'];?> </a></td>
                <td class=" "><?= $data['spek'];?></td>
                <td class=" ">
                  <?php
                    if ($data['tgl_masuk'] == NULL || $data['tgl_masuk'] == '' || $data['tgl_masuk'] == '0000-00-00') {
                        echo '-';
                    } else {
                        echo date('d-M-Y', strtotime($data['tgl_masuk']));
                    }
                  ?>
                </td>
                <td class=" "><?= $data['qty_masuk'];?></td>
                <td class=" "><?= $data['nama_satuan'];?></td>
                <td class=" "><?= "Rp. ".number_format("$harga_brg", 2, ",", "."); ?></td>
                <td class=" "><?= $data['waranty'];?></td>
                <td class=" ">
                  <?php
                    if ($data['renewal'] == NULL || $data['renewal'] == '' || $data['renewal'] == '0000-00-00') {
                        echo '-';
                    } else {
                        echo date('d-M-Y', strtotime($data['renewal']));
                    }
                  ?>
                </td>
                <td class=" "><?= $data['keterangan'];?></td>
                <td class=" "><?= $data['nama_vendor'];?></td>
    
                <td class=" last"><a href="?form=ubahInventaris&id_transaksi=<?= $data["id_transaksi"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusInventaris&id_transaksi=<?= $data["id_transaksi"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
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
