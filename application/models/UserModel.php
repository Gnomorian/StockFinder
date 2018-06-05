<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }
    /**
     * check if a users password and username match
     */
     function hasUser($username, $password) {
        $this->db->select('*');
        $this->db->where('name', $username);
        $this->db->where('password', md5($password));

		$query = $this->db->get('users');
		return $query->result();
     }
}