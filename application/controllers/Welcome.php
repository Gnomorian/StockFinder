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
		
		session_start();
		
		if(!isset($_POST['query'])) {
		
			if($this->verifyUser()) {
				$this->load->view('main', array('brands' => $brands, 'types' => $types, 'username' => $_SESSION['username']));
			}
			else {
				$this->load->view('main', array('brands' => $brands, 'types' => $types));
			}
			return;
		}
		// initalize stock model
		$this->load->model('StockModel', 'stock');
		
		switch($_POST['query']) {
			case "add":
				// add item to database
				if($this->verifyUser()) {
					$this->stock->addItem($data);
					$this->load->view('main', array('message' => "Item Was Sucessfully Added to the Database", 'brands' => $brands, 'types' => $types, 'username' => $_SESSION['username']));
				}
				else {
					$this->load->view('main', array('message' => "you are not Authorised to do this.", 'brands' => $brands, 'types' => $types));
				}
				break;
			case "search":
				// search database for items matching the query and return a table of results
				$result = $this->stock->searchItem($data);
				if(isset($_SESSION['username'])) {
					$this->load->view('main', array('result' => $result, 'brands' => $brands, 'types' => $types, 'username' => $_SESSION['username']));
				}
				else {
					$this->load->view('main', array('result' => $result, 'brands' => $brands, 'types' => $types));
				}
				break;
			case "delete":
				// delete item from the database
				if($this->verifyUser()) {
					$this->stock->deleteItem($data['id']);
					$this->load->view('main', array('message' => "Item Was Sucessfully Deleted from the Database", 'brands' => $brands, 'types' => $types ));
				}
				else {
					$this->load->view('main', array('message' => "You are not Authorised to do this.", 'brands' => $brands, 'types' => $types ));
				}
				break;
			case "login":
				// create session for user
				if($this->loginUser()) {
					$_SESSION['username'] = $_POST['username'];
					$this->load->view('main', array('brands' => $brands, 'types' => $types, 'username' => $_POST['username']));
				}
				else {
					$this->load->view('main', array('brands' => $brands, 'types' => $types, 'message' => "user either doesnt exist or you typed the wrong password."));
				}
				
				break;
			case "logout":
				// delete session for user
				session_destroy();
				$this->load->view('main', array('brands' => $brands, 'types' => $types));
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
	/**
	 * assembles the $data to be sent to the database
	 */
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
	/**
	 * checks if a user is loged in this session, returns true if there is.
	 */
	private function verifyUser() {
		//TODO: add logic to check if a user is authorised to edit/view something
		if(isset($_SESSION['username'])) {
			return true;
		}
		return false;
	}
	
	private function loginUser() {
		$this->load->model('UserModel', 'users');
		if($this->users->hasUser($_POST['username'], $_POST['password'])) {
			return true;
		}
		else {
			return false;
		}
	}
	private function is_session_started()
	{
	    if ( php_sapi_name() !== 'cli' ) {
	        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
	            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
	        } else {
	            return session_id() === '' ? FALSE : TRUE;
	        }
	    }
	    return FALSE;
	}
}
