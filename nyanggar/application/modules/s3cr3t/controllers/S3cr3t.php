<?php
class S3cr3t extends MX_Controller
	{

		private $inputs;
		public function __construct()
		{
			parent::__construct();
			$this->load->model('m_adminlestari');
		}public function index(){
			// renders /views/test.blade.php or /modules/test/views/test.blade.php
			$this->blade->render('home');
		}function validasi(){
        $this->form_validation->set_rules('username','Username','required|trim|max_length[50]');
        $this->form_validation->set_rules('password','Password','required|trim|max_length[50]');
       	$this->form_validation->set_error_delimiters("<div class='callout callout-danger' style='padding : 5px;margin-top : 0px;'>","</div>");

		}function auth(){
			$this->validasi();
			if($this->form_validation->run() == true){
				$username = $this->input->post('username');
				$password2 =  substr(md5($this->input->post('password')),0,20)."lestari";

				$criteria = array(
					'username' => $username,
					'password' => $password2
					);
				$datas = $this->m_adminlestari->get_where($criteria,'admin')->row_array();
				$jumlah = $this->m_adminlestari->get_where($criteria,'admin')->num_rows();
				if ($jumlah > 0) {
					
							$IDG = array(
								'lstr' => array(
									'id' => $datas['id_admin'],
									'nama' => $datas['nama_lengkap'],
									'alamat' => $datas['alamat'],
									'username' => $datas['username']
									)
								);
						 	$this->session->set_userdata($IDG);
						 	redirect('adminlestari/dashboard');
	 					

				}else{
					$this->session->set_flashdata("ggl","<div class='callout callout-danger' style='padding : 5px; margin-bottom : 10px;'>Login Gagal !</div>");
	        		$this->blade->render('home');
	        		
				}
			}else{

				$this->blade->render('home');
			}
		}function logout(){
			$this->session->unset_userdata('lstr');
			redirect('s3cr3t');
		}
	}