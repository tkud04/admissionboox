<?php
$void = 'javascript:void(0)';
$ac = "dashboard";
$useAdminSidebar = true;
?>

@extends('dashboard_layout')

@section('dashboard-title',"Add Facility")

@section('dashboard-scripts')
<script>
    const hideValidationErrors = () => {
        $('#add-facility-name-validation').hide()
        $('#add-facility-value-validation').hide()
        $('#add-facility-icon-validation').hide()
    }

    $(document).ready(() => {

        hideValidationErrors()

        $('#add-facility-icon').change(() => {
        const thiss = $('#add-facility-icon'), displayElem = $('#add-facility-icon-display')
          const v = thiss.val()
        
          if(v === 'none'){
           displayElem.html('Select an icon')
          }
          else{
            displayElem.html(`<i class='im ${v}' style="font-size: 40px;"></i>`)
          }
        })

        $('#add-facility-name').change(() => {
        const thiss = $('#add-facility-name'), valueElem = $('#add-facility-value')
          const v = thiss.val()
        
          if(v === ''){
           valueElem.val('')
          }
          else{
            const ret = v.split(' ')
          
            if(ret.length > 0){
                let ret2 = ret[0].toLowerCase()
                for(let i = 1; i < ret.length; i++){
                    ret2 += `-${ret[i].toLowerCase()}`
                }
                valueElem.val(ret2)
            }
           
          }
        })

        $('#add-facility-btn').click(e => {
            e.preventDefault()
            hideValidationErrors()

            const name = $('#add-facility-name').val(), value = $('#add-facility-value').val(),
                  icon = $('#add-facility-icon').val(), v = name === '' || value === '' || icon === 'none'

            if(v){
              if(name === '') $('#add-facility-name-validation').fadeIn()
              if(value === '') $('#add-facility-value-validation').fadeIn()
              if(icon === 'none') $('#add-facility-icon-validation').fadeIn()
            }
            else{
              $('#add-facility-btn').hide()
              $('#add-facility-loading').fadeIn()
              
              const fd = new FormData()
              fd.append('facility_name',name)
              fd.append('facility_value',value)
              fd.append('icon',icon)
              addFacility(fd,
              (data) => {
                
                $('#add-facility-loading').hide()
              $('#add-facility-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('Facility Added!')
                    window.location = 'facilities'
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#add-facility-loading').hide()
              $('#add-facility-btn').fadeIn()
                alert(`Failed to add facility: ${err}`)
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
            <h4 class="gray"><i class="sl sl-icon-key"></i>Add facility:</h4>
            <div class="utf_dashboard_list_box-static"> 
              <div class="my-profile">
			    <div class="row with-forms">
					<div class="col-md-6">
                        @include('components.form-validation', ['id' => "add-facility-name-validation"])
						<label>Name</label>						
						<input type="text" class="input-text" id="add-facility-name" placeholder="Facility name" value="">
					</div>
					<div class="col-md-6">
                     @include('components.form-validation', ['id' => "add-facility-value-validation"])
						<label>Value</label>
                        <input type="text" class="input-text" id="add-facility-value" placeholder="Facility value" value="" disabled>
					</div>
                    <div class="col-md-6">
                     @include('components.form-validation', ['id' => "add-facility-icon-validation"])
						<label>Icon</label>
                        <select class="input-text" id="add-facility-icon" placeholder="Facility icon">
                            <option value="none">Select an option</option>
                            @foreach($iconsList as $ic)
                            <option value="{{$ic}}">{{$ic}}</option>
                            @endforeach
                        </select>
					</div>
                    <div class="col-md-6">
                         <label>Icon Selected</label>
                    	<p><span id="add-facility-icon-display" style="font-size: 20px;">Select an icon</span></p>
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