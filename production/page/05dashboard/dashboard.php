

<!-- <div class="x_content">
	<div class="bs-glyphicons">
		<ul class="bs-glyphicons-list">

		<a href="index.php">
		  <li>
		    <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
		    <span class="glyphicon-class"><a href="index.php">Dashboard</span></a>
		  </li>
		</a>

		<a href="?form=tambahPengajuan">
		  <li>
		    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
		    <span class="glyphicon-class"><a href="?form=tambahPengajuan">Form Pengajuan Barang</span></a>
		  </li>
		</a>

		<a href="?page=historyPengajuan">
		  <li>
		    <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
		    <span class="glyphicon-class"><a href="?page=historyPengajuan">Tracking Progress</span></a>
		  </li>
		</a>

		  
		  

		</ul>
	</div>
</div> -->

<?php

$kapal = query("SELECT COUNT(*) as total FROM vessel");
$totalVessel = $kapal[0]['total'];

$crew = query("SELECT COUNT(*) as totalcrew FROM crew");
$totalCrew = $crew[0]['totalcrew'];

$storage_barang = query("SELECT COUNT(*) as totalstorage FROM storage_barang");
$totalStorage = $storage_barang[0]['totalstorage'];

$sertifikat_kapal = query("SELECT COUNT(*) as totalsertifikat FROM sertifikat_kapal");
$totalSertifikat = $sertifikat_kapal[0]['totalsertifikat'];


?>

<div class="row">
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
	<div class="tile-stats">
		<div class="icon"><i class="fa fa-ship"></i>
		</div>
		<div class="count"><?= $totalVessel;?></div>

		<h3>Total Vessel</h3>
		<p><a href="?page=masterVessel">More details</a></p>
	</div>
	</div>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
	<div class="tile-stats">
		<div class="icon"><i class="fa fa-users"></i>
		</div>
		<div class="count"><?= $totalCrew;?></div>

		<h3>Total Crew</h3>
		<p><a href="?page=crew">More details</a></p>
	</div>
	</div>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
	<div class="tile-stats">
		<div class="icon"><i class="fa fa-sort-amount-desc"></i>
		</div>
		<div class="count"><?= $totalStorage;?></div>

		<h3>Total Inventaris & Asset</h3>
		<p><a href="?page=inventarisAsset">More details</a></p>
	</div>
	</div>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
	<div class="tile-stats">
		<div class="icon"><i class="fa fa-check-square-o"></i>
		</div>
		<div class="count"><?= $totalSertifikat;?></div>

		<h3>Total Sertifikat Kapal</h3>
		<p><a href="?page=monitoringSertifikat">More details</a></p>
	</div>
	</div>
</div>