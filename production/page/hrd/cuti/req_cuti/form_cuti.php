<?php

// $id_mhs = $_SESSION["id_mhs"];

$id_user = $_SESSION['id_user'];

$nama = $_SESSION["nama_emp"];

// $karyawan = query("SELECT * FROM karyawan");
$karyawan = query("SELECT * FROM user JOIN karyawan ON karyawan.id_emp=user.id_emp WHERE user.id_user=$id_user");
$kategori_cuti = query("SELECT * FROM kategori_cuti");
// $kategori_cuti = query("SELECT * FROM kategori_cuti");
// $kategori_cuti = query("SELECT * FROM kategori_cuti WHERE id_kategori_cuti NOT IN (SELECT id_kategori_cuti FROM manage_cuti)");
$manage_cuti = query("SELECT * FROM manage_cuti");
date_default_timezone_set('Asia/Jakarta');

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahRequestCuti($_POST) > 0 ) {
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
			window.location.href = '?page=historyCuti'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=historyCuti'; //will redirect to your blog page (an ex: blog.html)
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
					<!-- <div class="page-title"> -->
						<!-- <div class="title_left">
							<h3>Form Tambah Absen</h3>
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
									<h2>Form Input Request Cuti<small></small></h2>
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
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Nama Karyawan <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<!-- <input type="text" name="id_emp" value="<?= $nama?>" class="form-control" readonly> -->
												<select class="form-control" name="id_emp" required>
													<option value="">--Pilih Karyawan--</option>
													<?php foreach($karyawan as $row) : ?>
														<option value="<?= $row['id_emp']?>"><?= $row['nama_emp']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>

										
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Nama Kategori Cuti <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_kategori_cuti" required>
													<option value="">--Pilih Kategori Cuti--</option>
													<?php foreach($kategori_cuti as $row) : ?>
														<option value="<?= $row['id_kategori_cuti']?>"><?= $row['kategori_cuti']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>
										
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_mulai">Dari <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="date" name="tgl_mulai" id="tgl_mulai" required="required" class="form-control" min="0">
											</div>
										</div>
								
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_akhir">Sampai <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="date" name="tgl_akhir" id="tgl_akhir" required="required" class="form-control" min="0">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="jml_hari">Jumlah Hari <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" name="jml_hari" id="jml_hari" required="required" placeholder="Ketikkan Jumlah Hari" class="form-control" min="0">
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tipe Cuti <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="tipe_cuti" required>
													<option value="">--Pilih Tipe Cuti--</option>
													<option value="Half Day">Half Day</option>
													<option value="Full Day">Full Day</option>	
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="alasan">Alasan 
											</label>
											<div class="col-md-6 col-sm-6 ">
												<!-- <input type="text" name="alasan" id="alasan" required="required" class="form-control" min="0"> -->
												<textarea class="form-control" rows="4" name="alasan" id="alasan" placeholder="Ketikkan Alasan" style="resize:none;"></textarea>
												<input type="hidden" name="status_cuti" class="form-control" value="Belum diapprove">
												<input type="hidden" name="created_at" class="form-control" value="<?= date('Y-m-d H:i:s') ?>">
												<input type="hidden" name="updated_at" class="form-control" value="NULL">
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
