<?php

$vessel = query("SELECT * FROM vessel");
$bank = query("SELECT * FROM bank");
$posisi = query("SELECT * FROM posisi_crew");
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahCrew($_POST) > 0 ) {
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
				text                :  'Data gagal ditambahkan',
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
							<h2>Form Input Data Crew <small></small></h2>
							
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<br />
							<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                <div class="item form-group">
                                    <label for="nama_crew" class="col-form-label col-md-3 col-sm-3 label-align">Nama Crew <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="nama_crew" name="nama_crew" class="form-control" type="text"placeholder="Ketikkan Nama Crew">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="nik" class="col-form-label col-md-3 col-sm-3 label-align">NIK <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="nik" name="nik" class="form-control" type="number" min="0" placeholder="Ketikkan NIK">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="npwp" class="col-form-label col-md-3 col-sm-3 label-align">NPWP <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="npwp" name="npwp" class="form-control" type="text" placeholder="Ketikkan NPWP">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="tmp_lahir" class="col-form-label col-md-3 col-sm-3 label-align">Tempat Lahir <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="tmp_lahir" name="tmp_lahir" class="form-control" type="text" placeholder="Ketikkan Tempat Lahir">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="tgl_lahircrew" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Lahir <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="tgl_lahircrew" name="tgl_lahircrew" class="form-control" type="date">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <div class="col-md-2 col-sm-6 ">
											Laki-laki :
											<input type="radio" class="flat" name="jk_crew" id="genderM" value="Laki-laki" checked="" required /> 
                                        </div>
                                        <div class="col-md-2 col-sm-6 ">
                                            Perempuan :
											<input type="radio" class="flat" name="jk_crew" id="genderF" value="Perempuan" required />
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Bank <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_bank" required>
                                            <option value="">--Pilih Bank--</option>
                                            <?php foreach($bank as $row) : ?>
                                                <option value="<?= $row['id_bank']?>"><?= $row['nama_bank']?></option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
									<label for="no_rek" class="col-form-label col-md-3 col-sm-3 label-align">No. Rekening <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<input id="no_rek" name="no_rek" class="form-control" type="number" min="1" placeholder="Ketikkan No. Rekening">
									</div>
								</div>

                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Posisi <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_posisi" required>
                                            <option value="">--Pilih Posisi--</option>
                                            <?php foreach($posisi as $row) : ?>
                                                <option value="<?= $row['id_posisi']?>"><?= $row['nama_posisi']?></option>
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
                                                <option value="<?= $row['id_vessel']?>"><?= $row['nama_vessel']?></option>
                                            <?php endforeach;?>	
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
