jQuery(function() {
    jQuery('.category-chosen').chosen();
    jQuery('.hide-price-role-select-chosen').chosen();
    jQuery('.tooltip').darkTooltip();
    jQuery('.attribute-update-chosen').chosen();
});
jQuery(function() {
     jQuery('#wrap_table').on('click', '#process_edit', function() {
        swal({
            title: js_obj.process_edit_alert_title,
            text: js_obj.process_edit_alert_subtitle,
            showCancelButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: js_obj.process_edit_alert_confirm_button,
            cancelButtonText: js_obj.process_edit_alert_cancel_button
        }).then(function() {
            jQuery('#main_edit_disp').fadeIn(350);
        });
    });
    jQuery('#main_edit_disp').on('click', '#pop_close', function() {
        jQuery('#main_edit_disp').fadeOut(350);
    });
});
jQuery(document).ready(function() {
    jQuery("#data_table").on('click', '#all_products_button', function() {
        get_all_products_js();
    });
});

function get_all_products_js() {
    jQuery(".loader").css("display", "block");
    var data = {
        paged: '1',
    };
    jQuery.ajax({
        url: ajaxurl,
        data: jQuery.extend({
            _ajax_eh_bep_nonce: jQuery('#_ajax_eh_bep_nonce').val(),
            action: 'eh_bep_all_products',
        }, data),
        success: function(response) {
            jQuery("#wrap_table").css("display", "block");
            jQuery(".loader").css("display", "none");
            clear_tabs();
            var response = jQuery.parseJSON(response);
            if (response.rows.length)
                jQuery('#the-list').html(response.rows);
            if (response.column_headers.length)
                jQuery('thead tr, tfoot tr').html(response.column_headers);
            if (response.pagination.bottom.length)
                jQuery('.tablenav.top .tablenav-pages').html(jQuery(response.pagination.top).html());
            if (response.pagination.top.length)
                jQuery('.tablenav.bottom .tablenav-pages').html(jQuery(response.pagination.bottom).html());
            list.init();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function clear_tabs() {
    jQuery("#tabs").find('.tab-current').removeClass("tab-current");
    jQuery("#tabs").find('.content-current').removeClass("content-current");
    jQuery("#general_sec").addClass("content-current");
    jQuery("#general_li").addClass("tab-current");
    jQuery('#title_action').prop('selectedIndex', 0);
    jQuery("#title_text").empty();
    jQuery('#sku_action').prop('selectedIndex', 0);
    jQuery("#sku_text").empty();
    jQuery('#catalog_action').prop('selectedIndex', 0);
    jQuery('#shipping_class_action').prop('selectedIndex', 0);
    jQuery('#stock_quantity_action').prop('selectedIndex', 0);
    jQuery("#stock_quantity_text").empty();
    jQuery('#allow_backorder_action').prop('selectedIndex', 0);
    jQuery('#stock_status_action').prop('selectedIndex', 0);
    jQuery('#manage_stock_action').prop('selectedIndex', 0);
    jQuery('#sale_price_action').prop('selectedIndex', 0);
    jQuery("#sale_price_text").empty();
    jQuery('#regular_price_action').prop('selectedIndex', 0);
    jQuery("#regular_price_text").empty();
    jQuery('#length_action').prop('selectedIndex', 0);
    jQuery("#length_text").empty();
    jQuery('#width_action').prop('selectedIndex', 0);
    jQuery("#width_text").empty();
    jQuery('#height_action').prop('selectedIndex', 0);
    jQuery("#height_text").empty();
    jQuery('#weight_action').prop('selectedIndex', 0);
    jQuery("#weight_text").empty();
    jQuery('#price_adjustment_action').prop('selectedIndex', 0);
    jQuery('#visibility_price').prop('selectedIndex', 0);
    jQuery('.hide-price-role-select-chosen').val('').trigger("chosen:updated");
}
function clear_filters() {
    jQuery('#product_type').prop('selectedIndex', 0);
    jQuery('.category-chosen').val('').trigger("chosen:updated");
    jQuery("#attrib_name input:checked").each(function() {
        jQuery(this).removeAttr('checked');
    });
    jQuery('#sale_price_range_select').prop('selectedIndex', 0);
    jQuery('#attribute_value_select').remove();
    jQuery('.attribute-chosen').val('').trigger("chosen:updated");
}
jQuery(document).ready(function() {
    jQuery("#data_table").on('click', '#clear_filter_button', function() {
        swal({
            title: js_obj.clear_product_alert_title,
            text: js_obj.clear_product_alert_subtitle,
            showCancelButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: js_obj.clear_product_alert_confirm_button,
            cancelButtonText: js_obj.clear_product_alert_cancel_button
        }).then(function() {
            jQuery(".loader").css("display", "block");
            jQuery.ajax({
                type: 'post',
                url: ajaxurl,
                data:{
                    _ajax_eh_bep_nonce: jQuery('#_ajax_eh_bep_nonce').val(),
                    action: 'eh_bep_clear_products',
                },
                success: function(response) {
                    jQuery("#wrap_table").css("display", "none");
                    jQuery(".loader").css("display", "none");
                    clear_filters();
                    var response = jQuery.parseJSON(response);
                    if (response.rows.length)
                        jQuery('#the-list').html(response.rows);
                    if (response.column_headers.length)
                        jQuery('thead tr, tfoot tr').html(response.column_headers);
                    if (response.pagination.bottom.length)
                        jQuery('.tablenav.top .tablenav-pages').html(jQuery(response.pagination.top).html());
                    if (response.pagination.top.length)
                        jQuery('.tablenav.bottom .tablenav-pages').html(jQuery(response.pagination.bottom).html());
                    list.init();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });
    jQuery("#data_table").on('click', '#filter_products_button', function() {
        jQuery(".loader").css("display", "block");
        var type_data = '';
        var category_data = '';
        var attribute_data = '';
        var attribute_value_data = '';
        var range_data = '';
        var desired_price_data = '';
        var minimum_price_data = '';
        var maximum_price_data = '';
        type_data = jQuery("#product_type").val();
        category_data = (jQuery("#category_select").chosen().val());
        attribute_data = getValue_attrib_name();
        if (getValue_attrib_name() != '')
            attribute_value_data = jQuery("#select_input_attributes").chosen().val();
        else {
            attribute_value_data = ''
        }
        range_data = jQuery("#sale_price_range_select").val();
        if (jQuery("#sale_price_range_select").val() != '|')
            desired_price_data = jQuery("#sale_price_text").val();
        else {
            minimum_price_data = jQuery("#sale_price_min_text").val();
            maximum_price_data = jQuery("#sale_price_max_text").val();
        }
        var data = {
            paged: '1',
        };
        jQuery.ajax({
            type: 'post',
            url: ajaxurl,
            data: jQuery.extend({
                _ajax_eh_bep_nonce: jQuery('#_ajax_eh_bep_nonce').val(),
                action: 'eh_bep_filter_products',
                type: type_data,
                category: category_data,
                attribute: attribute_data,
                attribute_value: attribute_value_data,
                range: range_data,
                desired_price: desired_price_data,
                minimum_price: minimum_price_data,
                maximum_price: maximum_price_data
            }, data),
            success: function(response) {
                jQuery("#wrap_table").css("display", "block");
                jQuery(".loader").css("display", "none");
                clear_tabs();
                var response = jQuery.parseJSON(response);
                if (response.rows.length)
                    jQuery('#the-list').html(response.rows);
                if (response.column_headers.length)
                    jQuery('thead tr, tfoot tr').html(response.column_headers);
                if (response.pagination.bottom.length)
                    jQuery('.tablenav.top .tablenav-pages').html(jQuery(response.pagination.top).html());
                if (response.pagination.top.length)
                    jQuery('.tablenav.bottom .tablenav-pages').html(jQuery(response.pagination.bottom).html());
                list.init();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
});

function check_props() {
    jQuery("#length_textbox").removeClass("input-error");
    jQuery("#width_textbox").removeClass("input-error");
    jQuery("#height_textbox").removeClass("input-error");
    jQuery("#weight_textbox").removeClass("input-error");
    var length_vali = false;
    var width_vali = false;
    var height_vali = false;
    var weight_vali = false;
    if (jQuery("#length_action").val() != '') {
        if (!jQuery.isNumeric(jQuery("#length_textbox").val())) {
            jQuery("#length_textbox").addClass("input-error");
        } else {
            length_vali = true;
        }
    } else {
        length_vali = true;
    }
    if (jQuery("#width_action").val() != '') {
        if (!jQuery.isNumeric(jQuery("#width_textbox").val())) {
            jQuery("#width_textbox").addClass("input-error");
        } else {
            width_vali = true;
        }
    } else {
        width_vali = true;
    }
    if (jQuery("#height_action").val() != '') {
        if (!jQuery.isNumeric(jQuery("#height_textbox").val())) {
            jQuery("#height_textbox").addClass("input-error");
        } else {
            height_vali = true;
        }
    } else {
        height_vali = true;
    }
    if (jQuery("#weight_action").val() != '') {
        if (!jQuery.isNumeric(jQuery("#weight_textbox").val())) {
            jQuery("#weight_textbox").addClass("input-error");
        } else {
            weight_vali = true;
        }
    } else {
        weight_vali = true;
    }
    if (length_vali && width_vali && height_vali && weight_vali) {
        return true;
    } else {
        return false;
    }
}

function getValue_attrib_name() {
    var chkArray = [];
    jQuery("#attrib_name input:checked").each(function() {
        chkArray.push(jQuery(this).val());
    });
    var selected;
    selected = chkArray.join(',') + ",";
    if (selected.length > 1) {
        return (selected.slice(0, -1));
    } else {
        return ('');
    }
}
jQuery(document).ready(function() {
    jQuery('#general_sec').on('click', '#reset_general_button', function() {
        jQuery('#title_action').prop('selectedIndex', 0);
        jQuery("#title_text").empty();
        jQuery('#sku_action').prop('selectedIndex', 0);
        jQuery("#sku_text").empty();
        jQuery('#catalog_action').prop('selectedIndex', 0);
        jQuery('#shipping_class_action').prop('selectedIndex', 0);
    });
    jQuery('#stock_sec').on('click', '#reset_stock_button', function() {
        jQuery('#stock_quantity_action').prop('selectedIndex', 0);
        jQuery("#stock_quantity_text").empty();
        jQuery('#allow_backorder_action').prop('selectedIndex', 0);
        jQuery('#stock_status_action').prop('selectedIndex', 0);
        jQuery('#manage_stock_action').prop('selectedIndex', 0);
    });
    jQuery('#role_based_sec').on('click', '#reset_role_based_button', function() {
        jQuery('#price_adjustment_action').prop('selectedIndex', 0);
        jQuery('#visibility_price').prop('selectedIndex', 0);
        jQuery('.hide-price-role-select-chosen').val('').trigger("chosen:updated");
    });
    jQuery('#price_sec').on('click', '#reset_price_button', function() {
        jQuery('#sale_price_action').prop('selectedIndex', 0);
        jQuery("#sale_price_text").empty();
        jQuery('#regular_price_action').prop('selectedIndex', 0);
        jQuery("#regular_price_text").empty();
    });
    jQuery('#properties_sec').on('click', '#reset_properties_button', function() {
        jQuery('#length_action').prop('selectedIndex', 0);
        jQuery("#length_text").empty();
        jQuery('#width_action').prop('selectedIndex', 0);
        jQuery("#width_text").empty();
        jQuery('#height_action').prop('selectedIndex', 0);
        jQuery("#height_text").empty();
        jQuery('#weight_action').prop('selectedIndex', 0);
        jQuery("#weight_text").empty();
    });
    jQuery('#general_sec').on('click', '#next_general_button', function() {
        jQuery("#title_textbox").removeClass("input-error");
        jQuery("#replaceable_title_textbox").removeClass("input-error");
        jQuery("#sku_textbox").removeClass("input-error");
        var title_vali = false;
        if (jQuery("#title_action").val() != '') {
            if (jQuery("#title_textbox").val() == '') {
                jQuery("#title_textbox").addClass("input-error");
            } else {
                title_vali = true;
            }
            if (jQuery("#title_action").val() == 'replace') {
                if (jQuery("#replaceable_title_textbox").val() == '') {
                    jQuery("#replaceable_title_textbox").addClass("input-error");
                } else {
                    title_vali = true;
                }
            }
        } else {
            title_vali = true;
        }
        var sku_vali = false;
        if (jQuery("#sku_action").val() != '') {
            if (jQuery("#sku_textbox").val() == '') {
                jQuery("#sku_textbox").addClass("input-error");
            } else {
                sku_vali = true;
            }
        } else {
            sku_vali = true;
        }
        if (title_vali && sku_vali) {
            jQuery("#general_sec").removeClass("content-current");
            jQuery("#general_li").removeClass("tab-current");
            jQuery("#price_sec").addClass("content-current");
            jQuery("#price_li").addClass("tab-current");
        }
    });
    jQuery('#price_sec').on('click', '#next_price_button', function() {
        jQuery("#sale_textbox").removeClass("input-error");
        jQuery("#regular_textbox").removeClass("input-error");
        var sale_vali = false;
        var sale_exec = false;
        var sale_note = '';
        if (jQuery("#sale_price_action").val() != '') {
            if (!jQuery.isNumeric(jQuery("#sale_textbox").val())) {
                jQuery("#sale_textbox").addClass("input-error");
            } else {
                if (jQuery("#sale_price_action").val() == 'up_percentage' && jQuery("#sale_textbox").val() >= 100) {
                    sale_exec = true;
                    sale_vali = true;
                    sale_note = "You are increasing Sale price too high!";
                } else if (jQuery("#sale_price_action").val() == 'down_percentage' && jQuery("#sale_textbox").val() >= 100) {
                    sale_exec = true;
                    sale_vali = true;
                    sale_note = "You are decreasing Sale price too low!";
                } else {
                    sale_vali = true;
                }
            }
        } else {
            sale_vali = true;
        }
        var regular_vali = false;
        var regular_exec = false;
        var regular_note = '';
        if (jQuery("#regular_price_action").val() != '') {
            if (!jQuery.isNumeric(jQuery("#regular_textbox").val())) {
                jQuery("#regular_textbox").addClass("input-error");
            } else {
                if (jQuery("#regular_price_action").val() == 'up_percentage' && jQuery("#regular_textbox").val() >= 100) {
                    regular_exec = true;
                    regular_vali = true;
                    regular_note = "You are increasing Regular price too high!";
                } else if (jQuery("#regular_price_action").val() == 'down_percentage' && jQuery("#regular_textbox").val() >= 100) {
                    regular_exec = true;
                    regular_vali = true;
                    regular_note = "You are decreasing Regular price too low!";
                } else {
                    regular_vali = true;
                }
            }
        } else {
            regular_vali = true;
        }
        if (sale_vali && regular_vali) {
            if (sale_exec || regular_exec) {
                swal({
                    title: 'Are you sure?',
                    text: sale_note + "<br>" + regular_note,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    confirmButtonText: 'Yes, I know',
                    cancelButtonText: 'No, Wait!',
                }).then(function() {
                    jQuery("#price_sec").removeClass("content-current");
                    jQuery("#price_li").removeClass("tab-current");
                    jQuery("#stock_sec").addClass("content-current");
                    jQuery("#stock_li").addClass("tab-current");
                }, function(dismiss) {
                    // dismiss can be 'cancel', 'overlay', 'close', 'timer'
                    if (dismiss === 'cancel') {
                        if (sale_exec) {
                            jQuery("#sale_textbox").addClass("input-error");
                        }
                        if (regular_exec) {
                            jQuery("#regular_textbox").addClass("input-error");
                        }
                    }
                });
            } else {
                jQuery("#price_sec").removeClass("content-current");
                jQuery("#price_li").removeClass("tab-current");
                jQuery("#stock_sec").addClass("content-current");
                jQuery("#stock_li").addClass("tab-current");
            }
        }
    });
    jQuery('#stock_sec').on('click', '#next_stock_button', function() {
        jQuery("#quantity_textbox").removeClass("input-error");
        var quanity_vali = false;
        if (jQuery("#stock_quantity_action").val() != '') {
            if (!(/^\d+$/.test(jQuery("#quantity_textbox").val()))) {
                jQuery("#quantity_textbox").addClass("input-error");
            } else {
                quanity_vali = true;
            }
        } else {
            quanity_vali = true;
        }
        if (quanity_vali) {
            jQuery("#stock_sec").removeClass("content-current");
            jQuery("#stock_li").removeClass("tab-current");
            jQuery("#properties_sec").addClass("content-current");
            jQuery("#properties_li").addClass("tab-current");
        }
    });
    jQuery('#properties_sec').on('click', '#next_properties_button', function() {
        if (check_props()) {
            jQuery("#properties_sec").removeClass("content-current");
            jQuery("#properties_li").removeClass("tab-current");
            jQuery("#role_based_sec").addClass("content-current");
            jQuery("#role_based_li").addClass("tab-current");
        }
    });
    jQuery('#price_sec').on('click', '#back_price_button', function() {
        jQuery("#price_sec").removeClass("content-current");
        jQuery("#price_li").removeClass("tab-current");
        jQuery("#general_sec").addClass("content-current");
        jQuery("#general_li").addClass("tab-current");

    });
    jQuery('#role_based_sec').on('click', '#back_role_based_button', function() {
        jQuery("#role_based_sec").removeClass("content-current");
        jQuery("#role_based_li").removeClass("tab-current");
        jQuery("#properties_sec").addClass("content-current");
        jQuery("#properties_li").addClass("tab-current");

    });
    jQuery('#stock_sec').on('click', '#back_stock_button', function() {
        jQuery("#stock_sec").removeClass("content-current");
        jQuery("#stock_li").removeClass("tab-current");
        jQuery("#price_sec").addClass("content-current");
        jQuery("#price_li").addClass("tab-current");

    });
    jQuery('#properties_sec').on('click', '#back_properties_button', function() {
        jQuery("#properties_sec").removeClass("content-current");
        jQuery("#properties_li").removeClass("tab-current");
        jQuery("#stock_sec").addClass("content-current");
        jQuery("#stock_li").addClass("tab-current");

    });
    jQuery('#sale_price_range_select').change(function() {
        var dom_bet = '<input type="text" placeholder="' + js_obj.filter_price_range_min_placeholder + '" id="sale_price_min_text"><input type="text" placeholder="' + js_obj.filter_price_range_max_placeholder + '" id="sale_price_max_text">';
        var dom_sing = '<input type="text" placeholder="' + js_obj.filter_price_range_desired_placeholder + '" id="sale_price_text">';
        switch (jQuery(this).val()) {
            case '|':
                jQuery("#sale_price_range_text").empty();
                jQuery('#sale_price_range_text').append(dom_bet);
                break;
            case 'all':
                jQuery("#sale_price_range_text").empty();
                break;
            default:
                jQuery("#sale_price_range_text").empty();
                jQuery('#sale_price_range_text').append(dom_sing);
        }
    });
    jQuery('#title_action').change(function() {
        var dom_new = '<input type="text" placeholder="' + js_obj.edit_title_new_placeholder + '" id="title_textbox">';
        var dom_app = '<input type="text" placeholder="' + js_obj.edit_title_append_placeholder + '" id="title_textbox">';
        var dom_pre = '<input type="text" placeholder="' + js_obj.edit_title_prepand_placeholder + '" id="title_textbox">';
        var dom_rep = '<input type="text" placeholder="' + js_obj.edit_title_replaceable_placeholder + '" id="replaceable_title_textbox"><input type="text" placeholder="' + js_obj.edit_title_replace_placeholder + '" id="title_textbox">';
        switch (jQuery(this).val()) {
            case 'append':
                jQuery("#title_text").empty();
                jQuery('#title_text').append(dom_app);
                break;
            case 'prepand':
                jQuery("#title_text").empty();
                jQuery('#title_text').append(dom_pre);
                break;
            case 'set_new':
                jQuery("#title_text").empty();
                jQuery('#title_text').append(dom_new);
                break;
            case 'replace':
                jQuery("#title_text").empty();
                jQuery('#title_text').append(dom_rep);
                break;
            default:
                jQuery("#title_text").empty();
        }
    });
    jQuery('#sku_action').change(function() {
        var dom_new = '<input type="text" placeholder="' + js_obj.edit_sku_new_placeholder + '" id="sku_textbox">';
        var dom_app = '<input type="text" placeholder="' + js_obj.edit_sku_append_placeholder + '" id="sku_textbox">';
        var dom_pre = '<input type="text" placeholder="' + js_obj.edit_sku_prepand_placeholder + '" id="sku_textbox">';
        var dom_rep = '<input type="text" placeholder="' + js_obj.edit_sku_replaceable_placeholder + '" id="replaceable_sku_textbox"><input type="text" placeholder="' + js_obj.edit_sku_replace_placeholder + '" id="sku_textbox">';
        switch (jQuery(this).val()) {
            case 'append':
                jQuery("#sku_text").empty();
                jQuery('#sku_text').append(dom_app);
                break;
            case 'prepand':
                jQuery("#sku_text").empty();
                jQuery('#sku_text').append(dom_pre);
                break;
            case 'set_new':
                jQuery("#sku_text").empty();
                jQuery('#sku_text').append(dom_new);
                break;
            case 'replace':
                jQuery("#sku_text").empty();
                jQuery('#sku_text').append(dom_rep);
                break;
            default:
                jQuery("#sku_text").empty();
        }
    });
    jQuery('#stock_quantity_action').change(function() {
        var dom_add = '<input type="text" placeholder="' + js_obj.edit_quantity_add_placeholder + '" id="quantity_textbox">';
        var dom_sub = '<input type="text" placeholder="' + js_obj.edit_quantity_sub_placeholder + '" id="quantity_textbox">';
        var dom_rep = '<input type="text" placeholder="' + js_obj.edit_quantity_rep_placeholder + '" id="quantity_textbox">';
        switch (jQuery(this).val()) {
            case 'add':
                jQuery("#stock_quantity_text").empty();
                jQuery('#stock_quantity_text').append(dom_add);
                break;
            case 'sub':
                jQuery("#stock_quantity_text").empty();
                jQuery('#stock_quantity_text').append(dom_sub);
                break;
            case 'replace':
                jQuery("#stock_quantity_text").empty();
                jQuery('#stock_quantity_text').append(dom_rep);
                break;
            default:
                jQuery("#stock_quantity_text").empty();
        }
    });
    jQuery('#length_action').change(function() {
        var dom_add = '<input type="text" placeholder="' + js_obj.edit_length_add_placeholder + '" id="length_textbox">';
        var dom_sub = '<input type="text" placeholder="' + js_obj.edit_length_sub_placeholder + '" id="length_textbox">';
        var dom_rep = '<input type="text" placeholder="' + js_obj.edit_length_rep_placeholder + '" id="length_textbox">';
        switch (jQuery(this).val()) {
            case 'add':
                jQuery("#length_text").empty();
                jQuery('#length_text').append(dom_add);
                break;
            case 'replace':
                jQuery("#length_text").empty();
                jQuery('#length_text').append(dom_rep);
                break;
            case 'sub':
                jQuery("#length_text").empty();
                jQuery('#length_text').append(dom_sub);
                break;
            default:
                jQuery("#length_text").empty();
        }
    });
    jQuery('#width_action').change(function() {
        var dom_add = '<input type="text" placeholder="' + js_obj.edit_width_add_placeholder + '" id="width_textbox">';
        var dom_sub = '<input type="text" placeholder="' + js_obj.edit_width_sub_placeholder + '" id="width_textbox">';
        var dom_rep = '<input type="text" placeholder="' + js_obj.edit_width_rep_placeholder + '" id="width_textbox">';
        switch (jQuery(this).val()) {
            case 'add':
                jQuery("#width_text").empty();
                jQuery('#width_text').append(dom_add);
                break;
            case 'sub':
                jQuery("#width_text").empty();
                jQuery('#width_text').append(dom_sub);
                break;
            case 'replace':
                jQuery("#width_text").empty();
                jQuery('#width_text').append(dom_rep);
                break;
            default:
                jQuery("#width_text").empty();
        }
    });
    jQuery('#height_action').change(function() {
        var dom_add = '<input type="text" placeholder="' + js_obj.edit_height_add_placeholder + '" id="height_textbox">';
        var dom_sub = '<input type="text" placeholder="' + js_obj.edit_height_sub_placeholder + '" id="height_textbox">';
        var dom_rep = '<input type="text" placeholder="' + js_obj.edit_height_rep_placeholder + '" id="height_textbox">';
        switch (jQuery(this).val()) {
            case 'add':
                jQuery("#height_text").empty();
                jQuery('#height_text').append(dom_add);
                break;
            case 'sub':
                jQuery("#height_text").empty();
                jQuery('#height_text').append(dom_sub);
                break;
            case 'replace':
                jQuery("#height_text").empty();
                jQuery('#height_text').append(dom_rep);
                break;
            default:
                jQuery("#height_text").empty();
        }
    });
    jQuery('#weight_action').change(function() {
        var dom_add = '<input type="text" placeholder="' + js_obj.edit_weight_add_placeholder + '" id="weight_textbox">';
        var dom_sub = '<input type="text" placeholder="' + js_obj.edit_weight_sub_placeholder + '" id="weight_textbox">';
        var dom_rep = '<input type="text" placeholder="' + js_obj.edit_weight_rep_placeholder + '" id="weight_textbox">';
        switch (jQuery(this).val()) {
            case 'add':
                jQuery("#weight_text").empty();
                jQuery('#weight_text').append(dom_add);
                break;
            case 'sub':
                jQuery("#weight_text").empty();
                jQuery('#weight_text').append(dom_sub);
                break;
            case 'replace':
                jQuery("#weight_text").empty();
                jQuery('#weight_text').append(dom_rep);
                break;
            default:
                jQuery("#weight_text").empty();
        }
    });
    jQuery('#sale_price_action').change(function() {
        var dom_up_per = '<input type="text" placeholder="' + js_obj.edit_price_up_per_placeholder + '" id="sale_textbox">';
        var dom_down_per = '<input type="text" placeholder="' + js_obj.edit_price_down_per_placeholder + '" id="sale_textbox">';
        var dom_up_pri = '<input type="text" placeholder="' + js_obj.edit_price_up_pri_placeholder + '" id="sale_textbox">';
        var dom_down_pri = '<input type="text" placeholder="' + js_obj.edit_price_down_pri_placeholder + '" id="sale_textbox">';
        switch (jQuery(this).val()) {
            case 'up_percentage':
                jQuery("#sale_price_text").empty();
                jQuery('#sale_price_text').append(dom_up_per);
                break;
            case 'down_percentage':
                jQuery("#sale_price_text").empty();
                jQuery('#sale_price_text').append(dom_down_per);
                break;
            case 'up_price':
                jQuery("#sale_price_text").empty();
                jQuery('#sale_price_text').append(dom_up_pri);
                break;
            case 'down_price':
                jQuery("#sale_price_text").empty();
                jQuery('#sale_price_text').append(dom_down_pri);
                break;
            default:
                jQuery("#sale_price_text").empty();
        }
    });
    jQuery('#regular_price_action').change(function() {
        var dom_up_per = '<input type="text" placeholder="' + js_obj.edit_price_up_per_placeholder + '" id="regular_textbox">';
        var dom_down_per = '<input type="text" placeholder="' + js_obj.edit_price_down_per_placeholder + '" id="regular_textbox">';
        var dom_up_pri = '<input type="text" placeholder="' + js_obj.edit_price_up_pri_placeholder + '" id="regular_textbox">';
        var dom_down_pri = '<input type="text" placeholder="' + js_obj.edit_price_down_pri_placeholder + '" id="regular_textbox">';
        switch (jQuery(this).val()) {
            case 'up_percentage':
                jQuery("#regular_price_text").empty();
                jQuery('#regular_price_text').append(dom_up_per);
                break;
            case 'down_percentage':
                jQuery("#regular_price_text").empty();
                jQuery('#regular_price_text').append(dom_down_per);
                break;
            case 'up_price':
                jQuery("#regular_price_text").empty();
                jQuery('#regular_price_text').append(dom_up_pri);
                break;
            case 'down_price':
                jQuery("#regular_price_text").empty();
                jQuery('#regular_price_text').append(dom_down_pri);
                break;
            default:
                jQuery("#regular_price_text").empty();
        }
    });
    jQuery("#attrib_name input[type='checkbox']").click(function() {
        var display = jQuery('#attrib_name input[type=checkbox]:checked').length;
        if (display == 0) {
            jQuery('#attribute_value_select').remove();
        } else {
            if (!jQuery('#attribute_value_select').length) {
                var dom = "<tr id='attribute_value_select'><td>" + js_obj.filter_attribute_value_title + "</td><td class='eh-content-table-middle'><span class='woocommerce-help-tip tooltip' data-tooltip='" + js_obj.filter_attribute_value_tooltip + "'></span></td><td><span class='select-eh' ><select data-placeholder='" + js_obj.filter_attribute_value_placeholder + "' multiple class='attribute-chosen' id='select_input_attributes'></select></span></td></tr>";
                jQuery('#attribute_types').after(dom);
                jQuery('.attribute-chosen').chosen();
                jQuery('.tooltip').darkTooltip();
            }
            if (!jQuery(this).is(':checked')) {
                remove_attribute_value(jQuery(this).val());
            } else {
                append_attribute_value(jQuery(this).val());
            }
        }
    });
    jQuery('#main_edit_disp').on('click', '#update_button', function() {
        if (check_props()) {
            jQuery('#update_properties_button').prop('disabled', true);
            jQuery(".loader-update").css("display", "block");
            var title_select_data = jQuery("#title_action").val();
            var sku_select_data = jQuery("#sku_action").val();
            var catalog_select_data = jQuery("#catalog_action").val();
            var shipping_select_data = jQuery("#shipping_class_action").val();
            var sale_select_data = jQuery("#sale_price_action").val();
            var regular_select_data = jQuery("#regular_price_action").val();
            var stock_manage_select_data = jQuery("#manage_stock_action").val();
            var quantity_select_data = jQuery("#stock_quantity_action").val();
            var backorder_select_data = jQuery("#allow_backorder_action").val();
            var stock_status_select_data = jQuery("#stock_status_action").val();
            var length_select_data = jQuery("#length_action").val();
            var width_select_data = jQuery("#width_action").val();
            var height_select_data = jQuery("#height_action").val();
            var weight_select_data = jQuery("#weight_action").val();
            var hide_price_select = (jQuery("#visibility_price").val() == undefined) ? '' : jQuery("#visibility_price").val();
            var hide_price_role_select = (jQuery("#hide_price_role_select").val() == undefined) ? '' : jQuery("#hide_price_role_select").chosen().val();
            var price_adjustment_select = (jQuery("#price_adjustment_action").val() == undefined) ? '' : jQuery("#price_adjustment_action").val();
            var title_text_data = (jQuery("#title_textbox").val() == undefined) ? '' : jQuery("#title_textbox").val();
            var replace_title_text_data = (jQuery("#replaceable_title_textbox").val() == undefined) ? '' : jQuery("#replaceable_title_textbox").val();
            var sku_text_data = (jQuery("#sku_textbox").val() == undefined) ? '' : jQuery("#sku_textbox").val();
            var replace_sku_text_data = (jQuery("#replaceable_sku_textbox").val() == undefined) ? '' : jQuery("#replaceable_sku_textbox").val();
            var sale_text_data = (jQuery("#sale_textbox").val() == undefined) ? '' : jQuery("#sale_textbox").val();
            var regular_text_data = (jQuery("#regular_textbox").val() == undefined) ? '' : jQuery("#regular_textbox").val();
            var quantity_text_data = (jQuery("#quantity_textbox").val() == undefined) ? '' : jQuery("#quantity_textbox").val();
            var length_text_data = (jQuery("#length_textbox").val() == undefined) ? '' : jQuery("#length_textbox").val();
            var width_text_data = (jQuery("#width_textbox").val() == undefined) ? '' : jQuery("#width_textbox").val();
            var height_text_data = (jQuery("#height_textbox").val() == undefined) ? '' : jQuery("#height_textbox").val();
            var weight_text_data = (jQuery("#weight_textbox").val() == undefined) ? '' : jQuery("#weight_textbox").val();
            jQuery.ajax({
                type: 'post',
                url: ajaxurl,
                data: {
                    _ajax_eh_bep_nonce: jQuery('#_ajax_eh_bep_nonce').val(),
                    action: 'eh_bep_update_products',
                    title_select: title_select_data,
                    sku_select: sku_select_data,
                    catalog_select: catalog_select_data,
                    shipping_select: shipping_select_data,
                    sale_select: sale_select_data,
                    regular_select: regular_select_data,
                    stock_manage_select: stock_manage_select_data,
                    quantity_select: quantity_select_data,
                    backorder_select: backorder_select_data,
                    stock_status_select: stock_status_select_data,
                    length_select: length_select_data,
                    width_select: width_select_data,
                    height_select: height_select_data,
                    weight_select: weight_select_data,
                    title_text: title_text_data,
                    replace_title_text: replace_title_text_data,
                    sku_text: sku_text_data,
                    sku_replace_text: replace_sku_text_data,
                    sale_text: sale_text_data,
                    regular_text: regular_text_data,
                    quantity_text: quantity_text_data,
                    length_text: length_text_data,
                    width_text: width_text_data,
                    height_text: height_text_data,
                    weight_text: weight_text_data,
                    hide_price: hide_price_select,
                    hide_price_role: hide_price_role_select,
                    price_adjustment: price_adjustment_select
                },
                success: function(response) {
                    jQuery(".loader-update").css("display", "none");
                    jQuery('#update_properties_button').prop('disabled', false);
                    swal({
                        title: js_obj.edit_success_alert_title,
                        type: 'success',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: js_obj.edit_success_alert_button
                    }).then(function() {
                        jQuery('#main_edit_disp').fadeOut(0);
                        get_all_products_js();
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    });
});

function append_attribute_value(attrib_name) {
    jQuery.ajax({
        type: 'post',
        url: ajaxurl,
        data: {
            _ajax_eh_bep_nonce: jQuery('#_ajax_eh_bep_nonce').val(),
            action: 'eh_bep_get_attributes_action',
            attrib: attrib_name
        },
        success: function(data) {
            jQuery('#select_input_attributes').append(data);
            jQuery('.attribute-chosen').trigger("chosen:updated");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function remove_attribute_value(attrib_name) {
    var id = '#grp_' + attrib_name;
    jQuery(id).remove();
    jQuery('.attribute-chosen').trigger("chosen:updated");
}
jQuery(document).ready(function() {
    jQuery('table.wp-list-table').tableSearch();
});
(function(jQuery) {
    jQuery.fn.tableSearch = function(options) {
        if (!jQuery(this).is('table')) {
            return;
        }
        var tableObj = jQuery(this),
            inputObj = jQuery('#search_id-search-input');
        inputObj.off('keyup').on('keyup', function() {
            var searchFieldVal = jQuery(this).val();
            tableObj.find('tbody tr').hide().each(function() {
                var currentRow = jQuery(this);
                currentRow.find('td').each(function() {
                    if (jQuery(this).html().indexOf(searchFieldVal) > -1) {
                        currentRow.show();
                        return false;
                    }
                });
            });
        });
    }
}(jQuery));
