<?php

// $id_mhs = $_SESSION["id_mhs"];

// ambil data di URL
$kode_brg = $_GET["kode_brg"];
// query data barang berdasarkan kode_brg
$barang = query("SELECT * FROM barang WHERE kode_brg = '$kode_brg'")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	

	

	// cek apakah data berhasil diubah atau tidak
	if(ubahBarang($_POST) > 0 ) {
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
			window.location.href = '?page=dataBarang'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=dataBarang'; //will redirect to your blog page (an ex: blog.html)
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
					
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2>Ubah Data Barang<small></small></h2>
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
							<!-- <input type="hidden" name="kode_brg_lama" value="<?= $barang["kode_brg"];?>"> -->
							<input type="hidden" name="gambarBarangLama" value="<?= $barang["gambar_barang"];?>">
							
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_brg">Kode Barang <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" name="kode_brg" id="kode_brg" required="required" class="form-control" value="<?= $barang["kode_brg"];?>" readonly>
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_barang">Nama Barang <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" name="nama_barang" id="nama_barang" required="required" class="form-control" value="<?= $barang["nama_barang"];?>">
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="spek">Spesifikasi 
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" name="spek" id="spek" required="required" class="form-control" value="<?= $barang["spek"];?>">
								</div>
							</div>
							<div class="item form-group">
								<label for="deskripsi" class="col-form-label col-md-3 col-sm-3 label-align">Deskripsi</label>
								<div class="col-md-6 col-sm-6 ">
									<textarea id="deskripsi" class="form-control" rows="4" name="deskripsi" id="deskripsi" style="resize:none;"><?= $barang["deskripsi"];?></textarea>
								</div>
							</div>
							
							<!-- <div class="item form-group">
								<label for="stok_barang" class="col-form-label col-md-3 col-sm-3 label-align">Stok Barang</label>
								<div class="col-md-6 col-sm-6 ">
									<input id="stok_barang" name="stok_barang" class="form-control" type="number" min="0" value="<?= $barang['stok_barang']?>">
								</div>
							</div> -->

							<div class="item form-group">
								<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Gambar Barang<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 ">
									<img src="img/barang/<?= $barang['gambar_barang'];?>" width="50">
									<input type="file" name="gambar_barang">
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
