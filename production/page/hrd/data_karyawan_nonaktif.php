<?php

$id_user = $_SESSION["id_user"];


?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Karyawan <small></small></h2>
        <form action="laporan/cetak_inventaris.php" method="get">
              <input type="hidden" name="aksi">
              <input type="hidden" name="id_user" value="<?= $id_user;?>">
              <input type="hidden" name="id_lokasi" value="<?= $id_vessel;?>">
              <input type="hidden" name="id_room" value="<?= $id_posisi;?>">
              <!-- <button type="submit" class="btn btn-info btn-sm" name="cetakData"><i class="fa fa-print"></i> Cetak Data</button> -->
              
          </form>
          <a href="?form=tambahKaryawan" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Tambah Karyawan</a>
          <a href="?page=dataKaryawan" class="btn btn-dark btn-sm "><i class="fa fa-users"></i> Karyawan Aktif</a>
          <a href="?page=masterBank" class="btn btn-danger btn-sm btn disabled" autofocus="on"><i class="fa fa-users"></i> Karyawan Non Aktif</a>
          <a href="?page=masterJabatan" class="btn btn-warning btn-sm"><i class="fa fa-user"></i> Master Jabatan</a>
          <a href="?page=masterDivisi" class="btn btn-success btn-sm"><i class="fa fa-building"></i> Master Divisi</a>
        
  
        <div class="clearfix"></div>
      </div>

      <div class="x_content">


        <div class="table-responsive">
          <table id="example" class="display" style="width:100%">
            <thead style="background-color: #2a3f54; color: #dfe5f1;">
              <tr class="headings">
              
                <th class="column-title">No. </th>
                <th class="column-title">Gambar </th>
                <th class="column-title">Nama </th>
                <th class="column-title">NIK </th>
                <th class="column-title">NPWP </th>
                <th class="column-title">Tempat, Tanggal Lahir </th>
                <th class="column-title">Jenis Kelamin </th>
                <th class="column-title">Jabatan </th>
                <!-- <th class="column-title">Bank - No. Rekening </th> -->
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
              		$query = "SELECT * FROM karyawan JOIN divisi ON divisi.id_divisi=karyawan.id_divisi JOIN jabatan ON jabatan.id_jabatan=karyawan.id_jabatan  WHERE karyawan.status='Tidak Aktif'";
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	      		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><a href="img/<?= $data['gambar'];?>"><img src="img/<?= $data['gambar'];?>" width="50"></a></td>
                <td class=" "><a href="?form=rincianKaryawan&id_emp=<?=$data["id_emp"]?>"><?= $data['nama_emp'];?></a></td>
                <td class=" "><?= $data['nik'];?> </td>
                <td class=" "><?= $data['npwp'];?> </td>
                <td class=" "><?= $data['tempat'];?>,  <?= date('d/m/Y', strtotime($data['tgl_lahir']));?></td>
                <td class=" "><?= $data['jenis_kelamin'];?> </td>
                <td class=" "><?= $data['nama_jabatan'];?> </td>
                <!-- <td class=" "><?= $data['nama_bank'];?> - <?= $data['nama_bank'];?></td> -->
                <td class=" "><?= $data['status'];?></td>

                <td class=" last"><a href="?form=ubahKaryawan&id_emp=<?= $data["id_emp"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusKaryawan&id_emp=<?= $data["id_emp"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
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
