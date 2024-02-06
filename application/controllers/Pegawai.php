<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller 
{

  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('db2',TRUE);
  }

  public function index()
  {
    $data['title'] = 'Data Pegawai';
    $data['user'] = $this->db->get_where('t_pegawai', ['id_pegawai' => $this->session->userdata('id_pegawai')])->row_array();
    $data['pegawai'] = $this->db->get('t_pegawai')->result_array();

  
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('pegawai/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah() {
    $id_pegawai = $this->input->post('id');
    $nama_pegawai = $this->input->post('nama');
    $bagian = $this->input->post('bagian');
    $password = MD5($this->input->post('password'));
    $role_id = $this->input->post('role');

    if(empty($id_pegawai) || empty($nama_pegawai) || empty($bagian) || empty($password) || empty($role_id)) {
      $this->session->set_flashdata('tambah', 'Data Yang Anda Masukkan Tidak Valid!');
      redirect('pegawai');
    } else {   
      $data = [
        'id_pegawai' => $id_pegawai,
        'nama_pegawai' => $nama_pegawai,
        'bagian' => $bagian,
        'password' => $password,
        'role_id' => $role_id
      ];
      $this->db->insert('t_pegawai', $data);

      $this->session->set_flashdata('message', 'Ditambahkan');
      redirect('pegawai');
    }
  }

  public function edit() {
    $id_pegawai = $this->input->post('id');
    $nama_pegawai = $this->input->post('nama');
    $bagian = $this->input->post('bagian');
    $password = MD5($this->input->post('password'));
    $role_id = $this->input->post('role');

    if(empty($nama_pegawai) || empty($bagian) || empty($password) || empty($role_id)) {
      $this->session->set_flashdata('tambah', 'Data Yang Anda Masukkan Tidak Valid!');
      redirect('pegawai');
    } else {   
      $data = [
        'id_pegawai' => $id_pegawai,
        'nama_pegawai' => $nama_pegawai,
        'bagian' => $bagian,
        'password' => $password,
        'role_id' => $role_id
      ];
      $this->db->where('id_pegawai', $id_pegawai);
      $this->db->update('t_pegawai', $data);

      $this->session->set_flashdata('message', 'Diedit');
      redirect('pegawai');
    }
  }

  public function hapus($id_pegawai) {
    $this->db->where('id_pegawai', $id_pegawai);
    $this->db->delete('t_pegawai');

    $this->session->set_flashdata('message', 'Dihapus');
    redirect('pegawai');
  }

}