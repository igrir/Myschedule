<?php 

class jadwal extends CI_Controller {
	
	function __construct(){
		parent :: __construct();
			$this->load->helper('url'); 
			$this->load->model('jadwal_model');
			$this->load->model('user_model');
			$this->load->library('session');

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

		//mengecek login
		if ($this->session->userdata('LOGGED_IN')) {
			$username = $this->session->userdata("username");
			$data['username'] = $username;

			$this->load->view("template/header", $data);
			$this->load->view("template/header_bar", $data);
			$this->load->view("tambah_jadwal", $data);
			$this->load->view("template/footer", $data);
			$this->load->model('jadwal_model');
			//$this->jadwal_model->insert_jadwal($data);
		}
	}

	/*
	 *  PAGE
	 *
	 *	Edit jadwal
	 */
	public function edit(){
		$data['title'] = "Edit Jadwal";

		$id_jadwal = $this->uri->segment(3);

		if ($this->session->userdata('LOGGED_IN')) {
			$username = $this->session->userdata("username");
			$data['username'] = $username;
			
			$datauser = $this->user_model->select_user($username);
			$datajadwal = $this->jadwal_model->select_by_id($id_jadwal);
			
			//cek dulu apakah user bersangkutan memiliki id jadwal tersebut
			//ini mencegah user lain mengedit jadwal si user tadi
			if ($datajadwal->user_id == $datauser->user_id) {

				$data['nama_jadwal'] = $datajadwal->nama_jadwal;
				$data['jam_mulai'] = $datajadwal->jam_mulai;
				$data['jam_akhir'] = $datajadwal->jam_akhir;

				$this->load->view("template/header", $data);
				$this->load->view("template/header_bar", $data);
				$this->load->view("edit_jadwal", $data);
				$this->load->view("template/footer", $data);
			}
			

			
		}
	}

	/*
	 *  ACTION
	 *
	 *	Tambah jadwal
	 */
	public function add_jadwal(){

		//mengecek login
		if ($this->session->userdata('LOGGED_IN')) {
			$username = $this->session->userdata("username");
			$data['username'] = $username;

			$data_user = $this->user_model->select_user($username);


			$jam_mulai = $this->input->post('jam_mulai');
			$jam_akhir = $this->input->post('jam_akhir');



			$data_jadwal = array('user_id'=>$data_user->user_id,
								 'nama_jadwal'=>$this->input->post('nama_jadwal'),
								 'hari'=>$this->input->post('hari'),
								 'jam_mulai'=>$jam_mulai,
								 'jam_akhir'=>$jam_akhir);


			$this->jadwal_model->insert_jadwal($data_jadwal);

			redirect('user');
		}
	}


}

?>