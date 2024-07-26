<?php
$messageString = isset($message) ? $message : "";
$styleString = isset($style) ? $style : "";
$idString = isset($id) ? "id='{$id}'" : "";
?>
<div style="<?php echo e($styleString); ?>" class="form-loading" <?php echo $idString; ?>>
    <p style="color:#000000;">
       <?php echo e($messageString); ?>  <img src="images/loading.gif" class="img img-esponsive" style="width: 20px; height: 20px;">
    </p>
</div>
<?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/components/generic-loading.blade.php ENDPATH**/ ?>