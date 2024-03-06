<?php
$id_uraian = mysqli_real_escape_string($koneksi, $_GET['id_uraian']);
$id_ppu = mysqli_real_escape_string($koneksi, $_GET['id_ppu']);
$id_user = $_SESSION['id_user'];
$satuan = query("SELECT * FROM satuan");
$vessel = query("SELECT * FROM vessel");
$project = query("SELECT * FROM project");

$uraian = query("SELECT * FROM uraian_ppu WHERE id_uraian=$id_uraian")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(ubahUraian($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'Uraian berhasil diupdate',
				//footer              :  '',
				icon                : 'success',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?form=lihatUraian&id_ppu=". $id_ppu ."'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>"; 

	} else{
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Gagal',
				text                :  'Uraian gagal diupdate',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?form=lihatUraian&id_ppu=". $id_ppu ."'; //will redirect to your blog page (an ex: blog.html)
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
									<h2>Ubah Uraian<small></small></h2>
	
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_uraian">Uraian <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="nama_uraian" id="nama_uraian" required="required" class="form-control" value="<?= $uraian['nama_uraian']?>">
											</div>
										</div>

                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="qty_uraian">Qty <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" min="0" name="qty_uraian" id="qty_uraian" required="required" class="form-control" value="<?= $uraian['qty_uraian']?>">
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Satuan <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_satuan" required>
													<option value="">--Pilih Satuan--</option>
													<?php foreach($satuan as $row) : ?>
														<option value="<?= $row['id_satuan']?>" <?= ($row['id_satuan'] == $uraian['id_satuan']) ? 'selected' : '';?>><?= $row['nama_satuan']?> </option>
													<?php endforeach;?>	
												</select>
												
											</div>
										</div>

                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="harga_satuan">Harga Satuan <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" min="0" name="harga_satuan" id="harga_satuan" required="required" class="form-control" value="<?= $uraian['harga_satuan']?>">
											</div>
										</div>

                                        <div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Vessel <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_vessel" required>
													<option value="">--Pilih Vessel--</option>
													<?php foreach($vessel as $row) : ?>
														<option value="<?= $row['id_vessel']?>" <?= ($row['id_vessel'] == $uraian['id_vessel']) ? 'selected' : '';?>><?= $row['nama_vessel']?> </option>
													<?php endforeach;?>	
												</select>
												
											</div>
										</div>

                                        <div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Project <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_project" required>
													<option value="">--Pilih Project--</option>
													<?php foreach($project as $row) : ?>
														<option value="<?= $row['id_project']?>" <?= ($row['id_project'] == $uraian['id_project']) ? 'selected' : '';?>><?= $row['nama_project']?> </option>
													<?php endforeach;?>	
												</select>
												
											</div>
										</div>


										<input type="hidden" name='id_ppu' value='<?= $id_ppu;?>'>
										<input type="hidden" name='id_uraian' value='<?= $id_uraian;?>'>
                                        
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="?form=lihatUraian&id_ppu=<?= $id_ppu;?>" class= "btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
												<button class="btn btn-primary btn-sm" type="reset"><i class="fa fa-refresh"></i> Reset</button>
												<button type="submit" class="btn btn-success btn-sm" name="submit"> <i class="fa fa-edit"></i> Update</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

				




					
				</div>
    </div>
