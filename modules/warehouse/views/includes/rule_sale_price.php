<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="horizontal-scrollable-tabs preview-tabs-top">
  <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
  <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
  <div class="horizontal-tabs">
   <ul class="nav nav-tabs nav-tabs-horizontal mbot15" role="tablist">
    <li role="presentation" class="active">
     <a href="#tab_items" aria-controls="tab_items" role="tab" data-toggle="tab">
       <?php echo _l('items'); ?>
     </a>
   </li>  
   <li role="presentation">
     <a href="#tab_receipt_delivery"  aria-controls="tab_receipt_delivery" role="tab" data-toggle="tab">
       <?php echo _l('wh_receipt_delivery_voucher'); ?>
     </a>
   </li>
   <li role="presentation">
     <a href="#tab_pdf"  aria-controls="tab_pdf" role="tab" data-toggle="tab">
       <?php echo _l('wh_pdf'); ?>
     </a>
   </li>

   </ul>
 </div>
</div>
<div class="tab-content">
  <div role="tabpanel" class="tab-pane ptop10 active" id="tab_items">
    <div class="row">
      <div class="col-md-12">
        <h5 class="no-margin font-bold h5-color"><?php echo _l('_profit_rate_p') ?></h5>
        <hr class="hr-color">
      </div>
    </div>
    <div class="form-group">
      <div onchange="setting_rule_sale_price(this); return false" class="form-group" app-field-wrapper="warehouse_selling_price_rule_profif_ratio">
        <input type="number" min="0" max="100" id="warehouse_selling_price_rule_profif_ratio" name="warehouse_selling_price_rule_profif_ratio" class="form-control" value="<?php echo get_warehouse_option('warehouse_selling_price_rule_profif_ratio'); ?>">
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h5 class="no-margin font-bold h5-color"><?php echo _l('rate') ?></h5>
        <hr class="hr-color">
      </div>
    </div>

      <div class="form-group">
        <div class="radio radio-primary radio-inline" >
          <input onchange="setting_profit_rate(this); return false" type="radio" id="y_opt_1_" name="profit_rate_by_purchase_price_sale" value="0" <?php if(get_warehouse_option('profit_rate_by_purchase_price_sale') == '0'){ echo "checked" ;}; ?>>
          <label for="y_opt_1_"><?php echo _l('warehouse_profit_rate_sale_price'); ?></label>

          <a href="#" class="pull-right display-block input_method"><i class="fa fa-question-circle i_tooltip" data-toggle="tooltip" title="" data-original-title="<?php echo _l('profit_rate_sale_price'); ?>"></i></a>
        </div>
      </div>

      <div class="form-group">
        <div class="radio radio-primary radio-inline" >
          <input onchange="setting_profit_rate(this); return false" type="radio" id="y_opt_2_" name="profit_rate_by_purchase_price_sale" value="1" <?php if(get_warehouse_option('profit_rate_by_purchase_price_sale') == '1'){ echo "checked" ;}; ?>>
          <label for="y_opt_2_"><?php echo _l('warehouse_profit_rate_purchase_price'); ?></label>

          <a href="#" class="pull-right display-block input_method"><i class="fa fa-question-circle i_tooltip" data-toggle="tooltip" title="" data-original-title="<?php echo _l('profit_rate_purchase_price'); ?>"></i></a>
        </div>
      </div>

    <div class="row">
        <div class="col-md-5">
          <label for="y_opt_2_"><?php echo _l('the_fractional_part'); ?></label>
        </div>
        <div class="col-md-2">
          <input onchange="setting_rules_for_rounding_prices(this); return false" type="number" min="0" max="100" step="1" id="warehouse_the_fractional_part" name="warehouse_the_fractional_part" class="form-control" value="<?php echo get_warehouse_option('warehouse_the_fractional_part'); ?>">
        </div>
    </div>

    <br/>
    <div class="row">
        <div class="col-md-5">
          <label for="y_opt_2_"><?php echo _l('integer_part'); ?></label>
        </div>
        <div class="col-md-2">
          <input onchange="setting_rules_for_rounding_prices(this); return false" type="number" min="0" max="100" step="1" id="warehouse_integer_part" name="warehouse_integer_part" class="form-control" value="<?php echo get_warehouse_option('warehouse_integer_part'); ?>">
        </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h5 class="no-margin font-bold h5-color" ><?php echo _l('barcode_setting')?></h5>
        <hr class="hr-color" >
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <div class="checkbox checkbox-primary">
            <input onchange="auto_create_change_setting(this); return false" type="checkbox" id="barcode_with_sku_code" name="purchase_setting[barcode_with_sku_code]" <?php if(get_warehouse_option('barcode_with_sku_code') == 1 ){ echo 'checked';} ?> value="barcode_with_sku_code">
            <label for="barcode_with_sku_code"><?php echo _l('barcode_equal_sku_code'); ?>
            <a href="#" class="pull-right display-block input_method"><i class="fa fa-question-circle i_tooltip" data-toggle="tooltip" title="" data-original-title="<?php echo _l('create_barcode_equal_sku_code_tooltip'); ?>"></i></a>
          </label>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <div class="checkbox checkbox-primary">
          <input onchange="auto_create_change_setting(this); return false" type="checkbox" id="display_product_name_when_print_barcode" name="purchase_setting[display_product_name_when_print_barcode]" <?php if(get_warehouse_option('display_product_name_when_print_barcode') == 1 ){ echo 'checked';} ?> value="display_product_name_when_print_barcode">
          <label for="display_product_name_when_print_barcode"><?php echo _l('display_product_name_when_print_barcode'); ?>
          <a href="#" class="pull-right display-block input_method"><i class="fa fa-question-circle i_tooltip" data-toggle="tooltip" title="" data-original-title="<?php echo _l('display_only_the_first_50'); ?>"></i></a>
        </label>
      </div>
    </div>
  </div>
