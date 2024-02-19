<?php


$kode_sales = generate_kode_sales();

$customer = query("SELECT * FROM customer");
$vessel = query("SELECT * FROM vessel");
$satuan = query("SELECT * FROM satuan");
$dept = query("SELECT * FROM dept");
$kargo = query("SELECT * FROM jenis_kargo");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(tambahSales($_POST) > 0 ) {
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
			window.location.href = '?page=salesPlan'; //will redirect to your blog page (an ex: blog.html)
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
			window.location.href = '?page=salesPlan'; //will redirect to your blog page (an ex: blog.html)
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
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Kode Sales <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" name="kode_brg" id="last-name" required="required" class="form-control" value="<?= $kode_sales;?>" readonly>
									</div>
								</div>

								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="voy_num">Voyage Number <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" name="voy_num" id="voy_num" required="required" class="form-control" placeholder="Ketikkan Voyage Number">
									</div>
								</div>

                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Vessel <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_vessel" required>
                                            <option value="">--Pilih Vessel--</option>
                                            <?php foreach($vessel as $row) : ?>
                                                <option value="<?= $row['id_vessel']?>"><?= $row['nama_vessel']?></option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Customer <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_cust" required>
                                            <option value="">--Pilih Customer--</option>
                                            <?php foreach($customer as $row) : ?>
                                                <option value="<?= $row['id_cust']?>"><?= $row['nama_customer']?></option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>

								<div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kargo <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_kargo" required>
                                            <option value="">--Pilih Jenis Kargo--</option>
                                            <?php foreach($kargo as $row) : ?>
                                                <option value="<?= $row['id_kargo']?>"><?= $row['nama_kargo']?></option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Qty</label>
									<div class="col-md-6 col-sm-6 ">
										<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" placeholder="Ketikkan Qty">
									</div>
								</div>

                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Satuan <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_satuan" required>
                                            <option value="">--Pilih Satuan--</option>
                                            <?php foreach($satuan as $row) : ?>
                                                <option value="<?= $row['id_satuan']?>"><?= $row['nama_satuan']?></option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Loading Port <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" name="loading_port" id="last-name" required="required" class="form-control" placeholder="Ketikkan Loading Port">
									</div>
								</div>

                                <div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Discharge Port <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" name="discharge_port" id="last-name" required="required" class="form-control" placeholder="Ketikkan Discharge Port">
									</div>
								</div>

                                <div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Sales Nominal</label>
									<div class="col-md-6 col-sm-6 ">
										<input id="middle-name" name="sales_nominal" class="form-control" type="number" min="1" placeholder="Ketikkan Sales Nominal">
									</div>
								</div>

                                <div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Start <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="date" name="start" id="last-name" required="required" class="form-control">
									</div>
								</div>

                                <div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Finished
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="date" name="finished" id="last-name" class="form-control">
									</div>
								</div>

                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Departement <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_dept" required>
                                            <option value="">--Pilih Departement--</option>
                                            <?php foreach($dept as $row) : ?>
                                                <option value="<?= $row['id_dept']?>"><?= $row['nama_dept']?></option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>

								<input type="hidden" name="app1">
								<input type="hidden" name="app2">
								<input type="hidden" name="app3">
								<input type="hidden" name="status_plan" value="On Dirops">


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
