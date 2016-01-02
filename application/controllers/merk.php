<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merk extends CI_Controller {

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
			'merk' => '',
			'id_merk' => '',
			'tgl_input_merk' => '',
			'data_merk' => $this->model->GetMerk("order by id_merk desc")->result_array(),
		);

		$this->load->view('merk/data_merk', $data);
	}

	function editmerk($kode = 0){		
		$tampung = $this->model->GetMerk("where id_merk = '$kode'")->result_array();
		$data = array(
			'nama' => $this->session->userdata('nama'),	
			'status' => 'lama',
			'tgl_input_merk' => $tampung[0]['tgl_input_merk'],
			'merk' => $tampung[0]['merk'],
			'id_merk' => $tampung[0]['id_merk'],
			'data_merk' => $this->model->GetMerk("where id_merk != '$kode' order by id_merk desc")->result_array()
			);
		$this->load->view('merk/data_merk', $data);
	}

	function savedata(){
		if($_POST){
			$status = $_POST['status'];
			$id_merk = $_POST['id_merk'];
			$merk = $_POST['merk'];
			$tgl_input_merk = $_POST['tgl_input_merk'];
			if($status == "baru"){
				$data = array(
					'id_merk' => $id_merk,
					'merk' => $merk,
					'tgl_input_merk' => date("Y-m-d H:i:s"),
					);
				$result = $this->model->Simpan('tb_merk', $data);
				if($result == 1){
					$this->session->set_flashdata("sukses", "<div class='alert alert-success'><strong>Simpan data BERHASIL dilakukan</strong></div>");
					header('location:'.base_url().'merk');
				}else{
					$this->session->set_flashdata("alert", "<div class='alert alert-danger'><strong>Simpan data GAGAL di lakukan</strong></div>");
					header('location:'.base_url().'merk');
				}
			}else{
				$data = array(
					'merk' => $merk
					);
				$result = $this->model->Update('tb_merk', $data, array('id_merk' => $id_merk));
				if($result == 1){
					$this->session->set_flashdata("sukses", "<div class='alert alert-success'><strong>Update data BERHASIL dilakukan</strong></div>");
					header('location:'.base_url().'merk');
				}else{
					$this->session->set_flashdata("alert", "<div class='alert alert-danger'><strong>Update data GAGAL di lakukan</strong></div>");
					header('location:'.base_url().'merk');
				}
			}
		}else{
			echo('handak baapa nyawa tong!!!');
		}
	}

	function hapusmerk($kode = 1){
		
		$result = $this->model->Hapus('tb_merk', array('id_merk' => $kode));
		if($result == 1){
			$this->session->set_flashdata("sukses", "<div class='alert alert-success'><strong>Hapus data BERHASIL dilakukan</strong></div>");
			header('location:'.base_url().'merk');
		}else{
			$this->session->set_flashdata("alert", "<div class='alert alert-danger'><strong>Hapus data GAGAL di lakukan</strong></div>");
			header('location:'.base_url().'merk');
		}
	}
}

// Developed by Muhammad Ridho
// Email: kenduanything23@gmail.com
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */