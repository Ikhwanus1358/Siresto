<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Itemmodel extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

 function eksport_data() {
  //  $this->db->select('no_transaksi, id_detail, id_pegawai, tanggal, total_harga, metode_pembayaran, besar_tunai, kembali');
  //  $this->db->from('t_transaksi');

  //  $queryPendapatan = "SELECT `tanggal`, SUM(`total_harga`)
  //                       AS `pendapatan` 
  //                       FROM `t_transaksi`
  //                       GROUP BY `tanggal`";
  // $this->db->query($queryPendapatan);

  $this->db->select('tanggal, SUM(total_harga)');
  $this->db->from('t_transaksi');
  $this->db->group_by('tanggal');
  return $this->db->get();
 }

}
