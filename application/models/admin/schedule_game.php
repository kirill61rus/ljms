<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule_game extends CI_Model {

    /**
     * loads the divisionss from the database
     * @return array  this divisions list
     */
    function count_filtered($filter) {
    	if (strlen($filter['league']))  {
    		$this->db->join('teams as home_teams', 'game_schedule.home_team_id = home_teams.id', 'left'); 
    		$this->db->join('teams as visitor_teams', 'game_schedule.visitor_team_id = visitor_teams.id', 'left'); 
    	}
    	$this->games_filter($filter);
    	return $this->db->count_all_results('game_schedule');
    }

	function get_list($num, $offset, $filter) {	

		$this->db->join('divisions', 'game_schedule.division_id = divisions.id', 'left')
				 ->join('teams as home_teams', 'game_schedule.home_team_id = home_teams.id', 'left')
				 ->join('teams as visitor_teams', 'game_schedule.visitor_team_id = visitor_teams.id', 'left')
				 ->join('location', 'game_schedule.location_id = location.id', 'left')
				 ->select('home_teams.name as home_team_name')
				 ->select('visitor_teams.name as visitor_team_name')
				 ->select('divisions.name as division_name')
				 ->select('game_schedule.status')
				 ->select('game_schedule.date')
				 ->select('game_schedule.id')
				 ->select('game_schedule.home_team_result')
				 ->select('game_schedule.visitor_team_result')
				 ->select('game_schedule.practice')
				 ->select('game_schedule.time')
				 ->select('location.name as location_name')
				 ->group_by('game_schedule.id');

		$this->games_filter($filter);

		return $this->db->get('game_schedule', $num, $offset)
						->result_array();
	}

	function games_filter($filter) {
		if(strlen($filter['division'])){
			$this->db->where('game_schedule.division_id', $filter['division']);
		}
		if(strlen($filter['team'])){
			$this->db->where('game_schedule.home_team_id', $filter['team']);
			$this->db->or_where('game_schedule.visitor_team_id', $filter['team']); 
		}
		if(strlen($filter['league'])){			
    		$this->db->where('home_teams.league_type_id', $filter['league']);
    		$this->db->or_where('visitor_teams.league_type_id', $filter['league']);
		}
		if($filter['date'] == 'future'){			
    		$this->db->where("DATE_FORMAT(date,'%Y-%m-%d')>=", date('Y-m-d'));
		} elseif ($filter['date'] == 'prev') {
			$this->db->where("DATE_FORMAT(date,'%Y-%m-%d')<", date('Y-m-d'));
		}
	}

	function game_by_date($date) {	
		$this->db->join('divisions', 'game_schedule.division_id = divisions.id', 'left')
				 ->join('teams as home_teams', 'game_schedule.home_team_id = home_teams.id', 'left')
				 ->join('teams as visitor_teams', 'game_schedule.visitor_team_id = visitor_teams.id', 'left')
				 ->join('location', 'game_schedule.location_id = location.id', 'left')
				 ->select('home_teams.name as home_team_name')
				 ->select('visitor_teams.name as visitor_team_name')
				 ->select('divisions.name as division_name')
				 ->select('game_schedule.date')
				 ->select('game_schedule.id')
				 ->select('game_schedule.home_team_result')
				 ->select('game_schedule.visitor_team_result')
				 ->select('game_schedule.practice')
				 ->select('game_schedule.time')
				 ->select('location.name as location_name')
				 ->group_by('game_schedule.id');

		$this->db->where("DATE_FORMAT(date,'%Y-%m-%d')=", $date);

		return $this->db->get('game_schedule')
						->result_array();
	}

	function game_for_division($id) {	
		$this->db->join('divisions', 'game_schedule.division_id = divisions.id', 'left')
				 ->join('teams as home_teams', 'game_schedule.home_team_id = home_teams.id', 'left')
				 ->join('teams as visitor_teams', 'game_schedule.visitor_team_id = visitor_teams.id', 'left')
				 ->join('location', 'game_schedule.location_id = location.id', 'left')
				 ->select('home_teams.name as home_team_name')
				 ->select('visitor_teams.name as visitor_team_name')
				 ->select('divisions.name as division_name')
				 ->select('game_schedule.date')
				 ->select('game_schedule.id')
				 ->select('game_schedule.home_team_result')
				 ->select('game_schedule.visitor_team_result')
				 ->select('game_schedule.practice')
				 ->select('game_schedule.time')
				 ->select('location.name as location_name')
				 ->group_by('game_schedule.id');

		$this->db->where('game_schedule.division_id', $id);

		return $this->db->get('game_schedule')
						->result_array();
	}




	function teams_by_id_game($id) {
		$this->db->join('teams as home_teams', 'game_schedule.home_team_id = home_teams.id', 'left')
				 ->join('teams as visitor_teams', 'game_schedule.visitor_team_id = visitor_teams.id', 'left')
 				 ->select('home_teams.name as home_team_name')
				 ->select('visitor_teams.name as visitor_team_name')
				 ->where('game_schedule.id', $id);
		return $this->db->get('game_schedule')->result_array();
	}

	function update_status($data) {
		$this->db->where_in('id', $data['id']);
		 $this->db->update('game_schedule', $data['status']);
	}

	function add($data) {
		$this->db->insert('game_schedule', $data);
		return $this->db->insert_id();
	}

	function edit($id, $data) {
		return $this->db->where('id', $id)
				 ->update('game_schedule', $data);
	}

	function delete($id) {
		$this->db->where_in('id', $id);
		return $this->db->delete('game_schedule'); 

	}
	function game_data($id) {
		$this->db->where('id', $id);
		return $this->db->get('game_schedule')->result_array();
	}
}