<?php

$id_no_po = $_GET['id_no_po'];

$satuan = query("SELECT * FROM satuan");
$vendor = query("SELECT * FROM vendor");
$req_barang = query("SELECT * FROM req_barang JOIN barang ON barang.kode_brg=req_barang.kode_brg WHERE req_barang.status_req='On Progress in Purchasing' GROUP BY barang.kode_brg");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(ajukanPO($_POST) > 0 ) {
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
			window.location.href = '?page=pengajuanPO&id_no_po=$id_no_po'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=pengajuanPO&id_no_po=$id_no_po'; //will redirect to your blog page (an ex: blog.html)
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
							<h2>Input Data Purchase Order <small></small></h2>
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
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_po">Tanggal Pengajuan <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="date" name="tgl_po" id="tgl_po" required="required" class="form-control">
									</div>
								</div>

								<div class="item form-group">
									<label for="id_room" class="col-form-label col-md-3 col-sm-3 label-align">Nama Barang <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<select class="form-control" name="id_req_brg" id="id_req_brg" required>
											<option value="">--Pilih Barang--</option>
											<?php foreach($req_barang as $row) : ?>
												<option value="<?= $row['id_req_brg']?>"><?= $row['kode_brg']?> - <?= $row['nama_barang']?> - <?= $row['spek']?></option>
											<?php endforeach;?>	
										</select>
									</div>
								</div>

								<div class="item form-group">
									<label for="qty_po" class="col-form-label col-md-3 col-sm-3 label-align">Qty</label>
									<div class="col-md-6 col-sm-6 ">
										<input id="qty_po" name="qty_po" class="form-control" type="number" min="0" placeholder="Ketikkan Qty Barang">
									</div>
								</div>

								<!-- <div class="item form-group">
									<label for="id_room" class="col-form-label col-md-3 col-sm-3 label-align">Satuan Barang <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<select class="form-control" name="id_satuan" id="id_satuan" required>
											<option value="">--Pilih Satuan--</option>
											<?php foreach($satuan as $row) : ?>
												<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
											<?php endforeach;?>	
										</select>
									</div>
								</div> -->

								<div class="item form-group">
									<label for="harga_po" class="col-form-label col-md-3 col-sm-3 label-align">Harga Satuan</label>
									<div class="col-md-6 col-sm-6 ">
										<input id="harga_po" name="harga_po" class="form-control" type="number" min="0" placeholder="Ketikkan Harga Satuan">
									</div>
								</div>


								<div class="item form-group">
									<label for="ket_po" class="col-form-label col-md-3 col-sm-3 label-align">Keterangan</label>
									<div class="col-md-6 col-sm-6 ">
										<textarea id="ket_po" class="form-control" rows="4" name="ket_po" id="ket_po" placeholder="Ketikkan Keterangan" style="resize:none;"></textarea>
									</div>
									<input name="acc3" class="form-control" type="hidden" value="">
									<input name="acc4" class="form-control" type="hidden" value="">
									<input name="acc5" class="form-control" type="hidden" value="">
									<input name="id_no_po" class="form-control" type="hidden" value="<?= $id_no_po?>">

								</div>

					

								<div class="item form-group">
									<label for="id_room" class="col-form-label col-md-3 col-sm-3 label-align">Vendor <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<select class="form-control" name="id_vendor" id="id_satuan" required>
											<option value="">--Pilih Vendor--</option>
											<?php foreach($vendor as $row) : ?>
												<option value="<?= $row['id_vendor']?>"><?= $row['nama_vendor']?></option>
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
