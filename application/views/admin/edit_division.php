<?php $this->load->view('admin/include/header')?>
<?php $this->load->view('admin/include/admin_menu')?>
<h2 class="title_admin">Edit Division</h2>
<?php $this->flash->show(); 
if (validation_errors()){ echo '<div class="alert-error">'.validation_errors().'</div>';}?>
	<?php 
		$attributes = array('id' => 'add_division');
		echo form_open_multipart('admin/divisions/edit?id='.$this->input->get('id'), $attributes);
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
					echo form_dropdown('status', $options, $division_data[0]['status'], $class);
					?>
				</div>
			</div>

			<div class="form-group">
				<div class="leftpart"><label>Division Name *</label></div>
				<div class="rightpart"><?php echo form_input('name', set_value('name',$division_data[0]['name'])); ?></div>
			</div>

			<div class="form-group">
				<div class="leftpart"><label>Ages From *</label></div>
				<div class="rightpart"><?php $options = array(
						5  => 5,
						6  => 6,
						7  => 7,
						8  => 8,
						9  => 9,
						10 => 10,
						11 => 11,
						12 => 12,
						13 => 13,
						14 => 14,
						15 => 15,
						16 => 16,
						17 => 17,
						18 => 18,
						);
					$age_from_id = 'id="age_from"';
					echo form_dropdown('age_from', $options, $division_data[0]['age_from'], $age_from_id);
					?> years  To *
					<?php 
					$age_to_id = 'id="age_to"';
					echo form_dropdown('age_to', $options, $division_data[0]['age_to'], $age_to_id);
					?>
				</div>
			</div>

			<div class="form-group">
				<div class="leftpart"><label>Description</label></div>
				<div class="rightpart"><?php echo form_textarea('description', set_value('description',$division_data[0]['description'])); ?></div>
			</div>

			<div class="form-group"> 
				<div class="leftpart"><label>Rules</label></div>
				<div class="rightpart"><?php echo form_textarea('rules', set_value('rules',$division_data[0]['rules'])); ?></div>
			</div>

			<div class="form-group">
				<div class="leftpart"><label>Base Fee</label></div>
				<div class="rightpart"><?php echo form_input('base_fee', set_value('base_fee',$division_data[0]['base_fee'])); ?></div>
			</div>

			<div class="form-group">
				<div class="leftpart"><label>Addon Fee</label></div>
				<div class="rightpart"><?php echo form_input('addon_fee', set_value('addon_fee',$division_data[0]['addon_fee'])); ?></div>
			</div>

			<div class="form-group">
				<div class="leftpart"><label>Logo</label></div>
				<div class="rightpart"><?php echo form_upload('userfile'); ?>
			<?php if ($division_data[0]['logo']):
			?>
			<a href="#delete_logo" data-item-id=<?php echo $this->input->get('id')?> class="button logo">Delete current image</a>
				</div>
			</div>
				<div class="form-group logo">
					<div class="leftpart"><label>Prewiev</label></div>
					<div class="rightpart">
						<img src=<?php echo (base_url().'upload/logo/'.$division_data[0]['logo']);?>>				
			<?php endif; ?>
					</div>
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