</div>

<?php if (is_admin()) { ?>
  <div class="row">
    <div class="col-md-12">
      <h5 class="no-margin font-bold h5-color" ><?php echo _l('button_update_do_not_update_inventory_numbers')?></h5>
      <hr class="hr-color" >
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <?php echo form_open_multipart(admin_url('warehouse/update_unchecked_inventory_numbers'), array('id'=>'update_unchecked_inventory_numbers')); ?>
      <div class="_buttons">
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-info intext-btn" onclick="update_unchecked_inventory_numbers(this); return false;" ><?php echo _l('update'); ?></button>
            <a href="#" class="input_method"><i class="fa fa-question-circle i_tooltip" data-toggle="tooltip" title="" data-original-title="<?php echo _l('update_unchecked_inventory_numbers_title'); ?>"></i></a>
          </div>
        </div>

      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
<?php } ?>

    
  </div>
  <div role="tabpanel" class="tab-pane ptop10 " id="tab_receipt_delivery">
    <div class="row">
      <div class="col-md-12">
        <h5 class="no-margin font-bold h5-color" ><?php echo _l('wh_general')?></h5>
        <hr class="hr-color" >
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <div class="checkbox checkbox-primary">
            <input onchange="auto_create_change_setting(this); return false" type="checkbox" id="revert_goods_receipt_goods_delivery" name="purchase_setting[revert_goods_receipt_goods_delivery]" <?php if(get_warehouse_option('revert_goods_receipt_goods_delivery') == 1 ){ echo 'checked';} ?> value="revert_goods_receipt_goods_delivery">
            <label for="revert_goods_receipt_goods_delivery"><?php echo _l('delete_goods_receipt_goods_delivery'); ?>
            <a href="#" class="pull-right display-block input_method"><i class="fa fa-question-circle i_tooltip" data-toggle="tooltip" title="" data-original-title="<?php echo _l('delete_goods_receipt_goods_delivery_tooltip'); ?>"></i></a>
          </label>
        </div>
      </div>
    </div>
  </div>

    <div class="row">
      <div class="col-md-12">
        <h5 class="no-margin font-bold h5-color" ><?php echo _l('export_method')?></h5>
        <hr class="hr-color" >
      </div>
    </div>

    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
          <select name="method_fifo" id="method_fifo" class="selectpicker"  data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('Alert'); ?>">
            <option value="method_fifo"><?php echo _l('method_fifo') ; ?></option>
          </select>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h5 class="no-margin font-bold h5-color" ><?php echo _l('goods_receipt')?></h5>
        <hr class="hr-color" >
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="vendor"></label>
          <div class="checkbox checkbox-primary">
            <input onchange="auto_create_change_setting(this); return false" type="checkbox" id="auto_create_goods_received" name="auto_create_goods_received" <?php if(get_warehouse_option('auto_create_goods_received') == 1 ){ echo 'checked';} ?> value="auto_create_goods_received">
            <label for="auto_create_goods_received"><?php echo _l('create_goods_received_note'); ?>
            <a href="#" class="pull-right display-block input_method"><i class="fa fa-question-circle i_tooltip" data-toggle="tooltip" title="" data-original-title="<?php echo _l('create_goods_received_note_tooltip'); ?>"></i></a>
          </label>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class=" form-group">
       <label for="goods_receipt_warehouse"><?php echo _l('goods_receipt_warehouse'); ?></label>
       <select onchange="goods_receipt_warehouse_change(this); return false" name="goods_receipt_warehouse" class="selectpicker" id="goods_receipt_warehouse" data-width="100%" data-none-selected-text="<?php echo _l('warehouse_name'); ?>"> 
        <option value=""></option>
        <?php foreach($warehouses as $wh){ ?>
          <option value="<?php echo html_entity_decode($wh['warehouse_id']); ?>" <?php if(get_warehouse_option('goods_receipt_warehouse') == $wh['warehouse_id']){ echo 'selected';} ?> ><?php echo html_entity_decode($wh['warehouse_code'].'_'.$wh['warehouse_name']); ?></option>
        <?php } ?>
      </select>
    </div>  
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <div class="checkbox checkbox-primary">
        <input onchange="auto_create_change_setting(this); return false" type="checkbox" id="goods_receipt_required_po" name="purchase_setting[goods_receipt_required_po]" <?php if(get_warehouse_option('goods_receipt_required_po') == 1 ){ echo 'checked';} ?> value="goods_receipt_required_po">
        <label for="goods_receipt_required_po"><?php echo _l('goods_receipt_required_po'); ?></label>
      </div>
    </div>
  </div>
