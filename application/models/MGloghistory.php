<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MGloghistory extends CI_Model
{



	function __construct()
	{
		parent::__construct();
		// $this->load->model('M_master_menu');
	}

	public function insert_history($data)
	{
			$this->db->insert('t_po_history', $data);
			return $this->db->insert_id();	
	}
}
