<?php

$id_user = $_SESSION['id_user'];
$rab = query("SELECT * FROM rab JOIN user ON user.id_user=rab.id_user");
$sales_plan = query("SELECT * FROM sales_plan");
$doc_num = generate_document_number();
$satuan = query("SELECT * FROM satuan");

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

<div class="x_panel">
    <div class="">			
		<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 ">
					<div class="x_panel">
						<div class="x_title">
							<h2>Form Input Sales Plan <small></small></h2>
							
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<br />
							<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Document Number <span class="required">*</span>
									</label>
									<div class="col-md-3 col-sm-6 ">
										<input type="text" name="doc_num" id="last-name" required="required" class="form-control" placeholder="<?= $doc_num;?>" readonly>
									</div>

									<div class="col-md-4 col-sm-">
										<div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="last-name">Tanggal</label>
											<input type="date" name="tgl_rab" id="last-name" class="form-control" value="<?= date('Y-m-d');?>">
										</div>
									</div>
								</div>

								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="voy_num">Voyage Number <span class="required">*</span>
									</label>
									<div class="col-md-3 col-sm-6 ">
										<select class="form-control" name="voy_num" required>
											<option value="">--Pilih Voyage Number--</option>
											<?php foreach($sales_plan as $row) : ?>
												<option value="<?= $row['id_sales']?>"><?= $row['voy_num']?></option>
											<?php endforeach;?>	
										</select>
									</div>
								</div>
								<div class="x_content"></div><hr>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Gaji Crew</label>
									<div class="col-md-3 col-sm-6 ">
										<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
									</div>

									<div class="col-md-4 col-sm-6">
										<div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="last-name">Asuransi Armada</label>
											<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
										</div>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Uang Makan</label>
									<div class="col-md-3 col-sm-6 ">
										<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
									</div>

									<div class="col-md-4 col-sm-6">
										<div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="last-name">Repair Maintenance</label>
											<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
										</div>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Depresiasi</label>
									<div class="col-md-3 col-sm-6 ">
										<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
									</div>

									<div class="col-md-4 col-sm-6">
										<div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="last-name">Bunker Usage</label>
											<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
										</div>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Total Freshwater Usage</label>
									<div class="col-md-3 col-sm-6 ">
										<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
									</div>

									<div class="col-md-4 col-sm-6">
										<div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="last-name">Crew Bonus</label>
											<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
										</div>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Agency Fees at Loading Port</label>
									<div class="col-md-3 col-sm-6 ">
										<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
									</div>

									<div class="col-md-4 col-sm-6">
										<div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="last-name">Agency Fees at Discharge Port</label>
											<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
										</div>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Labuh Tambat at Loading Port</label>
									<div class="col-md-3 col-sm-6 ">
										<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
									</div>

									<div class="col-md-4 col-sm-6">
										<div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="last-name">Labuh Tambat at Discharge Port</label>
											<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
										</div>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Biaya Koordinasi di Laut</label>
									<div class="col-md-3 col-sm-6 ">
										<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
									</div>

									<div class="col-md-4 col-sm-6">
										<div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="last-name">Biaya Supervisi Loading Unloading</label>
											<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
										</div>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Broker Fee</label>
									<div class="col-md-3 col-sm-6 ">
										<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
									</div>

									<div class="col-md-4 col-sm-6">
										<div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="last-name">Biaya Premi Pengawas</label>
											<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
										</div>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Biaya Lain-lain Operasional</label>
									<div class="col-md-3 col-sm-6 ">
										<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
									</div>

									<div class="col-md-4 col-sm-6">
										<div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="last-name">R/M Additional</label>
											<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
										</div>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Pengurusan Document Kapal</label>
									<div class="col-md-3 col-sm-6 ">
										<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
									</div>

									<div class="col-md-4 col-sm-6">
										<div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="last-name">Biaya Keperluan Kapal/Cleaning</label>
											<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
										</div>
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Crew Bonus (Performance Losses)</label>
									<div class="col-md-3 col-sm-6 ">
										<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
									</div>

									<div class="col-md-4 col-sm-6">
										<div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="last-name">Pph pasal 15 - (1.2%)</label>
											<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="0">
										</div>
									</div>
								</div>


					
                                <!-- <div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Crew Bonus (Performance Losses) <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" name="loading_port" id="last-name" required="required" class="form-control" placeholder="0">
									</div>
								</div>

								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Pph pasal 15 - (1.2%) <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" name="loading_port" id="last-name" required="required" class="form-control" placeholder="0">
									</div>
								</div> -->


								<div class="ln_solid"></div>
								<div class="item form-group">
									<div class="col-md-6 col-sm-6 offset-md-3">
										<!-- <button class="btn btn-primary" type="button">Cancel</button> -->
										<button class="btn btn-primary" type="reset">Reset</button>
										<button type="submit" class="btn btn-success" name="submit">Submit</button>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>				
	</div>
