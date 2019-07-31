<?php
defined('BASEPATH') or exit('No direct script access allowed');

class bookingpdf extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('exportpdf_helper');
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
    public function cetak(){
        ob_start();
        $this->load->view('main');
        $html = ob_get_contents();
            
            require_once('./assets/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P','A4','en');
        $pdf->WriteHTML($html);
        ob_end_clean();
        $pdf->Output('Data.pdf', 'D');
      }
}
?>
