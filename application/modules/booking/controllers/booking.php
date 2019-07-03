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
        // die("aaaa");

        // get data Post
        // generate images
        $this->load->view('main');
        // $this->djson(
        //     array(
        //         "status" => "200",
        //         "data" => "ok"
        //     )
        // );
    }

    public function save_jpg()
    {   
        // die('aaaaa');
        $random = rand(100, 1000);

        //$_POST[data][1] has the base64 encrypted binary codes. 
        //convert the binary to image using file_put_contents
        $savefile = @file_put_contents(base_url('')."assets/bukti/$random.jpg", base64_decode(explode(",", $_POST['data'])[1]));

        //if the file saved properly, print the file name
        if ($savefile) {
            echo $_POST['data'][1];
        }
    }
}
