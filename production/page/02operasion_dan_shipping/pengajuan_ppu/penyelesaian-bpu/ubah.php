<?php

$id_end = mysqli_real_escape_string($koneksi, $_GET['id_end']);
$id_user = $_SESSION['id_user'];
$karyawan = query("SELECT * FROM karyawan WHERE status='Aktif'");

$bpu_ppu = query("SELECT * FROM bpu_ppu 
                 JOIN ppu ON ppu.id_ppu = bpu_ppu.id_ppu 
                 WHERE EXISTS (SELECT 1 FROM penyelesaian WHERE penyelesaian.id_bpu = bpu_ppu.id_bpu AND penyelesaian.id_end = $id_end)");

$penyelesaian = query("SELECT * FROM penyelesaian JOIN bpu_ppu ON bpu_ppu.id_bpu=penyelesaian.id_bpu JOIN ppu ON ppu.id_ppu=bpu_ppu.id_ppu WHERE penyelesaian.id_end = $id_end")[0];



// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(ubahPenyelesaian($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'Penyelesaian berhasil diubah',
				//footer              :  '',
				icon                : 'success',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=penyelesaianBpu'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>"; 

	} else{
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Gagal',
				text                :  'Penyelesaian gagal diubah',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=penyelesaianBpu'; //will redirect to your blog page (an ex: blog.html)
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
							<h2>Ubah Penyelesaian<small></small></h2>

							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<br />
							<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                <input type="hidden" name="id_end" value= "<?= $id_end?>">
								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="no_ppu">Nomor PPU <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<select class="form-control" name="id_bpu" required>
											<option value="">--Pilih No PPU--</option>
											<?php foreach($bpu_ppu as $row) : ?>
												<option value="<?= $row['id_bpu']?>" <?= ($row['id_bpu'] == $penyelesaian['id_bpu']) ? 'selected' : '';?> ><?= $row['no_ppu']?> </option>
											<?php endforeach;?>	
										</select>
									</div>
								</div>

								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_bpu">Tanggal Penyelesaian <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="date" name="tgl_end" id="tgl_end" required="required" class="form-control" value="<?= $penyelesaian['tgl_end']?>">
									</div>
								</div>


								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="nominal_use">Total Pemakaian <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="number" min="0" name="nominal_use" id="angkaInput" required="required" class="form-control" placeholder="Total Pemakaian" value="<?= $penyelesaian['nominal_use']?>">
									</div>
								</div>

								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="selisih">Selisih <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="number" name="selisih" id="angkaInput" required="required" class="form-control" placeholder="Selisih" value="<?= $penyelesaian['selisih']?>">
									</div>
								</div>

								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="selisih">Status <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<select name="status_end" id="" class="form-control">
											<option value="">--Pilih Status--</option>
											<option value="Nihil" <?= ($penyelesaian['status_end'] == 'Nihil') ? 'selected' : '';?>>Nihil</option>
											<option value="Reimburse" <?= ($penyelesaian['status_end'] == 'Reimburse') ? 'selected': '';?>>Reimburse</option>
											<option value="Return" <?= ($penyelesaian['status_end'] == 'Return') ? 'selected' : '';?>>Return</option>
										</select>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Bukti Nota (.jpg, .png, .jpeg .pdf) <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<input type="file" name="bukti_nota">
                                        <?php if (!empty($penyelesaian['bukti_nota'])): ?>
											<br>
											<p class="file-selected">File sebelumnya: <?= $penyelesaian['bukti_nota'] ?></p>
											<input type="hidden" name="bukti_nota_lama" value="<?= $penyelesaian['bukti_nota'] ?>">
										<?php endif; ?>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Bukti Return (.jpg, .png, .jpeg .pdf) </label>
									<div class="col-md-6 col-sm-6 ">
										<input type="file" name="bukti_return">
                                        <?php if (!empty($penyelesaian['bukti_return'])): ?>
											<br>
											<p class="file-selected">File sebelumnya: <?= $penyelesaian['bukti_return'] ?></p>
											<input type="hidden" name="bukti_return_lama" value="<?= $penyelesaian['bukti_return'] ?>">
										<?php endif; ?>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Bukti Reimburse (.jpg, .png, .jpeg .pdf) <br> <b style="color:red">(Diisi oleh Finance)</b></label>
									<div class="col-md-6 col-sm-6 ">
										<input type="file" name="bukti_reimburse">
                                        <?php if (!empty($penyelesaian['bukti_reimburse'])): ?>
											<br>
											<p class="file-selected">File sebelumnya: <?= $penyelesaian['bukti_reimburse'] ?></p>
											<input type="hidden" name="bukti_reimburse_lama" value="<?= $penyelesaian['bukti_reimburse'] ?>">
										<?php endif; ?>
									</div>
								</div>

								<!-- <script>
									function formatAngka(input) {
										// Menghapus karakter selain angka
										let angka = input.value.replace(/\D/g, '');

										// Menggunakan fungsi Number() untuk mengonversi string menjadi angka
										angka = Number(angka);

										// Menggunakan fungsi toLocaleString() untuk memformat angka dengan tanda pemisah ribuan
										input.value = angka.toLocaleString();
									}
								</script> -->

			
								
								<div class="ln_solid"></div>
								<div class="item form-group">
									<div class="col-md-6 col-sm-6 offset-md-3">
										<a href="?page=penyelesaianBpu" class= "btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
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


