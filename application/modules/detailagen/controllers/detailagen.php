<?php
defined('BASEPATH') or exit('No direct script access allowed');

class detailagen extends MX_Controller
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

    public function get_detailagen()
    {

        // search data
        $id_agen=$this->input->post('id_agen');
        $data = $this->db->query("SELECT * FROM tabel_agen WHERE id_agent='" . $id_agen . "'")->result();
        $this->djson(
            array(
                "status" => "200",
                "data" => $data
            )
        );
    }


    public function searchagenbykota(){
        
    }


    public function searchbycoordinate($lat1 = '32.9697', $lon1 = '-96.80322')
    {
        $data_agen = $this->db->query("SELECT id_agent,latitude,longitude FROM tabel_agen")->result();

        $this->djson(
            array(
                "status" => "200",
                "data" => $data_agen
            )
        );
    }
    public function calculate($lat1 = '32.9697', $lon1 = '-96.80322', $lat2 = '29.46786', $lon2 = '-98.53506', $unit = 'm')
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            $data = ($miles * 1.609344);
            echo $data;
            die();
        }
    }
}
