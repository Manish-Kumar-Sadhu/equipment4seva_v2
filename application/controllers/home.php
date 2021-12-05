<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('master_model');
		if($this->session->userdata('logged_in')){
			$this->load->model('user_model');
			$userdata = $this->session->userdata('logged_in');
			$user_id = $userdata['user_id'];
			$this->data['functions']=$this->user_model->user_function($user_id);
			$this->data['user_parties']=$this->user_model->user_parties($user_id);
		}
		$this->data['yousee_website'] = $this->master_model->get_defaults('yousee_website');
    }

	public function index(){
		$this->data['title']='Home';
		$this->load->view('templates/header' , $this->data);
		$this->load->view('home', $this->data);
		$this->load->view('templates/footer' ,$this->data);
	}

	public function login(){
		$this->load->helper('form');
		if($this->session->userdata('logged_in')){
			$this->data['title']="Home";
			$this->load->view('templates/header' , $this->data);
			// $this->load->view('admin/admin_functions' , $this->data);
		}
		else {
			if(!$this->session->userdata('logged_in')){
				$this->data['title']="Login";
				$this->load->view('templates/header',$this->data);
				$this->load->helper('form');
				$this->load->library('form_validation');				
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
				$login = 0;
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('user/login');
				}
				else{
					$login = 1;
				}
				if($this->input->post('username') && $this->input->post('username')!=""){
					$this->user_model->save_user_signin($this->input->post('username'), $login);
				}
				if($login==1){
					redirect('equipments', 'refresh');	
				}	
			}
			else {
				redirect('home','refresh');
			}
		}
		$this->load->view('templates/footer');		
	}

	function check_database($password){
		$this->load->model('user_model');
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');
		$result = $this->user_model->login($username, $password);
		if($result) {
			$sess_array = array(
				'user_id' => $result->user_id,
				'username' => $result->username,
				'email'=>$result->email,
				'first_name'=>$result->first_name,
				'last_name'=>$result->last_name,
				'default_party_id'=>$result->default_party_id
				);
			$this->session->set_userdata('logged_in', $sess_array);
			return TRUE;
		} else {
			$this->form_validation->set_message('check_database','Invalid Username or Password');
	     return false;
		}
	}

	public function change_password() {
		if($this->session->userdata('logged_in')){
			$this->load->helper('form');
			$this->load->model('user_model');
			$this->load->library('form_validation');
			$this->data['title']="Change password";
			$this->data['userdata']=$this->session->userdata('logged_in');
			$user_id=$this->data['userdata']['user_id'];
			$this->load->view('templates/header',$this->data);
			$this->form_validation->set_rules('password','Password','required|trim|xss_clean');
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('pages/change_password',$this->data);
			}
			else {
				if($this->user_model->change_password($user_id)){
					$this->data['msg']="Password has been changed successfully";
				}
				else{
					$this->data['msg']="Password could not be changed";
				}
				$this->load->view('pages/change_password',$this->data);
				$this->load->view('templates/footer' , $this->data);
			}

		} else{
			show_404();
		}
	}

	function logout(){
	   $this->session->sess_destroy();
	   redirect('home', 'refresh');
	 }

}
