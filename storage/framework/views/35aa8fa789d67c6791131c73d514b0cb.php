<?php $__env->startSection('title',"Complete Application"); ?>

<?php
   $admission = $applicant['admission'];
   $banner = $school['banners'][0];
   $bImg = $banner['url'];
   $address = $school['address'];

   $rating = $calculatedRating['rating'];

   $applicationFee = floatval($admission['application_fee']);
   $vatFee = 0.075 * floatval($applicationFee);
   $totalFee = $applicationFee + $vatFee;
  ?>


<?php $__env->startSection('scripts'); ?>
<script src="js/moment.min.js"></script>
 
  <script>
  	 let xf_ref = "" 

  $(() => {
	$('#verify-btn').hide()
	const selectedDate = moment("<?php echo e($applicant['date_slot']); ?>"),
	deadlineDate = moment("<?php echo e($admission['end_date']); ?>"),
	selectedDateDisplay = selectedDate?.format('ddd, MMMM Do YYYY'),
	deadlineDateDisplay = deadlineDate?.format('ddd, MMMM Do YYYY')

	$('#selected-date').html(selectedDateDisplay);
	$('#deadline-date').html(deadlineDateDisplay);

	$('#confirm-btn').click((e) => {
	e.preventDefault()
	

		$('#confirm-btn').hide()
        $('#confirm-loading').fadeIn()
	

	   completeSchoolApplication({
		xf: "<?php echo e($applicant['id']); ?>",
	   },
	         (data) => {
				$('#confirm-loading').hide()
                console.log('complete data: ',data)

                if(data.status === 'ok'){
					$('#verify-btn').fadeIn()
					const parsedData = JSON.parse(data?.data)
					xf_ref = parsedData?.data?.reference
					window.location = `${parsedData?.data?.authorization_url}`
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#confirm-loading').hide()
              $('#confirm-btn').fadeIn()
                alert(`Failed to confirm school application: ${err}`)
              }
	     )
	
       })


	$('#verify-btn').click((e) => {
	e.preventDefault()
	

		$('#verify-btn').hide()
        $('#confirm-loading').fadeIn()
	

	   verifySchoolApplication({
		xf: xf_ref,
	   },
	         (data) => {
				$('#confirm-loading').hide()
				$('#verify-btn').fadeIn()
                console.log('verify data: ',data)
                if(data.status === 'ok'){
					const parsedData = JSON.parse(data?.data)
					// window.location = `${data?.data}`
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#confirm-loading').hide()
              $('#verify-btn').fadeIn()
                alert(`Failed to verify school application: ${err}`)
              }
	     )
	
       })
  })
  

  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('components.generic-banner',[
	 'title' => "Complete Application"
	], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



  <div class="container margin-bottom-75">
    <div class="row">
      <div class="col-lg-8 col-md-8 utf_listing_payment_section">
	    <div class="utf_booking_listing_section_form margin-bottom-40">
		  <h3><i class="sl sl-icon-paper-plane"></i> Billing Information</h3>
			<div class="row">
			  <div class="col-md-6">
				<label>First Name</label>
				<input type="text" value="<?php echo e($user->fname); ?>" placeholder="First Name">
			  </div>
			  <div class="col-md-6">
				<label>Last Name</label>
				<input type="text" value="<?php echo e($user->lname); ?>" placeholder="Last Name">
			  </div>
			  <div class="col-md-6">
				<div class="medium-icons">
				  <label>E-Mail</label>
				  <input type="text" value="<?php echo e($user->email); ?>" placeholder="Email">
				</div>
			  </div>
			  <div class="col-md-6">
				<div class="medium-icons">
				  <label>Phone</label>
				  <input type="text" value="<?php echo e($user->phone); ?>" placeholder="Phone">
				</div>
			  </div>
			</div>
		</div>
		
		<div class="utf_booking_payment_option_form">
		  <h3><i class="sl sl-icon-credit-card "></i> Payment Method</h3>
			<div class="payment">
			  <div class="utf_payment_tab_block utf_payment_tab_block_active">
				<div class="utf_payment_trigger_tab">
				  <input checked="" id="paypal" name="cardType" type="radio" value="paypal">
				  <label for="paypal">PayStack</label>
				  <img class="utf_payment_logo paypal" src="images/paystack-logo.png" alt=""> 
				</div>
				<div class="utf_payment_tab_block_content">				  
				  <p>You will be Redirected to PayStack to Complete Payment.</p>
				</div>
			  </div>			  			 
			  
			  
			</div>
			<?php echo $__env->make('components.generic-loading', ['message' => 'Processing', 'id' => "confirm-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<a href="#" id="confirm-btn" class="button utf_booking_confirmation_button margin-top-20 margin-bottom-10">Make Payment</a> 		
			<a href="#" id="verify-btn" class="button utf_booking_confirmation_button margin-top-20 margin-bottom-10">Verify Payment</a> 		
		</div>
	  </div>
      <div class="col-lg-4 col-md-4 margin-top-0 utf_listing_payment_section">
        <div class="utf_booking_listing_item_container compact utf_order_summary_widget_section">
          <div class="listing-item"> <img src="<?php echo e($bImg); ?>" alt="">
            <div class="utf_listing_item_content">              
              <h3><?php echo e($school['name']); ?></h3>
              <span><i class="fa fa-map-marker"></i> <?php echo e($address['school_state']); ?></span>
						<span><i class="fa fa-phone"></i> <?php echo e($school['phone']); ?></span>											
			  <div class="utf_star_rating_section"  data-rating="<?php echo e($rating); ?>">
				<div class="utf_counter_star_rating">(<?php echo e(count($allReviews)); ?>) Reviews</div>
			  </div>
			</div>
          </div>
        </div>
        <div class="boxed-widget opening-hours summary margin-top-0">
          <h3><i class="fa fa-calendar-check-o"></i> Application Summary</h3>
          <ul>
            <li>Examination date <span id="selected-date"></span></li>
			<li>Hour <span><?php echo e($selectedTime); ?></span></li>
			<li>Admission deadline <span id="deadline-date"></span></li>     
			<li>Application Fee <span>&#8358;<?php echo e(number_format($applicationFee,2)); ?></span></li>
			<li>V.A.T <span>&#8358;<?php echo e(number_format($vatFee,2)); ?></span></li>
			<li class="total-costs">Sub Total <span>&#8358;<?php echo e(number_format($totalFee,2)); ?></span></li>
			<li class="total-costs">
				<div class="col-md-8">
				  <input id="couponCode" placeholder="Have a coupon enter here..." required="" type="text">
				</div>
				<div class="col-md-4">
				  <input type="submit" class="coupon_code" value="Apply">	
				</div>
				<div class="clearfix"></div>
			</li>
            <li class="total-costs">Total Cost <span>&#8358;<?php echo e(number_format($totalFee,2)); ?></span></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/complete-application.blade.php ENDPATH**/ ?>