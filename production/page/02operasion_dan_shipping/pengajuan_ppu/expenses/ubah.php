<?php

$id_expenses = mysqli_real_escape_string($koneksi, $_GET['id_expenses']);
$id_user = $_SESSION['id_user'];
$karyawan = query("SELECT * FROM karyawan WHERE status='Aktif'");

$expenses = query("SELECT * FROM expenses JOIN karyawan ON karyawan.id_emp=expenses.pemohon WHERE id_expenses = $id_expenses")[0]; 


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(ubahExpenses($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'Expenses berhasil diubah',
				//footer              :  '',
				icon                : 'success',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=expenses'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>"; 

	} else{
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Gagal',
				text                :  'Expenses gagal diubah',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=expenses'; //will redirect to your blog page (an ex: blog.html)
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
							<h2>Ubah Expenses<small></small></h2>

							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<br />
							<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                <input type="hidden" name="id_expenses" value= "<?= $id_expenses?>">
								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="no_ppu">No. Expenses <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" class="form-control" name="no_expenses" placeholder="No. Expenses" value="<?= $expenses['no_expenses']?>" required readonly>
									</div>
								</div>

								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_expenses">Tanggal Expenses <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="date" name="tgl_expenses" id="tgl_expenses" required="required" class="form-control" value="<?= $expenses['tgl_expenses']?>">
									</div>
								</div>

                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Pemohon <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="pemohon">
                                            <option value="">--Pilih Karyawan--</option>
                                            <?php foreach($karyawan as $row) : ?>
                                                <option value="<?= $row['id_emp']?>" <?= ($row['id_emp'] == $expenses['pemohon']) ? 'selected' : '';?>><?= $row['nama_emp']?> </option>
                                            <?php endforeach;?>	
                                        </select>
                                        
                                    </div>
                                </div>


								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="nominal_expenses">Nominal Expenses <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="number" min="0" name="nominal_expenses" id="nominal_expenses" required="required" class="form-control" value="<?= $expenses['nominal_expenses']?>" placeholder="Nominal Expenses" >
									</div>
								</div>

                                <div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="nominal_use">Keperluan <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<textarea name="keperluan_exp" id="keperluan_exp" cols="3" rows="4" class="form-control" placeholder="Keperluan"> <?= $expenses['keperluan_exp']?></textarea>
									</div>
								</div>

						
								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Upload Expenses (.jpg, .png, .jpeg .pdf) <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<input type="file" name="upload_expenses">
                                        <?php if (!empty($expenses['upload_expenses'])): ?>
											<br>
											<p class="file-selected">File sebelumnya: <?= $expenses['upload_expenses'] ?></p>
											<input type="hidden" name="upload_expenses_lama" value="<?= $expenses['upload_expenses'] ?>">
										<?php endif; ?>

									</div>
								</div>



                                <input type="hidden" name="status_expenses" value="On Ka. Shipping">
                                <input type="hidden" name="app_exp1" value="">
                                <input type="hidden" name="app_exp2" value="">
                                <input type="hidden" name="app_exp3" value="">
                                <input type="hidden" name="app_exp4" value="">
                                <input type="hidden" name="app_exp5" value="">
                                <input type="hidden" name="id_user" value="<?= $id_user?>">

			
								
								<div class="ln_solid"></div>
								<div class="item form-group">
									<div class="col-md-6 col-sm-6 offset-md-3">
										<a href="?page=expenses" class= "btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
										<button class="btn btn-primary btn-sm" type="reset"><i class="fa fa-refresh"></i> Reset</button>
										<button type="submit" class="btn btn-success btn-sm" name="submit"><i class="fa fa-edit"></i> Update</button>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>	
		</div>
    </div>


