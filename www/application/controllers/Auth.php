<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller {
	function __constructor(){
		parent::__constructor();
	}

	function login(){
		$this->load->view('head');
		$this->load->view('login');
		$this->load->view('footer');
	}

	function logout(){
		$this->session->sess_destroy();
		$this->load->helper('url');
		redirect('/');
	}

	function register(){
		$this->load->view('head');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('nickname', 'nickname', 'required|min_length[5]|max_length[20]');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[30]|matches[re_password]');
		$this->form_validation->set_rules('re_password', 'retype password', 'required');


		if($this->form_validation->run() === false){
			$this->load->view('register');    
		} else {
			if(!function_exists('password_hash')){
				$this->load->helper('password');
			}
			$hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

			$this->load->model('User_models');
			$this->User_models->add(array(
				'email'=>$this->input->post('email'),
				'password'=>$hash,
				'nickname'=>$this->input->post('nickname')
				));

			$this->session->set_flashdata('message', '회원가입에 성공했습니다.');
			$this->load->helper('url');
			redirect('/');
		}
		$this->load->view('footer');    
	}

	function authentication(){
		$this->load->model('user_models');
		$user = $this->user_models->getByEmail(array('email'=>$this->input->post('email')));
		if(
			$this->input->post('email') == $user->email &&
			password_verify($this->input->post('password'), $user->password)
			) {
			$this->session->set_userdata('is_login', true);
			$this->session->set_userdata('user_id', $user->id);

		$this->load->helper('url');
		redirect('/');
	} else {
		echo "불일치";
		$this->session->set_flashdata('message', '로그인에 실패 했습니다.');
		$this->load->helper('url');
		redirect('/auth/login');
	}
}
}

?>
