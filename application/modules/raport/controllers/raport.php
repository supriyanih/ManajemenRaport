<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Raport extends MX_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_raport');
        $this->load->helper();
    }
    
    public function index()
	{
       $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('nis');
			
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

			
			$d['judul']="RAPORT SISWA";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM nilai $where ";		
			$tot_hal = $this->mdl_raport->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'raport';
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
			

			$text = "SELECT * FROM nilai $where 
					ORDER BY nis ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->mdl_raport->manualQuery($text);
			
			
			$d['content'] = $this->load->view('raport/view_raport', $d, true);		
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
                             
				$text = "SELECT * FROM siswa WHERE kelas ='$kls'";
			}else{
				$text = "SELECT * FROM siswa WHERE kelas ='$kls' AND nis LIKE '%$cari%' OR nama LIKE '%$cari%'";
			}
			$d['data'] = $this->mdl_raport->manualQuery($text);
			
			$this->load->view('ambil_siswa',$d);
		}else{
                    redirect('login');
		}        
	} 
	
        public function raportSiswa(){
            $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
                     $nis = $this->input->post('nis');
                     $smstr=$this->input->post('semester');
			$kls =  $this->uri->segment(3);
			if(empty($cari)){
				$where = "WHERE kls ='$kls' ";
				$kata = $this->session->userdata('cari');
			}else{
				$sess_data['cari'] = $this->input->post("txt_cari");
				$this->session->set_userdata($sess_data);
				$cari = $this->session->userdata('cari');
				$where = "WHERE kls ='$kls' AND nis ='$nis'";
				
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="RAPORT SISWA";
			
			//paging
			$page=$this->uri->segment(4);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM nilai $where ";		
			$tot_hal = $this->mdl_raport->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'raport/raportSiswa';
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
			

			$text = "SELECT * FROM nilai $where 
					ORDER BY id_nilai ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->mdl_raport->manualQuery($text);
			
			
			$d['content'] = $this->load->view('raport/view_raport', $d, true);		
			$this->load->view('home/home',$d);
		}else{
                    redirect('login');
		}      
        }
        
       public function dataRaport($kls){
            $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){ 
           
           $cari= $this->input->post('cari');
            $nis=  $this->input->post('nis');
            $semester= $this->input->post('semester');
                    if(empty($cari)){
                             
				$where = "WHERE a.nis ='$nis' AND a.semester ='$semester' AND a.kls ='$kls'";
			}else{
				$where = "SELECT * FROM nilai WHERE kls ='$kls' AND nis LIKE '%$cari%' OR nama LIKE '%$cari%'";
			}
                        
                        $text = "SELECT a.id_nilai,a.kls,a.id_jadwal,a.nis,a.harian,a.uts,a.uas,a.semester,
					b.id,b.kelas,b.mapel,
                                        c.nis,c.nama,
                                        d.kd_mapel,d.kkm,d.mapel
					FROM nilai as a 
					JOIN jadwal as b
                                        JOIN siswa as c
                                        JOIN mapel as d
					ON a.id_jadwal=b.id AND a.nis=c.nis AND b.mapel=d.kd_mapel
					$where";
                       $d['kls']=$kls;
                       $d['nis']=$nis;
                       $d['semester']=$semester;
                        
			$d['data'] = $this->mdl_raport->manualQuery($text);
			
			$this->load->view('ambil_raport',$d);
                        
                     }else{
                    redirect('login');
		}     
        }
        
        public function download_excel($kls,$nis,$semester)
	{
       
        $this->load->helper('to_excel');
        $where = "WHERE nis ='$nis' AND semester ='$semester' AND kls ='$kls'";
        
         $text = "SELECT*FROM nilai $where";
                         
                          
					
         
         $query = $this->mdl_raport->manualQuery($text);
         
         
       
			
			
			$nama_file = 'NILAI_SISWA_' . $nis . '_SEMESTER_' . $semester. '_SEMESTER_' .$kls;
			
            to_excel($query, $nama_file);
        }
        
        
        public function cetak($kls,$nis,$semester){
            
            $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){ 
            
          
			
                     $where = "WHERE a.nis ='$nis' AND a.semester ='$semester' AND a.kls ='$kls'";
                     
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			$d['judul']="DAFTAR NILAI SEMESTER";
			
			$pilih = $this->uri->segment(3);
		
			
			 $text = "SELECT a.kls,a.id_jadwal,a.nis,a.harian,a.uts,a.uas,a.semester,
					b.id,b.kelas,b.mapel,
                                        c.nis,c.nama,
                                        d.kd_mapel,d.kkm,d.mapel
					FROM nilai as a 
					JOIN jadwal as b
                                        JOIN siswa as c
                                        JOIN mapel as d
					ON a.id_jadwal=b.id AND a.nis=c.nis AND b.mapel=d.kd_mapel
					$where";
                         
                         $d['data'] = $this->mdl_raport->manualQuery($text);
			
                        $tex="SELECT * FROM siswa WHERE nis ='$nis'";
                        $dataSiswa = $this->mdl_raport->manualQuery($tex);
			if($dataSiswa->num_rows() > 0){
				foreach($dataSiswa->result() as $db){
					$nis   =$db->nis;
                                        $nama	   =$db->nama;
                                        $kelas	   =$db->kelas;
                                        $jurusan=$db->jurusan;
                                        
                                       
				}
			}else{
                                        $nis   ='';
                                        $nama	   ='';
                                        $kelas	   ='';
                                        $jurusan='';
                                        
                                        
			}
                        $textabsen= "SELECT * FROM absen WHERE nis='$nis' AND kd_kls='$kls'AND semester ='$semester'";
                        $dataAbsen = $this->mdl_raport->manualQuery($textabsen);
			if($dataAbsen->num_rows() > 0){
				foreach($dataAbsen->result() as $db){
					
                                        $id	   =$db->id;
                                        
                                        $nis	   =$db->nis;
                                   
                                        $smtr	   =$db->semester;
                                        $sakit	   =$db->sakit;
                                        $ijin	   =$db->ijin;
                                        $alpha	   =$db->alpha;
                                        
				}
                        }else{
                                        $id	   ='';
                                        
                                        $nis	   ='';
                                   
                                        $smtr	   ='';
                                        $sakit	   ='';
                                        $ijin	   ='';
                                        $alpha	   ='';
                                       
                      
			
			}
                        $textkelas="SELECT*FROM kelas where kd_kelas='$kls'";
                        $datakelas=  $this->mdl_raport->manualQuery($textkelas);
                        if($datakelas->num_rows() > 0){
                            foreach ($datakelas->result() as $db){
                                 
                                 
                                 $thn_ajaran=$db->thn_ajaran;
                            }
                        }  else {
                             
                             $thn_ajaran='';
                        }
                        
                        if($semester==1){
                            $smtr_siswa="GANJIL";
                        }  else {
                            $smtr_siswa="GENAP";
                        }
                        
                         $d['nama_siswa']=$nama;
                         $d['nis_siswa']=$nis;
                         $d['kelas_siswa']=$kelas;
                         $d['thn_ajaran']=$thn_ajaran;
                         $d['siswa_semester']=$semester;
                         $d['siswa_smstr']=$smtr_siswa;
                         $d['jurusan']=$jurusan;
                         $d['sakit_siswa']=$sakit;
                         $d['ijin_siswa']=$ijin;
                         $d['alpha_siswa']=$alpha;
                         
			
			$this->load->view('raport/cetak',$d);
                        
                         }else{
                    redirect('login');
		}                      
		
	}
                            
       
	
}

