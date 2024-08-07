<?php
$ac = "profile";
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
              fd.append('xf',"{{$school['id']}}")
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
@stop

@section('dashboard-content')

<div class="row">

<div class="col-lg-12 col-md-12">
  <?php
   $avatar = strlen($user['avatar']) >0 ? $user['avatar'] : "images/profile.png";
   $address = $school['address']; $coords = $address['longitude'].",".$address['latitude'];
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
					<div class="col-md-6">
						<label>Email</label>						
						<input type="text" class="input-text" placeholder="test@example.com" value="{{$user->email}}" disabled>
					</div>
					<div class="col-md-6">
						<label>Role</label>						
						<input type="text" class="input-text" value="School Admin" disabled>
					</div>

          <div class="col-md-12">
          @include('components.form-validation', ['id' => "profile-address-validation"])
						<label>Address</label>						
						<input type="text" id="profile-address" class="input-text" placeholder="Full address" value="{{$address['school_address']}}">
					</div>
					<div class="col-md-6">
          @include('components.form-validation', ['id' => "profile-state-validation"])
						<label>State</label>						
						<input type="text" id="profile-state" class="input-text" placeholder="e.g Lagos" value="{{$address['school_state']}}">
					</div>
          <div class="col-md-6">
            @include('components.form-validation', ['id' => "profile-coords-validation"])
						<label>Co-ordinates (Latitude,Longitude)</label>						
						<input type="text" id="profile-coords" class="input-text" placeholder="e.g 134.111,-34.12" value="{{$coords}}">
					</div>
					
					
				  </div>	
              </div>
              @include('components.generic-loading', ['message' => 'Updating school info', 'id' => "profile-loading"])
              <button class="button preview btn_center_item margin-top-15" id="profile-btn">Save Changes</button>
            </div>
          </div>
        </div>
       
</div>
      
@stop