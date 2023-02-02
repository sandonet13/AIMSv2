<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once __DIR__ .'/../libraries/gtsslib.php';

/**
 * GTSSolution verify
 */
class Gtsverify extends AdminController{
    public function __construct(){
        parent::__construct();
    }

    /**
     * index
     * @return void
     */
    public function index(){
        show_404();
    }

    /**
     * activate
     * @return json
     */
    public function activate(){
        $license_code = strip_tags(trim($_POST["purchase_key"]));
        $client_name = strip_tags(trim($_POST["username"]));
        $api = new PurchaseLic();

          $msg = 'Nulled by codingshop.net';


        $res = array();
        $res['status'] = 1;
        $res['message'] = $msg;
            $res['original_url']= $this->input->post('original_url');

        echo json_encode($res);
    }
}
