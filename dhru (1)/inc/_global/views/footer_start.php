<?php
/**
 * footer_start.php
 *
 * Author: pixelcave
 *
 * All vital JS scripts are included here
 *
 */
?>

<!--
    OneUI JS

    Core libraries and functionality
    webpack is putting everything together at assets/_js/main/app.js
-->
<script src="<?php echo $one->assets_folder; ?>/js/oneui.app.min.js"></script>

<!-- jQuery (required for jQuery Validation plugin) -->
<?php $one->get_js('js/lib/jquery.min.js'); ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/bootstrap-notify/bootstrap-notify.min.js'); ?>

<!-- Page JS Helpers (BS Notify Plugin) -->
<script>One.helpersOnLoad(['jq-notify']);</script>

<script><?php echo $alert;?></script>
