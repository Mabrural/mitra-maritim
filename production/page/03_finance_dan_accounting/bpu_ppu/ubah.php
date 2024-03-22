<?php

$id_user = $_SESSION['id_user'];
$id_bpu = mysqli_real_escape_string($koneksi, $_GET['id_bpu']);
$karyawan = query("SELECT * FROM karyawan WHERE status='Aktif'");
$crew = query("SELECT * FROM crew");

// $ppu = query("SELECT * FROM ppu WHERE status_ppu = 'Selesai'");
$ppu = query("SELECT * FROM ppu WHERE status_ppu = 'Selesai' AND 
             EXISTS (SELECT 1 FROM bpu_ppu WHERE bpu_ppu.id_ppu = ppu.id_ppu)");

$bpu_loan = query("SELECT * FROM bpu_ppu JOIN ppu ON ppu.id_ppu=bpu_ppu.id_ppu WHERE id_bpu=$id_bpu")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	
	// cek apakah data berhasil ditambahkan atau tidak
	if(ubahBpu($_POST) > 0 ) {
	
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'BPU berhasil diubah',
				//footer              :  '',
				icon                : 'success',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=bpuLoanPanjar'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>"; 

	} else{
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Gagal',
				text                :  'BPU gagal diubah',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=bpuLoanPanjar'; //will redirect to your blog page (an ex: blog.html)
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
									<h2>Ubah BPU (Bukti Pengeluaran Uang)<small></small></h2>
	
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
										<input type="hidden" name='id_bpu' value="<?= $id_bpu?>">
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="no_ppu">Nomor PPU <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_ppu">
													<option value="">--No. PPU--</option>
													<?php foreach($ppu as $row) : ?>
														<option value="<?= $row['id_ppu']?>" <?= ($row['id_ppu'] == $bpu_loan['id_ppu']) ? 'selected' : '';?>><?= $row['no_ppu']?> </option>
													<?php endforeach;?>	
												</select>
											</div>
										</div>

                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_bpu">Tanggal Transfer <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="date" name="tgl_bpu" id="tgl_bpu" required="required" class="form-control" value="<?= $bpu_loan['tgl_bpu']?>">
											</div>
										</div>


                                        <div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Penerima Dana <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="penerima_dana">
													<option value="">--Pilih Penerima Dana--</option>
													<?php foreach($karyawan as $row) : ?>
														<option value="<?= $row['id_emp']?>" <?= ($row['id_emp'] == $bpu_loan['penerima_dana']) ? 'selected' : '';?>><?= $row['nama_emp']?> </option>
													<?php endforeach;?>	
												</select>
												
											</div>
										</div>


                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="nominal_tf">Nominal Transfer <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" min="0" name="nominal_tf" id="nominal_tf" required="required" class="form-control" placeholder="Nominal Transfer" value="<?= $bpu_loan['nominal_tf']?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="note_bpu">Note 
											</label>
											<div class="col-md-6 col-sm-6 ">
												<textarea name="note_bpu" id="note_bpu" cols="30" rows="5" placeholder="Ketikkan Note " class="form-control" style="resize: none;"><?= $bpu_loan['note_bpu']?></textarea>
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Upload Bukti TF (.jpg, .png, .jpeg .pdf) <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input type="file" name="bukti_tf">
												<?php if (!empty($bpu_loan['bukti_tf'])): ?>
										            <br>
										            <p class="file-selected">File sebelumnya: <?= $bpu_loan['bukti_tf'] ?></p>
										            <input type="hidden" name="bukti_tf_lama" value="<?= $bpu_loan['bukti_tf'] ?>">
										        <?php endif; ?>
											</div>
										</div>

                                        
					

										<input type="hidden" name='id_user' value='<?= $id_user;?>'>
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="?page=bpuLoanPanjar" class= "btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
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