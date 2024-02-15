<?php

// $id_mhs = $_SESSION["id_mhs"];

// ambil data di URL
$id_storage = $_GET["id_storage"];
// query data mahasiswa berdasarkan id
$storage_barang = query("SELECT * FROM storage_barang WHERE id_storage = $id_storage")[0];
$lokasi = query("SELECT * FROM lokasi_barang");
$room = query("SELECT * FROM lokasi_room");
$vendor = query("SELECT * FROM vendor");
$barang = query("SELECT * FROM barang");
$satuan = query("SELECT * FROM satuan");
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	

	

	// cek apakah data berhasil diubah atau tidak
	if(ubahInventaris($_POST) > 0 ) {
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
			window.location.href = '?page=dataInventaris'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=dataInventaris'; //will redirect to your blog page (an ex: blog.html)
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
									<h2>Ubah Data Asset dan Inventaris<small></small></h2>
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
										<input type="hidden" name="id_storage" value="<?= $storage_barang["id_storage"];?>">
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Kode Barang <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="kode_brg">
													<option value="">--Pilih Barang--</option>
													<?php foreach($barang as $row) : ?>
														<option value="<?= $row['kode_brg']?>" <?= ($row['kode_brg'] == $storage_barang['kode_brg']) ? 'selected' : '';?>><?= $row['kode_brg']?> - <?= $row['nama_barang']?> - <?= $row['spek']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>
										
										<div class="item form-group">
											<label for="qty_brg" class="col-form-label col-md-3 col-sm-3 label-align">Qty <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="qty_brg" name="qty_brg" class="form-control" type="number" value= "<?= $storage_barang['qty_brg']?>" min="1" required>
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Satuan <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_satuan">
													<option value="">--Pilih Satuan--</option>
													<?php foreach($satuan as $row) : ?>
														<option value="<?= $row['id_satuan']?>" <?= ($row['id_satuan'] == $storage_barang['id_satuan']) ? 'selected' : '';?>><?= $row['nama_satuan']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label for="tgl_input" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Masuk </label>
											<div class="col-md-6 col-sm-6 ">
												<input id="tgl_input" name="tgl_input" class="form-control" type="date" value="<?= $storage_barang['tgl_input']?>">
											</div>
										</div>


										<div class="item form-group">
											<label for="kondisi_brg" class="col-form-label col-md-3 col-sm-3 label-align">Kondisi <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="kondisi_brg" required>
													<option value="">--Pilih Kondisi--</option>
													<option value="Baik" <?= ($storage_barang['kondisi_brg'] == 'Baik') ? 'selected' : '';?>>Baik</option>
													<option value="Perlu Perbaikan" <?= ($storage_barang['kondisi_brg'] == 'Perlu Perbaikan') ? 'selected' : '';?>>Perlu Perbaikan</option>
													<option value="Kurang Lengkap" <?= ($storage_barang['kondisi_brg'] == 'Kurang Lengkap') ? 'selected' : '';?>>Kurang Lengkap</option>
													<option value="Rusak" <?= ($storage_barang['kondisi_brg'] == 'Rusak') ? 'selected' : '';?>>Rusak</option>
													<option value="Hilang" <?= ($storage_barang['kondisi_brg'] == 'Hilang') ? 'selected' : '';?>>Hilang</option>
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label for="ket_kondisi" class="col-form-label col-md-3 col-sm-3 label-align">Keterangan</label>
											<div class="col-md-6 col-sm-6 ">
												<textarea id="ket_kondisi" class="form-control" rows="4" name="ket_kondisi" id="ket_kondisi" style="resize:none;"><?= $storage_barang['ket_kondisi']?></textarea>
											</div>
										</div>


										<div class="item form-group">
											<label for="id_lokasi" class="col-form-label col-md-3 col-sm-3 label-align">Lokasi Barang <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												
												<select class="form-control" name="id_lokasi" id="id_lokasi" required>
													<option value="">--Pilih Lokasi Barang--</option>
													<?php foreach($lokasi as $row) : ?>
														<option value="<?= $row['id_lokasi']?>" <?= ($row['id_lokasi'] == $storage_barang['id_lokasi'])? 'selected' : '';?>><?= $row['nama_lokasi']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label for="id_room" class="col-form-label col-md-3 col-sm-3 label-align">Lokasi Ruangan <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_room" id="id_room" required>
													<option value="">--Pilih Lokasi Ruangan--</option>
													<?php foreach($room as $row) : ?>
														<option value="<?= $row['id_room']?>" <?= ($row['id_room'] == $storage_barang['id_room']) ? 'selected' : '';?>><?= $row['room_name']?></option>
													<?php endforeach;?>	
												</select>
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
