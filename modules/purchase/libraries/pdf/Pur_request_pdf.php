<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once(APPPATH . 'libraries/pdf/App_pdf.php');

class Pur_request_pdf extends App_pdf
{
    protected $pur_request;

    public function __construct($pur_request)
    {
        $pur_request                = hooks()->apply_filters('request_html_pdf_data', $pur_request);
        $GLOBALS['pur_request_pdf'] = $pur_request;

        parent::__construct();

        $this->pur_request = $pur_request;
        // echo json_encode(format_pur_request_number($id))
        $this->SetTitle('Purchase Request');
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $this->SetHeaderMargin(PDF_MARGIN_HEADER);
        // $halaman = $this->PageNo();
        # Don't remove these lines - important for the PDF layout
        $this->pur_request = $this->fix_editor_html($this->pur_request);
    }

    public function prepare()
    {
        $this->set_view_vars('pur_request', $this->pur_request);

        return $this->build();
    }

    protected function type()
    {
        return 'pur_request';
    }

    protected function file_path()
    {
        $customPath = APPPATH . 'views/themes/' . active_clients_theme() . '/views/my_requestpdf.php';
        $actualPath = APP_MODULES_PATH . '/purchase/views/purchase_request/pur_requestpdf.php';

        if (file_exists($customPath)) {
            $actualPath = $customPath;
        }

        return $actualPath;
    }
}