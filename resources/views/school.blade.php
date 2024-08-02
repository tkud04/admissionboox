<?php
$void = 'javascript:void(0)';
?>
@extends('layout')

@section('title',$school['name'])

@section('scripts')

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

<div class="container">
    <div class="row utf_sticky_main_wrapper">
      <div class="col-lg-8 col-md-8">
        <div id="titlebar" class="utf_listing_titlebar">
          <div class="utf_listing_titlebar_title">
           <h2>{{$school['name']}} <span class="listing-tag">{{strtoupper($school['status'])}}</span></h2>		   
            <span> <a href="#utf_listing_location" class="listing-address"> <i class="sl sl-icon-location"></i> {{$address['school_state']}}</a> </span>			
			<span class="call_now"><i class="sl sl-icon-phone"></i> <a href="tel:{{$school['phone']}}">{{$school['phone']}}</a></span>
            <div class="utf_star_rating_section" data-rating="4.5">
              <div class="utf_counter_star_rating">(4.5) / (3 Reviews)</div>
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
			<a href="#"><i class="sl sl-icon-globe" aria-hidden="true"></i> www.example.com</a>			
          </div>
		  <div id="share-school-div" class="social-contact">
			<a href="#" class="facebook-link"><i class="fa fa-facebook"></i> Facebook</a>
			<a href="#" class="twitter-link"><i class="fa fa-twitter"></i> Twitter</a>
			<a href="#" class="instagram-link"><i class="fa fa-instagram"></i> Instagram</a>
			<a href="#" class="linkedin-link"><i class="fa fa-linkedin"></i> Linkedin</a>
			<a href="#" class="youtube-link"><i class="fa fa-youtube-play"></i> Youtube</a>
		  </div>		  		 
        </div>
		
		<div id="utf_listing_tags" class="utf_listing_section listing_tags_section">
          <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-40">Tags</h3>
		   <?php
            $tags = [
				'day' => false,
				'boarding' => false,
				'early' => false,
				'primary' => false,
				'secondary' => false,
				'tertiary' => false,
				'boys' => false,
				'girls' => false,
				'faith' => false,
				'private' => false,
				'public' => false,
			];

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
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Listing FAQ's</h3>
          <div class="style-2">
			<div class="accordion">
			  <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all"><span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span><i class="sl sl-icon-plus"></i> (1) How to Open an Account?</h3>
			  <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-utf_widget_content" style="display: none;">
				<p>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum is simply dummy text of the printing and type setting industry.</p>
			  </div>
			  <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all"><span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span><i class="sl sl-icon-plus"></i> (2) How to Add Listing?</h3>
			  <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-utf_widget_content" style="display: none;">
				<p>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum is simply dummy text of the printing and type setting industry.</p>
			  </div>
			  <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all"><span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span><i class="sl sl-icon-plus"></i> (3) What is Featured Listing?</h3>
			  <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-utf_widget_content" style="display: none;">
				<p>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum is simply dummy text of the printing and type setting industry.</p>
			  </div>			  			  				  			  
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
          <h3 class="utf_listing_headline_part margin-top-75 margin-bottom-20">Reviews <span>(08)</span></h3>
          <div class="clearfix"></div>
		  <div class="reviews-container">
			<div class="row">
				<div class="col-lg-3">
					<div id="review_summary">
						<strong>4.5</strong>
						<em>Superb Reviews</em>
						<small>Out of 15 Reviews</small>
					</div>
				</div>
				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Quality</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>77</strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Space</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>15</strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Price</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>18</strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Service</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>10</strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Location</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>05</strong></small></div>
					</div>
				</div>
			</div>
		  </div>	 	
          <div class="comments utf_listing_reviews">
            <ul>
              <li>
                <div class="avatar"><img src="images/client-avatar1.jpg" alt=""></div>
                <div class="utf_comment_content">
                  <div class="utf_arrow_comment"></div>
                  <div class="utf_star_rating_section" data-rating="5"><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span></div>
				  <a href="#" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a>                   
                  <div class="utf_by_comment">Francis Burton<span class="date"><i class="fa fa-clock-o"></i> Jan 05, 2022 - 8:52 am</span> </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat.</p>                                    
				</div>
              </li>
              <li>
                <div class="avatar"><img src="images/client-avatar2.jpg" alt=""> </div>
                <div class="utf_comment_content">
                  <div class="utf_arrow_comment"></div>
                  <div class="utf_star_rating_section" data-rating="4"><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star empty"></span></div>
				  <a href="#" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a>                  
                  <div class="utf_by_comment">Francis Burton<span class="date"><i class="fa fa-clock-o"></i> Jan 05, 2022 - 8:52 am</span> </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat.</p>                  
				</div>
              </li>
			  <li>
                <div class="avatar"><img src="images/client-avatar3.jpg" alt=""> </div>
                <div class="utf_comment_content">
                  <div class="utf_arrow_comment"></div>
                  <div class="utf_star_rating_section" data-rating="4"><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star empty"></span></div>                  
                  <div class="utf_by_comment">Francis Burton<span class="date"><i class="fa fa-clock-o"></i> Jan 05, 2022 - 8:52 am</span> </div>
				  <a href="#" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat.</p>                  
				</div>
              </li>
              <li>
                <div class="avatar"><img src="images/client-avatar1.jpg" alt=""></div>
                <div class="utf_comment_content">
                  <div class="utf_arrow_comment"></div>
                  <div class="utf_star_rating_section" data-rating="4.5"><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star half"></span></div>                  
                  <div class="utf_by_comment">Francis Burton<span class="date"><i class="fa fa-clock-o"></i> Jan 05, 2022 - 8:52 am</span> </div>
				  <a href="#" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a> 
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat.</p>
                  <div class="review-images utf_gallery_container"> 
				    <a href="images/review-image-01.jpg" class="utf_gallery"><img src="images/review-image-01.jpg" alt=""></a> 
					<a href="images/review-image-02.jpg" class="utf_gallery"><img src="images/review-image-02.jpg" alt=""></a> 
					<a href="images/review-image-03.jpg" class="utf_gallery"><img src="images/review-image-03.jpg" alt=""></a> 
					<a href="images/review-image-01.jpg" class="utf_gallery"><img src="images/review-image-01.jpg" alt=""></a> 
					<a href="images/review-image-02.jpg" class="utf_gallery"><img src="images/review-image-02.jpg" alt=""></a> 
					<a href="images/review-image-03.jpg" class="utf_gallery"><img src="images/review-image-03.jpg" alt=""></a> 
				  </div>                  
				</div>
              </li>
			  <li>
                <div class="avatar"><img src="images/client-avatar3.jpg" alt=""> </div>
                <div class="utf_comment_content">
                  <div class="utf_arrow_comment"></div>
                  <div class="utf_star_rating_section" data-rating="4"><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star empty"></span></div>                  
                  <div class="utf_by_comment">Francis Burton<span class="date"><i class="fa fa-clock-o"></i> Jan 05, 2022 - 8:52 am</span> </div>
				  <a href="#" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat.</p>                  
				</div>
              </li>
            </ul>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12">
              <div class="utf_pagination_container_part margin-top-30">
                <nav class="pagination">
                  <ul>
                    <li><a href="#"><i class="sl sl-icon-arrow-left"></i></a></li>
                    <li><a href="#" class="current-page">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div id="utf_add_review" class="utf_add_review-box">
          <h3 class="utf_listing_headline_part margin-bottom-20">Add Your Review</h3>
          <span class="utf_leave_rating_title">Your email address will not be published.</span>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="clearfix"></div>
              <div class="utf_leave_rating margin-bottom-30">
                <input type="radio" name="rating" id="rating-1" value="1">
                <label for="rating-1" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-2" value="2">
                <label for="rating-2" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-3" value="3">
                <label for="rating-3" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-4" value="4">
                <label for="rating-4" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-5" value="5">
                <label for="rating-5" class="fa fa-star"></label>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="add-review-photos margin-bottom-30">
                <div class="photoUpload"> <span>Upload Photo <i class="sl sl-icon-arrow-up-circle"></i></span>
                  <input type="file" class="upload">
                </div>
              </div>
            </div>
          </div>
          <form id="utf_add_comment" class="utf_add_comment">
            <fieldset>
              <div class="row">
                <div class="col-md-4">
                  <label>Name:</label>
                  <input type="text" placeholder="Name" value="">
                </div>
                <div class="col-md-4">
                  <label>Email:</label>
                  <input type="text" placeholder="Email" value="">
                </div>
                <div class="col-md-4">
                  <label>Subject:</label>
                  <input type="text" placeholder="Subject" value="">
                </div>
              </div>
              <div>
                <label>Review:</label>
                <textarea cols="40" placeholder="Your Message..." rows="3"></textarea>
              </div>
            </fieldset>
            <button class="button">Submit Review</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
      
      <!-- Sidebar -->
      <div class="col-lg-4 col-md-4 margin-top-75 sidebar-search">
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
        <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-phone"></i> Contact Info</h3>
          <div class="utf_hosted_by_user_title"> <a href="#" class="utf_hosted_by_avatar_listing"><img src="images/dashboard-avatar.jpg" alt=""></a>
            <h4><a href="#">Kathy Brown</a><span>Posted 3 Days Ago</span>
              <span><i class="sl sl-icon-location"></i> Lonsdale St, Melbourne</span>
            </h4>
          </div>
		  <ul class="utf_social_icon rounded margin-top-10">
            <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
            <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
            <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
            <li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>            
          </ul>
          <ul class="utf_listing_detail_sidebar">
            <li><i class="sl sl-icon-map"></i> 12345 Little Lonsdale St, Melbourne</li>
            <li><i class="sl sl-icon-phone"></i> +(012) 1123-254-456</li>
            <li><i class="sl sl-icon-globe"></i> <a href="#">www.example.com</a></li>
            <li><i class="fa fa-envelope-o"></i> <a href="mailto:info@example.com">info@example.com</a></li>
          </ul>		  
        </div>
        <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-folder-alt"></i> Categories</h3>
          <ul class="utf_listing_detail_sidebar">
            <li><i class="fa fa-angle-double-right"></i> <a href="#">Travel</a></li>
            <li><i class="fa fa-angle-double-right"></i> <a href="#">Nightlife</a></li>
            <li><i class="fa fa-angle-double-right"></i> <a href="#">Fitness</a></li>
            <li><i class="fa fa-angle-double-right"></i> <a href="#">Real Estate</a></li>
            <li><i class="fa fa-angle-double-right"></i> <a href="#">Restaurant</a></li>
            <li><i class="fa fa-angle-double-right"></i> <a href="#">Dance Floor</a></li>
          </ul>
        </div>
        <div class="utf_box_widget opening-hours margin-top-35">
          <h3><i class="sl sl-icon-clock"></i> Business Hours</h3>
          <ul>
            <li>Monday <span>09:00 AM - 09:00 PM</span></li>
            <li>Tuesday <span>09:00 AM - 09:00 PM</span></li>
            <li>Wednesday <span>09:00 AM - 09:00 PM</span></li>
            <li>Thursday <span>09:00 AM - 09:00 PM</span></li>
            <li>Friday <span>09:00 AM - 09:00 PM</span></li>
            <li>Saturday <span>09:00 AM - 10:00 PM</span></li>
            <li>Sunday <span>09:00 AM - 10:00 PM</span></li>
          </ul>
        </div>	
		<div class="opening-hours margin-top-35">
			<div class="utf_coupon_widget" style="background-image: url(images/coupon-bg-1.jpg);">
				<div class="utf_coupon_overlay"></div>
				<a href="#" class="utf_coupon_top">
					<h3>Book Now &amp; Get 50% Discount</h3>
					<div class="utf_coupon_expires_date">Date of Expires 05/08/2022</div>	
					<div class="utf_coupon_used"><strong>How to use?</strong> Just show us this coupon on a screen</div>	
				</a>
				<div class="utf_coupon_bottom">
					<p>Coupon Code</p>
					<div class="utf_coupon_code">DL76T</div>
				</div>
			</div>
		</div>
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
          <h3><i class="sl sl-icon-envelope-open"></i> Sidebar Form</h3>
          <form id="contactform">
            <div class="row">              
              <div class="col-md-12">                
                  <input name="name" type="text" placeholder="Name" required="">                
              </div>
              <div class="col-md-12">                
                  <input name="email" type="email" placeholder="Email" required="">                
              </div>    
			  <div class="col-md-12">                
                  <input name="phone" type="text" placeholder="Phone" required="">                
              </div>	
			  <div class="col-md-12">
				  <textarea name="comments" cols="40" rows="2" id="comments" placeholder="Your Message" required=""></textarea>
			  </div>
            </div>            
            <input type="submit" class="submit button" id="submit" value="Contact Agent">
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