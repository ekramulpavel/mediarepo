<?php

class User_Model extends CI_Model {

  function __construct(){

    parent::__construct();
    $this->load->database();
    $this->load->library('session');
      $this->load->model('Profile_model');
  }

  public function checkDuplicateEmail($post_email) {

    $this->db->where('email', $post_email);

    $query = $this->db->get('user');

    $count_row = $query->num_rows();

    if ($count_row > 0) {
      //if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
      return FALSE; // here I change TRUE to false.
    } else {
      // doesn't return any row means database doesn't have this email
      return TRUE; // And here false to TRUE
    }
  }

  //insert employee details to employee table
  public function insertUser(){
    $data = array(
      'name' => $this->input->post('txt_name'),
      'email' => $this->input->post('txt_email'),
      'password' => md5($this->input->post('txt_password')),
      'user_type' =>$this->input->post('txt_type'),
    );
    $this->db->insert('user',$data);
    }


  public function get_users()
  {
    return $this->db->get("user");
  }


  public function loginUser($username, $password){
      $profile = $this->get_profile();
    // var_dump($profile->result());die();
      if ($profile->num_rows() == 1) {
        foreach($profile->result() as $row){
        $profile_name = $row->pu_name;
        $profile_id = $row->pu_id;

      }
      // var_dump($profile_name);die();
      }
    $query = $this->db->get_where('user', array('name' => $username, 'password' => $password));

    if($query->num_rows() == 1){
      $userArr = array();
      foreach($query->result() as $row){
        $userArr[0] = $row->id;
        $userArr[1] = $row->name;
        $userArr[2] = $row->user_type;
      }

      $this->db->select('folders.name,folders.id');
      $this->db->from('folders');
      $this->db->where('folders.userid', 1);
      $this->db->where('folders.parentid', 0);
      $this->db->join('user', 'user.id = folders.userid');

      $get_folder = $this->db->get();
      $current_folder = array();
      foreach($get_folder->result() as $row){
        $temp_arr=array('name'=>$row->name,'id'=>$row->id);
        // $userArr[3] = ;
        // $userArr[4] = $row->id;
        // $current_folder.push($temp_arr)
        array_push($current_folder,$temp_arr);
      }
       if(isset($profile_name))
       {
        $userData = array(
        'id' => $userArr[0],
        'name' => $profile_name,
        'user_type' => $userArr[2],
        'folder_root_id' =>json_encode($current_folder),
        'logged_in'=> TRUE);
       }
       else{
      $userData = array(
        'id' => $userArr[0],
        'name' => $userArr[1],
        'user_type' => $userArr[2],
        'folder_root_id' =>json_encode($current_folder),
        'logged_in'=> TRUE
      );
      // var_dump($userData);die();
      }
  //     require('profile.php');
  // $test = new Profile();
  // $test->get_Image();
      // $this->Profile_model->
      // $this->get_image();
      $this->session->set_userdata($userData);

      return $query->result();
    }

    else{
      return false;
    }
  }

  public function get_email($email){

    $this -> db -> select('*');
    $this -> db -> from('user');
    $this -> db -> where('email = ' . "'" . $email . "'" );
    $query = $this->db->get();
    $res = $query->result();
    if(sizeof($res) > 0){
      $r = $query->result();
      //var_dump($r);die();
      $user=$r[0];
      $this->resetpassword($user);
      $info= "Password has been reset and has been sent to email id: ". $email;
      redirect('/login/forget?info=' . $info, 'refresh');
    }
    else{
      $error= "The email id you entered not found on our database ";
      redirect('/login/forget?error=' . $error, 'refresh');
    }

  }

  private function resetpassword($user)
  {
    date_default_timezone_set('GMT');
    $this->load->helper('string');
    $password= random_string('alnum', 16);
    $this->db->where('id', $user->id);
    $this->db->update('user',array('password'=>MD5($password)));
    $this->load->library('email');
    $this->email->from('deathkanji@gmail.com', 'Media repo');
    $this->email->to($user->email);
    $this->email->subject('Password reset');
    $this->email->message('You have requested the new password, Here is you new password:'. $password);
    $this->email->send();
  }
  // Update User information
  public function update() {
    $user_id = $this->input->post('user_id');
    $user_name = $this->input->post('edit_txt_name');
    $user_email = $this->input->post('edit_txt_email');
    $user_password = $this->input->post('edit_txt_password');

    if(strlen($user_password)==0){
      $user_data = array(
        'name' => $user_name,
        'email' => $user_email
      );
    }
    else{
      $user_data = array(
        'name' => $user_name,
        'email' => $user_email,
        'password' => md5($user_password),
      );
    }
    // var_dump($user_data);die();
    $this->db->where('id', $user_id);
    $this->db->update('user', $user_data);

  }

  public function delete_user($id){
    $this->db->where('id', $id);
    $this->db->delete('user');
  }

  public function create_folder(){
    $folder_name = $this->input->post('folder_name');
    $user_id=$_SESSION['id'];
    // $parent_id = $this->input->post('parentid');
    if(isset($folder_name)){
      $current_folder = json_decode($_SESSION['folder_root_id']);
      $parent_id=$current_folder[sizeof($current_folder)-1]->id;
      $root_folder = $this->make_root($current_folder = json_decode($_SESSION['folder_root_id'],true));
 // var_dump($root_folder);die();
      $folder_root_name=$current_folder[sizeof($current_folder)-1]->name;
      $folder_root_name =explode("/",$folder_root_name);
      $query =  $this->db->get_where('folders', array('name' => $folder_root_name[sizeof($folder_root_name)-1],'userid'=>'1'));
      foreach($query->result() as $row){
        $parent_id = $row->id;
      }
      $folder_array = array(
        'name' => $folder_name,
        'userid' => $user_id,
        'parentid' => $parent_id
      );

      if($this->db->insert('folders',$folder_array)){
        if (!is_dir('./'.$root_folder.'./' . $folder_name)) {
          mkdir('./'.$root_folder.'./' . $folder_name, 0777, TRUE);
        }
      }
    }
  }



