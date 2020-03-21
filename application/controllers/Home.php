<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $url_api = "http://127.0.0.1:8888/";

	public function __construct() {
		parent::__construct();
		$this->load->helper(['url']);
		$this->load->model(['access_ml']);
	}

	public function index() {
		show_404();
	}

	public function correct_spelling() {

		$this->access_ml->add();
		$url = $this->url_api."correct-spelling";
		if ($text = $this->input->post('text')) {
			try {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "text=$text");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec($ch);
				curl_close ($ch);
				echo $server_output;
			} catch (Exception $e) {
				echo "ERROR on server!";
			}
		}
	}	
}
