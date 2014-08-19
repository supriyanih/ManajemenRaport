<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nilai extends MX_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_nilai');
        $this->load->helper();
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
			
			$d['judul'] = "Data Nilai";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM jadwal WHERE id='$id'";
			$data = $this->mdl_nilai->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					
                                        $d['id']	   =$id;
                                       
                                        $d['kelas']         =$db->kelas;
                                      
                                        
				}
			
			}
			
                        $text = "SELECT * FROM smstr";
			$d['l_smstr'] = $this->mdl_nilai->manualQuery($text);
                        $d['jadwal']=  $this->uri->segment(3);
                  
			$d['content'] = $this->load->view('form_input', $d, true);		
			$this->load->view('home/home',$d);
		}else{
                    redirect('login');
		}
	}
        
        public function edit($id)
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['judul'] = "Data Nilai";
			
			//$id = $this->uri->segment(3);
			$text = "SELECT * FROM nilai WHERE id_nilai='$id'";
			$data = $this->mdl_nilai->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					
                                        $d['id']	   =$id;
                                        $d['id_jadwal']	   =$db->id_jadwal;
                                        $d['nis']	   =$db->nis;
                                        $d['kls']	   =$db->kls;
                                        $d['semester']	   =$db->semester;
                                        $d['harian']	   =$db->harian;
                                        $d['uts']	   =$db->uts;
                                        $d['uas']	   =$db->uas;
                                        
                                        
				
                                }
                        }else{
                            
                                        $d['id']	   =$id;
                                        $d['id_jadwal']	   ='';
                                        $d['nis']	   ='';
                                        $d['kls']	   ='';
                                        $d['semester']	   ='';
                                        $d['harian']	   ='';
                                        $d['uts']	   ='';
                                        $d['uas']	   ='';
                            
                        }
                                
                      
			
			
			
                        $tex = "SELECT * FROM smstr";
			$d['l_smstr'] = $this->mdl_nilai->manualQuery($tex);
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
			$this->mdl_nilai->manualQuery("DELETE FROM nilai WHERE id_nilai='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."nilai/tampilNilai/$jdw'>";			
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
                                       $up['kls']	=$this->input->post('kls');
                                        $up['harian']	=$this->input->post('harian');
                                        $up['uts']      =$this->input->post('uts');
                                        $up['uas']      =$this->input->post('uas');
                                        
                                        
				
				$id['id_nilai']=$this->input->post('id_nilai');
				
				$data = $this->mdl_nilai->getSelectedData("nilai",$id);
				if($data->num_rows()>0){
					$this->mdl_nilai->updateData("nilai",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->mdl_nilai->insertData("nilai",$up);
					echo 'Simpan data Sukses';		
				}
		}else{
                    redirect('login');
		}
	
	}
	
    public function InfoNilai()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kode = $this->input->post('nis');
			$text = "SELECT * FROM nilai WHERE nis ='$kode'";
			$tabel = $this->mdl_nilai->manualQuery($text);
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
                                        $data['wali_nilai']=$t->wali_nilai;
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
                                $data['wali_nilai']='';
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
			$tot_hal = $this->mdl_nilai->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'nilai/';
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
					
					
			$d['data'] = $this->mdl_nilai->manualQuery($text);
			$d['kd_jadwal']=  $this->uri->segment(4);
			
			$d['content'] = $this->load->view('nilai/data_siswa', $d, true);		
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
			$d['data'] = $this->mdl_nilai->manualQuery($text);
			
			$this->load->view('ambil_siswa',$d);
		}else{
                    redirect('login');
		}
	} 
        public function tampilNilai(){
           
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
			$tot_hal = $this->mdl_nilai->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'nilai/tampilNilai';
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
                        
			 

			
			$text = "SELECT a.id_nilai,a.kls,a.id_jadwal,a.nis,a.harian,a.uts,a.uas,a.semester,
					b.id,b.kelas,b.mapel,
                                        c.nis,c.nama
					FROM nilai as a 
					JOIN jadwal as b
                                        JOIN siswa as c
					ON a.id_jadwal=b.id AND a.nis=c.nis
					where a.id_jadwal ='$id'  ORDER BY id_jadwal ASC 
					LIMIT $limit OFFSET $offset";
					
			$d['data'] = $this->mdl_nilai->manualQuery($text);
                        
			$data_sess['jadwal']=  $this->uri->segment(3);
                         $this->session->set_userdata($data_sess);
			
			$d['content'] = $this->load->view('nilai/data_siswa', $d, true);		
			$this->load->view('home/home',$d);
		}else{
                    redirect('login');
		}        
        }
}

