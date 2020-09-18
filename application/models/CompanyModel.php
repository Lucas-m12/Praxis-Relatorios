<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyModel extends CI_Model {

	public function findOne() {

		$this->db->select("*");
		$this->db->from("EMPRESA");
		$this->db->where("STATUS", 1);
		// $this->db->limit(1);

		$company = $this->db->get()->result_array()[0];

		return $company;

	}

}

?>
