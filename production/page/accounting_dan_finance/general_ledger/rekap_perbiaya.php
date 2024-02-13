<?php

$id_user = $_SESSION["id_user"];

$kode_coa = $_GET['kode_coa'];
$rekap = query("SELECT * FROM jurnal JOIN cart_of_account ON cart_of_account.kode_coa=$kode_coa")[0];
?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Biaya - [ <?= $kode_coa ;?> ]<?= $rekap['name_account'] ;?> <small></small></h2>
        <!-- <a href="?form=tambahJournal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New Journal</a> -->
       
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
                <th class="column-title">No. Journal</th>
                <th class="column-title">Tanggal</th>
                <th class="column-title">Keterangan</th>
                <th class="column-title">Debit</th>
                <th class="column-title">Kredit</th>
                <th class="column-title">Saldo</th>

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
              		$query = "SELECT * FROM no_jurnal JOIN jurnal ON jurnal.no_jurnal=no_jurnal.no_jurnal JOIN cart_of_account ON cart_of_account.kode_coa=jurnal.kode_coa WHERE jurnal.kode_coa=$kode_coa";
              		
              		$tampil = mysqli_query($koneksi, $query);

              		// Inisialisasi saldo awal
        			   $saldo = 0;

              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     	$debit = $data['debit'];
              	     	$kredit = $data['kredit'];

              	     	// Update saldo berdasarkan jenis transaksi
			            if ($data['account_type'] == 'ASET' OR $data['account_type'] == 'Aset Lancar' OR $data['account_type'] == 'Kas & Bank' OR $data['account_type'] == 'Bank' OR $data['account_type'] == 'Piutang Usaha' OR $data['account_type'] == 'Piutang Non Usaha' OR $data['account_type'] == 'Piutang Pemegang Saham' OR $data['account_type'] == 'Piutang Related Party' OR $data['account_type'] == 'Pajak Dibayar Dimuka' OR $data['account_type'] == 'Aktiva Lancar Lainnya' OR $data['account_type'] == 'Aset Tidak Lancar' OR $data['account_type'] == 'Aset Tetap' OR $data['account_type'] == 'Aset Tetap-Akumulasi Penyusutan' OR $data['account_type'] == 'Akumulasi Penyusutan' OR $data['account_type'] == 'Harga Pokok Penjualan' OR $data['account_type'] == 'Beban' OR $data['account_type'] == 'Beban Lainnya') {

			                $saldo += $debit - $kredit ;

			            } else {
                      $saldo += $kredit - $debit;

			            }
              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['no_jurnal']?></td>
                <td class=" "><?= $data['tgl_jurnal'];?></td>
                <td class=" "><?= $data['ket_jurnal'];?></td>
                <td class=" "><?= "Rp. ".number_format("$debit", 2, ",", "."); ?></td>
                <td class=" "><?= "Rp. ".number_format("$kredit", 2, ",", "."); ?></td>
                <td class=" "><strong style="color: red"><?= "Rp. ".number_format("$saldo", 2, ",", "."); ?></strong></td>
                
               <!--  <td class=" last"><a href="?form=rincianJurnal&no_jurnal=<?= $data["no_jurnal"]; ?>" class="btn btn-secondary btn-sm"><i class="fa fa-eye fa-sm"></i> Lihat Journal </a> | <a href="?form=ubahNoJurnal&no_jurnal=<?= $data["no_jurnal"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusNoJurnal&no_jurnal=<?= $data["no_jurnal"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
                </td> -->
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
