
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {	

	public function __construct()
	{
		parent::__construct();
		
	}

	function proses_login(){
		
        //set variabel
		$nama_user = $this->input->post('nama_user');
		$nama = $this->input->post('nama');
		$pass_user=($_POST['pass_user']);
		
        //ambil database
		$query = $this->db->query("Select * from tb_login Where nama_user = '$nama_user' and (pass_user = '$pass_user' or nama = '$nama')");
		if ($query->num_rows() > 0){
			
			$row = $query->row();
			$id_user = $row->id_user;
			$pass_user = $row->pass_user;
			$nama = $row->nama;
			$level=$row->level;
			$status=$row->status;
			
			if ($pass_user==$pass_user AND $status==1){
                //ambil nama
				$q="SELECT * FROM tb_login where id_user='".$id_user."'";
				$bidang=$this->db->query($q)->row();
				$c='";s:1:"';
				$sql="SELECT * FROM ci_sessions WHERE user_data LIKE '%id_user".$c.$id_user."%'";
				$cek=$this->db->query($sql)->num_rows();
				// if($cek==0){

					$this->session->set_userdata('id_user',$id_user);
					$this->session->set_userdata('nama',$nama);
					if($level==1){

						$this->session->set_userdata('usersap',$id_user, $nama);
						redirect(base_url()."usersap");
					}
					elseif($level==2){
                            $this->session->set_userdata('logistik',$id_user);
                            redirect(base_url()."logistik");
                    }

                    elseif($level==3){
                            $this->session->set_userdata('pengadaan',$id_user);
                            redirect(base_url()."pengadaan");
                    }

                    elseif($level==4){
                            $this->session->set_userdata('userbag',$id_user);
                            redirect(base_url()."userbag");
                    }

                    elseif($level==5){
                            $this->session->set_userdata('sekretariat',$id_user);
                            redirect(base_url()."sekretariat");
                    }

                    elseif($level==6){
                            $this->session->set_userdata('keuangan',$id_user);
                            redirect(base_url()."keuangan");
                    }

                    elseif($level==7){
                            $this->session->set_userdata('inventori',$id_user);
                            redirect(base_url()."inventori");
                    }

					else{

						$this->session->set_userdata('enjinering',$id_user);
						redirect(base_url()."enjinering");
					}
					
				// }
				// else{

				// 	$info='<div class="warning-valid">NAMA PENGGUNA DAN PASSWORD ANDA SEDANG DI GUNAKAN</div>';
				// 	$this->session->set_userdata('info',$info);
				// 	redirect(base_url().'login');
				// }
			}
			
			else{
				$info='<div style="color:red">AKUN YANG ANDA GUNAKAN BELUM DI VERIFIKASI ADMIN</div>';
				$this->session->set_userdata('info',$info);

				redirect(base_url().'login');
			}
		}
		else{
			$info='<div style="color:red">PERIKSA KEMBALI NAMA PENGGUNA DAN PASSWORD ANDA!</div>';
			$this->session->set_userdata('info',$info);

			redirect(base_url().'login');
		}       
	}

	function proses_loginbeta(){
		
        //set variabel
		$nama_user = addslashes($_POST['nama_user']);
		$pass_user = addslashes($_POST['pass_user']);
		
        //ambil database
		$temp = $this->buku_model->GetUser("WHERE nama_user = '$nama_user' AND pass_user = '$pass_user'")->result_array();
		$query = $this->db->query("Select * from tb_login Where nama_user = '$nama_user' and (pass_user = '$pass_user' or nama = '$nama')");
		if ($query->num_rows() > 0 && $temp != NULL){
			
			$data = array(
				'id_user' => $temp[0]['id_user'],
				'nama' => $temp[0]['nama'],
				'pass_user' => $temp[0]['pass_user'],
				'nama_user' => $temp[0]['nama_user'],
				'level' => $temp[0]['level'],
				'status' => $temp[0]['status']
				);

			$row = $query->row();
			$id_user = $row->id_user;
			$pass_user = $row->pass_user;
			$nama = $row->nama;
			$level=$row->level;
			$status=$row->status;
			
			if ($pass_user==$pass_user AND $status==1){
                //ambil nama
				$q="SELECT * FROM tb_login where id_user='".$id_user."'";
				$bidang=$this->db->query($q)->row();
				$c='";s:1:"';
				$sql="SELECT * FROM ci_sessions WHERE user_data LIKE '%id_user".$c.$id_user."%'";
				$cek=$this->db->query($sql)->num_rows();
				// if($cek==0){

				$this->session->set_userdata('id_user',$id_user);
				if($level==1){

					$this->session->set_userdata('usersap',$id_user, $data);
					redirect(base_url()."usersap");
				}
				elseif($level==2){
					$this->session->set_userdata('logistik',$id_user);
					redirect(base_url()."logistik");
				}

				elseif($level==3){
					$this->session->set_userdata('pengadaan',$id_user);
					redirect(base_url()."pengadaan");
				}

				elseif($level==4){
					$this->session->set_userdata('userbag',$id_user);
					redirect(base_url()."userbag");
				}

				elseif($level==5){
					$this->session->set_userdata('sekretariat',$id_user);
					redirect(base_url()."sekretariat");
				}

				elseif($level==6){
					$this->session->set_userdata('keuangan',$id_user);
					redirect(base_url()."keuangan");
				}

				elseif($level==7){
					$this->session->set_userdata('inventori',$id_user);
					redirect(base_url()."inventori");
				}

				else{

					$this->session->set_userdata('enjinering',$id_user);
					redirect(base_url()."enjinering");
				}

				// }
				// else{

				// 	$info='<div class="warning-valid">NAMA PENGGUNA DAN PASSWORD ANDA SEDANG DI GUNAKAN</div>';
				// 	$this->session->set_userdata('info',$info);
				// 	redirect(base_url().'login');
				// }
			}
			
			else{
				$info='<div style="color:red">AKUN YANG ANDA GUNAKAN BELUM DI VERIFIKASI ADMIN</div>';
				$this->session->set_userdata('info',$info);

				redirect(base_url().'login');
			}
		}
		else{
			$info='<div style="color:red">PERIKSA KEMBALI NAMA PENGGUNA DAN PASSWORD ANDA!</div>';
			$this->session->set_userdata('info',$info);

			redirect(base_url().'login');
		}       
	}
}

// /* End of file m_login.php */
// /* Location: ./application/models/m_login.php */