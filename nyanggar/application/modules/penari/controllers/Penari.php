<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penari extends CI_Controller {

	private $configadd;
	private $data;
	public function __construct()
		{
			parent::__construct();
		
			$this->load->model('m_penari');
			//$this->load->model(array('m_bidang'));
	}function load(){
		$this->restrict();
		$criteria = array(
			'id_penari' => $_SESSION['lstrpnr']['id']
			);
		$criteria2 = array(
			'id_penari' => $_SESSION['lstrpnr']['id']
			);
		$this->data['jumlahpertunjukan'] =  $this->m_penari->get_pertunjukan2($criteria)->num_rows();
		$this->data['jumlahles'] = $this->m_penari->get_les($criteria2)->num_rows();
		$this->data['kategori'] = $this->m_penari->get('kategori_tari','id_kategori_tari')->result_array();
		$this->data['provinsi'] = $this->m_penari->get_provinsi()->result_array();
		$this->data['kabupaten'] = $this->m_penari->get('regencies','id')->result_array();
		$this->data['kecamatan'] = $this->m_penari->get('districts','id')->result_array();
		$this->data['pelajaran'] = $this->m_penari->get_pelajaran()->result_array();
		$this->data['user'] = $this->m_penari->get_where($criteria,'penari')->result_array();
		$this->data['pelajaran'] = $this->m_penari->get_pelajaran()->result_array();
		$this->data['mengajar'] = $this->m_penari->get_mengajar($criteria)->result_array();
		$this->data['lokasi'] = $this->m_penari->get_lokasi($criteria)->result_array();
		$this->data['id'] = $_SESSION['lstrpnr']['id'];
		$this->data['les'] = $this->m_penari->get_les($criteria2)->result_array();
		$this->data['pertunjukan'] = $this->m_penari->get_pertunjukan($criteria)->result_array();
		$this->data['pertunjukan2'] = $this->m_penari->get_pertunjukan2($criteria)->result_array();
		$this->data['model'] = $this->m_penari;
	}
	public function index()
	{
		$this->restrict();
		$this->data['active'] = 'home';
		$this->load();
		$this->blade->render('halamanpenari',array('penari' => $this->data));
	}function restrict(){
		if (!isset($_SESSION['lstrpnr'])) {
			# code...
			redirect('masuk');
		}
	}function add($criteria,$table){
		
		$criteria2 = array();
		foreach ($criteria as $key) {
			$criteria2[$key['field']] = $key['post'];
		}
		$add = $this->m_penari->save($criteria2,$table);
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
		$add = $this->m_penari->update($table,$primary,$kode,$criteria2);
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
		$id = $this->input->post('id');
		$this->restrict();
		$criteria = array(
			'id_penari' => $_SESSION['lstrpnr']['id']
			);
		$gambara = $this->m_penari->get_where($criteria,'penari')->result_array();
		$this->load();
		$gambar = substr(str_shuffle('minhajul23313l6234estari182'),0,10).".jpg";
		$config['upload_path']          = './upload/penari/';
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
		                'field' => 'tanggal_lahir',
		                'post'	=> date('Y-d-m',strtotime($this->input->post('ttl')))
		        ),array(
		                'form' => 'alamat',
		                'label' => 'Alamat',
		                'rules' => 'required|trim',
		                'field' => 'alamat',
		                'post' => $this->input->post('alamat')
		        ),array(
		                'form' => 'namabank',
		                'label' => 'Nama Bank',
		                'rules' => '',
		                'field' => 'nama_bank',
		                'post' => $this->input->post('namabank')
		        ),array(
		                'form' => 'nomor',
		                'label' => 'Nomor KTP',
		                'rules' => 'integer',
		                'field' => 'nomor_ktp',
		                'post' => $this->input->post('nomor')
		        ),array(
		                'form' => 'nomorrekening',
		                'label' => 'Nomor Rekening',
		                'rules' => 'integer',
		                'field' => 'nomor_rekening',
		                'post' => $this->input->post('nomorrekening')
		        ),array(
		                'form' => 'namapemilik',
		                'label' => 'Nama Pemilik Rekening',
		                'rules' => '',
		                'field' => 'nama_pemilik_rekening',
		                'post' => $this->input->post('namapemilik')
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
			$update = $this->update('penari','id_penari',$id,$this->configadd);
			if ($update == true) {
				echo "add berhasil";
				$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible"> Update data profil berhasil ! </div> <br>');
				redirect('penari/viewprofil');
			}else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible"> Update data profil gagal ! </div> <br>');
				redirect('penari/viewprofil');
			}
		}else{
			//echo "validasi gagal";
			$this->session->set_flashdata('errorsprofil', validation_errors());
			redirect('penari/viewprofil');
		}
	}function pelajaran(){
		$this->restrict();
		$this->configadd = array(
		        array(
		                'form' => 'tarif',
		                'label' => 'Tarif Per Jam',
		                'rules' => 'required|trim|integer',
		                'field' => 'fee',
		                'post' => $this->input->post('tarif')
		        ),array(
		                'form' => 'mata',
		                'label' => 'Mata Pelajaran Tari',
		                'rules' => 'required|trim',
		                'field' => 'mata_pelajaran',
		                'post' => $this->input->post('mata')
		        ),array(
		                'form' => 'kategori',
		                'label' => 'Kategori Tari',
		                'rules' => 'required|trim',
		                'field' => 'id_kategori_tari',
		                'post' => $this->input->post('kategori')
		        ),array(
		                'form' => 'p',
		                'label' => 'Tarif Per Jam',
		                'rules' => '',
		                'field' => 'id_penari',
		                'post' => $_SESSION['lstrpnr']['id']
		        ),array(
		                'form' => 'jumlah',
		                'label' => 'Jumlah Pertemuan Minimal',
		                'rules' => 'required|trim|integer',
		                'field' => 'jumlah_pertemuan',
		                'post' => $this->input->post('jumlah')
		        ),array(
		                'form' => 'deskripsi',
		                'label' => 'Deskripso',
		                'rules' => 'required|trim',
		                'field' => 'detail',
		                'post' => $this->input->post('deskripsi')
		        )
		);
		$verifikasi = $this->validasi($this->configadd);
		if ($verifikasi == true) {
			# code...
			$update = $this->add($this->configadd,'mengajar');
			if ($update == true) {
				//echo "add berhasil";
				$this->session->set_flashdata('pesanpelajaran','<div class="alert alert-success alert-dismissible"> Tambah data mata pelajaran berhasil ! </div> <br>');
				redirect('penari/viewpelajaran');
			}else{
				$this->session->set_flashdata('pesanpelajaran','<div class="alert alert-danger alert-dismissible"> Tambah data mata pelajaran gagal ! </div> <br>');
				redirect('penari/viewpelajaran');
			}
		}else{
			//echo "validasi gagal";
				$this->session->set_flashdata('errors', validation_errors());
				redirect('penari/viewpelajaran');
		}
		
	}function viewpelajaran(){
		
		$this->load();
		$this->data['active'] = 'pelajaran';
		$this->blade->render('halamanpenari',array('penari' => $this->data));
	}function viewpertunjukan(){
		
		$this->load();
		$this->data['active'] = 'pertunjukan';
		$this->blade->render('halamanpenari',array('penari' => $this->data));
	}function viewprofil(){
		$this->load();
		$this->data['active'] = 'profil';
		$this->blade->render('halamanpenari',array('penari' => $this->data));

	}function viewruangles(){
		$this->load();
		$this->data['active'] = 'ruangles';
		$this->blade->render('halamanpenari',array('penari' => $this->data));

	}function viewruangpertunjukan(){
		$this->load();
		$this->data['active'] = 'ruangpertunjukan';
		$this->blade->render('halamanpenari',array('penari' => $this->data));

	}function deletemengajar(){
		$id = $this->uri->segment('3');
		echo $id;
		if ($this->m_penari->delete('id_mengajar',$id,'mengajar')) {
				$this->session->set_flashdata('hapusmengajar','<div class="alert alert-success alert-dismissible"> Data Mata Pelajaran Berhasil Dihapus ! </div> <br>');
				redirect('penari/viewpelajaran');
			}
	}function lokasi(){
		$this->restrict();
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
		        ),array(
		                'form' => '',
		                'label' => '',
		                'rules' => '',
		                'field' => 'id_penari',
		                'post' => $_SESSION['lstrpnr']['id']
		        )
		);
		$verifikasi = $this->validasi($this->configadd);
		if ($verifikasi == true) {
			# code...
			$update = $this->add($this->configadd,'lokasi_mengajar');
			if ($update == true) {
				//echo "add berhasil";
				$this->session->set_flashdata('pesanlokasi','<div class="alert alert-success alert-dismissible"> Tambah data lokasi mengajar berhasil ! </div> <br>');
				redirect('penari/viewpelajaran');
			}else{
				$this->session->set_flashdata('pesanlokasi','<div class="alert alert-danger alert-dismissible"> Tambah data lokasi mengajar gagal ! </div> <br>');
				redirect('penari/viewpelajaran');
			}
		}else{
			//echo "validasi gagal";
				$this->session->set_flashdata('errorslokasi', validation_errors());
				redirect('penari/viewpelajaran');
		}
		
	}function deletelokasimengajar(){
		$id = $this->uri->segment('3');
		if ($this->m_penari->delete('id_lokasi_mengajar',$id,'lokasi_mengajar')) {
				$this->session->set_flashdata('hapuslokasi','<div class="alert alert-success alert-dismissible"> Data Lokasi Mengajar Berhasil Dihapus ! </div> <br>');
				redirect('penari/viewpelajaran');
			}
	}function pertunjukan(){
		$this->restrict();
		$this->load();
		$gambar = substr(str_shuffle('minhajul23313l6234estari182'),0,10).".mp4";
		$config['upload_path']          = './upload/video/';
        $config['allowed_types']        = 'mp4|mkv|avi|mpeg';
        $config['max_size']             = 25000;
        $config['max_width']            = 99999999;
        $config['max_height']           = 99999999;
        $config['file_name']			= $gambar;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('video')) {
        	# code...
        }else{
        	$this->session->set_flashdata('errorsupload', '<div class="alert alert-danger alert-dismissible"> upload video tidak sesuai kualifikasi ! </div>');

        }
		$this->configadd = array(
		        array(
		                'form' => 'nama',
		               'label' => 'Nama Pertunjukan',
		                'rules' => 'required|trim',
		                'field' => 'nama_pertunjukan',
		                'post' => $this->input->post('nama')
		        ),array(
		                'form' => 'kategori',
		                'label' => 'Kategori Pertunjukan',
		                'rules' => 'required|trim',
		                'field' => 'id_kategori_tari',
		                'post' => $this->input->post('kategori')
		        ),array(
		                'form' => 'video',
		                'label' => 'Video Pertunjukan',
		                'rules' => '',
		                'field' => 'video_pertunjukan',
		                'post' => $gambar
		        ),array(
		                'form' => 'deskripsi',
		                'label' => 'Deskripsi Pertunjukan',
		                'rules' => 'required|trim',
		                'field' => 'detail_pertunjukan',
		                'post' => $this->input->post('deskripsi')
		        ),array(
		                'form' => 'fee',
		                'label' => 'Fee Pertunjukan',
		                'rules' => 'required|trim|integer',
		                'field' => 'fee',
		                'post' => $this->input->post('fee')
		        ),array(
		                'form' => '',
		                'label' => '',
		                'rules' => '',
		                'field' => 'id_penari',
		                'post' => $_SESSION['lstrpnr']['id']
		        )
		);
		$verifikasi = $this->validasi($this->configadd);
		if ($verifikasi == true) {
			# code...
			$update = $this->add($this->configadd,'pertunjukan');
			if ($update == true) {
				//echo "add berhasil";
				$this->session->set_flashdata('pesanpertunjukan','<div class="alert alert-success alert-dismissible"> Tambah data pertunjukan berhasil ! </div> <br>');
				redirect('penari/viewpertunjukan');
			}else{
				$this->session->set_flashdata('pesanpertunjukan','<div class="alert alert-danger alert-dismissible"> Tambah data pertunjukan gagal ! </div> <br>');
				redirect('penari/viewpertunjukan');
			}
		}else{
			//echo "validasi gagal";
				$this->session->set_flashdata('errorspertunjukan', validation_errors());
				redirect('penari/viewpertunjukan');
		}
		
	}function deletepertunjukan(){
		$id = $this->uri->segment('3');
		if ($this->m_penari->delete('id_pertunjukan',$id,'pertunjukan')) {
				$this->session->set_flashdata('hapuspertunjukan','<div class="alert alert-success alert-dismissible"> Data Pertunjukan Berhasil Dihapus ! </div> <br>');
				redirect('penari/viewpertunjukan');
			}
	}function editpertunjukan(){
		$this->restrict();
		$id = $this->input->post('id');
		$criteria = array(
			'id_pertunjukan' => $id
			);
		$gambara = $this->m_penari->get_where($criteria,'pertunjukan')->result_array();
		$this->load();
		$gambar = substr(str_shuffle('minhajul23313l6234estari182'),0,10).".mp4";
		$config['upload_path']          = './upload/video/';
        $config['allowed_types']        = 'mp4|mkv|avi|mpeg';
        $config['max_size']             = 20000;
        $config['max_width']            = 99999999;
        $config['max_height']           = 99999999;
        $config['file_name']			= $gambar;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('video')) {
        	# code...
        }else{
        	$gambar = $gambara[0]['video_pertunjukan'];
        	$this->session->set_flashdata('errorsupload', '<div class="alert alert-danger alert-dismissible"> upload video tidak sesuai kualifikasi ! </div>');
        }
		$this->configadd = array(
		        array(
		                'form' => 'nama',
		                'label' => 'Nama Pertunjukan',
		                'rules' => 'required|trim',
		                'field' => 'nama_pertunjukan',
		                'post' => $this->input->post('nama')
		        ),array(
		                'form' => 'kategori',
		                'label' => 'Kategori Pertunjukan',
		                'rules' => 'required|trim',
		                'field' => 'id_kategori_tari',
		                'post' => $this->input->post('kategori')
		        ),array(
		                'form' => 'video',
		                'label' => 'Video Pertunjukan',
		                'rules' => '',
		                'field' => 'video_pertunjukan',
		                'post' => $gambar
		        ),array(
		                'form' => 'deskripsi',
		                'label' => 'Deskripsi Pertunjukan',
		                'rules' => 'required|trim',
		                'field' => 'detail_pertunjukan',
		                'post' => $this->input->post('deskripsi')
		        ),array(
		                'form' => 'fee',
		                'label' => 'Fee Pertunjukan',
		                'rules' => 'required|trim|integer',
		                'field' => 'fee',
		                'post' => $this->input->post('fee')
		        ),array(
		                'form' => '',
		                'label' => '',
		                'rules' => '',
		                'field' => 'id_penari',
		                'post' => $_SESSION['lstrpnr']['id']
		        )
		);
		$verifikasi = $this->validasi($this->configadd);
		if ($verifikasi == true) {
			# code...
			$update = $this->update('pertunjukan','id_pertunjukan',$id,$this->configadd);
			if ($update == true) {
				//echo "add berhasil";
				$this->session->set_flashdata('pesanpertunjukan','<div class="alert alert-success alert-dismissible"> Update data pertunjukan berhasil ! </div> <br>');
				redirect('penari/viewpertunjukan');
			}else{
				$this->session->set_flashdata('pesanpertunjukan','<div class="alert alert-danger alert-dismissible"> Update data pertunjukan gagal ! </div> <br>');
				redirect('penari/viewpertunjukan');
			}
		}else{
			//echo "validasi gagal";
				$this->session->set_flashdata('errorspertunjukan', validation_errors());
				redirect('penari/viewpertunjukan');
		}
		
	}function accept(){
		$id = $this->uri->segment('3');
		$criteria = array(
			"status_pesan" => 'diterima'
			);
		$update = $this->m_penari->update('pesan_les','id_pesan_les',$id,$criteria);
		redirect('penari/viewruangles');
	}function tolak(){
		$id = $this->uri->segment('3');
		$criteria = array(
			"status_pesan" => 'ditolak'
			);
		$update = $this->m_penari->update('pesan_les','id_pesan_les',$id,$criteria);
		redirect('penari/viewruangles');
	}function acceptpertunjukan(){
		$id = $this->uri->segment('3');
		$criteria = array(
			"status_pesan" => 'diterima'
			);
		$update = $this->m_penari->update('pesan_pertunjukan','id_pesan_pertunjukan',$id,$criteria);
		redirect('penari/viewruangpertunjukan');
	}function tolakpertunjukan(){
		$id = $this->uri->segment('3');
		$criteria = array(
			"status_pesan" => 'ditolak'
			);
		$update = $this->m_penari->update('pesan_pertunjukan','id_pesan_pertunjukan',$id,$criteria);
		redirect('penari/viewruangpertunjukan');
	}
}
