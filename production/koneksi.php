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

// function tambahPengajuan($data) {
// 	global $koneksi;
// 	// $kode_pengajuan = htmlspecialchars($data["kode_pengajuan"]);
// 	$kode_pengajuan = 1;
// 	$nama_barang = htmlspecialchars($data["nama_barang"]);
// 	$spek = htmlspecialchars($data["spek"]);
// 	$deskripsi = htmlspecialchars($data["deskripsi"]);
// 	$qty = htmlspecialchars($data["qty"]);
// 	$tgl_pengajuan = htmlspecialchars($data["tgl_pengajuan"]);
// 	$status = htmlspecialchars($data["status"]);
// 	$id_user = mysqli_real_escape_string($koneksi, $_SESSION["id_user"]);
// 	$new_kode_pengajuan = $kode_pengajuan+1;

// 	$query = "INSERT INTO barang VALUES
// 			('', '$new_kode_pengajuan', '$nama_barang', '$spek', '$deskripsi', '$qty', '$tgl_pengajuan', '$status','$id_user')";
// 	mysqli_query($koneksi, $query);

// 	return mysqli_affected_rows($koneksi);
// }


// function generate_kode_pengajuan() {
//   global $koneksi;
  
//   // Ambil nilai auto increment terakhir
//   $query = "SELECT MAX(CAST(SUBSTRING(kode_brg, 4) AS SIGNED)) AS kode_terakhir FROM req_barang";
//   $result = mysqli_query($koneksi, $query);
//   $row = mysqli_fetch_assoc($result);
//   $kode_terakhir = $row['kode_terakhir'];

//   // Generate kode barang baru
//   $kode_baru = "REQ". date('Ymd');
//   if ($kode_terakhir !== null) {
//     $kode_baru .= sprintf("%05d", $kode_terakhir + 1);
//   } else {
//     $kode_baru .= "00001";
//   }

