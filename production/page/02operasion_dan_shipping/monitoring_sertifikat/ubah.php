<?php
$id_sertifikat = mysqli_real_escape_string($koneksi, $_GET['id_sertifikat']);
$sertifikat = query("SELECT * FROM sertifikat_kapal JOIN vessel ON vessel.id_vessel=sertifikat_kapal.id_vessel WHERE id_sertifikat=$id_sertifikat")[0];
$vessel = query("SELECT * FROM vessel");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(ubahSertifikat($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'Data berhasil diupdate',
				//footer              :  '',
				icon                : 'success',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=monitoringSertifikat'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>"; 

	} else{
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Gagal',
				text                :  'Data gagal diupdate',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=monitoringSertifikat'; //will redirect to your blog page (an ex: blog.html)
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
							<h2>Update Data Certificate <small></small></h2>
							
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<br />
							<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                <input type="hidden" name="id_sertifikat" value="<?= $id_sertifikat;?>">
                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Nama Vessel <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_vessel" required>
                                            <option value="">--Pilih Vessel--</option>
                                            <?php foreach($vessel as $row) : ?>
                                                <option value="<?= $row['id_vessel']?>" <?= ($row['id_vessel'] == $sertifikat['id_vessel']) ? 'selected' : '';?>><?= $row['nama_vessel']?> </option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="nama_sertifikat" class="col-form-label col-md-3 col-sm-3 label-align">Nama Sertifikat <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="nama_sertifikat" name="nama_sertifikat" class="form-control" type="text" placeholder="Ketikkan Nama Sertifikat" value="<?= $sertifikat['nama_sertifikat']?>" required>
                                    </div>
                                </div>
								
								<div class="item form-group">
                                    <label for="tgl_terbit" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Terbit <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="tgl_terbit" name="tgl_terbit" class="form-control" type="date" value="<?= $sertifikat['tgl_terbit']?>" required>
                                    </div>
                                </div>


                                <div class="item form-group">
                                    <label for="tgl_expired" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Expired <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="tgl_expired" name="tgl_expired" class="form-control" type="date" value="<?= $sertifikat['tgl_expired']?>" required>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="status_cert" class="col-form-label col-md-3 col-sm-3 label-align">Status Sertifikat <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
										<select class="form-control" name="status_cert" required>
                                            <option value="">--Pilih Status Sertifikat--</option>
                                            <option value="Aktif" <?= ($sertifikat['status_cert'] == 'Aktif') ? 'selected': '';?>>Aktif</option>
                                            <option value="Akan Kedaluarsa" <?= ($sertifikat['status_cert'] == 'Akan Kedaluarsa') ? 'selected' : '';?>>Akan Kedaluarsa</option>
                                            <option value="Kedaluarsa" <?= ($sertifikat['status_cert'] == 'Kedaluarsa') ? 'selected' : '';?>>Kedaluarsa</option>
                                        </select>
                                    </div>
                                </div>

                               
								<div class="ln_solid"></div>
								<div class="item form-group">
									<div class="col-md-6 col-sm-6 offset-md-3">
										<!-- <button class="btn btn-primary" type="button">Cancel</button> -->
										<button class="btn btn-primary" type="reset">Reset</button>
										<button type="submit" class="btn btn-success" name="submit"> <i class="fa fa-edit"></i> Update</button>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>

				




					
	</div>
 </div>
