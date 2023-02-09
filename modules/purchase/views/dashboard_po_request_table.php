<?php

defined('BASEPATH') or exit('No direct script access allowed');


$aColumns = [
    'pur_rq_code',
    'pur_rq_name',
    'requester',
    'request_date',
    'purchase_type',
    'status',
    'id',
    ];


$base_currency = get_base_currency_pur();

$sIndexColumn = 'id';
$sTable       = db_prefix().'pur_request';
// $join         = [
//                     'LEFT JOIN '.db_prefix().'pur_vendor ON '.db_prefix().'pur_vendor.userid = '.db_prefix().'pur_orders.vendor',
//                 ];
// $i = 0;


$where = [];



$result = data_tables_init($aColumns, $sIndexColumn, $sTable);
// echo json_encode($result);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

   for ($i = 0; $i < count($aColumns); $i++) {
        if (strpos($aColumns[$i], 'as') !== false && !isset($aRow[$aColumns[$i]])) {
            $_data = $aRow[strafter($aColumns[$i], 'as ')];
        } else {
            $_data = $aRow[$aColumns[$i]];
        }

        if($aColumns[$i] == 'pur_rq_code'){

            $numberOutput = '';
    
            $numberOutput = '<a href="' . admin_url('purchase/view_pur_request/' . $aRow['id']) . '"  onclick="init_pur_order(' . $aRow['id'] . '); return false;" >'.$aRow['pur_rq_code']. '</a>';
            
          

            $_data = $numberOutput;

        }elseif($aColumns[$i] == 'vendor'){
            $_data = '<a href="' . admin_url('purchase/vendor/' . $aRow['vendor']) . '" >' .  $aRow['company'] . '</a>';
        }elseif($aColumns[$i] == 'id'){
            $_data = '<td hidden>';
        }elseif ($aColumns[$i] == 'request_date') {
            $_data = _d($aRow['request_date']);
        }elseif($aColumns[$i] == 'requester'){
            $_data = '<a href="' . admin_url('staff/profile/' . $aRow['requester']) . '">' . staff_profile_image($aRow['requester'], [
                'staff-profile-image-small',
                ]) . '</a>';
            $_data .= ' <a href="' . admin_url('staff/profile/' . $aRow['requester']) . '">' . get_staff_full_name($aRow['requester']) . '</a>';
        }elseif($aColumns[$i] == 'subtotal'){
            $_data = app_format_money($aRow['subtotal'],$base_currency->symbol);
        }elseif($aColumns[$i] == 'status'){
            $delivery_status = '';

            if($aRow['status'] == 0){
                $delivery_status = '<span class="inline-block label label-danger" id="status_span_'.$aRow['id'].'" task-status-table="undelivered">'._l('Unknown');
            }else if($aRow['status'] == 1){
                $delivery_status = '<span class="inline-block label label-info" id="status_span_'.$aRow['id'].'" task-status-table="completely_delivered">'._l('Pending');
            }else if($aRow['status'] == 2){
                $delivery_status = '<span class="inline-block label label-success" id="status_span_'.$aRow['id'].'" task-status-table="pending_delivered">'._l('Approved');
            }else if($aRow['status'] == 3){
                $delivery_status = '<span class="inline-block label label-danger" id="status_span_'.$aRow['id'].'" task-status-table="partially_delivered">'._l('Rejected');
            }
            
          
            $delivery_status .= '</span>';
            $_data = $delivery_status;
            // $_data .= ' <a href="' . admin_url('staff/profile/' . $aRow['requester']) . '">' . get_staff_full_name($aRow['requester']) . '</a>';
        }elseif($aColumns[$i] == 'request_date'){
            $_data = _d($aRow['request_date']);
        }

        $row[] = $_data;
    }
    $output['aaData'][] = $row;

}
