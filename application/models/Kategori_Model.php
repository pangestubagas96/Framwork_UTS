<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_Model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getDataKategori()
		{
			$this->db->select("id,nama");
			$query = $this->db->get('kategori');
			return $query->result();
		}

		public function getBarangByKategori($id)
		{
			$this->db->select("barang.id as id,kategori.nama as namaKategori, barang.nama as namaBarang,DATE_FORMAT(tanggal_beli,'%d-%m-%Y') as tanggalBeli, kode,foto, fk_kategori");
			$this->db->where('fk_kategori', $id);	
			$this->db->join('kategori', 'kategori.id = barang.fk_kategori', 'left');	
			$query = $this->db->get('barang');
			return $query->result();
		}
		public function getAnakByPegawai($idPegawai)
		{
			$this->db->select("pegawai.nama as namaPegawai, anak.nama as namaAnak,DATE_FORMAT(anak.tanggalLahir,'%d-%m-%Y') as tanggalLahir");
			$this->db->where('fk_pegawai', $idPegawai);	
			$this->db->join('pegawai', 'pegawai.id = anak.fk_pegawai', 'left');	
			$query = $this->db->get('anak');
			return $query->result();
		}


		public function insertKategori()
		{
			$object = array( 
				'nama'=>$this->input->post('nama')  
			);
			$this->db->insert('kategori', $object);
		}


		public function getKategori($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('kategori',1);
			return $query->result();

		}

		public function updateById($id)
		{
			$data = array(
				'nama' => $this->input->post('nama') 
				);
			$this->db->where('id', $id);
			$this->db->update('kategori', $data);
		}

		public function deleteById($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('kategori');
		}

		public function deleteBarang($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('barang');
		}

		public function insertBarang($id)
		{
			$object = array(
				'nama' => $this->input->post('nama'),
				'kode'=>$this->input->post('kode'), 
				'tanggal_beli'=>$this->input->post('tanggalBeli'), 
				'foto'=>$this->upload->data('file_name'),
				'fk_kategori' => $id
			);
			$this->db->insert('barang', $object);
		}

		public function insertAnak($idPegawai)
		{
			$object = array(
				'nama' => $this->input->post('nama'),
				'tanggalLahir'=>$this->input->post('tanggalLahir'), 
				'fk_pegawai' => $idPegawai 
			);
			$this->db->insert('anak', $object);
		}

}

/* End of file Pegawai_Model.php */
/* Location: ./application/models/Pegawai_Model.php */
 ?>