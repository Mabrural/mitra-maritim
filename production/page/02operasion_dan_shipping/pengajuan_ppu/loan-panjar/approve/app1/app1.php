<?php

$id_user = $_SESSION["id_user"];

// $pengajuan = query("SELECT * FROM barang WHERE barang.id_barang=$id_user");

?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Loan / Panjar<small></small></h2>
        <!-- <a href="?form=tambahPpu" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New PPU</a>        -->
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
              		$query = "SELECT * FROM ppu JOIN karyawan ON karyawan.id_emp=ppu.id_emp JOIN divisi ON divisi.id_divisi=karyawan.id_divisi ORDER BY id_ppu DESC";
              		
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

                
                <!-- <td class=" last"><a href="?form=lihatUraian&id_ppu=<?= $data["id_ppu"]; ?>" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> Lihat Uraian</a>  <a href="?form=ubahPpu&id_ppu=<?= $data["id_ppu"]; ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve </a> <a href="?form=ubahPpu&id_ppu=<?= $data["id_ppu"]; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Revise </a> <a href="?form=hapusPpu&id_ppu=<?= $data["id_ppu"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Reject </a>
                </td> -->

                <!-- <td class="last">
                    <?php
                    if ($data['status_ppu'] !== 'On Ka. Shipping') {
                        echo ' <a href="?form=lihatUraian&id_ppu=' . $data["id_ppu"] . '" class="btn btn-secondary btn-sm" ><i class="fa fa-eye"></i> Lihat Uraian</a>';
                    } else {
                        echo ' <a href="?form=lihatUraian&id_ppu=' . $data["id_ppu"] . '" class="btn btn-secondary btn-sm" ><i class="fa fa-eye"></i> Lihat Uraian</a>';
                        echo ' <a href="?form=approvePpu&id_ppu=' . $data["id_ppu"] . '" class="btn btn-success btn-sm" onclick="return confirm(\'Anda yakin ingin mengapprove data ini?\')"><i class="fa fa-check"></i> Approve</a>';
                        echo ' <a href="?form=revisePpu&id_ppu=' . $data["id_ppu"] . '" class="btn btn-info btn-sm" onclick="return confirm(\'Anda yakin ingin merevise data ini?\')"><i class="fa fa-edit"></i> Revise </a>';
                        echo ' <a href="?form=rejectPpu&id_ppu=' . $data["id_ppu"] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Anda yakin ingin mereject data ini?\')"><i class="fa fa-ban"></i> Reject</a>';
                    }
                    ?>
                </td> -->

                <td class="last">
                    <?php
                    $id_ppu = $data["id_ppu"];
                    $query_check_uraian = "SELECT COUNT(*) as uraian_count FROM uraian_ppu WHERE id_ppu = $id_ppu";
                    $result_check_uraian = mysqli_query($koneksi, $query_check_uraian);
                    
                    if ($result_check_uraian) {
                        $uraian_count = mysqli_fetch_assoc($result_check_uraian)['uraian_count'];
                        
                        if ($data['status_ppu'] !== 'On Ka. Shipping') {
                            // Jika terdapat data uraian, tampilkan tombol "Lihat Uraian" saja
                            echo '<a href="?form=lihatUraian&id_ppu=' . $id_ppu . '" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> Lihat Uraian</a>';
                        } elseif($uraian_count > 0){
                            echo '<a href="?form=lihatUraian&id_ppu=' . $id_ppu . '" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> Lihat Uraian</a>  ';
                            echo ' <a href="?form=approvePpu&id_ppu=' . $data["id_ppu"] . '" class="btn btn-success btn-sm" onclick="return confirm(\'Anda yakin ingin mengapprove data ini?\')"><i class="fa fa-check"></i> Approve</a>';
                            echo ' <a href="?form=revisePpu&id_ppu=' . $data["id_ppu"] . '" class="btn btn-info btn-sm" onclick="return confirm(\'Anda yakin ingin merevise data ini?\')"><i class="fa fa-edit"></i> Revise </a>';
                            echo ' <a href="?form=rejectPpu&id_ppu=' . $data["id_ppu"] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Anda yakin ingin mereject data ini?\')"><i class="fa fa-ban"></i> Reject</a>';
                        }else {
                            // Jika tidak terdapat data uraian, tampilkan tombol "Lihat Uraian", "Ubah", dan "Hapus"
                            echo '<a href="?form=lihatUraian&id_ppu=' . $id_ppu . '" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> Lihat Uraian</a> ';

                        }
                    }
                    ?>
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
