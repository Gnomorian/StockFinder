<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TypeModel extends CI_Model {
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }
    /*
        get the typeName by id.
    */
    public function getTypeNameById($id) {
        $this->db->select('name');
        $this->db->where($id);
        
        return $this->db->get('types')->result();
    }
    
    /*
        get the type id by its english name.
    */
    public function getTypeIdByName($name) {
        $this->db->select('id');
        $this->db->where($name);
        
        return $this->db->get('types')->result();
    }
    
    /*
        get all known type ids.
    */
    public function getTypeIds() {
        $this->db->select('id');
        
        return $this->db->get('types')->result();
    }
    
    /*
        get all type names.
    */
    public function getTypeNames() {
        $this->db->select('name');
        
        return $this->db->get('types')->result();
    }
    
    /*
        get array of names from array of ids
    */
    public function translateIdsToNames($ids) {
        $names = array();
        for($i = 0; $i < count($ids); $i++) {
            $names[$i] = $this->gettypeNameById($ids[$i]);
        }
        return $names;
    }
    
    /*
        get array of ids from array of names
    */
    public function translateNamesToIds($names) {
        $ids = array();
        for($i = 0; $i < count($names); $i++) {
            $ids[$i] = $this->gettypeNameById($names[$i]);
        }
        return $ids;
    }
}