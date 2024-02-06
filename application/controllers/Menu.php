<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller 
{

  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('db2',TRUE);
  }

  public function index()
  {
    $data['title'] = 'Data Menu';
    $data['user'] = $this->db->get_where('t_pegawai', ['id_pegawai' => $this->session->userdata('id_pegawai')])->row_array();
    $data['menu'] = $this->db->get('t_menu')->result_array();

  
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('menu/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah() {
    $kode_menu = $this->input->post('kode');
    $nama_menu = $this->input->post('nama');
    $harga_menu = $this->input->post('harga');
    $status = $this->input->post('status');
    $jumlah_ketersediaan = $this->input->post('jumlah');

    if(empty($kode_menu) || empty($nama_menu) || empty($harga_menu) || empty($status) || empty($jumlah_ketersediaan)) {
      $this->session->set_flashdata('tambah', 'Data Yang Anda Masukkan Tidak Valid!');
      redirect('menu');
    } else {   
      $data = [
        'kode_menu' => $kode_menu,
        'nama_menu' => $nama_menu,
        'harga_menu' => $harga_menu,
        'status' => $status,
        'jumlah_ketersediaan' => $jumlah_ketersediaan
      ];
      $this->db->insert('t_menu', $data);

      $this->session->set_flashdata('message', 'Ditambahkan');
      redirect('menu');
    }
  }

  public function edit() {
    $kode_menu = $this->input->post('kode');
    $nama_menu = $this->input->post('nama');
    $harga_menu = $this->input->post('harga');
    $status = $this->input->post('status');
    $jumlah_ketersediaan = $this->input->post('jumlah');

    if(empty($kode_menu) || empty($nama_menu) || empty($harga_menu) || empty($status) || empty($jumlah_ketersediaan)) {
      $this->session->set_flashdata('tambah', 'Data Yang Anda Masukkan Tidak Valid!');
      redirect('menu');
    } else {   
      $data = [
        'kode_menu' => $kode_menu,
        'nama_menu' => $nama_menu,
        'harga_menu' => $harga_menu,
        'status' => $status,
        'jumlah_ketersediaan' => $jumlah_ketersediaan
      ];
      $this->db->where('kode_menu', $kode_menu);
      $this->db->update('t_menu', $data);

      $this->session->set_flashdata('message', 'Diedit');      
      redirect('menu');
    }
  }

  public function hapus($kode_menu) {
    $this->db->where('kode_menu', $kode_menu);
    $this->db->delete('t_menu');

    $this->session->set_flashdata('message', 'Dihapus');
    redirect('menu');
  }

}