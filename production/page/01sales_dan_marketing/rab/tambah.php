<?php

$id_user = $_SESSION['id_user'];
$rab = query("SELECT * FROM rab JOIN user ON user.id_user=rab.id_user");
$sales_plan = query("SELECT * FROM sales_plan");
$doc_num = generate_document_number();
$satuan = query("SELECT * FROM satuan");
$vessel = query("SELECT * FROM vessel");
$customer = query("SELECT * FROM customer");
$kargo = query("SELECT * FROM jenis_kargo");
$port = query("SELECT * FROM port");

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
						<td class=" "> <input type="text" name="tgl_rab" id="last-name" class="form-control text-right" oninput="formatAngka(this)" value="0"></td>
						
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>C/Hire Per day</strong></td>
						<td class=" ">: Rp.&nbsp;</td>
						<td class=" "><input type="text" name="tgl_rab" id="last-name" class="form-control text-right" oninput="formatAngka(this)" value="0"></td>
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>Total C/Hire Per day</strong></td>
						<td class=" ">: Rp.&nbsp;</td>
						<td class=" "><input type="text" name="tgl_rab" id="last-name" class="form-control text-right" oninput="formatAngka(this)" value="0"></td>
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>C/Hire Per Month</strong></td>
						<td class=" ">: Rp.&nbsp;</td>
						<td class=" "><input type="text" name="tgl_rab" id="last-name" class="form-control text-right" oninput="formatAngka(this)" value="0"></td>
					</tr>
				</table><br>
			</div>
			<div class="row col-md-4">
				<table>
					<tr class="even pointer">
						<td class=" " style="width: 15rem;"><strong>AVG. Speed/Knots</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" "> <input type="text" name="tgl_rab" id="last-name" class="form-control text-right" oninput="formatAngka(this)" value="0"></td>
						
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>Bunker Cons Per day</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" "><input type="text" name="tgl_rab" id="last-name" class="form-control text-right" oninput="formatAngka(this)" value="0"></td>
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>M/E Per Hrs</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" "><input type="text" name="tgl_rab" id="last-name" class="form-control text-right" value="0"></td>
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>A/E Per Hrs</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" "><input type="text" name="tgl_rab" id="last-name" class="form-control text-right" value="0"></td>
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
								<option value="">--Pilih Customer--</option>
								<?php foreach($customer as $row) : ?>
									<option value="<?= $row['id_cust']?>"><?= $row['nama_customer']?></option>
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
								<?php foreach($kargo as $row) : ?>
									<option value="<?= $row['id_kargo']?>"><?= $row['nama_kargo']?></option>
								<?php endforeach;?>	
							</select>

						</td>

					</tr>
				</table><br>
			</div>
			<div class="row col-md-4">
				<table>
					<tr class="even pointer">
						<td class=" " style="width: 15rem; text-align: right;"> <strong>Date of Opening :</strong></td>
						<td class=" "> <input type="date" class="form-control" id="dateOpening" onchange="calculateTotalDays()"></td>
						<td class=" ">  &nbsp;</td>
						
					</tr>
					<br>
					<tr class="odd pointer">
						<td class="" style="width: 15rem; text-align: right;"> <strong>Date of Closing :</strong></td>
						<td class=" "><input type="date" class="form-control" id="dateClosing" onchange="calculateTotalDays()"></td>
						<td class=" "> &nbsp;</td>
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" " style="width: 15rem; text-align: right;"> <strong>Total Days : </strong></td>
						<td class=" " style="width: 10rem; text-align: right;"> <strong><span id="totalDays">0</span></strong></td>
						<td class=" "></td>
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
						<td class=" " style="width: 15rem; text-align: right;"><strong>Loading Date :</strong></td>
						<td class=" "> <input type="date" class="form-control" id="dateOpening" onchange="calculateTotalDays()"></td>
						<td class=" ">  &nbsp;</td>
						
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" " style="width: 15rem; text-align: right;"> <strong>Est Discharging Date :</strong></td>
						<td class=" "> <input type="date" class="form-control" id="dateOpening" onchange="calculateTotalDays()"></td>
						<td class=" "> &nbsp;</td>
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" " style="width: 15rem; text-align: right;"><strong>Load Qty : </strong><input type="text" class="" value="0" style="width: 6rem; text-align: right;" oninput="formatAngka(this)"></td>
						<td class=" ">
						<select class="" style="padding: 3px;">
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select> </td>
						<td class=" "> </td>
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
			
					<td class=" " style="vertical-align: middle; text-align: left; width: 15rem;">Mob port from</td>
					<td class=" ">
						<select class="form-control col-md-12" name="voy_num" required>
							<option value=""></option>
							<?php foreach($port as $row) : ?>
								<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>
							<?php endforeach;?>	
						</select>
					
					</td>
					<td class=" " rowspan="6"  style="vertical-align: middle; text-align: center; width: 18rem;">Distance</td>
					<td class=" " style="vertical-align: middle; text-align: center; width: 15rem;"><input type="text" name="tgl_rab" class="form-control text-right" style="width: " value="0"></td>
					<td class=" " style="vertical-align: middle; text-align: right;">Bunker Price Rp. </td>
					<td class=""><input type="text" name="" class="form-control text-right" oninput="formatAngka(this)" value="0"></td>
				</tr>
				<tr class="odd pointer">

					<td class=" " style="vertical-align: middle; text-align: left;">Load port </td>
					<td class=" ">
						<select class="form-control col-md-12" name="voy_num" required>
							<option value=""></option>
							<?php foreach($port as $row) : ?>
								<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>
							<?php endforeach;?>	
						</select>
					</td>
					
					<td class=" "><input type="text" name="tgl_rab" class="form-control text-right" value="0"></td>
					<td class=" " style="vertical-align: middle; text-align: right;">Lumpsum Freight Rp. </td>
					<td class="a-right a-right "><input type="text" name="tgl_rab" class="form-control text-right" oninput="formatAngka(this)" value="0"></td>
				</tr>
				<tr class="odd pointer">

					<td class=" " style="vertical-align: middle; text-align: left;">Load port 2</td>
					<td class=" ">
						<select class="form-control col-md-12" name="voy_num" required>
							<option value=""></option>
							<?php foreach($port as $row) : ?>
								<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>
							<?php endforeach;?>	
						</select>
					</td>
					
					<td class=" "><input type="text" name="tgl_rab" class="form-control text-right" value="0"></td>
					<td class=" " colspan="2">&nbsp;</td>
				</tr>
				<tr class="even pointer">

					<td class=" " style="vertical-align: middle; text-align: left;">Discharge port</td>
					<td class=" ">
						<select class="form-control col-md-12" name="voy_num" required>
							<option value=""></option>
							<?php foreach($port as $row) : ?>
								<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>
							<?php endforeach;?>	
						</select>
					</td>
				
					<td class=" "><input type="text" name="tgl_rab" class="form-control text-right" value="0"></td>
					<td class=" " style="vertical-align: middle; text-align: right;">Freight Computation Rp. </td>
					<td class=" "><input type="text" name="tgl_rab" class="form-control text-right" oninput="formatAngka(this)" value="0"></td>
				</tr>
				<tr class="even pointer">

					<td class=" " style="vertical-align: middle; text-align: left;">Discharge port 2</td>
					<td class=" ">
						<select class="form-control col-md-12" name="voy_num" required>
							<option value=""></option>
							<?php foreach($port as $row) : ?>
								<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>
							<?php endforeach;?>	
						</select>
					</td>
				
					<td class=" "><input type="text" name="tgl_rab" class="form-control text-right" value="0"></td>
					<td class=" " colspan="2">&nbsp;</td>
				</tr>
				<tr class="odd pointer">

					<td class=" " style="vertical-align: middle; text-align: left;">Demob</td>
					<td class=" ">
						<select class="form-control col-md-12" name="voy_num" required>
							<option value=""></option>
							<?php foreach($port as $row) : ?>
								<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>
							<?php endforeach;?>	
						</select>
					</td>
			
					<td class=" "><input type="text" name="tgl_rab" class="form-control text-right" value="0"></td>
					<td class=" " colspan="2">&nbsp;</td>
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
						<td>
							<select class="form-control col-md-12" name="voy_num" required>
								<option value="">--From--</option>
								<?php foreach($port as $row) : ?>
									<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>
							<select class="form-control col-md-12" name="voy_num" required>
								<option value="">--To--</option>
								<?php foreach($port as $row) : ?>
									<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0"></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0"></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0"></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0"></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0"></td>
					</tr>
					<tr>
						<td>
							<select class="form-control col-md-12" name="voy_num" required>
								<option value="">--From--</option>
								<?php foreach($port as $row) : ?>
									<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>
							<select class="form-control col-md-12" name="voy_num" required>
								<option value="">--To--</option>
								<?php foreach($port as $row) : ?>
									<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
					</tr>
					<tr>
						<td>Idle Time</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
					</tr>

					<tr>
						<td>Loading - un loading</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
					</tr>

					<tr>
						<td>Oil Barge</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
					</tr>

					<tr>
						<td>Boiler</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
					</tr>

					<tr>
						<td>ROB (Remaind On Board)</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
					</tr>

					<tr>
						<td>Shifting / OG</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
						<td><input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required></td>
					</tr>

					<tr style="text-align: right">
						<td colspan="2" ><center><strong>Total</strong></center></td>
						<td><strong>0</strong></td>
						<td><strong>0</strong></td>
						<td><strong>0</strong></td>
						<td><strong>0</strong></td>
						<td><strong>0</strong></td>
					</tr>
					
					
					
					


				</tbody>
				<button type="button" class="btn btn-success btn-sm mt-1" id="addRowBtn"> <i class="fa fa-plus"></i> Row </button>
				<!-- <button id="addRowBtn">Submit</button> -->
			</table>
		</div>

		<!-- batas table activites -->

		<div class="table-responsive">
			<table class="table table-bordered" id="dataTables" >
				<thead>
					<tr class="" style="background-color: #A3B2D9;">
						<th class="" colspan="4" rowspan="2" style="vertical-align: middle; text-align: center;"><center>Revenue Sales</center> </th>
						<th class="" colspan="2"><center>Jumlah</center></th>
						
					</tr>
					<tr class="" style="background-color: #A3B2D9;">
						<th class=""><center>(IDR)</center> </th>
						<th class=""><center>%</center></th>
						
					</tr>
				</thead>

				<tbody>
					<tr>
						<td style="vertical-align: middle; text-align: right;">
							<Label>1. Freight Earning From</Label>
						</td>
						<td style="vertical-align: middle; text-align: right;">
							<select class="form-control col-md-12" name="">
								<option value="">--Pilih Port--</option>
								<?php foreach($port as $row) : ?>
									<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td colspan="2">
							<select class="form-control col-md-6" name="">
								<option value="">--Pilih Port--</option>
								<?php foreach($port as $row) : ?>
									<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td style="vertical-align: middle; text-align: right;"><input type="text" name="" style="vertical-align: middle; text-align: right;" value="0" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td style="vertical-align: middle; text-align: right;">
							<Label>2. Freight Earning From</Label>
						</td>
						<td style="vertical-align: middle; text-align: right;">
							<select class="form-control col-md-12" name="">
								<option value="">--Pilih Port--</option>
								<?php foreach($port as $row) : ?>
									<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td colspan="2">
							<select class="form-control col-md-6" name="">
								<option value="">--Pilih Port--</option>
								<?php foreach($port as $row) : ?>
									<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td style="vertical-align: middle; text-align: right;"><input type="text" name="" style="vertical-align: middle; text-align: right;" value="0" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>

					<tr style=" background-color:#FAFD8A;">
						<td colspan="4"><b style="float: right;">Total Sales Revenue</b></td>
						<td ><b style="float: right;">0</b></td>
						<td><b style="float: right;">0 %</b></td>
						
					</tr>
					

				</tbody>

				<thead>
					<tr class="" style="background-color: #A3B2D9;">
						<th class="" colspan="2" style="vertical-align: middle; text-align: center;"><center>Expenses/item</center> </th>
						<th class="" ><center>Total Qty</center></th>
						<th class="" ><center>Unit Price</center></th>
						<th class="">&nbsp;</th>
						<th class="">&nbsp;</th>
						
					</tr>
					<tr class="" style=" background-color:#FAFD8A;">
						<th class="" colspan="4" style="vertical-align: middle; text-align: right;">Total Expenses</th>
						<th class=""><b style="float: right;">0</b></th>
						<th class="" ><b style="float: right;">0 %</b></th>
						
					</tr>
					
				</thead>
				<tbody>
					<tr>
						<td>Gaji Crew</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Asuransi Armada</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Uang Makan</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Repair Maintenance (RM)</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Depresiasi</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Bunker Usage</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Total Freshwater Usage</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Crew Bonus</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Biaya On Time Delivery (OTD)</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Biaya Operasional Nahkoda</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Agency Fees at Loading Port</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Agency Fees at Discharge Port</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Labuh Tambat at Loading Port</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Labuh Tambat at Discharge Port</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Biaya Koordinasi di Laut</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Biaya Supervisi loading un loading</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Broker Fee</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Biaya Premi Pengawas</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Biaya Lain-lain Pengawas</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Biaya Lain-lain Operasional</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>R/M Additional</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Pengurusan Document Kapal</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Biaya keperluan kapal/cleaning</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Crew Bonus (Performance Losses)</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>
					<tr>
						<td>Pph Pasal 15 - (1.2%)</td>
						<td colspan="2" style="vertical-align: middle; text-align: center;">
							<input type="text" name="" value="0" class="text-right" style="width: 7rem;" oninput="formatAngka(this)">
							<select class="" style="padding: 3px;" name="" required>
								<option value="">--Pilih Satuan--</option>
								<?php foreach($satuan as $row) : ?>
									<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
								<?php endforeach;?>	
							</select>
						</td>
						<td>Rp. <input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td><input type="text" name="" value="0" style="float: right; text-align: right;" oninput="formatAngka(this)"></td>
						<td>&nbsp;</td>
						
					</tr>

					<tr style=" background-color:#FAFD8A;">
						<td colspan="4"><b style="float: right;">Cost of Money (2.5%)</b></td>
						<td >0</td>
						<td><b style="float: right;">%</b></td>
						
					</tr>
					<tr style=" background-color:#FAFD8A; border-color: black;">
						<td colspan="4"><b style="float: right;">Management Fee (2.5%)</b></td>
						<td >0</td>
						<td><b style="float: right;">%</b></td>
						
					</tr>
					<tr style=" background-color:#fff;">
						<td colspan="4"><b style="float: right;">Net Profit (2.5%)</b></td>
						<td >0</td>
						<td><b style="float: right;">%</b></td>
						
					</tr>
					<tr style=" background-color:#fff;">
						
						<td colspan="6">
							<label for=""><b>Notes Proyek: </b></label>
							<textarea name="ctt" id="" colspan="30" rows="5" class="form-control" style="resize: none;" placeholder="Ketikkan Notes Proyek"></textarea>
						</td>
						
						
					</tr>
					

				</tbody>				

				<!-- <button type="button" id="addRowBtn">Add Row</button>
				<button id="addRowBtn">Submit</button> -->
			</table>
		</div>
				
			
		</div>
				
				<a href="?page=RAB" class="btn btn-danger btn-sm">Cancel</a>
				<button type="submit" class="btn btn-success btn-sm" name="submit">Submit</button>
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

        cell1.innerHTML = '<select class="form-control col-md-12" name="" required>' +
							'<option value="">--From--</option>' +
							'<?php foreach($port as $row) : ?>' +
								'<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>' +
							'<?php endforeach;?>' +
						'</select>';
        cell2.innerHTML = '<select class="form-control col-md-12" name="" required>' +
							'<option value="">--To--</option>' +
							'<?php foreach($port as $row) : ?>' +
								'<option value="<?= $row['id_port']?>"><?= $row['nama_port']?></option>' +
							'<?php endforeach;?>' +
						'</select>';
        cell3.innerHTML = '<input type="text" name="field3[]" style="text-align: right" class="form-control" value="0" required>';
        cell4.innerHTML = '<input type="text" name="field4[]" style="text-align: right" class="form-control" value="0" required>';
        cell5.innerHTML = '<input type="text" name="field5[]" style="text-align: right" class="form-control" value="0" required>';
        cell6.innerHTML = '<input type="text" name="field6[]" style="text-align: right" class="form-control" value="0" required>';
        cell7.innerHTML = '<input type="text" name="field7[]" style="text-align: right" class="form-control" value="0" required>';
    });
</script>

<script>
	function formatAngka(input) {
		// Menghapus karakter selain angka
		let angka = input.value.replace(/\D/g, '');

		// Menggunakan fungsi Number() untuk mengonversi string menjadi angka
		angka = Number(angka);

		// Menggunakan fungsi toLocaleString() untuk memformat angka dengan tanda pemisah ribuan
		input.value = angka.toLocaleString();
	}
</script>

<script>
	function calculateTotalDays() {
		// Ambil elemen input date
		var dateOpening = document.getElementById("dateOpening").value;
		var dateClosing = document.getElementById("dateClosing").value;

		// Konversi string date menjadi objek Date
		var startDate = new Date(dateOpening);
		var endDate = new Date(dateClosing);

		// Hitung selisih hari dan tambahkan 1
		var timeDifference = endDate.getTime() - startDate.getTime();
		var daysDifference = Math.floor(timeDifference / (1000 * 3600 * 24)) + 1;

		// Tampilkan hasil pada elemen dengan id "totalDays"
		document.getElementById("totalDays").innerText = daysDifference;
	}
</script>