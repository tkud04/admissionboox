<?php
$useSidebar = $hasCompletedSignup;
$ac = "dashboard";

$classX = json_encode($classStatsXY['x']);
$classY = json_encode($classStatsXY['y']);
$genderX = json_encode($genderStatsXY['x']);
$genderY = json_encode($genderStatsXY['y']);
$locationX = json_encode($locationStatsXY['x']);
$locationY = json_encode($locationStatsXY['y']);
?>


<?php $__env->startSection('dashboard-title', $school['name']); ?>


<?php

if(!function_exists('isInSchoolFacility'))
{
  function isInSchoolFacility($item,$list)
{
  $ret = false;
   foreach($list as $l)
   {
     $f = $l['facility'];
     if($item === $f)
     {
       $ret = true;
     }
   }

   return $ret;
}
}

if(!function_exists('isInSchoolClub'))
{
  function isInSchoolClub($item,$list)
    {
      $ret = false;
       foreach($list as $l)
       {
         if($item === $l)
         {
           $ret = true;
         }
       }

       return $ret;
    }
}



?>

<?php $__env->startSection('scripts'); ?>
<?php if(!$hasCompletedSignup): ?>
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
<?php endif; ?>

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

  const initCharts = () => {
        const options1 = {
           chart: {
            type: 'bar'
           }, 
           series: [{
             name: 'Applicants',
             data: <?php echo e($classY); ?>

           }],
           xaxis: {
             categories:  <?php echo $classX; ?>

           }
         },
         options2 = {
          chart: {
            type: 'pie'
           }, 
           series: <?php echo $genderY; ?>,
           labels: <?php echo $genderX; ?>

         },
         options3 = {
           chart: {
            type: 'bar'
           }, 
           series: [{
             name: 'Applicants',
             data: <?php echo e($locationY); ?>

           }],
           xaxis: {
             categories:  <?php echo $locationX; ?>

           }
         }


         renderChart('#class-stats-chart-div',options1)
         renderChart('#gender-stats-chart-div',options2)
         renderChart('#location-stats-chart-div',options3)
      }

      $(document).ready(() =>{
        initCharts()
      })

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
              fd.append('xf',"<?php echo e($school['id']); ?>")
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
<?php $__env->stopSection(); ?>


