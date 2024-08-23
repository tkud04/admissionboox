<?php
$void = 'javascript:void(0)';
?>
@extends('layout')

@section('title',$school['name'])

<?php
$schoolUrl = $school['url'];
$url2 = url('school').'?xf='.$schoolUrl;

$reviewerFname = $user === null ? '' : $user->fname;
$reviewerLname = $user === null ? '' : $user->lname;
$reviewerEmail = $user === null ? '' : $user->email;
?>

@section('scripts')
<script>
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
                xf: "{{$schoolUrl}}",
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
                    window.location = 'school?xf={{$schoolUrl}}'
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
                xf: "{{$schoolUrl}}",
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
                    window.location = 'school?xf={{$schoolUrl}}'
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
})
</script>
@stop

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
@section('content')
<div id="utf_listing_gallery_part" class="utf_listing_section">
    <div class="utf_listing_slider utf_gallery_container margin-bottom-0"> 
		<?php
		  $address = $school['address'];
		  $info = $school['info'];

          foreach($school['banners'] as $banner)
		  {
			$bImg = $banner['url'];
		?>
		<a style="width: 1920px; height: 50px;" href="{{$bImg}}" data-background-image="{{$bImg}}" class="item utf_gallery"></a> 
		@if(count($school['banners']) === 1)
		<a style="width: 1920px; height: 50px;" href="{{$bImg}}" data-background-image="{{$bImg}}" class="item utf_gallery"></a> 
		@endif
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
           <h2>{{$school['name']}} <span class="listing-tag">{{strtoupper($school['status'])}}</span></h2>		   
            <span> <a href="#utf_listing_location" class="listing-address"> <i class="sl sl-icon-location"></i> {{$address['school_state']}}</a> </span>			
			<span class="call_now"><i class="sl sl-icon-phone"></i> <a href="tel:{{$school['phone']}}">{{$school['phone']}}</a></span>
            <div class="utf_star_rating_section" data-rating="{{$rating}}">
              <div class="utf_counter_star_rating">({{$rating}}) / ({{count($reviews)}} Reviews)</div>
            </div>
			<?php
              $bmu = "#".url("bookmark-school")."?xf=".$school['url'];
              $aru = "#utf_add_review";
              $ssu = "#share-school-div";
			?>
            <ul class="listing_item_social">
              <li><a href="{{$bmu}}"><i class="fa fa-bookmark"></i> Bookmark</a></li>
			  <li><a href="{{$aru}}"><i class="fa fa-star"></i> Add Review</a></li>
              <li><a href="{{$ssu}}"><i class="fa fa-share"></i> Share</a></li>
			 <!-- <li><a href="#" class="now_open">Open Now</a></li> -->
            </ul>			
          </div>
        </div>
        <div id="utf_listing_overview" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30">Why Choose Us?</h3>
           {!! $info['wcu'] !!} 
		  <div id="utf_listing_tags" class="utf_listing_section listing_tags_section margin-bottom-10 margin-top-0">          
		    <a href="tel:{{$school['phone']}}"><i class="sl sl-icon-phone" aria-hidden="true"></i> {{$school['phone']}}</a>			
			<a href="mailto:{{$school['email']}}"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$school['email']}}</a>	
			<a href="{{$url2}}"><i class="sl sl-icon-globe" aria-hidden="true"></i> View school website</a>	
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
			<a href="{{$vu}}"><i class="fa fa-tag" aria-hidden="true"></i> {{ucwords($k)}}</a>
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
                  <span><strong>{!! getPriceTag($info['school_fees']) !!}</strong></span> 
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
               <li>{{$f['facility_name']}} <i class="im {{$f['icon']}}"></i></li>
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
               <li>{{$club['club_name']}} <i class="im {{$club['icon']}}"></i></li>
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
				<span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span><i class="sl sl-icon-plus"></i> ({{$i+1}}) {!! $f['faq_question'] !!}
			</h3>
			  <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-utf_widget_content" style="display: none;">
				<p>{!! $f['faq_answer'] !!}</p>
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
          <h3 class="utf_listing_headline_part margin-top-75 margin-bottom-20">Reviews <span>({{count($reviews)}})</span></h3>
          <div class="clearfix"></div>
		  <div class="reviews-container">
			<div class="row">
				<div class="col-lg-3">
					<div id="review_summary">
					<strong>{{$rating}}</strong>
					@if($rating > 0)
					<div style="display: flex; justify-content: center;"><div class="utf_star_rating_section text-center" data-rating="{{$rating}}"></div></div>
					@endif
					</div>
				</div>
				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Environment</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: {{$ratingEnvironment}}%" aria-valuenow="{{$ratingEnvironment}}" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>{{$ratingEnvironment}}</strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Service</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: {{$ratingService}}%" aria-valuenow="{{$ratingService}}" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>{{$ratingService}}</strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Price</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: {{$ratingPrice}}%" aria-valuenow="{{$ratingPrice}}" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>{{$ratingPrice}}</strong></small></div>
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
                  <div class="utf_star_rating_section" data-rating="{{$rating}}"></div>
				  <a href="javascript:void(0)" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a>                   
                  <div class="utf_by_comment">{{$u['fname']}} {{$u['lname']}}<span class="date"><i class="fa fa-clock-o"></i> {{$review['date']}}</span> </div>
                  <p>{{$review['comment']}}</p>                                    
				</div>
              </li>
			  <?php
				}
			  ?>
            </ul>
          </div>
          <div class="clearfix"></div>
		  @if(count($reviews) > 0)
            @include('components.pagination',[
              'url' => "school?xf=".$school['url'],
              'currentPage' => $currentPage,
              'numPages' => $numPages,
              ])
          @endif
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
                  <input type="text" placeholder="Name" value="{{$reviewerFname}} {{$reviewerLname}}" disabled>
                </div>
                <div class="col-md-6">
                  <label>Email:</label>
                  <input type="text" placeholder="Email" value="{{$reviewerEmail}}" disabled>
                </div>
                
              </div>
			  <div class="row">
				<div class='col-md-12'>
				<span class="utf_leave_rating_title">Please give your feedback <strong>(1 to 100)</strong> on each of the school's ratings below:</span>
				</div>
			   <div class="col-md-4">
                  <label>Enviroment:</label>
				  @include('components.form-validation', ['id' => "add-review-environment-validation"])
                  <input type="number" min="1" max="100" placeholder="Environment" id="add-review-environment" >
                </div>
				<div class="col-md-4">
                  <label>Service:</label>
				  @include('components.form-validation', ['id' => "add-review-service-validation"])
                  <input type="number" min="1" max="100" placeholder="Service" id="add-review-service" >
                </div>
				<div class="col-md-4">
                  <label>Price:</label>
				  @include('components.form-validation', ['id' => "add-review-price-validation"])
                  <input type="number" min="1" max="100" placeholder="Price" id="add-review-price" >
                </div>

			  </div>
              <div>
                <label>Review:</label>
				@include('components.form-validation', ['id' => "add-review-comment-validation"])
                <textarea cols="40" placeholder="Your Message..." rows="3" id="add-review-comment"></textarea>
              </div>
            </fieldset>
			@include('components.generic-loading', ['message' => 'Processing', 'id' => "add-review-loading"])
                  @include('components.button',[
                     'href' => '#',
                     'title' => 'Submit',
                     'classes' => 'margin-top-20',
                     'id' => 'add-review-btn'
                    ])
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
            <h4><a href="#">{{$owner['name']}}</a><span>Posted on: {{$school['date']}}</span>
              <span><i class="sl sl-icon-location"></i> {{$address['school_address']}}, {{$address['school_state']}}</span>
            </h4>
          </div>
          <ul class="utf_listing_detail_sidebar">
            <li><i class="sl sl-icon-map"></i> [provided upon request]</li>
            <li><i class="sl sl-icon-phone"></i> [provided upon request]</li>
            <li><i class="sl sl-icon-globe"></i> <a href="{{$url2}}">View school website</a></li>
            <li><i class="fa fa-envelope-o"></i> <a href="mailto:{{$ownerEmail}}">Send an email</a></li>
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
			<li><i class="fa fa-angle-double-right"></i> <a href="{{$vu}}"> {{ucwords($k)}}</a></li>
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
		@include('components.school-premium-ad')
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
		<div class="utf_box_widget opening-hours margin-top-35">
			
		<h3><i class="sl sl-icon-envelope-open"></i> Contact Us</h3>
          <form id="contactform">
            <div class="row">              
              <div class="col-md-12">  
			  @include('components.form-validation', ['id' => "contact-school-name-validation"])              
                  <input  type="text" placeholder="Name" id="contact-school-name" value="{{$reviewerFname}} {{$reviewerLname}}" required="">                
              </div>
              <div class="col-md-12">    
			  @include('components.form-validation', ['id' => "contact-school-email-validation"])            
                  <input name="email" type="email" placeholder="Email" id="contact-school-email" value="{{$reviewerEmail}}" required="">                
              </div>    
			  <div class="col-md-12">
			  @include('components.form-validation', ['id' => "contact-school-message-validation"])
				  <textarea name="comments" cols="40" rows="2" id="contact-school-message" placeholder="Your Message" required=""></textarea>
			  </div>
            </div>            
            @include('components.generic-loading', ['message' => 'Processing', 'id' => "contact-school-loading"])
                  @include('components.button',[
                     'href' => '#',
                     'title' => 'Submit',
                     'classes' => 'margin-top-20',
                     'id' => 'contact-school-btn'
                    ])
          </form>
        </div>
		<div class="utf_box_widget opening-hours margin-top-35">
          <h3><i class="sl sl-icon-info"></i> Google AdSense</h3>
          <span><img src="images/google_adsense.jpg" alt=""></span>
        </div>
        <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-phone"></i> Quick Contact to Help?</h3>
          <p>Excepteur sint occaecat non proident, sunt in culpa officia deserunt mollit anim id est laborum.</p>
          <ul class="utf_social_icon rounded">
            <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
            <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
            <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
            <li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>            
          </ul>
          <a class="utf_progress_button button fullwidth_block margin-top-5" href="contact.html">Contact Us<div class="progress-bar"></div></a> 
		</div>
        <div class="utf_box_widget listing-share margin-top-35 margin-bottom-40 no-border">
          <h3><i class="sl sl-icon-pin"></i> Bookmark Listing</h3>
		  <span>1275 People Bookmarked Listings</span>
          <button class="like-button"><span class="like-icon"></span> Login to Bookmark Listing</button>          
          <ul class="utf_social_icon rounded margin-top-35">
            <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
            <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
            <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
            <li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>            
          </ul>
          <div class="clearfix"></div>
        </div>
		<div class="utf_box_widget opening-hours review-avg-wrapper margin-top-35">
          <h3><i class="sl sl-icon-star"></i>  Rating Average </h3>
          <div class="box-inner">
			  <div class="rating-avg-wrapper text-theme clearfix">
				<div class="rating-avg">4.8</div>
				<div class="rating-after">
				  <div class="rating-mode">/5 Average</div>
				  
				</div>
			  </div>
			  <div class="ratings-avg-wrapper">
				<div class="ratings-avg-item">
				  <div class="rating-label">Quality</div>
				  <div class="rating-value text-theme">5.0</div>
				</div>
				<div class="ratings-avg-item">
				  <div class="rating-label">Location</div>
				  <div class="rating-value text-theme">4.5</div>
				</div>
				<div class="ratings-avg-item">
				  <div class="rating-label">Space</div>
				  <div class="rating-value text-theme">3.5</div>
				</div>
				<div class="ratings-avg-item">
				  <div class="rating-label">Service</div>
				  <div class="rating-value text-theme">4.0</div>
				</div>
				<div class="ratings-avg-item">
				  <div class="rating-label">Price</div>
				  <div class="rating-value text-theme">5.0</div>
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
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-01.jpg" alt=""> <span class="tag"><i class="im im-icon-Chef-Hat"></i> Restaurant</span> <span class="featured_tag">Featured</span>
					  <span class="utf_open_now">Open Now</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $55</span>							
							<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
						</div>
						<h3>Chontaduro Barcelona</h3>
						<span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>											
					  </div>					  
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				  </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-02.jpg" alt=""> <span class="tag"><i class="im im-icon-Electric-Guitar"></i> Events</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $45 - $70</span>							
						</div>
						<h3>The Lounge & Bar</h3>
						<span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>												
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				  </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-03.jpg" alt=""> <span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span>
					  <span class="utf_closed">Closed</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $55</span>							
						</div>
						<h3>Westfield Sydney</h3>
						<span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>												
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				  </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-04.jpg" alt=""> <span class="tag"><i class="im im-icon-Dumbbell"></i> Fitness</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $45 - $70</span>							
							<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
						</div>
						<h3>Ruby Beauty Center</h3>
						<span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>												
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				  </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-05.jpg" alt=""> <span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span> <span class="featured_tag">Featured</span>
					  <span class="utf_closed">Closed</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $45 - $70</span>							
						</div>
						<h3>UK Fitness Club</h3>
						<span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>												
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				   </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-06.jpg" alt=""> <span class="tag"><i class="im im-icon-Chef-Hat"></i> Restaurant</span>
					  <span class="utf_open_now">Open Now</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $45</span>							
							<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
						</div>
						<h3>Fairmont Pacific Rim</h3>
						<span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>											
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a>
				  </div>
				</div>
			  </div>
		  </div>
			</div>
		  </div>
	  </div>
    </div>
  </section>
@stop