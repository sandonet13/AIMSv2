<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
  Widget Name: Total Orders
  Description: Total Orders
  
*/
?>

<?php
$fn_get_data = function () {
  $widget_req_from = DateTime::createFromFormat('Y-m-d', $this->input->get('period_from'));
  if ($widget_req_from !== false) {
    $widget_req_from = $widget_req_from->format('Y-m-d');
  } else {
    $widget_req_from = null;
  }

  $widget_req_to = DateTime::createFromFormat('Y-m-d', $this->input->get('period_to'));
  if ($widget_req_to !== false) {
    $widget_req_to = $widget_req_to->format('Y-m-d');
  } else {
    $widget_req_to = null;
  }

  $sql = "
    SELECT SUM(total) AS TOTAL_ROWS 
    FROM " . db_prefix() . "pur_orders
  ";
  if (isset($widget_req_from) && isset($widget_req_to)) {
    $sql .= "
      WHERE TBLInvoices.date >= '" . $widget_req_from . "' AND TBLInvoices.date <= '" . $widget_req_to . "'
    ";
  }

  return $this->db->query($sql)->result_array();
};

$widget_data = $fn_get_data();
$base_currency = get_base_currency_pur();
?>

<div class="widget widget-finance-total-orders widget-<?= $widget['id'] ?>" data-widget-id="<?= $widget['id'] ?>">
  <div class="widget-dragger"></div>
  <div class="card-counter danger">
    <i class="fa fa-dollar"></i>
    <span class="count-numbers" style="font-size:25px;"><?= app_format_money($widget_data[0]['TOTAL_ROWS'], $base_currency->symbol) ?></span>
    <span class="count-name"><?= _l('Total PO Value') ?></span>
  </div>
</div>