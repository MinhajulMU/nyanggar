<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlestari extends CI_Controller {

	private $posts;
	private $gambar;
	private $configadd;
	private $data;
	private $validasi;
	private $limitlestari = 10;

	public function __construct()
		{
			parent::__construct();
			$this->load->library('pagination');
			$this->load->model('m_adminlestari');
			//$this->load->model(array('m_bidang'));
	}public function index()
	{
		$this->blade->render('view');
	}function add($criteria,$table){
		
		$criteria2 = array();
		foreach ($criteria as $key) {
			$criteria2[$key['field']] = $key['post'];
		}
		$add = $this->m_adminlestari->save($criteria2,$table);
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
		$add = $this->m_adminlestari->update($table,$primary,$kode,$criteria2);
		if ($add  ==  true) {
			return true;
		}else{
			return false;
		}
	}function search(){

	}function validasi($config){
		foreach ($config as $key) {
			$this->form_validation->set_rules($key['form'],$key['label'],$key['rules']);	
		}
		$this->form_validation->set_error_delimiters("<div class='callout callout-danger'>","</div>");
		if($this->form_validation->run() == true){
			return true;
		}else{
			return false;
		}
	}function pagination($url,$jumlah){
		$this->configs['base_url']= $url;
	    $this->configs['total_rows']= $jumlah;
	    $this->configs['per_page']=$this->limitlestari;
	    $this->configs['uri_segment']=4;
	   	$this->pagination->initialize($this->configs);
	}function admin(){
		$offset = $this->uri->segment(4);
		if(empty($offset)) $offset=0;
		$data['admin'] = $this->m_adminlestari->selectadmin($this->limitlestari,$offset)->result_array();
		$url = site_url('adminlestari/admin/index/');
		$jumlah = $this->m_adminlestari->jumlah('admin');
		$this->pagination($url,$jumlah);
		if($this->input->get('id')){

			$criteria = array(
					'id_admin' => $this->input->get('id')
			);
				
			$data['update'] = $this->m_adminlestari->get_where($criteria,'admin')->result_array(); 
		}
		
		$data['pagination'] = $this->pagination->create_links();
		$this->blade->render('admin', array('isi' => $data));
	}function addadmin(){
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
		                'field' => 'no_hp',
		                'post' => $this->input->post('nohp')
		        ),
		        array(
		                'form' => 'alamat',
		                'label' => 'Alamat',
		                'rules' => 'required|trim',
		                'field' => 'alamat',
		                'post' => $this->input->post('alamat')
		        ),
		        array(
		                'form' => 'username',
		                'label' => 'Username',
		                'rules' => 'required|trim',
		                'field' => 'username',
		                'post' => $this->input->post('username')
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
			$add = $this->add($this->configadd,'admin');
			if ($add == true) {
				$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible"> Tambah data admin berhasil ! </div> <br>');
				redirect('adminlestari/admin');
			}else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible"> Tambah data admin gagal ! </div> <br>');
				redirect('adminlestari/admin');
			}
		}else{
			$this->blade->render('admin');
		}
	}function deleteadmin(){
		$id = $this->input->post('kode');
			

		if ($this->m_adminlestari->delete('id_admin',$id,'admin')) {
				$this->session->set_flashdata('hapus','<div class="alert alert-success alert-dismissible"> Data Admin Berhasil Dihapus ! </div> <br>');
				
			}
	}function editadmin(){
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
		                'field' => 'no_hp',
		                'post' => $this->input->post('nohp')
		        ),
		        array(
		                'form' => 'alamat',
		                'label' => 'Alamat',
		                'rules' => 'required|trim',
		                'field' => 'alamat',
		                'post' => $this->input->post('alamat')
		        ),
		        array(
		                'form' => 'username',
		                'label' => 'Username',
		                'rules' => 'required|trim',
		                'field' => 'username',
		                'post' => $this->input->post('username')
		        )
		);
		$verifikasi = $this->validasi($this->configadd);
		if ($verifikasi == true) {
			# code...
			$add = $this->update('admin','id_admin',$this->input->post('id'),$this->configadd);
			if ($add == true) {
				$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible"> Update data admin berhasil ! </div> <br>');
				redirect('adminlestari/admin');
			}else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible"> Update data admin gagal ! </div> <br>');
				redirect('adminlestari/admin');
			}
		}else{
			$this->blade->render('admin');
		}
	}function searchadmin(){
		$offset = $this->uri->segment(4);
		if(empty($offset)) $offset=0;
		if (isset($_POST['cari'])) {
			# code...
			$cari = $this->input->post('cari');	
			$this->session->set_userdata('cari',$cari);
		}else{
			$cari = $this->session->userdata('cari');
		}
		$url = site_url('adminlestari/searchadmin/index/');
		$jumlah = $this->m_adminlestari->num_cariadmin($cari)->num_rows();
		$this->pagination($url,$jumlah);
		$data['admin'] = $this->m_adminlestari->cariadmin($cari,$this->limitlestari,$offset)->result_array();
		$data['pagination'] = $this->pagination->create_links();
		$this->blade->render('admin', array('isi' => $data));
	}function users(){
		$offset = $this->uri->segment(4);
		if(empty($offset)) $offset=0;
		$data['admin'] = $this->m_adminlestari->selectusers($this->limitlestari,$offset)->result_array();
		$url = site_url('adminlestari/users/index/');
		$jumlah = $this->m_adminlestari->jumlah('users');
		$this->pagination($url,$jumlah);
		
		$data['pagination'] = $this->pagination->create_links();
		$this->blade->render('users', array('isi' => $data));
	}function deleteusers(){
		$id = $this->input->post('kode');

		if ($this->m_adminlestari->delete('id_users',$id,'users')) {
				$this->session->set_flashdata('hapus','<div class="alert alert-success alert-dismissible"> Data User Berhasil Dihapus ! </div> <br>');
				
			}
	}function searchusers(){
		$offset = $this->uri->segment(4);
		if(empty($offset)) $offset=0;
		if (isset($_POST['cari'])) {
			# code...
			$cari = $this->input->post('cari');
			$this->session->set_userdata('cari',$cari);
		}else{
			$cari = $this->session->userdata('cari');
		}
		$url = site_url('adminlestari/searchusers/index/');
		$jumlah = $this->m_adminlestari->num_cariusers($cari)->num_rows();
		$this->pagination($url,$jumlah);
		$data['admin'] = $this->m_adminlestari->cariusers($cari,$this->limitlestari,$offset)->result_array();
		$data['pagination'] = $this->pagination->create_links();
		$this->blade->render('admin', array('isi' => $data));
	}function penari(){
		$offset = $this->uri->segment(4);
		if(empty($offset)) $offset=0;
		$data['admin'] = $this->m_adminlestari->selectpenari($this->limitlestari,$offset)->result_array();
		$url = site_url('adminlestari/penari/index/');
		$jumlah = $this->m_adminlestari->jumlah('penari');
		$this->pagination($url,$jumlah);
		
		$data['pagination'] = $this->pagination->create_links();
		$this->blade->render('penari', array('isi' => $data));
	}function deletepenari(){
		$id = $this->input->post('kode');

		if ($this->m_adminlestari->delete('id_penari',$id,'penari')) {
				$this->session->set_flashdata('hapus','<div class="alert alert-success alert-dismissible"> Data Penari Berhasil Dihapus ! </div> <br>');
				
			}
	}function searchpenari(){
		$offset = $this->uri->segment(4);
		if(empty($offset)) $offset=0;
		if (isset($_POST['cari'])) {
			# code...
			$cari = $this->input->post('cari');
			$this->session->set_userdata('cari',$cari);
		}else{
			$cari = $this->session->userdata('cari');
		}
		$url = site_url('adminlestari/searchpenari/index/');
		$jumlah = $this->m_adminlestari->num_caripenari($cari)->num_rows();
		$this->pagination($url,$jumlah);
		$data['admin'] = $this->m_adminlestari->caripenari($cari,$this->limitlestari,$offset)->result_array();
		$data['pagination'] = $this->pagination->create_links();
		$this->blade->render('penari', array('isi' => $data));
	}
