<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class S3service extends CI_Controller {

	private function getS3() {
		$this->load->spark('amazon-sdk/0.1.7');
		$s3 = $this->awslib->get_s3();
		//$s3->disable_ssl_verification();
		//$s3->disable_ssl();
		//$s3->enable_debug_mode();
		//$s3->set_proxy('proxy://192.168.255.3:3128');
		return $s3;
	}

	private function getBucketName() {
		return 'storage1.chinesetech.com.tw';
	}

	public function index() {
		$this->load->view('include/header');
		$this->load->view('frontpage');
		$this->load->view('include/footer');
	}

	public function listall() {
		$s3 = $this->getS3();
		$response = $s3->list_objects($this->getBucketName());
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

	public function playback() {
		$object = $_GET['object'];
		$s3 = $this->getS3();
		$object_url = $s3->get_object_url($this->getBucketName(), $object, '30 minutes', array(
			'response' => array(
				'expires'          => gmdate(DATE_RFC2822, strtotime('1 January 1980'))
			)
		));

		$object_type = $this->getContentType($object);

		$data = array(
			'object' => $object,
			'object_type' => $object_type,
			'object_url' => $object_url
		);
		$this->load->view('include/header');
		$this->load->view('s3playback', $data);
		$this->load->view('include/footer');
	}

	private function getContentType($object) {
		$object_type = '';
		if (substr($object, -4)=='.ogg' || substr($object, -4)=='.ogv') {
			$object_type = 'video/ogg';
		}
		else if (substr($object, -4)=='.mp4') {
			$object_type = 'video/mp4';
		}
		else if (substr($object, -4)=='.mov') {
			$object_type = 'video/h264';
		}
		else if (substr($object, -4)=='.txt') {
			$object_type = 'plain/text';
		}
		return $object_type;
	}

	public function receive()
	{
		/**
		 * upload.php
		 *
		 * Copyright 2009, Moxiecode Systems AB
		 * Released under GPL License.
		 *
		 * License: http://www.plupload.com/license
		 * Contributing: http://www.plupload.com/contributing
		 */
		
		// HTTP headers for no cache etc
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		
		// Settings
		//$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
		$targetDir = 'uploads';
		
		$cleanupTargetDir = true; // Remove old files
		$maxFileAge = 5 * 3600; // Temp file age in seconds
		
		// 5 minutes execution time
		@set_time_limit(5 * 60);
		
		// Uncomment this one to fake upload time
		// usleep(5000);
		
		// Get parameters
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
		$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';
		
		// Clean the fileName for security reasons
		$fileName = preg_replace('/[^\w\._]+/', '_', $fileName);
		
		// Make sure the fileName is unique but only if chunking is disabled
		if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
			$ext = strrpos($fileName, '.');
			$fileName_a = substr($fileName, 0, $ext);
			$fileName_b = substr($fileName, $ext);
		
			$count = 1;
			while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
				$count++;
		
			$fileName = $fileName_a . '_' . $count . $fileName_b;
		}
		
		$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
		
		// Create target dir
		if (!file_exists($targetDir))
			@mkdir($targetDir);
		
		// Remove old temp files	
		if ($cleanupTargetDir && is_dir($targetDir) && ($dir = opendir($targetDir))) {
			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
		
				// Remove temp file if it is older than the max age and is not the current file
				if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
					@unlink($tmpfilePath);
				}
			}
		
			closedir($dir);
		} else
			die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
		
	
		$contentType = '';
	
		// Look for the content type header
		if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
			$contentType = $_SERVER["HTTP_CONTENT_TYPE"];
		
		if (isset($_SERVER["CONTENT_TYPE"]))
			$contentType = $_SERVER["CONTENT_TYPE"];
		
		// Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
		if (strpos($contentType, "multipart") !== false) {
			if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
				// Open temp file
				$out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
				if ($out) {
					// Read binary input stream and append it to temp file
					$in = fopen($_FILES['file']['tmp_name'], "rb");
		
					if ($in) {
						while ($buff = fread($in, 4096))
							fwrite($out, $buff);
					} else
						die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
					fclose($in);
					fclose($out);
					@unlink($_FILES['file']['tmp_name']);
				} else
					die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
			} else
				die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
		} else {
			// Open temp file
			$out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
			if ($out) {
				// Read binary input stream and append it to temp file
				$in = fopen("php://input", "rb");
		
				if ($in) {
					while ($buff = fread($in, 4096))
						fwrite($out, $buff);
				} else
					die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
		
				fclose($in);
				fclose($out);
			} else
				die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}
		
		// Check if file has been uploaded
		if (!$chunks || $chunk == $chunks - 1) {
			// Strip the temp .part suffix off 
			rename("{$filePath}.part", $filePath);

			// Upload to S3 bucket
			$s3 = $this->getS3();
			$response = $s3->create_object($this->getBucketName(), 'uploads/'.$fileName, array(
			    'fileUpload' => $filePath,
			    //'acl' => AmazonS3::ACL_PUBLIC,
			    'contentType' => $this->getContentType($fileName),
			    //'storage' => AmazonS3::STORAGE_REDUCED,
			    //'headers' => array(
			    //    'Cache-Control'    => 'max-age',
			    //    'Content-Encoding' => 'gzip',
			    //    'Content-Language' => 'en-US',
			    //    'Expires'          => 'Thu, 01 Dec 1994 16:00:00 GMT',
			    //),
			  	//'meta' => array(
			    //    'word'         => 'to your mother',    // x-amz-meta-word
			    //    'ice-ice-baby' => 'too cold, too cold' // x-amz-meta-ice-ice-baby
			    //),
			));
			file_put_contents($filePath.'.txt', $response);
		}
		
		// Return JSON-RPC response
		die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
	}
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
