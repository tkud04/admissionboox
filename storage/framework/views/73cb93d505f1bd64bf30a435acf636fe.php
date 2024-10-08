<?php
if(!function_exists('getActiveClass'))
{
    function getActiveClass($activeClass,$currentClass)
{
   return $activeClass === $currentClass ? 'active' : '';
}
}

$activeApplications = [];  $pendingApplications = []; $expiredApplications = [];

 foreach($schoolApplications as $sa)
 {
    if($sa['stage'] === 'pending')
    {
         array_push($pendingApplications,$sa);
    }
    else
    {
        if($sa['stage'] === 'active')
        {
            array_push($activeApplications,$sa);
        } 
        else if($sa['stage'] === 'expired')
        {
            array_push($expiredApplications,$sa);
        } 
    }
 }

?>
<div class="utf_dashboard_navigation js-scrollbar">
        <div class="utf_dashboard_navigation_inner_block">
            <ul>
                <li class="<?php echo e(getActiveClass('dashboard',$ac)); ?>"><a href="<?php echo e(url('dashboard')); ?>"><i class="sl sl-icon-layers"></i> Dashboard</a></li>
                </li>
                <li class="<?php echo e(getActiveClass('applications',$ac)); ?>">
                    <a href="javascript:void(0)"><i class="sl sl-icon-layers"></i> My Applications</a>
                    <ul>
                        <li><a href="<?php echo e(url('my-applications?status=active')); ?>">Active <span class="nav-tag green"><?php echo e(count($activeApplications)); ?></span></a></li>
                        <li><a href="<?php echo e(url('my-applications?status=pending')); ?>">Pending <span class="nav-tag yellow"><?php echo e(count($pendingApplications)); ?></span></a></li>
                        <li><a href="<?php echo e(url('my-applications?status=expired')); ?>">Expired <span class="nav-tag red"><?php echo e(count($expiredApplications)); ?></span></a></li>
                    </ul>
                </li>
                <li class="<?php echo e(getActiveClass('messages',$ac)); ?>"><a href="<?php echo e(url('messages')); ?>"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
                <li class="<?php echo e(getActiveClass('reviews',$ac)); ?>">
                    <a href="javascript:void(0)"><i class="sl sl-icon-star"></i> Reviews</a>
                    <ul>
                        <li><a href="#">Visitor Reviews <span class="nav-tag green">4</span></a></li>
                        <li><a href="#">Submitted Reviews <span class="nav-tag yellow">5</span></a></li>
                    </ul>
                </li>
                <li class="<?php echo e(getActiveClass('bookmarks',$ac)); ?>"><a href="<?php echo e(url('bookmarks')); ?>"><i class="sl sl-icon-heart"></i> Bookmark</a></li>
                <li class="<?php echo e(getActiveClass('profile',$ac)); ?>"><a href="<?php echo e(url('profile')); ?>"><i class="sl sl-icon-user"></i> My Profile</a></li>
                <li class="<?php echo e(getActiveClass('change-password',$ac)); ?>"><a href="<?php echo e(url('change-password')); ?>"><i class="sl sl-icon-key"></i> Change Password</a></li>
                <li><a href="<?php echo e(url('bye')); ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
            </ul>
        </div>
</div><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/components/user-sidebar.blade.php ENDPATH**/ ?>