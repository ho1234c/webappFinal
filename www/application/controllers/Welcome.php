<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends CI_Controller {
	function index(){
		if(!$this->session->userdata('is_login')){
			$this->load->helper('url');
			redirect('/auth/login');
		}else{
			$this->load->view('head');
			$this->load->model('Marker_models');
			$marker = $this->Marker_models->getByUserId(array('user_id'=>$this->session->userdata('user_id')));
			$data = array('marker' => $marker);
			$this->load->view('main',$data);
			$this->load->view('footer');
		}
	}
}
?>