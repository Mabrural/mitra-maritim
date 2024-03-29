<?php

$id_crew = $_GET['id_crew'];

$vessel = query("SELECT * FROM vessel");
$bank = query("SELECT * FROM bank");
$posisi = query("SELECT * FROM posisi_crew");

$crew = query("SELECT * FROM crew WHERE id_crew=$id_crew")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(ubahCrew($_POST) > 0 ) {
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
			window.location.href = '?page=crew'; //will redirect to your blog page (an ex: blog.html)
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
				text                :  'Data gagal diubah',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=crew'; //will redirect to your blog page (an ex: blog.html)
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
							<h2>Ubah Data Crew <small></small></h2>
							
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<br />
							<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                <input type="hidden" name="id_crew" value="<?= $id_crew;?>">
                                <div class="item form-group">
                                    <label for="nama_crew" class="col-form-label col-md-3 col-sm-3 label-align">Nama Crew <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="nama_crew" name="nama_crew" class="form-control" type="text" value="<?= $crew['nama_crew']?>">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="nik" class="col-form-label col-md-3 col-sm-3 label-align">NIK <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="nik" name="nik" class="form-control" type="number" min="0" value="<?= $crew['nik']?>">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="npwp" class="col-form-label col-md-3 col-sm-3 label-align">NPWP <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="npwp" name="npwp" class="form-control" type="text" value="<?= $crew['npwp']?>"">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="tmp_lahir" class="col-form-label col-md-3 col-sm-3 label-align">Tempat Lahir <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="tmp_lahir" name="tmp_lahir" class="form-control" type="text" value="<?= $crew['tmp_lahir']?>">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="tgl_lahircrew" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Lahir <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="tgl_lahircrew" name="tgl_lahircrew" class="form-control" type="date" value="<?= $crew['tgl_lahircrew']?>">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <div class="col-md-2 col-sm-6 ">
											Laki-laki :
											<input type="radio" class="flat" name="jk_crew" id="genderM" value="Laki-laki" <?= ($crew['jk_crew'] == 'Laki-laki') ? 'checked' : '';?> required /> 
                                        </div>
                                        <div class="col-md-2 col-sm-6 ">
                                            Perempuan :
											<input type="radio" class="flat" name="jk_crew" id="genderF" value="Perempuan" <?= ($crew['jk_crew'] == 'Perempuan') ? 'checked' : '';?> required />
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Bank <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_bank" required>
                                            <option value="">--Pilih Bank--</option>
                                            <?php foreach($bank as $row) : ?>
                                                <option value="<?= $row['id_bank']?>" <?= ($row['id_bank'] == $crew['id_bank']) ? 'selected' : '';?>><?= $row['nama_bank']?></option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
									<label for="no_rek" class="col-form-label col-md-3 col-sm-3 label-align">No. Rekening <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<input id="no_rek" name="no_rek" class="form-control" type="number" min="1" value="<?= $crew['no_rek']?>">
									</div>
								</div>

                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Posisi <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_posisi" required>
                                            <option value="">--Pilih Posisi--</option>
                                            <?php foreach($posisi as $row) : ?>
                                                <option value="<?= $row['id_posisi']?>" <?= ($row['id_posisi'] == $crew['id_posisi']) ? 'selected' : '';?>><?= $row['nama_posisi']?></option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>


                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Vessel <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_vessel" required>
                                            <option value="">--Pilih Vessel--</option>
                                            <?php foreach($vessel as $row) : ?>
                                                <option value="<?= $row['id_vessel']?>" <?= ($row['id_vessel'] == $crew['id_vessel']) ? 'selected' : '';?>><?= $row['nama_vessel']?></option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Upload KTP (.pdf, .png, .jpg, .jpeg) Max. 1 MB </label>
									<div class="col-md-6 col-sm-6 ">
										<input type="file" name="scan_ktp">
										<?php if (!empty($crew['scan_ktp'])): ?>
											<br>
											<p class="file-selected">File sebelumnya: <?= $crew['scan_ktp'] ?></p>
											<input type="hidden" name="scan_ktp_lama" value="<?= $crew['scan_ktp'] ?>">
										<?php endif; ?>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Upload KK (.pdf) Max. 1 MB </label>
									<div class="col-md-6 col-sm-6 ">
										<input type="file" name="scan_kk">
										<?php if (!empty($crew['scan_kk'])): ?>
											<br>
											<p class="file-selected">File sebelumnya: <?= $crew['scan_kk'] ?></p>
											<input type="hidden" name="scan_kk_lama" value="<?= $crew['scan_kk'] ?>">
										<?php endif; ?>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Upload NPWP (.pdf) Max. 1 MB </label>
									<div class="col-md-6 col-sm-6 ">
										<input type="file" name="scan_npwp">
										<?php if (!empty($crew['scan_npwp'])): ?>
											<br>
											<p class="file-selected">File sebelumnya: <?= $crew['scan_npwp'] ?></p>
											<input type="hidden" name="scan_npwp_lama" value="<?= $crew['scan_npwp'] ?>">
										<?php endif; ?>
									</div>
								</div>

								<div class="ln_solid"></div>
								<div class="item form-group">
									<div class="col-md-6 col-sm-6 offset-md-3">
										<!-- <button class="btn btn-primary" type="button">Cancel</button> -->
										<button class="btn btn-primary" type="reset">Reset</button>
										<button type="submit" class="btn btn-success" name="submit">Ubah</button>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>

				




					
	</div>
 </div>
