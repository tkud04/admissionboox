<?php
 $iconHTML = isset($icon) ? $icon : "";
 $hrefString = isset($href) ? $href : "";
 $classesString = isset($classes) ? $classes : "";
 $titleString = isset($title) ? $title : "";
 $idString = isset($id) ? $id : "";
 $styleString = isset($style) ? $style : "";
?>

<a href="<?php echo e($hrefString); ?>" id="<?php echo e($idString); ?>" class="button border <?php echo e($classesString); ?>" style="<?php echo e($styleString); ?>">
    <?php echo $iconHTML; ?><?php echo e($titleString); ?>

</a> <?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/components/button.blade.php ENDPATH**/ ?>