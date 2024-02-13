<?php

// $id_mhs = $_SESSION["id_mhs"];

// ambil data di URL
$id_req_brg = $_GET["id_req_brg"];
// query data mahasiswa berdasarkan id

$req_barang = query("SELECT * FROM req_barang WHERE id_req_brg = $id_req_brg")[0];
$karyawan = query("SELECT * FROM user JOIN karyawan ON karyawan.id_emp=user.id_emp JOIN req_barang ON req_barang.id_user=user.id_user WHERE req_barang.id_req_brg=$id_req_brg")[0];
$barang = query("SELECT * FROM barang");
$lokasi = query("SELECT * FROM lokasi_barang");
$room = query("SELECT * FROM lokasi_room");
$satuan = query("SELECT * FROM satuan");


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	

	

	// cek apakah data berhasil diubah atau tidak
	if(ubahApprove($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'Data berhasil direject',
				//footer              :  '',
				icon                : 'success',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=approve'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=pengajuan'; //will redirect to your blog page (an ex: blog.html)
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
							<h3>Konfirmasi Approval</h3>
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
									<h2>Konfirmasi Data <small></small></h2>
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
									<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
										<input type="hidden" name="id_req_brg" value="<?= $req_barang["id_req_brg"];?>">

										<div class="item form-group">

											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Pemohon <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="id_user" id="first-name" required="required" class="form-control" value="<?= $karyawan["nama_emp"];?>" disabled>
											</div>
										</div>

										<div class="item form-group">
											<!-- <input type="hidden" name="aksi" value="ubah"> -->

											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kode Pengajuan <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="kode_pengajuan" id="first-name" required="required" class="form-control" value="<?= $req_barang["kode_pengajuan"];?>" readonly>
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Kode Barang <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="hidden" name="kode_brg" value="<?= $req_barang['kode_brg']?>">
												<select class="form-control" name="kode_brg" required disabled>
													<option value="">--Pilih Barang--</option>
													<?php foreach($barang as $row) : ?>
														<option value="<?= $row['kode_brg']?>" <?= ($row['kode_brg'] == $req_barang['kode_brg'])?'selected': ''; ?>><?= $row['kode_brg']?> - <?= $row['nama_barang']?> - <?= $row['spek']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>

										
										<div class="item form-group">
											<label for="id_lokasi" class="col-form-label col-md-3 col-sm-3 label-align">Lokasi Barang <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input type="hidden" name="id_lokasi" value="<?= $req_barang['id_lokasi']?>">
												<select class="form-control" name="id_lokasi" id="id_lokasi" required disabled>
													<option value="">--Pilih Lokasi Barang--</option>
													<?php foreach($lokasi as $row) : ?>
														<option value="<?= $row['id_lokasi']?>" <?= ($row['id_lokasi'] == $req_barang['id_lokasi'])? 'selected' : '';?>><?= $row['nama_lokasi']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>
										
										<div class="item form-group">
											<label for="id_room" class="col-form-label col-md-3 col-sm-3 label-align">Lokasi Ruangan <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input type="hidden" name="id_room" value="<?= $req_barang['id_room']?>">
												<select class="form-control" name="id_room" id="id_room" required disabled>
													<option value="">--Pilih Lokasi Ruangan--</option>
													<?php foreach($room as $row) : ?>
														<option value="<?= $row['id_room']?>" <?= ($row['id_room'] == $req_barang['id_room'])?'selected' : '';?>><?= $row['room_name']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>

										<div class="item form-group">
										    <label for="qty_req" class="col-form-label col-md-3 col-sm-3 label-align">Qty <span class="required">*</span></label>
										    <div class="col-md-6 col-sm-6">
										        <input id="qty_req" name="qty_req" class="form-control" type="number" min="1" value="<?= $req_barang['qty_req']?>" required>
										    </div>
										</div>

										<div class="item form-group">
											<label for="id_room" class="col-form-label col-md-3 col-sm-3 label-align">Satuan Barang <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_satuan" id="id_satuan" required disabled>
													<option value="">--Pilih Satuan--</option>
													<?php foreach($satuan as $row) : ?>
														<option value="<?= $row['id_satuan']?>" <?= ($row['id_satuan'] == $req_barang['id_satuan'])?'selected': '';?>><?= $row['nama_satuan']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>


										<div class="item form-group">
											<label for="alasan" class="col-form-label col-md-3 col-sm-3 label-align">Alasan</label>
											<div class="col-md-6 col-sm-6 ">
												<textarea id="alasan" class="form-control" rows="4" name="alasan" id="alasan" style="resize:none;" readonly><?= $req_barang['alasan']?></textarea>
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Pengajuan</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="tgl_req_brg" class="form-control" type="date" value="<?= $req_barang["tgl_req_brg"];?>" readonly>
												<input id="middle-name" name="status_req" class="form-control" type="hidden" value="Ditolak">
												<input id="middle-name" name="acc1" class="form-control" type="hidden" value="">

											</div>
										</div>
									
									
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<!-- <button class="btn btn-primary" type="button">Cancel</button> -->
												<!-- <button class="btn btn-primary" type="reset">Reset</button> -->
												<button type="submit" class="btn btn-danger" name="submit">Reject</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

				




					
				</div>
    </div>
