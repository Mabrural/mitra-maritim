<?php 

$no_jurnal = $_GET["no_jurnal"];

if($no_jurnal === null) {
    echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
	echo '<script src="./sweetalert2.min.js"></script>';
	echo "<script>
	setTimeout(function () { 
		swal.fire({
			
			title               : 'Gagal',
			text                :  'Data gagal dihapus',
			//footer              :  '',
			icon                : 'error',
			timer               : 2000,
			showConfirmButton   : true
		});  
	},10);   setTimeout(function () {
		window.location.href = '?page=journal'; //will redirect to your blog page (an ex: blog.html)
	}, 2000); //will call the function after 2 secs
	</script>";
 }

if( $no_jurnal!==null && hapusNoJournal($no_jurnal) > 0 ){
	echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
	echo '<script src="./sweetalert2.min.js"></script>';
	echo "<script>
	setTimeout(function () { 
		swal.fire({
			
			title               : 'Berhasil',
			text                :  'Data berhasil dihapus',
			//footer              :  '',
			icon                : 'success',
			timer               : 2000,
			showConfirmButton   : true
		});  
	},10);   setTimeout(function () {
		window.location.href = '?page=journal'; //will redirect to your blog page (an ex: blog.html)
	}, 2000); //will call the function after 2 secs
	</script>";

} else{
	 echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Peringatan!',
				text                :  'Data Journal Sudah Ada, Journal Tidak Boleh Dihapus',
				//footer              :  '',
				icon                : 'warning',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=journal'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>";
}

?>