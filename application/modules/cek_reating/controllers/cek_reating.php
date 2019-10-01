<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cek_reating extends MX_Controller
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

    public function cek()
    {
        $id_user = $this->input->post('id_user');
        // $rate=$this->input->post('rate');
        $id_agen=$this->input->post('id_agen');

        
        // cek user
        $cek_user=$this->db->query("SELECT count(*) as total  FROM history_reting_agen WHERE id_agent='".$id_agen."' and id_user='".$id_user."'")->row();
        
        if ($cek_user->total == 0) {
            $this->djson(
                array(
                    "status" => "200",
                    "flag"=>0,
                    "messages" => "You can gave a rating"
                )
            );
        }else{
            $this->djson(
                array(
                    "status" => "200",
                    "flag"=>1,
                    "messages" => "You once gave a rating"
                )
            );
        }

    }
        // insert to rate_history
        
        // update rate agen
}
