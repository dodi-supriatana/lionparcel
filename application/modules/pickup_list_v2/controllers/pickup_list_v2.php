<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pickup_list_v2 extends MX_Controller
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


        if (($this->input->post('user_id'))) {
            $user_id=$this->input->post('user_id');
            $where=" and id_user=".$user_id;
        }else{
            $where="";

        }

        // if (!empty($this->input->post('user_id'))) {
        //     $where='';
        // }
        // if (!empty($this->input->post('user_id'))) {
        //     $where='';
        // }


        // search data
        $data = $this->db->query("SELECT id,id_book as order_id,product,date,img_name,flag_proccess,sender,origin,receiver,destination 
                                  FROM list_pickup_header 
                                  where (flag_proccess='001' or flag_proccess='002' or flag_proccess='003' or flag_proccess='004')".$where)->result();
        $history = $this->db->query("SELECT id,id_book as order_id,product,date,img_name,flag_proccess,sender,origin,receiver,destination 
                                    FROM list_pickup_header 
                                    where (flag_proccess='005' or flag_proccess='006' or flag_proccess='007')".$where)->result();
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
        $id_booking=$this->input->post('id_booking');


        $header=$this->db->query("SELECT picup_lat,pickup_long,no_resi,resi_img,id_kurir,nama_kurir FROM list_pickup_header where id='".$id."'")->result();
        $history_header=$this->db->query("SELECT picup_lat,pickup_long,id_kurir,no_resi,resi_img,nama_kurir FROM list_pickup_header WHERE id='".$id."'")->row();
        $history_detail=$this->db->query("SELECT
        id,
            date AS tanggal,
        CASE
                
                WHEN flag_proccess =001 THEN CONCAT('user Request Pickup with no pickup ', id_book ) 
                WHEN flag_proccess =002 THEN CONCAT(nama_kurir,' has taken Pickup with no pickup ')
                WHEN flag_proccess =003 THEN CONCAT(nama_kurir,' has verified')
                WHEN flag_proccess =004 or flag_proccess =005 THEN CONCAT('user has payment')
                ELSE '' 
            END  as command
            FROM
                list_pickup_detail 
        WHERE
            id_book = '".$id_booking."'")->result();

            $history=array('picup_lat'=>$history_header->picup_lat,'pickup_long'=>$history_header->pickup_long,'id_kurir'=>$history_header->id_kurir,'no_resi'=>$history_header->no_resi,'resi_img'=>$history_header->resi_img,'nama_kurir'=>$history_header->nama_kurir,'history_pesanan'=>$history_detail);
        

        $this->djson(
            array(
                "status" => "200",
                "data"=>$header,
                "history" => $history
            )
        );
    }


}
