<?php if ( ! defined('BASEPATH')) exit('acceso restringido a este script');

class VerOficios extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('ivss_model');
	}

/*Comienzo index */
	public function index(){
		$data["oficios"]=$this->ivss_model->mostrar();
		$this->load->view('private/ver_oficios',$data,false);
	}

	public function oficioIndividual(){
		$data["segmento"]=$this->uri->segment(3);
		$data["oficompletos"]=$this->ivss_model->verOficio($this->uri->segment(3));
		$this->load->view('private/ver',$data,false);
	}

}