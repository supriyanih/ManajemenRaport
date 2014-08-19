<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapel extends MX_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_mapel');
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
				$where = " WHERE kd_mapel LIKE '%$cari%' OR mapel LIKE '%$cari%'";
				
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Mata Pelajaran";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM mapel $where ";		
			$tot_hal = $this->mdl_mapel->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'mapel';
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
			

			$text = "SELECT * FROM mapel $where 
					ORDER BY kd_mapel ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->mdl_mapel->manualQuery($text);
			
			
			$d['content'] = $this->load->view('mapel/view_mapel', $d, true);		
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

			$d['judul']="Mata Pelajaran";
                        $tgl	= date('d-m-Y');
			
			$d['kd_mapel']	='';
			$d['mapel']	='';
			$d['kkm']	='';
			
			
			$d['content'] = $this->load->view('mapel/form_mapel', $d, true);		
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
			$text = "SELECT * FROM mapel WHERE kd_mapel='$id'";
			$data = $this->mdl_mapel->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					
                                        $d['kd_mapel']	   =$id;
                                        $d['mapel']	   =$db->mapel;
                                        $d['kkm']	   =$db->kkm;
                                       
				}
			}else{
					$d['kd_mapel']	   =$id;
                                        $d['mapel']	   ='';
                                        $d['kkm']	   ='';
                                        
			}
						
			$d['content'] = $this->load->view('mapel/form_mapel', $d, true);		
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
			$this->mdl_mapel->manualQuery("DELETE FROM mapel WHERE kd_mapel='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."mapel'>";			
		}else{
                    redirect('login');
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                                
                                        $up['kd_mapel']	   =$this->input->post('kd_mapel');
                                        $up['mapel']	   =$this->input->post('mapel');
                                        $up['kkm']	   =$this->input->post('kkm');
                                        
				$id['kd_mapel']=$this->input->post('kd_mapel');
				
				$data = $this->mdl_mapel->getSelectedData("mapel",$id);
				if($data->num_rows()>0){
					$this->mdl_mapel->updateData("mapel",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->mdl_mapel->insertData("mapel",$up);
					echo 'Simpan data Sukses';		
				}
		}else{
                    redirect('login');
		}
	
	}
	
    public function InfoMapel()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kode = $this->input->post('kd_mapel');
			$text = "SELECT * FROM mapel WHERE kd_mapel ='$kode'";
			$tabel = $this->mdl_mapel->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['kd_mapel']	   =$t->kd_mapel;
                                        $data['mapel']	   =$t->mapel;
                                        $data['kkm']	   =$t->kkm;
                                        
					echo json_encode($data);
				}
			}else{
				$data['kd_mapel']	   ='';
                                $data['mapel']	   ='';
                                $data['kkm']	   ='';
                                
				echo json_encode($data);
			}
		}else{
                    redirect('login');
		}
	}
}

