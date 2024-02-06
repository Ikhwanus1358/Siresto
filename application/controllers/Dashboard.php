<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{

  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('db2',TRUE);
  }


  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['user'] = $this->db->get_where('t_pegawai', ['id_pegawai' => $this->session->userdata('id_pegawai')])->row_array();

    $data['t_menu'] = $this->db->get('t_menu')->result_array();
    $data['t_meja'] = $this->db->get('t_meja')->result_array();

    $data['queryMeja'] = $this->db->get_where('t_meja',array('status'=>'isi'))->result_array();

    $data['menu'] = $this->db2->query('select * from user_sub_menu')->result();

    $data['queryPesanan'] = $this->db->get_where('t_pesanan',array('status'=>'menunggu'))->result_array();

    $tgl = date("Y-m-d");
    $queryTransaksi = "SELECT `tanggal`, SUM(`total_harga`)
                        AS `total` 
                        FROM `t_transaksi`
                        WHERE `tanggal`='$tgl'
                        GROUP BY `tanggal`";
    $data['transaksi_harian'] = $this->db->query($queryTransaksi)->result_array();
  
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('dashboard/index', $data);
    $this->load->view('templates/footer');


  }

}