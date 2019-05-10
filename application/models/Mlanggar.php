<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');
class Mlanggar extends CI_Model {
    var $table = 'm_lang_sum';
    var $table_detail='m_lang_detail';
    var $column_order = array('l.id','l.tanggal', 'l.jml_lang', 'l.jml_gur',null); 
    var $column_search = array('l.id','l.tanggal', 'l.jml_lang', 'l.jml_gur'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('tanggal' => 'desc'); // default order 
    function __construct() {
        parent::__construct();
    }
    
    private function _get_datatables_query() {
        $this->db->select('l.*,s.name')
        ->from($this->table. ' l')
        ->join('m_site s','s.id=l.site_id','left');
        // $this->db->from('m_lang_sum l')->join('m_site s','s.id=l.site_id','left');
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
    
    function get_datatables(){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    
    function count_filtered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    public function get_by_id($id){
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
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
    public function get_lang_stat(){
        return $this->db->query("select tanggal, jml_lang from m_lang_sum")->result();
    }
    public function get_stat_monthly($lang_sum_id=0, $parent_id=0) {
        $query = "select ld.lang_sum_id, ld.param_id, p.name as param_name, ld.total 
                    from m_lang_detail ld 
                    left join m_param p on ld.param_id=p.id
                    where ld.lang_sum_id='".$lang_sum_id."' and p.parent_id=".$parent_id;
        return $this->db->query($query)->result();
    }
    public function get_data_details($id){
        $this->db->from('m_lang_detail d');
        $this->db->join('m_param p','d.param_id=p.id');
        $this->db->join('m_lang_sum p','d.param_id=p.id');
        $query=$this->db->where('d.lang_sum_id',$id);
        return $query->result();
    }
    function find_all_by_nik($nik=0){
        $this->db->select('t.*, u.name as creator, u.site_id, s.name as site_name')
            ->from($this->table. ' t')
            ->join('m_users u', 't.user_id=u.nik', 'left')
            ->join('m_site s', 'u.site_id=s.id', 'left')
            ->where(array('t.user_id'=>$nik))
            ->order_by("t.tanggal", "desc");
        return $this->db->get();
    }
}