<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal extends MX_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_jadwal');
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
				$where = " WHERE id LIKE '%$cari%' OR pengajar LIKE '%$cari%'";
				
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Data Jadwal";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM jadwal $where ";		
			$tot_hal = $this->mdl_jadwal->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'jadwal';
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
			

			$text = "SELECT * FROM jadwal $where 
					ORDER BY id ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->mdl_jadwal->manualQuery($text);
			
			
			$d['content'] = $this->load->view('jadwal/view_jadwal', $d, true);		
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

			$d['judul']="Data Jadwal";
                        $tgl	= date('d-m-Y');
                        
                        $d['id']	='';
			$d['mapel']	='';
                        $d['pengajar']	='';
			
			$d['kelas']	='';
                        $d['jurusan']	='';
			
			$d['ruangan']	='';
			$d['hari']	='';
			$d['jam_mulai']	='';
                        $d['jam_selesai']	='';
                        
			
                        $text = "SELECT * FROM kelas";
			$d['l_kelas'] = $this->mdl_jadwal->manualQuery($text);
                        
                        $tex = "SELECT * FROM mapel";
			$d['l_mapel'] = $this->mdl_jadwal->manualQuery($tex);
                        
                        $te = "SELECT * FROM staff WHERE jabatan='guru'";
			$d['l_guru'] = $this->mdl_jadwal->manualQuery($te);
                        
                        $tx = "SELECT * FROM jurusan";
			$d['l_jurusan'] = $this->mdl_jadwal->manualQuery($tx);
                        
			$d['content'] = $this->load->view('jadwal/form_jadwal', $d, true);		
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
			
			$d['judul'] = "Data Jadwal";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM jadwal WHERE id='$id'";
			$data = $this->mdl_jadwal->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					
                                        $d['id']	   =$id;
                                        $d['mapel']	   =$db->mapel;
                                        $d['kelas']	   =$db->kelas;
                                        $d['jurusan']	   =$db->jurusan;
                                        $d['pengajar']    =$db->pengajar;
                                        $d['ruangan']	   =$db->ruangan;
                                        $d['hari']          =$db->hari;
                                        $d['jam_mulai']     =$db->jam_mulai;
                                        $d['jam_selesai']    =$db->jam_selesai;
                                        
				}
			}else{
					 $d['id']	   =$id;
                                        $d['mapel']	   ='';
                                        $d['kelas']	   ='';
                                        $d['jurusan']	   ='';
                                        $d['pengajar']    ='';
                                        $d['ruangan']	   ='';
                                        $d['hari']          ='';
                                        $d['jam_mulai']     ='';
                                        $d['jam_selesai']    ='';
			}
			
                         $text = "SELECT * FROM kelas";
			$d['l_kelas'] = $this->mdl_jadwal->manualQuery($text);
                        
                        $tex = "SELECT * FROM mapel";
			$d['l_mapel'] = $this->mdl_jadwal->manualQuery($tex);
                        
                        $te = "SELECT * FROM staff where jabatan ='guru'";
			$d['l_guru'] = $this->mdl_jadwal->manualQuery($te);
                        
                        $tx = "SELECT * FROM jurusan";
			$d['l_jurusan'] = $this->mdl_jadwal->manualQuery($tx);
                        
			$d['content'] = $this->load->view('jadwal/form_jadwal', $d, true);		
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
			$this->mdl_jadwal->manualQuery("DELETE FROM jadwal WHERE id='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."jadwal'>";			
		 }else{
                    redirect('login');
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                                
                                        $up['id']	   =  $this->input->post('id');
                                        $up['mapel']	   =$this->input->post('mapel');
                                        $up['kelas']	   =$this->input->post('kelas');
                                        $up['jurusan']	   =$this->input->post('jurusan');
                                        $up['pengajar']    =$this->input->post('pengajar');
                                        $up['ruangan']	   =$this->input->post('ruangan');
                                        $up['hari']          =$this->input->post('hari');
                                        $up['jam_mulai']     =$this->input->post('jam_mulai');
                                        $up['jam_selesai']    =$this->input->post('jam_selesai');
				
				$id['id']=$this->input->post('id');
				
				$data = $this->mdl_jadwal->getSelectedData("jadwal",$id);
				if($data->num_rows()>0){
					$this->mdl_jadwal->updateData("jadwal",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->mdl_jadwal->insertData("jadwal",$up);
					echo 'Simpan data Sukses';		
				}
		 }else{
                    redirect('login');
		}
	
	}
	 public function InfoSiswa()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kode = $this->input->post('nis');
			$text = "SELECT * FROM siswa WHERE nis ='$kode'";
			$tabel = $this->mdl_siswa->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['id']	   =$t->id;
                                        $data['mapel']	   =$t->mapel;
                                        $data['kelas']	   =$t->kelas;
                                        $data['jurusan'] =$t->jurusan;
                                        $data['pengajar']	   =$t->pengajar;
                                        $data['ruangan']   =$t->ruangan;
                                        $data['hari']     =$t->hari;
                                        $data['jam_mulai']    =$t->jam_mulai;
                                        $data['jam_selesai'] =$t->jam_selesai;
                                        
					echo json_encode($data);
				}
			}else{
				$data['id']	   ='';
                                $data['mapel']	   ='';
                                $data['kelas']	   ='';
                                $data['jurusan'] ='';
                                $data['pengajar']	   ='';
                                $data['ruangan']   ='';
                                $data['hari']     ='';
                                $data['jam_mulai']    ='';
                                $data['jam_selesai'] ='';
                                
				echo json_encode($data);
			}
		 }else{
                    redirect('login');
		}
	}
        
        public function jadwalGuru(){
            $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                        $nip=$this->session->userdata('nip');
                        $where="WHERE pengajar='$nip' AND status='aktif'";
                        $d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']=" Jadwal Guru";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM jadwal $where ";		
			$tot_hal = $this->mdl_jadwal->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'jadwal';
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
			

			$text = "SELECT * FROM jadwal $where 
					ORDER BY id ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->mdl_jadwal->manualQuery($text);
			
			
			$d['content'] = $this->load->view('jadwal/jadwal_guru', $d, true);		
			$this->load->view('home/home',$d);
                        
                        }else{
                    redirect('login');
		}
            
        }
   
}

