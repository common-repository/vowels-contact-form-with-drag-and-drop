<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$uploadNumFields = (int) $element->getUploadNumFields();
?>
<div class="vowels-element-wrap vowels-element-wrap-file <?php echo $name; ?>-element-wrap vowels-clearfix vowels-labels-<?php echo $labelPlacement; ?> <?php echo ($element->getRequired()) ? 'vowels-element-required' : 'vowels-element-optional'; ?>" <?php echo $element->getCss('outer'); ?>>
    <div class="vowels-element-spacer vowels-element-spacer-file <?php echo $name; ?>-element-spacer"><?php echo $paratexxt_start; ?>
        <?php
            if ($element->getIsMultiple() && $uploadNumFields > 0) {
                echo $element->getLabelHtml($tooltipType, $tooltipEvent, $labelCss, false, $uniqueId . '_file_label');
            } else {
                echo $element->getLabelHtml($tooltipType, $tooltipEvent, $labelCss, true);
            }
        ?>
        <div class="vowels-input-outer-wrap <?php echo $name; ?>-input-outer-wrap" <?php echo $element->getCss(null, $leftMarginCss); ?>>
            <?php if ($element->getIsMultiple() && $uploadNumFields > 0) : ?>
                    <?php for ($i = 1; $i <= $uploadNumFields; $i++) : ?>
                        <div class="vowels-input-wrap vowels-input-wrap-file vowels-clearfix <?php echo $name; ?>-input-wrap" <?php echo $element->getCss('inner', $leftMarginCss); ?>>
                            <span class="vowels-element-file-inner"><label id="<?php echo esc_attr(sprintf('%s_file_label_%d', $uniqueId, $i)); ?>" class="vowels-screen-reader-text"><?php printf(esc_html__('File %d', 'vowels-contact-form-with-drag-and-drop'), $i); ?></label><input class="vowels-element-file <?php echo $tooltipInputClass; ?> <?php echo $name; ?>" type="file" name="<?php echo $name; ?>[]" <?php echo $tooltipTitle; ?> aria-labelledby="<?php echo esc_attr($uniqueId . '_file_label'); ?> <?php echo esc_attr(sprintf('%s_file_label_%d', $uniqueId, $i)); ?>" /></span>
                        </div>
                    <?php endfor; ?>
                    <?php if ($element->getUploadUserAddMore()) : ?>
                        <?php $uploadAddAnotherText = strlen($element->getUploadAddAnotherText()) ? $element->getUploadAddAnotherText() : __('Upload another','vowels-contact-form-with-drag-and-drop'); ?>
                        <div class="vowels-hidden vowels-add-another-upload <?php echo $name; ?>-add-another-upload vowels-clearfix">
                            <span class="vowels-add-another-upload-button"><?php echo esc_html($uploadAddAnotherText); ?></span>
                        </div>
                        <script type="text/javascript">
                        jQuery(document).ready(function ($) {
                            var uniqueId = '<?php echo esc_js($uniqueId); ?>',
                                labelText = '<?php echo esc_js(__('File %d','vowels-contact-form-with-drag-and-drop')); ?>';

                            $('.<?php echo $name; ?>-add-another-upload', vowelsforminc.instance.$form).show().find('span').click(function (e) {
                                var count = $(this).closest('.vowels-input-outer-wrap').find('.vowels-input-wrap').length,
                                    labelId = uniqueId + '_file_label_' + (count + 1),
                                    thisLabelText = labelText.replace('%d', (count + 1)),
                                    ariaLabelledBy = uniqueId + '_file_label ' + labelId;

                                var $newFileElement = $('<div class="vowels-input-wrap vowels-input-wrap-file vowels-clearfix <?php echo $name; ?>-input-wrap"><span class="vowels-element-file-inner"><label class="vowels-screen-reader-text"></label><input class="vowels-element-file <?php echo $tooltipInputClass; ?> <?php echo $name; ?>" type="file" name="<?php echo $name; ?>[]" <?php echo $tooltipTitle; ?> /></span></div>');
                                $('.<?php echo $name; ?>-input-outer-wrap .vowels-input-wrap:last').after($newFileElement);
                                $newFileElement.find('.vowels-screen-reader-text').text(thisLabelText).attr('id', labelId);
                                $newFileElement.find('.vowels-element-file').attr('aria-labelledby', ariaLabelledBy);
                                $newFileElement.addClass('vowels-add-another-file-wrap').show();

                                <?php if ($form->getUseUniformJs()) : ?>
                                if ($.isFunction($.fn.uniform)) {
                                    $newFileElement.find('input:file').uniform({
                                        fileDefaultHtml: '<?php echo $element->getDefaultText(); ?>',
                                        fileButtonHtml: '<?php echo $element->getBrowseText(); ?>'
                                    });
                                }
                                <?php endif; ?>
                            });
                        });
                        </script>
                <?php endif; ?>
            <?php else : ?>
                <div class="vowels-input-wrap vowels-input-wrap-file vowels-clearfix <?php echo $name; ?>-input-wrap" <?php echo $element->getCss('inner'); ?>>
                    <span class="vowels-element-file-inner"><input id="<?php echo esc_attr($uniqueId); ?>" class="vowels-element-file <?php echo $tooltipInputClass; ?> <?php echo $name; ?>" type="file" name="<?php echo $name; ?>" <?php echo $tooltipTitle; ?> /></span>
                </div>
            <?php endif; ?>
            <?php if ($form->getUseUniformJs()) : ?>
                <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    if ($.isFunction($.fn.uniform)) {
                        $('.<?php echo $name; ?>-element-wrap input:file', vowelsforminc.instance.$form).not('.vowels-upload-enhanced').uniform({
                        	fileDefaultHtml: '<?php echo esc_js($element->getDefaultText()); ?>',
                        	fileButtonHtml: '<?php echo esc_js($element->getBrowseText()); ?>'
                        });
                    }
                });
                </script>
            <?php endif; ?>
            <script type="text/javascript">
            jQuery(document).ready(function ($) {
              	$('.<?php echo $name; ?>-input-wrap', vowelsforminc.instance.$form).show();
            });
            </script>
            <?php if ($useAjax && $element->getEnableSwfUpload()) : ?>
                <div id="<?php echo esc_attr($uniqueId); ?>-swfupload" class="vowels-swfupload">
                	<div class="vowels-clearfix">
                        <div id="<?php echo esc_attr($uniqueId); ?>-file-queue" class="vowels-file-queue vowels-clearfix"></div>
                        <div id="<?php echo esc_attr($uniqueId); ?>-file-queue-errors" class="vowels-queue-errors vowels-hidden"></div>
                        <div class="vowels-swfupload-browse-wrap vowels-clearfix">
                            <div class="vowels-swfupload-browse" id="<?php echo esc_attr($uniqueId); ?>-browse">
                                <span class="vowels-upload-browse-text"><?php echo $element->getBrowseText(); ?></span>
                                <input id="<?php echo esc_attr($uniqueId); ?>-enhanced" class="vowels-upload-enhanced <?php echo $name; ?>" type="file"<?php echo $element->getAllowMultipleUploads() ? ' multiple' : ''; ?> />
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    vowelsforminc.instance.addUploader({
                        id: <?php echo $element->getId(); ?>,
                        name: '<?php echo esc_js($name); ?>',
                        uniqueId: '<?php echo esc_js($uniqueId); ?>',
                        allowedExtensions: <?php echo json_encode($element->getFileUploadValidator()->getAllowedExtensions()); ?>,
                        fileSizeLimit : <?php echo esc_js($element->getFileUploadValidator()->getMaximumFileSize()); ?>,
                        fileUploadLimit : <?php echo $element->getAllowMultipleUploads() ? 0 : 1; ?>
                    });
                });
                </script>
            <?php endif; ?>
            <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_description.php'; ?>
        </div><?php echo $paratexxt_end; ?>
        <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_errors.php'; ?>
    </div>
</div>