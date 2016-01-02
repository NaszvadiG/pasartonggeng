<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->_cek_login();
		$this->load->helper('currency_format_helper');
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
			'data_produk' => $this->model->GetProdukKatMerko("order by id_produk desc")->result_array(),
		);

		$this->load->view('produk/data_produk', $data);
	}

	function addproduk()
	{
		$data = array(
			'nama' => $this->session->userdata('nama'),	
			'optkategori' => $this->model->GetKat()->result_array(),
			'optmerk' => $this->model->GetMerk()->result_array(),
		);
		
		$this->load->view('produk/add_produk', $data);
	}

	function savedata(){
		$config = array(
			'upload_path' => './assets/upload',
			'allowed_types' => 'gif|jpg|JPG|png',
			'max_size' => '2048',

		);
		$this->load->library('upload', $config);	
		$this->upload->do_upload('file_upload');
		$upload_data = $this->upload->data();

		$id_produk = '';
		$judul = $_POST['judul'];
		$harga = $_POST['harga'];		
		$jumlah = $_POST['jumlah'];
		$kondisi = $_POST['kondisi'];
		$id_merk = $_POST['id_merk'];
		$id_kat = $_POST['id_kat'];
		$status = $_POST['status'];
		$ket = $_POST['ket'];
		$tgl_input_pro = $_POST['tgl_input_pro'];
		$file_name = $upload_data['file_name'];

		$data = array(	
			'id_produk'=> $id_produk,
			'judul' => $judul,
			'harga' => $harga,
			'jumlah' => $jumlah,
			'kondisi' => $kondisi,
			'id_merk' => $id_merk,
			'id_kat' => $id_kat,
			'status' => $status,
			'ket' => $ket,
			'tgl_input_pro' => date("Y-m-d H:i:s"),
			'foto' => $file_name,
			);
		
		$result = $this->model->Simpan('tb_produk', $data);
		if($result == 1){
			$this->session->set_flashdata("sukses", "<div class='alert alert-success'><strong>Simpan data BERHASIL dilakukan</strong></div>");
			header('location:'.base_url().'produk');
		}else{
			$this->session->set_flashdata("alert", "<div class='alert alert-danger'><strong>Simpan data GAGAL di lakukan</strong></div>");
			header('location:'.base_url().'produk');
		}		
	}

	function editproduk($kode = 0){
		$data_produk = $this->model->GetProduk("where id_produk = '$kode'")->result_array();

		/*menjadikan kategori ke array*/
		$kategori_post_array = array();
		foreach($this->model->GetProduk("where id_produk = '$kode'")->result_array() as $kat){
			$kategori_post_array[] = $kat['id_kat'];
		}

		$merk_post_array = array();
		foreach($this->model->GetProduk("where id_produk = '$kode'")->result_array() as $merk){
			$merk_post_array[] = $merk['id_merk'];
		}

		$data = array(
			'nama' => $this->session->userdata('nama'),	
			'id_produk' => $data_produk[0]['id_produk'],
			'judul' => $data_produk[0]['judul'],
			'harga' => $data_produk[0]['harga'],
			'jumlah' => $data_produk[0]['jumlah'],
			'status' => $data_produk[0]['status'],
			'ket' => $data_produk[0]['ket'],
			'foto' => $data_produk[0]['foto'],
			'tgl_input_pro' => $data_produk[0]['tgl_input_pro'],
			'status' => $data_produk[0]['status'],
			'kategori' => $this->model->GetKat()->result_array(),
			'merk' => $this->model->GetMerk()->result_array(),
			'label_post' => $kategori_post_array,
			'merk_post' => $merk_post_array,
			);
		$this->load->view('produk/edit_produk', $data);
	}

	function updateproduki(){
		$config = array(
			'upload_path' => './assets/upload',
			'allowed_types' => 'gif|jpg|JPG|png',
			'max_size' => '2048',

		);
		$this->load->library('upload', $config);	
		$this->upload->do_upload('file_upload');
		$upload_data = $this->upload->data();
		$file_name = $upload_data['file_name'];

		$data = array(
			'id_produk' => $this->input->post('id_produk'),
			'judul' => $this->input->post('judul'),
			'harga' => $this->input->post('harga'),
			'jumlah' => $this->input->post('jumlah'),
			'kondisi' => $this->input->post('kondisi'),
			'id_merk' => $this->input->post('id_merk'),
			'id_kat' => $this->input->post('id_kat'),
			'tgl_input_pro' => $this->input->post('tgl_input_pro'),
			'status' => $this->input->post('status'),
			'ket' => $this->input->post('ket'),

			'foto' => $file_name,
			        
			);

		$res = $this->model->UpdateProduk($data);
		if($res>=0){
			$this->session->set_flashdata("sukses", "<div class='alert alert-success'><strong>Update data BERHASIL di lakukan</strong></div>");
			header('location:'.base_url().'produk');
		}else{
			$this->session->set_flashdata("alert", "<div class='alert alert-danger'><strong>Update data GAGAL di lakukan</strong></div>");
			header('location:'.base_url().'produk');
		}
	}

	function hapuspro($kode = 1){
		
		$result = $this->model->Hapus('tb_produk', array('id_produk' => $kode));
		if($result == 1){
			$this->session->set_flashdata("sukses", "<div class='alert alert-success'><strong>Hapus data BERHASIL dilakukan</strong></div>");
			header('location:'.base_url().'produk');
		}else{
			$this->session->set_flashdata("alert", "<div class='alert alert-danger'><strong>Hapus data GAGAL di lakukan</strong></div>");
			header('location:'.base_url().'produk');
		}
	}

	function updateproduk(){
		if($_FILES['file_upload']['error'] == 0):
			$config = array(
				'upload_path' => './assets/upload',
				'allowed_types' => 'gif|jpg|JPG|png',
				'max_size' => '2048',
				
				);
		$this->load->library('upload', $config);      
		$this->upload->do_upload('file_upload');
		$upload_data = $this->upload->data();
		$file_name = $upload_data['file_name'];
		else:
			$file_name = $this->input->post('foto');
		endif;
		
		$data = array(
			'id_produk' => $this->input->post('id_produk'),
			'judul' => $this->input->post('judul'),
			'harga' => $this->input->post('harga'),
			'jumlah' => $this->input->post('jumlah'),
			'kondisi' => $this->input->post('kondisi'),
			'id_merk' => $this->input->post('id_merk'),
			'id_kat' => $this->input->post('id_kat'),
			'tgl_input_pro' => $this->input->post('tgl_input_pro'),
			'status' => $this->input->post('status'),
			'ket' => $this->input->post('ket'),
			
			'foto' => $file_name,
			
			);
		
		$res = $this->model->UpdateProduk($data);
		if($res>=0){
			$this->session->set_flashdata("sukses", "<div class='alert alert-success'><strong>Update data BERHASIL di lakukan</strong></div>");
			header('location:'.base_url().'produk');
		}else{
			$this->session->set_flashdata("alert", "<div class='alert alert-danger'><strong>Update data GAGAL di lakukan</strong></div>");
			header('location:'.base_url().'produk');
		}
	}

	public function simpan(){
		$id['kode']=$this->input->post('id',TRUE);
		$data_array = $this->add_data(array('kode','nip','jenisarsip','tanggal','titel','deskripsi',
			'kodearsip','lokasifisik','catatan'),TRUE);

                // kita cek dulu dengan kode error 4
		if ( ! in_array(4, $_FILES['lampiran']['error'])) {
            // jika file tidak kosong tambahkan file gambar
            //$file1 = array();
			if($this->input->post('dok') == !NULL){
				$file1 = $this->upload($_FILES['lampiran']['name']);
				$file2 = $this->input->post('dok');
				$lampiran = $file1.'*'.$file2;
				$file['lampiran'] = $lampiran;
			}else{
				$file1 = $this->upload($_FILES['lampiran']['name']);
				$file['lampiran'] = $file1;
			}
		}else{
			$file['lampiran'] = $this->input->post('dok');
		}

		if($this->input->post(NULL,TRUE)==TRUE){
			$data = array_merge($data_array,$file);
			if($id['kode'] == false or $id['kode']==null){
                                //print_r($_POST); die();
				$this->model_home->tambah_data('tbl_arsip_kegiatan',$data);
				$this->pesan('pesan','Berhasil Menyimpan Data');
				redirect(base_url().'arsip_kegiatan/tambah');
			}else{

				$this->model_home->update_data($id,'tbl_arsip_kegiatan',$data);
				$this->pesan('pesan','Berhasil Mengubah Data');
				redirect(base_url().'arsip_kegiatan/tambah');

			}
		}
	}

}

// Developed by Muhammad Ridho
// Email: kenduanything23@gmail.com
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */