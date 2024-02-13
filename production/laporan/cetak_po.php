<?php

if (isset($_GET['cetakData'])) {
    include "../koneksi.php";
    // ambil data di URL
    $id_user = $_GET["id_user"];

	// $jabatan = $_GET['jabatan'];
    // query data berdasarkan id
    $po_barang = query("SELECT * FROM po_barang JOIN no_po ON no_po.id_no_po=po_barang.id_no_po")[0];

    // $id_vendor = $_GET['id_vendor'];
    $id_no_po = $_GET['id_no_po'];
    $no_po = query("SELECT * FROM no_po WHERE id_no_po='$id_no_po'")[0];
}
?>

<!-- saved from url=(0058)https://sim.polibatam.ac.id/layanan-akademik/cetak_khs.php -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Purchase Order <?= $no_po['no_po']?> <?= date('d-M-Y')?></title>
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
                <div style="text-align: right; font-size: 16">
                    <!-- THE CENTRO TOWN HOUSE NO. 17 <br>
                    KEL. SUKAJADI, KEC. BATAM KOTA <br> -->
                    <strong>PT MITRA MARITIM MANDIRI</strong> <br>
                    The Centro Town House No. 17 <br>
                    Kel. Sukajadi, Kec. Batam Kota, Kota Batam <br>
                    Telepon +62 778 48844550 - Faksimile +62 778 48844550 <br>
                    info@mitramaritim.com
                </div>

                <div style="margin-top: -70px; margin-left: 20px">
                    <img src="img/Untitled-1.png" style="width:300px;">
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
                                <!-- <td height="25px"> <div align="center"><b>REKAP DATA</b></div> </td> -->
                            </tr>
                            <tr>
                                <td height="25px"> <div align="center" style="font-size:20px"><b>PURCHASE ORDER</b></div> </td>
                            </tr>
                            <tr>
                                <td height="25px"> <div align="center"><b>( <?= $po_barang['no_po']?> )</b></div> </td>
                            </tr>
                        </tbody></table>

                        <table width="90%" border="0" cellpadding="1" cellspacing="1" align="center" style="font-family:&#39;Times New Roman&#39;, Times, serif; font-size:12px">
                            <tbody><tr>
                                <td width="20%">&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php 
                                $query = "SELECT * FROM po_barang JOIN vendor ON vendor.id_vendor=po_barang.id_vendor JOIN req_barang ON req_barang.id_req_brg=po_barang.id_req_brg JOIN barang ON barang.kode_brg=req_barang.kode_brg JOIN satuan ON satuan.id_satuan=req_barang.id_satuan JOIN user ON user.id_user=po_barang.id_user JOIN karyawan ON karyawan.id_emp=user.id_emp WHERE id_no_po=$id_no_po";

                                // Add filter conditions based on the selected values
                                  // if (!empty($id_vendor)) {
                                  //     $query .= " WHERE po_barang.id_vendor = $id_vendor";
                                  // }

                        

                                $tampil = mysqli_query($koneksi, $query);
                                
                                if (mysqli_num_rows($tampil) > 0 ) {
                                    
                                
                                    $data = mysqli_fetch_assoc($tampil);
                                    
                                    $nama_pemeriksa = $data['nama_emp'];                               
                                    $nama_vendor = $data['nama_vendor'];
                                    $no_telp_vendor = $data['no_telp_vendor'];
                                    $tgl = date('d-M-Y', strtotime(date('d-M-Y')));
                             ?>
                            <tr>
                                <td>Nama Vendor</td>
                                <td><?= $nama_vendor?></td>
                            </tr>
                            <tr>
                                <td>No. Telp Vendor</td>
                                <?php
                                if (!empty($id_vendor)) {
                                    echo "<td>: $no_telp_vendor</td>";
                                } else {
                                    echo '<td>: - </td>';
                                } ?>
                            </tr>
                
                            <tr>
                                <td>Diorder Oleh  </td>
                                <?= "<td>: $nama_pemeriksa</td>"  ?>
                            </tr>
                            <tr>
                                <td>Tanggal PO</td>
                                <?= "<td>: $tgl</td>"  ?>
                            </tr>
                        <?php
                        } else {
                                // No data found, display a message or handle accordingly
                                echo '<td colspan="2">Tidak ada data yang ditemukan</td>';
                            }
                        ?>

                        </tbody></table><br>

                        <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" style="font-family:&#39;Times New Roman&#39;, Times, serif; font-size:12px">
                            <tbody>
                            <tr>
                                
                                <td height="72" class="kotak"> <div align="center"><b>No</b></div> </td>
                                <td bordercolor="#333333" height="72" class="kananAtasBawah"> <div align="center"><b>Kode Barang</b></div> </td>
                                <td height="72" class="kananAtasBawah"> <div align="center"> <b>Nama Barang</b></div> </td>
                                <td height="72" class="kananAtasBawah"> <div align="center"> <b>Spesifikasi</b></div> </td>
                                <td height="72" class="kananAtasBawah"> <div align="center"><b>Qty</b></div> </td>
                                <td height="72" class="kananAtasBawah"> <div align="center"><b>Satuan</b></div> </td>
                                <td height="72" class="kananAtasBawah"> <div align="center"><b>Harga Satuan</b></div> </td>
                                <td height="72" class="kananAtasBawah"> <div align="center"><b>Total Harga</b></div> </td>
                                <!-- <td height="36" class="kananAtasBawah"> <div align="center"><b>Deskripsi</b></div> </td> -->
                                
                                <!-- <td height="72" class="kananAtasBawah"> <div align="center"><b>K x N</b></div> </td> -->
                            </tr>
                            
                            
                            <tr>
                                <?php 
                                    $no = 1;
                                    $total = 0;
                                    $total_sum = 0;
                                    // // $selectedIds = explode(',', $_GET['select_id']);
                                    // if (!is_array($selectedIds)) {
                                    //     $selectedIds = array();
                                    // }
                                    $query = "SELECT * FROM po_barang JOIN vendor ON vendor.id_vendor=po_barang.id_vendor JOIN req_barang ON req_barang.id_req_brg=po_barang.id_req_brg JOIN barang ON barang.kode_brg=req_barang.kode_brg JOIN satuan ON satuan.id_satuan=req_barang.id_satuan JOIN user ON user.id_user=po_barang.id_user JOIN karyawan ON karyawan.id_emp=user.id_emp WHERE id_no_po=$id_no_po";
                           

                                      

                                    $tampil = mysqli_query($koneksi, $query);
                                    while ($data = mysqli_fetch_assoc($tampil)) {
                                        $jabatan = $data['jabatan'];
                                        $qty_po = $data['qty_po'];
                                        $total += $qty_po;
				                        $harga_po = $data['harga_po'];
				                     	$total_harga = $harga_po * $qty_po;
                                    	$total_sum += $total_harga;
                                    	$acc5 = $data['acc5'];
                                        if ($acc5==null) {
                                            $no_acc = "Belum Disetujui";
                                        }

                                    
                                 ?>
                                <td height="20" valign="top" align="center" class="kotak" style="padding:4px">&nbsp;<?= $no++; ?></td>
                                <td valign="top" align="center" class="kananAtasBawah" style="padding:4px">&nbsp;<?= $data['kode_brg'];?></td>
                                <td valign="top" align="center" class="kananAtasBawah" style="padding:4px"><?= $data['nama_barang'];?></td>
                                <td valign="top" align="left" class="kananAtasBawah" style="padding:4px"><?= $data['spek'];?></td>
                                <td valign="top" align="center" class="kananAtasBawah" style="padding:4px"><?= $data['qty_po'];?></td>
                                <td valign="top" align="center" class="kananAtasBawah" style="padding:4px"><?= $data['nama_satuan'];?></td>
                                <td valign="top" align="left" class="kananAtasBawah" style="padding:4px"><?= "Rp. ".number_format("$harga_po", 2, ",", "."); ?></td>
                                <td valign="top" align="left" class="kananAtasBawah" style="padding:4px"><?= "Rp. ".number_format("$total_harga", 2, ",", "."); ?></td>
                                                                
                            </tr>

                          
                        </tbody><?php }?>
                        <tr>
	                        <td height="20" valign="top" align="center" class="kotak" style="padding:4px" colspan="4"><strong>Jumlah</strong></td>
	                        
	                        <td valign="top" align="center" class="kananAtasBawah" style="padding:4px"><b><?= $total;?></b></td>
	                        <td valign="top" align="center" class="kananAtasBawah" style="padding:4px" colspan="2"><b>Total</b></td>
	                        <td valign="top" align="left" class="kananAtasBawah" style="padding:4px"><b><?= "Rp. ".number_format("$total_sum", 2, ",", "."); ?></b></td> 
	                    </tr>
                        <!-- <tr>
	                        <td height="20" valign="top" align="center" class="kotak" style="padding:4px">&nbsp;</td>
	                        <td valign="top" align="center" class="kananAtasBawah" style="padding:4px">&nbsp;</td>
	                        <td valign="top" align="center" class="kananAtasBawah" style="padding:4px">&nbsp;</td>
	                        <td valign="top" align="center" class="kananAtasBawah" style="padding:4px"><strong>Jumlah</strong></td> 
	                        <td valign="top" align="center" class="kananAtasBawah" style="padding:4px"><b><?= $total;?></b></td>
	                        <td valign="top" align="center" class="kananAtasBawah" style="padding:4px">&nbsp;</td>
	                        <td valign="top" align="right" class="kananAtasBawah" style="padding:4px">&nbsp;</td> 
	                        <td valign="top" align="left" class="kananAtasBawah" style="padding:4px"><b><?= "Rp. ".number_format("$total_sum", 2, ",", "."); ?></b></td> 
	                    </tr> -->
	                    <tr>
	                        <!-- <td height="20" valign="top" align="center" class="kotak" style="padding:4px" colspan="8">&nbsp;</td> -->
	                         
	                    </tr>
                    </table><br>
                    <div class="row">
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
                                <!-- <td align="center"><?php if (isset($jabatan)) echo " $jabatan "; ?></td> -->
                                <td align="center">Direktur Utama</td>
                            </tr>  

                            <tr>
                                <td colspan="3">
                                    <div align="right" style="position: relative; left:-75px;">
                                        <?php
                                        // Cek apakah $acc5 tidak null dan tidak kosong
                                        if ($acc5 !== null && $acc5 !== "") {
                                            // Tampilkan gambar QR code
                                            echo '<img src="../pdfqrcodes/' . $acc5 . '.png">';
                                        }else{
                                            echo "
                                                <tr>
                                                    <td> <div align='left'> </div> </td>
                                                    <td> <div align='left'>  </div> </td>
                                                    <td> <div align='left'></div> </td>
                                                </tr>
                                                <tr>
                                                    <td> <div align='left'></div> </td>
                                                    <td> <div align='left'>  </div> </td>
                                                    <td> <div align='left'></div> </td>
                                                </tr>
                                                <tr>
                                                    <td> <div align='left'></div> </td>
                                                    <td> <div align='left'> </div> </td>
                                                    <td> <div align='left'></div> </td>
                                                </tr>

                                                <tr>
                                                    <td colspan='2'> <div align='left'>&nbsp;</div> </td>
                                                    <td> <div align='center'></div> </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2'> <div align='left'>&nbsp;</div> </td>
                                                    <td> <div align='center'></div> </td>
                                                </tr>
                                                ";
                                        }
                                        ?>
                                    </div>
                                </td>
                            </tr>


                            <!-- <tr>
                                <td colspan="3"><div align="right" style="position: relative; left:-75px;"><img src="../pdfqrcodes/<?= $acc5.'.png';?>"></div></td>
                            </tr> -->

                            <tr>
                                <td width="37%"> <div align="left"></div> </td>
                                <td width="28%"> <div align="left"></div> </td>
                                <td width="55%"> <div align="left"></div> </td>
                            </tr>
                            <!-- <tr>
                                <td> <div align="left"> </div> </td>
                                <td> <div align="left">  </div> </td>
                                <td> <div align="left"></div> </td>
                            </tr> -->
                            <!-- <tr>
                                <td> <div align="left"></div> </td>
                                <td> <div align="left">  </div> </td>
                                <td> <div align="left"></div> </td>
                            </tr> -->
                            <!-- <tr>
                                <td> <div align="left"></div> </td>
                                <td> <div align="left"> </div> </td>
                                <td> <div align="left"></div> </td>
                            </tr>  -->  


                            <!-- <tr>
                                <td colspan="2"> <div align="left">&nbsp;</div> </td>
                                <td> <div align="center"></div> </td>
                            </tr>   --> 
                            <tr>
                                <td colspan="2"> <div align="left">&nbsp;</div><br><br> </td>
                                <!-- <td> <div align="center"><?php if (isset($acc5)) echo "( $acc5 )"; ?></div> </td> -->
                                <td>
                                  <div align="center" style="position:  relative;top: -20px;">
                                    <?php
                                      if (isset($acc5) AND $acc5 != null) {
                                        echo "<b>( $acc5 )</b>";
                                      } else {
                                        echo "( $no_acc )";
                                      }
                                    ?>
                                  </div>
                                </td>

                            </tr>
                        </tbody></table>

                    </div>





                    </td>
                </tr>
            </tbody></table>

    
</body></html>