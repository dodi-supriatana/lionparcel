<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kecamatan extends MX_Controller
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

    public function get_kecamatan()
    {

        // search data
        $str=$this->input->post('kabkota');
        $kabkota=explode(' ',$str,2);
        // print_r($kabkota);
        // die($kabkota[1]);
        // die($kabkota[1]);
        $data = $this->db->query("SELECT kecamatan as value,kecamatan as label FROM wilayah WHERE kab_kota='$kabkota[1]' and type='$kabkota[0]' GROUP BY  label")->result();
        $this->djson(
            array(
                "status" => "200",
                "data" => $data 
            )
        );
    }
}
