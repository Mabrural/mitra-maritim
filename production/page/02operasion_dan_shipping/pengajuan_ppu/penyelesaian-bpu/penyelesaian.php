<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Penyelesaian / BPU<small></small></h2>
        <a href="?form=tambahPenyelesaian" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New Penyelesaian</a>       
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
                <th class="column-title">Nominal Pemakaian </th>
                <th class="column-title">Selisih </th>
                <th class="column-title">Status</th>
                <th class="column-title">Bukti Nota</th>
                <th class="column-title">Bukti Return</th>
                <th class="column-title">Bukti Reimburse</th>
     
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
              		$query = "SELECT * FROM penyelesaian JOIN bpu_ppu ON bpu_ppu.id_bpu=penyelesaian.id_bpu JOIN ppu ON ppu.id_ppu=bpu_ppu.id_ppu JOIN karyawan ON karyawan.id_emp=bpu_ppu.penerima_dana JOIN divisi ON divisi.id_divisi=karyawan.id_divisi";
                    
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
                        // var_dump($data); die; 		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><a href="?form=lihatUraianRead&id_ppu=<?= $data['id_ppu']?>"><?= $data['no_ppu'];?></a></td>
                <td class=" "><?= date('d/m/Y', strtotime($data['tgl_ppu']));?></td>
                <td class=" "><?= $data['nominal_use'];?></td>
                <td class=" "><?= $data['selisih'];?></td>
                <td class=" "><?= $data['status_end'];?></td>
                <td class=" "><a href="files/bukti_nota/<?= $data['bukti_nota'];?>" style="padding-top:5px; padding-bottom: 5px; padding-left:5px; padding-right:5px; background-color: green; color : white; border-radius: 3px;" >Lihat Nota</a></td>
                <td class=" "><a href="files/bukti_nota/<?= $data['bukti_return'];?>" style="padding-top:5px; padding-bottom: 5px; padding-left:5px; padding-right:5px; background-color: green; color : white; border-radius: 3px;" >Lihat Return</a></td>
                <!-- <td class=" "><a href="files/bukti_nota/<?= $data['bukti_reimburse'];?>" style="padding-top:5px; padding-bottom: 5px; padding-left:5px; padding-right:5px; background-color: green; color : white; border-radius: 3px;" >Lihat Reimburse</a></td> -->
                <td class=" ">
                    <?php if (!empty($data['bukti_reimburse'])): ?>
                        <a href="files/bukti_nota/<?= $data['bukti_reimburse'];?>" style="padding-top:5px; padding-bottom: 5px; padding-left:5px; padding-right:5px; background-color: green; color : white; border-radius: 3px;" >Lihat Reimburse</a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>

                
                <td class=" last"><a href="?form=ubahPenyelesaian&id_end=<?= $data["id_end"]; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Ubah </a>
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