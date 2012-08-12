<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class S3service extends CI_Controller {

	public function index() {
		$this->load->view('include/header');
		$this->load->view('frontpage');
		$this->load->view('include/footer');
	}

	public function listall() {
		$this->load->spark('amazon-sdk/0.1.7');
		//print_r($this->load->spark);
		$s3 = $this->awslib->get_s3();
		$result = $s3->list_buckets();

		$data = array();
		$data['result'] = $result;
		
		$this->load->view('include/header');
		$this->load->view('s3listall', $data);
		$this->load->view('include/footer');
	}

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
