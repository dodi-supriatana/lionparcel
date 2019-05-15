<?php
defined('BASEPATH') or exit('No direct script access allowed');

class autocomplate extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        //  if($this->session->userdata('status') != "login"){
        //     redirect(base_url("/login/signOut"));
        // }
        //  $this->load->model('M_channel');
        // $this->load->model('MGmenu');
        // $this->load->model('mprojectlist');
    }

    private function djson($value = array())
    {
        $json = json_encode($value);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($json);
    }

    public function get_autocomplate()
    {
        $word=$this->input->post('word');
        $query = $this->db->query("SELECT w.3lc as id,CONCAT(w.kecamatan, ', ', w.type,'', w.kab_kota, ', ',w.provinsi) as name FROM wilayah w WHERE w.kecamatan like '".$word."%' GROUP BY kecamatan limit 10 ");
        
        
        $this->djson(
			array(
				"status"=>"200",
				"data"=>$query->num_rows()
			)
		);
    }
}
