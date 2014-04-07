jQuery(document).ready(function(){
    jQuery('#the-list').on('click', '.editinline', function(){

		inlineEditPost.revert();
		
		var post_id = jQuery(this).closest('tr').attr('id');

		post_id = post_id.replace("post-", "");
		
		var $wc_inline_data = jQuery('#woocommerce_inline_' + post_id );

		var $ewsp_inline_data = jQuery('#ewsp_inline_data_' + post_id );

		var ewsp_wc_cog_cost                   = $ewsp_inline_data.find('.ewsp_wc_cog_cost').text();
		var ewsp_wc_wholesale_markup           = $ewsp_inline_data.find('.ewsp_wc_wholesale_markup').text();
		var ewsp_wc_wholesale_price            = $ewsp_inline_data.find('.ewsp_wc_wholesale_price').text();
		var ewsp_wc_suggested_retail_markup    = $ewsp_inline_data.find('.ewsp_wc_suggested_retail_markup').text();
		var ewsp_wc_suggested_retail_price     = $ewsp_inline_data.find('.ewsp_wc_suggested_retail_price').text();
		
		var ewsp_wc_cog_cost_variable                   = $ewsp_inline_data.find('.ewsp_wc_cog_cost_variable').text();
		var ewsp_wc_wholesale_markup_variable           = $ewsp_inline_data.find('.ewsp_wc_wholesale_markup_variable').text();
		var ewsp_wc_wholesale_price_variable            = $ewsp_inline_data.find('.ewsp_wc_wholesale_price_variable').text();
		var ewsp_wc_suggested_retail_markup_variable    = $ewsp_inline_data.find('.ewsp_wc_suggested_retail_markup_variable').text();
		var ewsp_wc_suggested_retail_price_variable     = $ewsp_inline_data.find('.ewsp_wc_suggested_retail_price_variable').text();

		jQuery('input[name="_wc_cog_cost"]', '.inline-edit-row').val(ewsp_wc_cog_cost);
		jQuery('input[name="_ewsp_wc_wholesale_markup"]', '.inline-edit-row').val(ewsp_wc_wholesale_markup);
		jQuery('input[name="_ewsp_wc_wholesale_price"]', '.inline-edit-row').val(ewsp_wc_wholesale_price);
		jQuery('input[name="_ewsp_wc_suggested_retail_markup"]', '.inline-edit-row').val(ewsp_wc_suggested_retail_markup);
		jQuery('input[name="_ewsp_wc_suggested_retail_price"]', '.inline-edit-row').val(ewsp_wc_suggested_retail_price);
		
		jQuery('input[name="_wc_cog_cost_variable"]', '.inline-edit-row').val(ewsp_wc_cog_cost_variable);
		jQuery('input[name="_ewsp_wc_wholesale_markup_variable"]', '.inline-edit-row').val(ewsp_wc_wholesale_markup_variable);
		jQuery('input[name="_ewsp_wc_wholesale_price_variable"]', '.inline-edit-row').val(ewsp_wc_wholesale_price_variable);
		jQuery('input[name="_ewsp_wc_suggested_retail_markup_variable"]', '.inline-edit-row').val(ewsp_wc_suggested_retail_markup_variable);
		jQuery('input[name="_ewsp_wc_suggested_retail_price_variable"]', '.inline-edit-row').val(ewsp_wc_suggested_retail_price_variable);
		
		
		// Conditional display
		var product_type		= $wc_inline_data.find('.product_type').text();
		var product_is_virtual	= $wc_inline_data.find('.product_is_virtual').text();

		if (product_type === 'simple' || product_type === 'external') {
			jQuery('.ewsp-pricing-fields-simple-product', '.inline-edit-row').show().removeAttr('style');
			jQuery('.ewsp-pricing-fields-variable-product', '.inline-edit-row').hide();
		} else {
			jQuery('.ewsp-pricing-fields-simple-product', '.inline-edit-row').hide();
			jQuery('.ewsp-pricing-fields-variable-product', '.inline-edit-row').show().removeAttr('style');
		}

/*
		if (product_is_virtual=='yes') {
			jQuery('.dimension_fields', '.inline-edit-row').hide();
		} else {
			jQuery('.dimension_fields', '.inline-edit-row').show().removeAttr('style');
		}

		if (product_type=='grouped') {
			jQuery('.stock_fields', '.inline-edit-row').hide();
		} else {
			jQuery('.stock_fields', '.inline-edit-row').show().removeAttr('style');
		}
*/

		
    });
    

});