<?php
$typeString = isset($type) ? $type : "";
$contentHTML = isset($content) ? $content : "This is a success notification. <strong>Important information</strong> can be highlighted!";
?>
<div class="notification <?php echo e($typeString); ?> closeable margin-bottom-30">
    <p><?php echo $contentHTML; ?></p>
    <a class="close" onclick="rn('<?php echo e($xf); ?>')"></a> 
</div><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/components/dashboard-notification.blade.php ENDPATH**/ ?>