

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

$sertifikat_expired = query("SELECT COUNT(*) as totalexpired FROM sertifikat_kapal WHERE status_cert='Kedaluarsa'");
$totalExpired = $sertifikat_expired[0]['totalexpired'];

$will_expired = query("SELECT COUNT(*) as totalwillexpired FROM sertifikat_kapal WHERE status_cert='Akan Kedaluarsa'");
$totalWillExpired = $will_expired[0]['totalwillexpired'];

$sertifikat_aktif = query("SELECT COUNT(*) as totalsertifikataktif FROM sertifikat_kapal WHERE status_cert='Aktif'");
$totalAktif = $sertifikat_aktif[0]['totalsertifikataktif'];

$crew_on = query("SELECT COUNT(*) as totalcrew FROM kontrak_crew WHERE idstatus_crew=1");
$totalCrewOn = $crew_on[0]['totalcrew'];

$crew_end = query("SELECT COUNT(*) as totalcrew FROM kontrak_crew WHERE idstatus_crew=2");
$totalCrewEnd = $crew_end[0]['totalcrew'];


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
	<div class="tile-stats --bs-success-bg-subtle">
		<div class="icon"><i class="fa fa-check-square-o"></i>
		</div>
		<div class="count"><?= $totalSertifikat;?></div>

		<h3>Total Sertifikat Kapal</h3>
		<p><a href="?page=monitoringSertifikat">More details</a></p>
	</div>
	</div>
</div>

<div class="row">
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
	<div class="tile-stats bg-danger text-light">
		<div class="icon"><i class="fa fa-hourglass-end text-white"></i>
		</div>
		<div class="count"><?= $totalExpired;?></div>

		<h3 class="text-white">Sertifikat Expired</h3>
		<p><a href="?page=sertifikatExpired" class="text-white">More details</a></p>
	</div>
	</div>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
	<div class="tile-stats bg-warning text-light">
		<div class="icon"><i class="fa fa-exclamation-triangle text-white"></i>
		</div>
		<div class="count"><?= $totalWillExpired;?></div>

		<h3 class="text-white">Sertifikat Will Expired</h3>
		<p><a href="?page=sertifikatWillExpired" class="text-white">More details</a></p>
	</div>
	</div>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
	<div class="tile-stats bg-success text-light">
		<div class="icon"><i class="fa fa-hourglass text-white"></i>
		</div>
		<div class="count"><?= $totalAktif;?></div>

		<h3 class="text-white">Sertifikat Aktif</h3>
		<p><a href="?page=sertifikatAktif" class="text-white">More details</a></p>
	</div>
	</div>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
	<div class="tile-stats bg-info text-light">
		<div class="icon"><i class="fa fa-check-square-o text-light"></i>
		</div>
		<div class="count"><?= $totalSertifikat;?></div>

		<h3 class="text-white">Stock BBM Monitor</h3>
		<p><a href="?page=monitoringSertifikat" class="text-white">More details</a></p>
	</div>
	</div>
</div>

<div class="row">
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
	<div class="tile-stats bg-danger text-light">
		<div class="icon"><i class="fa fa-toggle-off text-white"></i>
		</div>
		<div class="count"><?= $totalCrewEnd;?></div>

		<h3 class="text-white">Crew End Contract</h3>
		<p><a href="?page=crewEndContract" class="text-white">More details</a></p>
	</div>
	</div>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
	<div class="tile-stats bg-warning text-light">
		<div class="icon"><i class="fa fa-exclamation-triangle text-white"></i>
		</div>
		<div class="count"><?= $totalCrewOn;?></div>

		<h3 class="text-white">Crew Will End Contract</h3>
		<p><a href="?page=sertifikatWillExpired" class="text-white">More details</a></p>
	</div>
	</div>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
	<div class="tile-stats bg-success text-light">
		<div class="icon"><i class="fa fa-toggle-on text-white"></i>
		</div>
		<div class="count"><?= $totalCrewOn;?></div>

		<h3 class="text-white">Crew On Contract</h3>
		<p><a href="?page=sertifikatWillExpired" class="text-white">More details</a></p>
	</div>
	</div>
	
</div>

