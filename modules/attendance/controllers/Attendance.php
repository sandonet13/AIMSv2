<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Attendance extends AdminController 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('attendance_model');
    }

    /**
     * Go to Mailbox home page
     * @return view
     */
    public function index()
    {
        $id_att = "";
        if(get_staff_user_id() == 1){
            $id_att = 2;
        }if(get_staff_user_id() == 3){
            $id_att = 4;
        }if(get_staff_user_id() == 2){
            $id_att = 8;
        }if(get_staff_user_id() == 5){
            $id_att = 6;
        }if(get_staff_user_id() == 7){
            $id_att = 13;
        }if(get_staff_user_id() == 8){
            $id_att = 7;
        }if(get_staff_user_id() == 9){
            $id_att = 14;
        }
        
        // echo get_staff_user_id();
        $data['att']         = $this->attendance_model->get($id_att);
        $this->load->view('data', $data);
    }

}