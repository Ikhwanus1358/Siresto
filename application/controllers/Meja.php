<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meja extends CI_Controller 
{

  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('db2',TRUE);
  }

  public function index()
  {
    $data['title'] = 'Data Meja';
    $data['user'] = $this->db->get_where('t_pegawai', ['id_pegawai' => $this->session->userdata('id_pegawai')])->row_array();
    $data['meja'] = $this->db->get('t_meja')->result_array();

  
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('meja/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah() {
    $no_meja = $this->input->post('no');
    $jumlah_kursi = $this->input->post('kursi');
    $status = $this->input->post('status');

    if(empty($jumlah_kursi) || empty($status)) {
      $this->session->set_flashdata('tambah', 'Data Yang Anda Masukkan Tidak Valid!');
      redirect('meja');
    } else {   
      $data = [
        'no_meja' => $no_meja,
        'jumlah_kursi' => $jumlah_kursi,
        'status' => $status
      ];
      $this->db->insert('t_meja', $data);

      $this->session->set_flashdata('message', 'Ditambahkan');
      redirect('meja');
    }
  }

    public function edit() {
      $no_meja = $this->input->post('no');
      $jumlah_kursi = $this->input->post('kursi');
      $status = $this->input->post('status');
  
      if(empty($no_meja) || empty($jumlah_kursi) || empty($status)) {
        $this->session->set_flashdata('tambah', 'Data Yang Anda Masukkan Tidak Valid!');
        redirect('meja');
      } else {   
        $data = [
          'no_meja' => $no_meja,
          'jumlah_kursi' => $jumlah_kursi,
          'status' => $status
        ];
        $this->db->where('no_meja', $no_meja);
        $this->db->update('t_meja', $data);
  
        $this->session->set_flashdata('message', 'Diedit');
        redirect('meja');
      }
    }

    public function hapus($no_meja) {
      $this->db->where('no_meja', $no_meja);
      $this->db->delete('t_meja');

      $this->session->set_flashdata('message', 'Dihapus');
      redirect('meja');
    }

}