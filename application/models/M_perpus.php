<?php
defined('BASEPATH') or exit('No direct Script access allowed');

class M_perpus extends CI_Model
{
	function edit_data($where,$stable){
		return $this->db->get_where($stable,$where);
	}

	function get_data($stable){
		return $this->db->get($stable);
	}//lanjutan model M_perpus setelah function get data
	function insert_data($data,$table){
		$this->db->insert($table,$data);
	}

	function update_data($table,$data,$where){
		$this->db->update($table,$data,$where);
	}

	function delete_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
	public function get_keyword($keyword){
		$this->db->select('*');
		$this->db->from('buku');
		$this->db->like('judul_buku',$keyword);
		$this->db->or_like('pengarang',$keyword);
		$this->db->or_like('penerbit',$keyword);
		$this->db->or_like('thn_terbit',$keyword);
		$this->db->or_like('isbn',$keyword);
		return $this->db->get()->result();
	}
	public function get_keyword_anggota($keyword_anggota){
		$this->db->select('*');
		$this->db->from('anggota');
		$this->db->like('nama_anggota',$keyword_anggota);
		$this->db->or_like('gender',$keyword_anggota);
		$this->db->or_like('no_telp',$keyword_anggota);
		$this->db->or_like('alamat',$keyword_anggota);
		$this->db->or_like('email',$keyword_anggota);
		return $this->db->get()->result();
	}
	public function insert_detail($where){
		$sql="insert into detail_pinjam (id_pinjam, id_buku, denda) select transaksi.id_pinjam, transaksi.id_buku, transaksi.denda from transaksi where transaksi.id_anggota='$where'";
		$this->db->query($sql);
	}

	public function find($where, $table){
		//query mencari record berdasarkan ID-nya

		$hasil=$this->db->where('id_buku', $where)
		->limit(1)
		->get($table);
		if($hasil->num_rows() >0){
			return $hasil->row();
		}else{
			return array();
		}
	}

	public function kosongkan_data($table){
		return $this->db->truncate($table);
	}

	public function kode_otomatis(){
		$this->db->select('right(id_pinjam,3) as kode', false);
		$this->db->order_by('id_pinjam', 'desc');
		$this->db->limit(1);
		$query=$this->db->get('peminjaman');

		if($query->num_rows()<>0){
			$data=$query->row();
			$kode=intval($data->kode)+1;
		}else{
			$kode=1;
		}

		$kodemax=str_pad($kode,3,"0", STR_PAD_LEFT);
		$kodejadi='PJ'.$kodemax;
		return $kodejadi;
	}
}
?>