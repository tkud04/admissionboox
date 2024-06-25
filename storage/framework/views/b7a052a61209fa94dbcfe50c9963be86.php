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
                        <li><a href="<?php echo e(url('school-applications?status=active')); ?>">View admissions </a></li>
                        <li><a href="<?php echo e(url('school-applications?status=pending')); ?>">New admission</a></li>
                    </ul>
                </li>
                <li class="<?php echo e(getActiveClass('send-email',$ac)); ?>"><a href="<?php echo e(url('send-email')); ?>"><i class="sl sl-icon-envelope-open"></i> Send Email</a></li>
                <li class="<?php echo e(getActiveClass('applications',$ac)); ?>">
                    <a href="javascript:void(0)"><i class="sl sl-icon-layers"></i> Applications</a>
                    <ul>
                        <li><a href="<?php echo e(url('school-applications?status=active')); ?>">Active <span class="nav-tag green">10</span></a></li>
                        <li><a href="<?php echo e(url('school-applications?status=pending')); ?>">Pending <span class="nav-tag yellow">4</span></a></li>
                        <li><a href="<?php echo e(url('school-applications?status=expired')); ?>">Expired <span class="nav-tag red">8</span></a></li>
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
</div><?php /**PATH /Users/mac/repos/admissionboox/resources/views/components/school-sidebar.blade.php ENDPATH**/ ?>