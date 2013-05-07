<?php 

class jadwal extends CI_Controller {

	public function index()
	{
		

		$data['title'] = 'jadwal';

		//menampilkan view
		$this->load->view('template/header', $data);

		echo "coba kawan";

		$this->load->view('template/footer', $data);

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
	}

}

?>