<?php $this->load->view('admin/include/header')?>
<?php $this->load->view('admin/include/admin_menu')?>
<h2 class="title_indent text_center">Game Results</h2>
	<?php 
		if (validation_errors()){ echo '<div class="alert-error">'.validation_errors().'</div>';}
		$attributes = array('id' => 'add_results');
		echo form_open_multipart('admin/game_schedule/results?id='.$this->input->get('id'), $attributes);
	?>
		<div class="result_form">
			<div class="text_center">
		
					<div class="leftinput"><label class="bold"><?php echo htmlspecialchars($game_data[0]['home_team_name'])?></label></div>
					<div class="rightinput"><label class="bold"><?php echo htmlspecialchars($game_data[0]['visitor_team_name'])?></label></div>

					<div class="leftinput"><?php $data = array('name' => 'home_team_result', 'value' => set_value('home_team_result')); echo form_input($data); ?></div>
					<div class="rightinput"><?php $data = array('name' => 'visitor_team_result', 'value' => set_value('visitor_team_result')); echo form_input($data); ?></div>
			
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
		<a class="button" href="<?=base_url('admin/game_schedule')?>">Back</a>
	</div>
<?php $this->load->view('admin/include/footer')?>