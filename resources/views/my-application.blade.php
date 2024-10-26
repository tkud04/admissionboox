<?php
$ac = "applications";
$useSidebar = true;
$applicant = $application['user'];
$sname = $admission['session'];
$title = "{$applicant['fname']} {$applicant['lname']} | {$sname} Session";

$avatar = strlen($applicant['avatar']) > 0 ? $u['avatar'] : "images/profile.png";
?>
@extends('dashboard_layout')

@section('dashboard-title',"{$title}")

@section('dashboard-styles')
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

	 const confirmApproveApplication = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            updateApplication(xf,'approved',
				      () => {
			       		alert('Application approved!')
					      window.location = 'school-applications'
				      },
				      (err) => {
				       	alert('Failed to remove application: ',err)
				      }
			       )
           })
        
        }

        const confirmDeclineApplication = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            updateApplication(xf,'declined',
				      () => {
			       		alert('Application declined!')
					      window.location = 'school-applications'
				      },
				      (err) => {
				       	alert('Failed to remove application: ',err)
				      }
			       )
           })
        
        }

        const hideValidationErrors = () => {
          $('#sa-admission-validation').hide()
        }

      const initCharts = () => {
        const options = {
           chart: {
            type: 'line'
           }, 
           series: [{
             name: 'sales',
             data: [30,40,35,50,49,60,70,91,125]
           }],
           xaxis: {
             categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
           }
         }

         renderChart('#test-chart-div',options)
      }

      const initProgressBar = () => {
        const options = {
            strokeWidth: 4,
            easing: 'easeInOut',
            duration: 1400,
            color: '#FF7600',
            trailColor: '#eee',
            trailWidth: 1,
            svgStyle: {width: '100%', height: '100%'},
            text: {
              style: {
                // Text color.
                // Default: same as stroke color (options.color)
                color: '#999',
                position: 'absolute',
                right: '0',
                top: '30px',
                padding: 0,
                margin: 0,
                transform: null
              },
              autoStyleContainer: false
            },
            from: {color: '#FF7100'},
            to: {color: '#FF7600'},
            step: (state, bar) => {
              $('#admission-progress-bar-text').html(Math.round(bar.value() * 100) + ' %');
            }
          }
      
          renderProgressBar('#admission-progress-bar',options)

        
      }

    $(document).ready(() =>{
      //initCharts()
      initProgressBar()
    })
		
	
  </script>
@stop

@section('dashboard-content')

<div class="row">
   <div class="col-lg-12 col-md-12" id="applications-div-1">
       <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i>  Admission Progress</h3>
          </div>

          <div class="utf_submit_section">
             <div style="display: flex; flex-direction:row;">
               <div id="admission-progress-bar" style="display: flex; align-self:center; margin: 20px; margin-bottom: 5px;  width: 80%; height: 10px;"></div>
               <p id="admission-progress-bar-text" style="display: flex; margin-top: 25px;"></p>
             </div>
             <div id="test-chart-div"></div>
          </div>
       </div>
       <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i>  Applicant Bio</h3>
          </div>

          <div class="utf_submit_section">
            <div class="row">
                <div class="col-md-6">
                <ul>
             <li class="utf_approved_booking_listing" style="list-style-type: none">
				<div class="utf_list_box_listing_item bookings">
				  <div class="utf_list_box_listing_item-img"><img src="{{$avatar}}" alt=""></div>
				  <div class="utf_list_box_listing_item_content">
					<div class="inner">
					  <h3>{{$applicant['fname']}} {{$applicant['lname']}} <span class="utf_booking_listing_status">soemthing</span></h3>
            <div class="utf_inner_booking_listing_list">
						<h5>Application Opened:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted">{{$admission['date']}}</li>
						</ul>
					  </div>	
            <div class="utf_inner_booking_listing_list">
						<h5>Date Applied:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted">{{$applicant['date']}}</li>
						</ul>
					  </div>
					  <div class="utf_inner_booking_listing_list">
						<h5>Application Deadline:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted">{{$admission['end_date_formatted']}}</li>
						</ul>
					  </div>	  					  
					</div>
				  </div>
				</div>
				<div class="buttons-to-right"> 
        <a href="#" class="button gray"><i class="fa fa-eye"></i> View</a> 
          <?php
          $status = "";
           if($status === "pending")
           {
          ?>
             <a href="#" onclick="confirmApproveApplication('{{$applicationId}}')" class="button gray"><i class="fa fa-check"></i> Approve</a> 
             <a href="#" onclick="confirmDeclineApplication('{{$applicationId}}')" class="button gray reject"><i class="sl sl-icon-close"></i> Decline</a> 
          <?php
           }
          ?>
         
        </div>
			  </li>
             </ul>
                </div>
                <div class="col-md-6">
                <ul>
             <li class="utf_approved_booking_listing" style="list-style-type: none">
				<div class="utf_list_box_listing_item bookings">
				  <div class="utf_list_box_listing_item_content">
					<div class="inner">
					  <h3></h3><br>
            <div class="utf_inner_booking_listing_list">
						<h5>Examination date:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted">{{$application['date_slot']}}</li>
						</ul>
					  </div>	
            <div class="utf_inner_booking_listing_list">
						<h5>Examination time:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted">{{$timeSlots[$application['time_slot']]}}</li>
						</ul>
					  </div>
					 <!-- <div class="utf_inner_booking_listing_list">
						<h5>Application Deadline:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted">{{$admission['end_date_formatted']}}</li>
						</ul>
					  </div> -->  					  
					</div>
				  </div>
				</div>
				<div class="buttons-to-right"> 
        <a href="#" class="button gray"><i class="fa fa-eye"></i> View</a> 
          <?php
          $status = "";
           if($status === "pending")
           {
          ?>
             <a href="#" onclick="confirmApproveApplication('{{$applicationId}}')" class="button gray"><i class="fa fa-check"></i> Approve</a> 
             <a href="#" onclick="confirmDeclineApplication('{{$applicationId}}')" class="button gray reject"><i class="sl sl-icon-close"></i> Decline</a> 
          <?php
           }
          ?>
         
        </div>
			  </li>
             </ul>
                </div>
            </div>
            
          </div>
       </div>

       <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i>  Applicant Files</h3>
          </div>

          <div class="utf_submit_section">
             
          </div>
       </div>
   </div>   
</div>
      
@stop