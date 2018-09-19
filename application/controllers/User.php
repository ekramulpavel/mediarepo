<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->library('session');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->database();
    $this->load->model('User_model');
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

      //Transfering data to Model
      $check_email_duplicate=$this->User_model->checkDuplicateEmail($this->input->post('txt_email'));
      if($check_email_duplicate){
        $this->User_model->insertUser();
      }

      redirect(site_url().'redirect/user_list');
    }
  }


  public function show_user() {

    // Datatables Variables
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));


    $users = $this->User_model->get_users();

    $data = array();
    $user_id = $this->session->userData('id');

    foreach($users->result() as $r) {
      $del_string=($user_id!=$r->id)?'<a class="btn-danger btn-sm text-light ml-2 delete" data-value="'.site_url() .'user/delete?id='.$r->id .'">Delete</a>':'';

      $data[] = array(
        $r->id,
        $r->name,
        $r->email,
        '<a class="btn-primary btn-sm text-light editmodal" data-toggle="modal" data-name="'.$r->name.'" data-email="'.$r->email .'"  data-id="'.$r->id .'" data-target="#EditFormModal">Edit</a>'.$del_string.''

      );
    }

    $output = array(
      "draw" => $draw,
      "recordsTotal" => $users->num_rows(),
      "recordsFiltered" => $users->num_rows(),
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }

  public function my_file()
  {
    if(isset($_SESSION['id'])){
      $this->load->view('admin/header');
      $this->load->view('admin/my_file');
      $this->load->view('admin/footer');
    }else{
      redirect('login/index');
    }
  }

  public function all_file()
  {
    if(isset($_SESSION['id'])){
      $this->load->view('admin/header');
      $this->load->view('admin/all_file');
      $this->load->view('admin/footer');
    }else{
      redirect('login/index');
    }
  }
  public function index(){


    if(isset($_SESSION['id'])){
      // echo $_SESSION['id'];
      $this->load->view('admin/header');
      $this->load->view('admin/user_list');
      $this->load->view('admin/footer');
    }else{
      redirect('login/index');
    }

  }

  public function update(){
    $this->form_validation->set_rules('edit_txt_name','Name', 'required');
    $this->form_validation->set_rules('edit_txt_email','Email', 'required');
    $this->form_validation->set_rules('edit_txt_password','Password', '');
		$result = $this->User_model->update();
		redirect(base_url('redirect/user_list'));
	}

  public function delete(){
    $id=$_GET['id'];
    $this->User_model->delete_user( $id );
    redirect(site_url().'redirect/user_list');
  }

  public function addnewfolder(){
    $this->User_model->create_folder();
    redirect('user/all_file');
  }


}
