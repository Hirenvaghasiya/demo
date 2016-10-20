<?php
if (!defined('ABSPATH')) {
    exit;
}?>
<?php
$cat_args        = array(
    'hide_empty' => true,
    'order' => 'ASC'
);
$categories      = get_terms('product_cat', $cat_args);
$attributes      = wc_get_attribute_taxonomies();
$attribute_value = get_terms('pa_size', $cat_args);
?>
    <div class="eh-banner wrap postbox" style='padding:0px 20px;'>
        <p class="main">
        <ul>
            <li style='color:red;'><strong>Your Business is precious. Go Premium!</li></strong>
            <li><strong>- Support both Simple and Variable Products.</strong></li>
            <li><strong>- Premium Support:</strong> Faster and time bound response for support requests.</li>
		</ul>
        </p>
        <p><a href="http://www.xadapter.com/product/bulk-edit-products-prices-attributes-for-woocommerce" target="_blank" class="button button-primary">Upgrade to Premium Version</a> <a href="http://bulkeditproductsdemo.extensionhawk.com/wp-admin/admin.php?page=eh-bulk-edit-product-attr" target="_blank" class="button">Live Demo</a></p>
    </div>
	<style>
	.eh-banner img{
		float: left;
		margin-left: 0px !important;
		padding: 15px 0
	}
	</style>
        <div class="loader"></div>
        <div class='wrap postbox' style='padding:0px 20px;'>
        <h2>
            <?php _e('Product Filters', 'eh_bulk_edit'); ?>
        </h2>
        <hr>
        <table class='eh-content-table' id='data_table'>
            <tr>
                <td class='eh-content-table-left'>
                    <?php _e('Product Types', 'eh_bulk_edit'); ?>
                </td>
                <td class='eh-content-table-middle'>
                    <span class='woocommerce-help-tip tooltip' data-tooltip=' <?php _e('Select the product type in which filter has to be applied', 'eh_bulk_edit');?> '></span>
                </td>
                <td class='eh-content-table-input-td'>
                    <select id='product_type'>
                        <option value='simple'><?php _e('Simple', 'eh_bulk_edit'); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class='eh-content-table-left'>
                    <?php _e('Product categories', 'eh_bulk_edit'); ?>
                </td>
                <td class='eh-content-table-middle'>
                    <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Select the categories in which filter has to be applied', 'eh_bulk_edit'); ?>'></span>
                </td>
                <td>
                    <span class='select-eh'><select data-placeholder='<?php _e('Select Product Categories', 'eh_bulk_edit'); ?>' id='category_select' multiple class='category-chosen' >
                    <?php
                        foreach ($categories as $key => $value) {
                            echo "<option value='" . $value->slug . "'>" . $value->name . "</option>";
                        }
                    ?>
                    </select></span>
                </td>
            </tr>
            <tr id='attribute_types'>
                <td class='eh-content-table-left'>
                    <?php _e('Product Attributes', 'eh_bulk_edit'); ?>
                </td>
                <td class='eh-content-table-middle'>
                    <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Check the attributes in which filter has to be applied', 'eh_bulk_edit'); ?>'></span>
                </td>
                <td>
                    <?php
                        foreach ($attributes as $key => $value) {
                            echo "<span id='attrib_name' class='checkbox-eh'><input type='checkbox' name='attrib_name' value='" . $value->attribute_name . "' id='" . $value->attribute_name . "'>" . $value->attribute_label . "</span>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class='eh-content-table-left'>
                    <?php _e('Product Regular Price', 'eh_bulk_edit'); ?>
                </td>
                <td class='eh-content-table-middle'>
                    <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Select the regular price range in which filter has to be applied. Once selected provide desired price', 'eh_bulk_edit'); ?>'></span>
                </td>
                <td class='eh-content-table-input-td'>
                    <select id='sale_price_range_select'>
                        <option value='all'><?php _e('All', 'eh_bulk_edit'); ?></option>
                        <option value='>'>>=</option>
                        <option value='<'><=</option>
                        <option value='='>==</option>
                        <option value='|'>|| <?php _e('Between', 'eh_bulk_edit'); ?></option>
                    </select>
                    <span id='sale_price_range_text'></span>
                </td>
            </tr>
            <tr>
                <td class='eh-content-table-left'>
                </td>
                <td>
                </td>
                <td class='eh-content-table-input-td'>
                    <button id='filter_products_button' value='filter_products' style='width: 32%;' class='button button-primary button-large'><?php _e('Get Filtered Products', 'eh_bulk_edit'); ?></button>
                    <button id='all_products_button' value='all_products' style='width: 32%;' class='button button-primary button-large'><?php _e('Get All Products', 'eh_bulk_edit'); ?></button>
                    <button id='clear_filter_button' value='clear_products' style='width: 32%;' class='button button-primary button-large'><?php _e('Reset Filter', 'eh_bulk_edit'); ?></button>
                </td>
        </table>
    </div>
<?php
include_once EH_BEP_TEMPLATE_PATH . "/template-frontend-tables.php";
?>
