<?php
$ac = "reports";
$useSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"Reports")

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
					      window.location = 'school-reports'
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


    $(document).ready(() =>{
      $('#sr-btn').click((e) => {
         e.preventDefault()
         const rtype = $('#sr-type').val(), v = rtype === 'none'

         if(v){
          $('#sr-type-validation').fadeIn()
         } 
         else{
          const currentPage = "{{$currentPage}}"
          //window.location = `school-applications?xf=${admissionId}&page=${currentPage}`
        }
      })
    })
		
	
  </script>
@stop

@section('dashboard-content')

<div class="row">
        <?php
         if($hasSelectedReport)
         {
        ?>
        <div class="col-lg-12 col-md-12" id="applications-div-1">
          <div class="utf_dashboard_list_box margin-top-0">
			     <div class="sort-by my_sort_by">
           <div class="utf_sort_by_select_item">
                  <select data-placeholder="Items per page" class="utf_chosen_select_single" style="display: none;" id="items-select">
                    <option>7 items per page</option>
                  </select>
                  
                </div>
                <div class="utf_sort_by_select_item" style="margin-right: 10px;">
                  <select data-placeholder="All applications" class="utf_chosen_select_single" style="display: none;" id="applications-select">
                    <option>All applications</option>
                  </select>
                  
                </div>
                
            </div>
            <h4><i class="sl sl-icon-list"></i> Applications</h4>
            <ul>
              <?php
               if(count($applications) > 0)
               {
                foreach($applications as $a)
                {
                  $u = $a['user'];
                  $applicationId = $a['id'];
                  $status = $a['status']; $v = $status === 'active';
                  $styleString = "";
                  $isDeclined = $status === 'declined';

                  if($status === 'approved')
                  {
                    $styleString = "";
                  }
                  else if($status === 'pending')
                  {
                    $pendingStyleString = " style=\"background-color: orange; \"";
                    $styleString = " ".$pendingStyleString;
                  }
                  else if($status === "expired")
                  {
                    $expiredStyleString = " style=\"background-color: gray; \"";
                    $styleString = " ".$expiredStyleString;
                  }
                  else
                  {
                    $expiredStyleString = " style=\"background-color: red; \"";
                    $styleString = " ".$expiredStyleString;
                  }
                  
                  $avatar = strlen($u['avatar']) > 0 ? $u['avatar'] : "images/profile.png";
                  
                   $statusText = ucwords($status);

                   $vu = "school-application?xf={$applicationId}";
              ?>
                 <li class="utf_approved_booking_listing">
				<div class="utf_list_box_listing_item bookings">
				  <div class="utf_list_box_listing_item-img">
          <a href="{{$vu}}"><img src="{{$avatar}}" alt=""></a>
          </div>
				  <div class="utf_list_box_listing_item_content">
					<div class="inner">
					  <a href="{{$vu}}"><h3>{{$u['fname']}} {{$u['lname']}} <span class="utf_booking_listing_status"{!!$styleString!!}>{{$statusText}}</span></h3></a>
            <div class="utf_inner_booking_listing_list">
						<h5>Application Opened:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted">{{$admission['date']}}</li>
						</ul>
					  </div>	
            <div class="utf_inner_booking_listing_list">
						<h5>Date Applied:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted">{{$a['date']}}</li>
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
        <a href="{{$vu}}" class="button gray"><i class="fa fa-eye"></i> View</a> 
          <?php
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
              <?php
                }
               }
               else
               {
              ?>
               <div style="margin-top: 60px;">
              <p class="text-center"><i class="im im-icon-Student-Hat" style="font-size: 200px;"></i></p>
               <p class="text-center">
                   There are no applications on record.
                </p>

              
               </div>
                
              <?php
               }
              ?>
            
             
            </ul>
          </div>
		      <div class="clearfix"></div>
          @if(count($applications) > 0)
            @include('components.pagination',[
              'url' => "school-applications?xf=".$admission['id'],
              'currentPage' => $currentPage,
              'numPages' => $numPages,
              ])
          @endif
        </div>
        
        <?php
         }
        else
         {
        ?>
          <div class="col-lg-12 col-md-12" id="applications-div-1">
        <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i>  Reports</h3>
          </div>

          <div class="utf_submit_section">
             <div class="row with-forms">
                 <div class="col-md-12">
                     @include('components.form-validation', ['id' => "sr-type-validation",'style' => "margin-top: 10px;"])
                     <h5>Select type</h5>
                     <select id="sr-type" class="selectpicker default" data-selected-text-format="count" data-size="{{count($reportTypes)}}" title="Select session" tabindex="-98">
                     <option class="bs-title-option" value="none">Select report type</option>
                     <?php
                      foreach($reportTypes as $t)
                       {
                     ?>
                       <option value="{{$t['value']}}">{{$t['label']}}</option>
                     <?php
                       }
                     ?>
                    </select>
                 </div>

                

                 <div class="col-md-12">
                   @include('components.button',[
                     'href' => '#',
                     'id' => 'sr-btn',
                     'title' => 'Next',
                     'classes' => 'margin-top-20'
                    ])
               </div>
             </div>
          </div>
       </div>
        </div>
        <?php
         }
        ?>
       
      </div>
      
@stop