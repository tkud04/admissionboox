<?php
$ac = "profile";
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
      $('#profile-btn').click((e) => {
         e.preventDefault()
         const address = $('#profile-address').val(),  sstate = $('#profile-state').val(), coords = $('#profile-coords').val(),
           v = address === '' || sstate === '' || coords === ''

         if(v){
         if(address === '') $('#profile-address-validation').fadeIn()
         if(sstate === '') $('#profile-sstate-validation').fadeIn()
         if(coords === '') $('#profile-coords-validation').fadeIn()
         } 
        else{
          const coordsArr = coords.split(',')
          if(coordsArr.length === 2){
            $('#profile-btn').hide()
         $('#profile-loading').fadeIn()

        const fd = new FormData()
              fd.append('xf',"<?php echo e($school['id']); ?>")
              fd.append('address',address)
              fd.append('latitude',coordsArr[0])
              fd.append('longitude',coordsArr[1])
              fd.append('state',sstate)

              updateSchoolProfile(fd,
              (data) => {
                
                $('#profile-loading').hide()
              $('#profile-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('School Profile Updated!')
                    window.location = 'profile'
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#profile-loading').hide()
              $('#profile-btn').fadeIn()
                alert(`Failed to update school profile: ${err}`)
              }
            )
          }
          

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
   $address = $school['address']; $coords = $address['longitude'].",".$address['latitude'];
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
						<input type="text" class="input-text" value="School Admin" disabled>
					</div>

          <div class="col-md-12">
          <?php echo $__env->make('components.form-validation', ['id' => "profile-address-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<label>Address</label>						
						<input type="text" id="profile-address" class="input-text" placeholder="Full address" value="<?php echo e($address['school_address']); ?>">
					</div>
					<div class="col-md-6">
          <?php echo $__env->make('components.form-validation', ['id' => "profile-state-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<label>State</label>						
						<input type="text" id="profile-state" class="input-text" placeholder="e.g Lagos" value="<?php echo e($address['school_state']); ?>">
					</div>
          <div class="col-md-6">
            <?php echo $__env->make('components.form-validation', ['id' => "profile-coords-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<label>Co-ordinates (Latitude,Longitude)</label>						
						<input type="text" id="profile-coords" class="input-text" placeholder="e.g 134.111,-34.12" value="<?php echo e($coords); ?>">
					</div>
					
					
				  </div>	
              </div>
              <?php echo $__env->make('components.generic-loading', ['message' => 'Updating school info', 'id' => "profile-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <button class="button preview btn_center_item margin-top-15" id="profile-btn">Save Changes</button>
            </div>
          </div>
        </div>
       
</div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/school-profile.blade.php ENDPATH**/ ?>