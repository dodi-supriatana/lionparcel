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

    public function index()
    {
        $connect=array("connecting"=>"babi");
        echo json_encode($connect); 
    }


}
