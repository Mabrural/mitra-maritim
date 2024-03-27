<?php

// $id_mhs = $_SESSION["id_mhs"];

// $karyawan = query("SELECT * FROM karyawan");
$karyawan = query("SELECT * FROM karyawan WHERE id_emp NOT IN (SELECT id_emp FROM user)");

// $karyawan = query("SELECT * FROM karyawan WHERE jabatan != 'Direktur Utama' AND jabatan != 'Direktur HRD' AND jabatan != 'Direktur Keuangan' AND jabatan != 'Direktur Operasional' AND id_emp NOT IN (SELECT id_emp FROM user)");
$lantai = query("SELECT * FROM lantai");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahLogin($_POST) > 0 ) {
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
			window.location.href = '?page=userLogin'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=userLogin'; //will redirect to your blog page (an ex: blog.html)
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

					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Form Input Data Login<small></small></h2>

									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Nama Karyawan <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_emp" required>
													<option value="">--Pilih Karyawan--</option>
													<?php foreach($karyawan as $row) : ?>
														<option value="<?= $row['id_emp']?>"><?= $row['nama_emp']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Username <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="username" id="username" required="required" class="form-control">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="password" name="password" id="password" required="required" class="form-control">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="password2">Konfirmasi Password <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="password" name="password2" id="password2" required="required" class="form-control">
											</div>
										</div>
										

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Level <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="level" required>
													<option value="">--Pilih Level--</option>
													<option value="Crew Armada">Crew Armada</option>
													<option value="Staff Operasional">Staff Operasional</option>
													<option value="Kepala Operasional">Kepala Operasional</option>
													<option value="Kepala Cabang">Kepala Cabang</option>
													<option value="Purchasing">Purchasing</option>
													<option value="Staff IT">Staff IT</option>
													<option value="Staff Finance">Staff Finance</option>
													<option value="Staff Finance">Kepala Finance</option>
													<option value="Direktur Operasional">Direktur Operasional</option>
													<option value="Direktur HRD">Direktur HRD</option>
													<option value="Direktur Keuangan">Direktur Keuangan</option>
													<option value="Direktur Utama">Direktur Utama</option>
													
													
													
												</select>
											</div>
										</div>

										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="?page=userLogin" class= "btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
												<button class="btn btn-primary btn-sm" type="reset"><i class="fa fa-refresh"></i> Reset</button>
												<button type="submit" class="btn btn-success btn-sm" name="submit"><i class="fa fa-send-o"></i> Submit</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

				




					
				</div>
    </div>
