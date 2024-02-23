<?php

$id_user = $_SESSION['id_user'];
$id_duty = $_GET['id_duty'];
$on_duty = query("SELECT * FROM on_duty WHERE id_duty=$id_duty")[0];
$karyawan = query("SELECT * FROM karyawan JOIN jabatan ON jabatan.id_jabatan=karyawan.id_jabatan JOIN user ON user.id_emp=karyawan.id_emp WHERE user.id_user=$id_user");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(ubahOnduty($_POST) > 0 ) {
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
			window.location.href = '?page=onDuty'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=onDuty'; //will redirect to your blog page (an ex: blog.html)
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
							<h2>Ubah Data On Duty Karyawan <small></small></h2>
							
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<br />
							<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Nama Karyawan <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="hidden" name="id_duty" value="<?= $id_duty?>">
                                        <select class="form-control" name="id_emp" required>
                                            <option value="">--Pilih Karyawan--</option>
                                            <?php foreach($karyawan as $row) : ?>
                                                <option value="<?= $row['id_emp']?>" <?= ($row['id_emp'] == $on_duty['id_emp']) ? 'selected': '';?>><?= $row['nama_emp']?> - [<?= $row['nama_jabatan']?>]</option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="tgl_duty" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Duty <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="tgl_duty" name="tgl_duty" class="form-control" type="date" value="<?= $on_duty['tgl_duty']?>" required>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="waktu_duty" class="col-form-label col-md-3 col-sm-3 label-align">Waktu Duty <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="waktu_duty" name="waktu_duty" class="form-control" type="time" value="<?= $on_duty['waktu_duty']?>" required>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="tujuan_duty" class="col-form-label col-md-3 col-sm-3 label-align">Tujuan Duty <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="tujuan_duty" name="tujuan_duty" class="form-control" type="text" value="<?= $on_duty['tujuan_duty']?>" placeholder="Ketikkan Tujuan Duty">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="alasan_duty" class="col-form-label col-md-3 col-sm-3 label-align">Alasan</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        
                                    <textarea name="alasan_duty" id="alasan_duty" cols="30" rows="6" class="form-control" style="resize: none;" placeholder="Ketikkan Alasan Duty"><?= $on_duty['alasan_duty']?></textarea>
                                    </div>
                                </div>

                                    <input type="hidden" name="status_duty" value="<?= $on_duty['status_duty']?>">
                               
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
