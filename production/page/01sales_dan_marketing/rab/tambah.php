<?php

$id_user = $_SESSION['id_user'];
$rab = query("SELECT * FROM rab JOIN user ON user.id_user=rab.id_user");
$sales_plan = query("SELECT * FROM sales_plan");
$doc_num = generate_document_number();
$satuan = query("SELECT * FROM satuan");
$vessel = query("SELECT * FROM vessel");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahRab($_POST) > 0 ) {
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
			window.location.href = '?page=RAB'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=RAB'; //will redirect to your blog page (an ex: blog.html)
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


<form action="" id="dynamicForm">
<div class="col-md-12 col-sm-12  ">
	<div class="x_panel">
		<div class="x_title">
		<!-- <h2>Table design <small>Custom design</small></h2> -->

		<div class="clearfix"></div>
		</div>

		<div class="x_content">

		<div class="table-responsive ">
			<div class="row col-md-4">
				<table>
					<tr class="even pointer">
						<td class=" " style="width: 15rem;"><strong>Document Number</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" "> <input type="text" name="tgl_rab" id="last-name" class="form-control" value="<?= $doc_num;?>" readonly></td>
						
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>Voyage Number</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" ">

							<select class="form-control" name="voy_num" required>
								<option value="">--Pilih Voyage Number--</option>
								<?php foreach($sales_plan as $row) : ?>
									<option value="<?= $row['id_sales']?>"><?= $row['voy_num']?></option>
								<?php endforeach;?>	
							</select>

						</td>

					</tr>
				</table><br>
			</div>
			<div class="row col-md-4">
				<table>
					<tr class="even pointer">
						<td class=" " style="width: 15rem;"></td>
						<td class=" "> &nbsp;</td>
						<td class=" ">  &nbsp;</td>
						
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "></td>
						<td class=" "> &nbsp;</td>
						<td class=" "> &nbsp;</td>

					</tr>
				</table><br>
			</div>
			<div class="row col-md-4">
				<table>
					<tr class="even pointer">
						<td class=" " style="width: 15rem;"><strong>Tanggal</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" "> <input type="date" name="tgl_rab" id="last-name" class="form-control" value="<?= date('Y-m-d');?>"></td>
						
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>Deskripsi</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" ">
							<textarea name="" id="" cols="30" rows="3" class="form-control" style="resize: none;" placeholder="Ketikkan Deskripsi"></textarea>

						</td>

					</tr>
				</table><br>
			</div>
		</div>
		<br>
		<hr>
		<div class="table-responsive ">
			<div class="row col-md-4">
				<table>
					
					<br>
					<tr class="odd pointer" >
						<td class=" " style="width: 15rem;"><strong>Vessel</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" ">

							<select class="form-control" name="voy_num" required>
								<option value="">--Pilih Vessel--</option>
								<?php foreach($vessel as $row) : ?>
									<option value="<?= $row['id_vessel']?>"><?= $row['nama_vessel']?></option>
								<?php endforeach;?>	
							</select>

						</td>

					</tr>
				</table><br>
			</div>
			<div class="row col-md-4">
				<table>
					<tr class="even pointer">
						<td class=" " style="width: 15rem;"><strong>C/Hire Per day</strong></td>
						<td class=" ">: Rp.&nbsp;</td>
						<td class=" "> <input type="number" name="tgl_rab" id="last-name" class="form-control" value="0"></td>
						
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>C/Hire Per day</strong></td>
						<td class=" ">: Rp.&nbsp;</td>
						<td class=" "><input type="number" name="tgl_rab" id="last-name" class="form-control" value="0"></td>
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>Total C/Hire Per day</strong></td>
						<td class=" ">: Rp.&nbsp;</td>
						<td class=" "><input type="number" name="tgl_rab" id="last-name" class="form-control" value="0"></td>
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>C/Hire Per Month</strong></td>
						<td class=" ">: Rp.&nbsp;</td>
						<td class=" "><input type="number" name="tgl_rab" id="last-name" class="form-control" value="0"></td>
					</tr>
				</table><br>
			</div>
			<div class="row col-md-4">
				<table>
					<tr class="even pointer">
						<td class=" " style="width: 15rem;"><strong>AVG. Speed/Knots</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" "> <input type="number" name="tgl_rab" id="last-name" class="form-control" value="0"></td>
						
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>Bunker Cons Per day</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" "><input type="number" name="tgl_rab" id="last-name" class="form-control" value="0"></td>
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>M/E Per Hrs</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" "><input type="number" name="tgl_rab" id="last-name" class="form-control" value="0"></td>
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>A/E Per Hrs</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" "><input type="number" name="tgl_rab" id="last-name" class="form-control" value="0"></td>
					</tr>
				</table><br>
			</div>
		</div>
		<br>
		<hr>
		<div class="table-responsive ">
			<div class="row col-md-4">
				<table>
					
					<br>
					<tr class="odd pointer" >
						<td class=" " style="width: 15rem;"><strong>Customer</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" ">

							<select class="form-control" name="voy_num" required>
								<option value="">--Pilih Vessel--</option>
								<?php foreach($vessel as $row) : ?>
									<option value="<?= $row['id_vessel']?>"><?= $row['nama_vessel']?></option>
								<?php endforeach;?>	
							</select>

						</td>

					</tr>
					<br>
					<tr class="odd pointer" >
						<td class=" " style="width: 15rem;"><strong>Commodity</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" ">

							<select class="form-control" name="voy_num" required>
								<option value="">--Pilih Commodity--</option>
								<?php foreach($vessel as $row) : ?>
									<option value="<?= $row['id_vessel']?>"><?= $row['nama_vessel']?></option>
								<?php endforeach;?>	
							</select>

						</td>

					</tr>
				</table><br>
			</div>
			<div class="row col-md-4">
				<table>
					<tr class="even pointer">
						<td class=" " style="width: 15rem;"> &nbsp;</td>
						<td class=" "> &nbsp;</td>
						<td class=" ">  &nbsp;</td>
						
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "> &nbsp;</td>
						<td class=" "> &nbsp;</td>
						<td class=" "> &nbsp;</td>
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "> &nbsp;</td>
						<td class=" "> &nbsp;</td>
						<td class=" "> &nbsp;</td>
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "> &nbsp;</td>
						<td class=" "> &nbsp;</td>
						<td class=" "> &nbsp;</td>
					</tr>
				</table><br>
			</div>
			<div class="row col-md-4">
				<table>
					<tr class="even pointer">
						<td class=" " style="width: 15rem;"> &nbsp;</td>
						<td class=" "> &nbsp;</td>
						<td class=" ">  &nbsp;</td>
						
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "> &nbsp;</td>
						<td class=" "> &nbsp;</td>
						<td class=" "> &nbsp;</td>
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "> &nbsp;</td>
						<td class=" "> &nbsp;</td>
						<td class=" "> &nbsp;</td>
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "> &nbsp;</td>
						<td class=" "> &nbsp;</td>
						<td class=" "> &nbsp;</td>
					</tr>
				</table><br>
			</div>
		</div><br>
		<hr>
		<div class="table-responsive ">
		<table class="table table-bordered">
			
			<tbody>
				<tr class="even pointer">
			
					<td class=" ">Mob port from</td>
					<td class=" ">
						<select class="form-control col-md-12" name="voy_num" required>
							<option value="">--Pilih Satuan--</option>
							<?php foreach($satuan as $row) : ?>
								<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
							<?php endforeach;?>	
						</select>
					
					</td>
					<td class=" " rowspan="4"  style="vertical-align: middle; text-align: center;">Distance</td>
					<td class=" "><input type="number" name="tgl_rab" class="form-control col-md-12" value="0"></td>
					<td class=" ">Bunker Price</td>
					<td class="a-right a-right "><input type="number" name="tgl_rab" class="form-control col-md-12" value="0"></td>
				</tr>
				<tr class="odd pointer">

					<td class=" ">Load port </td>
					<td class=" ">
						<select class="form-control col-md-12" name="voy_num" required>
							<option value="">--Pilih Satuan--</option>
							<?php foreach($satuan as $row) : ?>
								<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
							<?php endforeach;?>	
						</select>
					</td>
					
					<td class=" "><input type="number" name="tgl_rab" class="form-control col-md-12" value="0"></td>
					<td class=" ">Lumpsum Freight</td>
					<td class="a-right a-right "><input type="number" name="tgl_rab" class="form-control col-md-12" value="0"></td>
				</tr>
				<tr class="even pointer">

					<td class=" ">Discharge port</td>
					<td class=" ">
						<select class="form-control col-md-12" name="voy_num" required>
							<option value="">--Pilih Satuan--</option>
							<?php foreach($satuan as $row) : ?>
								<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
							<?php endforeach;?>	
						</select>
					</td>
				
					<td class=" "><input type="number" name="tgl_rab" class="form-control col-md-12" value="0"></td>
					<td class=" ">Freight Computation</td>
					<td class="a-right a-right "><input type="number" name="tgl_rab" class="form-control col-md-12" value="0"></td>
				</tr>
				<tr class="odd pointer">

					<td class=" ">Demob</td>
					<td class=" ">
						<select class="form-control col-md-12" name="voy_num" required>
							<option value="">--Pilih Satuan--</option>
							<?php foreach($satuan as $row) : ?>
								<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
							<?php endforeach;?>	
						</select>
					</td>
			
					<td class=" "><input type="number" name="tgl_rab" class="form-control col-md-12" value="0"></td>
					<td class=" ">&nbsp;</td>
					<td class="a-right a-right ">&nbsp;</td>
				</tr>
				
				
			</tbody>
			</table>
			
		</div><br>


		<div class="table-responsive">
			<table class="table table-striped jambo_table bulk_action" id="dataTable">
				<thead>
					<tr class="headings">
						<th class="column-title" colspan="2"><center>Activities</center> </th>
						<th class="column-title">Distance/knots </th>
						<th class="column-title">Speed in Knt </th>
						<th class="column-title">Hours Taken </th>
						<th class="column-title">Total Days </th>
						<th class="column-title">Bunker Consum</th>
						</th>
						<th class="bulk-actions" colspan="7">
							<a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
						</th>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td><input type="text" name="field6[]" placeholder="From" required></td>
						<td><input type="text" name="field6[]" placeholder="To" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
					</tr>
					<tr>
						<td><input type="text" name="field6[]" placeholder="From" required></td>
						<td><input type="text" name="field6[]" placeholder="To" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
					</tr>
					<tr>
						<td>Idle Time</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
					</tr>

					<tr>
						<td>Loading - un loading</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
					</tr>

					<tr>
						<td>Oil Barge</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
					</tr>

					<tr>
						<td>Boiler</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
					</tr>

					<tr>
						<td>ROB (Remaind On Board)</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
					</tr>

					<tr>
						<td>Shifting / OG</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
						<td><input type="text" name="field6[]" value="0" required></td>
					</tr>

					<tr>
						<td colspan="3"><center><strong>Total</strong></center></td>
						<td>&nbsp;</td>
						<td><strong>0</strong></td>
						<td><strong>0</strong></td>
						<td><strong>0</strong></td>
					</tr>
					
					
					
					


				</tbody>
				<button type="button" id="addRowBtn">Add Row</button>
				<button id="addRowBtn">Submit</button>
			</table>
		</div>

		<!-- batas table activites -->

		<div class="table-responsive">
			<table class="table table-bordered" id="dataTables" >
				<thead>
					<tr class="">
						<th class="" colspan="4" rowspan="2" style="vertical-align: middle; text-align: center;"><center>Revenue Sales</center> </th>
						<th class="" colspan="2"><center>Jumlah</center></th>
						
					</tr>
					<tr class="">
						<th class=""><center>(IDR)</center> </th>
						<th class=""><center>%</center></th>
						
					</tr>
				</thead>

				<tbody>
					<tr>
						<td><input type="text" name="field6[]" placeholder="From" required></td>
						<td colspan="3"><input type="text" name="field6[]" placeholder="To" required></td>
						<td><input type="text" name="field6[]" placeholder="To" required></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td><input type="text" name="field6[]" placeholder="From" required></td>
						<td colspan="3"><input type="text" name="field6[]" placeholder="To" required></td>
						<td><input type="text" name="field6[]" placeholder="To" required></td>
						<td>&nbsp;</td>
						
					</tr>

					<tr>
						<td colspan="4"><b style="float: right;">Total Sales Revenue</b></td>
						<td >0</td>
						<td><b style="float: right;">%</b></td>
						
					</tr>
					

				</tbody>
				<button type="button" id="addRowBtn">Add Row</button>
				<button id="addRowBtn">Submit</button>
			</table>
		</div>
				
			
		</div>
	</div>
</div>


</form>
<script>
    document.getElementById('addRowBtn').addEventListener('click', function () {
        var table = document.getElementById('dataTable').getElementsByTagName('tbody')[0];

        // Find the row index of the "Idle Time" row
        var idleTimeRowIndex = -1;
        for (var i = 0; i < table.rows.length; i++) {
            if (table.rows[i].cells[0].textContent.trim() === 'Idle Time') {
                idleTimeRowIndex = i;
                break;
            }
        }

        // If "Idle Time" row is found, insert a new row above it, otherwise insert at the end
        var newRow = table.insertRow(idleTimeRowIndex !== -1 ? idleTimeRowIndex : table.rows.length);

        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);
        var cell5 = newRow.insertCell(4);
        var cell6 = newRow.insertCell(5);
        var cell7 = newRow.insertCell(6); // Fix index for the last cell

        cell1.innerHTML = '<input type="text" name="field1[]" required>';
        cell2.innerHTML = '<input type="text" name="field2[]" required>';
        cell3.innerHTML = '<input type="text" name="field3[]" value="0" required>';
        cell4.innerHTML = '<input type="text" name="field4[]" value="0" required>';
        cell5.innerHTML = '<input type="text" name="field5[]" value="0" required>';
        cell6.innerHTML = '<input type="text" name="field6[]" value="0" required>';
        cell7.innerHTML = '<input type="text" name="field7[]" value="0" required>';
    });
</script>



<!-- 
<script>
	document.getElementById('addRowBtn').addEventListener('click', function () {
		var table = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
		var newRow = table.insertRow(table.rows.length);

		var cell1 = newRow.insertCell(0);
		var cell2 = newRow.insertCell(1);
		var cell3 = newRow.insertCell(2);
		var cell4 = newRow.insertCell(3);
		var cell5 = newRow.insertCell(4);
		var cell6 = newRow.insertCell(5);
		var cell7 = newRow.insertCell(5);

		cell1.innerHTML = '<input type="text" name="field1[]" required>';
		cell2.innerHTML = '<input type="text" name="field2[]" required>';
		cell3.innerHTML = '<input type="text" name="field3[]" value="0" required>';
		cell4.innerHTML = '<input type="text" name="field4[]" value="0" required>';
		cell5.innerHTML = '<input type="text" name="field5[]" value="0" required>';
		cell6.innerHTML = '<input type="text" name="field6[]" value="0" required>';
		cell7.innerHTML = '<input type="text" name="field7[]" value="0" required>';
	});
</script> -->