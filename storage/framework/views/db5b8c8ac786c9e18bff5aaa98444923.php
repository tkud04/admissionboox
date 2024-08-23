<?php
$void = 'javascript:void(0)';
?>


<?php $__env->startSection('title',$school['name']); ?>

<?php
if(!function_exists('hasBookmarkedSchool'))
{
  function hasBookmarkedSchool($s,$uid)
  {
	$ret = 'false';
    $bookmarks = $s['bookmarks'];
	if(count($bookmarks) > 0)
	{
       foreach($bookmarks as $b)
	   {
		 if($b['user_id'] === $uid)
		 {
            $ret = 'true';
		 }
	   }
	}

	return $ret;
  }
}

$hbs = hasBookmarkedSchool($school,$user->id);
$schoolUrl = $school['url'];
$url2 = url('school').'?xf='.$schoolUrl;

$reviewerFname = $user === null ? '' : $user->fname;
$reviewerLname = $user === null ? '' : $user->lname;
$reviewerEmail = $user === null ? '' : $user->email;
?>

<?php $__env->startSection('scripts'); ?>
<script>
	console.log('hbs: ',"<?php echo e($hbs); ?>")
const clearValidations = () => {
  $('.form-validation').hide()
}

$(() => {
 $('#add-review-btn').click((e) => {
	e.preventDefault()
	clearValidations()

	const ratingEnvironment = $('#add-review-environment').val(), ratingService = $('#add-review-service').val(),
	      ratingPrice = $('#add-review-price').val(), ratingComment = $('#add-review-comment').val(),
		  v = ratingEnvironment === '' || ratingService === '' || ratingPrice === '' || ratingComment === ''
	
	if(v){
	  if(ratingEnvironment === '') $('#add-review-environment-validation').fadeIn()
	  if(ratingService === '') $('#add-review-service-validation').fadeIn()
	  if(ratingPrice === '') $('#add-review-price-validation').fadeIn()
	  if(ratingComment === '') $('#add-review-comment-validation').fadeIn()
	}
    else{
		$('#add-review-btn').hide()
              $('#add-review-loading').fadeIn()
              
              const payload = {
                xf: "<?php echo e($schoolUrl); ?>",
                environment: ratingEnvironment,
                service: ratingService,
                price: ratingPrice,
                comment: ratingComment,
              }
              
              addSchoolReview(payload,
              (data) => {
                
                $('#add-review-loading').hide()
              $('#add-review-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('Review Added! Admins would review shortly')
                    window.location = 'school?xf=<?php echo e($schoolUrl); ?>'
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#add-review-loading').hide()
                $('#add-review-btn').fadeIn()
                alert(`Failed to add review: ${err}`)
              }
            )
	}
 })

 $('#contact-school-btn').click((e) => {
	e.preventDefault()
	clearValidations()

	const contactName = $('#contact-school-name').val(), contactEmail = $('#contact-school-email').val(),
	      contactMessage = $('#contact-school-message').val(),
		  v = contactName === '' || contactEmail === '' || contactMessage === ''
	
	if(v){
	  if(contactName === '') $('#contact-school-name-validation').fadeIn()
	  if(contactEmail === '') $('#contact-school-email-validation').fadeIn()
	  if(contactMessage === '') $('#contact-school-message-validation').fadeIn()
	}
    else{
		$('#contact-school-btn').hide()
              $('#contact-school-loading').fadeIn()
              
              const payload = {
                xf: "<?php echo e($schoolUrl); ?>",
                contactName,
				contactEmail,
				contactMessage
              }
              
              contactSchool(payload,
              (data) => {
                
                $('#contact-school-loading').hide()
               $('#contact-school-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('Message sent! We would get back to you shortly.')
                    window.location = 'school?xf=<?php echo e($schoolUrl); ?>'
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
				$('#contact-school-loading').hide()
				$('#contact-school-btn').fadeIn()
                alert(`Failed to contact school: ${err}`)
              }
            )
	}
 })

 $('.bookmark-school').click((e) => {
	e.preventDefault()
	clearValidations()
      
              const payload = {
                xf: "<?php echo e($schoolUrl); ?>"
              }
              
              bookmarkSchool(payload,
              (data) => {
              
                if(data.status === 'ok'){
                    alert('Bookmarked!')
                    window.location = 'school?xf=<?php echo e($schoolUrl); ?>'
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
				 alert(`Failed to add bookmark: ${err}`)
              }
            )

 })
})
</script>
<?php $__env->stopSection(); ?>

<?php
if(!function_exists('getPriceTag'))
{
  function getPriceTag($category)
  {
    $ret = "";

    if($category === "50-100") $ret = "&#8358;50,000 - &#8358;150,000";
    if($category === "151-300") $ret = "&#8358;151,000 - &#8358;300,000";
    if($category === "301-500") $ret = "&#8358;301,000 - &#8358;500,000";
    if($category === "501-750") $ret = "&#8358;501,000 - &#8358;750,000";
    if($category === "751-1m") $ret = "&#8358;751,000 - &#8358;1,000,000";
    if($category === "above-1m") $ret = "Above &#8358;1,000,000";

    return $ret;
  }
}
?>
<?php $__env->startSection('content'); ?>
<div id="utf_listing_gallery_part" class="utf_listing_section">
    <div class="utf_listing_slider utf_gallery_container margin-bottom-0"> 
		<?php
		  $address = $school['address'];
		  $info = $school['info'];

          foreach($school['banners'] as $banner)
		  {
			$bImg = $banner['url'];
		?>
		<a style="width: 1920px; height: 50px;" href="<?php echo e($bImg); ?>" data-background-image="<?php echo e($bImg); ?>" class="item utf_gallery"></a> 
		<?php if(count($school['banners']) === 1): ?>
		<a style="width: 1920px; height: 50px;" href="<?php echo e($bImg); ?>" data-background-image="<?php echo e($bImg); ?>" class="item utf_gallery"></a> 
		<?php endif; ?>
		<?php
         }
		?>
	</div>
  </div>    
  <?php
        $rating = $calculatedRating['rating'];
		$ratingEnvironment = $calculatedRating['environment'];
		$ratingService = $calculatedRating['service'];
		$ratingPrice = $calculatedRating['price'];
	?>
<div class="container">
    <div class="row utf_sticky_main_wrapper">
      <div class="col-lg-8 col-md-8">
        <div id="titlebar" class="utf_listing_titlebar">
          <div class="utf_listing_titlebar_title">
           <h2><?php echo e($school['name']); ?> <span class="listing-tag"><?php echo e(strtoupper($school['status'])); ?></span></h2>		   
            <span> <a href="#utf_listing_location" class="listing-address"> <i class="sl sl-icon-location"></i> <?php echo e($address['school_state']); ?></a> </span>			
			<span class="call_now"><i class="sl sl-icon-phone"></i> <a href="tel:<?php echo e($school['phone']); ?>"><?php echo e($school['phone']); ?></a></span>
            <div class="utf_star_rating_section" data-rating="<?php echo e($rating); ?>">
              <div class="utf_counter_star_rating">(<?php echo e($rating); ?>) / (<?php echo e(count($reviews)); ?> Reviews)</div>
            </div>
			<?php
              $aru = "#utf_add_review";
              $ssu = "#share-school-div";
			?>
            <ul class="listing_item_social">
			 <?php if($hbs): ?>
			 <li><a href="#"><i class="fa fa-bookmark"></i> Bookmarked</a></li>
			 <?php else: ?>
			 <li><a href="#" class="bookmark-school"><i class="fa fa-bookmark"></i> Bookmark</a></li>
			 <?php endif; ?>

			  <li><a href="<?php echo e($aru); ?>"><i class="fa fa-star"></i> Add Review</a></li>
              <li><a href="<?php echo e($ssu); ?>"><i class="fa fa-share"></i> Share</a></li>
			 <!-- <li><a href="#" class="now_open">Open Now</a></li> -->
            </ul>			
          </div>
        </div>
        <div id="utf_listing_overview" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30">Why Choose Us?</h3>
           <?php echo $info['wcu']; ?> 
		  <div id="utf_listing_tags" class="utf_listing_section listing_tags_section margin-bottom-10 margin-top-0">          
		    <a href="tel:<?php echo e($school['phone']); ?>"><i class="sl sl-icon-phone" aria-hidden="true"></i> <?php echo e($school['phone']); ?></a>			
			<a href="mailto:<?php echo e($school['email']); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo e($school['email']); ?></a>	
			<a href="<?php echo e($url2); ?>"><i class="sl sl-icon-globe" aria-hidden="true"></i> View school website</a>	
          </div>
		  <div id="share-school-div" class="social-contact">
			<a href="#" class="facebook-link"><i class="fa fa-facebook"></i> Facebook</a>
			<a href="#" class="twitter-link"><i class="fa fa-twitter"></i> Twitter</a>
			<a href="#" class="instagram-link"><i class="fa fa-instagram"></i> Instagram</a>
		  </div>		  		 
        </div>
		
		<div id="utf_listing_tags" class="utf_listing_section listing_tags_section">
          <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-40">Tags</h3>
		   <?php
           

			if($info['boarding_type'] === 'day' || $info['boarding_type'] === "both") $tags['day'] = true;
			if($info['boarding_type'] === 'boarding' || $info['boarding_type'] === "both") $tags['boarding'] = true;
			if($info['school_type'] === 'early-only' || $info['school_type'] === "early-primary-secondary") $tags['early'] = true;
			if($info['school_type'] === 'primary-only' || $info['school_type'] === "primary-secondary" || $info['school_type'] === "early-primary-secondary") $tags['primary'] = true;
			if($info['school_type'] === 'secondary-only' || $info['school_type'] === "primary-secondary"  || $info['school_type'] === "early-primary-secondary") $tags['secondary'] = true;
			if($info['school_type'] === 'tertiary-only') $tags['tertiary'] = true;

			foreach($tags as $k => $v)
			{
				if($v)
				{
					$vu = url('schools')."?xf=".$k;
		   ?>
			<a href="<?php echo e($vu); ?>"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo e(ucwords($k)); ?></a>
			<?php
			    }
		    }
			?>
        </div>
        
        <div class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Pricing</h3>
          <div>
            <div class="utf_pricing_list_section">
              <h4>School Fees</h4>
              <ul>
                <li>
                  <h5><strong>Price Per Term</strong></h5>
                  <span><strong><?php echo getPriceTag($info['school_fees']); ?></strong></span> 
				</li>
              </ul>
            </div>
          </div>
		</div>
		
		<div id="utf_listing_amenities" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Facilities</h3>
          <ul class="utf_listing_features checkboxes margin-top-0">
			<?php
			  foreach($school['facilities'] as $facility)
			  {
				$f = $facility['facility'];
			?>
               <li><?php echo e($f['facility_name']); ?> <i class="im <?php echo e($f['icon']); ?>"></i></li>
            <?php
			  }
			?>        
          </ul>
        </div>

		<div id="utf_listing_amenities" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Clubs</h3>
          <ul class="utf_listing_features checkboxes margin-top-0">
			<?php
			  foreach($school['clubs'] as $club)
			  {
			?>
               <li><?php echo e($club['club_name']); ?> <i class="im <?php echo e($club['icon']); ?>"></i></li>
            <?php
			  }
			?>        
          </ul>
        </div>
		
		<div id="utf_listing_faq" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">FAQs</h3>
          <div class="style-2">
			<div class="accordion">
			 <?php 
			   $faqs = $school['faqs'];
               for($i = 0; $i < count($faqs); $i++)
			   {
				$f = $faqs[$i];
			 ?>
			  <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
				<span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span><i class="sl sl-icon-plus"></i> (<?php echo e($i+1); ?>) <?php echo $f['faq_question']; ?>

			</h3>
			  <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-utf_widget_content" style="display: none;">
				<p><?php echo $f['faq_answer']; ?></p>
			  </div>
			  
			<?php
			   }
			?>
			</div>
		  </div>
        </div>
		
        <div id="utf_listing_location" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-60 margin-bottom-40">Location</h3>
          <div id="utf_single_listing_map_block">
            <div id="utf_single_listingmap" data-latitude="36.778259" data-longitude="-119.417931" data-map-icon="im im-icon-Hamburger"></div>
            <a href="#" id="utf_street_view_btn">Street View</a> 
		  </div>
        </div>
		
        <div id="utf_listing_reviews" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-75 margin-bottom-20">Reviews <span>(<?php echo e(count($reviews)); ?>)</span></h3>
          <div class="clearfix"></div>
		  <div class="reviews-container">
			<div class="row">
				<div class="col-lg-3">
					<div id="review_summary">
					<strong><?php echo e($rating); ?></strong>
					<?php if($rating > 0): ?>
					<div style="display: flex; justify-content: center;"><div class="utf_star_rating_section text-center" data-rating="<?php echo e($rating); ?>"></div></div>
					<?php endif; ?>
					</div>
				</div>
				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Environment</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?php echo e($ratingEnvironment); ?>%" aria-valuenow="<?php echo e($ratingEnvironment); ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong><?php echo e($ratingEnvironment); ?></strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Service</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?php echo e($ratingService); ?>%" aria-valuenow="<?php echo e($ratingService); ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong><?php echo e($ratingService); ?></strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Price</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?php echo e($ratingPrice); ?>%" aria-valuenow="<?php echo e($ratingPrice); ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong><?php echo e($ratingPrice); ?></strong></small></div>
					</div>
				</div>
			</div>
		  </div>	 	
          <div class="comments utf_listing_reviews">
            <ul>
			  <?php
                foreach($reviews as $review)
				{
					$reviewRating = $review['rating'];
					$reviewEnviroment = $review['environment'];
					$reviewService = $review['service'];
					$reviewPrice = $review['price'];
					$u = $review['user'];
			  ?>
              <li>
                <div class="avatar"><img src="images/profile.png" alt=""></div>
                <div class="utf_comment_content">
                  <div class="utf_arrow_comment"></div>
                  <div class="utf_star_rating_section" data-rating="<?php echo e($rating); ?>"></div>
				  <a href="javascript:void(0)" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a>                   
                  <div class="utf_by_comment"><?php echo e($u['fname']); ?> <?php echo e($u['lname']); ?><span class="date"><i class="fa fa-clock-o"></i> <?php echo e($review['date']); ?></span> </div>
                  <p><?php echo e($review['comment']); ?></p>                                    
				</div>
              </li>
			  <?php
				}
			  ?>
            </ul>
          </div>
          <div class="clearfix"></div>
		  <?php if(count($reviews) > 0): ?>
            <?php echo $__env->make('components.pagination',[
              'url' => "school?xf=".$school['url'],
              'currentPage' => $currentPage,
              'numPages' => $numPages,
              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>
          <div class="clearfix"></div>
        </div>
        <div id="utf_add_review" class="utf_add_review-box">
          <h3 class="utf_listing_headline_part margin-bottom-20">Add Your Review</h3>
          <span class="utf_leave_rating_title">Your email address will not be published.</span>
         
          <form id="utf_add_comment" class="utf_add_comment">
            <fieldset>
              <div class="row">
                <div class="col-md-6">
                  <label>Name:</label>
                  <input type="text" placeholder="Name" value="<?php echo e($reviewerFname); ?> <?php echo e($reviewerLname); ?>" disabled>
                </div>
                <div class="col-md-6">
                  <label>Email:</label>
                  <input type="text" placeholder="Email" value="<?php echo e($reviewerEmail); ?>" disabled>
                </div>
                
              </div>
			  <div class="row">
				<div class='col-md-12'>
				<span class="utf_leave_rating_title">Please give your feedback <strong>(1 to 100)</strong> on each of the school's ratings below:</span>
				</div>
			   <div class="col-md-4">
                  <label>Enviroment:</label>
				  <?php echo $__env->make('components.form-validation', ['id' => "add-review-environment-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <input type="number" min="1" max="100" placeholder="Environment" id="add-review-environment" >
                </div>
				<div class="col-md-4">
                  <label>Service:</label>
				  <?php echo $__env->make('components.form-validation', ['id' => "add-review-service-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <input type="number" min="1" max="100" placeholder="Service" id="add-review-service" >
                </div>
				<div class="col-md-4">
                  <label>Price:</label>
				  <?php echo $__env->make('components.form-validation', ['id' => "add-review-price-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <input type="number" min="1" max="100" placeholder="Price" id="add-review-price" >
                </div>

			  </div>
              <div>
                <label>Review:</label>
				<?php echo $__env->make('components.form-validation', ['id' => "add-review-comment-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <textarea cols="40" placeholder="Your Message..." rows="3" id="add-review-comment"></textarea>
              </div>
            </fieldset>
			<?php echo $__env->make('components.generic-loading', ['message' => 'Processing', 'id' => "add-review-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'title' => 'Submit',
                     'classes' => 'margin-top-20',
                     'id' => 'add-review-btn'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
      
      <!-- Sidebar -->
      <div class="col-lg-4 col-md-4 margin-top-75 sidebar-search">
      <?php
	  if(false)
	  {
	  ?>
	   <div class="verified-badge with-tip margin-bottom-30" data-tip-content="Listing has been verified and belongs business owner or manager."> <i class="sl sl-icon-check"></i> Now Available<div class="tip-content" style="width: 720px; max-width: 720px;">Listing has been verified and belongs business owner or manager.</div></div>
        <div class="utf_box_widget booking_widget_box">
          <h3><i class="fa fa-calendar"></i> Booking
			<div class="price">
				<span>185$<small>person</small></span>				
			</div>
		  </h3>
          <div class="row with-forms margin-top-0">
            <div class="col-lg-12 col-md-12 select_date_box">
              <input type="text" id="date-picker" placeholder="Select Date" readonly="readonly">
			  <i class="fa fa-calendar"></i>
            </div>
  		    <div class="col-lg-12">
				<div class="panel-dropdown time-slots-dropdown">
					<a href="#">Choose Time Slot...</a>
					<div class="panel-dropdown-content padding-reset">
						<div class="panel-dropdown-scrollable">
							<div class="time-slot">
								<input type="radio" name="time-slot" id="time-slot-1">
								<label for="time-slot-1">
									<strong><span>1</span> : 8:00 AM - 8:30 AM</strong>									
								</label>
							</div>
							
							<div class="time-slot">
								<input type="radio" name="time-slot" id="time-slot-2">
								<label for="time-slot-2">
									<strong><span>2</span> : 8:30 AM - 9:00 AM</strong>
								</label>
							</div>

							<div class="time-slot">
								<input type="radio" name="time-slot" id="time-slot-3">
								<label for="time-slot-3">
									<strong><span>3</span> : 9:00 AM - 9:30 AM</strong>
								</label>
							</div>

							<div class="time-slot">
								<input type="radio" name="time-slot" id="time-slot-4">
								<label for="time-slot-4">
									<strong><span>4</span> : 9:30 AM - 10:00 AM</strong>
								</label>
							</div>

							<div class="time-slot">
								<input type="radio" name="time-slot" id="time-slot-5">
								<label for="time-slot-5">
									<strong><span>5</span> : 10:00 AM - 10:30 AM</strong>
								</label>
							</div>

							<div class="time-slot">
								<input type="radio" name="time-slot" id="time-slot-6">
								<label for="time-slot-6">
									<strong><span>6</span> : 13:00 PM - 13:30 PM</strong>
								</label>
							</div>

							<div class="time-slot">
								<input type="radio" name="time-slot" id="time-slot-7">
								<label for="time-slot-7">
									<strong><span>7</span> : 13:30 PM - 14:00 PM</strong>
								</label>
							</div>

							<div class="time-slot">
								<input type="radio" name="time-slot" id="time-slot-8">
								<label for="time-slot-8">
									<strong><span>8</span> : 14:00 PM - 14:30 PM</strong>
								</label>
							</div>
							
							<div class="time-slot">
								<input type="radio" name="time-slot" id="time-slot-9">
								<label for="time-slot-9">
									<strong><span>9</span> : 15:00 PM - 15:30 PM</strong>
								</label>
							</div>
							
							<div class="time-slot">
								<input type="radio" name="time-slot" id="time-slot-10">
								<label for="time-slot-10">
									<strong><span>10</span> : 16:00 PM - 16:30 PM</strong>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="panel-dropdown">
					<a href="#">Guests <span class="qtyTotal" name="qtyTotal">2</span></a>
					<div class="panel-dropdown-content">
						<div class="qtyButtons">
							<div class="qtyTitle">Adults</div>
							<div class="qtyDec"></div><input type="text" name="qtyInput" value="1"><div class="qtyInc"></div>
						</div>
						<div class="qtyButtons">
							<div class="qtyTitle">Childrens</div>
							<div class="qtyDec"></div><input type="text" name="qtyInput" value="1"><div class="qtyInc"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="with-forms margin-top-0">
				<div class="col-lg-12 col-md-12">
					<select class="utf_chosen_select_single" style="display: none;">
					  <option label="Select Time">Select Time</option>
					  <option>Lunch</option>
					  <option>Dinner</option>					  
					</select><div class="chosen-container chosen-container-single chosen-container-single-nosearch" style="width: 100%;" title=""><a class="chosen-single"><span>Select Time</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off" readonly=""></div><ul class="chosen-results"></ul></div></div>
				</div>
			</div>
          </div>          
          <a href="listing_booking.html" class="utf_progress_button button fullwidth_block margin-top-5">Request Booking<div class="progress-bar"></div></a>
		  <button class="like-button add_to_wishlist"><span class="like-icon"></span> Add to Wishlist</button>
          <div class="clearfix"></div>
        </div>
		<?php
	  }
	    $owner = $school['owner'];
		$ownerEmail = $owner['email'];
		?>
        <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-phone"></i> Owner Info</h3>
          <div class="utf_hosted_by_user_title"> <a href="#" class="utf_hosted_by_avatar_listing"><img src="images/profile.png" alt=""></a>
            <h4><a href="#"><?php echo e($owner['name']); ?></a><span>Posted on: <?php echo e($school['date']); ?></span>
              <span><i class="sl sl-icon-location"></i> <?php echo e($address['school_address']); ?>, <?php echo e($address['school_state']); ?></span>
            </h4>
          </div>
          <ul class="utf_listing_detail_sidebar">
            <li><i class="sl sl-icon-map"></i> [provided upon request]</li>
            <li><i class="sl sl-icon-phone"></i> [provided upon request]</li>
            <li><i class="sl sl-icon-globe"></i> <a href="<?php echo e($url2); ?>">View school website</a></li>
            <li><i class="fa fa-envelope-o"></i> <a href="mailto:<?php echo e($ownerEmail); ?>">Send an email</a></li>
          </ul>		  
        </div>
        <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-folder-alt"></i> Categories</h3>
          <ul class="utf_listing_detail_sidebar">
		  <?php
           
			if($info['boarding_type'] === 'day' || $info['boarding_type'] === "both") $tags['day'] = true;
			if($info['boarding_type'] === 'boarding' || $info['boarding_type'] === "both") $tags['boarding'] = true;
			if($info['school_type'] === 'early-only' || $info['school_type'] === "early-primary-secondary") $tags['early'] = true;
			if($info['school_type'] === 'primary-only' || $info['school_type'] === "primary-secondary" || $info['school_type'] === "early-primary-secondary") $tags['primary'] = true;
			if($info['school_type'] === 'secondary-only' || $info['school_type'] === "primary-secondary"  || $info['school_type'] === "early-primary-secondary") $tags['secondary'] = true;
			if($info['school_type'] === 'tertiary-only') $tags['tertiary'] = true;

			foreach($tags as $k => $v)
			{
				if($v)
				{
					$vu = url('schools')."?xf=".$k;
		   ?>
			<li><i class="fa fa-angle-double-right"></i> <a href="<?php echo e($vu); ?>"> <?php echo e(ucwords($k)); ?></a></li>
			<?php
			    }
		    }
			?>
          </ul>
        </div>
        <div class="utf_box_widget opening-hours margin-top-35">
          <h3><i class="sl sl-icon-clock"></i> School Hours</h3>
          <ul>
            <li>Monday <span>09:00 AM - 04:00 PM</span></li>
            <li>Tuesday <span>09:00 AM - 04:00 PM</span></li>
            <li>Wednesday <span>09:00 AM - 04:00 PM</span></li>
            <li>Thursday <span>09:00 AM - 04:00 PM</span></li>
            <li>Friday <span>09:00 AM - 04:00 PM</span></li>
          </ul>
        </div>	
		<?php echo $__env->make('components.school-premium-ad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="utf_box_widget opening-hours margin-top-35">
          <h3><i class="sl sl-icon-info"></i> Additional Information</h3>
          <ul>
            <li>Take Out: <span>Yes</span></li>
            <li>Delivery: <span>Yes</span></li>
            <li>Neutral Restrooms: <span>Yes</span></li>
            <li>Has Pool Table: <span>Yes</span></li>
            <li>Gender Neutral Restrooms: <span>Yes</span></li>
            <li>Waiter Service: <span>Yes</span></li>
          </ul>
        </div>
		<div class="utf_box_widget opening-hours margin-top-35" id="contactform-div">
			
		<h3><i class="sl sl-icon-envelope-open"></i> Contact Us</h3>
          <form id="contactform">
            <div class="row">              
              <div class="col-md-12">  
			  <?php echo $__env->make('components.form-validation', ['id' => "contact-school-name-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>              
                  <input  type="text" placeholder="Name" id="contact-school-name" value="<?php echo e($reviewerFname); ?> <?php echo e($reviewerLname); ?>" required="">                
              </div>
              <div class="col-md-12">    
			  <?php echo $__env->make('components.form-validation', ['id' => "contact-school-email-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>            
                  <input name="email" type="email" placeholder="Email" id="contact-school-email" value="<?php echo e($reviewerEmail); ?>" required="">                
              </div>    
			  <div class="col-md-12">
			  <?php echo $__env->make('components.form-validation', ['id' => "contact-school-message-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				  <textarea name="comments" cols="40" rows="2" id="contact-school-message" placeholder="Your Message" required=""></textarea>
			  </div>
            </div>            
            <?php echo $__env->make('components.generic-loading', ['message' => 'Processing', 'id' => "contact-school-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'title' => 'Submit',
                     'classes' => 'margin-top-20',
                     'id' => 'contact-school-btn'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </form>
        </div>
		<?php echo $__env->make('components.school-regular-ad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-phone"></i> Enquiries or Complaints?</h3>
          <p>We would love to hear from you! You can reach out to us for your enquiries, requests or complaints, or even just to say hi :)</p>
          <a class="utf_progress_button button fullwidth_block margin-top-5" href="#contactform-div">Contact Us<div class="progress-bar"></div></a> 
		</div>
        <div class="utf_box_widget listing-share margin-top-35 margin-bottom-40 no-border">
          <h3><i class="sl sl-icon-pin"></i> Bookmark School</h3>
		  <span><?php echo e(count($school['bookmarks'])); ?> People Bookmarked</span>
		  <?php if($user === null): ?>
          <button class="like-button"> Login to Bookmark School</button>          
          <?php else: ?>
		    <?php if($hbs): ?>
			<button class="like-button" disabled><span class="like-icon liked"></span> Bookmarked!</button>
			 <?php else: ?>
			 <button class="like-button bookmark-school"><span class="like-icon"></span> Bookmark School</button>
			 <?php endif; ?>
		           
          <?php endif; ?>
          <div class="clearfix"></div>
        </div>
		<div class="utf_box_widget opening-hours review-avg-wrapper margin-top-35">
          <h3><i class="sl sl-icon-star"></i>  Rating Average </h3>
          <div class="box-inner">
			  <div class="rating-avg-wrapper text-theme clearfix">
				<div class="rating-avg"><?php echo e($calculatedRating['rating']); ?></div>
				<div class="rating-after">
				  <div class="rating-mode">/5 Average</div>
				  
				</div>
			  </div>
			  <div class="ratings-avg-wrapper">
				<div class="ratings-avg-item">
				  <div class="rating-label">Service</div>
				  <div class="rating-value text-theme"><?php echo e($calculatedRating['service']); ?></div>
				</div>
				<div class="ratings-avg-item">
				  <div class="rating-label">Price</div>
				  <div class="rating-value text-theme"><?php echo e($calculatedRating['price']); ?></div>
				</div>
				<div class="ratings-avg-item">
				  <div class="rating-label">Environment</div>
				  <div class="rating-value text-theme"><?php echo e($calculatedRating['environment']); ?></div>
				</div>
				
			  </div>
			</div>
        </div>
      </div>
    </div>
  </div>

  <section class="fullwidth_block padding-top-20 padding-bottom-50">
    <div class="container">
      <div class="row slick_carousel_slider">
         <div class="col-md-12">
          <h3 class="headline_part centered margin-bottom-25">Similar Listings</h3>
         </div>		
		 <div class="row">
			<div class="col-md-12">
			<div class="simple_slick_carousel_block utf_dots_nav"> 
				<?php
                 foreach($similarSchools as $ss)
				 {
					$ssu = url('school')."?xf=".$ss['url'];
					$ssInfo = $ss['info'];
					$ssAddress = $ss['address'];
					$isFeatured = false;
					$hasAdmission = true;
					$scr = $ss['calculatedRating'];
					$ssBookmarkCount = count($ss['bookmarks']);
				?>
				  <div class="utf_carousel_item"> <a href="<?php echo e($ssu); ?>" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="<?php echo e($ss['logo']); ?>" alt=""> 
					<?php if($hasAdmission): ?><span class="tag"><i class="im im-icon-File"></i> Admission open</span> <?php endif; ?>
					<?php if($isFeatured): ?><span class="featured_tag">Featured</span><?php endif; ?>
					  <span class="utf_open_now"><?php echo e(ucwords($ss['status'])); ?></span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> <?php echo getPriceTag($ssInfo['school_fees']); ?></span>							
							<!--<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>-->
						</div>
						<h3><?php echo e($ss['name']); ?></h3>
						<span><i class="fa fa-map-marker"></i> <?php echo e($ssAddress['school_state']); ?></span>
						<span><i class="fa fa-phone"></i> <?php echo e($ss['phone']); ?></span>											
					  </div>					  
					</div>
					<div class="utf_star_rating_section" data-rating="<?php echo e($scr['rating']); ?>">
						<div class="utf_counter_star_rating">(<?php echo e($scr['rating']); ?>)</div>
						<span class="utf_view_count"><i class="fa fa-bookmark"></i> <?php echo e($ssBookmarkCount); ?>+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				  </div>
				  <?php
				 }
				  ?>
				  
				</div>
			  </div>
		  </div>
			</div>
		  </div>
	  </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/school.blade.php ENDPATH**/ ?>