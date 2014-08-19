<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jurusan extends MX_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_jurusan');
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
				$where = " WHERE kd_jurusan LIKE '%$cari%' OR jurusan LIKE '%$cari%'";
				
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Jurusan";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM jurusan $where ";		
			$tot_hal = $this->mdl_jurusan->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'jurusan';
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
			

			$text = "SELECT * FROM jurusan $where 
					ORDER BY kd_jurusan ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->mdl_jurusan->manualQuery($text);
			
			
			$d['content'] = $this->load->view('jurusan/view_jurusan', $d, true);		
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

			$d['judul']="Jurusan";
                        
			
			$d['kd_jurusan']	='';
			$d['jurusan']	='';
			
			
			
			$d['content'] = $this->load->view('jurusan/form_jurusan', $d, true);		
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
			
			$d['judul'] = "Mata Pelajaran";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM jurusan WHERE kd_jurusan='$id'";
			$data = $this->mdl_jurusan->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					
                                        $d['kd_jurusan']	   =$id;
                                        $d['jurusan']	   =$db->jurusan;
                                        
                                       
				}
			}else{
					$d['kd_jurusan']	   =$id;
                                        $d['jurusan']	   ='';
                                        
                                        
			}
						
			$d['content'] = $this->load->view('jurusan/form_jurusan', $d, true);		
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
			$this->mdl_jurusan->manualQuery("DELETE FROM jurusan WHERE kd_jurusan='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."jurusan'>";			
		}else{
                    redirect('login');
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                                
                                        $up['kd_jurusan']	   =$this->input->post('kd_jurusan');
                                        $up['jurusan']	   =$this->input->post('jurusan');
                                        
                                        
				$id['kd_jurusan']=$this->input->post('kd_jurusan');
				
				$data = $this->mdl_jurusan->getSelectedData("jurusan",$id);
				if($data->num_rows()>0){
					$this->mdl_jurusan->updateData("jurusan",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->mdl_jurusan->insertData("jurusan",$up);
					echo 'Simpan data Sukses';		
				}
		}else{
                    redirect('login');
		}
	
	}
	
    public function InfoJurusan()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kode = $this->input->post('kd_jurusan');
			$text = "SELECT * FROM jurusan WHERE kd_jurusan ='$kode'";
			$tabel = $this->mdl_jurusan->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['kd_jurusan']	   =$t->kd_jurusan;
                                        $data['jurusan']	   =$t->jurusan;
                                        
                                        
					echo json_encode($data);
				}
			}else{
				$data['kd_jurusan']	   ='';
                                $data['jurusan']	   ='';
                               
                                
				echo json_encode($data);
			}
		}else{
                    redirect('login');
		}
	}
}

