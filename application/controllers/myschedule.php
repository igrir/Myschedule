<?php
	
	//untuk handle API

	class myschedule extends CI_Controller{

		public function __construct(){
			parent::__construct();   

			//load model database user
			$this->load->model('user_model');
			//$this->load->library('sessionlogin');
		}


		/*
		 *  PAGE
		 *
		 *	Halaman Utama
		 */
		public function index(){
			$data['title'] = "My Schedule";
			$data['error'] = "";
			$this->load->view("template/header", $data);
			$this->load->view("login", $data);
			$this->load->view("template/footer", $data);
		}
	}
?>