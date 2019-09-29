<?php
defined('BASEPATH') or exit('No direct script access allowed');

class transaction extends MX_Controller
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
    
    public function pesanan()
    {
        $this->load->helper('url');
       $flag_proccess= $this->input->post('flag_proccess');

        if ($flag_proccess='001') { //booking
            // system
            $id_book = 'BOOK'.rand(0, 1000) . rand(0, 999); 
            date_default_timezone_set('Asia/Jakarta');
            $date = date("Y-m-d h:i:s");
            $tgl= date("Y-m-d");
            $waktu=date("h:i:s");      
            $id_kurir="";
            $nama_kurir="";
            $status="1";
            $status_barang="1"; // perhitungan betat vs dimensi      
            // param
            $id_user = $this->input->post('id_user', true);
            $id_agent = strtoupper($this->input->post('id_agent', true));
            $nama_agen = strtoupper($this->input->post('nama_agen', true));
                    $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $this->input->post("img_base64")));
                    // rename file name with random number
                    $image_name = md5(uniqid(rand(), true));
                    $filename = $image_name . '.' . 'png';
                    // image uploading folder path
                    $path = "assets/uploaded_image/";
                    // image is bind and upload to respective folder
                    file_put_contents($path . $filename, $image);    
            $image = base_url('assets/uploaded_image/' . $filename);
            $receiver = $this->input->post('receiver');
            $nomor_penerima=$this->input->post('nomor_penerima');
            $destination = $this->input->post('destination');
            $sender=$this->input->post('sender');
            $nomor_pengirim=$this->input->post('nomor_pengirim');
            $origin=$this->input->post('origin');
            $berat=$this->input->post('berat');
            $dimensi_lebar=$this->input->post('dimensi_lebar');
            $dimensi_panjang=$this->input->post('dimensi_panjang');
            $dimensi_tinggi=$this->input->post('dimensi_tinggi');
            $payment_metode=$this->input->post('payment_metode');
            $harga=$this->input->post('harga');
            $picup_lat=$this->input->post('picup_lat');
            $pickup_long=$this->input->post('pickup_long');
            $product = $this->input->post('product');

            $dataInsert_header =  [
                'id_book'=>$id_book,
                'id_user'=>$id_user,
                'id_agent'=>$id_agent,
                'nama_agen'=>$nama_agen,
                'id_kurir'=>$id_kurir,
                'nama_kurir'=>$nama_kurir,
                'status'=>$status,
                'flag_proccess'=>$flag_proccess,
                'status_barang'=>$status_barang,
                'date'=>$date,
                'tgl'=>$tgl,
                'waktu'=>$waktu,
                'img_name'=>$image,
                'receiver'=>$receiver,
                'nomor_penerima'=>$nomor_penerima,
                'destination'=>$destination,
                'sender'=>$sender,
                'nomor_pengirim'=>$nomor_pengirim,
                'origin'=>$origin,
                'berat'=>$berat,
                'dimensi_lebar'=>$dimensi_lebar,
                'dimensi_panjang'=>$dimensi_panjang,
                'dimensi_tinggi'=>$dimensi_tinggi,
                'payment_metode'=>$payment_metode,
                'harga'=>$harga,
                'picup_lat'=>$picup_lat,
                'pickup_long'=>$pickup_long,
                'product'=>$product        
            ];

            print_r($dataInsert_header);
            die();
        } elseif ($flag_proccess='002') { //kurir taken
            # code...
        }elseif ($flag_proccess='003') { //Verification
            # code...
        }elseif ($flag_proccess='004') { //Payment
            # code...
        }elseif ($flag_proccess='005') { //Done
            # code...
        }elseif ($flag_proccess='006') { //batal  
            # code...
        }elseif ($flag_proccess='007') { //Fiktif 
            # code...
        }
        
    }
}