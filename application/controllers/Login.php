<?php

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AMS', 'ID');
		$this->load->library('session');
	}

    public function index()
	{
		
	$this->load->view('page_login');	
		
    }
    

    public function process_login(){

        $user = $this->input->post('username');
		$password = $this->input->post('password');
		$this->ID->loginn($user, $password);
	
		if($this->session->has_userdata('ImageUploadUserId')){
			if($password=='123'){
				redirect('changepwd');
			}else{
			redirect('dashboard');
			}

		}
    }

	public function authenticate2()
	{

		$data = $this->input->post('data');

		$data2 = $this->ID->login2($data);
		return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode($data2));
	}

	public function logout()
    {
		$this->session->sess_destroy();
		redirect('');
    }


}
