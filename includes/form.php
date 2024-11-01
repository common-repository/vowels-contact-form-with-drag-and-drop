<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$formId = $form->getId();
$formUniqueId = $form->getUniqId();
$useAjax = $form->getUseAjax();
$formClasses = array();
if ($form->getUseUniformJs()) {
    $formClasses[] = "vowels-uniform-theme-{$form->getUniformJsTheme()}";
}
if (strlen($theme = $form->getTheme())) {
    $theme = explode('|', $theme);
    $formClasses[] = "vowels-theme-{$theme[0]}-{$theme[1]}";
}
if ($form->hasConditionalLogic()) {
    $formClasses[] = 'vowels-has-logic';
}
if ($form->isResponsive()) {
    $formClasses[] = 'vowels-responsive';
}
$anchor = apply_filters('vowels_form_builder_use_anchor', true);
$anchor = apply_filters("vowels_form_builder_use_anchor_$formId", $anchor);
$action = add_query_arg(array()) . ($anchor ? "#vowels-$formUniqueId" : '');
?>
<div id="vowels-outer-<?php echo esc_attr($formUniqueId); ?>" class="vowels-outer vowels-outer-<?php echo $formId; ?> <?php echo join(' ', $formClasses); ?> wpcf7" <?php echo $form->getCss('formOuter'); ?>>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            <?php if ($form->hasConditionalLogic()) : ?>
                vowelsforminc.logic[<?php echo $formId; ?>] = <?php echo $form->getConditionalLogicJson(); ?>;
            <?php endif; ?>
            $('#vowels-<?php echo esc_js($formUniqueId); ?>').vowelsforminc(<?php echo $form->getJsConfig(); ?>);
            <?php if ($form->getUseTooltips()) : ?>
            if ($.isFunction($.fn.qtip)) {
                $('.vowels-tooltip-hover', vowelsforminc.instance.$form).qtip({
                    style: {
                        classes: '<?php echo $form->getTooltipClasses(); ?>'
                    },
                    position: {
                        my: '<?php echo $form->getTooltipMy(); ?>',
                        at: '<?php echo $form->getTooltipAt(); ?>',
                        viewport: $(window),
                        adjust: {
                            method: 'shift'
                        }
                    }
                });
                $('.vowels-tooltip-click', vowelsforminc.instance.$form).qtip({
                    style: {
                        classes: '<?php echo $form->getTooltipClasses(); ?>'
                    },
                    position: {
                        my: '<?php echo $form->getTooltipMy(); ?>',
                        at: '<?php echo $form->getTooltipAt(); ?>',
                        viewport: $(window),
                        adjust: {
                            method: 'shift'
                        }
                    },
                    show: {
                        event: 'focus'
                    },
                    hide: {
                        event: 'unfocus'
                    }
                });
                $('.vowels-tooltip-icon-hover', vowelsforminc.instance.$form).qtip({
                    style: {
                        classes: '<?php echo $form->getTooltipClasses(); ?>'
                    },
                    position: {
                        my: '<?php echo $form->getTooltipMy(); ?>',
                        at: '<?php echo $form->getTooltipAt(); ?>',
                        viewport: $(window),
                        adjust: {
                            method: 'shift'
                        }
                    },
                    content: {
                        text: function (api) {
                            return $(this).find('.vowels-tooltip-icon-content').html();
                        }
                    }
                });
                $('.vowels-tooltip-icon-click', vowelsforminc.instance.$form).qtip({
                    style: {
                        classes: '<?php echo $form->getTooltipClasses(); ?>'
                    },
                    position: {
                        my: '<?php echo $form->getTooltipMy(); ?>',
                        at: '<?php echo $form->getTooltipAt(); ?>',
                        viewport: $(window),
                        adjust: {
                            method: 'shift'
                        }
                    },
                    show: {
                        event: 'click'
                    },
                    hide: {
                        event: 'unfocus'
                    },
                    content: {
                        text: function (api) {
                            return $(this).find('.vowels-tooltip-icon-content').html();
                        }
                    }
                });
                $('.vowels-labels-inside > .vowels-element-spacer > label').hover(function () {
                    $(this).siblings('.vowels-input-wrap').find('.vowels-tooltip-hover').qtip('show');
                }, function () {
                    $(this).siblings('.vowels-input-wrap').find('.vowels-tooltip-hover').qtip('hide');
                });
            }
            <?php endif; ?>
            <?php if ($form->getUseUniformJs()) : ?>
            if ($.isFunction($.fn.uniform)) {
                $('select, input:checkbox, input:radio', vowelsforminc.instance.$form).uniform({context: vowelsforminc.instance.$form, selectAutoWidth: false});
            }
            <?php endif; ?>
            if ($.isFunction($.fn.inFieldLabels)) {
                $('.vowels-labels-inside:not(.vowels-element-wrap-recaptcha) > .vowels-element-spacer > label', vowelsforminc.instance.$form).inFieldLabels();
            }
            <?php if (!get_option('vowels_form_builder_disable_jqueryui_output') && $form->hasDatepickerElement()) : ?>
                if ($.isFunction($.fn.datepicker)) {
                    <?php if (strlen($form->getjQueryUITheme())) : ?>
                        if (!$('#vowels-jqueryui-theme').length) {
                            var themeUrl = vowelsL10n.plugin_url + '/js/jqueryui/themes/<?php echo $form->getjQueryUITheme(); ?>/jquery-ui.min.css?ver=1.12.1';
                            $('head').append('<link id="vowels-jqueryui-theme" rel="stylesheet" href="' + themeUrl + '" type="text/css" />');
                        }
                    <?php endif; ?>
                    <?php if (strlen($form->getjQueryUIL10n())) : ?>
                         $.getScript(vowelsL10n.plugin_url + '/js/jqueryui/i18n/jquery.ui.datepicker-<?php echo $form->getjQueryUIL10n(); ?>.js');
                    <?php endif; ?>
                }
            <?php endif; ?>
            $('.vowels-group-row > div:last-child:not(:first-child)', vowelsforminc.instance.$form).add('.vowels-group-row:last-child', vowelsforminc.instance.$form).addClass('last-child');
            <?php if ($form->hasConditionalLogic()) : ?>
                vowelsforminc.instance.applyAllLogic(true);
                $('#vowels-outer-<?php echo esc_js($formUniqueId); ?>').css('visibility', 'visible');
            <?php endif; ?>
        });
    </script>
    <form id="vowels-<?php echo esc_attr($formUniqueId); ?>" class="vowels vowels-form-<?php echo $formId; ?> wpcf7-form" action="<?php echo esc_url($action); ?>" method="post" enctype="multipart/form-data" novalidate="novalidate">
        <div class="vowels-inner vowels-inner-<?php echo $formId; ?>" <?php echo $form->getCss('formInner'); ?>>
            <input type="hidden" name="vowels_form_builder_id" value="<?php echo esc_attr($formId); ?>" />
            <input type="hidden" name="vowels_form_builder_uid" value="<?php echo esc_attr($formUniqueId); ?>" />
            <input type="hidden" name="form_url" value="<?php echo esc_attr(vowels_form_builder_get_current_url()); ?>" />
            <input type="hidden" name="referring_url" value="<?php echo esc_attr(vowels_form_builder_get_http_referer()); ?>" />
            <input type="hidden" name="post_id" value="<?php echo esc_attr(vowels_form_builder_get_current_post_id()); ?>" />
            <input type="hidden" name="post_title" value="<?php echo esc_attr(vowels_form_builder_get_current_post_title()); ?>" />
            <?php if (strlen(($formTitle = $form->getTitle()))) : ?>
                <h3 class="vowels-title" <?php echo $form->getCss('title'); ?>><?php echo do_shortcode($formTitle); ?></h3>
            <?php endif; ?>
            <?php if (strlen(($formDescription = $form->getDescription()))) : ?>
                <p class="vowels-description" <?php echo $form->getCss('description'); ?>><?php echo do_shortcode($formDescription); ?></p>
            <?php endif; ?>
            <?php if ($form->getSuccessMessagePosition() == 'above') : ?>
                <?php if ($form->getSubmitted() && isset($successMessage) && strlen($successMessage)) : ?>
                    <div class="vowels-success-message" <?php echo $form->getCss('success'); ?>><?php echo $successMessage; ?></div>
                <?php else : ?>
                    <div class="vowels-success-message <?php if (!$form->getSubmitted()) echo 'vowels-hidden'; ?>" <?php echo $form->getCss('success'); ?>></div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="vowels-elements vowels-elements-<?php echo $formId; ?> vowels-clearfix" <?php echo $form->getCss('elements'); ?>>
                <?php
                    $columnData = array();
                    $elements = $form->getElements();
                    $labelData = array(array(
                        'placement' => $form->getLabelPlacement(),
                        'width' => $form->getLabelWidth()
                    ));
                    $tooltipData = array(array(
                        'type' => $form->getTooltipType(),
                        'event' => $form->getTooltipEvent()
                    ));

                    while (list($key, $element) = each($elements)) {
                        $elementClass = get_class($element);

                        // Label data
                        $currentLabelData = end($labelData);
                        $labelPlacement = $currentLabelData['placement'];
                        $labelWidth = $currentLabelData['width'];

                        // Tooltip data
                        $currentTooltipData = end($tooltipData);
                        $tooltipType = $currentTooltipData['type'];
                        $tooltipEvent = $currentTooltipData['event'];

                        // Per-element data
                        if ($elementClass != 'vowelsforminc_Element_Groupstart') {
                            // Labels
                            if ($element->getLabelPlacement() != 'inherit') {
                                $labelPlacement = $element->getLabelPlacement();
                                if ($labelPlacement == 'left') {
                                    $labelWidth = strlen($element->getLabelWidth()) ? $element->getLabelWidth() : $labelWidth;
                                }
								
								 
								
                            }
                            // Tooltips
                            if ($element->getTooltipType() != 'inherit') $tooltipType = $element->getTooltipType();
                            if ($element->getTooltipEvent() != 'inherit') $tooltipEvent = $element->getTooltipEvent();
                        }

                        // Label CSS styles
						if ($labelPlacement == 'above') {
                                    $paratexxt_start = '<p style="margin-bottom: 0px;">';
									$paratexxt_end = '</p>';
									$class_marginyesno= '99';
                                }
						
						else
						{
						    $paratexxt_start = '';
							$paratexxt_end = '<br>';
							
							if ($labelPlacement == 'left') 
							{
							$class_marginyesno= '88';
							}
							else
							{
							$class_marginyesno= '';
							}
							
						}
						
                        $labelCss = ($labelPlacement == 'left' && strlen($labelWidth)) ? array('width' => $labelWidth) : null;
                        $leftMarginCss = ($labelPlacement == 'left' && strlen($labelWidth)) ? array('margin-left' => $labelWidth) : null;

                        // Tooltip settings
                        if (($form->getUseTooltips() && strlen($element->getTooltip()) && $tooltipType == 'field')) {
                            $tooltipInputClass = 'vowels-tooltip vowels-tooltip-' . $tooltipEvent;
                            $tooltipTitle = 'title="' . esc_attr($element->getTooltip()) . '"';
                        } else {
                            $tooltipInputClass = '';
                            $tooltipTitle = '';
                        }

                        // Other common variables
                        $uniqueId = $element->getUniqueId();
                        $name = $element->getName();

                        // Display each element
                        switch ($elementClass) {
                            case 'vowelsforminc_Element_Captcha':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/captcha.php';
                                break;
                            case 'vowelsforminc_Element_Checkbox':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/checkbox.php';
                                break;
                            case 'vowelsforminc_Element_Date':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/date.php';
                                break;
                            case 'vowelsforminc_Element_Email':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/email.php';
                                break;
                            case 'vowelsforminc_Element_Text':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/text.php';
                                break;
                            case 'vowelsforminc_Element_File':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/file.php';
                                break;
                            case 'vowelsforminc_Element_Groupend':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/groupend.php';
                                // We've ended a group, remove the last added group info
                                array_pop($columnData);
                                // Change back to the previous label data
                                array_pop($labelData);
                                // Change back to previous tooltip data
                                array_pop($tooltipData);
                                break;
                            case 'vowelsforminc_Element_Groupstart':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/groupstart.php';
                                // We've started a new group, so save the group info
                                $columnData[] = array('count' => 0, 'target' => $element->getNumberOfColumns());
                                // Save the label data for this group
                                $labelData[] = array(
                                    'placement' => ($element->getLabelPlacement() == 'inherit') ? $labelPlacement : $element->getLabelPlacement(),
                                    'width' => strlen($element->getLabelWidth()) ? $element->getLabelWidth() : $labelWidth
                                );
                                // Save tooltip data for this group
                                $tooltipData[] = array(
                                    'type' => ($element->getTooltipType() == 'inherit') ? $tooltipType : $element->getTooltipType(),
                                    'event' => ($element->getTooltipEvent() == 'inherit') ? $tooltipEvent : $element->getTooltipEvent()
                                );
                                break;
                            case 'vowelsforminc_Element_Hidden':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/hidden.php';
                                break;
                            case 'vowelsforminc_Element_Honeypot':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/honeypot.php';
                                break;
                            case 'vowelsforminc_Element_Html':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/html.php';
                                break;
                            case 'vowelsforminc_Element_Password':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/password.php';
                                break;
                            case 'vowelsforminc_Element_Radio':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/radio.php';
                                break;
                            case 'vowelsforminc_Element_Recaptcha':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/recaptcha.php';
                                break;
                            case 'vowelsforminc_Element_Select':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/select.php';
                                break;
                            case 'vowelsforminc_Element_Textarea':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/textarea.php';
                                break;
                            case 'vowelsforminc_Element_Time':
                                include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/time.php';
                                break;
                        }

                        // For every non-group element, check if we are at the end of the group row and start a new row if needed
                        if (!in_array($elementClass, array('vowelsforminc_Element_Groupstart', 'vowelsforminc_Element_Hidden'))) {
                            if (count($columnData)) {
                                $endIndex = count($columnData) - 1;
                                $next = current($elements);
                                $columnData[$endIndex]['count']++;

                                if (($columnData[$endIndex]['count'] == $columnData[$endIndex]['target']) && !($next instanceof vowelsforminc_Element_Groupend)) {
                                    echo '</div><div class="vowels-group-row vowels-clearfix vowels-group-row-' . $columnData[$endIndex]['target'] . 'cols">';
                                    $columnData[$endIndex]['count'] = 0;
                                }
                            }
                        }
                    }
                ?>
                <div class="vowels-submit-wrap vowels-submit-wrap-<?php echo $formId; ?> vowels-clearfix" <?php echo $form->getCss('submitOuter'); ?>>
                    <div class="vowels-submit-input-wrap vowels-submit-input-wrap-<?php echo $formId; ?>" <?php echo $form->getCss('submit'); ?>>
		    
		    
                	 <!--  disabled on 2610.2018 as theme default button was not reflecting.replaced with below code.
					 
					 <button class="vowels-submit-element" type="submit" name="vowels_form_builder_submit" <?php echo $form->getCss('submitButton'); ?>><span <?php echo $form->getCss('submitSpan'); ?>><em <?php echo $form->getCss('submitEm'); ?>><?php echo esc_html($form->getSubmitButtonText()); ?></em></span></button>
						-->
						
						 <input class="vowels-submit-element" type="submit" name="vowels_form_builder_submit" value="<?php echo esc_html($form->getSubmitButtonText()); ?>" <?php echo $form->getCss('submitButton'); ?> />             
						 
						        </div>
                    <div class="vowels-loading-wrap"><span class="vowels-loading"><?php esc_html_e('Please wait...','vowels-contact-form-with-drag-and-drop'); ?></span></div>
                </div>
            </div>
            <?php if ($form->getShowReferralLink()) : ?>
                <div class="vowels-referral-link">
                    <?php
                        $referralUrl = 'http://www.vowelsform.com/buy.php';
                        $referralUsername = strlen($form->getReferralUsername()) ? $form->getReferralUsername() : 'Vowelsform';
                        $referralUrl .= '?ref=' . $referralUsername;
                    ?>
                    <a href="<?php echo esc_attr($referralUrl); ?>"><?php echo $form->getReferralText(); ?></a>
                </div>
            <?php endif; ?>
            <?php if ($form->swfUploadEnabled()) : ?>
                <div class="vowels2-upload-progress-wrap">
                    <div class="vowels-upload-progress-bar-wrap">
                        <div class="vowels-upload-progress-bar"></div>
                    </div>
                    <div class="vowels-upload-info vowels-clearfix">
                        <div class="vowels-upload-filename"></div>
                        <div class="vowels-upload-error"></div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($form->getSuccessMessagePosition() == 'below') : ?>
                <?php if ($form->getSubmitted() && isset($successMessage) && strlen($successMessage)) : ?>
                    <div class="vowels-success-message" <?php echo $form->getCss('success'); ?>><?php echo $successMessage; ?></div>
                <?php else : ?>
                    <div class="vowels-success-message <?php if (!$form->getSubmitted()) echo 'vowels-hidden'; ?>" <?php echo $form->getCss('success'); ?>></div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php if (current_user_can('vowels_form_builder_build_form') && $form->getId() > 0) : ?>
        <div class="vowels-edit-form-wrap">
            <a class="vowels-edit-form" href="<?php echo admin_url('/admin.php?page=vowels_form_builder_form_builder&amp;id=' . $formId);?>"><?php esc_html_e('Edit this form','vowels-contact-form-with-drag-and-drop'); ?></a>
        </div>
        <?php endif; ?>
    </form>
    <script type="text/javascript">
    jQuery('#vowels-outer-<?php echo esc_js($formUniqueId); ?> script').remove();
    </script>
</div>