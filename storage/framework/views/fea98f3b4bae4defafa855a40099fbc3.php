<?php
$ac = "applications";
$useSidebar = true;
?>


<?php $__env->startSection('dashboard-title',"Profile"); ?>


<?php $__env->startSection('dashboard-scripts'); ?>

  <script>

	 const confirmChangePassword = (newPassword) => {
            confirmAction(newPassword, 
			    (xf) => {
            updatePassword(xf,
				      () => {
			       		alert('Password changed!')
					      window.location = 'profile'
				      },
				      (err) => {
				       	alert('Failed to change password: ',err)
				      }
			       )
           })
        
        }

        const hideValidationErrors = () => {
          $('#sa-admission-validation').hide()
        }


    $(document).ready(() =>{
      $('#sa-btn-1').click((e) => {
         e.preventDefault()
         const admissionId = $('#sa-admission').val(), v = admissionId === 'none'

         if(v){
          $('#sa-admission-validation').fadeIn()
         } 
      })
    })
		
	
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-content'); ?>

<div class="row">

<div class="col-lg-12 col-md-12">
  <?php
   $avatar = strlen($user['avatar']) >0 ? $user['avatar'] : "images/profile.png";
  ?>
          <div class="utf_dashboard_list_box margin-top-0">
            <h4 class="gray"><i class="sl sl-icon-user"></i> Profile Details</h4>
            <div class="utf_dashboard_list_box-static"> 
              <div class="edit-profile-photo"> <img src="<?php echo e($avatar); ?>" alt="">
                <div class="change-photo-btn">
                  <div class="photoUpload"> <span><i class="fa fa-upload"></i> Upload Photo</span>
                    <input type="file" class="upload">
                  </div>
                </div>
              </div>
              <div class="my-profile">
			    <div class="row with-forms">
					<div class="col-md-4">
						<label>First Name</label>						
						<input type="text" class="input-text" placeholder="Alex Daniel" value="<?php echo e($user->fname); ?>" disabled>
					</div>
          <div class="col-md-4">
						<label>Last Name</label>						
						<input type="text" class="input-text" placeholder="Alex Daniel" value="<?php echo e($user->lname); ?>" disabled>
					</div>
					<div class="col-md-4">
						<label>Phone</label>						
						<input type="text" class="input-text" placeholder="(123) 123-456" value="<?php echo e($user->phone); ?>" disabled>
					</div>
					<div class="col-md-6">
						<label>Email</label>						
						<input type="text" class="input-text" placeholder="test@example.com" value="<?php echo e($user->email); ?>" disabled>
					</div>
					<div class="col-md-6">
						<label>Role</label>						
						<input type="text" class="input-text" placeholder="London" value="School Admin" disabled>
					</div>
					
					
          <!--
          <div class="col-md-4">
						<label>Gender</label>						
						<input type="text" class="input-text" placeholder="20 March 2000" value="<?php echo e($user->gender); ?>">
					</div>
					<div class="col-md-12">
						<label>Address</label>
						<textarea name="notes" cols="30" rows="10">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti.</textarea>
					</div>
            -->
					
				  </div>	
              </div>
              <button class="button preview btn_center_item margin-top-15">Save Changes</button>
            </div>
          </div>
        </div>
       
</div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/school-profile.blade.php ENDPATH**/ ?>