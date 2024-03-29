<?php 

$host = "localhost";
$user = "root";
$pass = "78789898";
$db = "sistem"; //nama database
//melakukan koneksi ke database
$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
	echo "Gagal konek: " . die(mysqli_error($koneksi));
}



function query($query){
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
}

function generate_kode_sales() {
	global $koneksi;
  
	// Ambil nilai auto increment terakhir
	$query = "SELECT MAX(CAST(SUBSTRING(kode_sales, 13, 5) AS SIGNED)) AS kode_terakhir FROM sales_plan";
	$result = mysqli_query($koneksi, $query);
	$row = mysqli_fetch_assoc($result);
	$kode_terakhir = $row['kode_terakhir'];
  
	// Generate kode pengajuan baru
	$kode_baru = "SPL-" . date('ymd');
	if ($kode_terakhir !== null) {
	  $kode_baru .= sprintf("%05d", $kode_terakhir + 1);
	} else {
	  $kode_baru .= "00001";
	}
  
	// Generate angka random
	$angka_random = random_int(10000, 99999);
  
	// Cek apakah angka random sudah pernah digunakan
	$query = "SELECT kode_sales FROM sales_plan WHERE kode_sales LIKE 'SPL-%' AND RIGHT(kode_sales, 5) = '$angka_random'";
	$result = mysqli_query($koneksi, $query);
	while (mysqli_num_rows($result) > 0) {
	  // Jika sudah pernah digunakan, generate angka random lagi
	  $angka_random = random_int(10000, 99999);
	  $query = "SELECT kode_sales FROM sales_plan WHERE kode_sales LIKE 'SPL-%' AND RIGHT(kode_sales, 5) = '$angka_random'";
	  $result = mysqli_query($koneksi, $query);
	}
  
	// Tambahkan angka random ke kode pengajuan
	$kode_baru .= "-" . $angka_random;
  
	return $kode_baru;
  }

  function tambahSales($data) {

	global $koneksi;
	$kode_sales = generate_kode_sales();
	$voy_num = mysqli_real_escape_string($koneksi, $data["voy_num"]);
	$qty_sales = mysqli_real_escape_string($koneksi, $data["qty_sales"]);
	$id_load = mysqli_real_escape_string($koneksi, $data["id_load"]);
	$id_disch = mysqli_real_escape_string($koneksi, $data["id_disch"]);
	$sales_nominal = mysqli_real_escape_string($koneksi, $data["sales_nominal"]);
	$start = mysqli_real_escape_string($koneksi, $data["start"]);
	$finished = mysqli_real_escape_string($koneksi, $data["finished"]);
	$app1 = mysqli_real_escape_string($koneksi, $data["app1"]);
	$app2 = mysqli_real_escape_string($koneksi, $data["app2"]);
	$app3 = mysqli_real_escape_string($koneksi, $data["app3"]);
	$status_plan = mysqli_real_escape_string($koneksi, $data["status_plan"]);
	$id_cust = mysqli_real_escape_string($koneksi, $data["id_cust"]);
	$id_satuan = mysqli_real_escape_string($koneksi, $data["id_satuan"]);
	$id_vessel = mysqli_real_escape_string($koneksi, $data["id_vessel"]);
	$id_dept = mysqli_real_escape_string($koneksi, $data["id_dept"]);
	$id_kargo = mysqli_real_escape_string($koneksi, $data["id_kargo"]);

	$query = "INSERT INTO sales_plan VALUES
			('', '$kode_sales', '$voy_num', '$qty_sales', '$id_load', '$id_disch', '$sales_nominal', '$start', '$finished', '','','','$status_plan', '$id_cust', '$id_satuan', '$id_vessel', '$id_dept', '$id_kargo')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);


}

