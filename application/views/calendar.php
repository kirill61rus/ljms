<?php $this->load->view('include/header')?>
<h4>Games on <?php echo date('D, F d Y', strtotime($date))?></h4>
<table class="full_width_table schedule_for_date">
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

<?php $this->load->view('include/footer')?>