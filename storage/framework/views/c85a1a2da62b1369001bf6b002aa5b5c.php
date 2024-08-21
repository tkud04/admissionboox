<?php
$ac = "reviews";
$useSidebar = true;
?>


<?php $__env->startSection('dashboard-title',"Reviews"); ?>

<?php $__env->startSection('dashboard-styles'); ?>
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-scripts'); ?>
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

	 const confirmRemoveReview = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            removeSchoolReview(xf,
				      () => {
			       		alert('Review removed!')
					      window.location = 'school-reviews'
				      },
				      (err) => {
				       	alert('Failed to remove review: ',err)
				      }
			       )
           })
        
        }

        const confirmUpdateReview = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            updateSchoolReview(xf,
				      () => {
			       		alert('Review status removed!')
					      window.location = 'school-reviews'
				      },
				      (err) => {
				       	alert('Failed to update review: ',err)
				      }
			       )
           })
        
        }

      

        const hideValidationErrors = () => {
          $('#f-question').hide()
          $('#f-answer').hide()
        }
		
	
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-content'); ?>

<div class="row">
   
   <div class="col-lg-12 col-md-12 mb-4">
       <div class="utf_dashboard_list_box table-responsive recent_booking">
         <h4>Reviews</h4>
         <div class="dashboard-list-box table-responsive invoices with-icons">
            <ul>
         <?php
         if(isset($reviews) && count($reviews) > 0)
               {
                 foreach($reviews as $r)
                 {
                    $rid = $r['id'];
                    $ru = $r['user'];
                    $uname = $ru['fname']." ".$ru['lname'];
                    $su = url('school')."?xf=".$school['url'];
                    $rating = $ru['rating'];
                    $status = $ru['status'];
                    $updateBtnText = $status === 'pending' ? 'Approve' : 'Decline'
              ?>
                <div class="comments utf_listing_reviews dashboard_review_item">
                  <ul>
                    <li>
                      <div class="avatar"><img src="images/profile.png" alt=""></div>
                      <div class="utf_comment_content">
                        <div class="utf_arrow_comment"></div>
                        <div class="utf_by_comment"><?php echo e($uname); ?>

                          <div class="utf_by_comment-listing">on <a href="<?php echo e($su); ?>"><?php echo e($school['name']); ?></a></div>
                          <span class="date"><i class="fa fa-clock-o"></i> <?php echo e($ru['date']); ?></span>
                          <span class="date">Status: <?php echo e($ru['status']); ?></span>
                          <div class="utf_star_rating_section" data-rating="<?php echo e($rating); ?>"></div>
                          <a href="#" class="rate-review popup-with-zoom-anim" onclick="confirmUpdateReview('<?php echo e($rid); ?>');return false;"><?php echo e($updateBtnText); ?></a>
						  </div>
                        <p><?php echo e($ru['comment']); ?></p>						
					  </div>
                    </li>
                  </ul>
                </div>
             <?php
                 }
             }
             else{
             ?>
               
             <?php
             }
             ?>
             </ul>
         </div>
       </div>
     </div>
</div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/my-reviews.blade.php ENDPATH**/ ?>