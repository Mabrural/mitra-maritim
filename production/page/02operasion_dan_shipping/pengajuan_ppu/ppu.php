<?php
$sertifikat = query("SELECT * FROM sertifikat_kapal JOIN vessel ON vessel.id_vessel=sertifikat_kapal.id_vessel");
$vessel = query("SELECT * FROM vessel");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahSertifikat($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'Sertifikat berhasil ditambahkan',
				//footer              :  '',
				icon                : 'success',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=monitoringSertifikat'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>"; 

	} else{
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Gagal',
				text                :  'Sertifikat gagal ditambahkan',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=monitoringSertifikat'; //will redirect to your blog page (an ex: blog.html)
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
							<h2>Pengajuan Pengeluaran Uang <small></small></h2>
							
							<div class="clearfix"></div>
						</div>

                        <a href="?page=loanPanjar" class="btn btn-primary">Loan / Panjar</a>
                        <a href="?page=expenses" class="btn btn-info">Expenses</a>
                        <a href="?page=penyelesaianBpu" class="btn btn-success">Penyelesaian / BPU</a>
                        
						
							
						</div>
					</div>
				</div>
			</div>

				




					
	</div>
 </div>

