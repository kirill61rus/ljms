<?php if (!defined('BASEPATH')) exit('');

	class Validation { 
	    /**
	     * disivion data
	     * @param division data 
	     * @return TRUE or FALSE this errors
	     */
		function division_validate() {
			$CI =& get_instance();
			$CI->form_validation->set_rules('status', 'Status',  'required');	
			$CI->form_validation->set_rules('name', 'Name',  'required|trim|max_length[30]');	
			$CI->form_validation->set_rules('base_fee', 'Base fee',  'numeric');	
			$CI->form_validation->set_rules('addon_fee', 'Addon fee',  'numeric');	
			$CI->form_validation->set_rules('age_to', 'Age',  'callback_age_check');
			$CI->form_validation->set_rules('age_from', '',  '');	
			$CI->form_validation->set_rules('description', '',  'trim');	
			$CI->form_validation->set_rules('rules', '',  'trim');
			if($CI->form_validation->run()) {
				return TRUE;
			} else{
				return FALSE;
			}
		}

		function team_validate() {
			$CI =& get_instance();
			$CI->form_validation->set_rules('name', 'Name',  'required|trim|max_length[30]');	
			$CI->form_validation->set_rules('division_id', 'Division',  'required');	
			$CI->form_validation->set_rules('status', 'Status',  'required');	
			$CI->form_validation->set_rules('league_type_id', 'League type',  'required');	
			$CI->form_validation->set_rules('is_visitor', '',  '');	
			if($CI->form_validation->run()) {
				return TRUE;
			} else{
				return FALSE;
			}

		}
		function user_validate() {
			$CI =& get_instance();
			$CI->form_validation->set_rules('first_name', 'First name',  'required|trim');
			$CI->form_validation->set_rules('last_name', 'Last name',  'required|trim');
			$CI->form_validation->set_rules('address', 'Address',  'required|trim');
			$CI->form_validation->set_rules('city', 'City',  'required|trim');
			$CI->form_validation->set_rules('state_id', 'State',  'required');
			$CI->form_validation->set_rules('zipcode', 'Zipcode',  'required|integer');
			$CI->form_validation->set_rules('email', 'Email',  'required|valid_email|callback_email_check');
			$CI->form_validation->set_rules('repeat_email', 'Email Confirm',  'required|matches[email]');
			$CI->form_validation->set_rules('home_phone', 'Home phone',  'required|callback_phone_check');
			$CI->form_validation->set_rules('cell_phone', 'Cell phone',  'callback_phone_check');
			$CI->form_validation->set_rules('alt_phone', 'Alternitive phone', 'callback_phone_check');
			$CI->form_validation->set_rules('password', 'Password',  'required|min_length[6]');
			$CI->form_validation->set_rules('repassword', 'Password confirm',  'required|matches[password]');
			$CI->form_validation->set_rules('alt_email', 'Alt Email',  'valid_email');
			$CI->form_validation->set_rules('alt_phone_2', 'Alt phone',  'callback_phone_check');
			$CI->form_validation->set_rules('alt_first_name', 'Alt first name',  ''); 
			$CI->form_validation->set_rules('alt_last_name', 'Alt last name',  ''); 
			if($CI->form_validation->run()) {
				return TRUE;
			} else{
				return FALSE;
			}

		}
	}