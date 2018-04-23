<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangpertunjukan extends CI_Controller {

	private $data;
	private $configadd;
	private $configs;
	private $limitlestari = 10;
	public function __construct()
		{
			parent::__construct();
			$this->load->library('pagination');
			$this->load->library('pagination');
			$this->load->model('m_ruangpertunjukan');
			//$this->load->model(array('m_bidang'));
	}
	public function index()
	{
		$id = $this->uri->segment('3');

		if ($this->input->post('cari')) {
			# code...
			$this->data['page'] = $this->input->post('id');
			$criteria2= array(
				'pertunjukan.id_kategori_tari' => $id
				);
			$offset = $this->uri->segment(4);
			if(empty($offset)) $offset=0;
			$url = site_url('ruangpertunjukan/index/'.$id.'/');
			$jumlah = $this->m_ruangpertunjukan->jumlahcari($criteria2,$this->input->post('cari'))->num_rows();
			$this->pagination($url,$jumlah);
			$this->data['pagination'] = $this->pagination->create_links();
			$this->data['tunjukan'] = $this->m_ruangpertunjukan->cari_tunjuk_where($criteria2,$this->input->post('cari'),$this->limitlestari,$offset)->result_array();
		}else{
			if ($id == '') {
				redirect('ruangpertunjukan/index/5');
				}
				
				if ($id == '5') {
					# code...
				$this->data['page'] = 5;
				$offset = $this->uri->segment(4);
				if(empty($offset)) $offset=0;
				$url = site_url('ruangpertunjukan/index/'.$id.'/');
				$jumlah = $this->m_ruangpertunjukan->get_tunjuk()->num_rows();
				$this->pagination($url,$jumlah);
				$this->data['pagination'] = $this->pagination->create_links();
				$this->data['tunjukan'] = $this->m_ruangpertunjukan->get_tunjuk_limit($this->limitlestari,$offset)->result_array();
				}else{
					$criteria = array(
						'pertunjukan.id_kategori_tari' => $id
						);
					$this->data['page'] = 5;
					$offset = $this->uri->segment(4);
					if(empty($offset)) $offset=0;
					$url = site_url('ruangpertunjukan/index/'.$id.'/');
					$jumlah = $this->m_ruangpertunjukan->get_tunjuk_where_num($criteria)->num_rows();
					$this->pagination($url,$jumlah);
					$this->data['pagination'] = $this->pagination->create_links();
					$this->data['tunjukan'] = $this->m_ruangpertunjukan->get_tunjuk_where($criteria,$this->limitlestari,$offset)->result_array();
					$this->data['page'] = $id;
			}
		}
		
		$this->blade->render('ruangpertunjukan',array('tunjuk' => $this->data));
	}function pagination($url,$jumlah){
		$this->configs['base_url']= $url;
	    $this->configs['total_rows']= $jumlah;
	    $this->configs['per_page']=$this->limitlestari;
	    $this->configs['uri_segment']=4;
	   	$this->pagination->initialize($this->configs);
	}function detail(){
		$id = $this->uri->segment('3');
		$criteria = array(
			'id_pertunjukan' => $id
			);
		$this->data['tunjukan'] = $this->m_ruangpertunjukan->get_pertunjukan_detail($criteria)->result_array();
		$this->blade->render('ruangpertunjukan2',array('tunjuk' => $this->data));
	}function pesan(){
		$id = $this->uri->segment('3');
		$now = date('Y-m-d H:i:s');
		$criteria2 = array(
			'id_client' => $_SESSION['lstrclnt']['id'],
			'id_pertunjukan' => $id,
			'waktu_pesan' => $now,
			'status_pesan' => 'menunggu persetunjuan'
			);
		$simpan = $this->m_ruangpertunjukan->save($criteria2,'pesan_pertunjukan');
		if ($simpan> 0) {
			# code...
			$total = $this->m_ruangpertunjukan->get_where(array('id_pertunjukan'=> $id),'pertunjukan')->result_array();
			$now2 = date('Y-m-d H:i:s');
			$maks = date('Y-m-d H:i:s',strtotime('+1 days',strtotime($now2)));
			$criteria3 = array(
				'id_pesan_pertunjukan'=> $simpan,
				'id_rekening' => '3',
				'status_pembayaran' => 'belum_bayar',
				'maks_pembayaran' => $maks,
				'total_bayar' => $total[0]['fee']
				
				);
			$simpan2 = $this->m_ruangpertunjukan->save($criteria3,'pembayaran_pertunjukan');
			redirect('ruangpertunjukan/view_pesan/'.$simpan);	
		}
		
	}function view_pesan(){
		$this->data['page'] = 'home';
		$this->load_pesan();
		$this->blade->render('ruangpertunjukan3',array('pesan' => $this->data));
	}function view_rekening(){
		$this->data['page'] = 'profil';
		$this->load_pesan();
		$this->blade->render('ruangpertunjukan3',array('pesan' => $this->data));
	}function view_pembayaran(){
		$this->data['page'] = 'bayar';
		$this->load_pesan();
		$this->blade->render('ruangpertunjukan3',array('pesan' => $this->data));
	}function pesan2(){
		$id = $this->input->post('ids');
		$criteria = array(
			'tanggal_acara' => date("Y-m-d",strtotime($this->input->post('tanggal'))),
			'id_provinsi' => $this->input->post('provinsi'),
			'id_kabupaten' => $this->input->post('kabupaten'),
			'id_kecamatan' => $this->input->post('kecamatan'),
			'alamat_lengkap' => $this->input->post('alamat'),
			);

		$update = $this->m_ruangpertunjukan->update('pesan_pertunjukan','id_pesan_pertunjukan',$id,$criteria);
		#$this->data['page'] = 'profil';
		redirect('ruangpertunjukan/view_rekening/'.$id);
	}function load_pesan(){
		$id = $this->uri->segment('3');
		$criteria = array(
			'pesan_pertunjukan.id_pesan_pertunjukan' => $id
			);
	
		$this->data['provinsi'] = $this->m_ruangpertunjukan->get_provinsi()->result_array();
		$this->data['kabupaten'] = $this->m_ruangpertunjukan->get('regencies','id')->result_array();
		$this->data['kecamatan'] = $this->m_ruangpertunjukan->get('districts','id')->result_array();
		$this->data['pertunjukan'] = $this->m_ruangpertunjukan->get_pesan_pertunjukan($criteria)->result_array();
		$this->data['rekening'] = $this->m_ruangpertunjukan->get('rekening','id_rekening')->result_array();
	}function pesan3(){
		$id = $this->input->post('idh');
		$criteria = array(
			'id_rekening' => $this->input->post('rekening')
			);
		$update = $this->m_ruangpertunjukan->update('pembayaran_pertunjukan','id_pesan_pertunjukan',$id,$criteria);
		if ($update == true) {
			# code...
			redirect('ruangpertunjukan/view_pembayaran/'.$id);
		}
	}function upload(){
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
        	$criteria = array(
        		'bukti_transaksi' => $gambar,
        		'status_pembayaran' => 'menunggu_validasi'
        		);
        	$update = $this->m_ruangpertunjukan->update('pembayaran_pertunjukan','id_pesan_pertunjukan',$id,$criteria);
			if ($update == true) {
				# code...
				redirect('ruangpertunjukan/view_sukses/');
			}else{
				echo "gagal";
			}	
        }else{
        	redirect('ruangpertunjukan/view_pembayaran/'.$id);	
        }
	}function view_sukses(){
		$this->blade->render('ruangpertunjukan4');
	}
}
