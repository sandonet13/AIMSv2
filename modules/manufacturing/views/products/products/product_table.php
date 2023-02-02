<?php

defined('BASEPATH') or exit('No direct script access allowed');
$this->ci->load->model('warehouse/warehouse_model');
$list_product_type = mrp_product_type();

$aColumns = [
	'1',
	db_prefix() . 'items.id',
	'description',
	'commodity_barcode',
	'rate',
	'purchase_price',
	'group_id', //product category
	'product_type', //product type
	'2', // inventory qty 
	'unit_id',
];
$sIndexColumn = 'id';
$sTable = db_prefix() . 'items';

$where = [];

$commodity_ft = $this->ci->input->post('item_filter');
$product_type_ft = $this->ci->input->post('product_type_filter');
$product_category_ft = $this->ci->input->post('product_category_filter');


$tags_ft = $this->ci->input->post('item_filter');

$join= [];


$where[] = 'AND '.db_prefix().'items.active = 1';
$where[] = 'AND ('  .db_prefix().'items.parent_id is null OR  '.db_prefix().'items.parent_id = 0 OR  '.db_prefix().'items.parent_id = "" )  ';


if (isset($commodity_ft)) {
	$where_commodity_ft = '';
	foreach ($commodity_ft as $commodity_id) {
		if ($commodity_id != '') {
			if ($where_commodity_ft == '') {
				$where_commodity_ft .= ' AND ('.db_prefix().'items.id = "' . $commodity_id . '"';
			} else {
				$where_commodity_ft .= ' or '.db_prefix().'items.id = "' . $commodity_id . '"';
			}
		}
	}
	if ($where_commodity_ft != '') {
		$where_commodity_ft .= ')';
		array_push($where, $where_commodity_ft);
	}
}

if (isset($product_type_ft)) {
	$where_product_type_ft = '';
	foreach ($product_type_ft as $product_type) {
		if ($product_type != '') {
			if ($where_product_type_ft == '') {
				$where_product_type_ft .= ' AND ('.db_prefix().'items.product_type = "' . $product_type . '"';
			} else {
				$where_product_type_ft .= ' or '.db_prefix().'items.product_type = "' . $product_type . '"';
			}
		}
	}
	if ($where_product_type_ft != '') {
		$where_product_type_ft .= ')';
		array_push($where, $where_product_type_ft);
	}
}

if (isset($product_category_ft)) {
	$where_product_category_ft = '';
	foreach ($product_category_ft as $product_category) {
		if ($product_category != '') {
			if ($where_product_category_ft == '') {
				$where_product_category_ft .= ' AND ('.db_prefix().'items.group_id = "' . $product_category . '"';
			} else {
				$where_product_category_ft .= ' or '.db_prefix().'items.group_id = "' . $product_category . '"';
			}
		}
	}
	if ($where_product_category_ft != '') {
		$where_product_category_ft .= ')';
		array_push($where, $where_product_category_ft);
	}
}



$custom_fields = get_custom_fields('items', [
	'show_on_table' => 1,
]);


foreach ($custom_fields as $key => $field) {
	$selectAs = (is_cf_date($field) ? 'date_picker_cvalue_' . $key : 'cvalue_' . $key);

	array_push($customFieldsColumns, $selectAs);
	array_push($aColumns, 'ctable_' . $key . '.value as ' . $selectAs);
	array_push($join, 'LEFT JOIN ' . db_prefix() . 'customfieldsvalues as ctable_' . $key . ' ON ' . db_prefix() . 'items.id = ctable_' . $key . '.relid AND ctable_' . $key . '.fieldto="items_pr" AND ctable_' . $key . '.fieldid=' . $field['id']);
}

// Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
	@$this->ci->db->query('SET SQL_BIG_SELECTS=1');
}


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [db_prefix().'items.id']);

$output = $result['output'];
$rResult = $result['rResult'];


