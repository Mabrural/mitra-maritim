<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Loan / Panjar<small></small></h2>
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
                <th class="column-title">Nomor PPU </th>
                <th class="column-title">Tanggal Input </th>
                <th class="column-title">Nama Pemohon</th>
                <th class="column-title">Divisi</th>
                <th class="column-title">Keperluan</th>
                <th class="column-title">Status</th>
     
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
              		$query = "SELECT * FROM ppu JOIN karyawan ON karyawan.id_emp=ppu.id_emp JOIN divisi ON divisi.id_divisi=karyawan.id_divisi";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['no_ppu'];?></td>
                <td class=" "><?= date('d/m/Y', strtotime($data['tgl_ppu']));?></td>
                <td class=" "><?= $data['nama_emp'];?></td>
                <td class=" "><?= $data['nama_divisi'];?></td>
                <td class=" "><?= $data['keperluan'];?></td>
                <td class=" "><?= $data['status_ppu'];?></td>

                
                <td class=" last"><a href="?form=lihatUraianRead&id_ppu=<?= $data["id_ppu"]; ?>" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> Lihat Uraian</a> 
                </td>




            
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
