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
    }
}