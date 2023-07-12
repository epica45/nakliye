<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<title>Nakliye Proforma Hesaplama</title>
	<style type="text/css">
		.input-group{
			margin: 10px 0px;
		}
		.dragging {
			background-color: red;
		}
	</style>
</head>
<body>
<div class="container">
	<?php
		$attributes = array('method'=>'post','name'=>'hesapla_form');
    	echo form_open('Nakliye/hesapla', $attributes);
	?>
	<div class="col-md-6">
		<div class="input-group">
			<span class="input-group-addon">Vessel Name</span>
		    <input id="vessel-name" type="text" class="form-control" name="vesselName" value="ARISTON TBN">
		</div>
		<div class="input-group">
			<span class="input-group-addon">Flag</span>
			<input id="flag" type="text" class="form-control" name="flag" value="GRC FLAG">
		</div>
		<div class="input-group">
			<span class="input-group-addon">NRT</span>
		    <input id="nrt" type="text" class="form-control" name="nrt" value="17889">
		</div>
		<div class="input-group">
			<span class="input-group-addon">GRT</span>
			<input id="grt" type="text" class="form-control" name="grt" value="29499">
		</div>
		<div class="input-group">
			<span class="input-group-addon">Cargo</span>
		    <input id="cargo" type="text" class="form-control" name="cargo" value="35000">
		</div>
		<div class="input-group">
			<span class="input-group-addon">Cargo Type</span>
			<input id="cargo-type" type="text" class="form-control" name="cargoType" value="">
		</div>
		<div class="input-group">
			<span class="input-group-addon">Port</span>
		    <input id="port" type="text" class="form-control" name="port">
		</div>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<span class="input-group-addon">₺ / $ Currency</span>
		    <input id="tl-dolar" type="text" class="form-control" name="tlDolar" value="<?php echo $dolar; ?>">
		</div>
		<div class="input-group">
			<span class="input-group-addon">€ / $ Currency</span>
			<input id="euro-dolar" type="text" class="form-control" name="euroDolar" value="<?php echo $euro; ?>">
		</div>
		<div class="input-group">
			<span class="input-group-addon">Duration</span>
		    <input id="duration" type="text" class="form-control" name="duration" value="4">
		</div>
		<div class="input-group">
			<span class="input-group-addon">Export / Import</span>
			<select class="form-control" id="expImp" name="expImp">
				<option>Export</option>
				<option>Import</option>
			</select>
		</div>
		<div class="input-group">
			<span class="input-group-addon">Passenger / Freight</span>
		    <select class="form-control" id="passFre" name="passFre">
				<option>Freight</option>
				<option>Passenger</option>
			</select>
		</div>
		<div class="input-group">
			<span class="input-group-addon">Bulk</span>
		    <input id="bulk" type="text" class="form-control" name="bulk">
		</div>
		<div class="input-group">
			<span class="input-group-addon">Cargo Type</span>
		    <input id="cargo-type-code" type="text" class="form-control" name="cargoTypeCode">
		</div>
	</div>
	<div class="col-md-12">
		  <div class="input-group">
		    <span class="input-group-addon">Pilotage</span>
		    <input id="pilotage" type="text" class="form-control" name="pilotage">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon">Tugboat 1/1 IN/OUT</span>
		    <input id="tugboat" type="text" class="form-control" name="tugboat">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon">Pilotage and Tug Overtime</span>
		    <input id="pilotage-tug-over" type="text" class="form-control" name="pilotageTugOver">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon">Garbage Removal for 1 CBM Compulsory</span>
		    <input id="garbage-removal" type="text" class="form-control" name="garbageRemoval">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon">Custom Overtime</span>
		    <input id="custom-owertime" type="text" class="form-control" name="customOwertime">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon">Chamber of Shipping Fees</span>
		    <input id="chamber-shipping" type="text" class="form-control" name="chamberShipping">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon">Petties</span>
		    <input id="petties" type="text" class="form-control" name="petties">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon">Phone and Fax</span>
		    <input id="phone-fax" type="text" class="form-control" name="phoneFax">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon">Fotocopies and Misc.</span>
		    <input id="fotocopies" type="text" class="form-control" name="fotocopies">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon">Taxi</span>
		    <input id="taxi" type="text" class="form-control" name="taxi">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon">Association Fees in Concern Freight</span>
		    <input id="association" type="text" class="form-control" name="association">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon">Supervising Fees as Per Tariff</span>
		    <input id="supervising" type="text" class="form-control" name="supervising">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon">Agency Fees as Per Tariff</span>
		    <input id="agency-per" type="text" class="form-control" name="agencyPer">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon">Agency Fees as Per Tariff Over 5 Days</span>
		    <input id="agency-per-five" type="text" class="form-control" name="agencyPerFive">
		  </div>
		  <div class="input-group center">
		  	<input type="submit" value="Hesapla" class="btn btn-default">
		  </div>
	</div>
	<?php echo form_close(); ?>
</div>
</body>
</html>