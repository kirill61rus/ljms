<?php if (!defined('BASEPATH')) exit('');

	class Has_acces { 
	    
	    /**
	     * checks whether the user is an administrator
	     * @param session
	     * @return TRUE or FALSE 
	     */
		function admin_function() {
			$CI =& get_instance();
			if ($CI->session->userdata('role') == 'admin') {
				return TRUE;
			} else {
				return FALSE;
			}
		}
		function ownership_divisions($id) {
			$CI =& get_instance();
			$user_role = $CI->session->userdata('role');
			if((preg_match('/'.$id.'/', $CI->session->userdata('divisions')) || $user_role == "admin")) {
				return TRUE;
			}
		}
	}