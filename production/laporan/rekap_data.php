<?php

if (isset($_GET['cetakData'])) {
	include "../koneksi.php";
    // ambil data di URL
	$id_user = $_GET["id_user"];
	// query data mahasiswa berdasarkan id
	$req_barang = query("SELECT * FROM req_barang WHERE id_user = $id_user")[0];

	$tgl_req_brg = $_GET['tgl_req_brg'];
}
?>

<!-- saved from url=(0058)https://sim.polibatam.ac.id/layanan-akademik/cetak_khs.php -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<title>Rekap Data Pengajuan Barang</title>
			<link rel="icon" href="img/gpp.png" type="image/ico" />
			<script language="JavaScript">
				function Cetakan(){
					document.getElementById("button_cetak").style.display = "none";
					document.getElementById("kop").style.display = "block";
					window.print();
					alert("Jangan di tekan tombol OK sebelum dokumen selesai tercetak!");
					document.getElementById("button_cetak").style.display = "block";
					document.getElementById("kop").style.display = "none";
				}
			</script>
		<style>
			/* CSS Document */
			TD.kotak
			{
			border-style : solid;border-top-width :1px;border-bottom-width :1px;border-left-width :1px;border-right-width:1px; border-color:#000000;
			}
			TD.kiri
			{
			border-style : solid;border-top-width :0px;border-bottom-width :0px;border-left-width :1px;border-right-width:0px; border-color:#000000;
			}
			TD.kiriKanan
			{
			border-style : solid;border-top-width :0px;border-bottom-width :0px;border-left-width :1px;border-right-width:1px; border-color:#000000;
			}
			TD.kiriKananBawah
			{
			border-style : solid;border-top-width :0px;border-bottom-width :1px;border-left-width :1px;border-right-width:1px; border-color:#000000;
			}
			TD.kiriKananAtas
			{
			border-style : solid;border-top-width :1px;border-bottom-width :0px;border-left-width :1px;border-right-width:1px; border-color:#000000;
			}
			TD.kiriBawah
			{
			border-style : solid;border-top-width :0px;border-bottom-width :1px;border-left-width :1px;border-right-width:0px; border-color:#000000;
			}
			TD.kanan
			{
			border-style : solid;border-top-width :0px;border-bottom-width :0px;border-left-width :0px;border-right-width:1px;border-color:#000000;
			}
			TD.kananBawah
			{
			border-style : solid;border-top-width :0px;border-bottom-width :1px;border-left-width :0px;border-right-width:1px;border-color:#000000;
			}
			TD.kananAtasBawah
			{
			border-style : solid;border-top-width :1px;border-bottom-width :1px;border-left-width :0px;border-right-width:1px;border-color:#000000;
			}
			TD.kiriAtas
			{
			border-style : solid;border-top-width :1px;border-bottom-width :0px;border-left-width :1px;border-right-width:0px;border-color:#000000;
			}
			TD.kananAtas
			{
			border-style : solid;border-top-width :1px;border-bottom-width :0px;border-left-width :0px;border-right-width:1px;border-color:#000000;
			}
			TD.Atas
			{
			border-style : solid;border-top-width :1px;border-bottom-width :0px;border-left-width :0px;border-right-width:0px;border-color:#000000;
			}
			TD.Bawah
			{
			border-style : solid;border-top-width :0px;border-bottom-width :1px;border-left-width :0px;border-right-width:0px;border-color:#000000;
			}

			td.judul
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:15px; text-align:center; color:#FFFFFF; font-weight:bold;
			}

			td.sub_judul
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:13px; text-align:center; color:#0272FF; line-height:25px; font-weight:bold;
			}

			td.nmkolom
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:12px; text-align:center; color:#FF0000; line-height:25px; font-weight:bold; padding:2px;
			}

			td.isikolom
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:12px; color:#0272FF; line-height:25px; padding:2px;
			}

			td.isikolomkecil
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:10px; line-height:25px; padding:2px;
			}

			td.isikolomtebal
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:12px; color:#0272FF; line-height:25px; font-weight:bold; padding:2px;
			}

			td.cekbok
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:12px; text-align:left; color:#FFFFFF;
			}

			td.nmkolomLap
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:12px; text-align:center; line-height:25px; font-weight:bold; padding:2px;
			}

			td.isikolomLap
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:12px; padding:2px;
			}

			td.isikolomLapTebal
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:12px; font-weight:bold; padding:2px;
			}

			td.isikolomLap2
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:12px; padding:2px;
			}

			td.judulLap
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:15px; font-weight:bold;
			}

			td.sub_judulLap
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:13px; text-align:center; font-weight:bold; line-height:18px;
			}

			td.sub_judulLap2
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:12px; font-weight:bold; line-height:18px;
			}

			body.bg{
			background-image:url(xbgclr.jpg); background-repeat:repeat-x
			}

			td.judulLapTahun
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:11px; font-weight:bold; line-height:18px;
			}

			td.sub_judulLapTahun
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:10px; text-align:center; font-weight:bold; line-height:15px;
			}

			td.sub_judulLapTahun2
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:10px; font-weight:bold; line-height:15px;
			}

			td.nmkolomLapTahun
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:9px; text-align:center; line-height:15px; font-weight:bold; padding:2px;
			}

			td.isikolomLapTahun
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:9px; line-height:15px; padding:2px;
			}

			td.isikolomLapTahun2
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:9px; line-height:15px; padding:2px; background-color:#FFFF99; color:#000000;
			}

			td.isikolomLapTahun3
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:9px; line-height:15px; padding:2px; background-color:#AAEBF2; color:#000000;
			}

			td.judulLapTipis
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:12px; line-height:15px;
			}

			td.judulLapTebal
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:18px; font-weight:bold; text-align:center; line-height:20px;
			}

			td.judulLapTebal2
			{ 
			font-family:Helvetica, Verdana, Arial, sans-serif; font-size:14px; font-weight:bold; text-align:center; line-height:20px;
			}
		</style></head>

		

		

		<body>
			<div id="kop" style="display: none">
				<div style="text-align: right; font-size: 18">
					<!-- THE CENTRO TOWN HOUSE NO. 17 <br>
					KEL. SUKAJADI, KEC. BATAM KOTA <br> -->
					<strong>PT GLOBAL PETRO PASIFIC</strong> <br>
					The Centro Town House No. 17 <br>
					Kel. Sukajadi, Kec. Batam Kota, Kota Batam <br>
					<!-- Telepon +62 778 469856 - 469860 Faksimile +62 778 463620 <br> -->
					Laman: www.globalpetro.co.id, Surel: info@globalpetro.co.id
				</div>

				<div style="margin-top: -70px; margin-left: 20px">
					<img src="img/Logo Global Petro.jpg" style="width:300px;">
					<!-- <img src="../img_sim/logo_polibatam.png" style="width:100px;"> -->
				</div>

				<div style="text-align: right; margin-top: -10px; margin-right: 10px">
					<!-- <img src="./KHS Mahasiswa_files/logo_urs.png" style="width:120px;"> -->
					<!-- <img src="../img_sim/logo_urs.png" style="width:120px;"> -->
				</div><br><br>
				<hr style=" border: 1px solid black">
			</div>

			<table width="794px" height="1123px" align="center" cellpadding="0" cellspacing="0" border="0">
				<tbody><tr>
					<td valign="top">
						<table width="90%" border="0" align="center" cellpadding="0" cellspacing="1" style="font-family:&#39;Trebuchet MS&#39;, Arial, Helvetica, sans-serif;">
							<tbody><tr id="button_cetak">
								<td colspan="2">
									<input type="button" name="Button" value="Cetak" onclick="Cetakan()">
								</td>
							</tr>
						</tbody></table>

						<table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" style="font-family:&#39;Times New Roman&#39;, Times, serif; font-size:16px">
							<tbody><tr>
								<td height="25px"> <div align="center"><b>REKAP DATA</b></div> </td>
							</tr>
							<tr>
								<td height="25px"> <div align="center"><b>PERMINTAAN BARANG</b></div> </td>
							</tr>
						</tbody></table>

						<table width="90%" border="0" cellpadding="1" cellspacing="1" align="center" style="font-family:&#39;Times New Roman&#39;, Times, serif; font-size:12px">
							<tbody><tr>
								<td width="20%">&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<?php 
								$query = "SELECT * FROM user JOIN karyawan ON karyawan.id_emp=user.id_emp WHERE id_user='$id_user'";
								$query2 = "SELECT * FROM req_barang WHERE id_user='$id_user'";
								$tampil = mysqli_query($koneksi, $query);
								$tampil2 = mysqli_query($koneksi, $query2);
								$data = mysqli_fetch_assoc($tampil);
								$data2 = mysqli_fetch_assoc($tampil2);
								$nama_pemohon = $data['nama_emp'];
							 	$jabatan = $data['jabatan'];
							 	$divisi = $data['divisi'];
							 	$acc1 = $data2['acc1'];
							 	$acc2 = $data2['acc2'];
							 	$acc3 = $data2['acc3'];
							 	$tgl = date('d-M-Y', strtotime($tgl_req_brg));
							 ?>
							<tr>
								<td>Nama Pemohon</td>
								<?= "<td>: $nama_pemohon</td>"  ?>
							</tr>
							<tr>
								<td>Jabatan</td>
								<?= "<td>: $jabatan</td>"  ?>
							</tr>
							<tr>
								<td>Divisi</td>
								<?= "<td>: $divisi</td>"  ?>
							</tr>
							<tr>
								<td>Disetujui Oleh  </td>
								<?= "<td>: $acc1 & $acc2</td>"  ?>
							</tr>
							<tr>
								<td>Tanggal Pengajuan</td>
								<?= "<td>: $tgl</td>"  ?>
							</tr>


						</tbody></table><br>

						<table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" style="font-family:&#39;Times New Roman&#39;, Times, serif; font-size:12px">
							<tbody>
							<tr>
								
								<td height="72" class="kotak"> <div align="center"><b>No</b></div> </td>
								<td bordercolor="#333333" height="72" class="kananAtasBawah"> <div align="center"><b>Kode Pengajuan</b></div> </td>
								<td height="72" class="kananAtasBawah"> <div align="center"> <b>Kode Barang</b></div> </td>
								<td height="72" class="kananAtasBawah"> <div align="center"> <b>Nama Barang</b></div> </td>
								<td height="72" class="kananAtasBawah"> <div align="center"><b>Qty</b></div> </td>
								<td height="72" class="kananAtasBawah"> <div align="center"><b>Satuan</b></div> </td>
								<td height="72" class="kananAtasBawah"> <div align="center"><b>Spesifikasi</b></div> </td>
								<!-- <td height="36" class="kananAtasBawah"> <div align="center"><b>Deskripsi</b></div> </td> -->
								
								<!-- <td height="72" class="kananAtasBawah"> <div align="center"><b>K x N</b></div> </td> -->
							</tr>
							
							
							<tr>
								<?php 
				              		$no = 1;
				              		$total = 0;
				              		$query = "SELECT * FROM req_barang JOIN user ON user.id_user=req_barang.id_user JOIN barang ON barang.kode_brg=req_barang.kode_brg JOIN satuan ON satuan.id_satuan=req_barang.id_satuan WHERE status_req='On Progress in Purchasing' AND req_barang.id_user=$id_user AND req_barang.tgl_req_brg='$tgl_req_brg'";
				              		 // $query = "SELECT *, SUM(qty_req) AS total_qty FROM req_barang JOIN user ON user.id_user=req_barang.id_user JOIN barang ON barang.kode_brg=req_barang.kode_brg WHERE status_req='On Progress in Purchasing' AND req_barang.id_user=$id_user AND req_barang.tgl_req_brg='$tgl_req_brg'";
				              		$tampil = mysqli_query($koneksi, $query);
				              		while ($data = mysqli_fetch_assoc($tampil)) {

					              		$qty_req = $data['qty_req'];
					              		$total += $qty_req;
				              		// $qty_req_arr = explode(',', $qty_req);
				              		// $total = array_sum($qty_req_arr);
				              		

				              	 ?>
								<td height="20" valign="top" align="center" class="kotak" style="padding:4px">&nbsp;<?= $no++; ?></td>
								<td valign="top" align="center" class="kananAtasBawah" style="padding:4px">&nbsp;<?= $data['kode_pengajuan'];?></td>
								<td valign="top" align="center" class="kananAtasBawah" style="padding:4px"><?= $data['kode_brg'];?></td>
								<td valign="top" align="left" class="kananAtasBawah" style="padding:4px"><?= $data['nama_barang'];?></td>
								<td valign="top" align="center" class="kananAtasBawah" style="padding:4px"><?= $data['qty_req'];?></td>
								<td valign="top" align="center" class="kananAtasBawah" style="padding:4px"><?= $data['nama_satuan'];?></td>
								<td valign="top" align="left" class="kananAtasBawah" style="padding:4px"><?= $data['spek'];?></td>
								<!-- <td valign="top" align="left" class="kananAtasBawah" style="padding:4px"><?= $data['deskripsi'];?></td> -->
																
							</tr>

							
						</tbody><?php } ?>
						<tr>
								<!-- <td height="20" valign="top" align="center" class="kotak" style="padding:4px">&nbsp;</td>
								<td valign="top" align="center" class="kananAtasBawah" style="padding:4px">&nbsp;</td>
								<td valign="top" align="center" class="kananAtasBawah" style="padding:4px">&nbsp;</td>
								<td valign="top" align="center" class="kananAtasBawah" style="padding:4px">Jumlah</td> 
								<td valign="top" align="center" class="kananAtasBawah" style="padding:4px"><?= $total;?></td>
								<td valign="top" align="center" class="kananAtasBawah" style="padding:4px">&nbsp;</td> -->
								<!-- <td valign="top" align="center" class="kananAtasBawah" style="padding:4px">&nbsp;</td>  -->
							</tr>
					</table><br>

						<table width="90%" border="0" cellpadding="1" cellspacing="1" align="center" style="font-family:&#39;Times New Roman&#39;, Times, serif; font-size:12px">
							<tbody><tr>
								<td colspan="2">&nbsp;</td>
								<td align="center">Batam, <?= date('d-M-Y');?></td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
								<td align="center">Mengetahui,</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
								<td align="center">Direktur Operasional</td>
							</tr>	
							<tr>
								<td width="37%"> <div align="left"></div> </td>
								<td width="28%"> <div align="left"></div> </td>
								<td width="55%"> <div align="left"></div> </td>
							</tr>
							<tr>
								<td> <div align="left"> </div> </td>
								<td> <div align="left">  </div> </td>
								<td> <div align="left"></div> </td>
							</tr>
							<tr>
								<td> <div align="left"></div> </td>
								<td> <div align="left">  </div> </td>
								<td> <div align="left"></div> </td>
							</tr>
							<tr>
								<td> <div align="left"></div> </td>
								<td> <div align="left"> </div> </td>
								<td> <div align="left"></div> </td>
							</tr>	
							<tr>
								<td colspan="2"> <div align="left">&nbsp;</div> </td>
								<td> <div align="center"></div> </td>
							</tr>	
							<tr>
								<td colspan="2"> <div align="left">&nbsp;</div><br><br> </td>
								<td> <div align="center">( <?= $acc3;?> ) </div> </td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			</tbody></table>

	
</body></html>