<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();	
	}

	public function index()
	{
        $URL='https://api.spaceXdata.com/v3/launches?limit=100';
		$response=$this->process_curl($URL);
		$data['format_response']=json_decode($response,true);
		// echo "<pre>"; print_r($data['format_response']); exit();
		$this->load->view('list',$data);
	}
	function process_curl($url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
        return $output;
    }
}
