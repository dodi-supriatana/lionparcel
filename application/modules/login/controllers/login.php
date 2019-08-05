<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login extends MX_Controller
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

    public function get_login()
    {

        // search data
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $data = $this->db->query("SELECT * FROM m_user where username='" . $username . "' and password='" . $password . "'");

        // print_r($data->num_rows());
        // die();
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $key) {
                $is_active = $key->is_active;
            }

            if ($is_active == '1') {
                $kirim = $data->result();
                $jwtPayload = [
                    "username" => $kirim[0]->username,
                    "id_user" => $kirim[0]->id_user
                ];
                $jwtPayload["timestamp"] = time();
                $token = AUTHORIZATION::generateToken($jwtPayload);
                $kirim[0]->tokenJwt = $token;
                $message = 'active user';
            } else {
                $kirim = [];
                $message = 'your mock-up license is expired, please contact yugo@cudocomm.com';
            }
        } else {
            $kirim = [];
            $message = 'Username and password do not match';
        }
        $this->djson(
            array(
                "status" => "200",
                'message' => $message,
                "data" => $kirim
            )
        );
    }


    public function searchagenbykota()
    { }


    public function searchbycoordinate($lat1 = '32.9697', $lon1 = '-96.80322')
    {
        $data_agen = $this->db->query("SELECT id_agent,latitude,longitude FROM tabel_agen")->result();

        $this->djson(
            array(
                "status" => "200",
                "data" => $data_agen
            )
        );
    }
    public function calculate($lat1 = '32.9697', $lon1 = '-96.80322', $lat2 = '29.46786', $lon2 = '-98.53506', $unit = 'm')
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            $data = ($miles * 1.609344);
            echo $data;
            die();
        }
    }
}
