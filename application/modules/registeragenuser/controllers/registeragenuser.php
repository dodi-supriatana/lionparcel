<?php
defined('BASEPATH') or exit('No direct script access allowed');

class registeragenuser extends MX_Controller
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

    public function send_registeragen()
    {
        // get post data
        $nama=$this->input->post('nama');
        $email=$this->input->post('email');
        $no_hp=$this->input->post('no_hp');
        $password=$this->input->post('password');

        $query=$this->db->query("INSERT INTO m_user (username, password, no_hp,nama, id_level,images)VALUES ('".$email."', '".$password."','".$no_hp."','". $nama."','1','https://rehrealestate.com/wp-content/uploads/2015/08/facebook-default-no-profile-pic-girl.jpg')");
        if ($query) {
            $this->djson(
                array(
                    "status" => "200",
                    "messages" => "success"
                )
            );
        }else {
            $this->djson(
                array(
                    "status" => "200",
                    "messages" => "Failed"
                )
            );
        }

    }

 

    
  

}
