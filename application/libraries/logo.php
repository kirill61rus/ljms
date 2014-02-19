<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту');

class Logo { 
    /**
     * checks the format and rename page
     * @param url page
     * @return page this new name or error
     */
	function upload_logo() {
		$config['upload_path']   = './'.URL_LOGO;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']		 = 1500;
		$config['encrypt_name']  = TRUE;

		$CI =& get_instance();
		$CI->load->library('upload', $config);
		/**
		* resize 
		* @param url page
		* @return page this new size or error
		*/
		if ($CI->upload->do_upload()) {
			$image_data = $CI->upload->data();

			$config = array(
				'image_library'  => 'gd2',
				'source_image'   => $image_data['full_path'],   
				'new_image' 	 => APPPATH.'../'.URL_LOGO,
				'maintain_ratio' => TRUE, 
				'width' 		 => 150,
				'height' 		 => 150
			);

			$CI->load->library('image_lib', $config);
			// if no errors returns the name of the created image
			if ($CI->image_lib->resize()) {
				return $image_data['file_name'];
			} 

			$CI->session->set_flashdata('error', $CI->image_lib->display_errors());
		} 

		$CI->session->set_flashdata('error', $CI->upload->display_errors());
	}
}