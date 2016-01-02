<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	//ambil data user
	function GetUser($data) {
        $query = $this->db->get_where('tb_login', $data);
        return $query;
    }

	//ambil data tabel kategori
	public function GetKat($where= "")
	{
		$data = $this->db->query('select * from tb_kategori '.$where);
		return $data;
	}

	//ambil data tabel merk
	public function GetMerk($where= "")
	{
		$data = $this->db->query('select * from tb_merk '.$where);
		return $data;
	}

	//ambil data tabel produk
	public function GetProduk($where= "")
	{
		$data = $this->db->query('select * from tb_produk '.$where);
		return $data;
	}

	public function GetTotProduk()
	{
		$data = $this->db->query('select * from tb_produk group by id_kat ');
		return $data;
	}

	public function GetDetailProduk($where = ""){
		return $this->db->query("select tb_merk.merk, tb_produk.*  from tb_produk inner join tb_merk on tb_merk.id_merk=tb_produk.id_merk $where;");
	}

	public function count_all() {
		return $this->db->count_all('tb_produk');
	}

	//ambil data dari 3 tabel
	public function GetProdukKatMerko($where= "") {
    $data = $this->db->query('SELECT p.*, q.kategori, c.merk
                                FROM tb_produk p
                                LEFT JOIN tb_kategori q
                                ON(p.id_kat = q.id_kat)
                                LEFT JOIN tb_merk c
                                ON(p.id_merk = c.id_merk)'.$where);
    return $data;
    }

	//batas crud data
	public function Simpan($table, $data){
		return $this->db->insert($table, $data);
	}

	public function Update($table,$data,$where){
		return $this->db->update($table,$data,$where);
	}

	public function Hapus($table,$where){
		return $this->db->delete($table,$where);
	}

	function UpdateProduk($data){
        $this->db->where('id_produk',$data['id_produk']);
        $this->db->update('tb_produk',$data);
    }
	//batas crud data

    //model untuk visitor/pengunjung
    function GetVisitor($where = ""){
		return $this->db->query("select * from tb_visitor $where");		
	}

	function GetProductView(){
		return $this->db->query("select sum(counter) as totalview from tb_produk where status = 'publish'");
	}
	//batas query pengunjung

	public function GetKate($where= "")
	{
		$data = $this->db->query('select count(*) as totalkategori from tb_kategori '.$where);
		return $data;
	}

	function TotalKat(){
		return $this->db->query("select count(*) as totalkategori from tb_produk group by id_kat; ");
	}
}

/* End of file model.php */
/* Location: ./application/models/model.php */