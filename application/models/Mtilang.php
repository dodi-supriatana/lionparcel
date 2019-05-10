<?php

header('Access-Control-Allow-Origin: *');



defined('BASEPATH') OR exit('No direct script access allowed');



class Mtilang extends CI_Model {



	var $table = 'm_tilang';

    var $column_order = array('tilang_date'); 

    var $column_search = array('tilang_date'); //set column field database for datatable searchable just firstname , lastname , address are searchable

    var $order = array('tilang_date' => 'desc'); // default order 



	function __construct() {

		parent::__construct();

	}



	

    private function _get_datatables_query() {

        $this->db->select('t.*, u.name as creator, u.site_id, u2.name as approver, s.name as site_name')

            ->from($this->table. ' t')

            ->join('m_users u', 't.user_id=u.nik', 'left')

            ->join('m_site s', 'u.site_id=s.id', 'left')

            ->join('m_users u2', 't.approved_by=u2.nik', 'left');

 

        $i = 0;

     

        foreach ($this->column_search as $item) // loop column 

        {

            if($_POST['search']['value']) // if datatable send POST for search

            {

                 

                if($i===0) // first loop

                {

                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.

                    $this->db->like($item, $_POST['search']['value']);

                }

                else

                {

                    $this->db->or_like($item, $_POST['search']['value']);

                }

 

                if(count($this->column_search) - 1 == $i) //last loop

                    $this->db->group_end(); //close bracket

            }

            $i++;

        }

         

        if(isset($_POST['order'])) // here order processing

        {

            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

        } 

        else if(isset($this->order))

        {

            $order = $this->order;

            $this->db->order_by(key($order), $order[key($order)]);

        }

    }

 

    function get_datatables()

    {

        $this->_get_datatables_query();

        if($_POST['length'] != -1)

        $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();

        return $query->result();

    }



    function count_filtered()

    {

        $this->_get_datatables_query();

        $query = $this->db->get();

        return $query->num_rows();

    }

 

    public function count_all()

    {

        $this->db->from($this->table);

        return $this->db->count_all_results();

    }



    function cek($nik, $password){

		$this->db->select('u.nik, u.name, u.password, u.site_id, s.name as site_name')

		->from($this->table. ' u')

		->join('m_site s', 'u.site_id=s.id', 'left')->where(array('u.nik'=>$nik, 'u.password'=>$password));

		// $this->db->where('u.password', $password);

		

		return $this->db->get();

	}

 

    public function get_by_nik($nik)

    {

        $this->db->from($this->table);

        $this->db->where('nik',$nik);

        $query = $this->db->get();

 

        return $query->row();

    }





    public function get_by_id($id)

    {

        $query=$this->db->select('t.*, u.name as creator, u.site_id, u2.name as approver, s.name as site_name')

            ->from($this->table. ' t')

            ->join('m_users u', 't.user_id=u.nik', 'left')

            ->join('m_site s', 'u.site_id=s.id', 'left')

            ->join('m_users u2', 't.approved_by=u2.nik', 'left')->where(array('t.id'=>$id))->get();

 

        return $query->row();

    }

    public function get_by_id_array($id)

    {

        $query=$this->db->select('t.*, u.name as creator, u.site_id, u2.name as approver, s.name as site_name')

            ->from($this->table. ' t')

            ->join('m_users u', 't.user_id=u.nik', 'left')

            ->join('m_site s', 'u.site_id=s.id', 'left')

            ->join('m_users u2', 't.approved_by=u2.nik', 'left')->where(array('t.id'=>$id))->get();

 

        return $query->result();

    }

 

    public function save($data)

    {

        $this->db->insert($this->table, $data);

        return $this->db->insert_id();

    }

 

    public function update($where, $data)

    {

        $this->db->update($this->table, $data, $where);

        return $this->db->affected_rows();

    }

 

    public function delete_by_nik($nik)

    {

        $this->db->where('nik', $nik);

        $this->db->delete($this->table);

    }



	function find_all_by_nik($nik=0){

		$this->db->select('t.*, u.name as creator, u.site_id, u2.name as approver, s.name as site_name')

			->from($this->table. ' t')

			->join('m_users u', 't.user_id=u.nik', 'left')

			->join('m_site s', 'u.site_id=s.id', 'left')

			->join('m_users u2', 't.approved_by=u2.nik', 'left')

			->where(array('t.user_id'=>$nik))

			->order_by("t.tilang_date", "desc");

		return $this->db->get();

	}


    public function total(){
        return $this->db->query("SELECT concat( format( sum(total), 0)) as total FROM m_tilang")->row();

    }

 public function jumlah_tilang(){
        return $this->db->query("SELECT count(*) as tilang FROM m_tilang  WHERE YEAR(tilang_date) = DATE_FORMAT(now(),'%Y') ")->row();

    }
	
	

    

public function trefik(){
    return $this->db->query("SELECT DATE_FORMAT(tilang_date,'%Y') tahun, concat(format( sum(total), 0)) as total FROM m_tilang GROUP BY  DATE_FORMAT(tilang_date,'%Y')")->result();

}

public function max_dana(){
    return $this->db->query("SELECT polda, tahun, concat( format( MAX(total), 0))  as maxs FROM max_dana")->row();
}


public function max_total(){
    return $this->db->query("SELECT polda, tahun, concat( format( MAX(total), 0))  as maxs FROM max_total")->row();
}

public function total_pelanggaran(){
   return $this->db->query('SELECT sum(total) as totals FROM m_lang_detail WHERE param_id=9 or param_id=10')->row();
}

public function Total_tilang(){
    return $this->db->query('SELECT sum(total) as totals FROM  m_lang_detail WHERE param_id=9')->row();

}

public function Total_teguran(){
    return $this->db->query('SELECT sum(total) as totals FROM m_lang_detail WHERE param_id=10')->row();

}
}

