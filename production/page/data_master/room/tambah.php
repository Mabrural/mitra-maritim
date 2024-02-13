<?php

// $id_mhs = $_SESSION["id_mhs"];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahRuangan($_POST) > 0 ) {
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
			window.location.href = '?page=dataRuangan'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=dataRuangan'; //will redirect to your blog page (an ex: blog.html)
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
							<h2>Form Input Data Ruangan<small></small></h2>
							<!-- <ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
									<ul class="dropdown-menu" role="menu">
										<li><a class="dropdown-item" href="#">Settings 1</a>
										</li>
										<li><a class="dropdown-item" href="#">Settings 2</a>
										</li>
									</ul>
								</li>
								<li><a class="close-link"><i class="fa fa-close"></i></a>
								</li>
							</ul> -->
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<br />
							<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
								<div class="item form-group">
									<label for="room_name" class="col-form-label col-md-3 col-sm-3 label-align">Nama Ruangan<span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 ">
										<input id="room_name" name="room_name" class="form-control" type="text" placeholder="Ketikkan Nama Ruangan" required>
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
