<?php $this->load->view('admin/include/header')?>
<?php $this->load->view('admin/include/admin_menu')?>
<h2 class="title_admin">Edit Team</h2>
	<?php 
		$attributes = array('id' => 'add_team');
		echo form_open_multipart('admin/teams/edit?id='.$this->input->get('id'), $attributes);
	?>
		<div class="add_form">
			<div class="form-group">
				<div class="leftpart"><label>Team Name *</label></div>
				<div class="rightpart"><?php $value = $data['team_data'][0]['name']; echo form_input('name', $value); ?></div>
			</div>
			<div class="form-group">
				<div class="leftpart"><label>Division *</label></div>
				<div class="rightpart">
					<?php
						$options[''] =  'Select';
						foreach($data['division_list'] as $item) :
						$options[$item['id']] =  htmlspecialchars($item['name']);
						endforeach;
						$setting = 'class= "select_wide"';
						echo form_dropdown('division_id', $options,  $data['team_data'][0]['division_id'], $setting);
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
						echo form_dropdown('league_type_id', $options, $data['team_data'][0]['league_type_id'], $setting);
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
						echo form_dropdown('status', $options, $data['team_data'][0]['status'], $setting);
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
						echo form_dropdown('is_visitor', $options, $data['team_data'][0]['is_visitor'], $setting);
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