<?php

// $id_mhs = $_SESSION["id_mhs"];

// ambil data di URL
$id_user = $_SESSION["id_user"];
// query data karyawan berdasarkan id
$karyawan = query("SELECT * FROM user JOIN karyawan ON karyawan.id_emp=user.id_emp WHERE user.id_user = $id_user")[0];

// $tgl_pengajuan = $_GET['tgl_pengajuan'];



?>


    
      
					
<div class="clearfix"></div>
	
    
<div class="row">
	<div class="col-md-12 col-sm-12 ">
		<div class="x_panel">
				<div class="x_title">
					<h2>Rincian Data Karyawan<small></small></h2>
                  <!-- <form action="../../laporan/rekap_data.php" method="get">
        					<a href="laporan/rekap_data.php" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Cetak Data</a>
                  </form> -->
                  <form action="laporan/rekap_data.php" method="get">
                      <input type="hidden" name="aksi">
                      <input type="hidden" name="id_emp" value="<?= $karyawan['id_emp'];?>">
                      <!-- <input type="hidden" name="tgl_pengajuan" value="<?= $tgl_pengajuan;?>"> -->
                      <!-- <button type="submit" class="btn btn-info btn-sm" name="cetakData"><i class="fa fa-print"></i> Cetak Data</button> -->
                  </form>

									
							
					<div class="x_content">
						<div class="row no-gutters">
						  <div class="col-md-2 mt-5 ml-5 my-5 mr-5">
						  	
						    	<img src="img/<?= $karyawan['gambar'];?>" class="card-img rounded img-thumbnail" alt="monmaap, kosong.">
						  
						  </div>
						  <div class="col-md-7 mt-5 ml-5 mr-5">
						        <h5 class="card-title"><b><center>DATA DIRI KARYAWAN</center></b></h5><hr>
						        <table>
						        <tbody style="font-size: 0.9rem;">
						        	<tr>
						          <td width="45%">NIK</td>
						          <td>:&nbsp;&nbsp;</td>
						          <td><?= $karyawan['nik']?></td>
						        </tr>
						        <tr>
						          <td width="45%">NPWP</td>
						          <td>:&nbsp;&nbsp;</td>
						          <td><?= $karyawan['npwp']?></td>
						        </tr>
						        <tr>
						          <td width="45%">Nama Lengkap</td>
						          <td>:&nbsp;&nbsp;</td>
						          <td><?= $karyawan['nama_emp']?></td>
						        </tr>
						        <tr>
						          <td>No. Telp/HP</td>
						          <td>:&nbsp;&nbsp;</td>
						          <td><?= $karyawan['no_hp']?></td>
						        </tr>
						        <tr>
						          <td>Email</td>
						          <td>:&nbsp;&nbsp;</td>
						          <td><?= $karyawan['email']?></td>
						        </tr>
						        <tr>
						          <td>Alamat</td>
						          <td>:&nbsp;&nbsp;</td>
						          <td><?= $karyawan['alamat']?></td>
						        </tr>
						        <tr>
						          <td>Status Pernikahan</td>
						          <td>:&nbsp;&nbsp;</td>
						          <td><?= $karyawan['status_pernikahan']?></td>
						        </tr>
						        <tr>
						          <td>Jabatan</td>
						          <td>:&nbsp;&nbsp;</td>
						          <td><?= $karyawan['jabatan']?></td>
						        </tr>
						        <tr>
						          <td>Divisi</td>
						          <td>:&nbsp;&nbsp;</td>
						          <td><?= $karyawan['divisi']?></td>
						        </tr>
						        
						        <tr>
						          <td>Status Karyawan</td>
						          <td>:&nbsp;&nbsp;</td>
						          <td><?= $karyawan['status']?></td>
						        </tr>
						      
						    </tbody></table>
						    <br>
						    <a href="?form=updateProfile&id_emp=<?= $karyawan['id_emp']?>" class="btn btn-info btn-sm"> <i class="fa fa-edit"></i> Update Profile</a>
						  </div>
						</div>
					</div>
				</div>
		</div>
	</div>
		
</div>



