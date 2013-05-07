<?php
	
	//untuk handle API

	class myschedule extends CI_Controller{

		public function __construct(){
			parent::__construct();   

			//load model database user
			$this->load->model('user_model');
			//$this->load->library('sessionlogin');
		}


		//halaman utama
		public function index(){
			$this->load->view("login");
		}
	}
?>