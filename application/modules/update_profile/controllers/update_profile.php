<?php
defined('BASEPATH') or exit('No direct script access allowed');

class update_profile extends MX_Controller
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

    public function update()
    {
        $id_user = $this->input->post('id_user');
        if ($this->input->post('nama')) {
            $nama = $this->input->post('nama');
            $data['nama']=$nama;
        }
        if ($this->input->post('password')) {
            $password = $this->input->post('password');
            $data['password']=$password;
            
        }

        $this->db->where('id_user', $id_user);
       $update= $this->db->update('m_user', $data);


        // send email + code

        if ($update) {
                $this->djson(
                    array(
                        "status" => "200",
                        "messages" => "update success"
                    )
                );
            } else {
                $this->djson(
                    array(
                        "status" => "200",
                        "messages" => "update failed"
                    )
                );
            }
        }
}
