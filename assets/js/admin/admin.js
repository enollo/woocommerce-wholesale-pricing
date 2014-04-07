jQuery(document).ready(function($){
	
	// Calculate Wholesale and Suggested Retail Pricing
	////////////////////////////////////////////////////////////////
	
	
	// Change on Wholesale Markup
	////////////////////////////////
	
	//--main edit screen of simple and variable product
	$( ".options_group .ewsp_wholesale_fields input[name^='_ewsp_wc_wholesale_markup']" ).on('keyup change', function(){
		
		var fieldName = $(this).attr("name");
		var fieldNameSuffix = fieldName.slice(-9) === '_variable' ? '_variable' : '';
		
		var $costField = $(this).closest('.options_group').find('input[name="_wc_cog_cost' + fieldNameSuffix + '"]');
		
		// Wholesale
		var $fieldWrapperWholesale = $(this).closest('.ewsp_wholesale_fields');
		
		if ( $fieldWrapperWholesale.length > 0 ) {
			ewspUpdateWholesaleField( 'price', $(this), $fieldWrapperWholesale, $costField );
		}
		
		// Suggested Retail
		var $fieldWrapperSuggestedRetail = $fieldWrapperWholesale.siblings('.ewsp_suggested_retail_fields');
		
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'price', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale );
		}
			
	});
	
	//--variation
	$( ".woocommerce_variation .ewsp_wholesale_fields input[name^='variable_ewsp_wc_wholesale_markup']" ).on('keyup change', function(){
		
		var fieldName = $(this).attr("name");
		var fieldNameSuffix = fieldName.slice(-9) === '_variable' ? '_variable' : '';
		
		var $costField = $(this).closest('.woocommerce_variation').find('input[name^="variable_cost_of_good"]');
		
		// Wholesale
		var $fieldWrapperWholesale = $(this).closest('.ewsp_wholesale_fields');
		
		if ( $fieldWrapperWholesale.length > 0 ) {
			ewspUpdateWholesaleField( 'price', $(this), $fieldWrapperWholesale, $costField, true );
		}
		
		// Suggested Retail
		var $fieldWrapperSuggestedRetail = $fieldWrapperWholesale.siblings('.ewsp_suggested_retail_fields');
		
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'price', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale, true );
		}
			
	});
	
	//--quick edit for simple and variable product
	$( ".ewsp-pricing-fields.inline-edit-col .ewsp_wholesale_fields input[name^='_ewsp_wc_wholesale_markup']" ).on('keyup change', function(){
		
		var fieldName = $(this).attr("name");
		var fieldNameSuffix = fieldName.slice(-9) === '_variable' ? '_variable' : '';
		
		var $costField = $(this).closest('.ewsp-pricing-fields.inline-edit-col').find('input[name="_wc_cog_cost' + fieldNameSuffix + '"]');
		
		// Wholesale
		var $fieldWrapperWholesale = $(this).closest('.ewsp_wholesale_fields');
		
		if ( $fieldWrapperWholesale.length > 0 ) {
			ewspUpdateWholesaleField( 'price', $(this), $fieldWrapperWholesale, $costField );
		}
		
		// Suggested Retail
		var $fieldWrapperSuggestedRetail = $fieldWrapperWholesale.siblings('.ewsp_suggested_retail_fields');
		
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'price', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale );
		}
		
	});
	
	// Change on Wholesale Price
	////////////////////////////////
	
	//--main edit screen of simple and variable product
	$( ".options_group .ewsp_wholesale_fields input[name^='_ewsp_wc_wholesale_price']" ).on('keyup', function(){ //on keyup only!! Make sure they really want to alter the markup
		
		var fieldName = $(this).attr("name");
		var fieldNameSuffix = fieldName.slice(-9) === '_variable' ? '_variable' : '';
		
		var $costField = $(this).closest('.options_group').find('input[name="_wc_cog_cost' + fieldNameSuffix + '"]');
		
		// Wholesale
		var $fieldWrapperWholesale = $(this).closest('.ewsp_wholesale_fields');
		
		if ( $fieldWrapperWholesale.length > 0 ) {
			ewspUpdateWholesaleField( 'markup', $(this), $fieldWrapperWholesale, $costField );
		}
		
		// Suggested Retail
		var $fieldWrapperSuggestedRetail = $fieldWrapperWholesale.siblings('.ewsp_suggested_retail_fields');
		
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'price', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale );
		}
			
	});
	
	//--variation
	$( ".woocommerce_variation .ewsp_wholesale_fields input[name^='variable_ewsp_wc_wholesale_price']" ).on('keyup', function(){
		
		var fieldName = $(this).attr("name");
		var fieldNameSuffix = fieldName.slice(-9) === '_variable' ? '_variable' : '';
		
		var $costField = $(this).closest('.woocommerce_variation').find('input[name^="variable_cost_of_good"]');
		
		// Wholesale
		var $fieldWrapperWholesale = $(this).closest('.ewsp_wholesale_fields');
		
		if ( $fieldWrapperWholesale.length > 0 ) {
			ewspUpdateWholesaleField( 'markup', $(this), $fieldWrapperWholesale, $costField, true );
		}
		
		// Suggested Retail
		var $fieldWrapperSuggestedRetail = $fieldWrapperWholesale.siblings('.ewsp_suggested_retail_fields');
		
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'price', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale, true );
		}
			
	});
	
	//--quick edit for simple and variable product
	$( ".ewsp-pricing-fields.inline-edit-col .ewsp_wholesale_fields input[name^='_ewsp_wc_wholesale_price']" ).on('keyup', function(){
		
		var fieldName = $(this).attr("name");
		var fieldNameSuffix = fieldName.slice(-9) === '_variable' ? '_variable' : '';
		
		var $costField = $(this).closest('.ewsp-pricing-fields.inline-edit-col').find('input[name="_wc_cog_cost' + fieldNameSuffix + '"]');
		
		// Wholesale
		var $fieldWrapperWholesale = $(this).closest('.ewsp_wholesale_fields');
		
		if ( $fieldWrapperWholesale.length > 0 ) {
			ewspUpdateWholesaleField( 'markup', $(this), $fieldWrapperWholesale, $costField );
		}
		
		// Suggested Retail
		var $fieldWrapperSuggestedRetail = $fieldWrapperWholesale.siblings('.ewsp_suggested_retail_fields');
		
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'price', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale );
		}
			
	});
	
	// Change on Cost
	////////////////////////////////
	
	//--main edit of simple or variable product
	$( ".options_group ._wc_cog_cost_variable_field input[name^='_wc_cog_cost']" ).on('keyup change', function(){
		
		// Wholesale
		var $fieldWrapperWholesale = $(this).closest('.options_group').find('.ewsp_wholesale_fields');
		
		if ( $fieldWrapperWholesale.length > 0 ) {
			ewspUpdateWholesaleField( 'price', $(this), $fieldWrapperWholesale, $(this) );
		}
		
		// Suggested Retail
		var $fieldWrapperSuggestedRetail = $fieldWrapperWholesale.siblings('.ewsp_suggested_retail_fields');
		
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'price', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale );
		}
	
	});
	
	//--variation
	$( ".woocommerce_variation input[name^='variable_cost_of_good']" ).on('keyup change', function(){
		
		// Wholesale
		var $fieldWrapperWholesale = $(this).closest('.woocommerce_variation').find('.ewsp_wholesale_fields');
		
		if ( $fieldWrapperWholesale.length > 0 ) {
			ewspUpdateWholesaleField( 'price', $(this), $fieldWrapperWholesale, $(this), true );
		}
		
		// Suggested Retail
		var $fieldWrapperSuggestedRetail = $fieldWrapperWholesale.siblings('.ewsp_suggested_retail_fields');
		
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'price', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale, true );
		}
	
	});
	
	//--quick edit
	$( ".ewsp-pricing-fields.inline-edit-col input[name^='_wc_cog_cost']" ).on('keyup change', function(){
		
		// Wholesale
		var $fieldWrapperWholesale = $(this).closest('.ewsp-pricing-field-wrapper').find('.ewsp_wholesale_fields');
		
		if ( $fieldWrapperWholesale.length > 0 ) {
			ewspUpdateWholesaleField( 'price', $(this), $fieldWrapperWholesale, $(this) );
		}
		
		// Suggested Retail
		var $fieldWrapperSuggestedRetail = $fieldWrapperWholesale.siblings('.ewsp_suggested_retail_fields');
		
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'price', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale );
		}
		
	});
	
	// Change on Suggested Retail Markup
	////////////////////////////////
	
	//--main edit screen of simple and variable product
	$( ".options_group .ewsp_suggested_retail_fields input[name^='_ewsp_wc_suggested_retail_markup']" ).on('keyup change', function(){
		
		// Suggested Retail Wrapper
		var $fieldWrapperSuggestedRetail = $(this).closest('.ewsp_suggested_retail_fields');
		
		// Wholesale Wrapper
		var $fieldWrapperWholesale = $fieldWrapperSuggestedRetail.siblings('.ewsp_wholesale_fields');
		
		// update field
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'price', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale );
		}
			
	});
	
	//--variation
	$( ".woocommerce_variation .ewsp_suggested_retail_fields input[name^='variable_ewsp_wc_suggested_retail_markup']" ).on('keyup change', function(){
		
		// Suggested Retail Wrapper
		var $fieldWrapperSuggestedRetail = $(this).closest('.ewsp_suggested_retail_fields');
		
		// Wholesale Wrapper
		var $fieldWrapperWholesale = $fieldWrapperSuggestedRetail.siblings('.ewsp_wholesale_fields');
		
		// update field
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'price', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale, true );
		}
			
	});
	
	//--quick edit for simple and variable product
	$( ".ewsp-pricing-fields.inline-edit-col .ewsp_suggested_retail_fields input[name^='_ewsp_wc_suggested_retail_markup']" ).on('keyup change', function(){
		
		// Suggested Retail Wrapper
		var $fieldWrapperSuggestedRetail = $(this).closest('.ewsp_suggested_retail_fields');
		
		// Wholesale Wrapper
		var $fieldWrapperWholesale = $fieldWrapperSuggestedRetail.siblings('.ewsp_wholesale_fields');
		
		// update field
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'price', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale );
		}
		
	});
	
	// Change on Suggested Retail Price
	////////////////////////////////
	
	//--main edit screen of simple and variable product
	$( ".options_group .ewsp_suggested_retail_fields input[name^='_ewsp_wc_suggested_retail_price']" ).on('keyup', function(){
		
		// Suggested Retail Wrapper
		var $fieldWrapperSuggestedRetail = $(this).closest('.ewsp_suggested_retail_fields');
		
		// Wholesale Wrapper
		var $fieldWrapperWholesale = $fieldWrapperSuggestedRetail.siblings('.ewsp_wholesale_fields');
		
		// update field
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'markup', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale );
		}
			
	});
	
	//--variation
	$( ".woocommerce_variation .ewsp_suggested_retail_fields input[name^='variable_ewsp_wc_suggested_retail_price']" ).on('keyup', function(){
		
		// Suggested Retail Wrapper
		var $fieldWrapperSuggestedRetail = $(this).closest('.ewsp_suggested_retail_fields');
		
		// Wholesale Wrapper
		var $fieldWrapperWholesale = $fieldWrapperSuggestedRetail.siblings('.ewsp_wholesale_fields');
		
		// update field
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'markup', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale, true );
		}
			
	});
	
	//--quick edit for simple and variable product
	$( ".ewsp-pricing-fields.inline-edit-col .ewsp_suggested_retail_fields input[name^='_ewsp_wc_suggested_retail_price']" ).on('keyup', function(){
		
		// Suggested Retail Wrapper
		var $fieldWrapperSuggestedRetail = $(this).closest('.ewsp_suggested_retail_fields');
		
		// Wholesale Wrapper
		var $fieldWrapperWholesale = $fieldWrapperSuggestedRetail.siblings('.ewsp_wholesale_fields');
		
		// update field
		if ( $fieldWrapperSuggestedRetail.length > 0 ) {
			ewspUpdateSuggestedRetailField( 'markup', $(this), $fieldWrapperSuggestedRetail, $fieldWrapperWholesale );
		}
		
	});
	
	
	function ewspUpdateWholesaleField( field, $triggerInput, $fieldWrapper, $costField, variation ) {
		
		if ( field !== 'markup' && field !== 'price') {
			return;
		}
		
		if ( typeof(variation) === 'undefined' ) {
			variation = false;
		}
		
		var fieldName = $triggerInput.attr("name");
		var fieldNameSuffix = fieldName.slice(-9) === '_variable' ? '_variable' : '';
		
		var markupFieldSelector;
		var priceFieldSelector;
		
		if ( ! variation ) {
			markupFieldSelector = 'input[name="_ewsp_wc_wholesale_markup' + fieldNameSuffix + '"]';
			priceFieldSelector = 'input[name="_ewsp_wc_wholesale_price' + fieldNameSuffix + '"]';
		} else {
			markupFieldSelector = 'input[name^="variable_ewsp_wc_wholesale_markup"]';
			priceFieldSelector = 'input[name^="variable_ewsp_wc_wholesale_price"]';
		}
		
		var $markupInput = $fieldWrapper.find(markupFieldSelector);
		var $priceInput = $fieldWrapper.find(priceFieldSelector);
		
		
		if ( $markupInput.length === 0 || $priceInput.length === 0 ) {
			return;
		}
		
		var cost = $costField.val();
		var markup = $markupInput.val();
		var price = $priceInput.val();
		
		markup = markup.replace('%', '');
		
		// Get default values of the fields. This ensures we use the defult values for these fields if they have not been set
		if ( variation ) {
			
			if ( ! markup ) {
				markup = $markupInput.attr('placeholder');
				$markupInput.val( markup );
			}
			
			if ( ! price ) {
				price = $priceInput.attr('placeholder');
				$priceInput.val( price );
			}
			
		}
		
		markup = markup / 100;
		
		// update price if needed
		if ( field === 'price' && price !== cost * (1 + markup) ) {
			var newPrice = cost * (1 + markup);
			newPrice = newPrice.toFixed(2);
			$priceInput.val(newPrice);
		}
		
		// update markup if needed
		if ( field === 'markup' && price !== cost * (1 + markup) ) {
			var newMarkup = ( ( price/cost ) - 1 ) * 100;
			$markupInput.val( newMarkup );
		}
	}
	
	function ewspUpdateSuggestedRetailField( field, $triggerInput, $fieldWrapper, $fieldWrapperWholesale, variation ) {
		
		if ( field !== 'markup' && field !== 'price') {
			return;
		}
		
		if ( typeof(variation) === 'undefined' ) {
			variation = false;
		}
		
		var fieldName = $triggerInput.attr("name");
		var fieldNameSuffix = fieldName.slice(-9) === '_variable' ? '_variable' : '';
		
		var markupFieldSelector;
		var priceFieldSelector;
		var priceWholesaleFieldSelector;
		
		if ( ! variation ) {
			markupFieldSelector = 'input[name="_ewsp_wc_suggested_retail_markup' + fieldNameSuffix + '"]';
			priceFieldSelector = 'input[name="_ewsp_wc_suggested_retail_price' + fieldNameSuffix + '"]';
			priceWholesaleFieldSelector = 'input[name="_ewsp_wc_wholesale_price' + fieldNameSuffix + '"]';
		} else {
			markupFieldSelector = 'input[name^="variable_ewsp_wc_suggested_retail_markup"]';
			priceFieldSelector = 'input[name^="variable_ewsp_wc_suggested_retail_price"]';
			priceWholesaleFieldSelector = 'input[name^="variable_ewsp_wc_wholesale_price"]';
		}
		
		var $markupInput = $fieldWrapper.find(markupFieldSelector);
		var $priceInput = $fieldWrapper.find(priceFieldSelector);
		var $wholesalePriceField = $fieldWrapperWholesale.find(priceWholesaleFieldSelector);
		
		
		if ( $markupInput.length === 0 || $priceInput.length === 0 || $wholesalePriceField.length === 0 ) {
			return;
		}
		
		var markup = $markupInput.val();
		var price = $priceInput.val();
		var wsPrice = $wholesalePriceField.val();
		
		markup = markup.replace('%', '');
		
		// Get default values of the fields. This ensures we use the defult values for these fields if they have not been set
		if ( variation ) {
			
			if ( ! markup ) {
				markup = $markupInput.attr('placeholder');
				$markupInput.val( markup );
			}
			
			if ( ! price ) {
				price = $priceInput.attr('placeholder');
				$priceInput.val( price );
			}
			
		}
		
		markup = markup / 100;
		
		// update price if needed
		if ( field === 'price' && price !== wsPrice * (1 + markup) ) {
			var newPrice = wsPrice * (1 + markup);
			newPrice = newPrice.toFixed(2);
			$priceInput.val(newPrice);
		}
		
		// update markup if needed
		if ( field === 'markup' && price !== wsPrice * (1 + markup) ) {
			var newMarkup = ( ( price/wsPrice ) - 1 ) * 100;
			$markupInput.val( newMarkup );
		}
	}
	
});