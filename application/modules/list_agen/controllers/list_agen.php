<?php
defined('BASEPATH') or exit('No direct script access allowed');

class list_agen extends MX_Controller
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

    public function get_listagen()
    {

        // search data
        $id_agen = $this->input->post('lot');
        $id_agen = $this->input->post('lot');
        $data = $this->db->query("SELECT * FROM tabel_agen ")->result();
        $this->djson(
            array(
                "status" => "200",
                "data" => $data
            )
        );
    }


    public function searchagenbykota()
    { }


    public function searchbycoordinate()
    {
        $user_latitude = $this->input->post('user_latitude');
        $user_longitude = $this->input->post('user_longitude');

        if (!empty($user_latitude) and !empty($user_longitude)) {

            $data = $this->db->query("SELECT tabel_agen.*, 
            (6371 * acos(cos(radians(" . $user_latitude . ")) 
            * cos(radians(latitude)) * cos(radians(longitude) 
            - radians(" . $user_longitude . ")) + sin(radians(" . $user_latitude . ")) 
            * sin(radians(latitude)))) AS jarak 
            FROM tabel_agen 
            HAVING jarak < 10 ORDER BY jarak")->result();
        } else {
            $data = "please input data user latitude and longitude ";
        }

        $this->djson(
            array(
                "status" => "200",
                "data" => $data
            )
        );
    }

    public function get_lat_long()
    {
        $address = $this->input->post('address');
        $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key=AIzaSyCfY9TPZ31i6nu-oTLQWjuHaIt5dbc86o4&sensor=false');
        $output = json_decode($geocode);
        $lat = @$output->results[0]->geometry->location->lat;
        $lng = @$output->results[0]->geometry->location->lng;

        if (!empty($lat) or !empty($lng)) {

            $data = $this->db->query("SELECT tabel_agen.*, 
        (6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(latitude)) * cos(radians(longitude) 
        - radians(" . $lng . ")) + sin(radians(" . $lat . ")) 
        * sin(radians(latitude)))) AS jarak 
        FROM tabel_agen 
        HAVING jarak < 10 ORDER BY jarak")->result();
        } else {
            $data = [];
        }
        $this->djson(
            array(
                "status" => "200",
                "data" => $data
            )
        );
    }
}
