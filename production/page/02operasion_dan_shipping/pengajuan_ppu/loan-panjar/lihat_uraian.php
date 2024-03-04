<?php

$id_ppu = mysqli_real_escape_string($koneksi, $_GET['id_ppu']);

$id_user = $_SESSION["id_user"];
$pembuat = query("SELECT * FROM ppu JOIN user ON user.id_user=$id_user JOIN karyawan ON karyawan.id_emp=user.id_emp")[0];

$ppu = query("SELECT * FROM ppu JOIN karyawan ON karyawan.id_emp=ppu.id_emp JOIN divisi ON divisi.id_divisi=karyawan.id_divisi WHERE id_ppu=$id_ppu")[0];
?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Uraian<small></small></h2>
        <a href="?form=tambahUraian" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Uraian</a>
        <a href="?page=loanPanjar" class="btn btn-danger btn-sm"><i class="fa fa-left"></i> Back</a><br><br>
        <div class="float-left">
        <table>
                <tbody style="font-size: 0.9rem;">

                <tr>
                    <td width="45%"><strong>Nama Pemohon</strong></td>
                    <td>:&nbsp;&nbsp;</td>
                    <td><?= $ppu['nama_emp']?></td>
                </tr>

                <tr>
                    <td width="45%"><strong>Divisi</strong></td>
                    <td>:&nbsp;&nbsp;</td>
                    <td><?= $ppu['nama_divisi']?></td>
                </tr>

                <tr>
                    <td width="45%"><strong>Keperluan</strong></td>
                    <td>:&nbsp;&nbsp;</td>
                    <td><?= $ppu['keperluan']?></td>
                </tr>

                

            </tbody></table>
        </div>
        <div class="float-right">
        <table>
                <tbody style="font-size: 0.9rem;">

                <tr>
                    <td width="45%"><strong>Nomor PPU</strong></td>
                    <td>:&nbsp;&nbsp;</td>
                    <td><?= $ppu['no_ppu']?></td>
                </tr>

                <tr>
                    <td width="45%"><strong>Tanggal</strong></td>
                    <td>:&nbsp;&nbsp;</td>
                    <td><?= $ppu['tgl_ppu']?></td>
                </tr>

            </tbody></table>
        </div>
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
                <th class="column-title">Uraian </th>
                <th class="column-title">Qty </th>
                <th class="column-title">Unit</th>
                <th class="column-title">Harga Satuan</th>
                <th class="column-title">Jumlah</th>
                <th class="column-title">Vessel</th>
                <th class="column-title">Project</th>
                <!-- <th class="column-title">Status</th> -->

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
              		$query = "SELECT * FROM uraian_ppu JOIN satuan ON satuan.id_satuan=uraian_ppu.id_satuan JOIN vessel ON vessel.id_vessel=uraian_ppu.id_vessel JOIN project ON project.id_project=uraian_ppu.id_project WHERE id_ppu=$id_ppu";
              		
              		$tampil = mysqli_query($koneksi, $query);
              		while ($data = mysqli_fetch_assoc($tampil)) {
              	     		

              	 ?>
                <td class=" "><?= $no++;?></td>
                <td class=" "><?= $data['nama_uraian'];?></td>
                <td class=" "><?= $data['qty_uraian'];?></td>
                <td class=" "><?= $data['nama_satuan'];?></td>
                <td class=" "><?= $data['harga_satuan'];?></td>
                <td class=" "><?= $data['harga_satuan'] * $data['qty_uraian'];?></td>
                <td class=" "><?= $data['nama_vessel'];?></td>
                <td class=" "><?= $data['nama_project'];?></td>
                <!-- <td class=" "><?= $data['nama_project'];?></td> -->
                <!-- <td class=" ">
                    <strong style="background-color: <?php
                    if ($data['status_rab'] == 'Reject') {
                        echo '#a62f26';
                    } elseif ($data['status_rab'] == 'Selesai') {
                      echo '#14a664';
                    } else {
                        echo '#b58709';
                    }
                ?>
                 ; color: white; padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 5px; font-weight: normal;"><?= $data['status_rab'];?></strong> -->
                
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

    <div class="x_content">
        <div class="row no-gutters">
            
            <div class="col-md-4 mt-2 ml-3 mr-5">
                <h5 class="card-title"><b>DATA APPROVAL</b></h5><hr>
                <table>
                <tbody style="font-size: 0.9rem;">

                <tr>
                    <td width="45%"><strong>Dibuat Oleh</strong></td>
                    <td>:&nbsp;&nbsp;</td>
                    <td><?= $pembuat['nama_emp'];?></td>
                </tr>

                <tr>
                    <td width="45%"><strong>Kepala Shipping</strong></td>
                    <td>:&nbsp;&nbsp;</td>
                    <td></td>
                </tr>

                <tr>
                    <td width="45%"><strong>Kepala Cabang</strong></td>
                    <td>:&nbsp;&nbsp;</td>
                    <td></td>
                </tr>

                <tr>
                    <td width="45%"><strong>Direktur Operasional</strong></td>
                    <td>:&nbsp;&nbsp;</td>
                    <td></td>
                </tr>

                <tr>
                    <td width="45%"><strong>Direktur Utama</strong></td>
                    <td>:&nbsp;&nbsp;</td>
                    <td></td>
                </tr>

                <tr>
                    <td width="45%"><strong>Direktur Keuangan</strong></td>
                    <td>:&nbsp;&nbsp;</td>
                    <td></td>
                </tr>

            </tbody></table>
            <br>
            </div>
        </div>
    </div>
