<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AMS extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database('MIS');
		$this->load->library('session');
	}

	public function loginn($username, $password)
	{

		$query = $this->db->query("SELECT        LoginName, Password, Status, UserID
      FROM            tbl_User_Logins
      WHERE        (LoginName = '$username') AND (Password = '$password') and (imgUploadStatus = 1) ");

		if ($query->num_rows() > 0) {
			$result = $query->row();
			$session_data = array(
				'ImageUploadUserId' => $result->UserID,
				'user_name' => $result->LoginName,
				'userStus' => 1,
				'Status' => $result->Status,

			);
			$Status = $result->Status;

			//echo $Status;
			// Die;

			if ($Status == 0) {
				$this->session->set_flashdata('info', 'Your Account Has Been Disable');
				redirect('Login/page_dashboard');
			} else {
				if ($password == '123') {
					$this->session->set_flashdata('info', 'Please Change Your Password First');
				} else {
					$this->session->set_flashdata('info', 'Welcome in ImageUpload');
				}

				$this->session->set_userdata($session_data);
			}
		} else {
			//echo "Hello";
			//Die;

			$this->session->set_flashdata('info', 'Your User Name OR Password is In Correct ');
			redirect('');
		}
	}

	public function login2($data)
	{
		// print_r($data);
		// print_r("<br>");
		// print_r($data['id']);
		// die;
		$session_data = [
			'ImageUploadUserId' => $data['id'],
			// 'gradeName' => $data['gradeName'],
			'Username' => $data['picture']['name'],
			'CardNo' => $data['picture']['CardNo'],

			'deptid' => $data['companyInfo']['Department']['id'],
			'deptName' => $data['companyInfo']['Department']['name'],

			'sectionid' => $data['companyInfo']['Section']['id'],
			'sectionName' => $data['companyInfo']['Department']['name'],


		];
		$this->session->set_flashdata('info', 'Welcome to Forward Image Collaboration System.');
		$this->session->set_userdata($session_data);
		// redirect('EOT/hodVerfication');
		return true;
	}


	public function getImages()
    {
		$user_id = $this->session->userdata('ImageUploadUserId');
		$deptid = $this->session->userdata('deptid');
		$deptName = $this->session->userdata('deptName');
		$sectionid = $this->session->userdata('sectionid');
		$sectionName = $this->session->userdata('sectionName');
		$CardNo = $this->session->userdata('CardNo');
		if($CardNo == 129 || $CardNo == 10894){ //oman quality and zeeshan IT have access to all uploaded images
			$query = $this->db->query("SELECT * FROM dbo.View_imageUploader ORDER BY EntryDate DESC")->result_array();
			return $query;
		}else if($CardNo == 10926){ //nimra lab has access only to her own images 
			$query = $this->db->query("SELECT * FROM dbo.View_imageUploader WHERE (loginId = $user_id) ORDER BY EntryDate DESC" )->result_array();
			return $query;
		}else{
			$query = $this->db->query("SELECT * FROM dbo.View_imageUploader WHERE (deptId = $deptid) ORDER BY EntryDate DESC")->result_array();
			return $query;
		}

    }



	public function UploadPic($picture1, $description)
	{


		date_default_timezone_set('Asia/Karachi');
		$Date = date('Y/m/d h:i:s');
		$user_id = $this->session->userdata('ImageUploadUserId');
		$deptid = $this->session->userdata('deptid');
		$deptName = $this->session->userdata('deptName');
		$sectionid = $this->session->userdata('sectionid');
		$sectionName = $this->session->userdata('sectionName');
		

		$query2 = $this->db->query("INSERT INTO dbo.tbl_ImageUploaderApp(
              Picture
              ,EntryDate
			  ,User_ID
			  ,deptId
			  ,deptName
			  ,sectionId
			  ,sectionName
			  ,Description

			  )
            VALUES
              ('$picture1','$Date', $user_id, '$deptid', '$deptName', '$sectionid', '$sectionName', '$description' )");
		if ($query2) {
			$this->session->set_flashdata('info', 'Image uploaded successfully');
			return true;
		} else {
			$this->session->set_flashdata('error', 'File data could not be uploaded. Something went wrong!');
			return false;
		}
	}

	public function deleteitem($TID)
	{
		
	$query = $this->db->query("Delete from dbo.tbl_ImageUploaderApp where TID = '$TID'");
	return $query;
	}





	



	
}
