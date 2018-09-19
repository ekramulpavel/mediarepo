<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->model('User_model');

  }

  public function index()
  {
    $this->load->view('header');
    $this->load->view('login_view');
    $this->load->view('footer');
  }


  public function login(){

    $this->form_validation->set_rules('txt_username','Username', 'trim|required');
    $this->form_validation->set_rules('txt_password','Password', 'trim|required');

    if($this->form_validation->run() == false){
      $this->load->view('header');
      $this->load->view('login_view');
      $this->load->view('footer');
    }else{

      $username = $this->input->post('txt_username');
      $password = md5($this->input->post('txt_password'));

      if($this->User_model->loginUser($username, $password)){

        $userInfo = $this->User_model->loginUser($username, $password);          


        $this->session->set_flashdata('login_msg', '<div class="alert alert-success text-center">Successfully logged in</div>');
        //$this->load->view('header');
        //$this->load->view('tasks_view');
        //$this->load->view('footer');
        $user_type = $this->session->userData('user_type');
        if($user_type=='super'){
          redirect('redirect/user_list');
        }
        else {
          redirect('user/my_file');
        }

      }else{
        $this->session->set_flashdata('login_msg', '<div class="alert alert-danger text-center">Login Failed!! Please try again.</div>');
        $this->load->view('header');
        $this->load->view('login_view');
        $this->load->view('footer');

      }
    }
  }

  function logout(){
    $userData = array(
      'id',
      'name',
      'user_type',
      'logged_in'
    );
    $this->session->unset_userdata($userData);
    $this->session->sess_destroy();
    redirect('/');
  }


  public function forget()
  {
    $data = array();
    if (isset($_GET['info'])) {
      $data['info'] = $_GET['info'];
    }
    if (isset($_GET['error'])) {
      $data['error'] = $_GET['error'];
    }
    $this->load->view('header');
    $this->load->view('login-forget',$data);
    $this->load->view('footer');
  }


  public function doforget()
  {
    $email= $this->input->post('email', TRUE);
    $q = $this->User_model->get_email($email);
  }

}
