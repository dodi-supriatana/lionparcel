<?php
defined('BASEPATH') or exit('No direct script access allowed');

class registeragen extends MX_Controller
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

        // $this->input->post('nama_pendaftar');
        $namapendaftar = $this->input->post('namapendaftar');
        $namaagen = $this->input->post('namaagen');
        $alamat = $this->input->post('alamat');
        $provinsi = $this->input->post('provinsi');
        $kota = $this->input->post('kota');
        $kecamatan = $this->input->post('kecamatan');
        $ktp = $this->input->post('ktp');
        $kk = $this->input->post('kk');
        $jamoperasional = $this->input->post('jamoperasional');
        $selfie = $this->input->post('selfie');



        $imgktp = $ktp; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
        $imgktp = str_replace('data:image/png;base64,', '', $imgktp);
        $imgktp = str_replace(' ', '+', $imgktp);
        $data = base64_decode($imgktp);
        file_put_contents('/tmp/image.png', $data);


        //$this->send_email_registrasion($email);


        // $data = $this->db->query("SELECT w.3lc as id,CONCAT(w.kecamatan, ', ', w.type,'', w.kab_kota, ', ',w.provinsi) as name FROM wilayah w WHERE w.kecamatan like '" . $word . "%' GROUP BY kecamatan limit 10 ")->result();
        $this->djson(
            array(
                "status" => "200"
                // "data" => $dat   a
            )
        );
    }
}
