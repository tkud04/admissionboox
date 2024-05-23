 <div class="row"> 
        <div class="col-lg-12 col-md-12">
          <div class="utf_dashboard_list_box margin-top-0">
            <h4 class="gray"><i class="sl sl-icon-key"></i>Update School Information</h4>
            <div class="utf_dashboard_list_box-static"> 
              <div class="my-profile">
              <div class="row with-forms">              
				 <div class="utf_submit_section col-md-12">
					<p>Upload relevant resources; for example, school prospectus, etc</p>
                    <?php echo $__env->make('components.form-validation', ['id' => "update-school-info-resources-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
					<form action="#" onsubmit="handleResourcesUpload" class="dropzone" id="update-school-info-resources"></form>
				  </div>
			  </div>
			    <div class="row with-forms">
                <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-picture"></i> Images</h3>
              </div>			  
              	  
            </div> 
					<div class="col-md-6">
                        <?php echo $__env->make('components.form-validation', ['id' => "update-school-info-password-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('components.form-validation', ['id' => "update-school-info-password2-validation2",'message' => "Passwords must match"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('components.form-validation', ['id' => "update-school-info-password2-validation3",'message' => "Passwords must be at least 6 characters"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<label>New Password</label>						
						<input type="password" class="input-text" id="update-school-info-password" placeholder="*********" value="">
					</div>
					<div class="col-md-6">
                    <?php echo $__env->make('components.form-validation', ['id' => "update-school-info-password2-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<label>Confirm New Password</label>
						<input type="password" class="input-text" id="update-school-info-password2" placeholder="*********" value="">
					</div>
					<div class="col-md-12">
                         <?php echo $__env->make('components.generic-loading', ['message' => 'Updating your password', 'id' => "update-school-info-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<button class="button btn_center_item margin-top-15" id="update-school-info-btn">Change Password</button>
					</div>
				</div>
              </div>
            </div>
          </div>
        </div>
 </div><?php /**PATH /Users/mac/repos/admissionboox/resources/views/update-school-info.blade.php ENDPATH**/ ?>