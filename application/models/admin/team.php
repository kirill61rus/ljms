<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team extends CI_Model {

    /**
     * loads the divisionss from the database
     * @return array  this teams list
     */
    function names_list() {
		return $this->db->select('name')
						->select('id')
		    			->get('teams')
		    			->result_array();
    }

    function count_filtered($filter) {
    	$this->team_filter($filter);
    	return $this->db->count_all_results('teams');
    }

	function get_list($num, $offset, $filter) {	

		$this->db->join('divisions', 'divisions.id = teams.division_id', 'left')
				 ->join('roles_to_users', 'roles_to_users.team_id = teams.id AND roles_to_users.role_id = 3', 'left')
				 ->join('users', 'users.id = roles_to_users.user_id', 'left')
				 ->join('leagues', 'leagues.id = teams.league_type_id', 'left');
		$this->game_results();				 

		$this->db->select('users.first_name as user_name')
				 ->select('users.last_name as user_surname')
				 ->select('teams.id')
				 ->select('teams.status')
 				 ->select('teams.name as team_name')
				 ->select('divisions.name as division_name')
				 ->select('leagues.name as league_name')
				 ->order_by('teams.name')
				 ->group_by('teams.id')
				 ->select('teams.status');

		$this->team_filter($filter);

		return $this->db->get('teams', $num, $offset)
			     ->result_array();
	}

	function team_filter($filter) {
		if($filter['id']){
			$this->db->where('teams.division_id', $filter['id']);
		}
		if(strlen($filter['league_type_id'])){
			$this->db->where('teams.league_type_id', $filter['league_type_id']);
		}
		if(strlen($filter['status'])){
			$this->db->where('teams.status', $filter['status']);
		}
	}
	function get_ljms_team($id) {
		$this->game_results();
		$where = "teams.division_id = $id AND teams.league_type_id = 1";		
		$this->db->where($where);
		$this->db->group_by('teams.id');		
		$this->db->select('teams.name');
		return $this->db->get('teams')
			    		->result_array();
	}
	function get_non_conference_teams($id) {
		$this->game_results();
		$where = "teams.division_id = $id AND teams.league_type_id = 2";		
		$this->db->where($where);
		$this->db->group_by('teams.id');		
		$this->db->select('teams.name');
		return $this->db->get('teams')
			    		->result_array();
	}

	function update_status($data) {
		$this->db->where_in('id', $data['id']);
		 $this->db->update('teams', $data['status']);
	}

	function add($data) {
		$this->db->insert('teams', $data);
		return $this->db->insert_id();
	}

	function edit($id, $data) {
		$this->db->where('id', $id);
		 $this->db->update('teams', $data);
		return $this->db->insert_id();
	}

	function delete($id) {
		$this->db->where_in('id', $id);
		return $this->db->delete('teams'); 

	}
	
	function team_data($id) {
		$this->db->where('id', $id);
		return $this->db->get('teams')->result_array();
	}

	function game_results(){
	$this->db->join('game_schedule as home_win', 'home_win.home_team_id = teams.id AND home_win.home_team_result > home_win.visitor_team_result', 'left')
			 ->join('game_schedule as visitor_win', 'visitor_win.visitor_team_id = teams.id AND visitor_win.visitor_team_result > visitor_win.home_team_result', 'left')

			 ->join('game_schedule as home_loss', 'home_loss.home_team_id = teams.id AND home_loss.home_team_result < home_loss.visitor_team_result', 'left')
			 ->join('game_schedule as visitor_loss', 'visitor_loss.visitor_team_id = teams.id AND visitor_loss.visitor_team_result < visitor_loss.home_team_result', 'left')

			 ->join('game_schedule as home_ties', 'home_ties.home_team_id = teams.id AND home_ties.home_team_result = home_ties.visitor_team_result', 'left')
			 ->join('game_schedule as visitor_ties', 'visitor_ties.visitor_team_id = teams.id AND visitor_ties.visitor_team_result = visitor_ties.home_team_result', 'left')

			 ->select('GROUP_CONCAT(DISTINCT(home_win.id)) as home_win', false)
			 ->select('GROUP_CONCAT(DISTINCT(visitor_win.id)) as visitor_win', false)
			 ->select('GROUP_CONCAT(DISTINCT(home_loss.id)) as home_loss', false)
			 ->select('GROUP_CONCAT(DISTINCT(visitor_loss.id)) as visitor_loss', false)
			 ->select('GROUP_CONCAT(DISTINCT(home_ties.id)) as home_ties', false)
			 ->select('GROUP_CONCAT(DISTINCT(visitor_ties.id)) as visitor_ties', false);
	}
}