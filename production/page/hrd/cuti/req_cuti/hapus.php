<?php 

$id_req_cuti = $_GET["id_req_cuti"];

if( hapusRequestCuti($id_req_cuti) > 0 ){
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
		window.location.href = '?page=cutiKaryawan'; //will redirect to your blog page (an ex: blog.html)
	}, 2000); //will call the function after 2 secs
	</script>";
	// echo "
	// 	<script>
	// 		alert('Data berhasil dihapus!');
	// 		document.location.href = 'index.php';
	// 	</script>
	// ";
} else {
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
		window.location.href = '?page=cutiKaryawan'; //will redirect to your blog page (an ex: blog.html)
	}, 2000); //will call the function after 2 secs
	</script>";
	// echo "
	// 	<script>
	// 		alert('Data gagal dihapus');
	// 		document.location.href = 'index.php';
	// 	</script>
	// ";
 }

 ?>