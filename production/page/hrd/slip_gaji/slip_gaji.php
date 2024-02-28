<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Slip Gaji Karyawan <small></small></h2>
        <a href="?form=tambahSlip" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Tambah Slip Gaji</a>
       
        <div class="clearfix"></div>
      </div>
 
      <div class="row"><br><br>
            <div class="col-md-12">
            <form method="get">
                <div class="col-md-2 col-sm-4">
                    <input type="hidden" name="page" value="slipGaji">
                    <input type="hidden" name="aksi">
                    <label for="periode_awal">Periode Awal</label>
                    <input type="month" name="periode_awal" id="periode_awal" class="form-control" value="<?php echo isset($_GET['periode_awal']) ? $_GET['periode_awal'] : ''; ?>">
                </div>
                <div class="col-md-2 col-sm-4">
                    <label for="periode_akhir">Periode Akhir</label>
                    <input type="month" name="periode_akhir" id="periode_akhir" class="form-control" value="<?php echo isset($_GET['periode_akhir']) ? $_GET['periode_akhir'] : ''; ?>">
                </div>
                <div class="col-md-2 col-sm-4">
                <label for="periode_akhir"></label><br>

                    <button type="submit" class="btn btn-primary mt-2">Filter</button>
                </div>
            </form>
            </div>
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
                <th class="column-title">Nama Karyawan</th>
                <th class="column-title">Jabatan </th>
                <th class="column-title">Periode </th>
                <th class="column-title">Tanggal Terbit </th>
                <th class="column-title">Slip Gaji </th>
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
                    $query = "SELECT * FROM slip_gaji 
                      JOIN karyawan ON karyawan.id_emp=slip_gaji.id_emp 
                      JOIN jabatan ON jabatan.id_jabatan=karyawan.id_jabatan 
                      JOIN user ON user.id_emp=karyawan.id_emp 
                     ";
            
                    // Tambahkan kondisi WHERE untuk filter rentang periode
                    if (!empty($_GET['periode_awal']) && isset($_GET['periode_akhir'])) {
                        $periode_awal = htmlspecialchars($_GET['periode_awal']);
                        $periode_akhir = htmlspecialchars($_GET['periode_akhir']);
                        $query .= " AND slip_gaji.periode BETWEEN '$periode_awal' AND '$periode_akhir'";
                    }
              		// $query = "SELECT * FROM slip_gaji JOIN karyawan ON karyawan.id_emp=slip_gaji.id_emp JOIN jabatan ON jabatan.id_jabatan=karyawan.id_jabatan ORDER BY id_slip DESC";
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	      		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><a href="?form=rincianKaryawan&id_emp=<?=$data["id_emp"]?>"><?= $data['nama_emp'];?></a></td>
                <td class=" "><?= $data['nama_jabatan'];?> </td>
                <td class=" "><?= date('F Y', strtotime($data['periode']));?> </td>
                <td class=" "><?= date('d/m/Y', strtotime($data['tgl_terbit']));?>  </td>
                <td class=" "><a href="files/slip_gaji/<?= $data['slip_gaji'];?>" style="color:blue; text-decoration: underline;">Lihat Slip Gaji</a></td>
            

                <td class=" last"><a href="?form=ubahSlip&id_slip=<?= $data["id_slip"]; ?>" class="btn btn-info btn-sm"> <i class="fa fa-edit"></i> Ubah</a>
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
