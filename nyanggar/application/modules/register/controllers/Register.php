<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	private $configadd;
	public function __construct()
		{
			parent::__construct();
		
			$this->load->model('m_register');
			//$this->load->model(array('m_bidang'));
	}public function index()
	{
		$this->blade->render('register0');
	}function add($criteria,$table){
		
		$criteria2 = array();
		foreach ($criteria as $key) {
			$criteria2[$key['field']] = $key['post'];
		}
		$add = $this->m_register->save($criteria2,$table);
		if ($add  > 0) {
			return true;
		}else{
			return false;
		}
	}function validasi($config){
		foreach ($config as $key) {
			$this->form_validation->set_rules($key['form'],$key['label'],$key['rules']);	
		}
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
		if($this->form_validation->run() == true){
			return true;
		}else{
			return false;
		}
	}function daftarpenari(){
		$this->configadd = array(
		        array(
		                'form' => 'nama',
		                'label' => 'Nama Lengkap',
		                'rules' => 'required|trim',
		                'field' => 'nama_lengkap',
		                'post' => $this->input->post('nama')
		        ),
		        array(
		                'form' => 'email',
		                'label' => 'E-Mail',
		                'rules' => 'required|valid_email|trim',
		                'field' => 'email',
		                'post' => $this->input->post('email')
		        ),
		        array(
		                'form' => 'nohp',
		                'label' => 'No HP',
		                'rules' => 'required|trim|integer',
		                'field' => 'nohp',
		                'post' => $this->input->post('nohp')
		        ),
		        array(
		                'form' => 'jkel',
		                'label' => 'Jenis Kelamin',
		                'rules' => 'required|trim',
		                'field' => 'jenis_kelamin',
		                'post' => $this->input->post('jkel')
		        ),
		        array(
		                'form' => 'password',
		                'label' => 'Password',
		                'rules' => 'required|trim',
		                'field' => 'password',
		                'post'	=> substr(md5($this->input->post('password')),0,20)."lestari"
		        )
		);
		$verifikasi = $this->validasi($this->configadd);
		if ($verifikasi == true) {
			# code...
			$add = $this->add($this->configadd,'penari');
			if ($add == true) {
				$this->blade->render('message');
			}else{

				redirect('register/penari');
			}
		}else{
			$this->blade->render('register');
		}
	}function penari(){
		$this->blade->render('register');
	}function client(){
		$this->blade->render('register2');
	}function daftarclient(){
		$this->configadd = array(
		        array(
		                'form' => 'nama',
		                'label' => 'Nama Lengkap',
		                'rules' => 'required|trim',
		                'field' => 'nama_lengkap',
		                'post' => $this->input->post('nama')
		        ),
		        array(
		                'form' => 'email',
		                'label' => 'E-Mail',
		                'rules' => 'required|valid_email|trim',
		                'field' => 'email',
		                'post' => $this->input->post('email')
		        ),
		        array(
		                'form' => 'nohp',
		                'label' => 'No HP',
		                'rules' => 'required|trim|integer',
		                'field' => 'nohp',
		                'post' => $this->input->post('nohp')
		        ),
		        array(
		                'form' => 'ttl',
		                'label' => 'Tanggal Lahir',
		                'rules' => 'required|trim',
		                'field' => 'ttl',
		                'post' => date('Y-m-d',strtotime($this->input->post('ttl'))) 
		        ),
		        array(
		                'form' => 'password',
		                'label' => 'Password',
		                'rules' => 'required|trim',
		                'field' => 'password',
		                'post'	=> substr(md5($this->input->post('password')),0,20)."lestari"
		        )
		);
		$verifikasi = $this->validasi($this->configadd);
		if ($verifikasi == true) {
			# code...
			$add = $this->add($this->configadd,'users');
			if ($add == true) {
				$this->blade->render('message');
			}else{

				redirect('register/client');
			}
		}else{
			$this->blade->render('register2');
		}
	}
}
