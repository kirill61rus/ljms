<?php $this->load->view('admin/include/header')?>
<?php $this->load->view('admin/include/admin_menu')?>
<h2 class="title_admin">Add Team</h2>
	<?php 
		$attributes = array('id' => 'add_team');
		echo form_open_multipart('admin/teams/add', $attributes);
	?>
		<div class="add_form">
			<div class="form-group">
				<div class="leftpart"><label>Team Name *</label></div>
				<div class="rightpart"><?php echo form_input('name'); ?></div>
			</div>
			<div class="form-group">
				<div class="leftpart"><label>Division *</label></div>
				<div class="rightpart">
					<?php
						$setting = 'class= "select_wide"';
						$options[''] =  'Select';
						foreach($list as $item) :
						$options[$item['id']] =  $item['name'];
						endforeach;
						echo form_dropdown('division_id', $options, '',$setting);
					?>
				</div>
			</div>
			<div class="form-group">
				<div class="leftpart"><label>League Type</label></div>
				<div class="rightpart">
					<?php $options = array(
							''  => 'Select',
							'1'    => 'LJMS Teams',
							'2' => 'Non conference Teams
							',
						);
						echo form_dropdown('league_type_id', $options, '',$setting);
					?>

				</div>
			</div>
			<div class="form-group">
				<div class="leftpart"><label>Status *</label></div>
				<div class="rightpart">
					<?php $options = array(
							''  => 'Select one',
							'1'    => 'Active',
							'0' => 'Inactive',
						);
						echo form_dropdown('status', $options, '',$setting);
					?>
				</div>
			</div>
			<div class="form-group">
				<div class="leftpart"><label>Is visitor</label></div>
				<div class="rightpart">
					<?php $options = array(
							'0'    	=> 'No',
							'1' 	=> 'Yes',
						);
						echo form_dropdown('is_visitor', $options, '',$setting);
					?>
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
		<a class="button" href="<?=base_url('admin/teams')?>">Back</a>
	</div>
<?php $this->load->view('admin/include/footer')?>