  // File Insertion
  function insertFile()
  {
    $data = array(
      'f_name' => $this->input->post('name'),
      'user_id' => $this->input->get('userid'),
      'folder_id' => md5($this->input->get('filderid')),
      'create_date' =>$this->input->get('create'),
      'modified_date' =>$this->input->get('modify'),
    );

    $this->db->insert('files', $data);
  }



  // Get all folders
  public function get_allfolders(){
    $user_id = $_SESSION['id'];
    $segs = $this->uri->segment_array();
    $func =$this->uri->segment(3);
    if (intVal(end($segs)) > 0) {
      $parent_id=end($segs);
      if($func=='push'){
        $this->push_session($parent_id);
        $current_folder=json_decode($_SESSION['folder_root_id']);
$parent_id =$current_folder[sizeof($current_folder)-1]->id;
      }
      elseif ($func=="pop") {
        $this->pop_session($parent_id);
      }
    }else{
      $current_folder = json_decode($_SESSION['folder_root_id']);
      $parent_id=$current_folder[sizeof($current_folder)-1]->id;
    }
    $this->db->select('files.file_name ,files.create_date,files.folder_id,files.user_id ');
    $this->db->from('files');

    $this->db->where('files.folder_id', $parent_id);
    $query = $this->db->get();
    $res = $query->result();
    if ($query->num_rows() > 0) {
      $this->db->select('user.name as username,files.user_id ,folders.parentid,user.id,files.folder_id,folders.name as foldername, folders.id, files.id as id, files.file_name as filename,files.modified_date as date');
      $this->db->from('files');
      $this->db->join('folders', 'files.folder_id = folders.id', 'FULL OUTER JOIN');
// $this->db->join('folders', 'folders.userid = files.user_id','FULL OUTER JOIN');
      $this->db->join('user', 'files.user_id  = user.id','FULL OUTER JOIN');

      $this->db->where('files.folder_id  ', $parent_id);
$this->db->or_where('folders.parentid ', $parent_id);
      $query = $this->db->get();

      $res = $query->result();
//       $this->db->select('user.name as username, folders.id as id, folders.name as filename, folders.date as date');
//           $this->db->from('user');
//           $this->db->join('folders', 'folders.userid = user.id','FULL OUTER JOIN');
//           $this->db->where('folders.parentid ', $parent_id);
//           $query = $this->db->get();
// var_dump($res);die();
    }
else{
  $this->db->select('user.name as username, folders.id as id, folders.name as filename, folders.date as date');
      $this->db->from('user');
      $this->db->join('folders', 'folders.userid = user.id','FULL OUTER JOIN');
      $this->db->where('folders.parentid ', $parent_id);
      $query = $this->db->get();

  $res = $query->result();
}

// var_dump($res);die();
    return $res;

  }

  function  push_session($current_id){
    $this->db->select('*');
    $this->db->from('folders');
    $this->db->where('folders.id ', $current_id);
    $query= $this->db->get();
    $res = $query->result();
    $current_folder = json_decode($_SESSION['folder_root_id']);
    $parent_id=$current_folder[sizeof($current_folder)-1]->id;
    $parent_folder_name=$current_folder[sizeof($current_folder)-1]->name;
    foreach($res as $row){
      $temp_arr=array('name'=>$row->name,'id'=>$row->id);
      array_push($current_folder,$temp_arr);
    }
    $_SESSION['folder_root_id']=json_encode($current_folder);
  }

  function pop_session($current_id){
    $current_folder = json_decode($_SESSION['folder_root_id'],true);
    $len=count($current_folder);
    if($len>1){
      for ($i=0; $i<$len;$i++){
        if($current_folder[$i]['id']==$current_id){
          $temp =array_slice($current_folder,0,$i+1);
        }
      }
      $_SESSION['folder_root_id']=json_encode($temp);
      // $current_folder = json_decode($_SESSION['folder_root_id']);
    }
  }

public function make_root($arr){
  $root_folder ="/uploads";
  for($i =1;$i<count($arr);$i++){
      $root_folder .= "/".$arr[$i]["name"];
    }
return $root_folder;


  }

  public function get_myfolders()
  {
    $user_id = $_SESSION['id'];
    $segs = $this->uri->segment_array();

    // if (intVal(end($segs)) > 0) {
    //   $parent_id=end($segs);
    // }else{

      $current_folder = json_decode($_SESSION['folder_root_id']);
      $parent_id=$current_folder[sizeof($current_folder)-1]->id;
    // }

    // $this->db->select('*');
    // $this->db->from('folders');
    // $this->db->where('userid', $user_id);
    // $this->db->where('parentid', $parent_id);
    // $this->db->join('user', 'user.id = folders.userid');
    // $query= $this->db->get();
    // $res = $query->result();
    $this->db->select('files.user_id ,files.folder_id as parentid,files.id as id, files.file_name as filename,files.modified_date as date');
    $this->db->from('files');

    $this->db->where('files.user_id', $user_id);
    $query = $this->db->get();

    $res = $query->result();
    return $res;
  }

  function displayrecords()
  {
    $query=$this->db->query("select * from folders");
    return $query->result();
  }

    function get_profile()
    {
         $CI =& get_instance();
         $CI->load->model('Profile_model');
         return $CI->Profile_model->get_name();
    }

//     function get_image(){
//       $this->load->library('../controllers/profile');

// $obj = new $this->profile();

// $obj->get_Image();
    // }
}

?>
