<table class="table table-borderless table-data3">
	<tbody>
		<tr>
			<th colspan="2">Number of companies nested as shareholder: <span class="red-text"><?php echo $CROW->noc;?></span></th>
		</tr>
	<?php 
		$i=1;foreach($URES as $UR){
			if(count($URES)>1){
	?>
		<tr>
			<th colspan="2">UBO - <?php echo $i;?></th>
		</tr>
	<?php }?>
		<tr>
			<th>SHARE</th>
			<th><input disabled="" type="text" class="form-control" name="co_website" value="<?php echo $UR['ubo_share'];?>" /></th>
		</tr>
		<tr>
			<th width="300">Name</th>
			<th><input disabled="" type="text" class="form-control" name="co_website" value="<?php echo $UR['ubo_name'];?>" /></th>
		</tr><tr>
			<th>Date of Birth</th>
			<th><input disabled="" type="text" class="form-control" name="co_website" value="<?php echo date("d-m-Y", strtotime($UR['ubo_dob']));?>" /></th>
		</tr><tr>
			<th>Primary Nationality</th>
			<th>
				<select class="custom-select form-control" disabled="">
					<option value disabled selected>Choose the country</option>
				<?php foreach ($CRES as $CR){ ?>
					<option value="<?php echo $CR['iso3'];?>" <?php if($UR['ubo_nationality1']==$CR['iso3']) echo 'selected="selected"'?>><?php echo ucwords(strtolower($CR['name']));?></option>
				<?php }?>
				</select>
			</th>
		</tr><tr>
			<th>Second Nationality</th>
			<th>
				<select class="custom-select form-control" disabled="">
					<option value disabled selected>Choose the country</option>
				<?php foreach ($CRES as $CR){ ?>
					<option value="<?php echo $CR['iso3'];?>" <?php if($UR['ubo_nationalaity2']==$CR['iso3']) echo 'selected="selected"'?>><?php echo ucwords(strtolower($CR['name']));?></option>
				<?php }?>
				</select>
			</th>
		</tr><tr>
			<th>ID Type</th>
			<th>
				<select class="custom-select form-control" disabled="">
					<option value="0" <?php if ($UR['id_type']==0) echo 'selected="selected"'?>>-- Please Select --</option>
					<option value="1" <?php if ($UR['id_type']==1) echo 'selected="selected"'?>>Passport</option>
					<option value="2" <?php if ($UR['id_type']==2) echo 'selected="selected"'?>>Govt ID</option>
					<option value="3" <?php if ($UR['id_type']==3) echo 'selected="selected"'?>>Driving Liscence</option>
				</select>
			</th>
		</tr><tr>
			<th>ID Number</th>
			<th><input disabled="" type="text" class="form-control" name="co_website" value="<?php echo $UR['id_number'];?>" /></th>
		</tr><tr>
			<th>Expiry</th>
			<th><input disabled="" type="text" class="form-control" name="co_website" value="<?php echo date("d-m-Y", strtotime($UR['id_expiry']));?>" /></th>
		</tr><tr>
			<th>Issued Country</th>
			<th>
				<select disabled="" class="custom-select form-control">
					<option value disabled selected>Choose the country</option>
				<?php foreach ($CRES as $CR){ ?>
					<option value="<?php echo $CR['iso3'];?>" <?php if($UR['id_country']==$CR['iso3']) echo 'selected="selected"'?>><?php echo ucwords(strtolower($CR['name']));?></option>
				<?php }?>
				</select>
			</th>
		</tr><tr>
			<th>Residence Address</th>
			<th><textarea disabled="" class="form-control"><?php echo $UR['addr'];?></textarea></th>
		</tr><tr>
			<th>Residence Country</th>
			<th>
				<select disabled="" class="custom-select form-control">
					<option value disabled selected>Choose the country</option>
				<?php foreach ($CRES as $CR){ ?>
					<option value="<?php echo $CR['iso3'];?>" <?php if($UR['addr_country']==$CR['iso3']) echo 'selected="selected"'?>><?php echo ucwords(strtolower($CR['name']));?></option>
				<?php }?>
				</select>
			</th>
		</tr><tr>
			<th>Tax Number</th>
			<th><input disabled="" type="text" class="form-control" name="co_website" value="<?php echo $UR['tax_number'];?>" /></th>
		</tr><tr>
			<th>Tax Residence</th>
			<th>
				<select disabled="" class="custom-select form-control">
					<option value disabled selected>Choose the country</option>
				<?php foreach ($CRES as $CR){ ?>
					<option value="<?php echo $CR['iso3'];?>" <?php if($UR['tax_country']==$CR['iso3']) echo 'selected="selected"'?>><?php echo ucwords(strtolower($CR['name']));?></option>
				<?php }?>
				</select>
			</th>
		</tr>
	<?php 
		$i++;}
	?>
	</tbody>
</table>