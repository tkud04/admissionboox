<?php
$void = 'javascript:void(0)';
$useSidebar = true;
$ac = "dashboard";
?>



<?php $__env->startSection('dashboard-title',"Change Password"); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(() => {

        $('#set-password-password-validation').hide()
        $('#set-password-password2-validation').hide()
        $('#set-password-password2-validation2').hide()
        $('#set-password-password2-validation3').hide()

        $('#set-password-btn').click(e => {
            e.preventDefault()
            $('#set-password-password-validation').hide()
            $('#set-password-password2-validation').hide()
            $('#set-password-password2-validation2').hide()
            $('#set-password-password2-validation3').hide()

            const pass = $('#set-password-password').val(), pass2 = $('#set-password-password2').val(),
            v = pass === '' || pass2 === '' || pass !== pass2 || pass.length <= 6

            if(v){
              if(pass === '') $('#set-password-password-validation').fadeIn()
              if(pass2 === '') $('#set-password-password2-validation').fadeIn()
              if(pass !== pass2) $('#set-password-password2-validation2').fadeIn()
              if(pass.length <= 6) $('#set-password-password2-validation3').fadeIn()
            }
            else{
              $('#set-password-btn').hide()
              $('#set-password-loading').fadeIn()
              
              const fd = new FormData()
              fd.append('password',pass)
              fd.append('password_confirmation',pass2)
              fd.append('email',"<?php echo e($em); ?>")
              changePassword(fd,
              (data) => {
                
                $('#set-password-btn').fadeIn()
              $('#set-password-loading').hide()
                if(data.status === 'ok'){
                    alert('Password changed!')
                    window.location = 'dashboard'
                }
                else if(data.status === 'error'){
                    let errMessage = 'please try again'
                    if(data.message === 'invalid-session'){
                     errMessage = 'There was an issue while processing your data. Please contact support'
                    }
                    else if(data.message === 'invalid-user'){
                     errMessage = 'User invalid, please contact support'
                    }

                    alert(errMessage)
                }
              },
              (err) => {alert(`Failed to change password: ${err}`)}
            )
            }
        })
    })
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-content'); ?>
<div class="row"> 
        <div class="col-lg-12 col-md-12">
          <div class="utf_dashboard_list_box margin-top-0">
            <h4 class="gray"><i class="sl sl-icon-key"></i>Email Verified! Set your password:</h4>
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
      </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/change-password.blade.php ENDPATH**/ ?>