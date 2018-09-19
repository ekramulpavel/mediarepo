<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends CI_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->library('session');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->database();
    $this->load->model('User_model');
  }

  public function user_list()
  {
    $logged_in = $this->session->userData('logged_in');
    if ($logged_in==TRUE) {
      // $this->load->helper('url');
      if( $this->session->userData('user_type') == 'super'){
      $this->load->view('admin/header');
      $this->load->view('admin/user_list');
      $this->load->view('admin/footer');
    }else{
        redirect('user/my_file');
    }
    }
    else {
      redirect('login/index');
    }


  }
  function signup() {

    $this->form_validation->set_rules('txt_name','name', 'required');
    $this->form_validation->set_rules('txt_email','User email', 'required');
    $this->form_validation->set_rules('txt_password','Password', 'required');
    $this->form_validation->set_rules('txt_confirm_password', 'Password Confirmation', 'trim|required|matches[txt_password]');

    if ($this->form_validation->run() == FALSE) {
      // var_dump("hi");die();
      redirect('redirect/user_list');
    } else {
      //Setting values for tabel columns
      $data = array(
        'name' => $this->input->post('txt_name'),
        'email' => $this->input->post('txt_email'),
        'password' => md5($this->input->post('txt_password')),
        'user_type' =>$this->input->post('txt_type'),
      );
      //Transfering data to Model
      $this->User_model->insertUser($data);
      $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Inserted Successfully </div>');
      // //Loading View
      $this->load->view('admin/header');
      $this->load->view('admin/user_list',$data);
      $this->load->view('admin/footer');
    }
  }

}
