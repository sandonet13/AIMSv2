<div class="horizontal-scrollable-tabs">
   <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
   <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
   <div class="horizontal-tabs">
      <ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal" role="tablist">
         <li role="presentation" class="<?php if($tab_2 == 'purchase_order'){echo 'active';}; ?>">
            <a href="<?php echo admin_url('accounting/transaction?group=purchase&tab=purchase_order'); ?>">
              <i class="fa fa-credit-card"></i>&nbsp;<?php echo _l('purchase_order'); ?> <span class="text-danger"><?php echo '('.$count_purchase_order.')'; ?></span>
            </a>
         </li>
         <li role="presentation" class="<?php if($tab_2 == 'purchase_payment'){echo 'active';}; ?>">
            <a href="<?php echo admin_url('accounting/transaction?group=purchase&tab=purchase_payment'); ?>">
              <i class="fa fa-file-text"></i>&nbsp;<?php echo _l('purchase_payment'); ?> <span class="text-danger"><?php echo '('.$count_purchase_payment.')'; ?></span>
            </a>
         </li>
      </ul>
   </div>
    <?php echo form_hidden('currency_id', $currency->id); ?>
  <?php $this->load->view($tab_2,array('bulk_actions'=>true)); ?>
</div>
