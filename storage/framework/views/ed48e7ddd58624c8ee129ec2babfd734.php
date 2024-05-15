<?php
$notificationsArr = isset($notifications) ? $notifications : [];
$fnameString = isset($fname) ? $fname : "";

?>
<div class="dashboard_header_button_item has-noti js-item-menu">
    <i class="sl sl-icon-bell"></i>
    <div class="dashboard_notifi_dropdown js-dropdown">
        <div class="dashboard_notifi_title">
            <p>You Have 2 Notifications</p>
        </div>
        <div class="dashboard_notifi_item">
            <div class="bg-c1 red">
                <i class="fa fa-check"></i>
            </div>
            <div class="content">
                <p>Your Listing <b>Burger House (MG Road)</b> Has Been Approved!</p>
                <span class="date">2 hours ago</span>
            </div>
        </div>
        <div class="dashboard_notifi_item">
            <div class="bg-c1 green">
                <i class="fa fa-envelope"></i>
            </div>
            <div class="content">
                <p>You Have 7 Unread Messages</p>
                <span class="date">5 hours ago</span>
            </div>
        </div>
        <div class="dashboard_notify_bottom text-center pad-tb-20">
            <a href="<?php echo e(url('notifications')); ?>">View All Notification</a>
        </div>
    </div>
</div>
<div class="utf_user_menu">
    <div class="utf_user_name"><span><img src="images/dashboard-avatar.jpg" alt=""></span>Hi, <?php echo e($fnameString); ?>!</div>
    <ul>
        <li><a href="<?php echo e(url('dashboard')); ?>"><i class="sl sl-icon-layers"></i> Dashboard</a></li>
        <li><a href="<?php echo e(url('dashboard')); ?>"><i class="sl sl-icon-user"></i> My Profile</a></li>
        <li><a href="<?php echo e(url('dashboard')); ?>"><i class="sl sl-icon-list"></i> My Listing</a></li>
        <li><a href="<?php echo e(url('dashboard')); ?>"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
        <li><a href="<?php echo e(url('dashboard')); ?>"><i class="sl sl-icon-docs"></i> Booking</a></li>
        <li><a href="<?php echo e(url('bye')); ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
    </ul>
</div><?php /**PATH /Users/mac/repos/admissionboox/resources/views/components/auth-menu.blade.php ENDPATH**/ ?>