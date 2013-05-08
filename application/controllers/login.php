<?php
 
	class login extends CI_Controller{
		function __construct(){
			//membuat construktor;
			parent::__construct();
			//meload helper form dan url
			$this->load->helper(array('form','url'));
			//meload model login
			$this->load->model('user_model');
		}
  
		function index(){
			//membuat variable judul web yang ditampilkan sebagai judul browser
			$data['title'] = 'MY SCHEDULE';
			//membuat nama header yang ditampilkan pd form login
			$data['loginheader'] = 'Login';
			//membuat string gagal dimana nantinya digunakan untuk validasi
			$data['gagal'] = '';
			//meload view login
			$this->load->view('user_model',$data);
		}
  
		function cekuser(){
			//memanggil model login
			$data['query'] = $this->cek_username_password->cekdb();
			//mengecek isi dari model login
			if($data['query']==null){
				return false;
			}else{
				return $data['query'];
			}
		}
  
		function proseslogin(){
			//membuat variable judul web yang ditampilkan sebagai judul browser
			$data['title'] = 'MY SCHEDULE';
			//membuat nama header yang ditampilkan pd form login
			$data['loginheader'] = 'Login';
			//megecek isi dari fungsi cekuser diatas
			//jika data ada maka login berhasil
			if($this->cekuser()==true){
				//membuat variable logo yang nanti ditampilkan pd view
				$data['logo'] = 'MY SCHEDULE';
				//membuat variable account yang nanti ditampilkan pd view
				$data['username'] = 'Account: '.$this->input->post('username');
				//menyimpan data pada array
				$newdata = array(
					'username'=>$data['username'],
					'islogin'=>true
				);
				//membuat sesion
				$this->session->set_userdata($newdata);
				//menampilkan view home
				$this->load->view('v_home',$data);
			}else{
				//membuat validasi gagal yang ditampilkan pada form login
				$data['gagal'] = '<div id="notification">Maaf, Proses Login Gagal!<BR>1. Username atau Password anda salah.<BR>2. Coba periksa kembali keadaan <span class="red">Caps lock</span>.</div>';
				//memanggil view login
				$this->load->view('cek_username_password',$data);
			}
		}
  
		function logout(){
			//menghapus sesion
			$this->session->sess_destroy();
			//kembali ke form login
			redirect('login/index');  
		}
 
	}
?>