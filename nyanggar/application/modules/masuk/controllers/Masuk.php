<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk extends CI_Controller {


	private $inputs;
	public function __construct()
	{
			parent::__construct();
			$this->load->model('m_adminlestari');
	}
	public function index()
	{
		$this->blade->render('masuk');
	}function validasi(){
        $this->form_validation->set_rules('email','E-Mail','required|trim|max_length[50]|valid_email');
        $this->form_validation->set_rules('password','Kata Sandi','required|trim|max_length[50]');
       	$this->form_validation->set_error_delimiters("<div class='alert alert-danger' style='padding : 5px;margin-top : 0px;'>","</div>");

	}function authclient(){
			$this->validasi();
			$this->session->unset_userdata('lstrpnr');
			if($this->form_validation->run() == true){
				$email = $this->input->post('email');
				$password2 =  substr(md5($this->input->post('password')),0,20)."lestari";

				$criteria = array(
					'email' => $email,
					'password' => $password2
					);
				$datas = $this->m_adminlestari->get_where($criteria,'users')->row_array();
				$jumlah = $this->m_adminlestari->get_where($criteria,'users')->num_rows();
				if ($jumlah > 0) {
					
							$IDG = array(
								'lstrclnt' => array(
									'id' => $datas['id_users'],
									'nama' => $datas['nama_lengkap'],
									'email' => $datas['email'],
									'foto' =>$datas['foto']
									)
								);
						 	$this->session->set_userdata($IDG);
						 
						 	redirect('client/');
	 					

				}else{
					$this->session->set_flashdata("ggl","<div class='alert alert-danger' style='padding : 5px; margin-bottom : 10px;'>Username atau Password salah !</div>");
	        		$this->blade->render('masuk');
	        		
				}
			}else{

				$this->blade->render('masuk');
			}
		}function authpenari(){
			$this->validasi();
			$this->session->unset_userdata('lstrclnt');
			if($this->form_validation->run() == true){
				$email = $this->input->post('email');
				$password2 =  substr(md5($this->input->post('password')),0,20)."lestari";

				$criteria = array(
					'email' => $email,
					'password' => $password2
					);
				$datas = $this->m_adminlestari->get_where($criteria,'penari')->row_array();
				$jumlah = $this->m_adminlestari->get_where($criteria,'penari')->num_rows();
				if ($jumlah > 0) {
					
							$IDG = array(
								'lstrpnr' => array(
									'id' => $datas['id_penari'],
									'nama' => $datas['nama_lengkap'],
									'email' => $datas['email'],
									'foto' => $datas['foto']
									)
								);
						 	$this->session->set_userdata($IDG);
						 	
						 	redirect('penari/');
	 					

				}else{
					$this->session->set_flashdata("ggl","<div class='alert alert-danger' style='padding : 5px; margin-bottom : 10px;'>Username atau Password salah !</div>");
	        		$this->blade->render('masuk');
	        		
				}
			}else{

				$this->blade->render('masuk');
			}
		}function logoutclient(){
			$this->session->set_flashdata("lgtclnt","<div class='alert alert-success' style='padding : 5px; margin-bottom : 10px;'>Log Out Berhasil !</div>");
			$this->session->unset_userdata('lstrclnt');
			redirect('masuk');
		}function logoutpenari(){
			$this->session->set_flashdata("lgtpnr","<div class='alert alert-success' style='padding : 5px; margin-bottom : 10px;'>Log Out Berhasil  !</div>");
			$this->session->unset_userdata('lstrpnr');
			redirect('masuk');
		}
}
