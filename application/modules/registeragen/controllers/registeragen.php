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
        $user_id = $this->input->post('user_id');

        $data['namapendaftar'] = $this->input->post('nama_ktp');
        $data['namaagen'] = $this->input->post('nama_agen');
        $data['provinsi'] = $this->input->post('provinsi');
        $data['kota'] = $this->input->post('kota');
        $data['kecamatan'] = $this->input->post('kecamatan');
        $data['alamat'] = $this->input->post('alamat');
        $data['jamoperasional'] = $this->input->post('jam_operasi');
        // $foto_ktp = $this->input->post('foto_ktp');
        // $foto_kk = $this->input->post('foto_kk');
        // $foto_selfie = $this->input->post('foto_selfie');

        if ($this->input->post('foto_ktp')) {
            // $img_base64 = $this->input->post('foto_ktp');
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $this->input->post("foto_ktp")));
            // rename file name with random number
            $image_name = md5(uniqid(rand(), true));
            $filename = $image_name . '.' . 'png';
            // image uploading folder path
            $path = "assets/agen/";
            // image is bind and upload to respective folder
            file_put_contents($path . $filename, $image);
            $image_base_url = base_url('assets/agen/' . $filename);
            $data['ktp'] = $image_base_url;
            // die($image_base_url);
        }
        if ($this->input->post('foto_kk')) {
            // $img_base64 = $this->input->post('foto_ktp');
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $this->input->post("foto_kk")));
            // rename file name with random number
            $image_name = md5(uniqid(rand(), true));
            $filename = $image_name . '.' . 'png';
            // image uploading folder path
            $path = "assets/agen/";
            // image is bind and upload to respective folder
            file_put_contents($path . $filename, $image);
            $image_base_url = base_url('assets/agen/' . $filename);
            $data['kk'] = $image_base_url;
            // die($image_base_url);
        }
        if ($this->input->post('foto_selfie')) {
            // $img_base64 = $this->input->post('foto_ktp');
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $this->input->post("foto_selfie")));
            // rename file name with random number
            $image_name = md5(uniqid(rand(), true));
            $filename = $image_name . '.' . 'png';
            // image uploading folder path
            $path = "assets/agen/";
            // image is bind and upload to respective folder
            file_put_contents($path . $filename, $image);
            $image_base_url = base_url('assets/agen/' . $filename);
            $data['selfie'] = $image_base_url;
            // die($image_base_url);
        }
        $data['status']="0";

        // insert into tbl agen

    // echo json_encode($data);
    // die();
        $reg=$this->db->insert('register_agen', $data);

        $this->djson(
            array(
                "status" => "200"
            )
        );
    }
}
