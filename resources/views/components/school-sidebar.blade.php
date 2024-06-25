<?php
function getActiveClass($activeClass,$currentClass)
{
   return $activeClass === $currentClass ? 'active' : '';
}

?>
<div class="utf_dashboard_navigation js-scrollbar">
        <div class="utf_dashboard_navigation_inner_block">
            <ul>
                <li class="{{getActiveClass('dashboard',$ac)}}"><a href="{{url('dashboard')}}"><i class="sl sl-icon-layers"></i> Dashboard</a></li>
                </li>
                <li class="{{getActiveClass('admissions',$ac)}}">
                    <a href="javascript:void(0)"><i class="sl sl-icon-layers"></i> Admissions</a>
                    <ul>
                        <li><a href="{{url('school-applications?status=active')}}">View admissions </a></li>
                        <li><a href="{{url('school-applications?status=pending')}}">New admission</a></li>
                    </ul>
                </li>
                <li class="{{getActiveClass('send-email',$ac)}}"><a href="{{url('send-email')}}"><i class="sl sl-icon-envelope-open"></i> Send Email</a></li>
                <li class="{{getActiveClass('applications',$ac)}}">
                    <a href="javascript:void(0)"><i class="sl sl-icon-layers"></i> Applications</a>
                    <ul>
                        <li><a href="{{url('school-applications?status=active')}}">Active <span class="nav-tag green">10</span></a></li>
                        <li><a href="{{url('school-applications?status=pending')}}">Pending <span class="nav-tag yellow">4</span></a></li>
                        <li><a href="{{url('school-applications?status=expired')}}">Expired <span class="nav-tag red">8</span></a></li>
                    </ul>
                </li>
                <li class="{{getActiveClass('reviews',$ac)}}">
                    <a href="{{url('reviews')}}"><i class="sl sl-icon-star"></i> Reviews</a>
                </li>
                <li class="{{getActiveClass('profile',$ac)}}"><a href="{{url('profile')}}"><i class="sl sl-icon-user"></i> My Profile</a></li>
                <li class="{{getActiveClass('change-password',$ac)}}"><a href="{{url('change-password')}}"><i class="sl sl-icon-key"></i> Change Password</a></li>
                <li><a href="{{url('bye')}}"><i class="sl sl-icon-power"></i> Logout</a></li>
            </ul>
        </div>
</div>