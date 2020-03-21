<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access_ml extends CI_Model {

    protected $table_name = "access";

    public function __construct(){		
		parent::__construct();
		$this->load->database();
	}
	public function run($sql){
		$dataset = $this->db->query($sql);
		return $dataset->result();
    }
    // Function to get the client IP address
	function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	public function add() {
        $ip = $this->get_client_ip();
        $query = " INSERT INTO $this->table_name (ip) VALUES ('$ip');";
        $this->run($query);
        return $this->db->affected_rows() > 0;
	}	
}
