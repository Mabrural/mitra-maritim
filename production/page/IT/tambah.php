<?php

// $id_mhs = $_SESSION["id_mhs"];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahKaryawan($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'Data berhasil ditambahkan',
				//footer              :  '',
				icon                : 'success',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=hrd'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>"; 
		// echo "
		// 	<script>
		// 		alert('Data berhasil ditambahkan');
		// 		document.location.href = '?page=anggaran';
		// 	</script>
		// ";
	} else{
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Gagal',
				text                :  'Data gagal ditambahkan',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=hrd'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>";
		// echo "
		// 	<script>
		// 		alert('Data gagal ditambahkan');
		// 		document.location.href = '?page=anggaran';
		// 	</script>
		// ";
	}

}


?>


    <div class="x_panel">
      <div class="">
					<!-- <div class="page-title">
						<div class="title_left">
							<h3>Form Tambah Karyawan</h3>
						</div> -->

						<!-- <div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
								</div>
							</div>
						</div> -->
					<!-- </div> -->
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Form Input Karyawan<small></small></h2>
									<!-- <ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul> -->
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">NIK <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" name="nik" id="last-name" required="required" class="form-control">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">NPWP <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="npwp" id="last-name" required="required" class="form-control">
											</div>
										</div>
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nama Lengkap <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="nama_emp" id="last-name" required="required" class="form-control">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Jabatan</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="jabatan" class="form-control" type="text">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Divisi</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="divisi" class="form-control" type="text">
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Lahir <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="tgl_lahir" class="form-control" type="date" required>
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="jenis_kelamin" required>
													<option value="">--Pilih Jenis Kelamin--</option>
													<option value="Laki-laki">Laki-laki</option>
													<option value="Perempuan">Perempuan</option>	
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Alamat <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="alamat" class="form-control" type="text" required>
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">No. HP <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="no_hp" class="form-control" type="number" required>
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Email <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="email" class="form-control" type="email" required>
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Status Pernikahan <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="status_pernikahan" required>
													<option value="">--Pilih Status Pernikahan--</option>
													<option value="Belum Menikah">Belum Menikah</option>
													<option value="Sudah Menikah">Sudah Menikah</option>	
													<option value="Cerai Hidup">Cerai Hidup</option>	
													<option value="Cerai Mati">Cerai Mati</option>	
												</select>
											</div>
										</div>

										
										
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Status Karyawan <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="status" required>
													<option value="">--Pilih Status Karyawan--</option>
													<option value="Aktif">Aktif</option>
													<option value="Tidak Aktif">Tidak Aktif</option>	
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Gambar <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input type="file" name="gambar">
											</div>
										</div>
										<div class="item form-group">
											<!-- <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Pengajuan</label> -->
											<!-- <div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="tgl_pengajuan" class="form-control" placeholder="dd-mm-yyyy" type="hidden" value="<?php echo date('Y-m-d'); ?>" readonly>
												<input id="middle-name" name="status" class="form-control" type="hidden" value="Menunggu Persetujuan">
												<input id="middle-name" name="acc1" class="form-control" type="hidden" value="">
												<input id="middle-name" name="acc2" class="form-control" type="hidden" value="">
												
											</div> -->
										</div>
										
										<!-- <div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Condition</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="kondisi" class="form-control" type="text">
												<input id="middle-name" name="status" class="form-control" type="hidden" value="Menunggu Persetujuan">
												<input id="middle-name" name="status2" class="form-control" type="hidden" value="Menunggu Persetujuan">
											</div>
										</div> -->
										<!-- <div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Status</label>
											<div class="col-md-6 col-sm-6">
												<select class="form-control" name="status">
													<option value="Menunggu Persetujuan" type="hidden">Menunggu Persetujuan</option>
													<option value="Sedang diproses">Sedang diproses</option>
													<option value="Sudah disetujui">Sudah disetujui</option>
													<option value="Ditolak">Ditolak</option>
												</select>
											</div>
										</div> -->
										<!-- <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
											<div class="col-md-6 col-sm-6 ">
												<div id="gender" class="btn-group" data-toggle="buttons">
													<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
														<input type="radio" name="gender" value="male" class="join-btn"> &nbsp; Male &nbsp;
													</label>
													<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
														<input type="radio" name="gender" value="female" class="join-btn"> Female
													</label>
												</div>
											</div>
										</div> -->
										<!-- <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Date Of Birth <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
												<script>
													function timeFunctionLong(input) {
														setTimeout(function() {
															input.type = 'text';
														}, 60000);
													}
												</script>
											</div>
										</div> -->
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
