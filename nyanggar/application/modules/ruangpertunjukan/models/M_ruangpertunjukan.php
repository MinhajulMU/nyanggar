<?php
class M_ruangpertunjukan extends CI_Model{

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
    }function get_penari($criteria,$limit,$offset){
      $this->db->select('*');
      $this->db->from('mengajar');
      $this->db->join('lokasi_mengajar','mengajar.id_penari = lokasi_mengajar.id_penari','left');
      $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = mengajar.id_kategori_tari','left');
      $this->db->join('penari','penari.id_penari = mengajar.id_penari','left');
      $this->db->where($criteria);
      $this->db->limit($limit,$offset);
      $this->db->order_by('id_mengajar','desc');
      return $this->db->get();
    }function jumlah_penari($criteria){
      $this->db->select('*');
      $this->db->from('mengajar');
      $this->db->join('lokasi_mengajar','mengajar.id_penari = lokasi_mengajar.id_penari','left');
      $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = mengajar.id_kategori_tari','left');
      $this->db->join('penari','penari.id_penari = mengajar.id_penari','left');
      $this->db->where($criteria);
      $this->db->order_by('id_mengajar','desc');
      return $this->db->get();
    }function update($table,$primary,$kode,$jenis){
        $this->db->where($primary,$kode);
        $this->db->update($table,$jenis);
        return true;
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
    }function caripenari($criteria,$cari,$limit,$offset){
        $this->db->select('*');
        $this->db->from('mengajar');
        $this->db->join('lokasi_mengajar','mengajar.id_penari = lokasi_mengajar.id_penari','left');
        $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = mengajar.id_kategori_tari','left');
        $this->db->join('penari','penari.id_penari = mengajar.id_penari','left');
        $this->db->group_start();
        $this->db->where($criteria);
        $this->db->like('nama_lengkap',$cari);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where($criteria);
        $this->db->like('mata_pelajaran',$cari);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where($criteria);
        $this->db->like('fee',$cari);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where($criteria);
        $this->db->like('detail',$cari);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where($criteria);
        $this->db->like('nama_kategori',$cari);
        $this->db->group_end();
        $this->db->limit($limit,$offset);
        $quer = $this->db->get();
        return $quer;
    }function numpenari($criteria,$cari){
        $this->db->select('*');
        $this->db->from('mengajar');
        $this->db->join('lokasi_mengajar','mengajar.id_penari = lokasi_mengajar.id_penari','left');
        $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = mengajar.id_kategori_tari','left');
        $this->db->join('penari','penari.id_penari = mengajar.id_penari','left');
        $this->db->group_start();
        $this->db->where($criteria);
        $this->db->like('nama_lengkap',$cari);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where($criteria);
        $this->db->like('mata_pelajaran',$cari);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where($criteria);
        $this->db->like('fee',$cari);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where($criteria);
        $this->db->like('detail',$cari);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where($criteria);
        $this->db->like('nama_kategori',$cari);
        $this->db->group_end();
        $quer =$this->db->get();
        return $quer;
    }function get_profil($criteria){
        $this->db->select('*');
        $this->db->from('mengajar');
        $this->db->join('lokasi_mengajar','mengajar.id_penari = lokasi_mengajar.id_penari','left');
        $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = mengajar.id_kategori_tari','left');
        $this->db->join('penari','penari.id_penari = mengajar.id_penari','left');
        $this->db->where($criteria);
        return $this->db->get();
    }function get_tunjuk(){
      $this->db->select('*');
      $this->db->from('pertunjukan');
      $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = pertunjukan.id_kategori_tari','left');
      $this->db->join('penari','penari.id_penari = pertunjukan.id_penari','left');
      $this->db->order_by('id_pertunjukan','desc');
      return $this->db->get();
    }function get_tunjuk_limit($limit,$offset){
      $this->db->select('*');
      $this->db->from('pertunjukan');
      $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = pertunjukan.id_kategori_tari','left');
      $this->db->join('penari','penari.id_penari = pertunjukan.id_penari','left');
      $this->db->limit($limit,$offset);
      $this->db->order_by('id_pertunjukan','desc');
      return $this->db->get();
    }function get_tunjuk_where_num($criteria){
      $this->db->select('*');
      $this->db->from('pertunjukan');
      $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = pertunjukan.id_kategori_tari','left');
      $this->db->join('penari','penari.id_penari = pertunjukan.id_penari','left');
      $this->db->where($criteria);
      $this->db->order_by('id_pertunjukan','desc');
      return $this->db->get();
    }function get_tunjuk_where($criteria,$limit,$offset){
      $this->db->select('*');
      $this->db->from('pertunjukan');
      $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = pertunjukan.id_kategori_tari','left');
      $this->db->join('penari','penari.id_penari = pertunjukan.id_penari','left');
      $this->db->where($criteria);
      $this->db->limit($limit,$offset);
      $this->db->order_by('id_pertunjukan','desc');
      return $this->db->get();
    }function cari_tunjuk_where($id, $cari,$limit,$offset){
      $this->db->select('*');
      $this->db->from('pertunjukan');
      $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = pertunjukan.id_kategori_tari','left');
      $this->db->join('penari','penari.id_penari = pertunjukan.id_penari','left');
      $this->db->group_start();
      $this->db->where($id);
      $this->db->like('nama_pertunjukan',$cari);
      $this->db->group_end();
      $this->db->or_group_start();
      $this->db->where($id);
      $this->db->like('nama_kategori',$cari);
      $this->db->group_end();
      $this->db->or_group_start();
      $this->db->where($id);
      $this->db->like('fee',$cari);
      $this->db->group_end();
      $this->db->limit($limit,$offset);
      $this->db->order_by('id_pertunjukan','desc');
      return $this->db->get();
    }function jumlahcari($id, $cari){
      $this->db->select('*');
      $this->db->from('pertunjukan');
      $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = pertunjukan.id_kategori_tari','left');
      $this->db->join('penari','penari.id_penari = pertunjukan.id_penari','left');
      $this->db->group_start();
      $this->db->where($id);
      $this->db->like('nama_pertunjukan',$cari);
      $this->db->group_end();
      $this->db->or_group_start();
      $this->db->where($id);
      $this->db->like('nama_kategori',$cari);
      $this->db->group_end();
      $this->db->or_group_start();
      $this->db->where($id);
      $this->db->like('fee',$cari);
      $this->db->group_end();
      $this->db->order_by('id_pertunjukan','desc');
      return $this->db->get();
    }function get_pertunjukan_detail($criteria){
      $this->db->select('*');
      $this->db->from('pertunjukan');
      $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = pertunjukan.id_kategori_tari','left');
      $this->db->join('penari','penari.id_penari = pertunjukan.id_penari','left');
      $this->db->where($criteria);
      return $this->db->get();
    }function get_pesan_pertunjukan($criteria){
      $this->db->select('*');
      $this->db->from('pesan_pertunjukan');
      $this->db->join('pertunjukan','pertunjukan.id_pertunjukan = pesan_pertunjukan.id_pertunjukan','left');
      $this->db->join('kategori_tari','kategori_tari.id_kategori_tari = pertunjukan.id_kategori_tari','left');
      $this->db->join('penari','penari.id_penari = pertunjukan.id_penari','left');
      $this->db->join('pembayaran_pertunjukan','pembayaran_pertunjukan.id_pesan_pertunjukan = pesan_pertunjukan.id_pesan_pertunjukan','left');
      $this->db->join('rekening','rekening.id_rekening = pembayaran_pertunjukan.id_rekening','left');
      $this->db->where($criteria);
      return $this->db->get();
    }
}