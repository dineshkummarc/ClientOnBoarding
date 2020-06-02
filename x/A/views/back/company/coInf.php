<table class="table table-borderless table-data3">
	<tbody>
		<tr>
			<th>Type</th>
			<th>
				<select class="custom-select form-control" disabled="">
					<option value="0" <?php if ($CROW->company_type==0) echo 'selected="selected"'?>>-- Please Select --</option>
					<option value="1" <?php if ($CROW->company_type==1) echo 'selected="selected"'?>>Private Ltd. Liability</option>
					<option value="2" <?php if ($CROW->company_type==2) echo 'selected="selected"'?>>Public Ltd. Liability</option>
					<option value="3" <?php if ($CROW->company_type==3) echo 'selected="selected"'?>>Limited Liability Company</option>
					<option value="3" <?php if ($CROW->company_type==4) echo 'selected="selected"'?>>Other</option>
				</select>
			</th>
		</tr><tr>
			<th>Website</th>
			<th><input type="text" class="form-control" value="<?php echo $CROW->company_www;?>" disabled="" /></th>
		</tr><tr>
			<th>Currency</th>
			<th>
				<select class="custom-select form-control" disabled="">
					<option value="1" <?php if ($CROW->company_curr==1) echo 'selected="selected"'?>>EURO</option>
					<option value="2" <?php if ($CROW->company_curr==2) echo 'selected="selected"'?>>USD</option>
					<option value="3" <?php if ($CROW->company_curr==3) echo 'selected="selected"'?>>GBP</option>
					<option value="3" <?php if ($CROW->company_curr==4) echo 'selected="selected"'?>>Other</option>
				</select>
			</th>
		</tr><tr>
			<th>Registration Number</th>
			<th><input type="text" class="form-control" name="co_website" value="<?php echo $CROW->reg_number;?>" disabled="" /></th>
		</tr><tr>
			<th>Date of Registration</th>
			<th><input type="text" class="form-control" name="co_website" value="<?php echo date("d-m-Y", strtotime($CROW->reg_dt));?>" disabled="" /></th>
		</tr><tr>
			<th>Registered Address</th>
			<th><textarea class="form-control" disabled=""><?php echo $CROW->reg_addr;?></textarea></th>
		</tr><tr>
			<th>Registered Country</th>
			<th>
				<select class="custom-select form-control" disabled="">
					<option value disabled selected>Choose the country</option>
				<?php foreach ($CRES as $CR){ ?>
					<option value="<?php echo $CR['iso3'];?>" <?php if($CROW->reg_country==$CR['iso3']) echo 'selected="selected"'?>><?php echo ucwords(strtolower($CR['name']));?></option>
				<?php }?>
				</select>
			</th>
		</tr><tr>
			<th>Operation Address</th>
			<th><textarea class="form-control" disabled=""><?php echo $CROW->oper_addr;?></textarea></th>
		</tr><tr>
			<th>Operation Country</th>
			<th>
				<select class="custom-select form-control" disabled="">
					<option value disabled selected>Choose the country</option>
				<?php foreach ($CRES as $CR){ ?>
					<option value="<?php echo $CR['iso3'];?>" <?php if($CROW->oper_country==$CR['iso3']) echo 'selected="selected"'?>><?php echo ucwords(strtolower($CR['name']));?></option>
				<?php }?>
				</select>
			</th>
		</tr><tr>
			<th>Operation Region</th>
			<th>
				<select class="custom-select form-control" disabled="">
					<option value disabled selected>Choose the country</option>
				<?php foreach ($RRES as $RR){ ?>
					<option value="<?php echo $RR['region_id'];?>" <?php if($CROW->oper_region==$RR['region_id']) echo 'selected="selected"'?>><?php echo ucwords(strtolower($RR['region_name']));?></option>
				<?php }?>
				</select>
			</th>
		</tr><tr>
			<th>Tax Number</th>
			<th><input type="text" class="form-control" name="co_website" value="<?php echo $CROW->tax_number;?>" disabled="" /></th>
		</tr><tr>
			<th>Tax Country</th>
			<th>
				<select class="custom-select form-control" disabled="">
					<option value disabled selected>Choose the country</option>
				<?php foreach ($CRES as $CR){ ?>
					<option value="<?php echo $CR['iso3'];?>" <?php if($CROW->tax_country==$CR['iso3']) echo 'selected="selected"'?>><?php echo ucwords(strtolower($CR['name']));?></option>
				<?php }?>
				</select>
			</th>
		</tr>
	</tbody>
</table>