<?php
	
	//untuk handle API

	class user extends CI_Controller{

		public function __construct(){
			parent::__construct();   

			//load model database user
			$this->load->model('user_model');
			$this->load->library('session');
			$this->load->model('jadwal_model');
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

				$username = $this->session->userdata("username");
				$data['username'] = $username;

				$data_user = $this->user_model->select_user($username);

				$data['jadwal_senin'] = "";
				$data['jadwal_selasa'] = "";
				$data['jadwal_rabu'] = "";
				$data['jadwal_kamis'] = "";
				$data['jadwal_jumat'] = "";
				$data['jadwal_sabtu'] = "";
				$data['jadwal_minggu'] = "";

				foreach($this->jadwal_model->select_by_user($data_user->user_id) as $data_jadwal){
					$j_nama = $data_jadwal->nama_jadwal;
					$j_jam_mulai = $data_jadwal->jam_mulai;
					$j_jam_akhir = $data_jadwal->jam_akhir;

					$tampil_jadwal = "<div class='jadwal-content'>
										<span class='jadwal-judul'>".$j_nama."</span><br/>
										<span class='jadwal-waktu'>".$j_jam_mulai."-".$j_jam_akhir."</span><br/>
										<span class='jadwal-menu'>edit | copy</span><br/>
									  </div>";

					switch ($data_jadwal->hari) {
						case 1:
							$data['jadwal_senin'] .= $tampil_jadwal;
							break;
						case 2:
							$data['jadwal_selasa'] .= $tampil_jadwal;
							break;
						case 3:
							$data['jadwal_rabu'] .= $tampil_jadwal;
							break;
						case 4:
							$data['jadwal_kamis'] .= $tampil_jadwal;
							break;
						case 5:
							$data['jadwal_jumat'] .= $tampil_jadwal;
							break;
						case 6:
							$data['jadwal_sabtu'] .= $tampil_jadwal;
							break;
						case 7:
							$data['jadwal_minggu'] .= $tampil_jadwal;
							break;
					}

				};

				

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
				$username = $this->session->userdata("username");
				$data['username'] = $username;

				//data yang ditampilkan di halaman edit
				$data_pengguna = $this->user_model->select_user($username);

				$data['bio'] = $data_pengguna->bio;

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