</div>

<div class="col-md-12 col-sm-12  ">
	<div class="x_panel">
		<div class="x_title">
		<!-- <h2>Table design <small>Custom design</small></h2> -->

		<div class="clearfix"></div>
		</div>

		<div class="x_content">

		<div class="table-responsive ">
			<div class="row col-md-6">
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
			<div class="row col-md-6">
				<table>
					<tr class="even pointer">
						<td class=" " style="width: 10rem;"><strong>Tanggal</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" "> <input type="date" name="tgl_rab" id="last-name" class="form-control" value="<?= date('Y-m-d');?>"></td>
						
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>Deskripsi</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" ">
							<!-- <input type="text" name="tgl_rab" id="last-name" class="form-control"> -->
							<textarea name="" id="" cols="30" rows="3" class="form-control" style="resize: none;" placeholder="Ketikkan Deskripsi"></textarea>

						</td>

					</tr>
				</table><br>
			</div>
		</div>
		<br>
		<hr>
		<div class="table-responsive ">
			<div class="row col-md-6">
				<table>
					
					<br>
					<tr class="odd pointer" >
						<td class=" " style="width: 15rem;"><strong>Voyage Number</strong></td>
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
			<div class="row col-md-6">
				<table>
					<tr class="even pointer">
						<td class=" " style="width: 15rem;"><strong>C/Hire Per day</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" "> <input type="date" name="tgl_rab" id="last-name" class="form-control" value="<?= date('Y-m-d');?>"></td>
						
					</tr>
					<br>
					<tr class="odd pointer">
						<td class=" "><strong>C/Hire Per day</strong></td>
						<td class=" ">: &nbsp;</td>
						<td class=" ">
							<!-- <input type="text" name="tgl_rab" id="last-name" class="form-control"> -->
							<textarea name="" id="" cols="30" rows="2" class="form-control" style="resize: none;" placeholder="Ketikkan Deskripsi"></textarea>

						</td>

					</tr>
				</table><br>
			</div>
		</div>


		<div class="table-responsive">
			<table class="table table-striped jambo_table bulk_action">
			<thead>
				<tr class="headings">
				<th>
					<input type="checkbox" id="check-all" class="flat">
				</th>
				<th class="column-title">Expanses / Item </th>
				<th class="column-title">Total Qty </th>
				<th class="column-title">Unit Price </th>
				<th class="column-title">Bill to Name </th>
				<th class="column-title">Status </th>
				<th class="column-title">Amount </th>
				<th class="column-title no-link last"><span class="nobr">Action</span>
				</th>
				<th class="bulk-actions" colspan="7">
					<a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
				</th>
				</tr>
			</thead>

			<tbody>
				<tr class="even pointer">
				<td class="a-center ">
					<input type="checkbox" class="flat" name="table_records">
				</td>
				<td class=" ">Gaji Crew</td>
				<td class=" ">
					<input id="middle-name" name="qty_sales" class="form-control col-md-6" type="number" min="1" placeholder="0">
					<select class="form-control col-md-6" name="voy_num" required>
						<option value="">--Pilih Satuan--</option>
						<?php foreach($satuan as $row) : ?>
							<option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
						<?php endforeach;?>	
					</select>
				
				</td>
				<td class=" ">121000210 <i class="success fa fa-long-arrow-up"></i></td>
				<td class=" ">John Blank L</td>
				<td class=" ">Paid</td>
				<td class="a-right a-right ">$7.45</td>
				<td class=" last"><a href="#">View</a>
				</td>
				</tr>
				<tr class="odd pointer">
				<td class="a-center ">
					<input type="checkbox" class="flat" name="table_records">
				</td>
				<td class=" ">121000039</td>
				<td class=" ">May 23, 2014 11:30:12 PM</td>
				<td class=" ">121000208 <i class="success fa fa-long-arrow-up"></i>
				</td>
				<td class=" ">John Blank L</td>
				<td class=" ">Paid</td>
				<td class="a-right a-right ">$741.20</td>
				<td class=" last"><a href="#">View</a>
				</td>
				</tr>
				<tr class="even pointer">
				<td class="a-center ">
					<input type="checkbox" class="flat" name="table_records">
				</td>
				<td class=" ">121000038</td>
				<td class=" ">May 24, 2014 10:55:33 PM</td>
				<td class=" ">121000203 <i class="success fa fa-long-arrow-up"></i>
				</td>
				<td class=" ">Mike Smith</td>
				<td class=" ">Paid</td>
				<td class="a-right a-right ">$432.26</td>
				<td class=" last"><a href="#">View</a>
				</td>
				</tr>
				<tr class="odd pointer">
				<td class="a-center ">
					<input type="checkbox" class="flat" name="table_records">
				</td>
				<td class=" ">121000037</td>
				<td class=" ">May 24, 2014 10:52:44 PM</td>
				<td class=" ">121000204</td>
				<td class=" ">Mike Smith</td>
				<td class=" ">Paid</td>
				<td class="a-right a-right ">$333.21</td>
				<td class=" last"><a href="#">View</a>
				</td>
				</tr>
				<tr class="even pointer">
				<td class="a-center ">
					<input type="checkbox" class="flat" name="table_records">
				</td>
				<td class=" ">121000040</td>
				<td class=" ">May 24, 2014 11:47:56 PM </td>
				<td class=" ">121000210</td>
				<td class=" ">John Blank L</td>
				<td class=" ">Paid</td>
				<td class="a-right a-right ">$7.45</td>
				<td class=" last"><a href="#">View</a>
				</td>
				</tr>
				<tr class="odd pointer">
				<td class="a-center ">
					<input type="checkbox" class="flat" name="table_records">
				</td>
				<td class=" ">121000039</td>
				<td class=" ">May 26, 2014 11:30:12 PM</td>
				<td class=" ">121000208 <i class="error fa fa-long-arrow-down"></i>
				</td>
				<td class=" ">John Blank L</td>
				<td class=" ">Paid</td>
				<td class="a-right a-right ">$741.20</td>
				<td class=" last"><a href="#">View</a>
				</td>
				</tr>
				<tr class="even pointer">
				<td class="a-center ">
					<input type="checkbox" class="flat" name="table_records">
				</td>
				<td class=" ">121000038</td>
				<td class=" ">May 26, 2014 10:55:33 PM</td>
				<td class=" ">121000203</td>
				<td class=" ">Mike Smith</td>
				<td class=" ">Paid</td>
				<td class="a-right a-right ">$432.26</td>
				<td class=" last"><a href="#">View</a>
				</td>
				</tr>
				<tr class="odd pointer">
				<td class="a-center ">
					<input type="checkbox" class="flat" name="table_records">
				</td>
				<td class=" ">121000037</td>
				<td class=" ">May 26, 2014 10:52:44 PM</td>
				<td class=" ">121000204</td>
				<td class=" ">Mike Smith</td>
				<td class=" ">Paid</td>
				<td class="a-right a-right ">$333.21</td>
				<td class=" last"><a href="#">View</a>
				</td>
				</tr>

				<tr class="even pointer">
				<td class="a-center ">
					<input type="checkbox" class="flat" name="table_records">
				</td>
				<td class=" ">121000040</td>
				<td class=" ">May 27, 2014 11:47:56 PM </td>
				<td class=" ">121000210</td>
				<td class=" ">John Blank L</td>
				<td class=" ">Paid</td>
				<td class="a-right a-right ">$7.45</td>
				<td class=" last"><a href="#">View</a>
				</td>
				</tr>
				<tr class="odd pointer">
				<td class="a-center ">
					<input type="checkbox" class="flat" name="table_records">
				</td>
				<td class=" ">121000039</td>
				<td class=" ">May 28, 2014 11:30:12 PM</td>
				<td class=" ">121000208</td>
				<td class=" ">John Blank L</td>
				<td class=" ">Paid</td>
				<td class="a-right a-right ">$741.20</td>
				<td class=" last"><a href="#">View</a>
				</td>
				</tr>
			</tbody>
			</table>
		</div>
				
			
		</div>
	</div>
</div>