<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Absen extends MX_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_absen');
        $this->load->helper();
    }
    
    public function index()
	{
        
	}
	
	public function input1()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['judul'] = "Data Absen";
			
			$d['semester']=1;
			$d['base_url'] = site_url() . 'absen/absenGanjil';
                        
			$d['content'] = $this->load->view('form_input', $d, true);		
			$this->load->view('home/home',$d);
		}else{
                    redirect('login');
		}
	}
        public function input2()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['judul'] = "Data Absen";
			
			$d['semester']=2;
			$d['base_url'] = site_url() . 'absen/absenGenap';
                        
			$d['content'] = $this->load->view('form_input', $d, true);		
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
			
			$d['judul'] = "Data Absen";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM absen WHERE id='$id'";
			$data = $this->mdl_absen->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					
                                        $d['id']	   =$id;
                                        $d['kd_kls']	   =$db->kd_kls;
                                        $d['nis']	   =$db->nis;
                                   
                                        $d['semester']	   =$db->semester;
                                        $d['sakit']	   =$db->sakit;
                                        $d['ijin']	   =$db->ijin;
                                        $d['alpha']	   =$db->alpha;
                                        
				}
                      
			
			}
			
                        $text = "SELECT * FROM smstr";
			$d['l_smstr'] = $this->mdl_absen->manualQuery($text);
                        $d['jadwal']=  $this->uri->segment(3);
                  
			$d['content'] = $this->load->view('form_edit', $d, true);		
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
			$this->mdl_absen->manualQuery("DELETE FROM absen WHERE id='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."wali'>";			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                                
                                        $up['kd_kls']=$this->input->post('kd_kls');
                                        $up['nis']=$this->input->post('nis');
                                        $up['semester']=$this->input->post('semester');
                                       
                                        $up['sakit']=$this->input->post('sakit');
                                        $up['ijin'] =$this->input->post('ijin');
                                        $up['alpha']      =$this->input->post('alpha');
                                        
                                        
                                        
                                        
				$id['id']=$this->input->post('id');
				
				$data = $this->mdl_absen->getSelectedData("absen",$id);
				if($data->num_rows()>0){
					$this->mdl_absen->updateData("absen",$up,$id);
					echo 'Update data Sukses';
				}else{
				$this->mdl_absen->insertData("absen",$up);
					echo 'Simpan data Sukses';			
				}
		}else{
				redirect('login');
		}
	
	}
	
    public function InfoAbsen()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kode = $this->input->post('nis');
			$text = "SELECT * FROM absen WHERE nis ='$kode'";
			$tabel = $this->mdl_absen->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['nis']	   =$t->nis;
                                        $data['nama']	   =$t->nama;
                                        $data['tempat']	   =$t->tempat;
                                        $data['tgl_lahir'] =$t->tgl_lahir;
                                        $data['jenkel']	   =$t->jenkel;
                                        $data['jurusan']   =$t->jurusan;
                                        $data['kelas']     =$t->kelas;
                                        $data['alamat']    =$t->alamat;
                                        $data['thn_masuk'] =$t->thn_masuk;
                                        $data['wali_absen']=$t->wali_absen;
                                        $data['telpon_wali']=$t->telpon_wali;
					echo json_encode($data);
				}
			}else{
				$data['nis']	   ='';
                                $data['nama']	   ='';
                                $data['tempat']	   ='';
                                $data['tgl_lahir'] ='';
                                $data['jenkel']	   ='';
                                $data['jurusan']   ='';
                                $data['kelas']     ='';
                                $data['alamat']    ='';
                                $data['thn_masuk'] ='';
                                $data['wali_absen']='';
                                $data['telpon_wali']='';
				echo json_encode($data);
			}
		}else{
			redirect('login');
		}
	}
      public function tampilSiswa(){
          $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                        $id=$this->uri->segment(3);
                        $where="WHERE kelas='$id'";
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Data Siswa";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM siswa $where ";		
			$tot_hal = $this->mdl_absen->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'absen/';
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
			

			$text = "SELECT * FROM siswa $where";
					
					
			$d['data'] = $this->mdl_absen->manualQuery($text);
			$d['kd_jadwal']=  $this->uri->segment(4);
			
			$d['content'] = $this->load->view('absen/data_siswa', $d, true);		
			$this->load->view('home/home',$d);
                        
                        }else{
			redirect('login');
		}
      }
      
      
       public function DataSiswa($kls){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari= $this->input->post('cari');
			if(empty($cari)){
				$text = "SELECT * FROM siswa WHERE kelas='$kls'";
			}else{
				$text = "SELECT * FROM siswa WHERE nis LIKE '%$cari%' OR nama LIKE '%$cari%'";
			}
			$d['data'] = $this->mdl_absen->manualQuery($text);
			
			$this->load->view('ambil_siswa',$d);
		}else{
			redirect('login');
		}
	} 
        public function tampilAbsen(){
           
            $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
            
             
		
			$cari = $this->input->post('txt_cari');
			
			if(empty($cari)){
                                $id=$this->uri->segment(3);
				$where = "WHERE id_jadwal ='$id'";
				$kata = $this->session->userdata('cari');
			}else{
				$sess_data['cari'] = $this->input->post("txt_cari");
				$this->session->set_userdata($sess_data);
				$cari = $this->session->userdata('cari');
				$where = " WHERE nis LIKE '%$cari%' OR semester LIKE '%$cari%'";
				
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Absen Siswa";
			
			//paging
			$page=$this->uri->segment(4);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM absen $where ";		
			$tot_hal = $this->mdl_absen->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'absen/tampilAbsen';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 4;
			$config['next_link'] = 'Lanjut &raquo;';
			$config['prev_link'] = '&laquo; Kembali';
			$config['last_link'] = '<b>Terakhir &raquo; </b>';
			$config['first_link'] = '<b> &laquo; Pertama</b>';
			$this->pagination->initialize($config);
			$d["paginator"] =$this->pagination->create_links();
			$d['hal'] = $offset;
                        
			 

			
			$text = "SELECT * FROM absen $where 
					ORDER BY id_jadwal ASC 
					LIMIT $limit OFFSET $offset";
					
			$d['data'] = $this->mdl_absen->manualQuery($text);
                        
			$data_sess['jadwal']=  $this->uri->segment(3);
                         $this->session->set_userdata($data_sess);
			
			$d['content'] = $this->load->view('absen/data_siswa', $d, true);		
			$this->load->view('home/home',$d);
		}else{
			redirect('login');
		}          
        }
        
         public function absenGanjil(){
             $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
		
			$cari = $this->input->post('txt_cari');
			
			if(empty($cari)){
                                $id=$this->uri->segment(3);
				$where = "WHERE kd_kls ='$id'";
				$kata = $this->session->userdata('cari');
			}else{
				$sess_data['cari'] = $this->input->post("txt_cari");
				$this->session->set_userdata($sess_data);
				$cari = $this->session->userdata('cari');
				$where = " WHERE nis LIKE '%$cari%' OR semester LIKE '%$cari%'";
				
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="ABSEN SEMESTER I";
			
			//paging
			$page=$this->uri->segment(4);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM absen $where ";		
			$tot_hal = $this->mdl_absen->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'absen/absenGanjil';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 4;
			$config['next_link'] = 'Lanjut &raquo;';
			$config['prev_link'] = '&laquo; Kembali';
			$config['last_link'] = '<b>Terakhir &raquo; </b>';
			$config['first_link'] = '<b> &laquo; Pertama</b>';
			$this->pagination->initialize($config);
			$d["paginator"] =$this->pagination->create_links();
			$d['hal'] = $offset;
                        
			 $text = "SELECT a.id,a.kd_kls,a.semester,a.nis,a.sakit,a.ijin,a.alpha,
					b.nis,b.nama
					FROM absen as a 
					JOIN siswa as b
					ON a.nis=b.nis
					WHERE a.kd_kls='$id' AND a.semester='1' ORDER BY semester ASC 
					LIMIT $limit OFFSET $offset ";

			$d['data'] = $this->mdl_absen->manualQuery($text);
                        
			
			
			$d['content'] = $this->load->view('absen/absen_ganjil', $d, true);		
			$this->load->view('home/home',$d);
	}else{
			redirect('login');
		}          
            
        }
        public function absenGenap(){
            $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('txt_cari');
			
			if(empty($cari)){
                                $id=$this->uri->segment(3);
				$where = "WHERE kd_kls ='$id'";
				$kata = $this->session->userdata('cari');
			}else{
				$sess_data['cari'] = $this->input->post("txt_cari");
				$this->session->set_userdata($sess_data);
				$cari = $this->session->userdata('cari');
				$where = " WHERE nis LIKE '%$cari%' OR semester LIKE '%$cari%'";
				
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="ABSEN SEMESTER II";
			
			//paging
			$page=$this->uri->segment(4);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM absen $where ";		
			$tot_hal = $this->mdl_absen->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'absen/absenGanjil';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 4;
			$config['next_link'] = 'Lanjut &raquo;';
			$config['prev_link'] = '&laquo; Kembali';
			$config['last_link'] = '<b>Terakhir &raquo; </b>';
			$config['first_link'] = '<b> &laquo; Pertama</b>';
			$this->pagination->initialize($config);
			$d["paginator"] =$this->pagination->create_links();
			$d['hal'] = $offset;
                        
			 $text = "SELECT a.id,a.kd_kls,a.semester,a.nis,a.sakit,a.ijin,a.alpha,
					b.nis,b.nama
					FROM absen as a 
					JOIN siswa as b
					ON a.nis=b.nis
					WHERE a.kd_kls='$id' AND a.semester='2' ORDER BY semester ASC 
					LIMIT $limit OFFSET $offset ";

			$d['data'] = $this->mdl_absen->manualQuery($text);
                        
			
			
			$d['content'] = $this->load->view('absen/absen_genap', $d, true);		
			$this->load->view('home/home',$d);
	
            }else{
			redirect('login');
		}        
        }
}

