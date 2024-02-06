<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendapatan extends CI_Controller 
{

  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('db2',TRUE);
    $this->load->model('Itemmodel');
  }

  public function index()
  {
    $data['title'] = 'Pendapatan';
    $data['user'] = $this->db->get_where('t_pegawai', ['id_pegawai' => $this->session->userdata('id_pegawai')])->row_array();
    $data['transaksi'] = $this->db->get('t_transaksi')->result_array();

    $queryPendapatan = "SELECT `tanggal`, SUM(`total_harga`)
                        AS `pendapatan` 
                        FROM `t_transaksi`
                        GROUP BY `tanggal`";
    $data['pendapatan'] = $this->db->query($queryPendapatan)->result_array();
  
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('pendapatan/index', $data);
    $this->load->view('templates/footer');
  }

  public function excel()
  {
   $query = $this->Itemmodel->eksport_data();

   if(!$query)
      return false;

    // Load library
    $this->load->library('PHPExcel');
    $this->load->library('PHPExcel/IOFactory');

    // Buat sebuah file Excel baru.
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setTitle("Laporan Pendapatan Restoran");
    $objPHPExcel->getProperties()->setDescription("Berisi data 
    total transaksi pelanggan perhari");
    $objPHPExcel->setActiveSheetIndex(0);

    // Header laporan
    $objPHPExcel->getActiveSheet()->setCellValue('A1','Laporan Pendapatan Restoran');
    $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

    // Tanggal laporan
    $today = date("d-m-Y");
    $objPHPExcel->getActiveSheet()->setCellValue('B3','Tanggal: '.$today);
    $objPHPExcel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);

    // Header tabel produk
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);

    $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(15);

    $objPHPExcel->getActiveSheet()->setCellValue('A5','Tanggal');
    $objPHPExcel->getActiveSheet()->setCellValue('B5','Pendapatan');
  
    $objPHPExcel->getActiveSheet()->getStyle('A5:B5')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    // Border header tabel
    $styleArray = array(
      'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb'=>'E1E0F7'),
      ),
      'borders' => array(
      'outline' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN,
          ),
        ),
      );
     
      $objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($styleArray);
      $objPHPExcel->getActiveSheet()->getStyle('B5')->applyFromArray($styleArray);

      // Isi tabel
      $fields = $query->list_fields();
      $row = 6;

      foreach($query->result() as $data)
      {
        $col = 0;
        foreach ($fields as $field)
        {
          $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
          $objPHPExcel->getActiveSheet()->getStyle("A".($row).":B".($row))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
          $col++;
        }
        $row++;
        }

        // Menuliskan skrip pada file yang telah dibuat.
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
        
        // Mendefinisikan header dan melakukan unggah secara otomatis.
        $filename='Laporan_Pendapatan_'.$today.'.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        ob_get_clean();
        $objWriter->save('php://output');

  }
}