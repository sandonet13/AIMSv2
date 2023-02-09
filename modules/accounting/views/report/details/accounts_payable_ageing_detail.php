<div id="accordion">
  <div class="card">
    <table class="tree">
      <tbody>
        <tr>
          <td colspan="6">
              <h3 class="text-center no-margin-top-20 no-margin-left-24"><?php echo get_option('companyname'); ?></h3>
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="6">
            <h4 class="text-center no-margin-top-20 no-margin-left-24"><?php echo _l('accounts_payable_ageing_detail'); ?></h4>
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="6">
            <p class="text-center no-margin-top-20 no-margin-left-24"><?php echo _d($data_report['to_date']); ?></p>
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr class="tr_header">
          <td class="text-bold"><?php echo _l('invoice_payments_table_date_heading'); ?></td>
          <td class="text-bold"><?php echo _l('transaction_type'); ?></td>
          <td class="text-bold"><?php echo _l('acc_no'); ?></td>
          <td class="text-bold"><?php echo _l('vendor'); ?></td>
          <td class="text-bold"><?php echo _l('invoice_add_edit_duedate'); ?></td>
          <td class="total_amount text-bold"><?php echo _l('amount'); ?></td>
        </tr>
        <?php
         $row_index = 1; 
         $parent_index = 1; 
         $total = 0; 
         ?>
         <tr class="treegrid-10000 parent-node expanded">
            <td class="parent"><?php echo _l('current'); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
         <?php foreach ($data_report['data']['current'] as $val) {
              $row_index += 1;
              $total += $val['amount'];
            ?>
            <tr class="treegrid-<?php echo html_entity_decode($row_index); ?> treegrid-parent-10000 ">
              <td>
              <?php echo _d($val['date']); ?> 
              </td>
              <td>
              <?php echo html_entity_decode($val['type']); ?> 
              </td>
              <td>
              <?php echo html_entity_decode($val['number']); ?> 
              </td>
              <td>
              <?php echo get_company_name($val['vendor']); ?> 
              </td>
              <td>
              <?php echo _d($val['duedate']); ?> 
              </td>
              <td class="total_amount">
              <?php echo app_format_money($val['amount'], $currency->name); ?> 
              </td>
            </tr>
          <?php }
            $row_index += 1;
           ?>
          
           <tr class="treegrid-total-<?php echo html_entity_decode($row_index); ?> treegrid-parent-10000 parent-node expanded tr_total">
            <td class="parent"><?php echo _l('total_for', _l('current')); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="total_amount"><?php echo app_format_money($total, $currency->name); ?></td>
          </tr>

          <?php
         $row_index++; 
         $total = 0; 
         ?>
         <tr class="treegrid-10000 parent-node expanded">
            <td class="parent"><?php echo _l('1_30_days_past_due'); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
         <?php foreach ($data_report['data']['1_30_days_past_due'] as $val) {
              $row_index += 1;
              $total += $val['amount'];
            ?>
            <tr class="treegrid-<?php echo html_entity_decode($row_index); ?> treegrid-parent-10000 ">
              <td>
              <?php echo _d($val['date']); ?> 
              </td>
              <td>
              <?php echo html_entity_decode($val['type']); ?> 
              </td>
              <td>
              <?php echo html_entity_decode($val['number']); ?> 
              </td>
              <td>
              <?php echo get_company_name($val['vendor']); ?> 
              </td>
              <td>
              <?php echo _d($val['duedate']); ?> 
              </td>
              <td class="total_amount">
              <?php echo app_format_money($val['amount'], $currency->name); ?> 
              </td>
            </tr>
          <?php }
            $row_index += 1;
           ?>
          
           <tr class="treegrid-total-<?php echo html_entity_decode($row_index); ?> treegrid-parent-10000 parent-node expanded tr_total">
            <td class="parent"><?php echo _l('total_for', _l('1_30_days_past_due')); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="total_amount"><?php echo app_format_money($total, $currency->name); ?></td>
          </tr>

          <?php
         $row_index++; 
         $total = 0; 
         ?>
         <tr class="treegrid-10001 parent-node expanded">
            <td class="parent"><?php echo _l('31_60_days_past_due'); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
         <?php foreach ($data_report['data']['31_60_days_past_due'] as $val) {
              $row_index += 1;
              $total += $val['amount'];
            ?>
            <tr class="treegrid-<?php echo html_entity_decode($row_index); ?> treegrid-parent-10001 ">
              <td>
              <?php echo _d($val['date']); ?> 
              </td>
              <td>
              <?php echo html_entity_decode($val['type']); ?> 
              </td>
              <td>
              <?php echo html_entity_decode($val['number']); ?> 
              </td>
              <td>
              <?php echo get_company_name($val['vendor']); ?> 
              </td>
              <td>
              <?php echo _d($val['duedate']); ?> 
              </td>
              <td class="total_amount">
              <?php echo app_format_money($val['amount'], $currency->name); ?> 
              </td>
            </tr>
          <?php }
            $row_index += 1;
           ?>
          
           <tr class="treegrid-total-<?php echo html_entity_decode($row_index); ?> treegrid-parent-10001 parent-node expanded tr_total">
            <td class="parent"><?php echo _l('total_for', _l('31_60_days_past_due')); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="total_amount"><?php echo app_format_money($total, $currency->name); ?></td>
          </tr>
          <?php $row_index += 1; 
           $total = 0; ?>
          <tr class="treegrid-10000 parent-node expanded">
            <td class="parent"><?php echo _l('61_90_days_past_due'); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
         <?php foreach ($data_report['data']['61_90_days_past_due'] as $val) {
              $row_index += 1;
              $total += $val['amount'];
            ?>
            <tr class="treegrid-<?php echo html_entity_decode($row_index); ?> treegrid-parent-10000 ">
              <td>
              <?php echo _d($val['date']); ?> 
              </td>
              <td>
              <?php echo html_entity_decode($val['type']); ?> 
              </td>
              <td>
              <?php echo html_entity_decode($val['number']); ?> 
              </td>
              <td>
              <?php echo get_company_name($val['vendor']); ?> 
              </td>
              <td>
              <?php echo _d($val['duedate']); ?> 
              </td>
              <td class="total_amount">
              <?php echo app_format_money($val['amount'], $currency->name); ?> 
              </td>
            </tr>
          <?php }
            $row_index += 1;
           ?>
          
           <tr class="treegrid-total-<?php echo html_entity_decode($row_index); ?> treegrid-parent-10000 parent-node expanded tr_total">
            <td class="parent"><?php echo _l('total_for', _l('61_90_days_past_due')); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="total_amount"><?php echo app_format_money($total, $currency->name); ?></td>
          </tr>

          <?php
         $row_index++; 
         $total = 0; 
         ?>
         <tr class="treegrid-10001 parent-node expanded">
            <td class="parent"><?php echo _l('91_and_over'); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
         <?php foreach ($data_report['data']['91_and_over'] as $val) {
              $row_index += 1;
              $total += $val['amount'];
            ?>
            <tr class="treegrid-<?php echo html_entity_decode($row_index); ?> treegrid-parent-10001 ">
              <td>
              <?php echo _d($val['date']); ?> 
              </td>
              <td>
              <?php echo html_entity_decode($val['type']); ?> 
              </td>
              <td>
              <?php echo html_entity_decode($val['number']); ?> 
              </td>
              <td>
              <?php echo get_company_name($val['vendor']); ?> 
              </td>
              <td>
              <?php echo _d($val['duedate']); ?> 
              </td>
              <td class="total_amount">
              <?php echo app_format_money($val['amount'], $currency->name); ?> 
              </td>
            </tr>
          <?php }
            $row_index += 1;
           ?>
          
           <tr class="treegrid-total-<?php echo html_entity_decode($row_index); ?> treegrid-parent-10001 parent-node expanded tr_total">
            <td class="parent"><?php echo _l('total_for', _l('91_and_over')); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="total_amount"><?php echo app_format_money($total, $currency->name); ?></td>
          </tr>
      </tbody>
    </table>
  </div>
</div>