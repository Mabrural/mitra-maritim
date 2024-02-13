<?php

$id_user = $_SESSION["id_user"];

$no_jurnal = $_GET['no_jurnal'];

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>No. Journal : <?= $no_jurnal?><small></small></h2>
        <a href="?form=tambahDataJournal&no_jurnal=<?= $no_jurnal;?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
        
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
                <th class="column-title">No. Journal </th>
                <th class="column-title">Tanggal Journal </th>
                <th class="column-title">No. Account </th>
                <th class="column-title">Account </th>
                <th class="column-title">Keterangan </th>
                <th class="column-title">Debit </th>
                <th class="column-title">Kredit </th>
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
                  $totalDebit = 0;
                  $totalKredit = 0;
              		$query = "SELECT * FROM jurnal JOIN no_jurnal ON no_jurnal.no_jurnal=jurnal.no_jurnal JOIN cart_of_account ON cart_of_account.kode_coa=jurnal.kode_coa WHERE jurnal.no_jurnal='$no_jurnal'";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
                      $debit = $data['debit'];
              	     	$kredit = $data['kredit'];
                      $totalDebit += $debit;
                      $totalKredit += $kredit;
              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['no_jurnal'];?></td>
                <td class=" "><?= date('d-M-Y', strtotime($data['tgl_jurnal']));?></td>
                <td class=" "><?= $data['kode_coa'];?></td>
                <td class=" "><?= $data['name_account'];?></td>
                <td class=" "><?= $data['ket_jurnal'];?></td>
                <td class=" "><?= "Rp. ".number_format("$debit", 2, ",", "."); ?></td>
                <td class=" "><?= "Rp. ".number_format("$kredit", 2, ",", "."); ?></td>
                
                <td class=" last"><a href="?form=ubahDataJournal&id_jurnal=<?= $data["id_jurnal"]?>&no_jurnal=<?= $data["no_jurnal"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusDataJournal&id_jurnal=<?= $data["id_jurnal"]?>&no_jurnal=<?= $data["no_jurnal"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
                </td>
              </tr>
              
           <?php } ?>

            </tbody>

            <tfoot>
                <tr>
                    <th colspan="6" style="text-align:right">Total:</th>
                    <th><?= "Rp. " . number_format($totalDebit, 2, ",", "."); ?></th>
                    <th><?= "Rp. " . number_format($totalKredit, 2, ",", "."); ?></th>
                    <th colspan="1"></th> <!-- Kolom aksi tidak perlu dihitung total -->
                </tr>
            </tfoot>
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
