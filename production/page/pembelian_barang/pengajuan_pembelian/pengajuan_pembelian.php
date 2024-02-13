<?php

$id_user = $_SESSION["id_user"];

$vendor = query("SELECT * FROM vendor");

$id_invoice = $_GET['id_invoice'];

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Pembelian Barang <small></small></h2>
        
        <form action="laporan/cetak_po.php" method="get">
            <input type="hidden" name="aksi">
            <input type="hidden" name="id_user" value="<?= $id_user;?>">
            <input type="hidden" name="id_invoice" value="<?= $id_invoice;?>">
            <!-- <input type="hidden" name="id_vendor" value="<?= $id_vendor;?>"> -->
            <!-- <input type="hidden" id="select_id" name="select_id" value="<?=$selectedIds?>"> -->
            <a href="?form=tambahPembelian&id_invoice=<?= $id_invoice?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Ajukan PO</a>
            <!-- button type="submit" class="btn btn-info btn-sm" name="cetakData" onclick="document.getElementById('select_id').value = getCheckedIds();"><i class="fa fa-print"></i> Cetak PO</button> -->

            <?php 
            $query = "SELECT * FROM po_barang JOIN vendor ON vendor.id_vendor=po_barang.id_vendor JOIN req_barang ON req_barang.id_req_brg=po_barang.id_req_brg JOIN barang ON barang.kode_brg=req_barang.kode_brg JOIN satuan ON satuan.id_satuan=req_barang.id_satuan WHERE po_barang.id_invoice=$id_invoice";
              // Eksekusi query
                $result = mysqli_query($koneksi, $query);

                // Hitung jumlah baris hasil query
                $row_count = mysqli_num_rows($result);

                // Buat kondisi untuk menentukan apakah tombol harus diaktifkan atau dinonaktifkan
                $is_disabled = ($row_count > 0) ? "" : "disabled";


             ?>
            <button type="submit" class="btn btn-info btn-sm" name="cetakData" <?php echo $is_disabled; ?>><i class="fa fa-print"></i> Cetak PO</button>
        </form>

        <div class="row">
              <div class="col-md-3 col-sm-6">
                  <form method="get">
                    <input type="hidden" name="aksi">
                        <!-- <input type="hidden" name="id_user" value="<?= $storage_barang['id_user'];?>"> -->
                     <!--  <select class="form-control" name="id_vendor" id="id_vendor" required>
                          <option value="">--Pilih Vendor--</option>
                          <?php foreach($vendor as $row) : ?>
                              <option value="<?= $row['id_vendor']?>" <?php echo ($id_vendor == $row['id_vendor']) ? 'selected' : ''; ?>>
                                  <?= $row['nama_vendor']?>
                              </option>
                          <?php endforeach;?> 
                      </select><br> -->
                  </form>
              </div>

          </div>

        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <script type="text/javascript">
          $(document).ready(function() {
              // Add change event listeners to the dropdowns
              $('#id_vendor, #id_room').change(function() {
                  // Get selected values
                  var id_vendor = $('#id_vendor').val();
                  var id_room = $('#id_room').val();

                  // Redirect to the current page with filter parameters
                  window.location.href = '?page=pengajuanPembelian&id_vendor=' + id_vendor;
                  // window.location.href = '?id_lokasi=' + id_lokasi + '&id_room=' + id_room;
              });

              // ... (rest of the JavaScript code)
          });
        </script>

        <!-- <script type="text/javascript">
              function getCheckedIds() {
              var selectedIds = [];
              $('input[name="select_id[]"]:checked').each(function() {
                  selectedIds.push($(this).val());
              });
              return selectedIds;
          }
        </script> -->

        <!-- <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p> -->

        <div class="table-responsive">
          <table id="example" class="display" style="width:100%">
            <thead style="background-color: #2a3f54; color: #dfe5f1;">
              <tr class="headings">
                <!-- <th>
                  <input type="checkbox" id="check-all" class="flat">
                </th> -->
                <th class="column-title">No. </th>
                <th class="column-title">Tanggal PO</th>
                <th class="column-title">Nama Barang </th>
                <th class="column-title">Spesifikasi </th>
                <th class="column-title">Keterangan </th>
                <th class="column-title">Qty </th>
                <th class="column-title">Satuan </th>
                <th class="column-title">Harga Satuan</th>
                <th class="column-title">Total Harga</th>
                <th class="column-title">Vendor </th>
                <th class="column-title">Status </th>
                           
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
              		$query = "SELECT * FROM po_barang JOIN vendor ON vendor.id_vendor=po_barang.id_vendor JOIN req_barang ON req_barang.id_req_brg=po_barang.id_req_brg JOIN barang ON barang.kode_brg=req_barang.kode_brg JOIN satuan ON satuan.id_satuan=req_barang.id_satuan WHERE po_barang.id_invoice=$id_invoice";
                  // $query = "SELECT * FROM po_barang JOIN req_barang ON req_barang.id_req_brg JOIN vendor ON vendor.id_vendor=po_barang.id_vendor JOIN barang ON barang.kode_brg=req_barang.kode_brg JOIN satuan ON satuan.id_satuan=req_barang.id_satuan";

                  // if (!empty($id_vendor)) {
                  //     $query .= " WHERE po_barang.id_vendor = $id_vendor AND id_invoice=$id_invoice ORDER BY id_po DESC";
                  // }
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     $harga_po = $data['harga_po'];
                     $total_harga = $harga_po * $data['qty_po'];
              	 ?>
                 <!-- <td><input type="checkbox" class="flat" name="select_id[]" value="<?= $data['id_po']; ?>"></td> -->
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= date('d-M-Y', strtotime($data['tgl_po']));?></td>
                <td class=" "><a href="img/barang/<?= $data['gambar_barang'];?>" style="text-decoration: underline; color:blue;"><?= $data['nama_barang'];?> </a></td>
                <td class=" "><?= $data['spek'];?></td>
                <td class=" "><?= $data['ket_po'];?></td>
                <td class=" "><?= $data['qty_po'];?></td>
                <td class=" "><?= $data['nama_satuan'];?></td>
                <td class=" "><?= "Rp. ".number_format("$harga_po", 2, ",", "."); ?></td>
                <td class=" "><?= "Rp. ".number_format("$total_harga", 2, ",", "."); ?></td>
                <td class=" "><?= $data['nama_vendor'];?></td>
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
                
                <td class="last">
                    <?php
                    if ($data['status_req'] == 'Menunggu Persetujuan Dir. HRD') {
                        echo '<a href="?form=ubahPembelian&id_po=' . $data["id_po"] . '" class="btn btn-info btn-sm">Ubah</a> | ';
                        echo '<a href="?form=hapusPembelian&id_po=' . $data["id_po"] . '&id_invoice='.$data["id_invoice"].'" onclick="return confirm(\'Anda yakin ingin menghapus data ini?\')" class="btn btn-danger btn-sm">Hapus</a>';
                    } else {
                        echo '<button class="btn btn-secondary btn-sm" disabled>Selesai</button>';
                    }
                    ?>
                </td>
                <!-- <td class=" last"><a href="?form=ubahPembelian&id_po=<?= $data["id_po"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusPembelian&id_po=<?= $data["id_po"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a>
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
