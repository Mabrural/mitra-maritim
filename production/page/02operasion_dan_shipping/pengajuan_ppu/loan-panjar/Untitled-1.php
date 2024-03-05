

<?php
$id_ppu = mysqli_real_escape_string($koneksi, $_GET['id_ppu']);
$satuan = query("SELECT * FROM satuan");
$vessel = query("SELECT * FROM vessel");
$project = query("SELECT * FROM project");

?>
<div class="x_panel">
      <div class="x_title">
        
        <h2>Tambah Uraian<small></small></h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <form method="post" action="">

                <p>Jumlah data</p>
                <input type="number" name="jum" size="1" ><br><br>
                <a href="?form=lihatUraian&id_ppu=<?= $id_ppu?>" class="btn btn-danger btn-sm">Back</a>
                <button type="submit" name="submit" class="btn btn-primary btn-sm">Next</button>
        </form>

        <!-- <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p> -->
<?php
    if (isset($_POST['submit'])) {
        echo '<div class="table-responsive"><form method="post" action="">
        <table class="table table-responsive table-bordered">
            <tr bgcolor="#eee">
                <th width="400">Uraian</th>
                <th width="130">Qty</th>
                <th width="200">Unit</th>
                <th width="200">Harga Satuan</th>
                <!-- <th width="200">Jumlah</th> -->
                <th width="300">Vessel</th>
                <th width="400">Project</th></tr>'; // Close the opening tr tag here

        $jum = $_POST['jum'];
        for ($i = 1; $i <= $jum; $i++) {
            echo '<tr>
                        <td><input type="text" class="form-control" name="nama_uraian[]" size="55"></td>
                        <td><input type="number" min="0" class="form-control" name="qty_uraian[]" size="10"></td>
                        <td><select class="form-control" name="id_satuan">
                                <option value="">--Pilih Satuan--</option>';
                                foreach ($satuan as $row) {
                                    echo '<option value="' . $row['id_satuan'] . '">' . $row['nama_satuan'] . '</option>';
                                }
            echo '</select>
                </td>
                <td><input type="text" class="form-control" name="harga_satuan[]" size="10"></td>
               <!-- <td><input type="text" class="form-control" name="jumlah[]" size="10" readonly value="9"></td> -->
                <td><select class="form-control" name="id_vessel"> <!-- Change the name attribute to "id_vessel" -->
                        <option value="">--Pilih Vessel--</option>';
                        foreach ($vessel as $row) {
                            echo '<option value="' . $row['id_vessel'] . '">' . $row['nama_vessel'] . '</option>';
                        }
            echo '</select>
                </td>
                <td><select class="form-control" name="id_project"> <!-- Added missing opening tag for select -->
                        <option value="">--Pilih Project--</option>';
                        foreach ($project as $row) {
                            echo '<option value="' . $row['id_project'] . '">' . $row['nama_project'] . '</option>';
                        }
            echo '</select>
                </td>
            </tr>';
        }

        echo '</table>

        <input type="hidden" name="jum" value="' . $jum . '">
        <input type="submit" name="simpan" value="Simpan" class="btn btn-success btn-sm">
        
    </form></div>';
    }

    if (isset($_POST['simpan'])) {
        // cek apakah data berhasil ditambahkan atau tidak
        if(tambahUraian($_POST) > 0 ) {
            echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
            echo '<script src="./sweetalert2.min.js"></script>';
            echo "<script>
            setTimeout(function () { 
                swal.fire({
                    
                    title               : 'Berhasil',
                    text                :  'Data berhasil ditambahkan',
                    //footer              :  '',
                    icon                : 'success',
                    timer               : 2000,
                    showConfirmButton   : true
                });  
            },10);   setTimeout(function () {
                window.location.href = '?form=lihatUraian&id_ppu=". $id_ppu ."'; //will redirect to your blog page (an ex: blog.html)
            }, 2000); //will call the function after 2 secs
            </script>"; 
            // echo "
            // 	<script>
            // 		alert('Data berhasil ditambahkan');
            // 		document.location.href = '?page=anggaran';
            // 	</script>
            // ";
        } else{
            echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
            echo '<script src="./sweetalert2.min.js"></script>';
            echo "<script>
            setTimeout(function () { 
                swal.fire({
                    
                    title               : 'Gagal',
                    text                :  'Data gagal ditambahkan',
                    //footer              :  '',
                    icon                : 'error',
                    timer               : 2000,
                    showConfirmButton   : true
                });  
            },10);   setTimeout(function () {
                window.location.href = '?form=lihatUraian&id_ppu=". $id_ppu ."'; //will redirect to your blog page (an ex: blog.html)
            }, 2000); //will call the function after 2 secs
            </script>";
            // echo "
            // 	<script>
            // 		alert('Data gagal ditambahkan');
            // 		document.location.href = '?page=anggaran';
            // 	</script>
            // ";
        }
    }
    
?>


<br>


        </div>
				
			
      </div>
    </div>