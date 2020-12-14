<?php defined('BASEPATH') or exit ('No Direct Script Access Allowed');

class Buku extends CI_controller
{

	function construct(){
						parent::_construct();
						// cek login
						if($this->session->userdata('status') !="Login"){
						$alert=$this->session->set_flashdata('alert','Anda belum Login');
						redirect(base_url());
						}
				}

		function index(){
			$data['anggota'] = $this->M_perpus->get_data('anggota')-> result();
			$data['buku'] = $this->M_perpus->get_data('buku')-> result();

			$data['header'] = 'Katalog Buku';
		}
		
		public function katalog_detail(){
			$id = $this->url->segment(3);
			$buku = $this->db->query('SELECT*from buku b, kategori k where b.id_kategori=k.id_kategori and b.id_buku='.$id)->result();

				foreach ($buku as $field) {
					$data['judul'] = $fields->judul_buku;
					$data['pengarang'] = $fields->pengarang;
					$data['penerbit'] = $fields->penerbit;
					$data['kategori'] = $fields->nama_kategori;
					$data['tahun'] = $fields->thn_terbit;
					$data['isbn'] = $fields->isbn;
					$data['gambar'] = $fields->gambar;
					$data['id'] = $id;
				}
				$this->load->view('desain');
				$this->load->view('toplayout');
				$this->load->view('detail_buku',$data);
		}
		public function search(){
			$keyword = $this->input->post('keyword');
			$data['buku'] = $this->M_perpus->get_keyword($keyword);
			$this->load->view('admin/header');
			$this->load->view('admin/buku',$data);
			$this->load->view('admin/footer');
		}				
	}
?>