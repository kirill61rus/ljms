<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту');

class Logo { 
    /**
     * resize and rename page
     * @param url page
     * @return page this naw name and size 
     */
	function upload_logo() {
		$config['upload_path']   = './'.URL_LOGO;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']		 = 1500;
		$config['encrypt_name']  = TRUE;

		$CI =& get_instance();
		$CI->load->library('upload', $config);
		$CI->upload->do_upload();
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
		$CI->image_lib->resize();

		return $image_data['file_name'];
	}
}