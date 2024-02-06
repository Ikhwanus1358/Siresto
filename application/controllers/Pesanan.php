<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller 
{

  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('db2',TRUE);
  }

  public function index()
  {
    $data['title'] = 'Data Pesanan';
    $data['user'] = $this->db->get_where('t_pegawai', ['id_pegawai' => $this->session->userdata('id_pegawai')])->row_array();
    $data['pesanan'] = $this->db->get('t_pesanan')->result_array();
    $data['menu'] = $this->db->get('t_menu')->result_array();
    $data['noMeja'] = $this->db->get('t_meja')->result_array();
  
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('pesanan/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah() {
    $no_pesanan = $this->input->post('no');
    $no_meja = $this->input->post('no_meja');
    $nama_pemesan = $this->input->post('nama');
    $status = $this->input->post('status');

    if(empty($no_meja) || empty($nama_pemesan) || empty($status)) {
      $this->session->set_flashdata('tambah', 'Data Yang Anda Masukkan Tidak Valid!');
      redirect('pesanan');
    } else {   
      $data = [
        'no_pesanan' => $no_pesanan,
        'no_meja' => $no_meja,
        'nama_pemesan' => $nama_pemesan,
        'status' => $status
      ];
      $this->db->insert('t_pesanan', $data);

      $this->session->set_flashdata('message', 'Ditambahkan');
      redirect('pesanan');
    }
  }

  public function edit() {
    $no_pesanan = $this->input->post('no');
    $no_meja = $this->input->post('no_meja');
    $nama_pemesan = $this->input->post('nama');
    $status = $this->input->post('status');

    if(empty($no_pesanan) || empty($no_meja) || empty($nama_pemesan) || empty($status)) {
      $this->session->set_flashdata('tambah', 'Data Yang Anda Masukkan Tidak Valid!');
      redirect('pesanan');
    } else {   
      $data = [
        'no_pesanan' => $no_pesanan,
        'no_meja' => $no_meja,
        'nama_pemesan' => $nama_pemesan,
        'status' => $status
      ];
      $this->db->where('no_pesanan', $no_pesanan);
      $this->db->update('t_pesanan', $data);

      $this->session->set_flashdata('message', 'Diedit');
      redirect('pesanan');
    }
  }

  public function hapus($no_pesanan) {
    $this->db->where('no_pesanan', $no_pesanan);
    $this->db->delete('t_pesanan');

    $this->session->set_flashdata('message', 'Dihapus');
    redirect('pesanan');
  }

  public function detail($no_pesanan)
  {
    $data['title'] = 'Detail Pesanan';
    $data['user'] = $this->db->get_where('t_pegawai', ['id_pegawai' => $this->session->userdata('id_pegawai')])->row_array();
    
    $data['detail'] = $this->db->get_where('t_detail_pesanan', ['no_pesanan' => $no_pesanan])->result_array();
    $data['kodeMenu'] = $this->db->get('t_menu')->result_array();
    $data['idPegawai'] = $this->db->get('t_pegawai')->result_array();

    // $queryIdDetail = "SELECT * FROM `t_detail_pesanan` 
    //                   FROM `t_detail_pesanan`
    //                   ORDER BY `id_detail` DESC LIMIT `1`";
    // $data['idDetail'] = $this->db->query($queryIdDetail)->result_array();

    $data['idDetail'] = $this->db->order_by('id_detail', "desc")->limit(1)->get('t_detail_pesanan')->result_array();

    $queryBayar = "SELECT
                  `t_menu`.`harga_menu`*
                  `t_detail_pesanan`.`qty` 
                  AS `total`, 
                  `t_detail_pesanan`.`id_detail`
                FROM
                  `t_menu`,
                  `t_detail_pesanan`
                WHERE `t_menu`.`kode_menu` = `t_detail_pesanan`.`kode_menu`";
    $data['bayar'] = $this->db->query($queryBayar)->result_array();

    $data['no_pesanan'] = $this->uri->segment(3);
  
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('pesanan/detail', $data);
    $this->load->view('templates/footer');
  }

  public function detailT() {
    $data['url'] = $this->uri->segment(3);
    $data['menu'] = $this->db->get('t_menu')->result_array();

    $id_detail = $this->input->post('id');
    $kode_menu = $this->input->post('kode_menu');
    $qty = $this->input->post('qty');
    $no_pesanan = $this->input->post('no');

    $sql = "UPDATE `t_menu` SET `jumlah_ketersediaan` = `jumlah_ketersediaan` - '$qty' WHERE `kode_menu` = '$kode_menu'";


    if(empty($kode_menu) || empty($qty)) {
      $this->session->set_flashdata('tambah', 'Data Yang Anda Masukkan Tidak Valid!');
      redirect(base_url()."pesanan/detail/".$no_pesanan);
    } else {   
      $data = [
        'id_detail' => $id_detail,
        'kode_menu' => $kode_menu,
        'qty' => $qty,
        'no_pesanan' => $no_pesanan
      ];
      $this->db->query($sql); 

      $this->db->insert('t_detail_pesanan', $data);

      $this->session->set_flashdata('message', 'Ditambahkan');
      redirect(base_url()."pesanan/detail/".$no_pesanan);
    }
  }

  public function hapusT($id_detail, $no_pesanan, $qty, $kode_menu) {
    $data['detail'] = $this->db->get_where('t_detail_pesanan', ['no_pesanan' => $no_pesanan])->result_array();

    $sql = "UPDATE `t_menu` SET `jumlah_ketersediaan` = `jumlah_ketersediaan` + '$qty' WHERE `kode_menu` = '$kode_menu'";
    $this->db->query($sql);

    $this->db->where('id_detail', $id_detail);
    $this->db->delete('t_detail_pesanan');

    $this->session->set_flashdata('message', 'Dihapus');
      redirect(base_url().'pesanan/detail/'.$no_pesanan);
  }

  public function editT() {
    $no_pesanan = $this->input->post('no');
    $id_detail = $this->input->post('id');
    $kode_menu = $this->input->post('kode');
    $qty = $this->input->post('qty');

    if(empty($id_detail) || empty($kode_menu) || empty($qty)) {
      $this->session->set_flashdata('tambah', 'Data Yang Anda Masukkan Tidak Valid!');
      redirect(base_url()."pesanan/detail/".$no_pesanan);
    } else {   
      $data = [
        'id_detail' => $id_detail,
        'no_pesanan' => $no_pesanan,
        'kode_menu' => $kode_menu,
        'qty' => $qty
      ];
      $this->db->where('id_detail', $id_detail);
      $this->db->update('t_detail_pesanan', $data);

      $this->session->set_flashdata('message', 'Diedit');
      redirect(base_url()."pesanan/detail/".$no_pesanan);
    }
  }

  public function bayar(){
    $no_pesanan = $this->input->post('no_pesanan');
    $no_transaksi = $this->input->post('no');
    $id_detail = $this->input->post('id');
    $id_pegawai = $this->input->post('id_pegawai');
    $tanggal = $this->input->post('tgl');
    $total_harga = $this->input->post('total');
    $metode_pembayaran = $this->input->post('metode');

    if(empty($id_detail) || empty($id_pegawai) || empty($tanggal) || empty($total_harga) || empty($metode_pembayaran)) {
      $this->session->set_flashdata('tambah', 'Data Yang Anda Masukkan Tidak Valid!');
      redirect('pesanan');
    } else {   
      $data = [
        'no_transaksi' => $no_transaksi,
        'id_detail' => $id_detail,
        'id_pegawai' => $id_pegawai,
        'tanggal' => $tanggal,
        'total_harga' => $total_harga,
        'metode_pembayaran' => $metode_pembayaran
      ];
      $this->db->insert('t_transaksi', $data);

      $this->session->set_flashdata('message', 'Ditambahkan');
      redirect(base_url()."pesanan/detail/".$no_pesanan);
   }
  }

}