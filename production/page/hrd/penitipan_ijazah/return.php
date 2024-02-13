<?php

// $id_mhs = $_SESSION["id_mhs"];

// ambil data di URL
$id_ijazah = $_GET["id_ijazah"];
// query data mahasiswa berdasarkan id
$ijazah = query("SELECT * FROM ijazah WHERE id_ijazah = $id_ijazah")[0];
// $karyawan = query("SELECT * FROM karyawan");
$karyawan = query("SELECT * FROM karyawan WHERE jabatan != 'Direktur Utama' AND jabatan != 'Direktur HRD' AND jabatan != 'Direktur Keuangan' AND jabatan != 'Direktur Operasional' AND id_emp IN (SELECT id_emp FROM ijazah WHERE id_ijazah=$id_ijazah)");
$lantai = query("SELECT * FROM lantai");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	

	

	// cek apakah data berhasil diubah atau tidak
	if(ubahIjazah($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'Ijazah berhasil dikembalikan',
				//footer              :  '',
				icon                : 'success',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=penitipanIjazah'; //will redirect to your blog page (an ex: blog.html)
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
				text                :  'Ijazah gagal dikembalikan',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=penitipanIjazah'; //will redirect to your blog page (an ex: blog.html)
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
					<!-- <div class="page-title">
						<div class="title_left">
							<h3>Form Pengadaan Barang</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
								</div>
							</div>
						</div>
					</div> -->
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Konfirmasi Pengembalian Ijazah<small></small></h2>
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
										<input type="hidden" name="id_ijazah" value="<?= $ijazah["id_ijazah"];?>">
										
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Nama Karyawan <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 " readonly>
											

												<select class="form-control" name="id_emp" required readonly>
													<!-- <option value="">--Pilih Karyawan--</option> -->
													<?php foreach($karyawan as $row) : ?>
														<option value="<?= $row['id_emp']?>" <?= ($row['id_emp'] == $ijazah['id_emp'])?'selected': ''; ?>><?= $row['nama_emp']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">No. Ijazah <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="no_ijazah" id="last-name" required="required" class="form-control" value="<?= $ijazah['no_ijazah']?>" readonly>
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_penitipan">Tanggal Penitipan <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="date" name="tgl_penitipan" id="tgl_penitipan" class="form-control" value="<?= $ijazah['tgl_penitipan']?>" required readonly>
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_kembali">Tanggal Pengembalian
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" value="<?= date('Y-m-d');?>" readonly>
												<input type="hidden" name="status_ijazah" value="Sudah dikembalikan">
											</div>
										</div>

										<div class="item form-group">
										    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Scan Ijazah (.pdf) <span class="required">*</span></label>
										    <div class="col-md-6 col-sm-6 ">
										        <input type="file" name="scan_ijazah" hidden>
										        <?php if (!empty($ijazah['scan_ijazah'])): ?>
										            
										            <input type="text" class="form-control" name="" value="<?= $ijazah['scan_ijazah'] ?>" readonly>
										            <input type="hidden" name="scan_ijazah_lama" value="<?= $ijazah['scan_ijazah'] ?>">
										        <?php endif; ?>
										    </div>
										</div>
										

										
									
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<!-- <button class="btn btn-primary" type="button">Cancel</button> -->
												<button class="btn btn-primary" type="reset">Reset</button>
												<button type="submit" class="btn btn-success" name="submit">Return Ijazah</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

				




					
				</div>
    </div>
