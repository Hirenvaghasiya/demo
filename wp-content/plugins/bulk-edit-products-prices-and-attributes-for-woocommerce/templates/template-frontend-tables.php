<?php
if (!defined('ABSPATH')) {
    exit;
}?>
<div class='wrap' id='wrap_table' style="position:relative;display: none;">
<?php
eh_bep_list_table();
?>
</div>
<?php
function eh_bep_list_table()
{
?>
<?php
    session_start();
    $_SESSION['product_ids']=eh_bep_get_first_products();
    $obj = new Eh_DataTables();
    $obj->input();
    $obj->prepare_items();
    $obj->search_box('search', 'search_id');
?>
    <button id='process_edit' value='edit_products' class='button button-primary button-large'><?php _e('Process Edit', 'eh_bulk_edit'); ?></button>
    <form id="movies-filter" method="get">
            <input type="hidden" name="action" value="all" />
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />
            <?php $obj->display(); ?>   
    </form>
    <?php
}
add_action('admin_footer', 'eh_bep_update_tab');
function eh_bep_update_tab()
{
    $page = (isset($_GET['page'])) ? esc_attr($_GET['page']) : false;
    if ('eh-bulk-edit-product-attr' != $page)
        return;
    global $woocommerce;
?>
		<div class="popup" data-popup="popup-1" id='main_edit_disp'>
			<div class="popup-inner" >
				<div class="loader-update"></div>
				<div id="tabs" class="tabs">
					<nav>
						<ul>
							<li id='general_li' class='tab-current'><a class="tab-a"><span><?php _e('General', 'eh_bulk_edit'); ?></span></a></li>
							<li id='price_li'><a class="tab-a"><span><?php _e('Price', 'eh_bulk_edit'); ?></span></a></li>
							<li id='stock_li'><a class="tab-a"><span><?php _e('Stock', 'eh_bulk_edit'); ?></span></a></li>
							<li id='properties_li'><a class="tab-a"><span><?php _e('Properties', 'eh_bulk_edit'); ?></span></a></li>
							<?php
                  if (in_array('pricing-discounts-by-user-role-woocommerce/pricing-discounts-by-user-role-woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
              ?>
							<li id='role_based_li'><a class="tab-a"><span><?php _e('Role Based', 'eh_bulk_edit'); ?></span></a></li>
							<?php
                  }
              ?>
						</ul>
					</nav>
					<div class="content">
						<section id="general_sec" class='content-current'>
							<span class='update-title'><center><?php _e('General Update', 'eh_bulk_edit'); ?></center></span>
							<hr>
							<div class='tab-div'>
							<table class='eh-edit-tab-table' id='update_general_table'>
									<tr>
											<td class='eh-edit-tab-table-left'>
													<?php _e('Title', 'eh_bulk_edit'); ?>
											</td>
											<td class='eh-edit-tab-table-middle'>
			                    <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Set new or update title', 'eh_bulk_edit'); ?>'></span>
			                </td>
											<td class='eh-edit-tab-table-input-td'>
			                    <select id='title_action'>
			                        <option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
			                        <option value='set_new'><?php _e('Set New', 'eh_bulk_edit'); ?></option>
			                        <option value='append'><?php _e('Append', 'eh_bulk_edit'); ?></option>
			                        <option value='prepand'><?php _e('Prepand', 'eh_bulk_edit'); ?></option>
			                        <option value='replace'><?php _e('Replace', 'eh_bulk_edit'); ?></option>
			                    </select>
			                    <span id='title_text'></span>
			                </td>
									</tr>
									<tr>
											<td class='eh-edit-tab-table-left'>
													<?php _e('SKU', 'eh_bulk_edit'); ?>
											</td>
											<td class='eh-edit-tab-table-middle'>
			                    <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Set new or update SKU.', 'eh_bulk_edit'); ?>'></span>
			                </td>
											<td class='eh-edit-tab-table-input-td'>
			                    <select id='sku_action'>
															<option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
															<option value='set_new'><?php _e('Set New', 'eh_bulk_edit'); ?></option>
															<option value='append'><?php _e('Append', 'eh_bulk_edit'); ?></option>
															<option value='prepand'><?php _e('Prepand', 'eh_bulk_edit'); ?></option>
															<option value='replace'><?php _e('Replace', 'eh_bulk_edit'); ?></option>
			                    </select>
			                    <span id='sku_text' style="position:absolute;"></span>
			                </td>
									</tr>
									<tr>
											<td class='eh-edit-tab-table-left'>
													<?php _e('Product Visiblity', 'eh_bulk_edit'); ?>
											</td>
											<td class='eh-edit-tab-table-middle'>
			                    <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Select product visibilty on Catalog/Search page', 'eh_bulk_edit'); ?>'></span>
			                </td>
											<td class='eh-edit-tab-table-input-td'>
												<select id='catalog_action'>
														<option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
														<option value='visible'><?php _e('Catalog/Search', 'eh_bulk_edit'); ?></option>
														<option value='catalog'><?php _e('Catalog', 'eh_bulk_edit'); ?></option>
														<option value='search'><?php _e('Search', 'eh_bulk_edit'); ?></option>
														<option value='hidden'><?php _e('Hidden', 'eh_bulk_edit'); ?></option>
												</select>
											</td>
									</tr>
									<tr>
											<td class='eh-edit-tab-table-left'>
													<?php _e('Shipping class', 'eh_bulk_edit'); ?>
											</td>
											<td class='eh-edit-tab-table-middle'>
			                    <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Set shipping class for filterd products. If the shipping class exists it will be replaced', 'eh_bulk_edit'); ?>'></span>
			                </td>
											<td class='eh-edit-tab-table-input-td'>
												<select id='shipping_class_action'>
														<option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
														<?php
                                $ship = $woocommerce->shipping->get_shipping_classes();
                                foreach ($ship as $key => $value) {
                                    echo "<option value='" . $value->term_id . "'>" . $value->name . "</option>";
                                }
                            ?>
												</select>
												<span id='shipping_class_check_text'>
											</td>
									</tr>
							</table>
						</div>
							<hr>
							<div style="margin:2%;">
								<button id='next_general_button' value='next_products_general' style='float: right; margin-left: 10px;' class='button button-primary button-large'><span class="next-text"><?php _e('Next', 'eh_bulk_edit'); ?></span><span class="next"></span></button>
								<center><button id='reset_general_button' value='reset_products_general' class='button button-primary button-large'><?php _e('Reset General', 'eh_bulk_edit'); ?></button></center>
							</div>
						</section>
						<section id="price_sec">
							<span class='update-title'><center><?php _e('Price Update', 'eh_bulk_edit'); ?></center></span>
							<hr>
							<div class='tab-div'>
								<table class='eh-edit-tab-table' id='Update_price_table'>
									<tr>
											<td class='eh-edit-tab-table-left'>
													<?php _e('Sale Price', 'eh_bulk_edit'); ?>
											</td>
											<td class='eh-edit-tab-table-middle'>
			                    <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Select the desired option to adjust sale price', 'eh_bulk_edit'); ?>'></span>
			                </td>
											<td class='eh-edit-tab-table-input-td'>
			                    <select id='sale_price_action'>
			                        <option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
			                        <option value='up_percentage'><?php _e('Increase by Percentage ( + %)', 'eh_bulk_edit'); ?></option>
			                        <option value='down_percentage'><?php _e('Decrease by Percentage ( - %)', 'eh_bulk_edit'); ?></option>
			                        <option value='up_price'><?php _e('Increase by Price ( + $)', 'eh_bulk_edit'); ?></option>
			                        <option value='down_price'><?php _e('Decrease by Price ( - $)', 'eh_bulk_edit');?></option>
			                    </select>
			                    <span id='sale_price_text'></span>
			                </td>
									</tr>
									<tr>
											<td class='eh-edit-tab-table-left'>
													<?php _e('Regular Price', 'eh_bulk_edit'); ?>
											</td>
											<td class='eh-edit-tab-table-middle'>
			                    <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Select the desired option to adjust Regular price', 'eh_bulk_edit'); ?>'></span>
			                </td>
											<td class='eh-edit-tab-table-input-td'>
													<select id='regular_price_action'>
															<option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
															<option value='up_percentage'><?php _e('Increase by Percentage ( + %)', 'eh_bulk_edit'); ?></option>
															<option value='down_percentage'><?php _e('Decrease by Percentage ( - %)', 'eh_bulk_edit'); ?></option>
															<option value='up_price'><?php _e('Increase by Price ( + $)', 'eh_bulk_edit'); ?></option>
															<option value='down_price'><?php _e('Decrease by Price ( - $)', 'eh_bulk_edit'); ?></option>
													</select>
													<span id='regular_price_text'></span>
			                </td>
									</tr>
							</table>
							</div>
							<hr>
							<div style="margin:2%;">
								<button id='back_price_button' value='back_products_price' style='float: left; margin-left: 10px;' class='button button-primary button-large'><span class="previous"></span><span class="previous-text"><?php _e('Back', 'eh_bulk_edit'); ?></span></button>
								<button id='next_price_button' value='next_products_price' style='float: right; margin-left: 10px;' class='button button-primary button-large'><span class="next-text"><?php _e('Next', 'eh_bulk_edit'); ?></span><span class="next"></span></button>
								<center><button id='reset_price_button' value='reset_products_price' class='button button-primary button-large'><?php _e('Reset Price', 'eh_bulk_edit'); ?></button></center>
							</div>
						</section>
						<section id="stock_sec">
							<span class='update-title'><center><?php _e('Stock Update', 'eh_bulk_edit'); ?></center></span>
							<hr>
							<div class='tab-div'>
							<table class='eh-edit-tab-table' id='update_stock_table'>
									<tr>
											<td class='eh-edit-tab-table-left'>
													<?php _e('Manage Stock ?', 'eh_bulk_edit'); ?>
											</td>
											<td class='eh-edit-tab-table-middle'>
													<span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Enable or Disable manage stock for products', 'eh_bulk_edit'); ?>'></span>
											</td>
											<td class='eh-edit-tab-table-input-td'>
													<select id='manage_stock_action'>
															<option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
															<option value='yes'><?php _e('Enable', 'eh_bulk_edit'); ?></option>
															<option value='no'><?php _e('Disable', 'eh_bulk_edit'); ?></option>
													</select>
													<span id='manage_stock_check_text'>
													</span>
											</td>
									</tr>
									<tr>
											<td class='eh-edit-tab-table-left'>
													<?php _e('Stock Quantity', 'eh_bulk_edit'); ?>
											</td>
											<td class='eh-edit-tab-table-middle'>
													<span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Update stock quantity', 'eh_bulk_edit'); ?>'></span>
											</td>
											<td class='eh-edit-tab-table-input-td'>
													<select id='stock_quantity_action'>
															<option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
															<option value='add'><?php _e('Add', 'eh_bulk_edit'); ?></option>
															<option value='sub'><?php _e('Subtract', 'eh_bulk_edit'); ?></option>
															<option value='replace'><?php _e('Replace', 'eh_bulk_edit'); ?></option>
													</select>
													<span id='stock_quantity_text'></span>
											</td>
									</tr>
									<tr>
											<td class='eh-edit-tab-table-left'>
													<?php _e('Allow Backorders ?', 'eh_bulk_edit'); ?>
											</td>
											<td class='eh-edit-tab-table-middle'>
													<span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Select the required backorder option', 'eh_bulk_edit'); ?>'></span>
											</td>
											<td class='eh-edit-tab-table-input-td'>
												<select id='allow_backorder_action'>
														<option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
														<option value='no'><?php _e('Do not allow', 'eh_bulk_edit'); ?></option>
														<option value='notify'><?php _e('Allow, but notify customer', 'eh_bulk_edit'); ?></option>
														<option value='yes'><?php _e('Allow', 'eh_bulk_edit'); ?></option>
												</select>
												<span id='backorder_text'></span>
											</td>
									</tr>
									<tr>
											<td class='eh-edit-tab-table-left'>
													<?php _e('Stock Status', 'eh_bulk_edit'); ?>
											</td>
											<td class='eh-edit-tab-table-middle'>
													<span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Update the stock status', 'eh_bulk_edit'); ?>'></span>
											</td>
											<td class='eh-edit-tab-table-input-td'>
												<select id='stock_status_action'>
														<option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
														<option value='instock'><?php _e('In Stock', 'eh_bulk_edit'); ?></option>
														<option value='outofstock'><?php _e('Out of Stock', 'eh_bulk_edit'); ?></option>
												</select>
											</td>
									</tr>
							</table>
						</div>
							<hr>
							<div style="margin:2%;">
								<button id='back_stock_button' value='back_products_stock' style='float: left; margin-left: 10px;' class='button button-primary button-large'><span class="previous"></span><span class="previous-text"><?php _e('Back', 'eh_bulk_edit'); ?></span></button>
								<button id='next_stock_button' value='next_products_stock' style='float: right; margin-left: 10px;' class='button button-primary button-large'><span class="next-text"><?php _e('Next', 'eh_bulk_edit'); ?></span><span class="next"></span></button>
								<center><button id='reset_stock_button' value='reset_products_stock' class='button button-primary button-large'><?php _e('Reset Stock', 'eh_bulk_edit'); ?></button></center>
							</div>
						</section>
						<section id="properties_sec">
							<span class='update-title'><center><?php _e('Properties Update', 'eh_bulk_edit'); ?></center></span>
							<hr>
							<div class='tab-div'>
								<table class='eh-edit-tab-table ' id='update_properties_table'>
									<tr>
											<td class='eh-edit-tab-table-left'>
													<?php _e('Length', 'eh_bulk_edit'); ?>
													<span style="float:right;"><?php echo strtolower(get_option('woocommerce_dimension_unit')); ?></span>
											</td>
											<td class='eh-edit-tab-table-middle'>
													<span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Update the length', 'eh_bulk_edit'); ?>'></span>
											</td>
											<td class='eh-edit-tab-table-input-td'>
													<select id='length_action'>
															<option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
															<option value='add'><?php _e('Add', 'eh_bulk_edit'); ?></option>
															<option value='sub'><?php _e('Subtract', 'eh_bulk_edit'); ?></option>
															<option value='replace'><?php _e('Replace', 'eh_bulk_edit'); ?></option>
													</select>
													<span id='length_text'></span>
											</td>
									</tr>
										<tr>
												<td class='eh-edit-tab-table-left'>
														<?php _e('Width', 'eh_bulk_edit'); ?>
														<span style="float:right;"><?php echo strtolower(get_option('woocommerce_dimension_unit')); ?></span>
												</td>
												<td class='eh-edit-tab-table-middle'>
														<span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Update the width', 'eh_bulk_edit'); ?>'></span>
												</td>
												<td class='eh-edit-tab-table-input-td'>
														<select id='width_action'>
																<option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
																<option value='add'><?php _e('Add', 'eh_bulk_edit'); ?></option>
																<option value='sub'><?php _e('Subtract', 'eh_bulk_edit'); ?></option>
																<option value='replace'><?php _e('Replace', 'eh_bulk_edit'); ?></option>
														</select>
														<span id='width_text'></span>
												</td>
										</tr>
										<tr>
												<td class='eh-edit-tab-table-left'>
														<?php _e('Height', 'eh_bulk_edit'); ?>
														<span style="float:right;"><?php echo strtolower(get_option('woocommerce_dimension_unit')); ?></span>
												<td class='eh-edit-tab-table-middle'>
														<span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Update the height', 'eh_bulk_edit'); ?>'></span>
												</td>
												<td class='eh-edit-tab-table-input-td'>
														<select id='height_action'>
																<option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
																<option value='add'><?php _e('Add', 'eh_bulk_edit'); ?></option>
																<option value='sub'><?php _e('Subtract', 'eh_bulk_edit'); ?></option>
																<option value='replace'><?php _e('Replace', 'eh_bulk_edit'); ?></option>
														</select>
														<span id='height_text'></span>
												</td>
										</tr>
										<tr>
												<td class='eh-edit-tab-table-left'>
														<?php _e('Weight', 'eh_bulk_edit'); ?>
														<span style="float:right;"><?php echo strtolower(get_option('woocommerce_weight_unit')); ?></span>
												</td>
												<td class='eh-edit-tab-table-middle'>
														<span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Update the weight', 'eh_bulk_edit'); ?>'></span>
												</td>
												<td class='eh-edit-tab-table-input-td'>
														<select id='weight_action'>
																<option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
																<option value='add'><?php _e('Add', 'eh_bulk_edit'); ?></option>
																<option value='sub'><?php _e('Subtract', 'eh_bulk_edit'); ?></option>
																<option value='replace'><?php _e('Replace', 'eh_bulk_edit'); ?></option>
														</select>
														<span id='weight_text'></span>
												</td>
										</tr>
								</table>
							</div>
							<hr>
							<div style="margin:2%;">
								<button id='back_properties_button' value='back_products_properties' style='float: left; margin-left: 10px;' class='button button-primary button-large'><span class="previous"></span><span class="previous-text"><?php _e('Back', 'eh_bulk_edit'); ?></span></button>
								<?php
                     if (in_array('pricing-discounts-by-user-role-woocommerce/pricing-discounts-by-user-role-woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
                ?>
												<button id='next_properties_button' value='next_properties_button' style='float: right; margin-left: 10px;' class='button button-primary button-large'><span class="next-text"><?php _e('Next', 'eh_bulk_edit'); ?></span><span class="next"></span></button>
								<?php
                     } else {
                ?>
											<button id='update_button' value='update_button' style='float: right; margin-left: 10px;' class='button button-primary button-large'><span class="update-text"><?php _e('Update Product', 'eh_bulk_edit'); ?></span><span class="update"></span></button>
        				<?php
                     }
                ?>
								<center><button id='reset_properties_button' value='reset_products_properties' class='button button-primary button-large'><?php _e('Reset Properties', 'eh_bulk_edit'); ?></button></center>
							</div>
						</section>
						<?php
                if (in_array('pricing-discounts-by-user-role-woocommerce/pricing-discounts-by-user-role-woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
             ?>
									<section id="role_based_sec">
										<span class='update-title'><center><?php _e('Role Based Update', 'eh_bulk_edit'); ?></center></span>
										<hr>
										<div class='tab-div'>
										<table class='eh-edit-tab-table' id='update_general_table'>
												<tr>
														<td class='eh-edit-tab-role-table-left'>
																<?php _e('Hide price for guest user', 'eh_bulk_edit'); ?>
														</td>
														<td class='eh-edit-tab-table-middle'>
																<span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Select the price visibilty for guest users', 'eh_bulk_edit'); ?>'></span>
														</td>
														<td class='eh-edit-tab-table-input-td'>
																<select id='visibility_price'>
																		<option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
																		<option value='no'><?php _e('Show Price', 'eh_bulk_edit'); ?></option>
																		<option value='yes'><?php _e('Hide Price', 'eh_bulk_edit'); ?></option>
																</select>
														</td>
												</tr>
												<tr>
														<td class='eh-edit-tab-role-table-left'>
																<?php _e('Hide product price based on user role', 'eh_bulk_edit'); ?>
														</td>
														<td class='eh-edit-tab-table-middle'>
																<span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('For selected user role, hide the product price', 'eh_bulk_edit'); ?>'></span>
														</td>
														<td>
																<span class='select-eh'><select data-placeholder='<?php _e('User Role', 'eh_bulk_edit'); ?>' id='hide_price_role_select' multiple class='hide-price-role-select-chosen' >
																<?php
                                    global $wp_roles;
                                    $roles = $wp_roles->role_names;
                                    foreach ($roles as $key => $value) {
                                        echo "<option value='" . $key . "'>" . $value . "</option>";
                                    }
                                ?>
															</select></span>
														</td>
												</tr>
												<?php
                             $enabled_roles = get_option('eh_pricing_discount_product_price_user_role');
                             if (is_array($enabled_roles)) {
                                 if (!in_array('none', $enabled_roles)) {
                        ?>
																	<tr>
																			<td class='eh-edit-tab-role-table-left'>
																					<?php _e('Enforce individual product price adjustment', 'eh_bulk_edit'); ?>
																			</td>
																			<td class='eh-edit-tab-table-middle'>
																					<span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Enable or Disable induvidual product adjustments', 'eh_bulk_edit'); ?>'></span>
																			</td>
																			<td class='eh-edit-tab-table-input-td'>
																				<select id='price_adjustment_action'>
																						<option value=''><?php _e('< Select Action >', 'eh_bulk_edit'); ?></option>
																						<option value='yes'><?php _e('Enable', 'eh_bulk_edit'); ?></option>
																						<option value='no'><?php _e('Disable', 'eh_bulk_edit'); ?></option>
																				</select>
																			</td>
																	</tr>
															<?php
                                  }
                             }
                      ?>
										</table>
									</div>
										<hr>
										<div style="margin:2%;">
											<button id='back_role_based_button' value='back_products_rolebased' style='float: left; margin-left: 10px;' class='button button-primary button-large'><span class="previous"></span><span class="previous-text"><?php _e('Back', 'eh_bulk_edit'); ?></span></button>
											<button id='update_button' value='update_button' style='float: right; margin-left: 10px;' class='button button-primary button-large'><span class="update-text"><?php _e('Update Product', 'eh_bulk_edit'); ?></span><span class="update"></span></button>
											<center><button id='reset_role_based_button' value='reset_products_rolebased' class='button button-primary button-large'><?php _e('Reset Role Based', 'eh_bulk_edit'); ?></button></center>
										</div>
									</section>
								<?php
    }
?>
					</div><!-- /content -->
				</div>
				<span class="popup-close " data-popup-close="popup-1" id='pop_close' style="cursor:pointer;">x</span>
			</div>
		</div>
		<?php
}
