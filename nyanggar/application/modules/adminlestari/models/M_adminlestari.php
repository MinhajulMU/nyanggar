<?php
class M_adminlestari extends CI_Model{
	private $table="tb_admin";
    private $primary="id_admin";

	function __construct(){
		parent::__construct();
	}function save($criteria,$table){
		$this->db->insert($table,$criteria);
		return $this->db->insert_id();
	}function selectadmin($limit,$offset){
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->limit($limit,$offset);
        $this->db->order_by('id_admin','desc');
        return $this->db->get();
    }function selectpelajaran($limit,$offset){
        $this->db->select('*');
        $this->db->from('pelajaran');
        $this->db->limit($limit,$offset);
        $this->db->order_by('id_pelajaran','desc');
        return $this->db->get();
    }function selectusers($limit,$offset){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->limit($limit,$offset);
        $this->db->order_by('id_users','desc');
        return $this->db->get();
    }function selectles($limit,$offset){
        $this->db->select('*');
        $this->db->from('pesan_les');
        $this->db->join('users','users.id_users = pesan_les.id_client','left');
        $this->db->join('pembayaran_les','pembayaran_les.id_pesan_les = pesan_les.id_pesan_les','left');
        $this->db->join('rekening','rekening.id_rekening = pembayaran_les.id_rekening_tujuan','left');
        $this->db->limit($limit,$offset);
        $this->db->order_by('pesan_les.id_pesan_les','desc');
        return $this->db->get();
    }function selectpertunjukan($limit,$offset){
        $this->db->select('*');
        $this->db->from('pesan_pertunjukan');
        $this->db->join('users','users.id_users = pesan_pertunjukan.id_client','left');
        $this->db->join('pembayaran_pertunjukan','pembayaran_pertunjukan.id_pesan_pertunjukan = pesan_pertunjukan.id_pesan_pertunjukan','left');
        $this->db->join('rekening','rekening.id_rekening = pembayaran_pertunjukan.id_rekening','left');
        $this->db->limit($limit,$offset);
        $this->db->order_by('pesan_pertunjukan.id_pesan_pertunjukan','desc');
        return $this->db->get();
    }function selectpenari($limit,$offset){
        $this->db->select('*');
        $this->db->from('penari');
        $this->db->limit($limit,$offset);
        $this->db->order_by('id_penari','desc');
        return $this->db->get();
    }function delete($primary,$kode,$table){
        $this->db->where($primary,$kode);
        $query = $this->db->delete($table);
        if ($query) {
            # code...
            return true;
        }
    }function cariadmin($cari,$limit,$offset){
         $this->db->select('*');
        $this->db->from('admin');
        $this->db->like('nama_lengkap',$cari);
        $this->db->or_like('email',$cari);
        $this->db->or_like('no_hp',$cari);
        $this->db->or_like('alamat',$cari);
        $this->db->or_like('username',$cari);
        $this->db->limit($limit,$offset);
        $quer = $this->db->get();
        return $quer;
    }function num_cariadmin($cari){
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->like('nama_lengkap',$cari);
        $this->db->or_like('email',$cari);
        $this->db->or_like('no_hp',$cari);
        $this->db->or_like('alamat',$cari);
        $this->db->or_like('username',$cari);
        $quer =$this->db->get();
        return $quer;
    }function cariusers($cari,$limit,$offset){
         $this->db->select('*');
        $this->db->from('users');
        $this->db->like('nama_lengkap',$cari);
        $this->db->or_like('email',$cari);
        $this->db->or_like('nohp',$cari);
        $this->db->or_like('ttl',$cari);
        $this->db->limit($limit,$offset);
        $quer = $this->db->get();
        return $quer;
    }function num_cariusers($cari){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->like('nama_lengkap',$cari);
        $this->db->or_like('email',$cari);
        $this->db->or_like('nohp',$cari);
        $this->db->or_like('ttl',$cari);
        $quer =$this->db->get();
        return $quer;
    }function caripenari($cari,$limit,$offset){
         $this->db->select('*');
        $this->db->from('penari');
        $this->db->like('nama_lengkap',$cari);
        $this->db->or_like('email',$cari);
        $this->db->or_like('nohp',$cari);
        $this->db->or_like('jenis_kelamin',$cari);
        $this->db->limit($limit,$offset);
        $quer = $this->db->get();
        return $quer;
    }function num_caripenari($cari){
        $this->db->select('*');
        $this->db->from('penari');
        $this->db->like('nama_lengkap',$cari);
        $this->db->or_like('email',$cari);
        $this->db->or_like('nohp',$cari);
        $this->db->or_like('jenis_kelamin',$cari);
        $quer =$this->db->get();
        return $quer;
    }function cariles($cari,$limit,$offset){
        $this->db->select('*');
        $this->db->from('pesan_les');
        $this->db->join('users','users.id_users = pesan_les.id_client','left');
        $this->db->join('pembayaran_les','pembayaran_les.id_pesan_les = pesan_les.id_pesan_les','left');
        $this->db->join('rekening','rekening.id_rekening = pembayaran_les.id_rekening_tujuan','left');
        $this->db->like('nama_lengkap',$cari);
        $this->db->or_like('jumlah_bayar',$cari);
        $this->db->or_like('nama_bank',$cari);
        $this->db->or_like('status_pembayaran',$cari);
        $this->db->or_like('maks_pembayaran',$cari);
        $this->db->limit($limit,$offset);
        $quer = $this->db->get();
        return $quer;
    }function num_cariles($cari){
        $this->db->select('*');
        $this->db->from('pesan_les');
        $this->db->join('users','users.id_users = pesan_les.id_client','left');
        $this->db->join('pembayaran_les','pembayaran_les.id_pesan_les = pesan_les.id_pesan_les','left');
        $this->db->join('rekening','rekening.id_rekening = pembayaran_les.id_rekening_tujuan','left');
        $this->db->like('nama_lengkap',$cari);
        $this->db->or_like('jumlah_bayar',$cari);
        $this->db->or_like('nama_bank',$cari);
        $this->db->or_like('status_pembayaran',$cari);
        $this->db->or_like('maks_pembayaran',$cari);
        $quer =$this->db->get();
        return $quer;
    }function caripertunjukan($cari,$limit,$offset){
        $this->db->select('*');
        $this->db->from('pesan_pertunjukan');
        $this->db->join('users','users.id_users = pesan_pertunjukan.id_client','left');
        $this->db->join('pembayaran_pertunjukan','pembayaran_pertunjukan.id_pesan_pertunjukan = pesan_pertunjukan.id_pesan_pertunjukan','left');
        $this->db->join('rekening','rekening.id_rekening = pembayaran_pertunjukan.id_rekening','left');
        $this->db->like('nama_lengkap',$cari);
        $this->db->or_like('total_bayar',$cari);
        $this->db->or_like('nama_bank',$cari);
        $this->db->or_like('status_pembayaran',$cari);
        $this->db->or_like('maks_pembayaran',$cari);
        $this->db->limit($limit,$offset);
        $quer = $this->db->get();
        return $quer;
    }function num_caripertunjukan($cari){
        $this->db->select('*');
        $this->db->from('pesan_pertunjukan');
        $this->db->join('users','users.id_users = pesan_pertunjukan.id_client','left');
        $this->db->join('pembayaran_pertunjukan','pembayaran_pertunjukan.id_pesan_pertunjukan = pesan_pertunjukan.id_pesan_pertunjukan','left');
        $this->db->join('rekening','rekening.id_rekening = pembayaran_pertunjukan.id_rekening','left');
        $this->db->like('nama_lengkap',$cari);
        $this->db->or_like('total_bayar',$cari);
        $this->db->or_like('nama_bank',$cari);
        $this->db->or_like('status_pembayaran',$cari);
        $this->db->or_like('maks_pembayaran',$cari);
        $quer =$this->db->get();
        return $quer;
    }function caripelajaran($cari,$limit,$offset){
         $this->db->select('*');
        $this->db->from('pelajaran');
        $this->db->like('nama_pelajaran',$cari);
        $this->db->or_like('keterangan',$cari);
        $this->db->limit($limit,$offset);
        $quer = $this->db->get();
        return $quer;
    }function num_caripelajaran($cari){
        $this->db->select('*');
        $this->db->from('pelajaran');
        $this->db->like('nama_pelajaran',$cari);
        $this->db->or_like('keterangan',$cari);
        $quer =$this->db->get();
        return $quer;
    }function get_where($criteria,$table){
      $this->db->select('*');
      $this->db->from($table);
      $this->db->where($criteria);
      return $this->db->get();
    }function update($table,$primary,$kode,$jenis){
        $this->db->where($primary,$kode);
        $this->db->update($table,$jenis);
        return true;
    }function jumlah($table){
        $qq =  $this->db->get($table);
        return $qq->num_rows();
    }function select_table($table){
        $this->db->select('*');
        $this->db->from($table);
        return $this->db->get();
    }
}