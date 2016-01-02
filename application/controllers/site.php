<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('currency_format_helper');
	}

	public function index($offset=0)
	{
		$this->countervisitor();
		/* Pagination */
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url().'site/index';
		$config['total_rows'] = $this->model->count_all();
		$config['per_page'] = 6;

		/*============================== ambil query database ==================*/
		$data['data_produk']=$this->model->GetProduk("where tb_produk.status = 'publish' group by tb_produk.id_produk order by tb_produk.id_produk desc limit ".$config['per_page']." offset ".$offset)->result_array();
		$data['rekomen'] = $this->model->GetProduk("where status = 'publish' order by rand() limit 3")->result_array();
		/*======================================================================*/

                // CSS Bootstrap               
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';            
		$config['prev_link'] = '«';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '»';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
                // Akhir CSS

		$config["num_links"] = round( $config["total_rows"] / $config["per_page"] );           
		$this->pagination->initialize($config);
		$data['pages'] = $this->pagination->create_links();

		$datas = array(
			"sidebar" => $this->sidebar_kat(),
			"produk"=>$this->load->view('incsite/produk',$data, TRUE),
			// "total_kat" => $this->model->GetKat('where id_kat')->num_rows(),
			// "rekomen" => $this->model->GetProduk("where status = 'publish' order by rand() limit 6")->result_array(),

			);
		$this->load->view('site/index', $datas);
	}

	function sidebar_kat(){
		$data = array(
			"total_kat" => $this->model->TotalKat('')->result_array(),
			"total_merk" => $this->model->GetProduk('group by id_merk')->num_rows(),
			"kategoriq" => $this->model->GetKat()->result_array(),
			"merk" => $this->model->GetMerk()->result_array(),
			);
		return $this->load->view("incsite/sidebar", $data, TRUE);
	}

	function detail($id_produk = '', $kode = 0)
	{
		$this->countervisitor();
		$data['data_produk']=$this->model->GetDetailProduk("where tb_produk.id_produk='$kode'")->result_array();

		// $data_content =  $this->blog_model->GetContentBlog("where content.kode_content = '$kode'")->result_array();
		$datas = array(
			"sidebar" => $this->sidebar_kat(),
			"detail_produks"=>$this->load->view('incsite/detail_produk',$data, TRUE),
			// "rekomen" => $this->model->GetProduk("where status = 'publish' order by rand() limit 6")->result_array(),

			);
		$this->cookiesetter($kode);
		$this->load->view('site/detail', $datas);
	}

	function kategori($id, $offset=0)
	{
		$this->countervisitor();
		$config['uri_segment'] = 4;
		$config['base_url'] = base_url().'site/kategori/'.$id;
		$config['total_rows'] = $this->model->count_all();
		$config['per_page'] = 6;

		$cek = $this->model->GetKat("where id_kat = '$id'");
		if ($cek->num_rows() > 0) {
			$data = array(
				"data_produk" => $this->model->GetProduk("where tb_produk.status = 'publish' and id_kat = '$id' limit ".$config['per_page']." offset ".$offset)->result_array(),
				"rekomen" => $this->model->GetProduk("where status = 'publish' order by rand() limit 3")->result_array(),
				);

		 // CSS Bootstrap               
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';            
			$config['prev_link'] = '«';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '»';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
                // Akhir CSS

			$config["num_links"] = round( $config["total_rows"] / $config["per_page"] );           
			$this->pagination->initialize($config);
			$data['pages'] = $this->pagination->create_links();

			$datas = array(
				"sidebar" => $this->sidebar_kat(),
				"produk"=>$this->load->view('incsite/produk',$data, TRUE),
			// "rekomen" => $this->model->GetProduk("where status = 'publish' order by rand() limit 6")->result_array(),

				);
			$this->load->view('site/kategori', $datas);
		}

	}

	function merk($id, $offset=0)
	{
		$this->countervisitor();
		$config['uri_segment'] = 4;
		$config['base_url'] = base_url().'site/merk/'.$id;
		$config['total_rows'] = $this->model->count_all();
		$config['per_page'] = 6;

		$cek = $this->model->GetMerk("where id_merk = '$id'");
		if ($cek->num_rows() > 0) {
			$data = array(
				"data_produk" => $this->model->GetProduk("where tb_produk.status = 'publish' and id_merk = '$id' limit ".$config['per_page']." offset ".$offset)->result_array(),
				"rekomen" => $this->model->GetProduk("where status = 'publish' order by rand() limit 3")->result_array(),
				);

		 // CSS Bootstrap               
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';            
			$config['prev_link'] = '«';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '»';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
                // Akhir CSS

			$config["num_links"] = round( $config["total_rows"] / $config["per_page"] );           
			$this->pagination->initialize($config);
			$data['pages'] = $this->pagination->create_links();

			$datas = array(
				"sidebar" => $this->sidebar_kat(),
				"produk"=>$this->load->view('incsite/produk',$data, TRUE),
			// "rekomen" => $this->model->GetProduk("where status = 'publish' order by rand() limit 6")->result_array(),

				);
			$this->load->view('site/index', $datas);
		}

	}

	private function cookiesetter($kode = 0){
		if(!isset($_COOKIE[$kode])){
			$content = $this->model->GetProduk("where id_produk = '$kode'")->result_array();
			$result = $this->model->Update('tb_produk',array('counter' => ($content[0]['counter']+1)),array('id_produk'=>$kode));
			if($result == 1){
				setcookie($kode,"http://pasartungging.id.ai", time()+3600);
			}
		}
	}

	private function countervisitor(){

		if($this->agent->is_browser()){
			$agent = $this->agent->browser().' '.$this->agent->version();
		}elseif ($this->agent->is_robot()){
			$agent = $this->agent->robot();
		}elseif ($this->agent->is_mobile()){
			$agent = $this->agent->mobile();
		}else{
			$agent = 'Unidentified User Agent';
		}
		
		$data_visitor = $this->model->GetVisitor("where ip = '".$_SERVER['REMOTE_ADDR']."'")->result_array();
		if($data_visitor == NULL){
			$data = array(
				'ip' => $_SERVER['REMOTE_ADDR'],
				'os' => $this->agent->platform(),
				'browser' => $agent,
				'tanggal' => date("Y-m-d H:i:s")
			);
			$this->model->Simpan('tb_visitor',$data);
			$this->session->set_userdata('pasartungging',"Ridho");
			setcookie("pasartungging",'Ridho', time()+3600*24);
		}else{
			if(!isset($_COOKIE['pasartungging'])){
				$data_visitor = $this->model->GetVisitor("where ip = '".$_SERVER['REMOTE_ADDR']."' and tanggal = '".date("Y-m-d H:i:s")."'");
				if($data_visitor != NULL){
					if(!$this->session->userdata('pasartungging.com')){
						$data = array(
							'ip' => $_SERVER['REMOTE_ADDR'],
							'os' => $this->agent->platform(),
							'browser' => $agent,
							'tanggal' => date("Y-m-d H:i:s")
						);
						$this->model->Simpan('tb_visitor', $data);
						$this->session->set_userdata('pasartungging',"Ridho");
						setcookie("pasartungging",'Ridho', time()+3600*24);
					}else{
						setcookie("pasartungging",'Ridho', time()+3600*24);
					}
				}else{
					$data = array(
							'ip' => $_SERVER['REMOTE_ADDR'],
							'os' => $this->agent->platform(),
							'browser' => $agent,
							'tanggal' => date("Y-m-d H:i:s")
					);
					$this->model->Simpan('tb_visitor', $data);
					$this->session->set_userdata('pasartungging',"Ridho");
					setcookie("pasartungging",'Ridho', time()+3600*24);
				}
			}
		}
	}


}

/* End of file site.php */
/* Location: ./application/controllers/site.php */