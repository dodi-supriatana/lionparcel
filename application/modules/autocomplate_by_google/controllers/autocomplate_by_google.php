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
        $word = $this->input->post('word');
        if (!empty($word)) {
            $query = $this->db->query("SELECT w.3lc as id,CONCAT( w.kelurahan, ', ',w.kecamatan, ', ', w.type ,' ', w.kab_kota, ', ',w.provinsi) as name FROM wilayah w WHERE CONCAT( w.kelurahan, ', ',w.kecamatan,' ', w.kab_kota, ' ',w.provinsi) like '%" . $word . "%' GROUP BY kecamatan limit 10 ");


            $this->djson(
                array(
                    "status" => "200",
                    "data" => $query->result()
                )
            );
        } else {
            $this->djson(
                array(
                    "status" => "200",
                    "data" => []
                )
            );
        }
    }

    public function get_address()
    {
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');;
        $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $latitude . ',' . $longitude . '&sensor=false&key=AIzaSyCfY9TPZ31i6nu-oTLQWjuHaIt5dbc86o4&sensor=false');
        $output = json_decode($geocode);
        $formattedAddress = @$output->results[0]->formatted_address;
        $this->djson(
            array(
                "status" => "200",
                "data" => $formattedAddress
            )
        );
    }

    public function get_autocomplate_kecamatan()
    {
        $word = $this->input->post('word');
        if (!empty($word)) {
            $query = $this->db->query("SELECT w.kecamatan as id,CONCAT(w.kecamatan, ', ', w.type ,' ', w.kab_kota, ', ',w.provinsi) as name FROM wilayah w WHERE CONCAT(w.kecamatan,' ', w.kab_kota, ' ',w.provinsi) like '%" . $word . "%' GROUP BY kecamatan limit 10 ");


            $this->djson(
                array(
                    "status" => "200",
                    "data" => $query->result()
                )
            );
        } else {
            $this->djson(
                array(
                    "status" => "200",
                    "data" => []
                )
            );
        }
    }

    public function get_autocomplate_address(){
        $address = $this->input->post('address');

		$geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&key=AIzaSyBmtZNz9aMpD-tDGdjX_ZmvkdCLe8orp7U&sensor=false');
		$output = json_decode($geocode);
		print_r($output);
		die();
		$lat = @$output->results[0]->geometry->location->lat;
		$lng = @$output->results[0]->geometry->location->lng;


    }

   
}
