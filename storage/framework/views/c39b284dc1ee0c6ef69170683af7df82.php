<?php
$useSidebar = $hasCompletedSignup;
$ac = "dashboard";
?>


<?php $__env->startSection('dashboard-title', $school['name']); ?>


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

  const initElems = () => {

  }

  $(document).ready(() => {
    initElems()
    $('#update-school-info-resources').submit(e => {
      e.preventDefault()
      console.log('form: ', $('#update-school-info-resources'))
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
          <?php echo $__env->make('components.form-validation', ['id' => "update-school-info-resources-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <form action="api/usr" class="dropzone"></form>
        </div>


        <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-energy"></i> Clubs</h3>
          </div>

          <?php echo $__env->make('components.form-validation', ['id' => "update-school-clubs-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <div class="checkboxes in-row amenities_checkbox">
          <ul>
            <?php
    for ($i = 0; $i < count($clubs); $i++) {
    $club = $clubs[$i];
            ?>
            <li>
            <input id="check-<?php echo e($i); ?>" type="checkbox" name="clubs">
            <label for="check-<?php echo e($i); ?>"><i class="im <?php echo e($club['icon']); ?>" style="font-size: 20px;"></i>
              <?php echo e($club['club_name']); ?></label>
            </li>
            <?php
    }
            ?>
          </ul>
          </div>
        </div>

        <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-map"></i> Location</h3>
          </div>
          <div class="utf_submit_section">
          <div class="row with-forms">
            <div class="col-md-6">
            <h5>State</h5>
            <div class="intro-search-field utf-chosen-cat-single">
              
              <select class="selectpicker default" data-selected-text-format="count" data-size="7"
                title="Select City" tabindex="-98">
                <option class="bs-title-option" value="">Select State</option>
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
            <h5>School Address</h5>
            <input type="text" class="input-text" name="address" id="address" placeholder="Address" value="">
            </div>
            <div class="col-md-12">
            <h5>Co-ordinates</h5>
            <div class="row with-forms">
              <div class="col-md-6">
              <input type="text" class="input-text" name="latitude" id="latitude" placeholder="40.7324319"
                value="">
              </div>
              <div class="col-md-6">
              <input type="text" class="input-text" name="longitude" id="longitude"
                placeholder="-73.824807777775" value="">
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

        <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-energy"></i> Facilities</h3>
          </div>

          <?php echo $__env->make('components.form-validation', ['id' => "update-school-clubs-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <div class="checkboxes in-row amenities_checkbox">
          <ul>
            <?php
    for ($i = 0; $i < count($facilities); $i++) {
    $facility = $facilities[$i];
            ?>
            <li>
            <input id="check-facility-<?php echo e($i); ?>" type="checkbox" name="facilities">
            <label for="check-facility-<?php echo e($i); ?>"><i class="im <?php echo e($facility['icon']); ?>" style="font-size: 20px;"></i>
              <?php echo e($facility['facility_name']); ?></label>
            </li>
            <?php
    }
            ?>
          </ul>
          </div>
        </div>

        <div class="col-md-12">
          <?php echo $__env->make('components.generic-loading', ['message' => 'Updating your password', 'id' => "update-school-info-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <button class="button btn_center_item margin-top-15" id="update-school-info-btn">Submit</button>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/repos/admissionboox/resources/views/school-dashboard.blade.php ENDPATH**/ ?>