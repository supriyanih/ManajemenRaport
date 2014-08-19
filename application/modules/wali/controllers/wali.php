<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wali extends MX_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_wali');
        $this->load->helper();
    }
    
    public function index()
	{
        $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                        $nip=$this->session->userdata('nip');
                        $where="WHERE wali_kelas='$nip' AND status='aktif'";
                        $d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Wali Kelas";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM kelas $where ";		
			$tot_hal = $this->mdl_wali->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'wali';
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
			
			$data = $this->mdl_wali->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					
                                        $d['kd_kelas']	   =$db->kd_kelas;
                                        $d['kelas']	   =$db->kelas;
                                        $d['thn_ajaran']   =$db->thn_ajaran;
                                        $d['wali_kelas']   =$db->wali_kelas;
                                        $d['status']	   =$db->status;
                                       $d['content'] = $this->load->view('wali/menu_wali', $d, true);	
                                        
                                        
				}
			
			}  else {
                            $d['content'] = $this->load->view('wali/welcome', $d, true);
                        }
			
					
			$this->load->view('home/home',$d);
                        
                        
                        }else{
                    redirect('login');
		}    
            
	}
	
       
        public function nilai(){
            
             $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('txt_cari');
			
			if(empty($cari)){
                                $id=$this->uri->segment(3);
				$where = "WHERE kls ='$id'";
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

			
			$d['judul']="Nilai Siswa";
			
			//paging
			$page=$this->uri->segment(4);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM nilai $where ";		
			$tot_hal = $this->mdl_wali->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'menu/nilai';
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
                        
			 $text = "SELECT a.kls,a.id_jadwal,a.nis,a.harian,a.uts,a.uas,a.praktek,a.semester,
					b.id,b.kelas,b.mapel,
                                        c.nis,c.nama
					FROM nilai as a 
					JOIN jadwal as b
                                        JOIN siswa as c
					ON a.id_jadwal=b.id AND a.nis=c.nis
					WHERE a.kls='$id' ORDER BY semester ASC 
					LIMIT $limit OFFSET $offset ";

			$d['data'] = $this->mdl_wali->manualQuery($text);
                        
			
			
			$d['content'] = $this->load->view('wali/nilai_siswa', $d, true);		
			$this->load->view('home/home',$d);
		  }else{
                    redirect('login');
		}    
                        
        }

        public function input()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['judul'] = "Data Wali";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM siswa WHERE nis='$id'";
			$data = $this->mdl_wali->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					
                                        $d['nis']	   =$id;
                                        $d['nama']	   =$db->nama;
                                      
                                        
				}
			
			}
			
                        $text = "SELECT * FROM smstr";
			$d['l_smstr'] = $this->mdl_wali->manualQuery($text);
                        $d['jadwal']=  $this->uri->segment(3);
                  
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
			
			$d['judul'] = "Data Wali";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM wali WHERE id='$id'";
			$data = $this->mdl_wali->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					
                                        $d['id']	   =$id;
                                        $d['id_jadwal']	   =$db->id_jadwal;
                                        $d['nis']	   =$db->nis;
                                        $d['semester']	   =$db->semester;
                                        $d['harian']	   =$db->harian;
                                        $d['uts']	   =$db->uts;
                                        $d['uas']	   =$db->uas;
                                        $d['praktek']	   =$db->praktek;
                                        
				}
                      
			
			}
			
                        $text = "SELECT * FROM smstr";
			$d['l_smstr'] = $this->mdl_wali->manualQuery($text);
                        $d['jadwal']=  $this->uri->segment(3);
                  
			$d['content'] = $this->load->view('form_edit', $d, true);		
			$this->load->view('home/home',$d);
		  }else{
                    redirect('login');
		}    
	}
	
	public function hapus($id,$jdw)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){			
			$id = $this->uri->segment(3);
			$this->mdl_wali->manualQuery("DELETE FROM wali WHERE id='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."wali/tampilWali/$jdw'>";			
		  }else{
                    redirect('login');
		}    
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                                
                                        $up['id_jadwal']=$this->input->post('id_jadwal');
                                        $up['nis']	=$this->input->post('nis');
                                        $up['semester']	=$this->input->post('semester');
                                       
                                        $up['harian']	=$this->input->post('harian');
                                        $up['uts']      =$this->input->post('uts');
                                        $up['uas']      =$this->input->post('uas');
                                        $up['praktek']   =$this->input->post('praktek');
                                        
				
				$id['id']=$this->input->post('id');
				
				$data = $this->mdl_wali->getSelectedData("wali",$id);
				if($data->num_rows()>0){
					$this->mdl_wali->updateData("wali",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->mdl_wali->insertData("wali",$up);
					echo 'Simpan data Sukses';		
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
			$tot_hal = $this->mdl_wali->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'wali/';
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
					
					
			$d['data'] = $this->mdl_wali->manualQuery($text);
			$d['kd_jadwal']=  $this->uri->segment(4);
			
			$d['content'] = $this->load->view('wali/data_siswa', $d, true);		
			$this->load->view('home/home',$d);
                        
                         }else{
                    redirect('login');
		}  
      }
      
      
       public function DataSiswa(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari= $this->input->post('cari');
			if(empty($cari)){
				$text = "SELECT * FROM siswa";
			}else{
				$text = "SELECT * FROM siswa WHERE nis LIKE '%$cari%' OR nama LIKE '%$cari%'";
			}
			$d['data'] = $this->mdl_wali->manualQuery($text);
			
			$this->load->view('ambil_siswa',$d);
		 }else{
                    redirect('login');
		}  
	} 
        public function tampilWali(){
           
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

			
			$d['judul']="Wali Siswa";
			
			//paging
			$page=$this->uri->segment(4);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM wali $where ";		
			$tot_hal = $this->mdl_wali->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'wali/tampilWali';
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
                        
			 

			
			$text = "SELECT * FROM wali $where 
					ORDER BY id_jadwal ASC 
					LIMIT $limit OFFSET $offset";
					
			$d['data'] = $this->mdl_wali->manualQuery($text);
                        
			$data_sess['jadwal']=  $this->uri->segment(3);
                         $this->session->set_userdata($data_sess);
			
			$d['content'] = $this->load->view('wali/data_siswa', $d, true);		
			$this->load->view('home/home',$d);
		}else{
                    redirect('login');
		}               
        }
        
       
        
        public function nilaiGenap(){
             $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('txt_cari');
			
			if(empty($cari)){
                                $id=$this->uri->segment(3);
				$where = "WHERE kls ='$id'";
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

			
			$d['judul']="Nilai Siswa";
			
			//paging
			$page=$this->uri->segment(4);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM nilai $where ";		
			$tot_hal = $this->mdl_wali->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'menu/nilai';
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
                        
			 $text = "SELECT a.kls,a.id_jadwal,a.nis,a.harian,a.uts,a.uas,a.semester,
					b.id,b.kelas,b.mapel,
                                        c.nis,c.nama
					FROM nilai as a 
					JOIN jadwal as b
                                        JOIN siswa as c
					ON a.id_jadwal=b.id AND a.nis=c.nis
					WHERE a.kls='$id' AND a.semester='2' ORDER BY semester ASC 
					LIMIT $limit OFFSET $offset ";

			$d['data'] = $this->mdl_wali->manualQuery($text);
                        
			
			
			$d['content'] = $this->load->view('wali/nilai_siswa', $d, true);		
			$this->load->view('home/home',$d);
                        
                        }else{
                    redirect('login');
		} 
	
        }
        
        public function nilaiGanjil(){
             $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('txt_cari');
			
			if(empty($cari)){
                                $id=$this->uri->segment(3);
				$where = "WHERE kls ='$id'";
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

			
			$d['judul']="Nilai Siswa";
			
			//paging
			$page=$this->uri->segment(4);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM nilai $where ";		
			$tot_hal = $this->mdl_wali->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'menu/nilai';
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
                        
			 $text = "SELECT a.kls,a.id_jadwal,a.nis,a.harian,a.uts,a.uas,a.semester,
					b.id,b.kelas,b.mapel,
                                        c.nis,c.nama
					FROM nilai as a 
					JOIN jadwal as b
                                        JOIN siswa as c
					ON a.id_jadwal=b.id AND a.nis=c.nis
					WHERE a.kls='$id' AND a.semester='1' ORDER BY semester ASC 
					LIMIT $limit OFFSET $offset ";

			$d['data'] = $this->mdl_wali->manualQuery($text);
                        
			
			
			$d['content'] = $this->load->view('wali/nilai_siswa', $d, true);		
			$this->load->view('home/home',$d);
                        
                         
                        }else{
                    redirect('login');
		} 
	
            
        }
       
}

