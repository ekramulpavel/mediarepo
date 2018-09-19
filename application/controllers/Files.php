<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends CI_Controller  {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation','UploadHandler');
		$this->load->database();
		$this->load->model('User_model');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}


	public function displayAllFile()
	{
		$result=$this->User_model->get_allfolders();
// var_dump($result);die();
		if($result ){
			$arr=array();
			foreach ($result as $key => $value) {
				$arr['data'][]=array(
					'ID' => $value->id,
					'User_Name' =>$value->username,
					'File_Name' => $value->filename,
					'Date' => $value-> date
				);
			}
		}else{
			$arr['data']=array();
		}

		// $arr['session'][]=$_SESSION['folder_root_id'];
		echo json_encode($arr);
	}

	public function displayMyFile()	{
		$result=$this->User_model->get_myfolders();
		if($result ){
			$arr=array();
			foreach ($result as $key => $value) {

				$arr['data'][]=array(
					'ID' => $value->id,
					'User_Name' =>$value->parentid,
					'File_Name' => $value->filename,
					'Date' => $value->date
				);
			}
		}else{
			$arr['data']=array();
		}
		echo json_encode($arr);
	}

	public function json()
	{
// var_dump($_REQUEST);
 $root_folder = $this->User_model->make_root($current_folder = json_decode($_SESSION['folder_root_id'],true));
$root_folder =  $root_folder.'/';
// var_dump($root_folder);die();
		$options = [
			'script_url' => site_url($root_folder),
			'upload_dir' => APPPATH . '..'.$root_folder,
			'upload_url' => site_url($root_folder)
		];
// var_dump($options);die();
	$this->load->library('UploadHandler', $options);

// var_dump(json_decode($response));
// return $response;
	}


}
