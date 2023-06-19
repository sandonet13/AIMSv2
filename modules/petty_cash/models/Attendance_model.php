<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Mailbox Model
 */
class Attendance_model extends App_Model
{
    /**
    * Controler __construct function to initialize options
    */
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id){
        $this->db->where('userid', $id);
        $this->db->order_by("checktime", "desc");
        return $this->db->get('checkinout')->result_array();
    }
}
