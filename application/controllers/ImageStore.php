<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ImageStore extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('AMS', 'A');
		// $this->load->model('AMS', 'ID');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('page_dashboard');
	}
	public function test()
	{
		$this->load->view('test');
	}

    public function UploadPic()
	{
		// print_r($_FILES);die;

		$picture1 = '';
		if (!empty($_FILES['image']['name'])) {
			$config['upload_path'] = 'assets\img\FTC';
			$config['allowed_types'] = '*';
			$config['file_name'] = basename($_FILES["image"]['name']);

			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('image')) {
				$uploadData = $this->upload->data();
				$picture1 = $uploadData['file_name'];
				$configi['image_library'] = 'gd2';
				$configi['source_image'] = $uploadData['full_path'];
				$configi['create_thumb'] = FALSE;
				$configi['maintain_ratio'] = FALSE;
				$configi['quality'] = 60;
				$configi['width'] = 800;
				$configi['height'] = 600;
				$configi['new_image'] = 'assets/img/FTC/' . $picture1;
				$this->load->library('image_lib');
				$this->image_lib->initialize($configi);
				$this->image_lib->resize();
			} else {
				$picture1 = '';
			}
		} else {
			$picture1 = '';
		}


		$data = $this->A->UploadPic($picture1, $_POST['description']);
		return redirect('ImageStore/');
	}

    public function getImages()
	{
		$data = $this->A->getImages();

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function deleteitem()
	{
		
		$data = $this->A->deleteitem($_POST['TID']);

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

}
