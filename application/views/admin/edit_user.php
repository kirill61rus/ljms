<?php $this->load->view('admin/include/header')?>
<?php $this->load->view('admin/include/admin_menu')?>
		<script type="text/javascript">
       		var user_id = '<?php echo $this->input->get("id");  ?>';
    	</script>
<h2 class="title_admin">Edit System User</h2>
    <?php $this->flash->show(); 
		if (validation_errors()){ echo '<div class="alert-error">'.validation_errors().'</div>';}
		$attributes = array('id' => 'add_user', 'autocomplete' => "off");
		echo form_open_multipart('admin/system_users/edit?id='.$this->input->get('id'), $attributes);
	?>
		<div class="add_form">
		<h3 class="title_form">User information</h3>
			<div class="form-group">
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>First Name *</label>
					</div>
					<div class="hilf_width_col">
						<?php echo form_input('first_name', set_value('first_name', $user_data[0]['first_name'])); ?>
					</div>
				</div>
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Last Name *</label>
					</div>
					<div class="hilf_width_col">
						<?php echo form_input('last_name', set_value('last_name', $user_data[0]['last_name'])); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Address *</label>
					</div>
					<div class="hilf_width_col">
						<?php echo form_input('address', set_value('address', $user_data[0]['address'])); ?>
					</div>
				</div>
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>City *</label>
					</div>
					<div class="hilf_width_col">
						<?php echo form_input('city', set_value('city', $user_data[0]['city'])); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>State *</label>
					</div>
					<div class="hilf_width_col">
						<?php
							$setting = 'class= "select_wide"';
							$options[''] =  'Select one';
							foreach($states as $item) :
								$options[$item['id']] =  $item['name'];
							endforeach;
							echo form_dropdown('state_id', $options, set_value('state_id', $user_data[0]['state_id']), $setting);
						?>
					</div>
				</div>
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Zipcode *</label>
					</div>
					<div class="hilf_width_col">
						<?php echo form_input('zipcode', set_value('zipcode', $user_data[0]['zipcode'])); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Email *</label>
					</div>
					<div class="hilf_width_col">
						<?php $id_email = 'id = "email"'; echo form_input('email', set_value('email', $user_data[0]['email']), $id_email); ?>
					</div>
				</div>
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Home Phone *</label>
					</div>
					<div class="hilf_width_col">
						<?php echo form_input('home_phone', set_value('home_phone', $user_data[0]['home_phone'])); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Email Confirm *</label>
					</div>
					<div class="hilf_width_col">
						<?php echo form_input('repeat_email', set_value('email', $user_data[0]['email'])); ?>
					</div>
				</div>
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Cell Phone </label>
					</div>
					<div class="hilf_width_col">
						<?php echo form_input('cell_phone', set_value('cell_phone', $user_data[0]['cell_phone'])); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Password *</label>
					</div>
					<div class="hilf_width_col">
						<?php  $id_password = 'id = "password"'; echo form_password('password', '', $id_password); ?>
					</div>
				</div>
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Alternitive Phone </label>
					</div>
					<div class="hilf_width_col">
						<?php echo form_input('alt_phone', set_value('alt_phone', $user_data[0]['alt_phone'])); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Password Confirm*</label>
					</div>
					<div class="hilf_width_col">
						<?php  echo form_password('repassword'); ?>
					</div>
				</div>				
			</div>			
		</div>
		<div class="add_form">
		<h3 class="title_form">Alt Contact</h3>
			<div class="form-group">
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>First Name</label>
					</div>
					<div class="hilf_width_col">
						<?php echo form_input('alt_first_name', set_value('alt_first_name', $user_data[0]['alt_first_name'])); ?>
					</div>
				</div>
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Last Name</label>
					</div>
					<div class="hilf_width_col">
						<?php echo form_input('alt_last_name', set_value('alt_last_name', $user_data[0]['alt_last_name'])); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Alt Email</label>
					</div>
					<div class="hilf_width_col">
						<?php echo form_input('alt_email', set_value('alt_email', $user_data[0]['alt_email'])); ?>
					</div>
				</div>
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Alt Phone</label>
					</div>
					<div class="hilf_width_col">
						<?php echo form_input('alt_phone_2', set_value('alt_phone_2', $user_data[0]['alt_phone_2'])); ?>
					</div>
				</div>
			</div>
		</div>
<div class="add_form">
		<h3 class="title_form">User Roles</h3>
			<div class="form-group">
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Assign Roles</label>
					</div>
					<div class="hilf_width_col">
						<?php
							$setting_rol = 'class= "select_wide roles_dd"';
							$options_roles[''] =  'Select';
							foreach($roles as $item) :
								$options_roles[$item['id']] =  $item['name'];
							endforeach;
							echo form_dropdown('roles', $options_roles, '',$setting_rol);
						?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Assign Divisions</label>
					</div>
					<div class="hilf_width_col">
						<?php
							$setting_div = 'class="select_wide divisions_dd" disabled="disabled"';
							$options_div[''] =  'Select';
							foreach($divisions as $item) :
							$options_div[$item['id']] =  htmlspecialchars($item['name']);
							endforeach;
						echo form_dropdown('division', $options_div, '',$setting_div);
						?>
					</div>
				</div>
				<div class="hilf_width_col">
					<div class="hilf_width_col">
						<label>Assign Teams</label>
					</div>
					<div class="hilf_width_col">
						<?php
							$setting_team = 'class="select_wide teams_dd" disabled="disabled"';
							$options_team[''] =  'Select';
						echo form_dropdown('team', $options_team, '',$setting_team);
						?>
					</div>
				</div>
			</div>
				<table style="display: none">
					<?php $this->load->view('admin/templates/role_block') ?>
				</table>
				<table class="user_roles">
					<thead>
						<tr>
							<th class="quarter"><p>Current Roles</p></th>
							<th class="quarter"><p>Division</p></th>
							<th class="quarter"><p>Team</p></th>
							<th class="quarter"></th>
						</tr>
					</thead>
					<tbody>
							<?php 
							foreach($roles_by_user_id as $key => $value){
								echo $this->parser->parse('admin/templates/role_block', [
									'role_name' => $roles_by_user_id[$key]['role_name'],
									'division_name' =>  htmlspecialchars($roles_by_user_id[$key]['division_name']),
									'team_name' => htmlspecialchars($roles_by_user_id[$key]['team_name']),
									'role_input' => '',
									'div_input' => '',
									'team_input' => '',	
									'role_to_user_id' => $roles_by_user_id[$key]['id'],								
								], TRUE);
							}
							?>
							<table style="display: none">
								<?php $this->load->view('admin/templates/role_block') ?>
							</table>
					</tbody>
				</table>
				<a class="add_role_btn">Add Role</a>
			</div>
		<div class="text_center">
			<?php
				$data = array('value' => 'Save', 'class'=> 'button');
				echo form_submit($data);
			?>
		</div>
	<?php echo form_close()?>
	<div class="right_button">
		<a class="button" href="<?=base_url('admin/system_users')?>">Back</a>
	</div>
<?php $this->load->view('admin/include/footer')?>