</div>

    <div class="row">
      <div class="col-md-12">
        <h5 class="no-margin font-bold h5-color" ><?php echo _l('stock_export')?></h5>
        <hr class="hr-color" >
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <div class="checkbox checkbox-primary">
            <input onchange="auto_create_change_setting(this); return false" type="checkbox" id="auto_create_goods_delivery" name="purchase_setting[auto_create_goods_delivery]" <?php if(get_warehouse_option('auto_create_goods_delivery') == 1 ){ echo 'checked';} ?> value="auto_create_goods_delivery">
            <label for="auto_create_goods_delivery"><?php echo _l('create_goods_delivery_note'); ?>
            <a href="#" class="pull-right display-block input_method"><i class="fa fa-question-circle i_tooltip" data-toggle="tooltip" title="" data-original-title="<?php echo _l('create_goods_delivery_note_tooltip'); ?>"></i></a>
          </label>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <div class="checkbox checkbox-primary">
          <input onchange="auto_create_change_setting(this); return false" type="checkbox" id="cancelled_invoice_reverse_inventory_delivery_voucher" name="purchase_setting[cancelled_invoice_reverse_inventory_delivery_voucher]" <?php if(get_warehouse_option('cancelled_invoice_reverse_inventory_delivery_voucher') == 1 ){ echo 'checked';} ?> value="cancelled_invoice_reverse_inventory_delivery_voucher">
          <label for="cancelled_invoice_reverse_inventory_delivery_voucher"><?php echo _l('cancelled_invoice_reverse_inventory_delivery_voucher_note'); ?>
          <a href="#" class="pull-right display-block input_method"><i class="fa fa-question-circle i_tooltip" data-toggle="tooltip" title="" data-original-title=""></i></a>
        </label>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <div class="checkbox checkbox-primary">
        <input onchange="auto_create_change_setting(this); return false" type="checkbox" id="uncancelled_invoice_create_inventory_delivery_voucher" name="purchase_setting[uncancelled_invoice_create_inventory_delivery_voucher]" <?php if(get_warehouse_option('uncancelled_invoice_create_inventory_delivery_voucher') == 1 ){ echo 'checked';} ?> value="uncancelled_invoice_create_inventory_delivery_voucher">
        <label for="uncancelled_invoice_create_inventory_delivery_voucher"><?php echo _l('uncancelled_invoice_create_inventory_delivery_voucher_note'); ?>
        <a href="#" class="pull-right display-block input_method"><i class="fa fa-question-circle i_tooltip" data-toggle="tooltip" title="" data-original-title=""></i></a>
      </label>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <div class="checkbox checkbox-primary">
        <input onchange="auto_create_change_setting(this); return false" type="checkbox" id="goods_delivery_required_po" name="purchase_setting[goods_delivery_required_po]" <?php if(get_warehouse_option('goods_delivery_required_po') == 1 ){ echo 'checked';} ?> value="goods_delivery_required_po">
        <label for="goods_delivery_required_po"><?php echo _l('goods_delivery_required_po'); ?></label>
      </div>
    </div>
  </div>
