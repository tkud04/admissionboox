 <div class="row"> 
        <div class="col-lg-12 col-md-12">
          <div class="utf_dashboard_list_box margin-top-0">
            <h4 class="gray"><i class="sl sl-icon-key"></i>Update School Information</h4>
            <div class="utf_dashboard_list_box-static"> 
              <div class="my-profile">
			    <div class="row with-forms">
					<div class="col-md-6">
                        <?php echo $__env->make('components.form-validation', ['id' => "set-password-password-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('components.form-validation', ['id' => "set-password-password2-validation2",'message' => "Passwords must match"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('components.form-validation', ['id' => "set-password-password2-validation3",'message' => "Passwords must be at least 6 characters"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<label>New Password</label>						
						<input type="password" class="input-text" id="set-password-password" placeholder="*********" value="">
					</div>
					<div class="col-md-6">
                    <?php echo $__env->make('components.form-validation', ['id' => "set-password-password2-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<label>Confirm New Password</label>
						<input type="password" class="input-text" id="set-password-password2" placeholder="*********" value="">
					</div>
					<div class="col-md-12">
                         <?php echo $__env->make('components.generic-loading', ['message' => 'Updating your password', 'id' => "set-password-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<button class="button btn_center_item margin-top-15" id="set-password-btn">Change Password</button>
					</div>
				</div>
              </div>
            </div>
          </div>
        </div>
 </div><?php /**PATH /Users/mac/repos/admissionboox/resources/views/update-school-info.blade.php ENDPATH**/ ?>