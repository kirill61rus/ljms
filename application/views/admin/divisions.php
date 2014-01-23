<?php $this->load->view('admin/include/header')?>
<?php $this->load->view('admin/include/admin_menu')?>
<div class="admin_menu_info">
	<h2>Divisions</h2>
	<?php echo ($this->session->flashdata('item')); ?>
	<ul>
		<li>"Ages" - Age group that applies to a particular division.</li>
		<li>"Base Fee" - Amount charged for a registration.</li>
		<li>"Add-on Fee" - Amount charged during registration for each additional child being registered.</li>
	</ul>
</div>
	<?php 
		$attributes = array('id' => 'filter',  'method' => 'get');
		echo form_open_multipart('admin/divisions/', $attributes);
	?>
<div class="filter">
	<form>
		<b>Filter by:</b> Division:
		<?php
			$options[''] =  'All';
			foreach($list as $item) :
			$options[$item['id']] =  $item['name'];
			endforeach;
		echo form_dropdown('id', $options, $filter['id']);
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
	<a href="<?=base_url('admin/divisions/?').$filter_data.'limit=10'?>">10</a>
	<a href="<?=base_url('admin/divisions/?').$filter_data.'limit=20'?>">20</a>
	<a href="<?=base_url('admin/divisions/?').$filter_data.'limit=30'?>">30</a>
	<a href="<?=base_url('admin/divisions/?').$filter_data.'limit=all'?>">All</a>
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
	echo form_dropdown('action', $options);
	?>
	<input type="submit" class="button" value="Action">
</div>
<?php echo form_close()?>
<table class="full_width_table">
	<thead>
		<tr>
			<th class ="checkbox_col" ><input class="check_all" type="checkbox" name="#"></th>
			<th class="divis_col"><p>DIVISION</p></th>
			<th class="season_col"><p>SEASON</p></th>
			<th class="team_col"><p>TEAM(S)</p></th>
			<th class="dir_col"><p>DIRECTOR</p></th>
			<th class="action_col"><p>ACTION</p></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($divisions as $item) :?>
			<tr>
				<td class ="checkbox_col"><input data-item-id="<?php echo ($item['id']);?>" class="check_div" type="checkbox"></td>
				<td class="divis_col"><p><?php echo htmlspecialchars($item['division_name']);?></p></td>
				<td class="season_col"><p><?php echo (($item['fall_ball'] == 0 ? "Spring/Summer" : "Fall Ball"))?></p></td>
				<td class="team_col"><p><?php echo ($item['team_name']);?></p></td>
				<td class="dir_col"><p>директор нужно вывести</p></td>
				<td class="action_col">
				<a href="<?php echo base_url('admin/divisions/edit').'?'.'id='.($item['id'])?>" class="edit"><img src="<?=base_url('images/edit.png')?>"></a>
				<a href="#delete" data-item-id="<?php echo ($item['id']);?>" class="delete"><img src="<?=base_url('images/delete.png')?>"></a>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
<div class="pagination">
<?php echo $this->pagination->create_links(); ?>
</div>

<?php $this->load->view('admin/include/footer')?>