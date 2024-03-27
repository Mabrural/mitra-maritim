<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>BPU Loan / Panjar<small></small></h2>
        <a href="?form=tambahBpuLoan" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New BPU</a>       
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
                <th class="column-title">Tanggal Transfer </th>
                <th class="column-title">Nama Penerima Dana</th>
                <th class="column-title">Nominal Transfer</th>
                <th class="column-title">Note</th>
                <th class="column-title">Bukti Transfer</th>
     
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
              		$query = "SELECT * FROM bpu_ppu JOIN ppu ON ppu.id_ppu=bpu_ppu.id_ppu JOIN karyawan ON karyawan.id_emp=bpu_ppu.penerima_dana";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
                    $nominal_tf =$data['nominal_tf'];

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><a href="?form=lihatUraianBpu&id_ppu=<?= $data['id_ppu']?>"><?= $data['no_ppu'];?></a></td>
                <td class=" "><?= date('d/m/Y', strtotime($data['tgl_bpu']));?></td>
                <td class=" "><?= $data['nama_emp'];?></td>
                <td class=" "><strong style='color: red'><?= "Rp. ".number_format("$nominal_tf", 2, ",", "."); ?> </strong></td>
                <td class=" "><?= $data['note_bpu'];?></td>
                <td class=" "><a href="files/bukti_tf_bpu/<?= $data['bukti_tf']?>" style="padding-top:5px; padding-bottom: 5px; padding-left:5px; padding-right:5px; background-color: green; color : white; border-radius: 3px;">Lihat Bukti TF</a></td>

                
                <td class=" last"> <a href="?form=ubahBpuLoan&id_bpu=<?= $data["id_bpu"]; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Ubah </a> <a href="?form=hapusBpuLoan&id_bpu=<?= $data["id_bpu"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus </a>
                </td>

          

                <!-- <td class="last">
                    <?php
                    $id_ppu = $data["id_ppu"];
                    $query_check_uraian = "SELECT COUNT(*) as uraian_count FROM uraian_ppu WHERE id_ppu = $id_ppu";
                    $result_check_uraian = mysqli_query($koneksi, $query_check_uraian);

                    if ($result_check_uraian) {
                        $uraian_count = mysqli_fetch_assoc($result_check_uraian)['uraian_count'];

                        if ($data['status_ppu'] === 'Revise' || $data['status_ppu'] === 'On Ka. Shipping') {
                            // Jika status_ppu adalah 'Revise' atau 'On Ka. Shipping', tampilkan tombol "Lihat Uraian", "Ubah", dan "Hapus"
                            echo '<a href="?form=lihatUraian&id_ppu=' . $id_ppu . '" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> Lihat Uraian</a> | ';
                            echo '<a href="?form=ubahPpu&id_ppu=' . $id_ppu . '" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Ubah</a> | ';
                            echo '<a href="?form=hapusPpu&id_ppu=' . $id_ppu . '" onclick="return confirm(\'Anda yakin ingin menghapus data ini?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>';
                        } else {
                            // Jika status_ppu bukan 'Revise' atau 'On Ka. Shipping', tampilkan tombol "Lihat Uraian" saja
                            echo '<a href="?form=lihatUraianRead&id_ppu=' . $id_ppu . '" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> Lihat Uraian</a>';
                        }
                    }
                    ?>
                </td> -->


            
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
