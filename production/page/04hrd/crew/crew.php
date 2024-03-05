<?php

$id_user = $_SESSION["id_user"];

$vessel = query("SELECT * FROM vessel");
$posisi = query("SELECT * FROM posisi_crew");
$id_vessel = isset($_GET['id_vessel']) ? $_GET['id_vessel'] : '';
$id_posisi = isset($_GET['id_posisi']) ? $_GET['id_posisi'] : '';

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Crew Armada<small></small></h2>

          <form action="laporan/cetak_inventaris.php" method="get">
              <input type="hidden" name="aksi">
              <input type="hidden" name="id_user" value="<?= $id_user;?>">
              <input type="hidden" name="id_lokasi" value="<?= $id_vessel;?>">
              <input type="hidden" name="id_room" value="<?= $id_posisi;?>">
              <!-- <button type="submit" class="btn btn-info btn-sm" name="cetakData"><i class="fa fa-print"></i> Cetak Data</button> -->
              
          </form>
        <a href="?form=tambahCrew" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Crew</a>
        <a href="?page=crew" class="btn btn-dark btn-sm btn disabled"><i class="fa fa-users"></i> Crew Armada</a>
        <a href="?page=masterBank" class="btn btn-warning btn-sm"><i class="fa fa-bank"></i> Master Bank</a>
        <a href="?page=masterPosisi" class="btn btn-dark btn-sm"><i class="fa fa-ship"></i> Master Posisi</a>
        <a href="?page=kontrakCrew" class="btn btn-success btn-sm  "><i class="fa fa-file-text-o"></i> Kontrak Crew</a>
        <div class="clearfix"></div>
      </div>

          <div class="col-md-2 col-sm-6">
              <form method="get">
                <input type="hidden" name="aksi">
                  <select class="form-control" name="id_vessel" id="id_vessel" required>
                      <option value="">--Pilih Kapal--</option>
                      <?php foreach($vessel as $row) : ?>
                          <option value="<?= $row['id_vessel']?>" <?php echo ($id_vessel == $row['id_vessel']) ? 'selected' : ''; ?>>
                              <?= $row['nama_vessel']?>
                          </option>
                      <?php endforeach;?> 
                  </select><br>
              </form>
          </div>

          <div class="col-md-2 col-sm-6">
              <select class="form-control" name="id_posisi" id="id_posisi" required>
                  <option value="">--Pilih Posisi--</option>
                  <?php foreach($posisi as $row) : ?>
                      <option value="<?= $row['id_posisi']?>" <?php echo ($id_posisi == $row['id_posisi']) ? 'selected' : ''; ?>>
                          <?= $row['nama_posisi']?>
                      </option>
                  <?php endforeach;?> 
              </select>
                <br>
          </div>

      <div class="x_content">

      <script type="text/javascript">
        $(document).ready(function() {
            // Add change event listeners to the dropdowns
            $('#id_vessel, #id_posisi').change(function() {
                // Get selected values
                var id_vessel = $('#id_vessel').val();
                var id_posisi = $('#id_posisi').val();

                // Redirect to the current page with filter parameters
                window.location.href = '?page=crew&id_vessel=' + id_vessel + '&id_posisi=' + id_posisi;
            });

            // ... (rest of the JavaScript code)
        });
      </script>

        <!-- <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p> -->

        <div class="table-responsive">
          <table id="example" class="display" style="width:100%">
            <thead style="background-color: #2a3f54; color: #dfe5f1;">
              <tr class="headings">
                <!-- <th>
                  <input type="checkbox" id="check-all" class="flat">
                </th> -->
                <th class="column-title">No. </th>
                <th class="column-title">Nama Crew </th>
                <th class="column-title">Kapal</th>
                <th class="column-title">Posisi</th>
                <th class="column-title">NIK </th>
                <th class="column-title">NPWP </th>
                <th class="column-title">Tempat, Tanggal Lahir </th>
                <th class="column-title">Jenis Kelamin </th>
                <th class="column-title">Bank - No. Rekening</th>
                <th class="column-title">Lampiran</th>
                
                           
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
              		$query = "SELECT * FROM crew JOIN bank ON bank.id_bank=crew.id_bank JOIN vessel ON vessel.id_vessel=crew.id_vessel JOIN posisi_crew ON posisi_crew.id_posisi=crew.id_posisi";
              		
                  // Add filter conditions based on the selected values
                  if (!empty($id_vessel)) {
                    $query .= " WHERE crew.id_vessel = $id_vessel";
                  }

                  if (!empty($id_posisi)) {
                      $query .= (!empty($id_posisi)) ? " AND " : " WHERE ";
                      $query .= "crew.id_posisi = $id_posisi";
                  }

                  $query .= " ORDER BY crew.id_crew DESC";


              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['nama_crew'];?></td>
                <td class=" "><?= $data['nama_vessel'];?></td>   
                <td class=" "><?= $data['nama_posisi'];?></td>
                <td class=" "><?= $data['nik'];?></td>
                <td class=" "><?= $data['npwp'];?></td>
                <td class=" "><?= $data['tmp_lahir'];?>, <?= date('d/m/Y', strtotime($data['tgl_lahircrew']));?></td>
                <td class=" "><?= $data['jk_crew'];?></td>
                
                <td class=" "><?= $data['nama_bank'];?> - <?= $data['no_rek'];?></td>
                <td class=" "><a href="?form=lihatLampiran&id_crew=<?= $data['id_crew']?>" style="text-decoration:underline; color: blue;">Lihat lampiran</a></td>
                
            
                <td class=" last"><a href="?form=ubahCrew&id_crew=<?= $data["id_crew"]; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Ubah </a> | <a href="?form=hapusCrew&id_crew=<?= $data["id_crew"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Hapus </a>
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


          <!-- <script type="text/javascript">
            new DataTable('#example', {
            responsive: true,
            columnDefs: [
              {
                targets: -1,
                responsivePriority: 'auto'
              }
            ]
          });

          </script> -->
        </div>
				
			
      </div>
    </div>
