<?php $this->load->view('admin/include/header')?>
<?php $this->load->view('admin/include/admin_menu')?>
<h2 class="title_admin">Add Division</h2>
	<?php 
		if (validation_errors()){ echo '<div class="alert-error">'.validation_errors().'</div>';}
		$attributes = array('id' => 'add_division');
		echo form_open_multipart('admin/divisions/add', $attributes);
	?>

		<div class="add_form">
			<div class="form-group">
				<div class="leftpart"><label>Status *</label></div>
				<div class="rightpart"><?php $options = array(
						''  => 'Select one',
						'1'    => 'Active',
						'0' => 'Inactive',
						);
					$class = 'class="select_wide"';
					echo form_dropdown('status', $options, set_value('status'), $class);
					?>
						<input type="checkbox" value="1" name="fall_ball">Fall Ball
				</div>
			</div>

			<div class="form-group">
				<div class="leftpart"><label>Division Name *</label></div>
				<div class="rightpart"><?php $data = array('name' => 'name', 'value' => set_value('name')); echo form_input($data); ?></div>
			</div>

			<div class="form-group">
				<div class="leftpart"><label>Ages From *</label></div>
				<div class="rightpart"><?php $options = array(
						'5'  => '5',
						'6'  => '6',
						'7'  => '7',
						'8'  => '8',
						'9'  => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						);
					$age_from_id = 'id="age_from"';
					echo form_dropdown('age_from', $options, set_value('age_from'), $age_from_id);
					?> years  To *
					<?php 
					$age_to_id = 'id="age_to"';
					echo form_dropdown('age_to', $options, set_value('age_to'), $age_to_id);
					?>
				</div>
			</div>

			<div class="form-group">
				<div class="leftpart"><label>Description</label></div>
				<div class="rightpart"><?php $data = array('name' => 'description', 'value' => set_value('description')); echo form_textarea($data); ?></div>
			</div>

			<div class="form-group"> 
				<div class="leftpart"><label>Rules</label></div>
				<div class="rightpart"><?php $data = array('name' => 'rules', 'value' => set_value('rules')); echo form_textarea($data); ?></div>
			</div>

			<div class="form-group">
				<div class="leftpart"><label>Base Fee</label></div>
				<div class="rightpart"><?php $data = array('name' => 'base_fee', 'value' => set_value('base_fee')); echo '$'.form_input($data); ?></div>
			</div>

			<div class="form-group">
				<div class="leftpart"><label>Addon Fee</label></div>
				<div class="rightpart"><?php $data = array('name' => 'addon_fee', 'value' => set_value('addon_fee')); echo '$'.form_input($data); ?></div>
			</div>

			<div class="form-group">
				<div class="leftpart"><label>Logo</label></div>
				<div class="rightpart"><?php echo form_upload('userfile'); ?></div>
			</div>
		</div>
		<div class="text_center">
			<?php
				$data = array('value' => 'Save', 'class'=> 'button');
				echo form_submit($data);
			?>
		</div>
	<?php echo form_close()?>
	<div class="right_button">
		<a class="button" href="<?=base_url('admin/divisions')?>">Back</a>
	</div>
<?php $this->load->view('admin/include/footer')?>