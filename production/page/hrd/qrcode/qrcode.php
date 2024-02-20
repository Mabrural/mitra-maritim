<?php

$id_user = $_SESSION["id_user"];
require_once('phpqrcode/qrlib.php'); 
// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>QRCode <small></small></h2>
        <a href="?form=tambahQrcode" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Buat QRCode</a>
        <!-- <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Settings 1</a>
                <a class="dropdown-item" href="#">Settings 2</a>
              </div>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul> -->
        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <!-- <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p> -->

        <div class="table-responsive">
          <table id="example" class="display" style="width:100%">
            <thead style="background-color: #2a3f54; color: #dfe5f1;">
              <tr class="headings">
                <!-- <th>
                  <input type="checkbox" id="check-all" class="flat">
                </th> -->
                <th class="column-title">No. </th>
                <th class="column-title">QRCode </th>
                <th class="column-title">Nama </th>
                <th class="column-title">Jabatan </th>
                <th class="column-title no-link last"><span class="nobr">Action</span>
                </th>
                <th class="bulk-actions" colspan="7">
                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th>
              </tr>
            </thead>

            <tbody>
              <tr class="even pointer">
              	<?php 
              		$no = 1;
              		$query = "SELECT * FROM qrcode JOIN karyawan ON karyawan.id_emp=qrcode.id_emp JOIN divisi ON divisi.id_divisi=karyawan.id_divisi JOIN jabatan ON jabatan.id_jabatan=karyawan.id_jabatan";
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	      	$qrvalue = $data["nama_emp"];
			
						$tempDir = "pdfqrcodes/"; 
						$codeContents = $qrvalue; 
						$fileName = $qrvalue . '.png'; 
						$pngAbsoluteFilePath = $tempDir.$fileName; 
						$urlRelativeFilePath = $tempDir.$fileName; 
						if (!file_exists($pngAbsoluteFilePath)) { 
							QRcode::png($codeContents, $pngAbsoluteFilePath); 
						}

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><a href="pdfqrcodes/<?= $data['nama_emp'].'.png';?>"><img src="pdfqrcodes/<?= $data['nama_emp'].'.png';?>" width="50"></a></td>
                <td class=" "><a href="?form=rincianKaryawan&id_emp=<?=$data["id_emp"]?>"><?= $data['nama_emp'];?></a></td>
                <td class=" "><?= $data['nama_jabatan'];?> </td>

                <td class=" last"> <a href="?form=hapusQrcode&id_qr=<?= $data["id_qr"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
                </td>
              </tr>
              <?php } ?>
           
            </tbody>
           
          </table>

          <script type="text/javascript">
          $(document).ready(function() {
              // Periksa apakah ada data dalam tabel
              if ($('#example tbody td').length > 0) {
                  new DataTable('#example', {
                      responsive: true,
                      columnDefs: [
                          {
                              targets: -1,
                              responsivePriority: 'auto'
                          }
                      ]
                  });
              } else {
                  // Jika tidak ada data, inisialisasi DataTable tanpa responsivitas
                  $('#example').DataTable();
              }
          });

          </script>
        </div>
				
			
      </div>
    </div>
