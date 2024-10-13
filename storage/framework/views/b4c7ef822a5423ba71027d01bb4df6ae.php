<?php
$ac = "applications";
$useSidebar = true;
$applicant = $application['user'];
$sname = $admission['session'];
$title = "{$applicant['fname']} {$applicant['lname']} | {$sname} Session";

$avatar = strlen($applicant['avatar']) > 0 ? $u['avatar'] : "images/profile.png";
?>


<?php $__env->startSection('dashboard-title',"{$title}"); ?>

<?php $__env->startSection('dashboard-styles'); ?>
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-scripts'); ?>
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


    $(document).ready(() =>{
     
    })
		
	
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-content'); ?>

<div class="row">
   <div class="col-lg-12 col-md-12" id="applications-div-1">
       <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i>  Admission Progress</h3>
          </div>

          <div class="utf_submit_section">
             
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
				  <div class="utf_list_box_listing_item-img"><img src="<?php echo e($avatar); ?>" alt=""></div>
				  <div class="utf_list_box_listing_item_content">
					<div class="inner">
					  <h3><?php echo e($applicant['fname']); ?> <?php echo e($applicant['lname']); ?> <span class="utf_booking_listing_status">soemthing</span></h3>
            <div class="utf_inner_booking_listing_list">
						<h5>Application Opened:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted"><?php echo e($admission['date']); ?></li>
						</ul>
					  </div>	
            <div class="utf_inner_booking_listing_list">
						<h5>Date Applied:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted"><?php echo e($applicant['date']); ?></li>
						</ul>
					  </div>
					  <div class="utf_inner_booking_listing_list">
						<h5>Application Deadline:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted"><?php echo e($admission['end_date_formatted']); ?></li>
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
             <a href="#" onclick="confirmApproveApplication('<?php echo e($applicationId); ?>')" class="button gray"><i class="fa fa-check"></i> Approve</a> 
             <a href="#" onclick="confirmDeclineApplication('<?php echo e($applicationId); ?>')" class="button gray reject"><i class="sl sl-icon-close"></i> Decline</a> 
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
						  <li class="highlighted"><?php echo e($application['date_slot']); ?></li>
						</ul>
					  </div>	
            <div class="utf_inner_booking_listing_list">
						<h5>Examination time:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted"><?php echo e($timeSlots[$application['time_slot']]); ?></li>
						</ul>
					  </div>
					 <!-- <div class="utf_inner_booking_listing_list">
						<h5>Application Deadline:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted"><?php echo e($admission['end_date_formatted']); ?></li>
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
             <a href="#" onclick="confirmApproveApplication('<?php echo e($applicationId); ?>')" class="button gray"><i class="fa fa-check"></i> Approve</a> 
             <a href="#" onclick="confirmDeclineApplication('<?php echo e($applicationId); ?>')" class="button gray reject"><i class="sl sl-icon-close"></i> Decline</a> 
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
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/my-application.blade.php ENDPATH**/ ?>