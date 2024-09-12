
@extends('layout')

@section('title',"Complete Application")

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


@section('scripts')
<script src="js/moment.min.js"></script>
  <script>	
  $(() => {
	const selectedDate = moment("{{$applicant['date_slot']}}"),
	deadlineDate = moment("{{$admission['end_date']}}"),
	selectedDateDisplay = selectedDate?.format('ddd, MMMM Do YYYY'),
	deadlineDateDisplay = deadlineDate?.format('ddd, MMMM Do YYYY')

	$('#selected-date').html(selectedDateDisplay);
	$('#deadline-date').html(deadlineDateDisplay);

	$('#confirm-btn').click((e) => {
	e.preventDefault()
	clearValidations()

		$('#confirm-btn').hide()
        $('#confirm-loading').fadeIn()
	

	   confirmSchoolApplication({
		xf: "$applicant['id']",
	   },
	         (data) => {
				$('#confirm-loading').hide()
                
                if(data.status === 'ok'){
					 window.location = `${data?.data}`
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
  })
  

  </script>
@stop

@section('content')

@include('components.generic-banner',[
	 'title' => "Complete Application"
	])



  <div class="container margin-bottom-75">
    <div class="row">
      <div class="col-lg-8 col-md-8 utf_listing_payment_section">
	    <div class="utf_booking_listing_section_form margin-bottom-40">
		  <h3><i class="sl sl-icon-paper-plane"></i> Billing Information</h3>
			<div class="row">
			  <div class="col-md-6">
				<label>First Name</label>
				<input type="text" value="{{$user->fname}}" placeholder="First Name">
			  </div>
			  <div class="col-md-6">
				<label>Last Name</label>
				<input type="text" value="{{$user->lname}}" placeholder="Last Name">
			  </div>
			  <div class="col-md-6">
				<div class="medium-icons">
				  <label>E-Mail</label>
				  <input type="text" value="{{$user->email}}" placeholder="Email">
				</div>
			  </div>
			  <div class="col-md-6">
				<div class="medium-icons">
				  <label>Phone</label>
				  <input type="text" value="{{$user->phone}}" placeholder="Phone">
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
			@include('components.generic-loading', ['message' => 'Processing', 'id' => "confirm-loading"])
			<a href="confirm-btn" class="button utf_booking_confirmation_button margin-top-20 margin-bottom-10">Confirm Now</a> 		
		</div>
	  </div>
      <div class="col-lg-4 col-md-4 margin-top-0 utf_listing_payment_section">
        <div class="utf_booking_listing_item_container compact utf_order_summary_widget_section">
          <div class="listing-item"> <img src="{{$bImg}}" alt="">
            <div class="utf_listing_item_content">              
              <h3>{{$school['name']}}</h3>
              <span><i class="fa fa-map-marker"></i> {{$address['school_state']}}</span>
						<span><i class="fa fa-phone"></i> {{$school['phone']}}</span>											
			  <div class="utf_star_rating_section"  data-rating="{{$rating}}">
				<div class="utf_counter_star_rating">({{count($allReviews)}}) Reviews</div>
			  </div>
			</div>
          </div>
        </div>
        <div class="boxed-widget opening-hours summary margin-top-0">
          <h3><i class="fa fa-calendar-check-o"></i> Application Summary</h3>
          <ul>
            <li>Examination date <span id="selected-date"></span></li>
			<li>Hour <span>{{$selectedTime}}</span></li>
			<li>Admission deadline <span id="deadline-date"></span></li>     
			<li>Application Fee <span>&#8358;{{number_format($applicationFee,2)}}</span></li>
			<li>V.A.T <span>&#8358;{{number_format($vatFee,2)}}</span></li>
			<li class="total-costs">Sub Total <span>&#8358;{{number_format($totalFee,2)}}</span></li>
			<li class="total-costs">
				<div class="col-md-8">
				  <input id="couponCode" placeholder="Have a coupon enter here..." required="" type="text">
				</div>
				<div class="col-md-4">
				  <input type="submit" class="coupon_code" value="Apply">	
				</div>
				<div class="clearfix"></div>
			</li>
            <li class="total-costs">Total Cost <span>&#8358;{{number_format($totalFee,2)}}</span></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

@stop