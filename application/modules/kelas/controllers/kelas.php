<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelas extends MX_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_kelas');
        $this->load->helper();
    }
    
    public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('txt_cari');
			
			if(empty($cari)){
				$where = ' ';
				$kata = $this->session->userdata('cari');
			}else{
				$sess_data['cari'] = $this->input->post("txt_cari");
				$this->session->set_userdata($sess_data);
				$cari = $this->session->userdata('cari');
				$where = " WHERE kd_kelas LIKE '%$cari%' OR kelas LIKE '%$cari%'";
				
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM kelas $where ";		
			$tot_hal = $this->mdl_kelas->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'kelas';
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
			

			$text = "SELECT * FROM kelas $where 
					ORDER BY kd_kelas ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->mdl_kelas->manualQuery($text);
			
			
			$d['content'] = $this->load->view('kelas/view_kelas', $d, true);		
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

			$d['judul']="Data Kelas";
                        $tgl	= date('d-m-Y');
			
			$d['kd_kelas']	='';
			$d['kelas']	='';
			$d['thn_ajaran']='';
                        $d['wali_kelas']='';
                        
			
			
			$d['content'] = $this->load->view('kelas/form_kelas', $d, true);		
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
			
			$d['judul'] = "Data Kelas";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM kelas WHERE kd_kelas='$id'";
			$data = $this->mdl_kelas->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					
                                        $d['kd_kelas']	   =$id;
                                        $d['kelas']	   =$db->kelas;
                                        $d['thn_ajaran']  =$db->thn_ajaran;
                                       $d['wali_kelas']   =$db->wali_kelas;
                                       
				}
			}else{
					$d['kd_kelas']	   =$id;
                                        $d['kelas']	   ='';
                                        $d['thn_ajaran']   ='';
                                        $d['wali_kelas']   ='';
                                        
                                        
			}
						
			$d['content'] = $this->load->view('kelas/form_kelas', $d, true);		
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
			$this->mdl_kelas->manualQuery("DELETE FROM kelas WHERE kd_kelas='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."kelas'>";			
		}else{
                    redirect('login');
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                                
                                        $up['kd_kelas']	   =$this->input->post('kd_kelas');
                                        $up['kelas']	   =$this->input->post('kelas');
                                        $up['thn_ajaran']  =$this->input->post('thn_ajaran');
                                        $up['wali_kelas']  =$this->input->post('wali_kelas');
                                        
                                        
				$id['kd_kelas']=$this->input->post('kd_kelas');
				
				$data = $this->mdl_kelas->getSelectedData("kelas",$id);
				if($data->num_rows()>0){
					$this->mdl_kelas->updateData("kelas",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->mdl_kelas->insertData("kelas",$up);
					echo 'Simpan data Sukses';		
				}
		}else{
                    redirect('login');
		}
	
	}
	
    public function InfoKelas()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kode = $this->input->post('kd_kelas');
			$text = "SELECT * FROM kelas WHERE kd_kelas ='$kode'";
			$tabel = $this->mdl_kelas->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['kd_kelas']	   =$t->kd_kelas;
                                        $data['kelas']              =$t->kelas;
                                        $data['thn_ajaran']	   =$t->thn_ajaran;
                                        $data['wali_kelas']	   =$t->wali_kelas;
                                        
                                        
					echo json_encode($data);
				}
			}else{
				$data['kd_kelas']	   ='';
                                $data['kelas']	   ='';
                                $data['thn_ajaran']	   ='';
                                $data['wali_kelas'] ='';
                               
				echo json_encode($data);
			}
		}else{
                    redirect('login');
		}
	}
  public function DataWali(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari= $this->input->post('cari');
			if(empty($cari)){
				$text = "SELECT * FROM staff WHERE jabatan ='guru'";
			}else{
				$text = "SELECT * FROM staff WHERE nip LIKE '%$cari%' OR nama LIKE '%$cari%'";
			}
			$d['data'] = $this->mdl_kelas->manualQuery($text);
			
			$this->load->view('data_wali',$d);
		}else{
                    redirect('login');
		}
	} 
        
         public function InfoWali()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kode = $this->input->post('nip');
			$text = "SELECT * FROM staff WHERE nip ='$kode'";
			$tabel = $this->mdl_guru->manualQuery($text);
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
}

