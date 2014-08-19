<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siswa extends MX_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_siswa');
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
				$where = " WHERE nis LIKE '%$cari%' OR nama LIKE '%$cari%'";
				
			}
			
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
			$tot_hal = $this->mdl_siswa->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'siswa';
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
			

			$text = "SELECT * FROM siswa $where 
					ORDER BY nis ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->mdl_siswa->manualQuery($text);
			
			
			$d['content'] = $this->load->view('siswa/view_siswa', $d, true);		
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

			$d['judul']="Data Siswa";
                        $tgl	= date('d-m-Y');
			
			$d['nis']	='';
			$d['nama']	='';
			$d['tempat']	='';
			$d['tgl_lahir']	=$tgl;
			$d['jenkel']	='';
			$d['jurusan']	='';
                        $d['kelas']	='';
                        $d['alamat']	='';
                        $d['thn_masuk']	='';
                        $d['wali_siswa']='';
                        $d['telpon_wali']='';
			
                        $text = "SELECT * FROM kelas";
			$d['l_kelas'] = $this->mdl_siswa->manualQuery($text);
                        
                        $tex = "SELECT * FROM jurusan";
			$d['l_jurusan'] = $this->mdl_siswa->manualQuery($tex);
                        
			$d['content'] = $this->load->view('siswa/form_siswa', $d, true);		
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
			
			$d['judul'] = "Data Siswa";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM siswa WHERE nis='$id'";
			$data = $this->mdl_siswa->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					
                                        $d['nis']	   =$id;
                                        $d['nama']	   =$db->nama;
                                        $d['tempat']	   =$db->tempat;
                                        $d['tgl_lahir'] =$this->mdl_siswa->tgl_sql($db->tgl_lahir);
                                        $d['jenkel']	   =$db->jenkel;
                                        $d['jurusan']   =$db->jurusan;
                                        $d['kelas']     =$db->kelas;
                                        $d['alamat']    =$db->alamat;
                                        $d['thn_masuk'] =$db->thn_masuk;
                                        $d['wali_siswa']=$db->wali_siswa;
                                        $d['telpon_wali']=$db->telpon_wali;
				}
			}else{
					$d['nis']	   =$id;
                                        $d['nama']	   ='';
                                        $d['tempat']	   ='';
                                        $d['tgl_lahir'] ='';
                                        $d['jenkel']	   ='';
                                        $d['jurusan']   ='';
                                        $d['kelas']     ='';
                                        $d['alamat']    ='';
                                        $d['thn_masuk'] ='';
                                        $d['wali_siswa']='';
                                        $d['telpon_wali']='';
			}
			
                        $text = "SELECT * FROM kelas";
			$d['l_kelas'] = $this->mdl_siswa->manualQuery($text);
                        
                         $tex = "SELECT * FROM jurusan";
			$d['l_jurusan'] = $this->mdl_siswa->manualQuery($tex);
			$d['content'] = $this->load->view('siswa/form_siswa', $d, true);		
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
			$this->mdl_siswa->manualQuery("DELETE FROM siswa WHERE nis='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."siswa'>";			
		}else{
                    redirect('login');
		}    
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                                
                                        $up['nis']	   =$this->input->post('nis');
                                        $up['nama']	   =$this->input->post('nama');
                                        $up['tempat']	   =$this->input->post('tempat');
                                        $up['tgl_lahir']   =$this->mdl_siswa->tgl_sql($this->input->post('tgl_lahir'));
                                        $up['jenkel']	   =$this->input->post('jenkel');
                                        $up['jurusan']   =$this->input->post('jurusan');
                                        $up['kelas']     =$this->input->post('kelas');
                                        $up['alamat']    =$this->input->post('alamat');
                                        $up['thn_masuk'] =$this->input->post('thn_masuk');
                                        $up['wali_siswa']=$this->input->post('wali_siswa');
                                        $up['telpon_wali']=$this->input->post('telpon_wali');
				
				$id['nis']=$this->input->post('nis');
				
				$data = $this->mdl_siswa->getSelectedData("siswa",$id);
				if($data->num_rows()>0){
					$this->mdl_siswa->updateData("siswa",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->mdl_siswa->insertData("siswa",$up);
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
					$data['nis']	   =$t->nis;
                                        $data['nama']	   =$t->nama;
                                        $data['tempat']	   =$t->tempat;
                                        $data['tgl_lahir'] =$t->tgl_lahir;
                                        $data['jenkel']	   =$t->jenkel;
                                        $data['jurusan']   =$t->jurusan;
                                        $data['kelas']     =$t->kelas;
                                        $data['alamat']    =$t->alamat;
                                        $data['thn_masuk'] =$t->thn_masuk;
                                        $data['wali_siswa']=$t->wali_siswa;
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
                                $data['wali_siswa']='';
                                $data['telpon_wali']='';
				echo json_encode($data);
			}
		}else{
                    redirect('login');
		}    
	}
}

