<?php

$id_sales = $_GET['id_sales'];
$kode_sales = generate_kode_sales();

$customer = query("SELECT * FROM customer");
$vessel = query("SELECT * FROM vessel");
$satuan = query("SELECT * FROM satuan");
$dept = query("SELECT * FROM dept");

$sales_plan = query("SELECT * FROM sales_plan WHERE id_sales=$id_sales")[0];
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	


	// cek apakah data berhasil ditambahkan atau tidak
	if(ubahSales($_POST) > 0 ) {
		echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
		echo '<script src="./sweetalert2.min.js"></script>';
		echo "<script>
		setTimeout(function () { 
			swal.fire({
				
				title               : 'Berhasil',
				text                :  'Data berhasil diubah',
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
				text                :  'Data gagal diubah',
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
							<h2>Ubah Data Sales Plan <small></small></h2>
						
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<br />
							<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                            <input type="hidden" name="id_sales" value="<?= $sales_plan["id_sales"];?>">
								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Kode Sales <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" name="kode_brg" id="last-name" required="required" class="form-control" value="<?= $sales_plan['kode_sales'];?>" readonly>
									</div>
								</div>

                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Vessel <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_vessel" required>
                                            <option value="">--Pilih Vessel--</option>
                                            <?php foreach($vessel as $row) : ?>
                                                <option value="<?= $row['id_vessel']?>" <?= ($row['id_vessel'] == $sales_plan['id_vessel'])? 'selected' : '';?>><?= $row['nama_vessel']?></option>
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
                                                <option value="<?= $row['id_cust']?>" <?= ($row['id_cust'] == $sales_plan['id_cust'])? 'selected' : '';?>><?= $row['nama_customer']?></option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>
                        
								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Jenis Kargo <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" name="jenis_kargo" id="last-name" required="required" class="form-control" value="<?= $sales_plan['jenis_kargo']?>">
									</div>
								</div>

								<div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Qty</label>
									<div class="col-md-6 col-sm-6 ">
										<input id="middle-name" name="qty_sales" class="form-control" type="number" min="1" value="<?= $sales_plan['qty_sales']?>">
									</div>
								</div>

                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Satuan <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_satuan" required>
                                            <option value="">--Pilih Satuan--</option>
                                            <?php foreach($satuan as $row) : ?>
                                                <option value="<?= $row['id_satuan']?>" <?= ($row['id_satuan'] == $sales_plan['id_satuan'])? 'selected' : '';?>><?= $row['nama_satuan']?></option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Loading Port <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" name="loading_port" id="last-name" required="required" class="form-control" value="<?= $sales_plan['loading_port']?>">
									</div>
								</div>

                                <div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Discharge Port <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" name="discharge_port" id="last-name" required="required" class="form-control" value="<?= $sales_plan['discharge_port']?>">
									</div>
								</div>

                                <div class="item form-group">
									<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Sales Nominal</label>
									<div class="col-md-6 col-sm-6 ">
										<input id="middle-name" name="sales_nominal" class="form-control" type="number" min="1" value="<?= $sales_plan['sales_nominal']?>">
									</div>
								</div>

                                <div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Start <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="date" name="start" id="last-name" required="required" class="form-control" value="<?= $sales_plan['start']?>">
									</div>
								</div>

                                <div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Finished
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="date" name="finished" id="last-name" class="form-control" value="<?= $sales_plan['finished']?>">
									</div>
								</div>

                                <div class="item form-group">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Departement <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="id_dept" required>
                                            <option value="">--Pilih Departement--</option>
                                            <?php foreach($dept as $row) : ?>
                                                <option value="<?= $row['id_dept']?>" <?= ($row['id_dept'] == $sales_plan['id_dept'])? 'selected' : '';?>><?= $row['nama_dept']?></option>
                                            <?php endforeach;?>	
                                        </select>
                                    </div>
                                </div>

								<div class="ln_solid"></div>
								<div class="item form-group">
									<div class="col-md-6 col-sm-6 offset-md-3">
										<!-- <button class="btn btn-primary" type="button">Cancel</button> -->
										<button class="btn btn-primary" type="reset">Reset</button>
										<button type="submit" class="btn btn-success" name="submit">Ubah</button>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>

				




					
	</div>
 </div>
