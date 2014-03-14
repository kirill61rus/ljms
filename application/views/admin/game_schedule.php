<?php $this->load->view('admin/include/header')?>
<?php $this->load->view('admin/include/admin_menu')?>
<div class="admin_menu_info">
	<h2>Game schedule</h2>
    <?php $this->flash->show(); ?>
</div>
	<?php 
		$attributes = array('id' => 'filter',  'method' => 'get');
		echo form_open_multipart('admin/game_schedule/', $attributes);
	?>
<div class="filter">
	<form>
		<b>Filter by:</b> Division:
		<?php
			$setting = 'class= "select_100px"';
			$options[''] =  'All';
			foreach($divisions as $item) :
			$options[$item['id']] =  htmlspecialchars($item['name']);
			endforeach;
		echo form_dropdown('division', $options, $filter['division'], $setting);
		?>
		Team:
		<?php
			$options_team[''] =  'All';
			foreach($teams as $item) :
			$options_team[$item['id']] =  htmlspecialchars($item['name']);
			endforeach;
		echo form_dropdown('team', $options_team, $filter['team'], $setting);
		?>
		League type:
		<?php $options_league = array(
			''  => 'Select',
			'1'    => 'LJMS Teams',
			'2' => 'Non conference Teams
			',
		);
		echo form_dropdown('league', $options_league, $filter['league'], $setting);
		?>
		Date:
		<?php $options_date = array(
			''  => 'All',
			'future'    => 'Future games',
			'prev' => 'Prev game',
		);
		echo form_dropdown('date', $options_date, $filter['date'], $setting);
		?>
		<input type="submit" class="button" value="Filter">
	</form>
</div>
<?php echo form_close()?>
<div class="right_button">
	<a class="button" href="<?=base_url('admin/game_schedule/add')?>">Add game</a>
</div>
<div class="right_button pagination total_rows">
	<a <?php if (!isset($_GET['limit']) || $_GET['limit'] == '10') {  echo 'class="active_limit"';} ?> href="<?=base_url('admin/game_schedule/?').$filter_data.'limit=10'?>">10</a>
	<a <?php if (isset($_GET['limit']) && $_GET['limit'] == '20') {  echo 'class="active_limit"';} ?> href="<?=base_url('admin/game_schedule/?').$filter_data.'limit=20'?>">20</a>
	<a <?php if (isset($_GET['limit']) && $_GET['limit'] == '30') {  echo 'class="active_limit"';} ?> href="<?=base_url('admin/game_schedule/?').$filter_data.'limit=30'?>">30</a>
	<a <?php if (isset($_GET['limit']) && $_GET['limit'] == 'all') { echo 'class="active_limit"';} ?> href="<?=base_url('admin/game_schedule/?').$filter_data.'limit=all'?>">All</a>
</div>
	<?php 
		$attributes = array('id' => 'action_select');
		echo form_open_multipart('admin/game_schedule/action', $attributes);
	?>
<div class="action_select">
	<?php $options = array(
		''  => 'Select',
		'delete'    => 'Delete',
		'active' => 'Active',
		'inactive' => 'Inactive',
		);
		$action_class = 'class="action_dropdown"';
	echo form_dropdown('action', $options, '', $action_class);
	?>
	<input type="submit" class="inactiv" id = 'mass_action_button'onclick="return confirm('Are you sure?')" value="Action" disabled>
</div>
<?php echo form_close()?>
<table class="full_width_table">
	<thead>
		<tr>
			<th class ="checkbox_col" ><input class="check_all" type="checkbox" name="#"></th>
			<th><p>DATE</p></th>
			<th><p>TIME</p></th>
			<th><p>DIVISION</p></th>
			<th><p>HOME</p></th>
			<th><p>VISITOR</p></th>
			<th><p>PRACTICE</p></th>
			<th><p>LOCATION</p></th>
			<th  class="action_col"><p>ACTION</p></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($schedule as $item) :?>
			<tr>
				<td class ="checkbox_col"><input data-item-id="<?php echo ($item['id']);?>" class="check_one" type="checkbox"></td>
				<td><p><?php echo date('l', strtotime($item['date'])).'</br>'.date('n/j/Y', strtotime($item['date']))?></p></td>
				<td><p><?php echo date('H:i', strtotime($item['time']));?></p></td>
				<td><p><?php echo htmlspecialchars($item['division_name'])?></p></td>
				<td><p><?php echo htmlspecialchars($item['home_team_name'])."</br>(".$item['home_team_result'].")"?></p></td>
				<td><p><?php echo htmlspecialchars($item['visitor_team_name'])."</br>(".$item['visitor_team_result'].")";?></p></td>
				<td><p><?php echo (($item['practice'])==1) ? 'YES': 'NO';?></p></td>
				<td><p><?php echo htmlspecialchars($item['location_name'])?></p></td>
				<td class="action_col">
					<a class="button" href="<?=base_url('admin/game_schedule/results').'?'.'id='.($item['id'])?>">Results</a>
					<a href="<?php echo base_url('admin/game_schedule/edit').'?'.'id='.($item['id'])?>" class="edit"><img src="<?=base_url('images/edit.png')?>"></a>
			</tr> 
		<?php endforeach;?>
	</tbody>
</table>
<div class="pagination">
<?php echo $this->pagination->create_links(); ?>
</div>

<?php $this->load->view('admin/include/footer')?>