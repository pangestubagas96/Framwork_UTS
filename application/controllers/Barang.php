<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function index($id)
	{
		
		$this->load->model('Kategori_Model');
		$data["barang_list"] = $this->Kategori_Model->getBarangByKategori($id);
		$this->load->view('barang',$data);	
	
	}

	public function create($id)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->load->model('Kategori_model');
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_barang_view');

		}else{
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']  = 1000000;
			$config['max_width']  = 10240;
			$config['max_height']  = 7680;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('userfile')){
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('tambah_barang_view', $error);
			}
			else{
				$this->Kategori_model->insertBarang($id);	
				$this->load->view('tambah_barang_sukses');
			}
		}
	}
	public function delete($id)
	{
		//$this->load->helper('url','form');
		$this->load->model('Kategori_model');
		$this->Kategori_model->deleteBarang($id);	
		// redirect('barang/index/'.$id);
	}	
}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */
 ?>