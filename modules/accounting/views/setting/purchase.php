<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php 

  $acc_pur_order_automatic_conversion = get_option('acc_pur_order_automatic_conversion');
  $acc_pur_order_payment_account = get_option('acc_pur_order_payment_account');
  $acc_pur_order_deposit_to = get_option('acc_pur_order_deposit_to');

  $acc_pur_payment_automatic_conversion = get_option('acc_pur_payment_automatic_conversion');
  $acc_pur_payment_payment_account = get_option('acc_pur_payment_payment_account');
  $acc_pur_payment_deposit_to = get_option('acc_pur_payment_deposit_to');
 ?>





<?php echo form_open(admin_url('accounting/update_purchase_automatic_conversion'),array('id'=>'werehouse-mapping-setup-form')); ?>
<div class="row">
  <div class="col-md-12">
    <h4><?php echo _l('automatic_conversion'); ?></h4>
      <div class="div_content">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6 border-right">
                <h5 class="title mbot5"><?php echo _l('purchase_order') ?></h5>
              </div>
              <div class="col-md-6 mtop5">
                  <div class="onoffswitch">
                      <input type="checkbox" id="acc_pur_order_automatic_conversion" data-perm-id="3" class="onoffswitch-checkbox" <?php if($acc_pur_order_automatic_conversion == '1'){echo 'checked';} ?>  value="1" name="acc_pur_order_automatic_conversion">
                      <label class="onoffswitch-label" for="acc_pur_order_automatic_conversion"></label>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row <?php if($acc_pur_order_automatic_conversion == 0){echo 'hide';} ?>" id="div_pur_order_automatic_conversion">
          <div class="col-md-6">
            <?php echo render_select('acc_pur_order_payment_account',$accounts,array('id','name', 'account_type_name'),'payment_account',$acc_pur_order_payment_account,array(),array(),'','',false); ?>
          </div>
          <div class="col-md-6">
            <?php echo render_select('acc_pur_order_deposit_to',$accounts,array('id','name', 'account_type_name'),'deposit_to',$acc_pur_order_deposit_to,array(),array(),'','',false); ?>
          </div>
        </div>
      </div>
      <div class="div_content">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6 border-right">
                <h5 class="title mbot5"><?php echo _l('payment') ?></h5>
              </div>
              <div class="col-md-6 mtop5">
                  <div class="onoffswitch">
                      <input type="checkbox" id="acc_pur_payment_automatic_conversion" data-perm-id="3" class="onoffswitch-checkbox" <?php if($acc_pur_payment_automatic_conversion == '1'){echo 'checked';} ?>  value="1" name="acc_pur_payment_automatic_conversion">
                      <label class="onoffswitch-label" for="acc_pur_payment_automatic_conversion"></label>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row <?php if($acc_pur_payment_automatic_conversion == 0){echo 'hide';} ?>" id="div_pur_payment_automatic_conversion">
          <div class="col-md-6">
            <?php echo render_select('acc_pur_payment_payment_account',$accounts,array('id','name', 'account_type_name'),'payment_account',$acc_pur_payment_payment_account,array(),array(),'','',false); ?>
          </div>
          <div class="col-md-6">
            <?php echo render_select('acc_pur_payment_deposit_to',$accounts,array('id','name', 'account_type_name'),'deposit_to',$acc_pur_payment_deposit_to,array(),array(),'','',false); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<hr>
<button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
<?php echo form_close(); ?>

