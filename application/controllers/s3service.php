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
		echo '<pre>' . print_r($result, TRUE) . '</pre>';
		
		$this->load->spark('example-spark/1.0.0');      # We always specify the full path from the spark folder
		$this->example_spark->printHello();             # echo's "Hello from the example spark!"

		$this->load->view('include/header');
		$this->load->view('s3listall');
		$this->load->view('include/footer');
	}

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