function ubahSales($data) {
	global $koneksi;
	$id_sales = $data["id_sales"];
	$voy_num = mysqli_real_escape_string($koneksi, $data["voy_num"]);
	$qty_sales = mysqli_real_escape_string($koneksi, $data["qty_sales"]);
	$id_load = mysqli_real_escape_string($koneksi, $data["id_load"]);
	$id_disch = mysqli_real_escape_string($koneksi, $data["id_disch"]);
	$sales_nominal = mysqli_real_escape_string($koneksi, $data["sales_nominal"]);
	$start = mysqli_real_escape_string($koneksi, $data["start"]);
	$finished = mysqli_real_escape_string($koneksi, $data["finished"]);
	$app1 = mysqli_real_escape_string($koneksi, $data["app1"]);
	$app2 = mysqli_real_escape_string($koneksi, $data["app2"]);
	$app3 = mysqli_real_escape_string($koneksi, $data["app3"]);
	$status_plan = mysqli_real_escape_string($koneksi, $data["status_plan"]);
	$id_cust = mysqli_real_escape_string($koneksi, $data["id_cust"]);
	$id_satuan = mysqli_real_escape_string($koneksi, $data["id_satuan"]);
	$id_vessel = mysqli_real_escape_string($koneksi, $data["id_vessel"]);
	$id_dept = mysqli_real_escape_string($koneksi, $data["id_dept"]);
	$id_kargo = mysqli_real_escape_string($koneksi, $data["id_kargo"]);


	$query = "UPDATE sales_plan SET
				voy_num = '$voy_num',
				qty_sales = '$qty_sales',
				id_load = '$id_load',
				id_disch = '$id_disch',
				sales_nominal = '$sales_nominal',
				start = '$start',
				finished = '$finished',
				status_plan = '$status_plan',
				id_cust = '$id_cust',
				id_satuan = '$id_satuan',
				id_vessel = '$id_vessel',
				id_dept = '$id_dept',
				id_kargo = '$id_kargo'
			  WHERE id_sales = $id_sales
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusSales($id_sales) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM sales_plan WHERE id_sales='$id_sales'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function approveSales1($id_sales) {
	global $koneksi;
	$app1 = "Bambang Wahyudi";	
	$status_plan = "On Dirut";	

	$query = "UPDATE sales_plan SET
				app1 = '$app1',
				status_plan = '$status_plan'
			  WHERE id_sales = $id_sales
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function reviseSales1($id_sales) {
	global $koneksi;
	$app1 = "";	
	$status_plan = "Revise";	

	$query = "UPDATE sales_plan SET
				app1 = '$app1',
				status_plan = '$status_plan'
			  WHERE id_sales = $id_sales
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectSales1($id_sales) {
	global $koneksi;
	$status_plan = "Reject";	

	$query = "UPDATE sales_plan SET
				status_plan = '$status_plan'
			  WHERE id_sales = $id_sales
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function approveSales2($id_sales) {
	global $koneksi;
	$app2 = "Raden Sulaiman Sanjeev";	
	$status_plan = "On Dirkeu";	

	$query = "UPDATE sales_plan SET
				app2= '$app2',
				status_plan = '$status_plan'
			  WHERE id_sales = $id_sales
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function reviseSales2($id_sales) {
	global $koneksi;
	$app1 = "";	
	$status_plan = "Revise";	

	$query = "UPDATE sales_plan SET
				app1 = '$app1',
				status_plan = '$status_plan'
			  WHERE id_sales = $id_sales
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectSales2($id_sales) {
	global $koneksi;
	$app1 = "";
	$status_plan = "Reject";	

	$query = "UPDATE sales_plan SET
				app1 = '$app1',
				status_plan = '$status_plan'
			  WHERE id_sales = $id_sales
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function approveSales3($id_sales) {
	global $koneksi;
	$app3 = "Regina";	
	$status_plan = "Selesai";	

	$query = "UPDATE sales_plan SET
				app3= '$app3',
				status_plan = '$status_plan'
			  WHERE id_sales = $id_sales
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function reviseSales3($id_sales) {
	global $koneksi;
	$app1 = "";	
	$app2 = "";	
	$status_plan = "Revise";	

	$query = "UPDATE sales_plan SET
				app1 = '$app1',
				app2 = '$app2',
				status_plan = '$status_plan'
			  WHERE id_sales = $id_sales
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectSales3($id_sales) {
	global $koneksi;
	$app1 = "";
	$app2 = "";
	$status_plan = "Reject";	

	$query = "UPDATE sales_plan SET
				app1 = '$app1',
				app2 = '$app2',
				status_plan = '$status_plan'
			  WHERE id_sales = $id_sales
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function generate_document_number() {
	global $koneksi;
	
	// Ambil nilai auto increment terakhir
	$query = "SELECT MAX(CAST(SUBSTRING(doc_num, 4) AS SIGNED)) AS kode_terakhir FROM rab";
	$result = mysqli_query($koneksi, $query);
	$row = mysqli_fetch_assoc($result);
	$kode_terakhir = $row['kode_terakhir'];
  
	// Generate kode barang baru
	$kode_baru = "RAB";
	if ($kode_terakhir !== null) {
	  $kode_baru .= sprintf("%07d", $kode_terakhir + 1);
	} else {
	  $kode_baru .= "0000001";
	}
  
	return $kode_baru;
}


function tambahVessel($data) {

	global $koneksi;
	$nama_vessel = mysqli_real_escape_string($koneksi, $data["nama_vessel"]);


	$query = "INSERT INTO vessel VALUES
			('', '$nama_vessel')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);


}

function ubahVessel($data) {
	global $koneksi;
	$id_vessel = $data["id_vessel"];
	$nama_vessel = mysqli_real_escape_string($koneksi, $data["nama_vessel"]);

	$query = "UPDATE vessel SET
				nama_vessel = '$nama_vessel'
			  WHERE id_vessel = $id_vessel
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusVessel($id_vessel) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM vessel WHERE id_vessel='$id_vessel'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function tambahCustomer($data) {

	global $koneksi;
	$nama_customer = mysqli_real_escape_string($koneksi, $data["nama_customer"]);


	$query = "INSERT INTO customer VALUES
			('', '$nama_customer')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);


}

function ubahCustomer($data) {
	global $koneksi;
	$id_cust = $data["id_cust"];
	$nama_customer = mysqli_real_escape_string($koneksi, $data["nama_customer"]);

	$query = "UPDATE customer SET
				nama_customer = '$nama_customer'
			  WHERE id_cust = $id_cust
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusCustomer($id_cust) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM customer WHERE id_cust='$id_cust'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function tambahDept($data) {

	global $koneksi;
	$nama_dept = mysqli_real_escape_string($koneksi, $data["nama_dept"]);


	$query = "INSERT INTO dept VALUES
			('', '$nama_dept')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);


}

function ubahDept($data) {
	global $koneksi;
	$id_dept = $data["id_dept"];
	$nama_dept = mysqli_real_escape_string($koneksi, $data["nama_dept"]);

	$query = "UPDATE dept SET
				nama_dept = '$nama_dept'
			  WHERE id_dept = $id_dept
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusDept($id_dept) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM dept WHERE id_dept='$id_dept'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function tambahKargo($data) {

	global $koneksi;
	$nama_kargo = mysqli_real_escape_string($koneksi, $data["nama_kargo"]);


	$query = "INSERT INTO jenis_kargo VALUES
			('', '$nama_kargo')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function ubahKargo($data) {
	global $koneksi;
	$id_kargo = $data["id_kargo"];
	$nama_kargo = mysqli_real_escape_string($koneksi, $data["nama_kargo"]);

	$query = "UPDATE jenis_kargo SET
				nama_kargo = '$nama_kargo'
			  WHERE id_kargo = $id_kargo
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusKargo($id_kargo) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM jenis_kargo WHERE id_kargo='$id_kargo'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function tambahPort($data) {

	global $koneksi;
	$nama_port = mysqli_real_escape_string($koneksi, $data["nama_port"]);


	$query = "INSERT INTO port VALUES
			('', '$nama_port')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function ubahPort($data) {
	global $koneksi;
	$id_port = $data["id_port"];
	$nama_port = mysqli_real_escape_string($koneksi, $data["nama_port"]);

	$query = "UPDATE port SET
				nama_port = '$nama_port'
			  WHERE id_port = $id_port
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusPort($id_port) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM port WHERE id_port='$id_port'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}



function tambahJabatan($data) {

	global $koneksi;
	$nama_jabatan = mysqli_real_escape_string($koneksi, $data["nama_jabatan"]);


	$query = "INSERT INTO jabatan VALUES
			('', '$nama_jabatan')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function hapusJabatan($id_jabatan) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM jabatan WHERE id_jabatan='$id_jabatan'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function ubahJabatan($data) {
	global $koneksi;
	$id_jabatan = $data["id_jabatan"];
	$nama_jabatan = mysqli_real_escape_string($koneksi, $data["nama_jabatan"]);

	$query = "UPDATE jabatan SET
				nama_jabatan = '$nama_jabatan'
			  WHERE id_jabatan = $id_jabatan
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function tambahDivisi($data) {

	global $koneksi;
	$nama_divisi= mysqli_real_escape_string($koneksi, $data["nama_divisi"]);


	$query = "INSERT INTO divisi VALUES
			('', '$nama_divisi')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function ubahDivisi($data) {
	global $koneksi;
	$id_divisi = $data["id_divisi"];
	$nama_divisi = mysqli_real_escape_string($koneksi, $data["nama_divisi"]);

	$query = "UPDATE divisi SET
				nama_divisi = '$nama_divisi'
			  WHERE id_divisi = $id_divisi
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusDivisi($id_divisi) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM divisi WHERE id_divisi='$id_divisi'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function tambahCrew($data) {

	global $koneksi;
	$nama_crew = mysqli_real_escape_string($koneksi, $data["nama_crew"]);
	$nik = mysqli_real_escape_string($koneksi, $data["nik"]);
	$npwp = mysqli_real_escape_string($koneksi, $data["npwp"]);
	$no_kk = mysqli_real_escape_string($koneksi, $data["no_kk"]);
	$tmp_lahir = mysqli_real_escape_string($koneksi, $data["tmp_lahir"]);
	$tgl_lahircrew = mysqli_real_escape_string($koneksi, $data["tgl_lahircrew"]);
	$jk_crew = mysqli_real_escape_string($koneksi, $data["jk_crew"]);
	$no_rek = mysqli_real_escape_string($koneksi, $data["no_rek"]);
	$id_posisi = mysqli_real_escape_string($koneksi, $data["id_posisi"]);
	$id_vessel = mysqli_real_escape_string($koneksi, $data["id_vessel"]);
	$id_bank = mysqli_real_escape_string($koneksi, $data["id_bank"]);

	// Cek apakah file_scan_ktp diisi
	if(isset($_FILES['scan_ktp']) && $_FILES['scan_ktp']['size'] > 0) {
		$file_scan_ktp =  uploadKTP();
		if (!$file_scan_ktp) {
			return false;
		}
	} else {
		$file_scan_ktp = null;
	}

	// Cek apakah file_scan_ktp diisi
	if(isset($_FILES['scan_kk']) && $_FILES['scan_kk']['size'] > 0) {
		$file_scan_kk =  uploadKK();
		if (!$file_scan_kk) {
			return false;
		}
	} else {
		$file_scan_kk = null;
	}

	// Cek apakah file_scan_ktp diisi
	if(isset($_FILES['scan_npwp']) && $_FILES['scan_npwp']['size'] > 0) {
		$file_scan_npwp =  uploadNPWP();
		if (!$file_scan_npwp) {
			return false;
		}
	} else {
		$file_scan_npwp = null;
	}

	$query = "INSERT INTO crew VALUES
			('', '$nama_crew', '$nik', '$npwp', '$no_kk', '$tmp_lahir', '$tgl_lahircrew', '$jk_crew', '$no_rek', '$id_posisi', '$id_vessel', '$id_bank', '$file_scan_ktp', '$file_scan_kk', '$file_scan_npwp')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);


}

function uploadKTP(){

	$namaFile = $_FILES['scan_ktp']['name'];
	$ukuranFile = $_FILES['scan_ktp']['size'];
	$error = $_FILES['scan_ktp']['error'];
	$tmpName = $_FILES['scan_ktp']['tmp_name'];

	// cek apakah tidak ada file yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih file terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah pdf
	$ekstensiFileValid = ['pdf', 'png', 'jpg', 'jpeg'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid) ){
		echo "
			<script>
				alert('yang anda upload bukan Pdf/Png/Jpg/Jpeg!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran file terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, pdf siap diupload
	// generate nama pdf baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'files/ktp/'. $namaFileBaru);
	return $namaFileBaru;
 }

 function uploadKK(){

	$namaFile = $_FILES['scan_kk']['name'];
	$ukuranFile = $_FILES['scan_kk']['size'];
	$error = $_FILES['scan_kk']['error'];
	$tmpName = $_FILES['scan_kk']['tmp_name'];

	// cek apakah tidak ada file yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih file terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah pdf
	$ekstensiFileValid = ['pdf', 'png', 'jpg', 'jpeg'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid) ){
		echo "
			<script>
				alert('yang anda upload bukan Pdf/Png/Jpg/Jpeg!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran file terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, pdf siap diupload
	// generate nama pdf baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'files/kk/'. $namaFileBaru);
	return $namaFileBaru;
 }

 function uploadNPWP(){

	$namaFile = $_FILES['scan_npwp']['name'];
	$ukuranFile = $_FILES['scan_npwp']['size'];
	$error = $_FILES['scan_npwp']['error'];
	$tmpName = $_FILES['scan_npwp']['tmp_name'];

	// cek apakah tidak ada file yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih file terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah pdf
	$ekstensiFileValid = ['pdf', 'png', 'jpg', 'jpeg'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid) ){
		echo "
			<script>
				alert('yang anda upload bukan Pdf/Png/Jpg/Jpeg!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran file terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, pdf siap diupload
	// generate nama pdf baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'files/npwp/'. $namaFileBaru);
	return $namaFileBaru;
 }

 function ubahCrew($data) {
	global $koneksi;
	$id_crew = $data["id_crew"];
	$nama_crew = mysqli_real_escape_string($koneksi, $data["nama_crew"]);
	$nik = mysqli_real_escape_string($koneksi, $data["nik"]);
	$npwp = mysqli_real_escape_string($koneksi, $data["npwp"]);
	$tmp_lahir = mysqli_real_escape_string($koneksi, $data["tmp_lahir"]);
	$tgl_lahircrew = mysqli_real_escape_string($koneksi, $data["tgl_lahircrew"]);
	$jk_crew = mysqli_real_escape_string($koneksi, $data["jk_crew"]);
	$no_rek = mysqli_real_escape_string($koneksi, $data["no_rek"]);
	$id_posisi = mysqli_real_escape_string($koneksi, $data["id_posisi"]);
	$id_vessel = mysqli_real_escape_string($koneksi, $data["id_vessel"]);
	$id_bank = mysqli_real_escape_string($koneksi, $data["id_bank"]);
	
	// Inisialisasi variabel untuk file lama
	$ktpLama = isset($data["scan_ktp_lama"]) ? mysqli_real_escape_string($koneksi, $data["scan_ktp_lama"]) : '';
	$kkLama = isset($data["scan_kk_lama"]) ? mysqli_real_escape_string($koneksi, $data["scan_kk_lama"]) : '';
	$npwpLama = isset($data["scan_npwp_lama"]) ? mysqli_real_escape_string($koneksi, $data["scan_npwp_lama"]) : '';

	// cek apakah user pilih pdf baru atau tidak
	$fileKTP = isset($_FILES['scan_ktp']) && $_FILES['scan_ktp']['error'] !== 4 ? uploadKTP() : $ktpLama;
	
	// cek apakah user pilih pdf baru atau tidak
	$fileKK = isset($_FILES['scan_kk']) && $_FILES['scan_kk']['error'] !== 4 ? uploadKK() : $kkLama;

	// cek apakah user pilih pdf baru atau tidak
	$fileNPWP = isset($_FILES['scan_npwp']) && $_FILES['scan_npwp']['error'] !== 4 ? uploadNPWP() : $npwpLama;

	$query = "UPDATE crew SET
				nama_crew = '$nama_crew',
				nik = '$nik',
				npwp = '$npwp',
				tmp_lahir = '$tmp_lahir',
				tgl_lahircrew = '$tgl_lahircrew',
				jk_crew = '$jk_crew',
				no_rek = '$no_rek',
				id_posisi = '$id_posisi',
				id_vessel = '$id_vessel',
				id_bank = '$id_bank',
				scan_ktp = '$fileKTP',
				scan_kk = '$fileKK',
				scan_npwp = '$fileNPWP'
			  WHERE id_crew = $id_crew
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusCrew($id_crew) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM crew WHERE id_crew='$id_crew'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function tambahKontrakCrew($data) {

	global $koneksi;
	$sign_on = mysqli_real_escape_string($koneksi, $data["sign_on"]);
	$sign_off = mysqli_real_escape_string($koneksi, $data["sign_off"]);
	$gaji_crew = mysqli_real_escape_string($koneksi, $data["gaji_crew"]);
	$uang_makan_crew = mysqli_real_escape_string($koneksi, $data["uang_makan_crew"]);
	$idstatus_crew = mysqli_real_escape_string($koneksi, $data["idstatus_crew"]);
	$id_crew = mysqli_real_escape_string($koneksi, $data["id_crew"]);
	
	$file_sertifikat_crew =  uploadSertifikatCrew();
	if (!$file_sertifikat_crew) {
		return false;
	}

	$query = "INSERT INTO kontrak_crew VALUES
			('', '$sign_on', '$sign_off', '$file_sertifikat_crew', '$gaji_crew', '$uang_makan_crew', '$idstatus_crew', '$id_crew')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);


}

function uploadSertifikatCrew(){

	$namaFile = $_FILES['scan_sertifikat_crew']['name'];
	$ukuranFile = $_FILES['scan_sertifikat_crew']['size'];
	$error = $_FILES['scan_sertifikat_crew']['error'];
	$tmpName = $_FILES['scan_sertifikat_crew']['tmp_name'];

	// cek apakah tidak ada file yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih file terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah pdf
	$ekstensiFileValid = ['pdf'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid) ){
		echo "
			<script>
				alert('yang anda upload bukan Pdf!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran pdf terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, pdf siap diupload
	// generate nama pdf baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'files/sertifikat_crew/'. $namaFileBaru);
	return $namaFileBaru;
 }


function ubahKontrakCrew($data) {
	global $koneksi;
	$id_kontrakcrew = $data["id_kontrakcrew"];
	$sign_on = mysqli_real_escape_string($koneksi, $data["sign_on"]);
	$sign_off = mysqli_real_escape_string($koneksi, $data["sign_off"]);
	$gaji_crew = mysqli_real_escape_string($koneksi, $data["gaji_crew"]);
	$fileLama = mysqli_real_escape_string($koneksi, $data["sertifikat_crew_lama"]);
	$uang_makan_crew = mysqli_real_escape_string($koneksi, $data["uang_makan_crew"]);
	$idstatus_crew = mysqli_real_escape_string($koneksi, $data["idstatus_crew"]);
	$id_crew = mysqli_real_escape_string($koneksi, $data["id_crew"]);

	// cek apakah user pilih pdf baru atau tidak
	if ($_FILES['scan_sertifikat_crew']['error'] === 4 ) {
		$file = $fileLama;
	} else {

		$file = uploadSertifikatCrew();
	}

	$query = "UPDATE kontrak_crew SET
				sign_on = '$sign_on',
				sign_off = '$sign_off',
				sertifikat_crew = '$file',
				gaji_crew = '$gaji_crew',
				uang_makan_crew = '$uang_makan_crew',
				idstatus_crew = '$idstatus_crew',
				id_crew = '$id_crew'
			  WHERE id_kontrakcrew = $id_kontrakcrew
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusKontrakCrew($id_kontrakcrew) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM kontrak_crew WHERE id_kontrakcrew=$id_kontrakcrew");

	return mysqli_affected_rows($koneksi);

}

function tambahBank($data) {

	global $koneksi;
	$nama_bank = mysqli_real_escape_string($koneksi, $data["nama_bank"]);
	

	$query = "INSERT INTO bank VALUES
			('', '$nama_bank')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);


}

function ubahBank($data) {
	global $koneksi;
	$id_bank = mysqli_real_escape_string($koneksi, $data["id_bank"]);
	$nama_bank = mysqli_real_escape_string($koneksi, $data["nama_bank"]);

	$query = "UPDATE bank SET
				nama_bank = '$nama_bank'
			  WHERE id_bank = $id_bank
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusBank($id_bank) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM bank WHERE id_bank='$id_bank'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function tambahPosisi($data) {

	global $koneksi;
	$nama_posisi = mysqli_real_escape_string($koneksi, $data["nama_posisi"]);
	

	$query = "INSERT INTO posisi_crew VALUES
			('', '$nama_posisi')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);


}

function ubahPosisi($data) {
	global $koneksi;
	$id_posisi = mysqli_real_escape_string($koneksi, $data["id_posisi"]);
	$nama_posisi = mysqli_real_escape_string($koneksi, $data["nama_posisi"]);

	$query = "UPDATE posisi_crew SET
				nama_posisi = '$nama_posisi'
			  WHERE id_posisi = $id_posisi
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusPosisi($id_posisi) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM posisi_crew WHERE id_posisi='$id_posisi'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function tambahRab($data) {
	global $koneksi;
	$doc_num = htmlspecialchars($data["doc_num"]);
	$id_sales = htmlspecialchars($data["id_sales"]);
	$tgl_rab = htmlspecialchars($data["tgl_rab"]);
	$id_user = htmlspecialchars($data["id_user"]);
	$rab_app1 = htmlspecialchars($data["rab_app1"]);
	$rab_app2 = htmlspecialchars($data["rab_app2"]);
	$rab_app3 = htmlspecialchars($data["rab_app3"]);
	$status_rab = htmlspecialchars($data["status_rab"]);
	
	$file_rab =  uploadFileRab();
	if (!$file_rab) {
		return false;
	}

	$query = "INSERT INTO rab VALUES
			('', '$doc_num', '$tgl_rab', '$file_rab', '$id_user', '$id_sales', '$rab_app1', '$rab_app2', '$rab_app3', '$status_rab')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function uploadFileRab(){

	$namaFile = $_FILES['file_rab']['name'];
	$ukuranFile = $_FILES['file_rab']['size'];
	$error = $_FILES['file_rab']['error'];
	$tmpName = $_FILES['file_rab']['tmp_name'];

	// cek apakah tidak ada file yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih file terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah pdf
	$ekstensiFileValid = ['pdf', 'xlsx'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid) ){
		echo "
			<script>
				alert('yang anda upload bukan Pdf/Excel!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran pdf terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, pdf siap diupload
	// generate nama pdf baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'files/rab/'. $namaFileBaru);
	return $namaFileBaru;
 }

 function ubahRab($data) {
	global $koneksi;
	$id_rab = $data["id_rab"];
	$doc_num = htmlspecialchars($data["doc_num"]);
	$id_sales = htmlspecialchars($data["id_sales"]);
	$tgl_rab = htmlspecialchars($data["tgl_rab"]);
	$id_user = htmlspecialchars($data["id_user"]);
	$fileLama = htmlspecialchars($data['file_rab_lama']);
	$rab_app1 = htmlspecialchars($data["rab_app1"]);
	$rab_app2 = htmlspecialchars($data["rab_app2"]);
	$rab_app3 = htmlspecialchars($data["rab_app3"]);
	$status_rab = htmlspecialchars($data["status_rab"]);

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['file_rab']['error'] === 4 ) {
		$file = $fileLama;
	} else {

		$file = uploadFileRab();
	}

	$query = "UPDATE rab SET
				doc_num = '$doc_num',
				tgl_rab = '$tgl_rab',
				file_rab = '$file',
				id_user = '$id_user',
				id_sales = '$id_sales',
				rab_app1 = '$rab_app1',
				rab_app2 = '$rab_app2',
				rab_app3 = '$rab_app3',
				status_rab = '$status_rab'
			  WHERE id_rab = $id_rab
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusRab($id_rab) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM rab WHERE id_rab=$id_rab");

	return mysqli_affected_rows($koneksi);

}

function approveRab1($id_rab) {
	global $koneksi;
	$rab_app1 = "Bambang Wahyudi";	
	$status_rab = "On Dirut";	

	$query = "UPDATE rab SET
				rab_app1 = '$rab_app1',
				status_rab = '$status_rab'
			  WHERE id_rab = $id_rab
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function reviseRab1($id_rab) {
	global $koneksi;
	$rab_app1 = "";	
	$status_rab = "Revise";	

	$query = "UPDATE rab SET
				rab_app1 = '$rab_app1',
				status_rab = '$status_rab'
			  WHERE id_rab = $id_rab
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectRab1($id_rab) {
	global $koneksi;
	$status_rab = "Reject";	

	$query = "UPDATE rab SET
				status_rab = '$status_rab'
			  WHERE id_rab = $id_rab
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function approveRab2($id_rab) {
	global $koneksi;
	$rab_app2 = "Raden Sulaiman Sanjeev";	
	$status_rab = "On Dirkeu";	

	$query = "UPDATE rab SET
				rab_app2 = '$rab_app2',
				status_rab = '$status_rab'
			  WHERE id_rab = $id_rab
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function reviseRab2($id_rab) {
	global $koneksi;
	$rab_app1 = "";	
	$status_rab = "Revise";	

	$query = "UPDATE rab SET
				rab_app1 = '$rab_app1',
				status_rab = '$status_rab'
			  WHERE id_rab = $id_rab
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectRab2($id_rab) {
	global $koneksi;
	$rab_app1 = "";
	$status_rab = "Reject";	

	$query = "UPDATE rab SET
				rab_app1 = '$rab_app1',
				status_rab = '$status_rab'
			  WHERE id_rab = $id_rab
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function approveRab3($id_rab) {
	global $koneksi;
	$rab_app3 = "Regina";	
	$status_rab = "Selesai";	

	$query = "UPDATE rab SET
				rab_app3 = '$rab_app3',
				status_rab = '$status_rab'
			  WHERE id_rab = $id_rab
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function reviseRab3($id_rab) {
	global $koneksi;
	$rab_app1 = "";	
	$rab_app2 = "";	
	$status_rab = "Revise";	

	$query = "UPDATE rab SET
				rab_app1 = '$rab_app1',
				rab_app2 = '$rab_app2',
				status_rab = '$status_rab'
			  WHERE id_rab = $id_rab
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectRab3($id_rab) {
	global $koneksi;
	$rab_app1 = "";
	$rab_app2 = "";
	$status_rab = "Reject";	

	$query = "UPDATE rab SET
				rab_app1 = '$rab_app1',
				rab_app2 = '$rab_app2',
				status_rab = '$status_rab'
			  WHERE id_rab = $id_rab
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function generate_kode_pengajuan() {
  global $koneksi;

  // Ambil nilai auto increment terakhir
  $query = "SELECT MAX(CAST(SUBSTRING(kode_pengajuan, 13, 5) AS SIGNED)) AS kode_terakhir FROM req_barang";
  $result = mysqli_query($koneksi, $query);
  $row = mysqli_fetch_assoc($result);
  $kode_terakhir = $row['kode_terakhir'];

  // Generate kode pengajuan baru
  $kode_baru = "REQ-" . date('ymd');
  if ($kode_terakhir !== null) {
    $kode_baru .= sprintf("%05d", $kode_terakhir + 1);
  } else {
    $kode_baru .= "00001";
  }

  // Generate angka random
  $angka_random = random_int(10000, 99999);

  // Cek apakah angka random sudah pernah digunakan
  $query = "SELECT kode_pengajuan FROM req_barang WHERE kode_pengajuan LIKE 'REQ-%' AND RIGHT(kode_pengajuan, 5) = '$angka_random'";
  $result = mysqli_query($koneksi, $query);
  while (mysqli_num_rows($result) > 0) {
    // Jika sudah pernah digunakan, generate angka random lagi
    $angka_random = random_int(10000, 99999);
    $query = "SELECT kode_pengajuan FROM req_barang WHERE kode_pengajuan LIKE 'REQ-%' AND RIGHT(kode_pengajuan, 5) = '$angka_random'";
    $result = mysqli_query($koneksi, $query);
  }

  // Tambahkan angka random ke kode pengajuan
  $kode_baru .= "-" . $angka_random;

  return $kode_baru;
}



function tambahPengajuan($data) {

	global $koneksi;
	$kode_pengajuan = generate_kode_pengajuan();
	$kode_brg = htmlspecialchars($data["kode_brg"]);
	$qty_req = htmlspecialchars($data["qty_req"]);
	$tgl_req_brg = htmlspecialchars($data["tgl_req_brg"]);
	$alasan = htmlspecialchars($data["alasan"]);
	$status_req = htmlspecialchars($data["status_req"]);
	$id_lokasi = htmlspecialchars($data["id_lokasi"]);
	$id_room = htmlspecialchars($data["id_room"]);
	$id_satuan = htmlspecialchars($data["id_satuan"]);
	$id_user = mysqli_real_escape_string($koneksi, $_SESSION["id_user"]);

	$query = "INSERT INTO req_barang VALUES
			('', '$kode_pengajuan', '$kode_brg', '$qty_req', '$tgl_req_brg', '$alasan', '$status_req', '', '', '', '$id_lokasi', '$id_room', '$id_user', '$id_satuan')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);


}


function ubahPengajuan($data) {
	global $koneksi;
	$id_req_brg = $data["id_req_brg"];
	$kode_pengajuan = htmlspecialchars($data['kode_pengajuan']);
	$kode_brg = htmlspecialchars($data["kode_brg"]);
	$qty_req = htmlspecialchars($data["qty_req"]);
	$tgl_req_brg = htmlspecialchars($data["tgl_req_brg"]);
	$alasan = htmlspecialchars($data["alasan"]);
	$status_req = htmlspecialchars($data["status_req"]);
	$id_lokasi = htmlspecialchars($data["id_lokasi"]);
	$id_room = htmlspecialchars($data["id_room"]);
	$id_satuan = htmlspecialchars($data["id_satuan"]);


	$query = "UPDATE req_barang SET
				kode_pengajuan = '$kode_pengajuan',
				kode_brg = '$kode_brg',
				qty_req = '$qty_req',
				tgl_req_brg = '$tgl_req_brg',
				alasan = '$alasan',
				status_req = '$status_req',
				id_lokasi = '$id_lokasi',
				id_room = '$id_room',
				id_satuan = '$id_satuan'
			  WHERE id_req_brg = $id_req_brg
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}


function ubahApprove($data) {
	global $koneksi;
	$id_req_brg = $data["id_req_brg"];
	$kode_pengajuan = htmlspecialchars($data['kode_pengajuan']);
	$kode_brg = htmlspecialchars($data["kode_brg"]);
	$qty_req = htmlspecialchars($data["qty_req"]);
	$tgl_req_brg = htmlspecialchars($data["tgl_req_brg"]);
	$alasan = htmlspecialchars($data["alasan"]);
	$status_req = htmlspecialchars($data["status_req"]);
	$id_lokasi = htmlspecialchars($data["id_lokasi"]);
	$id_room = htmlspecialchars($data["id_room"]);
	$acc1 = htmlspecialchars($data["acc1"]);


	$query = "UPDATE req_barang SET
				kode_pengajuan = '$kode_pengajuan',
				kode_brg = '$kode_brg',
				qty_req = '$qty_req',
				tgl_req_brg = '$tgl_req_brg',
				alasan = '$alasan',
				status_req = '$status_req',
				id_lokasi = '$id_lokasi',
				id_room = '$id_room',
				acc1 = '$acc1'
			  WHERE id_req_brg = $id_req_brg
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function ubahApprove2($data) {
	global $koneksi;
	$id_req_brg = $data["id_req_brg"];
	$kode_pengajuan = htmlspecialchars($data['kode_pengajuan']);
	$kode_brg = htmlspecialchars($data["kode_brg"]);
	$qty_req = htmlspecialchars($data["qty_req"]);
	$tgl_req_brg = htmlspecialchars($data["tgl_req_brg"]);
	$alasan = htmlspecialchars($data["alasan"]);
	$status_req = htmlspecialchars($data["status_req"]);
	$id_lokasi = htmlspecialchars($data["id_lokasi"]);
	$id_room = htmlspecialchars($data["id_room"]);
	$acc2 = htmlspecialchars($data["acc2"]);



	$query = "UPDATE req_barang SET
				kode_pengajuan = '$kode_pengajuan',
				kode_brg = '$kode_brg',
				qty_req = '$qty_req',
				tgl_req_brg = '$tgl_req_brg',
				alasan = '$alasan',
				status_req = '$status_req',
				id_lokasi = '$id_lokasi',
				id_room = '$id_room',
				acc2 = '$acc2'
			  WHERE id_req_brg = $id_req_brg
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function ubahApprove3($data) {
	global $koneksi;
	$id_req_brg = $data["id_req_brg"];
	$kode_pengajuan = htmlspecialchars($data['kode_pengajuan']);
	$kode_brg = htmlspecialchars($data["kode_brg"]);
	$qty_req = htmlspecialchars($data["qty_req"]);
	$tgl_req_brg = htmlspecialchars($data["tgl_req_brg"]);
	$alasan = htmlspecialchars($data["alasan"]);
	$status_req = htmlspecialchars($data["status_req"]);
	$id_lokasi = htmlspecialchars($data["id_lokasi"]);
	$id_room = htmlspecialchars($data["id_room"]);
	$acc3 = htmlspecialchars($data["acc3"]);



	$query = "UPDATE req_barang SET
				kode_pengajuan = '$kode_pengajuan',
				kode_brg = '$kode_brg',
				qty_req = '$qty_req',
				tgl_req_brg = '$tgl_req_brg',
				alasan = '$alasan',
				status_req = '$status_req',
				id_lokasi = '$id_lokasi',
				id_room = '$id_room',
				acc3 = '$acc3'
			  WHERE id_req_brg = $id_req_brg
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusPengajuan($id_req_brg) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM req_barang WHERE id_req_brg=$id_req_brg");

	return mysqli_affected_rows($koneksi);

}

function tambahKaryawan($data) {
	global $koneksi;
	$nama_emp = htmlspecialchars($data["nama_emp"]);
	$id_jabatan = htmlspecialchars($data["id_jabatan"]);
	$id_divisi = htmlspecialchars($data["id_divisi"]);
	$status = htmlspecialchars($data["status"]);
	$tgl_lahir = htmlspecialchars($data["tgl_lahir"]);
	$tempat = htmlspecialchars($data["tempat"]);
	$jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$no_hp = htmlspecialchars($data["no_hp"]);
	$email = htmlspecialchars($data["email"]);
	$status_p = htmlspecialchars($data["status_pernikahan"]);
	$nik = htmlspecialchars($data["nik"]);
	$npwp = htmlspecialchars($data["npwp"]);
	$norek_mandiri = htmlspecialchars($data["norek_mandiri"]);

	// upload gambar
	$gambar =  upload();
	if (!$gambar) {
		return false;
	}

	$query = "INSERT INTO karyawan VALUES
			('', '$nama_emp', '$id_jabatan', '$id_divisi', '$status', '$gambar', '$tgl_lahir', '$tempat', '$jenis_kelamin', '$alamat', '$no_hp', '$email', '$status_p', '$nik', '$npwp', '$norek_mandiri')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function upload(){

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih gambar terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid) ){
		echo "
			<script>
				alert('yang anda upload bukan gambar!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran gambar terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/'. $namaFileBaru);
	return $namaFileBaru;
 }

function ubahKaryawan($data) {
	global $koneksi;
	$id_emp = $data["id_emp"];
	$nama_emp = htmlspecialchars($data["nama_emp"]);
	$id_jabatan = htmlspecialchars($data["id_jabatan"]);
	$id_divisi = htmlspecialchars($data["id_divisi"]);
	$status = htmlspecialchars($data["status"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);
	$tgl_lahir = htmlspecialchars($data["tgl_lahir"]);
	$tempat = htmlspecialchars($data["tempat"]);
	$jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$no_hp = htmlspecialchars($data["no_hp"]);
	$email = htmlspecialchars($data["email"]);
	$status_p = htmlspecialchars($data["status_pernikahan"]);
	$nik = htmlspecialchars($data["nik"]);
	$npwp = htmlspecialchars($data["npwp"]);
	$norek_mandiri = htmlspecialchars($data["norek_mandiri"]);

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar']['error'] === 4 ) {
		$gambar = $gambarLama;
	} else {

		$gambar = upload();
	}


	$query = "UPDATE karyawan SET
				nama_emp = '$nama_emp',
				id_jabatan = '$id_jabatan',
				id_divisi = '$id_divisi',
				status = '$status',
				gambar = '$gambar',
				tgl_lahir = '$tgl_lahir',
				tempat = '$tempat',
				jenis_kelamin = '$jenis_kelamin',
				alamat = '$alamat',
				no_hp = '$no_hp',
				email = '$email',
				status_pernikahan = '$status_p',
				nik = '$nik',
				npwp = '$npwp',
				norek_mandiri = '$norek_mandiri'
			  WHERE id_emp = $id_emp
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusKaryawan($id_emp) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM karyawan WHERE id_emp=$id_emp");

	return mysqli_affected_rows($koneksi);

}

function tambahAbsen($data) {
	global $koneksi;
	$no_absen = htmlspecialchars($data["no_absen"]);
	$id_emp = htmlspecialchars($data["id_emp"]);
	$id_lantai = htmlspecialchars($data["id_lantai"]);


	$query = "INSERT INTO absen VALUES
			('', '$no_absen', '$id_emp', '$id_lantai')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function ubahAbsen($data) {
	global $koneksi;
	$id_absen = $data["id_absen"];
	$no_absen = htmlspecialchars($data["no_absen"]);
	$id_emp = htmlspecialchars($data["id_emp"]);
	$id_lantai = htmlspecialchars($data["id_lantai"]);


	$query = "UPDATE absen SET
				no_absen = '$no_absen',
				id_emp = '$id_emp',
				id_lantai = '$id_lantai'
			  WHERE id_absen = $id_absen
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusAbsen($id_absen) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM absen WHERE id_absen=$id_absen");

	return mysqli_affected_rows($koneksi);

}

function tambahAkses($data) {
	global $koneksi;
	$no_akses = htmlspecialchars($data["no_akses"]);
	$id_emp = htmlspecialchars($data["id_emp"]);
	$id_lantai = htmlspecialchars($data["id_lantai"]);


	$query = "INSERT INTO akses_pintu VALUES
			('', '$no_akses', '$id_emp', '$id_lantai')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function ubahAkses($data) {
	global $koneksi;
	$id_akses = $data["id_akses"];
	$no_akses = htmlspecialchars($data["no_akses"]);
	$id_emp = htmlspecialchars($data["id_emp"]);
	$id_lantai = htmlspecialchars($data["id_lantai"]);


	$query = "UPDATE akses_pintu SET
				no_akses = '$no_akses',
				id_emp = '$id_emp',
				id_lantai = '$id_lantai'
			  WHERE id_akses = $id_akses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusAkses($id_akses) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM akses_pintu WHERE id_akses=$id_akses");

	return mysqli_affected_rows($koneksi);

}

function tambahLogin($data){
	global $koneksi;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
	$id_emp	= mysqli_real_escape_string($koneksi, $data["id_emp"]);	
	$level	= mysqli_real_escape_string($koneksi, $data["level"]);	

	// cek username sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT username FROM user WHERE username= '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Daftar Akun Gagal',
				text                :  'Username yang dipilih sudah terdaftar',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=userLogin'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>";
		// echo "
		// 	<script>
		// 		alert('Username yang dipilih sudah terdaftar!');
		// 	</script>
		// ";
		return false;
	}

	// cek konfirmasi password
	if ($password !== $password2) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Daftar Akun Gagal',
				text                :  'Konfirmasi Password Tidak Sesuai!',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = '?page=userLogin'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>";
		// echo "
		// 	<script>
		// 		alert('konfirmasi password tidak sesuai!');
		// 	</script>
		// ";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);


	// tambahkan user baru ke database
	mysqli_query($koneksi, "INSERT INTO user VALUES('', '$username', '$password', '$level', '$id_emp')");

	return mysqli_affected_rows($koneksi);
}

function ubahLogin($data) {
	global $koneksi;
	$id_user = $data["id_user"];
	$username = htmlspecialchars($data["username"]);
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
	$level = htmlspecialchars($data['level']);
	$id_emp = htmlspecialchars($data["id_emp"]);

	$password2 = password_hash($password, PASSWORD_DEFAULT);

	$query = "UPDATE user SET
				username = '$username',
				password = '$password2',
				level = '$level',
				id_emp = '$id_emp'
			  WHERE id_user = $id_user
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}


function hapusLogin($id_user) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM user WHERE id_user=$id_user");

	return mysqli_affected_rows($koneksi);

}

function changePassword($data) {
	global $koneksi;
	$id_user = $data["id_user"];
	$username = htmlspecialchars($data["username"]);
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
	$level = htmlspecialchars($data['level']);
	$id_emp = htmlspecialchars($data["id_emp"]);

	$password2 = password_hash($password, PASSWORD_DEFAULT);

	$query = "UPDATE user SET
				username = '$username',
				password = '$password2',
				level = '$level',
				id_emp = '$id_emp'
			  WHERE id_user = $id_user
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function tambahIjazah($data) {
	global $koneksi;
	$no_ijazah = htmlspecialchars($data["no_ijazah"]);
	$tgl_penitipan = htmlspecialchars($data["tgl_penitipan"]);
	$tgl_kembali = htmlspecialchars($data["tgl_kembali"]);
	$status_ijazah = htmlspecialchars($data["status_ijazah"]);
	$id_emp = htmlspecialchars($data["id_emp"]);

	$file =  uploadFile();
	if (!$file) {
		return false;
	}

	$query = "INSERT INTO ijazah VALUES
			('', '$no_ijazah', '$tgl_penitipan', '$tgl_kembali', '$status_ijazah', '$file', '$id_emp')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function uploadFile(){

	$namaFile = $_FILES['scan_ijazah']['name'];
	$ukuranFile = $_FILES['scan_ijazah']['size'];
	$error = $_FILES['scan_ijazah']['error'];
	$tmpName = $_FILES['scan_ijazah']['tmp_name'];

	// cek apakah tidak ada file yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih file terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah pdf
	$ekstensiFileValid = ['pdf'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid) ){
		echo "
			<script>
				alert('yang anda upload bukan pdf!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran pdf terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, pdf siap diupload
	// generate nama pdf baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'files/ijazah/'. $namaFileBaru);
	return $namaFileBaru;
 }

function ubahIjazah($data) {
	global $koneksi;
	$id_ijazah = $data["id_ijazah"];
	$no_ijazah = htmlspecialchars($data["no_ijazah"]);
	$tgl_penitipan = htmlspecialchars($data["tgl_penitipan"]);
	$tgl_kembali = htmlspecialchars($data["tgl_kembali"]);
	$status_ijazah = htmlspecialchars($data["status_ijazah"]);
	$fileLama = htmlspecialchars($data['scan_ijazah_lama']);
	$id_emp = htmlspecialchars($data["id_emp"]);

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['scan_ijazah']['error'] === 4 ) {
		$file = $fileLama;
	} else {

		$file = uploadFile();
	}

	$query = "UPDATE ijazah SET
				no_ijazah = '$no_ijazah',
				tgl_penitipan = '$tgl_penitipan',
				tgl_kembali = '$tgl_kembali',
				status_ijazah = '$status_ijazah',
				scan_ijazah = '$file',
				id_emp = '$id_emp'
			  WHERE id_ijazah = $id_ijazah
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusIjazah($id_ijazah) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM ijazah WHERE id_ijazah=$id_ijazah");

	return mysqli_affected_rows($koneksi);

}

function tambahSlip($data) {
	global $koneksi;
	$periode = htmlspecialchars($data["periode"]);
	$tgl_terbit = htmlspecialchars($data["tgl_terbit"]);
	$id_emp = htmlspecialchars($data["id_emp"]);

	// Modifikasi format periode
	// $periode = date("Y-m-01", strtotime($periode));

	$file =  uploadSlip();
	if (!$file) {
		return false;
	}

	$query = "INSERT INTO slip_gaji VALUES
			('', '$id_emp', '$periode', '$tgl_terbit', '$file')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function uploadSlip(){

	$namaFile = $_FILES['slip_gaji']['name'];
	$ukuranFile = $_FILES['slip_gaji']['size'];
	$error = $_FILES['slip_gaji']['error'];
	$tmpName = $_FILES['slip_gaji']['tmp_name'];

	// cek apakah tidak ada file yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih file terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah pdf
	$ekstensiFileValid = ['pdf'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid) ){
		echo "
			<script>
				alert('yang anda upload bukan pdf!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran pdf terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, pdf siap diupload
	// generate nama pdf baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'files/slip_gaji/'. $namaFileBaru);
	return $namaFileBaru;
 }

 function ubahSlip($data) {
	global $koneksi;
	$id_slip = $data["id_slip"];
	$periode = htmlspecialchars($data["periode"]);
	$tgl_terbit = htmlspecialchars($data["tgl_terbit"]);
	$id_emp = htmlspecialchars($data["id_emp"]);
	$fileLama = htmlspecialchars($data['slip_gaji_lama']);

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['slip_gaji']['error'] === 4 ) {
		$file = $fileLama;
	} else {

		$file = uploadSlip();
	}

	$query = "UPDATE slip_gaji SET
				id_emp = '$id_emp',
				periode = '$periode',
				tgl_terbit = '$tgl_terbit',
				slip_gaji = '$file'
			  WHERE id_slip = $id_slip
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}


function tambahKontrak($data) {
	global $koneksi;
	$tgl_mulai = htmlspecialchars($data["tgl_mulai"]);
	$tgl_akhir = htmlspecialchars($data["tgl_akhir"]);
	$gaji_pokok = htmlspecialchars($data["gaji_pokok"]);
	$tunjangan = htmlspecialchars($data["tunjangan"]);
	$status_kontrak = htmlspecialchars($data["status_kontrak"]);
	$id_emp = htmlspecialchars($data["id_emp"]);


	$query = "INSERT INTO kontrak_kerja VALUES
			('', '$tgl_mulai', '$tgl_akhir', '$gaji_pokok', '$tunjangan', '$status_kontrak', '$id_emp')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function ubahKontrak($data) {
	global $koneksi;
	$id_kontrak = $data["id_kontrak"];
	$tgl_mulai = htmlspecialchars($data["tgl_mulai"]);
	$tgl_akhir = htmlspecialchars($data["tgl_akhir"]);
	$gaji_pokok = htmlspecialchars($data["gaji_pokok"]);
	$tunjangan = htmlspecialchars($data["tunjangan"]);
	$status_kontrak = htmlspecialchars($data["status_kontrak"]);
	$id_emp = htmlspecialchars($data["id_emp"]);


	$query = "UPDATE kontrak_kerja SET
				tgl_mulai = '$tgl_mulai',
				tgl_akhir = '$tgl_akhir',
				gaji_pokok = '$gaji_pokok',
				tunjangan = '$tunjangan',
				status_kontrak = '$status_kontrak',
				id_emp = '$id_emp'
			  WHERE id_kontrak = $id_kontrak
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusKontrak($id_kontrak) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM kontrak_kerja WHERE id_kontrak=$id_kontrak");

	return mysqli_affected_rows($koneksi);

}

function tambahManageCuti($data) {
	global $koneksi;
	$id_kategori_cuti = htmlspecialchars($data["id_kategori_cuti"]);
	$kuota_cuti = htmlspecialchars($data["kuota_cuti"]);
	$id_emp = htmlspecialchars($data["id_emp"]);


	$query = "INSERT INTO manage_cuti VALUES
			('', '$id_kategori_cuti', '$kuota_cuti', '$id_emp')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function ubahManageCuti($data) {
	global $koneksi;
	$id_manage_cuti = $data["id_manage_cuti"];
	$id_kategori_cuti = htmlspecialchars($data["id_kategori_cuti"]);
	$kuota_cuti = htmlspecialchars($data["kuota_cuti"]);
	$id_emp = htmlspecialchars($data["id_emp"]);


	$query = "UPDATE manage_cuti SET
				id_kategori_cuti = '$id_kategori_cuti',
				kuota_cuti = '$kuota_cuti',
				id_emp = '$id_emp'
			  WHERE id_manage_cuti = $id_manage_cuti
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusManageCuti($id_manage_cuti) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM manage_cuti WHERE id_manage_cuti=$id_manage_cuti");

	return mysqli_affected_rows($koneksi);

}

function tambahRequestCuti($data) {
	global $koneksi;

	$tgl_mulai = htmlspecialchars($data["tgl_mulai"]);
	$tgl_akhir = htmlspecialchars($data["tgl_akhir"]);
	$jml_hari = htmlspecialchars($data["jml_hari"]);
	$tipe_cuti = htmlspecialchars($data["tipe_cuti"]);
	$alasan = htmlspecialchars($data["alasan"]);
	$status_cuti = htmlspecialchars($data["status_cuti"]);
	$created_at = htmlspecialchars($data["created_at"]);
	$updated_at = htmlspecialchars($data["updated_at"]);
	$id_kategori_cuti = htmlspecialchars($data["id_kategori_cuti"]);
	$id_emp = htmlspecialchars($data["id_emp"]);


	$query = "INSERT INTO req_cuti VALUES
			('', '$tgl_mulai', '$tgl_akhir', '$jml_hari', '$tipe_cuti', '$alasan', '$status_cuti', '$created_at', '$updated_at', '$id_emp', '$id_kategori_cuti')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function ubahRequestCuti($data) {
	global $koneksi;
	$id_req_cuti = $data["id_req_cuti"];
	$tgl_mulai = htmlspecialchars($data["tgl_mulai"]);
	$tgl_akhir = htmlspecialchars($data["tgl_akhir"]);
	$jml_hari = htmlspecialchars($data["jml_hari"]);
	$tipe_cuti = htmlspecialchars($data["tipe_cuti"]);
	$alasan = htmlspecialchars($data["alasan"]);
	$status_cuti = htmlspecialchars($data["status_cuti"]);
	$created_at = htmlspecialchars($data["created_at"]);
	$updated_at = htmlspecialchars($data["updated_at"]);
	$id_kategori_cuti = htmlspecialchars($data["id_kategori_cuti"]);
	$id_emp = htmlspecialchars($data["id_emp"]);


	$query = "UPDATE req_cuti SET
				tgl_mulai = '$tgl_mulai',
				tgl_akhir = '$tgl_akhir',
				jml_hari = '$jml_hari',
				tipe_cuti = '$tipe_cuti',
				alasan = '$alasan',
				status_cuti = '$status_cuti',
				created_at = '$created_at',
				updated_at = '$updated_at',
				id_emp = '$id_emp',
				id_kategori_cuti = '$id_kategori_cuti'
			  WHERE id_req_cuti = $id_req_cuti
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusRequestCuti($id_req_cuti) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM req_cuti WHERE id_req_cuti=$id_req_cuti");

	return mysqli_affected_rows($koneksi);

}

function tambahOnduty($data) {
	global $koneksi;

	$tgl_duty = htmlspecialchars($data["tgl_duty"]);
	$waktu_duty = htmlspecialchars($data["waktu_duty"]);
	$tujuan_duty = htmlspecialchars($data["tujuan_duty"]);
	$alasan_duty = htmlspecialchars($data["alasan_duty"]);
	$status_duty = htmlspecialchars($data["status_duty"]);
	$id_emp = htmlspecialchars($data["id_emp"]);


	$query = "INSERT INTO on_duty VALUES
			('', '$tgl_duty', '$waktu_duty', '$tujuan_duty', '$alasan_duty', '$status_duty', '$id_emp')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function ubahOnduty($data) {
	global $koneksi;
	$id_duty = htmlspecialchars($data['id_duty']);
	$tgl_duty = mysqli_real_escape_string($koneksi, $data["tgl_duty"]);
	$waktu_duty = mysqli_real_escape_string($koneksi, $data["waktu_duty"]);
	$tujuan_duty = mysqli_real_escape_string($koneksi, $data["tujuan_duty"]);
	$alasan_duty = mysqli_real_escape_string($koneksi, $data["alasan_duty"]);
	$status_duty = mysqli_real_escape_string($koneksi, $data["status_duty"]);
	$id_emp = mysqli_real_escape_string($koneksi, $data["id_emp"]);


	$query = "UPDATE on_duty SET
				tgl_duty = '$tgl_duty',
				waktu_duty = '$waktu_duty',
				tujuan_duty = '$tujuan_duty',
				alasan_duty = '$alasan_duty',
				status_duty = '$status_duty'
			  WHERE id_duty = $id_duty
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusOnduty($id_duty) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM on_duty WHERE id_duty=$id_duty");

	return mysqli_affected_rows($koneksi);

}

function approveOnduty($id_duty) {
	global $koneksi;	
	$status_duty = "Approved";	

	$query = "UPDATE on_duty SET
				status_duty = '$status_duty'
			  WHERE id_duty = $id_duty
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectOnduty($id_duty) {
	global $koneksi;	
	$status_duty = "Rejected";	

	$query = "UPDATE on_duty SET
				status_duty = '$status_duty'
			  WHERE id_duty = $id_duty
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}


function approveCuti($data) {
    global $koneksi;
    $id_req_cuti = $data["id_req_cuti"];
    $tgl_mulai = htmlspecialchars($data["tgl_mulai"]);
    $tgl_akhir = htmlspecialchars($data["tgl_akhir"]);
    $jml_hari = htmlspecialchars($data["jml_hari"]);
    $tipe_cuti = htmlspecialchars($data["tipe_cuti"]);
    $alasan = htmlspecialchars($data["alasan"]);
    $status_cuti = htmlspecialchars($data["status_cuti"]);
    $created_at = htmlspecialchars($data["created_at"]);
    $updated_at = htmlspecialchars($data["updated_at"]);
    $id_kategori_cuti = htmlspecialchars($data["id_kategori_cuti"]);
    $id_emp = htmlspecialchars($data["id_emp"]);

    // Jika status cuti sudah diapprove
    if ($status_cuti == "Approved") {

        // Ambil data manage_cuti berdasarkan id_emp dan id_kategori_cuti
        $manage_cuti = mysqli_query($koneksi, "SELECT * FROM manage_cuti WHERE id_emp = $id_emp AND id_kategori_cuti = $id_kategori_cuti");

        // Jika data manage_cuti ada
        if (mysqli_num_rows($manage_cuti) > 0) {

            // Ambil data manage_cuti
            $data_manage_cuti = mysqli_fetch_assoc($manage_cuti);

            // Kurangi kuota cuti
            $kuota_cuti = $data_manage_cuti['kuota_cuti'] - $jml_hari;

            // Update kuota cuti
            mysqli_query($koneksi, "UPDATE manage_cuti SET kuota_cuti = $kuota_cuti WHERE id_emp = $id_emp AND id_kategori_cuti = $id_kategori_cuti");
        }
    }

    // Update data req_cuti
    $query = "UPDATE req_cuti SET
                tgl_mulai = '$tgl_mulai',
                tgl_akhir = '$tgl_akhir',
                jml_hari = '$jml_hari',
                tipe_cuti = '$tipe_cuti',
                alasan = '$alasan',
                status_cuti = '$status_cuti',
                created_at = '$created_at',
                updated_at = '$updated_at',
                id_emp = '$id_emp',
                id_kategori_cuti = '$id_kategori_cuti'
           	WHERE id_req_cuti = $id_req_cuti
            ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function rejectCuti($data) {
    global $koneksi;
    $id_req_cuti = $data["id_req_cuti"];
    $tgl_mulai = htmlspecialchars($data["tgl_mulai"]);
    $tgl_akhir = htmlspecialchars($data["tgl_akhir"]);
    $jml_hari = htmlspecialchars($data["jml_hari"]);
    $tipe_cuti = htmlspecialchars($data["tipe_cuti"]);
    $alasan = htmlspecialchars($data["alasan"]);
    $status_cuti = htmlspecialchars($data["status_cuti"]);
    $created_at = htmlspecialchars($data["created_at"]);
    $updated_at = htmlspecialchars($data["updated_at"]);
    $id_kategori_cuti = htmlspecialchars($data["id_kategori_cuti"]);
    $id_emp = htmlspecialchars($data["id_emp"]);


    // Update data req_cuti
    $query = "UPDATE req_cuti SET
                tgl_mulai = '$tgl_mulai',
                tgl_akhir = '$tgl_akhir',
                jml_hari = '$jml_hari',
                tipe_cuti = '$tipe_cuti',
                alasan = '$alasan',
                status_cuti = '$status_cuti',
                created_at = '$created_at',
                updated_at = '$updated_at',
                id_emp = '$id_emp',
                id_kategori_cuti = '$id_kategori_cuti'
           	WHERE id_req_cuti = $id_req_cuti
            ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


function generate_kode_barang() {
  global $koneksi;
  
  // Ambil nilai auto increment terakhir
  $query = "SELECT MAX(CAST(SUBSTRING(kode_brg, 4) AS SIGNED)) AS kode_terakhir FROM barang";
  $result = mysqli_query($koneksi, $query);
  $row = mysqli_fetch_assoc($result);
  $kode_terakhir = $row['kode_terakhir'];

  // Generate kode barang baru
  $kode_baru = "BRG";
  if ($kode_terakhir !== null) {
    $kode_baru .= sprintf("%05d", $kode_terakhir + 1);
  } else {
    $kode_baru .= "00001";
  }

  return $kode_baru;
}

function tambahBarang($data) {
	global $koneksi;

	$kode_brg = generate_kode_barang();
	$nama_barang = htmlspecialchars($data["nama_barang"]);
	$spek = htmlspecialchars($data["spek"]);
	$deskripsi = htmlspecialchars($data["deskripsi"]);
	// $stok_barang = htmlspecialchars($data["stok_barang"]);

	$gambar_barang =  uploadGambarBarang();
	if (!$gambar_barang) {
		return false;
	}

	$query = "INSERT INTO barang VALUES
			('$kode_brg', '$nama_barang', '$gambar_barang', '$spek', '$deskripsi')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

//  function hapusBarang($kode_brg) {
// 	global $koneksi;
// 	mysqli_query($koneksi, "DELETE FROM barang WHERE kode_brg='$kode_brg'");

// 	return mysqli_affected_rows($koneksi);

// }
function hapusBarang($kode_brg) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM barang WHERE kode_brg='$kode_brg'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function ubahBarang($data) {
	global $koneksi;
	// $kode_brg_lama = $data["kode_brg_lama"];
	$kode_brg = $data["kode_brg"];
	$gambarLama = htmlspecialchars($data["gambarBarangLama"]);
	$nama_barang = htmlspecialchars($data["nama_barang"]);
	$spek = htmlspecialchars($data["spek"]);
	$deskripsi = htmlspecialchars($data["deskripsi"]);
	// $stok_barang = htmlspecialchars($data["stok_barang"]);
	
	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar_barang']['error'] === 4 ) {
		$gambar_barang = $gambarLama;
	} else {

		$gambar_barang = uploadGambarBarang();
	}


	$query = "UPDATE barang SET
				kode_brg = '$kode_brg',
				nama_barang = '$nama_barang',
				gambar_barang = '$gambar_barang',
				spek = '$spek',
				deskripsi = '$deskripsi'
			  WHERE kode_brg = '$kode_brg'
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}


function uploadGambarBarang(){

	$namaFile = $_FILES['gambar_barang']['name'];
	$ukuranFile = $_FILES['gambar_barang']['size'];
	$error = $_FILES['gambar_barang']['error'];
	$tmpName = $_FILES['gambar_barang']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih gambar terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid) ){
		echo "
			<script>
				alert('yang anda upload bukan gambar!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran gambar terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/barang/'. $namaFileBaru);
	return $namaFileBaru;
 }



function tambahInventaris($data) {
	global $koneksi;

	$tgl_input = htmlspecialchars($data['tgl_input']);
	$qty_brg = htmlspecialchars($data['qty_brg']);
	$kondisi_brg = htmlspecialchars($data["kondisi_brg"]);
	$ket_kondisi = htmlspecialchars($data["ket_kondisi"]);
	$kode_brg = htmlspecialchars($data["kode_brg"]);
	$id_room = htmlspecialchars($data["id_room"]);
	$id_lokasi = htmlspecialchars($data["id_lokasi"]);
	$id_satuan = htmlspecialchars($data["id_satuan"]);
	$id_user = htmlspecialchars($_SESSION['id_user']);


	$query = "INSERT INTO storage_barang VALUES
			('', '$tgl_input', '$qty_brg', '$kondisi_brg', '$ket_kondisi', '$kode_brg', '$id_lokasi', '$id_satuan', '$id_room', '$id_user')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}


function ubahInventaris($data) {
	global $koneksi;
	$id_storage = htmlspecialchars($data['id_storage']);
	$tgl_input = htmlspecialchars($data['tgl_input']);
	$qty_brg = htmlspecialchars($data['qty_brg']);
	$kondisi_brg = htmlspecialchars($data["kondisi_brg"]);
	$ket_kondisi = htmlspecialchars($data["ket_kondisi"]);
	$kode_brg = htmlspecialchars($data["kode_brg"]);
	$id_room = htmlspecialchars($data["id_room"]);
	$id_lokasi = htmlspecialchars($data["id_lokasi"]);
	$id_satuan = htmlspecialchars($data["id_satuan"]);


	$query = "UPDATE storage_barang SET
				tgl_input = '$tgl_input',
				qty_brg = '$qty_brg',
				kondisi_brg = '$kondisi_brg',
				ket_kondisi = '$ket_kondisi',
				kode_brg = '$kode_brg',
				id_lokasi = '$id_lokasi',
				id_satuan = '$id_satuan',
				id_room = '$id_room'
			  WHERE id_storage = $id_storage
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusInventaris($id_storage) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM storage_barang WHERE id_storage=$id_storage");

	return mysqli_affected_rows($koneksi);

}

function tambahVendor($data) {
	global $koneksi;
	$nama_vendor = htmlspecialchars($data["nama_vendor"]);
	$no_telp_vendor = htmlspecialchars($data["no_telp_vendor"]);


	$query = "INSERT INTO vendor VALUES
			('', '$nama_vendor', '$no_telp_vendor')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function ubahVendor($data) {
	global $koneksi;
	$id_vendor = $data["id_vendor"];
	$nama_vendor = htmlspecialchars($data["nama_vendor"]);
	$no_telp_vendor = htmlspecialchars($data["no_telp_vendor"]);


	$query = "UPDATE vendor SET
				nama_vendor = '$nama_vendor',
				no_telp_vendor = '$no_telp_vendor'
			  WHERE id_vendor = $id_vendor
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusVendor($id_vendor) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM vendor WHERE id_vendor=$id_vendor");

	return mysqli_affected_rows($koneksi);

}

function tambahLokasi($data) {
	global $koneksi;
	$nama_lokasi = htmlspecialchars($data["nama_lokasi"]);

	$query = "INSERT INTO lokasi_barang VALUES
			('', '$nama_lokasi')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function ubahLokasi($data) {
	global $koneksi;
	$id_lokasi = $data["id_lokasi"];
	$nama_lokasi = htmlspecialchars($data["nama_lokasi"]);

	$query = "UPDATE lokasi_barang SET
				nama_lokasi = '$nama_lokasi'
			  WHERE id_lokasi = $id_lokasi
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusLokasi($id_lokasi) {
	global $koneksi;


	try{
		mysqli_query($koneksi, "DELETE FROM lokasi_barang WHERE id_lokasi=$id_lokasi");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function tambahRuangan($data) {
	global $koneksi;
	$room_name = htmlspecialchars($data["room_name"]);

	$query = "INSERT INTO lokasi_room VALUES
			('', '$room_name')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function ubahRuangan($data) {
	global $koneksi;
	$id_room = $data["id_room"];
	$room_name = htmlspecialchars($data["room_name"]);

	$query = "UPDATE lokasi_room SET
				room_name = '$room_name'
			  WHERE id_room = $id_room
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusRuangan($id_room) {
	global $koneksi;


	try{
		mysqli_query($koneksi, "DELETE FROM lokasi_room WHERE id_room=$id_room");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}


function tambahSatuan($data) {
	global $koneksi;
	$nama_satuan = htmlspecialchars($data["nama_satuan"]);

	$query = "INSERT INTO satuan VALUES
			('', '$nama_satuan')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function ubahSatuan($data) {
	global $koneksi;
	$id_satuan = $data["id_satuan"];
	$nama_satuan = htmlspecialchars($data["nama_satuan"]);

	$query = "UPDATE satuan SET
				nama_satuan = '$nama_satuan'
			  WHERE id_satuan = $id_satuan
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusSatuan($id_satuan) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM satuan WHERE id_satuan=$id_satuan");

	return mysqli_affected_rows($koneksi);

}

function ajukanPO($data) {
	global $koneksi;

	$id_req_brg = htmlspecialchars($data['id_req_brg']);
	$tgl_po = htmlspecialchars($data['tgl_po']);
	$qty_po = htmlspecialchars($data["qty_po"]);
	$harga_po = htmlspecialchars($data["harga_po"]);
	$ket_po = htmlspecialchars($data["ket_po"]);
	$acc3 = htmlspecialchars($data["acc3"]);
	$acc4 = htmlspecialchars($data["acc4"]);
	$acc5 = htmlspecialchars($data["acc5"]);
	$id_vendor = htmlspecialchars($data["id_vendor"]);
	$id_user = htmlspecialchars($_SESSION['id_user']);
	$id_no_po = htmlspecialchars($data['id_no_po']);


	$query = "INSERT INTO po_barang VALUES
			('', '$id_req_brg', '$tgl_po', '$qty_po', '$harga_po', '$ket_po', '$acc3', '$acc4', '$acc5', '$id_vendor', '$id_user', '$id_no_po')";
	mysqli_query($koneksi, $query);

	// Mengupdate status_req di tabel req_barang
	// $query_update = "UPDATE req_barang SET status_req = 'Menunggu Persetujuan Dir. HRD' WHERE id_req_brg = $id_req_brg AND req_barang.kode_brg=req_barang.kode_brg";
	$query_update = "UPDATE req_barang 
                 SET status_req = 'Menunggu Persetujuan Dir. HRD' 
                 WHERE kode_brg = (SELECT kode_brg FROM req_barang WHERE id_req_brg = $id_req_brg) AND tgl_req_brg = (SELECT tgl_req_brg FROM req_barang WHERE id_req_brg = $id_req_brg)";

	mysqli_query($koneksi, $query_update);

	return mysqli_affected_rows($koneksi);
}

function ubahPengajuanPO($data) {
	global $koneksi;
	$id_po = $data["id_po"];
	$id_req_brg = htmlspecialchars($data['id_req_brg']);
	$tgl_po = htmlspecialchars($data['tgl_po']);
	$qty_po = htmlspecialchars($data["qty_po"]);
	$harga_po = htmlspecialchars($data["harga_po"]);
	$ket_po = htmlspecialchars($data["ket_po"]);
	$acc3 = htmlspecialchars($data["acc3"]);
	$acc4 = htmlspecialchars($data["acc4"]);
	$acc5 = htmlspecialchars($data["acc5"]);
	$id_vendor = htmlspecialchars($data["id_vendor"]);

	$query = "UPDATE po_barang SET
				id_req_brg = '$id_req_brg',
				tgl_po = '$tgl_po',
				qty_po = '$qty_po',
				harga_po = '$harga_po',
				ket_po = '$ket_po',
				acc3 = '$acc3',
				acc4 = '$acc4',
				acc5 = '$acc5',
				id_vendor = '$id_vendor'
			  WHERE id_po = $id_po
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusPengajuanPO($id_po) {
    global $koneksi;

    // Memulai transaksi
    mysqli_begin_transaction($koneksi);

    try {
        // Ambil kode_brg dari tabel req_barang
        $result = mysqli_query($koneksi, "SELECT kode_brg,tgl_req_brg FROM req_barang WHERE id_req_brg = (SELECT id_req_brg FROM po_barang WHERE id_po = $id_po)");
        $row = mysqli_fetch_assoc($result);
        $kode_brg = $row['kode_brg'];
        $tgl_req_brg = $row['tgl_req_brg'];
        

        // Hapus data dari tabel po_barang
        mysqli_query($koneksi, "DELETE FROM po_barang WHERE id_po=$id_po");

        // Periksa apakah penghapusan berhasil
        if (mysqli_affected_rows($koneksi) > 0) {
            // Jika berhasil, update status_req di tabel req_barang
            mysqli_query($koneksi, "UPDATE req_barang SET status_req = 'On Progress in Purchasing' WHERE kode_brg = '$kode_brg' AND tgl_req_brg = '$tgl_req_brg'");
        } else {
            // Jika gagal, rollback transaksi
            mysqli_rollback($koneksi);
            return false;
        }

        // Commit transaksi jika semuanya berhasil
        mysqli_commit($koneksi);

        return true;
    } catch (Exception $e) {
        // Jika terjadi kesalahan, rollback transaksi
        mysqli_rollback($koneksi);
        return false;
    }
}

function tambahPembelian($data) {
	global $koneksi;

	$id_req_brg = htmlspecialchars($data['id_req_brg']);
	$tgl_po = htmlspecialchars($data['tgl_po']);
	$qty_po = htmlspecialchars($data["qty_po"]);
	$harga_po = htmlspecialchars($data["harga_po"]);
	$ket_po = htmlspecialchars($data["ket_po"]);
	$acc3 = htmlspecialchars($data["acc3"]);
	$acc4 = htmlspecialchars($data["acc4"]);
	$acc5 = htmlspecialchars($data["acc5"]);
	$id_vendor = htmlspecialchars($data["id_vendor"]);
	$id_user = htmlspecialchars($_SESSION['id_user']);
	$id_invoice = htmlspecialchars($data['id_invoice']);


	$query = "INSERT INTO po_barang VALUES
			('', '$id_req_brg', '$tgl_po', '$qty_po', '$harga_po', '$ket_po', '$acc3', '$acc4', '$acc5', '$id_vendor', '$id_user', '$id_invoice')";
	mysqli_query($koneksi, $query);

	// Mengupdate status_req di tabel req_barang
	// $query_update = "UPDATE req_barang SET status_req = 'Menunggu Persetujuan Dir. HRD' WHERE id_req_brg = $id_req_brg AND req_barang.kode_brg=req_barang.kode_brg";
	$query_update = "UPDATE req_barang 
                 SET status_req = 'Menunggu Persetujuan Dir. HRD' 
                 WHERE kode_brg = (SELECT kode_brg FROM req_barang WHERE id_req_brg = $id_req_brg) AND tgl_req_brg = (SELECT tgl_req_brg FROM req_barang WHERE id_req_brg = $id_req_brg)";

	mysqli_query($koneksi, $query_update);

	return mysqli_affected_rows($koneksi);
}

function ubahPembelian($data) {
	global $koneksi;
	$id_po = $data["id_po"];
	$id_req_brg = htmlspecialchars($data['id_req_brg']);
	$tgl_po = htmlspecialchars($data['tgl_po']);
	$qty_po = htmlspecialchars($data["qty_po"]);
	$harga_po = htmlspecialchars($data["harga_po"]);
	$ket_po = htmlspecialchars($data["ket_po"]);
	$acc3 = htmlspecialchars($data["acc3"]);
	$acc4 = htmlspecialchars($data["acc4"]);
	$acc5 = htmlspecialchars($data["acc5"]);
	$id_vendor = htmlspecialchars($data["id_vendor"]);

	$query = "UPDATE po_barang SET
				id_req_brg = '$id_req_brg',
				tgl_po = '$tgl_po',
				qty_po = '$qty_po',
				harga_po = '$harga_po',
				ket_po = '$ket_po',
				acc3 = '$acc3',
				acc4 = '$acc4',
				acc5 = '$acc5',
				id_vendor = '$id_vendor'
			  WHERE id_po = $id_po
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function app1Pembelian($data) {
	global $koneksi;
	$id_po = $data["id_po"];
	$id_req_brg = htmlspecialchars($data['id_req_brg']);
	$tgl_po = htmlspecialchars($data['tgl_po']);
	$qty_po = htmlspecialchars($data["qty_po"]);
	$harga_po = htmlspecialchars($data["harga_po"]);
	$ket_po = htmlspecialchars($data["ket_po"]);
	$acc3 = htmlspecialchars($data["acc3"]);
	$acc4 = htmlspecialchars($data["acc4"]);
	$acc5 = htmlspecialchars($data["acc5"]);
	$id_vendor = htmlspecialchars($data["id_vendor"]);

	$query = "UPDATE po_barang SET
				id_req_brg = '$id_req_brg',
				tgl_po = '$tgl_po',
				qty_po = '$qty_po',
				harga_po = '$harga_po',
				ket_po = '$ket_po',
				acc3 = '$acc3',
				acc4 = '$acc4',
				acc5 = '$acc5',
				id_vendor = '$id_vendor'
			  WHERE id_po = $id_po
			";
	mysqli_query($koneksi, $query);


	$query_update = "UPDATE req_barang 
                 SET status_req = 'Menunggu Persetujuan Dir. Keuangan' 
                 WHERE kode_brg = (SELECT kode_brg FROM req_barang WHERE id_req_brg = $id_req_brg) AND tgl_req_brg = (SELECT tgl_req_brg FROM req_barang WHERE id_req_brg = $id_req_brg)";
  mysqli_query($koneksi, $query_update);

	return mysqli_affected_rows($koneksi);
}

function app2Pembelian($data) {
	global $koneksi;
	$id_po = $data["id_po"];
	$id_req_brg = htmlspecialchars($data['id_req_brg']);
	$tgl_po = htmlspecialchars($data['tgl_po']);
	$qty_po = htmlspecialchars($data["qty_po"]);
	$harga_po = htmlspecialchars($data["harga_po"]);
	$ket_po = htmlspecialchars($data["ket_po"]);
	$acc3 = htmlspecialchars($data["acc3"]);
	$acc4 = htmlspecialchars($data["acc4"]);
	$acc5 = htmlspecialchars($data["acc5"]);
	$id_vendor = htmlspecialchars($data["id_vendor"]);

	$query = "UPDATE po_barang SET
				id_req_brg = '$id_req_brg',
				tgl_po = '$tgl_po',
				qty_po = '$qty_po',
				harga_po = '$harga_po',
				ket_po = '$ket_po',
				acc3 = '$acc3',
				acc4 = '$acc4',
				acc5 = '$acc5',
				id_vendor = '$id_vendor'
			  WHERE id_po = $id_po
			";
	mysqli_query($koneksi, $query);


	$query_update = "UPDATE req_barang 
                 SET status_req = 'Menunggu Persetujuan Dir. Utama' 
                 WHERE kode_brg = (SELECT kode_brg FROM req_barang WHERE id_req_brg = $id_req_brg) AND tgl_req_brg = (SELECT tgl_req_brg FROM req_barang WHERE id_req_brg = $id_req_brg)";
  mysqli_query($koneksi, $query_update);
  
	return mysqli_affected_rows($koneksi);
}

function app3Pembelian($data) {
	global $koneksi;
	$id_po = $data["id_po"];
	$id_req_brg = htmlspecialchars($data['id_req_brg']);
	$tgl_po = htmlspecialchars($data['tgl_po']);
	$qty_po = htmlspecialchars($data["qty_po"]);
	$harga_po = htmlspecialchars($data["harga_po"]);
	$ket_po = htmlspecialchars($data["ket_po"]);
	$acc3 = htmlspecialchars($data["acc3"]);
	$acc4 = htmlspecialchars($data["acc4"]);
	$acc5 = htmlspecialchars($data["acc5"]);
	$id_vendor = htmlspecialchars($data["id_vendor"]);

	$query = "UPDATE po_barang SET
				id_req_brg = '$id_req_brg',
				tgl_po = '$tgl_po',
				qty_po = '$qty_po',
				harga_po = '$harga_po',
				ket_po = '$ket_po',
				acc3 = '$acc3',
				acc4 = '$acc4',
				acc5 = '$acc5',
				id_vendor = '$id_vendor'
			  WHERE id_po = $id_po
			";
	mysqli_query($koneksi, $query);


	$query_update = "UPDATE req_barang 
                 SET status_req = 'Selesai' 
                 WHERE kode_brg = (SELECT kode_brg FROM req_barang WHERE id_req_brg = $id_req_brg) AND tgl_req_brg = (SELECT tgl_req_brg FROM req_barang WHERE id_req_brg = $id_req_brg)";
  mysqli_query($koneksi, $query_update);
  
	return mysqli_affected_rows($koneksi);
}
// function hapusPembelian($id_po) {
// 	global $koneksi;
// 	mysqli_query($koneksi, "DELETE FROM po_barang WHERE id_po=$id_po");

// 	return mysqli_affected_rows($koneksi);

// }

 
function hapusPembelian($id_po) {
    global $koneksi;

    // Memulai transaksi
    mysqli_begin_transaction($koneksi);

    try {
        // Ambil kode_brg dari tabel req_barang
        $result = mysqli_query($koneksi, "SELECT kode_brg,tgl_req_brg FROM req_barang WHERE id_req_brg = (SELECT id_req_brg FROM po_barang WHERE id_po = $id_po)");
        $row = mysqli_fetch_assoc($result);
        $kode_brg = $row['kode_brg'];
        $tgl_req_brg = $row['tgl_req_brg'];
        

        // Hapus data dari tabel po_barang
        mysqli_query($koneksi, "DELETE FROM po_barang WHERE id_po=$id_po");

        // Periksa apakah penghapusan berhasil
        if (mysqli_affected_rows($koneksi) > 0) {
            // Jika berhasil, update status_req di tabel req_barang
            mysqli_query($koneksi, "UPDATE req_barang SET status_req = 'On Progress in Purchasing' WHERE kode_brg = '$kode_brg' AND tgl_req_brg = '$tgl_req_brg'");
        } else {
            // Jika gagal, rollback transaksi
            mysqli_rollback($koneksi);
            return false;
        }

        // Commit transaksi jika semuanya berhasil
        mysqli_commit($koneksi);

        return true;
    } catch (Exception $e) {
        // Jika terjadi kesalahan, rollback transaksi
        mysqli_rollback($koneksi);
        return false;
    }
}

function reject1Pembelian($data) {
	global $koneksi;
	$id_po = $data["id_po"];
	$id_req_brg = htmlspecialchars($data['id_req_brg']);
	$tgl_po = htmlspecialchars($data['tgl_po']);
	$qty_po = htmlspecialchars($data["qty_po"]);
	$harga_po = htmlspecialchars($data["harga_po"]);
	$ket_po = htmlspecialchars($data["ket_po"]);
	$acc3 = htmlspecialchars($data["acc3"]);
	$acc4 = htmlspecialchars($data["acc4"]);
	$acc5 = htmlspecialchars($data["acc5"]);
	$id_vendor = htmlspecialchars($data["id_vendor"]);

	$query = "UPDATE po_barang SET
				id_req_brg = '$id_req_brg',
				tgl_po = '$tgl_po',
				qty_po = '$qty_po',
				harga_po = '$harga_po',
				ket_po = '$ket_po',
				acc3 = '$acc3',
				acc4 = '$acc4',
				acc5 = '$acc5',
				id_vendor = '$id_vendor'
			  WHERE id_po = $id_po
			";
	mysqli_query($koneksi, $query);


	$query_update = "UPDATE req_barang 
                 SET status_req = 'Ditolak' 
                 WHERE kode_brg = (SELECT kode_brg FROM req_barang WHERE id_req_brg = $id_req_brg) AND tgl_req_brg = (SELECT tgl_req_brg FROM req_barang WHERE id_req_brg = $id_req_brg)";
  mysqli_query($koneksi, $query_update);

	return mysqli_affected_rows($koneksi);
}

// function generate_kode_invoice() {
//   global $koneksi;
  
//   // Ambil nilai auto increment terakhir
//   $query = "SELECT MAX(CAST(SUBSTRING(no_invoice, 4) AS SIGNED)) AS kode_terakhir FROM invoice";
//   $result = mysqli_query($koneksi, $query);
//   $row = mysqli_fetch_assoc($result);
//   $kode_terakhir = $row['kode_terakhir'];

//   // Generate kode barang baru
//   $kode_baru = "NO. ";
//   if ($kode_terakhir !== null) {
//     $kode_baru .= sprintf("%05d", $kode_terakhir + 1);
//   } else {
//     $kode_baru .= "001/PO/MMM/I/date('y')";
//   }

//   return $kode_baru;
// }




function generate_kode_invoice() {
  global $koneksi;

  // Ambil tahun dan bulan sekarang
  $tahun_sekarang = date("Y");

  // Mencoba mengambil nilai auto increment terakhir (dengan penanganan error)
  $query = "SELECT MAX(CAST(SUBSTRING(no_invoice, 4, 3) AS SIGNED)) AS kode_terakhir FROM invoice WHERE SUBSTRING(no_invoice, 6, 4) = '$tahun_sekarang'";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $kode_terakhir = $row['kode_terakhir'];
  } else {
    // Jika terjadi error saat query, asumsikan kode terakhir belum ada
    $kode_terakhir = 0;
  }

  // Generate kode invoice baru
  $kode_baru = "NO. ";
  $kode_baru .= sprintf("%03d", $kode_terakhir + 1);  // Tambahkan angka urut dengan 3 digit
  $kode_baru .= "/PO/MMM/I/$tahun_sekarang";

  return $kode_baru;
}

function tambahPO($data) {
  global $koneksi;

  // Ambil data no invoice dari input
  $no_po = htmlspecialchars($data["no_po"]);

  // Cek apakah no invoice sudah ada
  $query_cek = "SELECT COUNT(*) AS total FROM no_po WHERE no_po = '$no_po'";
  $result_cek = mysqli_query($koneksi, $query_cek);
  $row_cek = mysqli_fetch_assoc($result_cek);

  // Jika no invoice sudah ada, tampilkan pesan error
  if ($row_cek['total'] > 0) {
    echo "<script>alert('No. Purchase Order sudah ada!');</script>";
    return false;
  }

  // Jika no invoice belum ada, insert data invoice
  $query = "INSERT INTO no_po VALUES
			('', '$no_po')";
  mysqli_query($koneksi, $query);

  // Return true jika insert berhasil
  return mysqli_affected_rows($koneksi) > 0;
}

function ubahNoPO($data) {
	global $koneksi;

	$id_no_po = htmlspecialchars($data["id_no_po"]);
	$no_po = htmlspecialchars($data["no_po"]);

	$query = "UPDATE no_po SET
				no_po= '$no_po'
			  WHERE id_no_po='$id_no_po'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function hapusPO($id_no_po) {
	global $koneksi;
	// mysqli_query($koneksi, "DELETE FROM invoice WHERE id_invoice=$id_invoice");
	try{
		mysqli_query($koneksi, "DELETE FROM no_po WHERE id_no_po='$id_no_po'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function tambahInvoice($data) {
  global $koneksi;

  // Ambil data no invoice dari input
  $no_invoice = htmlspecialchars($data["no_invoice"]);

  // Cek apakah no invoice sudah ada
  $query_cek = "SELECT COUNT(*) AS total FROM invoice WHERE no_invoice = '$no_invoice'";
  $result_cek = mysqli_query($koneksi, $query_cek);
  $row_cek = mysqli_fetch_assoc($result_cek);

  // Jika no invoice sudah ada, tampilkan pesan error
  if ($row_cek['total'] > 0) {
    echo "<script>alert('No invoice sudah ada!');</script>";
    return false;
  }

  // Jika no invoice belum ada, insert data invoice
  $query = "INSERT INTO invoice VALUES
			('', '$no_invoice')";
  mysqli_query($koneksi, $query);

  // Return true jika insert berhasil
  return mysqli_affected_rows($koneksi) > 0;
}

function ubahInvoice($data) {
	global $koneksi;

	$id_invoice = htmlspecialchars($data["id_invoice"]);
	$no_invoice = htmlspecialchars($data["no_invoice"]);

	$query = "UPDATE invoice SET
				no_invoice= '$no_invoice'
			  WHERE id_invoice='$id_invoice'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function hapusInvoice($id_invoice) {
	global $koneksi;
	// mysqli_query($koneksi, "DELETE FROM invoice WHERE id_invoice=$id_invoice");
	try{
		mysqli_query($koneksi, "DELETE FROM invoice WHERE id_invoice='$id_invoice'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}


function tambahQrcode($data) {
	global $koneksi;
	$id_emp = htmlspecialchars($data["id_emp"]);
	
	$query = "INSERT INTO qrcode VALUES
			('', '$id_emp')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusQrcode($id_qr) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM qrcode WHERE id_qr=$id_qr");

	return mysqli_affected_rows($koneksi);

}

function tambahCoa($data) {
	global $koneksi;
	$kode_coa = htmlspecialchars($data["kode_coa"]);
	$name_account = htmlspecialchars($data["name_account"]);
	$account_type = mysqli_real_escape_string($koneksi, $data["account_type"]);
	// $account_type = htmlspecialchars($data["account_type"]);


	$query = "INSERT INTO cart_of_account VALUES
			('$kode_coa', '$name_account', '$account_type')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function ubahCoa($data) {
	global $koneksi;

	$kode_coa = htmlspecialchars($data["kode_coa"]);
	$kode_coa_lama = htmlspecialchars($data["kode_coa_lama"]);
	$name_account = htmlspecialchars($data["name_account"]);
	$account_type = mysqli_real_escape_string($koneksi, $data["account_type"]);
	// $account_type = htmlspecialchars($data["account_type"]);

	$query = "UPDATE cart_of_account SET
				kode_coa= '$kode_coa',
				name_account = '$name_account',
				account_type = '$account_type'
			  WHERE kode_coa='$kode_coa_lama'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function hapusCoa($kode_coa) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM cart_of_account WHERE kode_coa=$kode_coa");

	return mysqli_affected_rows($koneksi);

}

function tambahNoJournal($data) {
	global $koneksi;
	$no_journal = htmlspecialchars($data["no_journal"]);

	$query = "INSERT INTO no_jurnal VALUES
			('$no_journal')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

// function hapusNoJournal($no_jurnal) {
// 	global $koneksi;
// 	mysqli_query($koneksi, "DELETE FROM no_jurnal WHERE no_jurnal='$no_jurnal'");

// 	return mysqli_affected_rows($koneksi);

// }

function hapusNoJournal($no_jurnal) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM no_jurnal WHERE no_jurnal='$no_jurnal'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function ubahNoJournal($data) {
	global $koneksi;

	$no_jurnal = htmlspecialchars($data["no_jurnal"]);
	$no_jurnal_lama = htmlspecialchars($data["no_jurnal_lama"]);

	$query = "UPDATE no_jurnal SET
				no_jurnal= '$no_jurnal'
			  WHERE no_jurnal='$no_jurnal_lama'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function tambahDataJournal($data) {
	global $koneksi;
	$tgl_jurnal = htmlspecialchars($data["tgl_jurnal"]);
	$ket_jurnal = htmlspecialchars($data["ket_jurnal"]);
	$debit = htmlspecialchars($data["debit"]);
	$kredit = htmlspecialchars($data["kredit"]);
	$no_jurnal = htmlspecialchars($data["no_jurnal"]);
	$kode_coa = htmlspecialchars($data["kode_coa"]);

	$query = "INSERT INTO jurnal VALUES
			('', '$tgl_jurnal', '$ket_jurnal', '$debit', '$kredit','$no_jurnal', '$kode_coa')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function ubahDataJournal($data) {
	global $koneksi;
	$id_jurnal = htmlspecialchars($data["id_jurnal"]);
	$tgl_jurnal = htmlspecialchars($data["tgl_jurnal"]);
	$ket_jurnal = htmlspecialchars($data["ket_jurnal"]);
	$debit = htmlspecialchars($data["debit"]);
	$kredit = htmlspecialchars($data["kredit"]);
	$no_jurnal = htmlspecialchars($data["no_jurnal"]);
	$kode_coa = htmlspecialchars($data["kode_coa"]);

	$query = "UPDATE jurnal SET
				tgl_jurnal= '$tgl_jurnal',
				ket_jurnal= '$ket_jurnal',
				debit= '$debit',
				kredit= '$kredit',
				no_jurnal= '$no_jurnal',
				kode_coa= '$kode_coa'
			  WHERE id_jurnal='$id_jurnal'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function hapusDataJournal($id_jurnal) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM jurnal WHERE id_jurnal='$id_jurnal'");

	return mysqli_affected_rows($koneksi);

}



function tambahAnggaran($data) {
	global $koneksi;
	$nama_anggaran = htmlspecialchars($data["nama_anggaran"]);
	$nominal = htmlspecialchars($data["nominal"]);
	$tgl_mulai = htmlspecialchars($data["tgl_mulai"]);
	$tgl_akhir = htmlspecialchars($data["tgl_akhir"]);
	$id_mhs = mysqli_real_escape_string($koneksi, $_SESSION["id_mhs"]);


	$query = "INSERT INTO anggaran VALUES
			('', '$nama_anggaran', '$nominal', '$tgl_mulai', '$tgl_akhir', '$id_mhs')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}
function hapusAnggaran($id_anggaran) {
	global $koneksi;


	try{
		mysqli_query($koneksi, "DELETE FROM anggaran WHERE id_anggaran='$id_anggaran'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function ubahAnggaran($data) {
	global $koneksi;

	$id_anggaran = htmlspecialchars($data["id_anggaran"]);
	$nama_anggaran = htmlspecialchars($data["nama_anggaran"]);
	$nominal = htmlspecialchars($data["nominal"]);
	$tgl_mulai = htmlspecialchars($data["tgl_mulai"]);
	$tgl_akhir = htmlspecialchars($data["tgl_akhir"]);

	$query = "UPDATE anggaran SET
				nama_anggaran= '$nama_anggaran',
				nominal = '$nominal',
				tgl_mulai = '$tgl_mulai',
				tgl_akhir = '$tgl_akhir'
			  WHERE id_anggaran='$id_anggaran'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function tambahTagihan($data) {
	global $koneksi;
	$nama_tagihan = htmlspecialchars($data["nama_tagihan"]);
	$nominal = htmlspecialchars($data["nominal"]);
	$tgl_due = htmlspecialchars($data["tgl_due"]);
	$id_mhs = mysqli_real_escape_string($koneksi, $_SESSION["id_mhs"]);


	$query = "INSERT INTO tagihan VALUES
			('', '$nama_tagihan', '$nominal', '$tgl_due', '$id_mhs')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusTagihan($id_tagihan) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM tagihan WHERE id_tagihan=$id_tagihan");

	return mysqli_affected_rows($koneksi);

}

function ubahTagihan($data) {
	global $koneksi;

	$id_tagihan = htmlspecialchars($data["id_tagihan"]);
	$nama_tagihan = htmlspecialchars($data["nama_tagihan"]);
	$nominal= htmlspecialchars($data["nominal"]);
	$tgl_due = htmlspecialchars($data["tgl_due"]);

	$query = "UPDATE tagihan SET
				nama_tagihan= '$nama_tagihan',
				nominal = '$nominal',
				tgl_due = '$tgl_due'
			  WHERE id_tagihan='$id_tagihan'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function tambahCatatan($data) {
	global $koneksi;

	$tgl_catatan = mysqli_real_escape_string($koneksi, $data["tgl_catatan"]);
	$nominal = mysqli_real_escape_string($koneksi, $data["nominal"]);
	$id_anggaran = mysqli_real_escape_string($koneksi, $data["id_anggaran"]);
	$id_kategori = mysqli_real_escape_string($koneksi, $data["id_kategori"]);
	$keterangan = mysqli_real_escape_string($koneksi, $data["keterangan"]);
	$id_mhs = mysqli_real_escape_string($koneksi, $_SESSION["id_mhs"]);


	$query = "INSERT INTO catatan_pengeluaran VALUES
			('','$id_kategori', '$id_anggaran', '$tgl_catatan', '$nominal', '$keterangan', '$id_mhs')";
	mysqli_query($koneksi, $query);
	//  var_dump($query);
	//  die;
	return mysqli_affected_rows($koneksi);
}

function hapusCatatan($id_catatan) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM catatan_pengeluaran WHERE id_catatan=$id_catatan");

	return mysqli_affected_rows($koneksi);

}

function ubahCatatan($data) {
	global $koneksi;

	$id_catatan = mysqli_real_escape_string($koneksi, $data["id_catatan"]);
	$tgl_catatan = mysqli_real_escape_string($koneksi, $data["tgl_catatan"]);
	$nominal = mysqli_real_escape_string($koneksi, $data["nominal_catatan"]);
	$id_anggaran = mysqli_real_escape_string($koneksi, $data["id_anggaran"]);
	$id_kategori = mysqli_real_escape_string($koneksi, $data["id_kategori"]);
	$keterangan = mysqli_real_escape_string($koneksi, $data["keterangan"]);

	$query = "UPDATE catatan_pengeluaran SET
				id_kategori = '$id_kategori',
				id_anggaran= '$id_anggaran',
				tgl_catatan= '$tgl_catatan',
				nominal_catatan= '$nominal',
				keterangan = '$keterangan'
			  WHERE id_catatan='$id_catatan'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function tambahJadwal($data) {
	global $koneksi;
	$matkul = htmlspecialchars($data["matkul"]);
	$hari = mysqli_real_escape_string($koneksi, $data["hari"]);
	$jam = htmlspecialchars($data["jam"]);


	$query = "INSERT INTO jadwal VALUES
			('', '$matkul', '$hari', '$jam')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusJadwal($id_matkul) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM jadwal WHERE id_matkul=$id_matkul");

	return mysqli_affected_rows($koneksi);

}

function ubahJadwal($data) {
	global $koneksi;

	$id_matkul = htmlspecialchars($data["id_matkul"]);
	// $id_lama = htmlspecialchars($data["id_lama"]);	
	$matkul = htmlspecialchars($data["matkul"]);
	$hari = mysqli_real_escape_string($koneksi, $data["hari"]);
	$jam = htmlspecialchars($data["jam"]);

	$query = "UPDATE jadwal SET
				matkul= '$matkul',
				hari = '$hari',
				jam = '$jam'
			  WHERE id_matkul='$id_matkul'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function registrasi($data){
	global $koneksi;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $email = stripcslashes($data["email"]);
	

	// cek username sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT username FROM user WHERE username= '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Daftar Akun Gagal',
				text                :  'Username yang dipilih sudah terdaftar',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = 'index.php'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>";
		// echo "
		// 	<script>
		// 		alert('Username yang dipilih sudah terdaftar!');
		// 	</script>
		// ";
		return false;
	}

	// cek konfirmasi password
	if ($password !== $password2) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Daftar Akun Gagal',
				text                :  'Konfirmasi Password Tidak Sesuai!',
				//footer              :  '',
				icon                : 'error',
				timer               : 2000,
				showConfirmButton   : true
			});  
		},10);   setTimeout(function () {
			window.location.href = 'login.php'; //will redirect to your blog page (an ex: blog.html)
		}, 2000); //will call the function after 2 secs
		</script>";
		// echo "
		// 	<script>
		// 		alert('konfirmasi password tidak sesuai!');
		// 	</script>
		// ";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);


	// tambahkan user baru ke database
	mysqli_query($koneksi, "INSERT INTO user VALUES('', '$username', '$password', '$email')");

	return mysqli_affected_rows($koneksi);
}


function ubahProfil($data){
	global $koneksi;
	$id_mhs = $data['id_mhs'];
    $nama = stripcslashes($data["nama_mhs"]);
	$username =stripcslashes($data["username"]);
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
    $no_hp = stripcslashes($data["no_hp"]);
    $alamat = stripcslashes($data["alamat"]);
    $email = stripcslashes($data["email"]);

	
	$password2 = password_hash($password, PASSWORD_DEFAULT);

		// Update user data in the database
		$update_query = "UPDATE mahasiswa 
		SET nama_mhs = '$nama', 
			username = '$username',
			password = '$password2',
			no_hp = '$no_hp', 
			alamat = '$alamat', 
			email = '$email' 
		WHERE id_mhs='$id_mhs'";
	
	

	mysqli_query($koneksi, $update_query);

	return mysqli_affected_rows($koneksi);
}



function cariAnggaran($keyword){
	$query = "SELECT * FROM anggaran
				WHERE
			  nama_anggaran LIKE '%$keyword%' OR 
			  nominal LIKE '%$keyword%' OR 
			  tgl_mulai LIKE '%$keyword%' OR
			  tgl_akhir LIKE '%$keyword%'
			";

	return query($query);
}

function tambahSertifikat($data) {

	global $koneksi;
	$nama_sertifikat = mysqli_real_escape_string($koneksi, $data["nama_sertifikat"]);
	$tgl_terbit = mysqli_real_escape_string($koneksi, $data["tgl_terbit"]);
	$tgl_expired = mysqli_real_escape_string($koneksi, $data["tgl_expired"]);
	$status_cert = mysqli_real_escape_string($koneksi, $data["status_cert"]);
	$id_vessel = mysqli_real_escape_string($koneksi, $data["id_vessel"]);

	$file_sertifikat_kapal =  uploadSertifikatKapal();
	if (!$file_sertifikat_kapal) {
		return false;
	}
	

	$query = "INSERT INTO sertifikat_kapal VALUES
			('', '$nama_sertifikat', '$tgl_terbit', '$tgl_expired', '$file_sertifikat_kapal', '$status_cert', '$id_vessel')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);


}

function uploadSertifikatKapal(){

	$namaFile = $_FILES['scan_sertifikat_kapal']['name'];
	$ukuranFile = $_FILES['scan_sertifikat_kapal']['size'];
	$error = $_FILES['scan_sertifikat_kapal']['error'];
	$tmpName = $_FILES['scan_sertifikat_kapal']['tmp_name'];

	// cek apakah tidak ada file yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih file terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah pdf
	$ekstensiFileValid = ['pdf'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid) ){
		echo "
			<script>
				alert('yang anda upload bukan Pdf!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran pdf terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, pdf siap diupload
	// generate nama pdf baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'files/sertifikat_kapal/'. $namaFileBaru);
	return $namaFileBaru;
 }

function ubahSertifikat($data){
	global $koneksi;
	$id_sertifikat = $data['id_sertifikat'];
    $nama_sertifikat = mysqli_real_escape_string($koneksi, $data["nama_sertifikat"]);
	$tgl_terbit = mysqli_real_escape_string($koneksi, $data["tgl_terbit"]);
	$tgl_expired = mysqli_real_escape_string($koneksi, $data["tgl_expired"]);
	$fileLama = mysqli_real_escape_string($koneksi, $data["scan_sertifikat_kapal_lama"]);
	$status_cert = mysqli_real_escape_string($koneksi, $data["status_cert"]);
	$id_vessel = mysqli_real_escape_string($koneksi, $data["id_vessel"]);

	// cek apakah user pilih pdf baru atau tidak
	if ($_FILES['scan_sertifikat_kapal']['error'] === 4 ) {
		$file = $fileLama;
	} else {

		$file = uploadSertifikatKapal();
	}


	$query = "UPDATE sertifikat_kapal SET
			nama_sertifikat= '$nama_sertifikat',
			tgl_terbit = '$tgl_terbit',
			tgl_expired = '$tgl_expired',
			scan_sertifikat_kapal = '$file',
			status_cert = '$status_cert',
			id_vessel = '$id_vessel'
	WHERE id_sertifikat='$id_sertifikat'
	";

	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusSertifikat($id_sertifikat) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM sertifikat_kapal WHERE id_sertifikat=$id_sertifikat");

	return mysqli_affected_rows($koneksi);

}

function tambahUraian($data) {

	global $koneksi;
	$nama_uraian = mysqli_real_escape_string($koneksi, $data["nama_uraian"]);
	$qty_uraian = mysqli_real_escape_string($koneksi, $data["qty_uraian"]);
	$id_satuan = mysqli_real_escape_string($koneksi, $data["id_satuan"]);
	$harga_satuan = mysqli_real_escape_string($koneksi, $data["harga_satuan"]);
	$id_vessel = mysqli_real_escape_string($koneksi, $data["id_vessel"]);
	$id_project = mysqli_real_escape_string($koneksi, $data["id_project"]);
	$id_ppu = mysqli_real_escape_string($koneksi, $data["id_ppu"]);

	

	$query = "INSERT INTO uraian_ppu VALUES
			('', '$nama_uraian', '$qty_uraian', '$id_satuan', '$harga_satuan', '$id_vessel', '$id_project', '$id_ppu')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);


}

function ubahUraian($data) {
	global $koneksi;
	$id_uraian = mysqli_real_escape_string($koneksi, $data['id_uraian']);
	$nama_uraian = mysqli_real_escape_string($koneksi, $data["nama_uraian"]);
	$qty_uraian = mysqli_real_escape_string($koneksi, $data["qty_uraian"]);
	$id_satuan = mysqli_real_escape_string($koneksi, $data["id_satuan"]);
	$harga_satuan = mysqli_real_escape_string($koneksi, $data["harga_satuan"]);
	$id_vessel = mysqli_real_escape_string($koneksi, $data["id_vessel"]);
	$id_project = mysqli_real_escape_string($koneksi, $data["id_project"]);
	$id_ppu = mysqli_real_escape_string($koneksi, $data["id_ppu"]);


	$query = "UPDATE uraian_ppu SET
				nama_uraian= '$nama_uraian',
				qty_uraian= '$qty_uraian',
				id_satuan= '$id_satuan',
				harga_satuan= '$harga_satuan',
				id_vessel= '$id_vessel',
				id_project= '$id_project',
				id_ppu = '$id_ppu'
			  WHERE id_uraian='$id_uraian'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function hapusUraian($id_uraian) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM uraian_ppu WHERE id_uraian='$id_uraian'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}


function tambahPpu($data) {

	global $koneksi;
	$no_ppu = mysqli_real_escape_string($koneksi, $data["no_ppu"]);
	// Check if the expenses with the same number already exists
	$query_check = "SELECT * FROM ppu WHERE no_ppu = '$no_ppu'";
	$result_check = mysqli_query($koneksi, $query_check);
	if(mysqli_num_rows($result_check) > 0) {
		return false; // Return false to indicate failure
	}
	$tgl_ppu = mysqli_real_escape_string($koneksi, $data["tgl_ppu"]);
	$keperluan = mysqli_real_escape_string($koneksi, $data["keperluan"]);
	$id_user = mysqli_real_escape_string($koneksi, $data["id_user"]);
	$id_emp = mysqli_real_escape_string($koneksi, $data["id_emp"]);
	$status_ppu = mysqli_real_escape_string($koneksi, $data["status_ppu"]);
	$app_ppu1 = mysqli_real_escape_string($koneksi, $data["app_ppu1"]);
	$app_ppu2 = mysqli_real_escape_string($koneksi, $data["app_ppu2"]);
	$app_ppu3 = mysqli_real_escape_string($koneksi, $data["app_ppu3"]);
	$app_ppu4 = mysqli_real_escape_string($koneksi, $data["app_ppu4"]);
	$app_ppu5 = mysqli_real_escape_string($koneksi, $data["app_ppu5"]);

	$query = "INSERT INTO ppu VALUES
			('', '$no_ppu', '$tgl_ppu', '$keperluan', '$id_user', '$id_emp', '$status_ppu', '$app_ppu1', '$app_ppu2', '$app_ppu3', '$app_ppu4', '$app_ppu5')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);


}

function ubahPpu($data) {
	global $koneksi;
	$id_ppu = mysqli_real_escape_string($koneksi, $data['id_ppu']);
	$no_ppu = mysqli_real_escape_string($koneksi, $data["no_ppu"]);
	$tgl_ppu = mysqli_real_escape_string($koneksi, $data["tgl_ppu"]);
	$keperluan = mysqli_real_escape_string($koneksi, $data["keperluan"]);
	$id_user = mysqli_real_escape_string($koneksi, $data["id_user"]);
	$id_emp = mysqli_real_escape_string($koneksi, $data["id_emp"]);
	$status_ppu = mysqli_real_escape_string($koneksi, $data["status_ppu"]);
	$app_ppu1 = mysqli_real_escape_string($koneksi, $data["app_ppu1"]);
	$app_ppu2 = mysqli_real_escape_string($koneksi, $data["app_ppu2"]);
	$app_ppu3 = mysqli_real_escape_string($koneksi, $data["app_ppu3"]);
	$app_ppu4 = mysqli_real_escape_string($koneksi, $data["app_ppu4"]);
	$app_ppu5 = mysqli_real_escape_string($koneksi, $data["app_ppu5"]);

	$query = "UPDATE ppu SET
				no_ppu= '$no_ppu',
				tgl_ppu= '$tgl_ppu',
				keperluan= '$keperluan',
				id_user= '$id_user',
				id_emp= '$id_emp',
				status_ppu= '$status_ppu',
				app_ppu1= '$app_ppu1',
				app_ppu2= '$app_ppu2',
				app_ppu3= '$app_ppu3',
				app_ppu4= '$app_ppu4',
				app_ppu5= '$app_ppu5'
			  WHERE id_ppu='$id_ppu'
			";
			
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function hapusPpu($id_ppu) {
	global $koneksi;
	try{
		mysqli_query($koneksi, "DELETE FROM ppu WHERE id_ppu='$id_ppu'");
	}catch(Exception $e){
		return false;
	}

	return mysqli_affected_rows($koneksi);

}

function approvePpu1($id_ppu) {
	global $koneksi;
	$app_ppu1 = "Gahral";	
	$status_ppu = "On Kacab";	

	$query = "UPDATE ppu SET
				app_ppu1 = '$app_ppu1',
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function revisePpu1($id_ppu) {
	global $koneksi;
	$app_ppu1 = "";	
	$status_ppu = "Revise";	

	$query = "UPDATE ppu SET
				app_ppu1 = '$app_ppu1',
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectPpu1($id_ppu) {
	global $koneksi;
	$status_ppu = "Reject";	

	$query = "UPDATE ppu SET
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function approvePpu2($id_ppu) {
	global $koneksi;
	$app_ppu2 = "Michael";	
	$status_ppu = "On Dirops";	

	$query = "UPDATE ppu SET
				app_ppu2 = '$app_ppu2',
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function revisePpu2($id_ppu) {
	global $koneksi;
	$app_ppu1 = "";	
	$status_ppu = "Revise";	

	$query = "UPDATE ppu SET
				app_ppu1 = '$app_ppu1',
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectPpu2($id_ppu) {
	global $koneksi;
	$app_ppu1 = '';
	$status_ppu = "Reject";	

	$query = "UPDATE ppu SET
				app_ppu1 = '$app_ppu1',
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function approvePpu3($id_ppu) {
	global $koneksi;
	$app_ppu3 = "Bambang Wahyudi";	
	$status_ppu = "On Dirut";	

	$query = "UPDATE ppu SET
				app_ppu3 = '$app_ppu3',
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function revisePpu3($id_ppu) {
	global $koneksi;
	$app_ppu1 = "";	
	$app_ppu2 = "";	
	$status_ppu = "Revise";	

	$query = "UPDATE ppu SET
				app_ppu1 = '$app_ppu1',
				app_ppu2 = '$app_ppu2',
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectPpu3($id_ppu) {
	global $koneksi;
	$app_ppu1 = '';
	$app_ppu2 = '';
	$status_ppu = "Reject";	

	$query = "UPDATE ppu SET
				app_ppu1 = '$app_ppu1',
				app_ppu2 = '$app_ppu2',
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function approvePpu4($id_ppu) {
	global $koneksi;
	$app_ppu4 = "Raden Sulaiman Sanjeev";	
	$status_ppu = "On Dirkeu";	

	$query = "UPDATE ppu SET
				app_ppu4 = '$app_ppu4',
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function revisePpu4($id_ppu) {
	global $koneksi;
	$app_ppu1 = "";	
	$app_ppu2 = "";	
	$app_ppu3 = "";	
	$status_ppu = "Revise";	

	$query = "UPDATE ppu SET
				app_ppu1 = '$app_ppu1',
				app_ppu2 = '$app_ppu2',
				app_ppu3 = '$app_ppu3',
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectPpu4($id_ppu) {
	global $koneksi;
	$app_ppu1 = '';
	$app_ppu2 = '';
	$app_ppu3 = '';
	$status_ppu = "Reject";	

	$query = "UPDATE ppu SET
				app_ppu1 = '$app_ppu1',
				app_ppu2 = '$app_ppu2',
				app_ppu3 = '$app_ppu3',
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function approvePpu5($id_ppu) {
	global $koneksi;
	$app_ppu5 = "Regina";	
	$status_ppu = "Selesai";	

	$query = "UPDATE ppu SET
				app_ppu5 = '$app_ppu5',
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function revisePpu5($id_ppu) {
	global $koneksi;
	$app_ppu1 = "";	
	$app_ppu2 = "";	
	$app_ppu3 = "";	
	$app_ppu4 = "";	
	$status_ppu = "Revise";	

	$query = "UPDATE ppu SET
				app_ppu1 = '$app_ppu1',
				app_ppu2 = '$app_ppu2',
				app_ppu3 = '$app_ppu3',
				app_ppu4 = '$app_ppu4',
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectPpu5($id_ppu) {
	global $koneksi;
	$app_ppu1 = '';
	$app_ppu2 = '';
	$app_ppu3 = '';
	$app_ppu4 = '';
	$status_ppu = "Reject";	

	$query = "UPDATE ppu SET
				app_ppu1 = '$app_ppu1',
				app_ppu2 = '$app_ppu2',
				app_ppu3 = '$app_ppu3',
				app_ppu4 = '$app_ppu4',
				status_ppu = '$status_ppu'
			  WHERE id_ppu = $id_ppu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}


function tambahBpu($data) {
	global $koneksi;
	$tgl_bpu = htmlspecialchars($data["tgl_bpu"]);
	$penerima_dana = htmlspecialchars($data["penerima_dana"]);
	$nominal_tf = htmlspecialchars($data["nominal_tf"]);
	$note_bpu = htmlspecialchars($data["note_bpu"]);
	$id_ppu = htmlspecialchars($data["id_ppu"]);
	
	$bukti_tf =  uploadBuktiTf();
	if (!$bukti_tf) {
		return false;
	}

	$query = "INSERT INTO bpu_ppu VALUES
			('', '$tgl_bpu', '$penerima_dana', '$nominal_tf', '$note_bpu', '$bukti_tf', '$id_ppu')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function uploadBuktiTf(){

	$namaFile = $_FILES['bukti_tf']['name'];
	$ukuranFile = $_FILES['bukti_tf']['size'];
	$error = $_FILES['bukti_tf']['error'];
	$tmpName = $_FILES['bukti_tf']['tmp_name'];

	// cek apakah tidak ada file yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih file terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah pdf
	$ekstensiFileValid = ['pdf', 'png', 'jpg', 'jpeg'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid) ){
		echo "
			<script>
				alert('yang anda upload bukan Pdf/Png/Jpg/Jpeg!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran File terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, pdf siap diupload
	// generate nama pdf baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'files/bukti_tf_bpu/'. $namaFileBaru);
	return $namaFileBaru;
 }

 function ubahBpu($data) {
	global $koneksi;
	$id_bpu = $data['id_bpu'];
	$tgl_bpu = htmlspecialchars($data["tgl_bpu"]);
	$penerima_dana = htmlspecialchars($data["penerima_dana"]);
	$nominal_tf = htmlspecialchars($data["nominal_tf"]);
	$note_bpu = htmlspecialchars($data["note_bpu"]);
	$bukti_tf_lama = htmlspecialchars($data["bukti_tf_lama"]);
	$id_ppu = htmlspecialchars($data["id_ppu"]);
	

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['bukti_tf']['error'] === 4 ) {
		$bukti_tf = $bukti_tf_lama;
	} else {

		$bukti_tf = uploadBuktiTf();
	}

	$query = "UPDATE bpu_ppu SET
				tgl_bpu = '$tgl_bpu',
				penerima_dana = '$penerima_dana',
				nominal_tf = '$nominal_tf',
				note_bpu = '$note_bpu',
				bukti_tf = '$bukti_tf',
				id_ppu = '$id_ppu'
			  WHERE id_bpu = $id_bpu
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusBpu($id_bpu) {
	global $koneksi;

	try{
		mysqli_query($koneksi, "DELETE FROM bpu_ppu WHERE id_bpu=$id_bpu");
	}catch(Exception $e){
		return false;
	}
	

	return mysqli_affected_rows($koneksi);

}

function tambahPenyelesaian($data) {
	global $koneksi;
	$tgl_end = htmlspecialchars($data["tgl_end"]);
	$nominal_use = htmlspecialchars($data["nominal_use"]);
	$selisih = htmlspecialchars($data["selisih"]);
	$status_end = htmlspecialchars($data["status_end"]);
	$id_bpu = htmlspecialchars($data["id_bpu"]);
	
	// Cek apakah bukti_nota diisi
	if(isset($_FILES['bukti_nota']) && $_FILES['bukti_nota']['size'] > 0) {
		$bukti_nota =  uploadNota();
		if (!$bukti_nota) {
			return false;
		}
	} else {
		$bukti_nota = null;
	}

	// Cek apakah bukti_return diisi
	if(isset($_FILES['bukti_return']) && $_FILES['bukti_return']['size'] > 0) {
		$bukti_return =  uploadReturn();
		if (!$bukti_return) {
			return false;
		}
	} else {
		$bukti_return = null;
	}

	// Cek apakah file_scan_ktp diisi
	if(isset($_FILES['bukti_reimburse']) && $_FILES['bukti_reimburse']['size'] > 0) {
		$bukti_reimburse =  uploadReimburse();
		if (!$bukti_reimburse) {
			return false;
		}
	} else {
		$bukti_reimburse = null;
	}

	$query = "INSERT INTO penyelesaian VALUES
			('', '$tgl_end', '$nominal_use', '$bukti_nota', '$selisih', '$status_end', '$id_bpu', '$bukti_return', '$bukti_reimburse')";
	mysqli_query($koneksi, $query);


	return mysqli_affected_rows($koneksi);
}

function uploadNota(){

	$namaFile = $_FILES['bukti_nota']['name'];
	$ukuranFile = $_FILES['bukti_nota']['size'];
	$error = $_FILES['bukti_nota']['error'];
	$tmpName = $_FILES['bukti_nota']['tmp_name'];

	// cek apakah tidak ada file yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih file terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah pdf
	$ekstensiFileValid = ['pdf', 'png', 'jpg', 'jpeg'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid) ){
		echo "
			<script>
				alert('yang anda upload bukan Pdf/Png/Jpg/Jpeg!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran File terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, pdf siap diupload
	// generate nama pdf baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'files/bukti_nota/'. $namaFileBaru);
	return $namaFileBaru;
 }

 function uploadReturn(){

	$namaFile = $_FILES['bukti_return']['name'];
	$ukuranFile = $_FILES['bukti_return']['size'];
	$error = $_FILES['bukti_return']['error'];
	$tmpName = $_FILES['bukti_return']['tmp_name'];

	// cek apakah tidak ada file yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih file terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah pdf
	$ekstensiFileValid = ['pdf', 'png', 'jpg', 'jpeg'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid) ){
		echo "
			<script>
				alert('yang anda upload bukan Pdf/Png/Jpg/Jpeg!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran File terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, pdf siap diupload
	// generate nama pdf baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'files/bukti_nota/'. $namaFileBaru);
	return $namaFileBaru;
 }

 function uploadReimburse(){

	$namaFile = $_FILES['bukti_reimburse']['name'];
	$ukuranFile = $_FILES['bukti_reimburse']['size'];
	$error = $_FILES['bukti_reimburse']['error'];
	$tmpName = $_FILES['bukti_reimburse']['tmp_name'];

	// cek apakah tidak ada file yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih file terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah pdf
	$ekstensiFileValid = ['pdf', 'png', 'jpg', 'jpeg'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid) ){
		echo "
			<script>
				alert('yang anda upload bukan Pdf/Png/Jpg/Jpeg!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran File terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, pdf siap diupload
	// generate nama pdf baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'files/bukti_nota/'. $namaFileBaru);
	return $namaFileBaru;
 }

 function ubahPenyelesaian($data) {
	global $koneksi;
	$id_end = mysqli_real_escape_string($koneksi, $data["id_end"]);
	$tgl_end = htmlspecialchars($data["tgl_end"]);
	$nominal_use = htmlspecialchars($data["nominal_use"]);
	$selisih = htmlspecialchars($data["selisih"]);
	$status_end = htmlspecialchars($data["status_end"]);
	$id_bpu = htmlspecialchars($data["id_bpu"]);
	
	// Inisialisasi variabel untuk file lama
	$notaLama = isset($data["bukti_nota_lama"]) ? mysqli_real_escape_string($koneksi, $data["bukti_nota_lama"]) : '';
	$returnLama = isset($data["bukti_return_lama"]) ? mysqli_real_escape_string($koneksi, $data["bukti_return_lama"]) : '';
	$reimburseLama = isset($data["bukti_reimburse_lama"]) ? mysqli_real_escape_string($koneksi, $data["bukti_reimburse_lama"]) : '';

	// cek apakah user pilih pdf baru atau tidak
	$bukti_nota = isset($_FILES['bukti_nota']) && $_FILES['bukti_nota']['error'] !== 4 ? uploadNota() : $notaLama;
	
	// cek apakah user pilih pdf baru atau tidak
	$bukti_return = isset($_FILES['bukti_return']) && $_FILES['bukti_return']['error'] !== 4 ? uploadReturn() : $returnLama;

	// cek apakah user pilih pdf baru atau tidak
	$bukti_reimburse = isset($_FILES['bukti_reimburse']) && $_FILES['bukti_reimburse']['error'] !== 4 ? uploadReimburse() : $reimburseLama;

	$query = "UPDATE penyelesaian SET
				tgl_end = '$tgl_end',
				nominal_use = '$nominal_use',
				bukti_nota = '$bukti_nota',
				selisih = '$selisih',
				status_end = '$status_end',
				id_bpu = '$id_bpu',
				bukti_return = '$bukti_return',
				bukti_reimburse = '$bukti_reimburse'
			  WHERE id_end = $id_end
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function tambahExpenses($data) {
	global $koneksi;
	$no_expenses = htmlspecialchars($data["no_expenses"]);

	// Check if the expenses with the same number already exists
	$query_check = "SELECT * FROM expenses WHERE no_expenses = '$no_expenses'";
	$result_check = mysqli_query($koneksi, $query_check);
	if(mysqli_num_rows($result_check) > 0) {
		return false; // Return false to indicate failure
	}

	$tgl_expenses = htmlspecialchars($data["tgl_expenses"]);
	$nominal_expenses = htmlspecialchars($data["nominal_expenses"]);
	$keperluan_exp = htmlspecialchars($data["keperluan_exp"]);
	$status_expenses = htmlspecialchars($data["status_expenses"]);
	$app_exp1 = htmlspecialchars($data["app_exp1"]);
	$app_exp2 = htmlspecialchars($data["app_exp2"]);
	$app_exp3 = htmlspecialchars($data["app_exp3"]);
	$app_exp4 = htmlspecialchars($data["app_exp4"]);
	$app_exp5 = htmlspecialchars($data["app_exp5"]);
	$pemohon = htmlspecialchars($data["pemohon"]);
	$id_user = htmlspecialchars($data["id_user"]);
	
	$upload_exp =  uploadExpenses();
	if (!$upload_exp) {
		return false;
	}

	$query = "INSERT INTO expenses VALUES
			('', '$no_expenses', '$tgl_expenses', '$nominal_expenses', '$keperluan_exp', '$upload_exp', '$status_expenses', '$app_exp1', '$app_exp2', '$app_exp3', '$app_exp4', '$app_exp5', '$pemohon', '$id_user')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function uploadExpenses(){

	$namaFile = $_FILES['upload_expenses']['name'];
	$ukuranFile = $_FILES['upload_expenses']['size'];
	$error = $_FILES['upload_expenses']['error'];
	$tmpName = $_FILES['upload_expenses']['tmp_name'];

	// cek apakah tidak ada file yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih file terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah pdf
	$ekstensiFileValid = ['pdf', 'png', 'jpg', 'jpeg'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid) ){
		echo "
			<script>
				alert('yang anda upload bukan Pdf/Png/Jpg/Jpeg!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran File terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, pdf siap diupload
	// generate nama pdf baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'files/upload_expenses/'. $namaFileBaru);
	return $namaFileBaru;
 }

 function ubahExpenses($data) {
	global $koneksi;
	$id_expenses = $data['id_expenses'];
	$no_expenses = htmlspecialchars($data["no_expenses"]);
	$tgl_expenses = htmlspecialchars($data["tgl_expenses"]);
	$nominal_expenses = htmlspecialchars($data["nominal_expenses"]);
	$keperluan_exp = htmlspecialchars($data["keperluan_exp"]);
	$status_expenses = htmlspecialchars($data["status_expenses"]);
	$app_exp1 = htmlspecialchars($data["app_exp1"]);
	$app_exp2 = htmlspecialchars($data["app_exp2"]);
	$app_exp3 = htmlspecialchars($data["app_exp3"]);
	$app_exp4 = htmlspecialchars($data["app_exp4"]);
	$app_exp5 = htmlspecialchars($data["app_exp5"]);
	$pemohon = htmlspecialchars($data["pemohon"]);
	$id_user = htmlspecialchars($data["id_user"]);
	$upload_exp_lama = htmlspecialchars($data["upload_expenses_lama"]);
	

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['upload_expenses']['error'] === 4 ) {
		$upload_exp = $upload_exp_lama;
	} else {

		$bukti_tf = uploadBuktiTf();
	}

	$query = "UPDATE expenses SET
				no_expenses = '$no_expenses',
				tgl_expenses = '$tgl_expenses',
				nominal_expenses = '$nominal_expenses',
				keperluan_exp = '$keperluan_exp',
				upload_expenses = '$upload_exp',
				status_expenses = '$status_expenses',
				app_exp1 = '$app_exp1',
				app_exp2 = '$app_exp2',
				app_exp3 = '$app_exp3',
				app_exp4 = '$app_exp4',
				app_exp5 = '$app_exp5',
				pemohon = '$pemohon',
				id_user = '$id_user'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function approveExpenses1($id_expenses) {
	global $koneksi;
	$app_exp1 = "Gahral";	
	$status_expenses = "On Kacab";	

	$query = "UPDATE expenses SET
				app_exp1 = '$app_exp1',
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function reviseExpenses1($id_expenses) {
	global $koneksi;
	$app_exp1 = "";	
	$status_expenses = "Revise";	

	$query = "UPDATE expenses SET
				app_exp1 = '$app_exp1',
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectExpenses1($id_expenses) {
	global $koneksi;
	$status_expenses = "Reject";	

	$query = "UPDATE expenses SET
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function approveExpenses2($id_expenses) {
	global $koneksi;
	$app_exp2 = "Michael Kawilarang";	
	$status_expenses = "On Dirops";	

	$query = "UPDATE expenses SET
				app_exp2 = '$app_exp2',
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function reviseExpenses2($id_expenses) {
	global $koneksi;
	$app_exp1 = "";	
	$status_expenses = "Revise";	

	$query = "UPDATE expenses SET
				app_exp1 = '$app_exp1',
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectExpenses2($id_expenses) {
	global $koneksi;
	$app_exp1 = '';
	$status_expenses = "Reject";	

	$query = "UPDATE expenses SET
				app_exp1 = '$app_exp1',
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function approveExpenses3($id_expenses) {
	global $koneksi;
	$app_exp3 = "Bambang Wahyudi";	
	$status_expenses = "On Dirut";	

	$query = "UPDATE expenses SET
				app_exp3 = '$app_exp3',
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function reviseExpenses3($id_expenses) {
	global $koneksi;
	$app_exp1 = "";	
	$app_exp2 = "";	
	$status_expenses = "Revise";	

	$query = "UPDATE expenses SET
				app_exp1 = '$app_exp1',
				app_exp2 = '$app_exp2',
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectExpenses3($id_expenses) {
	global $koneksi;
	$app_exp1 = '';
	$app_exp2 = '';
	$status_expenses = "Reject";	

	$query = "UPDATE expenses SET
				app_exp1 = '$app_exp1',
				app_exp2 = '$app_exp2',
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function approveExpenses4($id_expenses) {
	global $koneksi;
	$app_exp4 = "Raden Sulaiman Sanjeev";	
	$status_expenses = "On Dirkeu";	

	$query = "UPDATE expenses SET
				app_exp4 = '$app_exp4',
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function reviseExpenses4($id_expenses) {
	global $koneksi;
	$app_exp1 = "";	
	$app_exp2 = "";	
	$app_exp3 = "";	
	$status_expenses = "Revise";	

	$query = "UPDATE expenses SET
				app_exp1 = '$app_exp1',
				app_exp2 = '$app_exp2',
				app_exp3 = '$app_exp3',
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectExpenses4($id_expenses) {
	global $koneksi;
	$app_exp1 = '';
	$app_exp2 = '';
	$app_exp3 = '';
	$status_expenses = "Reject";	

	$query = "UPDATE expenses SET
				app_exp1 = '$app_exp1',
				app_exp2 = '$app_exp2',
				app_exp3 = '$app_exp3',
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function approveExpenses5($id_expenses) {
	global $koneksi;
	$app_exp5 = "Regina";	
	$status_expenses = "Selesai";	

	$query = "UPDATE expenses SET
				app_exp5 = '$app_exp5',
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function reviseExpenses5($id_expenses) {
	global $koneksi;
	$app_exp1 = "";	
	$app_exp2 = "";	
	$app_exp3 = "";	
	$app_exp4 = "";	
	$status_expenses = "Revise";	

	$query = "UPDATE expenses SET
				app_exp1 = '$app_exp1',
				app_exp2 = '$app_exp2',
				app_exp3 = '$app_exp3',
				app_exp4 = '$app_exp3',
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rejectExpenses5($id_expenses) {
	global $koneksi;
	$app_exp1 = '';
	$app_exp2 = '';
	$app_exp3 = '';
	$app_exp4 = '';
	$status_expenses = "Reject";	

	$query = "UPDATE expenses SET
				app_exp1 = '$app_exp1',
				app_exp2 = '$app_exp2',
				app_exp3 = '$app_exp3',
				app_exp4 = '$app_exp4',
				status_expenses = '$status_expenses'
			  WHERE id_expenses = $id_expenses
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function tambahBpuExpenses($data) {
	global $koneksi;
	$tgl_bpu_exp = htmlspecialchars($data["tgl_bpu_exp"]);
	$penerima_exp = mysqli_real_escape_string($koneksi, $data['penerima_exp']);
	$nominal_tf_exp = mysqli_real_escape_string($koneksi, $data['nominal_tf_exp']);
	$note_exp = mysqli_real_escape_string($koneksi, $data['note_exp']);
	$id_expenses = mysqli_real_escape_string($koneksi, $data['id_expenses']);
	$id_user = htmlspecialchars($data["id_user"]);
	
	$bukti_tf_exp =  uploadBuktiTfExp();
	if (!$bukti_tf_exp) {
		return false;
	}

	$query = "INSERT INTO bpu_expenses VALUES
			('', '$tgl_bpu_exp', '$penerima_exp', '$nominal_tf_exp', '$note_exp', '$bukti_tf_exp', '$id_expenses', '$id_user')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function uploadBuktiTfExp(){

	$namaFile = $_FILES['bukti_tf_exp']['name'];
	$ukuranFile = $_FILES['bukti_tf_exp']['size'];
	$error = $_FILES['bukti_tf_exp']['error'];
	$tmpName = $_FILES['bukti_tf_exp']['tmp_name'];

	// cek apakah tidak ada file yang diupload
	if ($error === 4) {
		echo "
			<script>
				alert('pilih file terlebih dahulu!');
			</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah pdf
	$ekstensiFileValid = ['pdf', 'png', 'jpg', 'jpeg'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid) ){
		echo "
			<script>
				alert('yang anda upload bukan Pdf/Png/Jpg/Jpeg!');
			</script>
		";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000){
		echo "
			<script>
				alert('ukuran File terlalu besar!');
			</script>
		";
		return false;
	}

	// lolos pengecekan, pdf siap diupload
	// generate nama pdf baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'files/bukti_tf_exp/'. $namaFileBaru);
	return $namaFileBaru;
 }

 function ubahBpuExpenses($data) {
	global $koneksi;
	$id_bpu_exp = mysqli_real_escape_string($koneksi, $data['id_bpu_exp']);
	$tgl_bpu_exp = htmlspecialchars($data["tgl_bpu_exp"]);
	$penerima_exp = mysqli_real_escape_string($koneksi, $data['penerima_exp']);
	$nominal_tf_exp = mysqli_real_escape_string($koneksi, $data['nominal_tf_exp']);
	$note_exp = mysqli_real_escape_string($koneksi, $data['note_exp']);
	$id_expenses = mysqli_real_escape_string($koneksi, $data['id_expenses']);
	$id_user = htmlspecialchars($data["id_user"]);
	$bukti_tf_exp_lama = mysqli_real_escape_string($koneksi, $data['bukti_tf_exp_lama']);
	

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['bukti_tf_exp']['error'] === 4 ) {
		$bukti_tf_exp = $bukti_tf_exp_lama;
	} else {

		$bukti_tf_exp = uploadBuktiTfExp();
	}

	$query = "UPDATE bpu_expenses SET
				tgl_bpu_exp = '$tgl_bpu_exp',
				penerima_exp = '$penerima_exp',
				nominal_tf_exp = '$nominal_tf_exp',
				note_exp = '$note_exp',
				bukti_tf_exp = '$bukti_tf_exp',
				id_expenses = '$id_expenses',
				id_user = '$id_user'
			  WHERE id_bpu_exp = $id_bpu_exp
			";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusBpuExpenses($id_bpu_exp) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM bpu_expenses WHERE id_bpu_exp=$id_bpu_exp");

	return mysqli_affected_rows($koneksi);

}

 ?>