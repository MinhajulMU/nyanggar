<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

	private $configadd;
	private $data;
	public function __construct()
		{
			parent::__construct();
		
			$this->load->model('m_client');
			//$this->load->model(array('m_bidang'));
	}public function index()
	{
		$this->restrict();
		$this->load();
		$this->data['active'] = 'home';
		$this->blade->render('halamanclient',array('client' => $this->data));
	}function load(){
		$this->restrict();
		$criteria = array(
			'id_users' => $_SESSION['lstrclnt']['id']
			);
		$criteria2 = array(
			'id_client' => $_SESSION['lstrclnt']['id']
			);
		$this->data['jumlahles'] = $this->m_client->get_where($criteria2,'pesan_les')->num_rows();
		$this->data['jumlahpertunjukan'] = $this->m_client->get_where($criteria2,'pesan_pertunjukan')->num_rows();
		$this->data['pesanan'] = $this->m_client->get_pesanan($criteria2)->result_array();
		$this->data['user'] = $this->m_client->get_where($criteria,'users')->result_array();
		$this->data['pertunjukan'] = $this->m_client->get_pertunjukan($criteria2)->result_array();

	}function restrict(){
		if (!isset($_SESSION['lstrclnt'])) {
			# code...
			redirect('masuk');
		}
	}function add($criteria,$table){
		
		$criteria2 = array();
		foreach ($criteria as $key) {
			$criteria2[$key['field']] = $key['post'];
		}
		$add = $this->m_client->save($criteria2,$table);
		if ($add  > 0) {
			return true;
		}else{
			return false;
		}
	}function update($table,$primary,$kode,$jenis){
		$criteria2 = array();
		foreach ($jenis as $key) {
			$criteria2[$key['field']] = $key['post'];
		}
		$add = $this->m_client->update($table,$primary,$kode,$criteria2);
		if ($add  ==  true) {
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
	}function profil(){
		$this->restrict();
		$criteria = array(
			'id_users' => $_SESSION['lstrclnt']['id']
			);
		$gambara = $this->m_client->get_where($criteria,'users')->result_array();
		$this->load();
		$gambar = substr(str_shuffle('minhajul23313l6234estari182'),0,10).".jpg";
		$config['upload_path']          = './upload/client/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1000000;
        $config['max_width']            = 99999999;
        $config['max_height']           = 99999999;
        $config['file_name']			= $gambar;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('foto')) {
        	# code...
        }else{
        	$gambar = $gambara[0]['foto'];
        }

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
		                'form' => 'ttl',
		                'label' => 'Tanggal Lahir',
		                'rules' => 'required|trim',
		                'field' => 'ttl',
		                'post'	=> date('Y-d-m',strtotime($this->input->post('ttl')))
		        ),array(
		                'form' => 'alamat',
		                'label' => 'Alamat',
		                'rules' => 'required|trim',
		                'field' => 'alamat',
		                'post' => $this->input->post('alamat')
		        ),array(
		                'form' => 'tentang',
		                'label' => 'Tentang Saya',
		                'rules' => '',
		                'field' => 'tentang_saya',
		                'post' => $this->input->post('tentang')
		        ),array(
		                'form' => 'foto',
		                'label' => 'Foto',
		                'rules' => '',
		                'field' => 'foto',
		                'post' => $gambar
		        ),
		);

		$verifikasi = $this->validasi($this->configadd);
		if ($verifikasi == true) {
			# code...
			$id = $_SESSION['lstrclnt']['id'];
			$update = $this->update('users','id_users',$id,$this->configadd);
			if ($update == true) {
				//echo "add berhasil";
				$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible"> Update data identitas client berhasil ! </div> <br>');
				redirect('client/viewclient');
			}else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible"> Update data identitas client gagal ! </div> <br>');
				redirect('client/viewclient');
			}
		}else{
			//echo "validasi gagal";
			$this->session->set_flashdata('errorsclient', validation_errors());
			redirect('client/viewprofil');
		}
	}function viewclient(){
		$this->load();
		$this->data['active'] = 'profil';
		$this->blade->render('halamanclient',array('client' => $this->data));

	}function viewles(){
		$this->load();
		$this->data['active'] = 'ruangles';
		$this->blade->render('halamanclient',array('client' => $this->data));

	}function viewpertunjukan(){
		$this->load();
		$this->data['active'] = 'pertunjukan';
		$this->blade->render('halamanclient',array('client' => $this->data));

	}function akhiriles(){
		$id = $this->uri->segment('3');
		$criteria = array(
			'status_pesan' => 'selesai'
		);
		$update = $this->m_client->update('pesan_les','id_pesan_les',$id,$criteria);
		if ($update == true) {
			# code...
			redirect('client/viewles');
		}
	}function akhiripertunjukan(){
		$id = $this->uri->segment('3');
		$criteria = array(
			'status_pesan' => 'selesai'
		);
		$update = $this->m_client->update('pesan_pertunjukan','id_pesan_pertunjukan',$id,$criteria);
		if ($update == true) {
			# code...
			redirect('client/viewpertunjukan');
		}
	}
}
