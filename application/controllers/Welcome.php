<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$result;
		$brands;
		
		$data = $this->formatData($this->sortData($_POST));
		
		// get list of brand ids
		$this->load->model('BrandModel', 'brands');
		$brands = $this->brands->getBrandNames();
		
		// get list of type ids
		$this->load->model('TypeModel', 'types');
		$types = $this->types->getTypeNames();
		
		if(!isset($_POST['query'])) {
			$this->load->view('main', array('brands' => $brands, 'types' => $types));
			return;
		}
		// initalize stock model
		$this->load->model('StockModel', 'stock');
		
		switch($_POST['query']) {
			case "add":
				// add item to database
				$this->stock->addItem($data);
				$this->load->view('main', array('message' => "Item Was Sucessfully Added to the Database", 'brands' => $brands, 'types' => $types));
				break;
			case "search":
				$result = $this->stock->searchItem($data);
				$this->load->view('main', array('result' => $result, 'brands' => $brands, 'types' => $types));
				break;
			case "delete":
				// delete item from the database
				$this->stock->deleteItem($data['id']);
				$this->load->view('main', array('message' => "Item Was Sucessfully Deleted from the Database", 'brands' => $brands, 'types' => $types ));
				break;
		}
	}
	
	private function sortData($from, $to=null) {
		if($to == null) {
			$to = array();
		}
		// set the $to variable to be passed to the StockModel
		if(isset($from['name'])) {
			$to['name'] = $from['name'];
		}
		if(isset($from['brand'])) {
			$to['brand'] = $from['brand'];
		}
		if(isset($from['type'])) {
			$to['type'] = $from['type'];
		}
		if(isset($from['target'])) {
			$to['target'] = $from['target'];
		}
		if(isset($from['size'])) {
			$to['size'] = $from['size'];
		}
		if(isset($from['colour'])) {
			$to['colour'] = $from['colour'];
		}
		if(isset($from['location'])) {
			$to['location'] = $from['location'];
		}
		if(isset($from['condition'])) {
			$to['condition'] = $from['condition'];
		}
		if(isset($from['id'])) {
			$to['id'] = $from['id'];
		}
		
		return $to;
	}
	
	private function formatData($data) {
		if(isset($data['name'])) {
			$data['name'] = strtolower($data['name']);
		}
		if(isset($data['location'])) {
			$data['location'] = strtoupper($data['location']);
		}
		if(isset($data['colour'])) {
			$data['colour'] = strtolower($data['colour']);
		}
		return $data;
	}
}
