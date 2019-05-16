<?php
defined('BASEPATH') or exit('No direct script access allowed');

class checkprice extends MX_Controller
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

    public function get_checkprice()
    {

        $origin=$this->input->post('origin');
        $destinance=$this->input->post('destinance');
        $weight=$this->input->post('weight');
        
        // search data
        $data = $this->db->query("SELECT
        rt.rate_id,
            rt.origin_3lc,
            rt.origin_city dari,
            rt.destination_city AS ke,
            rt.product,
            date_format(created_date,' %d %M %Y')  as last_update,
            total * ".$weight."  as final_price
        FROM
            rate_tabel rt 
        WHERE
            rt.origin_3lc = '".$origin."' 
            AND rt.destination_3lc = '".$destinance."'")->result();
        $this->djson(
			array(
				"status"=>"200",
				"data"=>$data
			)
		);
    }
}
