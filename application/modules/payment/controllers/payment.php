<?php
defined('BASEPATH') or exit('No direct script access allowed');

class payment extends MX_Controller
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

        $this->load->helper(['jwt', 'authorization']);
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

    public function rupiah($angka){
	
		$hasil_rupiah = number_format($angka,2,',','.');
		return $hasil_rupiah;
 
    }
    
    public function go_payment()
    {
        $this->load->helper('url');
        // $this->load->model('HistoryOrder_model');
        // $id_book = 'BOOK'.rand(0, 1000) . rand(0, 999);       
        // $id_user = $this->input->post('id_user');
        // $id_agent = strtoupper($this->input->post('id_agent', true));
        // $nama_agen = strtoupper($this->input->post('nama_agen', true));
        $id_book=$this->input->post('id_book');
        // $id_kurir=$this->input->post('id_kurir');
        // $nama_kurir=$this->input->post('nama_kurir');
        // $status="1";
        $flag_proccess="004";

        // date_default_timezone_set('Asia/Jakarta');
        // $date = date("Y-m-d h:i:s");
        // $tgl= date("Y-m-d");
        // $waktu=date("h:i:s");
       
        // $picup_lat=$this->input->post('picup_lat');
        // $pickup_long=$this->input->post('pickup_long');
        // $product = $this->input->post('product');
        // $no_resi=$this->input->post('no_resi');
        // $resi_img=$this->input->post('resi_img');


        $update =  [
            'flag_proccess'=>$flag_proccess
        ];

        // $insert_history =  [
        //     'id_book'=>$id_book,
        //     'id_kurir'=>$id_kurir,
        //     'id_user'=>$id_user,
        //     'nama_kurir'=>$nama_kurir,
        //     'status'=>$status,
        //     'flag_proccess'=>$flag_proccess,
        //     'date'=>$date,
        //     'tgl'=>$tgl,
        //     'waktu'=>$waktu,
        //     'picup_lat'=>$picup_lat,
        //     'pickup_long'=>$pickup_long
        // ];

            $this->db->where('id_book', $id_book);
            $success= $this->db->update('list_pickup_header', $update);
         
        // $this->HistoryOrder_model->insert('tracking', $dataInsertTracking);
        if($success){
            // $success = $this->db->insert('list_pickup_detail', $insert_history);       
            return $this->djson(
                array(
                    "status" => "200",
                    "data" => "success payment"
                )
            );

        }else
        {
            return $this->djson(
                array(
                    "status" => "500",
                    "msg" => "Some Error Occured. Please Try Again."
                )
            );
        }
    }
}