<?php $__env->startSection('dashboard-content'); ?>
<?php if($hasCompletedSignup): ?>
  <?php if(count($notifications) > 0): ?>
    <div class="row">
    <div class="col-md-12">
    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $__env->make('components.dashboard-notification', [
      'type' => $n['type'],
      'content' => isset($n['content']) ? $n['content'] : "",
      'xf' => $n['id']
      ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </div>
  <?php endif; ?>

  <?php if(isset($dashboardStats)): ?>
    <?php echo $__env->make('components.school-dashboard-stats',['dashboardStats' => $dashboardStats], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <div class="row">
    <div class="col-lg-6 col-md-12">
    <div class="utf_dashboard_list_box with-icons margin-top-20">
      <h4>Stats</h4>
      <ul>
        <?php
         if(count($classStatsXY) > 0)
         {
           
        ?>
        <li>
          <h5>By class</h5>
          <div id="class-stats-chart-div"></div>
        </li>
        <li>
          <h5>By gender</h5>
          <div id="gender-stats-chart-div"></div>
        </li>
        <li>
          <h5>By location</h5>
          <div id="location-stats-chart-div"></div>
        </li>
        <?php
        }
        else
        {
        ?>
         <li><i class="utf_list_box_icon sl sl-icon-eyeglass"></i> No new updates yet. </strong>
      </li>
        <?php
        }
       ?>
      
      </ul>
    </div>

    </div>
    <div class="col-lg-6 col-md-12">
    <div class="utf_dashboard_list_box invoices with-icons margin-top-20">
      <h4>Recent Applications</h4>
      <ul>
        <?php
         if(count($schoolApplications) > 0)
         {
         foreach($schoolApplications as $sa)
         {
          $iid = "shdj3";
          $iu = url('application-invoice')."?xf=".$iid;
          $u = $sa['user'];
          $a = $sa['admission'];
          $term = ['name' => "", 'value' => '0'];

          foreach($terms as $t)
                    {
                      if($t['value'] === $a['term_id']) $term = $t;
                    }
        ?>
      <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong><?php echo e($a['session']); ?> <span
          class="paid"><?php echo e(ucwords($sa['stage'])); ?></span></strong>
        <ul>
        <li>
          <p>
            <span>Applicant:-</span> <?php echo e($u['fname']); ?> <?php echo e($u['lname']); ?><br>
            <span>Term selected:-</span> <?php echo e($term['name']); ?>

          </p>
        </li>
        </ul>
        <div class="buttons-to-right"> <a href="<?php echo e($iu); ?>" target="_blank" class="button gray"><i
          class="sl sl-icon-printer"></i> Invoice</a> </div>
      </li>
       <?php
         }
        }
        else
        {
        ?>
         <li><i class="utf_list_box_icon sl sl-icon-eyeglass"></i> No applications yet. <a href="<?php echo e(url('school-admissions')); ?>">View admissions</a></strong>
      </li>
        <?php
        }
       ?>
      </ul>
    </div>

    <div class="utf_dashboard_list_box invoices with-icons margin-top-20">
      <h4>Recent Emails</h4>
      <ul>
        <?php
         if(count($sentMails) > 0)
         {
         foreach($sentMails as $se)
         {
        ?>
      <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong><?php echo e(ucwords($se['title'])); ?></strong>
        <ul>
        <li>
          <p>
            <span>Date sent:-</span> <?php echo e($se['date_formatted']); ?><br>
            <span>No. of applicants:-</span> <?php echo e($se['num_applicants']); ?>

          </p>
        </li>
        </ul>
        <div class="buttons-to-right"> <a href="<?php echo e($iu); ?>" target="_blank" class="button gray"><i
          class="sl sl-icon-printer"></i> Invoice</a> </div>
      </li>
       <?php
         }
        }
        else
        {
        ?>
         <li><i class="utf_list_box_icon sl sl-icon-eyeglass"></i> No emails sent... yet. <a href="<?php echo e(url('send-email')); ?>">Send a message</a></strong>
      </li>
        <?php
        }
       ?>
      </ul>
    </div>
    </div>
  </div>
<?php else: ?>
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
              <p class="text-info"><?php echo e($resourcesCount); ?> resource(s) uploaded</p>
          <?php
           }
          ?>
         
          <?php echo $__env->make('components.form-validation', ['id' => "usi-resources-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <form action="api/usr" class="dropzone"></form>
        </div>


        <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-energy"></i> Clubs</h3>
          </div>

          <?php echo $__env->make('components.form-validation', ['id' => "usi-clubs-validation",'message' => 'Select at least 1 club'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <div class="checkboxes in-row amenities_checkbox">
          <ul>
            <?php
    for ($i = 0; $i < count($clubs); $i++) {
    $club = $clubs[$i];
    if(isInSchoolClub($club,$school['clubs'])){}
    else{
            ?>
            <li>
            <input id="check-<?php echo e($i); ?>" type="checkbox" class="usi-clubs" data-value="<?php echo e($club['id']); ?>">
            <label for="check-<?php echo e($i); ?>"><i class="im <?php echo e($club['icon']); ?>" style="font-size: 20px;"></i>
              <?php echo e($club['club_name']); ?></label>
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
            <?php echo $__env->make('components.form-validation', ['id' => "usi-state-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <h5>State</h5>
            <div class="intro-search-field utf-chosen-cat-single">
              
              <select id="usi-state" class="selectpicker default" data-selected-text-format="count" data-size="7"
                title="Select State" tabindex="-98">
                <option class="bs-title-option" value="<?php echo e($schoolAddress['school_state']); ?>">Select State</option>
                <?php
                  foreach($ngStates as $s)
                  {
                ?>
                <option value="<?php echo e($s); ?>"><?php echo e($s); ?></option>
                <?php
                  }
                ?>
              </select>
            </div>
            </div>
            <div class="col-md-6">
            <?php echo $__env->make('components.form-validation', ['id' => "usi-address-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <h5>School Address</h5>
            <input type="text" class="input-text" name="address" id="usi-address" placeholder="Address" value="<?php echo e($schoolAddress['school_address']); ?>">
            </div>
            <div class="col-md-12">
            <h5>Co-ordinates</h5>
            <div class="row with-forms">
              <div class="col-md-6">
              <?php echo $__env->make('components.form-validation', ['id' => "usi-latitude-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <h6>Latitude</h6>
              <input type="text" class="input-text" name="latitude" id="usi-latitude" placeholder="40.7324319"
                value="<?php echo e($schoolAddress['latitude']); ?>">
              </div>
              <div class="col-md-6">
              <?php echo $__env->make('components.form-validation', ['id' => "usi-longitude-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <h6>Longitude</h6>
              <input type="text" class="input-text" name="longitude" id="usi-longitude"
                placeholder="-73.824807777775" value="<?php echo e($schoolAddress['longitude']); ?>">
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

          <?php echo $__env->make('components.form-validation', ['id' => "usi-facilities-validation",'message' => 'Select at least 1 facility'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <div class="checkboxes in-row amenities_checkbox">
          <ul>
            <?php
    
    for ($i = 0; $i < count($facilities); $i++) {
    $facility = $facilities[$i];
    //$facility = $f['facility'];
    if(isInSchoolFacility($facility,$school['facilities'])){}
    else{
            ?>
            <li>
            <input id="check-facility-<?php echo e($i); ?>" type="checkbox" class="usi-facilities" data-value="<?php echo e($facility['id']); ?>">
            <label for="check-facility-<?php echo e($i); ?>"><i class="im <?php echo e($facility['icon']); ?>" style="font-size: 20px;"></i>
              <?php echo e($facility['facility_name']); ?></label>
            </li>
            <?php
    }
  }
            ?>
          </ul>
          </div>
        </div>

        <?php if(strlen($school['logo']) < 1): ?>
        <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-folder-alt"></i> School Logo</h3>
          </div>
          <p>Upload school logo</p>
          <?php echo $__env->make('components.form-validation', ['id' => "usi-logo-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <form action="api/usl" class="dropzone"></form>
        </div>
         <?php endif; ?>

         <?php if(count($school['banners']) < 1): ?>
        <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-folder-alt"></i> School Landing Page</h3>
          </div>
          <p>Upload school landing page</p>
          <?php echo $__env->make('components.form-validation', ['id' => "usi-landing-page-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <form action="api/ust" class="dropzone"></form>
        </div>
        <?php endif; ?>

        <div class="col-md-12">
          <?php echo $__env->make('components.generic-loading', ['message' => 'Updating school info', 'id' => "usi-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <button class="button btn_center_item margin-top-15" id="usi-btn">Submit</button>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/school-dashboard.blade.php ENDPATH**/ ?>