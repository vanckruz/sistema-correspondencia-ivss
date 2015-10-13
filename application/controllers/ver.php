<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ver extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('ivss_model');
	}

/*Comienzo index */
	public function index(){
		$data["titulo"]="ver correspoondencia";
		$this->load->view('inc/head',$data);
		$this->load->view('private/ver');
		
	}

}