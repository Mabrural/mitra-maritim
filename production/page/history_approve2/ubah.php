<?php

// $id_mhs = $_SESSION["id_mhs"];

// ambil data di URL
$id_barang = $_GET["id_barang"];
// query data mahasiswa berdasarkan id
$barang = query("SELECT * FROM barang WHERE id_barang = $id_barang")[0];



// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	

	

	// cek apakah data berhasil diubah atau tidak
	if(ubahPengajuan($_POST) > 0 ) {
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
			window.location.href = '?page=pengajuan'; //will redirect to your blog page (an ex: blog.html)
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
					<div class="page-title">
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
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Form Ubah Data <small></small></h2>
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
										<input type="hidden" name="id_barang" value="<?= $barang["id_barang"];?>">
										<div class="item form-group">
											<!-- <input type="hidden" name="aksi" value="ubah"> -->

											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">INV ID <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="inv_id" id="first-name" required="required" class="form-control" value="<?= $barang["inv_id"];?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nama Barang <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="nama_barang" id="last-name" required="required" class="form-control" value="<?= $barang["nama_barang"];?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Spec</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="spek" class="form-control" type="text" value="<?= $barang["spek"];?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Desc</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="deskripsi" class="form-control" type="text" value="<?= $barang["deskripsi"];?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Qty</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="qty" class="form-control" type="text" value="<?= $barang["qty"];?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Date In</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="tgl_masuk" class="form-control" type="date" value="<?= $barang["tgl_masuk"];?>" readonly>
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Unit Price</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="harga" class="form-control" type="text" value="<?= $barang["harga"];?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Vendor</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="vendor" class="form-control" type="text" value="<?= $barang["vendor"];?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Waranty</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="waranty" class="form-control" type="text" value="<?= $barang["waranty"];?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Renewal</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="renewal" class="form-control" type="text" value="<?= $barang["renewal"];?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Condition</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="middle-name" name="kondisi" class="form-control" type="text" value="<?= $barang["kondisi"];?>">
												<input id="middle-name" name="status" class="form-control" type="hidden" value="Menunggu Persetujuan">
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
