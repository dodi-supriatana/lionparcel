<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MGupdateheader extends CI_Model
{



	function __construct()
	{
		parent::__construct();
		// $this->load->model('M_master_menu');
	}

	public function Update_header_upload_po_attach($po_no,$file,$po_position)
	{
		// $this->db->update($this->table, $data, $where);
		$query = $this->db->query("UPDATE t_po_header
									SET po_active='2', progress='20',po_doc='".$file."',po_position='".$po_position."'
									WHERE po_no='".$po_no."'");
		return $this->db->affected_rows();
	}

	public function cek_approval($po_no,$approved_by){
		$query=$this->db->query("SELECT * FROM t_po_detail pod where pod.po_no='".$po_no."' and approved_by='".$approved_by."' and `status`!='5'")->num_rows();
		return $query;
	}
}
