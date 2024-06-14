<?php
$void = 'javascript:void(0)';
$ac = "dashboard";
$useAdminSidebar = true;
?>

@extends('dashboard_layout')

@section('dashboard-title',"Add Club")

@section('dashboard-scripts')
<script>
    const hideValidationErrors = () => {
        $('#add-club-name-validation').hide()
        $('#add-club-value-validation').hide()
        $('#add-club-icon-validation').hide()
    }

    $(document).ready(() => {

        hideValidationErrors()

        $('#add-club-icon').change(() => {
        const thiss = $('#add-club-icon'), displayElem = $('#add-club-icon-display')
          const v = thiss.val()
        
          if(v === 'none'){
           displayElem.html('Select an icon')
          }
          else{
            displayElem.html(`<i class='im ${v}' style="font-size: 40px;"></i>`)
          }
        })

        $('#add-club-name').change(() => {
        const thiss = $('#add-club-name'), valueElem = $('#add-club-value')
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

        $('#add-club-btn').click(e => {
            e.preventDefault()
            hideValidationErrors()

            const name = $('#add-club-name').val(), value = $('#add-club-value').val(),
                  icon = $('#add-club-icon').val(), v = name === '' || value === '' || icon === 'none'

            if(v){
              if(name === '') $('#add-club-name-validation').fadeIn()
              if(value === '') $('#add-club-value-validation').fadeIn()
              if(icon === 'none') $('#add-club-icon-validation').fadeIn()
            }
            else{
              $('#add-club-btn').hide()
              $('#add-club-loading').fadeIn()
              
              const fd = new FormData()
              fd.append('club_name',name)
              fd.append('club_value',value)
              fd.append('img_url',icon)
              addClub(fd,
              (data) => {
                
                $('#add-club-loading').hide()
              $('#add-club-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('Club Added!')
                    window.location = 'clubs'
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#add-club-loading').hide()
              $('#add-club-btn').fadeIn()
                alert(`Failed to add club: ${err}`)
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
            <h4 class="gray"><i class="sl sl-icon-key"></i>Add club:</h4>
            <div class="utf_dashboard_list_box-static"> 
              <div class="my-profile">
			    <div class="row with-forms">
					<div class="col-md-6">
                        @include('components.form-validation', ['id' => "add-club-name-validation"])
						<label>Name</label>						
						<input type="text" class="input-text" id="add-club-name" placeholder="Club name" value="">
					</div>
					<div class="col-md-6">
                     @include('components.form-validation', ['id' => "add-club-value-validation"])
						<label>Value</label>
                        <input type="text" class="input-text" id="add-club-value" placeholder="Club value" value="" disabled>
					</div>
                    <div class="col-md-6">
                     @include('components.form-validation', ['id' => "add-club-icon-validation"])
						<label>Icon</label>
                        <select class="input-text" id="add-club-icon" placeholder="Club icon">
                            <option value="none">Select an option</option>
                            @foreach($iconsList as $ic)
                            <option value="{{$ic}}">{{$ic}}</option>
                            @endforeach
                        </select>
					</div>
                    <div class="col-md-6">
                         <label>Icon Selected</label>
                    	<p><span id="add-club-icon-display" style="font-size: 20px;">Select an icon</span></p>
					</div>
					<div class="col-md-12">
                         @include('components.generic-loading', ['message' => 'Loading', 'id' => "add-club-loading"])
						<button class="button btn_center_item margin-top-15" id="add-club-btn">Submit</button>
					</div>
				</div>
              </div>
            </div>
          </div>
        </div>
      </div>
@stop