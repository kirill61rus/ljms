<?php $this->load->view('admin/include/header')?>
<?php $this->load->view('admin/include/admin_menu')?>
<div class="admin_menu_info">
	<h2>Divisions</h2>
	<?php $this->flash->show(); ?>
</div>
	<?php 
		$attributes = array('id' => 'filter',  'method' => 'get');
		echo form_open_multipart('admin/divisions/', $attributes);
	?>
<div class="filter">
	<form>
		<b>Filter by:</b> Division:
		<?php
			$class = 'class="select_wide"';
			$options[''] =  'All';
			foreach($list as $item) :
			$options[$item['id']] =  htmlspecialchars($item['name']);
			endforeach;
		echo form_dropdown('id', $options, $filter['id'], $class);
		?>
		Season:
		<?php $options = array(
			''  => 'All',
			'0'    => 'Standart',
			'1' => 'Fall Ball',
			);
		echo form_dropdown('season', $options, $filter['season']);
		?>
		Status:
		<?php $options = array(
			''  => 'All',
			'1'    => 'Active',
			'0' => 'Inactive',
			);
		echo form_dropdown('status', $options, $filter['status']);
		?>
		<input type="submit" class="button" value="Filter">
	</form>
</div>
<?php echo form_close()?>
<div class="right_button">
	<a class="button" href="<?=base_url('admin/divisions/add')?>">Add division</a>
</div>
<div class="right_button pagination total_rows">
	<a <?php if (!isset($_GET['limit']) || $_GET['limit'] == '10') {  echo 'class="active_limit"';} ?> href="<?=base_url('admin/divisions/?').$filter_data.'limit=10'?>">10</a>
	<a <?php if (isset($_GET['limit']) && $_GET['limit'] == '20') {  echo 'class="active_limit"';} ?> href="<?=base_url('admin/divisions/?').$filter_data.'limit=20'?>">20</a>
	<a <?php if (isset($_GET['limit']) && $_GET['limit'] == '30') {  echo 'class="active_limit"';} ?>  href="<?=base_url('admin/divisions/?').$filter_data.'limit=30'?>">30</a>
	<a <?php if (isset($_GET['limit']) && $_GET['limit'] == 'all') { echo 'class="active_limit"';} ?> href="<?=base_url('admin/divisions/?').$filter_data.'limit=all'?>">All</a>
</div>
	<?php 
		$attributes = array('id' => 'action_select');
		echo form_open_multipart('admin/divisions/action', $attributes);
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
			<th class="divis_col"><p>DIVISION</p></th>
			<th class="season_col"><p>SEASON</p></th>
			<th class="teams_col"><p>TEAM(S)</p></th>
			<th class="dir_col"><p>DIRECTOR</p></th>
			<th class="action_col"><p>ACTION</p></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($divisions as $item) :?>
			<tr>
				<td class ="checkbox_col"><input data-item-id="<?php echo ($item['id']);?>" class="check_one" type="checkbox"></td>
				<td class="divis_col"><p><?php echo htmlspecialchars($item['division_name']);?></p></td>
				<td class="season_col"><p><?php echo (($item['fall_ball'] == 0 ? "Spring/Summer" : "Fall Ball"))?></p></td>
				<td class="teams_col"><p><?php echo str_replace('|||', '</br>', htmlspecialchars($item['team_name']));?></p></td>
				<td class="dir_col"><p><?php echo ($item['user_name']);?></p></td>
				<td class="action_col">
				<a href="<?php echo base_url('admin/divisions/edit').'?'.'id='.($item['id'])?>" class="edit"><img src="<?=base_url('images/edit.png')?>"></a>
				<a href="#delete" data-item-id="<?php echo ($item['id']);?>" data-item-page="divisions" class="delete"><img src="<?=base_url('images/delete.png')?>"></a>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
<div class="pagination">
<?php echo $this->pagination->create_links(); ?>
</div>

<?php $this->load->view('admin/include/footer')?>