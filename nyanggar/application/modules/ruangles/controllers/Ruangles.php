<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangles extends CI_Controller {

	private $data;
	private $configadd;
	private $configs;
	private $limitlestari = 10;
	public function __construct()
		{
			parent::__construct();
			$this->load->library('pagination');
			$this->load->model('m_ruangles');
			//$this->load->model(array('m_bidang'));
	}
	public function index()
	{
		$this->data['provinsi'] = $this->m_ruangles->get_provinsi()->result_array();
		$this->data['kabupaten'] = $this->m_ruangles->get('regencies','id')->result_array();
		$this->data['kecamatan'] = $this->m_ruangles->get('districts','id')->result_array();
		$this->blade->render('ruangles',array('les' => $this->data));
	}function add($criteria,$table){
		
		$criteria2 = array();
		foreach ($criteria as $key) {
			$criteria2[$key['field']] = $key['post'];
		}
		$add = $this->m_ruangles->save($criteria2,$table);
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
		$add = $this->m_ruangles->update($table,$primary,$kode,$criteria2);
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
	}function pagination($url,$jumlah){
		$this->configs['base_url']= $url;
	    $this->configs['total_rows']= $jumlah;
	    $this->configs['per_page']=$this->limitlestari;
	    $this->configs['uri_segment']=5;
	   	$this->pagination->initialize($this->configs);
	}function where($criteria,$table,$id,$limit,$offset){
		
		$criteria2 = array();
		if ($id == 5) {
			# code...
			foreach ($criteria as $key) {
			$criteria2[$key['field']] = $key['post'];
			}
		}else{
			foreach ($criteria as $key) {
				$criteria2[$key['field']] = $key['post'];
			}
			$criteria2['mengajar.id_kategori_tari'] = $id;
		}
		
		
		$jumlah = $this->m_ruangles->jumlah_penari($criteria2)->num_rows();
		if ($jumlah > 0) {
			# code...
			$this->data['jumlah'] = $jumlah;
			$this->data['daerah'] = $this->m_ruangles->get_penari($criteria2,$limit,$offset)->result_array();
			return true;
		}else{
			return false;
		}
	}function search($criteria,$cari,$id,$limit,$offset){
		$criteria2 = array();
		if ($id == 5) {
			# code...
			foreach ($criteria as $key) {
			$criteria2[$key['field']] = $key['post'];
			}
		}else{
			foreach ($criteria as $key) {
				$criteria2[$key['field']] = $key['post'];
			}
			$criteria2['mengajar.id_kategori_tari'] = $id;
		}
		
		$jumlah = $this->m_ruangles->numpenari($criteria2,$cari)->num_rows();
		if ($jumlah > 0) {
			# code...
			$this->data['jumlah'] = $jumlah;
			$this->data['daerah'] = $this->m_ruangles->caripenari($criteria2,$cari,$limit,$offset)->result_array();
			return true;
		}else{
			return false;
		}
	}function daerah(){

		if ($this->input->post('provinsi')) {
			# code...
			$this->configadd = array(
				        array(
				                'form' => 'provinsi',
				                'label' => 'Provinsi',
				                'rules' => 'required|trim|integer',
				                'field' => 'id_provinsi',
				                'post' => $this->input->post('provinsi')
				        ),array(
				                'form' => 'kabupaten',
				                'label' => 'Kabupaten',
				                'rules' => 'required|trim|integer',
				                'field' => 'id_kabupaten',
				                'post' => $this->input->post('kabupaten')
				        ),array(
				                'form' => 'kecamatan',
				                'label' => 'Kecamatan',
				                'rules' => 'required|trim|integer',
				                'field' => 'id_kecamatan',
				                'post' => $this->input->post('kecamatan')
				        )
			);
			$_SESSION['daerah'] = $this->configadd;
		}
		if ($this->input->post('provinsi')) {
			# code...
			$verifikasi = $this->validasi($this->configadd);
		}else{
			$verifikasi = $this->validasi($_SESSION['daerah']);
		}
		

		if ($verifikasi == true) {
			# code...
			redirect('ruangles/searchpenari/5');
		}else{
			$this->session->set_flashdata('errorslokasi', validation_errors());
			redirect('ruangles');
		}

	}function searchpenari(){
		$offset = $this->uri->segment(5);
		if(empty($offset)) $offset=0;
		$id = $this->uri->segment('3');
		$url = site_url('ruangles/searchpenari/'.$id.'/index/');
		
		$update = $this->where($_SESSION['daerah'],'lokasi_mengajar',$id,$this->limitlestari,$offset);				
		
		
		if ($update == true) {
				//echo "add berhasil";
				
				//$jumlah = $this->m_adminlestari->jumlah('admin');
				$this->pagination($url,$this->data['jumlah']);
				$this->data['kategori'] = $id;
				$this->data['pagination'] = $this->pagination->create_links();
				$this->blade->render('ruangles2',array('les' => $this->data));
			}else{
				$this->data['kategori'] = $id;
				$this->data['daerah'] = 'tidak ada';
				$this->blade->render('ruangles2',array('les' => $this->data));
		}
	}function cari(){
		$offset = $this->uri->segment(5);
		if(empty($offset)) $offset=0;
		$id = $this->uri->segment('3');
		if ($this->input->post('cari')) {
			# code...
			$cari = $this->input->post('cari');
			$_SESSION['cari'] = $this->input->post('cari');
		}else{
			$cari = $this->session->userdata('cari');	
		}
		$url = site_url('ruangles/cari/'.$id.'/index/');
		$update = $this->search($_SESSION['daerah'],$cari,$id,$this->limitlestari,$offset);
		//$this->session->set_userdata('cari',$cari);
		
		if ($update == true) {
				//echo "add berhasil";
				
				//$jumlah = $this->m_adminlestari->jumlah('admin');
				$this->pagination($url,$this->data['jumlah']);
				$this->data['kategori'] = $id;
				$this->data['pagination'] = $this->pagination->create_links();
				$this->blade->render('ruangles2',array('les' => $this->data));
			}else{
				$this->data['kategori'] = $id;
				$this->data['daerah'] = 'tidak ada';
				$this->blade->render('ruangles2',array('les' => $this->data));
		}
	}function profil(){
		$id = $this->uri->segment('3');
		$criteria = array(
			'id_mengajar' => $id
			);
		$this->data['profil'] = $this->m_ruangles->get_profil($criteria,'mengajar')->result_array();
		$this->blade->render('ruangles3',array('isi' => $this->data));
	}function insert_pesanan(){
		$id = $this->uri->segment('3');
		if (!isset($_SESSION['lstrclnt'])) {
			# code...
			redirect('masuk');
		}


		$now = date('Y-m-d H:i:s');
		$criteria = array(
			'id_client' => $_SESSION['lstrclnt']['id'],
			'id_mengajar' => $id,
			'tanggal_pesan' => $now,
			'status_pesan' => 'menunggu_konfirmasi'
			);
		$simpan = $this->m_ruangles->save($criteria,'pesan_les');
		if ($simpan > 0) {
			# code...
			$maks = date('Y-m-d H:i:s',strtotime('+1 days',strtotime($now)));
			$criteria2 = array(
				'id_pesan_les' => $simpan,
				'id_rekening_tujuan' => '3',
				'maks_pembayaran' => $maks,
				'status_pembayaran' => 'belum_bayar'
			);
			$simpan = $this->m_ruangles->save($criteria2,'pembayaran_les');
			redirect('ruangles/pesan/'.$simpan);
		}
		
	}
	function pesan(){
		$this->load_pesanan();
		$this->data['page'] = "home";
		$this->blade->render('ruangles4',array('pesan' => $this->data));
	}function detailpesanan(){
		$this->configadd = array(
		        array(
		                'form' => 'durasi',
		                'label' => 'Durasi Per Pertemuan',
		                'rules' => 'required|trim',
		                'field' => 'durasi_per_pertemuan',
		                'post' => $this->input->post('durasi')
		        ),
		        array(
		                'form' => 'jumlah',
		                'label' => 'Jumlah Pertemuan',
		                'rules' => 'required|trim',
		                'field' => 'jumlah_pertemuan_minimal',
		                'post' => $this->input->post('jumlah')
		        ),
		        array(
		                'form' => 'pesan',
		                'label' => 'Pesan Tambahan',
		                'rules' => '',
		                'field' => 'pesan',
		                'post' => $this->input->post('pesan')
		        )
		);
		$verifikasi = $this->validasi($this->configadd);
		if ($verifikasi == true) {
			# code...
			$add = $this->update('pesan_les','id_pesan_les',$this->input->post('id'),$this->configadd);
			if ($add == true) {
				//echo $this->input->post('id');
				redirect('ruangles/detail_jadwal_pesan/'.$this->input->post('id'));
			}else{
				
				redirect('ruangles/pesan/'.$this->input->post('id'));
			}
		}else{
			$this->load_pesanan();
			$this->data['page'] = 'home';
			$this->blade->render('ruangles4',array('pesan' => $this->data));
		}
	}function load_pesanan(){
			$id = $this->uri->segment('3');
			if (!isset($_SESSION['lstrclnt'])) {
				# code...
				redirect('masuk');
			}
			$criteria = array(
				'pesan_les.id_pesan_les'=> $id
				);
			$this->data['provinsi'] = $this->m_ruangles->get_provinsi()->result_array();
			$this->data['kabupaten'] = $this->m_ruangles->get('regencies','id')->result_array();
			$this->data['kecamatan'] = $this->m_ruangles->get('districts','id')->result_array();
			$this->data['bank'] = $this->m_ruangles->get('rekening','id_rekening')->result_array();
			$this->data['pesanan'] = $this->m_ruangles->get_pesanan($criteria)->result_array();
	}function detail_jadwal_pesan(){
		$this->load_pesanan();
		$this->data['page'] = 'jadwal';
		$this->blade->render('ruangles4',array('pesan' => $this->data));
	}function detailjadwal(){
		$this->configadd = array(
		        array(
		                'form' => 'tanggal',
		                'label' => 'Tanggal Pertemuan Pertama',
		                'rules' => 'required|trim',
		                'field' => 'tanggal_pertemuan_pertama',
		                'post' => date("Y-m-d",strtotime($this->input->post('tanggal')))
		        ),
		        array(
		                'form' => 'waktu',
		                'label' => 'Waktu Pertemuan Pertama',
		                'rules' => 'required|trim',
		                'field' => 'waktu_pertemuan_pertama',
		                'post' => $this->input->post('waktu')
		        )
		);
		$verifikasi = $this->validasi($this->configadd);
		if ($verifikasi == true) {
			# code...
			$add = $this->update('pesan_les','id_pesan_les',$this->input->post('id'),$this->configadd);
			if ($add == true) {
				
				redirect('ruangles/detail_lokasi/'.$this->input->post('id'));
			}else{
				
				redirect('ruangles/detailjadwal');
			}
		}else{
			$this->load_pesanan();
			$this->data['page'] = 'jadwal';
			$this->blade->render('ruangles4',array('pesan' => $this->data));
		}
	}function detail_lokasi(){
		$this->load_pesanan();
		$this->data['page'] = 'lokasi';
		$this->blade->render('ruangles4',array('pesan' => $this->data));
	}function detaillokasi(){
		$this->configadd = array(
		        array(
		                'form' => 'alamat',
		                'label' => 'Alamat Lengkap',
		                'rules' => 'required|trim',
		                'field' => 'alamat_lengkap',
		                'post' => $this->input->post('alamat')
		        ),array(
		                'form' => 'provinsi',
		                'label' => 'Provinsi',
		                'rules' => 'required|trim',
		                'field' => 'id_provinsi',
		                'post' => $this->input->post('provinsi')
		        ),array(
		                'form' => 'kabupaten',
		                'label' => 'Kabupaten',
		                'rules' => 'required|trim',
		                'field' => 'id_kabupaten',
		                'post' => $this->input->post('kabupaten')
		        ),array(
		                'form' => 'kecamatan',
		                'label' => 'Kecamatan',
		                'rules' => 'required|trim',
		                'field' => 'id_kecamatan',
		                'post' => $this->input->post('kecamatan')
		        )
		);
		$verifikasi = $this->validasi($this->configadd);
		if ($verifikasi == true) {
			# code...
			$add = $this->update('pesan_les','id_pesan_les',$this->input->post('id'),$this->configadd);
			if ($add == true) {
				$now = date('Y-m-d H:i:s');
				$maks = date('Y-m-d H:i:s',strtotime('+1 days',strtotime($now)));
				$id = $this->input->post('id');
				$criteria2 = array(
					'id_pesan_les' => $id
					);
				$pesann = $this->m_ruangles->get_where($criteria2,'pesan_les')->result_array();
				$durasi = $pesann[0]['durasi_per_pertemuan'];
				$jumlahp = $pesann[0]['jumlah_pertemuan_minimal'];
				$idm = $pesann[0]['id_mengajar'];
				$criteria3 = array(
					'id_mengajar' => $idm
					);
				$mengajarr = $this->m_ruangles->get_where($criteria3,'mengajar')->result_array();
				$fee = $mengajarr[0]['fee'];
				$jumlah_pembayaran = $durasi*$jumlahp*$fee;
				$criteria2 = array(
					'jumlah_bayar' => $jumlah_pembayaran
				);
				$this->m_ruangles->update('pembayaran_les','id_pesan_les',$this->input->post('id'),$criteria2);
				redirect('ruangles/bayar/'.$this->input->post('id'));
			}else{
				
				redirect('ruangles/detail_lokasi/'.$this->input->post('id'));
			}
		}else{
			$this->load_pesanan();
			$this->data['page'] = 'lokasi';
			$this->blade->render('ruangles4',array('pesan' => $this->data));
		}
	}function bayar(){
		$this->load_pesanan();
		$this->data['page'] = 'home';
		$this->blade->render('ruangles5',array('pesan' => $this->data));
	}function bayar2(){
		$id = $this->uri->segment('3');
		$this->configadd = array(
		        array(
		                'form' => '',
		                'label' => '',
		                'rules' => '',
		                'field' => 'id_rekening_tujuan',
		                'post' => $this->input->post('rekening')
		        )
		);
		$add = $this->update('pembayaran_les','id_pesan_les',$id,$this->configadd);
			if ($add == true) {
				$this->load_pesanan();
				$this->data['page'] = 'review';
				$this->blade->render('ruangles5',array('pesan' => $this->data));
			}else{
				
				redirect('review');
		}
	}function bayar3(){
		$this->load_pesanan();
		$this->data['page'] = 'upload';
		$this->blade->render('ruangles5',array('pesan' => $this->data));
	}function bayar4(){
		$id = $this->input->post('id');
		$gambar = substr(str_shuffle('minhajul23313l6234estari182'),0,10).".jpg";
		$config['upload_path']          = './upload/bukti/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1000000;
        $config['max_width']            = 99999999;
        $config['max_height']           = 99999999;
        $config['file_name']			= $gambar;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('foto')) {
        	# code...
        	$this->configadd = array(
		        array(
		                'form' => '',
		                'label' => '',
		                'rules' => '',
		                'field' => 'bukti_pembayaran',
		                'post' => $gambar
		        ),array(
		                'form' => '',
		                'label' => '',
		                'rules' => '',
		                'field' => 'status_pembayaran',
		                'post' => "menunggu_validasi"
		        )
			);
			$add = $this->update('pembayaran_les','id_pesan_les',$id,$this->configadd);
				if ($add == true) {
					$this->blade->render('ruangles6',array('pesan' => $this->data));
				}else{
					redirect('ruangles/bayar3/'.$id);
				}

        }else{
        	redirect('ruangles/bayar3/'.$id);
        }
	}function tes(){
		$this->blade->render('ruangles6');
	}
}
