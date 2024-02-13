<?php

// $id_mhs = $_SESSION["id_mhs"];

// ambil data di URL
$kode_coa = $_GET["kode_coa"];
// query data mahasiswa berdasarkan id
$coa = query("SELECT * FROM cart_of_account WHERE kode_coa = $kode_coa")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	

	

	// cek apakah data berhasil diubah atau tidak
	if(ubahCoa($_POST) > 0 ) {
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
			window.location.href = '?page=coa'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=coa'; //will redirect to your blog page (an ex: blog.html)
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
									<h2>Ubah Data Cart of Account<small></small></h2>
							
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
										<input type="hidden" name="kode_coa_lama" value="<?= $coa["kode_coa"];?>">
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_coa">Kode COA <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" min="0" name="kode_coa" id="kode_coa" required="required" class="form-control" value="<?= $coa['kode_coa']?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="name_account">Account <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="name_account" id="name_account" required="required" class="form-control" value="<?= $coa['name_account']?>">
											</div>
										</div>
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="account_type">Account Type<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
													<select class="form-control" name="account_type" required>
														<option value="">--Pilih Account Type--</option>
														<option value="ASET" <?php if ($coa['account_type'] == 'ASET') { echo "selected"; } ?>>ASET</option>
														<option value="Aset Lancar" <?php if ($coa['account_type'] == 'Aset Lancar') { echo "selected"; } ?>>Aset Lancar</option>
														<option value="Kas & Bank" <?php if ($coa['account_type'] == 'Kas & Bank') { echo "selected"; } ?>>Kas & Bank</option>
														<option value="Kas" <?php if ($coa['account_type'] == 'Kas') { echo "selected"; } ?>>Kas</option>
														<option value="Bank" <?php if ($coa['account_type'] == 'Bank') { echo "selected"; } ?>>Bank</option>
														<option value="Piutang Usaha" <?php if ($coa['account_type'] == 'Piutang Usaha') { echo "selected"; } ?>>Piutang Usaha</option>
														<option value="Piutang Non Usaha" <?php if ($coa['account_type'] == 'Piutang Non Usaha') { echo "selected"; } ?>>Piutang Non Usaha</option>
														<option value="Piutang Pemegang Saham" <?php if ($coa['account_type'] == 'Piutang Pemegang Saham') { echo "selected"; } ?>>Piutang Pemegang Saham</option>
														<option value="Piutang Related Party" <?php if ($coa['account_type'] == 'Piutang Related Party') { echo "selected"; } ?>>Piutang Related Party</option>
														<option value="Pajak Dibayar Dimuka" <?php if ($coa['account_type'] == 'Pajak Dibayar Dimuka') { echo "selected"; } ?>>Pajak Dibayar Dimuka</option>
														<option value="Aktiva Lancar Lainnya" <?php if ($coa['account_type'] == 'Aktiva Lancar Lainnya') { echo "selected"; } ?>>Aktiva Lancar Lainnya</option>
														<option value="Aset Tidak Lancar" <?php if ($coa['account_type'] == 'Aset Tidak Lancar') { echo "selected"; } ?>>Aset Tidak Lancar</option>
														<option value="Aset Tetap" <?php if ($coa['account_type'] == 'Aset Tetap') { echo "selected"; } ?>>Aset Tetap</option>
														<option value="Aset Tetap-Akumulasi Penyusutan" <?php if ($coa['account_type'] == 'Aset Tetap-Akumulasi Penyusutan') { echo "selected"; } ?>>Aset Tetap-Akumulasi Penyusutan</option>
														<option value="Akumulasi Penyusutan" <?php if ($coa['account_type'] == 'Akumulasi Penyusutan') { echo "selected"; } ?>>Akumulasi Penyusutan</option>
														<option value="KEWAJIBAN" <?php if ($coa['account_type'] == 'KEWAJIBAN') { echo "selected"; } ?>>KEWAJIBAN</option>
														<option value="Hutang Lancar" <?php if ($coa['account_type'] == 'Hutang Lancar') { echo "selected"; } ?>>Hutang Lancar</option>
														<option value="Hutang Usaha" <?php if ($coa['account_type'] == 'Hutang Usaha') { echo "selected"; } ?>>Hutang Usaha</option>
														<option value="Hutang Non Usaha" <?php if ($coa['account_type'] == 'Hutang Non Usaha') { echo "selected"; } ?>>Hutang Non Usaha</option>
														<option value="Hutang Bank" <?php if ($coa['account_type'] == 'Hutang Bank') { echo "selected"; } ?>>Hutang Bank</option>
														<option value="Hutang Pajak" <?php if ($coa['account_type'] == 'Hutang Pajak') { echo "selected"; } ?>>Hutang Pajak</option>
														<option value="Hutang Lancar Lainnya" <?php if ($coa['account_type'] == 'Hutang Lancar Lainnya') { echo "selected"; } ?>>Hutang Lancar Lainnya</option>
														<option value="Biaya Yang Masih Harus Dibayar" <?php if ($coa['account_type'] == 'Biaya Yang Masih Harus Dibayar') { echo "selected"; } ?>>Biaya Yang Masih Harus Dibayar</option>
														<option value="Hutang Jangka Panjang" <?php if ($coa['account_type'] == 'Hutang Jangka Panjang') { echo "selected"; } ?>>Hutang Jangka Panjang</option>
														<option value="EKUITAS" <?php if ($coa['account_type'] == 'EKUITAS') { echo "selected"; } ?>>EKUITAS</option>
														<option value="Laba Ditahan" <?php if ($coa['account_type'] == 'Laba Ditahan') { echo "selected"; } ?>>Laba Ditahan</option>
														<option value="Pendapatan" <?php if ($coa['account_type'] == 'Pendapatan') { echo "selected"; } ?>>Pendapatan</option>
														<option value="Pendapatan Lainnya" <?php if ($coa['account_type'] == 'Pendapatan Lainnya') { echo "selected"; } ?>>Pendapatan Lainnya</option>
														<option value="Harga Pokok Penjualan" <?php if ($coa['account_type'] == 'Harga Pokok Penjualan') { echo "selected"; } ?>>Harga Pokok Penjualan</option>
														<option value="Beban" <?php if ($coa['account_type'] == 'Beban') { echo "selected"; } ?>>Beban</option>
														<option value="Beban Lainnya" <?php if ($coa['account_type'] == 'Beban Lainnya') { echo "selected"; } ?>>Beban Lainnya</option>
														
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
