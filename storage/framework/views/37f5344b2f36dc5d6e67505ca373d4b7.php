<?php
$ac = "applications";
$useSidebar = true;
?>


<?php $__env->startSection('dashboard-title',"Applications"); ?>

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
      $('#sa-btn-1').click((e) => {
         e.preventDefault()
         const admissionId = $('#sa-admission').val(), v = admissionId === 'none'

         if(v){
          $('#sa-admission-validation').fadeIn()
         } 
         else{
          const currentPage = "<?php echo e($currentPage); ?>"
          window.location = `school-applications?xf=${admissionId}&page=${currentPage}`
        }
      })
    })
		
	
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-content'); ?>

<div class="row">
        <?php
         if($hasSelectedAdmission)
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
          <a href="<?php echo e($vu); ?>"><img src="<?php echo e($avatar); ?>" alt=""></a>
          </div>
				  <div class="utf_list_box_listing_item_content">
					<div class="inner">
					  <a href="<?php echo e($vu); ?>"><h3><?php echo e($u['fname']); ?> <?php echo e($u['lname']); ?> <span class="utf_booking_listing_status"<?php echo $styleString; ?>><?php echo e($statusText); ?></span></h3></a>
            <div class="utf_inner_booking_listing_list">
						<h5>Application Opened:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted"><?php echo e($admission['date']); ?></li>
						</ul>
					  </div>	
            <div class="utf_inner_booking_listing_list">
						<h5>Date Applied:-</h5>
						<ul class="utf_booking_listing_list">
						  <li class="highlighted"><?php echo e($a['date']); ?></li>
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
        <a href="<?php echo e($vu); ?>" class="button gray"><i class="fa fa-eye"></i> View</a> 
          <?php
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
          <?php if(count($applications) > 0): ?>
            <?php echo $__env->make('components.pagination',[
              'url' => "school-applications?xf=".$admission['id'],
              'currentPage' => $currentPage,
              'numPages' => $numPages,
              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>
        </div>
        
        <?php
         }
        else
         {
        ?>
          <div class="col-lg-12 col-md-12" id="applications-div-1">
        <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i>  Applications</h3>
          </div>

          <div class="utf_submit_section">
             <div class="row with-forms">
                 <div class="col-md-12">
                     <?php echo $__env->make('components.form-validation', ['id' => "sa-admission-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     <h5>Admission Session</h5>
                     <select id="sa-admission" class="selectpicker default" data-selected-text-format="count" data-size="<?php echo e(count($schoolAdmissions)); ?>" title="Select session" tabindex="-98">
                     <option class="bs-title-option" value="none">Select admission</option>
                     <?php
                      foreach($schoolAdmissions as $a)
                       {
                     ?>
                       <option value="<?php echo e($a['id']); ?>"><?php echo e($a['session']); ?> session</option>
                     <?php
                       }
                     ?>
                    </select>
                 </div>

                

                 <div class="col-md-12">
                   <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'id' => 'sa-btn-1',
                     'title' => 'Next',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               </div>
             </div>
          </div>
       </div>
        </div>
        <?php
         }
        ?>
       
      </div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/my-applications.blade.php ENDPATH**/ ?>