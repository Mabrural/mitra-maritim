<?php

// $id_mhs = $_SESSION["id_mhs"];

// ambil data di URL
$id_emp = $_GET["id_emp"];
// query data mahasiswa berdasarkan id
$karyawan = query("SELECT * FROM karyawan WHERE id_emp = $id_emp")[0];
$jabatan = query("SELECT * FROM jabatan");
$divisi = query("SELECT * FROM divisi");


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	

	

	// cek apakah data berhasil diubah atau tidak
	if(ubahKaryawan($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'Data berhasil diubah',
				//footer              :  '',
				icon                : 'success',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=dataKaryawan'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>";
		// echo "
		// 	<script>
		// 		alert('Data berhasil diubah!');
		// 		document.location.href = '?page=pengajuan';
		// 	</script>
		// ";
	} else{
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Gagal',
				text                :  'Data gagal diubah',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=dataKaryawan'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>";
		// echo "
		// 	<script>
		// 		alert('Data gagal diubah!');
		// 		document.location.href = '?page=pengajuan';
		// 	</script>
		// ";
	}

}


?>


    <div class="x_panel">
      <div class="">
					
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Ubah Data Karyawan<small></small></h2>
									
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
										<input type="hidden" name="id_emp" value="<?= $karyawan["id_emp"];?>">
										<input type="hidden" name="gambarLama" value="<?= $karyawan["gambar"];?>">
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nama Lengkap <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="nama_emp" id="last-name" required="required" class="form-control" value="<?= $karyawan["nama_emp"];?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">NIK <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" min="0" name="nik" id="last-name" required="required" class="form-control" value="<?= $karyawan["nik"];?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">NPWP <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="npwp" id="last-name" required="required" class="form-control" value="<?= $karyawan["npwp"];?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="norek_mandiri">No. Rek Mandiri <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" min="0" name="norek_mandiri" id="norek_mandiri" required="required" class="form-control" value="<?= $karyawan["norek_mandiri"];?>">
											</div>
										</div>
										
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Jabatan <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_jabatan" id="id_jabatan" required>
													<option value="">--Pilih Jabatan--</option>
													<?php foreach($jabatan as $row) : ?>
														<option value="<?= $row['id_jabatan']?>" <?= ($row['id_jabatan'] == $karyawan['id_jabatan']) ? 'selected' : '';?>><?= $row['nama_jabatan']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Divisi</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_divisi" id="id_divisi" required>
													<option value="">--Pilih Divisi--</option>
													<?php foreach($divisi as $row) : ?>
														<option value="<?= $row['id_divisi']?>" <?= ($row['id_divisi'] == $karyawan['id_divisi']) ? 'selected' : '';?>><?= $row['nama_divisi']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>
										<div class="item form-group">
											<label for="tempat" class="col-form-label col-md-3 col-sm-3 label-align">Tempat Lahir <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="tempat" name="tempat" class="form-control" type="text" value="<?= $karyawan["tempat"];?>">
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Lahir <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="tgl_lahir" class="form-control" type="date" value="<?= $karyawan["tgl_lahir"];?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<div class="col-md-2 col-sm-6 ">
													Laki-laki :
													<input type="radio" class="flat" name="jenis_kelamin" id="genderM" value="Laki-laki" <?= ($karyawan['jenis_kelamin'] == 'Laki-laki') ? 'checked' : '';?> required /> 
												</div>
												<div class="col-md-2 col-sm-6 ">
													Perempuan :
													<input type="radio" class="flat" name="jenis_kelamin" id="genderF" value="Perempuan" <?= ($karyawan['jenis_kelamin'] == 'Perempuan') ? 'checked' : '';?> required />
												</div>
												
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Alamat <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<textarea class="form-control" rows="4" name="alamat" id="alamat" style="resize:none;" required><?= $karyawan["alamat"];?></textarea>
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">No. HP <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name"  min="0" name="no_hp" class="form-control" type="number" value="<?= $karyawan["no_hp"];?>">
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Email <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="email" class="form-control" type="email" value="<?= $karyawan["email"];?>">
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Status Pernikahan<span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="status_pernikahan">
													<option value="Belum Menikah" <?php if ($karyawan['status_pernikahan'] == 'Belum Menikah') { echo "selected"; } ?>>Belum Menikah</option>
													<option value="Sudah Menikah" <?php if ($karyawan['status_pernikahan'] == 'Sudah Menikah') { echo "selected"; } ?>>Sudah Menikah</option>
													<option value="Cerai Hidup" <?php if ($karyawan['status_pernikahan'] == 'Cerai Hidup') { echo "selected"; } ?>>Cerai Hidup</option>
													<option value="Cerai Mati" <?php if ($karyawan['status_pernikahan'] == 'Cerai Mati') { echo "selected"; } ?>>Cerai Mati</option>
													
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Status Karyawan<span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="status">
													<option value="Aktif" <?php if ($karyawan['status'] == 'Aktif') { echo "selected"; } ?>>Aktif</option>
													<option value="Tidak Aktif" <?php if ($karyawan['status'] == 'Tidak Aktif') { echo "selected"; } ?>>Tidak Aktif</option>
													
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Gambar <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<img src="img/<?= $karyawan['gambar'] ;?>" width="50">
												<input type="file" name="gambar">
											</div>
										</div>

										
									
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<!-- <button class="btn btn-primary" type="button">Cancel</button> -->
												<button class="btn btn-primary" type="reset">Reset</button>
												<button type="submit" class="btn btn-success" name="submit">Submit</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

				




					
				</div>
    </div>
