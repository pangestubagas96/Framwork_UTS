<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function index()
	{
		$this->load->model('Kategori_Model');
		$data["kategori_list"] = $this->Kategori_Model->getDataKategori();
		$this->load->view('kategori',$data);	
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->load->model('Kategori_model');
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_kategori_view');

		}else{
			$this->Kategori_model->insertKategori();
			$data["kategori_list"] = $this->Kategori_model->getDataKategori();	
			$this->load->view('kategori', $data);
		}
	}
	//method update butuh parameter id berapa yang akan di update
	public function update($id)
	{
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		//sebelum update data harus ambil data lama yang akan di update
		$this->load->model('Kategori_model');
		$data['kategori']=$this->Kategori_model->getKategori($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_kategori_view',$data);

		}else{
			$this->Kategori_model->updateById($id);
			$data["kategori_list"] = $this->Kategori_model->getDataKategori();	
			$this->load->view('kategori', $data);
			

		}
	}

	public function delete($id)
	{
		//$this->load->helper('url','form');
		$this->load->model('Kategori_model');
		$this->Kategori_model->deleteById($id);	
		redirect('kategori');
	}
}



 ?>