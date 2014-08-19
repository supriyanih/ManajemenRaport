<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {

	
	public function index()
	{
            $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
            $d['prg']= $this->config->item('prg');
            
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			$d['content']=  $this->load->view('welcome',$d,true);
			$d['judul']=" Welcome..!";
            $this->load->view('home',$d);
            
            }else{
                redirect('login');
	}
	}
}

