/**
 * Vowelsform Form Builder for WordPress plugin
 *
 */
;(function ($, window) {
	var	$body,
		$form,
		$elementsList,
		$messageArea,
		$wrap;

	window.vowelsforminc = vowelsforminc = {
		form: {},
		logicableElements: [],
		savedFormJson: '',

		init: function (form) {
			$body = $('body');
			$form = $('#ifb');
			if (!$form.length) {
				return;
			}

			$wrap = $('.ifb-wrap');

			vowelsforminc.form = form;

			if (form.id === 0) {
				$('body').addClass('vowels-overlay-active');
				$('#ifb-top').addClass('ifb-new-form');
				$('#ifb-new-form-name-overlay').fadeIn(1000);
				$('#new_form_name').focus().keyup(function (event) {
					if (event.keyCode == 13) {
						$('.ifb-new-form-name-ok').click();
					}
				});
				$(document).bind('keyup.vowels', function (event) {
					if (event.keyCode == 27) {
						$('.ifb-new-form-name-close').click();
						$(document).unbind('keyup.vowels');
					}
				});

				$('.ifb-new-form-name-ok').click(function () {
					var val = $('#new_form_name').val();
					if (val.length) {
						$('#name').val(val);
						vowelsforminc.updateFormName();
					}
				});

				$('.ifb-new-form-name-ok, .ifb-new-form-name-close').click(function () {
					$('body').removeClass('vowels-overlay-active');
					$('#ifb-new-form-name-overlay').hide();
					$('#ifb-elements-empty').add($('.vowels-current-form')).add($('.ifb-vowels-title-form-name')).fadeIn(1000);
				});

				if ($body.hasClass('mobile')) {
					$('.ifb-new-form-name-ok').click();
				}
			} else {
				$('#ifb-top').addClass('ifb-saved-form');
				$('.vowels-current-form').add($('.ifb-vowels-title-form-name')).fadeIn(10);
				if (form.elements.length === 0) {
					$('#ifb-elements-empty').fadeIn(10);
				}
			}

			// Prevent the enter key from doing weird stuff
			$form.submit(function(e) { e.preventDefault(); }).attr('autocomplete', 'off');

			// Fix for JSON.stringify if prototype.js is loaded
			if (typeof Array.prototype.toJSON == 'function') {
				delete Array.prototype.toJSON;
			}

			$elementsList = $('#ifb-elements-wrap');
			$messageArea = $('#ifb-message-area');

			$(window).bind('scroll.vowels resize.vowels', vowelsforminc.positionMessageBox);
			$(window).bind('scroll.vowels resize.vowels', vowelsforminc.positionRightColumn);
			$(window).bind('scroll.vowels resize.vowels', vowelsforminc.showScrollTopButton);

			$('#ifb-tabs').fptabs('.ifb-tabs-panel', {
				tabs: '> .ifb-tabs-nav > li',
				current: 'ifb-current-tab',
				onBeforeClick: function (event, index) {
					if (index == 1) {
						vowelsforminc.update();
						vowelsforminc.updateSettingsDependencies();
					}
				}
			});

			$('#ifb-settings-tabs').fptabs('.ifb-tabs-panel', { tabs: '> .ifb-tabs-nav > li', current: 'ifb-current-tab' });
			$('#ifb-add-element-tabs').fptabs('.ifb-tabs-panel', { tabs: '> .ifb-tabs-nav > li', current: 'ifb-current-tab' });
			
		
			
			var texts = ["Global Settings","Themes","Styles", "CSS Settings", "Email Settings", "Entries Settings", "Database Settings", "Label Placement"];
			var count = 0;
			function changeText() {
			$("#ifb-settings-tab").text(texts[count]);
			count < 8 ? count++ : count = 0;
			}
			setInterval(changeText, 15500);
			
			if ($.isFunction($.fn.qtip)) {
				$wrap.delegate('.ifb-tooltip', 'click', function (event) {
					$(this).qtip({
						overwrite: false, // Make sure the tooltip won't be overridden once created
				        show: {
				           event: event.type, // Use the same show event as the one that triggered the event handler
				           ready: true // Show the tooltip as soon as it's bound, vital so it shows up the first time you hover!
				        },
				        hide: {
			        		event: 'unfocus'
				        },
						style: {
							classes: 'qtip-dark qtip-dark-form'
						},
						content: {
							text: function (api) {
								return $(this).find('.ifb-tooltip-content').html();
							}
						}
					}, event);
				});

				$wrap.delegate('.ifb-simple-tooltip', 'mouseover', function (event) {
					$(this).qtip({
						overwrite: false, // Make sure the tooltip won't be overridden once created
				        show: {
				           event: event.type, // Use the same show event as the one that triggered the event handler
				           ready: true // Show the tooltip as soon as it's bound, vital so it shows up the first time you hover!
				        },
						style: {
							classes: 'qtip-dark qtip-dark-form'
						},
						content: {
							text: false
						}
					}, event);
				});
			}

			$('#element_background_colour, #element_border_colour, #element_text_colour, #label_text_colour').ColorPicker({
				onSubmit: function(hsb, hex, rgb, el) {
					$(el).val('#' + hex);
					$(el).ColorPickerHide();
				},
				onBeforeShow: function () {
					$(this).ColorPickerSetColor(this.value);
				},
				onChange: function (hsb, hex, rgb) {
					$($(this).data('colorpicker').el).val('#'+hex);
				}
			})
			.bind('keyup', function(){
				$(this).ColorPickerSetColor(this.value);
			});

			$('#ifb-first-save-close').click(function () {
				$('#vowels-add-to-website').removeClass('ifb-add-to-website-open').addClass('ifb-add-to-website-closed');
				$('#ifb-first-save-message').hide();
			});

			$wrap.delegate('.ifb-message-more', 'click', function () {
				$(this).parent().find('.ifb-message-more-content').fadeIn('slow');
				return false;
			});

			$('h3.ifb-show-atw-content').click(function () {
				$(this).next().slideToggle(400);
			});

			$wrap.delegate('.ifb-show-first-time-save', 'click', function () {
				if (!vowelsforminc.isScrolledIntoView($('#vowels-add-to-website'))) {
					$.smoothScroll({
						scrollTarget: $('#vowels-add-to-website'),
						offset: -50,
						speed: 1000,
						afterScroll: function () {
							$('#vowels-add-to-website').click();
						}
					});
				} else {
					$('#vowels-add-to-website').click();
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

		    $('#vowels-add-to-website').click(function () {
		    	var $message = $('#ifb-first-save-message');
		    	if ($message.is(':hidden')) {
		    		$message.fadeIn();
		    		$(this).removeClass('ifb-add-to-website-closed').addClass('ifb-add-to-website-open');
		    	} else {
		    		$message.hide();
		    		$(this).removeClass('ifb-add-to-website-open').addClass('ifb-add-to-website-closed');
		    	}
		    });

		    $('#ifb-scroll-top').click(function () {
		    	$.smoothScroll({
					scrollTarget: $('#ifb-top'),
					offset: -50,
					speed: 1000
				});

		    	return false;
		    });

			if (form.elements.length) {
				$form.addClass('ifb-has-elements');
				// Click to edit element label
				for (var i = 0; i < form.elements.length; i++) {
					var element = form.elements[i];
					(function (e) {
						$('.ifb-preview-label-content', '#ifb-element-wrap-' + e.id).editable(function (value, settings) {
							vowelsforminc.savePreviewLabel(value, vowelsforminc.getElementById(e.id));
							return value;
						}, {
							onblur: 'submit',
							onreset: function (settings, self) {
								vowelsforminc.savePreviewLabel(self.revert, vowelsforminc.getElementById(e.id));
							},
							placeholder: ''
						});
					})(element);

					switch (element.type) {
						case 'select':
						case 'radio':
						case 'checkbox':
							vowelsforminc.logicableElements.push(element);
						break;
					}
				}

				vowelsforminc.syncAllLogic(false);
			} else {
				$form.addClass('ifb-no-elements');
			}

			vowelsforminc.updateFormTitle();
			// Click to edit element title
			$('#ifb-title').editable(function (value, settings) {
				$('#title').val(value);
				return value;
			}, {
				onblur: 'submit',
				onreset: function (settings, self) {
					$('#title').val(self.revert);
				},
				placeholder: ''
			});

			vowelsforminc.updateFormDescription();
			// Click to edit element description
			$('#ifb-description').editable(function (value, settings) {
				$('#description').val(value);
				return value;
			}, {
				type: 'textarea',
				onblur: 'submit',
				onreset: function (settings, self) {
					$('#description').val(self.revert);
				},
				height: 60,
				placeholder: ''
			});

			$('#ifb-current-form-name').editable(function (value, settings) {
				$('#name').val(value);
				vowelsforminc.updateFormName();
				return value;
			}, {
				onblur: 'submit',
				onreset: function (settings, self) {
					$('#name').val(self.revert);
					vowelsforminc.updateFormName();
				},
				placeholder: '',
				height: 45
			});

			for (var j = 0; j < form.conditional_recipients.length; j++) {
				vowelsforminc.addConditionalRecipient(form.conditional_recipients[j]);
			}

			vowelsforminc.updateTooltipStyle();

			for (var field in vowelsforminc.form.db_fields) {
				if (vowelsforminc.form.db_fields.hasOwnProperty(field)) {
					vowelsforminc.addDbField(field, vowelsforminc.form.db_fields[field], true);
				}
			}

			$('.ifb-element-settings-tabs').fptabs('.ifb-tabs-panel', { tabs: '> .ifb-tabs-nav > li', current: 'ifb-current-tab' });

			// Make the elements sortable
			$('#ifb-elements-wrap').sortable({
				placeholder: 'ifb-sortable-placeholder',
				stop: function (event, ui) {
					var elementType = ui.item.data('type');
					if (typeof elementType === 'string') {
						var index = ui.item.index();
						ui.item.remove();
						vowelsforminc.addElement(elementType, index, vowelsforminc.sortElements);
					} else {
						vowelsforminc.sortElements();
					}
				},
				delay: 0,
				revert: true,
				handle: '.ifb-move-link, .ifb-element-preview, .ifb-element-preview span.ifb-handle, p.ifb-recaptcha-empty',
				start: function (e, ui) {
			        ui.placeholder.html('<span/>');
			    },
			    tolerance: 'pointer',
			    opacity: 0.4
			});

			// Make the right hand add element buttons draggable to the element list
			$('.ifb-add-element-ul div').draggable({
				connectToSortable: '#ifb-elements-wrap',
				helper: 'clone',
				delay: 0,
				start: function (event, ui) {
					if (typeof document.selection === 'object') {
						document.selection.empty();
					}
				}
			}).disableSelection();

			// Entries table layout sortable
			$('#ifb-active-columns').sortable({
				connectWith: '#ifb-inactive-columns',
				placeholder: 'ifb-columnsort-ph',
				revert: true,
				//tolerance: 'pointer',
				opacity: 0.4
			});

			$('#ifb-inactive-columns').sortable({
				connectWith: '#ifb-active-columns',
				placeholder: 'ifb-columnsort-ph',
				revert: true,
				//tolerance: 'pointer',
				opacity: 0.4
			});

			vowelsforminc.update();
			vowelsforminc.updateSettingsDependencies();

			if (window.location.hash == '#ifb-settings-entries') {
				$('#ifb-tabs').data('tabs').click(1);
				$('#ifb-settings-tabs').data('tabs').click(3);
			}

			// If something has changed, show an alert if leaving the page
			vowelsforminc.savedFormJson = JSON.stringify(vowelsforminc.form);

			window.onbeforeunload = function () {
			    vowelsforminc.update();
			    if (vowelsforminc.savedFormJson !== JSON.stringify(vowelsforminc.form)) {
			        return vowelsL10n.unsaved_changes;
			    }
			};

			$('.ifb-wrap').show();
			$(window).resize();
		},

		/**
		 * Add an element to the form
		 *
		 * Gets the element HTML via Ajax and inserts it into the element list. Also
		 * adds the element to the form object.
		 *
		 * @param string type The type of element to add
		 * @param int position The position of the element in the list
		 * @param function callback Callback executed after element has been added
		 * @param object element Type element object (if converting)
		 */
		addElement: function (type, position, callback, element) {
			if (type == 'group') {
				gsPosition = (typeof position == 'number') ? position : null;
				gePosition = (typeof position == 'number') ? position + 1 : null;
				vowelsforminc.addElement('groupstart', gsPosition, function () {
					vowelsforminc.addElement('groupend', gePosition, callback);
				});
				return;
			}

			// Set the form tab active
			$('#ifb-tabs').data('tabs').click(0);

			if (vowelsforminc.form.elements.length === 0) {
				$('#ifb-elements-empty').hide();
				$form.removeClass('ifb-no-elements').addClass('ifb-has-elements');
			}

			element = element || {
				id: vowelsforminc.getNextElementId(),
				type: type
			};

			var errorCallback = function () {
				this.remove();

				var checkIfEmpty = function () {
					if (vowelsforminc.form.elements.length === 0) {
						$('#ifb-elements-empty').show();
						$form.removeClass('ifb-has-elements').addClass('ifb-no-elements');
					}
				};

				if (type == 'groupend') {
					// If adding the groupend element failed, delete the corresponding groupstart
					vowelsforminc.deleteElement(element.id-1, true, function () {
						checkIfEmpty();
					});
				} else {
					checkIfEmpty();
				}
			};

			var $placeholder = vowelsforminc.getPlaceholder('element');

			if (typeof position !== 'number') {
				position = vowelsforminc.form.elements.length;
			}

			if (position === 0) {
				$elementsList.prepend($placeholder);
			} else if (position == vowelsforminc.form.elements.length) {
				$elementsList.append($placeholder);
			} else {
				$elementsList.find('.ifb-element-wrap:nth-child(' + position + ')').after($placeholder);
			}

			vowelsforminc.setLabelPlacement();

			$.ajax({
				type: 'POST',
			//	async: false,
				url: ajaxurl,
				context: $placeholder,
				data: {
			       action: 'vowels_form_builder_get_element',
			       element: JSON.stringify(element),
			       form: JSON.stringify(vowelsforminc.form)
				},
				dataType: 'json',
				success: function (response) {
					if (response === null) {
						errorCallback.apply(this);
						vowelsforminc.formatAddMessage(vowelsL10n.error_adding_element, 'error', 10);
					} else if (typeof response === 'object') {
						if (response.type == 'success') {
							element = response.data.element;
							this.replaceWith(response.data.html);
							$('#ifb-element-settings-tabs-' + element.id).fptabs('.ifb-tabs-panel', { tabs: '> .ifb-tabs-nav > li', current: 'ifb-current-tab' });
							$('#ifb-element-wrap-' + element.id).fadeIn('slow');

							vowelsforminc.form.elements.splice(position, 0, element);

							if (element.type == 'radio' || element.type == 'select') {
								// Add this element to the conditional recipient element lists
								$('#ifb-conditional-recipient-list > li').each(function () {
									$(this).find('.ifb-conditional-element').append($('<option/>', { value: element.id, text: vowelsforminc.getShortenedAdminLabel(element) }));
								});
							}

							// Click to edit element label
							
							$('.ifb-preview-label-content', '#ifb-element-wrap-' + element.id).editable(function (value, settings) {
								vowelsforminc.savePreviewLabel(value, element);
								return value;
							}, {
								onblur: 'submit',
								onreset: function (settings, self) {
									vowelsforminc.savePreviewLabel(self.revert, element);
								},
								placeholder: '',
								select: !0
							});
										
							// Add default filters and validators, sync conditional logic
							switch (element.type) {
								case 'text':
								case 'textarea':
									vowelsforminc.addFilter(element, 'trim');
									vowelsforminc.syncLogic(element);
									break;
								case 'email':
									vowelsforminc.addFilter(element, 'trim');
									vowelsforminc.addValidator(element, 'email');
									vowelsforminc.syncLogic(element);
									break;
								case 'checkbox':
								case 'select':
								case 'radio':
									vowelsforminc.logicableElements.push(element);
									vowelsforminc.syncAllLogic();
									break;
								default:
									vowelsforminc.syncLogic(element);
									break;
							}

							if (element.save_to_database) {
								vowelsforminc.addEntryLayoutColumn(element);
							}

							if (response.message) {
								vowelsforminc.addResponseMessage(response.message);
							}

							if (typeof callback === 'function') {
								callback.call();
							}
						} else if (response.type == 'error') {
							errorCallback.apply(this);
							if (response.message) {
								vowelsforminc.addResponseMessage(response.error);
							}
						}
					}
				},
				error: function () {
					errorCallback.apply(this);
					vowelsforminc.formatAddMessage(vowelsL10n.error_adding_element, 'error', 10);
				}
			});
		},

		
		
				
		deleteElement: function (id, force, callback) {
			if (!force && !confirm(vowelsL10n.confirm_delete_element)) {
				return;
			}

			var element;
			for (var i = 0; i < vowelsforminc.form.elements.length; i++) {
				if (vowelsforminc.form.elements[i].id == id) {
					element = vowelsforminc.form.elements[i];
					vowelsforminc.form.elements.splice(i, 1);
				}
			}

			$('#ifb-element-wrap-' + id).fadeOut('slow').hide(0, function() {
				if (element.type == 'groupstart') {
					vowelsforminc.deleteElement(element.id+1, true);
				} else if (element.type == 'groupend') {
					vowelsforminc.deleteElement(element.id-1, true);
				}

				$(this).remove();

				if (vowelsforminc.form.elements.length === 0) {
					$('#ifb-elements-empty').fadeIn();
					$form.removeClass('ifb-has-elements').addClass('ifb-no-elements');
				}

				if (!force) {
					vowelsforminc.addMessage(vowelsL10n.element_deleted, 'success', 5);
				}

				vowelsforminc.removeEntryLayoutColumn(element);

				switch (element.type) {
					case 'select':
					case 'checkbox':
					case 'radio':
						vowelsforminc.deleteLogicableElement(element);
						vowelsforminc.deleteDependentLogicRules(element);
						vowelsforminc.syncAllLogic(false, true);
					break;
				}

				if (typeof callback === 'function') {
					callback.apply(this);
				}
			});

			// Check if there are any conditional rules on this element and delete them
			$('#ifb-conditional-recipient-list > li').each(function () {
				if ($(this).find('.ifb-conditional-element').val() == id) {
					vowelsforminc.deleteConditionalRecipient($(this).data('id'));
				}
			});
		},

		/**
		 * Convert an element to another type
		 *
		 * @param object element The original element
		 * @param string target Type The name of the target element type
		 */
		convertElement: function (element, targetList) {
			var targetType = $(targetList).val();
			if (targetType === '' || !confirm(vowelsL10n.confirm_convert_element)) {
				return;
			}

			var convertIt = function (element) {
				var clone = $.extend(true, {}, element),
				position = vowelsforminc.getElementPosition(element);
				clone.id = vowelsforminc.getNextElementId();
				clone.type = targetType;

				vowelsforminc.deleteElement(element.id, true, function () {
					vowelsforminc.addElement(null, position, null, clone);
				});
			};

			switch (element.type) {
				case 'radio':
					if (targetType == 'select' || targetType == 'checkbox') {
						convertIt(element);
					}
					break;
				case 'select':
					if (targetType == 'radio' || targetType == 'checkbox') {
						convertIt(element);
					}
					break;
				case 'checkbox':
					if (targetType == 'radio' || targetType == 'select') {
						convertIt(element);
					}
					break;
			}
		},

		/**
		 * Save the form
		 */
		save: function (nonce, onSuccess, onError) {
			vowelsforminc.update();

			$.ajax({
				type: 'POST',
				async: false,
				url: ajaxurl,
				data: {
			       action: 'vowels_form_builder_save_form_ajax',
			       _ajax_nonce: nonce,
			       form: JSON.stringify(vowelsforminc.form)
				},
				dataType: 'json',
				success: function (response) {
					if (response === null) {
						vowelsforminc.formatAddMessage(vowelsL10n.error_saving_form, 'error', 10);

						if (typeof onError === 'function') {
							onError.apply(this);
						}
					} else if (typeof response === 'object') {
						if (response.type == 'success') {
							var oldId = vowelsforminc.form.id;
							vowelsforminc.form.id = response.data.id;
							$('.ifb-update-form-id').text(vowelsforminc.form.id);
							vowelsforminc.updateShortcodes();

							if (oldId === 0) {
								$('#ifb-top').removeClass('ifb-new-form').addClass('ifb-saved-form');
								var $entriesLink = $('#vowels-builder-to-entries-link'),
									$reloadLink = $('#vowels-reload-link');

								if ($entriesLink.length) {
									$entriesLink.attr('href', $entriesLink.attr('href').replace(/id=\d+/, 'id=' + vowelsforminc.form.id));
								}

								if ($reloadLink.length) {
									$reloadLink.attr('href', $reloadLink.attr('href').replace(/id=\d+/, 'id=' + vowelsforminc.form.id));
								}

								if (history.replaceState) {
									history.replaceState({}, '', window.location.href + '&id=' + vowelsforminc.form.id);
								}
							}

							vowelsforminc.savedFormJson = JSON.stringify(vowelsforminc.form);

							if (response.message) {
								vowelsforminc.addResponseMessage(response.message);
							}

							if (typeof onSuccess === 'function') {
								onSuccess.apply(this);
							}
						} else if (response.type == 'error') {
							if (response.message) {
								vowelsforminc.addResponseMessage(response.message);
							}

							if (typeof onError === 'function') {
								onError.apply(this);
							}
						}
					}
				},
				error: function () {
					vowelsforminc.formatAddMessage(vowelsL10n.error_saving_form, 'error', 10);

					if (typeof onError === 'function') {
						onError.apply(this);
					}
				}
			});
		},

		saveForm: function (button, nonce)
		{
			var $save = $(button).find('.ifb-save').hide(),
			$saving = $(button).find('.ifb-saving').css('display', 'block'),
			$saved = $(button).find('.ifb-saved'),
			$saveFailed = $(button).find('.ifb-save-failed');

			var onSuccess = function () {
				$saving.hide();
				$saved.css('display', 'block');
				setTimeout(function () {
					$saved.hide();
					$save.css('display', 'block');
				}, 1250);
			};

			var onError = function () {
				$saving.hide();
				$saveFailed.css('display', 'block');
				setTimeout(function () {
					$saveFailed.hide();
					$save.css('display', 'block');
				}, 1250);
			};

			vowelsforminc.save(nonce, onSuccess, onError);
		},

	    saveElementSettings: function (button, nonce) {
			var $save = $(button).find('.ifb-save').hide(),
			$saving = $(button).find('.ifb-saving').css('display', 'block'),
			$saved = $(button).find('.ifb-saved'),
			$saveFailed = $(button).find('.ifb-save-failed');

			var onSuccess = function () {
				$saving.hide();
				$saved.css('display', 'block');
				setTimeout(function () {
					$saved.hide();
					$save.css('display', 'block');
				}, 1250);
			};

			var onError = function () {
				$saving.hide();
				$saveFailed.show();
				setTimeout(function () {
					$saveFailed.hide();
					$save.css('display', 'block');
				}, 1250);
			};

			vowelsforminc.save(nonce, onSuccess, onError);
	    },

	    saveAndCloseElementSettings: function (nonce, id) {
	    	vowelsforminc.hideSettings(id);
			vowelsforminc.save(nonce);
	    },

		/**
		 * Preview the form
		 */
		preview: function () {
			vowelsforminc.update();
			window.open(vowelsL10n.preview_url);
		},

		/**
		 * Get a given parameter from the URL
		 */
		getQueryParameter: function (key, default_) {
			if (default_ === undefined) {
				default_ = '';
			}

			key = key.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");

			var regex = new RegExp("[\\?&]"+key+"=([^&#]*)");
			var qs = regex.exec(window.location.href);

			return qs === null ? default_ : qs[1];
		},

		/**
		 * Update the form object to match the input values
		 */
		update: function () {
			var form = this.form;

			// Global form settings
			form.name = $('#name').val();
			form.title = $('#title').val();
			form.description = $('#description').val();
			form.active = $('#active').is(':checked');
			form.send_notification = $('#send_notification').is(':checked');
			form.subject = $('#subject').val();
			form.customise_email_content = $('#customise_email_content').is(':checked');
			form.notification_show_empty_fields = $('#notification_show_empty_fields').is(':checked');
			form.notification_format = $('#notification_format').val();
			form.notification_email_content = $('#notification_email_content').val();
			form.notification_reply_to_element = $('#notification_reply_to_element').val();
			form.notification_from_type = $('#notification_from_type').val();
			form.from_email = $('#from_email').val();
			form.from_name = $('#from_name').val();
			form.notification_from_element = $('#notification_from_element').val();
			form.send_autoreply = $('#send_autoreply').is(':checked');
			form.autoreply_recipient_element = $('#autoreply_recipient_element').val();
			form.autoreply_subject = $('#autoreply_subject').val();
			form.autoreply_format = $('#autoreply_format').val();
			form.autoreply_email_content = $('#autoreply_email_content').val();
			form.autoreply_from_type = $('#autoreply_from_type').val();
			form.autoreply_from_email = $('#autoreply_from_email').val();
			form.autoreply_from_name = $('#autoreply_from_name').val();
			form.autoreply_from_element = $('#autoreply_from_element').val();
			form.recipients = [];
			$('#recipients > li').each(function () {
				var email = $(this).find('input[name="ifb_recipient_email"]').val();
				if (email.length > 0) {
					form.recipients.push(email);
				}
			});
			form.bcc = [];
			$('#bcc').children().each(function () {
				var email = $(this).find('input[name="ifb_bcc_email"]').val();
				if (email.length > 0) {
					form.bcc.push(email);
				}
			});
			form.conditional_recipients = [];
			$('#ifb-conditional-recipient-list > li').each(function () {
				var conditionalRecipient = {
					id: $(this).data('id'),
					recipient: $(this).find('.ifb-conditional-recipient').val(),
					element: $(this).find('.ifb-conditional-element').val(),
					operator: $(this).find('.ifb-conditional-operator').val(),
					value: $(this).find('.ifb-conditional-value').val()
				};

				form.conditional_recipients.push(conditionalRecipient);
			});

			form.email_sending_method = $('#email_sending_method').val();
			form.smtp_host = $('#smtp_host').val();
			form.smtp_port = $('#smtp_port').val();
			form.smtp_encryption = $('#smtp_encryption').val();
			form.smtp_username = $('#smtp_username').val();
			if ($('#smtp_password').length) {
				form.smtp_password = $('#smtp_password').val();
			}
			form.label_placement = $('#label_placement').val();
			form.label_width = $('#label_width').val();
			form.success_type = $('#success_type').val();
			form.success_message = $('#success_message').val();
			form.success_message_position = $('#success_message_position').val();
			form.success_message_timeout = $('#success_message_timeout').val();
			form.success_redirect_type = $('#success_redirect_type').val();
			if (form.success_redirect_type.length === 0) {
				form.success_redirect_value = '';
			} else if (form.success_redirect_type == 'page') {
				form.success_redirect_value = $('#success_redirect_page').val();
			} else if (form.success_redirect_type == 'post') {
				form.success_redirect_value = $('#success_redirect_post').val();
			} else if (form.success_redirect_type == 'url') {
				form.success_redirect_value = $('#success_redirect_url').val();
			}
			form.reset_form_values = $('#reset_form_values').val();
			form.submit_button_text = $('#submit_button_text').val();
			form.use_ajax = $('#use_ajax').is(':checked');
			form.show_referral_link = $('#show_referral_link').is(':checked');
			form.referral_text = $('#referral_text').val();
			form.referral_username = $('#referral_username').val();
			form.use_honeypot = $('#use_honeypot').is(':checked');
			form.conditional_logic_animation = $('#conditional_logic_animation').is(':checked');
			form.center_fancybox = $('#center_fancybox').is(':checked');
			form.required_text = $('#required_text').val();
			form.theme = $('#theme').val();
			form.responsive = $('#responsive').is(':checked');
			form.use_uniformjs = $('#use_uniformjs').is(':checked');
			form.uniformjs_theme = $('#uniformjs_theme').val();
			form.jqueryui_theme = $('#jqueryui_theme').val();
			form.jqueryui_l10n = $('#jqueryui_l10n').val();
			form.use_tooltips = $('#use_tooltips').is(':checked');
			form.tooltip_type = $('#tooltip_type').val();
			form.tooltip_event = $('#tooltip_event').val();
			form.tooltip_style = $('#tooltip_style').val();
			form.tooltip_custom = $('#tooltip_custom').val();
			form.tooltip_my = $('#tooltip_my').val();
			form.tooltip_at = $('#tooltip_at').val();
			form.tooltip_rounded = $('#tooltip_rounded').is(':checked');
			form.tooltip_shadow = $('#tooltip_shadow').is(':checked');
			form.element_background_colour = $('#element_background_colour').val();
			form.element_border_colour = $('#element_border_colour').val();
			form.element_text_colour = $('#element_text_colour').val();
			form.label_text_colour = $('#label_text_colour').val();
			vowelsforminc.updateGlobalStyles();
			form.save_to_database = $('#save_to_database').is(':checked');
			form.entries_table_layout.active = [];
			$('#ifb-active-columns > li > div').each(function () {
				var entry = {
					type: $(this).data('type'),
					label: $(this).text(),
					id: $(this).data('id')
				};
				form.entries_table_layout.active.push(entry);
			});
			form.entries_table_layout.inactive = [];
			$('#ifb-inactive-columns > li > div').each(function () {
				var entry = {
					type: $(this).data('type'),
					label: $(this).text(),
					id: $(this).data('id')
				};
				form.entries_table_layout.inactive.push(entry);
			});
			form.use_wp_db = $('#use_wp_db').is(':checked');
			form.db_host = $('#db_host').val();
			form.db_username = $('#db_username').val();
			form.db_password = $('#db_password').val();
			form.db_name = $('#db_name').val();
			form.db_table = $('#db_table').val();
			vowelsforminc.updateDbFields();

			// Per element settings
			for (var i = 0; i < form.elements.length; i++) {
				var element = form.elements[i];

				switch (element.type) {
					case 'text':
						// Settings
						element.label = $('#label_'+element.id).val();
						element.placeholder = $('#placeholder_'+element.id).val();
						element.description = $('#description_'+element.id).val();
						element.required = $('#required_'+element.id).is(':checked');

						// More settings
						element.default_value = $('#default_value_'+element.id).val();
						element.dynamic_default_value = $('#dynamic_default_value_'+element.id).is(':checked');
						element.dynamic_key = $('#dynamic_key_'+element.id).val();
						element.clear_default_value = $('#clear_default_value_'+element.id).is(':checked');
						element.reset_default_value = $('#reset_default_value_'+element.id).is(':checked');
						element.tooltip = $('#tooltip_'+element.id).val();
						element.admin_label = $('#admin_label_'+element.id).val();
						element.required_message = $('#required_message_'+element.id).val();
						element.is_hidden = $('#is_hidden_'+element.id).is(':checked');
						element.save_to_database = $('#save_to_database_'+element.id).is(':checked');
						element.label_placement = $('#label_placement_'+element.id).val();
						element.label_width = $('#label_width_'+element.id).val();
						element.tooltip_type = $('#tooltip_type_'+element.id).val();
						element.tooltip_event = $('#tooltip_event_'+element.id).val();
						element.prevent_duplicates = $('#prevent_duplicates_'+element.id).is(':checked');
						element.duplicate_found_message = $('#duplicate_found_message_'+element.id).val();
						vowelsforminc.updateLogic(element);

						// Advanced
						vowelsforminc.updateFilters(element);
						vowelsforminc.updateValidators(element);
						vowelsforminc.updateStyles(element);
						break;
					case 'textarea':
						// Settings
						element.label = $('#label_'+element.id).val();
						element.placeholder = $('#placeholder_'+element.id).val();
						element.description = $('#description_'+element.id).val();
						element.required = $('#required_'+element.id).is(':checked');

						// More settings
						element.default_value = $('#default_value_'+element.id).val();
						element.dynamic_default_value = $('#dynamic_default_value_'+element.id).is(':checked');
						element.dynamic_key = $('#dynamic_key_'+element.id).val();
						element.clear_default_value = $('#clear_default_value_'+element.id).is(':checked');
						element.reset_default_value = $('#reset_default_value_'+element.id).is(':checked');
						element.tooltip = $('#tooltip_'+element.id).val();
						element.admin_label = $('#admin_label_'+element.id).val();
						element.required_message = $('#required_message_'+element.id).val();
						element.is_hidden = $('#is_hidden_'+element.id).is(':checked');
						element.save_to_database = $('#save_to_database_'+element.id).is(':checked');
						element.label_placement = $('#label_placement_'+element.id).val();
						element.label_width = $('#label_width_'+element.id).val();
						element.tooltip_type = $('#tooltip_type_'+element.id).val();
						element.tooltip_event = $('#tooltip_event_'+element.id).val();
						element.prevent_duplicates = $('#prevent_duplicates_'+element.id).is(':checked');
						element.duplicate_found_message = $('#duplicate_found_message_'+element.id).val();
						vowelsforminc.updateLogic(element);

						// Advanced
						vowelsforminc.updateFilters(element);
						vowelsforminc.updateValidators(element);
						vowelsforminc.updateStyles(element);
						break;
					case 'email':
						// Settings
						element.label = $('#label_'+element.id).val();
						element.placeholder = $('#placeholder_'+element.id).val();
						element.description = $('#description_'+element.id).val();
						element.required = $('#required_'+element.id).is(':checked');

						// More settings
						element.default_value = $('#default_value_'+element.id).val();
						element.dynamic_default_value = $('#dynamic_default_value_'+element.id).is(':checked');
						element.dynamic_key = $('#dynamic_key_'+element.id).val();
						element.clear_default_value = $('#clear_default_value_'+element.id).is(':checked');
						element.reset_default_value = $('#reset_default_value_'+element.id).is(':checked');
						element.tooltip = $('#tooltip_'+element.id).val();
						element.admin_label = $('#admin_label_'+element.id).val();
						element.required_message = $('#required_message_'+element.id).val();
						element.is_hidden = $('#is_hidden_'+element.id).is(':checked');
						element.save_to_database = $('#save_to_database_'+element.id).is(':checked');
						element.label_placement = $('#label_placement_'+element.id).val();
						element.label_width = $('#label_width_'+element.id).val();
						element.tooltip_type = $('#tooltip_type_'+element.id).val();
						element.tooltip_event = $('#tooltip_event_'+element.id).val();
						element.prevent_duplicates = $('#prevent_duplicates_'+element.id).is(':checked');
						element.duplicate_found_message = $('#duplicate_found_message_'+element.id).val();
						vowelsforminc.updateLogic(element);

						// Advanced
						vowelsforminc.updateFilters(element);
						vowelsforminc.updateValidators(element);
						vowelsforminc.updateStyles(element);
						break;
					case 'select':
						// Settings
						element.label = $('#label_'+element.id).val();
						element.description = $('#description_'+element.id).val();
						element.required = $('#required_'+element.id).is(':checked');
						vowelsforminc.updateOptions(element);

						// More settings
						element.tooltip = $('#tooltip_'+element.id).val();
						element.admin_label = $('#admin_label_'+element.id).val();
						element.required_message = $('#required_message_'+element.id).val();
						element.is_hidden = $('#is_hidden_'+element.id).is(':checked');
						element.save_to_database = $('#save_to_database_'+element.id).is(':checked');
						element.label_placement = $('#label_placement_'+element.id).val();
						element.label_width = $('#label_width_'+element.id).val();
						element.tooltip_type = $('#tooltip_type_'+element.id).val();
						element.tooltip_event = $('#tooltip_event_'+element.id).val();
						element.prevent_duplicates = $('#prevent_duplicates_'+element.id).is(':checked');
						element.duplicate_found_message = $('#duplicate_found_message_'+element.id).val();
						vowelsforminc.updateLogic(element);
						element.dynamic_default_value = $('#dynamic_default_value_'+element.id).is(':checked');
						element.dynamic_key = $('#dynamic_key_'+element.id).val();

						// Advanced
						vowelsforminc.updateStyles(element);
						break;
					case 'checkbox':
						// Settings
						element.label = $('#label_'+element.id).val();
						element.description = $('#description_'+element.id).val();
						element.required = $('#required_'+element.id).is(':checked');
						vowelsforminc.updateOptions(element);
						element.options_layout = $('#options_layout_' + element.id).val();
						element.tooltip = $('#tooltip_'+element.id).val();

						// More settings
						element.admin_label = $('#admin_label_'+element.id).val();
						element.required_message = $('#required_message_'+element.id).val();
						element.is_hidden = $('#is_hidden_'+element.id).is(':checked');
						element.save_to_database = $('#save_to_database_'+element.id).is(':checked');
						element.label_placement = $('#label_placement_'+element.id).val();
						element.label_width = $('#label_width_'+element.id).val();
						element.tooltip_type = $('#tooltip_type_'+element.id).val();
						element.tooltip_event = $('#tooltip_event_'+element.id).val();
						element.prevent_duplicates = $('#prevent_duplicates_'+element.id).is(':checked');
						element.duplicate_found_message = $('#duplicate_found_message_'+element.id).val();
						vowelsforminc.updateLogic(element);
						element.dynamic_default_value = $('#dynamic_default_value_'+element.id).is(':checked');
						element.dynamic_key = $('#dynamic_key_'+element.id).val();

						// Advanced
						vowelsforminc.updateStyles(element);
						break;
					case 'radio':
						// Settings
						element.label = $('#label_'+element.id).val();
						element.description = $('#description_'+element.id).val();
						element.required = $('#required_'+element.id).is(':checked');
						vowelsforminc.updateOptions(element);
						element.options_layout = $('#options_layout_' + element.id).val();
						element.tooltip = $('#tooltip_'+element.id).val();

						// More settings
						element.admin_label = $('#admin_label_'+element.id).val();
						element.required_message = $('#required_message_'+element.id).val();
						element.is_hidden = $('#is_hidden_'+element.id).is(':checked');
						element.save_to_database = $('#save_to_database_'+element.id).is(':checked');
						element.label_placement = $('#label_placement_'+element.id).val();
						element.label_width = $('#label_width_'+element.id).val();
						element.tooltip_type = $('#tooltip_type_'+element.id).val();
						element.tooltip_event = $('#tooltip_event_'+element.id).val();
						element.prevent_duplicates = $('#prevent_duplicates_'+element.id).is(':checked');
						element.duplicate_found_message = $('#duplicate_found_message_'+element.id).val();
						vowelsforminc.updateLogic(element);
						element.dynamic_default_value = $('#dynamic_default_value_'+element.id).is(':checked');
						element.dynamic_key = $('#dynamic_key_'+element.id).val();

						// Advanced
						vowelsforminc.updateStyles(element);
						break;
					case 'file':
						// Settings
						element.label = $('#label_'+element.id).val();
						element.description = $('#description_'+element.id).val();
						element.required = $('#required_'+element.id).is(':checked');
						element.enable_swf_upload = $('#enable_swf_upload_'+element.id).is(':checked');
						element.allow_multiple_uploads = $('#allow_multiple_uploads_'+element.id).is(':checked');
						element.upload_num_fields = $('#upload_num_fields_'+element.id).val();
						element.upload_user_add_more = $('#upload_user_add_more_'+element.id).is(':checked');
						element.upload_add_another_text = $('#upload_add_another_text_'+element.id).val();
						element.upload_allowed_extensions = $('#upload_allowed_extensions_'+element.id).val();
						element.upload_maximum_size = $('#upload_maximum_size_'+element.id).val();

						// More settings
						element.tooltip = $('#tooltip_'+element.id).val();
						element.admin_label = $('#admin_label_'+element.id).val();
						element.is_hidden = $('#is_hidden_'+element.id).is(':checked');
						element.save_to_database = $('#save_to_database_'+element.id).is(':checked');
						element.label_placement = $('#label_placement_'+element.id).val();
						element.label_width = $('#label_width_'+element.id).val();
						element.add_as_attachment = $('#add_as_attachment_'+element.id).is(':checked');
						element.save_to_server = $('#save_to_server_'+element.id).is(':checked');
						element.save_path = $('#save_path_'+element.id).val();
						element.browse_text = $('#browse_text_'+element.id).val();
						element.default_text = $('#default_text_'+element.id).val();
						element.tooltip_type = $('#tooltip_type_'+element.id).val();
						element.tooltip_event = $('#tooltip_event_'+element.id).val();
						element.messages = {
							not_uploaded_with_filename: $('#not_uploaded_with_filename_'+element.id).val(),
		                    not_uploaded: $('#not_uploaded_'+element.id).val(),
		                    too_big_with_filename: $('#too_big_with_filename_'+element.id).val(),
		                    too_big: $('#too_big_'+element.id).val(),
		                    not_allowed_type_with_filename: $('#not_allowed_type_with_filename_'+element.id).val(),
		                    not_allowed_type: $('#not_allowed_type_'+element.id).val(),
		                    field_required: $('#field_required_'+element.id).val(),
		                    only_partial_with_filename: $('#only_partial_with_filename_'+element.id).val(),
		                    only_partial: $('#only_partial_'+element.id).val(),
		                    no_file: $('#no_file_'+element.id).val(),
		                    missing_temp_folder: $('#missing_temp_folder_'+element.id).val(),
		                    failed_to_write: $('#failed_to_write_'+element.id).val(),
		                    stopped_by_extension: $('#stopped_by_extension_'+element.id).val(),
		                    unknown_error: $('#unknown_error_'+element.id).val()
						};
						vowelsforminc.updateLogic(element);

						// Advanced
						vowelsforminc.updateStyles(element);
						break;
					case 'captcha':
						// Settings
						element.label = $('#label_'+element.id).val();
						element.placeholder = $('#placeholder_'+element.id).val();
						element.description = $('#description_'+element.id).val();
						vowelsforminc.updateCaptchaOptions(element);

						// More settings
						element.tooltip = $('#tooltip_'+element.id).val();
						element.required_message = $('#required_message_'+element.id).val();
						element.invalid_message = $('#invalid_message_'+element.id).val();

						element.label_placement = $('#label_placement_'+element.id).val();
						element.label_width = $('#label_width_'+element.id).val();
						element.tooltip_type = $('#tooltip_type_'+element.id).val();
						element.tooltip_event = $('#tooltip_event_'+element.id).val();
						vowelsforminc.updateLogic(element);

						// Advanced
						vowelsforminc.updateStyles(element);
						break;
					case 'recaptcha':
						// Settings
						element.label = $('#label_'+element.id).val();
						element.description = $('#description_'+element.id).val();
						element.recaptcha_theme = $('#recaptcha_theme_'+element.id).val();
						element.recaptcha_type = $('#recaptcha_type_'+element.id).val();
						element.recaptcha_size = $('#recaptcha_size_'+element.id).val();
						element.recaptcha_badge_position = $('#recaptcha_badge_position_'+element.id).val();
						element.recaptcha_lang = $('#recaptcha_lang_'+element.id).val();
						element.tooltip = $('#tooltip_'+element.id).val();

						// More settings
						element.admin_label = $('#admin_label_'+element.id).val();
						element.required_message = $('#required_message_'+element.id).val();
						element.label_placement = $('#label_placement_'+element.id).val();
						element.label_width = $('#label_width_'+element.id).val();
						element.tooltip_type = $('#tooltip_type_'+element.id).val();
						element.tooltip_event = $('#tooltip_event_'+element.id).val();
						vowelsforminc.updateLogic(element);
						element.messages = {
							'missing-input-secret': $('#recaptcha_missing-input-secret_'+element.id).val(),
							'invalid-input-secret': $('#recaptcha_invalid-input-secret_'+element.id).val(),
							'missing-input-response': $('#recaptcha_missing-input-response_'+element.id).val(),
							'invalid-input-response': $('#recaptcha_invalid-input-response_'+element.id).val(),
							'error': $('#recaptcha_error_'+element.id).val()
						};

						// Advanced
						vowelsforminc.updateStyles(element);
						break;
					case 'html':
						// Settings
						element.content = $('#content_'+element.id).val();
						element.enable_wrapper = $('#enable_wrapper_' + element.id).is(':checked');
						element.show_in_entry = $('#show_in_entry_' + element.id).is(':checked');
						vowelsforminc.updateLogic(element);
						break;
					case 'date':
						// Settings
						element.label = $('#label_'+element.id).val();
						element.description = $('#description_'+element.id).val();
						element.required = $('#required_'+element.id).is(':checked');
						element.tooltip = $('#tooltip_'+element.id).val();

						// More settings
						element.default_value = {
							day: $('#default_value_' + element.id + '_day').val(),
							month: $('#default_value_' + element.id + '_month').val(),
							year: $('#default_value_' + element.id + '_year').val()
						};
						element.show_date_headings = $('#show_date_headings_'+element.id).is(':checked');
						element.day_heading = $('#day_heading_' + element.id).val();
						element.month_heading = $('#month_heading_' + element.id).val();
						element.year_heading = $('#year_heading_' + element.id).val();

						element.month_translations = {
							1: $('#month_translation_1_' + element.id).val(),
							2: $('#month_translation_2_' + element.id).val(),
							3: $('#month_translation_3_' + element.id).val(),
							4: $('#month_translation_4_' + element.id).val(),
							5: $('#month_translation_5_' + element.id).val(),
							6: $('#month_translation_6_' + element.id).val(),
							7: $('#month_translation_7_' + element.id).val(),
							8: $('#month_translation_8_' + element.id).val(),
							9: $('#month_translation_9_' + element.id).val(),
							10: $('#month_translation_10_' + element.id).val(),
							11: $('#month_translation_11_' + element.id).val(),
							12: $('#month_translation_12_' + element.id).val()
						};

						element.start_year = $('#start_year_' + element.id).val();
						element.end_year = $('#end_year_' + element.id).val();
						element.admin_label = $('#admin_label_'+element.id).val();
						element.required_message = $('#required_message_'+element.id).val();
						element.months_as_numbers = $('#months_as_numbers_'+element.id).is(':checked');
						element.field_order = $('#field_order_'+element.id).val();
						element.date_validator_message_invalid = $('#date_validator_message_invalid_'+element.id).val();
						element.date_format = $('#date_format_'+element.id).val();
						element.is_hidden = $('#is_hidden_'+element.id).is(':checked');
						element.save_to_database = $('#save_to_database_'+element.id).is(':checked');
						element.show_datepicker = $('#show_datepicker_'+element.id).is(':checked');
						element.label_placement = $('#label_placement_'+element.id).val();
						element.label_width = $('#label_width_'+element.id).val();
						element.tooltip_type = $('#tooltip_type_'+element.id).val();
						element.tooltip_event = $('#tooltip_event_'+element.id).val();
						element.prevent_duplicates = $('#prevent_duplicates_'+element.id).is(':checked');
						element.duplicate_found_message = $('#duplicate_found_message_'+element.id).val();
						vowelsforminc.updateLogic(element);
						element.dynamic_default_value = $('#dynamic_default_value_'+element.id).is(':checked');
						element.dynamic_key = $('#dynamic_key_'+element.id).val();

						// Advanced
						vowelsforminc.updateStyles(element);
						break;
					case 'time':
						// Settings
						element.label = $('#label_'+element.id).val();
						element.description = $('#description_'+element.id).val();
						element.required = $('#required_'+element.id).is(':checked');
						element.tooltip = $('#tooltip_'+element.id).val();

						// More settings
						element.default_value = {
							hour: $('#default_value_'+element.id+'_hour').val(),
							minute: $('#default_value_'+element.id+'_minute').val(),
							ampm: $('#default_value_'+element.id+'_ampm').val()
						};
						element.time_12_24 = $('#time_12_24_'+element.id).val();
						element.show_time_headings = $('#show_time_headings_'+element.id).is(':checked');
						element.start_hour = $('#start_hour_'+element.id).val();
						element.end_hour = $('#end_hour_'+element.id).val();
						element.minute_granularity = $('#minute_granularity_'+element.id).val();
						element.time_format = $('#time_format_'+element.id).val();
						element.time_validator_message_invalid = $('#time_validator_message_invalid_'+element.id).val();
						element.hh_string = $('#hh_string_'+element.id).val();
						element.mm_string = $('#mm_string_'+element.id).val();
						element.ampm_string = $('#ampm_string_'+element.id).val();
						element.am_string = $('#am_string_'+element.id).val();
						element.pm_string = $('#pm_string_'+element.id).val();
						element.admin_label = $('#admin_label_'+element.id).val();
						element.required_message = $('#required_message_'+element.id).val();
						element.is_hidden = $('#is_hidden_'+element.id).is(':checked');
						element.save_to_database = $('#save_to_database_'+element.id).is(':checked');
						element.label_placement = $('#label_placement_'+element.id).val();
						element.label_width = $('#label_width_'+element.id).val();
						element.tooltip_type = $('#tooltip_type_'+element.id).val();
						element.tooltip_event = $('#tooltip_event_'+element.id).val();
						element.prevent_duplicates = $('#prevent_duplicates_'+element.id).is(':checked');
						element.duplicate_found_message = $('#duplicate_found_message_'+element.id).val();
						vowelsforminc.updateLogic(element);
						element.dynamic_default_value = $('#dynamic_default_value_'+element.id).is(':checked');
						element.dynamic_key = $('#dynamic_key_'+element.id).val();

						// Advanced
						vowelsforminc.updateStyles(element);
						break;
					case 'hidden':
						// Settings
						element.default_value = $('#default_value_'+element.id).val();
						element.label = $('#label_'+element.id).val();
						element.is_hidden = $('#is_hidden_'+element.id).is(':checked');
						element.save_to_database = $('#save_to_database_'+element.id).is(':checked');
						element.dynamic_default_value = $('#dynamic_default_value_'+element.id).is(':checked');
						element.dynamic_key = $('#dynamic_key_'+element.id).val();
						break;
					case 'password':
						// Settings
						element.label = $('#label_'+element.id).val();
						element.placeholder = $('#placeholder_'+element.id).val();
						element.description = $('#description_'+element.id).val();
						element.required = $('#required_'+element.id).is(':checked');

						// More settings
						element.tooltip = $('#tooltip_'+element.id).val();
						element.admin_label = $('#admin_label_'+element.id).val();
						element.required_message = $('#required_message_'+element.id).val();
						element.is_hidden = $('#is_hidden_'+element.id).is(':checked');
						element.save_to_database = $('#save_to_database_'+element.id).is(':checked');
						element.label_placement = $('#label_placement_'+element.id).val();
						element.label_width = $('#label_width_'+element.id).val();
						element.tooltip_type = $('#tooltip_type_'+element.id).val();
						element.tooltip_event = $('#tooltip_event_'+element.id).val();
						element.prevent_duplicates = $('#prevent_duplicates_'+element.id).is(':checked');
						element.duplicate_found_message = $('#duplicate_found_message_'+element.id).val();
						vowelsforminc.updateLogic(element);
						element.dynamic_default_value = $('#dynamic_default_value_'+element.id).is(':checked');
						element.dynamic_key = $('#dynamic_key_'+element.id).val();

						// Advanced
						vowelsforminc.updateFilters(element);
						vowelsforminc.updateValidators(element);
						vowelsforminc.updateStyles(element);
						break;
					case 'groupstart':
						element.admin_title = $('#admin_title_'+element.id).val();
						element.title = $('#title_'+element.id).val();
						element.show_name_in_email = $('#show_name_in_email_'+element.id).is(':checked');
						element.description = $('#description_'+element.id).val();
						element.number_of_columns = $('#number_of_columns_'+element.id).val();
						element.column_alignment = $('#column_alignment_'+element.id).val();
						element.label_placement = $('#label_placement_'+element.id).val();
						element.label_width = $('#label_width_'+element.id).val();
						element.group_style = $('#group_style_'+element.id).val();
						element.tooltip_type = $('#tooltip_type_'+element.id).val();
						element.tooltip_event = $('#tooltip_event_'+element.id).val();
						element.border_colour = $('#border_colour_'+element.id).val();
						element.background_colour = $('#background_colour_'+element.id).val();
						vowelsforminc.updateLogic(element);
						vowelsforminc.updateStyles(element);
						break;
				}
			}
		},

		getNextElementId: function () {
			var id = 0;

			if (vowelsforminc.form.elements.length > 0) {
				for (var i = 0; i < vowelsforminc.form.elements.length; i++) {
					id = Math.max(id, vowelsforminc.form.elements[i].id);
				}
			}

			return id + 1;
		},

		getPlaceholder: function (type) {
			var classes = ['placeholder'];

			if (type) {
				classes.push(type + '-placeholder');
			}

			return $('<div class="' + classes.join(' ') + '"></div>');
		},

		getElementById: function (id) {
			for (var i = 0; i < vowelsforminc.form.elements.length; i++) {
				if (vowelsforminc.form.elements[i].id == id) {
					return vowelsforminc.form.elements[i];
				}
			}
			return null;
		},

		showSettings: function (id) {
			var $elementWrap = $('#ifb-element-wrap-'+id);

			if ($elementWrap.size()) {
				$elementWrap.find('.ifb-element-settings-inner').show();
				$elementWrap.find('.ifb-element-settings').fadeIn(500);
				$elementWrap.find('.ifb-settings-link').hide();
				$elementWrap.find('.ifb-close-link').show();
				$elementWrap.addClass('ifb-settings-open');
			}
		},

		hideSettings: function (id) {
			var $elementWrap = $('#ifb-element-wrap-'+id);

			if ($elementWrap.size()) {
				$elementWrap.find('.ifb-element-settings-inner').eq($('#ifb-element-settings-tabs-'+id).data('tabs').getIndex()).slideUp(400, function () {
					$elementWrap.find('.ifb-element-settings').hide();
					$elementWrap.find('.ifb-close-link').hide();
					$elementWrap.find('.ifb-settings-link').show();
					$elementWrap.removeClass('ifb-settings-open');
				});
			}
		},

		toggleCustomiseValues: function (checked, element) {
			if (checked) {
				$('#options_td_'+element.id).addClass('ifb-customise-values');
				element.customise_values = true;
			} else {
				$('#options_td_'+element.id).removeClass('ifb-customise-values');
				element.customise_values = false;
			}

			vowelsforminc.updateOptions(element);
		},

		clearDefaultOptions: function (element) {
			$('#ifb_options_' + element.id).find('.ifb-default-option').attr('checked', false);
			vowelsforminc.updateOptions(element);
		},

		updateOptions: function (element) {
			element.options = [];
			element.default_value = [];

			var $previewElement = $('#ifb_element_'+element.id),
				$options, count, $optionsOverflow;

			switch (element.type) {
				case 'select':
					$previewElement.find('option').remove();

					$('#ifb_options_' + element.id + ' > li').each(function (index) {
						var label = $('.ifb-option-label', $(this)).val();
						if (!element.customise_values) {
							$('.ifb-option-value', $(this)).val(label);
						}
						var value = $('.ifb-option-value', $(this)).val();
						element.options.push({ label: label, value: value });

						if ($('.ifb-default-option', $(this)).is(':checked')) {
							element.default_value.push(value);
						}

						$previewElement.append($('<option />', { value: value, text: label }));
					});

					if (element.default_value.length) {
						$previewElement.val(element.default_value);
						$('.ifb-clear-default-options', '#options_td_' + element.id).css('visibility', 'visible');
					} else {
						$('.ifb-clear-default-options', '#options_td_' + element.id).css('visibility', 'hidden');
					}
					break;
				case 'checkbox':
					$options = $('#ifb_options_' + element.id + ' > li');
					count = $options.length;
					$optionsOverflow = $('#ifb_options_overflow_' + element.id);
					$previewElement.find('li').remove();

					$options.each(function (index) {
						var label = $('.ifb-option-label', $(this)).val();
						if (!element.customise_values) {
							$('.ifb-option-value', $(this)).val(label);
						}
						var value = $('.ifb-option-value', $(this)).val();
						element.options.push({ label: label, value: value });

						if ($('.ifb-default-option', $(this)).is(':checked')) {
							element.default_value.push(value);
						}

						if (index < 5) {
							var $input = $('<input type="checkbox" name="ifb_element_'+element.id+'" disabled="disabled" />').val(value),
							$label = $('<label/>').html(label);

							$previewElement.append($('<li/>').append($input).append($label));
						}
					});

					if (count > 5) {
						$optionsOverflow.fadeIn('slow');
					} else {
						$optionsOverflow.hide();
					}

					$('input[name=ifb_element_'+element.id+']', $previewElement).val(element.default_value);
					break;
				case 'radio':
					$options = $('#ifb_options_' + element.id + ' > li');
					count = $options.length;
					$optionsOverflow = $('#ifb_options_overflow_' + element.id);
					$previewElement.find('li').remove();

					$options.each(function (index) {
						var label = $('.ifb-option-label', $(this)).val();
						if (!element.customise_values) {
							$('.ifb-option-value', $(this)).val(label);
						}
						var value = $('.ifb-option-value', $(this)).val();
						element.options.push({ label: label, value: value });

						if ($('.ifb-default-option', $(this)).is(':checked')) {
							element.default_value.push(value);
						}

						if (index < 5) {
							var $input = $('<input type="radio" name="ifb_element_'+element.id+'" disabled="disabled" />').val(value),
							$label = $('<label/>').html(label);

							$previewElement.append($('<li/>').append($input).append($label));
						}

						if (element.default_value.length) {
							$('.ifb-clear-default-options', '#options_td_' + element.id).css('visibility', 'visible');
						} else {
							$('.ifb-clear-default-options', '#options_td_' + element.id).css('visibility', 'hidden');
						}
					});

					if (count > 5) {
						$optionsOverflow.fadeIn('slow');
					} else {
						$optionsOverflow.hide();
					}

					$('input[name=ifb_element_'+element.id+']', $previewElement).val(element.default_value);
					break;
			}

			// Check if there are any active conditional rules for this element and update the values
			$('#ifb-conditional-recipient-list > li').each(function () {
				if ($(this).find('.ifb-conditional-element').val() == element.id) {
					var $values = $(this).find('.ifb-conditional-value'),
						value = $values.val(),
						optionHasBeenSelected = false;

					$values.empty();

					for (var i = 0; i < element.options.length; i++) {
						var option = element.options[i],
							$option = $('<option/>', { value: option.value, text: option.label });

						if (value === option.value) {
							$option.attr('selected', 'selected');
							optionHasBeenSelected = true;
						}

						$values.append($option);
					}

					if (!optionHasBeenSelected && typeof value === 'string' && value.length > 0) {
						// There was a saved value that's no longer in the list, add it to stop this rule incorrectly interfering
						$values.append($('<option>', { text: value, value: value }).attr('selected', 'selected'));
					}
				}
			});
		},

		addOption: function (button, element) {
			$(button).parent().after(vowelsforminc.getOptionHtml(element, ''));
			vowelsforminc.updateOptions(element);
			vowelsforminc.updateLogicOptions(element);
		},

		getOptionHtml: function (element, label, value) {
			if (value === null || value === undefined) {
				value = label;
			}

			var defaultType = (element.type == 'checkbox') ? 'checkbox' : 'radio';
			return $('<li class="ifb-option-wrap">' +
			            ' <input class="ifb-default-option" name="default_option_' + element.id + '" type="' + defaultType + '" onclick="vowelsforminc.updateOptions(vowelsforminc.getElementById('+element.id+'));" />' +
				        ' <input class="ifb-option-label" type="text" value="' + label + '" onkeyup="vowelsforminc.updateOptions(vowelsforminc.getElementById('+element.id+'));" onblur="vowelsforminc.updateLogicOptions(vowelsforminc.getElementById('+element.id+'));" />' +
					    ' <input class="ifb-option-value" type="text" value="' + value + '" onkeyup="vowelsforminc.updateOptions(vowelsforminc.getElementById('+element.id+'));" onblur="vowelsforminc.updateLogicOptions(vowelsforminc.getElementById('+element.id+'));" />' +
					    ' <span class="ifb-add-option" onclick="vowelsforminc.addOption(this, vowelsforminc.getElementById('+element.id+'));">+</span>' +
					    ' <span class="ifb-remove-option" onclick="vowelsforminc.removeOption(this, vowelsforminc.getElementById('+element.id+'));">x</span>' +
				    '</li>');
		},

		removeOption: function (button, element) {
			if ($('li', $(button).parent().parent()).size() > 1) {
				$(button).parent().remove();
			} else {
				vowelsforminc.addMessage(vowelsL10n.at_least_one_option, 'error', 3);
			}

			vowelsforminc.updateOptions(element);
			vowelsforminc.updateLogicOptions(element);
		},

		/**
		 * Updates the element's preview label
		 *
		 * @param object element
		 */
		updatePreviewLabel: function (element) {
			var $previewLabel = $('.ifb-preview-label', '#ifb-element-wrap-'+element.id),
			val = $('#label_' + element.id).val();

			$('.ifb-preview-label-content', '#ifb-element-wrap-'+element.id).html(val);

			if (val.length > 0) {
				$previewLabel.find('.ifb-required').show();
			} else {
				$previewLabel.find('.ifb-required').hide();
			}

			element.label = val;
		},

		/**
		 * Updates the element's label including in other places
		 * that don't require immediate feedback
		 *
		 * @param object element
		 */
		updateElementLabel: function (element) {
			vowelsforminc.updatePreviewLabel(element);
			vowelsforminc.updateConditionalRecipientLabels(element);
			vowelsforminc.updateEntryLayoutColumnLabel(element);
			vowelsforminc.updateLogicRuleLabels(element);
		},

		updateAdminLabel: function (input, element) {
			var label = $(input).val();
			element.admin_label = label;

			vowelsforminc.updateConditionalRecipientLabels(element);
			vowelsforminc.updateEntryLayoutColumnLabel(element);
			vowelsforminc.updateLogicRuleLabels(element);
		},

		updateConditionalRecipientLabels: function (element) {
			if (element.type == 'radio' || element.type == 'select') {
				// Check for any conditional recipients using this element and update the label
				$('#ifb-conditional-recipient-list .ifb-conditional-element > option[value="'+element.id+'"]').each(function () {
					$(this)[0].text = vowelsforminc.getShortenedAdminLabel(element);
				});
			}
		},

		updateHiddenPreviewLabel: function (input, element) {
			var $previewLabel = $('.ifb-preview-label', '#ifb-element-wrap-'+element.id);
			var $hidden = $previewLabel.find('span.ifb-hidden-preview');
			var val = $(input).val();

			$previewLabel.text(val).append($hidden);
			element.label = val;
			vowelsforminc.updateEntryLayoutColumnLabel(element);
		},

		updatePreviewDescription: function (element) {
			var $previewDescription = $('.ifb-preview-description', '#ifb-element-wrap-'+element.id);

			var val = $('#description_' + element.id).val();
			$previewDescription.html(val);

			if (val.length > 0) {
				$previewDescription.show();
			} else {
				$previewDescription.hide();
			}
		},

		updateDefaultValue: function (input, element) {
			$('#ifb_element_'+element.id).val($(input).val());
		},

	    updateGroupTitle: function (element) {
			var $titlePreview = $('#ifb-element-wrap-' + element.id + ' .ifb-preview-title'),
			    val = $('#title_' + element.id).val();
			$titlePreview.html(val);

			if (val.length > 0) {
				$titlePreview.show();
			} else {
				$titlePreview.hide();
			}
		},

		toggleElementRequired: function (element, checked) {
			if (checked) {
				$('#ifb-element-wrap-'+element.id).removeClass('ifb-element-optional');
				element.required = true;
			} else {
				$('#ifb-element-wrap-'+element.id).addClass('ifb-element-optional');
				element.required = false;
			}
		},

		updateRequiredText: function (input) {
			var requiredText = $(input).val();
			$('.ifb-preview-label span.ifb-required').text(requiredText);

			if (requiredText.length > 0) {
				$form.removeClass('ifb-no-required-text');
			} else {
				$form.addClass('ifb-no-required-text');
			}
		},

		setRecaptchaTheme: function (element, list) {
			var val = $(list).val();
			var $context = $('#ifb_element_'+element.id);
			$('.ifb-recaptcha-sample', $context).hide();

			switch (val) {
				case 'light':
					/* falls through */
				default:
					$('.ifb-recaptcha-sample-light', $context).show();
					break;
				case 'dark':
					$('.ifb-recaptcha-sample-dark', $context).show();
					break;
			}
		},

		setLabelPlacement: function () {
			var val = $('#label_placement').val();
			vowelsforminc.form.label_placement = val;
			$('.ifb-element-wrap').removeClass('ifb-label-placement-left ifb-label-placement-above ifb-label-placement-inside');
			$('.ifb-element-wrap').addClass('ifb-label-placement-'+val);

			if (val == 'left') {
				$('.ifb-show-if-label-placement-left').show();
			} else {
				$('.ifb-show-if-label-placement-left').hide();
			}
		},

		setSaveToServer: function (element, checked) {
			if (checked) {
				$('.show-if-save-to-server', '#ifb-element-wrap-' + element.id).show();
			} else {
				$('.show-if-save-to-server', '#ifb-element-wrap-' + element.id).hide();
			}
		},

		addFilter: function (element, type) {
			var filter = {
				id: vowelsforminc.getNextFilterId(element),
				element_id: element.id,
				type: type
			};

			$.ajax({
				type: 'POST',
				async: false,
				url: ajaxurl,
				data: {
			       action: 'vowels_form_builder_get_filter',
			       filter: JSON.stringify(filter)
				},
				dataType: 'json',
				success: function (response) {
					if (response === null) {
						vowelsforminc.formatAddMessage(vowelsL10n.error_adding_filter, 'error', 10);
					} else if (typeof response === 'object') {
						if (response.type == 'success') {
							$(response.data.html).hide().appendTo($('#ifb-filters-'+element.id)).fadeIn('slow');

							filter = response.data.filter;

							element.filters.push(filter);

							if (element.filters.length > 0) {
								$('#ifb-filters-empty-'+element.id).hide();
							}
						} else if (response.type == 'error') {
							if (response.message) {
								vowelsforminc.addResponseMessage(response.message);
							}
						}
					}
				},
				error: function () {
					vowelsforminc.formatAddMessage(vowelsL10n.error_adding_filter, 'error', 10, 'Ajax request failed');
				}
			});
		},

		getNextFilterId: function (element) {
			var id = 0;

			if (element.filters.length > 0) {
				for (var i = 0; i < element.filters.length; i++) {
					id = Math.max(id, element.filters[i].id);
				}
			}

			return id + 1;
		},

		showFilterSettings: function (elementId, filterId) {
			var $filterWrap = $('#ifb-filter-wrap-'+elementId+'-'+filterId);

			if ($filterWrap.size()) {
				$filterWrap.find('.ifb-filter-settings').slideDown();
				$filterWrap.find('.ifb-filter-settings-link').hide();
				$filterWrap.find('.ifb-filter-close-link').show();
				$filterWrap.addClass('ifb-filter-settings-open');
			}
		},

		hideFilterSettings: function (elementId, filterId) {
			var $filterWrap = $('#ifb-filter-wrap-'+elementId+'-'+filterId);

			if ($filterWrap.size()) {
				$filterWrap.find('.ifb-filter-settings').slideUp();
				$filterWrap.find('.ifb-filter-close-link').hide();
				$filterWrap.find('.ifb-filter-settings-link').show();
				$filterWrap.removeClass('ifb-filter-settings-open');
			}
		},

		updateFilters: function (element) {
			for (var i = 0; i < element.filters.length; i++) {
				var filter = element.filters[i];

				switch (filter.type) {
					case 'alpha':
					case 'alphaNumeric':
					case 'digits':
						filter.allow_white_space = $('#f_allow_white_space_'+filter.element_id+'_'+filter.id).is(':checked');
						break;
					case 'stripTags':
						filter.allowable_tags = $('#f_allowable_tags_'+filter.element_id+'_'+filter.id).val();
						break;
					case 'regex':
						filter.pattern = $('#f_pattern_'+filter.element_id+'_'+filter.id).val();
						break;
				}
			}
		},

		deleteFilter: function (element, filterId) {
			for (var i = 0; i < element.filters.length; i++) {
				if (element.filters[i].id == filterId) {
					element.filters.splice(i, 1);
				}
			}

			$('#ifb-filter-wrap-' + element.id + '-' + filterId).hide(0, function() {
				$(this).remove();

				if (element.filters.length === 0) {
					$('#ifb-filters-empty-' + element.id).fadeIn();
				}
			});
		},

		addValidator: function (element, type) {
			var validator = {
				id: vowelsforminc.getNextValidatorId(element),
				element_id: element.id,
				type: type
			};

			$.ajax({
				type: 'POST',
				async: false,
				url: ajaxurl,
				data: {
			       action: 'vowels_form_builder_get_validator',
			       validator: JSON.stringify(validator)
				},
				dataType: 'json',
				success: function (response) {
					if (response === null) {
						vowelsforminc.formatAddMessage(vowelsL10n.error_adding_validator, 'error', 10);
					} else if (typeof response === 'object') {
						if (response.type == 'success') {
							$(response.data.html).hide().appendTo($('#ifb-validators-'+element.id)).fadeIn('slow');

							validator = response.data.validator;

							element.validators.push(validator);

							if (element.validators.length > 0) {
								$('#ifb-validators-empty-'+element.id).hide();
							}
						} else if (response.type == 'error') {
							if (response.message) {
								vowelsforminc.addResponseMessage(response.message);
							}
						}
					}
				},
				error: function () {
					vowelsforminc.formatAddMessage(vowelsL10n.error_adding_validator, 'error', 10, 'Ajax request failed.');
				}
			});
		},

		getNextValidatorId: function (element) {
			var id = 0;

			if (element.validators.length > 0) {
				for (var i = 0; i < element.validators.length; i++) {
					id = Math.max(id, element.validators[i].id);
				}
			}

			return id + 1;
		},

		showValidatorSettings: function (elementId, validatorId) {
			var $validatorWrap = $('#ifb-validator-wrap-'+elementId+'-'+validatorId);

			if ($validatorWrap.size()) {
				$validatorWrap.find('.ifb-validator-settings').slideDown();
				$validatorWrap.find('.ifb-validator-settings-link').hide();
				$validatorWrap.find('.ifb-validator-close-link').show();
				$validatorWrap.addClass('ifb-validator-settings-open');
			}
		},

		hideValidatorSettings: function (elementId, validatorId) {
			var $validatorWrap = $('#ifb-validator-wrap-'+elementId+'-'+validatorId);

			if ($validatorWrap.size()) {
				$validatorWrap.find('.ifb-validator-settings').slideUp();
				$validatorWrap.find('.ifb-validator-close-link').hide();
				$validatorWrap.find('.ifb-validator-settings-link').show();
				$validatorWrap.removeClass('ifb-validator-settings-open');
			}
		},

		updateValidators: function (element) {
			for (var i = 0; i < element.validators.length; i++) {
				var validator = element.validators[i];
				switch (validator.type) {
					case 'alpha':
					case 'alphaNumeric':
					case 'digits':
						validator.allow_white_space = $('#v_allow_white_space_'+validator.element_id+'_'+validator.id).is(':checked');
						validator.messages.invalid = $('#v_invalid_'+validator.element_id+'_'+validator.id).val();
						break;
					case 'email':
						validator.messages.invalid = $('#v_invalid_'+validator.element_id+'_'+validator.id).val();
						break;
					case 'greaterThan':
						validator.min = $('#v_min_'+validator.element_id+'_'+validator.id).val();
						validator.messages.not_greater_than = $('#v_not_greater_than_'+validator.element_id+'_'+validator.id).val();
						break;
					case 'identical':
						validator.token = $('#v_token_'+validator.element_id+'_'+validator.id).val();
						validator.messages.not_match = $('#v_not_match_'+validator.element_id+'_'+validator.id).val();
						break;
					case 'lessThan':
						validator.max = $('#v_max_'+validator.element_id+'_'+validator.id).val();
						validator.messages.not_less_than = $('#v_not_less_than_'+validator.element_id+'_'+validator.id).val();
						break;
					case 'length':
						validator.min = $('#v_min_'+validator.element_id+'_'+validator.id).val();
						validator.max = $('#v_max_'+validator.element_id+'_'+validator.id).val();
						validator.messages.too_short = $('#v_too_short_'+validator.element_id+'_'+validator.id).val();
						validator.messages.too_long = $('#v_too_long_'+validator.element_id+'_'+validator.id).val();
						break;
					case 'regex':
						validator.pattern = $('#v_pattern_'+validator.element_id+'_'+validator.id).val();
						validator.messages.invalid = $('#v_invalid_'+validator.element_id+'_'+validator.id).val();
						break;
				}
			}
		},

		deleteValidator: function (element, validatorId) {
			for (var i = 0; i < element.validators.length; i++) {
				if (element.validators[i].id == validatorId) {
					element.validators.splice(i, 1);
				}
			}

			$('#ifb-validator-wrap-' + element.id + '-' + validatorId).hide(0, function() {
				$(this).remove();

				if (element.validators.length === 0) {
					$('#ifb-validators-empty-' + element.id).fadeIn();
				}
			});
		},

		addStyle: function (element, type) {
			var style = {
				id: vowelsforminc.getNextStyleId(element),
				element_id: element.id,
				type: type
			};

			$.ajax({
				type: 'POST',
				async: false,
				url: ajaxurl,
				data: {
			       action: 'vowels_form_builder_get_style',
			       style: JSON.stringify(style)
				},
				dataType: 'json',
				success: function (response) {
					if (response === null) {
						vowelsforminc.formatAddMessage(vowelsL10n.error_adding_style, 'error', 10);
					} else if (typeof response === 'object') {
						if (response.type == 'success') {
							$(response.data.html).hide().appendTo($('#ifb-styles-'+element.id)).fadeIn('slow');

							style = response.data.style;

							element.styles.push(style);

							if (element.styles.length > 0) {
								$('#ifb-styles-empty-'+element.id).hide();
							}
						} else if (response.type == 'error') {
							if (response.message) {
								vowelsforminc.addResponseMessage(response.message);
							}
						}
					}
				},
				error: function () {
					vowelsforminc.formatAddMessage(vowelsL10n.error_adding_style, 'error', 10, 'Ajax request failed.');
				}
			});
		},

		getNextStyleId: function (element) {
			var id = 0;

			if (element.styles.length > 0) {
				for (var i = 0; i < element.styles.length; i++) {
					id = Math.max(id, element.styles[i].id);
				}
			}

			return id + 1;
		},

		showStyleSettings: function (elementId, styleId) {
			var $styleWrap = $('#ifb-style-wrap-'+elementId+'-'+styleId);

			if ($styleWrap.size()) {
				$styleWrap.find('.ifb-style-settings').slideDown();
				$styleWrap.find('.ifb-style-settings-link').hide();
				$styleWrap.find('.ifb-style-close-link').show();
				$styleWrap.addClass('ifb-style-settings-open');
			}
		},

		hideStyleSettings: function (elementId, styleId) {
			var $styleWrap = $('#ifb-style-wrap-'+elementId+'-'+styleId);

			if ($styleWrap.size()) {
				$styleWrap.find('.ifb-style-settings').slideUp();
				$styleWrap.find('.ifb-style-close-link').hide();
				$styleWrap.find('.ifb-style-settings-link').show();
				$styleWrap.removeClass('ifb-style-settings-open');
			}
		},

		updateStyles: function (element) {
			for (var i = 0; i < element.styles.length; i++) {
				var style = element.styles[i];
				style.css = $('#s_css_' + style.element_id + '_' + style.id).val();
			}
		},

		deleteStyle: function (element, styleId) {
			for (var i = 0; i < element.styles.length; i++) {
				if (element.styles[i].id == styleId) {
					element.styles.splice(i, 1);
				}
			}

			$('#ifb-style-wrap-' + element.id + '-' + styleId).hide(0, function() {
				$(this).remove();

				if (element.styles.length === 0) {
					$('#ifb-styles-empty-' + element.id).fadeIn();
				}
			});
		},

		addGlobalStyle: function (type) {
			if (type == 'date') {
				vowelsforminc.addGlobalStyle('dateDay');
				vowelsforminc.addGlobalStyle('dateMonth');
				vowelsforminc.addGlobalStyle('dateYear');
				return;
			} else if (type == 'time') {
				vowelsforminc.addGlobalStyle('timeHour');
				vowelsforminc.addGlobalStyle('timeMinute');
				vowelsforminc.addGlobalStyle('timeAmPm');
				return;
			}

			var style = {
				id: vowelsforminc.getNextGlobalStyleId(),
				type: type
			};

			$.ajax({
				type: 'POST',
				async: false,
				url: ajaxurl,
				data: {
			       action: 'vowels_form_builder_get_global_style',
			       style: JSON.stringify(style)
				},
				dataType: 'json',
				success: function (response) {
					if (response === null) {
						vowelsforminc.formatAddMessage(vowelsL10n.error_adding_style, 'error', 10);
					} else if (typeof response === 'object') {
						if (response.type == 'success') {
							$(response.data.html).hide().appendTo($('#ifb-global-styles')).fadeIn('slow');

							style = response.data.style;

							vowelsforminc.form.styles.push(style);

							if (vowelsforminc.form.styles.length > 0) {
								$('.ifb-global-styles-empty').hide();
							}
						} else if (response.type == 'error') {
							if (response.message) {
								vowelsforminc.addResponseMessage(response.message);
							}
						}
					}
				},
				error: function () {
					vowelsforminc.formatAddMessage(vowelsL10n.error_adding_style, 'error', 10, 'Ajax request failed.');
				}
			});
		},

		getNextGlobalStyleId: function () {
			var id = 0;

			if (vowelsforminc.form.styles.length > 0) {
				for (var i = 0; i < vowelsforminc.form.styles.length; i++) {
					id = Math.max(id, vowelsforminc.form.styles[i].id);
				}
			}

			return id + 1;
		},

		showGlobalStyleSettings: function (styleId) {
			var $styleWrap = $('#ifb-global-style-wrap-' + styleId);

			if ($styleWrap.size()) {
				$styleWrap.find('.ifb-style-settings').slideDown();
				$styleWrap.find('.ifb-style-settings-link').hide();
				$styleWrap.find('.ifb-style-close-link').show();
				$styleWrap.addClass('ifb-style-settings-open');
			}
		},

		hideGlobalStyleSettings: function (styleId) {
			var $styleWrap = $('#ifb-global-style-wrap-' + styleId);

			if ($styleWrap.size()) {
				$styleWrap.find('.ifb-style-settings').slideUp();
				$styleWrap.find('.ifb-style-close-link').hide();
				$styleWrap.find('.ifb-style-settings-link').show();
				$styleWrap.removeClass('ifb-style-settings-open');
			}
		},

		updateGlobalStyles: function () {
			for (var i = 0; i < vowelsforminc.form.styles.length; i++) {
				var style = vowelsforminc.form.styles[i];
				style.css = $('#s_css_' + style.id).val();
			}
		},

		deleteGlobalStyle: function (styleId) {
			for (var i = 0; i < vowelsforminc.form.styles.length; i++) {
				if (vowelsforminc.form.styles[i].id == styleId) {
					vowelsforminc.form.styles.splice(i, 1);
				}
			}

			$('#ifb-global-style-wrap-' + styleId).hide(0, function() {
				$(this).remove();

				if (vowelsforminc.form.styles.length === 0) {
					$('.ifb-global-styles-empty').fadeIn();
				}
			});
		},

		updateCaptchaOptions: function (element) {
			element.options.length = $('#length_' + element.id).val();
			element.options.width = $('#width_' + element.id).val();
			element.options.height = $('#height_' + element.id).val();
			element.options.bgColour = $('#bg_colour_' + element.id).val();
			element.options.textColour = $('#text_colour_' + element.id).val();
			element.options.font = $('#font_' + element.id).val();
			element.options.minFontSize = $('#min_font_size_' + element.id).val();
			element.options.maxFontSize = $('#max_font_size_' + element.id).val();
			element.options.minAngle = $('#min_angle_' + element.id).val();
			element.options.maxAngle = $('#max_angle_' + element.id).val();
		},

		refreshCaptchaPreview: function (element) {
			this.updateCaptchaOptions(element);
			var config = btoa(JSON.stringify({uniqId: 1, tmpDir: vowelsL10n.tmp_dir, preview: 1, options: element.options}));
			var time = new Date().getTime();
			var width = $.isNumeric(element.options.width) ? element.options.width : 115;
			var height = $.isNumeric(element.options.height) ? element.options.height : 40;

			$('#ifb_captcha_'+element.id).attr('src', vowelsL10n.captcha_url + '?c=' + config + '&t=' + time).width(width).height(height);
		},

		toggleTooltipSettings: function (checked) {
			if (checked) {
				$('.show-if-tooltips-enabled').show();
			} else {
				$('.show-if-tooltips-enabled').hide();
			}
		},

		addRecipientField: function (element) {
			$(element).parent().after('<li><input name="ifb_recipient_email" type="text" /> <span class="ifb-small-add-button" onclick="vowelsforminc.addRecipientField(this); return false;">+</span> <span class="ifb-small-delete-button" onclick="vowelsforminc.removeRecipientField(this); return false;">x</span></li>');
		},

		removeRecipientField: function (element) {
			var $recipientList = $(element).parent().parent();
			if ($recipientList.children().size() > 1) {
				$(element).parent().remove();
			}
		},

		toggleAllowMultipleUploads: function (element) {
			if ($('#allow_multiple_uploads_' + element.id).is(':checked')) {
				$('.show-if-allow-multiple-uploads', '#ifb-element-wrap-' + element.id).show();
				if ($('#upload_user_add_more_' + element.id).is(':checked')) {
					$('.show-if-upload-user-add-more', '#ifb-element-wrap-' + element.id).show();
				}
			} else {
				$('.show-if-allow-multiple-uploads', '#ifb-element-wrap-' + element.id).hide();
				$('.show-if-upload-user-add-more', '#ifb-element-wrap-' + element.id).hide();
			}
		},

		setMailTransport: function (select) {
			if ($(select).val() == 'smtp') {
				$('.ifb-show-if-smtp-on').show();
			} else {
				$('.ifb-show-if-smtp-on').hide();
			}
		},

		setSendNotification: function () {
			var checked = $('#send_notification').is(':checked');
			if (checked) {
				this.form.send_notification = true;
				$('.ifb-show-if-send-notification-on').show();
				vowelsforminc.toggleCustomiseEmailContent();
			} else {
				this.form.send_notification = false;
				$('.ifb-show-if-send-notification-on').hide();
			}
		},

		setSendAutoreply: function (checked) {
			if (checked) {
				this.form.send_autoreply = true;
				$('.ifb-show-if-send-autoreply-on').show();
			} else {
				this.form.send_autoreply = false;
				$('.ifb-show-if-send-autoreply-on').hide();
			}
		},

		insertAtCursor: function(field, value) {
	        //IE support
	        if (document.selection)
	        {
	            field.focus();
	            sel = document.selection.createRange();
	            sel.text = value;
	        }

	        //Mozilla/Firefox/Netscape 7+ support
	        else if (field.selectionStart || field.selectionStart == '0')
	        {
	            var startPos = field.selectionStart;
	            var endPos = field.selectionEnd;
	            field.value = field.value.substring(0, startPos)+ value + field.value.substring(endPos, field.value.length);
	        }

	        else
	        {
	            field.value += value;
	        }
	    },

	    insertVariable: function(selector, select) {
	    	var val = $(select).val();
	    	if (val.length) {
	    		this.insertAtCursor($(selector)[0], val);
	    		$(selector).focus();
	    		$(select).val('');
	    	}
	    },

	    updateSettingsDependencies: function () {
	    	var $selects = $('.ifb-insert-variable').empty().append($('<option/>', { value: '', text: vowelsL10n.insert_variable })),

	    	$autoreplyRecipient = $('#autoreply_recipient_element'),
	    	$notificationReplyTo = $('#notification_reply_to_element'),
	    	$notificationFrom = $('#notification_from_element'),
	    	$autoreplyFrom = $('#autoreply_from_element'),

	    	selectedAutoreplyRecipient = $autoreplyRecipient.val(),
	    	selectedNotificationReplyToElement = $notificationReplyTo.val(),
	    	selectedNotificationFromElement = $notificationFrom.val(),
	    	selectedAutoreplyFromElement = $autoreplyFrom.val(),

	    	$allEmailDependents = $autoreplyRecipient.add($notificationReplyTo).add($notificationFrom).add($autoreplyFrom);
	    	$allEmailDependents.empty();

	    	if (vowelsforminc.form.elements.length > 0) {
		    	var $elementOpts = $('<optgroup label="' + vowelsL10n.submitted_form_value + '"/>');
		    	for (var i = 0; i < vowelsforminc.form.elements.length; i++) {
		    		var element = vowelsforminc.form.elements[i];

		    		if (element.type != 'html' && element.type != 'groupstart' && element.type != 'groupend') {
		    			$elementOpts.append($('<option/>', {value: '{' + vowelsforminc.getShortenedAdminLabel(element) + '|' + element.id + '}', text: vowelsforminc.getShortenedAdminLabel(element)}));
					}

		    		if (element.type == 'email') {
		    			$allEmailDependents.append($('<option/>', {value: element.id, text: vowelsforminc.getShortenedAdminLabel(element)}));
		    		}
		    	}

		    	if ($elementOpts.length > 0) {
		    		$selects.append($elementOpts);
		    	}
	    	}

	    	$selects.append($('<option/>', { value: '{ip}', text: vowelsL10n.user_ip_address }))
			.append($('<option/>', { value: '{user_agent}', text: vowelsL10n.user_agent }))
			.append($('<option/>', { value: '{url}', text: vowelsL10n.form_url }))
			.append($('<option/>', { value: '{referring_url}', text: vowelsL10n.referring_url }))
			.append($('<option/>', { value: '{user_display_name}', text: vowelsL10n.user_display_name }))
			.append($('<option/>', { value: '{user_email}', text: vowelsL10n.user_email }))
			.append($('<option/>', { value: '{user_login}', text: vowelsL10n.user_login }))
			.append($('<option/>', { value: '{post_id}', text: vowelsL10n.form_post_page_id }))
			.append($('<option/>', { value: '{post_title}', text: vowelsL10n.form_post_page_title }))
	    	.append($('<option/>', { value: '{entry_id}', text: vowelsL10n.entry_id }));

    		var $dateOpts = $('<optgroup label="' + vowelsL10n.date_select_format + '"/>');
	    	for (var j in vowelsL10n.date_formats) {
	    		$dateOpts.append($('<option/>', { value: '{submit_date|' + j + '}', text: vowelsL10n.date_formats[j] }));
	    	}

	    	if ($dateOpts.length > 0) {
	    		$selects.append($dateOpts);
	    	}

    		var $timeOpts = $('<optgroup label="' + vowelsL10n.time_select_format + '"/>');
	    	for (var k in vowelsL10n.time_formats) {
	    		$timeOpts.append($('<option/>', { value: '{submit_time|' + k + '}', text: vowelsL10n.time_formats[k] }));
	    	}

	    	if ($timeOpts.length > 0) {
	    		$selects.append($timeOpts);
	    	}

	    	if ($autoreplyRecipient.children('option').size() === 0) {
	    		$('.ifb-show-if-email-element').hide();
	    		$('.ifb-show-if-no-email-element').show();
	    	} else {
	    		$('.ifb-show-if-no-email-element').hide();
	    		$('.ifb-show-if-email-element').show();

	    		if (selectedAutoreplyRecipient === null) {
	    			$autoreplyRecipient[0].selectedIndex = 0;
	    		} else {
	    			$autoreplyRecipient.val(selectedAutoreplyRecipient);
	    		}

	    		if (selectedNotificationReplyToElement === null) {
	    			$notificationReplyTo[0].selectedIndex = 0;
	    		} else {
	    			$notificationReplyTo.val(selectedNotificationReplyToElement);
	    		}

	    		if (selectedNotificationFromElement === null) {
	    			$notificationFrom[0].selectedIndex = 0;
	    		} else {
	    			$notificationFrom.val(selectedNotificationFromElement);
	    		}

	    		if (selectedAutoreplyFromElement === null) {
	    			$autoreplyFrom[0].selectedIndex = 0;
	    		} else {
	    			$autoreplyFrom.val(selectedAutoreplyFromElement);
	    		}
	    	}

	    	var multiElements = this.getMultiElements();
	    	if (multiElements.length > 0) {
	    		$('#ifb-add-conditional-recipient-button').show();
	    		$('#ifb-conditional-no-valid-elements').hide();
	    	} else {
	    		$('#ifb-add-conditional-recipient-button').hide();
	    		$('#ifb-conditional-no-valid-elements').show();
	    	}
	    },

	    getNextConditionalRecipientId: function () {
	    	var id = 0;

			if (this.form.conditional_recipients.length > 0) {
				for (var i = 0; i < this.form.conditional_recipients.length; i++) {
					id = Math.max(id, this.form.conditional_recipients[i].id);
				}
			}

			return id + 1;
	    },

	    addConditionalRecipient: function (existingConditionalRecipient) {
	    	$('#ifb-conditional-recipient-list-wrap').show();
	    	var multiElements = this.getMultiElements();
	    	var existing = typeof existingConditionalRecipient === 'object' ? true : false;

	    	var conditionalRecipient = existingConditionalRecipient || {
	    		id: this.getNextConditionalRecipientId(),
	    		recipient: 'email@example.com',
	    		element: multiElements[0].id,
	    		operator: 'eq',
	    		value: multiElements[0].options[0].value // The first option of the first multi-element
	    	};

	    	var $recipientLabel = $('<label>' + vowelsL10n.send_to_email + '</label>');
	    	var $recipientElement = $('<input class="ifb-conditional-recipient" type="text"/>').val(conditionalRecipient.recipient);
	    	var $if = $('<span>' + vowelsL10n.conditional_if + '</span>');
	    	var $elementSelect = $('<select/>', { onchange: 'vowelsforminc.updateConditionalElementValues(this, '+conditionalRecipient.id+');' }).addClass('ifb-conditional-element');
	    	for (var i = 0; i < multiElements.length; i++) {
	    		var multiElement = multiElements[i];
	    		$elementSelect.append($('<option/>', { value: multiElement.id, text: vowelsforminc.getShortenedAdminLabel(multiElement) }));
	    	}
	    	$elementSelect.val(conditionalRecipient.element);

	    	var $operatorSelect = $('<select/>').addClass('ifb-conditional-operator').append($('<option/>', { value: 'eq', text: vowelsL10n.is_equal_to })).append($('<option/>', { value: 'neq', text: vowelsL10n.is_not_equal_to })).val(conditionalRecipient.operator);

	    	var selectedElement = this.getElementById(conditionalRecipient.element);
	    	var $elementValues = $('<select/>').addClass('ifb-conditional-value');

	    	for (var j = 0; j < selectedElement.options.length; j++) {
	    		var option = selectedElement.options[j];
	    		$elementValues.append($('<option/>', { value: option.value, text: option.label }));
	    	}
	    	$elementValues.val(conditionalRecipient.value);

	    	var $deleteLink = $('<span class="ifb-small-delete-button" onclick="vowelsforminc.deleteConditionalRecipient('+conditionalRecipient.id+');">X</span>');

	    	$ruleLi = $('<li/>', { id: 'ifb-conditional-rule-' + conditionalRecipient.id }).append(
    			$recipientLabel,
    			$recipientElement,
    			$if,
    			$elementSelect,
    			$operatorSelect,
    			$elementValues,
    			$deleteLink
	    	).data('id', conditionalRecipient.id);

	    	$('#ifb-conditional-recipient-list').append($ruleLi);

	    	if (!existing) {
	    		this.form.conditional_recipients.push(conditionalRecipient);
	    	}
	    },

	    deleteConditionalRecipient: function (id) {
	    	for (var i = 0; i < this.form.conditional_recipients.length; i++) {
				if (this.form.conditional_recipients[i].id == id) {
					this.form.conditional_recipients.splice(i, 1);
				}
			}

	    	$('#ifb-conditional-rule-' + id).hide(0, function () {
	    		$(this).remove();
	    		if ($('#ifb-conditional-recipient-list > li').length === 0) {
		    		$('#ifb-conditional-recipient-list-wrap').hide();
		    	}
	    	});
	    },

	    updateConditionalElementValues: function (select, ruleId) {
	    	var $ruleLi = $('#ifb-conditional-rule-' + ruleId);
    		var element = this.getElementById($ruleLi.find('.ifb-conditional-element').val());
    		if (element !== null) {
    			var $valuesSelect = $ruleLi.find('.ifb-conditional-value');
    			$valuesSelect.empty();
    			for (var i = 0; i < element.options.length; i++) {
    				var option = element.options[i];
    				$valuesSelect.append($('<option/>', { value: option.value, text: option.value }));
    			}
    		}
	    },

	    /**
	     * Returns all elements of type radio or select
	     *
	     * @return array
	     */
	    getMultiElements: function () {
	    	var multiElements = [];

	    	for (var i = 0; i < this.form.elements.length; i++) {
	    		var element = this.form.elements[i];
	    		if (element.type == 'radio' || element.type == 'select') {
	    			multiElements.push(element);
	    		}
	    	}

	    	return multiElements;
	    },

	    updateSuccessRedirectType: function () {
	    	var val = $('#success_redirect_type').val();

	    	if (!val.length) {
	    		$('#success_redirect_page').hide();
	    		$('#success_redirect_post').hide();
	    		$('#success_redirect_url').hide();
	    	} else if (val == 'page') {
	    		$('#success_redirect_page').show();
	    		$('#success_redirect_post').hide();
	    		$('#success_redirect_url').hide();
	    	} else if (val == 'post') {
	    		$('#success_redirect_page').hide();
	    		$('#success_redirect_post').show();
	    		$('#success_redirect_url').hide();
	    	} else if (val == 'url') {
	    		$('#success_redirect_page').hide();
	    		$('#success_redirect_post').hide();
	    		$('#success_redirect_url').show();
	    	}
	    },

	    updateStartYear: function (input, element) {
	    	var val = $(input).val();

	    	$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
			       action: 'vowels_form_builder_get_start_year_ajax',
			       year: val
				},
				dataType: 'json',
				success: function (response) {
					if (response.type == 'success') {
						element.start_date = response.data;
						vowelsforminc.updateDatePreview(element);
						vowelsforminc.updateDateDefaultYear(element);
					}
				}
			});
	    },

	    updateEndYear: function (input, element) {
    		var val = $(input).val();

	    	$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
			       action: 'vowels_form_builder_get_end_year_ajax',
			       year: val
				},
				dataType: 'json',
				success: function (response) {
					if (response.type == 'success') {
						element.end_date = response.data;
						vowelsforminc.updateDatePreview(element);
						vowelsforminc.updateDateDefault(element);
					}
				}
			});
	    },

	    updateDatePreview: function (element) {
	    	$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
			       action: 'vowels_form_builder_get_date_years_ajax',
			       start_year: $('#start_year_'+element.id).val(),
			       end_year: $('#end_year_'+element.id).val()
				},
				dataType: 'json',
				success: function (response) {
					if (response.type == 'success') {
						// Save the current selected default date values
				    	var defaultDay = $('#default_value_' + element.id + '_day').val(),
					    	defaultMonth = $('#default_value_' + element.id + '_month').val(),
					    	defaultYear = $('#default_value_' + element.id + '_year').val(),
							// Empty the drop downs
					    	$day = $('#ifb_element_' + element.id + '_day').empty(),
					    	$month = $('#ifb_element_' + element.id + '_month').empty(),
					    	$year = $('#ifb_element_' + element.id + '_year').empty(),
					    	$defaultDay = $('#default_value_' + element.id + '_day').empty(),
					    	$defaultMonth = $('#default_value_' + element.id + '_month').empty(),
					    	$defaultYear = $('#default_value_' + element.id + '_year').empty(),
					    	days = [],
					    	months = [],
					    	years = [],
					    	defaultDays = [],
					    	defaultMonths = [],
					    	defaultYears = [];

				    	// Add headings if they are set
				    	if (element.show_date_headings) {
				    		var dayHeading = $('#day_heading_' + element.id).val() || vowelsL10n.day,
					    		monthHeading = $('#month_heading_' + element.id).val() || vowelsL10n.month,
					    		yearHeading = $('#year_heading_' + element.id).val() || vowelsL10n.year;

				    		days.push(new Option(dayHeading, '', false, defaultDay === ''));
				    		defaultDays.push(new Option(dayHeading, '', false, defaultDay === ''));
				    		months.push(new Option(monthHeading, '', false, defaultMonth === ''));
				    		defaultMonths.push(new Option(monthHeading, '', false, defaultMonth === ''));
				    		years.push(new Option(yearHeading, '', false, defaultYear === ''));
				    		defaultYears.push(new Option(yearHeading, '', false, defaultYear === ''));
				    	}

				    	// Add the days
				    	for (var i = 1; i <= 31; i++) {
				    		days.push(new Option(i, i, false, defaultDay == i));
				    		defaultDays.push(new Option(i, i, false, defaultDay == i));
				    	}
				    	$day.html(days);
				    	$defaultDay.html(defaultDays);

				    	// Add the months
				    	for (var j = 1; j <= 12; j++) {
				    		var monthText = vowelsL10n.months[j],
				    			monthTranslation = $('#month_translation_' + j + '_' + element.id).val();

				    		if ($('#months_as_numbers_' + element.id).is(':checked')) {
				    			monthText = j;
				    		} else if (typeof monthTranslation == 'string' && monthTranslation.length) {
				    			monthText = monthTranslation;
				    		}

				    		months.push(new Option(monthText, j, false, defaultMonth == j));
				    		defaultMonths.push(new Option(monthText, j, false, defaultMonth == j));
				    	}
				    	$month.html(months);
				    	$defaultMonth.html(defaultMonths);

				    	// Add the years
				    	var sy = response.data.start_year, ey = response.data.end_year;
				    	if (sy > ey) {
					    	for (var k = sy; k >= ey; k--) {
					    		years.push(new Option(k, k, false, defaultYear == k));
					    		defaultYears.push(new Option(k, k, false, defaultYear == k));
					    	}
				    	} else {
				    		for (var l = sy; l <= ey; l++) {
					    		years.push(new Option(l, l, false, defaultYear == l));
					    		defaultYears.push(new Option(l, l, false, defaultYear == l));
					    	}
				    	}
				    	$year.html(years);
				    	$defaultYear.html(defaultYears);

				    	// Check if we need to swap day and month
				    	if ($('#field_order_' + element.id).val() != 'us') {
				    		$day.after($month);
				    		$defaultDay.after($defaultMonth);
				    	} else {
				    		$month.after($day);
				    		$defaultMonth.after($defaultDay);
				    	}
					}
				}
			});
	    },

	    updateDefaultDate: function (element) {
	    	$('#ifb_element_' + element.id + '_day').val($('#default_value_' + element.id + '_day').val());
	    	$('#ifb_element_' + element.id + '_month').val($('#default_value_' + element.id + '_month').val());
	    	$('#ifb_element_' + element.id + '_year').val($('#default_value_' + element.id + '_year').val());
	    },

	    showDateHeadings: function (checked, element) {
	    	if (checked) {
	    		element.show_date_headings = true;
	    	} else {
	    		element.show_date_headings = false;
	    	}

	    	vowelsforminc.updateDatePreview(element);
	    },

	    monthsAsNumbers: function (checked, element) {
	    	if (checked) {
	    		element.months_as_numbers = true;
	    	} else {
	    		element.months_as_numbers = false;
	    	}

	    	vowelsforminc.updateDatePreview(element);
	    },

	    updateTimePreview: function (element) {
	    	var $defaultHour = $('#default_value_' + element.id + '_hour'),
		    	$defaultMinute = $('#default_value_' + element.id + '_minute'),
		    	$defaultAmpm = $('#default_value_' + element.id + '_ampm');

	    	var defaultHour = $defaultHour.val(),
		    	defaultMinute = $defaultMinute.val(),
		    	defaultAmpm = $defaultAmpm.val();

	    	var $hour = $('#ifb_element_' + element.id + '_hour').empty(),
		    	$minute = $('#ifb_element_' + element.id + '_minute').empty(),
		    	$ampm = $('#ifb_element_' + element.id + '_ampm').empty();

	    	$defaultHour.empty();
	    	$defaultMinute.empty();
	    	$defaultAmpm.empty();

	    	var is24hr = $('#time_12_24_' + element.id).val() == '24',
	    		hours = [],
	    		minutes = [],
	    		ampms = [],
	    		defaultHours = [],
	    		defaultMinutes = [],
	    		defaultAmpms = [];

    		if ($('#show_time_headings_' + element.id).is(':checked')) {
    			var hhString = $('#hh_string_' + element.id).val() || vowelsL10n.hh_string,
		    		mmString = $('#mm_string_' + element.id).val() || vowelsL10n.mm_string,
		    		ampmString = $('#ampm_string_' + element.id).val() || vowelsL10n.ampm_string;

	    		hours.push(new Option(hhString, '', false, defaultHour === ''));
	    		defaultHours.push(new Option(hhString, '', false, defaultHour === ''));
				minutes.push(new Option(mmString, '', false, defaultMinute === ''));
				defaultMinutes.push(new Option(mmString, '', false, defaultMinute === ''));
				ampms.push(new Option(ampmString, '', false, defaultAmpm === ''));
				defaultAmpms.push(new Option(ampmString, '', false, defaultAmpm === ''));
    		}

	    	// Add the hours
	    	var customSh = $('#start_hour_' + element.id).val(),
	    		customEh = $('#end_hour_' + element.id).val(),
	    		sh, eh, value;

    		if ($.isNumeric(customSh)) {
    			sh = parseInt(customSh, 10);
    		} else {
    			sh = is24hr ? 0 : 1;
    		}

    		if ($.isNumeric(customEh)) {
    			eh = parseInt(customEh, 10);
    		} else {
    			eh = is24hr ? 23 : 12;
    		}

    		if (sh > eh) {
		    	for (var i = sh; i >= eh; i--) {
		    		value = i < 10 ? '0'+i : ''+i;
					hours.push(new Option(value, value, false, defaultHour === value));
	    			defaultHours.push(new Option(value, value, false, defaultHour === value));
		    	}
	    	} else {
	    		for (var j = sh; j <= eh; j++) {
		    		value = j < 10 ? '0'+j : ''+j;
	    			hours.push(new Option(value, value, false, defaultHour === value));
	    			defaultHours.push(new Option(value, value, false, defaultHour === value));
		    	}
	    	}

	    	$hour.html(hours);
	    	$defaultHour.html(defaultHours);

	    	var minuteGranularity = $('#minute_granularity_' + element.id).val();
	    	// Add the minutes
	    	for (var k = 0; k <= 59; k++) {
	    		if (k % minuteGranularity === 0) {
	    			value = k < 10 ? '0'+k : ''+k;
	    			minutes.push(new Option(value, value, false, defaultMinute === value));
	    			defaultMinutes.push(new Option(value, value, false, defaultMinute === value));
	    		}
	    	}
	    	$minute.html(minutes);
	    	$defaultMinute.html(defaultMinutes);

	    	var amString = $('#am_string_' + element.id).val() || vowelsL10n.am_string,
	    		pmString = $('#pm_string_' + element.id).val() || vowelsL10n.pm_string;

	    	ampms.push(new Option(amString, 'am', false, defaultAmpm === 'am'));
	    	defaultAmpms.push(new Option(amString, 'am', false, defaultAmpm === 'am'));
			ampms.push(new Option(pmString, 'pm', false, defaultAmpm === 'pm'));
			defaultAmpms.push(new Option(pmString, 'pm', false, defaultAmpm === 'pm'));

	    	if (is24hr) {
	    		$ampm.add($defaultAmpm).hide();
    		} else {
    			$ampm.add($defaultAmpm).show();
    		}

	    	// Add the AM/PM options
	    	$ampm.html(ampms);
	    	$defaultAmpm.html(defaultAmpms);
	    },

	    showTimeHeadings: function (checked, element) {
	    	if (checked) {
	    		element.show_time_headings = true;
	    	} else {
	    		element.show_time_headings = false;
	    	}

	    	vowelsforminc.updateTimePreview(element);
	    },

	    getAdminLabel: function (element) {
	    	if (typeof element.admin_label === 'string' && element.admin_label.length > 0) {
	    		return element.admin_label;
	    	}

	    	if (typeof element.label === 'string' && element.label.length > 0) {
	    		return element.label;
	    	}

	    	return '';
	    },

	    getShortenedAdminLabel: function (element) {
	    	return vowelsforminc.shorten(vowelsforminc.getAdminLabel(element));
	    },

	    shorten: function (text, maxLength, join) {
	    	if (!maxLength) maxLength = 20;
	    	if (!join) join = '...';

	    	var halfLength = Math.floor(maxLength / 2);

	    	if (text.length > maxLength) {
	    		var firstHalf = text.slice(0, halfLength - 1);
	    		var secondHalf = text.slice(-halfLength);
	    		text = firstHalf + join + secondHalf;
	    	}

	    	return text;
	    },

	    updateTooltipStyle: function () {
	    	var style = $('#tooltip_style').val();

	    	if (style == 'custom') {
	    		$('.show-if-tooltip-style-previewable').hide();
	    		$('.show-if-tooltip-style-custom').show();
	    	} else {
	    		var classes = [style];

	    		if ($('#tooltip_shadow').is(':checked')) {
	    			classes.push('qtip-shadow');
	    		}

	    		if ($('#tooltip_rounded').is(':checked')) {
	    			classes.push('qtip-rounded');
	    		}

	    		if ($.isFunction($.fn.qtip)) {
		    		$('#ifb-tooltip-example').qtip('destroy').qtip({
		    			content: vowelsL10n.example_tooltip,
		    			style: {
		    				classes: classes.join(' ')
		    			},
		    			position: {
		    				my: $('#tooltip_my').val(),
	    					at: $('#tooltip_at').val()
		    			}
		    		}).show();
		    	}

	    		$('#tooltip_custom').val('');
	    		$('.show-if-tooltip-style-previewable').show();
	    		$('.show-if-tooltip-style-custom').hide();
	    	}
	    },

	    sortElements: function() {
			var elements = [];

			$.each($elementsList.children(), function () {
				var id = $(this).attr('id').substring(17);
				elements.push(vowelsforminc.getElementById(id));
			});

			vowelsforminc.form.elements = elements;
	    },

	    addMessage: function(message, type, timeout) {
	    	if (typeof type === 'undefined') {
	    		type = 'success';
	    	}

	    	if (typeof timeout === 'undefined') {
	    		timeout = 0;
	    	}

	    	var $message = $('<div/>').addClass('ifb-message ifb-message-' + type).html(message);

    		var $close = $('<div/>').addClass('ifb-close-message').click(function () {
    			$message.fadeOut('slow').hide(0, function() {
    				$message.remove();
    			});
    		});
    		$message.prepend($close);

	    	$messageArea.empty().prepend($message);
	    	$message.hide().fadeIn('slow');

	    	if (timeout > 0) {
	    		setTimeout(function() {
	    			$message.fadeOut('slow').hide(0, function() {
	    				$message.remove();
	    			});
	    		}, (timeout*1000));
	    	}
	    },

	    addResponseMessage: function (responseMessage) {
	    	vowelsforminc.addMessage(responseMessage.content, responseMessage.type, responseMessage.timeout);
	    },

	    formatAddMessage: function (content, type, timeout, more) {
	    	if (typeof type === 'undefined') {
	    		type = 'success';
	    	}

	    	if (typeof timeout === 'undefined') {
	    		timeout = 5;
	    	}

	    	if (more && more.length > 0) {
	    		content += ' <a href="#" class="ifb-message-more">' + vowelsforminc.htmlEntities(vowelsL10n.more_information) + '</a>.';
	    		content += '<div class="ifb-hidden ifb-message-more-content">' + more + '</div>';
	    	}

	    	vowelsforminc.addMessage(content, type, timeout);
	    },

	    htmlEntities: function (str) {
	    	return $('<div/>').text(str).html();
	    },

	    scrollToElement: function (element) {
	    	vowelsforminc.showSettings(element.id);

	    	function pulseIn(callback) {
	    		$('#ifb-element-wrap-' + element.id + ' .ifb-element-preview').animate({
    				borderTopColor: '#C30000',
    				borderRightColor: '#C30000',
    				borderBottomColor: '#C30000',
    				borderLeftColor: '#C30000'
	    		}, 20, function () {
	    			if (typeof callback === 'function') {
	    				callback.apply(this);
	    			}
	    		});
	    	}

	    	function pulseOut(callback)
	    	{
	    		$('#ifb-element-wrap-' + element.id + ' .ifb-element-preview').animate({
	    			borderTopColor: '#919191',
    				borderRightColor: '#919191',
    				borderBottomColor: '#919191',
    				borderLeftColor: '#919191'
	    		}, 20, function () {
	    			if (typeof callback === 'function') {
	    				callback.apply(this);
	    			}
	    		});
	    	}

	    	$.smoothScroll({
				scrollTarget: $('#ifb-element-wrap-' + element.id),
				offset: -50,
				speed: 1000,
				afterScroll: function () {
	    			pulseIn(function () {
	    				pulseOut(function () {
	    					pulseIn(function () {
	    						pulseOut(function () {
	    							$(this).removeAttr('style');
	    						});
	    					});
	    				});
	    			});
		    	}
			});
	    },

	    updateFormTitle: function () {
	    	var val = $('#title').val();
	    	$('#ifb-title').html(val);

	    	if (val.length > 0) {
	    		$('#ifb-title').fadeIn('slow');
	    	} else {
	    		$('#ifb-title').hide();
	    	}
	    },

	    updateFormDescription: function () {
	    	var val = $('#description').val();
	    	$('#ifb-description').html(val);

	    	if (val.length > 0) {
	    		$('#ifb-description').fadeIn('slow');
	    	} else {
	    		$('#ifb-description').hide();
	    	}
	    },

	    savePreviewLabel: function (value, element) {
	    	$('#label_' + element.id).val(value);
	    	vowelsforminc.updateElementLabel(element);
	    },

	    maybeSelectOptionText: function (input) {
	    	var val = $(input).val();

	    	if (val == vowelsL10n.option_1 || val == vowelsL10n.option_2 || val == vowelsL10n.option_3) {
	    		$(input).select();
	    	}
	    },

	    positionMessageBox: function() {
	    	var $messageArea = $('#ifb-message-area');
	    	var scrollY = $(window).scrollTop();
	    	var minY = $('.ifb-wrap').offset().top - 20;
	    	var isFixed = $messageArea.css('position') == 'fixed';
	    	var marginRight = $('body').hasClass('folded') ? '-260px' : '-322px';

	    	if (scrollY > minY && !isFixed) {
	    		$messageArea.css({
	    			position: 'fixed',
    	            right: '50%',
    	            marginRight: marginRight,
    	            top: '39px'
	    		});
	    	} else if (scrollY < minY && isFixed) {
	    		$messageArea.css({
	    			position: 'absolute',
    	            right: 0,
    	            top: '19px',
    	            marginRight: 0
	    		});
	    	}
	    },

	    positionRightColumn: function() {
	    	var $scrollElement = $('.ifb-right-scroll-wrap');
	    	var scrollY = $(window).scrollTop();
	    	var minY = $('.ifb-wrap').offset().top - 20;
	    	var isFixed = $scrollElement.css('position') == 'fixed';
	    	var marginRight = $('body').hasClass('folded') ? '-453px' : '-515px';

	    	if (scrollY > minY && !isFixed) {
	    		$scrollElement.css({
	    			position: 'fixed',
    	            right: '50%',
    	            marginRight: marginRight,
    	            top: '20px'
	    		});
	    	} else if (scrollY < minY && isFixed) {
	    		$scrollElement.css({
	    			position: 'static',
    	            right: 0,
    	            top: 0,
    	            marginRight: 0
	    		});
	    	}
	    },

	    showScrollTopButton: function () {
	    	if ($(window).scrollTop() > 200) {
	    		$('#ifb-scroll-top').fadeIn();
	    	} else {
	    		$('#ifb-scroll-top').fadeOut();
	    	}
	    },

	    toggleUseWpDb: function (checked) {
			if (checked) {
				$('.ifb-show-if-not-wpdb').hide();
			} else {
				$('.ifb-show-if-not-wpdb').show();
			}
		},

		addDbField: function (field, value, skipUpdate) {
			if (!field) field = '';
			if (!value) value = '';

			$('#db_fields_empty').hide();
			$('#db_fields_headings').show();
			$('#db_fields').show().append('<li><input type="text" name="db_field_name" class="db_field_name" value="' + field + '" /> <input type="text" name="db_field_value" class="db_field_value" value="' + value + '" /> <select class="ifb-insert-variable" onchange="vowelsforminc.insertVariable(jQuery(this).prev(\'.db_field_value\'), this);"></select> <span class="ifb-small-delete-button" onclick="vowelsforminc.removeDbField(this); return false;" title="' + vowelsL10n.remove + '">x</span></li>');

			if (!skipUpdate) {
				vowelsforminc.updateSettingsDependencies();
			}
		},

		removeDbField: function (listItem) {
			$(listItem).parent().remove();

			if ($('#db_fields').children().length === 0) {
				$('#db_fields').hide();
				$('#db_fields_headings').hide();
				$('#db_fields_empty').show();
			}
		},

		updateDbFields: function () {
			vowelsforminc.form.db_fields = {};

			$('#db_fields > li').each(function () {
				var field = $(this).find('.db_field_name').val(),
				value = $(this).find('.db_field_value').val();

				if (field.length) {
					vowelsforminc.form.db_fields[field] = value;
				}
			});
		},

		updateSuccessType: function () {
			if ($('#success_type').val() == 'redirect') {
				$('.show-if-success-type-redirect').show();
				$('.show-if-success-type-message').hide();
			} else {
				$('.show-if-success-type-redirect').hide();
				$('.show-if-success-type-message').show();
			}
		},

		toggleUseUniform: function (checked) {
			if (checked) {
				$('.show-if-use-uniform').show();
			} else {
				$('.show-if-use-uniform').hide();
			}
		},

		toggleCustomiseEmailContent: function () {
			var checked = $('#customise_email_content').is(':checked');
			if (checked) {
				$('.ifb-show-if-customise-email-content').show();
				$('.ifb-show-if-customise-email-content-off').hide();
			} else {
				$('.ifb-show-if-customise-email-content').hide();
				$('.ifb-show-if-customise-email-content-off').show();
			}
		},

		updateFormName: function () {
			$('.ifb-update-form-name').text($('#name').val());
			vowelsforminc.updateShortcodes();
		},

		updateShortcodes: function () {
			$('#ifb-shortcode-preview-form').text('[vowels id="' + vowelsforminc.form.id + '" name="' + $('#name').val() + '"]');
			$('#ifb-shortcode-preview-popup').text('[vowels_form_builder_popup id="' + vowelsforminc.form.id + '" name="' + $('#name').val() + '"]' + vowelsL10n.popup_trigger_text + '[/vowels_form_builder_popup]');
		},

		updateGroupName: function (element) {
			var name = $('#admin_title_' + element.id).val();
			$('#ifb-element-wrap-' + element.id).find('.ifb-start-group-name').text(name);
			$('#ifb-element-wrap-' + (element.id+1)).find('.ifb-group-end-name').text(name);
		},

		toggleAddAnotherUpload: function (element) {
			if ($('#upload_user_add_more_' + element.id).is(':checked')) {
				$('.show-if-upload-user-add-more', '#ifb-element-wrap-' + element.id).show();
			} else {
				$('.show-if-upload-user-add-more', '#ifb-element-wrap-' + element.id).hide();
			}
		},

		updateOptionsLayout: function (element) {
			if ($('#options_layout_' + element.id).val() == 'block') {
				$('#ifb_element_' + element.id).removeClass('ifb-options-inline').addClass('ifb-options-block');
			} else {
				$('#ifb_element_' + element.id).removeClass('ifb-options-block').addClass('ifb-options-inline');
			}
		},

		setElementLabelPlacement: function (element) {
			if ($('#label_placement_' + element.id).val() == 'left') {
				$('.ifb-show-if-element-label-placement-left', '#ifb-element-wrap-' + element.id).show();
			} else {
				$('.ifb-show-if-element-label-placement-left', '#ifb-element-wrap-' + element.id).hide();
			}
		},

		updatePlaceholder: function (element) {
			var placeholder = $('#placeholder_' + element.id).val();

			if ($.type(placeholder) == 'string' && placeholder.length) {
				$('#ifb_element_' + element.id).attr('placeholder', placeholder);
			} else {
				$('#ifb_element_' + element.id).attr('placeholder', '');
			}
		},

		hideNagMessage: function () {
			$('#ifb-nag-message').remove();
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
			       action: 'vowels_form_builder_hide_nag_message'
				}
			});
		},

		isScrolledIntoView: function (elem) {
	        var docViewTop = $(window).scrollTop();
	        var docViewBottom = docViewTop + $(window).height();

	        var elemTop = $(elem).offset().top;
	        var elemBottom = elemTop + $(elem).height();

	        return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom) && (elemBottom <= docViewBottom) && (elemTop >= docViewTop));
	    },

	    getElementPosition: function (element) {
	    	for (var i = 0; i < vowelsforminc.form.elements.length; i++) {
	    		if (vowelsforminc.form.elements[i].id == element.id) {
	    			return i;
	    		}
	    	}

	    	return 0;
	    },

	    addEntryLayoutColumn: function (element) {
	    	vowelsforminc.removeEntryLayoutColumn(element);
	    	var $activeColumnList = $('#ifb-active-columns');
	    	if ($activeColumnList.children().length > 3) {
	    		$target = $('#ifb-inactive-columns');
	    	} else {
	    		$target = $activeColumnList;
	    	}
	    	$target.append('<li><div class="ifb-button" data-type="element" data-id="' + element.id + '">' + vowelsforminc.getShortenedAdminLabel(element) + '</div></li>');
	    },

	    updateEntryLayoutColumnLabel: function (element) {
	    	$('#ifb-active-columns > li > div').each(function () {
	    		if ($(this).data('id') == element.id) {
	    			$(this).text(vowelsforminc.getShortenedAdminLabel(element));
	    		}
	    	});

	    	$('#ifb-inactive-columns > li > div').each(function () {
	    		if ($(this).data('id') == element.id) {
	    			$(this).text(vowelsforminc.getShortenedAdminLabel(element));
	    		}
	    	});
	    },

	    removeEntryLayoutColumn: function (element) {
	    	$('#ifb-active-columns > li > div').each(function () {
	    		if ($(this).data('id') == element.id) {
	    			$(this).parent().remove();
	    		}
	    	});

	    	$('#ifb-inactive-columns > li > div').each(function () {
	    		if ($(this).data('id') == element.id) {
	    			$(this).parent().remove();
	    		}
	    	});
	    },

	    toggleSaveToDatabase: function (element) {
	    	if ($('#save_to_database_' + element.id).is(':checked')) {
	    		vowelsforminc.addEntryLayoutColumn(element);
	    	} else {
	    		vowelsforminc.removeEntryLayoutColumn(element);
	    	}
	    },

	    toggleShowDatepicker: function (element) {
	    	if ($('#show_datepicker_' + element.id).is(':checked')) {
	    		$('.ifb-show-if-show-datepicker', '#ifb-element-wrap-' + element.id).show();
	    	} else {
	    		$('.ifb-show-if-show-datepicker', '#ifb-element-wrap-' + element.id).hide();
	    	}
	    },

	    groupStyleChanged: function (element) {
	    	if ($('#group_style_' + element.id).val() == 'plain') {
	    		$('.ifb-show-if-group-style-bordered', '#ifb-element-wrap-' + element.id).hide();
	    	} else {
	    		$('.ifb-show-if-group-style-bordered', '#ifb-element-wrap-' + element.id).show();
	    	}
	    },

	    toggleClearDefaultValue: function (element) {
	    	if ($('#clear_default_value_' + element.id).is(':checked')) {
	    		$('.ifb-show-if-clear-default-value', '#ifb-element-wrap-' + element.id).show();
	    	} else {
	    		$('.ifb-show-if-clear-default-value', '#ifb-element-wrap-' + element.id).hide();
	    	}
	    },

	    showBulkOptions: function (element) {
	    	tb_show(vowelsL10n.add_bulk_options, '#TB_inline?height=500&amp;width=500&amp;inlineId=ifb-bulk-options-' + element.id);

	    	// Fix to prevent Thickbox breaking jQuery UI tabs for WP < 3.3
	    	$("#TB_window, #TB_overlay, #TB_HideSelect").one('unload', function (e) {
	    	    e.stopPropagation();
	    	    e.stopImmediatePropagation();
	    	    return false;
	    	});
	    },

	    loadBulkOptions: function (type, element) {
	    	if (typeof vowelsL10n.bulk_options[type] === 'object') {
	    		$('#bulk_options_textarea_' + element.id).val(vowelsL10n.bulk_options[type].join('\n'));
	    	}
	    },

	    insertBulkOptions: function (element) {
	    	var $bulkOptions = $('#bulk_options_textarea_' + element.id),
	    	bulkOptions = $bulkOptions.val();

	    	if (bulkOptions.length) {
	    		var $optionsList = $('#ifb_options_' + element.id);
		    	if ($('#bulk_options_clear_' + element.id).is(':checked')) {
		    		$optionsList.empty();
		    	}

		    	bulkOptions = bulkOptions.split('\n');

		    	for (var i = 0; i < bulkOptions.length; i++) {
		    		$optionsList.append(vowelsforminc.getOptionHtml(element, bulkOptions[i]));
		    	}

		    	vowelsforminc.updateOptions(element);
		    	vowelsforminc.updateLogicOptions(element);
	    	}

	    	$bulkOptions.val('');

	    	if (typeof tb_remove === 'function') {
	    		tb_remove();
	    	}
	    },

	    loadBulkExistingOptions: function (element) {
	    	var options = [];
	    	for (var i = 0; i < element.options.length; i++) {
	    		options.push(element.options[i].label);
	    	}

	    	$('#bulk_options_textarea_' + element.id).val(options.join('\n'));
	    },

	    togglePreventDuplicates: function (element) {
	    	if ($('#prevent_duplicates_' + element.id).is(':checked')) {
	    		$('.ifb-show-if-prevent-duplicates', '#ifb-element-wrap-' + element.id).show();
	    	} else {
	    		$('.ifb-show-if-prevent-duplicates', '#ifb-element-wrap-' + element.id).hide();
	    	}
	    },

	    notificationFromTypeChanged: function () {
	    	if ($('#notification_from_type').val() == 'static') {
	    		$('.ifb-notification-from-element').hide();
	    		$('.ifb-notification-from-static').show();
	    	} else {
	    		$('.ifb-notification-from-static').hide();
	    		$('.ifb-notification-from-element').show();
	    	}
	    },

	    autoreplyFromTypeChanged: function () {
	    	if ($('#autoreply_from_type').val() == 'static') {
	    		$('.ifb-autoreply-from-element').hide();
	    		$('.ifb-autoreply-from-static').show();
	    	} else {
	    		$('.ifb-autoreply-from-static').hide();
	    		$('.ifb-autoreply-from-element').show();
	    	}
	    },

	    toggleLogic: function (element) {
	    	if ($('#logic_' + element.id).is(':checked')) {
	    		vowelsforminc.syncLogic(element);
	    		$('.ifb-show-if-logic-on', '#ifb-element-wrap-' + element.id).show();
	    		$('#enable_wrapper_' + element.id).attr('checked', true);
	    	} else {
	    		$('.ifb-show-if-logic-on', '#ifb-element-wrap-' + element.id).hide();
	    	}
	    },

	    toggleLogicOff: function (element) {
	    	$('#logic_' + element.id).attr('checked', false);
	    	$('.ifb-show-if-logic-on', '#ifb-element-wrap-' + element.id).hide();
	    },

	    syncLogic: function (element, update, hideIfNoRules) {
	    	switch (element.type) {
	    		case 'hidden':
	    		case 'groupend':
	    			// Not applicable to hidden/groupend element types
	    			break;
    			default:
	    			if (update !== false) {
	    				vowelsforminc.updateLogic(element);
	    			}
	    			$('#ifb_logic_rules_' + element.id).empty();
	    			if ($('#logic_' + element.id).is(':checked')) {
	    				if (vowelsforminc.logicableElements.length > 0) {
	    					var $rulesOuter = $('<div class="ifb-rules-outer-wrap"></div>'),
	    					$rulesTop = $('<div class="ifb-rules-top"></div>');

	    					var this_if_text = element.type == 'groupstart' ? vowelsL10n.this_group_if : vowelsL10n.this_field_if;

	    					$rulesTop.append($('<select id="logic_action_' + element.id + '">').append($('<option>', { text: vowelsL10n.show, value: 'show' })).append($('<option>', { text: vowelsL10n.hide, value: 'hide' })).val(element.logic_action || 'show'));
	    					$rulesTop.append($('<span class="ifb-logic-top-if"></span>').text(this_if_text));
	    					$rulesTop.append($('<select id="logic_match_' + element.id + '">').append($('<option>', { text: vowelsL10n.all, value: 'all' })).append($('<option>', { text: vowelsL10n.any, value: 'any' })).val(element.logic_match || 'any'));
	    					$rulesTop.append($('<span class="ifb-logic-top-rules-match"></span>').text(vowelsL10n.these_rules_match));
	    					$rulesOuter.append($rulesTop);

	    					$rulesWrap = $('<div class="ifb-rules-wrap"></div>');

	    					if (element.logic_rules.length) {
	    						for (var i = 0; i < element.logic_rules.length; i++) {
	    							$rulesWrap.append(vowelsforminc.buildLogicRule(element.logic_rules[i], element, i));
	    						}
	    					} else {
    							$rulesWrap.append(vowelsforminc.buildLogicRule(vowelsforminc.getNewLogicRule(), element, 0));
    							if (hideIfNoRules) {
    								vowelsforminc.toggleLogicOff(element);
    							}
	    					}

	    					$rulesOuter.append($rulesWrap);
	    					$('#ifb_logic_rules_' + element.id).append($rulesOuter);
	    				} else {
	    					$('#ifb_logic_rules_' + element.id).html('<div class="ifb-info-message"><span class="ifb-info-message-icon"></span>'+ vowelsL10n.need_multi_element +'</div>');
	    					if (hideIfNoRules) {
	    						vowelsforminc.toggleLogicOff(element);
	    					}
	    				}
	    	    	}
	    			break;
	    	}
	    },

	    buildLogicRule: function (rule, element, index) {
			var $ruleWrap = $('<div id="ifb-rule-wrap-'+element.id+'-'+index+'" class="ifb-rule-wrap"></div>');

			var $element = $('<select id="logic_rule_element_'+element.id+'_'+index+'" class="logic_rule_element"></select>');
			for (var i = 0; i < vowelsforminc.logicableElements.length; i++) {
				$element.append($('<option>', { text: vowelsforminc.getShortenedAdminLabel(vowelsforminc.logicableElements[i]), value: vowelsforminc.logicableElements[i].id }));
			}

			var $operator = $('<select id="logic_rule_operator_'+element.id+'_'+index+'" class="logic_rule_operator"></select>').append($('<option>', { text: vowelsL10n.is, value: 'eq' })).append($('<option>', { text: vowelsL10n.is_not, value: 'neq' }));

			if (typeof rule === 'object') {
				if (rule.element_id) {
					$element.val(rule.element_id);
				}
				$operator.val(rule.operator);
			}

			var $value = vowelsforminc.buildLogicRuleValues($element.val(), element, index, (typeof rule === 'object') ? rule.value : '');

			$element.change(function () {
				$('#logic_rule_value_'+element.id+'_'+index).replaceWith(vowelsforminc.buildLogicRuleValues($(this).val(), element, index));
			});

			var $addButton = $('<span class="ifb-small-add-button"></span>').click(function () {
				vowelsforminc.addLogicRule(element, index+1);
			});

			var $deleteButton = $('<span class="ifb-small-delete-button"></span>').click(function () {
				vowelsforminc.deleteLogicRule(element, index);
			});

			$ruleWrap.append($element).append($operator).append($value).append($addButton).append($deleteButton);
			return $ruleWrap;
	    },

	    buildLogicRuleValues: function (selectedElementId, element, index, selectedValue) {
	    	$value = $('<select id="logic_rule_value_'+element.id+'_'+index+'" class="logic_rule_value"></select>');

	    	var selectedElement = vowelsforminc.getElementById(selectedElementId),
			optionHasBeenSelected = false;

			for (var i = 0; i < selectedElement.options.length; i++) {
				var $option = $('<option>', { text: vowelsforminc.shorten(selectedElement.options[i].label), value: selectedElement.options[i].value });
				if (selectedElement.options[i].value == selectedValue) {
					$option.attr('selected', 'selected');
					optionHasBeenSelected = true;
				}

				$value.append($option);
			}

			// There was a saved value that's no longer in the list, add it to stop this rule incorrectly interfering
			if (!optionHasBeenSelected && typeof selectedValue === 'string' && selectedValue.length > 0) {
				$value.append($('<option>', { text: selectedValue, value: selectedValue }).attr('selected', 'selected'));
			}

			return $value;
	    },

	    syncAllLogic: function (update, hideIfNoRules) {
	    	for (var i = 0; i < vowelsforminc.form.elements.length; i++) {
	    		vowelsforminc.syncLogic(vowelsforminc.form.elements[i], update, hideIfNoRules);
	    	}
	    },

	    updateLogic: function (element) {
	    	element.logic = $('#logic_' + element.id).is(':checked');
	    	element.logic_action = 'show';
	    	element.logic_match = 'all';
	    	element.logic_rules = [];

	    	if (element.logic) {
	    		element.logic_action = $('#logic_action_' + element.id).val();
	    		element.logic_match = $('#logic_match_' + element.id).val();

	    		$('.ifb-rule-wrap', '#ifb_logic_rules_' + element.id).each(function () {
	    			element.logic_rules.push({
	    				element_id: $(this).find('.logic_rule_element').val(),
	    				operator: $(this).find('.logic_rule_operator').val(),
    					value: $(this).find('.logic_rule_value').val()
	    			});
	    		});

	    		// If there are no rules, just disable logic altogether
	    		if (element.logic_rules.length === 0) {
	    			element.logic = false;
	    		}
	    	}
	    },

	    updateAllLogic: function () {
	    	for (var i = 0; i < vowelsforminc.form.elements.length; i++) {
	    		vowelsforminc.updateLogic(vowelsforminc.form.elements[i]);
	    	}
	    },

	    deleteLogicableElement: function (element) {
	    	for (var i = 0; i < vowelsforminc.logicableElements.length; i++) {
	    		if (vowelsforminc.logicableElements[i].id == element.id) {
	    			vowelsforminc.logicableElements.splice(i, 1);
	    		}
	    	}
	    },

	    addLogicRule: function (element, index) {
	    	vowelsforminc.updateLogic(element);
	    	element.logic_rules.splice(index, 0, vowelsforminc.getNewLogicRule());
	    	vowelsforminc.syncLogic(element, false);
	    },

    	deleteLogicRule: function (element, index) {
	    	vowelsforminc.updateLogic(element);
	    	if (element.logic_rules.length > 1) {
	    		element.logic_rules.splice(index, 1);
	    		vowelsforminc.syncLogic(element, false);
	    	}
	    },

	    getNewLogicRule: function () {
	    	return { element_id: '', operator: 'eq', value: '' };
	    },

	    deleteDependentLogicRules: function (element) {
	    	vowelsforminc.updateAllLogic();
	    	for (var i = 0; i < vowelsforminc.form.elements.length; i++) {
	    		if (typeof vowelsforminc.form.elements[i].logic_rules === 'object') {
	    			var newLogicRules = [];
	    			for (var j = 0; j < vowelsforminc.form.elements[i].logic_rules.length; j++) {
	    				if (vowelsforminc.form.elements[i].logic_rules[j].element_id != element.id) {
	    					newLogicRules.push(vowelsforminc.form.elements[i].logic_rules[j]);
	    				}
	    			}
	    			vowelsforminc.form.elements[i].logic_rules = newLogicRules;
	    		}
	    	}
	    },

	    /**
	     * Updates existing logic rules with changes to the element labels
	     *
	     * @param object element
	     */
	    updateLogicRuleLabels: function (element) {
	    	$('.logic_rule_element > option[value="'+element.id+'"]').each(function () {
	    		$(this)[0].text = vowelsforminc.getShortenedAdminLabel(element);
	    	});
	    },

	    /**
	     * Updates existing logic rules with changes to the options
	     * for the given element
	     *
	     * @param object element
	     */
	    updateLogicOptions: function (element) {
	    	$('.logic_rule_element > option[value="'+element.id+'"]').each(function () {
	    		var id = $(this).parent().attr('id'),
	    		idParts = id.split('_');

	    		id = id.replace('element', 'value');

	    		$values = $('#' + id);
	    		selectedValue = $values.val();

	    		$values.replaceWith(vowelsforminc.buildLogicRuleValues(element.id, vowelsforminc.getElementById(idParts[3]), idParts[4], selectedValue));
	    	});
	    },

	    toggleDynamicDefaultValue: function (element) {
	    	if ($('#dynamic_default_value_' + element.id).is(':checked')) {
	    		$('.ifb-show-if-dynamic-default-value', '#ifb-element-wrap-' + element.id).show();
	    	} else {
	    		$('.ifb-show-if-dynamic-default-value', '#ifb-element-wrap-' + element.id).hide();
	    	}
	    },

	    addBcc: function () {
	    	$('#add_bcc').hide();
	    	$('#bcc').append(vowelsforminc.getBccHtml());
	    },

	    getBccHtml: function () {
	    	return '<div><input name="ifb_bcc_email" type="text" /> <span class="ifb-small-add-button" onclick="vowelsforminc.addBccField(this); return false;">+</span> <span class="ifb-small-delete-button" onclick="vowelsforminc.removeBccField(this); return false;">x</span></li>';
	    },

	    addBccField: function (element) {
			$(element).parent().after(vowelsforminc.getBccHtml());
		},

		removeBccField: function (element) {
			$(element).parent().remove();

			if ($('#bcc').children().length === 0) {
				$('#add_bcc').show();
			}
		}
	};

	window.vowelsPreloadedImages = [];
	window.vowelsPreload = function (images, prefix) {
		for (var i = 0; i < images.length; i++) {
			var elem = document.createElement('img');
			elem.src = prefix ? prefix + images[i] : images[i];
			window.vowelsPreloadedImages.push(elem);
		}
	};

	/**
	 * Preload form builder images
	 */
	window.vowelsPreload([
       '/button-blue-hover.png',
       '/pop-up-box-close.png',
       '/pop-up-box-close-hover.png',
       '/button-orange-hover.png',
       '/add-icon-for-orange-button.png',
       '/edit-form-icon-grey.png',
       '/form-settings-icon-orange.png',
       '/help-hover.png',
       '/button-grey.png',
       '/button-grey-hover.png',
       '/go-to-top-hover.png',
       '/side-button-loading.gif',
       '/button-extra-tick.png',
       '/button-extra-fail.png',
       '/button-orange.png',
       '/drop-element-from-here.png',
       '/button-dark.png',
       '/button-dark-hover.png',
       '/delete-bg-hover.png',
       '/button-extra-minus-smaller.png',
       '/button-extra-minus-mini.png',
       '/button-extra-add-mini.png',
       '/color-wheel.png',
       '/toggle-plus.png',
       '/loading.gif',
       '/move-here.png',
       '/vowels-main-nav-bg-hover.png',
       '/info-icon.png'
    ], vowelsL10n.admin_images_url);
})(jQuery, window);