//   return $kode_baru;
// }

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
	$jabatan = htmlspecialchars($data["jabatan"]);
	$divisi = htmlspecialchars($data["divisi"]);
	$status = htmlspecialchars($data["status"]);
	$tgl_lahir = htmlspecialchars($data["tgl_lahir"]);
	$jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$no_hp = htmlspecialchars($data["no_hp"]);
	$email = htmlspecialchars($data["email"]);
	$status_p = htmlspecialchars($data["status_pernikahan"]);
	$nik = htmlspecialchars($data["nik"]);
	$npwp = htmlspecialchars($data["npwp"]);

	// upload gambar
	$gambar =  upload();
	if (!$gambar) {
		return false;
	}

	$query = "INSERT INTO karyawan VALUES
			('', '$nama_emp', '$jabatan', '$divisi', '$status', '$gambar', '$tgl_lahir', '$jenis_kelamin', '$alamat', '$no_hp', '$email', '$status_p', '$nik', '$npwp')";
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
	$jabatan = htmlspecialchars($data["jabatan"]);
	$divisi = htmlspecialchars($data["divisi"]);
	$status = htmlspecialchars($data["status"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);
	$tgl_lahir = htmlspecialchars($data["tgl_lahir"]);
	$jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$no_hp = htmlspecialchars($data["no_hp"]);
	$email = htmlspecialchars($data["email"]);
	$status_p = htmlspecialchars($data["status_pernikahan"]);
	$nik = htmlspecialchars($data["nik"]);
	$npwp = htmlspecialchars($data["npwp"]);

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar']['error'] === 4 ) {
		$gambar = $gambarLama;
	} else {

		$gambar = upload();
	}


	$query = "UPDATE karyawan SET
				nama_emp = '$nama_emp',
				jabatan = '$jabatan',
				divisi = '$divisi',
				status = '$status',
				gambar = '$gambar',
				tgl_lahir = '$tgl_lahir',
				jenis_kelamin = '$jenis_kelamin',
				alamat = '$alamat',
				no_hp = '$no_hp',
				email = '$email',
				status_pernikahan = '$status_p',
				nik = '$nik',
				npwp = '$npwp'
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
    if ($status_cuti == "Sudah diapprove") {

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


// function generate_kode_barang() {
//   global $koneksi;
  
//   // Ambil nilai auto increment terakhir
//   $query = "SELECT MAX(CAST(SUBSTRING(kode_brg, 4) AS SIGNED)) AS kode_terakhir FROM storage_barang";
//   $result = mysqli_query($koneksi, $query);
//   $row = mysqli_fetch_assoc($result);
//   $kode_terakhir = $row['kode_terakhir'];

//   // Generate kode barang baru
//   $kode_baru = "BRG";
//   if ($kode_terakhir !== null) {
//     $kode_baru .= sprintf("%03d", $kode_terakhir + 1);
//   } else {
//     $kode_baru .= "001";
//   }

//   return $kode_baru;
// }

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

 function hapusBarang($kode_brg) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM barang WHERE kode_brg='$kode_brg'");

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

// function uploadGambarBarang(){

// 	$namaFile = $_FILES['gambar_barang']['name'];
// 	$ukuranFile = $_FILES['gambar_barang']['size'];
// 	$error = $_FILES['gambar_barang']['error'];
// 	$tmpName = $_FILES['gambar_barang']['tmp_name'];

// 	// cek apakah tidak ada gambar yang diupload
// 	if ($error === 4) {
// 		echo "
// 			<script>
// 				alert('pilih gambar terlebih dahulu!');
// 			</script>
// 		";
// 		return false;
// 	}

// 	// cek apakah yang diupload adalah gambar
// 	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
// 	$ekstensiGambar = explode('.', $namaFile);
// 	$ekstensiGambar = strtolower(end($ekstensiGambar));
// 	if (!in_array($ekstensiGambar, $ekstensiGambarValid) ){
// 		echo "
// 			<script>
// 				alert('yang anda upload bukan gambar!');
// 			</script>
// 		";
// 		return false;
// 	}

// 	// cek jika ukurannya terlalu besar
// 	if ($ukuranFile > 1000000){
// 		echo "
// 			<script>
// 				alert('ukuran gambar terlalu besar!');
// 			</script>
// 		";
// 		return false;
// 	}

// 	// Auto crop gambar menjadi 400 x 400 px
// 	$maxWidth = 400;
// 	$maxHeight = 400;

// 	list($width, $height) = getimagesize($tmpName);

// 	$ratio = min($maxWidth/$width, $maxHeight/$height);

// 	$newWidth = $width * $ratio;
// 	$newHeight = $height * $ratio;

// 	$imageResized = imagecreatetruecolor($newWidth, $newHeight);

// 	if ($ekstensiGambar == 'jpg' || $ekstensiGambar == 'jpeg') {
// 		$image = imagecreatefromjpeg($tmpName);
// 	} elseif ($ekstensiGambar == 'png') {
// 		$image = imagecreatefrompng($tmpName);
// 	}

// 	imagecopyresampled($imageResized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

// 	// Simpan gambar yang sudah di-crop
// 	$namaFileBaru = 'img/barang/' . uniqid() . '.' . $ekstensiGambar;

// 	if ($ekstensiGambar == 'jpg' || $ekstensiGambar == 'jpeg') {
// 		imagejpeg($imageResized, $namaFileBaru);
// 	} elseif ($ekstensiGambar == 'png') {
// 		imagepng($imageResized, $namaFileBaru);
// 	}

// 	imagedestroy($imageResized);

// 	// Hapus file sementara yang diupload
// 	unlink($tmpName);

// 	return $namaFileBaru;
//  }


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
	mysqli_query($koneksi, "DELETE FROM lokasi_barang WHERE id_lokasi=$id_lokasi");

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
	mysqli_query($koneksi, "DELETE FROM lokasi_room WHERE id_room=$id_room");

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



 ?>