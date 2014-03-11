<?php $this->load->view('admin/include/header')?>
<?php $this->load->view('admin/include/admin_menu')?>

<!--for time form -->
<link rel="stylesheet" href="<?=base_url('style/jquery.timeentry.css')?>">
<script type="text/javascript" src="<?=base_url();?>js/libraries/jquery.plugin.js"></script> 
<script type="text/javascript" src="<?=base_url();?>js/libraries/jquery.timeentry.js"></script>


<script>
	$(function() {
		//$('#date').datepicker({rangeSelect: true,  minDate: 0});

		$('#date').datepick({ minDate: 0 });

		$('#date').mask('99/99/9999');
	});
	$(function () { 
		$('#time').timeEntry({show24Hours: true});
	});

</script>

<h2 class="title_admin">Add Game</h2>
	<?php 
		$this->flash->show(); 
		if (validation_errors()){ echo '<div class="alert-error">'.validation_errors().'</div>';}
		$attributes = array('id' => 'add_game');
		echo form_open_multipart('admin/game_schedule/add', $attributes);
	?>
		<div class="add_form">
			<div class="form-group">
				<div class="leftpart"><label>Practice Game</label></div>
				<input type="checkbox" value="1" name="practice">
			</div>
			<div class="form-group">
				<div class="leftpart"><label>Date (mm/dd/yyyy) *</label></div>
				<div class="rightpart"><?php $data = array('name' => 'date', 'id' => 'date', 'onchange' => 'onchangeTest()', 'value' => set_value('date')); echo form_input($data); ?></div>

			</div>
			<div class="form-group">
				<div class="leftpart"><label>Time (hh:mm) *</label></div>
				<div class="rightpart"><?php $data = array('name' => 'time', 'id' => 'time', 'value' => set_value('time')); echo form_input($data); ?>24 hour time</div>
			</div>
			<div class="form-group">
				<div class="leftpart"><label>Division *</label></div>
				<div class="rightpart">
					<?php
						$class = 'class= "select_wide divisions_dd"';
						$options[''] =  'Select';
						foreach($divisions as $item) :
						$options[$item['id']] =  htmlspecialchars($item['name']);
						endforeach;
						echo form_dropdown('division_id', $options, set_value('division_id'), $class);
					?>
				</div>
			</div>
			<div class="form-group">
				<div class="leftpart"><label>Home Team</label></div>
				<div class="rightpart">
					<?php
						$setting_team = 'class="select_wide home_teams_dd" id="home_team" disabled="disabled"';
						$options_team[''] =  'Select';
					echo form_dropdown('home_team_id', $options_team, set_value('home_team_id'),$setting_team);
					?>
				</div>
			</div>
			<div class="form-group">
				<div class="leftpart"><label>Visitor Team</label></div>
				<div class="rightpart">
					<?php
						$setting_team = 'class="select_wide visitor_teams_dd" id="visitor_team" disabled="disabled"';
						$options_team[''] =  'Select';
					echo form_dropdown('visitor_team_id', $options_team, set_value('visitor_team_id'),$setting_team);
					?>
				</div>
			</div>
			<div class="form-group">
				<div class="leftpart"><label>Location *</label></div>
				<div class="rightpart">
					<?php
						$class = 'class= "select_wide"';
						$options[''] =  'Select';
						foreach($location as $item) :
						$options[$item['id']] =  htmlspecialchars($item['name']);
						endforeach;
						echo form_dropdown('location_id', $options, set_value('location_id'), $class);
					?>
				</div>
			</div>
			<div class="form-group">
				<div class="leftpart"><label>Presiding Official</label></div>
				<div class="rightpart">
					<?php 
						$setting = 'class="select_wide" disabled="disabled"';
				    	$options = array(
							''  => 'Select',
						);
						echo form_dropdown('presiding_official', $options, set_value('presiding_official'),$setting);
					?>

				</div>
			</div>
			<div class="form-group">
				<div class="leftpart"><label>Second Presiding Official</label></div>
				<div class="rightpart">
					<?php
						$options = array(
							''  => 'Select',
						);
						echo form_dropdown('second_presiding_official', $options, set_value('second_presiding_official'),$setting);
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
		<a class="button" href="<?=base_url('admin/game_schedule')?>">Back</a>
	</div>
<?php $this->load->view('admin/include/footer')?>