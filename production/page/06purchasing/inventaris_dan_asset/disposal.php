<?php

$id_user = $_SESSION["id_user"];

$storage_barang = query("SELECT * FROM storage_barang WHERE storage_barang.id_user=$id_user");
$lokasi = query("SELECT * FROM lokasi_barang");
$room = query("SELECT * FROM lokasi_room");

$id_lokasi = isset($_GET['id_lokasi']) ? $_GET['id_lokasi'] : '';
$id_room = isset($_GET['id_room']) ? $_GET['id_room'] : '';

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Asset dan Inventaris <small></small></h2>

        
          <form action="laporan/cetak_inventaris.php" method="get">
              <input type="hidden" name="aksi">
              <input type="hidden" name="id_user" value="<?= $id_user;?>">
              <input type="hidden" name="id_lokasi" value="<?= $id_lokasi;?>">
              <input type="hidden" name="id_room" value="<?= $id_room;?>">
              <a href="?form=tambahInventaris" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Asset</a>
              <!-- <button type="submit" class="btn btn-info btn-sm" name="cetakData"><i class="fa fa-print"></i> Cetak Data</button> -->
              <a href="?page=inventarisAsset" class="btn btn-body btn-sm text-light bg-dark "><i class="fa fa-suitcase"></i> Asset</a>
              <a href="?page=masterLokasi" class="btn btn-warning btn-sm text-dark"><i class="fa fa-location-arrow"></i> Master Lokasi</a>
              <a href="?page=masterRoom" class="btn btn-success btn-sm"><i class="fa fa-hotel"></i> Master Ruangan</a>
              <a href="?page=disposal" class="btn btn-danger btn-sm btn disabled"><i class="fa fa-trash"></i> Disposal</a>
              
          </form>
         

        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <div class="table-responsive">
          <table id="example" class="display" style="width:100%">
            <thead style="background-color: #2a3f54; color: #dfe5f1;">
              <tr class="headings">
                <!-- <th>
                  <input type="checkbox" id="check-all" class="flat">
                </th> -->
                <th class="column-title">No. </th>
                <th class="column-title">Kode Barang </th>
                <th class="column-title">Nama Barang </th>
                <th class="column-title">Spesifikasi </th>
                <th class="column-title">Deskripsi </th>
                <th class="column-title">Qty </th>
                <th class="column-title">Tanggal Masuk </th>
                <th class="column-title">Kondisi Barang </th>
                <th class="column-title">Keterangan </th>
                <th class="column-title">Lokasi Barang </th>
                <th class="column-title">Lokasi Ruangan </th>               
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
              		$query = "SELECT * FROM storage_barang JOIN lokasi_room ON lokasi_room.id_room=storage_barang.id_room JOIN lokasi_barang ON lokasi_barang.id_lokasi=storage_barang.id_lokasi JOIN barang ON barang.kode_brg=storage_barang.kode_brg WHERE storage_barang.kondisi_brg='Disposal'";

                  // Add filter conditions based on the selected values
                //   if (!empty($id_lokasi)) {
                //       $query .= " WHERE storage_barang.id_lokasi = $id_lokasi";
                //   }

                //   if (!empty($id_room)) {
                //       $query .= (!empty($id_lokasi)) ? " AND " : " WHERE ";
                //       $query .= "storage_barang.id_room = $id_room";
                //   }
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
                		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['kode_brg'];?></td>
                <td class=" "><a href="img/barang/<?= $data['gambar_barang'];?>" style="text-decoration: underline; color:blue;"><?= $data['nama_barang'];?> </a></td>
                <td class=" "><?= $data['spek'];?></td>
                <td class=" "><?= $data['deskripsi'];?></td>
                <td class=" "><?= $data['qty_brg'];?></td>
                <!-- <td class=" "><?= date('d-M-Y', strtotime($data['date_in']));?></td> -->
                <td class=" ">
                	<?php
      				        if ($data['tgl_input'] == NULL || $data['tgl_input'] == '' || $data['tgl_input'] == '0000-00-00') {
      				            echo '-';
      				        } else {
      				            echo date('d-M-Y', strtotime($data['tgl_input']));
      				        }
      				    ?>
                </td>
                
                <td class=" "><?= $data['kondisi_brg'];?></td>
                <td class=" "><?= $data['ket_kondisi'];?></td>
                <td class=" "><?= $data['nama_lokasi'];?></td>
                <td class=" "><?= $data['room_name'];?></td>

 
                <td class=" last"><a href="?form=ubahInventaris&id_storage=<?= $data["id_storage"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusInventaris&id_storage=<?= $data["id_storage"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
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
