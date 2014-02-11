<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Flash {
	function show (){
		$CI =& get_instance();

		$flash_data = config_item('flash');

		if($CI->session->flashdata('error')){
			echo ($flash_data['error_open_tag'] . $CI->session->flashdata('error') . $flash_data['error_close_tag']); 
		}

		if($CI->session->flashdata('success')){
			echo ($flash_data['success_open_tag'] . $CI->session->flashdata('success') . $flash_data['success_close_tag']); 
		}
		if($CI->session->flashdata('error_small')){
			echo ($flash_data['error_small_open_tag'] . $CI->session->flashdata('error_small') . $flash_data['error_small_close_tag']); 
		}
	}
}