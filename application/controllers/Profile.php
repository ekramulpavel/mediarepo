<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Profile extends CI_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->library('session');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation', 'upload');
    $this->load->database();
    $this->load->model('Profile_model');
  }

  public function index()
  {
    $this->load->view('header');
    $this->load->view('login_view');
    $this->load->view('footer');
  }


  public function insert_user(){

    $this->Profile_model->insertUser();
    redirect('user/my_file');
  }




 public function get_Image() {

    $res = $this->Profile_model->getImage();
    return $res;
    // foreach ($res as $row) {
    //   $profile_image_location = $row->image;
    // }
    // // var_dump($profile_image_location);die();
    // $_SESSION["profile_image_location"] = $profile_image_location ;
    // var_dump($res);die();




// return $value = (string)$res;
// $value = $value ;
// var_dump($value);


// $array = array();
// $res = (object) $array;

// // return $array;
// var_dump($array);


   }

}

?>
