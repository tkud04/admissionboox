<?php
$ac = "applications";
$useSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"Profile")


@section('dashboard-scripts')

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
@stop

@section('dashboard-content')

<div class="row">

<div class="col-lg-12 col-md-12">
  <?php
   $avatar = strlen($user['avatar']) >0 ? $user['avatar'] : "images/profile.png";
   $address = $ua['address'].",".$ua['city'];
  ?>
          <div class="utf_dashboard_list_box margin-top-0">
            <h4 class="gray"><i class="sl sl-icon-user"></i> Profile Details</h4>
            <div class="utf_dashboard_list_box-static"> 
              <div class="edit-profile-photo"> <img src="{{$avatar}}" alt="">
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
						<input type="text" class="input-text" placeholder="Alex Daniel" value="{{$user->fname}}" disabled>
					</div>
          <div class="col-md-4">
						<label>Last Name</label>						
						<input type="text" class="input-text" placeholder="Alex Daniel" value="{{$user->lname}}" disabled>
					</div>
					<div class="col-md-4">
						<label>Phone</label>						
						<input type="text" class="input-text" placeholder="(123) 123-456" value="{{$user->phone}}" disabled>
					</div>
					<div class="col-md-4">
						<label>Email</label>						
						<input type="text" class="input-text" placeholder="test@example.com" value="{{$user->email}}" disabled>
					</div>
					<div class="col-md-4">
						<label>Role</label>						
						<input type="text" class="input-text" placeholder="User role" value="{{ucwords($user->role)}}" disabled>
					</div>
                    <div class="col-md-4">
						<label>Gender</label>						
						<input type="text" class="input-text" placeholder="Gender" value="{{ucwords($user->gender)}}" disabled>
					</div>
					<div class="col-md-12">
						<label>Address</label>
						<textarea name="notes" cols="30" rows="10" disabled>{{$address}}</textarea>
					</div>
					
				  </div>	
              </div>
              <button class="button preview btn_center_item margin-top-15">Save Changes</button>
            </div>
          </div>
        </div>
       
</div>
      
@stop