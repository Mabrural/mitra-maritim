<?php

$id_user = $_SESSION["id_user"];

$barang = query("SELECT * FROM barang");
$room = query("SELECT * FROM lokasi_room");
$lokasi = query("SELECT * FROM lokasi_barang");
$kode_pengajuan = generate_kode_pengajuan();
$satuan = query("SELECT * FROM satuan");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahPengajuan($_POST) > 0 ) {
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
			window.location.href = '?page=pengajuan'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=pengajuan'; //will redirect to your blog page (an ex: blog.html)
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
									<h2>Form Input Pengajuan Barang <small></small></h2>
						
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
							
									 <form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

										<div class="item form-group">
										    <label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_brg">Kode Barang <span class="required">*</span></label>
										    <div class="col-md-6 col-sm-6">
										        <!-- <input type="text" name="kode_pengajuan" id="kode_pengajuan" class="form-control" value="<?= $kode_pengajuan;?>"> -->
										        <select class="form-control" name="kode_brg" required>
															<option value="">--Pilih Barang--</option>
															<?php foreach($barang as $row) : ?>
																<option value="<?= $row['kode_brg']?>"><?= $row['kode_brg']?> - <?= $row['nama_barang']?> - <?= $row['spek']?></option>
															<?php endforeach;?>	
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
										    <label for="qty_req" class="col-form-label col-md-3 col-sm-3 label-align">Qty <span class="required">*</span></label>
										    <div class="col-md-6 col-sm-6">
										        <input id="qty_req" name="qty_req" class="form-control" type="number" placeholder="Ketikkan Qty" min="1" required>
										    </div>
										</div>

										<div class="item form-group">
											<label for="id_room" class="col-form-label col-md-3 col-sm-3 label-align">Satuan Barang <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_satuan" id="id_satuan" required>
													<option value="">--Pilih Satuan--</option>
													<?php foreach($satuan as $row) : ?>
														<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label for="alasan" class="col-form-label col-md-3 col-sm-3 label-align">Alasan</label>
											<div class="col-md-6 col-sm-6 ">
												<textarea id="alasan" class="form-control" rows="4" name="alasan" id="alasan" placeholder="Ketikkan Alasan" style="resize:none;"></textarea>
											</div>
										</div>
									

										<div class="item form-group">
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="tgl_req_brg" class="form-control" placeholder="dd-mm-yyyy" type="hidden" value="<?php echo date('Y-m-d'); ?>" readonly>
												<input id="middle-name" name="status_req" class="form-control" type="hidden" value="Menunggu Persetujuan Ka. Ops">
												<input id="middle-name" name="acc1" class="form-control" type="hidden" value="">
												<input id="middle-name" name="acc2" class="form-control" type="hidden" value="">
												<input id="middle-name" name="acc3" class="form-control" type="hidden" value="">
												
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
