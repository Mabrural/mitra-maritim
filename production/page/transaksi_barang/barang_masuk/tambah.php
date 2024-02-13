<?php

// $id_mhs = $_SESSION["id_mhs"];

$lokasi = query("SELECT * FROM lokasi_barang");
$room = query("SELECT * FROM lokasi_room");
$vendor = query("SELECT * FROM vendor");
$kode_brg = generate_kode_barang();
$barang = query("SELECT * FROM barang");

$req_barang = query("SELECT * FROM req_barang");
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahInventaris($_POST) > 0 ) {
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
			window.location.href = '?page=dataInventaris'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=dataInventaris'; //will redirect to your blog page (an ex: blog.html)
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
							<h2>Form Input Barang Masuk <small></small></h2>
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
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">ID Transaksi <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" name="kode_brg" id="last-name" required="required" class="form-control" value="<?= $kode_brg;?>" readonly>
									</div>
								</div>

								<div class="item form-group">
									<label for="tanggal_masuk" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Masuk </label>
									<div class="col-md-6 col-sm-6 ">
										<input id="tanggal_masuk" name="date_in" class="form-control" type="date" value="<?= date('Y-m-d')?>">
									</div>
								</div>

								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Kode Pengajuan <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<select class="form-control" name="kode_pengajuan" id="kode_pengajuan" required>
											<option value="">--Pilih Kode Pengajuan--</option>
											<?php foreach($req_barang as $row) : ?>
												<option value="<?= $row['kode_pengajuan']?>"><?= $row['kode_pengajuan']?>	</option>
											<?php endforeach;?>	
										</select>

									</div>
								</div>

								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Kode Barang <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<select class="form-control" name="kode_brg" id="kode_brg" required>
											<option value="">--Pilih Kode Barang--</option>
											<?php foreach($barang as $row) : ?>
												<option value="<?= $row['kode_brg']?>"><?= $row['kode_brg']?> - <?= $row['nama_barang']?> - <?= $row['spek']?></option>
											<?php endforeach;?>	
										</select>

									</div>
								</div>
								
<!-- 								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nama Barang <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" name="nama_barang" id="last-name" required="required" class="form-control" readonly>
									</div>
								</div>
								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Spesifikasi</label>
									<div class="col-md-6 col-sm-6 ">
										<input id="middle-name" name="spek" class="form-control" type="text" readonly>
									</div>
								</div>
								<div class="item form-group">
									<label for="deskripsi" class="col-form-label col-md-3 col-sm-3 label-align">Deskripsi</label>
									<div class="col-md-6 col-sm-6 ">
										<textarea id="deskripsi" class="form-control" rows="4" name="deskripsi" id="deskripsi" style="resize:none;" readonly></textarea>
									</div>
								</div>
								<div class="item form-group">
									<label for="qty" class="col-form-label col-md-3 col-sm-3 label-align">Stok <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<input id="qty" name="qty" class="form-control" type="number" min="1" required readonly>
									</div>
								</div> -->

								<div class="item form-group">
									<label for="qty" class="col-form-label col-md-3 col-sm-3 label-align">Qty <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<input id="qty" name="qty" class="form-control" type="number" min="1" required >
									</div>
								</div>

								

								<div class="item form-group">
									<label for="renewal" class="col-form-label col-md-3 col-sm-3 label-align">Renewal </label>
									<div class="col-md-6 col-sm-6 ">
										<input id="renewal" name="renewal" class="form-control" type="date">
									</div>
								</div>

								<div class="item form-group">
									<label for="kondisi_brg" class="col-form-label col-md-3 col-sm-3 label-align">Kondisi <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<!-- <input id="kondisi_brg" name="kondisi_brg" class="form-control" type="text" placeholder="Ketikkan Kondisi Barang" required> -->
										<select class="form-control" name="kondisi_brg" required>
											<option value="NULL">--Pilih Kondisi--</option>
											<option value="Baik">Baik</option>
											<option value="Perlu Perbaikan">Perlu Perbaikan</option>
											<option value="Kurang Lengkap">Kurang Lengkap</option>
											<option value="Rusak">Rusak</option>
											<option value="Hilang">Hilang</option>
										</select>
									</div>
								</div>

								<div class="item form-group">
									<label for="id_lokasi" class="col-form-label col-md-3 col-sm-3 label-align">Lokasi Barang <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										
										<select class="form-control" name="id_lokasi" id="id_lokasi" required>
											<option value="">--Pilih Lokasi Barang--</option>
											<?php foreach($lokasi as $row) : ?>
												<option value="<?= $row['id_lokasi']?>"><?= $row['nama_lokasi']?></option>
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
												<option value="<?= $row['id_room']?>"><?= $row['room_name']?></option>
											<?php endforeach;?>	
										</select>
									</div>
								</div>

								<div class="item form-group">
									<label for="id_vendor" class="col-form-label col-md-3 col-sm-3 label-align">Vendor</label>
									<div class="col-md-6 col-sm-6 ">
										<select class="form-control" name="id_vendor" id="id_vendor" required>
											<option value="">--Pilih Vendor--</option>
											<?php foreach($vendor as $row) : ?>
												<option value="<?= $row['id_vendor']?>"><?= $row['nama_vendor']?></option>
											<?php endforeach;?>	
										</select>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Gambar Barang</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="file" name="gambar_brg">
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
