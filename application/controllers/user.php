<?php
	
	//untuk handle API

	class user extends CI_Controller{

		public function __construct(){
			parent::__construct();   

			//load model database user
			$this->load->model('user_model');
			//$this->load->library('sessionlogin');
		}


		/*
		 *  PAGE
		 *
		 *	Halaman utama user (Jadwal dari user berada di sini)
		 */
		 
		 public function login(){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$hasil = $this->user_model->cek_username_password($username, $password);
			
			if($hasil->num_rows() == 1){
				$data = $hasil->row();
				$this->session->set_userdata('user_id', $data->user_id);
				$this->session->set_userdata('name', $data->name);
				
				redirect('jadwal/index');
			}
		}
		
		function add_user(){   
			$this->load->model('user_model');
			$this->user_model->insert_user();
			$data['notifikasi'] = 'Data berhasil disimpan';
			$data['judul']='Insert Data Berhasil';
		}
		
		public function index(){
			$data['title'] = "Jadwal";
			$this->load->view("template/header", $data);
			$this->load->view("template/header_bar", $data);
			$this->load->view("jadwal", $data);
			$this->load->view("template/footer", $data);
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
			$this->load->view("template/header", $data);
			$this->load->view("template/header_bar", $data);
			$this->load->view("edit_user", $data);
			$this->load->view("template/footer", $data);
		}

	}
?>