<div class="row">
	<div class="col-md-12 col-sm-12 ">
		<div class="x_panel">
				<div class="x_title">
					<h2>Kuota Cuti Saya<small></small></h2>
                  <!-- <form action="../../laporan/rekap_data.php" method="get">
        					<a href="laporan/rekap_data.php" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Cetak Data</a>
                  </form> -->
                  <form action="laporan/rekap_data.php" method="get">
                      <input type="hidden" name="aksi">
                      <input type="hidden" name="id_emp" value="<?= $karyawan['id_emp'];?>">
                      <!-- <input type="hidden" name="tgl_pengajuan" value="<?= $tgl_pengajuan;?>"> -->
                      <!-- <button type="submit" class="btn btn-info btn-sm" name="cetakData"><i class="fa fa-print"></i> Cetak Data</button> -->
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
				                <th class="column-title">Nama Karyawan</th>
				                <th class="column-title">Jabatan</th>
				                <th class="column-title">Divisi</th>
				                <th class="column-title">Kategori Cuti</th>
				                <th class="column-title">Kuota</th>
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
				              		// $query = "SELECT * FROM akses_pintu JOIN karyawan ON karyawan.id_emp=akses_pintu.id_emp JOIN lantai ON lantai.id_lantai=akses_pintu.id_lantai ORDER BY akses_pintu.id_akses DESC";
				                  $query = "SELECT * FROM manage_cuti JOIN karyawan ON karyawan.id_emp=manage_cuti.id_emp JOIN kategori_cuti ON kategori_cuti.id_kategori_cuti=manage_cuti.id_kategori_cuti JOIN user ON user.id_emp=karyawan.id_emp WHERE user.id_user=$id_user";
				              		$tampil = mysqli_query($koneksi, $query);
				              		while ($data = mysqli_fetch_assoc($tampil)) {
				              	      		

				              	 ?>
				                <td class=" "><?= $no++;?></td>
				                <td class=" "><a href="?form=rincianKaryawan&id_emp=<?=$data["id_emp"]?>"><?= $data['nama_emp'];?></a></td>
				                <td class=" "><?= $data['jabatan'];?> </td>
				                <td class=" "><?= $data['divisi'];?> </td>
				                <td class=" "><?= $data['kategori_cuti'];?> </td>

				                <td class="">
				                    <div class="progress">
				                        <?php
				                        $kategori_cuti = $data['kategori_cuti'];
				                        $kuota_cuti = $data['kuota_cuti'];

				                        // Menghitung persentase width sesuai dengan kondisi tertentu
				                        if ($kategori_cuti == 'Annual Leave') {
				                            $width_percentage = ($kuota_cuti == 12) ? 100 : min(100, ($kuota_cuti / 12) * 100);
				                        } elseif ($kategori_cuti == 'Unpaid Leave') {
				                            $width_percentage = ($kuota_cuti == 3) ? 100 : min(100, ($kuota_cuti / 3) * 100);
				                        } elseif ($kategori_cuti == 'Sick Leave') {
				                            $width_percentage = ($kuota_cuti == 6) ? 100 : min(100, ($kuota_cuti / 6) * 100);
				                        } else {
				                            // Jika tidak memenuhi kondisi spesifik, gunakan perhitungan default
				                            $width_percentage = min(100, ($kuota_cuti / 12) * 100);
				                        }

				                        // Output progress bar dengan width yang dihitung
				                        echo '<div class="progress-bar progress-bar-striped" role="progressbar" style="width: ' . $width_percentage . '%" aria-valuenow="' . $kuota_cuti . '" aria-valuemin="0" aria-valuemax="12">' . $kuota_cuti . '</div>';
				                        ?>
				                    </div>
				                </td>
				                <!-- <td class="">
				                    <div class="progress">
				                        <?php
				                        $kuota_cuti = $data['kuota_cuti'];
				                        
				                        // Menghitung persentase width sesuai dengan kondisi tertentu
				                        // $width_percentage = ($kuota_cuti >= 12) ? 100 : (($kuota_cuti >= 6) ? 50 : ($kuota_cuti * 100 / 12));
				                        $width_percentage = min(100, ($kuota_cuti / 12) * 100);
				                        
				                        // Output progress bar dengan width yang dihitung
				                        echo '<div class="progress-bar progress-bar-striped" role="progressbar" style="width: ' . $width_percentage . '%" aria-valuenow="' . $kuota_cuti . '" aria-valuemin="0" aria-valuemax="12">' . $kuota_cuti . '</div>';
				                        ?>
				                    </div>
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
		
	</div>
		
</div>