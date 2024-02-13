<?php

// $id_mhs = $_SESSION["id_mhs"];

// ambil data di URL
$id_emp = $_GET["id_emp"];
// query data karyawan berdasarkan id
$karyawan = query("SELECT * FROM karyawan WHERE id_emp = $id_emp")[0];

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
						  </div>
						</div>
					</div>
				</div>
		</div>
	</div>
		
</div>