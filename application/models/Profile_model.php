<?php

class Profile_model extends CI_Model{

  function __construct(){

    parent::__construct();
    $this->load->database();
    $this->load->library('session');
    $this->load->library('upload');
  }




  public function insertUser()
  {
    $id = $_SESSION['id'];


    $name = $_FILES['insert_image']["name"];
   // var_dump($name);die();
    $target_dir =FCPATH ."images/".$name;
    move_uploaded_file($_FILES["insert_image"]["tmp_name"],$target_dir);



    $data = array(
      'full_name'	=>  $_POST['insert_txt_name'] ,
      'phone'     =>  $_POST['insert_txt_phone'],
      'image'     =>  $target_dir,
      'user_id'   =>  $_POST['insert_txt_user_id']
    );


    $this->db->where('user_id',$id);
    $q = $this->db->get('profile');

    if ( $q->num_rows() > 0 )
    {
      $this->db->where('user_id',$id);
      $this->db->update('profile',$data);
    } else {
      $this->db->set('user_id', $id);
      $this->db->insert('profile',$data);
    }
  }


  public function get_name()
  {
    $id = $_SESSION['id'];
    $this->db->select('user.id as u_id, profile.full_name as pu_name, profile.user_id as pu_id');
    $this->db->from('user');
    $this->db->join('profile', 'profile.user_id = user.id');
    $this->db->where('user.id', $id);

    return $this->db->get();

  }


  // public function get_image($data, $id){
  //   $id = $_SESSION['id'];
  //   // $this->db->select('image');
  //   // $this->db->from('profile');
  //   // $this->db->where('user_id', $id);

  //   // return $this->db->get();

  //    $this->db->set($data);
  //       $this->db->where('user.id', $id);
  //       if ($this->db->update('profile') ===true) {
  //           return true;
  //       }else{
  //           return false;
  //       }

  // }

    public function getImage(){

    $id = $_SESSION['id'];
    $this->db->select('image');
    $this->db->from('profile');
    $this->db->where('user_id', $id);
    // var_dump($id);die();
    $query = $this->db->get();

    $data = $query->result();

    return $data;
    }



}
?>
