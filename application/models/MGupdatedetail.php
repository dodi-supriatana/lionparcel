<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MGupdatedetail extends CI_Model
{



	function __construct()
	{
		parent::__construct();
		// $this->load->model('M_master_menu');
	}

	public function Update_detail_upload($po_no,$file,$doc_id,$po_work)
	{
		// $this->db->update($this->table, $data, $where);
		$query = $this->db->query("UPDATE t_po_detail
									SET status='3', file_name='".$file."'
									WHERE po_no='".$po_no."' and doc_id='".$doc_id."' and approved_by='".$po_work."'");
		return $this->db->affected_rows();
	}

	public function Update_detail_status($po_no,$status,$doc_id,$po_work)
	{
		// $this->db->update($this->table, $data, $where);
		$query = $this->db->query("UPDATE t_po_detail
									SET status='".$status."'
									WHERE po_no='".$po_no."' and doc_id='".$doc_id."' and approved_by='".$po_work."'");
		return $this->db->affected_rows();
	}


	
}
