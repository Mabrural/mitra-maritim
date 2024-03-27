<?php

$id_bpu_exp = mysqli_real_escape_string($koneksi, $_GET['id_bpu_exp']);

$id_user = $_SESSION['id_user'];
$karyawan = query("SELECT * FROM karyawan WHERE status='Aktif'");
$crew = query("SELECT * FROM crew");

$expenses = query("SELECT * FROM expenses WHERE status_expenses = 'Selesai' AND 
            EXISTS (SELECT 1 FROM bpu_expenses WHERE bpu_expenses.id_expenses = expenses.id_expenses)");
$bpu_expenses = query("SELECT * FROM bpu_expenses WHERE id_bpu_exp=$id_bpu_exp")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(ubahBpuExpenses($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'BPU Expenses berhasil diubah',
				//footer              :  '',
				icon                : 'success',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=bpuExpenses'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>"; 

	} else{
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Gagal',
				text                :  'BPU Expenses gagal diubah',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=bpuExpenses'; //will redirect to your blog page (an ex: blog.html)
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
									<h2>Ubah BPU Expenses (Bukti Pengeluaran Uang)<small></small></h2>
	
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                        <input type="hidden" name= "id_bpu_exp" value="<?= $id_bpu_exp?>">
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="id_expenses">Nomor Expenses <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_expenses" required>
                                                    <option value="">-- No Expenses --</option>
													<?php foreach($expenses as $row) : ?>
														<option value="<?= $row['id_expenses']?>" <?= ($row['id_expenses'] == $bpu_expenses['id_expenses']) ? 'selected' : '';?>><?= $row['no_expenses']?> </option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>

                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_bpu">Tanggal Transfer <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="date" name="tgl_bpu_exp" id="tgl_bpu_exp" required="required" class="form-control" value="<?= $bpu_expenses['tgl_bpu_exp']?>">
											</div>
										</div>


                                        <div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Penerima Dana <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="penerima_exp">
													<option value="">--Pilih Penerima Dana--</option>
													<?php foreach($karyawan as $row) : ?>
														<option value="<?= $row['id_emp']?>" <?= ($row['id_emp'] == $bpu_expenses['penerima_exp']) ? 'selected' : '';?>><?= $row['nama_emp']?> </option>
													<?php endforeach;?>	
												</select>
												
											</div>
										</div>

 
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="nominal_tf_exp">Nominal Transfer <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" min="0" name="nominal_tf_exp" id="nominal_tf_exp" required="required" class="form-control" placeholder="Nominal Transfer" value="<?= $bpu_expenses['nominal_tf_exp']?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="note_bpu">Note 
											</label>
											<div class="col-md-6 col-sm-6 ">
												<textarea name="note_exp" id="note_exp" cols="30" rows="5" placeholder="Ketikkan Note " class="form-control" style="resize: none;"><?= $bpu_expenses['note_exp']?></textarea>
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Upload Bukti TF (.jpg, .png, .jpeg .pdf) <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input type="file" name="bukti_tf_exp">
                                                <?php if (!empty($bpu_expenses['bukti_tf_exp'])): ?>
										            <br>
										            <p class="file-selected">File sebelumnya: <?= $bpu_expenses['bukti_tf_exp'] ?></p>
										            <input type="hidden" name="bukti_tf_exp_lama" value="<?= $bpu_expenses['bukti_tf_exp'] ?>">
										        <?php endif; ?>
											</div>
										</div>

                                        
					
                                        <input type="hidden" name="id_user" value="<?= $id_user?>">
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="?page=bpuExpenses" class= "btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
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

    <script>
        document.getElementById('pemohon_type').addEventListener('change', function() {
            var karyawanDropdown = document.getElementById('karyawan_dropdown');
            var crewDropdown = document.getElementById('crew_dropdown');

            if (this.value === 'karyawan') {
                karyawanDropdown.style.display = 'block';
                crewDropdown.style.display = 'none';
            } else if (this.value === 'crew') {
                karyawanDropdown.style.display = 'none';
                crewDropdown.style.display = 'block';
            }
        });
    </script>