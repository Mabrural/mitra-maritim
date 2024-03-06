<?php

$id_user = $_SESSION['id_user'];
$karyawan = query("SELECT * FROM karyawan WHERE status='Aktif'");
$crew = query("SELECT * FROM crew");
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahPpu($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'PPU berhasil ditambahkan',
				//footer              :  '',
				icon                : 'success',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=loanPanjar'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>"; 

	} else{
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Gagal',
				text                :  'PPU gagal ditambahkan',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=loanPanjar'; //will redirect to your blog page (an ex: blog.html)
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
									<h2>New PPU<small></small></h2>
	
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="no_ppu">Nomor PPU <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="no_ppu" id="no_ppu" required="required" class="form-control" placeholder="No. PPU">
											</div>
										</div>

                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_ppu">Tanggal PPU <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="date" name="tgl_ppu" id="tgl_ppu" required="required" class="form-control">
											</div>
										</div>


                                        <div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Pemohon <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="id_emp">
													<option value="">--Pilih Karyawan--</option>
													<?php foreach($karyawan as $row) : ?>
														<option value="<?= $row['id_emp']?>"><?= $row['nama_emp']?> </option>
													<?php endforeach;?>	
												</select>
												
											</div>
										</div>


                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="keperluan">Keperluan <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="keperluan" id="keperluan" required="required" class="form-control" placeholder="Keperluan">
											</div>
										</div>

                                        
					

										<input type="hidden" name='id_user' value='<?= $id_user;?>'>
							
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="?page=loanPanjar" class= "btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
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