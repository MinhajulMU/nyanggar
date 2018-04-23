<?php
class M_penari extends CI_Model{

	function __construct(){
		parent::__construct();
	}function save($criteria,$table){
		$this->db->insert($table,$criteria);
		return $this->db->insert_id();
	}function delete($primary,$kode,$table){
        $this->db->where($primary,$kode);
        $query = $this->db->delete($table);
        if ($query) {
            # code...
            return true;
        }
    }function get_where($criteria,$table){
      $this->db->select('*');
      $this->db->from($table);
      $this->db->where($criteria);
      return $this->db->get();
    }function update($table,$primary,$kode,$jenis){
        $this->db->where($primary,$kode);
        $this->db->update($table,$jenis);
        return true;
    }function get_pelajaran(){
      $this->db->select('*');
      $this->db->from('pelajaran');
      $this->db->order_by('id_pelajaran','desc');
      return $this->db->get();
    }function get_pertunjukan($criteria){
      $this->db->select('*');
      $this->db->from('pertunjukan');
      $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = pertunjukan.id_kategori_tari','left');
      $this->db->where($criteria);
      $this->db->order_by('id_pertunjukan','desc');
      return $this->db->get();
    }function get_pertunjukan2($criteria){
      $this->db->select('*,provinces.name as nama_provinsi, regencies.name as nama_kabupaten, districts.name as nama_kecamatan');
      $this->db->from('pesan_pertunjukan');
      $this->db->join('pertunjukan','pertunjukan.id_pertunjukan = pesan_pertunjukan.id_pertunjukan','left');
      $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = pertunjukan.id_kategori_tari','left');
      $this->db->join('users','users.id_users = pesan_pertunjukan.id_client','left');
      $this->db->join('pembayaran_pertunjukan','pembayaran_pertunjukan.id_pesan_pertunjukan = pesan_pertunjukan.id_pesan_pertunjukan','left');
      $this->db->join('provinces','provinces.id = pesan_pertunjukan.id_provinsi','left');
      $this->db->join('regencies','regencies.id = pesan_pertunjukan.id_kabupaten','left');
      $this->db->join('districts','provinces.id = pesan_pertunjukan.id_kecamatan','left');
      $this->db->where($criteria);
      $this->db->order_by('pesan_pertunjukan.id_pesan_pertunjukan','desc');
      return $this->db->get();
    }function get_mengajar($criteria){
      $this->db->select('*');
      $this->db->from('mengajar');
      $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = mengajar.id_kategori_tari','left');
      $this->db->where($criteria);
      $this->db->order_by('id_mengajar','desc');
      return $this->db->get();
    }function get($table,$primary){
      $this->db->select('*');
      $this->db->from($table);
      $this->db->order_by($primary,'desc');
      return $this->db->get();
    }function get_provinsi(){
      $this->db->select('*');
      $this->db->from('provinces');
      $this->db->where_in('id',array('31','33','51'));
      $this->db->order_by("id",'desc');
      return $this->db->get();
    }function get_lokasi($criteria){
      $this->db->select('*,regencies.name as nama_kabupaten, districts.name as nama_kecamatan');
      $this->db->from('lokasi_mengajar');
      $this->db->join('districts','districts.id = lokasi_mengajar.id_kecamatan','left');
      $this->db->join('regencies','regencies.id = lokasi_mengajar.id_kabupaten','left');
      $this->db->where($criteria);
      $this->db->order_by('id_lokasi_mengajar','desc');
      return $this->db->get();
    }function get_les($criteria){
      $this->db->select('*');
      $this->db->from('pesan_les');
      $this->db->join('mengajar','mengajar.id_mengajar = pesan_les.id_mengajar','left');
      $this->db->join('users','users.id_users = pesan_les.id_client','left');
      $this->db->join('pembayaran_les','pembayaran_les.id_pesan_les = pesan_les.id_pesan_les','left');
      $this->db->where($criteria);
      $this->db->order_by('pesan_les.id_pesan_les','desc');
      return $this->db->get();
    }
}