//======================================================================================
	function les(){
		$offset = $this->uri->segment(4);
		if(empty($offset)) $offset=0;
		$data['admin'] = $this->m_adminlestari->selectles($this->limitlestari,$offset)->result_array();
		$url = site_url('adminlestari/les/index/');
		$jumlah = $this->m_adminlestari->jumlah('pesan_les');
		$this->pagination($url,$jumlah);
		$data['pagination'] = $this->pagination->create_links();
		$this->blade->render('les', array('isi' => $data));
	}function deleteles(){
		$id = $this->input->post('kode');

		if ($this->m_adminlestari->delete('id_pesan_les',$id,'pesan_les')) {
				$this->session->set_flashdata('hapus','<div class="alert alert-success alert-dismissible"> Data Pesan Les Berhasil Dihapus ! </div> <br>');
				
			}
	}function searchles(){
		$offset = $this->uri->segment(4);
		if(empty($offset)) $offset=0;
		if (isset($_POST['cari'])) {
			# code...
			$cari = $this->input->post('cari');
			$this->session->set_userdata('cari',$cari);
		}else{
			$cari = $this->session->userdata('cari');
		}
		$url = site_url('adminlestari/searchles/index/');
		$jumlah = $this->m_adminlestari->num_cariles($cari)->num_rows();
		$this->pagination($url,$jumlah);
		$data['admin'] = $this->m_adminlestari->cariles($cari,$this->limitlestari,$offset)->result_array();
		$data['pagination'] = $this->pagination->create_links();
		$this->blade->render('les', array('isi' => $data));
	}function accept(){
		$id = $this->uri->segment('3');
		$criteria = array(
			'status_pembayaran' => 'verified',
			'id_admin' => $_SESSION['lstr']['id']
			);
		$update = $this->m_adminlestari->update('pembayaran_les','id_pembayaran_les',$id,$criteria);
		if ($update == 'true') {
			# code...
			redirect('adminlestari/les');

		}else{
			redirect('adminlestari/les');
		}

	}
	//==================================================================================
	//======================================================================================
	function pertunjukan(){
		$offset = $this->uri->segment(4);
		if(empty($offset)) $offset=0;
		$data['admin'] = $this->m_adminlestari->selectpertunjukan($this->limitlestari,$offset)->result_array();
		$url = site_url('adminlestari/les/index/');
		$jumlah = $this->m_adminlestari->jumlah('pesan_les');
		$this->pagination($url,$jumlah);
		$data['pagination'] = $this->pagination->create_links();
		$this->blade->render('pertunjukan', array('isi' => $data));
	}function deletepertunjukan(){
		$id = $this->input->post('kode');
		if ($this->m_adminlestari->delete('id_pesan_pertunjukan',$id,'pesan_pertunjukan')) {
				$this->session->set_flashdata('hapus','<div class="alert alert-success alert-dismissible"> Data Pemesanan Pertunjukan Berhasil Dihapus ! </div> <br>');
				
			}
	}function searchpertunjukan(){
		$offset = $this->uri->segment(4);
		if(empty($offset)) $offset=0;
		if (isset($_POST['cari'])) {
			# code...
			$cari = $this->input->post('cari');
			$this->session->set_userdata('cari',$cari);
		}else{
			$cari = $this->session->userdata('cari');
		}
		$url = site_url('adminlestari/searchpertunjukan/index/');
		$jumlah = $this->m_adminlestari->num_caripertunjukan($cari)->num_rows();
		$this->pagination($url,$jumlah);
		$data['admin'] = $this->m_adminlestari->caripertunjukan($cari,$this->limitlestari,$offset)->result_array();
		$data['pagination'] = $this->pagination->create_links();
		$this->blade->render('pertunjukan', array('isi' => $data));
	}function acceptpertunjukan(){
		$id = $this->uri->segment('3');
		$criteria = array(
			'status_pembayaran' => 'verified',
			'id_admin' => $_SESSION['lstr']['id']
			);
		$update = $this->m_adminlestari->update('pembayaran_pertunjukan','id_pembayaran_pertunjukan',$id,$criteria);
		if ($update == 'true') {
			# code...
			redirect('adminlestari/pertunjukan');

		}else{
			redirect('adminlestari/pertunjukan');
		}

	}function dashboard(){
		$data['jumlahuser'] = $this->m_adminlestari->select_table('users')->num_rows();
		$data['jumlahpenari'] = $this->m_adminlestari->select_table('penari')->num_rows();
		$data['jumlahpesanles'] = $this->m_adminlestari->select_table('pesan_les')->num_rows();
		$data['jumlahpesanpertunjukan'] = $this->m_adminlestari->select_table('pesan_pertunjukan')->num_rows();
		$this->blade->render('dashboard',array('jumlah' => $data));
	}
}