foreach ($rResult as $aRow) {
	$row = [];
	for ($i = 0; $i < count($aColumns); $i++) {

		if (strpos($aColumns[$i], 'as') !== false && !isset($aRow[$aColumns[$i]])) {
			$_data = $aRow[strafter($aColumns[$i], 'as ')];
		} else {
			$_data = $aRow[$aColumns[$i]];
		}


		/*get commodity file*/
		$arr_images = $this->ci->manufacturing_model->mrp_get_attachments_file($aRow['id'], 'commodity_item_file');
		if($aColumns[$i] == db_prefix() . 'items.id'){
			if (count($arr_images) > 0) {

				if(file_exists(MANUFACTURING_PRODUCT_UPLOAD . $arr_images[0]['rel_id'] . '/' . $arr_images[0]['file_name'])) {
					$_data = '<img class="images_w_table" src="' . site_url('modules/manufacturing/uploads/products/' . $arr_images[0]['rel_id'] . '/' . $arr_images[0]['file_name']) . '" alt="' . $arr_images[0]['file_name'] . '" >';
				}elseif (file_exists('modules/warehouse/uploads/item_img/' . $arr_images[0]['rel_id'] . '/' . $arr_images[0]['file_name'])) {
					$_data = '<img class="images_w_table" src="' . site_url('modules/warehouse/uploads/item_img/' . $arr_images[0]['rel_id'] . '/' . $arr_images[0]['file_name']) . '" alt="' . $arr_images[0]['file_name'] . '" >';
				} elseif (file_exists('modules/purchase/uploads/item_img/'. $arr_images[0]['rel_id'] . '/' . $arr_images[0]['file_name'])) {
					$_data = '<img class="images_w_table" src="' . site_url('modules/purchase/uploads/item_img/' . $arr_images[0]['rel_id'] . '/' . $arr_images[0]['file_name']) . '" alt="' . $arr_images[0]['file_name'] . '" >';
				}else{
					$_data = '<img class="images_w_table" src="' . site_url('modules/manufacturing/uploads/null_image.jpg') . '" alt="nul_image.jpg">';
				}
			} else {

				$_data = '<img class="images_w_table" src="' . site_url('modules/manufacturing/uploads/null_image.jpg') . '" alt="nul_image.jpg">';
			}
		}

		if ($aColumns[$i] == 'description') {
			$code = '<a href="' . admin_url('manufacturing/view_product_detail/' . $aRow['id']) . '">' . $aRow['description'] . '</a>';
			$code .= '<div class="row-options">';

			$code .= '<a href="' . admin_url('manufacturing/view_product_detail/' . $aRow['id']) . '" >' . _l('view') . '</a>';

			if (has_permission('manufacturing', '', 'edit') || is_admin()) {
				$code .= ' | <a href="' . admin_url('manufacturing/add_edit_product/product/' . $aRow['id']) . '"  >' . _l('edit') . '</a>';
			}
			if (has_permission('manufacturing', '', 'delete') || is_admin()) {
				$code .= ' | <a href="' . admin_url('manufacturing/delete_product/' . $aRow['id'].'/product') . '" class="text-danger _delete">' . _l('delete') . '</a>';
			}

			$code .= '</div>';

			$_data = $code;

		}elseif($aColumns[$i] == '1'){
			$_data = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';
		}elseif ($aColumns[$i] == 'unit_id') {
			if ($aRow['unit_id'] != null) {
				$_data = mrp_get_unit_name($aRow['unit_id']);
			} else {
				$_data = '';
			}
		} elseif ($aColumns[$i] == 'rate') {
			$_data = app_format_money((float) $aRow['rate'], '');
		} elseif ($aColumns[$i] == 'purchase_price') {
			$_data = app_format_money((float) $aRow['purchase_price'], '');

		} elseif ($aColumns[$i] == 'group_id') {
			$_data = get_wh_group_name($aRow['group_id']) != null ? get_wh_group_name($aRow['group_id'])->name : '';

		} elseif ($aColumns[$i] == 'product_type') {

			$product_type_name ='';

			if($aRow['product_type'] !== null){

				foreach ($list_product_type as $value) {
				    if($value['name'] == $aRow['product_type']){
				    	$product_type_name .= $value['label'];
				    }
				}

			}
			$_data = $product_type_name;

		} elseif ($aColumns[$i] == '2') {
			$_data ='';
			$arr_warehouse = get_warehouse_by_commodity($aRow['id']);

			$str = '';
			if(count($arr_warehouse) > 0){
				foreach ($arr_warehouse as $wh_key => $warehouseid) {
					$str = '';
					if ($warehouseid['warehouse_id'] != '' && $warehouseid['warehouse_id'] != '0') {
							//get inventory quantity
						$inventory_quantity = $this->ci->warehouse_model->get_quantity_inventory($warehouseid['warehouse_id'], $aRow['id']);
						$quantity_by_warehouse =0;
						if($inventory_quantity){
							$quantity_by_warehouse = $inventory_quantity->inventory_number;
						}

						$team = get_warehouse_name($warehouseid['warehouse_id']);
						if($team){
							$value = $team != null ? get_object_vars($team)['warehouse_name'] : '';

							$str .= '<span class="label label-tag tag-id-1"><span class="tag">' . $value . ': ( '.$quantity_by_warehouse.' )</span><span class="hide">, </span></span>&nbsp';

							$_data .= $str;
							if($wh_key%3 ==0){
								$_data .='<br/>';
							}
						}

					}
				}

			} else {
				$_data = '';
			}

		} 


		$row[] = $_data;

	}
	$output['aaData'][] = $row;
}

