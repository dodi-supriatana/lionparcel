<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MGmenu extends CI_Model {

	var $table = 'permissions';
    var $column_order = array('menu','ctrl','is_web','icon'); //set column field database for datatable orderable
    var $column_search = array('menu','ctrl','is_web','icon'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('ctrl' => 'desc'); // default order 

	function __construct() {
		parent::__construct();
        // $this->load->model('M_master_menu');
	}

    function get_menu()
    {   
                 $this->db->where('is_menu',1);
                 $this->db->order_by('menu_id','asc');   
        $query = $this->db->get($this->table);
        return $query->result();
    }
    function get_child_menu($id){
        $query = $this->db->query("SELECT
                                        x2.menu_id,
                                        x2.parent_id,
                                        x2.permission_name,
                                        x2.ctrl_menu 
                                    FROM
                                        permissions x1
                                        RIGHT JOIN permissions x2 ON x2.parent_id = x1.menu_id 
                                    WHERE
                                        x2.parent_id IN ( ".$id." ) and x1.is_menu=1
                                    ORDER BY
                                        x1.parent_id");
        return $query->result();
    }


}
