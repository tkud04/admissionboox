<?php
$void = 'javascript:void(0)';
$ac = "dashboard";
$useAdminSidebar = true;
?>

@extends('dashboard_layout')

@section('dashboard-title',"Add Facility")

@section('dashboard-scripts')
<script>
    $(document).ready(() => {

        $('#add-facility-name-validation').hide()
        $('#add-facility-content-validation').hide()

        $('#add-facility-btn').click(e => {
            e.preventDefault()
            $('#add-facility-name-validation').hide()
            $('#add-facility-content-validation').hide()

            const name = $('#add-facility-name').val(), content = $('#add-facility-content').val(),
            v = name === '' || content === ''

            if(v){
              if(name === '') $('#add-facility-name-validation').fadeIn()
              if(content === '') $('#add-facility-content-validation').fadeIn()
            }
            else{
              $('#add-facility-btn').hide()
              $('#add-facility-loading').fadeIn()
              
              const fd = new FormData()
              fd.append('name',name)
              fd.append('value',content)
              addPlugin(fd,
              (data) => {
                
                $('#add-facility-loading').hide()
              $('#add-facility-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('Plugin Added!')
                    window.location = 'plugins'
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
              (err) => {
                $('#add-facility-loading').hide()
              $('#add-facility-btn').fadeIn()
                alert(`Failed to change password: ${err}`)
              }
            )
            }
        })
    })
</script>
@stop

@section('dashboard-content')
<div class="row"> 
        <div class="col-lg-12 col-md-12">
          <div class="utf_dashboard_list_box margin-top-0">
            <h4 class="gray"><i class="sl sl-icon-key"></i>Add plugin:</h4>
            <div class="utf_dashboard_list_box-static"> 
              <div class="my-profile">
			    <div class="row with-forms">
					<div class="col-md-12">
                        @include('components.form-validation', ['id' => "add-facility-name-validation"])
						<label>Name</label>						
						<input type="text" class="input-text" id="add-facility-name" placeholder="Plugin name" value="">
					</div>
					<div class="col-md-12">
                     @include('components.form-validation', ['id' => "add-facility-content-validation"])
						<label>Content</label>
            <textarea class="input-text" id="add-facility-content" name="value" placeholder="Plugin content" rows="15"></textarea>
					</div>
					<div class="col-md-12">
                         @include('components.generic-loading', ['message' => 'Loading', 'id' => "add-facility-loading"])
						<button class="button btn_center_item margin-top-15" id="add-facility-btn">Submit</button>
					</div>
				</div>
              </div>
            </div>
          </div>
        </div>
      </div>
@stop