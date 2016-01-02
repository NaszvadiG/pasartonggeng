<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
			'total_product' => $this->model->GetProduk()->num_rows(),
			'product_view' => $this->model->GetProductView()->result_array(),
			'nama' => $this->session->userdata('nama'),	
		);
		
		$this->load->view('index', $data);
	}
}

// Developed by Muhammad Ridho
// Email: kenduanything23@gmail.com
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */