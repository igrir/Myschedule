<?php
	
	//untuk handle API

	class user extends CI_Controller{

		public function __construct(){
			parent::__construct();   

			//load model database user
			$this->load->model('user_model');
			$this->load->library('session');
		}

		public function login(){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->user_model->cek_username_password($username,$password)) {

				//data untuk kebutuhan session
				$userdata = array('username'=>$username,
								  'LOGGED_IN'=>true);

				$this->session->set_userdata($userdata);

				$data['error']='';
				$data['title'] = "Jadwal";
				
				redirect('user');

			} else {
				$data['error']='Tidak ada username atau password tersebut';
				$this->load->view('login', $data);
				$this->load->view("template/header", $data);
				$this->load->view("template/footer", $data);
			}
		}
		
		public function add_user(){   
			$this->load->model('user_model');
			$this->user_model->insert_user();
			$data['title'] = "Login";
			$this->load->view("template/header", $data);
			$this->load->view('login', $data);
			$this->load->view("template/footer", $data);
		}
		


		/*
		 *  PAGE
		 *
		 *	Halaman utama user (Jadwal dari user berada di sini)
		 */
		public function index(){
			$data['title'] = "Jadwal";

			//mengecek login
			if ($this->session->userdata('LOGGED_IN')) {

				$data['username'] = $this->session->userdata("username");

				$this->load->view("template/header", $data);
				$this->load->view("template/header_bar", $data);
				$this->load->view("jadwal", $data);
				$this->load->view("template/footer", $data);
			}else{
				redirect('myschedule');
			}

			
		}
		
		
		public function daftar(){
			$data['title'] = "Daftar";
			$this->load->view("template/header", $data);
			$this->load->view("daftar", $data);
			$this->load->view("template/footer", $data);
		}

		/*
		 *  PAGE
		 *
		 *	Edit user
		 */
		public function edit(){
			$data['title'] = "Edit user";

			//mengecek login
			if ($this->session->userdata('LOGGED_IN')) {

				$data['username'] = $this->session->userdata("username");
				$this->load->view("template/header", $data);
				$this->load->view("template/header_bar", $data);
				$this->load->view("edit_user", $data);
				$this->load->view("template/footer", $data);
			}
		}
		
		//to do logout process
		function logout() {
			$this->session->sess_destroy();
			$data['error'] = 'You have been logged out.';
			$this->load->view("template/header", $data);
			$this->load->view('login', $data);
			$this->load->view("template/footer", $data);
		}
	}
?>