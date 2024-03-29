<?php
defined('BASEPATH') or exit('No direct script access allowed');

class booking extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('exportpdf_helper');
    }

    public function ressi(){
        $this->load->view('main');
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

    public function get_booking()
    {

        $date = date('Ymd');
        $agen=$this->input->post('agen');
        $alamatpengirim=$this->input->post('alamatpengirim');
        $alamatpenerima=$this->input->post('alamatpenerima');
        $jumlah=$this->input->post('jumlah');
        $product=$this->input->post('product');
        $harga=$this->input->post('harga');        
        $from = $this->input->post('origin');
        $des = $this->input->post('destination');
        $sender = $this->input->post('pengirim');;
        $to = $this->input->post('penerima');;
        $sttNO=date('Ymd').$this->input->post('user_id');


        $html = '<<<EOD
        <div class="invoice-box bgimg" id="canvas">
		<table cellpadding="0" cellspacing="0">
			<tr class="top">
				<td colspan="2">
					<table>
						<tr>
							<td class="title">
								<img src="<?php echo base_url("assets/logopanjangmerah.png") ?>" style="width:100%; max-width:300px;">
							</td>

							<td>
								STT No.11-18-621<br>
								Created: 29 Juni 2019<br>
								<!-- Due: February 1, 2015 -->
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr class="information">
				<td colspan="2">
					<table>
						<tr>
							<td>
								Agen LionParcel : Batan Indah <br>
								Alamat<br>
								<!-- Sunnyville, CA 12345 -->
							</td>

							<td>
								<!-- Acme Corp.<br>
                                John Doe<br>
                                john@example.com -->
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr class="heading">
				<td style="color: red;">
					Detail Pengirim
				</td>

				<td>

				</td>
			</tr>

			<tr class="details">
				<td>
					Check
				</td>

				<td>
					1000
				</td>
			</tr>

			<tr class="heading" style="color: red;">
				<td>
					Informasi Product
				</td>

				<td>

				</td>
			</tr>

			<tr>
				<td>
					Jumlah
				</td>
				<!-- <td>
                    product
				</td> -->

				<td>
					Harga
				</td>
			</tr>


			<tr class="total">
				<td></td>

				<td>
					Total Harga: Rp $total
				</td>
			</tr>
		</table>
	    </div>
        EOD';

        $css = "<<<EOD
        .bgimg {
			background-image: url('../assets/background_resi_2.png');
			background-repeat: no-repeat;
			background-size: 100%;

		}

		.invoice-box {
			max-width: 800px;
			margin: auto;
			padding: 30px;
			border: 1px solid #eee;
			box-shadow: 0 0 10px rgba(0, 0, 0, .15);
			font-size: 16px;
			line-height: 24px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			color: #555;
		}

		.invoice-box table {
			width: 100%;
			line-height: inherit;
			text-align: left;
		}

		.invoice-box table td {
			padding: 5px;
			vertical-align: top;
		}

		.invoice-box table tr td:nth-child(2) {
			text-align: right;
		}

		.invoice-box table tr.top table td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.top table td.title {
			font-size: 45px;
			line-height: 45px;
			color: #333;
		}

		.invoice-box table tr.information table td {
			padding-bottom: 40px;
		}

		.invoice-box table tr.heading td {
			background: #eee;
			border-bottom: 1px solid #ddd;
			font-weight: bold;
		}

		.invoice-box table tr.details td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.item td {
			border-bottom: 1px solid #eee;
		}

		.invoice-box table tr.item.last td {
			border-bottom: none;
		}

		.invoice-box table tr.total td:nth-child(2) {
			border-top: 2px solid #eee;
			font-weight: bold;
		}

		@media only screen and (max-width: 600px) {
			.invoice-box table tr.top table td {
				width: 100%;
				display: block;
				text-align: center;
			}

			.invoice-box table tr.information table td {
				width: 100%;
				display: block;
				text-align: center;
			}
		}

		/** RTL **/
		.rtl {
			direction: rtl;
			font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		}

		.rtl table {
			text-align: right;
		}

		.rtl table tr td:nth-child(2) {
			text-align: left;
		}
        EOD";
        $google_fonts = "Roboto";

        $data = array(
            'html' => $html,
            'css' => $css,
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
        // print_r($res);
        // $datas['image'] = base64_encode(file_get_contents($res['url'] . ".jpg"));
        // $datas['link'] = $res['url'] . ".jpg";


        
        $url =  $res['url'] . ".jpg";;
        $img = 'assets/bukti/' . $sender . 'to' . $to . '--' . $from . 'to' . $des . $date . '.jpg';
        $save_proses = file_put_contents($img, file_get_contents($url));

        //  echo base64_encode(file_get_contents(base_url($img)));
        $path = $url;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);

        $datas['agen']=$this->input->post('agen');
        $datas['alamatpengirim']=$this->input->post('alamatpengirim');
        $datas['alamatpenerima']=$this->input->post('alamatpenerima');
        $datas['jumlah']=$this->input->post('jumlah');
        $datas['product']=$this->input->post('product');
        $datas['harga']=$this->input->post('harga');        
        $datas['pengirim'] = $this->input->post('pengirim');;
        $datas['penerima'] = $this->input->post('penerima');;
        $datas['STTno']=$sttNO;
        $datas['base64'] = 'data:image/' . $type . ';base64,' . base64_encode($data);


        

        $this->djson(
            array(
                "status" => "200",
                "data" => $datas
            )
        );
    }
}
