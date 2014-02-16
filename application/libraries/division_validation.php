<?php if (!defined('BASEPATH')) exit('');

	class Division_validation { 
	    /**
	     * disivion data
	     * @param division data 
	     * @return TRUE or FALSE 
	     */
		function set_validation_rules($logo_format_validation) {
			$CI =& get_instance();
			$CI->form_validation->set_rules('status', 'Status',  'required');	
			$CI->form_validation->set_rules('name', 'Name',  'required|trim|max_length[30]');	
			$CI->form_validation->set_rules('base_fee', 'Base fee',  'numeric');	
			$CI->form_validation->set_rules('addon_fee', 'Addon fee',  'numeric');	
			$CI->form_validation->set_rules('age_to', 'Age',  'callback_age_check');
			$CI->form_validation->set_rules('age_from', '',  '');	
			$CI->form_validation->set_rules('description', '',  'trim');	
			$CI->form_validation->set_rules('rules', '',  'trim');
			$CI->form_validation->set_rules('userfile', 'Logo',  $logo_format_validation);		

			if($CI->form_validation->run()) {
				return TRUE;
			} else{
				return FALSE;
			}
		}
	}