</div>


  </div>
  <div role="tabpanel" class="tab-pane ptop10 " id="tab_pdf">
    <div class="row">
      <div class="col-md-12">
        <h5 class="no-margin font-bold h5-color" ><?php echo _l('wh_general')?></h5>
        <hr class="hr-color" >
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <div class="checkbox checkbox-primary">
            <input onchange="auto_create_change_setting(this); return false" type="checkbox" id="goods_delivery_pdf_display_warehouse_lotnumber_bottom_infor" name="purchase_setting[goods_delivery_pdf_display_warehouse_lotnumber_bottom_infor]" <?php if(get_warehouse_option('goods_delivery_pdf_display_warehouse_lotnumber_bottom_infor') == 1 ){ echo 'checked';} ?> value="goods_delivery_pdf_display_warehouse_lotnumber_bottom_infor">
            <label for="goods_delivery_pdf_display_warehouse_lotnumber_bottom_infor"><?php echo _l('goods_delivery_pdf_display_warehouse_lotnumber_bottom_infor'); ?>
          </label>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <div class="checkbox checkbox-primary">
          <input onchange="show_item_cf_on_pdf(this); return false" type="checkbox" id="show_item_cf_on_pdf" name="purchase_setting[show_item_cf_on_pdf]" <?php if(get_option('show_item_cf_on_pdf') == 1 ){ echo 'checked';} ?> value="show_item_cf_on_pdf">
          <label for="show_item_cf_on_pdf"><?php echo _l('show_item_cf_on_pdf'); ?>
        </label>
      </div>
    </div>
  </div>
</div>

    <div class="row">
      <div class="col-md-12">
        <h5 class="no-margin font-bold h5-color" ><?php echo _l('stock_export')?></h5>
        <hr class="hr-color" >
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <div class="checkbox checkbox-primary">
            <input onchange="auto_create_change_setting(this); return false" type="checkbox" id="goods_delivery_pdf_display" name="purchase_setting[goods_delivery_pdf_display]" <?php if(get_warehouse_option('goods_delivery_pdf_display') == 1 ){ echo 'checked';} ?> value="goods_delivery_pdf_display">
            <label for="goods_delivery_pdf_display"><?php echo _l('goods_delivery_pdf_display'); ?>
          </label>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <div class="checkbox checkbox-primary">
          <input onchange="auto_create_change_setting(this); return false" type="checkbox" id="goods_delivery_pdf_display_outstanding" name="purchase_setting[goods_delivery_pdf_display_outstanding]" <?php if(get_warehouse_option('goods_delivery_pdf_display_outstanding') == 1 ){ echo 'checked';} ?> value="goods_delivery_pdf_display_outstanding">
          <label for="goods_delivery_pdf_display_outstanding"><?php echo _l('goods_delivery_pdf_display_outstanding'); ?>
        </label>
      </div>
    </div>
  </div>
</div>


  </div>
  
</div>


<div class="clearfix"></div>

<?php require 'modules/warehouse/assets/js/rule_sale_price_js.php';?>
</body>
</html>


