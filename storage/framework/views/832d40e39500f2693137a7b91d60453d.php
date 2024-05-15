<?php
$messageString = isset($message) ? $message : "This field is required";
$styleString = isset($style) ? $style : "";
$idString = isset($id) ? "id='{$id}'" : "";
?>
<div style="<?php echo e($styleString); ?>" class="form-validation" <?php echo $idString; ?>>
    <p style="color:#FF0000;">
      <i class="fa fa-window-close"></i>  <?php echo e($messageString); ?>  
    </p>
</div>
<?php /**PATH /Users/mac/repos/admissionboox/resources/views/components/form-validation.blade.php ENDPATH**/ ?>