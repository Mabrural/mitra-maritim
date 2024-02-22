<?php
// get_mahasiswa_data.php


if (isset($_GET['voy_num'])) {
    $selectedVoy = $_GET['voy_num'];

    // Lakukan koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = "78789898";
    $dbname = "sistem";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query untuk mendapatkan data mahasiswa berdasarkan NIM
    $sql = "SELECT vessel.nama_vessel, jenis_kargo.nama_kargo FROM sales_plan JOIN vessel ON vessel.id_vessel=sales_plan.id_vessel JOIN jenis_kargo ON jenis_kargo.id_kargo=sales_plan.id_kargo WHERE sales_plan.voy_num = '$selectedVoy'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<label for='namaMahasiswa'>Nama Mahasiswa:</label>";
        echo "<input type='text' id='namaMahasiswa' name='namaMahasiswa' value='" . $row["nama_vessel"] . "' disabled><br>";
        echo "<label for='jurusanMahasiswa'>Jurusan Mahasiswa:</label>";
        echo "<input type='text' id='jurusanMahasiswa' name='jurusanMahasiswa' value='" . $row["nama_kargo"] . "' disabled>";
    }

    $conn->close();
}
?>
