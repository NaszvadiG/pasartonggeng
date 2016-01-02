<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->_cek_login();
	}
	private function _cek_login()
	{
		if(!$this->session->userdata('useradmin')){            
			redirect(base_url().'backend');
		}
	}

	public function index()
	{
		$data = array(
			'nama' => $this->session->userdata('nama'),	
			'status' => 'baru',
			'kategori' => '',
			'id_kat' => '',
			'tgl_input_kat' => '',
			'data_kategori' => $this->model->GetKat("order by id_kat desc")->result_array(),
		);

		$this->load->view('kategori/data_kategori', $data);
	}

	function editkategori($kode = 0){		
		$tampung = $this->model->GetKat("where id_kat = '$kode'")->result_array();
		$data = array(
			'nama' => $this->session->userdata('nama'),	
			'status' => 'lama',
			'tgl_input_kat' => $tampung[0]['tgl_input_kat'],
			'kategori' => $tampung[0]['kategori'],
			'id_kat' => $tampung[0]['id_kat'],
			'data_kategori' => $this->model->GetKat("where id_kat != '$kode' order by id_kat desc")->result_array()
			);
		$this->load->view('kategori/data_kategori', $data);
	}

	function savedata(){
		if($_POST){
			$status = $_POST['status'];
			$id_kat = $_POST['id_kat'];
			$kategori = $_POST['kategori'];
			$tgl_input_kat = $_POST['tgl_input_kat'];
			if($status == "baru"){
				$data = array(
					'id_kat' => $id_kat,
					'kategori' => $kategori,
					'tgl_input_kat' => date("Y-m-d H:i:s"),
					);
				$result = $this->model->Simpan('tb_kategori', $data);
				if($result == 1){
					$this->session->set_flashdata("sukses", "<div class='alert alert-success'><strong>Simpan data BERHASIL dilakukan</strong></div>");
					header('location:'.base_url().'kategori');
				}else{
					$this->session->set_flashdata("alert", "<div class='alert alert-danger'><strong>Simpan data GAGAL di lakukan</strong></div>");
					header('location:'.base_url().'kategori');
				}
			}else{
				$data = array(
					'kategori' => $kategori
					);
				$result = $this->model->Update('tb_kategori', $data, array('id_kat' => $id_kat));
				if($result == 1){
					$this->session->set_flashdata("sukses", "<div class='alert alert-success'><strong>Update data BERHASIL dilakukan</strong></div>");
					header('location:'.base_url().'kategori');
				}else{
					$this->session->set_flashdata("alert", "<div class='alert alert-danger'><strong>Update data GAGAL di lakukan</strong></div>");
					header('location:'.base_url().'kategori');
				}
			}
		}else{
			echo('handak baapa nyawa tong!!!');
		}
	}

	function hapuskat($kode = 1){
		
		$result = $this->model->Hapus('tb_kategori', array('id_kat' => $kode));
		if($result == 1){
			$this->session->set_flashdata("sukses", "<div class='alert alert-success'><strong>Hapus data BERHASIL dilakukan</strong></div>");
			header('location:'.base_url().'kategori');
		}else{
			$this->session->set_flashdata("alert", "<div class='alert alert-danger'><strong>Hapus data GAGAL di lakukan</strong></div>");
			header('location:'.base_url().'kategori');
		}
	}
}

// Developed by Muhammad Ridho
// Email: kenduanything23@gmail.com
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */