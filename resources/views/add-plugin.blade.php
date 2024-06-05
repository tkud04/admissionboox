<?php
$void = 'javascript:void(0)';
$ac = "dashboard";
$useAdminSidebar = true;
?>

@extends('dashboard_layout')

@section('dashboard-title',"Add Plugin")

@section('dashboard-scripts')
<script>
    $(document).ready(() => {

        $('#add-plugin-name-validation').hide()
        $('#add-plugin-content-validation').hide()

        $('#add-plugin-btn').click(e => {
            e.preventDefault()
            $('#add-plugin-name-validation').hide()
            $('#add-plugin-content-validation').hide()

            const name = $('#add-plugin-name').val(), content = $('#add-plugin-content').val(),
            v = name === '' || content === ''

            if(v){
              if(name === '') $('#add-plugin-name-validation').fadeIn()
              if(content === '') $('#add-plugin-content-validation').fadeIn()
            }
            else{
              $('#add-plugin-btn').hide()
              $('#add-plugin-loading').fadeIn()
              
              const fd = new FormData()
              fd.append('name',name)
              fd.append('value',content)
              addPlugin(fd,
              (data) => {
                
                $('#add-plugin-loading').hide()
              $('#add-plugin-btn').fadeIn()

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
                $('#add-plugin-loading').hide()
              $('#add-plugin-btn').fadeIn()
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
                        @include('components.form-validation', ['id' => "add-plugin-name-validation"])
						<label>Name</label>						
						<input type="text" class="input-text" id="add-plugin-name" placeholder="Plugin name" value="">
					</div>
					<div class="col-md-12">
                     @include('components.form-validation', ['id' => "add-plugin-content-validation"])
						<label>Content</label>
            <textarea class="input-text" id="add-plugin-content" name="value" placeholder="Plugin content" rows="15"></textarea>
					</div>
					<div class="col-md-12">
                         @include('components.generic-loading', ['message' => 'Loading', 'id' => "add-plugin-loading"])
						<button class="button btn_center_item margin-top-15" id="add-plugin-btn">Submit</button>
					</div>
				</div>
              </div>
            </div>
          </div>
        </div>
      </div>
@stop