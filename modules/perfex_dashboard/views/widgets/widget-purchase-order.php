<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
  Widget Name: New Customers
  Description: New Customers
  
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
    SELECT pur_order_number, order_date, vendor, total, tblpur_orders.datecreated as dated, id, total_tax, approve_status, delivery_status, delivery_date, company FROM " . db_prefix() . "pur_orders
    LEFT JOIN " .db_prefix(). "pur_vendor ON " . db_prefix(). "pur_vendor.userid = " .db_prefix(). "pur_orders.vendor";
    // echo $sql;
  if (isset($widget_req_from) && isset($widget_req_to)) {
    $sql .= "
      WHERE dated >= '" . $widget_req_from . " 00:00:00' AND dated <= '" . $widget_req_to . " 23:23:59' 
    ";
  }
  $sql .= "
    ORDER BY dated DESC LIMIT 0 , 5
  ";
  
  return $this->db->query($sql )->result_array();
};

$widget_data = $fn_get_data();
// echo json_encode($widget_data);
$base_currency = get_base_currency_pur();
?>

<div class="widget widget-new-customers widget-<?= $widget['id'] ?>" data-widget-id="<?= $widget['id'] ?>">
  <div class="">
    <div class="panel_s">
      <div class="panel-body">
        <div class="widget-dragger"></div>

        <h4 class="pull-left mtop5"><?php echo _l('5 Last Purchase Order'); ?></h4>
        <!-- <a href="<?php echo admin_url('clients'); ?>" class="pull-right mtop5"><?php echo _l('home_stats_full_report'); ?></a> -->
        <div class="clearfix"></div>
        <div class="row mtop5">
          <hr class="hr-panel-heading-dashboard">
        </div>
        <div style="overflow-x:auto;">
        <table class="table dataTable no-footer dtr-inline">
          <thead>
            <th><?= _l('PO Number') ?></th>
            <th><?= _l('Vendor') ?></th>
            <th><?= _l('Order Date') ?></th>
            <th><?= _l('Status') ?></th>
            <th><?= _l('Total') ?></th>
            <!-- <th><?= _l('Total Tax') ?></th> -->
            <th><?= _l('Delivery Date') ?></th>
            <th><?= _l('Delivery Status') ?></th>
            <th><?= _l('Created At') ?></th>
          </thead>
          <tbody>
            <?php if (count($widget_data) > 0) { ?>
              <?php foreach ($widget_data as $widget_row) { ?>
                <tr>
                  <!-- <td>
                    <a href="<?= admin_url('staff/profile/' . $widget_row['requester']) ?>"> <?= staff_profile_image($widget_row['requester'], ['staff-profile-image-small',]) ?> </a>
                    <a href="<?= admin_url('staff/profile/' . $widget_row['requester']) ?>"> <?= get_staff_full_name($widget_row['requester']) ?> </a>
                  </td> -->
                  <td><a href="<?= admin_url('purchase/view_pur_request/' . $widget_row['id']) ?>"><?= $widget_row['pur_order_number'] ?></a></td>
                  <td><a href="<?= admin_url('purchase/vendor/' . $widget_row['vendor']) ?>"><?= $widget_row['company'] ?></a></td>
                  <td><?= $widget_row['order_date'] ?></td>
                  <?php if ($widget_row['approve_status'] == 1) { ?>
                  <td><span class="inline-block label label-warning" id="status_span_<?= $widget_row['id'] ?>" task-status-table="pending">Pending</td>
                  <?php } ?>
                  <?php if ($widget_row['approve_status'] == 2) { ?>
                  <td><span class="inline-block label label-success" id="status_span_<?= $widget_row['id'] ?>" task-status-table="approved">Approved</td>
                  <?php } ?>
                  <?php if ($widget_row['approve_status'] == 3) { ?>
                  <td><span class="inline-block label label-danger" id="status_span_<?= $widget_row['id'] ?>" task-status-table="rejected">Rejected</td>
                  <?php } ?>
                  <td><?= app_format_money($widget_row['total'],$base_currency->symbol) ?></td>
                  <!-- <td><?= $widget_row['total_tax'] ?></td> -->
                  <td><?= $widget_row['delivery_date'] ?></td>
                  <?php if ($widget_row['delivery_status'] == 0) { ?>
                  <td><span class="inline-block label label-danger" id="status_span_<?= $widget_row['id'] ?>" task-status-table="pending">Undelivered</td>
                  <?php } ?>
                  <?php if ($widget_row['delivery_status'] == 1) { ?>
                  <td><span class="inline-block label label-success" id="status_span_<?= $widget_row['id'] ?>" task-status-table="pending">Completely Delivered</td>
                  <?php } ?>
                  <?php if ($widget_row['delivery_status'] == 2) { ?>
                  <td><span class="inline-block label label-info" id="status_span_<?= $widget_row['id'] ?>" task-status-table="approved">Pending Delivered</td>
                  <?php } ?>
                  <?php if ($widget_row['delivery_status'] == 3) { ?>
                  <td><span class="inline-block label label-warning" id="status_span_<?= $widget_row['id'] ?>" task-status-table="rejected">Partially Delivered</td>
                  <?php } ?>
                  <td><?= time_ago($widget_row['dated']) ?></td>
                </tr>
              <?php } ?>
            <?php } else { ?>
              <tr>
                <td colspan="2"><?= _l('not_found') ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>