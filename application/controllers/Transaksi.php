<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller 
{

  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('db2',TRUE);
  }

  public function index()
  {
    $data['title'] = 'Data Transaksi';
    $data['user'] = $this->db->get_where('t_pegawai', ['id_pegawai' => $this->session->userdata('id_pegawai')])->row_array();
    
    $queryTransaksi = "SELECT
                  `t_menu`.`harga_menu`*
                  `t_detail_pesanan`.`qty` AS `total`, 
                  `t_detail_pesanan`.`id_detail`
                  FROM
                  `t_menu`,
                  `t_detail_pesanan`
                  WHERE `t_menu`.`kode_menu` = `t_detail_pesanan`.`kode_menu`";

    $data['trans'] = $this->db->query($queryTransaksi)->result_array();

    $queryTransaksi = "SELECT `t_transaksi`.`no_transaksi`, `t_detail_pesanan`.`no_pesanan`, `t_transaksi`.`id_pegawai`, `t_transaksi`.`tanggal`, sum(`t_transaksi`.`total_harga`) 
    AS `total`, `t_transaksi`.`metode_pembayaran` 
    FROM `t_transaksi`, `t_detail_pesanan`, `t_menu` 
    WHERE `t_menu`.`kode_menu` = `t_detail_pesanan`.`kode_menu`
    AND `t_transaksi`.`id_detail` = `t_detail_pesanan`.`id_detail` 
    GROUP BY `t_detail_pesanan`.`no_pesanan`";
    $data['transaksi'] = $this->db->query($queryTransaksi)->result_array();
  
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('transaksi/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah() {
    $no_transaksi = $this->input->post('no');
    $id_detail = $this->input->post('id_detail');
    $id_pegawai = $this->input->post('id_pegawai');
    $tanggal = $this->input->post('tanggal');
    $total_harga = $this->input->post('harga');
    $metode_pembayaran = $this->input->post('metode');
    // $besar_tunai = $this->input->post('besar_tunai');
    // $kembali = $this->input->post('kembali');

    if(empty($id_detail) || empty($id_pegawai) || empty($tanggal) || empty($total_harga) || empty($metode_pembayaran)) {
      $this->session->set_flashdata('tambah', 'Data Yang Anda Masukkan Tidak Valid!');
      redirect('transaksi');
    } else {   
      $data = [
        'no_transaksi' => $no_transaksi,
        'id_detail' => $id_detail,
        'id_pegawai' => $id_pegawai,
        'tanggal' => $tanggal,
        'total_harga' => $total_harga,
        'metode_pembayaran' => $metode_pembayaran
        // 'besar_tunai' => $besar_tunai,
        // 'kembali' => $kembali
      ];
      $this->db->insert('t_transaksi', $data);

      $this->session->set_flashdata('message', 'Ditambahkan');
      redirect('transaksi');
    }
  }

  public function edit() {
    $no_transaksi = $this->input->post('no');
    $id_detail = $this->input->post('id_detail');
    $id_pegawai = $this->input->post('id_pegawai');
    $tanggal = $this->input->post('tanggal');
    $total_harga = $this->input->post('harga');
    $metode_pembayaran = $this->input->post('metode');

    if(empty($no_transaksi) || empty($id_detail) || empty($id_pegawai) || empty($tanggal) || empty($total_harga) || empty($metode_pembayaran)) {
      $this->session->set_flashdata('tambah', 'Data Yang Anda Masukkan Tidak Valid!');
      redirect('transaksi');
    } else {   
      $data = [
        'no_transaksi' => $no_transaksi,
        'id_detail' => $id_detail,
        'id_pegawai' => $id_pegawai,
        'tanggal' => $tanggal,
        'total_harga' => $total_harga,
        'metode_pembayaran' => $metode_pembayaran
      ];
      $this->db->where('no_transaksi', $no_transaksi);
      $this->db->update('t_transaksi', $data);

      $this->session->set_flashdata('message', 'Diedit');
      redirect('transaksi');
    }
  }

  public function hapus($no_transaksi) {
    $this->db->where('no_transaksi', $no_transaksi);
    $this->db->delete('t_transaksi');

    $this->session->set_flashdata('message', 'Dihapus');
    redirect('transaksi');
  }

}