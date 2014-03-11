<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Division extends CI_Model {

    /**
     * loads the divisionss from the database
     * @return array  this divisions list
     */
    function names_list() {
		return $this->db->select('name')
						->select('id')
		    			->get('divisions')
		    			->result_array();
    }

    function count_filtered($filter) {
    	$this->division_filter($filter);
    	return $this->db->count_all_results('divisions');
    }

	function get_list($num, $offset, $filter) {	
		$this->db->join('teams', 'teams.division_id = divisions.id', 'left')
				 ->join('roles_to_users', 'roles_to_users.division_id = divisions.id AND roles_to_users.role_id = 2', 'left')
				 ->join('users', 'users.id = roles_to_users.user_id', 'left')
				 ->select('users.first_name as user_name')
				 ->select('users.last_name as user_surname')
				 ->select('GROUP_CONCAT(teams.name SEPARATOR "|||") as team_name', false)
				 ->select('fall_ball')
				 ->select('divisions.id')
				 ->select('divisions.name as division_name')
			     ->group_by('divisions.id');

		$this->division_filter($filter);

		return $this->db->get('divisions', $num, $offset)
			     ->result_array();
	}

	function division_filter($filter) {
		if($filter['id']){
			$this->db->where('divisions.id', $filter['id']);
		}
		if(strlen($filter['status'])){
			$this->db->where('divisions.status', $filter['status']);
		}
		if(strlen($filter['season'])){
			$this->db->where('divisions.fall_ball', $filter['season']);
		}
	}

	function update_status($data) {
		$this->db->where_in('id', $data['id']);
		 $this->db->update('divisions', $data['status']);
	}

	function add($data) {
		$this->db->insert('divisions', $data);
		return $this->db->insert_id();
	}

	function edit($id, $data) {
		$this->db->where('id', $id);
		 $this->db->update('divisions', $data);
		return $this->db->insert_id();
	}

	function delete($id) {
		$this->db->where_in('id', $id);
		return $this->db->delete('divisions'); 

	}
	
	function delete_logo($id) {
		$division['logo'] = '';
		$this->db->where('id', $id)
				 ->update('divisions', $division); 
	}

	function get_division_data_by_id($id) {
		$this->db->where('id', $id);
		return $this->db->get('divisions')->result_array();
	}
}
