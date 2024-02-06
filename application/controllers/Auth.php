<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->db_2 = $this->load->database('db2',TRUE);
  }

 public function index()
 {
   $this->form_validation->set_rules('username', 'Username', 'trim|required');
   $this->form_validation->set_rules('password', 'Password', 'trim|required');

   if ($this->form_validation->run() == false) {
     $data['title'] = 'SI Resto | Login';
     $this->load->view('templates/auth_header', $data);
     $this->load->view('auth/login'); 
     $this->load->view('templates/auth_footer');
   } else {
     $this->login();
   }
 }

 public function login() 
 {
  $username = $this->input->post('username');
  $password = md5($this->input->post('password'));

  $user = $this->db->get_where('t_pegawai', ['id_pegawai' => $username])->row_array();

  
  if($password == $user['password'] && $username == $user['id_pegawai']) {
   $data = [
     'id_pegawai' => $user['id_pegawai'],
     'role_id' => $user['role_id']
   ];
   $this->session->set_userdata($data);
   redirect('dashboard');
  } else {
    $this->session->set_flashdata('login', 'Masukkan Id dan Password Yang Benar!');
     redirect('auth');
  }
}

  public function logout()
  {
    $this->session->unset_userdata('id_pegawai');
    $this->session->unset_userdata('role_id');
     redirect('auth');
  }

}