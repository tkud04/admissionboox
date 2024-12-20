<?php
if(!function_exists('getActiveClass'))
{
    function getActiveClass($activeClass,$currentClass)
{
   return $activeClass === $currentClass ? 'active' : '';
}
}


?>
<div class="utf_dashboard_navigation js-scrollbar">
        <div class="utf_dashboard_navigation_inner_block">
            <ul>
                <li class="{{getActiveClass('dashboard',$ac)}}"><a href="{{url('dashboard')}}"><i class="sl sl-icon-layers"></i> Dashboard</a></li>
                </li>
                <li class="">
                    <a href="javascript:void(0)"><i class="sl sl-icon-layers"></i> Admissions</a>
                    <ul>
                        <li><a href="{{url('school-admissions')}}">View admissions </a></li>
                        <li><a href="{{url('add-school-admission')}}">New admission</a></li>
                        <!--<li><a href="#">Admission forms</a></li>-->
                    </ul>
                </li>
                <li class="{{getActiveClass('reports',$ac)}}">
                    <a href="{{url('school-reports')}}"><i class="sl sl-icon-notebook"></i> Reports</a>
                </li>
                <li class="{{getActiveClass('email',$ac)}}"><a href="{{url('send-email')}}"><i class="sl sl-icon-envelope-open"></i> Send Email</a></li>
                <li class="{{getActiveClass('applications',$ac)}}">
                    <a href="{{url('school-applications')}}"><i class="sl sl-icon-layers"></i> Applications</a>
                </li>
                <li class="">
                    <a href="javascript:void(0)"><i class="sl sl-icon-layers"></i> Classes</a>
                    <ul>
                       <li><a href="{{url('school-classes')}}">View classes</a></li>
                       <li><a href="{{url('add-school-class')}}">New class</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="javascript:void(0)"><i class="sl sl-icon-layers"></i> FAQs</a>
                    <ul>
                       <li><a href="{{url('school-faqs')}}">View FAQs</a></li>
                       <li><a href="{{url('add-school-faq')}}">New FAQ</a></li>
                    </ul>
                </li>
                <li class="{{getActiveClass('reviews',$ac)}}">
                    <a href="{{url('school-reviews')}}"><i class="sl sl-icon-star"></i> Reviews</a>
                </li>
                <li class="{{getActiveClass('settings',$ac)}}">
                    <a href="{{url('school-settings')}}"><i class="sl sl-icon-settings"></i> Settings</a>
                </li>
                <li class="{{getActiveClass('profile',$ac)}}"><a href="{{url('profile')}}"><i class="sl sl-icon-user"></i> My Profile</a></li>
                <li class="{{getActiveClass('change-password',$ac)}}"><a href="{{url('change-password')}}"><i class="sl sl-icon-key"></i> Change Password</a></li>
                <li><a href="{{url('bye')}}"><i class="sl sl-icon-power"></i> Logout</a></li>
            </ul>
        </div>
</div>