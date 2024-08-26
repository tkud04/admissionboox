<?php
$schoolText = intval($dashboardStats['schools']) === 1 ? "School" : "Schools";
$admissionText = intval($dashboardStats['admissions']) === 1 ? "Admission" : "Admissions";
$applicationText = intval($dashboardStats['applications']) === 1 ? "Application" : "Applications";
$userText = intval($dashboardStats['users']) === 1 ? "User" : "Users";
$smtpText = intval($dashboardStats['smtp']) === 1 ? "SMTP" : "SMTPs";
$pluginText = intval($dashboardStats['plugins']) === 1 ? "Plugin" : "Plugins";
?>
<div class="row"> 
        <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-1">
            <div class="utf_dashboard_stat_content">
              <h4>{{$dashboardStats['schools']}}</h4>
              <span>{{$schoolText}}</span>
			      </div>
            <div class="utf_dashboard_stat_icon"><i class="im im-icon-Open-Book"></i></div>
          </div>
        </div>
        
        <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-2">
            <div class="utf_dashboard_stat_content">
            <h4>{{$dashboardStats['admissions']}}</h4>
            <span>{{$admissionText}}</span>
			    </div>
            <div class="utf_dashboard_stat_icon"><i class="im im-icon-Student-Hat"></i></div>
          </div>
        </div>
        
        <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-3">
            <div class="utf_dashboard_stat_content">
            <h4>{{$dashboardStats['applications']}}</h4>
            <span>{{$applicationText}}</span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="im im-icon-Student-MaleFemale"></i></div>
          </div>
        </div>
        
        <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-4">
            <div class="utf_dashboard_stat_content">
            <h4>{{$dashboardStats['users']}}</h4>
            <span>{{$userText}}</span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="im im-icon-User"></i></div>
          </div>
        </div>
	
		<div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-5">
            <div class="utf_dashboard_stat_content">
            <h4>{{$dashboardStats['smtp']}}</h4>
            <span>{{$smtpText}}</span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="im im-icon-Email"></i></div>
          </div>
        </div>
		
        <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-6">
            <div class="utf_dashboard_stat_content">
            <h4>{{$dashboardStats['plugins']}}</h4>
            <span>{{$pluginText}}</span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="im im-icon-Gear"></i></div>
          </div>
        </div>
      </div>