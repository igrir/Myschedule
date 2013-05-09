<?php 

class jadwal extends CI_Controller {
	
	function __construct(){
		parent :: __construct();
			$this->load->helper('url'); 
			$this->load->model('jadwal_model');
			
	}
	
	public function index(){
		$data['title'] = 'jadwal';
		//menampilkan view
		$this->load->view('template/header', $data);
		echo "coba kawan";
		$this->load->view('template/footer', $data);
	}
	
	/*
	 *  PAGE
	 *
	 *	Tambah jadwal
	 */
	public function tambah(){
		$data['title'] = "Tambah Jadwal";
		$this->load->view("template/header", $data);
		$this->load->view("template/header_bar", $data);
		$this->load->view("tambah_jadwal", $data);
		$this->load->view("template/footer", $data);
		$this->load->model('jadwal_model');
		$this->jadwal_model->insert_jadwal($data);
		
	}

	/*
	 *  PAGE
	 *
	 *	Edit jadwal
	 */
	public function edit(){
		$data['title'] = "Edit Jadwal";
		$this->load->view("template/header", $data);
		$this->load->view("template/header_bar", $data);
		$this->load->view("edit_jadwal", $data);
		$this->load->view("template/footer", $data);
	}

}

?>