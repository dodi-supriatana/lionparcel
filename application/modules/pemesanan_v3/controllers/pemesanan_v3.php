<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pemesanan_v3 extends MX_Controller
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

    public function rupiah($angka)
    {

        $hasil_rupiah = number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }

    public function pesanan()
    {
    //     echo "kontol";
    //     die();
        $this->load->helper('url');
        // $this->load->model('HistoryOrder_model');
        $order_by = $this->input->post('order_by');
        // die($status_barang);
        // 1=Customer
        // 2=Onsales(go Show)
        // 3=On Call
        // 4=At hock        


        // Pasti di kirim
        $id_user = $this->input->post('id_user', true);
        $id_agent = strtoupper($this->input->post('id_agent', true));
        $nama_agen = strtoupper($this->input->post('nama_agen', true));
        $id_kurir = "";
        $nama_kurir = "";
        // $status = "1";

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d h:i:s");
        $tgl = date("Y-m-d");
        $waktu = date("h:i:s");

        $receiver = $this->input->post('receiver');
        $nomor_penerima = $this->input->post('nomor_penerima');
        $destination = $this->input->post('destination');
        $sender = $this->input->post('sender');
        $nomor_pengirim = $this->input->post('nomor_pengirim');
        $origin = $this->input->post('origin');
        $berat = $this->input->post('berat');
        $dimensi_lebar = $this->input->post('dimensi_lebar');
        $dimensi_panjang = $this->input->post('dimensi_panjang');
        $dimensi_tinggi = $this->input->post('dimensi_tinggi');
        $payment_metode = $this->input->post('payment_metode');
        $harga = $this->input->post('harga');
        $picup_lat = $this->input->post('picup_lat');
        $pickup_long = $this->input->post('pickup_long');
        $product = $this->input->post('product');
        $alamat_agen = $this->input->post('alamat_agen');


        if ($order_by != 4) {
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $this->input->post("img_base64")));
            // rename file name with random number
            $image_name = md5(uniqid(rand(), true));
            $filename = $image_name . '.' . 'png';
            // image uploading folder path
            $path = "assets/uploaded_image/";
            // image is bind and upload to respective folder
            file_put_contents($path . $filename, $image);
            $image = base_url('assets/uploaded_image/' . $filename);
        } else {
            $image = "";
        }

        if ($order_by == '1') { // 1=Customer 
            $flag_proccess = "001";
            // $sttNo = rand(88, 99) . '-18-' . rand(111, 999);
            $id_book = 'BOOK' . rand(0, 1000) . rand(0, 999);
            $dataInsert_header =  [
                'id_book' => $id_book,
                'id_user' => $id_user,
                'id_agent' => $id_agent,
                'nama_agen' => $nama_agen,
                'id_kurir' => $id_kurir,
                'nama_kurir' => $nama_kurir,
                'status' => $order_by,
                'flag_proccess' => $flag_proccess,
                // 'order_by' => $order_by,
                'date' => $date,
                'tgl' => $tgl,
                'waktu' => $waktu,
                'img_name' => $image,
                'receiver' => $receiver,
                'nomor_penerima' => $nomor_penerima,
                'destination' => $destination,
                'sender' => $sender,
                'nomor_pengirim' => $nomor_pengirim,
                'origin' => $origin,
                'berat' => $berat,
                'dimensi_lebar' => $dimensi_lebar,
                'dimensi_panjang' => $dimensi_panjang,
                'dimensi_tinggi' => $dimensi_tinggi,
                'payment_metode' => $payment_metode,
                'harga' => $harga,
                'picup_lat' => $picup_lat,
                'pickup_long' => $pickup_long,
                'product' => $product,
                'alamat_agen' => $alamat_agen
            ];
            $success = $this->db->insert('list_pickup_header', $dataInsert_header);
            
            if ($success) {
                $success = $this->db->insert('list_pickup_detail', $dataInsert_header);
                return $this->djson(
                    array(
                        "status" => "200",
                        "data" => "success booking"
                    )
                );
            } else {
                return $this->djson(
                    array(
                        "status" => "500",
                        "msg" => "Some Error Occured. Please Try Again."
                    )
                );
            }
        } elseif ($order_by == '2') { // 2=Onsales(go Show)
            $flag_proccess = "005";
            $sttNo = rand(88, 99) . '-18-' . rand(111, 999);
            $id_book = 'BOOK' . rand(0, 1000) . rand(0, 999);
            $dataImage = [];
            $dataImage['stt_no'] = $sttNo;
            $dataImage['product'] = $product;
            $dataImage['date'] = $date;
            $dataImage['nama_agen'] = $nama_agen;
            $dataImage['alamat_agen'] = $alamat_agen;
            $dataImage['nama_penerima'] = $receiver;
            $dataImage['alamat_penerima'] = $destination;
            $dataImage['nomor_penerima'] = $nomor_penerima;
            $dataImage['nama_pengirim'] = $sender;
            $dataImage['alamat_pengirim'] = $origin;
            $dataImage['nomor_pengirim'] = $nomor_pengirim;
            $dataImage['panjang'] = $dimensi_panjang;
            $dataImage['lebar'] = $dimensi_lebar;
            $dataImage['tinggi'] = $dimensi_tinggi;
            $dataImage['berat'] = $berat;
            $dataImage['harga'] = $harga;
            $dataInsert_header =  [
                'no_resi'=>$sttNo,
                'id_book' => $id_book,
                'id_user' => $id_user,
                'id_agent' => $id_agent,
                'nama_agen' => $nama_agen,
                'id_kurir' => $id_kurir,
                'nama_kurir' => $nama_kurir,
                'status' => $order_by,
                'flag_proccess' => $flag_proccess,
                // 'status_barang' => $order_by,
                'date' => $date,
                'tgl' => $tgl,
                'waktu' => $waktu,
                'img_name' => $image,
                'receiver' => $receiver,
                'nomor_penerima' => $nomor_penerima,
                'destination' => $destination,
                'sender' => $sender,
                'nomor_pengirim' => $nomor_pengirim,
                'origin' => $origin,
                'berat' => $berat,
                'dimensi_lebar' => $dimensi_lebar,
                'dimensi_panjang' => $dimensi_panjang,
                'dimensi_tinggi' => $dimensi_tinggi,
                'payment_metode' => $payment_metode,
                'harga' => $harga,
                'picup_lat' => $picup_lat,
                'pickup_long' => $pickup_long,
                'product' => $product,
                'alamat_agen' => $alamat_agen
            ];
            $success = $this->db->insert('list_pickup_header', $dataInsert_header);

            if ($success) {
                $data = $this->get_image_base64($dataImage);
                $image_base64=$data['image_base64'];
                $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_base64));
                // rename file name with random number
                $image_name = md5(uniqid(rand(), true));
                $filename = $image_name . 'RESI.' . 'png';
                // image uploading folder path
                $path = "assets/uploaded_image/";
                // image is bind and upload to respective folder
                file_put_contents($path . $filename, $image);
                $image = base_url('assets/uploaded_image/' . $filename);
    
                $update =  [
                    'resi_img'=>$image
                ];
                $this->db->where('id_book', $id_book);
                $success= $this->db->update('list_pickup_header', $update);
                $success = $this->db->insert('list_pickup_detail', $dataInsert_header);
                if (!$data) {
                    return $this->djson(
                        array(
                            "status" => "500",
                            "msg" => 'Error when generate image'
                        )
                    );
                }
                return $this->djson(
                    array(
                        "status" => "200",
                        "data" => $data
                    )
                );
            } else {
                return $this->djson(
                    array(
                        "status" => "500",
                        "msg" => "Some Error Occured. Please Try Again."
                    )
                );
            }
        } elseif ($order_by == '3') { // 3=On Call
            $flag_proccess = "001";
            $id_book = 'BOOK' . rand(0, 1000) . rand(0, 999);
            $dataInsert_header =  [
                'id_book' => $id_book,
                'id_user' => $id_user,
                'id_agent' => $id_agent,
                'nama_agen' => $nama_agen,
                'id_kurir' => $id_kurir,
                'nama_kurir' => $nama_kurir,
                'status' => $order_by,
                'flag_proccess' => $flag_proccess,
                // 'status_barang' => $order_by,
                'date' => $date,
                'tgl' => $tgl,
                'waktu' => $waktu,
                'img_name' => $image,
                'receiver' => $receiver,
                'nomor_penerima' => $nomor_penerima,
                'destination' => $destination,
                'sender' => $sender,
                'nomor_pengirim' => $nomor_pengirim,
                'origin' => $origin,
                'berat' => $berat,
                'dimensi_lebar' => $dimensi_lebar,
                'dimensi_panjang' => $dimensi_panjang,
                'dimensi_tinggi' => $dimensi_tinggi,
                'payment_metode' => $payment_metode,
                'harga' => $harga,
                'picup_lat' => $picup_lat,
                'pickup_long' => $pickup_long,
                'product' => $product,
                'alamat_agen' => $alamat_agen
            ];
            $success = $this->db->insert('list_pickup_header', $dataInsert_header);

            if ($success) {
                $success = $this->db->insert('list_pickup_detail', $dataInsert_header);
                return $this->djson(
                    array(
                        "status" => "200",
                        "data" => "success booking"
                    )
                );
            } else {
                return $this->djson(
                    array(
                        "status" => "500",
                        "msg" => "Some Error Occured. Please Try Again."
                    )
                );
            }
        } elseif ($order_by == '4') { // 4=At hock 
            $flag_proccess = "005";
            $sttNo = rand(88, 99) . '-18-' . rand(111, 999);
            $id_book = 'BOOK' . rand(0, 1000) . rand(0, 999);
            $dataImage = [];
            $dataImage['stt_no'] = $sttNo;
            $dataImage['product'] = $product;
            $dataImage['date'] = $date;
            $dataImage['nama_agen'] = $nama_agen;
            $dataImage['alamat_agen'] = $alamat_agen;
            $dataImage['nama_penerima'] = $receiver;
            $dataImage['alamat_penerima'] = $destination;
            $dataImage['nomor_penerima'] = $nomor_penerima;
            $dataImage['nama_pengirim'] = $sender;
            $dataImage['alamat_pengirim'] = $origin;
            $dataImage['nomor_pengirim'] = $nomor_pengirim;
            $dataImage['panjang'] = $dimensi_panjang;
            $dataImage['lebar'] = $dimensi_lebar;
            $dataImage['tinggi'] = $dimensi_tinggi;
            $dataImage['berat'] = $berat;
            $dataImage['harga'] = $harga;
            $dataInsert_header =  [
                'id_book' => $id_book,
                'id_user' => $id_user,
                'id_agent' => $id_agent,
                'nama_agen' => $nama_agen,
                'id_kurir' => $id_kurir,
                'nama_kurir' => $nama_kurir,
                'status' => $order_by,
                'flag_proccess' => $flag_proccess,
                // 'status_barang' => $order_by,
                'date' => $date,
                'tgl' => $tgl,
                'waktu' => $waktu,
                'img_name' => $image,
                'receiver' => $receiver,
                'nomor_penerima' => $nomor_penerima,
                'destination' => $destination,
                'sender' => $sender,
                'nomor_pengirim' => $nomor_pengirim,
                'origin' => $origin,
                'berat' => $berat,
                'dimensi_lebar' => $dimensi_lebar,
                'dimensi_panjang' => $dimensi_panjang,
                'dimensi_tinggi' => $dimensi_tinggi,
                'payment_metode' => $payment_metode,
                'harga' => $harga,
                'picup_lat' => $picup_lat,
                'pickup_long' => $pickup_long,
                'product' => $product,
                'alamat_agen' => $alamat_agen
            ];
            $success = $this->db->insert('list_pickup_header', $dataInsert_header);

            if ($success) {
                $data = $this->get_image_base64($dataImage);
                $success = $this->db->insert('list_pickup_detail', $dataInsert_header);
                if (!$data) {
                    return $this->djson(
                        array(
                            "status" => "500",
                            "msg" => 'Error when generate image'
                        )
                    );
                }
                return $this->djson(
                    array(
                        "status" => "200",
                        "data" => $data
                    )
                );
            } else {
                return $this->djson(
                    array(
                        "status" => "500",
                        "msg" => "Some Error Occured. Please Try Again."
                    )
                );
            }
            // athoc
        }
    }

    public function get_image_base64($data)
    {
        $this->load->helper('url');
        $dataImage = [
            'stt_no' => $data['stt_no'],
            'product' => strtoupper($data['product']),
            'date' => $data['date'],
            'nama_agen' => ucwords($data['nama_agen']),
            'alamat_agen' => ucwords($data['alamat_agen']),
            'nama_pengirim' => ucwords($data['nama_pengirim']),
            'alamat_pengirim' => ucwords($data['alamat_pengirim']),
            'nomor_pengirim' => $data['nomor_pengirim'],
            'nama_penerima' => ucwords($data['nama_penerima']),
            'alamat_penerima' => ucwords($data['alamat_penerima']),
            'nomor_penerima' => ucwords($data['nomor_penerima']),
            'panjang' => $data['panjang'],
            'lebar' => $data['lebar'],
            'tinggi' => $data['tinggi'],
            'berat' => $data['berat'],
            'harga' => $data['harga']
        ];

        $html = ' 
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Document</title>
                <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
                <style>
                    * {
			            padding: 0;
			            margin: 0;
			            font-family: "Raleway", sans-serif;
			            box-sizing: border-box;
			        }

			        .container {
			            width: 1700px;
			            height: 1000px;
                        background-image: url("data:image/png;base64,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");
                        background-position: -100px -180px;
                        background-size: 110% 130%;
			            background-repeat: no-repeat;
			            overflow: hidden;
			        }

			        .satu {
			            height: 25%;
			            display: flex;
			            flex-direction: row;
			        }

			        .satu .kiri {
			            padding: 0% 0 0 6%;
			            flex: 2;
			        }

			        .satu .kiri p {
			            margin: 0.5% 0;
			        }

			        .logo {
                        background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABwEAAAFgCAYAAABT8QZBAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyhpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQwIDc5LjE2MDQ1MSwgMjAxNy8wNS8wNi0wMTowODoyMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTggKE1hY2ludG9zaCkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RjJCQjY5NzlCNjlEMTFFOUEzNzNBRjEwMTNBRjc3QTQiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RjJCQjY5N0FCNjlEMTFFOUEzNzNBRjEwMTNBRjc3QTQiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpGMkJCNjk3N0I2OUQxMUU5QTM3M0FGMTAxM0FGNzdBNCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpGMkJCNjk3OEI2OUQxMUU5QTM3M0FGMTAxM0FGNzdBNCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PiRdZvwAACh7SURBVHja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");
                        background-repeat: no-repeat;
			            background-position: 0% 60%;
			            background-size: 400px 80px;
			            height: 100px;
			            width: 500px;
			            margin-bottom: 1%;
			            margin-top: 2%;
			        }

			        .satu .kiri p:nth-child(2){
			            font-size: 32px;
			        }

			        .satu .kiri p:nth-child(3) {
			            font-size: 25px;
			        }

			        .satu .kanan {
			            padding: 5% 6% 0 0;
			            text-align: right;
			            font-size: 35px;
			        }

			        .dua,
			        .empat,
			        .enam {
			            background-color: rgb(233, 233, 233);
			            padding-left: 6%;
			            height: 6%;
			            display: flex;
			            flex-direction: column;
			            justify-content: space-around;
			            font-size: 30px;
			            color: rgb(255, 77, 145);
			            font-weight: bold;
			        }

			        .tiga {
			            height: 30%;
			            display: flex;
			            flex-direction: row;
			            padding-top: 3%;
			        }

			        .tiga .kiri p:nth-child(1),
			        .tiga .kanan p:nth-child(1){
			            font-weight: bold;
			            margin-bottom: 3%;
			            font-size: 30px;
			        }

			        .tiga .kiri p:nth-child(2),
			        .tiga .kanan p:nth-child(2){
			            font-weight: bold;
			            margin-bottom: 2%;
			            font-size: 25px;
			        }

			        .tiga .kiri p:nth-child(3),
			        .tiga .kanan p:nth-child(3){
			            font-size: 22px;
			            margin-bottom: 3%;
			        }

			        .line {
			            border-top: 1px solid rgb(202, 202, 202);
			        }

			        .tiga .kiri {
			            width: 50%;
			            padding-left: 6%;
			            padding-right: 2%;
			            word-wrap: break-word;
			            overflow: auto;
			        }

			        .tiga .kanan {
			            width: 50%;
			            padding-right: 6%;
			            padding-left: 2%;
			            word-wrap: break-word;
			            overflow: auto;
			        }

			        .lima {
			            height: 25%;
			            display: flex;
			            flex-direction: row;
			            padding: 2% 6%;
			        }

			        .lima .col {
			            flex: 1;
			        }
			        
			        .col p:nth-child(1) {
			            margin-top: 15%;
                        font-size: 23px;
			            font-weight: 500;
			        }

			        .col p:nth-child(2) {
			            margin-top: 15%;
			            margin-bottom: 40%;
			            font-weight: bold;
                        font-size: 23px;  
			        }

			        .col-7 p:nth-child(1) {
			            text-align: center;
			        }

			        .col-7 p:nth-child(2) {
			            text-align: right;
			        }
			        
			        .enam {
			            display: flex;
			            flex-direction: row;
			            padding: 0 6%;
			        }

			        .enam .kiri {
			            flex: 4;
			            text-align: right;
			            padding-right: 35%;
			            margin: auto 0;
			        }

			        .enam .kanan {
			            flex: 1;
			            text-align: right;
			            margin: auto 0;
			        }
                </style>
            </head>
            <body>
                <!-- 1280 x 802 -->
                <!-- -40% -->
                <!-- 512 | 321 -->
                <!-- 768 x 481 -->
                <div class="container">
                    <div class="satu">
                        <div class="kiri">
                            <div class="logo"></div>
                            <p>Agen Lion Parcel : <b>' . $dataImage['nama_agen'] . '</b></p>
                            <p>' . $dataImage['alamat_agen'] . '</p>
                        </div>
                        <div class="kanan">
                            <p>STT No. ' . $dataImage['stt_no'] . '</p>
                            <p>' . $dataImage['date'] . '</p>
                        </div>
                    </div>
                    <div class="dua">
                        <p>Detail Pengiriman</p>
                    </div>
                    <div class="tiga">
                        <div class="kiri">
                            <p>Asal Pengirim</p>
                            <p>' . $dataImage['nama_pengirim'] . '</p>
                            <p> ' . $dataImage['alamat_pengirim'] . ' <br>
                            ' . $dataImage['nomor_pengirim'] . ' </p>
                            
                            <div class="line"></div>
                        </div>
                        <div class="kanan">
                            <p>Tujuan Pengiriman</p>
                            <p>' . $dataImage['nama_penerima'] . '</p>
                            <p>' . $dataImage['alamat_penerima'] . '<br>
                            ' . $dataImage['nomor_penerima'] . '</p>
                            <div class="line"></div>
                        </div>
                    </div>
                    <div class="empat">
                        <p>Informasi Product</p>
                    </div>
                    <div class="lima">
                        <div class="col col-1">
                            <p>Jumlah</p>
                            <p>1</p>
                        </div>
                        <div class="col col-2">
                            <p>Product</p>
                            <p>' . $dataImage['product'] . '</p>
                        </div>
                        <div class="col col-3">
                            <p>Panjang/cm</p>
                            <p>' . $dataImage['panjang'] . '</p>
                        </div>
                        <div class="col col-4">
                            <p>Lebar/cm</p>
                            <p>' . $dataImage['lebar'] . '</p>
                        </div>
                        <div class="col col-5">
                            <p>Tinggi/cm</p>
                            <p>' . $dataImage['tinggi'] . '</p>
                        </div>
                        <div class="col col-6">
                            <p>Berat/kg</p>
                            <p>' . $dataImage['berat'] . '</p>
                        </div>
                        <div class="col col-7">
                            <p>Harga</p>
                            <p>Rp. ' . number_format($dataImage['harga'], 0, ',', '.') . ',-</p>
                        </div>
                    </div>
                    <div class="enam">
                        <div class="kiri">
                            <p>Total Harga</p>
                        </div>
                        <div class="kanan">
                            <p>Rp. ' . $dataImage['harga'] . '</p>
                        </div>
                    </div>
                </div>
            </body>
            </html>
        ';
        $google_fonts = "Roboto";

        $data = array(
            'html' => $html,
            'google_fonts' => $google_fonts
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://hcti.io/v1/image");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        curl_setopt($ch, CURLOPT_POST, 1);
        // Retrieve your user_id and api_key from https://htmlcsstoimage.com/dashboard
        curl_setopt($ch, CURLOPT_USERPWD, "c7d34f7f-e17a-4b8d-9654-52e8756921b6" . ":" . "6dbda856-8cac-463f-8cbc-8ba1f28aa83e");

        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $res = json_decode($result, true);
        $url = $res['url'];
        $url .= '.png';
        $image = file_get_contents($url);
        if ($image !== false) {
            $dataImage['image_base64'] = 'data:image/png;base64,' . base64_encode($image);
            return $dataImage;
        }

        return false;
    }
}
