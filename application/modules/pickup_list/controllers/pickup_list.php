<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pickup_list extends MX_Controller
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

    public function get_pickup_list()
    {

        // search data
        $data = $this->db->query("SELECT id,id_book as order_id,product,date,img_name,flag_proccess,sender,origin,receiver,destination FROM list_pickup_header where flag_proccess='001' or flag_proccess='002' or flag_proccess='003' or flag_proccess='004'")->result();
        $history = $this->db->query("SELECT id,id_book as order_id,product,date,img_name,flag_proccess,sender,origin,receiver,destination FROM list_pickup_header where flag_proccess='005' or flag_proccess='006' or flag_proccess='007'")->result();
        $this->djson(
            array(
                "status" => "200",
                "pesanan" => $data,
                "history" => $history
            )
        );
    }

    public function get_tracking(){
        $id=$this->input->post('id');

        $header=$this->db->query("SELECT picup_lat,pickup_long,no_resi,resi_img FROM list_pickup_header where id='".$id."'")->row();
        $history=$this->db->query("SELECT id,app_command,date FROM list_pickup_detail where id_header='".$id."'")->result();
        

        $this->djson(
            array(
                "status" => "200",
                "data"=>$header,
                "history" => $history
            )
        );
    }


}
