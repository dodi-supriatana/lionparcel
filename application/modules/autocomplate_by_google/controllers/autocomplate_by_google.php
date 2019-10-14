<?php
defined('BASEPATH') or exit('No direct script access allowed');

class autocomplate_by_google extends MX_Controller
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

    public function get_autocomplate_address(){
        $address = $this->input->post('address');

		// $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&key=AIzaSyBmtZNz9aMpD-tDGdjX_ZmvkdCLe8orp7U&sensor=false');
		$geocode = file_get_contents('https://maps.googleapis.com/maps/api/place/autocomplete/json?input='. urlencode($address) .'&types=geocode&language=en&key=AIzaSyBnlCirhyEFsqNA1YDKyBBicWWb3T37ZBk');        
        $output = json_decode($geocode);
        
        $i=0;
        // $jalan=array();
        foreach ($output->predictions as $key) {
            $data[$i]['tempat']=@$output->predictions[$i]->description;
            $address2 = @$output->predictions[$i]->description;
            // die($address);
            $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address2) . '&key=AIzaSyBmtZNz9aMpD-tDGdjX_ZmvkdCLe8orp7U&sensor=false');
            $outputjalan = json_decode($geocode);
            $data[$i]['lat'] = @$outputjalan->results[0]->geometry->location->lat;
            $data[$i]['lng'] = @$outputjalan->results[0]->geometry->location->lng;
            $i++;
        }
        

        // echo json_encode($jalan,JSON_PRETTY_PRINT);
        
        $this->djson(
            array(
                "status" => "200",
                // "data"=>$header,
                "history" => $data
            )
        );


    }

   
}
