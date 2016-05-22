<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockModel extends CI_Model {
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }
    // add an item to the database parameter is an array with the keys as the fields
    public function addItem($data) {
        $this->db->insert('items', $data);
    }
    
    //search for items in the database, parameter is an array with the keys as the fields
    public function searchItem($data) {
        
        $this->db->select('*');
        
        if(isset($data['name']) && $data['name'] != "") {
            $this->db->like('name', $data['name']);
            
		}
		if(isset($data['brand']) && $data['brand'] != "") {
            $this->db->where('brand', $data['brand']);
		}
		if(isset($data['type']) && $data['type'] != "") {
            $this->db->where('type', $data['type']);
		}
		if(isset($data['target']) && $data['target'] != "") {
            $this->db->where('target', $data['target']);
		}
		if(isset($data['size']) && $data['size'] != "") {
            $this->db->where('size', $data['size']);
		}
		if(isset($data['location']) && $data['location'] != "") {
            $this->db->where('location', $data['location']);
		}
		if(isset($data['colour']) && $data['colour'] != "") {
            $this->db->like('colour', $data['colour']);
		}
		if(isset($data['condition']) && $data['condition'] != "") {
            $this->db->where('condition', $data['condition']);
		}
		$query = $this->db->get('items');
		return $query->result();
    }
    
    // deletes a row from table
    public function deleteItem($id) {
        $this->db->delete('items', array('id' => $id));
    }
    // translate brand:ai to Active Intent, translates Active Intent to ai if internal=true
    public function acronemTranslation($value, $internal=false) {
        // id : field : unlocolizedname : locolizedname
        // field is whether it is a brand, colour, target etc
        if($internal){
            // Active Intent to ai
            $this->db->select('unlocolizedname');
            $this->db->where($value);
        }
        else {
            // ai to Active Intent
            $this->db->select('locolizedname');
            $this->db->where($value);
        }
        $query = $this->db->get('translation');
        return $query->result();
    }
}