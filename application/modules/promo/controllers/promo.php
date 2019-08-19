<?php
defined('BASEPATH') or exit('No direct script access allowed');

class promo extends MX_Controller
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
        // $this->load->helper(['jwt', 'authorization']);
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

    public function get_promo()
    {
        // $db = $this->db;
        // $headers = $this->input->request_headers();
        // // verify token
        // $auth = verifyToken($headers, $db);
        // if (!$auth["validToken"]) {
        //     return $this->djson($auth["res"]);
        // }

        // search data
        $data = $this->db->query("SELECT
        p.highlight,
        CONCAT(s.base_url,
        p.promo_image) as promo,
        p.promo_image 
    FROM
        promo p
        LEFT JOIN setting s ON p.setting_id = s.id 
    WHERE
        `status` =1")->result();
        $this->djson(
            array(
                "status" => "200",
                "data" => $data,
            )
        );
    }
}
