<?php
$void = 'javascript:void(0)';
?>


<?php $__env->startSection('title',"Welcome"); ?>

<?php $__env->startSection('scripts'); ?>
<script src="js/typed.js"></script>
    <script>
        var typed = new Typed('.typed-words', {
            strings: <?php echo json_encode($typedTexts); ?>,
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 4000,
            startDelay: 1000,
            loop: true,
            showCursor: true
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('components.home-search',['locations' => $locations], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('components.listing-categories',['categories' => $categories], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/repos/admissionboox/resources/views/index.blade.php ENDPATH**/ ?>