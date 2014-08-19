<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_admin');
        $this->load->helper();
    }
    
    public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('txt_cari');
			
			if(empty($cari)){
				$where = "WHERE jabatan ='admin'";
				$kata = $this->session->userdata('cari');
			}else{
				$sess_data['cari'] = $this->input->post("txt_cari");
				$this->session->set_userdata($sess_data);
				$cari = $this->session->userdata('cari');
				$where = " WHERE nip LIKE '%$cari%' OR nama LIKE '%$cari%'";
				
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Data Admin";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM staff $where ";		
			$tot_hal = $this->mdl_admin->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'admin';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['next_link'] = 'Lanjut &raquo;';
			$config['prev_link'] = '&laquo; Kembali';
			$config['last_link'] = '<b>Terakhir &raquo; </b>';
			$config['first_link'] = '<b> &laquo; Pertama</b>';
			$this->pagination->initialize($config);
			$d["paginator"] =$this->pagination->create_links();
			$d['hal'] = $offset;
			

			$text = "SELECT * FROM staff $where 
					ORDER BY nip ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->mdl_admin->manualQuery($text);
			
			
			$d['content'] = $this->load->view('admin/view_admin', $d, true);		
			$this->load->view('home/home',$d);
		}else{
                    redirect('login');
		}
	}
	
	public function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			$d['judul']="Data Admin";
                        $tgl	= date('d-m-Y');
			
			$d['nip']	='';
			$d['nama']	='';
			$d['tempat']	='';
			$d['tgl_lahir']	=$tgl;
			$d['jenkel']	='';
			$d['telpon']	='';
                        $d['email']	='';
                        $d['alamat']	='';
                        
			
			$d['content'] = $this->load->view('admin/form_admin', $d, true);		
			$this->load->view('home/home',$d);
		}else{
                    redirect('login');
		}
	}
	
	public function edit()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['judul'] = "Data Admin";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM staff WHERE nip='$id'";
			$data = $this->mdl_admin->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					
                                        $d['nip']	   =$id;
                                        $d['nama']	   =$db->nama;
                                        $d['tempat']	   =$db->tempat;
                                        $d['tgl_lahir'] =$this->mdl_admin->tgl_sql($db->tgl_lahir);
                                        $d['jenkel']	   =$db->jenkel;
                                        $d['telpon']   =$db->telpon;
                                        $d['email']     =$db->email;
                                        $d['alamat']    =$db->alamat;
                                        
				}
			}else{
					$d['nip']	   =$id;
                                        $d['nama']	   ='';
                                        $d['tempat']	   ='';
                                        $d['tgl_lahir'] ='';
                                        $d['jenkel']	   ='';
                                        $d['telpon']   ='';
                                        $d['email']     ='';
                                        $d['alamat']    ='';
                                        
			}
						
			$d['content'] = $this->load->view('admin/form_admin', $d, true);		
			$this->load->view('home/home',$d);
		}else{
                    redirect('login');
		}
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){			
			$id = $this->uri->segment(3);
			$this->mdl_admin->manualQuery("DELETE FROM staff WHERE nip='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."admin'>";			
		}else{
                    redirect('login');
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                                       $pass =$this->input->post('nip');
                                        $up['nip']	   =$this->input->post('nip');
                                        $up['nama']	   =$this->input->post('nama');
                                        $up['tempat']	   =$this->input->post('tempat');
                                        $up['tgl_lahir']   =$this->mdl_admin->tgl_sql($this->input->post('tgl_lahir'));
                                        $up['jenkel']	   =$this->input->post('jenkel');
                                        $up['telpon']   =$this->input->post('telpon');
                                        $up['email']     =$this->input->post('email');
                                        $up['alamat']    =$this->input->post('alamat');
                                        
                                        $up['username']	   =$this->input->post('nip');
                                        $up['password']	   =  md5($pass);
                                        $up['jabatan']	   ='admin';
				
				$id['nip']=$this->input->post('nip');
				
				$data = $this->mdl_admin->getSelectedData("staff",$id);
				if($data->num_rows()>0){
					$this->mdl_admin->updateData("staff",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->mdl_admin->insertData("staff",$up);
                                        
					echo 'Simpan data Sukses';		
				}
		}else{
                    redirect('login');
		}
	
	}
	
    public function InfoAdmin()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kode = $this->input->post('nip');
			$text = "SELECT * FROM staff WHERE nip ='$kode'";
			$tabel = $this->mdl_admin->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['nip']	   =$t->nip;
                                        $data['nama']	   =$t->nama;
                                        $data['tempat']	   =$t->tempat;
                                        $data['tgl_lahir'] =$t->tgl_lahir;
                                        $data['jenkel']	   =$t->jenkel;
                                        $data['telpon']   =$t->telpon;
                                        $data['email']     =$t->email;
                                        $data['alamat']    =$t->alamat;
                                        
					echo json_encode($data);
				}
			}else{
				$data['nip']	   ='';
                                $data['nama']	   ='';
                                $data['tempat']	   ='';
                                $data['tgl_lahir'] ='';
                                $data['jenkel']	   ='';
                                $data['telpon']   ='';
                                $data['email']     ='';
                                $data['alamat']    ='';
                                
				echo json_encode($data);
			}
		}else{
                    redirect('login');
		}
	}
        public function profil(){
            $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
            
                        $nip=  $this->session->userdata('nip');
                        
                        $d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			$d['judul']="Profil Administrasi"; 
                        
                        $text = "SELECT * FROM staff WHERE nip ='$nip'";
			$tabel = $this->mdl_admin->manualQuery($text);
			
			if($tabel->num_rows()>0){
				foreach($tabel->result() as $t){
					$d['nip']	   =$t->nip;
                                        $d['nama']	   =$t->nama;
                                        $d['username'] =$t->username;
                                        $d['password']=$t->password;
                                        $d['tempat']	   =$t->tempat;
                                        $d['tgl_lahir'] =$t->tgl_lahir;
                                        $d['jenkel']	   =$t->jenkel;
                                        $d['telpon']   =$t->telpon;
                                        $d['email']     =$t->email;
                                        $d['alamat']    =$t->alamat;
                                        
					
				}
			}else{
				$d['nip']	   ='';
                                $d['nama']	   ='';
                                $d['username'] ='';
                                $d['password']='';
                                $d['tempat']	   ='';
                                $d['tgl_lahir'] ='';
                                $d['jenkel']	   ='';
                                $d['telpon']   ='';
                                $d['email']     ='';
                                $d['alamat']    ='';
                                
				
			}
                        
                        $d['content'] = $this->load->view('admin/profile', $d, true);		
			$this->load->view('home/home',$d);
                        
                        }else{
                    redirect('login');
		}
        }
        public function editAdmin($nip){
            $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
            
            
                  $d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['judul'] = "Data Guru";
			
			
			$text = "SELECT * FROM staff WHERE nip='$nip'";
			$data = $this->mdl_admin->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					
                                        $d['nip']	   =$nip;
                                        $d['nama']	   =$db->nama;
                                        $d['username']      =$db->username;
                                        
                                        $d['tempat']	   =$db->tempat;
                                        $d['tgl_lahir'] =$this->mdl_admin->tgl_sql($db->tgl_lahir);
                                        $d['jenkel']	   =$db->jenkel;
                                        $d['telpon']   =$db->telpon;
                                        $d['email']     =$db->email;
                                        $d['alamat']    =$db->alamat;
                                        
				}
			}else{
					$d['nip']	   =$nip;
                                        $d['nama']	   ='';
                                        $d['tempat']	   ='';
                                        $d['tgl_lahir'] ='';
                                        $d['jenkel']	   ='';
                                        $d['telpon']   ='';
                                        $d['email']     ='';
                                        $d['alamat']    ='';
                                        
			}
						
			$d['content'] = $this->load->view('admin/edit_profil', $d, true);		
			$this->load->view('home/home',$d);
		 }else{
                    redirect('login');
		}
            
        }
        public function update(){
            
             $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
            
            $pass=  $this->input->post('password');
            if($pass==""){
                                        $id['nip']	   =$this->input->post('nip');
                                        $up['nama']	   =$this->input->post('nama');
                                        $up['tempat']	   =$this->input->post('tempat');
                                        $up['tgl_lahir']   =$this->mdl_admin->tgl_sql($this->input->post('tgl_lahir'));
                                        $up['jenkel']	   =$this->input->post('jenkel');
                                        $up['telpon']   =$this->input->post('telpon');
                                        $up['email']     =$this->input->post('email');
                                        $up['alamat']    =$this->input->post('alamat');
                                        $up['username']	   =$this->input->post('username');
                                        $this->mdl_admin->updateData("staff",$up,$id);
                                        echo 'berhasil di ubah';
                                        
            }  else {
                                        $id['nip']	   =$this->input->post('nip');
                                        $pass=  $this->input->post('password');
                                        $up['nama']	   =$this->input->post('nama');
                                        $up['tempat']	   =$this->input->post('tempat');
                                        $up['tgl_lahir']   =$this->mdl_admin->tgl_sql($this->input->post('tgl_lahir'));
                                        $up['jenkel']	   =$this->input->post('jenkel');
                                        $up['telpon']   =$this->input->post('telpon');
                                        $up['email']     =$this->input->post('email');
                                        $up['alamat']    =$this->input->post('alamat');
                                        $up['username']	   =$this->input->post('username');
                                        $up['password']	   =  md5($pass);
                                        $this->mdl_admin->updateData("staff",$up,$id);
                                        echo 'berhasil di ubah';
            }
            
             }else{
                    redirect('login');
		}
        }
}

