<table class="table table-borderless table-data3">
	<tbody>
		<tr>
			<th>Source</th>
			<th>
			<?php 
				$TEMP = $this->setting_model->getChannel($FROW->channel_id);
				echo $TEMP->name;
			?>
			</th>
		</tr><tr>
			<th>Name</th>
			<th><?php echo $FROW->form_name;?></th>
		</tr><tr>
			<th>Phone</th>
			<th><?php echo '+'.$FROW->form_phone;?></th>
		</tr><tr>
			<th>Email</th>
			<th><a href="maiolto:<?php echo $FROW->form_email;?>"><?php echo $FROW->form_email;?></a></th>
		</tr><tr>
			<th>Designation/Job Role</th>
			<th><?php echo $FROW->form_desig;?></th>
		</tr><tr>
			<th>Submitted on:</th>
			<th><?php echo date("d-m-Y", strtotime($FROW->rdt));?></th>
		</tr>
	</tbody>
</table>