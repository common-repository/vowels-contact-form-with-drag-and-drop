jQuery(document).ready(function ($) {
	$('.vowels-delete-form').click(function () {
		return confirm(vowelsAdminL10n.single_delete_message);
	});

	$('.vowels-delete-entry').click(function () {
		return confirm(vowelsAdminL10n.single_delete_entry_message);
	});

	$('.vowels-bulk-delete-go').click(function () {
		if ($('input[name="form[]"]:checked').length > 0) {
			if ($('#vowels-bulk-action').val() == 'delete') {
				return confirm(vowelsAdminL10n.plural_delete_message);
			}
		} else {
			return false;
		}
	});

	$('.vowels-bulk-delete-go2').click(function () {
		if ($('input[name="form[]"]:checked').length > 0) {
			if ($('#vowels-bulk-action2').val() == 'delete') {
				return confirm(vowelsAdminL10n.plural_delete_message);
			}
		} else {
			return false;
		}
	});

	$('.vowels-bulk-delete-entry-go').click(function () {
		if ($('input[name="entry[]"]:checked').length > 0) {
			if ($('#vowels-bulk-action').val() == 'delete') {
				return confirm(vowelsAdminL10n.plural_delete_entry_message);
			}
		} else {
			return false;
		}
	});

	$('.vowels-bulk-delete-entry-go2').click(function () {
		if ($('input[name="entry[]"]:checked').length > 0) {
			if ($('#vowels-bulk-action2').val() == 'delete') {
				return confirm(vowelsAdminL10n.plural_delete_entry_message);
			}
		} else {
			return false;
		}
	});

	function pulseIn($element, callback)
	{
		$element.animate({
			borderTopColor: '#0F83CA',
			borderRightColor: '#0F83CA',
			borderBottomColor: '#0F83CA',
			borderLeftColor: '#0F83CA'
		}, 30, function () {
			if (typeof callback === 'function') {
				callback.apply($element);
			}
		});
	}

	function pulseOut($element, callback)
	{
		$element.animate({
			borderTopColor: '#DDDDDD',
			borderRightColor: '#DDDDDD',
			borderBottomColor: '#DDDDDD',
			borderLeftColor: '#DDDDDD'
		}, 30, function () {
			if (typeof callback === 'function') {
				callback.apply($element);
			}
		});
	}

	if (/vowels_form_builder_help$/.test(pagenow)) {
		if (document.location.hash && $(document.location.hash).length) {
			if (document.location.hash != '#top') {
				$('h3').removeAttr('style');
				pulseIn($(document.location.hash).parents('h3'), function () {
					pulseOut(this, function () {
						pulseIn(this);
					});
				});
			}
		}

		$('a[href*="#"]').click(function(){
		    var elemId = '#' + $(this).attr('href').split('#')[1];
		    if (elemId != '#top') {
				$('h3').removeAttr('style');
				pulseIn($(elemId).parents('h3'), function () {
					pulseOut(this, function () {
						pulseIn(this);
					});
				});
		    }
		});
	}

	$('.vowels-export-data textarea').click(function () {
		$(this).select();
	});

	$('#vowels-filter-epp').change(function () {
		$('form#vowels-entries-filter').submit();
	});

	$('#global_email_sending_method').change(function () {
		if ($(this).val() == 'smtp') {
			$('.vowels-show-if-smtp-on').show();
		} else {
			$('.vowels-show-if-smtp-on').hide();
		}
	});

	$('#ifb-set-new-smtp-password').click(function () {
		$('<input type="password" name="smtp_password" id="smtp_password">').appendTo($(this).closest('td').empty()).focus();
    });

	var mouseInsideFormSwitcher = false;
    $('.vowels-form-switcher-list').hover(function(){
        mouseInsideFormSwitcher=true;
    }, function(){
        mouseInsideFormSwitcher=false;
    });

    var mouseInsideFormSwitcherTrigger = false;
    $('#vowels-form-switcher-trigger').hover(function(){
    	mouseInsideFormSwitcherTrigger=true;
    }, function(){
    	mouseInsideFormSwitcherTrigger=false;
    });

    $('#vowels-form-switcher-trigger').click(function () {
    	var $list = $('.vowels-form-switcher-list');
    	if ($list.is(':hidden')) {
    		$list.show();
    		$(this).removeClass('ifb-form-switcher-closed').addClass('ifb-form-switcher-open');
    	} else {
    		$list.hide();
    		$(this).removeClass('ifb-form-switcher-open').addClass('ifb-form-switcher-closed');
    	}
	});

    $('body').mouseup(function(){
        if(!mouseInsideFormSwitcher && !mouseInsideFormSwitcherTrigger) {
        	$('.vowels-form-switcher-list').hide();
        	$('#vowels-form-switcher-trigger').removeClass('ifb-form-switcher-open').addClass('ifb-form-switcher-closed');
        }
    });

    $('a.vowels-external').click(function () {
    	var href = $(this).attr('href');
    	if (href.length) {
    		window.open(href);
    	}
    	return false;
    });

    var verifying = false;
    $('#verify-purchase-code').click(function () {
    	var purchaseCode = $('#purchase_code').val();
    	if (purchaseCode.length) {
	    	if (!verifying) {
	    		verifying = true;
	    		$('.vowels-verify-loading').show();
	        	$.ajax({
	        		type: 'POST',
	        		url: ajaxurl,
	        		data: {
	        			action: 'vowels_form_builder_verify_purchase_code',
        				_ajax_nonce: vowelsAdminL10n.verify_nonce,
        				purchase_code: purchaseCode
	        		},
	        		dataType: 'json',
	        		success: function (response) {
	        			$('.vowels-verify-loading').hide();
	        			if (typeof response === null) {
	        				addVerificationMessage(vowelsAdminL10n.error_verifying, 'error');
	        			} else if (typeof response === 'object') {
	        				if (response.type === 'success') {
	        					addVerificationMessage(response.message, 'success');
	        				} else if (response.type === 'error') {
	        					addVerificationMessage(response.message, 'error');
	        				}

	        				if (typeof response.status === 'string') {
	        					if (response.status === 'valid' && $('.vowels-valid-licence-wrap').is(':hidden')) {
	        						$('.vowels-invalid-licence-wrap').fadeOut('slow', function () {
	        							$('.vowels-valid-licence-wrap').fadeIn('slow');
	        						});
	        					} else if (response.status === 'invalid' && $('.vowels-invalid-licence-wrap').is(':hidden')) {
	        						$('.vowels-valid-licence-wrap').fadeOut('slow', function () {
	        							$('.vowels-invalid-licence-wrap').fadeIn('slow');
	        						});
	        					}
	        				}
	        			}

	        			verifying = false;
	        		},
	        		error: function () {
	        			$('.vowels-verify-loading').hide();
	        			addVerificationMessage(vowelsAdminL10n.error_verifying, 'error');
	        			verifying = false;
	        		}
	        	});
	    	} else {
	    		alert(vowelsAdminL10n.wait_verifying);
	    	}
    	}

    	return false;
    }); // End verify purchase code

	var checkingForUpdates = false;
	$('#ifb-check-for-updates').click(function () {

		if (!checkingForUpdates) {
			checkingForUpdates = true;
			$('.vowels-update-check-loading').show();

			$.ajax({
	    		type: 'POST',
	    		url: ajaxurl,
	    		data: {
	    			action: 'vowels_form_builder_manual_update_check',
	    			_ajax_nonce: vowelsAdminL10n.update_check_nonce
	    		},
	    		dataType: 'json',
	    		success: function (response) {
	    			$('.vowels-update-check-loading').hide();
	    			if (typeof response === null) {
	    				addUpdateMessage(vowelsAdminL10n.error_checking_for_updates, 'error');
	    			} else if (typeof response === 'object') {
	    				if (response.type === 'success') {
	    					addUpdateMessage(response.message, 'success');
	    				} else if (response.type === 'error') {
	    					addUpdateMessage(response.message, 'error');
	    				}
	    			}

	    			checkingForUpdates = false;
	    		},
	    		error: function () {
	    			$('.vowels-update-check-loading').hide();
	    			addUpdateMessage(vowelsAdminL10n.error_checking_for_updates, 'error');
	    			checkingForUpdates = false;
	    		}
	    	});
		}

		return false;
	});

    function addVerificationMessage(text, type)
    {
    	$('#ifb-verify-purchase-code-row').find('.vowels-success-message, .vowels-error-message').remove();
    	$('.vowels-verify-purchase-code-wrap').after('<div class="vowels-' + type + '-message">' + text + '</div>');
    }

	function addUpdateMessage(text, type)
    {
    	$('#ifb-manual-update-check-row').find('.vowels-success-message, .vowels-error-message').remove();
    	$('.ifb-update-check-wrap').after('<div class="vowels-' + type + '-message">' + text + '</div>');
    }

    if (/vowels_form_builder_export$/.test(pagenow)) {
    	$('#export_entries_form_id').change(function () {
    		$('#vowels-export-entries-fields-wrap').hide();
			var $fields = $('#vowels-export-entries-fields').empty(),
			$spinner = $('.vowels-export-entries-loading');
			$('#export_all_fields').attr('checked', false);

    		if ($(this).val() != '') {
    			$spinner.show();
    			$.ajax({
	        		type: 'POST',
	        		url: ajaxurl,
	        		data: {
	        			action: 'vowels_form_builder_get_export_field_list_ajax',
        				form_id: $(this).val()
	        		},
	        		dataType: 'json',
	        		success: function (response) {
	        			$spinner.hide();
	        			if (typeof response === null) {
	        				alert(vowelsAdminL10n.generic_error_try_again);
	        			} else if (typeof response === 'object') {
	        				if (response.type === 'success') {
	        					if (response.data.length) {
	        						for (var i = 0; i < response.data.length; i++) {
	        							$fields.append('<div class="vowels-export-single-field"><label for="export_field_' + i + '"><input class="vowels-export-field" type="checkbox" name="export_fields[]" id="export_field_' + i + '" value="' + response.data[i].value + '" /> ' + response.data[i].label + '</label></div>');
	        						}
	        					}

	        					$('#vowels-export-entries-fields-wrap').show();
	        				}
	        			}
	        		},
	        		error: function () {
	        			$spinner.hide();
	        			alert(vowelsAdminL10n.generic_error_try_again);
	        		}
	        	});
    		}
    	});

    	$('#export_all_fields').click(function () {
    		if ($(this).is(':checked')) {
    			$('.vowels-export-field').attr('checked', true);
    		} else {
    			$('.vowels-export-field').attr('checked', false);
    		}
    	});

    	var dates = $('#from, #to').datepicker({
    		dateFormat: 'yy-mm-dd',
    		onSelect: function( selectedDate ) {
	    		var option = this.id == "from" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" ),
				date = $.datepicker.parseDate(
					instance.settings.dateFormat ||
					$.datepicker._defaults.dateFormat,
					selectedDate, instance.settings
				);
	    		dates.not( this ).datepicker( "option", option, date );
			}
		});
    }

    $('#vowels-entry-show-empty-fields').click(function () {
    	if ($(this).is(':checked')) {
    		$.cookie('vowels-show-empty-fields', '1', { expires: 3650 });
    		window.location.reload();
    	} else {
    		$.removeCookie('vowels-show-empty-fields');
    		window.location.reload();
    	}
    });

    vowelsPreload([
    	'/button-orange-hover.png',
    	'/button-grey-hover.png',
		'/small-spinner.gif',
		'/vowels-warning.png',
		'/vowels-success.png',
		'/button-blue-hover.png',
		'/help-menu-sub-level-hover.png',
		'/button-orange.png',
		'/default-loading.gif',
    ], vowelsAdminL10n.admin_images_url);
}); // End document.ready

window.vowelsPreloadedImages = [];
window.vowelsPreload = function (images, prefix) {
	for (var i = 0; i < images.length; i++) {
		var elem = document.createElement('img');
		elem.src = prefix ? prefix + images[i] : images[i] ;
		window.vowelsPreloadedImages.push(elem);
	}
};