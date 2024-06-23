<?php
$useSidebar = $hasCompletedSignup;
$ac = "dashboard";
?>
@extends('dashboard_layout')

@section('dashboard-title', $school['name'])


@section('scripts')
@if(!$hasCompletedSignup)
  <script>
    $(document).ready(() => {
    Swal.fire({
      icon: 'warning',
      title: `Complete your school information`,
      html: `<p>Your school information is yet to be complete. Please fill out the rest of the information required in order to use AdmissionBoox!</p>`
    })
      .then((result) => {
      if (result.value) {
        //window.location = "dashboard";				
      }
      });
    })
  </script>
@endif

<script>

  const handleResourcesUpload = (e) => {
    console.log('Form event: ', e)
    return false
  }

  const hideValidations = () => {
    $('#usi-clubs-validation').hide()
    $('#usi-facilities-validation').hide()
    $('#usi-latitude-validation').hide()
    $('#usi-longitude-validation').hide()
    $('#usi-address-validation').hide()
    $('#usi-state-validation').hide()
  }

  const initElems = () => {
   hideValidations()
  }

  $(document).ready(() => {
    initElems()
    $('#update-school-info-resources').submit(e => {
      e.preventDefault()
      console.log('form: ', $('#usi-resources'))
    })

    $('#usi-btn').click(e => {
      e.preventDefault()
      hideValidations()
      console.log('updating school info')
      const clubs = $('input.usi-clubs:checked'), facilities = $('input.usi-facilities:checked'),
                    locationState = $('#usi-state').val(), locationAddress = $('#usi-address').val(), 
                    locationLat = $('#usi-latitude').val(), locationLong = $('#usi-longitude').val()
      


      const v = clubs.length < 1 || facilities.length < 1 ||locationState === '' ||
               locationAddress === '' || locationLat === '' || locationLong === ''

      
      if(v){
        if(clubs.length < 1) $('#usi-clubs-validation').fadeIn()
        if(facilities.length < 1) $('#usi-facilities-validation').fadeIn()
        if(locationState === '') $('#usi-state-validation').fadeIn()
        if(locationAddress === '') $('#usi-address-validation').fadeIn()
        if(locationLat === '') $('#usi-latitude-validation').fadeIn()
        if(locationLong === '') $('#usi-longitude-validation').fadeIn()
      }
      else{
        const clubValues = [], facilityValues = []
       
        clubs.each((i,elem) => {
          clubValues.push(elem.getAttribute('data-value'))
        })

        facilities.each((i,elem) => {
          facilityValues.push(elem.getAttribute('data-value'))
        })


       
        $('#usi-btn').hide()
        $('#usi-loading').fadeIn()

        const fd = new FormData()
              fd.append('xf',"{{$school['id']}}")
              fd.append('address',locationAddress)
              fd.append('latitude',locationLat)
              fd.append('longitude',locationLong)
              fd.append('state',locationState)
              fd.append('clubs',JSON.stringify(clubValues))
              fd.append('facilities',JSON.stringify(facilityValues))

              updateSchoolInfo(fd,
              (data) => {
                
                $('#usi-loading').hide()
              $('#usi-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('School Info Updated!')
                    window.location = 'dashboard'
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#usi-loading').hide()
              $('#usi-btn').fadeIn()
                alert(`Failed to update school info: ${err}`)
              }
            )

      }

    })
  })
</script>
@stop


@section('dashboard-content')
@if($hasCompletedSignup)
  @if(count($notifications) > 0)
    <div class="row">
    <div class="col-md-12">
    @foreach($notifications as $n)
    @include('components.dashboard-notification', [
      'type' => $n['type'],
      'content' => isset($n['content']) ? $n['content'] : "",
      'xf' => $n['id']
      ])
  @endforeach
    </div>
    </div>
  @endif

  <div class="row">
    <div class="col-lg-6 col-md-12">
    <div class="utf_dashboard_list_box with-icons margin-top-20">
      <h4>Recent Activities</h4>
      <ul>
      <li>
        <i class="utf_list_box_icon sl sl-icon-layers"></i> Peter Parker Left A Review 5.0 On <strong><a href="#">
          Restaurant</a></strong> <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
      </li>
      <li>
        <i class="utf_list_box_icon sl sl-icon-star"></i> Your Listing <strong><a href="#">Local
          Service</a></strong> Has Been Approved<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
      </li>
      <li>
        <i class="utf_list_box_icon sl sl-icon-heart"></i> Someone Bookmarked Your <strong><a
          href="#">Listing</a></strong> Restaurant <a href="#" class="close-list-item"><i
          class="fa fa-close"></i></a>
      </li>
      <li>
        <i class="utf_list_box_icon sl sl-icon-star"></i> Your Listing <strong><a href="#">Local
          Service</a></strong> Has Been Approved<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
      </li>
      <li>
        <i class="utf_list_box_icon sl sl-icon-heart"></i> Someone Bookmarked Your <strong><a
          href="#">Listing</a></strong> Restaurant <a href="#" class="close-list-item"><i
          class="fa fa-close"></i></a>
      </li>
      <li>
        <i class="utf_list_box_icon sl sl-icon-layers"></i> Peter Parker Left A Review 5.0 On <strong><a href="#">
          Restaurant</a></strong> <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
      </li>
      </ul>
    </div>

    </div>
    <div class="col-lg-6 col-md-12">
    <div class="utf_dashboard_list_box invoices with-icons margin-top-20">
      <h4>All Order Invoices</h4>
      <ul>
      <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>Premium Plan <span
          class="paid">Paid</span></strong>
        <ul>
        <li><span>Order Number:-</span> 004128641</li>
        <li><span>Date:-</span> 12 Jan 2022</li>
        </ul>
        <div class="buttons-to-right"> <a href="dashboard_invoice.html" class="button gray"><i
          class="sl sl-icon-printer"></i> Invoice</a> </div>
      </li>
      <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>Platinum Plan <span
          class="paid">Paid</span></strong>
        <ul>
        <li><span>Order Number:-</span> 004312641</li>
        <li><span>Date:-</span> 12 Jan 2022</li>
        </ul>
        <div class="buttons-to-right"> <a href="dashboard_invoice.html" class="button gray"><i
          class="sl sl-icon-printer"></i> Invoice</a> </div>
      </li>
      <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>Platinum Plan <span
          class="paid">Paid</span></strong>
        <ul>
        <li><span>Order Number:-</span> 004312641</li>
        <li><span>Date:-</span> 12 Jan 2022</li>
        </ul>
        <div class="buttons-to-right"> <a href="dashboard_invoice.html" class="button gray"><i
          class="sl sl-icon-printer"></i> Invoice</a> </div>
      </li>
      <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>Basic Plan <span
          class="unpaid">Unpaid</span></strong>
        <ul>
        <li><span>Order Number:-</span> 004031281</li>
        <li><span>Date:-</span> 12 Jan 2022</li>
        </ul>
        <div class="buttons-to-right"> <a href="dashboard_invoice.html" class="button gray"><i
          class="sl sl-icon-printer"></i> Invoice</a> </div>
      </li>
      <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>Basic Plan <span
          class="unpaid">Unpaid</span></strong>
        <ul>
        <li><span>Order Number:-</span> 004031281</li>
        <li><span>Date:-</span> 12 Jan 2022</li>
        </ul>
        <div class="buttons-to-right"> <a href="dashboard_invoice.html" class="button gray"><i
          class="sl sl-icon-printer"></i> Invoice</a> </div>
      </li>
      <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>Basic Plan <span
          class="unpaid">Unpaid</span></strong>
        <ul>
        <li><span>Order Number:-</span> 004031281</li>
        <li><span>Date:-</span> 12 Jan 2022</li>
        </ul>
        <div class="buttons-to-right"> <a href="dashboard_invoice.html" class="button gray"><i
          class="sl sl-icon-printer"></i> Invoice</a> </div>
      </li>
      </ul>
    </div>
    </div>
  </div>
@else
  <div class="row">
    <div class="col-lg-12 col-md-12">
    <div class="utf_dashboard_list_box margin-top-0">
      <h4 class="gray">Update School Information</h4>

      <div class="utf_dashboard_list_box-static">
      <div class="my-profile">
        <div class="row with-forms">
        <div class="col-md-12">
          <div class="form-group lis-relative">
          Your school profile is yet to be complete. Please fill out the required information to continue.
          </div>
        </div>
        </div>
        <div class="row with-forms">
        <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-folder-alt"></i> Resources</h3>
          </div>
          <p>Upload relevant resources; for example, school prospectus, etc</p>
          <?php
          $resourcesCount = count($school['resources']);
           if($resourcesCount > 0){
          ?>
              <p class="text-info">{{$resourcesCount}} resource(s) uploaded</p>
          <?php
           }
          ?>
         
          @include('components.form-validation', ['id' => "usi-resources-validation"])
          <form action="api/usr" class="dropzone"></form>
        </div>


        <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-energy"></i> Clubs</h3>
          </div>

          @include('components.form-validation', ['id' => "usi-clubs-validation",'message' => 'Select at least 1 club'])

          <div class="checkboxes in-row amenities_checkbox">
          <ul>
            <?php
    for ($i = 0; $i < count($clubs); $i++) {
    $club = $clubs[$i];
    if(in_array($club,$school['clubs'])){}
    else{
            ?>
            <li>
            <input id="check-{{$i}}" type="checkbox" class="usi-clubs" data-value="{{$club['id']}}">
            <label for="check-{{$i}}"><i class="im {{$club['icon']}}" style="font-size: 20px;"></i>
              {{$club['club_name']}}</label>
            </li>
            <?php
             }     
            }   
            ?>
          </ul>
          </div>
        </div>

        <?php
          $schoolAddress = $school['address'];
          $schoolAddressValidation = $schoolAddress['school_state'] === '' || $schoolAddress['school_address'] === '' ||
                                    $schoolAddress['longitude'] === '' ||  $schoolAddress['latitude'] === '';

          if($schoolAddressValidation)
          {
        ?>
        <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-map"></i> Location</h3>
          </div>
          <div class="utf_submit_section">
          <div class="row with-forms">
            <div class="col-md-6">
            @include('components.form-validation', ['id' => "usi-state-validation"])
            <h5>State</h5>
            <div class="intro-search-field utf-chosen-cat-single">
              
              <select id="usi-state" class="selectpicker default" data-selected-text-format="count" data-size="7"
                title="Select State" tabindex="-98">
                <option class="bs-title-option" value="{{$schoolAddress['school_state']}}">Select State</option>
                <?php
                  foreach($ngStates as $s)
                  {
                ?>
                <option value="{{$s}}">{{$s}}</option>
                <?php
                  }
                ?>
              </select>
            </div>
            </div>
            <div class="col-md-6">
            @include('components.form-validation', ['id' => "usi-address-validation"])
            <h5>School Address</h5>
            <input type="text" class="input-text" name="address" id="usi-address" placeholder="Address" value="{{$schoolAddress['school_address']}}">
            </div>
            <div class="col-md-12">
            <h5>Co-ordinates</h5>
            <div class="row with-forms">
              <div class="col-md-6">
              @include('components.form-validation', ['id' => "usi-latitude-validation"])
              <h6>Latitude</h6>
              <input type="text" class="input-text" name="latitude" id="usi-latitude" placeholder="40.7324319"
                value="{{$schoolAddress['latitude']}}">
              </div>
              <div class="col-md-6">
              @include('components.form-validation', ['id' => "usi-longitude-validation"])
              <h6>Longitude</h6>
              <input type="text" class="input-text" name="longitude" id="usi-longitude"
                placeholder="-73.824807777775" value="{{$schoolAddress['longitude']}}">
              </div>
            </div>
            </div>
           <!-- <div id="utf_listing_location" class="col-md-12 utf_listing_section">
            <div id="utf_single_listing_map_block">
              <div id="utf_single_listingmap" data-latitude="40.7324319" data-longitude="-73.824807777775"
              data-map-icon="im im-icon-Hamburger"></div>
              <a href="#" id="utf_street_view_btn">Street View</a>
            </div>
            </div>-->
          </div>
          </div>
        </div>
        <?php
          }
        ?>

        <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-energy"></i> Facilities</h3>
          </div>

          @include('components.form-validation', ['id' => "usi-facilities-validation",'message' => 'Select at least 1 facility'])

          <div class="checkboxes in-row amenities_checkbox">
          <ul>
            <?php
    for ($i = 0; $i < count($facilities); $i++) {
    $facility = $facilities[$i];
    if(in_array($facility,$school['facilities'])){}
    else{
            ?>
            <li>
            <input id="check-facility-{{$i}}" type="checkbox" class="usi-facilities" data-value="{{$facility['id']}}">
            <label for="check-facility-{{$i}}"><i class="im {{$facility['icon']}}" style="font-size: 20px;"></i>
              {{$facility['facility_name']}}</label>
            </li>
            <?php
    }
  }
            ?>
          </ul>
          </div>
        </div>

        @if(strlen($school['logo']) < 1)
        <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-folder-alt"></i> School Logo</h3>
          </div>
          <p>Upload school logo</p>
          @include('components.form-validation', ['id' => "usi-logo-validation"])
          <form action="api/usl" class="dropzone"></form>
        </div>
         @endif

         @if(strlen($school['landing_page_pic']) < 1)
        <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-folder-alt"></i> School Landing Page</h3>
          </div>
          <p>Upload school landing page</p>
          @include('components.form-validation', ['id' => "usi-landing-page-validation"])
          <form action="api/ust" class="dropzone"></form>
        </div>
        @endif

        <div class="col-md-12">
          @include('components.generic-loading', ['message' => 'Updating school info', 'id' => "usi-loading"])
          <button class="button btn_center_item margin-top-15" id="usi-btn">Submit</button>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
@endif
@stop