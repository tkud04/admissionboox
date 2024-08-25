<?php
 $activeSchools = [];  $pendingSchools = []; 
 foreach($menuSchools as $s)
 {
    if($s['status'] === 'active') array_push($activeSchools,$s);
    else if($s['status'] === 'pending') array_push($pendingSchools,$s);
 }

 $su = url('my-schools'); $asu = $su."?xf=active"; $psu = $su."?xf=pending";
?>

<div class="utf_dashboard_navigation js-scrollbar">
        <div class="utf_dashboard_navigation_inner_block">
            <ul>
                <li><a href="{{url('dashboard')}}"><i class="sl sl-icon-layers"></i> Dashboard</a></li>
               
                <li>
                    <a href="{{url('admin-school-admissions')}}"><i class="sl sl-icon-doc"></i> Admissions</a>
                </li>
                <li>
                    <a href="javascript:void(0)"><i class="sl sl-icon-graduation"></i> Schools</a>
                    <ul>
                        <li><a href="{{$asu}}">Active <span class="nav-tag green">{{count($activeSchools)}}</span></a></li>
                        <li><a href="{{$psu}}">Pending <span class="nav-tag yellow">{{count($pendingSchools)}}</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)"><i class="sl sl-icon-people"></i> Clubs</a>
                    <ul>
                        <li><a href="{{url('add-club')}}"> <i class="sl sl-icon-plus"></i> Add Club </a></li>
                        <li><a href="{{url('clubs')}}"> <i class="sl sl-icon-people"></i> View Clubs </a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)"><i class="sl sl-icon-directions"></i> Facilities</a>
                    <ul>
                        <li><a href="{{url('add-facility')}}"><i class="sl sl-icon-plus"></i> Add Facility </a></li>
                        <li><a href="{{url('facilities')}}"> <i class="sl sl-icon-layers"></i> View Facilities </a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)"><i class="sl sl-icon-wrench"></i> Plugins</a>
                    <ul>
                        <li><a href="{{url('add-plugin')}}"><i class="sl sl-icon-plus"></i> Add Plugin </a></li>
                        <li><a href="{{url('plugins')}}"> <i class="sl sl-icon-layers"></i> View Plugins </a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)"><i class="sl sl-icon-envelope-open"></i> SMTP Settings</a>
                    <ul>
                        <li><a href="{{url('add-sender')}}"><i class="sl sl-icon-plus"></i> Add SMTP setting </a></li>
                        <li><a href="{{url('senders')}}"> <i class="sl sl-icon-layers"></i> View SMTP settings </a></li>
                    </ul>
                </li>
               
                 <!--<li>
                    <a href="javascript:void(0)"><i class="sl sl-icon-star"></i> Reviews</a>
                    <ul>
                        <li><a href="{{url('reviews')}}">Approved <span class="nav-tag green">4</span></a></li>
                        <li><a href="{{url('reviews')}}">Pending <span class="nav-tag yellow">5</span></a></li>
                    </ul>
                </li>-->
                <li><a href="{{url('profile')}}"><i class="sl sl-icon-user"></i> My Profile</a></li>
                <li><a href="{{url('change-password')}}"><i class="sl sl-icon-key"></i> Change Password</a></li>
                <li><a href="{{url('bye')}}"><i class="sl sl-icon-power"></i> Logout</a></li>
            </ul>
        </div>
</div>