<?php
function getActiveClass($activeClass,$currentClass)
{
   return $activeClass === $currentClass ? 'active' : '';
}

?>
<div class="utf_dashboard_navigation js-scrollbar">
        <div class="utf_dashboard_navigation_inner_block">
            <ul>
                <li class="<?php echo e(getActiveClass('dashboard',$ac)); ?>"><a href="<?php echo e(url('dashboard')); ?>"><i class="sl sl-icon-layers"></i> Dashboard</a></li>
                </li>
                <li class="<?php echo e(getActiveClass('admissions',$ac)); ?>">
                    <a href="javascript:void(0)"><i class="sl sl-icon-layers"></i> Admissions</a>
                    <ul>
                        <li><a href="<?php echo e(url('school-admissions')); ?>">View admissions </a></li>
                        <li><a href="<?php echo e(url('add-school-admission')); ?>">New admission</a></li>
                        <!--<li><a href="#">Admission forms</a></li>-->
                    </ul>
                </li>
                <li class="<?php echo e(getActiveClass('email',$ac)); ?>"><a href="<?php echo e(url('send-email')); ?>"><i class="sl sl-icon-envelope-open"></i> Send Email</a></li>
                <li class="<?php echo e(getActiveClass('applications',$ac)); ?>">
                    <a href="<?php echo e(url('school-applications')); ?>"><i class="sl sl-icon-layers"></i> Applications</a>
                </li>
                <li class="<?php echo e(getActiveClass('classes',$ac)); ?>">
                    <a href="javascript:void(0)"><i class="sl sl-icon-layers"></i> Classes</a>
                    <ul>
                       <li><a href="<?php echo e(url('school-classes')); ?>">View classes</a></li>
                       <li><a href="<?php echo e(url('add-school-class')); ?>">New class</a></li>
                    </ul>
                </li>
                <li class="<?php echo e(getActiveClass('reviews',$ac)); ?>">
                    <a href="<?php echo e(url('reviews')); ?>"><i class="sl sl-icon-star"></i> Reviews</a>
                </li>
                <li class="<?php echo e(getActiveClass('profile',$ac)); ?>"><a href="<?php echo e(url('profile')); ?>"><i class="sl sl-icon-user"></i> My Profile</a></li>
                <li class="<?php echo e(getActiveClass('change-password',$ac)); ?>"><a href="<?php echo e(url('change-password')); ?>"><i class="sl sl-icon-key"></i> Change Password</a></li>
                <li><a href="<?php echo e(url('bye')); ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
            </ul>
        </div>
</div><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/components/school-sidebar.blade.php ENDPATH**/ ?>