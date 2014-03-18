<?php $this->load->view('include/header_this_left_sidebar')?>
	<div class="division_info">
		<h4><?php echo htmlspecialchars($division_data[0]['division_name']);?></h4>

		<div class="third_width_col">
			<p><?php echo ($division_data[0]['description']) ? htmlspecialchars($division_data[0]['description']): "No description";?></p>		
		</div>
		<div class="third_width_col">
			<h5>Division Rules</h5>
			<p><?php echo ($division_data[0]['rules']) ? htmlspecialchars($division_data[0]['rules']): "No rules";?></p>
		</div>
		<div class="third_width_col">
			<h5>LJMS Teams</h5>
			<?php if ($ljms_team) {?>
			<table class="full_width_table schedule_for_date">
				<thead>
					<tr>
						<th><p>TEAM</p></th>
						<th><p>WINS</p></th>
						<th><p>LOSES</p></th>
						<th><p>TIES</p></th>
						<th><p>AVERAGE</p></th>
					</tr>
				</thead>  
				<tbody>
					<?php foreach($ljms_team as $item) :?>
						<tr>
							<td><p><?php echo htmlspecialchars($item['name']);?></p></td>
							<td><p><?php ?></p></td>
							<td><p><?php ?></p></td>
							<td><p><?php ?></p></td>
							<td><p><?php ?></p></td>
						</tr> 
					<?php endforeach;?>
				</tbody>
			</table>
			<?php } else echo "<p>No LJMS Teams</p>";?>
		</div>
		<div class="third_width_col">
			<h5>Division Representives</h5>
			<?php if ($division_data[0]['user_name']) {?>
			<table class="full_width_table schedule_for_date">
				<thead>
					<tr>
						<th><p>NAME</p></th>
						<th><p>CONTACT</p></th>
					</tr>
				</thead>  
				<tbody>
					<tr>
						<td><p><?php echo htmlspecialchars($division_data[0]['user_name'].', '.$division_data[0]['user_surname']);?></p></td>
						<td><p><?php echo htmlspecialchars($division_data[0]['email']).'</br>'.htmlspecialchars($division_data[0]['home_phone']);?></p></td>
					</tr> 
				</tbody>
			</table>
			<?php } else echo "<p>No representives</p>";?>
		</div>
		<div class="third_width_col">
			<h5>Non Conference Teams</h5>
			<?php if ($non_conference_team) {?>
			<table class="full_width_table schedule_for_date">
				<thead>
					<tr>
						<th><p>TEAM</p></th>
						<th><p>WINS</p></th>
						<th><p>LOSES</p></th>
						<th><p>TIES</p></th>
						<th><p>AVERAGE</p></th>
					</tr>
				</thead>  
				<tbody>
					<?php foreach($non_conference_team as $item) :?>
						<tr>
							<td><p><?php echo htmlspecialchars($item['name']);?></p></td>
							<td><p><?php ?></p></td>
							<td><p><?php ?></p></td>
							<td><p><?php ?></p></td>
							<td><p><?php ?></p></td>
						</tr> 
					<?php endforeach;?>
				</tbody>
			</table>
			<?php } else echo "<p>No Non Conference Teams</p>";?>
		</div>

		<div class="two_thirds">
		<h5>Game schedule</h5>
		<?php if ($non_conference_team) {?>
			<table class="full_width_table">
				<thead>
					<tr>
						<th><p>DATES</p></th>
						<th><p>TIME</p></th>
						<th><p>DIV</p></th>
						<th><p>HOME</p></th>
						<th><p>VISITOR</p></th>
						<th><p>PRACTICE</p></th>
						<th><p>LOCATION</p></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($schedule as $item) :?>
						<tr>
							<td><p><?php echo date('D', strtotime($item['date'])).'</br>'.date('n/j/Y', strtotime($item['date']))?></p></td>
							<td><p><?php echo date('H:i', strtotime($item['time']));?></p></td>
							<td><p><?php echo htmlspecialchars($item['division_name'])?></p></td>
							<td><p><?php echo htmlspecialchars($item['home_team_name'])."</br>(".$item['home_team_result'].")"?></p></td>
							<td><p><?php echo htmlspecialchars($item['visitor_team_name'])."</br>(".$item['visitor_team_result'].")";?></p></td>
							<td><p><?php echo (($item['practice'])==1) ? 'YES': 'NO';?></p></td>
							<td><p><?php echo htmlspecialchars($item['location_name'])?></p></td>
						</tr> 
					<?php endforeach;?>
				</tbody>
			</table>
			<?php } else echo "<p>No Games</p>";?>
		</div>
	</div>
</div>

<?php $this->load->view('include/footer_common')?>