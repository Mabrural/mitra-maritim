<?php

// $id_mhs = $_SESSION["id_mhs"];

$lokasi = query("SELECT * FROM lokasi_barang");
$room = query("SELECT * FROM lokasi_room");
$barang = query("SELECT * FROM barang");
$satuan = query("SELECT * FROM satuan");
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
							<h2>Form Input Storage Barang <small></small></h2>
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
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Kode Barang <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<select class="form-control" name="kode_brg">
											<option value="">--Pilih Barang--</option>
											<?php foreach($barang as $row) : ?>
												<option value="<?= $row['kode_brg']?>"><?= $row['kode_brg']?> - <?= $row['nama_barang']?> - <?= $row['spek']?></option>
											<?php endforeach;?>	
										</select>
									</div>
								</div>
								
								<div class="item form-group">
									<label for="qty_brg" class="col-form-label col-md-3 col-sm-3 label-align">Qty <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<input id="qty_brg" name="qty_brg" class="form-control" type="number" placeholder="Ketikkan Qty" min="1" required>
									</div>
								</div>

								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Satuan <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<select class="form-control" name="id_satuan">
											<option value="">--Pilih Satuan--</option>
											<?php foreach($satuan as $row) : ?>
												<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
											<?php endforeach;?>	
										</select>
									</div>
								</div>

								<div class="item form-group">
									<label for="tgl_input" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Masuk </label>
									<div class="col-md-6 col-sm-6 ">
										<input id="tgl_input" name="tgl_input" class="form-control" type="date">
									</div>
								</div>


								<div class="item form-group">
									<label for="kondisi_brg" class="col-form-label col-md-3 col-sm-3 label-align">Kondisi <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
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
									<label for="ket_kondisi" class="col-form-label col-md-3 col-sm-3 label-align">Keterangan</label>
									<div class="col-md-6 col-sm-6 ">
										<textarea id="ket_kondisi" class="form-control" rows="4" name="ket_kondisi" id="ket_kondisi" placeholder="Ketikkan Deskripsi" style="resize:none;"></textarea>
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
