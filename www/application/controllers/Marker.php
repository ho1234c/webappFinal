<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Marker extends CI_Controller {
	function __constructor(){
		parent::__constructor();
	}

	function add(){
		$state_msg = "";
			// 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
		$config['upload_path'] = './static/user';
			// git,jpg,png 파일만 업로드를 허용한다.
		$config['allowed_types'] = 'gif|jpg|png';
			// 허용되는 파일의 최대 사이즈
		$config['max_width']  = '1024';
			// 이미지인 경우 허용되는 최대 높이
		$config['max_height']  = '768';
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('product_pic')){
			$state_msg = "file upload error";
			echo $state_msg;
		}else{
			$this->load->model('Marker_models');
			$user_id = $this->session->userdata('user_id');
			$data = $this->upload->data();
			$this->Marker_models->add(array(
				'lat'=>$this->input->post('lat'),
				'lng'=>$this->input->post('lng'),
				'filename'=>$data['file_name'],
				'user_id'=>$user_id
				));		
			$marker = $this->Marker_models->getByUserId(array('user_id'=>$user_id));
			echo json_encode($marker);
		}


	}
}