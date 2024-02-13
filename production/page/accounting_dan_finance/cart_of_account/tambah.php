<?php

// $id_mhs = $_SESSION["id_mhs"];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahCoa($_POST) > 0 ) {
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
			window.location.href = '?page=coa'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=coa'; //will redirect to your blog page (an ex: blog.html)
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
							<h2>Input Data Cart of Account <small></small></h2>
							
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<br />
							<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
								<div class="item form-group">
									<label for="kode_coa" class="col-form-label col-md-3 col-sm-3 label-align">Kode COA <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<input id="kode_coa" name="kode_coa" class="form-control" type="number" min="0" minlength="4" placeholder="Ketikkan Kode COA" required>
									</div>
								</div>

								<div class="item form-group">
									<label for="name_account" class="col-form-label col-md-3 col-sm-3 label-align">Account <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<input id="name_account" name="name_account" class="form-control" type="text" placeholder="Ketikkan Nama Account" required>
									</div>
								</div>
								
								<div class="item form-group">
									<label for="account_type" class="col-form-label col-md-3 col-sm-3 label-align">Account Type<span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<select class="form-control" name="account_type" required>
											<option value="">--Pilih Account Type--</option>
											<option value="ASET">ASET</option>
											<option value="Aset Lancar">Aset Lancar</option>
											<option value="Kas & Bank">Kas & Bank</option>
											<option value="Kas">Kas</option>
											<option value="Bank">Bank</option>
											<option value="Piutang Usaha">Piutang Usaha</option>
											<option value="Piutang Non Usaha">Piutang Non Usaha</option>
											<option value="Piutang Pemegang Saham">Piutang Pemegang Saham</option>
											<option value="Piutang Related Party">Piutang Related Party</option>
											<option value="Pajak Dibayar Dimuka">Pajak Dibayar Dimuka</option>
											<option value="Aktiva Lancar Lainnya">Aktiva Lancar Lainnya</option>
											<option value="Aset Tidak Lancar">Aset Tidak Lancar</option>
											<option value="Aset Tetap">Aset Tetap</option>
											<option value="Aset Tetap-Akumulasi Penyusutan">Aset Tetap-Akumulasi Penyusutan</option>
											<option value="Akumulasi Penyusutan">Akumulasi Penyusutan</option>
											<option value="KEWAJIBAN">KEWAJIBAN</option>
											<option value="Hutang Lancar">Hutang Lancar</option>
											<option value="Hutang Usaha">Hutang Usaha</option>
											<option value="Hutang Non Usaha">Hutang Non Usaha</option>
											<option value="Hutang Bank">Hutang Bank</option>
											<option value="Hutang Pajak">Hutang Pajak</option>
											<option value="Hutang Lancar Lainnya">Hutang Lancar Lainnya</option>
											<option value="Biaya Yang Masih Harus Dibayar">Biaya Yang Masih Harus Dibayar</option>
											<option value="Hutang Jangka Panjang">Hutang Jangka Panjang</option>
											<option value="EKUITAS">EKUITAS</option>
											<option value="Laba Ditahan">Laba Ditahan</option>
											<option value="Pendapatan">Pendapatan</option>
											<option value="Pendapatan Lainnya">Pendapatan Lainnya</option>
											<option value="Harga Pokok Penjualan">Harga Pokok Penjualan</option>
											<option value="Beban">Beban</option>
											<option value="Beban Lainnya">Beban Lainnya</option>
											
										</select>
									</div>
								</div>

								<!-- <div class="item form-group">
									<label for="account_type" class="col-form-label col-md-3 col-sm-3 label-align">Account Type<span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<input id="account_type" name="account_type" class="form-control" type="text" placeholder="Ketikkan Account Type" required>
									</div>
								</div> -->


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
