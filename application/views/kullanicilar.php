<!-- page content -->
<div class="right_col" role="main">

<div class="container">
	<?php
		$attributes = array('method'=>'post','name'=>'create_users','id'=>'create_usersForm');
    	echo form_open('Nakliye/create_users', $attributes);
	?>
	<div class="col-md-12">
		<h3 style="text-align: center;">Kullanıcı Oluştur</h3>
		<input type="hidden" name="id" id="user_id">	
		<div class="input-group">
			<span class="input-group-addon">Adı Soyadı</span>
		    <input type="text" id="user_name" class="form-control" name="name" required="required">
		</div>
		<div class="input-group">
			<span class="input-group-addon">E-posta Adresi</span>
		    <input type="email" id="user_email" class="form-control" name="email" required="required">
		</div>
		<div class="input-group">
			<span class="input-group-addon">Parolası</span>
		    <input type="password" id="user_pw1" class="form-control" name="password">
		</div>
		<div class="input-group">
			<span class="input-group-addon">Tekrar Parola</span>
		    <input type="password" id="user_pw2" class="form-control">
		</div>
		<div class="input-group">
			<span class="input-group-addon">Kullanıcı Rolü</span>
			<select name="role" id="user_role" class="form-control" required="required">
				<option value="">Rolü Seçin</option>
				<option value="1">Admin</option>
				<option value="2">Kullanıcı</option>
			</select>
		</div>
		<div style="text-align: center;">
			<input type="submit" value="Kullanıcı Oluştur" id="kullaniciOlusturBtn" class="btn btn-primary">
			<input type="submit" value="Kullanıcı Güncelle" id="kullaniciGuncelleBtn" class="btn btn-primary">
		</div>
		<?php echo form_close(); ?>
	</div>
	<div class="col-md-12">
		<h3 style="text-align: center;">Kullanıcılar</h3>
		<table class="table">
			<thead>
				<th>Adı Soyadı</th>
				<th>E-posta</th>
				<th>Rolü</th>
				<th>Düzenle</th>
				<th>Sil</th>
			</thead>
			<tbody>
				<?php 
				foreach ($get_users as $key => $value) {
				?>
				<tr>
					<td><?php echo $value->name; ?></td>
					<td><?php echo $value->email; ?></td>
					<td><?php echo (($value->role == 2) ? "Kullanıcı" : 'Admin')?></td>
					<td><a href="#" id="kullanici_duzenle" data-id="<?php echo $value->id; ?>"><i class="fa fa-edit"></i> Düzenle</a></td>
					<td><a href="#" id="kullanici_sil" data-id="<?php echo $value->id; ?>"><i class="fa fa-times"></i> Sil</a></td>
				</tr>
				<?php
				}
				?>				
			</tbody>
			
		</table>
	</div>
</div>

</div>
<!-- /page content -->