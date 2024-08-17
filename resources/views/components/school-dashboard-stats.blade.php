<?php
$admissionText = intval($dashboardStats['admissions']) === 1 ? "Admission" : "Admissions";
$classesText = intval($dashboardStats['classes']) === 1 ? "Class" : "Classes";
$facilitiesText = intval($dashboardStats['facilities']) === 1 ? "Facility" : "Facilities";
$reviewsText = intval($dashboardStats['reviews']) === 1 ? "Review" : "Reviews";
?>
<div class="row"> 
        <div class="col-lg-3 col-md-6">
          <div class="utf_dashboard_stat color-1">
            <div class="utf_dashboard_stat_content">
              <h4>{{$dashboardStats['admissions']}}</h4>
              <span>{{$admissionText}}</span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="im im-icon-Student-Hat2"></i></div>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
          <div class="utf_dashboard_stat color-2">
            <div class="utf_dashboard_stat_content">
              <h4>{{$dashboardStats['classes']}}</h4>
              <span>{{$classesText}}</span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="im im-icon-Folders"></i></div>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
          <div class="utf_dashboard_stat color-3">
            <div class="utf_dashboard_stat_content">
              <h4>{{$dashboardStats['facilities']}}</h4>
              <span>{{$facilitiesText}}</span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="im im-icon-Electricity"></i></div>
          </div>
        </div>
        
     
		
        <div class="col-lg-3 col-md-6">
          <div class="utf_dashboard_stat color-6">
            <div class="utf_dashboard_stat_content">
              <h4>{{$dashboardStats['reviews']}}</h4>
              <span>{{$reviewsText}}</span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="im im-icon-Star"></i></div>
          </div>
        </div>
      </div>