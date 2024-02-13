<?php

// $id_mhs = $_SESSION["id_mhs"];

// ambil data di URL
$id_kontrak = $_GET["id_kontrak"];
// query data kontrak berdasarkan id
$kontrak = query("SELECT * FROM kontrak_kerja WHERE id_kontrak = $id_kontrak")[0];
// $karyawan = query("SELECT * FROM karyawan");
$karyawan = query("SELECT * FROM karyawan WHERE jabatan != 'Direktur Utama' AND jabatan != 'Direktur HRD' AND jabatan != 'Direktur Keuangan' AND jabatan != 'Direktur Operasional' AND id_emp IN (SELECT id_emp FROM kontrak_kerja WHERE id_kontrak=$id_kontrak)");
$lantai = query("SELECT * FROM lantai");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	

	

	// cek apakah data berhasil diubah atau tidak
	if(ubahKontrak($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'Extend Kontrak Berhasil',
				//footer              :  '',
				icon                : 'success',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=kontrakKerja'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=kontrakKerja'; //will redirect to your blog page (an ex: blog.html)
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
									<h2>Konfirmasi Extend Kontrak<small></small></h2>
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
										<input type="hidden" name="id_kontrak" value="<?= $kontrak["id_kontrak"];?>">
										
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Nama Karyawan <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_emp" required>
													<!-- <option value="">--Pilih Karyawan--</option> -->
													<?php foreach($karyawan as $row) : ?>
														<option value="<?= $row['id_emp']?>" <?= ($row['id_emp'] == $kontrak['id_emp'])?'selected': ''; ?>><?= $row['nama_emp']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_mulai">Tanggal Mulai <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<?php
										            // Ambil nilai tgl_mulai dari $kontrak
										            $tgl_mulai = $kontrak['tgl_akhir'];

										            // Hitung tanggal mulai dengan menambahkan 1 hari
										            $tgl_mulai2 = date('Y-m-d', strtotime('+1 day', strtotime($tgl_mulai)));
										        ?>
												<input type="date" name="tgl_mulai" id="tgl_mulai" required="required" class="form-control" value="<?= $tgl_mulai2?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_akhir">Tanggal Akhir <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<?php
										        // Ambil nilai tgl_mulai dari $kontrak
        										// $tgl_mulai = $kontrak['tgl_akhir'];

										        // Hitung tanggal akhir dengan menambahkan 1 tahun
       											// $tgl_akhir = date('Y-m-d', strtotime('+1 year', strtotime($tgl_mulai)));
       											$value_tgl_akhir = $kontrak['status_kontrak'] === 'Kontrak 2' ? '0000-00-00' : date('Y-m-d', strtotime('+1 year', strtotime($tgl_mulai2)));

       											// Tambahkan kondisi untuk menentukan apakah input readonly atau tidak
            									$readonly_attr = $kontrak['status_kontrak'] === 'Kontrak 2' ? 'readonly' : '';
										        ?>
												<input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" value="<?= $value_tgl_akhir;?>" <?= $readonly_attr;?>>
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="gaji_pokok">Gaji Pokok <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control" min="0" value="<?= $kontrak['gaji_pokok']?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="tunjangan">Tunjangan
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" name="tunjangan" id="tunjangan" class="form-control" min="0" value="<?= $kontrak['tunjangan']?>">
												<!-- <input type="text" name="status_kontrak" value="<?= $kontrak['status_kontrak']?>"> -->
												<input type="hidden" name="status_kontrak" value="<?= $kontrak['status_kontrak'] === 'Kontrak 1' ? 'Kontrak 2' : ($kontrak['status_kontrak'] === 'Kontrak 2' ? 'Permanent' : $kontrak['status_kontrak']) ?>">

											</div>
										</div>

										<!-- <div class="item form-group">
										    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Upload Scan Ijazah (.pdf) <span class="required">*</span></label>
										    <div class="col-md-6 col-sm-6 ">
										        <input type="file" name="scan_ijazah">
										        <?php if (!empty($ijazah['scan_ijazah'])): ?>
										            <br>
										            <p class="file-selected">File sebelumnya: <?= $ijazah['scan_ijazah'] ?></p>
										            <input type="hidden" name="scan_ijazah_lama" value="<?= $ijazah['scan_ijazah'] ?>">
										        <?php endif; ?>
										    </div>
										</div> -->


										<!-- <div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Upload Scan Ijazah (.pdf) <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input type="file" name="scan_ijazah" required><br>
												<a href="" value="<?= $ijazah['scan_ijazah']?>"><?= $ijazah['scan_ijazah']?></a>
											</div>
										</div> -->
										

										
									
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<!-- <button class="btn btn-primary" type="button">Cancel</button> -->
												<button class="btn btn-primary" type="reset">Reset</button>
												<button type="submit" class="btn btn-success" name="submit">Extend</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

				




					
				</div>
    </div>
