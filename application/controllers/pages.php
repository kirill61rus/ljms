<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	function about(){
		$this->load->view('about');
	}
}