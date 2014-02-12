<?php $this->load->view('admin/include/header')?>
<?php $this->load->view('admin/include/admin_menu')?>
<div class="admin_menu_info">
	<h2>System users</h2>
    <?php $this->flash->show(); ?>
</div>
	<?php 
		$attributes = array('id' => 'filter',  'method' => 'get');
		echo form_open_multipart('admin/system_users/', $attributes);
	?>
<div class="filter">
	<form>
		<b>Filter by:</b> Division:
		<?php
			$setting = 'class= "select_wide"';
			$options[''] =  'All';
			foreach($divisions as $item) :
			$options[$item['id']] =  htmlspecialchars($item['name']);
			endforeach;
		echo form_dropdown('division', $options, $filter['division'], $setting);
		?>
		Role:
		<?php
			$options_roles[''] =  'All';
			foreach($roles as $item) :
			$options_roles[$item['id']] =  $item['name'];
			endforeach;
		echo form_dropdown('role', $options_roles, $filter['role'], $setting);
		?>
		<input type="submit" class="button" value="Filter">
	</form>
</div>
<?php echo form_close()?>
<div class="right_button">
	<a class="button" href="<?=base_url('admin/system_users/add')?>">Add user</a>
</div>
<div class="right_button pagination total_rows">
	<a <?php if (!isset($_GET['limit']) || $_GET['limit'] == '10') {  echo 'class="active_limit"';} ?> href="<?=base_url('admin/system_users/?').$filter_data.'limit=10'?>">10</a>
	<a <?php if (isset($_GET['limit']) && $_GET['limit'] == '20') {  echo 'class="active_limit"';} ?> href="<?=base_url('admin/system_users/?').$filter_data.'limit=20'?>">20</a>
	<a <?php if (isset($_GET['limit']) && $_GET['limit'] == '30') {  echo 'class="active_limit"';} ?> href="<?=base_url('admin/system_users/?').$filter_data.'limit=30'?>">30</a>
	<a <?php if (isset($_GET['limit']) && $_GET['limit'] == 'all') { echo 'class="active_limit"';} ?> href="<?=base_url('admin/system_users/?').$filter_data.'limit=all'?>">All</a>
</div>
	<?php 
		$attributes = array('id' => 'action_select');
		echo form_open_multipart('admin/system_users/action', $attributes);
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
	<th class="team_col"><p>NAME</p></th>
			<th class="divis_col"><p>PHONE</p></th>
	<th class="coach_col"><p>EMAIL</p></th>
	<th class="wins_col"><p>ROLE(S)</p></th>
	<th class="loses_col"><p>DIVISIONS</p></th>
	<th class="ties_col"><p>TEAMS</p></th>
			<th class="action_col"><p>ACTION</p></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($system_users as $item) :?>
			<tr>
				<td class ="checkbox_col"><input data-item-id="<?php echo ($item['id']);?>" class="check_div" type="checkbox"></td>
				<td  class="team_col"><p><?php echo htmlspecialchars($item['last_name'].', '.$item['first_name']);?></p></td>
				<td class="divis_col"><p><?php echo htmlspecialchars($item['home_phone']);?></p></td>
				<td class="coach_col"><p><?php echo htmlspecialchars($item['email']);?></p></td>
				<td class="wins_col"><p>0</p></td>
				<td class="loses_col"><p>0</p></td>
				<td class="ties_col"><p>0</p></td>
				<td class="action_col">
					<a href="<?php echo base_url('admin/system_users/edit').'?'.'id='.($item['id'])?>" class="edit"><img src="<?=base_url('images/edit.png')?>"></a>
					<a href="#delete" data-item-id="<?php echo ($item['id']);?>" class="delete"><img src="<?=base_url('images/delete.png')?>"></a>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
<div class="pagination">
<?php echo $this->pagination->create_links(); ?>
</div>

<?php $this->load->view('admin/include/footer')?>