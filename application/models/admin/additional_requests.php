<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class additional_requests extends CI_Model {

		function names_list() {
			return $this->db->select('name')
							->select('id')
			    			->get('location')
			    			->result_array();
    	}
		function get_teams_for_division_id($id){
			return $this->db->where('division_id', $id)
							->select('id, name')
							->get('teams')->result_array();
		}
		function date_this_game($year, $month){
			return $this->db->where("DATE_FORMAT(date,'%Y-%m')=", "$year-$month")
							->select('date')
							->get('game_schedule')->result_array();
							
		}
	}