<?php
/**
 * Adds a button to copy a self link to the clipboard.
 * The button is visible on the details page of a document.
 */
class CopySelfLink extends Plugin {

    function onAdminMenu() {
        $current_directory = dirname(__FILE__);
        $GLOBALS['smarty']->display('file:' . $current_directory . '/templates/copy_self_link.tpl');
    }

    function onAfterDetails($file_id) {
        $self_link = $GLOBALS['CONFIG']['base_url'] . 'details.php?id=' . $file_id;
        $GLOBALS['smarty']->assign('self_link', $self_link);

        $current_directory = dirname(__FILE__);
        $GLOBALS['smarty']->display('file:' . $current_directory . '/templates/copy_self_link_button.tpl');
    }
}
