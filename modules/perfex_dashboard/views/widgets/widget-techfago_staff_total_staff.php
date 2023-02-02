<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
  Widget Name: Total Staff
  Description: Total Staff
  
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
    SELECT COUNT(*) AS TOTAL_ROWS 
    FROM " . db_prefix() . "staff TBLStaff
  ";
  if (isset($widget_req_from) && isset($widget_req_to)) {
    $sql .= "
      WHERE TBLStaff.datecreated >= '" . $widget_req_from . " 00:00:00' AND TBLStaff.datecreated <= '" . $widget_req_to . " 23:59:59'
    ";
  }

  return $this->db->query($sql)->result_array();
};

$widget_data = $fn_get_data();
?>

<div class="widget widget-finance-total-orders widget-<?= $widget['id'] ?>" data-widget-id="<?= $widget['id'] ?>">
  <div class="widget-dragger"></div>
  <div class="card-counter primary">
    <i class="fa fa-users"></i>
    <span class="count-numbers"><?= $widget_data[0]['TOTAL_ROWS'] ?></span>
    <span class="count-name"><?= _l('staff') ?></span>
  </div>
</div>