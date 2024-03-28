<?php

$id_user = $_SESSION['id_user'];
$karyawan = query("SELECT * FROM karyawan WHERE status='Aktif'");



// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahExpenses($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'Expenses berhasil ditambahkan',
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
				text                :  'Expenses gagal ditambahkan',
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
							<h2>New Expenses<small></small></h2>

							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<br />
							<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="no_ppu">No. Expenses <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" class="form-control" name="no_expenses" placeholder="No. Expenses" required>
									</div>
								</div>

								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_expenses">Tanggal Expenses <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="date" name="tgl_expenses" id="tgl_expenses" required="required" class="form-control">
									</div>
								</div>

                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Pemohon <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="pemohon">
                                            <option value="">--Pilih Karyawan--</option>
                                            <?php foreach($karyawan as $row) : ?>
                                                <option value="<?= $row['id_emp']?>"><?= $row['nama_emp']?> </option>
                                            <?php endforeach;?>	
                                        </select>
                                        
                                    </div>
                                </div>


								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="nominal_expenses">Nominal Expenses <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="number" min="0" name="nominal_expenses" id="nominal_expenses" required="required" class="form-control" placeholder="Nominal Expenses" >
									</div>
								</div>

                                <div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="nominal_use">Keperluan <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<textarea name="keperluan_exp" id="keperluan_exp" cols="3" rows="4" class="form-control" placeholder="Keperluan"></textarea>
									</div>
								</div>

						
								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Upload Expenses (.jpg, .png, .jpeg .pdf) <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<input type="file" name="upload_expenses" required>
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
										<button type="submit" class="btn btn-success btn-sm" name="submit"><i class="fa fa-send-o"></i> Submit</button>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>	
		</div>
    </div>


