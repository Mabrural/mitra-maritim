<?php

// $id_mhs = $_SESSION["id_mhs"];

// ambil data di URL
$id_user = $_GET["id_user"];
// query data mahasiswa berdasarkan id
$req_barang = query("SELECT * FROM req_barang WHERE id_user = $id_user")[0];

$tgl_req_brg = $_GET['tgl_req_brg'];



?>


    
      
					
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Rincian Data Permintaan<small></small></h2>
                  <!-- <form action="../../laporan/rekap_data.php" method="get">
        					<a href="laporan/rekap_data.php" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Cetak Data</a>
                  </form> -->
                  <form action="laporan/rekap_data.php" method="get">
                  <!-- <a href="laporan/rekap_data.php&id_user=<?= $data['id_user'];?>" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Cetak Data</a> -->
                      <input type="hidden" name="aksi">
                      <input type="hidden" name="id_user" value="<?= $req_barang['id_user'];?>">
                      <input type="hidden" name="tgl_req_brg" value="<?= $tgl_req_brg;?>">
                      <button type="submit" class="btn btn-info btn-sm" name="cetakData"><i class="fa fa-print"></i> Cetak Data</button>
                  </form>

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
									
				<div class="table-responsive">
          <table id="example" class="display" style="width:100%">
            <thead style="background-color: #2a3f54; color: #dfe5f1;">
              <tr class="headings">
                <!-- <th>
                  <input type="checkbox" class="flat" id="check-all" value="<?= $data['id_req_brg']; ?>">

                </th> -->
                <th class="column-title">No. </th>
                <th class="column-title">Kode Pengajuan </th>
                <th class="column-title">Kode Barang </th>
                <th class="column-title">Nama Barang </th>
                <th class="column-title">Spesifikasi </th>
                <th class="column-title">Deskripsi </th>
                <th class="column-title">Qty </th>
                <th class="column-title">Satuan </th>
                <th class="column-title">Tanggal Pengajuan </th>
                <th class="column-title">Nama Pemohon </th>
                <th class="column-title">Approval 1 </th>
                <th class="column-title">Approval 2 </th>
                <th class="column-title">Status </th>
                <!-- <th class="column-title no-link last"><span class="nobr">Action</span> -->
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
              		$query = "SELECT * FROM req_barang JOIN user ON user.id_user=req_barang.id_user JOIN karyawan ON karyawan.id_emp=user.id_emp JOIN barang ON barang.kode_brg=req_barang.kode_brg JOIN satuan ON satuan.id_satuan=req_barang.id_satuan WHERE status_req='On Progress in Purchasing' AND req_barang.id_user=$id_user AND req_barang.tgl_req_brg='$tgl_req_brg'";
                  // $query2 = "SELECT * FROM karyawan JOIN user ON user.id_emp=karyawan.id_emp JOIN barang ON user.id_user=barang.id_user WHERE user.id_user=$id_user AND barang.status='On Progress in Purchasing' GROUP BY karyawan.nama_emp, barang.tgl_pengajuan ORDER BY barang.tgl_pengajuan DESC";
              		// $query = "SELECT * FROM barang JOIN user ON user.id_user=barang.id_user WHERE status='Sudah disetujui' AND barang.id_user=$id_user";
              		// $query = "SELECT * FROM barang WHERE barang.id_user=$id_user";
                  $tampil = mysqli_query($koneksi, $query);
                  // $tampil2 = mysqli_query($koneksi, $query2);
                  // $data2 = mysqli_fetch_assoc($tampil2);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              		
              		

              	 ?>
                <!-- <td><input type="checkbox" class="flat" name="check[]" value="<?= $data['kode_pengajuan']; ?>"></td> -->
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['kode_pengajuan'];?></td>
                <td class=" "><?= $data['kode_brg'];?></td>
                <td class=" "><?= $data['nama_barang'];?> </td>
                <td class=" "><?= $data['spek'];?></td>
                <td class=" "><?= $data['deskripsi'];?></td>
                <td class=" "><?= $data['qty_req'];?></td>
                <td class=" "><?= $data['nama_satuan'];?></td>
                <td class=" "><?= date('d-M-Y', strtotime($data['tgl_req_brg']));?></td>

                <td class=" "><strong><?= $data['nama_emp'];?></strong></td>
                <td class=" "><?= $data['acc1'];?></td>
                <td class=" "><?= $data['acc2'];?></td>
                <td class=" ">
                    <strong style="background-color: <?php
                    if ($data['status_req'] == 'Menunggu Persetujuan KC') {
                        echo '#b58709';
                    } elseif ($data['status_req'] == 'Menunggu Persetujuan Dir.Ops') {
                        echo '#b58709';
                    } elseif ($data['status_req'] == 'On Progress in Purchasing') {
                        echo '#b58709';
                    } elseif ($data['status_req'] == 'Menunggu Persetujuan Dir. HRD') {
                        echo '#b58709';
                    } elseif ($data['status_req'] == 'Menunggu Persetujuan Dir. Keuangan') {
                        echo '#b58709';
                    } elseif ($data['status_req'] == 'Menunggu Persetujuan Dir. Utama') {
                        echo '#b58709';
                    } elseif ($data['status_req'] == 'Ditolak') {
                        echo '#a62f26';
                    } else {
                        echo '#14a664';
                    }
                ?>


                    ; color: white; padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 5px; font-weight: normal;"><?= $data['status_req'];?></strong>
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



          <script>
            $(document).ready(function(){
              // Handler untuk checkbox "Check All"
              $('#check-all').click(function(){
                $('input[name="check[]"]').prop('checked', this.checked);
              });

              // Handler untuk checkbox pada setiap baris
              $('input[name="check[]"]').click(function(){
                if(!$('input[name="check[]"]:not(:checked)').length){
                  $('#check-all').prop('checked', true);
                } else {
                  $('#check-all').prop('checked', false);
                }
              });
            });
          </script>



        </div>
								</div>
							</div>
						</div>
					</div>

				




					
				</div>
    
