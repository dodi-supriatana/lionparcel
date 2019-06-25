<?php
defined('BASEPATH') or exit('No direct script access allowed');

class boarding extends MX_Controller
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

    public function get_boarding()
    {

        // search data
        $data = $this->db->query("SELECT * FROM boarding where status='1'")->result();
        $this->djson(
            array(
                "status" => "200",
                "data" => $data
            )
        );
    }


    public function searchagenbykota()
    { }


    public function searchbycoordinate()
    {
        $user_latitude = $this->input->post('user_latitude');
        $user_longitude = $this->input->post('user_longitude');

        if (!empty($user_latitude) and !empty($user_longitude)) {

            $query = $this->db->query("SELECT tabel_agen.*,
            (6371 * acos(cos(radians(" . $user_latitude . ")) 
            * cos(radians(latitude)) * cos(radians(longitude) 
            - radians(" . $user_longitude . ")) + sin(radians(" . $user_latitude . ")) 
            * sin(radians(latitude)))) AS jarak 
            FROM tabel_agen 
            HAVING jarak < 10 ORDER BY jarak");
            $data = array();
            $lenght=$query->num_rows();
            foreach ($query->result() as $datas) {

                $row = array(
                    'id_agent' => $datas->id_agent,
                    'nama_agent' => $datas->nama_agent,
                    'alamat_agent' => $datas->alamat_agent,
                    'jam_operasional' => $datas->jam_operasional,
                    'no_telepon' => $datas->no_telepon,
                    'foto_1' => $datas->foto_1,
                    'foto_2' => $datas->foto_2,
                    'foto_3' => $datas->foto_3,
                    'latitude' => (float)$datas->latitude,
                    'longitude' => (float)$datas->longitude,
                    'status' => $datas->status,
                    'jarak' => $datas->jarak,
                    // 'latitude' => (float)$datas->latitude,

                );
                $data[] = $row;




                // $row[] = $datas->nama_agent;
                // $row[] = $datas->alamat_agent;
                // $row[] = $datas->jam_operasional;
                // $row[] = $datas->no_telepon;
                // $row[] = $datas->foto_1;
                // $row[] = $datas->foto_2;
                // $row[] = $datas->foto_3;
                // $row[] = (float)$datas->latitude;
                // $row[] = (float)$datas->longitude;
                // $row[] = $datas->status;
                // $row[] = $datas->jarak;
                // $data[] = $row;
            }
            // echo json_encode($row,);
        } else {
            $data = "please input data user latitude and longitude ";
        }

        $this->djson(
            array(
                "status" => "200",
                "lenght" =>$lenght,
                "data" => $data
            )
        );
        // echo json_encode($data);
    }

    public function get_lat_long()
    {
        $address = $this->input->post('address');
        $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&key=AIzaSyCfY9TPZ31i6nu-oTLQWjuHaIt5dbc86o4&sensor=false');
        $output = json_decode($geocode);
        $lat = @$output->results[0]->geometry->location->lat;
        $lng = @$output->results[0]->geometry->location->lng;

        if (!empty($lat) or !empty($lng)) {

            $query = $this->db->query("SELECT tabel_agen.*, 
                    (6371 * acos(cos(radians(" . $lat . ")) 
                    * cos(radians(latitude)) * cos(radians(longitude) 
                    - radians(" . $lng . ")) + sin(radians(" . $lat . ")) 
                    * sin(radians(latitude)))) AS jarak 
                    FROM tabel_agen 
                    HAVING jarak < 10 ORDER BY jarak");

            $data = array();
            $lenght=$query->num_rows();
            foreach ($query ->result() as $datas) {

                $row = array(
                    'id_agent' => $datas->id_agent,
                    'nama_agent' => $datas->nama_agent,
                    'alamat_agent' => $datas->alamat_agent,
                    'jam_operasional' => $datas->jam_operasional,
                    'no_telepon' => $datas->no_telepon,
                    'foto_1' => $datas->foto_1,
                    'foto_2' => $datas->foto_2,
                    'foto_3' => $datas->foto_3,
                    'latitude' => (float)$datas->latitude,
                    'longitude' => (float)$datas->longitude,
                    'status' => $datas->status,
                    'jarak' => $datas->jarak,
                    // 'latitude' => (float)$datas->latitude,

                );
                $data[] = $row;
            }
        } else {
            $data = [];
        }
        $this->djson(
            array(
                "status" => "200",
                "lenght" =>$lenght,
                "data" => $data
            )
        );
    }
}
