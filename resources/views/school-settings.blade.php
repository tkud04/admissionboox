<?php
$ac = "settings";
$useSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"Settings")

@section('dashboard-styles')
<style type="text/css">
 .edit-landing-image{
  border-radius: 10%;
    /*max-width: 200px;*/
    width: 100%;
    border: 10px solid rgba(0, 0, 0, 0.08);
 }
</style>
@stop

@section('dashboard-scripts')

  <script>

	 const confirmRemoveBanner = (bannerId) => {
            confirmAction(bannerId, 
			    (xf) => {
            const fd = new FormData()
              fd.append('xf',bannerId)
              fd.append('type','delete')

              updateSchoolSettings(fd,
              (data) => {
                
                $('#settings-loading').hide()
              $('#settings-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('School settings Updated!')
                    window.location = 'school-settings'
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#settings-loading').hide()
              $('#settings-btn').fadeIn()
                alert(`Failed to update school settings: ${err}`)
              }
            )
           })
        
        }


        const confirmFirstBanner = (bannerId) => {
          const fd = new FormData()
              fd.append('xf',bannerId)
              fd.append('type','first')

              updateSchoolSettings(fd,
              (data) => {
                
                $('#settings-loading').hide()
              $('#settings-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('School settings Updated!')
                    window.location = 'school-settings'
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#settings-loading').hide()
              $('#settings-btn').fadeIn()
                alert(`Failed to update school settings: ${err}`)
              }
            )
        }

        const hideValidationErrors = () => {
          $('#sa-admission-validation').hide()
        }


    $(document).ready(() =>{
      $('#settings-btn').click((e) => {
         e.preventDefault()
         const logo = document.querySelector('#ss-logo'),  landingPage = document.querySelector('#ss-landing'),
           v = typeof logo.files[0] === 'undefined' && typeof landingPage.files[0] === 'undefined'
         console.log('logo: ', logo.files[0])
         console.log('landingPage: ', landingPage.files[0])
          
         
         if(v){
          if(typeof logo.files[0] === 'undefined') $('#logo-validation').fadeIn()
          if(typeof landingPage.files[0] === 'undefined') $('#landing-validation').fadeIn()
         } 
        else{
          $('#settings-btn').hide()
          $('#settings-loading').fadeIn()
             
        const fd = new FormData()
              fd.append('xf',"{{$school['id']}}")
              fd.append('logo',logo.files[0])
              fd.append('landing_page',landingPage.files[0])

              updateSchoolSettings(fd,
              (data) => {
                
                $('#settings-loading').hide()
              $('#settings-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('School settings Updated!')
                    window.location = 'school-settings'
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#settings-loading').hide()
              $('#settings-btn').fadeIn()
                alert(`Failed to update school settings: ${err}`)
              }
            )
          }
          
      })
    })
		
	
  </script>
@stop

@section('dashboard-content')
<?php
 $logo = strlen($school['logo']) > 0 ? $school['logo'] : "images/profile.png";
 $banners = $school['banners'];
 $landing = count($banners) > 0 ? $banners[0]['url'] : "images/profile.png";
?>

<div class="row">

<div class="col-lg-12 col-md-12">

          <div class="utf_dashboard_list_box margin-top-0">
            <h4 class="gray"><i class="sl sl-icon-user"></i> Settings</h4>
            <div class="utf_dashboard_list_box-static"> 
              <div class="my-profile">
			    <div class="row with-forms">
					<div class="col-md-6">
						<label>Upload new logo</label>	
            @include('components.form-validation', ['id' => "logo-validation"])					
            <div class="edit-landing-image"> <img src="{{$logo}}" alt="">
                <div class="change-photo-btn">
                  <div class="photoUpload"> <span><i class="fa fa-upload"></i> Upload logo</span>
                    <input type="file" class="upload" id="ss-logo">
                  </div>
                </div>
              </div>
					</div>
          <div class="col-md-6">
						<label> Upload new banner</label>	
            @include('components.form-validation', ['id' => "landing-validation"])					
            <div class="edit-landing-image"> <img src="{{$landing}}" alt="" style="border-radius: 10%;">
                <div class="change-photo-btn">
                  <div class="photoUpload"> <span><i class="fa fa-upload"></i> Upload landing page</span>
                    <input type="file" class="upload" id="ss-landing">
                  </div>
                </div>
              </div>
					</div>
          <div class="col-md-12">
						<label> Banners</label>	
            <div class="row">
              <?php
                foreach($banners as $b)
                {
                  $img = $b['url'];
                  $bid = $b['id'];
                  $bv = $b['first'];
              ?>
                <div class="edit-landing-image"> 
                  <img src="{{$img}}" alt="" style="border-radius: 10%;">
                  <div class="row">
                    <div class="col-md-6">
                    <div class="change-photo-btn">
                  <div class="photoUpload">
                    <a href="" onclick="confirmRemoveBanner('{{$bid}}'); return false;">
                    <span><i class="fa fa-trash"></i>Remove</span>
                    </a>
                  </div>
                </div>
                    </div>
                    <div class="col-md-6">
                       @if($bv === 'no')
                <br>
                <div class="change-photo-btn">
                  <div class="photoUpload">
                    <a href="" onclick="confirmFirstBanner('{{$bid}}'); return false;">
                    <span><i class="fa fa-tag"></i>Show first</span>
                    </a>
                  </div>
                </div>
                @endif
                    </div>
                  </div>
                  
               
                </div>
              <?php
                }
              ?>
            </div>
            
					</div>
					
					
				  </div>	
              </div>
              @include('components.generic-loading', ['message' => 'Updating school settings', 'id' => "settings-loading"])
              <button class="button preview btn_center_item margin-top-15" id="settings-btn">Save Changes</button>
            </div>
          </div>
        </div>
       
</div>
      
@stop