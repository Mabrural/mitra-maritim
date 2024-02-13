<?php

// $id_mhs = $_SESSION["id_mhs"];
$no_jurnal = $_GET['no_jurnal'];

$coa = query("SELECT * FROM cart_of_account");
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahDataJournal($_POST) > 0 ) {
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
			window.location.href = '?form=rincianJurnal&no_jurnal=".$no_jurnal."'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>"; 

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
			window.location.href = '?form=rincianJurnal&no_jurnal=".$no_jurnal."'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>";
		
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
							<h2>Input Data Journal <small></small></h2>
							
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<br />
							<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<input id="no_jurnal" name="no_jurnal" class="form-control" type="hidden" value="<?= $no_jurnal?>">
										<input id="tgl_jurnal" name="tgl_jurnal" class="form-control" type="date" value="<?= date('Y-m-d') ?>" required>
									</div>
								</div>

								<div class="item form-group">
									<label for="no_journal" class="col-form-label col-md-3 col-sm-3 label-align">No. Cart of Account <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<select class="form-control" name="kode_coa" required>
											<option value="">--Pilih No. Account--</option>
											<?php foreach($coa as $row) : ?>
												<option value="<?= $row['kode_coa']?>"> [ <?= $row['kode_coa']?> ] - <?= $row['name_account']?></option>
											<?php endforeach;?>	
										</select>
									</div>
								</div>

								<div class="item form-group">
									<label for="ket_jurnal" class="col-form-label col-md-3 col-sm-3 label-align">Keterangan</label>
									<div class="col-md-6 col-sm-6 ">
										<textarea id="ket_jurnal" class="form-control" rows="4" name="ket_jurnal" id="ket_jurnal" placeholder="Ketikkan Keterangan" style="resize:none;"></textarea>
									</div>
								</div>

								<div class="item form-group">
									<label for="debit" class="col-form-label col-md-3 col-sm-3 label-align">Debit</label>
									<div class="col-md-6 col-sm-6 ">
										<input id="debit" name="debit" class="form-control" type="number" min="0" placeholder="Ketikkan Debit">
									</div>
								</div>

								<div class="item form-group">
									<label for="kredit" class="col-form-label col-md-3 col-sm-3 label-align">Kredit</label>
									<div class="col-md-6 col-sm-6 ">
										<input id="kredit" name="kredit" class="form-control" type="number" min="0" placeholder="Ketikkan Kredit">
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
