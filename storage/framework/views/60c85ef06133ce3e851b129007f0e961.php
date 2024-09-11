<?php
$titleString = isset($title) ? $title : "";
?>
<div id="titlebar" class="gradient">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2><?php echo e($titleString); ?></h2>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
              <li><?php echo e($titleString); ?></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/components/generic-banner.blade.php ENDPATH**/ ?>