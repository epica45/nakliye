<!-- page content -->
<div class="right_col" role="main">

<div class="container">
	<?php /* <button class="btn btn-primary" id="toplu_fatura_sil">Toplu Proforma Sil</button> */ ?>
	<table class="fatura_list table table-hover">
		<tr>
			<td>#</td>
			<td>Tarih</td>
			<td>Gemi Adı</td>
			<td>Süre</td>
			<td>Bayrağı</td>
			<td>Net Ton</td>
			<td>Gross Ton</td>
			<td>Yük Tonu</td>
			<td>Ekleyen</td>
			<td>Güncelleyen</td>
			<td>Düzenle</td>
			<td>Sil</td>
		</tr>
		<?php
		foreach ($data as $result) {
				echo "
				<tr>
					<td><input type='checkbox' class='fatura_select' name='sil_check' value='".$result->id."' data-id='".$result->id."'></td>
					<td>".$result->tarih."</td>
					<td>".$result->vesselname."</td>
					<td>".$result->duration."</td>
					<td>".$result->flagname."</td>
					<td>".$result->nrt."</td>
					<td>".$result->grt."</td>
					<td>".$result->cargo."</td>
					<td>".$result->ekleyen."</td>
					<td>".$result->guncelleyen."</td>
					<td><a href='".site_url('Nakliye/view_fatura').'?id='.$result->id."'>Düzenle</a></td>
					<td><a href='#' data-id='".$result->id."' id='fatura_sil'>Sil</a></td>
				</tr>
				";
		}
		?>
	</table>
</div>

</div>
<!-- /page content -->