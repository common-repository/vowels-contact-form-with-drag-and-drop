<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;

$newline = vowels_form_builder_get_email_newline();
echo $mailer->Subject . $newline . $newline;

foreach ($form->getElements() as $element) {
    if (!$element->isHidden() && (!$element->isEmpty() || ($element->isEmpty() && $form->getNotificationShowEmptyFields()))) {
        if ($element instanceof vowelsforminc_Element_Groupstart) {
            if ($element->getShowNameInEmail() && strlen($adminTitle = $element->getAdminTitle())) {
                echo '=========================' . $newline;
                echo $adminTitle. $newline;
                echo '=========================';
            }
        } else {
            echo $element->getAdminLabel() . $newline;
            echo '------------------------' . $newline;
            echo $element->getValuePlain($newline);
        }
        echo $newline . $newline;
    }
}