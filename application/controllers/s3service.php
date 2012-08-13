<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class S3service extends CI_Controller {

	public function index() {
		$this->load->view('include/header');
		$this->load->view('frontpage');
		$this->load->view('include/footer');
	}

	public function listall() {
		$this->load->spark('amazon-sdk/0.1.7');
		$s3 = $this->awslib->get_s3();
		//$response = $s3->list_buckets();
		$response = $s3->list_objects('storage1.chinesetech.com.tw');
		$contents = $response->body->Contents;
	
		$result = array();
		foreach($contents as $object) {
			$key = $object->Key;
			array_push($result, "$key");
		}

		$data = array();
		$data['result'] = $result;
		
		$this->load->view('include/header');
		$this->load->view('s3listall', $data);
		$this->load->view('include/footer');
	}

	public function upload() {
		$this->load->view('include/header');
		$this->load->view('s3upload');
		$this->load->view('include/footer');
	}

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
