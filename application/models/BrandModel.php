<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BrandModel extends CI_Model {
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }
    /*
        get the brandName by id.
    */
    public function getBrandNameById($id) {
        $this->db->select('name');
        $this->db->where($id);
        
        return $this->db->get('brands')->result();
    }
    
    /*
        get the brand id by its english name.
    */
    public function getBrandIdByName($name) {
        $this->db->select('id');
        $this->db->where($name);
        
        return $this->db->get('brands')->result();
    }
    
    /*
        get all known brand ids.
    */
    public function getBrandIds() {
        $this->db->select('id');
        
        return $this->db->get('brands')->result();
    }
    
    /*
        get all brand names.
    */
    public function getBrandNames() {
        $this->db->select('name');
        
        return $this->db->get('brands')->result();
    }
    
    /*
        get array of names from array of ids
    */
    public function translateIdsToNames($ids) {
        $names = array();
        for($i = 0; $i < count($ids); $i++) {
            $names[$i] = $this->getBrandNameById($ids[$i]);
        }
        return $names;
    }
    
    /*
        get array of ids from array of names
    */
    public function translateNamesToIds($names) {
        $ids = array();
        for($i = 0; $i < count($names); $i++) {
            $ids[$i] = $this->getBrandNameById($names[$i]);
        }
        return $ids;
    }
}