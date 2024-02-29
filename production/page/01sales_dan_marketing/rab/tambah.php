<?php

$id_user = $_SESSION['id_user'];
$doc_num = generate_document_number();
$sales = query("SELECT * FROM sales_plan WHERE status_plan='selesai'");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahRab($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'RAB berhasil ditambahkan',
				//footer              :  '',
				icon                : 'success',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=RAB'; //will redirect to your blog page (an ex: blog.html)
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
				text                :  'RAB gagal ditambahkan',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=RAB'; //will redirect to your blog page (an ex: blog.html)
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
									<h2>Form Input RAB<small></small></h2>
	
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="doc_num">Document Number <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="doc_num" id="doc_num" required="required" value="<?= $doc_num;?>" class="form-control" readonly>
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Voyage Number <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<!-- <input type="text" id="searchCrew" class="form-control" placeholder="Cari Nama Crew"> -->
												<select class="form-control" name="id_sales" id="selectCrew" required>
													<option value="">--Pilih Voyage Number--</option>
													<?php foreach($sales as $row) : ?>
														<option value="<?= $row['id_sales']?>"><?= $row['voy_num']?> </option>
													<?php endforeach;?>	
												</select>
												
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl_rab">Tanggal <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="date" name="tgl_rab" id="tgl_rab" required="required" class="form-control">
											</div>
										</div>
										

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Upload File RAB (.xlsx, .pdf) <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input type="file" name="file_rab" required>
											</div>
										</div>

										<input type="hidden" name='id_user' value='<?= $id_user;?>'>
										<input type="hidden" name='rab_app1'>
										<input type="hidden" name='rab_app2'>
										<input type="hidden" name='rab_app3'>
										<input type="hidden" name='status_rab' value='On Dirops'>
										
							
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
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
