<?php

$id_kontrakcrew = $_GET['id_kontrakcrew'];

$crew = query("SELECT * FROM crew JOIN vessel ON vessel.id_vessel=crew.id_vessel JOIN posisi_crew ON posisi_crew.id_posisi=crew.id_posisi WHERE crew.id_crew IN (
    SELECT id_crew FROM kontrak_crew
  )");
$status_crew = query("SELECT * FROM status_crew");

$kontrak_crew = query("SELECT * FROM kontrak_crew WHERE id_kontrakcrew=$id_kontrakcrew")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(ubahKontrakCrew($_POST) > 0 ) {
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
			window.location.href = '?page=kontrakCrew'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=kontrakCrew'; //will redirect to your blog page (an ex: blog.html)
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
							<h2>Ubah Data Kontrak Crew <small></small></h2>
							
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<br />
							<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

                                <input type="hidden" name="id_kontrakcrew" value="<?= $id_kontrakcrew?>">
                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Nama Crew <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_crew" required>
                                            <option value="">--Pilih Crew--</option>
                                            <?php foreach($crew as $row) : ?>
                                                <option value="<?= $row['id_crew']?>" <?= ($row['id_crew'] == $kontrak_crew['id_crew']) ? 'selected': '';?>><?= $row['nama_crew']?> - [<?= $row['nama_posisi']?>] - <?= $row['nama_vessel']?></option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="sign_on" class="col-form-label col-md-3 col-sm-3 label-align">Sign On <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="sign_on" name="sign_on" class="form-control" type="date" value="<?= $kontrak_crew['sign_on']?>">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="sign_off" class="col-form-label col-md-3 col-sm-3 label-align">Sign Off <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="sign_off" name="sign_off" class="form-control" type="date" value="<?= $kontrak_crew['sign_off']?>">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="gaji_crew" class="col-form-label col-md-3 col-sm-3 label-align">Gaji <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="gaji_crew" name="gaji_crew" class="form-control" type="number" min="0" value="<?= $kontrak_crew['gaji_crew']?>">
                                    </div>
                                </div>


                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Status <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="idstatus_crew" required>
                                            <option value="">--Pilih Status Crew--</option>
                                            <?php foreach($status_crew as $row) : ?>
                                                <option value="<?= $row['idstatus_crew']?>" <?= ($row['idstatus_crew'] == $kontrak_crew['idstatus_crew']) ? 'selected' : '';?>><?= $row['nama_status']?></option>
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
