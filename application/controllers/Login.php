<?php

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper(['url','form']);
		$this->load->model('Login_model','',true);
	}

function index()
	{
    
    if($this->uri->segment(3) == 'akun_belum_terdaftar')
            $message = "Maaf! Akun Belum Terdaftar";
        else if($this->uri->segment(3) == 'salah_password')
            $message = "Maaf! Password Anda Salah";
        else if($this->uri->segment(3) == 'salah_username_password')
            $message = "Maaf! Username atau Password Anda Salah";
        else
            $message = "";
    
		if(!$_POST)
		{

			$input = (object) $this->Login_model->getDefaultValues();

		}
		else
		{

			$input = (object) $this->input->post();
		}

		if(!$this->Login_model->validate()) {
			$this->load->view(('login/login'), compact('input', 'message'));
			return;
		}

		if(!$this->Login_model->run($input)) {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            
            $cek_username = $this->db->where('username', $username)
                ->get('user')
                ->row();
            
            if(count($cek_username))
            {
                $cek_pwd = $this->db->where('username', $username)
                    ->where('password', $password)
                    ->get('user')
                    ->row();
                
                if(count($cek_pwd))
                {
                    echo "test";
                }
                else
                {
                    redirect('Login/index/salah_password');
                }
            }
            else
            {
                $cek_pwd = $this->db->where('password', $password)
                ->get('user')
                ->row();
                
                if($cek_pwd)
                {
                    redirect('Login/index/salah_username_password');
                }
                else
                {
                redirect('Login/index/akun_belum_terdaftar');
                }
            }
//			redirect('login');
		}
		else
		{
			redirect('Permintaan');
		}
	}

	function logout()
	{
		$this->Login_model->logout();
		redirect('Login');
	} 
}