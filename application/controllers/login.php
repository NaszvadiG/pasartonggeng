<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function index(){
		if ($this->session->userdata('dashboard') OR $this->session->userdata('kategori')) {
			redirect(base_url().'backend');
		}
		else{
			$db='m_login';
			$sub_data['info']=$this->session->userdata('info');
			if ($this->input->post('login')) {
				$this->form_validation->set_rules('nama_user','Nama Pengguna','trim|required|max_length[20]|xss_clean');
				$this->form_validation->set_rules('pass_user','Password','trim|required|max_length[20]|xss_clean');
				$this->form_validation->set_error_delimiters('<div class="warning-valid">','</div>');    
				if($this->form_validation->run()==TRUE){
					$this->$db->proses_login();
				}
			}
			// $data['body']=$this->load->view('v_login', $sub_data, TRUE);
			$this->load->view('login/login', $sub_data);

			$this->session->unset_userdata('info');       
		}
	}

	public function proseslog() {
		$data = array(
			'nama_user' => $this->input->post('nama_user', TRUE),
			'pass_user' => $this->input->post('pass_user', TRUE),
			);
		
		$hasil = $this->model->GetUser($data);
		if ($hasil->num_rows() == 1) {
			foreach ($hasil->result() as $sess) {
				// $sess_data['logged_in'] = 'Sudah Loggin';
				$sess_data['id_user'] = $sess->id_user;
				$sess_data['nama_user'] = $sess->nama_user;
				$sess_data['nama'] = $sess->nama;
				$sess_data['level'] = $sess->level;
				$sess_data['pass_user'] = $sess->pass_user;
				$this->session->set_userdata($sess_data);
			}
			if ($this->session->userdata('level')=='1') {
				$this->session->set_userdata('useradmin', $sess_data);
				redirect(base_url()."dashboard");
			}
			else{
				$this->session->set_userdata('pasartungging', $sess_data);
				redirect(base_url());
			}		
		}
		else {
			$info='<div style="color:red">PERIKSA KEMBALI NAMA PENGGUNA DAN PASSWORD ANDA!</div>';
			$this->session->set_userdata('info',$info);

			redirect(base_url().'login');
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'login');
	}
    // function register(){
    // 	$this->load->view('v_register');
    // }
}
