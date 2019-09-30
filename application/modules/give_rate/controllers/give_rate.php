<?php
defined('BASEPATH') or exit('No direct script access allowed');

class give_rate extends MX_Controller
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

    public function add_rate()
    {
        $id_user = $this->input->post('id_user');
        $rate=$this->input->post('rate');
        $id_agen=$this->input->post('id_agen');

        
        // cek user
        $cek_user=$this->db->query("SELECT count(*) as total  FROM history_reting_agen WHERE id_agent='".$id_agen."' and id_user='".$id_user."'")->row();
        
        if ($cek_user->total == 0) {
            $data_insert = array(
                'id_agent' => $id_agen,
                'bintang' => $rate,
                'id_user' => $id_user
            );

            $history=$this->db->insert('history_reting_agen', $data_insert);
            if ($history) {
                $get_rate_essisting=$this->db->query("SELECT rate FROM tabel_agen where id_agent='".$id_agen."'")->row();
                $get_total_vouter=$this->db->query("SELECT count(*) as total_vouter  FROM history_reting_agen WHERE id_agent='".$id_agen."'")->row();
                $total_vouter_new=$get_total_vouter->total_vouter;
                $rate_essisting=$get_rate_essisting->rate;
                $new_rate=($rate_essisting + $rate)/$total_vouter_new;

                // die("Rate existing".$rate_essisting." + input Rate".$rate." / total counter ".$total_vouter_new);

                $data = array(
                    'rate' => $new_rate
                );
                $this->db->where('id_agent', $id_agen);
                $this->db->update('tabel_agen', $data);
                $this->djson(
                    array(
                        "status" => "200",
                        "messages" => "update success"
                    )
                );
            }
        }else{
            $this->djson(
                array(
                    "status" => "200",
                    "messages" => "You once gave a rating"
                )
            );
        }

    }
        // insert to rate_history
        
        // update rate agen
}
