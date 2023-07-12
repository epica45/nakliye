<!-- page content -->
<div class="right_col" role="main">

<div class="container">
	<style type="text/css">
		.sabit-addon{width: 160px;}
		input[type=text], select, textarea{width: 300px!important;}
		@media screen and (max-width: 500px){input[type=text], select, textarea{width: 100%!important;}}
	</style>
	<div class="col-md-4">
	<?php
		$attributes = array('method'=>'post','name'=>'hesapla_form');
    	echo form_open('Nakliye/hesapla', $attributes);
	?>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">Vessel Name</span>
		    <input id="vessel-name" type="text" required class="form-control" name="vesselname">
		</div>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">Flag Type</span>
			<select class="form-control" id="flagtype" name="flagtype">
				<option>Not Turkish</option>
				<option>Turkish</option>
			</select>
		</div>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">Flag Name</span>
			<input id="flagname" type="text" required class="form-control uzat" name="flagname">
		</div>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">NRT</span>
		    <input id="nrt" type="text" required class="form-control" name="nrt">
		</div>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">GRT</span>
			<input id="grt" type="text" required class="form-control" name="grt">
		</div>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">Cargo</span>
		    <input id="cargo" type="text" required class="form-control" name="cargo">
		</div>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">Cargo Type</span>
			<input id="cargotype" type="text" required class="form-control" name="cargotype">
		</div>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">Port</span>
			<select class="form-control" id="port" name="port">
				<option>IZMIR</option>
				<option>ALIAGA</option>
			</select>
		</div>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">₺ / $ Currency</span>
		    <input id="tl-dolar" type="text" required class="form-control" name="tlDolar" value="<?php echo $dolar; ?>">
		</div>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">€ / $ Currency</span>
			<input id="euro-dolar" type="text" required class="form-control" name="euroDolar" value="<?php echo $euro; ?>">
		</div>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">Duration</span>
		    <input id="duration" type="text" required class="form-control" name="duration">
		</div>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">Export / Import</span>
			<select class="form-control" id="expImp" name="expImp">
				<option>Export</option>
				<option>Import</option>
			</select>
		</div>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">Passenger / Freight</span>
		    <select class="form-control" id="passFre" name="passFre">
				<option>Freight</option>
				<option>Passenger</option>
			</select>
		</div>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">Bulk</span>
		    <input id="bulk" type="text" required class="form-control" name="bulk" value="a">
		</div>
		<div class="input-group">
			<span class="input-group-addon sabit-addon">Cargo Type</span>
		    <input id="cargo-type-code" type="text" required class="form-control" name="cargotypecode" value="a">
		</div>
		<div class="input-group center">
			<input type="submit" value="Hesapla" class="btn btn-default">
		</div>
	<?php echo form_close(); ?>
	</div>
	<div class="col-md-8">
		<b>SUPERVISION SERVICES</b><br>			
		<b>A) CARGO IN BULK:</b><br>
		a) Dry Cargo: (Ores, minerals, scraps, pig iron, coal, carob, animal feeds, oil cakes, cement, clinger, pumice stones, artificial fertilizers, slag.)<br>
		b) Grains and Seeds: Wheat, barley, oats, rye, rice, corn, sunflower, soya beans, vetches.<br>
		c) Pulses: Broad beans, black eyed beans, beans, lentils, chickpeas<br>
		d) Crude oil and petroleum products<br>
		e) LPG and LNG gasses<br>
		f) Chemical products (including petroleum derivates) Wine, olive oil, molasses, edible liquid oils, mineral oil, tallow<br>
		<b>B) CARGO NOT IN BULK</b><br>
		a) Grains and flour, artificial fertilizers, sugar, cement,rice, semolina, carob, minerals, marvel blocks.<br>				
		b) Fresh fruits and vegetables, citrus, frozen food<br>
		c) Pulses and Seeds<br>
		d) Paper, iron and steel products and semi-finished products:Steel plates, iron coil, profiles, iron billets, iron bars,Round bars, wire rods in coils, all kinds of pipes, rolled sheets,newsprint paper, kraft paper in rolls, wood pulp<br>
		e) Wood logs and heavy logs<br>
		<b>C) EMPTY CONTAINERS AND EMPTY TRAILERS</b><br>
		<b>D) LIVESTOCK ( Euro per unit )</b><br>
		a) Small heads<br>
		b) Large heads<br>
		<b>E) OTHER CARGO, VARIOUS CARGO CARRIED IN THE SAME VESSEL</b><br>
		<b>F) ALL KIND OF CARGO CARRIED IN CONTAINERS</b><br>
		<b>G) MOTOR CARS, JEEP, PICK UP, PANELVAN,MINIBUS, MIDIBUS</b><br>
		<b>H) MOBILE VEHICLES AND CONSTRUCTION MACHINERY CARRIED BY RO – RO VESSELS</b><br>
	</div>
</div>

</div>
<!-- /page content -->