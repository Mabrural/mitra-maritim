<?php

$id_user = $_SESSION["id_user"];


?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Purchase Order <small></small></h2>
        
        <a href="?form=newPO" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New PO</a>

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

        <script type="text/javascript">
              function getCheckedIds() {
              var selectedIds = [];
              $('input[name="select_id[]"]:checked').each(function() {
                  selectedIds.push($(this).val());
              });
              return selectedIds;
          }
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
                <th class="column-title">No. Purchase Order</th>
                           
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
              		$query = "SELECT * FROM no_po ORDER BY id_no_po DESC";
              		// $query = "SELECT * FROM po_barang JOIN vendor ON vendor.id_vendor=po_barang.id_vendor JOIN req_barang ON req_barang.id_req_brg=po_barang.id_req_brg JOIN barang ON barang.kode_brg=req_barang.kode_brg JOIN satuan ON satuan.id_satuan=req_barang.id_satuan";
     
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
    
              	 ?>
                 <!-- <td><input type="checkbox" class="flat" name="select_id[]" value="<?= $data['id_invoice']; ?>"></td> -->
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['no_po'];?></td>
      
                <td class=" last"> <a href="?page=pengajuanPO&id_no_po=<?= $data["id_no_po"]; ?>" class="btn btn-dark btn-sm text-black"> <i class="fa fa-eye"></i> Lihat PO</a> | <a href="?form=ubahPO&id_no_po=<?= $data["id_no_po"]; ?>" class="btn btn-info btn-sm">Ubah </a> | <a href="?form=hapusPO&id_no_po=<?= $data["id_no_po"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus </a> 
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
