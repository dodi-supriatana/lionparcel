<?php
defined('BASEPATH') or exit('No direct script access allowed');

class booking extends MX_Controller
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

    public function get_booking()
    {

        // search data
        $data = $this->db->query("SELECT b.highlight,b.description,CONCAT(s.base_url,s.assets_url,b.image) as image FROM boarding b 
                                LEFT JOIN setting s on s.id=b.setting_id
                                WHERE `status`=1")->result();
        $this->djson(
            array(
                "status" => "200",
                "data" => $data
            )
        );
    }
}
