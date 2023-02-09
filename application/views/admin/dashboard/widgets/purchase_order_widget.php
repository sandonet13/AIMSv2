

<div class="widget" id="widget-<?php echo basename(__FILE__,".php"); ?>" data-name="<?php echo _l('Purchase Request'); ?>">
<div class="panel_s user-data">
  <div class="panel-body">
    <div class="widget-dragger"></div>

      <div class="row">
       <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <h4 class="no-margin font-bold"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo _l('Purchase Request'); ?></h4>
            </div>
            <div class="col-md-6">
              <a href="<?php echo admin_url('purchase/purchase_request'); ?>" class="btn btn-info pull-right"><?php echo _l('view_all'); ?></a>
            </div>
          </div>
          <hr />
        </div>
                </div>
                 <?php 
                 $arr_table = [];
                 $arr_table[] = _l('pur_rq_code');
                 $arr_table[] = _l('pur_rq_name');
                 $arr_table[] = _l('requester');
                 $arr_table[] = _l('request_date');
                 $arr_table[] = _l('Purchase Type');
                 $arr_table[] = _l('status');
                  ?>                   
                <?php render_datatable($arr_table,'table_pur_request_order_wg'); ?>                   
      
    </div>
  </div>
   
</div>