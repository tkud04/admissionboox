<?php
 $iconHTML = isset($icon) ? $icon : "";
 $hrefString = isset($href) ? $href : "";
 $classesString = isset($classes) ? $classes : "";
 $titleString = isset($title) ? $title : "";
 $idString = isset($id) ? $id : "";
?>

<a href="<?php echo e($hrefString); ?>" id="<?php echo e($idString); ?>" class="button border <?php echo e($classesString); ?>">
    <?php echo $iconHTML; ?><?php echo e($titleString); ?>

</a> <?php /**PATH /Users/mac/repos/admissionboox/resources/views/components/button.blade.php ENDPATH**/ ?>