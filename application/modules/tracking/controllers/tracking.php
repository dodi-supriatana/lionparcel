<?php
defined('BASEPATH') or exit('No direct script access allowed');

class tracking extends MX_Controller
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

    public function get_tracking()
    {
        $username = "lionparcel";
        $password = "lionparcel@123";
        $remote_url = 'http://lpapi.cargoflash.com/v3/stt/track?q=11-18-612';

        // Create a stream
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode("$username:$password")
            )
        );

        $context = stream_context_create($opts);

        // Open the file using the HTTP headers set above
        $json = file_get_contents($remote_url, false, $context);

        // print($json);
        $output = json_decode($json);
        $panjang=@$output->stts[0]->history;
        // $panjang_history=count($panjang);
        $history=array();
        $i=0;
        foreach ($panjang as $datas) {
            $row=array(
            "id"=> @$output->stts[0]->history[$i]->row,
            "title"=> @$output->stts[0]->history[$i]->remarks." ". @$output->stts[0]->history[$i]->city." (".@$output->stts[0]->history[$i]->location.")",
            "description" => substr(@$output->stts[0]->history[$i]->datetime,0,10)." ".substr(@$output->stts[0]->history[$i]->datetime,11,8),
            );
            $history[] = $row;
            $i++;
        }
        $data = array(
            'no_resi' => @$output->stts[0]->stt_no,
            "sender_name"=> @$output->stts[0]->sender_name,
			"reciver_name"=> @$output->stts[0]->recipient_name,
			"origin"=> @$output->stts[0]->origin,
			"destination"=> @$output->stts[0]->destination,
			"current_status"=> @$output->stts[0]->current_status,
            "berat"=> @$output->stts[0]->chargeable_weight,
            "history"=> $history,
        );

        $this->djson(
            array(
                "status" => "200",
                // "panjang"=>$panjang_history,
                "data" => $data
            )
        );
    }
}
