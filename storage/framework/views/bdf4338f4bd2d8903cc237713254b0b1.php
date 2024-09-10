<?php
$void = 'javascript:void(0)';
$isDashboard = true;
$v2 = isset($useAdminSidebar) ? $useAdminSidebar : false;
$v3 = isset($useSidebar) ? $useSidebar : true;
$isBlankLayout = isset($ibl) ? $ibl : false;
?>



<?php $__env->startSection('title'); ?>
 <?php echo $__env->yieldContent('dashboard-title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
  <?php echo $__env->yieldContent('dashboard-styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <?php echo $__env->yieldContent('dashboard-scripts'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
if($isBlankLayout)
{
?>
<?php echo $__env->yieldContent('dashboard-content'); ?>
<?php
}

else
{
?>
<div id="dashboard">
    
     <?php if($v3): ?>
     <a href="#" class="utf_dashboard_nav_responsive"><i class="fa fa-reorder"></i> Dashboard Sidebar Menu</a>
       <?php if($user->role === 'admin' || $user->role === 'su'): ?>
         <?php echo $__env->make('components.admin-sidebar',['ac' => $ac], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       <?php else: ?>
        <?php if($user->role === 'school_admin'): ?>
         <?php echo $__env->make('components.school-sidebar',['ac' => $ac], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
         <?php echo $__env->make('components.user-sidebar',['ac' => $ac], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
       <?php endif; ?>
     <?php endif; ?>
     <div class="utf_dashboard_content">
     <div id="titlebar" class="dashboard_gradient">
        <div class="row">
          <div class="col-md-12">
            <h2><?php echo $__env->yieldContent('dashboard-title'); ?></h2>
            <nav id="breadcrumbs">
              <ul>
                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li><?php echo $__env->yieldContent('dashboard-title'); ?></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
         <?php echo $__env->yieldContent('dashboard-content'); ?>

         <div class="row">
             <div class="col-md-12">
                 <div class="footer_copyright_part">Copyright &copy; <?php echo e(date('Y')); ?>, All Rights Reserved.</div>
             </div>
         </div>
     </div> 
</div>
<?php
}
?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/dashboard_layout.blade.php ENDPATH**/ ?>