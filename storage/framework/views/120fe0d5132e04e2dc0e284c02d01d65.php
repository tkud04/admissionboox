<?php
$ac = "dashboard";
?>


<?php $__env->startSection('dashboard-title',"Dashboard"); ?>

<?php $__env->startSection('dashboard-content'); ?>
  <?php if(count($notifications) > 0): ?>
  <div class="row">
        <div class="col-md-12">
         <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php echo $__env->make('components.dashboard-notification',[
            'type' => $n['type'],
            'content' => isset($n['content']) ? $n['content'] : "",
            'xf' => $n['id']
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
  </div>
  <?php endif; ?>

  <div class="row">
    <div class="col-lg-6 col-md-12">
    <div class="utf_dashboard_list_box with-icons margin-top-20">
      <h4>Recent Updates</h4>
      <ul>
        <?php
         if(count($notifications) > 0)
         {
           foreach($notifications as $ru){
        ?>
         <?php echo $__env->make('components.recent-updates-widget',$ru, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php
         }
        }
        else
        {
        ?>
         <li><i class="utf_list_box_icon sl sl-icon-eyeglass"></i> No new updates yet. </strong>
      </li>
        <?php
        }
       ?>
      
      </ul>
    </div>
       
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="utf_dashboard_list_box invoices with-icons margin-top-20">
            <h4>All Applications</h4>
            <ul>
        <?php
         if(count($schoolApplications) > 0)
         {
         foreach($schoolApplications as $sa)
         {
          $iid = "shdj3";
          $iu = url('application-invoice')."?xf=".$iid;
          $u = $sa['user'];
          $a = $sa['admission'];
          $term = ['name' => "", 'value' => '0'];

          foreach($terms as $t)
                    {
                      if($t['value'] === $a['term_id']) $term = $t;
                    }
        ?>
      <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong><?php echo e($a['session']); ?> <span
          class="paid">Paid</span></strong>
        <ul>
        <li>
          <p>
            <span>Applicant:-</span> <?php echo e($u['fname']); ?> <?php echo e($u['lname']); ?><br>
            <span>Term selected:-</span> <?php echo e($term['name']); ?>

          </p>
        </li>
        </ul>
        <div class="buttons-to-right"> <a href="<?php echo e($iu); ?>" target="_blank" class="button gray"><i
          class="sl sl-icon-printer"></i> Invoice</a> </div>
      </li>
       <?php
         }
        }
        else
        {
        ?>
         <li><i class="utf_list_box_icon sl sl-icon-eyeglass"></i> No applications yet. <a href="<?php echo e(url('school-admissions')); ?>">View admissions</a></strong>
      </li>
        <?php
        }
       ?>
      </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/dashboard.blade.php ENDPATH**/ ?>