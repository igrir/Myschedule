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
}

?>